<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserRun;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

Route::middleware(['cors'])->group(function () {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('profile', [AuthController::class, 'profile']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/sanctum/token', function (Request $request) {
//     $request->validate([
//         'email' => 'required|email',
//         'password' => 'required',
//         'device_name' => 'required',
//     ]);

//     $user = User::where('email', $request->email)->first();

//     if (!$user || !Hash::check($request->password, $user->password)) {
//         throw ValidationException::withMessages([
//             'email' => ['The provided credentials are incorrect.'],
//         ]);
//     }

//     return $user->createToken($request->device_name)->plainTextToken;
// });

// Route::middleware('auth:sanctum')->get('/user/revoke', function (Request $request) {
//     $user = $request->user();
//     $user->tokens()->delete();
//     return 'Token are deleted';
// });

// Route::post('/auth/register', [AuthController::class, 'register']);


Route::apiResource('/run', UserRun::class);
