<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects.index', [
            'projects' => Project::with('category')->orderBy('display_order')->get()
        ]);
    }

    public function create()
    {
        return view('admin.projects.create', [
            'categories' => Category::where('status', 'active')->get()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5000',
            'project_link' => 'nullable|url|max:255',
            'status' => 'required|in:draft,in_progress,published,archived',
            'featured' => 'boolean',
            'display_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('banner') && $request->file('banner')->isValid()) {

            $image     = $request->file('banner');
            $fileName  = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Destination: public/projects
            $destinationPath = public_path('projects');

            // Create folder if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move image to public folder
            $image->move($destinationPath, $fileName);

            // Save relative path in DB
            $data['banner'] = 'projects/' . $fileName;
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', [
            'project' => $project,
            'categories' => Category::where('status', 'active')->get()
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5000',
            'project_link' => 'nullable|url|max:255',
            'status' => 'required|in:draft,in_progress,published,archived',
            'featured' => 'boolean',
            'display_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('banner') && $request->file('banner')->isValid()) {

            $image     = $request->file('banner');
            $fileName  = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Destination: public/projects
            $destinationPath = public_path('projects');

            // Create folder if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move image to public folder
            $image->move($destinationPath, $fileName);

            // Save relative path in DB
            $data['banner'] = 'projects/' . $fileName;
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->banner && file_exists(public_path($project->banner))) {
            unlink(public_path($project->banner));
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }
}
