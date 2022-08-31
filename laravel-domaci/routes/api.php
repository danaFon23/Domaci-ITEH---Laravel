<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('directors', DirectorController::class);

Route::post('/registration',[AuthController::class, 'registration']);

Route::post('/login',[AuthController::class, 'login']);

Route::get('/movies', MovieController::class);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::resource('movies', MovieController::class)->only(['update','destroy']);
    Route::post('store', [MovieController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
