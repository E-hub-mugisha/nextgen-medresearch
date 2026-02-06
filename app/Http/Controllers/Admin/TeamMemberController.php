<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::latest()->get();
        return view('admin.team.index', compact('members'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'position'      => 'required|string|max:255',
            'bio'           => 'nullable|string',
            'email'         => 'nullable|email',
            'phone'         => 'nullable|string|max:30',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'facebook'      => 'nullable|url',
            'twitter'       => 'nullable|url',
            'linkedin'      => 'nullable|url',
            'status'        => 'required|in:active,inactive',
        ]);

        if ($image = $request->file('photo')) {
            $destinationPath = 'image/team/';
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

        TeamMember::create($data);

        return back()->with('success', 'Team member added successfully.');
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'position'      => 'required|string|max:255',
            'bio'           => 'nullable|string',
            'email'         => 'nullable|email',
            'phone'         => 'nullable|string|max:30',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'facebook'      => 'nullable|url',
            'twitter'       => 'nullable|url',
            'linkedin'      => 'nullable|url',
            'status'        => 'required|in:active,inactive',
        ]);

        if ($image = $request->file('photo')) {
            $destinationPath = 'image/team/';
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

        $teamMember->update($data);

        return back()->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $teamMember)
    {
        if ($teamMember->photo) {
            unlink(public_path($teamMember->photo));
        }

        $teamMember->delete();
        return back()->with('success', 'Team member deleted.');
    }
}
