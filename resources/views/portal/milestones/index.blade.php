@extends('layouts.portal')
@section('title', 'Milestones — ' . $project->title)

@section('content')

<div class="page-header-row">
    <div>
        <a href="{{ route('portal.projects.show', $project) }}"
           class="breadcrumb-link">
            <i class="bi bi-arrow-left me-1"></i>{{ $project->title }}
        </a>
        <h1 class="page-title mt-1">Milestones</h1>
        <p class="page-subtitle">
            {{ $milestones->flatten()->count() }} total milestones
        </p>
    </div>
    <a href="{{ route('projects.milestones.create', $project) }}"
       class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Add Milestone
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success mb-4">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    </div>
@endif

{{-- KANBAN COLUMNS --}}
<div class="kanban-board">

    {{-- TO DO --}}
    <div class="kanban-col">
        <div class="kanban-col-header todo">
            <span class="kanban-col-title">
                <i class="bi bi-circle me-2"></i>To Do
            </span>
            <span class="kanban-count">
                {{ isset($milestones['todo']) ? $milestones['todo']->count() : 0 }}
            </span>
        </div>
        <div class="kanban-col-body">
            @forelse($milestones['todo'] ?? [] as $milestone)
                @include('portal.milestones.partials.card', ['milestone' => $milestone])
            @empty
                <div class="kanban-empty">No milestones here</div>
            @endforelse
        </div>
    </div>

    {{-- IN PROGRESS --}}
    <div class="kanban-col">
        <div class="kanban-col-header in_progress">
            <span class="kanban-col-title">
                <i class="bi bi-arrow-repeat me-2"></i>In Progress
            </span>
            <span class="kanban-count">
                {{ isset($milestones['in_progress']) ? $milestones['in_progress']->count() : 0 }}
            </span>
        </div>
        <div class="kanban-col-body">
            @forelse($milestones['in_progress'] ?? [] as $milestone)
                @include('portal.milestones.partials.card', ['milestone' => $milestone])
            @empty
                <div class="kanban-empty">No milestones here</div>
            @endforelse
        </div>
    </div>

    {{-- DONE --}}
    <div class="kanban-col">
        <div class="kanban-col-header done">
            <span class="kanban-col-title">
                <i class="bi bi-check-circle me-2"></i>Done
            </span>
            <span class="kanban-count">
                {{ isset($milestones['done']) ? $milestones['done']->count() : 0 }}
            </span>
        </div>
        <div class="kanban-col-body">
            @forelse($milestones['done'] ?? [] as $milestone)
                @include('portal.milestones.partials.card', ['milestone' => $milestone])
            @empty
                <div class="kanban-empty">No milestones here</div>
            @endforelse
        </div>
    </div>

</div>

@endsection