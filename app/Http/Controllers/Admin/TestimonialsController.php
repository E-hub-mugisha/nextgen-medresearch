<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'nullable|string|max:255',
            'role'       => 'required|string|max:255',
            'organization'       => 'nullable|string',
            'testimonial' => 'required',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'rating'   => 'nullable|string|max:255',
            'status'      => 'required|in:draft,published',
            'featured'    => 'boolean',
        ]);

        if ($image = $request->file('photo')) {
            $destinationPath = 'image/testimonials/';
            $fileName  = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Create folder if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move image to public folder
            $image->move($destinationPath, $fileName);

            // Save relative path in DB
            $data['photo'] = "$fileName";
        }

        Testimonial::create($data);

        return back()->with('success', 'Testimonial added successfully.');
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name'        => 'nullable|string|max:255',
            'role'       => 'required|string|max:255',
            'organization'       => 'nullable|string',
            'testimonial' => 'required',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'rating'   => 'nullable|string|max:255',
            'status'      => 'required|in:draft,published',
            'featured'    => 'boolean',
        ]);

        if ($image = $request->file('photo')) {
            $destinationPath = 'image/testimonials/';
            $fileName  = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Create folder if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move image to public folder
            $image->move($destinationPath, $fileName);

            // Save relative path in DB
            $data['photo'] = "$fileName";
        }

        $testimonial->update($data);

        return back()->with('success', 'testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->image && file_exists('uploads/testimonials/' . $testimonial->image)) {
            unlink('uploads/testimonials/' . $testimonial->image);
        }

        $testimonial->delete();

        return back()->with('success', 'testimonial deleted.');
    }
}
