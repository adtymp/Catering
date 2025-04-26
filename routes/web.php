<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [LoginController::class, 'regis'])->name('register');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/product', function () {
    return view('productroom');
})->name('productroom');

Route::post('/product/add', [CategoryController::class, 'addCategory'])->name('addCategory');

Route::get('/product', [CategoryController::class, 'viewCategory'])->name('viewCategory');

Route::get('/cart', function(){
    return view('cartroom');
})->name('cart');

