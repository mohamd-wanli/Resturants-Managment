<?php

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\TableController;
use App\Statuses\UserStatus;
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

Route::middleware(['auth:sanctum', 'abilities:'.UserStatus::ADMIN])->prefix('Admin')->group(function () {
    Route::apiResource('category', CategoryController::class);
    Route::put('/activecategory/{id}', [CategoryController::class, 'active']);
    Route::get('/order', [OrderController::class, 'getOrders']);
    Route::apiResource('table', TableController::class);
    Route::put('/activetable/{id}', [TableController::class, 'active']);
    Route::apiResource('Employee', EmployeeController::class);
    Route::put('/activeemp/{id}', [EmployeeController::class, 'active']);
    Route::apiResource('product', ProductController::class)->except('update');
    Route::post('/product/{product}', [ProductController::class, 'update']);
    Route::get('/branch', [BranchController::class, 'index']);
    Route::get('/CompareFoodsByRequest', [StatisticController::class, 'CompareFoodsByRequest']);
    Route::get('/CompareDaysByRequest', [StatisticController::class, 'CompareDaysByRequest']);
    Route::get('/CompareWaitersByAverageOrder', [StatisticController::class, 'CompareWaitersByAverageOrder']);
    Route::get('/CompareHourByDate', [StatisticController::class, 'CompareHourByDate']);

});
