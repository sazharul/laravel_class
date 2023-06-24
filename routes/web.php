<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();


Route::get('/user-profile', [HomeController::class, 'user_profile'])->name('user_profile');
Route::get('/', [HomeController::class, 'index']);
Route::post('/profile/create', [ProfileController::class, 'store'])->name('profile_create');
Route::get('/asdf', [HomeController::class, 'index']);


Route::get('/home', [HomeController::class, 'index'])->name('home');






Route::middleware(['auth', 'custom'])->prefix('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile']);

    Route::resource('/category', CategoryController::class);
    Route::resource('/brand', BrandController::class);
    Route::resource('/unit', UnitController::class);
    Route::resource('/product', ProductController::class);

    Route::get('/', [ProductController::class, 'index']);
    Route::get('/cart', [ProductController::class, 'cart'])->name('cart');
    Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
    Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
    Route::patch('/update-cart', [ProductController::class, 'update_cart'])->name('update.cart');
    Route::delete('/remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');

});

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
