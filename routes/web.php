<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StaffController;
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

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth', 'role:admin-staff'])->group(function () {
    Route::resource('/product', ProductController::class);
    Route::resource('/customer', CustomerController::class);
    Route::get('/order', [OrderController::class, 'order_list']);
    Route::put('/order_update/{id}', [OrderController::class, 'order_update']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/staff', StaffController::class);
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::post('/order', [OrderController::class, 'order']);
    Route::get('/my-order', [OrderController::class, 'my_order']);
});

// Route::middleware(['auth', 'role:customer'])->group(function () {
//     Route::resource('/product', ProductController::class);
//     Route::resource('/customer', CustomerController::class);
// });