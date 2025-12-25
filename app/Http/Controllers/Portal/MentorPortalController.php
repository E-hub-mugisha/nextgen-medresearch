<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorPortalController extends Controller
{
    public function index()
    {
        $mentee = Auth::user();

        $requests = $mentee->requestedMentors()
            ->with('mentorProfile')
            ->withPivot('status', 'id')
            ->get();

        return view('portal.mentor.requests', compact('requests'));
    }
    public function mentorProfile(User $mentor)
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

        return view('portal.mentor.mentor-profile', compact('mentor', 'similarMentors'));
    }
    public function cancel($id)
    {
        $user = Auth::user();

        $user->requestedMentors()->detach($id);

        return response()->json([
            'success' => true,
            'message' => 'Mentorship request cancelled successfully'
        ]);
    }
}
