<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductGalleryController;

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

// route dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::resource('products', ProductController::class)->middleware('auth');
Route::get('products/{id}/gallery', [ProductController::class, 'gallery'])->name('products.gallery');
Route::resource('product-galleries', ProductGalleryController::class)->middleware('auth');

Auth::routes(['register' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
