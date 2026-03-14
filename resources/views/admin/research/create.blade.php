{{-- resources/views/admin/research/create.blade.php --}}
@extends('layouts.app')

@section('content')
<h4>Create Research</h4>
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

<form action="{{ route('admin.research.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Category</label>
        <select name="category_id" class="form-control" required>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Summary</label>
        <textarea name="summary" id="editor-summary" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Content</label>
        <textarea name="content" id="editor-content" class="form-control" rows="6"></textarea>
    </div>

    <div class="mb-3">
        <label>Document (PDF)</label>
        <input type="file" name="document" class="form-control">
    </div>

    <div class="mb-3">
        <label>Featured Image</label>
        <input type="file" name="featured_image" class="form-control">
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
            <option value="archived">Archived</option>
        </select>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" name="featured" class="form-check-input" value="1">
        <label class="form-check-label">Featured</label>
    </div>

    <button class="btn btn-success">Save</button>
    <a href="{{ route('admin.research.index') }}" class="btn btn-secondary">Back</a>
</form>

@push('scripts')
<script>
    ['editor-summary', 'editor-content'].forEach(id => {
        ClassicEditor
            .create(document.querySelector('#' + id))
            .catch(error => console.error(error));
    });
</script>
@push('scripts')

@endsection
