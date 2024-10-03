<?php

use App\Http\Controllers\ContributorsController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [HomePageController::class, 'index'])->name('pages.homepage');

Route::get('/contributors', [ContributorsController::class, 'index'])->name('contributors.page');


//Login Page routes // Extra
Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})->name('login');



/*Route::middleware('auth:sanctum')->group(function () {

    Route::get('/', function () {
        return inertia('HomePage'); // Inertia/Vue component
    });

    //Login Page routes
    Route::get('/login', function () {
        return inertia('HomePage'); // Inertia/Vue component
    });


    //Register Page route
    Route::get('/register', function () {
        return inertia('HomePage'); // Inertia/Vue component
    });

    //Forgot password page route
    Route::get('/forgot', function () {
        return inertia('HomePage'); // Inertia/Vue component
    });

});*/
