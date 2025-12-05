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

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/resources/', $filename);
            $data['file_path'] = $filename;
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

        if ($request->hasFile('file_path')) {

            // delete old file
            if ($resource->file_path && file_exists('uploads/resources/'.$resource->file_path)) {
                unlink('uploads/resources/'.$resource->file_path);
            }

            $file = $request->file('file_path');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/resources/', $filename);
            $data['file_path'] = $filename;
        }

        $resource->update($data);

        return back()->with('success', 'Resource updated successfully!');
    }

    public function destroy(Resource $resource)
    {
        if ($resource->file_path && file_exists('uploads/resources/'.$resource->file_path)) {
            unlink('uploads/resources/'.$resource->file_path);
        }

        $resource->delete();

        return back()->with('success', 'Resource deleted successfully!');
    }
}
