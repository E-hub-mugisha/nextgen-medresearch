<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->get();
        $categories = Category::where('status', 'active')->get();
        return view('admin.faqs.index', compact('faqs', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question'      => 'required|string|max:255',
            'answer'        => 'required|string',
            'category'      => 'required|string|max:100',
            'status'        => 'required|in:draft,published',
            'featured'      => 'nullable|boolean',
        ]);

        // Normalize featured value
        $data['featured'] = $request->boolean('featured');

        Faq::create($data);

        return back()->with('success', 'FAQ added successfully.');
    }


    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question'      => 'required|string|max:255',
            'answer'        => 'required|string',
            'category'      => 'required|string|max:100',
            'status'        => 'required|in:draft,published',
            'featured'      => 'nullable|boolean',
        ]);

        $data['featured'] = $request->boolean('featured');

        $faq->update($data);

        return back()->with('success', 'FAQ updated successfully.');
    }


    public function destroy(Faq $faq)
    {

        $faq->delete();

        return back()->with('success', 'faq deleted.');
    }
}
