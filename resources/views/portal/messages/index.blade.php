@extends('layouts.portal')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        {{-- Contacts List --}}
        <div class="col-md-4 col-lg-3 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Contacts</h6>
                </div>
                <ul class="list-group list-group-flush" style="max-height: 75vh; overflow-y:auto;">
                    @foreach($contacts as $contact)
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center
                        @if(isset($activeChat) && $activeChat->id == $contact->id) active @endif">
                        <a href="{{ route('messages.chat', $contact->id) }}" class="text-decoration-none text-dark w-100">
                            <div class="d-flex align-items-center">
                                <img src="{{ $contact->avatar ?? 'https://via.placeholder.com/40' }}"
                                    class="rounded-circle me-2" width="40" height="40" alt="avatar">
                                <div>
                                    <div class="fw-bold">{{ $contact->name }}</div>
                                    <small class="text-muted">{{ $contact->latestMessage?->body ?? '' }}</small>
                                </div>
                            </div>
                        </a>
                        @if($contact->unread_count > 0)
                        <span class="badge bg-danger rounded-pill">{{ $contact->unread_count }}</span>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Chat Window --}}
        <div class="col-md-8 col-lg-9 mb-3">
            <div class="card shadow-sm h-100 d-flex flex-column">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <div class="fw-bold">{{ $activeChat->name ?? 'Select a contact' }}</div>
                    @if(isset($activeChat))
                    <small class="text-muted">{{ $activeChat->online ? 'Online' : 'Offline' }}</small>
                    @endif
                </div>

                <div class="card-body flex-grow-1 overflow-auto" id="chatBox" style="height: 60vh;">
                    @if(isset($messages) && $messages->count() > 0)
                    @foreach($messages as $message)
                    <div class="d-flex mb-3 
            @if($message->sender_id == auth()->id()) justify-content-end @else justify-content-start @endif">
                        <div class="p-2 rounded 
                @if($message->sender_id == auth()->id()) bg-primary text-white @else bg-light text-dark @endif"
                            style="max-width: 70%;">
                            {{ $message->body }}
                            <div class="text-end text-muted" style="font-size:0.7rem;">
                                {{ $message->created_at->format('H:i') }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="text-center text-muted mt-4">
                        Select a contact to start chatting.
                    </div>
                    @endif
                </div>

                @if(isset($activeChat))
                <div class="card-footer bg-light">
                    <form id="messageForm" action="{{ route('messages.send', $activeChat->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="body" class="form-control" placeholder="Type a message..." required>
                            <button class="btn btn-gradient-primary" type="submit">Send</button>
                        </div>
                    </form>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

{{-- Styles --}}
<style>
    .btn-gradient-primary {
        background: linear-gradient(90deg, #4e54c8, #8f94fb);
        color: #fff;
        border: none;
    }

    .btn-gradient-primary:hover {
        opacity: .9;
    }

    .list-group-item.active {
        background: #4e54c8 !important;
        color: #fff;
    }

    #chatBox::-webkit-scrollbar {
        width: 6px;
    }

    #chatBox::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }
</style>

{{-- Optional: Auto-scroll chat to bottom --}}
<script>
    const chatBox = document.getElementById('chatBox');
    if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
</script>
@endsection