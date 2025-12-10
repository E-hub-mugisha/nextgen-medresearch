@extends('layouts.app')

@section('title','Frequently Asked Questions')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Frequently Asked Questions</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createFaqModal">
        <i class="mdi mdi-plus"></i> Add faqs
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

<div class="card p-3 shadow-sm">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Question</th>
                <th>Category</th>
                <th>Answer</th>
                <th>Featured</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faqs as $faq)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $faq->question }}</td>
                <td>{{ $faq->category ?? '-' }}</td>
                <td>{{ Str::limit($faq->answer, 80) ?? '-' }}</td>
                <td>
                    @if($faq->featured)
                    <span class="badge bg-success">Yes</span>
                    @else
                    <span class="badge bg-secondary">No</span>
                    @endif
                </td>
                <td>
                    <span class="badge bg-{{ $faq->status=='draft'?'secondary':($faq->status=='scheduled'?'info':($faq->status=='published'?'success':'dark')) }}">
                        {{ ucfirst($faq->status) }}
                    </span>
                </td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editFaqModal{{ $faq->id }}">Edit</button>
                    <form action="{{ route('admin.faqs.destroy',$faq->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this faq?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            {{-- Edit Modal --}}
            <div class="modal fade" id="editFaqModal{{ $faq->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('admin.faqs.update',$faq->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit faq</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label>Question</label>
                                    <input type="text" name="question" class="form-control" value="{{ $faq->question }}" required>
                                </div>

                                <div class="mb-3">
                                    <label>Category</label>
                                    <select name="category" class="form-control" required>
                                        <option value="general" {{ $faq->category=='general'?'selected':'' }}>general</option>
                                        <option value="membership" {{ $faq->category=='membership'?'selected':'' }}>membership</option>
                                        <option value="mentorship" {{ $faq->category=='mentorship'?'selected':'' }}>mentorship</option>
                                        <option value="research" {{ $faq->category=='research'?'selected':'' }}>research</option>
                                        <option value="platform" {{ $faq->category=='platform'?'selected':'' }}>platform</option>
                                    </select>

                                </div>

                                <div class="mb-3">
                                    <label>Answer</label>
                                    <textarea name="answer" class="form-control" rows="4">{{ $faq->answer }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="draft" {{ $faq->status=='draft'?'selected':'' }}>Draft</option>
                                        <option value="published" {{ $faq->status=='published'?'selected':'' }}>Published</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Featured</label>
                                    <select name="featured" class="form-control">
                                        <option value="0" {{ !$faq->featured?'selected':'' }}>No</option>
                                        <option value="1" {{ $faq->featured?'selected':'' }}>Yes</option>
                                    </select>
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
<div class="modal fade" id="createFaqModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.faqs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create FAQ</h5>

                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label>Question</label>
                        <input type="text" name="question" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Category</label>
                        <select name="category" class="form-control" required>
                            <option value="0">--- Select category ---</option>
                            <option value="general">general</option>
                            <option value="membership">membership</option>
                            <option value="mentorship">mentorship</option>
                            <option value="research">research</option>
                            <option value="platform">platform</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Answer</label>
                        <textarea name="answer" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Featured</label>
                        <select name="featured" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Create</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection