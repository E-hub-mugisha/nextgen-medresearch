<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\MilestoneComment;
use App\Models\ResearchMilestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, ResearchMilestone $milestone)
    {
        $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $comment = $milestone->comments()->create([
            'user_id' => Auth::id(),
            'comment'    => $request->body,
        ]);

        $comment->load('user');

        // Return rendered HTML partial for AJAX
        return response()->json([
            'success' => true,
            'html'    => view(
                'portal.milestones.partials.comment',
                compact('comment')
            )->render(),
        ]);
    }

    public function update(Request $request, MilestoneComment $comment)
    {
        abort_if($comment->user_id !== Auth::id(), 403);

        $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $comment->update(['comment' => $request->body]);

        return response()->json(['success' => true]);
    }

    public function destroy(MilestoneComment $comment)
    {
        abort_if($comment->user_id !== Auth::id(), 403);

        $comment->delete();

        return response()->json(['success' => true]);
    }
}
