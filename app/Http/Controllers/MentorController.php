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

class MentorController extends Controller
{
    public function index($role)
    {
        if (!in_array($role, ['mentee', 'mentor'])) abort(404);

        $researchInterests = ResearchInterest::all();
        return view('onboarding.index', compact('role', 'researchInterests'));
    }

    // Save step data in session
    public function saveStep(Request $request)
    {
        $step = $request->step;

        switch ($step) {
            case 1:
                $request->validate([
                    'name' => 'required|string',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:6|confirmed'
                ]);
                Session::put('onboarding.name', $request->name);
                Session::put('onboarding.email', $request->email);
                Session::put('onboarding.password', $request->password);
                break;

            case 2:
                $request->validate([
                    'interests' => 'required|array|min:1'
                ]);
                Session::put('onboarding.interests', $request->interests);
                break;

            case 3:
                $request->validate([
                    'bio' => 'required|string',
                    'research_goal' => 'required|string',
                    'education_level' => 'required|string',
                ]);
                Session::put('onboarding.bio', $request->bio);
                Session::put('onboarding.research_goal', $request->research_goal);
                Session::put('onboarding.education_level', $request->education_level);
                break;
        }

        return response()->json(['success' => true]);
    }

    // Final registration
    public function registerUser(Request $request)
    {
        $data = Session::get('onboarding');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $request->role,
            'password' => Hash::make($data['password']),
        ]);

        MenteeProfile::create([
            'user_id' => $user->id,
            'research_goals' => $data['research_goal'] ?? null,
            'education_level' => $data['education_level'] ?? null,
        ]);

        // Save interests if mentee
        if ($user->role == 'mentee' && !empty($data['interests'])) {
            $user->interests()->sync($data['interests']);
        }


        auth()->login($user);
        Session::forget('onboarding');

        $redirect = $user->role == 'mentee'
            ? route('mentors.list', ['user' => $user->id])
            : route('home');
        return response()->json(['success' => true, 'redirect' => $redirect]);
    }

    public function mentorLists(Request $request)
    {
        $mentee = Auth::user();

        if ($mentee->role !== 'mentee') {
            abort(403, 'Only mentees can view mentors');
        }

        // Fetch mentors who have at least one matching interest
        $mentors = User::where('role', 'mentor')
            ->get();

        // Get already requested mentors

        return view('portal.mentors', compact('mentors','mentee'));
    }

    // Request mentorship
    public function requestMentor(Request $request)
    {
        $user = Auth::user();

        // Prevent duplicate requests
        if (!$user->requestedMentors()->where('mentor_id', $request->mentor_id)->exists()) {
            $user->requestedMentors()->attach($request->mentor_id, ['status' => 'pending']);
        }

        return response()->json(['success' => true, 'message' => 'Mentor requested successfully']);
    }

    // Show wizard for mentor onboarding
    public function showWizard($role)
    {
        if ($role !== 'mentor') abort(404);

        $researchInterests = ResearchInterest::all();
        return view('onboarding.mentor', compact('researchInterests', 'role'));
    }

    // Save step data in session
    public function saveStepMentor(Request $request)
    {
        $step = $request->step;

        switch ($step) {
            case 1:
                $request->validate([
                    'name' => 'required|string',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:6|confirmed'
                ]);
                Session::put('onboarding.name', $request->name);
                Session::put('onboarding.email', $request->email);
                Session::put('onboarding.password', $request->password);
                break;

            case 2:
                $request->validate([
                    'interests' => 'required|array|min:1'
                ]);
                Session::put('onboarding.interests', $request->interests);
                break;

            case 3:
                $request->validate([
                    'bio' => 'nullable|string',
                    'institution' => 'nullable|string',
                ]);
                Session::put('onboarding.bio', $request->bio);
                Session::put('onboarding.institution', $request->institution);
                break;
        }

        return response()->json(['success' => true]);
    }

    // Final registration of mentor
    public function registerMentor(Request $request)
    {
        $data = Session::get('mentor_onboarding');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => 'mentor',
            'password' => Hash::make($data['password']),
        ]);

        MentorProfile::create([
            'user_id' => $user->id,
            'bio' => $data['bio'] ?? null,
            'institution' => $data['institution'] ?? null,
        ]);

        if (!empty($data['interests'])) {
            $user->interests()->sync($data['interests']);
        }

        auth()->login($user);
        Session::forget('mentor_onboarding');

        return response()->json(['success' => true, 'redirect' => route('home')]);
    }
}
