<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CauseController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\UserController;

Route::middleware(['auth', 'role:Super Admin|Admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('causes', CauseController::class);
    Route::resource('donations', DonationController::class)->only(['index', 'export']);
    Route::resource('users', UserController::class);
});

Route::middleware(['auth', 'role:Super Admin|Admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/admin/causes/{cause}/edit', [CauseController::class, 'edit'])->name('causes.edit');
