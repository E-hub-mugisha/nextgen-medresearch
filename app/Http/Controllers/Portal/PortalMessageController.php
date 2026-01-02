<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Mail\NewMessageMail;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PortalMessageController extends Controller
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

    /**
     * Show all contacts and optional active chat
     */
    public function chat(User $user = null)
    {
        $authId = Auth::id();

        // ================== CONTACTS LIST ==================
        // Users who have messages with the authenticated user
        $contacts = User::whereHas('sentMessages', function ($q) use ($authId) {
            $q->where('sender_id', $authId)
              ->orWhere('receiver_id', $authId);
        })
        ->withCount([
            // Count unread messages for this user
            'receivedMessages as unread_count' => function ($q) use ($authId) {
                $q->where('receiver_id', $authId)
                  ->whereNull('read_at');
            }
        ])
        ->get();

        $activeChat = $user;

        $messages = collect();

        if ($user) {
            // ================== MESSAGES FOR SELECTED CHAT ==================
            $messages = Message::where(function ($q) use ($authId, $user) {
                    $q->where('sender_id', $authId)
                      ->where('receiver_id', $user->id);
                })
                ->orWhere(function ($q) use ($authId, $user) {
                    $q->where('sender_id', $user->id)
                      ->where('receiver_id', $authId);
                })
                ->orderBy('created_at')
                ->get();

            // ================== AUTO-MARK MESSAGES AS READ ==================
            Message::where('sender_id', $user->id)
                ->where('receiver_id', $authId)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
        }

        return view('portal.messages.show', compact('contacts', 'activeChat', 'messages'));
    }

    /**
     * Send a message to a user and optionally send an email
     */
    public function send(Request $request, User $user)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
            'project_id' => 'nullable|exists:projects,id', // optional
            'project_title' => 'nullable|string|max:255', // optional for email
        ]);

        $message = Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $user->id,
            'project_id'  => $request->project_id,
            'body'        => $request->body,
        ]);

        // ================== OPTIONAL EMAIL NOTIFICATION ==================
        if ($user->email) {
            Mail::to($user->email)->send(
                new NewMessageMail(Auth::user(), $request->body, $request->project_title ?? null)
            );
        }

        return redirect()
            ->route('messages.chat', $user->id)
            ->with('success', 'Message sent successfully.');
    }
}
