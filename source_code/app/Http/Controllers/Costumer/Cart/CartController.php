<?php

namespace App\Http\Controllers\Costumer\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart');

        if (!$cart || count($cart) == 0) {
            return redirect()->route('cart.view')->with('error', 'Keranjang belanja Anda kosong.');
        }

        // Hitung total harga
        $totalHarga = 0;
        foreach ($cart as $id => $details) {
            $totalHarga += $details['harga_tayang'] * $details['quantity'];
        }

        // Buat order
        $order = Order::create([
            'user_id' => auth()->id(),
            'harga_total' => $totalHarga,
            'status' => 'pending',
        ]);

        // Simpan item dalam order
        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'produk_id' => $id,
                'jumlah' => $details['quantity'],
                'harga' => $details['harga_tayang'],
            ]);
        }

        // Kosongkan keranjang setelah checkout
        session()->forget('cart');

        return redirect()->route('order.show', $order->id)->with('success', 'Pesanan Anda berhasil dibuat!');
    }
    public function add(Request $request, $id)
    {
        $product = Produk::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }

        // Pastikan harga tayang ada
        if (!$product->harga_tayang) {
            return redirect()->back()->with('error', 'Harga Tayang tidak tersedia untuk produk ini!');
        }

        $quantity = $request->input('quantity', 1); // default quantity to 1 if not provided

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                "name" => $product->nama,
                "quantity" => $quantity,
                "harga_tayang" => $product->harga_tayang,
                "image" => $product->images->first()->gambar ?? 'default.png' // handle missing image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function viewCart()
    {
        $cart = session()->get('cart');

        return view('customer.cart.show', compact('cart'));
    }

    public function update(Request $request, $id)
    {
        if ($request->has('quantity')) {
            $cart = session()->get('cart');
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);

            return redirect()->route('cart.view')->with('success', 'Keranjang berhasil diperbarui!');
        }
    }

    public function remove($id)
    {
        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect()->route('cart.view')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
