<?php

namespace App\Http\Controllers;

use App\Models\BigSale;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $produk = Produk::with('images')->get();
        $slider = Slider::all();
        $bigSale = BigSale::with('produk')
        ->where('status', true)
        ->whereDate('mulai', '<=', now())
        ->whereDate('berakhir', '>=', now())
        ->first();

        return view('home', compact('produk','bigSale','slider'));
    }

    public function dashboard()
    {
        $customerCount = User::where('role', 'customer')->count();

        return view('dashboard',compact('customerCount'));
    }
}
