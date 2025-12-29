@extends('layouts.portal')
@section('content')

<div class="container mt-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">{{ $project->title }}</h3>
            <p class="text-muted mb-0">
                <i class="fa-solid fa-flask"></i>
                {{ $project->research_area }}
            </p>
        </div>

        <a href="{{ route('projects.index') }}" class="btn btn-light shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <!-- Project Overview -->
    <div class="card shadow-sm p-4 mb-4 rounded-4">
        <p class="text-muted">{{ $project->description }}</p>

        <div class="d-flex justify-content-between mt-3">
            <small class="text-muted">Created: {{ $project->created_at->format('M d, Y') }}</small>
            <small class="text-muted">Updated: {{ $project->updated_at->diffForHumans() }}</small>
        </div>
    </div>

    <div class="row">
        <!-- Milestones -->
        <div class="col-lg-8">
            <div class="card shadow-sm p-4 rounded-4 mb-4">
                <h5 class="fw-bold mb-3">
                    Milestones
                    <button class="btn btn-sm btn-primary float-end"
                        data-bs-toggle="modal" data-bs-target="#addMilestoneModal">
                        <i class="fa-solid fa-plus"></i> Add Milestone
                    </button>
                </h5>

                @forelse($project->milestones as $milestone)
                <div class="milestone-item mb-4 p-3 rounded-4 border">

                    <div class="d-flex justify-content-between">
                        <h6 class="fw-bold mb-1">{{ $milestone->title }}</h6>

                        <span class="badge 
                            {{ $milestone->status == 'completed' ? 'bg-success' :
                               ($milestone->status == 'ongoing' ? 'bg-primary' : 'bg-warning text-dark') }}">
                            {{ ucfirst($milestone->status) }}
                        </span>
                    </div>

                    <p class="text-muted mb-2">{{ $milestone->description }}</p>

                    <small class="text-muted">
                        <i class="fa-solid fa-calendar"></i>
                        Due: {{ \Carbon\Carbon::parse($milestone->due_date)->format('M d, Y') }}
                    </small>
                    <!-- Progress -->
                    <div class="mt-2">
                        <label class="small text-muted">Progress</label>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: {{ $milestone->progress ?? 0 }}%">
                                {{ $milestone->progress ?? 0 }}%
                            </div>
                        </div>
                    </div>

                    <!-- Attachments -->
                    @if($milestone->attachment)
                    <a href="{{ asset('storage/'.$milestone->attachment) }}" target="_blank" class="btn btn-sm btn-outline-dark mt-2">
                        View Attachment
                    </a>
                    @endif

                    <!-- Actions -->
                    <div class="text-end">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#editMilestoneModal{{ $milestone->id }}">Edit</button>

                        <form action="{{ route('milestones.destroy',$milestone->id) }}"
                            method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Delete this milestone?')">Delete</button>
                        </form>
                    </div>
                    <!-- Edit Milestone Modal -->
                    <div class="modal fade" id="editMilestoneModal{{ $milestone->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="{{ route('milestones.update',$milestone->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5>Edit Milestone</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Title</label>
                                            <input type="text" name="title" value="{{ $milestone->title }}" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control">{{ $milestone->description }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label>Progress (%)</label>
                                            <input type="number" name="progress" value="{{ $milestone->progress ?? 0 }}" class="form-control" min="0" max="100">
                                        </div>

                                        <div class="mb-3">
                                            <label>Attachment</label>
                                            <input type="file" name="attachment" class="form-control">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary">Close</button>
                                        <button class="btn btn-gradient-primary">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>

                    <!-- Comments -->
                    <h6 class="fw-semibold mb-2">Comments</h6>

                    <div class="comment-box mb-2">
                        @forelse($milestone->comments as $comment)
                        <div class="p-2 mb-2 rounded-3 bg-light">
                            <strong>{{ $comment->user->name }}:</strong>
                            <span class="text-muted">{{ $comment->comment }}</span>
                        </div>
                        @empty
                        <p class="text-muted">No comments yet.</p>
                        @endforelse
                    </div>

                    <form action="{{ route('comments.store', $milestone->id) }}"
                        method="POST"
                        class="d-flex">
                        @csrf
                        <input type="text"
                            name="comment"
                            class="form-control rounded-pill me-2"
                            placeholder="Write a comment..."
                            required>
                        <button class="btn btn-primary rounded-pill">
                            Send
                        </button>
                    </form>
                </div>
                @empty
                <p class="text-muted text-center">No milestones yet.</p>
                @endforelse
            </div>
        </div>

        <!-- Collaborators -->
        <div class="col-lg-4">
            <div class="card shadow-sm p-4 rounded-4">
                <h5 class="fw-bold mb-3">
                    Collaborators
                    <button class="btn btn-sm btn-primary float-end"
                        data-bs-toggle="modal"
                        data-bs-target="#addCollaboratorModal">
                        <i class="fa-solid fa-user-plus"></i> Add
                    </button>
                </h5>

                @forelse($project->collaborators as $collab)
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ $collab->user->profile_photo ?? 'https://ui-avatars.com/api/?name='.urlencode($collab->user->name).'&background=0D6EFD&color=fff' }}"
                        class="avatar-lg">

                    <div class="ms-2">
                        <strong>{{ $collab->user->name }}</strong>
                        <p class="text-muted small mb-0">{{ $collab->role }}</p>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#messageModal{{ $collab->id }}">
                            Message
                        </button>

                        <form action="{{ route('collaborators.destroy',$collab->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Remove</button>
                        </form>
                    </div>
                </div>
                <!-- Messaging Modal -->
                <div class="modal fade" id="messageModal{{ $collab->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('messages.send',$collab->user->id) }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>Message {{ $collab->user->name }}</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <textarea name="message" class="form-control" rows="4" placeholder="Type your message..." required></textarea>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary">Close</button>
                                    <button class="btn btn-gradient-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @empty
                <p class="text-muted text-center">No collaborators yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- ================= MODALS ================= -->

<!-- Add Milestone -->
<div class="modal fade" id="addMilestoneModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="{{ route('milestones.store', $project->id) }}" method="POST">
            @csrf
            <div class="modal-content rounded-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Add Milestone</h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body pt-0">
                    <div class="mb-3">
                        <label class="fw-semibold">Title</label>
                        <input type="text" name="title"
                            class="form-control rounded-pill" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Description</label>
                        <textarea name="description"
                            class="form-control rounded-4"
                            rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Due Date</label>
                        <input type="date" name="due_date"
                            class="form-control rounded-pill" required>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button class="btn btn-light"
                        data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Add Milestone</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Add Collaborator -->
<div class="modal fade" id="addCollaboratorModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="{{ route('collaborators.store', $project->id) }}" method="POST">
            @csrf
            <div class="modal-content rounded-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Add Collaborator</h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body pt-0">
                    <div class="mb-3">
                        <label class="fw-semibold">Select User</label>
                        <select name="user_id"
                            class="form-select rounded-pill" required>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Role</label>
                        <input type="text" name="role"
                            class="form-control rounded-pill" required>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button class="btn btn-light"
                        data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Add Collaborator</button>
                </div>
            </div>
        </form>
    </div>
</div>


<style>
    .card {
        border-radius: 18px;
    }

    .milestone-item:hover {
        background: #f8faff;
        transition: .3s;
    }

    .avatar-lg {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #fff;
    }
</style>

@endsection