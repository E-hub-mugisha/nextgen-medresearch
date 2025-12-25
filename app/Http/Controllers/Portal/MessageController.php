<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Show chat list with all conversations
    public function index() {
        $user = Auth::user();

        // Get distinct users this user has exchanged messages with
        $contacts = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->with(['sender', 'receiver'])
            ->get()
            ->map(function($m) use ($user) {
                return $m->sender_id == $user->id ? $m->receiver : $m->sender;
            })
            ->unique('id');

        return view('portal.messages.index', compact('contacts'));
    }

    // Show conversation with a specific user
    public function show(User $user) {
        $auth = Auth::user();

        $messages = Message::where(function($q) use ($auth, $user) {
                $q->where('sender_id', $auth->id)->where('receiver_id', $user->id);
            })
            ->orWhere(function($q) use ($auth, $user) {
                $q->where('sender_id', $user->id)->where('receiver_id', $auth->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('portal.messages.show', compact('user', 'messages'));
    }

    // Send message
    public function store(Request $request, User $user) {
        $request->validate([
            'body' => 'required|string|max:1000'
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'body' => $request->body
        ]);

        return redirect()->route('messages.show', $user->id);
    }
}
