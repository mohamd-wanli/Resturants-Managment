<?php

use App\Http\Controllers\Waiter\OrderController;
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

Route::middleware(['auth:sanctum', 'abilities:'.UserStatus::WAITER])->prefix('waiter')->group(function () {
    Route::get('getOrder', [OrderController::class, 'getOrder']);
    Route::put('changeStatusForDelivery', [OrderController::class, 'changeStatusForDelivery']);

});
