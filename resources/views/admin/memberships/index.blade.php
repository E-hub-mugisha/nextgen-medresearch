@extends('layouts.app')
@section('title','Membership Applications')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Membership Applications</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        + Add Member
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
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Organization</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($memberships as $member)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $member->full_name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->organization }}</td>
                    <td>{{ $member->type }}</td>
                    <td>
                        <span class="badge bg-{{ 
                            $member->status=='approved' ? 'success' :
                            ($member->status=='rejected' ? 'danger' : 'warning') 
                        }}">
                            {{ ucfirst($member->status) }}
                        </span>
                    </td>
                    <td class="text-end">

                        <!-- View -->
                        <button class="btn btn-sm btn-light" data-bs-toggle="modal"
                            data-bs-target="#viewModal{{ $member->id }}">View</button>

                        <!-- Edit -->
                        <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $member->id }}">Edit</button>

                        <!-- Approve -->
                        @if($member->status != 'approved')
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                            data-bs-target="#approveModal{{ $member->id }}">Approve</button>
                        @endif

                        <!-- Reject -->
                        @if($member->status != 'rejected')
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#rejectModal{{ $member->id }}">Reject</button>
                        @endif

                        <!-- Delete -->
                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $member->id }}">Delete</button>
                    </td>
                </tr>

                <!-- View Modal -->
                <div class="modal fade" id="viewModal{{ $member->id }}">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content rounded-4">
                            <div class="modal-header">
                                <h5>{{ $member->full_name }}</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Email:</strong> {{ $member->email }}</p>
                                <p><strong>Phone:</strong> {{ $member->phone ?? '-' }}</p>
                                <p><strong>Organization:</strong> {{ $member->organization ?? '-' }}</p>
                                <p><strong>Motivation:</strong><br>{{ $member->motivation ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $member->id }}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content rounded-4">
                            <form action="{{ route('admin.memberships.update',$member->id) }}" method="POST">
                                @csrf @method('PUT')

                                <div class="modal-header">
                                    <h5>Edit Member</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body row g-3">
                                    <div class="col-md-6">
                                        <label>Full Name</label>
                                        <input type="text" name="full_name" value="{{ $member->full_name }}" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ $member->email }}" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="{{ $member->phone }}" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Membership Type</label>
                                        <select name="type" class="form-select" required>
                                            <option value="individual" {{ $member->type=='individual'?'selected':'' }}>Individual</option>
                                            <option value="trainer" {{ $member->type=='trainer'?'selected':'' }}>Trainer</option>
                                            <option value="institutional" {{ $member->type=='institutional'?'selected':'' }}>Institutional</option>
                                            <option value="corporate" {{ $member->type=='corporate'?'selected':'' }}>Corporate</option>
                                            <option value="honorary" {{ $member->type=='honorary'?'selected':'' }}>Honorary</option>
                                        </select>

                                    </div>

                                    <div class="col-12">
                                        <label>Organization</label>
                                        <input type="text" name="organization" value="{{ $member->organization }}" class="form-control">
                                    </div>

                                    <div class="col-12">
                                        <label>Motivation</label>
                                        <textarea name="motivation" class="form-control">{{ $member->motivation }}</textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Status</label>
                                        <select name="status" class="form-select">
                                            <option value="pending" {{ $member->status=='pending'?'selected':'' }}>Pending</option>
                                            <option value="approved" {{ $member->status=='approved'?'selected':'' }}>Approved</option>
                                            <option value="rejected" {{ $member->status=='rejected'?'selected':'' }}>Rejected</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Approve Modal -->
                <div class="modal fade" id="approveModal{{ $member->id }}">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4 p-3 text-center">
                            <h5>Approve this member?</h5>
                            <form action="{{ route('admin.memberships.status',$member->id) }}" method="POST">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="approved">
                                <button class="btn btn-success px-4">Yes, Approve</button>
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Reject Modal -->
                <div class="modal fade" id="rejectModal{{ $member->id }}">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4 p-3 text-center">
                            <h5>Reject this member?</h5>
                            <form action="{{ route('admin.memberships.status',$member->id) }}" method="POST">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="rejected">
                                <button class="btn btn-danger px-4">Yes, Reject</button>
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $member->id }}">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4 p-3 text-center">
                            <h5>Delete this member?</h5>
                            <p>{{ $member->full_name }}</p>
                            <form action="{{ route('admin.memberships.destroy',$member->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger px-4">Delete</button>
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4">
            <form action="{{ route('admin.memberships.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5>Add Membership</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
                    </div>
                    <div class="col-md-6">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="phone" class="form-control" placeholder="Phone">
                    </div>
                    <div class="col-md-6">
                        <select name="type" class="form-select" required>
                            <option value="" disabled selected>Select Membership Type</option>
                            <option value="individual">Individual</option>
                            <option value="trainer">Trainer</option>
                            <option value="institutional">Institutional</option>
                            <option value="corporate">Corporate</option>
                            <option value="honorary">Honorary</option>
                        </select>

                    </div>
                    <div class="col-12">
                        <input type="text" name="organization" class="form-control" placeholder="Organization">
                    </div>
                    <div class="col-12">
                        <textarea name="motivation" class="form-control" placeholder="Motivation"></textarea>
                    </div>
                    <div class="col-md-6">
                        <select name="status" class="form-select">
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
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