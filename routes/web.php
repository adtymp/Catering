<?php

use App\Http\Controllers\AboutContoller;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminDashController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UlasanController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\LoggedIn;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

use function Laravel\Prompts\search;

Route::get('/', [DashboardController::class, 'index'])->name('welcome');

Route::get('/search', [DashboardController::class, 'filterSearch'])->name('filterSearch');

Route::post('/register', [LoginController::class, 'regis'])->name('register');

Route::get('/detailProduct/{slug}', [DashboardController::class, 'detailProduct'])->name('detailproduct');

Route::get('/products/category/{name}', [ProductController::class, 'showByCategory'])->name('products.category');

Route::get('/products/under/{price}', [ProductController::class, 'showByPrice'])->name('products.under');

Route::get('/about', [AboutContoller::class, 'index'])->name('about');

Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan');

Route::get('/carapesan', [UlasanController::class, 'index'])->name('carapesan');

Route::middleware(LoggedIn::class)->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('role:customer');

    Route::get('/address', [AddressController::class, 'index'])->name('address')->middleware('role:customer');

    Route::post('/address/addAddress', [AddressController::class, 'addAddress'])->name('addAddress')->middleware('role:customer');

    Route::post('/profile/deleteAddress/{id}', [AddressController::class, 'deleteAddress'])->name('address.deleteAddress')->middleware('role:customer');

    Route::post('/detailProduct/addCart', [CartController::class, 'addCart'])->name('addCart')->middleware('role:customer');

    Route::get('/order', [OrderController::class, 'index'])->name('order')->middleware('role:customer');

    Route::get('/payment', [PaymentController::class, 'index'])->name('payment')->middleware('role:customer');

    Route::get('/payment/checkout', [PaymentController::class, 'checkOut'])->name('payment.checkout')->middleware('role:customer');

    Route::post('/payment/request', [PaymentController::class, 'pembayaran'])->name('payment.request')->middleware('role:customer');

    Route::get('/cart', [CartController::class, 'index'])->name('cart')->middleware('role:customer');

    Route::post('/cart/delete/{id}', [CartController::class, 'deleteCart'])->name('cart.delete')->middleware('role:customer');

    Route::get('/detailpesanan/{idPesanan}', [OrderController::class, 'detailPesanan'])->name('detailpesanan')->middleware('role:customer');
});

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login/proses', [LoginController::class, 'login'])->name('admin.login.process');
});

Route::middleware(LoggedIn::class)->prefix('admin')->group(function () {
    Route::get('/admindashboard', [AdminDashController::class, 'index'])->name('admindashboard')->middleware('role:admin');

    Route::get('/product', [ProductController::class, 'index'])->name('productroom')->middleware('role:admin');

    //Category
    Route::post('/product/addCategory', [CategoryController::class, 'addCategory'])->name('productroom.category.add')->middleware('role:admin');

    Route::post('/product/editCategory/{id}', [CategoryController::class, 'editCategory'])->name('productroom.category.edit')->middleware('role:admin');

    Route::post('/product/updateCategory/{id}', [CategoryController::class, 'updateCategory'])->name('productroom.category.update')->middleware('role:admin');

    Route::post('/product/deleteCategory/{id}', [CategoryController::class, 'deleteCategory'])->name('productroom.category.delete')->middleware('role:admin');

    //Banner
    Route::post('/product/addBanner', [BannerController::class, 'addPost'])->name('productroom.banner.add')->middleware('role:admin');

    Route::get('/product/editBanner/{id}', [BannerController::class, 'editPost'])->name('productroom.banner.edit')->middleware('role:admin');

    Route::post('/product/upateBanner/{id}', [BannerController::class, 'updatePost'])->name('productroom.banner.update')->middleware('role:admin');

    Route::post('/product/deleteBanner/{id}', [BannerController::class, 'deletePost'])->name('productroom.banner.delete')->middleware('role:admin');

    //Product
    Route::post('/product/addProduct', [ProductController::class, 'addProduct'])->name('productroom.product.add')->middleware('role:admin');

    Route::get('/product/searchProduct', [ProductController::class, 'searchProduct'])->name('productroom.product.search')->middleware('role:admin');

    Route::post('/product/editProduct/{id}', [ProductController::class, 'editProduct'])->name('productroom.product.edit')->middleware('role:admin');

    Route::post('/product/updateProduct/{id}', [ProductController::class, 'updateProduct'])->name('productroom.product.update')->middleware('role:admin');

    Route::post('/product/deleteProduct/{id}', [ProductController::class, 'deleteProduct'])->name('productroom.product.delete')->middleware('role:admin');

    //Payment
    Route::get('/orderAdmin', [OrderController::class, 'indexAdmin'])->name('orderAdmin')->middleware('role:admin');

    Route::get('/orderAdmin/{idPesanan}', [OrderController::class, 'adminDetailPesanan'])->name('adminDetailPesanan')->middleware('role:admin');

    Route::post('/orderAdmin/update/{id}/{status}', [OrderController::class, 'update'])->name('adminDetailPesanan.update')->middleware('role:admin');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
