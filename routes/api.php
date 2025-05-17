<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\CustomUserController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\API\ReservationController;
use App\Http\Controllers\API\PersonneController;
use App\Http\Controllers\API\ChambreController;
use App\Http\Controllers\API\TarifController;
use App\Http\Controllers\API\ChambreTarifController;
use App\Http\Controllers\API\ImageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/user', [AuthController::class, 'getUser']);
Route::post('logout', [AuthController::class, 'logout']);

// users
Route::prefix('users')->group(function () {
    Route::get('/', [CustomUserController::class, 'index']);
    Route::get('/{id}', [CustomUserController::class, 'show']);
    Route::post('/', [CustomUserController::class, 'store']);
    Route::put('/{id}', [CustomUserController::class, 'update']);
    Route::delete('/{id}', [CustomUserController::class, 'destroy']);
    Route::get('/type/{type}', [CustomUserController::class, 'getUsersByType']);
});

// Clients
Route::prefix('clients')->group(function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::get('/{id}', [ClientController::class, 'show']);
    Route::post('/', [ClientController::class, 'store']);
    Route::put('/{id}', [ClientController::class, 'update']);
    Route::delete('/{id}', [ClientController::class, 'destroy']);
});

//  Reservations
Route::prefix('reservations')->group(function () {
    Route::get('/', [ReservationController::class, 'index']);
    Route::get('/{id}', [ReservationController::class, 'show']);
    Route::post('/', [ReservationController::class, 'store']);
    Route::put('/{id}', [ReservationController::class, 'update']);
    Route::delete('/{id}', [ReservationController::class, 'destroy']);
    
    // Custom attach/detach personne routes
    Route::post('/attach-personne', [ReservationController::class, 'attachPersonne']);
    Route::post('/detach-personne', [ReservationController::class, 'detachPersonne']);
});

// Personne 
Route::prefix('personnes')->group(function () {
    Route::get('/', [PersonneController::class, 'index']);
    Route::get('/{id}', [PersonneController::class, 'show']);
    Route::post('/', [PersonneController::class, 'store']);
    Route::put('/{id}', [PersonneController::class, 'update']);
    Route::delete('/{id}', [PersonneController::class, 'destroy']);

    // Get all reservations for a personne
    Route::get('/{id}/reservations', [PersonneController::class, 'reservations']);

    // Attach and detach reservation to personne
    Route::post('/attach-reservation', [PersonneController::class, 'attachReservation']);
    Route::post('/detach-reservation', [PersonneController::class, 'detachReservation']);
});


// Chambres
Route::prefix('chambres')->group(function () {
    Route::get('/', [ChambreController::class, 'index']);
    Route::get('/{id}', [ChambreController::class, 'show']);
    Route::post('/', [ChambreController::class, 'store']);
    Route::put('/{id}', [ChambreController::class, 'update']);
    Route::delete('/{id}', [ChambreController::class, 'destroy']);
});

// Tarifs
Route::prefix('tarifs')->group(function () {
    Route::get('/', [TarifController::class, 'index']);
    Route::get('/{id}', [TarifController::class, 'show']);
    Route::post('/', [TarifController::class, 'store']);
    Route::put('/{id}', [TarifController::class, 'update']);
    Route::delete('/{id}', [TarifController::class, 'destroy']);
});

// ChambreTarif
Route::prefix('chambre_tarifs')->group(function () {
    Route::get('/', [ChambreTarifController::class, 'index']);
    Route::get('/{id}', [ChambreTarifController::class, 'show']);
    Route::post('/', [ChambreTarifController::class, 'store']);
    Route::put('/{id}', [ChambreTarifController::class, 'update']);
    Route::delete('/{id}', [ChambreTarifController::class, 'destroy']);
});

// Images
Route::prefix('images')->group(function () {
    Route::get('/', [ImageController::class, 'index']);
    Route::get('/{id}', [ImageController::class, 'show']);
    Route::post('/', [ImageController::class, 'store']);
    Route::put('/{id}', [ImageController::class, 'update']);
    Route::delete('/{id}', [ImageController::class, 'destroy']);
});