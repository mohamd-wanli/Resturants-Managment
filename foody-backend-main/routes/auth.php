<?php

use App\Http\Controllers\AuthController;
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

Route::post('/loginRestaurant', [AuthController::class, 'loginRestaurant']);
Route::post('/loginEmployee', [AuthController::class, 'loginEmployee']);
Route::post('/loginAdmin', [AuthController::class, 'loginAdmin']);
