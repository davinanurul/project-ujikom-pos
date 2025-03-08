<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PenerimaanBarangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukVarianController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //Route User
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user', [UserController::class, 'store'])->name('user.store');
    Route::get('/nonaktifkan-akun/{userId}', [UserController::class, 'nonaktifkanAkun'])->name('user.nonaktifkan');
    Route::get('/aktifkan-akun/{userId}', [UserController::class, 'aktifkanAkun'])->name('user.aktifkan');

    // Route Member
    Route::get('member', [MemberController::class, 'index'])->name('member.index');
    Route::get('member/create', [MemberController::class, 'create'])->name('member.create');
    Route::post('member', [MemberController::class, 'store'])->name('member.store');
    Route::get('/member/{id}/edit', [MemberController::class, 'edit'])->name('member.edit');
    Route::put('/member/{id}', [MemberController::class, 'update'])->name('member.update');
    Route::get('/nonaktifkan-member/{memberId}', [MemberController::class, 'nonaktifkanAkun'])->name('member.nonaktifkan');
    Route::get('/aktifkan-member/{memberId}', [MemberController::class, 'aktifkanAkun'])->name('member.aktifkan');


    // Route Kategori
    Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::put('kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');

    // Route Supplier
    Route::get('supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('supplier/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');

    // Route Produk
    Route::get('produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('produk/{id}', [ProdukController::class, 'update'])->name('produk.update');

    // Route Produk Varian
    Route::get('produk_varian', [ProdukVarianController::class, 'index'])->name('produk_varian.index');
    Route::get('produk_varian/create', [ProdukVarianController::class, 'create'])->name('produk_varian.create');
    Route::post('produk_varian/store', [ProdukVarianController::class, 'store'])->name('produk_varian.store');

    // Route Penerimaan Barang
    Route::get('penerimaan_barang', [PenerimaanBarangController::class, 'index'])->name('penerimaan_barang.index');
    Route::get('penerimaan_barang/create', [PenerimaanBarangController::class, 'create'])->name('penerimaan_barang.create');
    Route::get('/penerimaan-barang/get-produk/{supplierId}', [PenerimaanBarangController::class, 'getProdukBySupplier']);
    Route::get('/penerimaan-barang/get-varian/{produkId}', [PenerimaanBarangController::class, 'getVarianByProduk']);
    Route::post('/penerimaan-barang/store', [PenerimaanBarangController::class, 'store'])->name('penerimaan_barang.store');

    // Route Transaksi
    Route::get('transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/get-varians/{produkId}', [TransaksiController::class, 'getVariansByProduk']);
    Route::get('/get-sizes/{produkId}/{warna}', [TransaksiController::class, 'getSizesByWarna']);
    Route::get('/get-harga/{produkId}/{warna}/{size}', [TransaksiController::class, 'getHarga']);
    Route::get('/get-varian/{produk_id}/{warna}/{size}', [TransaksiController::class, 'getVarian']);
});

// Route untuk Login
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
