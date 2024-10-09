<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContributeFilesController;
use App\Http\Controllers\ContributorsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ModerationController;
use App\Http\Controllers\OERController;
use Illuminate\Support\Facades\Route;


// Display the homepage
Route::get('/', [HomePageController::class, 'index'])->name('pages.homepage');


// Display contributors page
Route::get('/contributors', [ContributorsController::class, 'index'])->name('contributors.page');


// Show the register page (Inertia)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


// Show the login page (Inertia)
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);


// Display the AboutUs Page
Route::get('/about-us', [AboutUsController::class, 'index'])->name('pages.about-us');


// Display the Analytics Page
Route::get('/analytics', [AnalyticsController::class, 'index'])->name('pages.analytics');


// Display the ContributeFiles Page
Route::get('/contribute-files', [ContributeFilesController::class, 'index'])->name('contribute.files');
Route::post('/contribute-files', [ContributeFilesController::class, 'store'])->name('contribute.files.store');


// Display the Explore Page
//Route::get('/explore', [::class, 'index'])->name('explore.files');
//Route::post('/explore', [::class, 'store'])->name('explore.files.store');


// Display the Faq Page
Route::get('/faq', [FaqController::class, 'index'])->name('pages.faq');


// Display the Faq Page
Route::get('/moderation', [ModerationController::class, 'index'])->name('pages.moderation');


// Display the Faq Page
Route::get('/oer', [OERController::class, 'index'])->name('oer');




























// Show the reset password page (Inertia)
// Route::get('/reset-password', [ResetPasswordController::class, 'showResetPasswordPage'])->name('reset.password');






/*Route::middleware('auth:sanctum')->group(function () {

Route::post('/upload', [DocumentController::class, 'uploadAndConvert'])->name('upload.convert');

});*/
