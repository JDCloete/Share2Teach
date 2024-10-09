<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MetadataController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\StarredController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;


// Using Laravel Sanctum for API Authentication
// Login Routes
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

// Register Routes
Route::post('/register', [RegisterController::class, 'register']);

// Forgot Password Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.forgot');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');


// Faq Routes
Route::post('/faq', [FaqController::class, 'store']);
Route::get('/faq/{faq}', [FaqController::class, 'readSingle']);
Route::get('/faq', [FaqController::class, 'readAll']);
Route::patch('/faq/{faq}', [FaqController::class, 'update']);
Route::delete('/faq/{faq}', [FaqController::class, 'deleteFaq']);

//Roles Routes
Route::post('/roles', [RoleController::class, 'store']);
Route::delete('/roles/{role}', [RoleController::class, 'deleteRole']);
Route::get('/roles', [RoleController::class, 'readAll']);

//Analytics Routes
Route::get('/analytics', [AnalyticsController::class, 'readAllUsers']);
Route::get('/analytics', [AnalyticsController::class, 'readAllDownloads']);
Route::get('/analytics', [AnalyticsController::class, 'readAllDocuments']);
Route::get('/analytics', [AnalyticsController::class, 'readAllReportedDocuments']);

//Documents Routes
Route::get('/documents', [DocumentController::class, 'readAll']);
Route::get('/documents/{document}', [DocumentController::class, 'readSingle']);
Route::post('/documents', [DocumentController::class, 'store']);
Route::patch('/documents/{document}', [DocumentController::class, 'update']);
Route::delete('/documents/{document}', [DocumentController::class, 'deleteDocument']);

//User Routes
Route::get('/users', [UserController::class, 'readAll']);
Route::get('/users/{user}', [UserController::class, 'readSingle']);
Route::post('/users', [UserController::class, 'store']);
Route::patch('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'deleteUser']);

//Metadata Route
Route::post('/metadata', [MetadataController::class, 'store']);
Route::get('/metadata/search', [MetadataController::class, 'searchMetadata']);
Route::delete('/metadata/{metadata}', [MetadataController::class, 'deleteMetadata']);

//Starred Route
Route::get('/starred', [StarredController::class, 'readAll']);
Route::post('/starred', [StarredController::class, 'store']);
Route::delete('/starred/{starred}', [StarredController::class, 'delete']);

//Report Route
Route::post('/reported', [ReportController::class, 'storeReportedDocument']);
Route::get('/reports', [ReportController::class, 'readAllReports']);
Route::get('/reports/{id}', [ReportController::class, 'readReport']);
Route::patch('/reports/{id}', [ReportController::class, 'updateReport']);
Route::delete('/reports/{id}', [ReportController::class, 'deleteReport']);

// Retrieves all reports submitted by a specific user.
Route::get('/users/{userId}/reports', [ReportController::class, 'readReportsByUser']);

//Rating Route
Route::get('/ratings', [RatingController::class, 'readAll']);
Route::post('/ratings', [RatingController::class, 'store']);
Route::delete('/ratings/{rating}', [RatingController::class, 'delete']);
Route::patch('/ratings/{rating}', [RatingController::class, 'update']);

//Downloads Route
Route::get('/downloads', [DownloadsController::class, 'readAll']);
Route::post('/downloads', [DownloadsController::class, 'store']);

//Shared Routes
Route::get('/share', [ShareController::class, 'readAll']);
Route::post('/share', [ShareController::class, 'store']);
