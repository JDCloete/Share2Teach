<?php

use App\Http\Controllers\HomePageController;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Support\Facades\Route;

Route::middleware(HandleInertiaRequests::class)->group(function(){
    Route::get('/', [HomePageController::class, 'index'])->name('pages.homepage');

    //Route::get('/sign-up', [HomePageController::class, 'sign-up'])->name('pages.sign-up');
});



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
