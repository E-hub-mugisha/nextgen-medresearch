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

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/partners/', $filename);
            $data['logo'] = $filename;
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

        if ($request->hasFile('logo')) {

            // delete old logo
            if ($partner->logo && file_exists('uploads/partners/'.$partner->logo)) {
                unlink('uploads/partners/'.$partner->logo);
            }

            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/partners/', $filename);
            $data['logo'] = $filename;
        }

        $partner->update($data);

        return back()->with('success', 'Partner updated successfully.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo && file_exists('uploads/partners/'.$partner->logo)) {
            unlink('uploads/partners/'.$partner->logo);
        }

        $partner->delete();

        return back()->with('success', 'Partner deleted successfully.');
    }
}
