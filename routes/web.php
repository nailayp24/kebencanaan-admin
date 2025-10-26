<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KejadianBencanaController;
use App\Http\Controllers\PoskoBencanaController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

//login register
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

//dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

//data
Route::resource('warga', WargaController::class);
Route::resource('kejadian-bencana', KejadianBencanaController::class);
Route::resource('posko-bencana', PoskoBencanaController::class);
Route::resource('user', UserController::class);
