<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserRun;
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

// Route::get('/', function () {
//     return view('login');
// });


// Route::get('users', [AuthController::class, 'index'])->name('users.index');
// Route::get('users/{id}', [AuthController::class, 'getUsers']);
// Route::post('users/edit', [AuthController::class, 'editUser']);
// Route::post('users/delete/{id}', [AuthController::class, 'deleteUsers']);

// Route::get('run', [UserRun::class, 'getRun'])->name('run.run');;
// // Route::get('run/{id}', [AuthController::class, 'getUsers']);
// // Route::post('run/edit', [AuthController::class, 'editUser']);
// Route::post('run/delete/{id}', [UserRun::class, 'destroy']);


Route::view('/{any}', 'app')->where('any', '.*');
