<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\ResearchProject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollaboratorController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | SEND REQUEST — user requests to join a project
    |----------------------------------------------------------------------
    */
    public function sendRequest(Request $request, ResearchProject $project)
    {
        $user = Auth::user();

        // Owner cannot request to join their own project
        if ($project->owner_id === $user->id) {
            return back()->with('error', 'You cannot request to join your own project.');
        }

        // Check if already a collaborator or request already sent
        $exists = $project->collaborators()
            ->where('users.id', $user->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You have already requested to join this project.');
        }

        // Role comes from the user's registered role
        $project->collaborators()->attach($user->id, [
            'role'   => $user->role,   // ← mentor or mentee from users table
            'status' => 'pending',
        ]);

        return back()->with('success', 'Request sent! Waiting for the owner to accept.');
    }

    /*
    |----------------------------------------------------------------------
    | ACCEPT — owner accepts a collaborator
    |----------------------------------------------------------------------
    */
    public function accept(ResearchProject $project, User $user)
    {
        // Only project owner can accept
        abort_if($project->owner_id !== Auth::id(), 403);

        $project->collaborators()->updateExistingPivot($user->id, [
            'status' => 'accepted',
        ]);

        return back()->with('success', "{$user->name} has been accepted as a collaborator.");
    }

    /*
    |----------------------------------------------------------------------
    | REJECT — owner rejects a collaborator request
    |----------------------------------------------------------------------
    */
    public function reject(ResearchProject $project, User $user)
    {
        abort_if($project->owner_id !== Auth::id(), 403);

        $project->collaborators()->updateExistingPivot($user->id, [
            'status' => 'rejected',
        ]);

        return back()->with('success', "{$user->name}'s request has been rejected.");
    }

    /*
    |----------------------------------------------------------------------
    | REMOVE — owner removes an accepted collaborator
    |----------------------------------------------------------------------
    */
    public function remove(ResearchProject $project, User $user)
    {
        $authUser = Auth::user();

        // Owner can remove anyone, collaborator can remove themselves
        $isOwner = $project->owner_id === $authUser->id;
        $isSelf  = $user->id === $authUser->id;

        abort_if(!$isOwner && !$isSelf, 403);

        $project->collaborators()->detach($user->id);

        if ($isSelf && !$isOwner) {
            return redirect()
                ->route('portal.projects.index')
                ->with('success', 'You have left the project.');
        }

        return back()->with('success', "{$user->name} has been removed from the project.");
    }

    /*
    |----------------------------------------------------------------------
    | INDEX — list all collaborators on a project (AJAX or full page)
    |----------------------------------------------------------------------
    */
    public function index(ResearchProject $project)
    {
        $user = Auth::user();

        abort_if(
            $project->owner_id !== $user->id &&
                !$project->collaborators()->where('users.id', $user->id)->where('project_collaborators.status', 'accepted')->exists(),
            403
        );

        $accepted = $project->collaborators()
            ->wherePivot('status', 'accepted')
            ->orderByPivot('role')
            ->get()
            ->groupBy('pivot.role');  // group by mentor / mentee

        $pending = $project->collaborators()
            ->wherePivot('status', 'pending')
            ->get();

        $rejected = $project->collaborators()
            ->wherePivot('status', 'rejected')
            ->get();

        return view('portal.projects.collaborators', compact(
            'project',
            'accepted',
            'pending',
            'rejected'
        ));
    }

    /*
|----------------------------------------------------------------------
| INVITE — owner directly invites a user to their project
|----------------------------------------------------------------------
*/
    public function invite(ResearchProject $project, User $user)
    {
        $authUser = Auth::user();

        // Only project owner can invite
        abort_if($project->owner_id !== $authUser->id, 403);

        // Check already exists
        $exists = $project->collaborators()
            ->where('users.id', $user->id)
            ->exists();

        if ($exists) {
            return back()->with('error', "{$user->name} is already on this project.");
        }

        $project->collaborators()->attach($user->id, [
            'role'   => $user->role,   // ← use their registered role
            'status' => 'accepted',    // ← owner inviting = auto accepted
        ]);

        return back()->with('success', "{$user->name} has been added to {$project->title}.");
    }
}
