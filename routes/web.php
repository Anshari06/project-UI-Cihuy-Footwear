<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;

Route::get('/', [BarangController::class, 'landing'])->name('landing');

Auth::routes();

// ===================== PELANGGAN =====================
Route::middleware(['auth', 'pelanggan'])->group(function () {
    // Shop
    Route::get('/collection', [BarangController::class, 'index'])->name('collection');
    Route::get('/DetailProduk/{id}', [BarangController::class, 'show'])->name('detailproduk');

    // Cart & Checkout
    Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    // Pesanan
    Route::get('/history', [PesananController::class, 'index'])->name('history');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');
});

// ===================== ARTIKEL (guest-friendly) =====================
Route::get('/artikel', [ArticleController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('artikel.show');

// ===================== ADMIN =====================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Barang
    Route::get('/barang', [AdminController::class, 'barangIndex'])->name('barang.index');
    Route::get('/barang/create', [AdminController::class, 'barangCreate'])->name('barang.create');
    Route::post('/barang', [AdminController::class, 'barangStore'])->name('barang.store');
    Route::get('/barang/{id}/edit', [AdminController::class, 'barangEdit'])->name('barang.edit');
    Route::put('/barang/{id}', [AdminController::class, 'barangUpdate'])->name('barang.update');
    Route::delete('/barang/{id}', [AdminController::class, 'barangDestroy'])->name('barang.destroy');

    // Artikel
    Route::get('/artikel', [AdminController::class, 'artikelIndex'])->name('artikel.index');
    Route::get('/artikel/create', [AdminController::class, 'artikelCreate'])->name('artikel.create');
    Route::post('/artikel', [AdminController::class, 'artikelStore'])->name('artikel.store');
    Route::get('/artikel/{id}/edit', [AdminController::class, 'artikelEdit'])->name('artikel.edit');
    Route::put('/artikel/{id}', [AdminController::class, 'artikelUpdate'])->name('artikel.update');
    Route::delete('/artikel/{id}', [AdminController::class, 'artikelDestroy'])->name('artikel.destroy');
    Route::get('/artikel/arsip', [AdminController::class, 'arsipIndex'])->name('artikel.arsip');
    Route::post('/artikel/{id}/restore', [AdminController::class, 'arsipRestore'])->name('artikel.restore');
    Route::delete('/artikel/{id}/force', [AdminController::class, 'arsipDestroy'])->name('artikel.forceDelete');

    // Pesanan
    Route::get('/pesanan', [AdminController::class, 'pesananIndex'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [AdminController::class, 'pesananShow'])->name('pesanan.show');
    Route::put('/pesanan/{id}/status', [AdminController::class, 'pesananUpdateStatus'])->name('pesanan.status');

    // Pengguna
    Route::get('/pengguna', [AdminController::class, 'penggunaIndex'])->name('pengguna.index');
    Route::get('/pengguna/create', [AdminController::class, 'penggunaCreate'])->name('pengguna.create');
    Route::post('/pengguna', [AdminController::class, 'penggunaStore'])->name('pengguna.store');
    Route::get('/pengguna/{id}/edit', [AdminController::class, 'penggunaEdit'])->name('pengguna.edit');
    Route::put('/pengguna/{id}', [AdminController::class, 'penggunaUpdate'])->name('pengguna.update');
    Route::delete('/pengguna/{id}', [AdminController::class, 'penggunaDestroy'])->name('pengguna.destroy');
});

// ===================== API REGIONS (guest-friendly) =====================
Route::get('/api/regions/provinces', [RegionController::class, 'provinces'])->name('regions.provinces');
Route::get('/api/regions/cities', [RegionController::class, 'cities'])->name('regions.cities');
Route::get('/api/regions/districts', [RegionController::class, 'districts'])->name('regions.districts');
Route::get('/api/regions/villages', [RegionController::class, 'villages'])->name('regions.villages');
