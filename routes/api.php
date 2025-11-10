<?php

use App\Http\Controllers\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//Route::get('/users', [UserController::class, 'index']);
Route::apiResource('/users', UserController::class)->middleware('auth');
Route::get('/home', function () {
    return response()->json('Sem login', 200);
})->name('login');
