<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/logout', function () {
    return abort(404);
});

Route::get('/account', [AccountController::class, 'accountDetails'])->name('account.details');
Route::get('/account/edit', [AccountController::class, 'accountEdit'])->name('account.edit');
Route::post('/account/edit', [AccountController::class, 'editAccount'])->name('account.edit');
Route::post('/account/delete', [AccountController::class, 'deleteAccount'])->name('account.delete');


Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::get('/products/filtered', [ProductController::class, 'productsFiltered'])->name('products.filtered');
Route::get('/product/{id}', [ProductController::class, 'productDetails'])->name('product.details');

Route::get('/basket', [BasketController::class, 'index'])->name('basket');
Route::post('/basket/add', [BasketController::class, 'add'])->name('basket.add');
Route::patch('/basket/update', [BasketController::class, 'update'])->name('basket.update');
Route::post('/basket/delete', [BasketController::class, 'delete'])->name('basket.delete');

Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/order-history', [OrderController::class, 'history'])->name('order.history');
Route::post('/order/delete', [OrderController::class, 'deleteOrder'])->name('order.delete');
