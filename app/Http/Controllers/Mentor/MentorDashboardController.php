<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MentorDashboardController extends Controller
{
    public function dashboard()
    {
        $mentee = auth()->user();
        $requestedMentors = $mentee->requestedMentors()->with('mentorProfile')->get();
        $availableMentors = User::where('role', 'mentor')->with('mentorProfile')->get();

        return view('portal.mentee_dashboard', compact('mentee', 'requestedMentors', 'availableMentors'));
    }

    public function mentorDashboard()
    {
        $mentor = auth()->user();
        $mentorshipRequests = $mentor->requestedBy()->with('menteeProfile')->get();

        return view('portal.mentor_dashboard', compact('mentor', 'mentorshipRequests'));
    }
}
