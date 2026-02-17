<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use App\Models\Faq;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Program;
use App\Models\Project;
use App\Models\Research;
use App\Models\Resource;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function home()
    {
        $news = Post::where('status', 'published')->take(3)->get();
        $programs = Program::where('status', 'published')->orderBy('display_order')->get();
        $researches = Research::where('status', 'published')->get();
        $faqs = Faq::where('status', 'published')->orderBy('display_order')->get();
        $testimonials = Testimonial::where('status', 'published')->get();
        return view('front.home', compact('news', 'programs', 'researches', 'faqs', 'testimonials'));
    }
    public function about()
    {
        $faqs = Faq::where('status', 'published')->orderBy('display_order')->get();
        return view('front.about', compact('faqs'));
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

    public function programs()
    {
        $programs = \App\Models\Program::where('status', 'published')->orderBy('title')->get();

        return view('front.programs', compact('programs'));
    }
    public function programsDetail($slug)
    {
        $program = Program::where('slug', $slug)->firstOrFail();
        return view('front.program-details', compact('program'));
    }
    public function faqPage()
    {
        $faqs = Faq::where('status', 'published')
            ->orderBy('display_order')
            ->get()
            ->groupBy('category');

        return view('front.faq', compact('faqs'));
    }

    public function research()
    {
        $researches = Research::where('status', 'published')->paginate(12);
        return view('front.research', compact('researches'));
    }
    public function researchDetail($slug)
    {
        $research = Research::where('slug', $slug)->firstOrFail();
        return view('front.research-details', compact('research'));
    }
    public function storeQuestion(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:2000',
            'category' => 'required|string|max:255',
            'title' => 'required|string'
        ]);

        Faq::create([
            'title' => $request->input('title'),
            'question' => $request->input('question'),
            'category' => $request->input('category'),
            'status' => 'draft',
        ]);

        return redirect()->route('faq.page')->with('success', 'Your question has been submitted successfully. We will get back to you soon.');
    }
    public function space()
    {
        return view('front.research_space');
    }

    public function send(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        $data = $request->only('fname', 'lname', 'email', 'phone', 'message');

        Mail::send(new ContactFormMail($data));

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your message has been sent.'
        ]);
    }

    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email'   => 'required|email',
        ]);

        // Send notification email
        Mail::raw(
            "New newsletter subscription:\n\nEmail: {$validated['email']}",
            function ($message) {
                $message->to('info@nextgenmedresearch.org')
                    ->subject('New Newsletter Subscription');
            }
        );

       return back()->with('success', 'Thank you for subscribing!');
    }
}
