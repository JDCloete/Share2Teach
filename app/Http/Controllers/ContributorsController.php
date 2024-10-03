<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class ContributorsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('ContributorsPage'); // Ensure this matches your component's name
    }
}

