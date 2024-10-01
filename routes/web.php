<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\DocumentController; // Import the DocumentController
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\MetadataController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(HandleInertiaRequests::class)->group(function() {
    Route::get('/', [HomePageController::class, 'index'])->name('pages.homepage');

    // Document Routes
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index'); // Display documents
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create'); // Form to upload document
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store'); // Store uploaded document
    Route::resource('documents', DocumentController::class); // Resource route for documents
   // Route::resource('roles', RoleController::class);
    Route::resource('ratings', RatingController::class);
    Route::resource('shares', ShareController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('analytics', AnalyticsController::class);
    Route::resource('metadata', MetadataController::class);
    Route::resource('users', UserController::class);
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

    Route::get('downloads', [DownloadsController::class, 'index'])->name('downloads.index');
    Route::get('downloads/create', [DownloadsController::class, 'create'])->name('downloads.create');
    Route::post('downloads', [DownloadsController::class, 'store'])->name('downloads.store');
    Route::get('downloads/{id}', [DownloadsController::class, 'show'])->name('downloads.show');

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
