@extends('layouts.app')

@section('title', 'Edit Research')

@section('content')
<div class="container py-4">
    <h4>Edit Research</h4>
    <a href="{{ route('admin.research_spaces.index') }}" class="btn btn-secondary mb-3">Back to Research List</a>
    <form method="POST" action="{{ route('admin.research_spaces.update', $researchSpace) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control"
                value="{{ old('title', $researchSpace->title ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea id="editor-description"
                name="description"
                class="form-control">{{ old('description', $researchSpace->description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Importance</label>
            <textarea id="editor-importance"
                name="importance"
                class="form-control">{{ old('importance', $researchSpace->importance ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Impact</label>
            <textarea id="editor-impact"
                name="impact"
                class="form-control">{{ old('impact', $researchSpace->impact ?? '') }}</textarea>
        </div>


        <button class="btn btn-success">Save</button>

    </form>
</div>

@push('scripts')
<script>
    ['editor-description', 'editor-importance', 'editor-impact'].forEach(id => {
        ClassicEditor
            .create(document.querySelector('#' + id))
            .catch(error => console.error(error));
    });
</script>
@endpush
@endsection