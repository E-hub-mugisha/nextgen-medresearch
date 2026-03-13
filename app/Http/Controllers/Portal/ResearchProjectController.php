<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\ResearchProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResearchProjectController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | INDEX — list all of the user's projects
    |----------------------------------------------------------------------
    */
    public function index()
    {
        $user = Auth::user();

        // Projects the user owns
        $ownedProjects = ResearchProject::where('owner_id', $user->id)
            ->withCount('collaborators', 'milestones')
            ->latest()
            ->get();

        // Projects the user collaborates on
        $collaboratedProjects = ResearchProject::whereHas('collaborators', function ($q) use ($user) {
            $q->where('users.id', $user->id)
                ->where('project_collaborators.status', 'accepted');
        })
            ->withCount('collaborators', 'milestones')
            ->latest()
            ->get();

        return view('portal.projects.index', compact(
            'ownedProjects',
            'collaboratedProjects'
        ));
    }

    /*
    |----------------------------------------------------------------------
    | DISCOVER — browse all open projects
    |----------------------------------------------------------------------
    */
    public function discover(Request $request)
    {
        $user = Auth::user();

        $query = ResearchProject::with('owner.mentorProfile', 'owner.menteeProfile')
            ->withCount('collaborators', 'milestones')
            ->where('owner_id', '!=', $user->id);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by research area
        if ($request->filled('area')) {
            $query->where('research_area', 'like', '%' . $request->area . '%');
        }

        // Search by title or description
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $projects = $query->latest()->paginate(12)->withQueryString();

        $areas = ResearchProject::select('research_area')
            ->distinct()
            ->whereNotNull('research_area')
            ->pluck('research_area');

        return view('portal.projects.discover', compact('projects', 'areas'));
    }

    /*
    |----------------------------------------------------------------------
    | CREATE — show form
    |----------------------------------------------------------------------
    */
    public function create()
    {
        $areas = ResearchProject::select('research_area')
            ->distinct()
            ->whereNotNull('research_area')
            ->pluck('research_area');

        return view('portal.projects.create', compact('areas'));
    }

    /*
    |----------------------------------------------------------------------
    | STORE — save new project
    |----------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => ['required', 'string', 'max:255'],
            'description'   => ['required', 'string'],
            'research_area' => ['nullable', 'string', 'max:255'],
            'status'        => ['required', 'in:active,under review,completed,ongoing'],
            'start_date'    => ['nullable', 'date'],
            'end_date'      => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        $project = ResearchProject::create([
            ...$validated,
            'owner_id' => Auth::id(),
        ]);

        return redirect()
            ->route('portal.projects.show', $project)
            ->with('success', 'Project created successfully.');
    }

    /*
    |----------------------------------------------------------------------
    | SHOW — single project detail
    |----------------------------------------------------------------------
    */
    public function show(ResearchProject $project)
    {
        $user = Auth::user();

        $project->load([
            'owner',
            'collaborators',
            'milestones' => fn($q) => $q->withCount('comments')->orderBy('due_date'),
        ]);

        $isOwner = $project->owner_id === $user->id;

        $isCollaborator = $project->collaborators
            ->where('id', $user->id)
            ->where('pivot.status', 'accepted')
            ->isNotEmpty();

        // ✅ Check if user already has ANY entry (pending, accepted or rejected)
        $hasRequested = $project->collaborators
            ->where('id', $user->id)
            ->isNotEmpty();

        return view('portal.projects.show', compact(
            'project',
            'isOwner',
            'isCollaborator',
            'hasRequested',   // ← make sure this is passed
        ));
    }

    /*
    |----------------------------------------------------------------------
    | EDIT — show edit form
    |----------------------------------------------------------------------
    */
    public function edit(ResearchProject $project)
    {
        // Only the owner can edit
        abort_if($project->owner_id !== Auth::id(), 403);

        $areas = ResearchProject::select('research_area')
            ->distinct()
            ->whereNotNull('research_area')
            ->pluck('research_area');

        return view('portal.projects.edit', compact('project', 'areas'));
    }

    /*
    |----------------------------------------------------------------------
    | UPDATE — save changes
    |----------------------------------------------------------------------
    */
    public function update(Request $request, ResearchProject $project)
    {
        abort_if($project->owner_id !== Auth::id(), 403);

        $validated = $request->validate([
            'title'         => ['required', 'string', 'max:255'],
            'description'   => ['required', 'string'],
            'research_area' => ['nullable', 'string', 'max:255'],
            'status'        => ['required', 'in:active,under review,completed,ongoing'],
            'start_date'    => ['nullable', 'date'],
            'end_date'      => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        $project->update($validated);

        return redirect()
            ->route('portal.projects.show', $project)
            ->with('success', 'Project updated successfully.');
    }

    /*
    |----------------------------------------------------------------------
    | DESTROY — delete project
    |----------------------------------------------------------------------
    */
    public function destroy(ResearchProject $project)
    {
        abort_if($project->owner_id !== Auth::id(), 403);

        $project->delete();

        return redirect()
            ->route('portal.projects.index')
            ->with('success', 'Project deleted.');
    }
}
