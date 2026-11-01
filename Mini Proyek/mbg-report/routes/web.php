<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SppgController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RecapController;



Route::get('/', fn () => redirect()->route('login'));

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.proses');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.proses');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('can:report')->group(function () {
        Route::resource('reports', ReportController::class)->except(['index', 'show', 'destroy']);
    });

    Route::middleware('can:reviewing')->group(function () {
        Route::get('rekap', [RecapController::class, 'index'])->name('rekap.index');
        Route::get('reviews/{report}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
        Route::put('reviews/{report}', [ReviewController::class, 'update'])->name('reviews.update');});

        Route::get('reports/{report}', [ReportController::class, 'show'])
        ->whereNumber('report')
        ->name('reports.show');

        Route::middleware('can:manage-master')->group(function () {
        Route::resource('schools', SchoolController::class)->except(['show', 'destroy']);
        Route::resource('sppgs', SppgController::class)->except(['show', 'destroy']);

        Route::prefix('admin/users')->name('admin.users.')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::patch('{user}/role', [RoleController::class, 'update'])
                ->whereNumber('user')
                ->name('role.update');
        });
    });
});