<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\ResearchMilestone;
use App\Models\ResearchProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilestoneController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | INDEX — list all milestones for a project
    |----------------------------------------------------------------------
    */
    public function index(ResearchProject $project)
    {

        $milestones = ResearchMilestone::where('project_id', $project->id)
            ->withCount('comments')
            ->orderBy('due_date')
            ->get()
            ->groupBy('status');

        return view('portal.milestones.index', compact('project', 'milestones'));
    }

    /*
    |----------------------------------------------------------------------
    | CREATE — show form
    |----------------------------------------------------------------------
    */
    public function create(ResearchProject $project)
    {

        return view('portal.milestones.create', compact('project'));
    }

    /*
    |----------------------------------------------------------------------
    | STORE — save new milestone
    |----------------------------------------------------------------------
    */
    public function store(Request $request, ResearchProject $project)
    {

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status'      => ['required', 'in:todo,in_progress,done'],
            'due_date'    => ['nullable', 'date'],
        ]);

        $milestone = ResearchMilestone::create([
            ...$validated,
            'project_id' => $project->id,
        ]);

        return redirect()
            ->route('milestones.show', $milestone)
            ->with('success', 'Milestone created successfully.');
    }

    /*
    |----------------------------------------------------------------------
    | SHOW — single milestone with comments
    |----------------------------------------------------------------------
    */
    public function show(ResearchMilestone $milestone)
    {
        $user = Auth::user();

        $milestone->load([
            'project.owner',
            'project.collaborators',
            'comments' => fn($q) => $q->with('user')->latest(),
        ]);

        $project = $milestone->project;

        $isOwner        = $project->owner_id === $user->id;
        $isCollaborator = $project->collaborators
            ->where('id', $user->id)
            ->where('pivot.status', 'accepted')
            ->isNotEmpty();

        abort_if(!$isOwner && !$isCollaborator, 403);

        return view('portal.milestones.show', compact(
            'milestone',
            'project',
            'isOwner',
            'isCollaborator'
        ));
    }

    /*
    |----------------------------------------------------------------------
    | EDIT — show edit form
    |----------------------------------------------------------------------
    */
    public function edit(ResearchMilestone $milestone)
    {
        $project = $milestone->project;

        return view('portal.milestones.edit', compact('milestone', 'project'));
    }

    /*
    |----------------------------------------------------------------------
    | UPDATE — save changes
    |----------------------------------------------------------------------
    */
    public function update(Request $request, ResearchMilestone $milestone)
    {

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status'      => ['required', 'in:todo,in_progress,done'],
            'due_date'    => ['nullable', 'date'],
        ]);

        $milestone->update($validated);

        return redirect()
            ->route('milestones.show', $milestone)
            ->with('success', 'Milestone updated successfully.');
    }

    /*
    |----------------------------------------------------------------------
    | UPDATE STATUS — AJAX quick toggle
    |----------------------------------------------------------------------
    */
    public function updateStatus(Request $request, ResearchMilestone $milestone)
    {

        $request->validate([
            'status' => ['required', 'in:todo,in_progress,done'],
        ]);

        $milestone->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'status'  => $milestone->status,
        ]);
    }

    /*
    |----------------------------------------------------------------------
    | DESTROY — delete milestone
    |----------------------------------------------------------------------
    */
    public function destroy(ResearchMilestone $milestone)
    {
        $project = $milestone->project;
        abort_if($project->owner_id !== Auth::id(), 403);

        $milestone->delete();

        return redirect()
            ->route('portal.projects.show', $project)
            ->with('success', 'Milestone deleted.');
    }

    /*
    |----------------------------------------------------------------------
    | PRIVATE — check if user is owner or accepted collaborator
    |----------------------------------------------------------------------
    */
    private function authorizeAccess(ResearchProject $project): void
    {
        $user = Auth::user();

        $isOwner = $project->owner_id === $user->id;

        $isCollaborator = $project->collaborators()
            ->where('users.id', $user->id)
            ->wherePivot('status', 'accepted')
            ->exists();

        abort_if(!$isOwner && !$isCollaborator, 403);
    }
}
