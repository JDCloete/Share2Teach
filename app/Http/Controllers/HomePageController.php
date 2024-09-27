<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomePageController extends Controller
{
    public function index()
    {
        return Inertia::render('App'); // Ensure this matches your component's name
    }
}

