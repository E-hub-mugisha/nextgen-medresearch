@extends('layouts.guest')

@section('title', 'Vehicle Rescue Sheets')

@section('content')
<div class="our-core-value mt-10">
    <div class="container">

        <!-- Section Title -->
        <div class="section-title text-center mb-4">
            <h3 class="wow fadeInUp" style="border: 1px solid #fff">Vehicle Rescue Sheets</h3>
            <h2 class="text-anime-style-3" data-cursor="-opaque">Vehicle Rescue Sheets</h2>
            <p class="wow fadeInUp text-anime-style-3 mt-2" data-wow-delay="0.2s">
                Search and download rescue sheets for various vehicle models.
                Scan the QR code for quick access.
            </p>
        </div>

        <!-- Search -->
        <form method="GET" action="{{ route('rescue.sheet.public') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control rounded-3"
                    placeholder="Search by title or vehicle model..."
                    value="{{ request('search') }}" style="border: 1px solid #00697E;">
                <button class="btn-default ms-2" style="border: 1px solid #00697E;">
                    Search
                </button>
            </div>
        </form>

        <!-- Filter Button Menu -->
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="{{ route('rescue.sheet.public', ['search' => request('search')]) }}"
                class="btn btn-sm {{ !request('category') ? 'btn-primary' : 'btn-outline-primary' }}">
                All
            </a>

            <a href="{{ route('rescue.sheet.public', ['category' => 'car', 'search' => request('search')]) }}"
                class="btn btn-sm {{ request('category') == 'car' ? 'btn-primary' : 'btn-outline-primary' }}">
                🚗 Car
            </a>

            <a href="{{ route('rescue.sheet.public', ['category' => 'truck', 'search' => request('search')]) }}"
                class="btn btn-sm {{ request('category') == 'truck' ? 'btn-primary' : 'btn-outline-primary' }}">
                🚚 Truck
            </a>

            <a href="{{ route('rescue.sheet.public', ['category' => 'bus', 'search' => request('search')]) }}"
                class="btn btn-sm {{ request('category') == 'bus' ? 'btn-primary' : 'btn-outline-primary' }}">
                🚌 Bus
            </a>

            <a href="{{ route('rescue.sheet.public', ['category' => 'ev', 'search' => request('search')]) }}"
                class="btn btn-sm {{ request('category') == 'ev' ? 'btn-primary' : 'btn-outline-primary' }}">
                ⚡ EV
            </a>
        </div>

        <!-- List View -->
        <div class="list-group shadow-sm">
            @forelse($sheets as $sheet)
            <a href="{{ route('rescue.sheet.show', $sheet->slug) }}"
                target="_blank"
                class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">

                <div class="d-flex align-items-center gap-3">
                    @if($sheet->qr_code_path)
                    <img src="{{ asset($sheet->qr_code_path) }}" width="55" alt="QR">
                    @endif
                    <div>
                        <h6 class="mb-0">{{ $sheet->title }}</h6>
                        <small class="text-muted">
                            {{ $sheet->vehicle_model }} • {{ ucfirst($sheet->category) }}
                        </small>
                    </div>
                </div>

                <span class="badge bg-primary rounded-pill">
                    {{ $sheet->scan_count ?? 0 }} scans
                </span>
            </a>
            @empty
            <div class="text-center text-muted p-4">
                No rescue sheets found.
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $sheets->withQueryString()->links() }}
        </div>

    </div>
</div>
@endsection