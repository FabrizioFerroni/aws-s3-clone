<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BucketsController;
use App\Http\Controllers\SubbucketsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/iniciarsesion', [AuthController::class, 'getLogin'])->name('login');
Route::post('/iniciarsesion', [AuthController::class, 'postLogin'])->name('login');
Route::get('/registrarse', [AuthController::class, 'getRegister'])->name('register');
Route::post('/registrarse', [AuthController::class, 'postRegister'])->name('register');
Route::get('/cerrarsesion', [AuthController::class, 'getLogout'])->name('logout');
Route::middleware('auth:web')->group(function () {
    Route::get('/', [HomeController::class, 'getHome']);
    Route::get('/buckets', [BucketsController::class, 'getHome']);
    Route::post('/buckets', [BucketsController::class, 'postBucket']);
    Route::get('/buckets/{nombre}', [BucketsController::class, 'getHomeBuckets']);
    Route::get('/buckets/{nombre}/{subnombre}', [BucketsController::class, 'getHomeBucketsSub']);
    Route::get('/borrar/bucket/{id}', [BucketsController::class, 'deleteBucket']);
    Route::get('/editar/bucket/{slug}', [BucketsController::class, 'editBucket']);
    Route::post('/editar/bucket/{slug}', [BucketsController::class, 'posteditBucket']);
    Route::get('/crear/buckets', [BucketsController::class, 'getCrearBucket']);
    Route::get('/crear/buckets/{nombre}', [BucketsController::class, 'getCreateBucket']);
    Route::post('/crear/buckets/{nombre}', [SubbucketsController::class, 'postCreateBucket']);
    Route::get('/borrar/bucket/{nombre}/{id}', [SubbucketsController::class, 'deleteBucket']);
    Route::get('/perfil', [UsersController::class, 'getHome']);
    Route::post('/perfil', [UsersController::class, 'updatePerfil']);
    Route::get('/subir/{nombre}/{subnombre}', [SubbucketsController::class, 'subirArchivo']);
    Route::post('/subir/{nombre}/{subnombre}', [SubbucketsController::class, 'postsubirArchivo']);
    Route::get('/borrar/{nombre}/{subnombre}/{id}', [SubbucketsController::class, 'deleteSubirArchivo']);
});

Route::get('404', [ErrorController::class, 'error404']);
Route::get('500', [ErrorController::class, 'error500']);

