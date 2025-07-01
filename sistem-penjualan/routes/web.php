<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfileController;
use App\Models\Produk;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $produk = Produk::where('stok', '>', 0)->get();
        return view('dashboard', compact('produk'));
    })->name('dashboard');

    Route::get('/admin', function () {
        return view('welcome');
    })->name('admin.dashboard');

    // Admin only routes
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('sellers', SellerController::class);
        Route::resource('buyers', BuyerController::class);
        Route::resource('produk', ProdukController::class)->except(['index', 'show']);
    });

    // Admin and seller routes
    Route::middleware(['role:admin,seller'])->group(function () {
        Route::resource('produk', ProdukController::class)->except(['index', 'show']);
    });

    // User and admin routes for penjualan
    Route::middleware(['role:admin,user'])->group(function () {
        Route::resource('penjualan', PenjualanController::class);
    });

    // Public routes (all authenticated users)
    Route::resource('produk', ProdukController::class)->only(['index', 'show']);

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';