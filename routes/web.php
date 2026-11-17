<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses')->middleware('throttle:5,1');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.proses')->middleware('throttle:5,1');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', fn () => redirect()->route('dashboard'));
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::middleware('role:admin,staff')->group(function () {
        Route::resource('pelanggan', PelangganController::class)->except('show');
    });
});