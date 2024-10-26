<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MetadataController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\StarredController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Using Laravel Sanctum for API Authentication
// Login Routes
Route::post('/login', [LoginController::class, 'login']);


//Route::post('/logout', [LoginController::class, 'logout']);


// Register Routes
Route::post('/register', [UserController::class, 'store']);


// Populating the moderation page with documents
Route::get('/documents', [DocumentController::class, 'getDocumentsWithMetadata']);

Route::patch('/documents/{document}', [DocumentController::class, 'update']);
Route::delete('/documents/{document}', [DocumentController::class, 'deleteDocument']);

// Populating the moderation page with documents
Route::get('/reported-documents', [DocumentController::class, 'getDocumentsWithMetadata']);
//Route::get('/reported-documents', [DocumentController::class, 'getReportedDocuments']);

Route::patch('/reported-documents/{report}', [DocumentController::class, 'updateReportedDocument']);
Route::delete('/reported-documents/{report}', [DocumentController::class, 'deleteReportedDocument']);


//Route::patch('/documents/{document}', [DocumentController::class, 'updateReported']);
//Route::delete('/documents/{document}', [DocumentController::class, 'deleteReported']);




// Populating the moderation page with documents
Route::get('/documents/display', [DocumentController::class, 'getDocumentsWithRatings']);

// Rate document & Report document
Route::patch('/documents/rate/{rate}', [DocumentController::class, 'rate']);
Route::patch('/documents/report/{report}', [DocumentController::class, 'report']);





//User Routes
Route::get('/users', [DocumentController::class, 'getRolesWithUsers']);

Route::patch('/users/{user}', [DocumentController::class, 'updateUserToEducator']);
Route::patch('/users/{user}', [DocumentController::class, 'updateUserToModerator']);
Route::patch('/users/{user}', [DocumentController::class, 'updateUserToAdmin']);
Route::delete('/users/{user}', [DocumentController::class, 'deleteUser']);




// Forgot Password Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.forgot');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');


// Inside api.php
Route::get('/faq', [FaqController::class, 'readAll']);



Route::post('/faq', [FaqController::class, 'store']);
Route::get('/faq/{faq}', [FaqController::class, 'readSingle']);
Route::patch('/faq/{faq}', [FaqController::class, 'update']);
Route::delete('/faq/{faq}', [FaqController::class, 'deleteFaq']);




//Roles Routes
Route::post('/roles', [RoleController::class, 'store']);
Route::delete('/roles/{role}', [RoleController::class, 'deleteRole']);
Route::get('/roles', [RoleController::class, 'readAll']);


// Analytics Routes
Route::get('/analytics', [AnalyticsController::class, 'getAllAnalyticsData']);

//Analytics Routes
Route::get('/analytics/users', [AnalyticsController::class, 'readAllUsers']);
Route::get('/analytics/new-users-today', [AnalyticsController::class, 'readAllNewUsersFromToday']);


Route::get('/analytics/downloads', [AnalyticsController::class, 'readAllDownloads']);
Route::get('/analytics/new-downloads-today', [AnalyticsController::class, 'readAllNewDownloadsFromToday']);


Route::get('/analytics/documents', [AnalyticsController::class, 'readAllDocuments']);
Route::get('/analytics/new-documents-today', [AnalyticsController::class, 'readAllNewDocumentsFromToday']);


Route::get('/analytics/reported-documents', [AnalyticsController::class, 'readAllReportedDocuments']);
Route::get('/analytics/new-reports-today', [AnalyticsController::class, 'readAllNewReportsFromToday']);


//Documents Upload Routes
Route::post('/upload-documents', [DocumentController::class, 'upload']);


//Route::get('/documents', [DocumentController::class, 'readAll']);
//Route::get('/documents/{document}', [DocumentController::class, 'readSingle']);




// ALLES TOT HIER WERK


//Rating Route
Route::get('/ratings', [RatingController::class, 'readAll']);
Route::post('/ratings', [RatingController::class, 'store']);
Route::delete('/ratings/{rating}', [RatingController::class, 'delete']);
Route::patch('/ratings/{rating}', [RatingController::class, 'update']);


//
//Route::get('/users/{user}', [UserController::class, 'readSingle']);
//Route::post('/users', [UserController::class, 'store']);


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


//Downloads Route
Route::get('/downloads', [DownloadsController::class, 'readAll']);
Route::post('/downloads', [DownloadsController::class, 'store']);

//Shared Routes
Route::get('/share', [ShareController::class, 'readAll']);
Route::post('/share', [ShareController::class, 'store']);


Route::patch('users/{user}/update', [UserController::class, 'update']);
