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

        if($request->hasFile('banner')){
            $file = $request->file('banner');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/projects/', $filename);
            $data['banner'] = $filename;
        }

        Project::create($data);

        return redirect()->route('projects.index')->with('success','Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', [
            'project' => $project,
            'categories' => Category::where('status','active')->get()
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

        if($request->hasFile('banner')){
            if($project->banner && file_exists('uploads/projects/'.$project->banner)){
                unlink('uploads/projects/'.$project->banner);
            }
            $file = $request->file('banner');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/projects/', $filename);
            $data['banner'] = $filename;
        }

        $project->update($data);

        return redirect()->route('projects.index')->with('success','Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if($project->banner && file_exists('uploads/projects/'.$project->banner)){
            unlink('uploads/projects/'.$project->banner);
        }

        $project->delete();

        return redirect()->route('projects.index')->with('success','Project deleted successfully.');
    }
}
