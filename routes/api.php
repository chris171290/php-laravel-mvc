<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::post("/create", [AuthController::class, "createUser"])->name('user.create');
Route::post('/login', [AuthController::class, 'loginUser'])->name('user.login');

Route::middleware('auth:sanctum')->prefix('/v1')->group(function () {
    Route::apiResource('/user', UserController::class);
    Route::apiResource('/category', CategoryController::class);
    Route::apiResource('/product', ProductController::class);
});