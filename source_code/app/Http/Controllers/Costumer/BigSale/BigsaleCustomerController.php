<?php

namespace App\Http\Controllers\Costumer\BigSale;

use App\Http\Controllers\Controller;
use App\Models\BigSale;
use Illuminate\Http\Request;

class BigSaleCustomerController extends Controller
{
    public function index(){

        $bigSale = BigSale::with('produk')
        ->where('status', true)
        ->whereDate('mulai', '<=', now())
        ->whereDate('berakhir', '>=', now())
        ->first();

    // If there is an active Big Sale, get the products
    $products = $bigSale ? $bigSale->produk : collect(); // Use collect() for an empty collection if no BigSale is active

    return view('customer.bigsale.index', compact('products'));    }
}
