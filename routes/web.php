<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AdminReservasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\AdminGalleryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Controllers\HistoryController;

/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('welcome');
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
| HALAMAN PUBLIK (TANPA LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/welcome', [AuthController::class, 'welcome'])->name('welcome');

Route::view('/kontak', 'kontak')->name('kontak');

/*
|--------------------------------------------------------------------------
| USER (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::view('/reservasi', 'reservasi')->name('reservasi');

    Route::post('/reservasi/store', [ReservasiController::class, 'store'])
        ->name('reservasi.store');

    /* --- KRITIK USER (BAGIAN YANG DIUBAH) --- */
    Route::get('/kritik', [ReviewController::class, 'index'])->name('kritik.index');
    Route::post('/kritik', [ReviewController::class, 'store'])->name('kritik.store');
    Route::delete('/kritik/{id}', [ReviewController::class, 'destroy'])->name('kritik.destroy');
});

/*
|--------------------------------------------------------------------------
| MENU USER
|--------------------------------------------------------------------------
*/
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

/*
|--------------------------------------------------------------------------
| CART / KERANJANG
|--------------------------------------------------------------------------
*/
Route::prefix('cart')->middleware(['auth'])->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
});

Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| ORDER
|--------------------------------------------------------------------------
*/
Route::post('/order', [OrderController::class,'store'])->name('order.store')->middleware('auth');

/*
|--------------------------------------------------------------------------
| KONTAK
|--------------------------------------------------------------------------
*/
Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

/*
|--------------------------------------------------------------------------
| GALLERY USER
|--------------------------------------------------------------------------
*/
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

/*
|--------------------------------------------------------------------------
| ADMIN (WAJIB LOGIN + ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function(){

    /*
    |------------------------------------------
    | Dashboard
    |------------------------------------------
    */
    Route::get('/', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    //export data penjualan ke excel
    Route::get('/export', [AdminController::class, 'export'])
        ->name('admin.export');

    /*
    |------------------------------------------
    | Reservasi
    |------------------------------------------
    */
    Route::get('/reservasi', [AdminReservasiController::class, 'index'])
        ->name('admin.reservasi');

    Route::get('/reservasi/{id}/paid', [AdminReservasiController::class, 'updateStatus'])
        ->name('admin.reservasi.paid');

    Route::delete('/reservasi/{id}', [AdminReservasiController::class, 'destroy'])
        ->name('admin.reservasi.destroy');

    /*
    |------------------------------------------
    | Menu Admin
    |------------------------------------------
    */
    Route::get('/menu', [AdminMenuController::class,'index'])
        ->name('admin.menu');

    Route::get('/menu/create', [AdminMenuController::class,'create'])
        ->name('admin.menu.create');

    Route::post('/menu/store', [AdminMenuController::class,'store'])
        ->name('admin.menu.store');

    Route::get('/menu/{id}/edit', [AdminMenuController::class,'edit'])
        ->name('admin.menu.edit');

    Route::put('/menu/{id}', [AdminMenuController::class,'update'])
        ->name('admin.menu.update');

    Route::delete('/menu/{id}', [AdminMenuController::class,'destroy'])
        ->name('admin.menu.delete');

    /*
    |------------------------------------------
    | Order Admin
    |------------------------------------------
    */
    Route::get('/order_admin', [AdminOrderController::class, 'index'])
        ->name('admin.order_admin');

    Route::put('/order/{id}/status', [AdminOrderController::class, 'updateStatus'])
        ->name('admin.order.status');

    Route::delete('/order/{id}', [AdminOrderController::class, 'destroy'])
        ->name('admin.order.delete');


    /*
    |------------------------------------------
    | Kontak Admin
    |------------------------------------------
    */
    Route::get('/kontak', [AdminContactController::class, 'index'])
        ->name('admin.kontak');

    Route::delete('/kontak/{id}', [AdminContactController::class, 'destroy'])
        ->name('admin.kontak.delete');

    /*
    |------------------------------------------
    | Gallery Admin
    |------------------------------------------
    */
    Route::get('/gallery_admin', [AdminGalleryController::class, 'index'])
        ->name('gallery_admin');

    Route::post('/gallery_admin', [AdminGalleryController::class, 'store'])
        ->name('gallery_admin.store');

    Route::put('/gallery_admin/{id}', [AdminGalleryController::class, 'update'])
        ->name('gallery_admin.update');

    Route::delete('/gallery_admin/{id}', [AdminGalleryController::class, 'destroy'])
        ->name('gallery_admin.delete');

    /*
    |------------------------------------------
    | Kritik & Saran Admin
    |------------------------------------------
    */
    Route::get('/reviews', [AdminReviewController::class, 'index'])
        ->name('admin.reviews');
        
    Route::post('/reviews/{id}/reply', [AdminReviewController::class, 'reply'])
        ->name('admin.reviews.reply');

    Route::delete('/reviews/{id}/reply', [AdminReviewController::class, 'deleteReply'])
        ->name('admin.reviews.reply.delete');

    Route::delete('/reviews/{id}', [AdminReviewController::class, 'destroy'])
        ->name('admin.reviews.delete');

});

//History
Route::get('/history', [HistoryController::class, 'index'])->name('history')->middleware('auth');