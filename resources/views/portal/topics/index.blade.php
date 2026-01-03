@extends('layouts.portal')
@section('title', 'Research Topics')
@section('content')

<div class="container py-4">

    <div class="text-center mb-4">
        <h2 class="fw-bold">📚 Research Space</h2>
        <p class="text-muted">Explore research topics and their impact</p>
    </div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('info'))
    <div class="alert alert-info">{{ session('info') }}</div>
@endif

    <div class="row g-4">
        @forelse($researchSpaces as $research)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-semibold">{{ $research->title }}</h5>

                    <p class="text-muted small">
                        {{ Str::limit($research->description, 100) }}
                    </p>

                    <p>
                        <strong>Target Area:</strong> {{ $research->target_area }}
                    </p>
                </div>

                <div class="card-footer bg-white text-muted small">
                    Added on {{ $research->created_at->format('d M Y') }}
                    <button type="button" class="btn-default btn-sm float-end" data-bs-toggle="modal" data-bs-target="#researchModal{{ $research->id }}">
                        Read More
                    </button>
                </div>
            </div>
        </div>

        {{-- Modal --}}
        <div class="modal fade" id="researchModal{{ $research->id }}" tabindex="-1" aria-labelledby="researchModalLabel{{ $research->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="researchModalLabel{{ $research->id }}">{{ $research->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Description:</strong><br>{!! nl2br(e($research->description)) !!}</p>
                        <p><strong>Target Area:</strong><br>{!! nl2br(e($research->target_area)) !!}</p>
                        <p><strong>Importance:</strong><br>{!! nl2br(e($research->importance)) !!}</p>
                        <p><strong>Impact:</strong><br>{!! nl2br(e($research->impact)) !!}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form method="POST" action="{{ route('portal.research_spaces.select', $research->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Select Topic</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted">
            No research entries available.
        </div>
        @endforelse

    </div>

    <div class="mt-4">
        {{ $researchSpaces->links() }}
    </div>

</div>
@endsection