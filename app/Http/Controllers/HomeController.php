<?php

namespace App\Http\Controllers;

use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::query()
            ->where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact('featuredProjects'));
    }
}