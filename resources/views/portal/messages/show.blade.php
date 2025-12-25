@extends('layouts.portal')
@section('content')
<div class="container-fluid p-0 vh-100 d-flex flex-column">

    <!-- Header -->
    <div class="bg-white shadow-sm p-3 d-flex align-items-center justify-content-between sticky-top" style="z-index:10;">
        <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary btn-sm">← Back</a>
        <h5 class="m-0">{{ $user->name }}</h5>
        <span></span>
    </div>

    <!-- Chat Area -->
    <div class="flex-grow-1 overflow-auto p-3" id="chatArea" style="background:#e5ddd5;">
        @foreach($messages as $msg)
            <div class="d-flex mb-2 {{ $msg->sender_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                <div class="chat-bubble {{ $msg->sender_id == auth()->id() ? 'sent' : 'received' }}">
                    {{ $msg->body }}
                    <br>
                    <small class="text-muted">{{ $msg->created_at->format('H:i') }}</small>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Input Area -->
    <form action="{{ route('messages.store', $user->id) }}" method="POST" class="bg-white p-3 d-flex align-items-center shadow-sm">
        @csrf
        <input type="text" name="body" class="form-control me-2" placeholder="Type a message..." required>
        <button class="btn btn-gradient-primary">Send</button>
    </form>
</div>

<style>
    /* Chat bubbles */
    .chat-bubble {
        max-width: 70%;
        padding: 10px 15px;
        border-radius: 20px;
        word-wrap: break-word;
        font-size: 0.95rem;
        line-height: 1.4;
    }

    .sent {
        background: #dcf8c6;
        border-bottom-right-radius: 0;
    }

    .received {
        background: #fff;
        border-bottom-left-radius: 0;
    }

    /* Scrollbar */
    #chatArea {
        scrollbar-width: thin;
        scrollbar-color: #ccc transparent;
    }

    #chatArea::-webkit-scrollbar {
        width: 6px;
    }

    #chatArea::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 3px;
    }

    /* Gradient button */
    .btn-gradient-primary {
        background: linear-gradient(90deg, #4e54c8, #8f94fb);
        color: #fff;
        border: none;
    }

    .btn-gradient-primary:hover {
        opacity: 0.9;
    }
</style>

<script>
    // Auto scroll to bottom
    let chatArea = document.getElementById('chatArea');
    chatArea.scrollTop = chatArea.scrollHeight;
</script>
@endsection
