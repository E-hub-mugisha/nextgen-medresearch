@extends('layouts.portal')

@section('title', 'My Selected Topics')

@section('content')
<div class="container py-4">
    <h4>My Selected Research Topics</h4>

    @if($topics->isEmpty())
    <div class="alert alert-info">You have not selected any research topics yet.</div>
    @else
    <div class="row g-3">
        @foreach($topics as $research)
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-semibold">{{ $research->title }}</h5>

                    <p class="text-muted small">
                        {{ Str::limit($research->description, 150) }}
                    </p>

                    <p><strong>Target Area:</strong> {{ $research->target_area }}</p>
                    <p><strong>Importance:</strong> {{ Str::limit($research->importance, 120) }}</p>
                    <p><strong>Impact:</strong> {{ Str::limit($research->impact, 120) }}</p>

                    <p>
                        <strong>Status:</strong>
                        <span class="badge 
                                    @if($research->status=='completed') bg-success
                                    @elseif($research->status=='ongoing') bg-warning
                                    @elseif($research->status=='under review') bg-info
                                    @else bg-secondary @endif">
                            {{ ucfirst($research->status) }}
                        </span>
                    </p>

                    <p><strong>Selected At:</strong> {{ $research->pivot->created_at->format('d M Y H:i') }}</p>
                    <form method="POST" action="{{ route('portal.research_spaces.deselect', $research->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            Deselect Topic
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection