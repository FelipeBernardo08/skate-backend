<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageLocalController;
use App\Http\Controllers\ImageProductController;
use App\Http\Controllers\ImageProfileController;
use App\Http\Controllers\LikesLocalController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SkaterController;
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

    //skater
    Route::patch('update-skater', [SkaterController::class, 'updateSkater']);
    Route::patch('update-password', [SkaterController::class, 'updatePassword']);

    //local
    Route::post('create-local', [LocalController::class, 'createLocal']);
    Route::put('update-local/{id}', [LocalController::class, 'updateLocal']);

    //product
    Route::get('read-products', [ProductController::class, 'readProducts']);
    Route::get('read-product/{id}', [ProductController::class, 'readProductId']);
    Route::get('read-own-products', [ProductController::class, 'readOwnProducts']);
    Route::post('create-product', [ProductController::class, 'createProduct']);
    Route::put('update-product/{id}', [ProductController::class, 'updateProduct']);
    Route::patch('desactive-product/{id}', [ProductController::class, 'desactiveProduct']);

    //imgProfile
    Route::post('create-image-profile', [ImageProfileController::class, 'createImageProfile']);
    Route::delete('delete-image-profile/{id}', [ImageProfileController::class, 'deleteImgTicket']);

    //imgLocal
    Route::post('create-image-local/{id}', [ImageLocalController::class, 'createImageLocal']);

    //likesLocal
    Route::post('create-like-local', [LikesLocalController::class, 'createLike']);
});

//login
Route::post('login', [AuthController::class, 'login']);

//skater
Route::post('create-skater', [SkaterController::class, 'createSkater']);

//local
Route::get('read-locals', [LocalController::class, 'readLocals']);
Route::get('read-local/{id}', [LocalController::class, 'readLocalId']);
