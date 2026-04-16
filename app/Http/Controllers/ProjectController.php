<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::query()
            ->latest()
            ->paginate(9);

        return view('pages.projects', compact('projects'));
    }

    public function show(Project $project): View
    {
        $project->load('images');

        $relatedProjects = Project::query()
            ->where('id', '!=', $project->id)
            ->when($project->category, function ($query) use ($project) {
                $query->where('category', $project->category);
            })
            ->latest()
            ->take(3)
            ->get();

        return view('pages.project-single', compact('project', 'relatedProjects'));
    }
}