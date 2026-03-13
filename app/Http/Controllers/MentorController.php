<?php

namespace App\Http\Controllers;

use App\Models\MenteeProfile;
use App\Models\MentorProfile;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ResearchInterest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MentorController extends Controller
{
    public function showForm(Request $request)
    {
        // Validate the role query param — default to mentee if missing or invalid
        $role = in_array($request->query('role'), ['mentor', 'mentee'])
            ? $request->query('role')
            : 'mentee';

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
            'redirect' => route('portal.dashboard.index'), // redirect after successful registration
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

    public function registerUser(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'role'            => 'required|in:mentee',
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'password'        => ['required', 'confirmed', Password::min(8)],
            'bio'             => 'nullable|string',
            'research_goal'   => 'nullable|string|max:255',
            'education_level' => 'nullable|string|max:255',
            'interests'       => 'nullable|array',
            'interests.*'     => 'string|max:255',
        ]);

        // 1️⃣ Create User
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'mentee',
        ]);

        // 2️⃣ Create Mentee Profile
        MenteeProfile::create([
            'user_id'         => $user->id,
            'bio'             => $validated['bio'] ?? null,
            'research_goals'  => $validated['research_goal'] ?? null,
            'education_level' => $validated['education_level'] ?? null,
        ]);

        // 3️⃣ Handle Interests (auto-create)
        if (!empty($validated['interests'])) {
            $interestIds = [];

            foreach ($validated['interests'] as $name) {
                $interest = ResearchInterest::firstOrCreate(['name' => $name]);
                $interestIds[] = $interest->id;
            }

            $user->researchInterests()->sync($interestIds);
        }

        // 4️⃣ Auto Login
        auth()->login($user);


        return response()->json([
            'success'  => true,
            'redirect' => route('portal.dashboard'),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | HANDLE REGISTRATION (AJAX)
    | POST /register
    |--------------------------------------------------------------------------
    */
    public function register(Request $request)
    {
        // ── 1. Base validation (shared by both roles) ─────────────────────
        $rules = [
            'role'              => ['required', 'in:mentor,mentee'],
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'email', 'unique:users,email'],
            'password'          => ['required', 'confirmed', Password::min(8)],
            'bio'               => ['nullable', 'string', 'max:1000'],
            'research_goal'     => ['nullable', 'string', 'max:500'],
            'education_level'   => ['nullable', 'string', 'max:100'],
            'country'           => ['nullable', 'string', 'max:100'],
            'interests'         => ['nullable', 'array'],
            'interests.*'       => ['nullable'],
        ];

        // ── 2. Extra validation for mentors only ──────────────────────────
        if ($request->role === 'mentor') {
            $rules = array_merge($rules, [
                'expertise'          => ['required', 'string', 'max:255'],
                'organization'       => ['required', 'string', 'max:255'],
                'academic_title'     => ['nullable', 'string', 'max:100'],
                'experience_years'   => ['required', 'integer', 'min:0', 'max:60'],
                'max_mentees'        => ['required', 'integer', 'min:1', 'max:100'],
                'available'          => ['nullable', 'boolean'],
                'linkedin_url'       => ['nullable', 'url', 'max:255'],
                'google_scholar_url' => ['nullable', 'url', 'max:255'],
            ]);
        }

        $validated = $request->validate($rules);


        // ── 3. Create the user ────────────────────────────────────────────
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);


        // ── 4. Create the role-specific profile ───────────────────────────
        if ($validated['role'] === 'mentor') {

            MentorProfile::create([
                'user_id'            => $user->id,
                'bio'                => $validated['bio']               ?? null,
                'expertise'          => $validated['expertise'],
                'organization'       => $validated['organization'],
                'academic_title'     => $validated['academic_title']    ?? null,
                'country'            => $validated['country']           ?? null,
                'experience_years'   => $validated['experience_years'],
                'max_mentees'        => $validated['max_mentees'],
                'available'          => $request->boolean('available'),
                'linkedin_url'       => $validated['linkedin_url']       ?? null,
                'google_scholar_url' => $validated['google_scholar_url'] ?? null,
            ]);

        } else {

            MenteeProfile::create([
                'user_id'         => $user->id,
                'bio'             => $validated['bio']             ?? null,
                'research_goal'   => $validated['research_goal']   ?? null,
                'education_level' => $validated['education_level'] ?? null,
                'country'         => $validated['country']         ?? null,
            ]);

        }


        // ── 5. Attach research interests ──────────────────────────────────
        if (!empty($validated['interests'])) {

            $existingIds = [];
            $customNames = [];

            foreach ($validated['interests'] as $value) {
                // Numeric = existing ResearchInterest ID from DB
                if (is_numeric($value)) {
                    $existingIds[] = (int) $value;

                // Prefixed with "custom_" = user typed it manually
                } elseif (str_starts_with($value, 'custom_')) {
                    $label = trim(str_replace('custom_', '', $value));
                    if ($label) $customNames[] = $label;
                }
            }

            // Sync existing interests
            if ($existingIds) {
                $user->researchInterests()->sync($existingIds);
            }

            // Create and attach custom interests
            foreach ($customNames as $name) {
                $interest = ResearchInterest::firstOrCreate(
                    ['slug' => \Illuminate\Support\Str::slug($name)],
                    ['name' => $name]
                );
                $user->researchInterests()->syncWithoutDetaching([$interest->id]);
            }
        }


        // ── 6. Log the user in ────────────────────────────────────────────
        Auth::login($user);


        // ── 7. Return JSON response for the AJAX form ─────────────────────
        return response()->json([
            'success'  => true,
            'message'  => 'Account created successfully.',
            'redirect' => route('dashboard'),
        ], 201);
    }
}
