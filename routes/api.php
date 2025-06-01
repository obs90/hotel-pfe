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

use App\Http\Controllers\API\EmployeController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\AbsenceController;
use App\Http\Controllers\API\PaiementController;
use App\Http\Controllers\API\CongeController;
use App\Http\Controllers\API\TacheController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/user', [AuthController::class, 'getUser']);

Route::get('/chambres', [ChambreController::class, 'index']);
Route::get('chambres/{id}', [ChambreController::class, 'show']);

Route::middleware('auth:api')->group(function () {

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

    Route::get('/{id}/reservations', [ClientController::class, 'reservations']); // <--- Get all reservations for a specific client
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

// Employes
Route::prefix('employes')->group(function () {
    Route::get('/', [EmployeController::class, 'index']);
    Route::get('/{id}', [EmployeController::class, 'show']);
    Route::post('/', [EmployeController::class, 'store']);
    Route::put('/{id}', [EmployeController::class, 'update']);
    Route::delete('/{id}', [EmployeController::class, 'destroy']);
});

// Services
Route::prefix('services')->group(function () {
    Route::get('/', [ServiceController::class, 'index']);
    Route::get('/{id}', [ServiceController::class, 'show']);
    Route::post('/', [ServiceController::class, 'store']);
    Route::put('/{id}', [ServiceController::class, 'update']);
    Route::delete('/{id}', [ServiceController::class, 'destroy']);
});

// Absences
Route::prefix('absences')->group(function () {
    Route::get('/', [AbsenceController::class, 'index']);
    Route::get('/{id}', [AbsenceController::class, 'show']);
    Route::post('/', [AbsenceController::class, 'store']);
    Route::put('/{id}', [AbsenceController::class, 'update']);
    Route::delete('/{id}', [AbsenceController::class, 'destroy']);
});

// Paiements
Route::prefix('paiements')->group(function () {
    Route::get('/', [PaiementController::class, 'index']);          
    Route::get('/{id}', [PaiementController::class, 'show']);       
    Route::post('/', [PaiementController::class, 'store']);         
    Route::put('/{id}', [PaiementController::class, 'update']);     
    Route::delete('/{id}', [PaiementController::class, 'destroy']); 
});

// Conge

Route::prefix('conges')->group(function () {
    Route::get('/', [CongeController::class, 'index']);
    Route::post('/', [CongeController::class, 'store']);
    Route::get('{id}', [CongeController::class, 'show']);
    Route::put('{id}', [CongeController::class, 'update']);
    Route::delete('{id}', [CongeController::class, 'destroy']);
});

// Taches
Route::prefix('taches')->group(function () {
    Route::get('/', [TacheController::class, 'index']);
    Route::get('/{id}', [TacheController::class, 'show']);
    Route::post('/', [TacheController::class, 'store']);
    Route::put('/{id}', [TacheController::class, 'update']);
    Route::delete('/{id}', [TacheController::class, 'destroy']);
});

});