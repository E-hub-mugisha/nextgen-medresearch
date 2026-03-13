@extends('layouts.portal')
@section('title', 'Edit Project')

@section('content')

<div class="page-header-row">
    <div>
        <h1 class="page-title">Edit Project</h1>
        <p class="page-subtitle">{{ $project->title }}</p>
    </div>
    <a href="{{ route('portal.projects.show', $project) }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="row justify-content-center">
<div class="col-lg-8">

<form method="POST" action="{{ route('portal.projects.update', $project) }}">
@csrf
@method('PATCH')

<div class="panel">

    <div class="auth-section">
        <div class="section-label"><span>Basic Information</span></div>
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Project Title <span class="text-danger">*</span></label>
                <input type="text" name="title"
                       class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $project->title) }}" required>
                @error('title') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Description <span class="text-danger">*</span></label>
                <textarea name="description" rows="5"
                          class="form-control @error('description') is-invalid @enderror"
                          required>{{ old('description', $project->description) }}</textarea>
                @error('description') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Research Area</label>
                <input type="text" name="research_area"
                       class="form-control @error('research_area') is-invalid @enderror"
                       list="areas-list"
                       value="{{ old('research_area', $project->research_area) }}">
                <datalist id="areas-list">
                    @foreach($areas as $area)
                        <option value="{{ $area }}">
                    @endforeach
                </datalist>
            </div>

            <div class="col-md-6">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                    @foreach(['active','ongoing','under review','completed'] as $s)
                        <option value="{{ $s }}"
                            {{ old('status', $project->status) === $s ? 'selected' : '' }}>
                            {{ ucfirst($s) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="auth-section">
        <div class="section-label"><span>Timeline</span></div>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Start Date</label>
                <input type="date" name="start_date" class="form-control"
                       value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">End Date</label>
                <input type="date" name="end_date" class="form-control"
                       value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}">
            </div>
        </div>
    </div>

    <div class="auth-footer">
        <a href="{{ route('portal.projects.show', $project) }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-lg me-1"></i> Save Changes
        </button>
    </div>

</div>
</form>

</div>
</div>

@endsection