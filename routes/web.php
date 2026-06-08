<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

//Route::get('/', function () {
  //  return view('welcome');
//});

// --- Customer Interface Routes ---
Route::get('/', [CustomerController::class, 'index'])->name('customer.welcome');
Route::post('/select-table', [CustomerController::class, 'selectTable'])->name('customer.selectTable');
//Route::get('/menu', [CustomerController::class, 'menu'])->name('customer.menu');
Route::get('/menu', [App\Http\Controllers\CustomerController::class, 'menu'])->name('customer.menu');
Route::get('/item/{id}', [CustomerController::class, 'showItem'])->name('customer.item');
Route::post('/cart/add/{id}', [CustomerController::class, 'addToCart'])->name('customer.cart.add');
Route::get('/cart', [CustomerController::class, 'viewCart'])->name('customer.cart');
Route::post('/order/place', [CustomerController::class, 'placeOrder'])->name('customer.order.place');
Route::get('/order-success', [CustomerController::class, 'orderSuccess'])->name('customer.success');
// Route untuk memaparkan halaman butiran item/makanan yang diklik
Route::get('/menu/item/{id}', [CustomerController::class, 'showItem'])->name('customer.showItem');
Route::post('/cart/update/{id}', [\App\Http\Controllers\CustomerController::class, 'updateCart'])->name('customer.cart.update');
Route::delete('/cart/remove/{id}', [\App\Http\Controllers\CustomerController::class, 'removeFromCart'])->name('customer.cart.remove');

// --- Admin Authentication Routes (10 Marks) ---
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// --- Protected Admin Dashboard Routes (CRUD Operations) ---
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/orders/{id}/edit', [AdminController::class, 'editOrderStatus'])->name('orders.edit');
    Route::put('/orders/{id}/update', [AdminController::class, 'updateOrderStatus'])->name('orders.update');
    Route::get('/menu-items', [AdminController::class, 'menuItems'])->name('menu.items');
});
