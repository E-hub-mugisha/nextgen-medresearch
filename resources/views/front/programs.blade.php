@extends('layouts.guest')
@section('title', 'Our Programs')
@section('content')

<div class="page-services">
    <div class="container">
        <div class="section-title" style="margin-top: 3rem;">
            <!-- <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Frequently Asked Questions</h3> -->
            <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">
                Our Programs
            </h2>
            <p class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">Each research field is supported by expert teams and cutting-edge technologies, ensuring precision, innovation, and real-world relevance. our work is rooted in curiosity, driven by data, and designed to deliver meaningful impact.</p>
        </div>
        <div class="row service-list">
            @foreach($programs as $program)
            <div class="col-lg-3 col-md-6">
                <!-- Service Item Start -->
                <div class="service-item wow fadeInUp">
                    <!-- Service Image Start -->
                    <div class="service-image">
                        <img src="{{asset('image/programs')}}/{{ $program->icon }}" alt="">
                    </div>
                    <!-- Service Image End -->

                    <!-- Service Body Start -->
                    <div class="service-body">
                        <!-- Service Body Header Start -->
                        <div class="service-body-header">
                            <!-- Icon Box Start -->
                            <div class="icon-box">
                                <img src="{{ asset('assets/images/icon-service-1.svg') }}" alt="">
                            </div>
                            <!-- Icon Box End -->

                            <!-- Service Readmore Button Start -->
                            <div class="service-readmore-btn">
                                <a href="{{ route('programs.detail', $program->slug ) }}"><img src="{{ asset('assets/images/arrow-white.svg') }}" alt=""></a>
                            </div>
                            <!-- Service Readmore Button End -->
                        </div>
                        <!-- Service Body Header End -->

                        <!-- Service Content Start -->
                        <div class="service-content">
                            <h3><a href="{{ route('programs.detail', $program->slug ) }}">{{ $program->title }}</a></h3>
                            <p>{{ Str::limit($program->description, 100) }}</p>
                        </div>
                        <!-- Service Content End -->
                    </div>
                    <!-- Service Body End -->
                </div>
                <!-- Service Item End -->
            </div>
            @endforeach

        </div>
    </div>
</div>

@endsection