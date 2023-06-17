<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SendEmailController;
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


Route::get('/', [HomeController::class, 'index']);
Route::post('/profile/create', [ProfileController::class, 'store'])->name('profile_create');
Route::get('/asdf', [HomeController::class, 'index']);
Route::get('send-email', [SendEmailController::class, 'index']);

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile']);

    Route::resource('/category', CategoryController::class);
    Route::resource('/brand', BrandController::class);
    Route::resource('/unit', UnitController::class);
    Route::resource('/product', ProductController::class);

});
