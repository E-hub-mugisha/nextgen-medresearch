@extends('layouts.guest')
@section('title', 'Vehicle Rescue Sheets')
@section('content')


<!-- Our Services Section Start -->
<div class="our-core-value mt-10 pb-10">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-6">
                <!-- Section Title Start -->
                <div class="core-value-image" style="padding-top: 50px;">
                    <div class="section-title">
                        <h3 class="wow fadeInUp" style="border: 1px solid #fff">Vehicle Rescue Sheets</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Vehicle Rescue Sheets </h2>
                    </div>
                    <!-- Section Title End -->
                    <p class="wow fadeInUp text-anime-style-3" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        Search and download rescue sheets for various vehicle models.
                        Scan the QR code for quick access.
                    </p>
                    <!-- Section Content Button End -->
                    <a href="#rescue-sheets" class="btn-default" style="border: 1px solid #00697E;">View Rescue Sheets</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="pricing-box" style="padding-top: 50px;">
                    <!-- Pricing Item Start -->
                    <div class="pricing-item wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <!-- Pricing Header Start -->
                        <div class="pricing-header">
                            <h3>Search for vehicle model</h3>
                        </div>
                        <!-- Pricing Header End -->

                        <!-- Pricing Body Start -->
                        <div class="pricing-body">
                            <!-- Pricing Content Start -->
                            <div class="pricing-content">
                                <!-- Search -->
                                <form method="GET" action="{{ route('rescue.sheet.public') }}" class="mb-4">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control rounded-3 gap-2"
                                            placeholder="Search by title or vehicle model..."
                                            value="{{ request('search') }}" style="border: 1px solid #00697E;">
                                        <div class="pricing-btn">
                                            <button class="btn-default" style="border: 1px solid #00697E; margin-left: 10px;">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Pricing Content End -->
                        </div>
                    </div>
                    <!-- Pricing Body End -->
                </div>
            </div>
        </div>
    </div>
</div>


<div class="page-case-study" id="rescue-sheets">
    <div class="container">
        <div class="section-title">
            <h2 class="text-anime-style-3">Here is the lists of Vehicle Rescue Sheets </h2>
        </div>
        <div class="row">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Vehicle Model</th>
                        <th>QR Code</th>
                        <th>Scans</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sheets as $sheet)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sheet->title }}</td>
                        <td>{{ $sheet->vehicle_model ?? '-' }}</td>
                        <td>
                            @if($sheet->qr_code_path)
                            <a href="{{ route('rescue.sheet.show',$sheet->slug) }}" target="_blank">
                                <img src="{{ asset('storage/'.$sheet->qr_code_path) }}" width="60" alt="QR Code">
                            </a>
                            @endif
                        </td>
                        <td>{{ $sheet->scan_count ?? 0 }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $sheet->id }}">Scan</button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $sheet->id }}">Print</button>
                        </td>
                    </tr>


                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No rescue sheets added yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
        </div>
    </div>
</div>

@endsection