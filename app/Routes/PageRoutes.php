<?php

namespace App\Routes;




use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;


class PageRoutes
{
    public static function get()
    {
        // Landing page route
        Route::get('/', [HomePageController::class, 'index'])->name('pages.homepage');



        //Login page routes
        Route::get('/login', [LoginController::class, 'index'])->name('pages.login.index');

        //Register page route
        Route::get('/register', [RegisterController::class, 'index'])->name('pages.register.index');

        //Forgot password page route
        Route::get('/forgot', [RegisterController::class, 'index'])->name('pages.forgot.index');





    }
}


/*        // Authenticated routes
        Route::middleware('auth:sanctum')->group(function () {

            Route::prefix('/modules/{module}')->group(function () {

                //Submissions routes
                Route::get('/submissions', [SubmissionsController::class, 'index'])->name('pages.submissions');
                Route::get('/submissions/{submission}', [AssignmentsController::class, 'getSubmissionPage'])->name('pages.submission');

                //Assignments routes
                Route::get('/assignments', [AssignmentsController::class, 'index'])->name('pages.assignments');
                Route::get('/assignments/{assignment}', [AssignmentsController::class, 'getViewAssignmentPage'])->name('pages.assignment');
                Route::get('/assignments/create', [AssignmentsController::class, 'getCreateAssignmentPage'])->name('pages.create-assignments');

            });
        });*/
