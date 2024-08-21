<?php

namespace App\Http\Controllers\Costumer\Produk;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Komoditas;
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

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        $komoditas = Komoditas::all();
        $kategori = Kategori::all();
    
        // Search products by name or any other fields you want
        $produk = Produk::where('nama', 'LIKE', "%{$query}%")
            ->orWhere('spesifikasi_produk', 'LIKE', "%{$query}%")
            ->orWhere('merk', 'LIKE', "%{$query}%")
            ->get();
    
        // Count the number of products found
        $productCount = $produk->count();
    
        // Return the search results to a view
        return view('customer.search.index', compact('produk', 'query', 'komoditas', 'kategori', 'productCount'));
    }

    
    
}
