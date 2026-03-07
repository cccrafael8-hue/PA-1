<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('login');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::view('/welcome', 'welcome')->name('welcome');
    Route::view('/menu', 'menu')->name('menu');
    Route::view('/gallery', 'gallery')->name('gallery');
    Route::view('/reservasi', 'reservasi')->name('reservasi');
    Route::view('/kontak', 'kontak')->name('kontak');
    Route::view('/order', 'order')->name('order');

    Route::post('/reservasi/store', [ReservasiController::class, 'store'])
        ->name('reservasi.store');
});

/*
|--------------------------------------------------------------------------
| ADMIN (WAJIB LOGIN + ROLE ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard Admin (PAKAI CONTROLLER)
    Route::get('/admin', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Data Reservasi
    Route::get('/admin/reservasi', [ReservasiController::class, 'index'])
        ->name('admin.reservasi');

    Route::get('/admin/reservasi/{id}/paid', [ReservasiController::class, 'updateStatus'])
        ->name('admin.reservasi.paid');

    Route::delete('/admin/reservasi/{id}', [ReservasiController::class, 'destroy'])
        ->name('admin.reservasi.destroy');
});