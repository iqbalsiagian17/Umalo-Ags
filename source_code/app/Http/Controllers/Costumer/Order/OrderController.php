<?php

namespace App\Http\Controllers\Costumer\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function show($id)
    {
        $order = Order::with('orderItems.produk')->findOrFail($id);

        return view('customer.order.show', compact('order'));
    }

    public function contract($id)
    {
        $order = Order::with('orderItems.produk')->findOrFail($id);

        return view('customer.order.contract', compact('order'));
    }
}
