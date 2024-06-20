<?php

use App\Http\Controllers\FlightReservationController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginController::class, 'authenticate']);

Route::apiResource('flights.flight-reservations', FlightReservationController::class)
    ->only(['store', 'destroy'])
    ->parameters(['flight-reservations' => 'reservation'])
    ->shallow()

    ->middleware('auth:sanctum');
