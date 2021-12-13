<?php

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

Route::get('/', function () {
    return view('layouts.default', ["title" => "Homepage", "content" => "HomePage"]);
})->name('home');

Route::get('/login', function () {
    return view('layouts.default', ["title" => "Login", "content" => "Logging"]);
})->name('login');

Route::get('/register', function () {
    return view('layouts.default', ["title" => "Create account", "content" => "Registration"]);
})->name('register');

Route::get('/products', function () {
    return view('layouts.default', ["title" => "Products", "content" => "Products"]);
})->name('products');
