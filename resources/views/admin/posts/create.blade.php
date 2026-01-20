@extends('layouts.app')

@section('content')

<h2 class="mb-4">Create Post</h2>
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

<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="mb-3">
                    <label>Title *</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Category *</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Select --</option>
                        @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Short Description</label>
                    <textarea name="excerpt" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label>Content</label>
                    <textarea name="content" class="form-control" rows="5"></textarea>
                </div>

                <div class="mb-3 col-md-4">
                    <label>Featured Image</label>
                    <input type="file" name="featured_image" class="form-control">
                </div>

                <div class="mb-3 col-md-4">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="draft">Draft</option>
                        <option value="pending_review">Pending Review</option>
                        <option value="scheduled">Scheduled</option>
                        <option value="published">Published</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>

                <div class="mb-3 col-md-4">
                    <label>Publish At</label>
                    <input type="datetime-local" name="publish_at" class="form-control">
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="featured" value="1">
                    <label class="form-check-label">Feature this post</label>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-primary">Create Post</button>
</form>

@endsection