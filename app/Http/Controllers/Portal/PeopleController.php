<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\ResearchInterest;
use App\Models\ResearchProject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{
    public function index(Request $request)
    {
        $user  = Auth::user();

        $query = User::where('id', '!=', $user->id)
            ->with('mentorProfile', 'menteeProfile', 'researchInterests')
            ->withCount('projects');

        // Filter by role tab
        if ($request->filled('role') && in_array($request->role, ['mentor', 'mentee'])) {
            $query->where('role', $request->role);
        }

        // Search by name, expertise, bio
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('mentorProfile', fn($q2) =>
                        $q2->where('expertise', 'like', "%{$search}%")
                           ->orWhere('bio', 'like', "%{$search}%")
                           ->orWhere('organization', 'like', "%{$search}%")
                  )
                  ->orWhereHas('menteeProfile', fn($q2) =>
                        $q2->where('bio', 'like', "%{$search}%")
                           ->orWhere('research_goal', 'like', "%{$search}%")
                  );
            });
        }

        // Filter by research interest
        if ($request->filled('interest')) {
            $query->whereHas('researchInterests', fn($q) =>
                $q->where('research_interests.id', $request->interest)
            );
        }

        // Mentors only — filter by availability
        if ($request->filled('available')) {
            $query->whereHas('mentorProfile', fn($q) =>
                $q->where('available', true)
            );
        }

        $people = $query->paginate(12)->withQueryString();

        // Get the logged-in user's projects to offer
        // "invite to project" with a dropdown
        $myProjects = ResearchProject::where('owner_id', $user->id)
            ->where('status', '!=', 'completed')
            ->get();

        // IDs of users the auth user has already requested
        $requestedIds = DB::table('project_collaborators')
            ->whereIn('project_id', $myProjects->pluck('id'))
            ->where('status', 'pending')
            ->pluck('user_id')
            ->toArray();

        // Research interests for filter dropdown
        $interests = \App\Models\ResearchInterest::orderBy('name')->get();

        return view('portal.people.index', compact(
            'people',
            'myProjects',
            'requestedIds',
            'interests'
        ));
    }

    /*
    |----------------------------------------------------------------------
    | SHOW — own profile
    |----------------------------------------------------------------------
    */
    public function show()
    {
        $user = Auth::user()->load(
            'mentorProfile',
            'menteeProfile',
            'researchInterests',
            'projects',
        );

        $stats = [
            'projects'      => $user->projects()->count(),
            'collaborations'=> $user->collaborations()
                                    ->wherePivot('status', 'accepted')
                                    ->count(),
            'interests'     => $user->researchInterests()->count(),
            'milestones'    => \App\Models\ResearchMilestone::whereHas('project', fn($q) =>
                                    $q->where('owner_id', $user->id)
                                )->where('status', 'done')->count(),
        ];

        $recentProjects = $user->projects()
            ->withCount('collaborators', 'milestones')
            ->latest()
            ->take(4)
            ->get();

        return view('portal.profile.show', compact('user', 'stats', 'recentProjects'));
    }

    /*
    |----------------------------------------------------------------------
    | VIEW ANOTHER USER — public profile
    |----------------------------------------------------------------------
    */
    public function viewUser(User $user)
    {
        $user->load(
            'mentorProfile',
            'menteeProfile',
            'researchInterests',
            'projects',
        );

        $stats = [
            'projects'      => $user->projects()->count(),
            'collaborations'=> $user->collaborations()
                                    ->wherePivot('status', 'accepted')
                                    ->count(),
            'interests'     => $user->researchInterests()->count(),
            'milestones'    => \App\Models\ResearchMilestone::whereHas('project', fn($q) =>
                                    $q->where('owner_id', $user->id)
                                )->where('status', 'done')->count(),
        ];

        $recentProjects = $user->projects()
            ->withCount('collaborators', 'milestones')
            ->latest()
            ->take(4)
            ->get();

        // Check if auth user has already sent a request to any of this user's projects
        $authUser       = Auth::user();
        $isOwnProfile   = $authUser->id === $user->id;

        $myProjects = \App\Models\ResearchProject::where('owner_id', $authUser->id)
            ->where('status', '!=', 'completed')
            ->get();

        return view('portal.profile.show', compact(
            'user',
            'stats',
            'recentProjects',
            'isOwnProfile',
            'myProjects'
        ));
    }

    /*
    |----------------------------------------------------------------------
    | EDIT — show edit form
    |----------------------------------------------------------------------
    */
    public function edit()
    {
        $user = Auth::user()->load(
            'mentorProfile',
            'menteeProfile',
            'researchInterests'
        );

        $interests = ResearchInterest::orderBy('name')->get();

        return view('portal.profile.edit', compact('user', 'interests'));
    }

    /*
    |----------------------------------------------------------------------
    | UPDATE — save changes
    |----------------------------------------------------------------------
    */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Base validation
        $rules = [
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'email', 'unique:users,email,' . $user->id],
            'password'       => ['nullable', 'confirmed', 'min:8'],
            'profile_photo'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'interests'      => ['nullable', 'array'],
        ];

        // Mentor extra rules
        if ($user->role === 'mentor') {
            $rules = array_merge($rules, [
                'bio'                => ['nullable', 'string', 'max:1000'],
                'expertise'          => ['nullable', 'string', 'max:255'],
                'organization'       => ['nullable', 'string', 'max:255'],
                'academic_title'     => ['nullable', 'string', 'max:100'],
                'country'            => ['nullable', 'string', 'max:100'],
                'experience_years'   => ['nullable', 'integer', 'min:0'],
                'max_mentees'        => ['nullable', 'integer', 'min:1'],
                'available'          => ['nullable', 'boolean'],
                'linkedin_url'       => ['nullable', 'url'],
                'google_scholar_url' => ['nullable', 'url'],
            ]);
        } else {
            $rules = array_merge($rules, [
                'bio'             => ['nullable', 'string', 'max:1000'],
                'research_goal'   => ['nullable', 'string', 'max:500'],
                'education_level' => ['nullable', 'string', 'max:100'],
                'institution'     => ['nullable', 'string', 'max:255'],
                'country'         => ['nullable', 'string', 'max:100'],
                'availability'    => ['nullable', 'string', 'max:100'],
            ]);
        }

        $validated = $request->validate($rules);

        // Update base user
        $userData = [
            'name'  => $validated['name'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')
                            ->store('profile-photos', 'public');
            $userData['profile_photo'] = $path;
        }

        $user->update($userData);

        // Update role-specific profile
        if ($user->role === 'mentor') {
            $user->mentorProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'bio'                => $request->bio,
                    'expertise'          => $request->expertise,
                    'organization'       => $request->organization,
                    'academic_title'     => $request->academic_title,
                    'country'            => $request->country,
                    'experience_years'   => $request->experience_years,
                    'max_mentees'        => $request->max_mentees,
                    'available'          => $request->boolean('available'),
                    'linkedin_url'       => $request->linkedin_url,
                    'google_scholar_url' => $request->google_scholar_url,
                ]
            );
        } else {
            $user->menteeProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'bio'             => $request->bio,
                    'research_goal'   => $request->research_goal,
                    'education_level' => $request->education_level,
                    'institution'     => $request->institution,
                    'country'         => $request->country,
                    'availability'    => $request->availability,
                ]
            );
        }

        // Sync research interests
        if ($request->filled('interests')) {
            $user->researchInterests()->sync($request->interests);
        }

        return redirect()
            ->route('portal.profile.show')
            ->with('success', 'Profile updated successfully.');
    }
}
