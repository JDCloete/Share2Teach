<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContributeFilesController;
use App\Http\Controllers\ContributorsController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ModerateReportedController;
use App\Http\Controllers\ModerationController;
use App\Http\Controllers\OERController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserModerationController;
use Illuminate\Support\Facades\Route;


// Display the homepage
Route::get('/', [HomePageController::class, 'index'])->name('pages.homepage');


// Display contributors page
Route::get('/contributors', [ContributorsController::class, 'index'])->name('contributors.page');

Route::get('/about-us', [ContributorsController::class, 'index'])->name('contributors.page');


// Display the Faq Page
Route::get('/faq', [FaqController::class, 'index'])->name('pages.faq');



// Show the register page (Inertia)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.show');
Route::post('/register', [UserController::class, 'store'])->name('register.store');



// Show the login page (Inertia)
Route::get('/login', [LoginController::class, 'index'])->name('login');


// Display the Document Moderation Page
Route::get('/moderation', [ModerationController::class, 'index'])->name('pages.moderation');

// Display the Document Moderation Page
Route::get('/moderate-reported', [ModerateReportedController::class, 'index'])->name('pages.moderate');


// Display the User Moderation Page
Route::get('/moderate-users', [UserModerationController::class, 'index'])->name('pages.user.moderation');


// VIEW DOCUMENTS
Route::get('/documents/{id}/url', [DocumentController::class, 'getDocumentUrl']);



Route::get('/documents/download/{id}', [DocumentController::class, 'download']);



// Display the AboutUs Page
Route::get('/about-us', [AboutUsController::class, 'index'])->name('pages.about-us');


// Display the Analytics Page
Route::get('/analytics', [AnalyticsController::class, 'index'])->name('pages.analytics');



// Display the ContributeFiles Page
Route::get('/contribute-files', [ContributeFilesController::class, 'index'])->name('contribute.files');
Route::post('/contribute-files', [ContributeFilesController::class, 'store'])->name('contribute.files.store');


// Display the Explore Page
Route::get('/explore', [DocumentController::class, 'index'])->name('explore.files');
Route::post('/explore', [DocumentController::class, 'store'])->name('explore.files.store');





// Display the Faq Page
Route::get('/oer', [OERController::class, 'index'])->name('oer');


// Display the Reset Password Page
Route::get('/reset-password', [ForgotPasswordController::class, 'showResetPasswordPage'])->name('reset.password');




























// Show the reset password page (Inertia)
// Route::get('/reset-password', [ResetPasswordController::class, 'showResetPasswordPage'])->name('reset.password');






/*Route::middleware('auth:sanctum')->group(function () {

Route::post('/upload', [DocumentController::class, 'uploadAndConvert'])->name('upload.convert');

});*/
