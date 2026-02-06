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

        if ($image = $request->file('file_path')) {
            $destinationPath = 'files/resources/';
            $fileName  = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Create folder if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move image to public folder
            $image->move($destinationPath, $fileName);

            // Save relative path in DB
            $data['file_path'] = "$fileName";
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

        if ($image = $request->file('file_path')) {
            $destinationPath = 'files/resources/';
            $fileName  = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Create folder if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move image to public folder
            $image->move($destinationPath, $fileName);

            // Save relative path in DB
            $data['file_path'] = "$fileName";
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
