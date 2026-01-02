<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Mail\NewMessageMail;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\ResearchProject;
use App\Models\ResearchMilestone;
use App\Models\ProjectCollaborator;
use App\Models\User;
use App\Models\MilestoneComment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class MenteeProjectController extends Controller
{
    // Show all projects for the logged-in mentee
    public function index()
    {
        $mentee = Auth::user();
        $projects = ResearchProject::with('milestones', 'collaborators.user')
            ->where('mentee_id', $mentee->id)
            ->get();

        return view('portal.projects.index', compact('projects'));
    }

    // Show single project with milestones
    public function show(ResearchProject $project)
    {
        $project->load('milestones.comments.user', 'collaborators.user');


        // For adding collaborators
        $users = User::where('id', '!=', $project->mentee_id)->get();

        return view('portal.projects.show', compact('project', 'users'));
    }

    // Store new project
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'research_area' => 'required|string',
        ]);

        $project = ResearchProject::create([
            'mentee_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'research_area' => $request->research_area,
            'status' => 'ongoing',
        ]);

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Project created successfully!');
    }

    public function storeMilestone(Request $request, ResearchProject $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        $project->milestones()->create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Milestone added successfully.');
    }

    // Add collaborator
    public function storeCollaborator(Request $request, ResearchProject $project)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string|max:255',
        ]);

        $project->collaborators()->create([
            'user_id' => $request->user_id,
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'Collaborator added successfully.');
    }

    // Add comment to milestone
    public function storeComment(Request $request, ResearchMilestone $milestone)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $milestone->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    public function storeSend(Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
            'project_id' => 'required|exists:research_projects,id',
            'project_title' => 'required|string|max:255',
            'receiver_id' => 'required|exists:users,id',
        ]);

        Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'body'        => $request->body,
            'project_id'  => $request->project_id,
        ]);

        $projectTitle = $request->project_title;
        // OR: $collab->project->title
        $user = User::find($request->receiver_id);

        if ($user->email) {
            Mail::to($user->email)->send(
                new NewMessageMail(Auth::user(), $request->body, $projectTitle)
            );
        }

        return back()->with('success', 'Message sent successfully');
    }

    public function updateProfile(Request $request, $id)
    {
        $mentee = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $mentee->id,
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $mentee->name = $request->name;
        $mentee->email = $request->email;
        $mentee->location = $request->location;
        $mentee->bio = $request->bio;

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/images'), $fileName);
            $mentee->image = 'uploads/images/' . $fileName;
        }

        $mentee->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function showProfile()
    {
        $mentee = auth()->user();
        $requests = $mentee->requestedMentors ?? collect();
        $projects = ResearchProject::with('milestones', 'collaborators.user')
            ->where('mentee_id', $mentee->id)
            ->get();

        return view('portal.profile.index', compact('mentee', 'requests', 'projects'));
    }
    public function export(ResearchProject $project, Request $request)
    {
        $format = $request->format;

        if ($format === 'pdf') {

            $pdf = Pdf::loadView('exports.project-pdf', [
                'project' => $project,
                'collaborators' => $project->collaborators
            ])->setPaper('A4', 'portrait');

            return $pdf->download($project->title . '.pdf');
        }

        if ($format === 'word') {

            $phpWord = new PhpWord();
            $section = $phpWord->addSection();

            $section->addText($project->title, ['bold' => true, 'size' => 18]);
            $section->addText("Research Area: " . $project->research_area);
            $section->addTextBreak();
            $section->addText($project->description);

            $fileName = $project->title . '.docx';
            $tempFile = tempnam(sys_get_temp_dir(), 'word');

            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save($tempFile);

            return response()->download($tempFile, $fileName)
                ->deleteFileAfterSend(true);
        }

        return back()->with('error', 'Invalid export option selected.');
    }
}
