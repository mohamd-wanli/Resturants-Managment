<?php

use App\Http\Controllers\Kitchen\OrderController;
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

Route::middleware(['auth:sanctum', 'abilities:'.UserStatus::CHEF])->prefix('chef')->group(function () {
    Route::get('getOrder', [OrderController::class, 'getOrder']);
    Route::put('changeStatusForStartPreparing', [OrderController::class, 'changeStatusForStartPreparing']);
    Route::put('changeStatusForEndPreparing', [OrderController::class, 'changeStatusForEndPreparing']);

});
