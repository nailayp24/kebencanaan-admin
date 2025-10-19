<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PoskoController;
use App\Http\Controllers\KejadianController;

// Redirect halaman utama ke dashboard
Route::redirect('/', '/dashboard');

// =========================
// Dashboard
// =========================
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// =========================
// Autentikasi
// =========================
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login.index');
    Route::post('/login', [AuthController::class, 'login'])->name('login.handle');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// =========================
// Data Kebencanaan
// =========================
Route::resource('kejadian', KejadianController::class);

// =========================
// CRUD Kejadian & Posko
// =========================
Route::resource('posko', PoskoController::class);
