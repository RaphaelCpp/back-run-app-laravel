<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserRun;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('getAllUser', [AuthController::class, 'getallUser'])->middleware('auth:sanctum');
Route::get('users/{id}', [AuthController::class, 'getUser'])->middleware('auth:sanctum');
Route::put('users/edit', [AuthController::class, 'editUser'])->middleware('auth:sanctum');
Route::delete('users/delete/{id}', [AuthController::class, 'deleteUsers'])->middleware('auth:sanctum');
Route::get('getAllRun', [UserRun::class, 'getAllRun'])->middleware('auth:sanctum');
Route::delete('run/delete/{id}', [UserRun::class, 'destroy'])->middleware('auth:sanctum');

Route::apiResource('/run', UserRun::class);
