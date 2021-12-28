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

Route::get('/', [HomeController::class, 'getHome'])->name('home');

Route::get('/register', [RegisterController::class, 'getRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'postRegister']);

Route::get('/login', [LoginController::class, 'getLogin'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin']);

Route::post('/logout', [LogoutController::class, 'postLogout'])->name('logout');
Route::get('/logout', function () {
    return abort(404);
});

Route::get('/account/details', [AccountController::class, 'getAccountDetails'])->name('account.details');
Route::get('/account/edit', [AccountController::class, 'getAccountEdit'])->name('account.edit');
Route::post('/account/edit', [AccountController::class, 'postAccountEdit'])->name('account.edit');
Route::post('/account/delete', [AccountController::class, 'postAccountDelete'])->name('account.delete');


Route::get('/products', [ProductController::class, 'getProducts'])->name('products');
Route::get('/products/filtered', [ProductController::class, 'getProductsFiltered'])->name('products.filtered');
Route::get('/products/{id}', [ProductController::class, 'getProductDetails'])->name('product.details');

Route::get('/basket', [BasketController::class, 'getBasket'])->name('basket');
Route::post('/basket/add', [BasketController::class, 'postAddItem'])->name('basket.add');
Route::patch('/basket/update', [BasketController::class, 'patchUpdateItem'])->name('basket.update.quantity');
Route::post('/basket/delete', [BasketController::class, 'postDeleteItem'])->name('basket.delete.item');
Route::post('/basket/destroy', [BasketController::class, 'postDestroyBasket'])->name('basket.destroy');

Route::get('/checkout', [OrderController::class, 'getCheckout'])->name('order.checkout');
Route::post('/checkout', [OrderController::class, 'postCheckout'])->name('order.place');
Route::get('/orders/history', [OrderController::class, 'getHistory'])->name('order.history');
Route::post('/orders/delete', [OrderController::class, 'postDelete'])->name('order.delete');
