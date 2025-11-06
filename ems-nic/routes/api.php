<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\WeatherController;

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login'])->name('login');;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/locations', [LocationController::class, 'index']);
    Route::get('/locations/{id}', [LocationController::class, 'show']);
    Route::post('/locations', [LocationController::class, 'store']);
    Route::put('/locations/{id}', [LocationController::class, 'update']);
    Route::delete('/locations/{id}', [LocationController::class, 'destroy']);
    Route::get('/locations-search', [LocationController::class, 'search']);



    Route::get('/weather', [WeatherController::class, 'index']);
    Route::get('/weather/{location_id}', [WeatherController::class, 'show']);




    Route::post('/logout', [AuthController::class, 'logout']);
});
