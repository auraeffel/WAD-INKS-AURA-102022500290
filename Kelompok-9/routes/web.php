<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanPembersihController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\MesinController;
use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;

// Halaman utama: arahkan sesuai status login
Route::get('/', fn () => redirect()->route(auth()->check() ? 'pelanggan.index' : 'login'));

// Hanya untuk yang BELUM login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Hanya untuk yang SUDAH login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('layanan', LayananController::class)->except(['show']);
    Route::resource('mesin', MesinController::class)->except(['show']);
    Route::resource('pelanggan', PelangganController::class)->except(['show']);
    Route::resource('bahan-pembersih', BahanPembersihController::class)->except(['show']);
    Route::get('/bahan', [BahanPembersihController::class, 'index']);
});
