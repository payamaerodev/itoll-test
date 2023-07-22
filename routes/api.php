<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [\App\Http\Controllers\ServiceRequestController::class, 'issueToken'])->name('login');
Route::prefix('/')->middleware(['auth:sanctum'])->group(function () {
    Route::prefix('/set')->group(function () {
        Route::post('/add-request', [\App\Http\Controllers\ServiceRequestController::class, 'postRequest'])->middleware('user_role:clientSet');
        Route::put('/cancel-request', [\App\Http\Controllers\ServiceRequestController::class, 'cancelServiceRequest'])->middleware('user_role:clientSet');
    });
    Route::prefix('/courier')->group(function () {
        Route::put('/accept-request', [\App\Http\Controllers\ServiceRequestController::class, 'postAcceptByCourier'])->middleware('user_role:courier');
        Route::get('/get-requests', [\App\Http\Controllers\ServiceRequestController::class, 'getServicesRequests'])->middleware('user_role:courier');
    });
});
