<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tokens/create', [\App\Http\Controllers\Api\AuthController::class, 'token']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [\App\Http\Controllers\Api\UserController::class, 'me']);
    Route::get('/rewards', [\App\Http\Controllers\Api\UserController::class, 'rewards']);
    Route::post('/redeem/{reward}', [\App\Http\Controllers\Api\UserController::class, 'redeem']);

    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});
