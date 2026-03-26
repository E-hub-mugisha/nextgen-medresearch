@extends('layouts.guest')

@section('title', 'Vehicle Rescue Sheets')

@section('content')
<div class="our-core-value mt-10" style="padding-top: 10rem;">
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
                class="btn btn-sm {{ !request('category') ? 'btn-primary' : 'btn-outline-primary' }}" style="background: #00697E; color: #fff;">
                All
            </a>

            <a href="{{ route('rescue.sheet.public', ['category' => 'car', 'search' => request('search')]) }}"
                class="btn btn-sm {{ request('category') == 'car' ? 'btn-primary' : 'btn-outline-primary' }}" style="background: #00697E; color: #fff;">
                Car
            </a>

            <a href="{{ route('rescue.sheet.public', ['category' => 'truck', 'search' => request('search')]) }}"
                class="btn btn-sm {{ request('category') == 'truck' ? 'btn-primary' : 'btn-outline-primary' }}" style="background: #00697E; color: #fff;">
                Truck
            </a>

            <a href="{{ route('rescue.sheet.public', ['category' => 'bus', 'search' => request('search')]) }}"
                class="btn btn-sm {{ request('category') == 'bus' ? 'btn-primary' : 'btn-outline-primary' }}" style="background: #00697E; color: #fff;">
                Bus
            </a>

            <a href="{{ route('rescue.sheet.public', ['category' => 'ev', 'search' => request('search')]) }}"
                class="btn btn-sm {{ request('category') == 'ev' ? 'btn-primary' : 'btn-outline-primary' }}" style="background: #00697E; color: #fff;">
                EV
            </a>
        </div>

        <!-- List View -->
        <div class="list-group shadow-sm">
            @forelse($sheets as $sheet)
            {{-- List Item --}}
            <div class="list-group-item d-flex align-items-center justify-content-between">

                <div class="d-flex align-items-center gap-3">

                    {{-- QR Code → opens modal --}}
                    @if($sheet->qr_code_path)
                    <img src="{{ asset('qr_codes/' . $sheet->qr_code_path) }}"
                        width="55" alt="QR" role="button"
                        data-bs-toggle="modal"
                        data-bs-target="#qrModal{{ $sheet->id }}"
                        title="Click to scan QR">
                    @endif

                    {{-- Title → opens file --}}
                    <div>
                        <a href="{{ asset('rescue_sheets/' . $sheet->file_path) }}"
                            target="_blank" class="text-decoration-none text-dark">
                            <h6 class="mb-0">{{ $sheet->title }}</h6>
                        </a>
                        <small class="text-muted">
                            {{ $sheet->vehicle_model }} • {{ ucfirst($sheet->category) }}
                        </small>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-primary rounded-pill">
                        {{ $sheet->scan_count ?? 0 }} scans
                    </span>

                    {{-- Open file button --}}
                    <a href="{{ asset('rescue_sheets/' . $sheet->file_path) }}"
                        target="_blank"
                        class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-file-earmark-arrow-down"></i> Open
                    </a>
                </div>
            </div>

            {{-- QR Modal --}}
            @if($sheet->qr_code_path)
            <div class="modal fade" id="qrModal{{ $sheet->id }}" tabindex="-1"
                aria-labelledby="qrModalLabel{{ $sheet->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content text-center">

                        <div class="modal-header border-0 pb-0">
                            <h6 class="modal-title w-100 fw-semibold" id="qrModalLabel{{ $sheet->id }}">
                                {{ $sheet->title }}
                            </h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body py-3">
                            <img src="{{ asset('qr_codes/' . $sheet->qr_code_path) }}"
                                class="img-fluid" style="max-width:200px;" alt="QR Code">
                            <p class="text-muted small mt-2 mb-0">Scan to open rescue sheet</p>
                        </div>

                        <div class="modal-footer border-0 pt-0 justify-content-center">
                            <a href="{{ asset('rescue_sheets/' . $sheet->file_path) }}"
                                target="_blank" class="btn btn-sm btn-primary">
                                <i class="bi bi-file-earmark-arrow-down"></i> Open File
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            @endif
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