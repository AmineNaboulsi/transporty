<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitysController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthValidation;
use Illuminate\Support\Facades\Route;

//View
Route::get('/login', [PageController::class , "login"])->name("login");
Route::get('/register', [PageController::class , "register"])->name("register");
Route::get('/forget-password', [PageController::class , "forgetpassword"])->name("forgetpassword");
Route::get('/', [PageController::class , "home"])->name('home');
Route::get('/posts', [PageController::class , "posts"])->name('posts');
Route::get('/post/{id}', [PageController::class , "post"])->name('post');


//Actions
Route::post('/signin', [AuthController::class , "signin"])->name("signin");
Route::post('/logout', [PageController::class , "logout"])->name("logout");

Route::middleware(AuthValidation::class)->group(function(){
    Route::get('/dashboard', [PageController::class , "dashboard"])->name('dashboard');
    Route::get('/profile', [PageController::class , "profile"])->name('profile');
    //
    Route::get('/profile/edit', [UserController::class , "edit"])->name('profile.edit');
});

//api
Route::post('/signup', [AuthController::class , "signup"])->name("signup");
Route::get('/getcitys', [CitysController::class , "getcitys"])->name("getcitys");
Route::get('/getnavette', [CitysController::class , "getcitys"])->name("getcitys");
