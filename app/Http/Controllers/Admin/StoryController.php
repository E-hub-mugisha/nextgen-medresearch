<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::latest()->get();
        $categories = Category::where('status', 'active')->get();

        return view('admin.stories.index', compact('stories', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'nullable|string|max:255',
            'title'       => 'required|string|max:255',
            'story'       => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'video_url'   => 'nullable|string|max:255',
            'status'      => 'required|in:draft,published,archived',
            'featured'    => 'boolean',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $image     = $request->file('image');
            $fileName  = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Destination: public/resources
            $destinationPath = public_path('resources');

            // Create folder if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move image to public folder
            $image->move($destinationPath, $fileName);

            // Save relative path in DB
            $data['image'] = 'resources/' . $fileName;
        }

        Story::create($data);

        return back()->with('success', 'Story added successfully.');
    }

    public function update(Request $request, Story $story)
    {
        $data = $request->validate([
            'name'        => 'nullable|string|max:255',
            'title'       => 'required|string|max:255',
            'story'       => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'video_url'   => 'nullable|string|max:255',
            'status'      => 'required|in:draft,published,archived',
            'featured'    => 'boolean',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $image     = $request->file('image');
            $fileName  = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Destination: public/resources
            $destinationPath = public_path('resources');

            // Create folder if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move image to public folder
            $image->move($destinationPath, $fileName);

            // Save relative path in DB
            $data['image'] = 'resources/' . $fileName;
        }

        $story->update($data);

        return back()->with('success', 'Story updated successfully.');
    }

    public function destroy(Story $story)
    {
        if ($story->image && file_exists(public_path($story->image))) {
            unlink(public_path($story->image));
        }

        $story->delete();

        return back()->with('success', 'Story deleted.');
    }

    public function show(Story $story)
    {
        return view('admin.stories.show', compact('story'));
    }
}
