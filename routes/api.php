<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CriptomonedaController;
use App\Http\Controllers\Api\V1\MonedaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    // Authentication routes
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');

    // Register route
    Route::post('/register', 'register');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('monedas', MonedaController::class);

    Route::apiResource('criptomonedas', CriptomonedaController::class);
});
