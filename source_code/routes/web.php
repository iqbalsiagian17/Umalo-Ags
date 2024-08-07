<?php

use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MasterData\KategoriController;
use App\Http\Controllers\Admin\MasterData\SubKategoriController;
use App\Http\Controllers\Admin\MasterData\KomoditasController;
use Illuminate\Support\Facades\Auth; 
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Normal Users Routes List
Route::middleware(['auth', 'user-access:costumer'])->group(function () {
   
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
   
//Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
   
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::prefix('admin/masterdata')->name('admin.masterdata.')->group(function () {
        Route::resource('kategori', KategoriController::class);
        Route::resource('subkategori', SubKategoriController::class);
        Route::resource('komoditas', KomoditasController::class)
        ->parameters(['komoditas' => 'komoditas']);
    });
    
});


//akun sosial login
Route::get('/auth/{provider}redirect', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('socialite.callback');


