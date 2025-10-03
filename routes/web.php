<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KebencanaanController;

Route::get('/', function () {
    return redirect('/kebencanaan'); // arahkan langsung ke halaman kebencanaan
});

Route::get('/kebencanaan', [KebencanaanController::class, 'index']);


Route::get('/auth', [AuthController::class, 'index']);       // menampilkan form login
Route::post('/auth/login', [AuthController::class, 'login']); // proses login
