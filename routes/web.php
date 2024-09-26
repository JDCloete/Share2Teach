<?php

use App\Http\Controllers\HomePageController;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Support\Facades\Route;

Route::middleware(HandleInertiaRequests::class)->group(function(){


    // HomePage Route
    Route::get('/', [HomePageController::class, 'index'])->name('pages.homepage');



    // Sign-Up Page Route
    //Route::get('/sign-up', [HomePageController::class, 'sign-up'])->name('pages.sign-up');


});








#use App\Http\Controllers\UserInteractionController;

/*Route::post('documents/{document}/star', [UserInteractionController::class, 'star'])->middleware('auth');
Route::post('documents/{document}/rate', [UserInteractionController::class, 'rate'])->middleware('auth');
Route::get('documents/{document}/download', [UserInteractionController::class, 'download'])->middleware('auth');
Route::post('documents/{document}/report', [UserInteractionController::class, 'report'])->middleware('auth');
Route::post('documents/{document}/share', [UserInteractionController::class, 'share'])->middleware('auth');*/


/** R web.php
 *
 *  <?php
 *
 * use App\Routes\PageRoutes;
 *
 * // Call to all page routes
 * PageRoutes::get();
 *
 *
 */
