<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\ResearchMilestone;
use App\Models\ResearchProject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Projects the user owns
        $myProjects = ResearchProject::where('owner_id', $user->id)
            ->withCount('collaborators', 'milestones')
            ->latest()
            ->take(5)
            ->get();

        // ✅ Correct — use research_projects
        $pendingRequests = DB::table('project_collaborators')
            ->join('users', 'users.id', '=', 'project_collaborators.user_id')
            ->join('research_projects', 'research_projects.id', '=', 'project_collaborators.project_id')
            ->where('research_projects.owner_id', $user->id)
            ->where('project_collaborators.status', 'pending')
            ->select(
                'users.id as user_id',
                'users.name',
                'research_projects.id as project_id',
                'research_projects.title as project_title',
                'project_collaborators.role'
            )
            ->take(5)
            ->get();

        // Upcoming milestones across all projects the user is part of
        $upcomingMilestones = ResearchMilestone::whereHas('project', function ($q) use ($user) {
            $q->where('owner_id', $user->id)
                ->orWhereHas('collaborators', fn($q2) => $q2->where('users.id', $user->id)
                    ->where('project_collaborators.status', 'accepted'));
        })
            ->whereIn('status', ['todo', 'in_progress'])
            ->orderBy('due_date')
            ->take(5)
            ->get();

        // Suggested mentors or mentees depending on role
        $suggested = User::where('id', '!=', $user->id)
            ->where('role', $user->role === 'mentee' ? 'mentor' : 'mentee')
            ->with($user->role === 'mentee' ? 'mentorProfile' : 'menteeProfile')
            ->take(4)
            ->get();

        // Stats
        $stats = [
            'projects'     => ResearchProject::where('owner_id', $user->id)->count(),
            'collaborators' => DB::table('project_collaborators')
                ->whereIn('project_id', $myProjects->pluck('id'))
                ->where('status', 'accepted')
                ->count(),
            'milestones_done' => ResearchMilestone::whereHas('project', fn($q) => $q->where('owner_id', $user->id))
                ->where('status', 'done')
                ->count(),
            'open_requests' => $pendingRequests->count(),
        ];

        return view('portal.dashboard.index', compact(
            'user',
            'myProjects',
            'pendingRequests',
            'upcomingMilestones',
            'suggested',
            'stats'
        ));
    }
}
