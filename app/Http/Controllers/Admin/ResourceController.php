<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\Category;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index()
    {
        return view('admin.resources.index', [
            'resources' => Resource::with('category')->get(),
            'categories' => Category::where('status', 'active')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'description'   => 'nullable|string',
            'file_path'     => 'nullable|file|max:50000',
            'status'        => 'required|string',
        ]);

        if ($request->hasFile('file_path') && $request->file('file_path')->isValid()) {
            $data['file_path'] = $request
                ->file('file_path')
                ->store('resources', 'public');
        }

        Resource::create($data);

        return back()->with('success', 'Resource added successfully!');
    }

    public function update(Request $request, Resource $resource)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'description'   => 'nullable|string',
            'file_path'     => 'nullable|file|max:50000',
            'status'        => 'required|string',
        ]);

        if ($request->hasFile('file_path') && $request->file('file_path')->isValid()) {
            $data['file_path'] = $request
                ->file('file_path')
                ->store('resources', 'public');
        }

        $resource->update($data);

        return back()->with('success', 'Resource updated successfully!');
    }

    public function destroy(Resource $resource)
    {
        $resource->delete();

        return back()->with('success', 'Resource deleted successfully!');
    }
}
