<?php

use App\Http\Controllers\ContributorsController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [HomePageController::class, 'index'])->name('pages.homepage');

Route::get('/contributors', [ContributorsController::class, 'index'])->name('contributors.page');

//Route::get('/contributors', function () {
//    return Inertia::render('ContributorsPage'); // Assuming this is the path to your Vue component
//})->name('contributors.page'); // Make sure the name matches what you use in the `router.push`

<<<<<<< Updated upstream
});
=======


/*Route::middleware('auth:sanctum')->group(function () {

    Route::get('/', function () {
        return inertia('HomePage'); // Inertia/Vue component
    });

    //Login Page routes
    Route::get('/login', function () {
        return inertia('HomePage'); // Inertia/Vue component
    });
>>>>>>> Stashed changes

    //Register Page route
    Route::get('/register', function () {
        return inertia('HomePage'); // Inertia/Vue component
    });

    //Forgot password page route
    Route::get('/forgot', function () {
        return inertia('HomePage'); // Inertia/Vue component
    });

});*/
