<?php

use App\Http\Controllers\Api\AirportCrudController;
use App\Http\Controllers\Api\AirportsApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);

Route::get('/search', [AirportsApiController::class, 'search']);
Route::get('/nearest-airports', [AirportsApiController::class, 'searchNearestAirports']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('airports', AirportCrudController::class);
});
