<?php

namespace App\Http\Controllers;

use App\Models\BigSale;
use App\Models\Kategori;
use App\Models\Komoditas;
use App\Models\Order;
use App\Models\Produk;
use App\Models\Slider;
use App\Models\User;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // Update the status of expired Big Sales
        $this->updateBigSaleStatus();
    
        $produk = Produk::with('images')
            ->where('status', 'publish')
            ->get();
    
        $slider = Slider::all();
    
        $bigSale = BigSale::with('produk')
            ->where('status', 'aktif')
            ->whereDate('mulai', '<=', now())
            ->whereDate('berakhir', '>=', now())
            ->first();
    
        $kategori = Kategori::take(10)->get(); // Retrieve all categories
    
        return view('home', compact('produk', 'bigSale', 'slider', 'kategori'));
    }

    public function shop()
    {
        // Update the status of expired Big Sales
    
        $produk = Produk::with('images')
            ->where('status', 'publish')
            ->get();
    
        $kategori = Kategori::get(); // Retrieve all categories

        $komoditas = Komoditas::get();
    
        return view('customer.home.shop', compact('produk', 'kategori','komoditas'));
    }    
    


private function updateBigSaleStatus()
{
    $currentDateTime = now(); // Get the current date and time

    // Update all active Big Sales that have passed their end time
    BigSale::where('status', 'aktif')
        ->where('berakhir', '<=', $currentDateTime)
        ->update(['status' => 'tidak aktif']);
}



    

    public function dashboard()
    {
        // Menghitung jumlah pelanggan
        $customerCount = User::where('role', 'customer')->count();
    
        // Menghitung jumlah pesanan
        $orderCount = Order::count();
    
        // Menghitung jumlah kunjungan ke halaman home hari ini oleh pengguna biasa
        $visitorCountToday = Visit::whereDate('visited_at', Carbon::today())->count();
    
        // Statistik kunjungan berdasarkan interval waktu (misalnya per jam dalam sehari)
        $hourlyVisits = Visit::select(DB::raw('HOUR(visited_at) as hour'), DB::raw('count(*) as visits'))
            ->whereDate('visited_at', Carbon::today())
            ->groupBy('hour')
            ->orderBy('hour', 'asc')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item['hour'] => $item['visits']];
            });
    
        // Hitung durasi kunjungan individu per pengguna hari ini
        $visitDurations = Visit::whereDate('visited_at', Carbon::today())
            ->select(DB::raw('TIMESTAMPDIFF(SECOND, MIN(visited_at), MAX(visited_at)) as duration'))
            ->groupBy('user_id')
            ->pluck('duration');
    
        // Hitung rata-rata durasi kunjungan hari ini
        $averageVisitTimeToday = $visitDurations->avg();
    
        // Mengirim variabel ke view
        return view('dashboard', compact('customerCount', 'orderCount', 'visitorCountToday', 'hourlyVisits', 'averageVisitTimeToday'));
    }
    
}
