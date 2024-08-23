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
        // Memuat produk beserta relasinya (images, kategori, subKategori, komoditas, dan bigSales)
        $produk = Produk::with(['images', 'kategori', 'subKategori', 'komoditas', 'bigSales'])->findOrFail($id);
        $images = $produk->images;
    
        // Memeriksa apakah produk termasuk dalam Big Sale
        $bigSale = $produk->bigSales->first(); // Ambil Big Sale pertama jika ada

        $bigSaleItem = $produk->bigSales()->where('status', 'aktif')->first();

    
        // Ambil 5 produk lain yang memiliki komoditas atau kategori yang sama, tetapi bukan produk yang sedang ditampilkan
        $produK = Produk::where('id', '!=', $id)
                        ->where(function ($query) use ($produk) {
                            $query->where('komoditas_id', $produk->komoditas_id)
                                  ->orWhere('kategori_id', $produk->kategori_id);
                        })
                        ->has('images')
                        ->limit(5)
                        ->get();
    
        return view('customer.produk.show', compact('produk', 'images', 'produK', 'bigSale','bigSaleItem'));
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
