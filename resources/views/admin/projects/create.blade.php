@extends('layouts.app')

@section('title','Add Project')

@section('content')

<div class="card p-3 shadow-sm">
    <h3>Add Project</h3>
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

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control">
                <option value="">Select...</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Summary</label>
            <textarea name="summary" id="editor-summary" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" id="editor-description" class="form-control" rows="5"></textarea>
        </div>

        <div class="mb-3">
            <label>Banner</label>
            <input type="file" name="banner" class="form-control">
        </div>

        <div class="mb-3">
            <label>Project Link</label>
            <input type="url" name="project_link" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="draft">Draft</option>
                <option value="in_progress">In Progress</option>
                <option value="published">Published</option>
                <option value="archived">Archived</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Featured</label>
            <select name="featured" class="form-control">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Display Order</label>
            <input type="number" name="display_order" class="form-control" value="0">
        </div>

        <button class="btn btn-primary" type="submit">Save Project</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@push('scripts')
<script>
    ['editor-description', 'editor-summary'].forEach(id => {
        ClassicEditor
            .create(document.querySelector('#' + id))
            .catch(error => console.error(error));
    });
</script>
@endpush

@endsection