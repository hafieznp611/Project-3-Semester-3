<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegistrationController;

Route::resource('activities', ActivityController::class);

Route::patch('/activities/{activity}/restore', [ActivityController::class, 'restore'])
    ->name('activities.restore')
    ->withTrashed();
    
Route::get('/activities-trash', [ActivityController::class, 'trash'])
    ->name('activities.trash');

Route::resource('categories', CategoryController::class);

Route::post('/activities/{activity}/registrations', [RegistrationController::class, 'store'])
    ->name('activities.registrations.store');