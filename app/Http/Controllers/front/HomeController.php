<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Project;
use App\Models\Resource;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('front.home');
    }
    public function about()
    {
        return view('front.about');
    }
    public function contact()
    {
        return view('front.contact');
    }
    public function news()
    {
        $news = Post::where('status', 'published')->paginate(12);
        return view('front.news', compact('news'));
    }
    public function newsDetail($slug)
    {
        $new = Post::where('slug', $slug)->firstOrFail();
        return view('front.news_detail', compact('new'));
    }
    public function mentorshipHub()
    {
        return view('front.mentorship_hub');
    }
    public function researchData()
    {
        return view('front.research_data');
    }
    public function partners()
    {
        $partners = Partner::where('status', 'active')
            ->orderBy('display_order')
            ->get();
        return view('front.partners', compact('partners'));
    }
    public function ourImpact()
    {
        return view('front.our_impact');
    }
    public function projects()
    {
        $projects = Project::where('status', 'published')->paginate(12);
        return view('front.projects', compact('projects'));
    }
    public function projectsDetail($id)
    {
        $project = Project::where('id', $id)->firstOrFail();
        return view('front.projects_detail', compact('project'));
    }
    public function resources()
    {
        $resources = Resource::where('status', 'published')->paginate(12);
        return view('front.resources', compact('resources'));
    }
    public function resourcesDetail($id)
    {
        $resource = Resource::where('id', $id)->firstOrFail();
        return view('front.resources_detail', compact('resource'));
    }
}
