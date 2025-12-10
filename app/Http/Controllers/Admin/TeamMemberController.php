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

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
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

        if ($request->hasFile('photo')) {
            if ($teamMember->photo) {
                Storage::disk('public')->delete($teamMember->photo);
            }
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        $teamMember->update($data);

        return back()->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $teamMember)
    {
        if ($teamMember->photo) {
            Storage::disk('public')->delete($teamMember->photo);
        }

        $teamMember->delete();
        return back()->with('success', 'Team member deleted.');
    }
}
