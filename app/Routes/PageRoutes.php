<?php

namespace App\Routes;

use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;

class PageRoutes
{
    public static function get()
    {
        // Landing page route
        Route::get('/', [HomePageController::class, 'index'])->name('home');

        // Login page route
        Route::get('/login', [LoginController::class, 'index'])->name('login');

        // Register page route
        Route::get('/register', [RegisterController::class, 'index'])->name('register');

        // Forgot password page route
        Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.forgot');

    }
}
