<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
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
        return view('front.news');
    }
    public function newsDetail()
    {
        return view('front.news_detail');
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
        return view('front.partners');
    }
    public function ourImpact()
    {
        return view('front.our_impact');
    }
    
}
