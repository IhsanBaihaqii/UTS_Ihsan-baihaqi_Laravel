<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Fungsi Login
Route::get('/login', [LoginController::class, "index"])->name("login.index");
Route::post('/login', [LoginController::class, "proses"])->name("login.proses");

// Fungsi Logout
Route::get('/logout', [LogoutController::class, "index"])->name("logout.index");

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard.index');
Route::get('/dashboard/barang', [DashboardController::class, 'index']);
Route::post('/dashboard/barang', [DashboardController::class, 'aksi'])
    ->name('dashboard.barang.aksi');
Route::get('/dashboard/reset', [DashboardController::class, 'reset'])
    ->name('dashboard.reset');

Route::get('/barang', [BarangController::class, "index"])->name("barang.index");


