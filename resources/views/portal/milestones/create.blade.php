@extends('layouts.portal')
@section('title', 'Add Milestone')

@section('content')

<div class="page-header-row">
    <div>
        <a href="{{ route('portal.projects.show', $project) }}" class="breadcrumb-link">
            <i class="bi bi-arrow-left me-1"></i>{{ $project->title }}
        </a>
        <h1 class="page-title mt-1">Add Milestone</h1>
        <p class="page-subtitle">Break your project into trackable steps</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">

        <form method="POST"
            action="{{ route('projects.milestones.store', $project) }}">
            @csrf

            <div class="panel">

                <div class="auth-section">
                    <div class="section-label"><span>Milestone Details</span></div>
                    <div class="row g-3">

                        <div class="col-12">
                            <label class="form-label">
                                Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}"
                                placeholder="e.g. Complete literature review"
                                required>
                            @error('title')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="4"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="What needs to be done for this milestone?">{{ old('description') }}</textarea>
                            @error('description')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                Status <span class="text-danger">*</span>
                            </label>
                            <select name="status"
                                class="form-select @error('status') is-invalid @enderror"
                                required>
                                <option value="todo"
                                    {{ old('status', 'todo') === 'todo' ? 'selected' : '' }}>
                                    To Do
                                </option>
                                <option value="in_progress"
                                    {{ old('status') === 'in_progress' ? 'selected' : '' }}>
                                    In Progress
                                </option>
                                <option value="done"
                                    {{ old('status') === 'done' ? 'selected' : '' }}>
                                    Done
                                </option>
                            </select>
                            @error('status')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Due Date</label>
                            <input type="date" name="due_date"
                                class="form-control @error('due_date') is-invalid @enderror"
                                value="{{ old('due_date') }}">
                            @error('due_date')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="auth-footer">
                    <a href="{{ route('portal.projects.show', $project) }}"
                        class="btn btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i> Add Milestone
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>

@endsection