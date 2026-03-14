@extends('layouts.app')

@section('title', 'Create Program')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Create Program</h4>
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

            <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <!-- TITLE -->
                    <div class="col-md-12 mb-3">
                        <label>Title *</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="form-control @error('title') is-invalid @enderror">
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- CATEGORY -->
                    <div class="col-md-6 mb-3">
                        <label>Category *</label>
                        <select name="category_id"
                            class="form-control @error('category_id') is-invalid @enderror">
                            <option value="">Select</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- STATUS -->
                    <div class="col-md-3 mb-3">
                        <label>Status *</label>
                        <select name="status" class="form-control">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>

                    <!-- FEATURED -->
                    <div class="col-md-3 mb-3">
                        <label>Featured</label>
                        <select name="featured" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    <!-- DISPLAY ORDER -->
                    <div class="col-md-4 mb-3">
                        <label>Display Order</label>
                        <input type="number" name="display_order" value="0"
                            class="form-control">
                    </div>

                    <!-- ICON -->
                    <div class="col-md-12 mb-3">
                        <label>image</label>
                        <input type="file" name="icon" class="form-control">
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                        <textarea name="description" id="editor-description" rows="5"
                            class="form-control">{{ old('description') }}</textarea>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary px-4">Save Program</button>
            </form>

        </div>
    </div>

</div>

@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#editor-description'))
        .catch(error => console.error(error));
</script>
@endpush
@endsection