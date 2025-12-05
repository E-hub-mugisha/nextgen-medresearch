<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $image = null;

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image')->store('posts', 'public');
        }

        Post::create([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title),
            'category_id'  => $request->category_id,
            'excerpt'      => $request->excerpt,
            'content'      => $request->content,
            'featured_image' => $image,
            'status'       => $request->status,
            'featured'     => $request->featured ? 1 : 0,
            'publish_at'   => $request->publish_at,
            'created_by'   => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'       => 'required',
            'category_id' => 'required',
        ]);

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image')->store('posts', 'public');
        } else {
            $image = $post->featured_image;
        }

        $post->update([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title),
            'category_id'  => $request->category_id,
            'excerpt'      => $request->excerpt,
            'content'      => $request->content,
            'featured_image' => $image,
            'status'       => $request->status,
            'featured'     => $request->featured ? 1 : 0,
            'publish_at'   => $request->publish_at,
            'updated_by'   => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted!');
    }
}

