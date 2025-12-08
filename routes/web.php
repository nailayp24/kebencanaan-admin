<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KejadianBencanaController;
use App\Http\Controllers\PoskoBencanaController;
use App\Http\Controllers\DonasiBencanaController;
use App\Http\Controllers\ProfileController;

// ==================== PUBLIC ROUTES ====================

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login'); // GANTI 'auth.login' -> 'login'
});

// Auth Routes (bisa diakses tanpa login)
Route::controller(AuthController::class)->group(function () {

    Route::get('/login', 'index')->name('login'); // HAPUS 'auth.login'


    Route::post('/login', 'login')->name('login.submit');
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register')->name('register.submit');
    Route::post('/logout', 'logout')->name('logout');
});

// ==================== PROTECTED ROUTES (HARUS LOGIN) ====================
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes - DAPAT DIAKSES SEMUA USER
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::get('/photo/edit', [ProfileController::class, 'editPhoto'])->name('photo.edit');
        Route::put('/photo/update', [ProfileController::class, 'updatePhoto'])->name('photo.update');
        Route::delete('/photo/delete', [ProfileController::class, 'deletePhoto'])->name('photo.delete');
    });

    // Data Management
    Route::resource('warga', WargaController::class);
    Route::resource('kejadian-bencana', KejadianBencanaController::class);
    Route::resource('donasi-bencana', DonasiBencanaController::class);
    Route::resource('posko-bencana', PoskoBencanaController::class);

    // ========== SUPER ADMIN ONLY ROUTES ==========
    Route::middleware(['checkrole:super_admin'])->group(function () {

        // User Management
        Route::resource('user', UserController::class);

    });
});
