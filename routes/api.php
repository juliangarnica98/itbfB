<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
//rutas para hotel
Route::resource('hotel', HotelController::class)->only(['index','store']);
//rutas para habitación
Route::resource('room', RoomController::class)->only(['index','store']);