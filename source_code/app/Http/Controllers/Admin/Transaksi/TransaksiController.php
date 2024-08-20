<?php

namespace App\Http\Controllers\Admin\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems')->get();
        // Ambil daftar ID transaksi yang telah dilihat dari session
        $seenOrders = Session::get('seen_orders', []);

        // Simpan ID transaksi yang telah dilihat di session
        $newSeenOrders = $orders->pluck('id')->toArray();
        $seenOrders = array_merge($seenOrders, $newSeenOrders);
        Session::put('seen_orders', array_unique($seenOrders));
        return view('admin.transaksi.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        return view('admin.transaksi.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        return view('admin.transaksi.edit', compact('order'));
    }

    public function update(Request $request, $id)
{
    $order = Order::findOrFail($id);

    // Validate and set the tracking number if the status is Pengiriman
    if ($request->status == 'Pengiriman') {
        $request->validate([
            'nomor_resi' => 'required|string',
        ]);
        $order->nomor_resi = $request->nomor_resi;
    }

    // Validate and set the WhatsApp number if the status is Negosiasi
    if ($request->status == 'Negosiasi') {
        $request->validate([
            'whatsapp_number' => 'required|string',
        ]);
        $order->whatsapp_number = $request->whatsapp_number;
    }

    // Update the order status
    $order->status = $request->status;
    $order->save();

    // Log the status change with any additional info
    $order->statusHistories()->create([
        'status' => $request->status,
        'extra_info' => $request->status == 'Pengiriman' ? $order->nomor_resi : null,
        'created_at' => now(),
    ]);

    return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
}

    

    

    

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
