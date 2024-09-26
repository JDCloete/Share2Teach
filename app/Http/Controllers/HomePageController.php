<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomePageController extends Controller
{
    // Controller renders HomePage
    public function index(Request $request)
    {
        return Inertia::render('HomePage', []);
    }
}

