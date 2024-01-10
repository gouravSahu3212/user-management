<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/get-countries', [App\Http\Controllers\PublicController::class, 'get_countries'])->name('get-countries');

Route::get('/get-states', [App\Http\Controllers\PublicController::class, 'get_states'])->name('get-states');

Route::get('/get-cities', [App\Http\Controllers\PublicController::class, 'get_cities'])->name('get-cities');

Route::get('/get-users', [App\Http\Controllers\UserController::class, 'get_users'])->name('users');

Route::get('/edit-user-form/{user_id}', [App\Http\Controllers\UserController::class, 'edit_user_form'])->name('edit-user-form');

Route::post('/edit-user/{user_id}', [App\Http\Controllers\UserController::class, 'edit_user'])->name('edit-user');

Route::post('/delete-user', [App\Http\Controllers\UserController::class, 'delete_user'])->name('delete-user');

Route::get('/reset-password-form/{user_id}', [App\Http\Controllers\UserController::class, 'reset_password_form'])->name('reset-password-form');
