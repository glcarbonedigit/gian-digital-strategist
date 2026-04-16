<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectAdminController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:projects',
            'client_name' => 'nullable',
            'category' => 'nullable',
            'excerpt' => 'nullable',
            'content' => 'nullable',
            'project_url' => 'nullable',
        ]);

        $data['is_featured'] = $request->has('is_featured');

        Project::create($data);

        return redirect()->route('admin.projects');
    }
}