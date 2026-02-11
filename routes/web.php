<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', [UserController::class, 'showRegistrationForm']);
Route::post('/register', [userController::class, 'register'])->name('register');
Route::get('/login', [UserController::class, 'showLoginForm']);
Route::post('/login', [UserController::class, 'login'])->name('login');

// Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
