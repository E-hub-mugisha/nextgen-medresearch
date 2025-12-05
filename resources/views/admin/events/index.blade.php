@extends('layouts.app')

@section('title','Events')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Events</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createEventModal">
        <i class="mdi mdi-plus"></i> Add Event
    </button>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card p-3 shadow-sm">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Trainer</th>
                <th>Start</th>
                <th>End</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->category->name ?? '-' }}</td>
                <td>{{ $event->trainer ?? '-' }}</td>
                <td>{{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('Y-m-d H:i') : '-' }}</td>
                <td>{{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('Y-m-d H:i') : '-' }}</td>
                <td>
                    <span class="badge bg-{{ $event->status=='draft'?'secondary':($event->status=='scheduled'?'info':($event->status=='published'?'success':'dark')) }}">
                        {{ ucfirst($event->status) }}
                    </span>
                </td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editEventModal{{ $event->id }}">Edit</button>
                    <form action="{{ route('admin.events.destroy',$event->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this event?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            {{-- Edit Modal --}}
            <div class="modal fade" id="editEventModal{{ $event->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('admin.events.update',$event->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Event</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
                                </div>

                                <div class="mb-3">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">Select...</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ $event->category_id==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="4">{{ $event->description }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Trainer</label>
                                    <input type="text" name="trainer" class="form-control" value="{{ $event->trainer }}">
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <label>Start Date</label>
                                        <input type="datetime-local" name="start_date" class="form-control" value="{{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i') : '' }}">
                                    </div>
                                    <div class="col">
                                        <label>End Date</label>
                                        <input type="datetime-local" name="end_date" class="form-control" value="{{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i') : '' }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label>Location</label>
                                    <input type="text" name="location" class="form-control" value="{{ $event->location }}">
                                </div>

                                <div class="mb-3">
                                    <label>Capacity</label>
                                    <input type="number" name="capacity" class="form-control" value="{{ $event->capacity }}">
                                </div>

                                <div class="mb-3">
                                    <label>Banner</label>
                                    <input type="file" name="banner" class="form-control">
                                    @if($event->banner)
                                        <img src="{{ asset('uploads/events/'.$event->banner) }}" class="img-fluid mt-2" height="100">
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label>Registration Link</label>
                                    <input type="url" name="registration_link" class="form-control" value="{{ $event->registration_link }}">
                                </div>

                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="draft" {{ $event->status=='draft'?'selected':'' }}>Draft</option>
                                        <option value="scheduled" {{ $event->status=='scheduled'?'selected':'' }}>Scheduled</option>
                                        <option value="published" {{ $event->status=='published'?'selected':'' }}>Published</option>
                                        <option value="archived" {{ $event->status=='archived'?'selected':'' }}>Archived</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Publish At</label>
                                    <input type="datetime-local" name="publish_at" class="form-control" value="{{ $event->publish_at ? \Carbon\Carbon::parse($event->publish_at)->format('Y-m-d\TH:i') : '' }}">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Update</button>
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>
</div>

{{-- Create Modal --}}
<div class="modal fade" id="createEventModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Event</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">Select...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Trainer</label>
                        <input type="text" name="trainer" class="form-control">
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Start Date</label>
                            <input type="datetime-local" name="start_date" class="form-control">
                        </div>
                        <div class="col">
                            <label>End Date</label>
                            <input type="datetime-local" name="end_date" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Capacity</label>
                        <input type="number" name="capacity" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Banner</label>
                        <input type="file" name="banner" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Registration Link</label>
                        <input type="url" name="registration_link" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="draft">Draft</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="published">Published</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Publish At</label>
                        <input type="datetime-local" name="publish_at" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save Event</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
