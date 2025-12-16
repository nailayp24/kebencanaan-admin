<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengembangController;
use App\Http\Controllers\PoskoBencanaController;
use App\Http\Controllers\DonasiBencanaController;
use App\Http\Controllers\KejadianBencanaController;
use App\Http\Controllers\LogistikBencanaController;
use App\Http\Controllers\DistribusiLogistikController;

// ==================== PUBLIC ROUTES ====================

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes (bisa diakses tanpa login)
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login.submit');
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register')->name('register.submit');
    Route::post('/logout', 'logout')->name('logout');
});

// ==================== PROTECTED ROUTES (HARUS LOGIN) ====================
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // PROFIL PENGEMBANG - SEMUA USER BISA LIHAT (HANYA INDEX)
    Route::get('/pengembang', [PengembangController::class, 'index'])->name('pengembang.index');

    // Data Management (untuk semua user)
    Route::resource('warga', WargaController::class);
    Route::resource('kejadian-bencana', KejadianBencanaController::class);
    Route::resource('donasi-bencana', DonasiBencanaController::class);
    Route::resource('posko-bencana', PoskoBencanaController::class);
    Route::resource('logistik-bencana', LogistikBencanaController::class);
    Route::resource('distribusi-logistik', DistribusiLogistikController::class);

    Route::get('logistik-bencana/{id}/stok-tersedia', [LogistikBencanaController::class, 'getStokTersedia'])
        ->name('logistik-bencana.stok-tersedia');

    // ========== SUPER ADMIN ONLY ROUTES ==========
    Route::middleware(['checkrole:super_admin'])->group(function () {

        // User Management (HANYA SUPER ADMIN)
        Route::resource('user', UserController::class);
Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');


        // Pengembang CRUD (HANYA SUPER ADMIN)
        Route::prefix('pengembang')->name('pengembang.')->group(function () {
            Route::get('/create', [PengembangController::class, 'create'])->name('create');
            Route::post('/', [PengembangController::class, 'store'])->name('store');
            Route::get('/{pengembang}/edit', [PengembangController::class, 'edit'])->name('edit');
            Route::put('/{pengembang}', [PengembangController::class, 'update'])->name('update');
            Route::delete('/{pengembang}', [PengembangController::class, 'destroy'])->name('destroy');
        });
    });
});
