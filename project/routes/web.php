<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

//View
Route::get('/login', [PageController::class , "login"])->name("login");
Route::get('/register', [PageController::class , "register"])->name("register");
Route::get('/forget-password', [PageController::class , "forgetpassword"])->name("forgetpassword");
Route::get('/', [PageController::class , "home"])->name('home');
Route::get('/dashboard', [PageController::class , "home"])->name('dashboard');
Route::get('/profile', [PageController::class , "home"])->name('profile');
Route::get('/posts', [PageController::class , "posts"])->name('posts');
Route::get('/post/{id}', [PageController::class , "post"])->name('post');


//Actions
Route::post('/signin', [AuthController::class , "signin"])->name("signin");
Route::post('/signup', [AuthController::class , "signup"])->name("signup");
Route::post('/logout', [PageController::class , "logout"])->name("logout");
