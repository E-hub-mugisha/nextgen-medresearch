@extends('layouts.portal')
@section('title', 'My Projects')

@section('content')

<div class="page-header-row">
    <div>
        <h1 class="page-title">My Projects</h1>
        <p class="page-subtitle">Projects you own and collaborate on</p>
    </div>
    <a href="{{ route('portal.projects.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> New Project
    </a>
</div>

{{-- Flash message --}}
@if(session('success'))
<div class="alert alert-success mb-4">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
</div>
@endif

{{-- OWNED PROJECTS --}}
<div class="panel mb-4">
    <div class="panel-header">
        <span class="panel-title">
            <i class="bi bi-folder2-open me-2"></i>Projects I Own
            <span class="ms-badge ms-2">{{ $ownedProjects->count() }}</span>
        </span>
        <a href="{{ route('portal.projects.discover') }}" class="panel-link">Discover more →</a>
    </div>

    @if($ownedProjects->isEmpty())
    <div class="panel-empty">
        <i class="bi bi-folder-plus"></i>
        You haven't created any projects yet.
        <a href="{{ route('portal.projects.create') }}" class="d-block mt-2 text-teal fw-medium">
            Create your first project →
        </a>
    </div>
    @else
    <div class="projects-grid">
        @foreach($ownedProjects as $project)
        @include('portal.projects.partials.card', ['project' => $project, 'isOwner' => true])
        @endforeach
    </div>
    @endif
</div>

{{-- COLLABORATED PROJECTS --}}
<div class="panel">
    <div class="panel-header">
        <span class="panel-title">
            <i class="bi bi-people me-2"></i>Projects I Collaborate On
            <span class="ms-badge ms-2">{{ $collaboratedProjects->count() }}</span>
        </span>
    </div>

    @if($collaboratedProjects->isEmpty())
    <div class="panel-empty">
        <i class="bi bi-people"></i>
        You haven't joined any projects yet.
        <a href="{{ route('portal.projects.discover') }}" class="d-block mt-2 text-teal fw-medium">
            Browse open projects →
        </a>
    </div>
    @else
    <div class="projects-grid">
        @foreach($collaboratedProjects as $project)
        @include('portal.projects.partials.card', ['project' => $project, 'isOwner' => false])
        @endforeach
    </div>
    @endif
</div>

@endsection