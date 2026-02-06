<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        return view('admin.partners.index', [
            'partners' => Partner::orderBy('display_order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'testimonial'    => 'nullable|string',
            'status'         => 'required|in:active,inactive',
            'display_order'  => 'integer|min:0',
            'logo'           => 'required|image|mimes:png,jpg,jpeg,webp|max:3000',
        ]);

        if ($image = $request->file('logo')) {
            $destinationPath = 'image/partners/';
            $fileName  = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Create folder if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move image to public folder
            $image->move($destinationPath, $fileName);

            // Save relative path in DB
            $data['logo'] = "$fileName";
        }

        Partner::create($data);

        return back()->with('success', 'Partner added successfully.');
    }


    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'testimonial'    => 'nullable|string',
            'status'         => 'required|in:active,inactive',
            'display_order'  => 'integer|min:0',
            'logo'           => 'nullable|image|mimes:png,jpg,jpeg,webp|max:3000',
        ]);

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {

            // Delete old image
            if ($partner->logo && file_exists(public_path($partner->logo))) {
                unlink(public_path($partner->logo));
            }

            $image    = $request->file('logo');
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('partners');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $fileName);

            $data['logo'] = 'partners/' . $fileName;
        }

        $partner->update($data);

        return back()->with('success', 'Partner updated successfully.');
    }


    public function destroy(Partner $partner)
    {
        if ($partner->logo && file_exists(public_path($partner->logo))) {
            unlink(public_path($partner->logo));
        }

        $partner->delete();

        return back()->with('success', 'Partner deleted successfully.');
    }
}
