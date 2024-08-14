<?php

use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use Doctrine\DBAL\Schema\Index;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//rutas para hotel
Route::resource('hotel', HotelController::class)->only(['index','store','show']);
//ruta para asignar habitación
Route::post('room', [RoomController::class,'store'])->name('room.store');
//ruta para consultar asignaciones
Route::get('room/{id}', [RoomController::class,'index'])->name('room.index');
//rutas para ciudad
Route::resource('cities', CityController::class)->only(['index']);
//rutas de acomodacion
Route::resource('accommodation', AccommodationController::class)->only(['index']);
//rutas de tipo de habitación
Route::resource('room-type', RoomTypeController::class)->only(['index']);