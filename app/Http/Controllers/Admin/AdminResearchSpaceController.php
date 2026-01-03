<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResearchSpace;
use Illuminate\Http\Request;

class AdminResearchSpaceController extends Controller
{
    public function index()
    {
        $researchSpaces = ResearchSpace::withCount('users')->latest()->paginate(10);
        return view('admin.research-space.index', compact('researchSpaces'));
    }

    public function create()
    {
        return view('admin.research-space.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_area' => 'nullable|string',
            'importance' => 'nullable|string',
            'impact' => 'nullable|string',
        ]);

        ResearchSpace::create($request->all());

        return redirect()
            ->route('admin.research_spaces.index')
            ->with('success', 'Research entry created successfully.');
    }

    public function edit(ResearchSpace $researchSpace)
    {
        return view('admin.research-space.edit', compact('researchSpace'));
    }

    public function update(Request $request, ResearchSpace $researchSpace)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_area' => 'nullable|string',
            'importance' => 'nullable|string',
            'impact' => 'nullable|string',
        ]);

        $researchSpace->update($request->all());

        return redirect()
            ->route('admin.research_spaces.index')
            ->with('success', 'Research entry updated successfully.');
    }

    public function destroy(ResearchSpace $researchSpace)
    {
        $researchSpace->delete();

        return back()->with('success', 'Research entry deleted successfully.');
    }

    public function showUsers(ResearchSpace $researchSpace)
    {
        // eager load users
        $users = $researchSpace->users()->get();

        return view('admin.research-space.users', compact('researchSpace', 'users'));
    }
}
