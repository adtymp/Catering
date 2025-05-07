<?php

use App\Http\Controllers\AdminDashController;
use App\Http\Controllers\BannerController;
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

Route::get('/', [DashboardController::class, 'index'])->name('welcome');

Route::post('/register', [LoginController::class, 'regis'])->name('register');

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login/proses', [LoginController::class, 'login'])->name('admin.login.process');
});

Route::middleware(LoggedIn::class)->prefix('admin')->group(function () {
    Route::get('/admindashboard', [AdminDashController::class, 'index'])->name('admindashboard')->middleware('role:admin');

    Route::get('/product', [ProductController::class, 'index'])->name('productroom')->middleware('role:admin');

    Route::post('/product/addCategory', [CategoryController::class, 'addCategory'])->name('productroom.category.add')->middleware('role:admin');

    Route::post('/product/editCategory/{id}', [CategoryController::class, 'editCategory'])->name('productroom.category.edit')->middleware('role:admin');

    Route::post('/product/updateCategory/{id}', [CategoryController::class, 'updateCategory'])->name('productroom.category.update')->middleware('role:admin');

    Route::post('/product/deleteCategory/{id}', [CategoryController::class, 'deleteCategory'])->name('productroom.category.delete')->middleware('role:admin');

    Route::post('/product/addBanner', [BannerController::class, 'addPost'])->name('productroom.banner.add')->middleware('role:admin');

    Route::get('/product/editBanner/{id}', [BannerController::class, 'editPost'])->name('productroom.banner.edit')->middleware('role:admin');

    Route::post('/product/upateBanner/{id}', [BannerController::class, 'updatePost'])->name('productroom.banner.update')->middleware('role:admin');

    Route::post('/product/deleteBanner/{id}', [BannerController::class, 'deletePost'])->name('productroom.banner.delete')->middleware('role:admin');

    Route::post('/product/addProduct', [ProductController::class, 'addProduct'])->name('productroom.product.add')->middleware('role:admin');
});

Route::get('/cart', function () {
    return view('cartroom');
})->name('cart');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
