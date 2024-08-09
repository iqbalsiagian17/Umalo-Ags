<?php

namespace App\Http\Controllers\Costumer\Produk;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukCostumerController extends Controller
{
    public function userShow($id)
    {
        $produk = Produk::with(['images', 'kategori', 'subKategori', 'komoditas'])->findOrFail($id);
        $images = $produk->images;
        return view('customer.produk.show', compact('produk', 'images'));
    }
}
