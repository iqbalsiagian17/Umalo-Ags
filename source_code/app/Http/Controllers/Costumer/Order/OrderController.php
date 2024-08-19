<?php

namespace App\Http\Controllers\Costumer\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use PDF;

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
        $orders = auth()->user()->orders; // Assuming you have a relationship set up in the User model
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

    // Allow cancellation if the status is "Menunggu ACC Admin", "Menunggu ACC Admin untuk Negosiasi", "Negosiasi", or "Diterima"
    if (in_array($order->status, ['Menunggu ACC Admin', 'Menunggu ACC Admin untuk Negosiasi', 'Negosiasi', 'Diterima'])) {
        $order->status = 'Cancelled';
        $order->save();

        return redirect()->route('order.show', $order->id)->with('success', 'Pesanan berhasil dibatalkan.');
    }

    return redirect()->route('order.show', $order->id)->with('error', 'Pesanan tidak dapat dibatalkan pada tahap ini.');
}
public function generatePdf($id)
{
    $order = Order::with('orderItems.produk')->findOrFail($id);

    $pdf = PDF::loadView('customer.order.pdf', compact('order'));
    return $pdf->download('order-details.pdf');
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


                
    
}
