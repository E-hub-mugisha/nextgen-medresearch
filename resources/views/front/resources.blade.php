@extends('layouts.guest')
@section('title','Resources')
@section('content')

<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Our Resources</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home')}}">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Our Resources</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div class="page-case-study">
    <div class="container">
        <div class="row">
            @forelse($resources as $resource)
            <div class="col-lg-4 col-md-6">
                <!-- Case Study Item Start -->
                <div class="case-study-item wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <!-- Case Study Image Start-->
                    <div class="case-study-image">
                        <figure class="image-anime">
                            <img src="{{ asset('assets/images/case-study-1.jpg') }}" alt="">
                        </figure>

                        <!-- Case Study Button Start-->
                        <div class="case-study-btn">
                            <a href="{{ route('resources.detail', $resource->id )}}"><img src="{{ asset('assets/images/arrow-primary.svg') }}" alt=""></a>
                        </div>
                        <!-- Case Study Button End-->
                    </div>
                    <!-- Case Study Image End -->

                    <!-- Case Study Content Start -->
                    <div class="case-study-content">
                        <h2><a href="{{ route('resources.detail', $resource->id )}}">{{ $resource->title}}</a></h2>
                    </div>
                    <!-- Case Study Content End -->
                </div>
                <!-- Case Study Item End -->
            </div>
            @empty
            <p class="text-center text-muted">No recent resources available.</p>
            @endforelse

            <div class="col-lg-12">
                <!-- Page Pagination Start -->
                <div class="page-pagination wow fadeInUp" data-wow-delay="1.2s">
                    {{ $resources->links() }}
                </div>
                <!-- Page Pagination End -->
            </div>
        </div>
    </div>
</div>

@endsection