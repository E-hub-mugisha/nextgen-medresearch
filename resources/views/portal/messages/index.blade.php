@extends('layouts.portal')

@section('content')
<div class="container-fluid mt-4">
    <div class="row" style="height: 80vh;">

        <!-- Contacts List -->
        <div class="col-md-4 col-lg-3 border-end p-0" style="height: 100%; overflow-y: auto;">
            <div class="list-group list-group-flush">
                @foreach($contacts as $contact)
                    <a href="{{ route('messages.show', $contact->id) }}"
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center
                       {{ request()->segment(2) == $contact->id ? 'active' : '' }}">
                        <div>
                            <strong>{{ $contact->name }}</strong>
                        </div>
                        <small class="text-muted">{{ $contact->messages_count ?? 0 }} msgs</small>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Chat Area -->
        <div class="col-md-8 col-lg-9 d-flex flex-column p-0" style="height: 100%;">
            @if(isset($user))
            <div class="border-bottom p-3 bg-white sticky-top d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $user->name }}</h5>
                <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary btn-sm">← Back</a>
            </div>

            <div class="flex-grow-1 p-3" style="overflow-y: auto;" id="chatArea">
                @foreach($messages as $message)
                    @if($message->sender_id == auth()->id())
                        <div class="text-end mb-2">
                            <span class="badge bg-primary text-wrap p-2">{{ $message->body }}</span>
                            <small class="d-block text-muted">{{ $message->created_at->format('H:i') }}</small>
                        </div>
                    @else
                        <div class="text-start mb-2">
                            <span class="badge bg-secondary text-wrap p-2">{{ $message->body }}</span>
                            <small class="d-block text-muted">{{ $message->created_at->format('H:i') }}</small>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Message Input -->
            <div class="p-3 border-top bg-light">
                <form action="{{ route('messages.store', $user->id) }}" method="POST" class="d-flex">
                    @csrf
                    <input type="text" name="body" class="form-control me-2" placeholder="Type a message..." required>
                    <button class="btn btn-gradient-primary">Send</button>
                </form>
            </div>
            @else
            <div class="d-flex justify-content-center align-items-center h-100">
                <p class="text-muted">Select a contact to start messaging</p>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Gradient Buttons */
    .btn-gradient-primary {
        background: linear-gradient(90deg, #4e54c8, #8f94fb);
        color: #fff;
        border: none;
    }
    .btn-gradient-primary:hover {
        opacity: 0.9;
    }

    /* Chat badges */
    .badge {
        border-radius: 15px;
        max-width: 75%;
        display: inline-block;
    }

    /* Scrollbar styling */
    #chatArea::-webkit-scrollbar {
        width: 6px;
    }
    #chatArea::-webkit-scrollbar-thumb {
        background-color: rgba(0,0,0,0.2);
        border-radius: 3px;
    }
</style>

<script>
    // Scroll to bottom of chat on load
    window.addEventListener('load', function() {
        var chat = document.getElementById('chatArea');
        if(chat) chat.scrollTop = chat.scrollHeight;
    });
</script>
@endsection
