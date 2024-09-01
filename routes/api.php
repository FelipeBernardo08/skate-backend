<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SkaterController;
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

Route::middleware('jwt.auth')->group(function () {
    //login
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::patch('update-skater', [SkaterController::class, 'updateSkater']);
});

//login
Route::post('login', [AuthController::class, 'login']);

//skater
Route::post('create-skater', [SkaterController::class, 'createSkater']);
