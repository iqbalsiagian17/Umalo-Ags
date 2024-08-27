<?php

namespace App\Http\Controllers\Costumer\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use PDF;
use App\Models\PPN;
use App\Models\Materai;
class OrderController extends Controller
{
    public function negoisasi($id)
    {
        $order = Order::findOrFail($id);
        
        // Change the status to 'Negosiasi'
        $order->status = 'Negosiasi';
        $order->save();

        return redirect()->route('order.show', $id)->with('success', 'Negosiasi telah dimulai. Silakan tunggu konfirmasi dari admin.');
    }
    public function show($id)
    {
        $order = Order::with('orderItems.produk')->findOrFail($id);
        return view('customer.order.detail-pesanan', compact('order'));
    }

    public function contract($id)
    {
        $order = Order::with('orderItems.produk')->findOrFail($id);

        return view('customer.order.contract', compact('order'));
    }
    public function history()
    {
        $orders = Order::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();

        return view('customer.order.riwayat-pesanan', compact('orders'));
    }


    public function detail($id)
    {
        $order = Order::findOrFail($id);
        return view('customer.order.detail-pesanan', compact('order'));
    }
    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancelled';
        $order->save();

        return redirect()->route('order.detail', $order->id)->with('success', 'Pesanan telah dibatalkan.');
    }
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
    
        // If the user clicks the "Terima Barang" button, set the status to "Selesai"
        if ($order->status == 'Pengiriman') {
            $order->status = 'Selesai';
            $order->save();
    
            return redirect()->route('order.show', $order->id)->with('success', 'Pesanan telah selesai. Terima kasih telah berbelanja!');
        }
    
        // Other status updates can be handled here if necessary
        $order->update($request->all());
    
        return redirect()->route('order.show', $order->id)->with('success', 'Status pesanan berhasil diperbarui.');
    }
    

    public function cancelOrder(Request $request, $id)
{
    $order = Order::findOrFail($id);

    // Allow cancellation if the status is "Menunggu Konfirmasi Admin", "Menunggu Konfirmasi Admin untuk Negosiasi", "Negosiasi", or "Diterima"
    if (in_array($order->status, ['Menunggu Konfirmasi Admin', 'Menunggu Konfirmasi Admin untuk Negosiasi', 'Negosiasi', 'Diterima'])) {
        $order->status = 'Cancelled';
        $order->save();

        return redirect()->route('order.show', $order->id)->with('success', 'Pesanan berhasil dibatalkan.');
    }

    return redirect()->route('order.show', $order->id)->with('error', 'Pesanan tidak dapat dibatalkan pada tahap ini.');
}
public function generatePdf($id)
{
    $order = Order::with(['orderItems.produk', 'user.userDetail'])->findOrFail($id);
    $ppn = PPN::latest()->first();
    $materai = Materai::all(); // Retrieve all Materai records

    $totalPriceWithPPN = $order->harga_total + ($order->harga_total * ($ppn->ppn / 100));
    $userDetail = $order->user->userDetail; // Retrieve the UserDetail from the Order's user relationship

    // Convert Materai images to base64
    $materaiImages = [];
    foreach ($materai as $item) {
        $path = public_path($item->image);
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $materaiImages[] = $base64;
        }
    }

    $pdf = PDF::loadView('customer.order.pdf', compact('order', 'ppn', 'materaiImages', 'totalPriceWithPPN', 'userDetail'));

    // Generate the filename
    $companyName = preg_replace('/[^A-Za-z0-9\-]/', '_', $userDetail->perusahaan); // Sanitize the company name for a filename
    $year = $order->created_at->format('Y');
    $fileName = "invoice-{$companyName}-{$year}.pdf";

    return $pdf->download($fileName);
}





public function transactionHistory($id)
{
    $order = Order::with('statusHistories')->findOrFail($id);

    return view('customer.order.transaction_history', compact('order'));
}
public function uploadBuktiPembayaran(Request $request, $id)
{
    $request->validate([
        'bukti_pembayaran' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $order = Order::findOrFail($id);

    if ($request->file('bukti_pembayaran')) {
        $file = $request->file('bukti_pembayaran');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/bukti_pembayaran'), $filename);
        $order->bukti_pembayaran = $filename;
    }

    $order->save();

    return redirect()->route('order.show', $id)->with('success', 'Bukti pembayaran berhasil diunggah.');
}
public function submitReview(Request $request, $id)
{
    $order = Order::with('orderItems.produk')->findOrFail($id); // Ensure the order and related products are loaded

    if ($order->status !== 'Selesai') {
        return redirect()->route('order.show', $id)->with('error', 'Anda hanya dapat mengulas setelah pesanan selesai.');
    }

    $request->validate([
        'review' => 'required|string|max:1000',
    ]);

    // Assuming the user is submitting a review for the first product in the order
    $orderItem = $order->orderItems->first();
    if ($orderItem) {
        $orderItem->produk->reviews()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('review'),
        ]);

        return redirect()->route('product.show', $orderItem->produk->id)->with('success', 'Ulasan berhasil dikirim.');
    }

    return redirect()->route('order.show', $id)->with('error', 'Terjadi kesalahan saat mengirim ulasan.');
}

                
    
}
