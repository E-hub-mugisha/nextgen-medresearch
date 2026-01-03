<?php

namespace App\Http\Controllers;

use App\Models\MenteeProfile;
use App\Models\MentorProfile;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ResearchInterest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MentorController extends Controller
{
    public function index($role)
    {
        if (!in_array($role, ['mentee', 'mentor'])) abort(404);

        $researchInterests = ResearchInterest::all();
        return view('onboarding.index', compact('role', 'researchInterests'));
    }
public function registerMentor(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'bio' => 'required|string',
            'expertise' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'experience_years' => 'required|integer|min:0',
            'max_mentees' => 'required|integer|min:1',
        ]);

        // Create the mentor user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => 'mentor',
            'password' => Hash::make($request->input('password')),
        ]);

        // Create mentor profile
        MentorProfile::create([
            'user_id' => $user->id,
            'bio' => $request->input('bio'),
            'expertise' => $request->input('expertise'),
            'organization' => $request->input('organization'),
            'country' => $request->input('country'),
            'experience_years' => $request->input('experience_years'),
            'max_mentees' => $request->input('max_mentees'),
            'available' => $request->has('available'), // checkbox handling
        ]);

        // Log the user in
        auth()->login($user);

        // Return JSON for AJAX
        return response()->json([
            'success' => true,
            'redirect' => route('portal.dashboard'), // redirect after successful registration
        ]);
    }

    public function mentorLists(Request $request)
    {
        $mentee = Auth::user();

        if ($mentee->role !== 'mentee') {
            abort(403, 'Only mentees can view mentors');
        }

        // Get mentee interests IDs
        $menteeInterestIds = $mentee->interests()->pluck('research_interest_id');

        // Fetch mentors that share at least ONE matching interest
        $mentors = User::where('role', 'mentor')
            ->with([
                'mentorProfile',
                'reviews'
            ])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->get();

        // Filter dropdown data
        $expertiseList = MentorProfile::pluck('expertise')->unique();
        $countries = MentorProfile::pluck('country')->unique();

        return view('portal.mentors', compact(
            'mentors',
            'mentee',
            'expertiseList',
            'countries'
        ));
    }

    public function mentorDetails(User $mentor)
    {
        $mentor->load('mentorProfile', 'reviews.mentee');
        $mentor->reviews_avg_rating = $mentor->reviews->avg('rating');
        $mentor->reviews_count = $mentor->reviews->count();

        // Fetch similar mentors: same expertise or at least one shared interest
        $similarMentors = User::where('role', 'mentor')
            ->where('id', '!=', $mentor->id)
            ->where(function ($q) use ($mentor) {
                if ($mentor->mentorProfile->expertise) {
                    $q->whereHas('mentorProfile', fn($q2) => $q2->where('expertise', $mentor->mentorProfile->expertise));
                }
                // Also include mentors with shared research interests
                $interestIds = $mentor->interests()->pluck('research_interest_id');
                if ($interestIds->count() > 0) {
                    $q->orWhereHas('interests', fn($q3) => $q3->whereIn('research_interest_id', $interestIds));
                }
            })
            ->with(['mentorProfile'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->take(10) // limit to 10 similar mentors
            ->get();

        return view('portal.mentor-profile', compact('mentor', 'similarMentors'));
    }

    public function requestMentor(Request $request, $mentorId)
    {
        $user = Auth::user();

        // Prevent duplicate requests
        if (!$user->requestedMentors()->where('mentor_id', $mentorId)->exists()) {
            $user->requestedMentors()->attach($mentorId, ['status' => 'pending']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Mentor requested successfully'
        ]);
    }


    // Show wizard for mentor onboarding
    public function showWizard($role)
    {
        if ($role !== 'mentor') abort(404);

        $researchInterests = ResearchInterest::all();
        return view('onboarding.mentor', compact('researchInterests', 'role'));
    }

    
}
