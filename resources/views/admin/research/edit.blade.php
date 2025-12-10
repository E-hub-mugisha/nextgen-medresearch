{{-- resources/views/admin/research/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<h4>Edit Research</h4>
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

<form action="{{ route('admin.research.update', $research->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" value="{{ $research->title }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Category</label>
        <select name="category_id" class="form-control" required>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @selected($research->category_id == $cat->id)>
                {{ $cat->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Summary</label>
        <textarea name="summary" class="form-control">{{ $research->summary }}</textarea>
    </div>

    <div class="mb-3">
        <label>Content</label>
        <textarea name="content" class="form-control" rows="6">{{ $research->content }}</textarea>
    </div>

    <div class="mb-3">
        <label>New Document (optional)</label>
        <input type="file" name="document" class="form-control">
    </div>

    <div class="mb-3">
        <label>New Featured Image (optional)</label>
        <input type="file" name="featured_image" class="form-control">
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="draft" @selected($research->status == 'draft')>Draft</option>
            <option value="published" @selected($research->status == 'published')>Published</option>
            <option value="archived" @selected($research->status == 'archived')>Archived</option>
        </select>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" name="featured" class="form-check-input" value="1" @checked($research->featured)>
        <label class="form-check-label">Featured</label>
    </div>

    <button class="btn btn-success">Update</button>
    <a href="{{ route('admin.research.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection