<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Research;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResearchController extends Controller
{
    public function index()
    {
        $research = Research::latest()->paginate(10);
        return view('admin.research.index', compact('research'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.research.create', compact('categories'));
    }
    // app/Http/Controllers/Admin/ResearchController.php

    public function show(Research $research)
    {
        return view('admin.research.show', compact('research'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'document' => 'nullable|file|mimes:pdf,doc,docx',
            'featured_image' => 'nullable|image'
        ]);

        $slug = Str::slug($request->title);

        $data = $request->all();
        $data['slug'] = $slug;
        $data['created_by'] = auth()->id();

        if ($request->hasFile('document')) {
            $data['document'] = $request->file('document')->store('research/docs', 'public');
        }

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('research/images', 'public');
        }

        Research::create($data);

        return redirect()->route('admin.research.index')->with('success', 'Research created successfully');
    }

    public function edit(Research $research)
    {
        $categories = Category::all();
        return view('admin.research.edit', compact('research', 'categories'));
    }

    public function update(Request $request, Research $research)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'document' => 'nullable|file|mimes:pdf,doc,docx',
            'featured_image' => 'nullable|image'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['updated_by'] = auth()->id();

        if ($request->hasFile('document')) {
            $data['document'] = $request->file('document')->store('research/docs', 'public');
        }

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('research/images', 'public');
        }

        $research->update($data);

        return redirect()->route('admin.research.index')->with('success', 'Research updated successfully');
    }

    public function destroy(Research $research)
    {
        $research->delete();
        return redirect()->route('admin.research.index')->with('success', 'Research deleted successfully');
    }
}
