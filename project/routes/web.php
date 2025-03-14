<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitysController;
use App\Http\Controllers\Google2FAController;
use App\Http\Controllers\NavettesController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthValidation;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\Google2FAMiddleware;
use App\Models\permission;
use Illuminate\Support\Facades\Route;


//View
Route::get('/login', [PageController::class , "login"])->name("login");
Route::get('/register', [PageController::class , "register"])->name("register");
Route::get('/2fa/verify', [Google2FAController::class, 'verify'])->name('2fa.verify');
Route::post('/2fa/verify', [Google2FAController::class, 'authenticate'])->name('2fa.authenticate');
Route::delete('/2fa/disable', [Google2FAController::class, 'disable'])->name('2fa.disable');


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
Route::middleware([AuthValidation::class , CheckPermission::class])->group(function(){

    //dashborad
    Route::get('/dashboard', [PageController::class, "dashboard"])->name('dashboard.index');

    //users
    Route::prefix('dashboard/users')->middleware('CheckPermission')->group(function () {
        Route::get('/', [PageController::class, "users"])->name('users.index');
        //api
        Route::patch('/assign-role', [UserController::class, "assignrole"]);
    });

    //Roles
    Route::prefix('dashboard/role')->middleware('CheckPermission')->group(function () {
        Route::get('/', [PageController::class, "roles"])->name('roles.index');
        Route::get('/create', [RolesController::class, "create"])->name('roles.create');
        Route::post('/store', [RolesController::class, "store"])->name('roles.store');
        Route::get('/edit/{role:id}', [RolesController::class, "edit"])->name('roles.edit');
        Route::put('/update/{role:id}', [RolesController::class, "update"])->name('roles.update');
        Route::delete('/delete/{roles:id}', [RolesController::class, "destroy"])->name('roles.destroy');
    });

    //navettes
    Route::prefix('dashboard/navettes')->middleware('CheckPermission')->group(function () {
        Route::get('/', [PageController::class, "navettes"])->name('navettes.index');
        Route::get('/create', [NavettesController::class, "create"])->name('navettes.create');
        Route::post('/store', [NavettesController::class, "store"])->name('navettes.store');
        Route::get('/edit/{id}', [NavettesController::class, "edit"])->name('navettes.edit');
        Route::put('/update/{navettes:id}', [NavettesController::class, "update"])->name('navettes.update');
        Route::delete('/destroy/{navettes:id}', [NavettesController::class, "destroy"])->name('navettes.destroy');
    });

    //tags
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

        Route::middleware(AuthValidation::class )->group(function () {
            Route::get('/2fa/setup', [Google2FAController::class, 'setup'])->name('2fa.setup');


            Route::get('/test', function (){
                return 'test';
            })->middleware(Google2FAMiddleware::class)->name("test");
        });

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
