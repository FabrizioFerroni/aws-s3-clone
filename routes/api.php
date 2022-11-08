<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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


Route::prefix('auth')->group(function(){
    Route::post('iniciarsesion', [AuthController::class, 'postLogin']);
    Route::post('registrarse', [AuthController::class, 'postRegister']);
});

Route::middleware('auth:api')->group(function() {
    Route::get('users', [AuthController::class, 'getAll']);
    Route::get('user', [AuthController::class, 'getUser']);
});
