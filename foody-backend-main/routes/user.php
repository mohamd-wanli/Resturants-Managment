<?php

use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('user')->group(function () {

    Route::post('/makeOrder', [OrderController::class, 'makeOrder']);
    Route::get('/product', [ProductController::class, 'getProduct']);
    Route::get('/category', [CategoryController::class, 'getCategory']);

});
