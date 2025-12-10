<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::latest()->get();
        return view('admin.memberships.index', compact('memberships'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name'    => 'required|string|max:255',
            'email'        => 'required|email',
            'phone'        => 'nullable|string|max:50',
            'type' => 'required|in:individual,trainer,institutional,corporate,honorary',
            'organization' => 'nullable|string|max:255',
            'motivation'   => 'nullable|string',
            'status'       => 'required|in:pending,approved,rejected',
        ]);

        Membership::create($data);

        return back()->with('success', 'Membership added successfully.');
    }

    public function update(Request $request, Membership $membership)
    {
        $data = $request->validate([
            'full_name'    => 'required|string|max:255',
            'email'        => 'required|email',
            'phone'        => 'nullable|string|max:50',
            'type' => 'required|in:individual,trainer,institutional,corporate,honorary',
            'organization' => 'nullable|string|max:255',
            'motivation'   => 'nullable|string',
            'status'       => 'required|in:pending,approved,rejected',
        ]);

        $membership->update($data);

        return back()->with('success', 'Membership updated.');
    }

    public function destroy(Membership $membership)
    {
        $membership->delete();
        return back()->with('success', 'Membership deleted.');
    }
    public function updateStatus(Request $request, Membership $membership)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $membership->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status updated successfully.');
    }
}
