<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Mail\NewMessageMail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    // Show chat list with all conversations
    public function index()
    {
        $user = Auth::user();

        // Get distinct users this user has exchanged messages with
        $contacts = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->with(['sender', 'receiver'])
            ->get()
            ->map(function ($m) use ($user) {
                return $m->sender_id == $user->id ? $m->receiver : $m->sender;
            })
            ->unique('id');

        return view('portal.messages.index', compact('contacts'));
    }

    // Show conversation with a specific user
    public function show(User $user)
    {
        $auth = Auth::user();

        $contacts = User::where('id', '!=', auth()->id())->get(); // Example: all users except self

        // Set first contact as active chat (or null if no contacts)
        $activeChat = $contacts->first() ?? null;

        $messages = $activeChat
            ? Message::where(function ($q) use ($activeChat) {
                $q->where('sender_id', auth()->id())
                    ->where('receiver_id', $activeChat->id);
            })->orWhere(function ($q) use ($activeChat) {
                $q->where('sender_id', $activeChat->id)
                    ->where('receiver_id', auth()->id());
            })->orderBy('created_at')->get()
            : collect();

        return view('portal.messages.show', compact('user', 'contacts', 'activeChat', 'messages'));
    }

    // Send message
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:1000'
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

        return redirect()
            ->route('messages.show', $user->id)
            ->with('success', 'Message sent successfully.');
    }
}
