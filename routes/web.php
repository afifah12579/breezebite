<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| 1. Customer Interface Routes
|--------------------------------------------------------------------------
*/

// SEKARANG: Bila run localhost:8000, dia akan TERUS keluar Welcome Page/Pilih Meja
Route::get('/', function () { 
    return view('customer.welcome'); 
})->name('customer.welcome');

// Tukar '/welcome' yang lama tadi jadi '/menu' supaya tak bertindih
Route::get('/menu', [CustomerController::class, 'index'])->name('customer.menu');

Route::get('/dine-in/select', [CustomerController::class, 'showTableSelection'])->name('customer.dinein.select');
Route::get('/takeaway/details', [CustomerController::class, 'showTakeawayDetails'])->name('customer.takeaway.details');

Route::post('/select-table', [CustomerController::class, 'selectTable'])->name('customer.selectTable');

// Halaman Detail Item
Route::get('/menu/item/{id}', [CustomerController::class, 'showItem'])->name('customer.showItem');

// Pengurusan Troli (Cart)
Route::get('/cart', [CustomerController::class, 'cart'])->name('customer.cart');
Route::post('/cart/add/{id}', [CustomerController::class, 'addToCart'])->name('customer.cart.add');
Route::delete('/cart/remove/{id}', [CustomerController::class, 'removeFromCart'])->name('customer.cart.remove');

// Pengesahan & Proses Pesanan (Order)
Route::get('/cart/confirm', [CustomerController::class, 'confirmOrder'])->name('customer.order.confirm');
Route::post('/order/place', [CustomerController::class, 'placeOrder'])->name('customer.order.place');
Route::get('/order/success', [CustomerController::class, 'orderSuccess'])->name('customer.order.success');


/*
|--------------------------------------------------------------------------
| 2. Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');
// Pastikan ada route yang menerima parameter {status} seperti ini:
Route::get('/admin/orders/{status}', [AdminController::class, 'index'])->name('admin.orders.filter');



/*
|--------------------------------------------------------------------------
| 3. Protected Admin Dashboard Routes (Grouped)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Pengurusan Orders (Pesanan)
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders'); // Guna nama pendek sbb dah ada prefix 'admin.'
    Route::get('/orders/filter/{status}', [AdminController::class, 'orders'])->name('orders.filter');
    Route::get('/orders/{id}/edit', [AdminController::class, 'editOrderStatus'])->name('orders.edit');
    Route::put('/orders/{id}/update', [AdminController::class, 'updateOrderStatus'])->name('orders.update');
    Route::delete('/orders/{id}/delete', [AdminController::class, 'deleteOrder'])->name('orders.delete');
    
    // Pengurusan Menu Items (CRUD Makanan)
    Route::get('/menu-items', [AdminController::class, 'menuItems'])->name('menu.items');
    Route::get('/menu-items/create', [AdminController::class, 'createItem'])->name('menu.create');
    Route::post('/menu-items', [AdminController::class, 'storeItem'])->name('menu.store');
    Route::get('/menu-items/{id}/edit', [AdminController::class, 'editItem'])->name('menu.edit');
    Route::put('/menu-items/{id}', [AdminController::class, 'updateItem'])->name('menu.update');
    Route::delete('/menu-items/{id}', [AdminController::class, 'destroyItem'])->name('menu.destroy');

    
});