<?php

namespace App\Http\Controllers\Admin\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems')->get();
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

    if ($request->ajax()) {
        if ($request->status == 'Negosiasi' && $request->has('whatsapp_number')) {
            $request->validate([
                'whatsapp_number' => 'required|string',
            ]);
            $order->whatsapp_number = $request->whatsapp_number;
        }

        $order->status = $request->status;
        $order->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully!', 'whatsapp_number' => $order->whatsapp_number]);
    }

    return redirect()->route('transaksi.index', $order->id)->with('success', 'Status pesanan berhasil diperbarui.');
}

    

    

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
