<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PricelistController;
use App\Http\Controllers\VehicleBrandController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\VehicleYearController;
use App\Http\Controllers\VehicleModelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return "mantap";
});


Route::get("/login", [AuthController::class, 'login'])->name('login');
Route::post("/register", [AuthController::class, 'register']);


Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('vehicle-brand')->group(function () {
        Route::get('/{id?}', [VehicleBrandController::class, "getVehicleBrand"])->middleware(['auth:sanctum', 'ability:view-data']);
        Route::post('/', [VehicleBrandController::class, "createData"])->middleware(['auth:sanctum', 'ability:create-data']);
        Route::put('/{id}', [VehicleBrandController::class, "editData"])->middleware(['auth:sanctum', 'ability:edit-data']);
        Route::delete('/{id}', [VehicleBrandController::class, "deleteData"])->middleware(['auth:sanctum', 'ability:delete-data']);
    });

    Route::prefix('vehicle-type')->group(function () {
        Route::get('/{id?}', [VehicleTypeController::class, "getVehicleType"])->middleware(['auth:sanctum', 'ability:view-data']);
        Route::post('/', [VehicleTypeController::class, "createData"])->middleware(['auth:sanctum', 'ability:create-data']);
        Route::put('/{id}', [VehicleTypeController::class, "editData"])->middleware(['auth:sanctum', 'ability:edit-data']);
        Route::delete('/{id}', [VehicleTypeController::class, "deleteData"])->middleware(['auth:sanctum', 'ability:delete-data']);
    });

    Route::prefix('vehicle-year')->group(function () {
        Route::get('/{id?}', [VehicleYearController::class, "getVehicleYear"])->middleware(['auth:sanctum', 'ability:view-data']);
        Route::post('/', [VehicleYearController::class, "createData"])->middleware(['auth:sanctum', 'ability:create-data']);
        Route::put('/{id}', [VehicleYearController::class, "editData"])->middleware(['auth:sanctum', 'ability:edit-data']);
        Route::delete('/{id}', [VehicleYearController::class, "deleteData"])->middleware(['auth:sanctum', 'ability:delete-data']);
    });

    Route::prefix('vehicle-model')->group(function () {
        Route::get('/{id?}', [VehicleModelController::class, "getVehicleModel"])->middleware(['auth:sanctum', 'ability:view-data']);
        Route::post('/', [VehicleModelController::class, "createData"])->middleware(['auth:sanctum', 'ability:create-data']);
        Route::put('/{id}', [VehicleModelController::class, "editData"])->middleware(['auth:sanctum', 'ability:edit-data']);
        Route::delete('/{id}', [VehicleModelController::class, "deleteData"])->middleware(['auth:sanctum', 'ability:delete-data']);
    });

    Route::prefix('pricelist')->group(function () {
        Route::get('/{id?}', [PricelistController::class, "getPricelist"])->middleware(['auth:sanctum', 'ability:view-data']);
        Route::post('/', [PricelistController::class, "createData"])->middleware(['auth:sanctum', 'ability:create-data']);
        Route::put('/{id}', [PricelistController::class, "editData"])->middleware(['auth:sanctum', 'ability:edit-data']);
        Route::delete('/{id}', [PricelistController::class, "deleteData"])->middleware(['auth:sanctum', 'ability:delete-data']);
    });
});




// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
