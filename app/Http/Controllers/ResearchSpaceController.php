<?php

namespace App\Http\Controllers;

use App\Models\ResearchSpace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResearchSpaceController extends Controller
{
    public function index()
    {
        $researchSpaces = ResearchSpace::withCount('users')->latest()->paginate(10);
        return view('front.research_space', compact('researchSpaces'));
    }

    // list research on portal
    public function listResearchSpaces()
    {
        $researchSpaces = ResearchSpace::withCount('users')->latest()->paginate(10);
        return view('portal.topics.index', compact('researchSpaces'));
    }
    // add method user select research space
    public function selectResearchSpace(ResearchSpace $researchSpace)
    {
        $user = Auth::user();

        // check if user already selected this topic
        if ($user->researchSpaces()->where('research_space_id', $researchSpace->id)->exists()) {
            return back()->with('info', 'You have already selected this topic.');
        }

        // attach user to topic
        $user->researchSpaces()->attach($researchSpace->id);

        return back()->with('success', 'Research topic selected successfully.');
    }

    public function myTopics()
    {
        $user = Auth::user();

        // get topics user has selected
        $topics = $user->researchSpaces()->latest()->get();

        return view('portal.topics.my-topics', compact('topics'));
    }
    public function deselectTopic(ResearchSpace $researchSpace)
    {
        $user = auth()->user();

        // check if user has actually selected the topic
        if (!$user->researchSpaces()->where('research_space_id', $researchSpace->id)->exists()) {
            return back()->with('info', 'You have not selected this topic.');
        }

        // detach the topic from the user
        $user->researchSpaces()->detach($researchSpace->id);

        return back()->with('success', 'Research topic deselected successfully.');
    }
}
