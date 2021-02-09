<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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


Route::get('users', [UsersController::class, 'getAllUsers']);
Route::get('users/{id}', [UsersController::class, 'getUser']);
Route::post('users', [UsersController::class, 'createUser']);
Route::put('users', [UsersController::class, 'updateUser']);
Route::delete('users', [UsersController::class, 'deleteUser']);