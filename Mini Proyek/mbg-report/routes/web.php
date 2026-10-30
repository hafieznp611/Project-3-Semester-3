<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReportController;

Route::get('/', fn () => redirect()->route('login'));

Route::get('login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.proses');



Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('can:report')->group(function () {
        Route::resource('reports', ReportController::class)->except('destroy');
        Route::get('/reports/{id}', [ReportController::class, 'show'])->name('reports.show');
    });
});

Route::middleware('can:manage-distribution')->group(function () {
    Route::resource('distributions', DistributionController::class);
});