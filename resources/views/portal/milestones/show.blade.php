@extends('layouts.portal')
@section('title', $milestone->title)

@section('content')

{{-- Breadcrumb --}}
<div class="page-header-row">
    <div>
        <a href="{{ route('portal.projects.show', $project) }}" class="breadcrumb-link">
            <i class="bi bi-arrow-left me-1"></i>{{ $project->title }}
        </a>
        <h1 class="page-title mt-1">{{ $milestone->title }}</h1>
        <div class="d-flex align-items-center gap-2 mt-1">
            <span class="status-badge status-{{ $milestone->status }}">
                {{ ucfirst(str_replace('_', ' ', $milestone->status)) }}
            </span>
            @if($milestone->due_date)
                <span class="text-muted" style="font-size:.82rem;">
                    <i class="bi bi-calendar2 me-1"></i>
                    Due {{ $milestone->due_date->format('M d, Y') }}
                </span>
            @endif
        </div>
    </div>
    <div class="d-flex gap-2">
        {{-- Quick status dropdown --}}
        <div class="dropdown">
            <button class="btn btn-secondary btn-sm dropdown-toggle"
                    data-bs-toggle="dropdown">
                <i class="bi bi-arrow-repeat me-1"></i>Change Status
            </button>
            <ul class="dropdown-menu">
                @foreach(['todo' => 'To Do', 'in_progress' => 'In Progress', 'done' => 'Done'] as $val => $label)
                    <li>
                        <button class="dropdown-item btn-status-change
                                {{ $milestone->status === $val ? 'active' : '' }}"
                                data-id="{{ $milestone->id }}"
                                data-status="{{ $val }}">
                            {{ $label }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        @if($isOwner)
            <a href="{{ route('milestones.edit', $milestone) }}"
               class="btn btn-secondary btn-sm">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <form method="POST"
                  action="{{ route('milestones.destroy', $milestone) }}"
                  onsubmit="return confirm('Delete this milestone?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        @endif
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success mb-4">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    </div>
@endif

<div class="milestone-show-layout">

    {{-- LEFT — Description + Comments --}}
    <div class="milestone-show-main">

        {{-- Description --}}
        @if($milestone->description)
        <div class="panel mb-4">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-file-text me-2"></i>Description
                </span>
            </div>
            <div class="panel-body py-3">
                <p style="font-size:.9rem;line-height:1.8;color:var(--gray-700);">
                    {{ $milestone->description }}
                </p>
            </div>
        </div>
        @endif

        {{-- COMMENTS --}}
        <div class="panel">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-chat-left-text me-2"></i>Comments
                    <span class="ms-badge ms-2">
                        {{ $milestone->comments->count() }}
                    </span>
                </span>
            </div>

            {{-- Comment List --}}
            <div class="panel-body" id="commentsList">
                @forelse($milestone->comments as $comment)
                    @include('portal.milestones.partials.comment',
                             ['comment' => $comment])
                @empty
                    <div class="panel-empty" id="noComments">
                        <i class="bi bi-chat"></i>
                        No comments yet. Be the first to comment.
                    </div>
                @endforelse
            </div>

            {{-- Add Comment Form --}}
            <div class="comment-form-wrap">
                <div class="comment-form-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="comment-form-body">
                    <textarea id="commentBody"
                              class="form-control"
                              rows="2"
                              placeholder="Write a comment..."></textarea>
                    <div class="d-flex justify-content-end mt-2">
                        <button id="submitComment"
                                class="btn btn-primary btn-sm">
                            <i class="bi bi-send me-1"></i>Post Comment
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- RIGHT — Info Sidebar --}}
    <div class="milestone-show-sidebar">
        <div class="panel">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-info-circle me-2"></i>Details
                </span>
            </div>
            <div class="panel-body">
                <table class="details-table">
                    <tr>
                        <td>Status</td>
                        <td>
                            <span class="status-badge status-{{ $milestone->status }}">
                                {{ ucfirst(str_replace('_', ' ', $milestone->status)) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Due Date</td>
                        <td>{{ $milestone->due_date?->format('M d, Y') ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td>Project</td>
                        <td>
                            <a href="{{ route('portal.projects.show', $project) }}"
                               class="text-teal fw-medium" style="font-size:.8rem;">
                                {{ Str::limit($project->title, 30) }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Comments</td>
                        <td>{{ $milestone->comments->count() }}</td>
                    </tr>
                    <tr>
                        <td>Created</td>
                        <td>{{ $milestone->created_at->format('M d, Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
const milestoneId   = {{ $milestone->id }};
const csrfToken     = '{{ csrf_token() }}';
const currentUserId = {{ auth()->id() }};

// ── Post Comment ────────────────────────────────────────────────────────
$('#submitComment').on('click', function () {
    const body = $('#commentBody').val().trim();
    if (!body) return;

    $(this).prop('disabled', true).html('<i class="bi bi-hourglass"></i>');

    $.ajax({
        url:    '/milestones/' + milestoneId + '/comments',
        method: 'POST',
        data:   { _token: csrfToken, body },
        success: function (res) {
            $('#noComments').remove();
            $('#commentsList').append(res.html);
            $('#commentBody').val('');
            $('#submitComment').prop('disabled', false)
                .html('<i class="bi bi-send me-1"></i>Post Comment');

            // Update comment count badge
            const badge = $('.ms-badge');
            badge.text(parseInt(badge.text()) + 1);
        },
        error: function () {
            $('#submitComment').prop('disabled', false)
                .html('<i class="bi bi-send me-1"></i>Post Comment');
            Swal.fire('Error', 'Could not post comment.', 'error');
        }
    });
});

// ── Delete Comment ──────────────────────────────────────────────────────
$(document).on('click', '.btn-delete-comment', function () {
    const id  = $(this).data('id');
    const row = $(this).closest('.comment-item');

    Swal.fire({
        title: 'Delete this comment?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        confirmButtonColor: '#dc3545',
    }).then(result => {
        if (!result.isConfirmed) return;
        $.ajax({
            url:    '/comments/' + id,
            method: 'POST',
            data:   { _token: csrfToken, _method: 'DELETE' },
            success: function () {
                row.fadeOut(200, function () {
                    $(this).remove();
                    const badge = $('.ms-badge');
                    const count = parseInt(badge.text()) - 1;
                    badge.text(count);
                    if (count === 0) {
                        $('#commentsList').html(`
                            <div class="panel-empty" id="noComments">
                                <i class="bi bi-chat"></i>
                                No comments yet.
                            </div>
                        `);
                    }
                });
            }
        });
    });
});

// ── Inline Edit ─────────────────────────────────────────────────────
$(document).on('click', '.btn-edit-comment', function () {
    const id   = $(this).data('id');
    const item = $(this).closest('.comment-item');
    const body = item.find('.comment-body').text().trim(); // reads display text

    item.find('.comment-body').html(`
        <textarea class="form-control comment-edit-input" rows="2">${body}</textarea>
        <div class="d-flex gap-2 mt-2">
            <button class="btn btn-primary btn-sm btn-save-comment" data-id="${id}">Save</button>
            <button class="btn btn-secondary btn-sm btn-cancel-edit">Cancel</button>
        </div>
    `);
    $(this).hide();
    item.find('.btn-delete-comment').hide();
});

$(document).on('click', '.btn-cancel-edit', function () {
    location.reload();
});

$(document).on('click', '.btn-save-comment', function () {
    const id   = $(this).data('id');
    const body = $(this).closest('.comment-item').find('.comment-edit-input').val().trim();
    if (!body) return;

    $.ajax({
        url:    '/comments/' + id,
        method: 'POST',
        data:   { _token: csrfToken, _method: 'PATCH', body },
        success: function (res) {
            location.reload();
        }
    });
});

// ── Change Status ───────────────────────────────────────────────────────
$(document).on('click', '.btn-status-change', function () {
    const status = $(this).data('status');
    $.ajax({
        url:    '/milestones/' + milestoneId + '/status',
        method: 'POST',
        data:   { _token: csrfToken, _method: 'PATCH', status },
        success: function () { location.reload(); }
    });
});
</script>
@endpush