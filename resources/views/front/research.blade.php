@extends('layouts.guest')
@section('title','Research Projects')
@section('content')

<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Research Projects</h1>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Page Case Study Start -->
<div class="page-case-study">
    <div class="container">
        <div class="row">
            @foreach($researches as $research)
            <div class="col-lg-4 col-md-6">
                <!-- Case Study Item Start -->
                <div class="case-study-item card shadow-sm p-4 wow fadeInUp">
                    <!-- Case Study Image Start-->
                    <div class="case-study-image">
                        <figure class="image-anime">
                            <img src="{{asset('image/research')}}/{{ $research->featured_image }}" alt="">
                        </figure>

                        <!-- Case Study Button Start-->
                        <div class="case-study-btn">
                            <a href="{{ route('research.detail', $research->slug) }}"><img src="{{ asset('assets/images/arrow-primary.svg') }}" alt=""></a>
                        </div>
                        <!-- Case Study Button End-->
                    </div>
                    <!-- Case Study Image End -->

                    <!-- Case Study Content Start -->
                    <div class="case-study-content">
                        <h2><a href="{{ route('research.detail', $research->slug) }}" class="mb-3">{{ $research->title }}</a></h2>
                        <p class="mb-3">{!!  Str::limit($research->summary, 50) !!}</p>
                        <a href="{{ route('research.detail', $research->slug) }}" class="read-more">Read More</a>
                    </div>
                    <!-- Case Study Content End -->

                </div>
                <!-- Case Study Item End -->
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Page Case Study End -->


@endsection