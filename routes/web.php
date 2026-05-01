<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\OrderAdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminGalleryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\HistoryController;

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

    Route::get('/welcome', function () {
        $latestGallery = \App\Models\Gallery::latest()->first();

        // Cari menu paling populer dari Orders
        $orders = \App\Models\Order::all();
        $menuCounts = [];
        foreach($orders as $order) {
            $items = explode(', ', $order->menu);
            foreach($items as $item) {
                if(trim($item) == '') continue;
                $parts = explode(' x', $item);
                if(count($parts) == 2) {
                    $name = trim($parts[0]);
                    $qty = (int)$parts[1];
                    if(!isset($menuCounts[$name])) {
                        $menuCounts[$name] = 0;
                    }
                    $menuCounts[$name] += $qty;
                }
            }
        }
        
        $popularMenu = null;
        if(!empty($menuCounts)) {
            arsort($menuCounts);
            $popularName = array_key_first($menuCounts);
            $popularMenu = \App\Models\Menu::where('nama_menu', $popularName)->first();
        }

        // Kalau tidak ada order atau menu tidak ditemukan, tampilkan menu pertama
        if(!$popularMenu) {
            $popularMenu = \App\Models\Menu::first();
        }

        return view('welcome', compact('latestGallery', 'popularMenu'));
    })->name('welcome');
    Route::view('/reservasi', 'reservasi')->name('reservasi');
    Route::view('/kontak', 'kontak')->name('kontak');

    Route::post('/reservasi/store', [ReservasiController::class, 'store'])
        ->name('reservasi.store');

    /* --- KRITIK USER (BAGIAN YANG DIUBAH) --- */
    Route::get('/kritik', [ReviewController::class, 'index'])->name('kritik.index');
    Route::post('/kritik', [ReviewController::class, 'store'])->name('kritik.store');
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
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
});

Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

/*
|--------------------------------------------------------------------------
| ORDER
|--------------------------------------------------------------------------
*/
Route::post('/order', [OrderAdminController::class,'store'])->name('order.store');

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

    /*
    |------------------------------------------
    | Reservasi
    |------------------------------------------
    */
    Route::get('/reservasi', [ReservasiController::class, 'index'])
        ->name('admin.reservasi');

    Route::get('/reservasi/{id}/paid', [ReservasiController::class, 'updateStatus'])
        ->name('admin.reservasi.paid');

    Route::delete('/reservasi/{id}', [ReservasiController::class, 'destroy'])
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
    Route::get('/order_admin', [OrderAdminController::class, 'index'])
        ->name('admin.order_admin');

    Route::put('/order/{id}/status', [OrderAdminController::class, 'updateStatus'])
        ->name('admin.order.status');

    Route::delete('/order/{id}', [OrderAdminController::class, 'destroy'])
        ->name('admin.order.delete');


    /*
    |------------------------------------------
    | Kontak Admin
    |------------------------------------------
    */
    Route::get('/kontak', [ContactController::class, 'index'])
        ->name('admin.kontak');

    Route::delete('/kontak/{id}', [ContactController::class, 'destroy'])
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
    Route::get('/reviews', [ReviewController::class, 'adminIndex'])
        ->name('admin.reviews');
        
    Route::post('/reviews/{id}/reply', [ReviewController::class, 'reply'])
        ->name('admin.reviews.reply');

});

//History
Route::get('/history', [HistoryController::class, 'index'])->name('history')->middleware('auth');