<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ResearchInterest;
use App\Models\ResearchProject;
use Illuminate\Support\Facades\DB;

class ResearchInterestController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | INDEX — browse all topics, grouped by category
    |----------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $user = Auth::user();

        // IDs the user already follows
        $myIds = $user->researchInterests()->pluck('research_interests.id')->toArray();

        $query = ResearchInterest::withCount('users as followers_count');

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Only mine
        if ($request->boolean('mine')) {
            $query->whereIn('id', $myIds);
        }

        $topics = $query->orderBy('category')->orderBy('name')->get()
            ->groupBy('category');

        $categories = ResearchInterest::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('portal.interests.index', compact(
            'topics',
            'categories',
            'myIds',
        ));
    }

    /*
    |----------------------------------------------------------------------
    | TOGGLE — follow / unfollow a topic (AJAX)
    |----------------------------------------------------------------------
    */
    public function toggle(ResearchInterest $interest)
    {
        $user = Auth::user();

        $result = $user->researchInterests()->toggle($interest->id);

        $following = count($result['attached']) > 0;

        // Update follower count
        $interest->loadCount('users as followers_count');

        return response()->json([
            'success'   => true,
            'following' => $following,
            'count'     => $interest->followers_count,
        ]);
    }

    /*
    |----------------------------------------------------------------------
    | SYNC — bulk save from profile edit (non-AJAX)
    |----------------------------------------------------------------------
    */
    public function sync(Request $request)
    {
        $request->validate([
            'interests'   => ['nullable', 'array'],
            'interests.*' => ['exists:research_interests,id'],
        ]);

        Auth::user()->researchInterests()->sync(
            $request->interests ?? []
        );

        return back()->with('success', 'Research interests updated.');
    }

    /*
|----------------------------------------------------------------------
| PROJECTS — view all projects under a research topic
|----------------------------------------------------------------------
*/
    public function projects(Request $request, ResearchInterest $interest)
    {
        $user = Auth::user();

        $query = ResearchProject::where('research_area', $interest->name)
            ->with('owner.mentorProfile', 'collaborators')
            ->withCount('collaborators', 'milestones');

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Sort
        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'oldest'        => $query->oldest(),
            'collaborators' => $query->orderByDesc('collaborators_count'),
            'milestones'    => $query->orderByDesc('milestones_count'),
            default         => $query->latest(),
        };

        $projects = $query->paginate(12)->withQueryString();

        // IDs of projects where auth user already has a request/membership
        $myProjectIds = DB::table('project_collaborators')
            ->where('user_id', $user->id)
            ->pluck('project_id')
            ->toArray();

        // Related topics (same category)
        $relatedTopics = ResearchInterest::where('category', $interest->category)
            ->where('id', '!=', $interest->id)
            ->withCount('users as followers_count')
            ->orderByDesc('followers_count')
            ->take(6)
            ->get();

        // Is user following this topic
        $isFollowing = $user->researchInterests()
            ->where('research_interests.id', $interest->id)
            ->exists();

        // Stats
        $stats = [
            'total'     => ResearchProject::where('research_area', $interest->name)->count(),
            'active'    => ResearchProject::where('research_area', $interest->name)->where('status', 'active')->count(),
            'followers' => $interest->loadCount('users')->users_count,
        ];

        return view('portal.interests.projects', compact(
            'interest',
            'projects',
            'myProjectIds',
            'relatedTopics',
            'isFollowing',
            'stats',
        ));
    }
}
