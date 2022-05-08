<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserRun;
use Illuminate\Support\Facades\Route;


Route::view('/{any}', 'app')->where('any', '.*');
