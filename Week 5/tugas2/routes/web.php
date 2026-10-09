<?php
use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KeranjangController::class, 'index'])->name('index');
Route::get('/keranjang', [KeranjangController::class, 'keranjang'])->name('keranjang');
Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
Route::post('/keranjang/ubah/{id}', [KeranjangController::class, 'ubah'])->name('keranjang.ubah');
Route::post('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
Route::post('/keranjang/kosongkan', [KeranjangController::class, 'kosongkan'])->name('keranjang.kosongkan');