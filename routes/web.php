<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\OrderAdminController;
use App\Http\Controllers\CartController;

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
    Route::view('/gallery', 'gallery')->name('gallery');
    Route::view('/reservasi', 'reservasi')->name('reservasi');
    Route::view('/kontak', 'kontak')->name('kontak');

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

//Menu 
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::middleware(['auth','admin'])->prefix('admin')->group(function(){

    Route::get('/menu',[AdminMenuController::class,'index'])->name('admin.menu');

    Route::get('/menu/create',[AdminMenuController::class,'create'])
        ->name('admin.menu.create');

    Route::post('/menu/store',[AdminMenuController::class,'store'])
        ->name('admin.menu.store');

});

//Order
Route::get('/admin/order_admin', [App\Http\Controllers\OrderAdminController::class, 'index'])->name('admin.order_admin');

Route::post('/order', [OrderAdminController::class,'store'])->name('order.store');

//Cart / Keranjang
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
});

//Data orderan ke admin
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');