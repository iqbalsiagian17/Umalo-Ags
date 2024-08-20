<?php

namespace App\Http\Controllers\Costumer\BigSale;

use App\Http\Controllers\Controller;
use App\Models\BigSale;
use App\Models\Kategori;
use App\Models\Komoditas;
use App\Models\Produk;
use Illuminate\Http\Request;

class BigSaleCustomerController extends Controller
{
    public function index(Request $request)
{
    $bigSale = BigSale::with('produk')
        ->where('status', true)
        ->whereDate('mulai', '<=', now())
        ->whereDate('berakhir', '>=', now())
        ->first();

    // If there is an active Big Sale, get the products
    $products = $bigSale ? $bigSale->produk : collect(); 

    $komoditas = Komoditas::all();
    $kategori = Kategori::all();
    $sort = $request->get('sort');
    $kategoriId = $request->get('kategori_id');

    // Filter produk Big Sale berdasarkan kategori jika ada
    if ($kategoriId) {
        $products = $products->where('kategori_id', $kategoriId);
    }

    // Sorting produk Big Sale berdasarkan parameter yang diberikan
    if ($sort == 'newest') {
        $products = $products->sortByDesc('created_at');
    } elseif ($sort == 'oldest') {
        $products = $products->sortBy('created_at');
    }

    // Dapatkan jumlah produk setelah menerapkan filter dan sorting
    $productCount = $products->count(); 

    return view('customer.bigsale.index', compact('bigSale','products', 'komoditas', 'kategori', 'productCount'));
}

    public function updateStatus($id)
{
    $bigSale = BigSale::findOrFail($id);
    $bigSale->update(['status' => 'tidak aktif']);
    
    return response()->json(['message' => 'Status updated successfully']);
}

}
