<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $users = User::all();
    /*  return Inertia::render('Welcome'); */
   return view('users.index', [ 'users' => $users]);
})->name('home');

Route::get('/admin/usuarios', [UserController::class, 'index']);
Route::get('/admin/usuarios/{user}', [UserController::class, 'show']);