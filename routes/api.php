<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Models\User;

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
Route::middleware('api.auth')->group(function () {
    Route::get('/users', [App\Http\Controllers\Api\UserController::class, 'users_list']);
    
    Route::get('/user', [App\Http\Controllers\Api\AuthController::class, 'user']);

    Route::get('/user/{id}', [App\Http\Controllers\Api\UserController::class, 'get_user']);

    Route::post('/user/{id}', [App\Http\Controllers\Api\UserController::class, 'update_user']);

    Route::delete('/user/{id}', [App\Http\Controllers\Api\UserController::class, 'delete_user']);
    
    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
});

Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);

Route::post('/forget-password', [App\Http\Controllers\Api\AuthController::class, 'forget_password']);

Route::post('/reset-password', [App\Http\Controllers\Api\AuthController::class, 'reset_password']);
