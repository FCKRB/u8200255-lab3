<?php

use App\Http\Controllers\BodykitShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BodykitController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {
    Route::get('/guitars', [BodykitController::class, 'getAll']);
    Route::post('/guitars', [BodykitController::class, 'create']);

    Route::get('/guitars/{guitarId}', [BodykitController::class, 'get']);
    Route::put('/guitars/{guitarId}', [BodykitController::class, 'replace']);
    Route::patch('/guitars/{guitarId}', [BodykitController::class, 'update']);
    Route::delete('/guitars/{guitarId}', [BodykitController::class, 'delete']);

    Route::get('/guitar-shops', [BodykitShopController::class, 'getAll']);
    Route::get('/guitar-shops/{guitarShopId}', [BodykitShopController::class, 'get']);
    Route::post('/guitar-shops', [BodykitShopController::class, 'create']);
});
