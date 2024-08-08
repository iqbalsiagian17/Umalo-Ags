<?php

namespace App\Http\Controllers\Admin\BigSale;

use App\Http\Controllers\Controller;
use App\Models\BigSale;
use App\Models\Produk;
use Illuminate\Http\Request;

class BigsaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bigSales = BigSale::with('produk')->get();
        return view('admin.bigsale.index', compact('bigSales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Produk::all();
        return view('admin.bigsale.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bigSale = BigSale::create($request->only('judul', 'mulai', 'berakhir', 'status'));
    
        if ($request->has('products')) {
            foreach ($request->products as $product_id) {
                if (isset($request->harga_diskon[$product_id])) {
                    $harga_diskon = $request->harga_diskon[$product_id];
                    $bigSale->produk()->attach($product_id, ['harga_diskon' => $harga_diskon]);
                }
            }
        }
    
        return redirect()->route('bigsale.index');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bigSale = BigSale::with('produk')->findOrFail($id);
        return view('admin.bigsale.show', compact('bigSale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bigSale = BigSale::findOrFail($id);
        $bigSale->mulai = \Carbon\Carbon::parse($bigSale->mulai);
        $bigSale->berakhir = \Carbon\Carbon::parse($bigSale->berakhir);
        $products = Produk::all();
        return view('admin.bigsale.edit', compact('bigSale', 'products'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bigSale = BigSale::findOrFail($id);
        $bigSale->update($request->only('judul', 'mulai', 'berakhir', 'status'));
    
        // Detach existing products
        $bigSale->produk()->detach();
    
        // Attach new products with discount prices
        foreach ($request->products as $product_id => $value) {
            $harga_diskon = $request->input("products.{$product_id}_harga_diskon");
            if ($harga_diskon) {
                $bigSale->produk()->attach($product_id, ['harga_diskon' => $harga_diskon]);
            }
        }
    
        return redirect()->route('bigsale.index');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bigSale = BigSale::findOrFail($id);
        $bigSale->delete();
        return redirect()->route('bigsale.index');
    }
}
