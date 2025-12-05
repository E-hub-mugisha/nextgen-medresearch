<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::orderBy('display_order')->get();

        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 'active')->get();

        return view('admin.programs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'description'   => 'nullable|string',
            'icon'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'        => 'required|string|in:draft,published,archived',
            'featured'      => 'boolean',
            'display_order' => 'integer|min:0',
        ]);

        // Slug
        $data['slug'] = Str::slug($request->title);

        // Upload icon
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/programs/', $filename);
            $data['icon'] = $filename;
        }

        Program::create($data);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        $categories = Category::where('status', 'active')->get();

        return view('admin.programs.edit', compact('program', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'description'   => 'nullable|string',
            'icon'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'        => 'required|in:draft,published,archived',
            'featured'      => 'boolean',
            'display_order' => 'integer|min:0',
        ]);

        // Update slug only if title changed
        if ($program->title !== $request->title) {
            $data['slug'] = Str::slug($request->title);
        }

        // Handle icon upload
        if ($request->hasFile('icon')) {

            // delete old icon
            if ($program->icon && file_exists('uploads/programs/' . $program->icon)) {
                unlink('uploads/programs/' . $program->icon);
            }

            $file = $request->file('icon');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/programs/', $filename);
            $data['icon'] = $filename;
        }

        $program->update($data);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        // soft delete
        $program->delete();

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program deleted successfully.');
    }
}
