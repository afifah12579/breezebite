<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

//Route::get('/', function () {
  //  return view('welcome');
//});

// --- Customer Interface Routes ---
//Route::get('/', [CustomerController::class, 'index'])->name('customer.menu');
//Route::get('/menu', [CustomerController::class, 'index']);

//Route::post('/select-table', [CustomerController::class, 'selectTable'])->name('customer.selectTable');
//Route::get('/menu', [CustomerController::class, 'menu'])->name('customer.menu');
//Route::get('/menu', [App\Http\Controllers\CustomerController::class, 'menu'])->name('customer.menu');
//Route::get('/item/{id}', [CustomerController::class, 'showItem'])->name('customer.item');
//Route::post('/cart/add/{id}', [CustomerController::class, 'addToCart'])->name('customer.cart.add');
//Route::get('/cart', [CustomerController::class, 'viewCart'])->name('customer.cart');
//Route::post('/order/place', [CustomerController::class, 'placeOrder'])->name('customer.order.place');
//Route::get('/order-success', [CustomerController::class, 'orderSuccess'])->name('customer.success');
//
//  Route untuk memaparkan halaman butiran item/makanan yang diklik
//Route::get('/menu/item/{id}', [CustomerController::class, 'showItem'])->name('customer.showItem');
//Route::get('/cart', [CustomerController::class, 'cart'])->name('customer.cart');
//Route::post('/cart/add/{id}', [CustomerController::class, 'addToCart'])->name('customer.cart.add');
//Route::delete('/cart/remove/{id}', [CustomerController::class, 'removeFromCart'])->name('customer.cart.remove');
//Route::post('/order/place', [CustomerController::class, 'placeOrder'])->name('customer.order.place');
//Route::get('/order/success', [CustomerController::class, 'orderSuccess'])->name('customer.order.success');

//Route::get('/menu', [CustomerController::class, 'menu'])->name('customer.menu');
//Route::get('/menu/item/{id}', [CustomerController::class, 'showItem'])->name('customer.showItem');
//Route::get('/cart', [CustomerController::class, 'cart'])->name('customer.cart');
//Route::post('/cart/add/{id}', [CustomerController::class, 'addToCart'])->name('customer.cart.add');
//Route::delete('/cart/remove/{id}', [CustomerController::class, 'removeFromCart'])->name('customer.cart.remove');

// Route untuk hantar order dan paparan sukses
//Route::post('/order/place', [CustomerController::class, 'placeOrder'])->name('customer.order.place');
//Route::get('/order/success', [CustomerController::class, 'orderSuccess'])->name('customer.order.success');

// Tambah atau uncomment dua baris ini di dalam routes/web.php
Route::get('/welcome', function () { 
    return view('customer.welcome'); 
})->name('customer.welcome');

Route::post('/select-table', [CustomerController::class, 'selectTable'])->name('customer.selectTable');

//test code baru castomeer
// Halaman Utama & Menu Utama (Dua-dua panggil fungsi index)
Route::get('/', [CustomerController::class, 'index'])->name('customer.menu');
Route::get('/menu', [CustomerController::class, 'index']);

// Halaman Detail Item
Route::get('/menu/item/{id}', [CustomerController::class, 'showItem'])->name('customer.showItem');

// Pengurusan Troli (Cart)
Route::get('/cart', [CustomerController::class, 'cart'])->name('customer.cart');
Route::post('/cart/add/{id}', [CustomerController::class, 'addToCart'])->name('customer.cart.add');
Route::delete('/cart/remove/{id}', [CustomerController::class, 'removeFromCart'])->name('customer.cart.remove');

// Tambah route ini supaya pelanggan boleh pergi ke page pengesahan
Route::get('/cart/confirm', [CustomerController::class, 'confirmOrder'])->name('customer.order.confirm');

// Proses Pesanan (Order)
Route::post('/order/place', [CustomerController::class, 'placeOrder'])->name('customer.order.place');
Route::get('/order/success', [CustomerController::class, 'orderSuccess'])->name('customer.order.success');



// --- Admin Authentication Routes (10 Marks) ---
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// --- Protected Admin Dashboard Routes (CRUD Operations) ---
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Route asal untuk Orders
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/orders/{id}/edit', [AdminController::class, 'editOrderStatus'])->name('orders.edit');
    Route::put('/orders/{id}/update', [AdminController::class, 'updateOrderStatus'])->name('orders.update');
    // Pastikan ia adalah Route::post, BUKAN Route::get
Route::post('/order/place', [CustomerController::class, 'placeOrder'])->name('customer.order.place');
    
    // Route untuk Menu Items yang kita buat tadi
    Route::get('/menu-items', [AdminController::class, 'menuItems'])->name('menu.items');
    Route::get('/menu-items/create', [AdminController::class, 'createItem'])->name('menu.create');
    Route::post('/menu-items', [AdminController::class, 'storeItem'])->name('menu.store');
    
    // PASTIKAN BARIS INI ADA DI SINI DAN EJAANNYA BETUL:
    Route::delete('/menu-items/{id}', [AdminController::class, 'destroyItem'])->name('menu.destroy');
    
    // Route untuk Edit & Update
    Route::get('/menu-items/{id}/edit', [AdminController::class, 'editItem'])->name('menu.edit');
    Route::put('/menu-items/{id}', [AdminController::class, 'updateItem'])->name('menu.update');

    
    
});