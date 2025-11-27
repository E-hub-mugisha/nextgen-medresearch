@extends('layouts.guest')

@section('content')

<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">
                        Our rescue sheets
                    </h1>
                    <nav class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Vehicle Rescue Sheets</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>

<div class="our-pricing bg-section" style="margin-top: 5rem;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <!-- Our Pricing Content Start -->
                <div class="our-pricing-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Our rescue sheets</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">
                            Vehicle Rescue Sheets
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            Search and download rescue sheets for various vehicle models.
                            Scan the QR code for quick access.
                        </p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Pricing Button Start -->
                    <div class="our-pricing-btn wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <a href="#rescue-sheets" class="btn-default">View Rescue Sheets</a>
                    </div>
                    <!-- Pricing Button End -->
                </div>
                <!-- Our Pricing Content End -->
            </div>

            <div class="col-lg-6">
                <!-- Pricing Box Start -->
                <div class="pricing-box">
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
                                            value="{{ request('search') }}">
                                        <div class="pricing-btn">
                                            <button class="btn-default">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Pricing Content End -->
                        </div>
                        <!-- Pricing List Start -->
                        <!-- <div class="pricing-list">
                            <ul>
                                <li>Custom design</li>
                                <li>All Basic features</li>
                                <li>Priority processing</li>
                                <li>Access Online Portals</li>
                            </ul>
                        </div> -->
                        <!-- Pricing List End -->
                    </div>
                    <!-- Pricing Body End -->
                </div>
                <!-- Pricing Item End -->
            </div>
            <!-- Pricing Box End -->
        </div>
    </div>
</div>
</div>

<div class="page-case-study" id="rescue-sheets">
    <div class="container">
        <div class="row">
            @forelse($sheets as $sheet)
            <div class="col-lg-4 col-md-6">
                <!-- Case Study Item Start -->
                <div class="case-study-item wow fadeInUp rounded-3 shadow-sm" style="visibility: visible; animation-name: fadeInUp;">
                    <!-- Case Study Image Start-->
                    <div class="case-study-image">
                        <figure class="image-anime">
                            <img src="{{ asset('storage/'.$sheet->qr_code_path) }}" alt="">
                        </figure>

                        <!-- Case Study Button Start-->
                        <div class="case-study-btn">
                            <a href="{{ asset('storage/'.$sheet->qr_code_path) }}"><img src="{{ asset('assets/images/arrow-primary.svg') }}" alt=""></a>
                        </div>
                        <!-- Case Study Button End-->
                    </div>
                    <!-- Case Study Image End -->

                    <!-- Case Study Content Start -->
                    <div class="case-study-content p-2">
                        <h2><a href="{{ route('rescue.sheet.show', $sheet->slug) }}">{{ $sheet->title }}</a></h2>
                    </div>
                    <div class="mt-3 small text-muted p-2">
                        Scans: {{ $sheet->scan_count ?? 0 }} |
                        Downloads: {{ $sheet->download_count ?? 0 }}
                    </div>
                    <!-- Case Study Content End -->
                    <div class="d-grid gap-2 p-2">
                        <a href="{{ route('rescue.sheet.show', $sheet->slug) }}"
                            class="btn-default"
                            target="_blank">
                            View Sheet
                        </a>
                    </div>
                </div>
                <!-- Case Study Item End -->
            </div>
            @empty
            <p class="text-center text-muted">No rescue sheets available.</p>
            @endforelse
        </div>
        <div class="mt-4">
            {{ $sheets->links() }}
        </div>
    </div>
</div>

@endsection