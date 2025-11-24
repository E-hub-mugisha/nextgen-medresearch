<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;

class MembershipController extends Controller
{
    // Show public membership form
    public function create()
    {
        return view('membership.apply');
    }

    // Store application
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:memberships,email',
            'phone'     => 'nullable|string|max:20',
            'type'      => 'required|in:individual,trainer,institutional,corporate,honorary',
            'organization' => 'nullable|string|max:255',
            'motivation'   => 'nullable|string|max:2000',
        ]);

        Membership::create($request->all());

        return back()->with('success', 'Your membership application has been submitted!');
    }

    // Admin: list all applications
    public function index()
    {
        $memberships = Membership::latest()->paginate(15);
        return view('admin.memberships.index', compact('memberships'));
    }

    // Admin: approve or reject
    public function updateStatus(Request $request, Membership $membership)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $membership->update(['status' => $request->status]);

        return back()->with('success', 'Membership status updated.');
    }
}
