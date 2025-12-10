<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Post;
use App\Models\Project;
use App\Models\RescueSheet;
use App\Models\Research;
use App\Models\Resource;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $researches = Research::latest()->take(5)->get();
        $projects = Project::latest()->take(5)->get();
        $memberships = Membership::latest()->take(5)->get();
        $posts = Post::latest()->take(5)->get();
        $resources = Resource::latest()->take(5)->get();
        $totalRescue = RescueSheet::count();
        $totalRescueScan = RescueSheet::sum('scan_count');
        return view('admin.dashboard.index', compact('researches', 'projects', 'memberships', 'posts', 'resources', 'totalRescue', 'totalRescueScan'));
    }
}
