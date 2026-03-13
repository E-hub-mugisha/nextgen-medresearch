@extends('layouts.portal')
@section('title', 'Edit Milestone')

@section('content')

<div class="page-header-row">
    <div>
        <a href="{{ route('milestones.show', $milestone) }}" class="breadcrumb-link">
            <i class="bi bi-arrow-left me-1"></i>Back to Milestone
        </a>
        <h1 class="page-title mt-1">Edit Milestone</h1>
        <p class="page-subtitle">{{ $milestone->title }}</p>
    </div>
</div>

<div class="row justify-content-center">
<div class="col-lg-7">

<form method="POST" action="{{ route('milestones.update', $milestone) }}">
@csrf
@method('PATCH')

<div class="panel">

    <div class="auth-section">
        <div class="section-label"><span>Milestone Details</span></div>
        <div class="row g-3">

            <div class="col-12">
                <label class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" name="title"
                       class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $milestone->title) }}"
                       required>
                @error('title') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" rows="4"
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $milestone->description) }}</textarea>
                @error('description') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                    @foreach(['todo' => 'To Do', 'in_progress' => 'In Progress', 'done' => 'Done'] as $val => $label)
                        <option value="{{ $val }}"
                            {{ old('status', $milestone->status) === $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Due Date</label>
                <input type="date" name="due_date"
                       class="form-control"
                       value="{{ old('due_date', $milestone->due_date?->format('Y-m-d')) }}">
            </div>

        </div>
    </div>

    <div class="auth-footer">
        <a href="{{ route('milestones.show', $milestone) }}"
           class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-lg me-1"></i> Save Changes
        </button>
    </div>

</div>
</form>

</div>
</div>

@endsection