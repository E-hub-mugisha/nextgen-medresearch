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

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $data['logo'] = $request->file('logo')->store('partners', 'public');
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
            $data['logo'] = $request->file('logo')->store('partners', 'public');
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
