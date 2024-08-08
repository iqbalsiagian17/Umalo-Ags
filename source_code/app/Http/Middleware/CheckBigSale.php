<?php

// app/Http/Middleware/CheckBigSale.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Produk;

class CheckBigSale
{
    public function handle(Request $request, Closure $next)
    {
        $products = Produk::with('bigSales')->get();

        foreach ($products as $product) {
             $product->harga_tayang; // Default ke harga tayang
            foreach ($product->bigSales as $bigSale) {
                if ($bigSale->status && now()->between($bigSale->mulai, $bigSale->berakhir)) {
                     $product->pivot->harga_diskon;
                    break; // Keluar dari loop setelah menemukan harga diskon
                }
            }
        }

        $request->attributes->set('products', $products); // Menambahkan produk ke atribut request

        return $next($request);
    }
}

