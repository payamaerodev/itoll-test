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

Route::get('/issueToken', [\App\Http\Controllers\ServiceRequestController::class, 'issueToken']);
Route::prefix('/')->middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['user_role:clientSet'])->prefix('/set')->group(function () {
        Route::post('/add-request', [\App\Http\Controllers\ServiceRequestController::class, 'postRequest']);
        Route::post('/cancel-request', [\App\Http\Controllers\ServiceRequestController::class, 'cancelServiceRequest']);
    });
    Route::prefix('/courier')->middleware(['user_role:courier'])->group(function () {
        Route::post('/accept-request', [\App\Http\Controllers\ServiceRequestController::class, 'postAcceptByCourier'])->middleware('isCourier');
        Route::get('/get-requests', [\App\Http\Controllers\ServiceRequestController::class, 'getServicesRequests'])->middleware('auth:sanctum');

    });
});
Route::get('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login');
