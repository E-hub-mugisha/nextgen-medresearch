@extends('layouts.app')
@section('title','Team Members')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Team Members</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
        <i class="mdi mdi-plus"></i> Add Member
    </button>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>There were some errors:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($members as $member)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{asset('image/team')}}/{{ $member->photo ? $member->photo : 'default-avatar.png' }}"
                             class="rounded-circle border" width="50" height="50" style="object-fit:cover;">
                    </td>
                    <td class="fw-semibold">{{ $member->name }}</td>
                    <td>{{ $member->position }}</td>
                    <td>
                        <small>{{ $member->email ?? '-' }}</small><br>
                        <small>{{ $member->phone ?? '-' }}</small>
                    </td>
                    <td>
                        <span class="badge bg-{{ $member->status=='active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($member->status) }}
                        </span>
                    </td>
                    <td class="text-end">

                        <!-- View -->
                        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#viewModal{{ $member->id }}">
                            View
                        </button>

                        <!-- Edit -->
                        <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editModal{{ $member->id }}">
                            Edit
                        </button>

                        <!-- Delete -->
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $member->id }}">
                            Delete
                        </button>
                    </td>
                </tr>

                <!-- View Modal -->
                <div class="modal fade" id="viewModal{{ $member->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content rounded-4">
                            <div class="modal-header">
                                <h5 class="modal-title">Team Member Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="{{ $member->photo ? asset($member->photo) : asset('images/default-avatar.png') }}"
                                     class="rounded-circle mb-3" width="120" height="120" style="object-fit:cover;">
                                <h4>{{ $member->name }}</h4>
                                <p class="text-muted">{{ $member->position }}</p>
                                <p>{{ $member->bio ?? 'No bio available.' }}</p>

                                <div class="d-flex justify-content-center gap-3">
                                    @if($member->facebook)<a href="{{ $member->facebook }}" target="_blank">Facebook</a>@endif
                                    @if($member->twitter)<a href="{{ $member->twitter }}" target="_blank">Twitter</a>@endif
                                    @if($member->linkedin)<a href="{{ $member->linkedin }}" target="_blank">LinkedIn</a>@endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $member->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content rounded-4">
                            <form action="{{ route('admin.team.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Team Member</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body row g-3">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ $member->name }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Position</label>
                                        <input type="text" name="position" class="form-control" value="{{ $member->position }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ $member->email }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control" value="{{ $member->phone }}">
                                    </div>

                                    <div class="col-12">
                                        <label>Bio</label>
                                        <textarea name="bio" class="form-control" rows="3">{{ $member->bio }}</textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Facebook</label>
                                        <input type="url" name="facebook" class="form-control" value="{{ $member->facebook }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label>Twitter</label>
                                        <input type="url" name="twitter" class="form-control" value="{{ $member->twitter }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label>LinkedIn</label>
                                        <input type="url" name="linkedin" class="form-control" value="{{ $member->linkedin }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Status</label>
                                        <select name="status" class="form-select">
                                            <option value="active" {{ $member->status=='active'?'selected':'' }}>Active</option>
                                            <option value="inactive" {{ $member->status=='inactive'?'selected':'' }}>Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Photo</label>
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-primary px-4">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $member->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4">
                            <div class="modal-body text-center p-4">
                                <h5>Delete this member?</h5>
                                <p class="text-muted">{{ $member->name }}</p>

                                <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger px-4">Yes, Delete</button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No team members found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>


<!-- Add Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4">
            <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Team Member</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Position</label>
                        <input type="text" name="position" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>

                    <div class="col-12">
                        <label>Bio</label>
                        <textarea name="bio" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-4">
                        <label>Facebook</label>
                        <input type="url" name="facebook" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label>Twitter</label>
                        <input type="url" name="twitter" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label>LinkedIn</label>
                        <input type="url" name="linkedin" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Photo</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary px-4">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
