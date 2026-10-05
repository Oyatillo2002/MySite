<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'github_url' => 'nullable|url|max:255',
            'live_url' => 'nullable|url|max:255',
            'technologies' => 'nullable|array',
            'is_featured' => 'boolean',
        ]);

        // Technologies massivini JSON ga aylantirib saqlash
        $validated['technologies'] = json_encode($validated['technologies'] ?? []);
        
        Project::create($validated);

        return redirect()->route('admin.projects.index')
                        ->with('success', 'Project created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'github_url' => 'nullable|url|max:255',
            'live_url' => 'nullable|url|max:255',
            'technologies' => 'nullable|array',
            'is_featured' => 'boolean',
        ]);

        $validated['technologies'] = json_encode($validated['technologies'] ?? []);

        $project->update($validated);

        return redirect()->route('admin.projects.index')
                        ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
                        ->with('success', 'Project deleted successfully.');
    }
}