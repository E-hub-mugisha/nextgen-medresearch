@extends('layouts.portal')
@section('title', 'Discover Projects')

@section('content')

{{-- Header --}}
<div class="page-header-row">
    <div>
        <h1 class="page-title">Discover Projects</h1>
        <p class="page-subtitle">Find research projects to collaborate on</p>
    </div>
    <a href="{{ route('portal.projects.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> New Project
    </a>
</div>

{{-- FILTERS --}}
<div class="panel mb-4">
    <div class="panel-body py-3">
        <form method="GET" action="{{ route('portal.projects.discover') }}"
              class="discover-filters">

            {{-- Search --}}
            <div class="filter-search">
                <i class="bi bi-search"></i>
                <input type="text"
                       name="search"
                       class="filter-search-input"
                       placeholder="Search by title or description..."
                       value="{{ request('search') }}">
            </div>

            {{-- Research Area --}}
            <select name="area" class="form-select filter-select">
                <option value="">All Research Areas</option>
                @foreach($areas as $area)
                    <option value="{{ $area }}"
                        {{ request('area') === $area ? 'selected' : '' }}>
                        {{ $area }}
                    </option>
                @endforeach
            </select>

            {{-- Status --}}
            <select name="status" class="form-select filter-select">
                <option value="">All Statuses</option>
                @foreach(['active' => 'Active', 'ongoing' => 'Ongoing', 'under review' => 'Under Review', 'completed' => 'Completed'] as $val => $label)
                    <option value="{{ $val }}"
                        {{ request('status') === $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-funnel me-1"></i> Filter
            </button>

            @if(request()->hasAny(['search', 'area', 'status']))
                <a href="{{ route('portal.projects.discover') }}"
                   class="btn btn-secondary">
                    <i class="bi bi-x-lg me-1"></i> Clear
                </a>
            @endif

        </form>
    </div>
</div>

{{-- RESULTS COUNT --}}
<div class="d-flex align-items-center justify-content-between mb-3">
    <p class="text-muted mb-0" style="font-size:.85rem;">
        Showing <strong>{{ $projects->total() }}</strong> project{{ $projects->total() !== 1 ? 's' : '' }}
        @if(request('search'))
            for <strong>"{{ request('search') }}"</strong>
        @endif
    </p>
    <p class="text-muted mb-0" style="font-size:.82rem;">
        Page {{ $projects->currentPage() }} of {{ $projects->lastPage() }}
    </p>
</div>

{{-- PROJECT GRID --}}
@if($projects->isEmpty())
    <div class="panel">
        <div class="panel-empty" style="padding:3rem;">
            <i class="bi bi-search" style="font-size:2.5rem;opacity:.3;display:block;margin-bottom:12px;"></i>
            No projects found matching your criteria.
            <a href="{{ route('portal.projects.discover') }}"
               class="d-block mt-2 text-teal fw-medium">
                Clear filters →
            </a>
        </div>
    </div>
@else
    <div class="projects-grid mb-4">
        @foreach($projects as $project)
            <div class="project-card">

                {{-- Header --}}
                <div class="project-card-header">
                    <div class="project-card-icon">
                        {{ strtoupper(substr($project->title, 0, 1)) }}
                    </div>
                    <div class="ms-auto">
                        <span class="status-badge status-{{ str_replace(' ', '_', $project->status) }}">
                            {{ ucfirst($project->status) }}
                        </span>
                    </div>
                </div>

                {{-- Title --}}
                <a href="{{ route('portal.projects.show', $project) }}"
                   class="project-card-title">
                    {{ $project->title }}
                </a>

                {{-- Description --}}
                <p class="project-card-desc">
                    {{ Str::limit($project->description, 110) }}
                </p>

                {{-- Research Area --}}
                @if($project->research_area)
                    <span class="project-area-tag">
                        <i class="bi bi-tag me-1"></i>{{ $project->research_area }}
                    </span>
                @endif

                {{-- Owner --}}
                <div class="discover-card-owner">
                    <div class="discover-owner-avatar">
                        {{ strtoupper(substr($project->owner->name, 0, 2)) }}
                    </div>
                    <div>
                        <span class="discover-owner-name">{{ $project->owner->name }}</span>
                        <span class="discover-owner-role">{{ ucfirst($project->owner->role) }}</span>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="project-card-footer">
                    <span>
                        <i class="bi bi-people me-1"></i>
                        {{ $project->collaborators_count }}
                    </span>
                    <span>
                        <i class="bi bi-check2-square me-1"></i>
                        {{ $project->milestones_count }}
                    </span>
                    @if($project->end_date)
                        <span>
                            <i class="bi bi-calendar me-1"></i>
                            {{ $project->end_date?->format('M d, Y') }}
                        </span>
                    @endif
                    <a href="{{ route('portal.projects.show', $project) }}"
                       class="ms-auto panel-link">
                        View →
                    </a>
                </div>

            </div>
        @endforeach
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center">
        {{ $projects->links('vendor.pagination.portal') }}
    </div>
@endif

@endsection