<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KejadianBencanaController;
use App\Http\Controllers\PoskoBencanaController;
use App\Http\Controllers\UserController;

// Route utama - langsung ke login
Route::get('/', function () {
    return redirect('/login');
});

// Authentication Routes
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Dashboard & CRUD Routes
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('warga', WargaController::class);
Route::resource('kejadian-bencana', KejadianBencanaController::class);
Route::resource('posko-bencana', PoskoBencanaController::class);
Route::resource('user', UserController::class);
