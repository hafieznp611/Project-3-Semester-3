<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;

use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.proses');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/checkout', [OrderController::class, 'checkout'])->name('pesanan.checkout');
Route::get('/pesanan', [OrderController::class, 'index'])->name('pesanan.index');
Route::get('/pesanan/{id}', [OrderController::class, 'show'])->name('pesanan.show');

Route::middleware('auth')->group(function () {
    Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::post('/keranjang/ubah/{id}', [KeranjangController::class, 'ubah'])->name('keranjang.ubah');
    Route::get('/keranjang', [KeranjangController::class, 'tampilkan'])->name('keranjang.tampilkan');
});

Route::get('/admin/users', [RoleController::class, 'index'])
    ->middleware(['auth', 'can:manage-roles'])
    ->name('admin.users.index');

    Route::patch('/admin/users/{user}/role', [RoleController::class, 'update'])
    ->middleware(['auth', 'can:manage-roles'])
    ->name('admin.users.role.update');


