<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitysController;
use App\Http\Controllers\NavettesController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthValidation;
use App\Http\Middleware\CheckPermission;
use App\Models\permission;
use Illuminate\Support\Facades\Route;


//View
Route::get('/login', [PageController::class , "login"])->name("login");
Route::get('/register', [PageController::class , "register"])->name("register");
Route::get('/forget-password', [PageController::class , "forgetpassword"])->name("forgetpassword");
Route::get('/', [PageController::class , "home"])->name('home');
Route::get('/posts', [PageController::class , "posts"])->name('posts.index');
Route::get('/posts/book/{id}', [PageController::class , "book"])->name('posts.book');
Route::post('/posts/book/store{id}', [ReservationsController::class , "store"])->name('booking.store');
// Route::get('/post/{id}', [PageController::class , "post"])->name('post');

//Actions
Route::post('/signin', [AuthController::class , "signin"])->name("signin");
Route::post('/logout', [PageController::class , "logout"])->name("logout");

//Route Layer
Route::middleware([AuthValidation::class])->group(function(){

    //dashborad
    Route::get('/dashboard', [PageController::class, "dashboard"])->name('dashboard');

    //Roles
    Route::prefix('dashboard/role')->middleware('CheckPermission')->group(function () {
        Route::get('/', [PageController::class, "roles"])->name('roles.index');
        Route::get('/create', [RolesController::class, "create"])->name('roles.create');
        Route::post('/store', [RolesController::class, "store"])->name('roles.store');
        Route::get('/edit/{roles:id}', [RolesController::class, "edit"])->name('roles.edit');
        Route::post('/update', [RolesController::class, "update"])->name('roles.edit');
        Route::delete('/delete/{roles:id}', [RolesController::class, "destroy"])->name('roles.destroy');
    });

    //navettes
    Route::prefix('dashboard/navettes')->middleware('CheckPermission')->group(function () {
        Route::get('/', [PageController::class, "navettes"])->name('navettes.index');
        Route::get('/create', [NavettesController::class, "create"])->name('navettes.create');
        Route::post('/store', [NavettesController::class, "store"])->name('navettes.store');
    });

    //navettes
    Route::prefix('dashboard/tags')->middleware('CheckPermission')->group(function () {
        Route::get('/', [PageController::class, "tags"])->name('tags.index');
        Route::post('/store', [TagController::class, "store"])->name('tags.store');
        Route::post('/destroy/{tag:id}', [TagController::class, "destroy"])->name('tags.destroy');
    });

    //booking
    Route::prefix('dashboard/booking')->middleware('CheckPermission')->group(function () {
        Route::get('/', [PageController::class, "booking"])->name('booking.index');
        Route::post('/confirm/{reservations:id}', [ReservationsController::class, "confirm"])->name('booking.confirm');
    });

    //Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [PageController::class, "profile"])->name('profile.index');
        Route::get('/favorite', [PageController::class, "favorite"])->name('profile.favorite');
        Route::get('/payment', [PageController::class, "payment"])->name('profile.payment');
        Route::get('/notification', [PageController::class, "notification"])->name('profile.notification');
        Route::get('/change-password', [PageController::class, "password"])->name('profile.password');
        Route::get('/edit', [PageController::class, "editprofile"])->name('profile.edit');
        Route::get('/reservations', [PageController::class, "profile"])->name('profile.reservations');
        Route::post('/cancel/{reservations:id}', [ReservationsController::class, "cancel"])->name('booking.cancel');
    });
});

//api
Route::post('/signup', [AuthController::class , "signup"])->name("signup");
// Route::get('/getcitys', [CitysController::class , "getcitys"])->name("getcitys");
// Route::get('/getnavette', [CitysController::class , "getnavette"])->name("getcitys");
// Route::get('/test', [PageController::class , "test"])->name("test");

Route::fallback(function() {
    return view('404');
});
