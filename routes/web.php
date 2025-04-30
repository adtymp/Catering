<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\LoggedIn;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

Route::post('/register', [LoginController::class, 'regis'])->name('register');

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login/proses', [LoginController::class, 'login'])->name('admin.login.process');
});

Route::middleware(LoggedIn::class)->prefix('admin')->group(function () {
    Route::get('/admindashboard', [DashboardController::class, 'index'])->name('admindashboard');

    Route::get('/product/view', [ProductController::class, 'index'])->name('productroom');

    Route::post('/product/add', [CategoryController::class, 'addCategory'])->name('productroom.add');

    Route::get('/product', [CategoryController::class, 'viewCategory'])->name('productroom.view');
});

Route::get('/cart', function () {
    return view('cartroom');
})->name('cart');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
