<?php

namespace App\Http\Controllers;

use App\Models\BigSale;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $produk = Produk::with('images')
            ->where('status', 'publish')
            ->get();
    
        $slider = Slider::all();
    
        $bigSale = BigSale::with('produk')
            ->where('status', true)
            ->whereDate('mulai', '<=', now())
            ->whereDate('berakhir', '>=', now())
            ->first();
    
        $kategori = Kategori::take(10)->get(); // Retrieve all categories
    
        return view('home', compact('produk', 'bigSale', 'slider', 'kategori'));
    }
    

    public function dashboard()
    {
        $customerCount = User::where('role', 'customer')->count();

        return view('dashboard',compact('customerCount'));
    }
}
