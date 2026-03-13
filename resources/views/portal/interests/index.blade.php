@extends('layouts.portal')
@section('title', 'Research Topics')

@section('content')

{{-- Header --}}
<div class="page-header-row">
    <div>
        <h1 class="page-title">Research Topics</h1>
        <p class="page-subtitle">
            Follow topics to connect with relevant projects and people
        </p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <span class="text-muted" style="font-size:.82rem;">
            <strong>{{ count($myIds) }}</strong> topics followed
        </span>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success mb-4">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
</div>
@endif

{{-- FILTERS ──────────────────────────────────────────────────────── --}}
<form method="GET" action="{{ route('portal.interests.index') }}">
    <div class="panel mb-4">
        <div class="panel-body py-3">
            <div class="discover-filters">

                {{-- Search --}}
                <div class="filter-search">
                    <i class="bi bi-search"></i>
                    <input type="text"
                        name="search"
                        class="filter-search-input"
                        placeholder="Search topics..."
                        value="{{ request('search') }}">
                </div>

                {{-- Category --}}
                <select name="category" class="form-select filter-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat }}"
                        {{ request('category') === $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                    @endforeach
                </select>

                {{-- Mine only --}}
                <label class="people-filter-check">
                    <input type="checkbox"
                        name="mine"
                        value="1"
                        {{ request('mine') ? 'checked' : '' }}>
                    <span>Following only</span>
                </label>

                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>

                @if(request()->hasAny(['search', 'category', 'mine']))
                <a href="{{ route('portal.interests.index') }}"
                    class="btn btn-secondary btn-sm">
                    <i class="bi bi-x me-1"></i> Clear
                </a>
                @endif

            </div>
        </div>
    </div>
</form>

{{-- TOPICS BY CATEGORY ───────────────────────────────────────────── --}}
@forelse($topics as $category => $items)
<div class="panel mb-4">

    <div class="panel-header">
        <span class="panel-title">
            <i class="bi bi-folder me-2" style="color:var(--teal-600)"></i>
            {{ $category }}
            <span class="ms-badge ms-2">{{ $items->count() }}</span>
        </span>
        <span class="text-muted" style="font-size:.78rem;">
            {{ $items->where('id', fn($id) => in_array($id, $myIds))->count() }}
            / {{ $items->count() }} followed
        </span>
    </div>

    <div class="panel-body py-3">
        <div class="topics-grid">
            @foreach($items as $topic)
            <div class="topic-card {{ in_array($topic->id, $myIds) ? 'followed' : '' }}"
                id="topic-{{ $topic->id }}">

                <div class="topic-card-body">
                    <span class="topic-name">{{ $topic->name }}</span>
                    @if($topic->description)
                    <span class="topic-desc">{{ $topic->description }}</span>
                    @endif
                    <div class="d-flex align-items-center gap-2 mt-1">
                        <span class="topic-followers">
                            <i class="bi bi-people me-1"></i>
                            <span class="topic-count-{{ $topic->id }}">{{ $topic->followers_count }}</span>
                            followers
                        </span>
                        <span class="topic-sep">·</span>
                        <a href="{{ route('portal.interests.projects', $topic) }}"
                            class="topic-view-link">
                            View projects →
                        </a>
                    </div>
                </div>

                <button type="button"
                    class="topic-follow-btn {{ in_array($topic->id, $myIds) ? 'following' : '' }}"
                    data-id="{{ $topic->id }}"
                    data-url="{{ route('portal.interests.toggle', $topic) }}">
                    @if(in_array($topic->id, $myIds))
                    <i class="bi bi-check-lg"></i><span>Following</span>
                    @else
                    <i class="bi bi-plus-lg"></i><span>Follow</span>
                    @endif
                </button>

            </div>
            @endforeach
        </div>
    </div>

</div>
@empty
<div class="panel">
    <div class="panel-empty" style="padding:3rem;">
        <i class="bi bi-search" style="font-size:2.5rem;opacity:.3;display:block;margin-bottom:12px;"></i>
        No topics found.
        <a href="{{ route('portal.interests.index') }}"
            class="d-block mt-2 text-teal fw-medium">
            Clear filters →
        </a>
    </div>
</div>
@endforelse

@endsection

@push('scripts')
<script>
    const csrf = '{{ csrf_token() }}';

    // ── Toggle follow ────────────────────────────────────────────────────
    $(document).on('click', '.topic-follow-btn', function() {
        const btn = $(this);
        const id = btn.data('id');
        const url = btn.data('url');
        const card = $('#topic-' + id);

        btn.prop('disabled', true);

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: csrf
            },
            success: function(res) {
                if (res.following) {
                    btn.addClass('following')
                        .html('<i class="bi bi-check-lg"></i><span>Following</span>');
                    card.addClass('followed');
                } else {
                    btn.removeClass('following')
                        .html('<i class="bi bi-plus-lg"></i><span>Follow</span>');
                    card.removeClass('followed');
                }

                // Update follower count
                $('.topic-count-' + id).text(res.count);

                // Update header count
                updateFollowingCount();

                btn.prop('disabled', false);
            },
            error: function() {
                btn.prop('disabled', false);
                Swal.fire('Error', 'Could not update. Please try again.', 'error');
            }
        });
    });

    function updateFollowingCount() {
        const count = $('.topic-follow-btn.following').length;
        $('strong').filter(function() {
            return $(this).closest('.page-header-row').length > 0;
        }).first().text(count);
    }
</script>
@endpush