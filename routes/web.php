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

Route::prefix('register')->group(function () {
    Route::get('/', [RegisterController::class, 'getRegister'])->name('register');
    Route::post('/', [RegisterController::class, 'postRegister']);
});

Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'getLogin'])->name('login');
    Route::post('/', [LoginController::class, 'postLogin']);
});

Route::post('/logout', [LogoutController::class, 'postLogout'])->name('logout');

Route::prefix('account')->group(function () {
    Route::get('details', [AccountController::class, 'getAccountDetails'])->name('account.details');
    Route::get('edit', [AccountController::class, 'getAccountEdit'])->name('account.edit');
    Route::post('edit', [AccountController::class, 'postAccountEdit']);
    Route::post('delete', [AccountController::class, 'postAccountDelete'])->name('account.delete');
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'getProducts'])->name('products');
    Route::get('filtered', [ProductController::class, 'getProductsFiltered'])->name('products.filtered');
    Route::get('{id}', [ProductController::class, 'getProductDetails'])->name('product.details');
});

Route::prefix('basket')->group(function () {
    Route::get('/', [BasketController::class, 'getBasket'])->name('basket');
    Route::post('add', [BasketController::class, 'postAddItem'])->name('basket.add_item');
    Route::patch('update', [BasketController::class, 'patchUpdateItem'])->name('basket.update_item');
    Route::post('delete', [BasketController::class, 'postRemoveItem'])->name('basket.remove_item');
    Route::post('destroy', [BasketController::class, 'postDestroyBasket'])->name('basket.destroy');
});

Route::prefix('order')->group(function () {
    Route::get('checkout', [OrderController::class, 'getCheckout'])->name('order.checkout');
    Route::post('checkout', [OrderController::class, 'postCheckout']);
    Route::get('history', [OrderController::class, 'getHistory'])->name('order.history');
    Route::post('delete', [OrderController::class, 'postDelete'])->name('order.delete');
});

Route::fallback(function () {
    return abort(404);
});
