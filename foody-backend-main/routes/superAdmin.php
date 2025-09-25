<?php

use App\Http\Controllers\SuperAdmin\BranchController;
use App\Http\Controllers\SuperAdmin\RestaurantController;
use App\Http\Controllers\SuperAdmin\StatisticsController;
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

Route::middleware(['auth:sanctum', 'abilities:'.UserStatus::SUPER_ADMIN])->prefix('superAdmin')->group(function () {
    Route::apiResource('restaurant', RestaurantController::class);
    Route::apiResource('branch', BranchController::class);
    Route::get('RestaurantWithCountBranch', [StatisticsController::class, 'RestaurantWithCountBranch']);

});
