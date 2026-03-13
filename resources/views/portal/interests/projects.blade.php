@extends('layouts.portal')
@section('title', $interest->name . ' — Projects')

@section('content')

{{-- ── TOPIC HERO ───────────────────────────────────────────────── --}}
<div class="topic-hero panel mb-4">

    <div class="topic-hero-cover">
        <div class="topic-hero-cover-inner"></div>
    </div>

    <div class="topic-hero-body">

        <div class="topic-hero-info">
            <div class="topic-hero-category">
                <i class="bi bi-folder me-1"></i>{{ $interest->category }}
            </div>
            <h1 class="topic-hero-title">{{ $interest->name }}</h1>
            @if($interest->description)
                <p class="topic-hero-desc">{{ $interest->description }}</p>
            @endif

            <div class="topic-hero-meta">
                <span><i class="bi bi-folder2-open me-1"></i>{{ $stats['total'] }} projects</span>
                <span class="pf-sub-dot">·</span>
                <span><i class="bi bi-play-circle me-1"></i>{{ $stats['active'] }} active</span>
                <span class="pf-sub-dot">·</span>
                <span><i class="bi bi-people me-1"></i>{{ $stats['followers'] }} followers</span>
            </div>
        </div>

        <div class="topic-hero-actions">
            {{-- Follow/Unfollow --}}
            <button type="button"
                    class="btn {{ $isFollowing ? 'btn-secondary' : 'btn-primary' }} topic-hero-follow"
                    data-id="{{ $interest->id }}"
                    data-url="{{ route('portal.interests.toggle', $interest) }}">
                @if($isFollowing)
                    <i class="bi bi-check-lg me-1"></i> Following
                @else
                    <i class="bi bi-plus-lg me-1"></i> Follow Topic
                @endif
            </button>
            <a href="{{ route('portal.interests.index') }}"
               class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> All Topics
            </a>
        </div>

    </div>
</div>

{{-- Flash --}}
@if(session('success'))
    <div class="alert alert-success mb-4">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    </div>
@endif

{{-- ── MAIN LAYOUT ──────────────────────────────────────────────── --}}
<div class="topic-projects-layout">

    {{-- ── LEFT — Projects ───────────────────────────────────────── --}}
    <div class="topic-projects-main">

        {{-- Filters --}}
        <form method="GET"
              action="{{ route('portal.interests.projects', $interest) }}"
              class="mb-4">
            <div class="panel">
                <div class="panel-body py-3">
                    <div class="discover-filters">

                        <div class="filter-search">
                            <i class="bi bi-search"></i>
                            <input type="text"
                                   name="search"
                                   class="filter-search-input"
                                   placeholder="Search projects..."
                                   value="{{ request('search') }}">
                        </div>

                        <select name="status" class="form-select filter-select">
                            <option value="">All Statuses</option>
                            @foreach(['active' => 'Active', 'ongoing' => 'Ongoing', 'under review' => 'Under Review', 'completed' => 'Completed'] as $val => $label)
                                <option value="{{ $val }}"
                                    {{ request('status') === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>

                        <select name="sort" class="form-select filter-select">
                            <option value="latest"       {{ request('sort','latest') === 'latest'       ? 'selected' : '' }}>Latest</option>
                            <option value="oldest"       {{ request('sort') === 'oldest'       ? 'selected' : '' }}>Oldest</option>
                            <option value="collaborators"{{ request('sort') === 'collaborators' ? 'selected' : '' }}>Most Collaborators</option>
                            <option value="milestones"   {{ request('sort') === 'milestones'   ? 'selected' : '' }}>Most Milestones</option>
                        </select>

                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi bi-funnel me-1"></i> Filter
                        </button>

                        @if(request()->hasAny(['search','status','sort']))
                            <a href="{{ route('portal.interests.projects', $interest) }}"
                               class="btn btn-secondary btn-sm">
                                <i class="bi bi-x me-1"></i> Clear
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </form>

        {{-- Results count --}}
        <div class="d-flex align-items-center justify-content-between mb-3">
            <p class="text-muted mb-0" style="font-size:.85rem;">
                <strong>{{ $projects->total() }}</strong>
                project{{ $projects->total() !== 1 ? 's' : '' }} found
            </p>
            <p class="text-muted mb-0" style="font-size:.82rem;">
                Page {{ $projects->currentPage() }} of {{ $projects->lastPage() }}
            </p>
        </div>

        {{-- Project Cards --}}
        @forelse($projects as $project)
        <div class="tp-project-card panel mb-3">

            <div class="tp-card-body">

                {{-- Top row --}}
                <div class="tp-card-top">
                    <div class="tp-card-icon">
                        {{ strtoupper(substr($project->title, 0, 1)) }}
                    </div>
                    <div class="tp-card-info">
                        <a href="{{ route('portal.projects.show', $project) }}"
                           class="tp-card-title">
                            {{ $project->title }}
                        </a>
                        <div class="tp-card-owner">
                            <div class="tp-owner-avatar">
                                {{ strtoupper(substr($project->owner->name, 0, 2)) }}
                            </div>
                            <span>{{ $project->owner->name }}</span>
                            <span class="role-pill {{ $project->owner->role }}" style="font-size:.65rem;">
                                {{ ucfirst($project->owner->role) }}
                            </span>
                        </div>
                    </div>
                    <span class="status-badge status-{{ str_replace(' ', '_', $project->status) }} flex-shrink-0">
                        {{ ucfirst($project->status) }}
                    </span>
                </div>

                {{-- Description --}}
                <p class="tp-card-desc">
                    {{ Str::limit($project->description, 180) }}
                </p>

                {{-- Footer --}}
                <div class="tp-card-footer">

                    <div class="tp-card-stats">
                        <span>
                            <i class="bi bi-people me-1"></i>
                            {{ $project->collaborators_count }}
                            collaborator{{ $project->collaborators_count !== 1 ? 's' : '' }}
                        </span>
                        <span>
                            <i class="bi bi-check2-square me-1"></i>
                            {{ $project->milestones_count }}
                            milestone{{ $project->milestones_count !== 1 ? 's' : '' }}
                        </span>
                        @if($project->start_date)
                            <span>
                                <i class="bi bi-calendar me-1"></i>
                                {{ $project->start_date->format('M Y') }}
                            </span>
                        @endif
                    </div>

                    <div class="tp-card-actions">
                        <a href="{{ route('portal.projects.show', $project) }}"
                           class="btn btn-secondary btn-sm">
                            <i class="bi bi-eye me-1"></i> View
                        </a>

                        @php
                            $alreadyIn  = in_array($project->id, $myProjectIds);
                            $isOwner    = $project->owner_id === auth()->id();
                            $isAccepted = $project->collaborators
                                ->where('id', auth()->id())
                                ->where('pivot.status', 'accepted')
                                ->isNotEmpty();
                            $isPending  = $project->collaborators
                                ->where('id', auth()->id())
                                ->where('pivot.status', 'pending')
                                ->isNotEmpty();
                            $available  = in_array($project->status, ['active', 'ongoing']);
                        @endphp

                        @if($isOwner)
                            <a href="{{ route('portal.projects.edit', $project) }}"
                               class="btn btn-secondary btn-sm">
                                <i class="bi bi-pencil me-1"></i> Edit
                            </a>
                        @elseif($isAccepted)
                            <span class="btn btn-secondary btn-sm" style="cursor:default;">
                                <i class="bi bi-check-circle me-1 text-success"></i> Joined
                            </span>
                        @elseif($isPending)
                            <button class="btn btn-secondary btn-sm" disabled>
                                <i class="bi bi-clock me-1"></i> Pending
                            </button>
                        @elseif($available)
                            <form method="POST"
                                  action="{{ route('portal.collaborators.request', $project) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="bi bi-person-plus me-1"></i> Request to Work
                                </button>
                            </form>
                        @else
                            <button class="btn btn-secondary btn-sm" disabled
                                    title="Project is {{ $project->status }}">
                                <i class="bi bi-lock me-1"></i> Not Accepting
                            </button>
                        @endif

                    </div>
                </div>

            </div>
        </div>
        @empty
            <div class="panel">
                <div class="panel-empty" style="padding:3rem;">
                    <i class="bi bi-folder2-open" style="font-size:2.5rem;opacity:.3;display:block;margin-bottom:12px;"></i>
                    No projects found for <strong>{{ $interest->name }}</strong> yet.
                    <a href="{{ route('portal.projects.create') }}"
                       class="d-block mt-2 text-teal fw-medium">
                        Start one yourself →
                    </a>
                </div>
            </div>
        @endforelse

        {{-- Pagination --}}
        @if($projects->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $projects->links('vendor.pagination.portal') }}
            </div>
        @endif

    </div>

    {{-- ── RIGHT — Sidebar ────────────────────────────────────────── --}}
    <div class="topic-projects-sidebar">

        {{-- Topic Stats --}}
        <div class="panel mb-4">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-bar-chart me-2"></i>Topic Overview
                </span>
            </div>
            <div class="panel-body py-2">
                <dl class="pf-details-list">
                    <div class="pf-detail-row">
                        <dt><i class="bi bi-folder2-open"></i> Total Projects</dt>
                        <dd>{{ $stats['total'] }}</dd>
                    </div>
                    <div class="pf-detail-row">
                        <dt><i class="bi bi-play-circle"></i> Active</dt>
                        <dd>{{ $stats['active'] }}</dd>
                    </div>
                    <div class="pf-detail-row">
                        <dt><i class="bi bi-people"></i> Followers</dt>
                        <dd id="heroFollowerCount">{{ $stats['followers'] }}</dd>
                    </div>
                    <div class="pf-detail-row">
                        <dt><i class="bi bi-tag"></i> Category</dt>
                        <dd>{{ $interest->category }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        {{-- How it works --}}
        <div class="panel mb-4">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-info-circle me-2"></i>How to Join
                </span>
            </div>
            <div class="panel-body py-3">
                <div class="tp-how-steps">
                    <div class="tp-step">
                        <div class="tp-step-num">1</div>
                        <div class="tp-step-text">
                            Browse active projects and click <strong>View</strong> to learn more
                        </div>
                    </div>
                    <div class="tp-step">
                        <div class="tp-step-num">2</div>
                        <div class="tp-step-text">
                            Click <strong>Request to Work</strong> on any open project
                        </div>
                    </div>
                    <div class="tp-step">
                        <div class="tp-step-num">3</div>
                        <div class="tp-step-text">
                            Wait for the project owner to <strong>accept</strong> your request
                        </div>
                    </div>
                    <div class="tp-step">
                        <div class="tp-step-num">4</div>
                        <div class="tp-step-text">
                            Start collaborating on <strong>milestones</strong>!
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Topics --}}
        @if($relatedTopics->isNotEmpty())
        <div class="panel">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-diagram-2 me-2"></i>Related Topics
                </span>
            </div>
            <div class="panel-body py-2">
                @foreach($relatedTopics as $related)
                <a href="{{ route('portal.interests.projects', $related) }}"
                   class="tp-related-topic">
                    <span class="tp-related-name">{{ $related->name }}</span>
                    <span class="tp-related-count">
                        {{ $related->followers_count }}
                        <i class="bi bi-people ms-1"></i>
                    </span>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>

</div>

@endsection

@push('scripts')
<script>
const csrf = '{{ csrf_token() }}';

// ── Follow/Unfollow from hero ────────────────────────────────────────
$('.topic-hero-follow').on('click', function () {
    const btn = $(this);
    const url = btn.data('url');

    btn.prop('disabled', true);

    $.ajax({
        url, method: 'POST',
        data: { _token: csrf },
        success: function (res) {
            if (res.following) {
                btn.removeClass('btn-primary')
                   .addClass('btn-secondary')
                   .html('<i class="bi bi-check-lg me-1"></i> Following');
            } else {
                btn.removeClass('btn-secondary')
                   .addClass('btn-primary')
                   .html('<i class="bi bi-plus-lg me-1"></i> Follow Topic');
            }
            $('#heroFollowerCount').text(res.count);
            btn.prop('disabled', false);
        },
        error: function () {
            btn.prop('disabled', false);
            Swal.fire('Error', 'Could not update. Please try again.', 'error');
        }
    });
});
</script>
@endpush