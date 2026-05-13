<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;

Route::get('/', function () {
    return view('welcome');
});


// LOGIN
Route::get('/login', [LoginController::class, 'index'])
    ->name('login.index');

Route::post('/login', [LoginController::class, 'proses'])
    ->name('login.proses');

// LOGOUT
Route::get('/logout', [LogoutController::class, 'index'])
    ->name('logout.index');

// DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard.index');


// CRUD BARANG
// Tampilkan halaman barang
Route::get('/dashboard/barang', [BarangController::class, 'index'])
    ->name('barang.index');

// Simpan barang
Route::post('/dashboard/barang/store', [BarangController::class, 'store'])
    ->name('barang.store');

// Update barang
Route::put('/dashboard/barang/update/{id}', [BarangController::class, 'update'])
    ->name('barang.update');

// Hapus barang
Route::delete('/dashboard/barang/delete/{id}', [BarangController::class, 'destroy'])
    ->name('barang.destroy');


// RESET
Route::get('/dashboard/reset', [DashboardController::class, 'reset'])
    ->name('dashboard.reset');