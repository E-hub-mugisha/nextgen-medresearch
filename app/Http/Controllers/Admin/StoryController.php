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

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move('uploads/stories/', $filename);
            $data['image'] = $filename;
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

        if ($request->hasFile('image')) {
            if ($story->image && file_exists('uploads/stories/' . $story->image)) {
                unlink('uploads/stories/' . $story->image);
            }

            $filename = time() . '.' . $request->image->extension();
            $request->image->move('uploads/stories/', $filename);
            $data['image'] = $filename;
        }

        $story->update($data);

        return back()->with('success', 'Story updated successfully.');
    }

    public function destroy(Story $story)
    {
        if ($story->image && file_exists('uploads/stories/' . $story->image)) {
            unlink('uploads/stories/' . $story->image);
        }

        $story->delete();

        return back()->with('success', 'Story deleted.');
    }

    public function show(Story $story)
    {
        return view('admin.stories.show', compact('story'));
    }
}
