@extends('layouts.app')

@section('title', 'Edit Program')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Program</h4>
        <a href="{{ route('admin.programs.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
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

            <form action="{{ route('admin.programs.update', $program->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    <!-- TITLE -->
                    <div class="col-md-12 mb-3">
                        <label>Title *</label>
                        <input type="text" name="title" value="{{ old('title', $program->title) }}"
                            class="form-control @error('title') is-invalid @enderror">
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- CATEGORY -->
                    <div class="col-md-6 mb-3">
                        <label>Category *</label>
                        <select name="category_id"
                            class="form-control @error('category_id') is-invalid @enderror">

                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ $program->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- STATUS -->
                    <div class="col-md-3 mb-3">
                        <label>Status *</label>
                        <select name="status" class="form-control">
                            @foreach(['draft','published','archived'] as $status)
                            <option value="{{ $status }}"
                                {{ $program->status == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- FEATURED -->
                    <div class="col-md-3 mb-3">
                        <label>Featured</label>
                        <select name="featured" class="form-control">
                            <option value="0" {{ $program->featured ? '' : 'selected' }}>No</option>
                            <option value="1" {{ $program->featured ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>

                    <!-- DISPLAY ORDER -->
                    <div class="col-md-4 mb-3">
                        <label>Display Order</label>
                        <input type="number" name="display_order"
                            value="{{ $program->display_order }}"
                            class="form-control">
                    </div>

                    <!-- ICON -->
                    <div class="col-md-12 mb-3">
                        <label>Icon</label><br>

                        @if($program->icon)
                        <img src="{{ asset($program->icon) }}"
                            height="80" class="mb-2 rounded">
                        @endif

                        <input type="file" name="icon" class="form-control mt-2">
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                        <textarea name="description" rows="5"
                            class="form-control">{{ old('description', $program->description) }}</textarea>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary px-4">Update Program</button>
            </form>

        </div>
    </div>

</div>
@endsection