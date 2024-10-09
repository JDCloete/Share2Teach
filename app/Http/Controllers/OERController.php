<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class OERController extends Controller
{
    public function index(): Response
    {
        // Render the OERPage using Inertia
        return Inertia::render('OERPage');
    }
}
