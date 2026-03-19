@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Event Details</h4>
            <small class="text-muted">View full event information</small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary btn-sm p-3">
                ← Back
            </a>
            
        </div>
    </div>

    <div class="row g-4">

        <!-- Left: Main Content -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">

                    <!-- Banner -->
                    @if($event->banner)
                        <div class="mb-4">
                            <img
                                src="{{asset('image/events')}}/{{ $event->banner }}"
                                alt="{{ $event->title }}"
                                class="img-fluid rounded w-100"
                                style="max-height: 320px; object-fit: cover;"
                            >
                        </div>
                    @endif

                    <!-- Title -->
                    <h3 class="fw-bold mb-2">{{ $event->title }}</h3>

                    <!-- Category -->
                    <p class="text-muted mb-3">
                        <i class="bi bi-folder"></i>
                        {{ $event->category->name ?? 'Uncategorized' }}
                    </p>

                    <!-- Description -->
                    <div class="mt-4">
                        <h6 class="fw-semibold">Description</h6>
                        <p class="text-muted mb-0">
                            {!! $event->description ?: 'No description provided.' !!}
                        </p>
                    </div>

                    <!-- Registration Link -->
                    @if($event->registration_link)
                        <div class="mt-4">
                            <a href="{{ $event->registration_link }}" target="_blank"
                               class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-box-arrow-up-right"></i> Register for Event
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- Right: Meta Info -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h6 class="fw-semibold mb-3">Event Info</h6>

                    <ul class="list-group list-group-flush small">

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Status</span>
                            <span class="badge
                                @switch($event->status)
                                    @case('published') bg-success @break
                                    @case('scheduled') bg-info @break
                                    @case('draft') bg-secondary @break
                                    @default bg-dark
                                @endswitch
                            ">
                                {{ ucfirst($event->status) }}
                            </span>
                        </li>

                        @if($event->trainer)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Trainer</span>
                            <span>{{ $event->trainer }}</span>
                        </li>
                        @endif

                        @if($event->start_date)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Start Date</span>
                            <span>{{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}</span>
                        </li>
                        @endif

                        @if($event->end_date)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>End Date</span>
                            <span>{{ \Carbon\Carbon::parse($event->end_date)->format('M d, Y') }}</span>
                        </li>
                        @endif

                        @if($event->location)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Location</span>
                            <span>{{ $event->location }}</span>
                        </li>
                        @endif

                        @if(!is_null($event->capacity))
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Capacity</span>
                            <span>{{ $event->capacity }}</span>
                        </li>
                        @endif

                        @if($event->publish_at)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Publish At</span>
                            <span>{{ \Carbon\Carbon::parse($event->publish_at)->format('M d, Y') }}</span>
                        </li>
                        @endif

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Created</span>
                            <span>{{ $event->created_at->format('M d, Y') }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Updated</span>
                            <span>{{ $event->updated_at->diffForHumans() }}</span>
                        </li>

                    </ul>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
