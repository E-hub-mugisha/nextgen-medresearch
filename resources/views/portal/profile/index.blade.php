@extends('layouts.portal')

@section('content')
<div class="container mt-5">

    <div class="row">
        {{-- Profile Sidebar --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm text-center p-4">
                <img src="{{ $mentee->avatar ?? 'https://via.placeholder.com/150' }}" 
                     class="rounded-circle mb-3" width="120" height="120" alt="Avatar">
                <h4 class="fw-bold">{{ $mentee->name }}</h4>
                <p class="text-muted">{{ $mentee->email }}</p>

                @if($mentee->location)
                <p class="text-muted"><i class="fa-solid fa-location-dot me-1"></i>{{ $mentee->location }}</p>
                @endif

                {{-- Edit Profile Button --}}
                <button class="btn btn-gradient-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    Edit Profile
                </button>
            </div>

            {{-- About Section --}}
            <div class="card shadow-sm mt-4 p-3">
                <h5 class="fw-bold mb-2">About</h5>
                <p class="text-muted">{{ $mentee->about ?? 'No bio added yet.' }}</p>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="col-md-8">
            {{-- Mentorship Requests Table --}}
            <div class="card shadow-sm p-3 mb-4">
                <h5 class="fw-bold mb-3">My Mentorship Requests</h5>
                @if($requests->isEmpty())
                    <p class="text-muted">You have not requested any mentorship yet.</p>
                    <a href="{{ route('mentors.list') }}" class="btn btn-gradient-primary btn-sm">
                        Find Mentors
                    </a>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Mentor Name</th>
                                    <th>Expertise</th>
                                    <th>Status</th>
                                    <th>Requested On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requests as $mentor)
                                <tr>
                                    <td>{{ $mentor->name }}</td>
                                    <td>{{ $mentor->mentorProfile->expertise ?? '-' }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($mentor->pivot->status=='pending') bg-warning text-dark
                                            @elseif($mentor->pivot->status=='approved') bg-success
                                            @else bg-danger
                                            @endif">
                                            {{ ucfirst($mentor->pivot->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $mentor->pivot->created_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- Recent Projects --}}
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold mb-3">My Projects</h5>
                @if($projects->isEmpty())
                    <p class="text-muted">No projects added yet.</p>
                    <a href="{{ route('projects.create') }}" class="btn btn-gradient-primary btn-sm">
                        Add Project
                    </a>
                @else
                    <ul class="list-group">
                        @foreach($projects as $project)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-1">{{ $project->title }}</h6>
                                <p class="text-muted mb-0">{{ Str::limit($project->description, 80) }}</p>
                            </div>
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-outline-primary btn-sm">
                                View
                            </a>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Edit Profile Modal --}}
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('mentee.update', $mentee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $mentee->name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $mentee->email }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Location</label>
                            <input type="text" name="location" class="form-control" value="{{ $mentee->location }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Avatar</label>
                            <input type="file" name="avatar" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <label>About</label>
                            <textarea name="about" class="form-control" rows="3">{{ $mentee->about }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-gradient-primary" type="submit">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Styles --}}
<style>
.btn-gradient-primary{
    background: linear-gradient(90deg,#4e54c8,#8f94fb);
    color:#fff;border:none;
}
.btn-gradient-primary:hover{opacity:.9;}
.card{border-radius:15px;}
</style>
@endsection
