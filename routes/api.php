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
    Route::get('/bodykits', [BodykitController::class, 'getAll']);
    Route::post('/bodykits', [BodykitController::class, 'create']);

    Route::get('/bodykits/{bodykitId}', [BodykitController::class, 'get']);
    Route::put('/bodykits/{bodykitId}', [BodykitController::class, 'replace']);
    Route::patch('/bodykits/{bodykitId}', [BodykitController::class, 'update']);
    Route::delete('/bodykits/{bodykitId}', [BodykitController::class, 'delete']);

    Route::get('/bodykit-shops', [BodykitShopController::class, 'getAll']);
    Route::get('/bodykit-shops/{bodykitShopId}', [BodykitShopController::class, 'get']);
    Route::post('/bodykit-shops', [BodykitShopController::class, 'create']);
});
