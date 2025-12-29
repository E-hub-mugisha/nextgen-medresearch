<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\ResearchProject;
use App\Models\User;
use Illuminate\Http\Request;

class MentorDashboardController extends Controller
{
    public function dashboard()
    {
        $mentee = auth()->user();
        $requestedMentors = $mentee->requestedMentors()->with('mentorProfile')->get();
        $availableMentors = User::where('role', 'mentor')->with('mentorProfile')->get();

        $stats = [
            'total_requests' => $requestedMentors->count(),
            'pending' => $requestedMentors->where('pivot.status', 'pending')->count(),
            'approved' => $requestedMentors->where('pivot.status', 'approved')->count(),
            'rejected' => $requestedMentors->where('pivot.status', 'rejected')->count(),
        ];

        $chart = [
            'months' => ['Jan', 'Feb', 'Mar', 'Apr'],
            'requests' => [2, 5, 3, 7],

            'expertiseLabels' => ['AI', 'Medicine', 'Data Science', 'Engineering', 'Other'],
            'expertiseData' => [4, 2, 3, 1, 2]
        ];

        $projects = ResearchProject::with('milestones', 'collaborators.user')
            ->where('mentee_id', $mentee->id)
            ->get();
        $analytics = [
            'request_months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            'request_counts' => [2, 5, 3, 7, 6],

            'projects' => $projects->pluck('title'), // Collection of project titles
            'milestones_progress' => $projects->map(function ($project) {
                // Average milestone completion per project
                $total = $project->milestones->count();
                if ($total == 0) return 0;
                $sum = $project->milestones->sum('progress');
                return round($sum / $total);
            })
        ];

        return view('portal.mentee_dashboard', compact('mentee', 'requestedMentors', 'availableMentors', 'stats', 'chart', 'analytics'));
    }

    public function mentorDashboard()
    {
        $mentor = auth()->user();
        $mentorshipRequests = $mentor->requestedBy()->with('menteeProfile')->get();

        return view('portal.mentor_dashboard', compact('mentor', 'mentorshipRequests'));
    }
    
}
