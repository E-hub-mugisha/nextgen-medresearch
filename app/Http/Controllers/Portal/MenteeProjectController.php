<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResearchProject;
use App\Models\ResearchMilestone;
use App\Models\ProjectCollaborator;
use App\Models\User;
use App\Models\MilestoneComment;
use Illuminate\Support\Facades\Auth;

class MenteeProjectController extends Controller
{
    // Show all projects for the logged-in mentee
    public function index()
    {
        $mentee = Auth::user();
        $projects = ResearchProject::with('milestones', 'collaborators.user')
            ->where('mentee_id', $mentee->id)
            ->get();

        return view('portal.projects.index', compact('projects'));
    }

    // Show single project with milestones
    public function show(ResearchProject $project)
    {
        $project->load('milestones.comments.user', 'collaborators.user');


        // For adding collaborators
        $users = User::where('id', '!=', $project->mentee_id)->get();

        return view('portal.projects.show', compact('project', 'users'));
    }

    // Store new project
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'research_area' => 'required|string',
        ]);

        $project = ResearchProject::create([
            'mentee_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'research_area' => $request->research_area,
            'status' => 'ongoing',
        ]);

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Project created successfully!');
    }

    public function storeMilestone(Request $request, ResearchProject $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        $project->milestones()->create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Milestone added successfully.');
    }

    // Add collaborator
    public function storeCollaborator(Request $request, ResearchProject $project)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string|max:255',
        ]);

        $project->collaborators()->create([
            'user_id' => $request->user_id,
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'Collaborator added successfully.');
    }

    // Add comment to milestone
    public function storeComment(Request $request, ResearchMilestone $milestone)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $milestone->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
