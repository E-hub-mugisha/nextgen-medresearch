@extends('layouts.guest')
@section('title', $research->title)
@section('content')

<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">{{ $research->title }}</h1>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Page Service Single Start -->
<div class="page-case-study-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <!-- Page Single Sidebar Start -->
                <div class="page-single-sidebar">
                    <!-- Page Category List Start -->
                    <div class="page-category-list case-study-category-list wow fadeInUp">
                        <h3>Case Study Information</h3>
                        <ul>
                            <li>status :<span> {{ $research->status ?? 'N/A' }}</span></li>
                            <li>Category :<span> {{ $research->category->name ?? 'General' }}</span></li>
                            <li>Location :<span>Rwanda</span></li>
                            <li>Duration :<span> {{ $research->duration ?? 'N/A' }}</span></li>
                            <li>Date :<span> {{ $research->created_at->format('d M Y') ?? 'N/A' }}</span></li>
                        </ul>
                    </div>
                    <!-- Page Category List End -->

                    <!-- Sidebar CTA Box Start -->
                    <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.25s">
                        <!-- Sidebar CTA Content Start -->
                        <div class="sidebar-cta-logo">
                            <img src="{{ asset('assets/images/logo-white.png') }}" alt="">
                        </div>
                        <!-- Sidebar CTA Content End -->

                        <!-- Sidebar CTA Contact Start -->
                        <div class="sidebar-cta-content">
                            <p>Partner with us to drive innovation and shape a healthier future.</p>
                            <a href="{{asset('file/researches')}}/{{ $research->document }}" class="btn-default btn-highlighted">Research Document</a>
                        </div>
                        <!-- Sidebar CTA Contact End -->
                    </div>
                    <!-- Sidebar CTA Box End -->
                </div>
                <!-- Page Single Sidebar End -->
            </div>

            <div class="col-lg-8">
                <!-- Case Study Single Content Start -->
                <div class="case-study-single-content">
                    <!-- Page Single image Start -->
                    <div class="page-single-image">
                        <figure class="image-anime">
                            <img src="{{asset('image/research')}}/{{ $research->featured_image }}" alt="">
                        </figure>
                    </div>
                    <!-- Page Single image End -->

                    <!-- Case Study Entry Start -->
                    <div class="case-study-entry">
                        <!-- Empowering Agriculture Box Start -->
                        <div class="empowering-agriculture-box">
                            <h2 class="text-anime-style-3"> {{ $research->title ?? '' }}</h2>
                            <p class="wow fadeInUp"> {{ $research->content ?? '' }}</p>

                            <!-- Empowering Box List Start -->
                            <div class="empowering-box-list">
                                <!-- Empowering Box Start -->
                                <div class="empowering-box wow fadeInUp" data-wow-delay="0.2s">
                                    <!-- Empowering Item Start -->
                                    <div class="empowering-item">
                                        <div class="empowering-item-content">
                                            <p class="text-white"> {{ $research->summary ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Empowering Box End -->

                            </div>
                            <!-- Empowering Box List End -->
                        </div>
                        <!-- Empowering Agriculture Box End -->
                    </div>
                    <!-- Case Study Entry End -->
                </div>
                <!-- Case Study Single Content End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Service Single End -->

@endsection