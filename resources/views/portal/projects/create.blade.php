@extends('layouts.portal')
@section('title', 'New Project')

@section('content')

<div class="page-header-row">
    <div>
        <h1 class="page-title">Create a Project</h1>
        <p class="page-subtitle">Set up your research project and invite collaborators</p>
    </div>
    <a href="{{ route('portal.projects.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">

        <form method="POST" action="{{ route('portal.projects.store') }}" id="projectForm">
            @csrf

            <div class="panel">

                {{-- BASIC INFO --}}
                <div class="auth-section">
                    <div class="section-label"><span>Basic Information</span></div>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Project Title <span class="text-danger">*</span></label>
                            <input type="text" name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}"
                                placeholder="e.g. Genomic Variant Detection in Rural Populations"
                                required>
                            @error('title')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea name="description" rows="5"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Describe the research problem, objectives, and expected outcomes..."
                                required>{{ old('description') }}</textarea>
                            @error('description')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Research Area</label>
                            <input type="text" name="research_area"
                                class="form-control @error('research_area') is-invalid @enderror"
                                list="areas-list"
                                value="{{ old('research_area') }}"
                                placeholder="e.g. Bioinformatics, Machine Learning...">
                            <datalist id="areas-list">
                                @foreach($areas as $area)
                                <option value="{{ $area }}">
                                    @endforeach
                            </datalist>
                            @error('research_area')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="active" {{ old('status') === 'active'       ? 'selected' : '' }}>Active</option>
                                <option value="ongoing" {{ old('status') === 'ongoing'      ? 'selected' : '' }}>Ongoing</option>
                                <option value="under review" {{ old('status') === 'under review' ? 'selected' : '' }}>Under Review</option>
                                <option value="completed" {{ old('status') === 'completed'    ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- TIMELINE --}}
                <div class="auth-section">
                    <div class="section-label"><span>Timeline</span></div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date"
                                class="form-control @error('start_date') is-invalid @enderror"
                                value="{{ old('start_date') }}">
                            @error('start_date')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date"
                                class="form-control @error('end_date') is-invalid @enderror"
                                value="{{ old('end_date') }}">
                            @error('end_date')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="auth-footer">
                    <a href="{{ route('portal.projects.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Create Project
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>

@endsection