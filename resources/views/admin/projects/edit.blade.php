@extends('layouts.app')

@section('title','Edit Project')

@section('content')

<div class="card p-3 shadow-sm">
    <h3>Edit Project</h3>

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

    <form action="{{ route('admin.projects.update',$project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $project->title }}" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control">
                <option value="">Select...</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $project->category_id==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Summary</label>
            <textarea name="summary" class="form-control" rows="3">{{ $project->summary }}</textarea>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="5">{{ $project->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Banner</label>
            <input type="file" name="banner" class="form-control">
            @if($project->banner)
            <img src="{{asset('image/projects')}}/{{ $project->banner }}" class="img-fluid mt-2" height="100">
            @endif
        </div>

        <div class="mb-3">
            <label>Project Link</label>
            <input type="url" name="project_link" class="form-control" value="{{ $project->project_link }}">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="draft" {{ $project->status=='draft'?'selected':'' }}>Draft</option>
                <option value="in_progress" {{ $project->status=='in_progress'?'selected':'' }}>In Progress</option>
                <option value="published" {{ $project->status=='published'?'selected':'' }}>Published</option>
                <option value="archived" {{ $project->status=='archived'?'selected':'' }}>Archived</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Featured</label>
            <select name="featured" class="form-control">
                <option value="0" {{ !$project->featured?'selected':'' }}>No</option>
                <option value="1" {{ $project->featured?'selected':'' }}>Yes</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Display Order</label>
            <input type="number" name="display_order" class="form-control" value="{{ $project->display_order }}">
        </div>

        <button class="btn btn-primary" type="submit">Update Project</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection