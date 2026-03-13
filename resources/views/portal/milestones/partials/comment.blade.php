<div class="comment-item" id="comment-{{ $comment->id }}">

    <div class="comment-avatar">
        {{ strtoupper(substr($comment->user->name, 0, 2)) }}
    </div>

    <div class="comment-content">
        <div class="comment-meta">
            <span class="comment-author">{{ $comment->user->name }}</span>
            <span class="comment-role">{{ ucfirst($comment->user->role) }}</span>
            <span class="comment-time">
                {{ $comment->created_at->diffForHumans() }}
            </span>

            @if(auth()->id() === $comment->user_id)
                <div class="comment-actions ms-auto">
                    <button class="comment-action-btn btn-edit-comment"
                            data-id="{{ $comment->id }}"
                            title="Edit">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="comment-action-btn btn-delete-comment"
                            data-id="{{ $comment->id }}"
                            title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            @endif
        </div>

        <div class="comment-body">{{ $comment->comment }}</div>
    </div>

</div>