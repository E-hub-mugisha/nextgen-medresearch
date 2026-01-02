@extends('layouts.portal')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">

        {{-- ================= CONTACTS LIST ================= --}}
        <div class="col-md-4 col-lg-3 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Contacts</h6>
                </div>

                <ul class="list-group list-group-flush" style="max-height: 75vh; overflow-y:auto;">
                    @forelse($contacts as $contact)
                        <li class="list-group-item list-group-item-action
                            @if(isset($activeChat) && $activeChat->id === $contact->id) active @endif">

                            <a href="{{ route('messages.chat', $contact->id) }}"
                               class="text-decoration-none w-100 d-flex align-items-center">

                                <img src="{{ $contact->avatar ?? 'https://via.placeholder.com/40' }}"
                                     class="rounded-circle me-2" width="40" height="40">

                                <div class="flex-grow-1">
                                    <div class="fw-bold text-truncate">{{ $contact->name }}</div>

                                    <small class="text-muted text-truncate d-block">
                                        {{ Str::limit(
                                            $contact->messages()
                                                ->where(function ($q) {
                                                    $q->where('sender_id', auth()->id())
                                                      ->orWhere('receiver_id', auth()->id());
                                                })
                                                ->latest()
                                                ->value('body'),
                                            35
                                        ) }}
                                    </small>
                                </div>

                                @if($contact->unread_count > 0)
                                    <span class="badge bg-danger rounded-pill ms-2">{{ $contact->unread_count }}</span>
                                @endif
                            </a>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted">No contacts yet</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- ================= CHAT WINDOW ================= --}}
        <div class="col-md-8 col-lg-9 mb-3">
            <div class="card shadow-sm h-100 d-flex flex-column">

                {{-- Chat Header --}}
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <div class="fw-bold">
                        {{ $activeChat->name ?? 'Select a contact' }}
                    </div>
                    @if(isset($activeChat))
                        <small class="text-muted">
                            {{ $activeChat->online ? 'Online' : 'Offline' }}
                        </small>
                    @endif
                </div>

                {{-- Messages --}}
                <div class="card-body flex-grow-1 overflow-auto" id="chatBox" style="height:60vh;">
                    @if(isset($activeChat) && $messages->count())
                        @foreach($messages as $message)
                            <div class="d-flex mb-3
                                {{ $message->sender_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">

                                <div class="p-3 rounded
                                    {{ $message->sender_id === auth()->id() ? 'bg-primary text-white' : 'bg-light text-dark' }}"
                                    style="max-width:70%;">

                                    {{-- Project title (if any) --}}
                                    @if($message->project)
                                        <div class="small fw-bold mb-1">{{ $message->project->title }}</div>
                                    @endif

                                    <div>{{ $message->body }}</div>

                                    <div class="text-end opacity-75" style="font-size:0.7rem;">
                                        {{ $message->created_at->format('d M, H:i') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @elseif(isset($activeChat))
                        <div class="text-center text-muted mt-4">
                            No messages yet. Say hello 👋
                        </div>
                    @else
                        <div class="text-center text-muted mt-4">
                            Select a contact to start chatting
                        </div>
                    @endif
                </div>

                {{-- Message Form --}}
                @if(isset($activeChat))
                <div class="card-footer bg-light">

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mb-2">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('messages.send', $activeChat->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text"
                                   name="body"
                                   class="form-control @error('body') is-invalid @enderror"
                                   placeholder="Type a message..."
                                   value="{{ old('body') }}"
                                   required>
                                   <input type="hidden" name="project_id" value="{{ $activeChat->project_id }}">
                                   <input type="hidden" name="project_title" value="{{ $activeChat->project_title }}">
                                   <input type="hidden" name="recipient_id" value="{{ $activeChat->id }}">
                            <button class="btn btn-gradient-primary" type="submit">Send</button>
                        </div>

                        @error('body')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

{{-- Auto-scroll chat --}}
<script>
    const chatBox = document.getElementById('chatBox');
    if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
</script>

@endsection
