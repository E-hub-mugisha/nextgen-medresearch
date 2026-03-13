@php
    $isOwner = $isOwner ?? false;
@endphp

<div class="project-card">

    {{-- Header --}}
    <div class="project-card-header">
        <div class="project-card-icon">
            {{ strtoupper(substr($project->title, 0, 1)) }}
        </div>
        <div class="ms-auto d-flex align-items-center gap-2">
            <span class="status-badge status-{{ str_replace(' ', '_', $project->status) }}">
                {{ ucfirst($project->status) }}
            </span>

            @if($isOwner)
            <div class="dropdown">
                <button class="icon-btn border-0 bg-transparent"
                        data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item"
                           href="{{ route('portal.projects.show', $project) }}">
                            <i class="bi bi-eye me-2"></i>View
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item"
                           href="{{ route('portal.projects.edit', $project) }}">
                            <i class="bi bi-pencil me-2"></i>Edit
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item"
                           href="{{ route('projects.milestones.create', $project) }}">
                            <i class="bi bi-plus-circle me-2"></i>Add Milestone
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST"
                              action="{{ route('portal.projects.destroy', $project) }}"
                              onsubmit="return confirm('Delete this project?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-trash me-2"></i>Delete
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            @endif
        </div>
    </div>

    {{-- Title --}}
    <a href="{{ route('portal.projects.show', $project) }}"
       class="project-card-title">
        {{ $project->title }}
    </a>

    {{-- Description --}}
    <p class="project-card-desc">
        {{ Str::limit($project->description, 100) }}
    </p>

    {{-- Research Area --}}
    @if($project->research_area)
    <span class="project-area-tag">
        <i class="bi bi-tag me-1"></i>{{ $project->research_area }}
    </span>
    @endif

    {{-- Footer --}}
    <div class="project-card-footer">
        <span>
            <i class="bi bi-people me-1"></i>
            {{ $project->collaborators_count ?? 0 }}
        </span>
        <span>
            <i class="bi bi-check2-square me-1"></i>
            {{ $project->milestones_count ?? 0 }}
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