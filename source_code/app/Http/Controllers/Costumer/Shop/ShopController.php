<?php

namespace App\Http\Controllers\Costumer\Shop;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Komoditas;
use App\Models\Produk;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function shop(Request $request)
    {
        // Ambil semua kategori dan komoditas untuk ditampilkan di sidebar
        $kategori = Kategori::take(10)->get(); // Retrieve all categories
        $komoditas = Komoditas::get();
        
        // Ambil parameter sort dan kategori dari request
        $sort = $request->get('sort');
        $kategoriId = $request->get('kategori_id');
    
        // Query dasar untuk produk yang dipublish
        $query = Produk::with('images')->where('status', 'publish');
    
        // Filter berdasarkan kategori jika ada
        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }
    
        // Sorting berdasarkan parameter yang diberikan
        if ($sort == 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        }
    
    
        $produk = $query->paginate(9);
    
        // Dapatkan produk setelah menerapkan filter dan sorting
        $productCount = $produk->total();
    
        return view('customer.shop.shop', compact('produk', 'kategori', 'komoditas', 'productCount'));
    }
    
    
    public function filterByCategory(Request $request, $id)
    {
        $kategori = Kategori::all(); // Untuk sidebar kategori
        $currentCategory = Kategori::find($id); // Kategori yang dipilih
    
        if (!$currentCategory) {
            return redirect()->route('shop')->with('error', 'Kategori tidak ditemukan.');
        }
    
        // Menghitung jumlah produk yang memiliki kategori yang sama
        $productCount = Produk::where('kategori_id', $id)->where('status', 'publish')->count();
    
        $komoditas = Komoditas::all(); // Untuk sidebar komoditas
        
        $sort = $request->get('sort');
        $query = Produk::where('kategori_id', $id)->where('status', 'publish');
    
        if ($sort == 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        }
    
        // Selalu dapatkan produk setelah sorting
        $produk = $query->paginate(9);
        
        // Pastikan untuk mengirimkan variabel $productCount ke view
        return view('customer.shop.kategori', compact('produk', 'kategori', 'currentCategory', 'komoditas', 'productCount'));
    }
    
    
    
    
    
}
