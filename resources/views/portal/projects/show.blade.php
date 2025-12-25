@extends('layouts.portal')
@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>{{ $project->title }}</h3>
        <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary">← Back</a>
    </div>

    <p>{{ $project->description }}</p>
    <p><strong>Research Area:</strong> {{ $project->research_area }}</p>

    <!-- Milestones -->
    <div class="card shadow-sm mb-4 p-3">
        <h5>Milestones
            <button class="btn btn-sm btn-gradient-primary float-end" data-bs-toggle="modal" data-bs-target="#addMilestoneModal">+ Add Milestone</button>
        </h5>
        <ul class="list-group mt-3">
            @foreach($project->milestones as $milestone)
            <li class="list-group-item">
                <strong>{{ $milestone->title }}</strong> <span class="text-muted">({{ ucfirst($milestone->status) }})</span>
                <p>{{ $milestone->description }}</p>
                <small>Due: {{ $milestone->due_date }}</small>

                <!-- Comments -->
                <div class="mt-2">
                    <h6>Comments</h6>
                    <ul class="list-group mb-2">
                        @foreach($milestone->comments as $comment)
                        <li class="list-group-item"><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</li>
                        @endforeach
                    </ul>
                    <form action="{{ route('comments.store', $milestone->id) }}" method="POST" class="d-flex">
                        @csrf
                        <input type="text" name="comment" class="form-control me-2" placeholder="Add comment" required>
                        <button class="btn btn-gradient-primary" type="submit">Send</button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Collaborators -->
    <div class="card shadow-sm mb-4 p-3">
        <h5>Collaborators
            <button class="btn btn-sm btn-gradient-primary float-end" data-bs-toggle="modal" data-bs-target="#addCollaboratorModal">+ Add Collaborator</button>
        </h5>
        <ul class="list-group mt-3">
            @foreach($project->collaborators as $collab)
            <li class="list-group-item">{{ $collab->user->name }} ({{ $collab->role }})</li>
            @endforeach
        </ul>
    </div>
</div>

<!-- Modals -->
<div class="modal fade" id="addMilestoneModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('milestones.store', $project->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Milestone</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3"><label>Title</label><input type="text" name="title" class="form-control" required></div>
                    <div class="mb-3"><label>Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
                    <div class="mb-3"><label>Due Date</label><input type="date" name="due_date" class="form-control" required></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-gradient-primary">Add Milestone</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="addCollaboratorModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('collaborators.store', $project->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Collaborator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>User</label>
                        <select name="user_id" class="form-select" required>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Role</label>
                        <input type="text" name="role" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-gradient-primary">Add Collaborator</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
