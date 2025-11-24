@extends('layouts.guest')
@section('title', $new->title)
@section('content')

<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">{{ $new->title}}</h1>
                    <div class="post-single-meta wow fadeInUp">
                        <ol class="breadcrumb">
                            <li><i class="fa-regular fa-user"></i> Admin</li>
                            <li><i class="fa-regular fa-clock"></i> 13 June, 2025</li>
                        </ol>
                    </div>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Scrolling Ticker Section Start -->
<div class="our-scrolling-ticker">
    <!-- Scrolling Ticker Start -->
    <div class="scrolling-ticker-box">
        <div class="scrolling-content">
            <span><img src="images/icon-sparkle.svg" alt="">Diagnostics</span>
            <span><img src="images/icon-sparkle.svg" alt="">Innovation</span>
            <span><img src="images/icon-sparkle.svg" alt="">Biotech</span>
            <span><img src="images/icon-sparkle.svg" alt="">Environment</span>
            <span><img src="images/icon-sparkle.svg" alt="">Testing</span>
            <span><img src="images/icon-sparkle.svg" alt="">Research</span>
            <span><img src="images/icon-sparkle.svg" alt="">Diagnostics</span>
            <span><img src="images/icon-sparkle.svg" alt="">Innovation</span>
            <span><img src="images/icon-sparkle.svg" alt="">Biotech</span>
        </div>

        <div class="scrolling-content">
            <span><img src="images/icon-sparkle.svg" alt="">Diagnostics</span>
            <span><img src="images/icon-sparkle.svg" alt="">Innovation</span>
            <span><img src="images/icon-sparkle.svg" alt="">Biotech</span>
            <span><img src="images/icon-sparkle.svg" alt="">Environment</span>
            <span><img src="images/icon-sparkle.svg" alt="">Testing</span>
            <span><img src="images/icon-sparkle.svg" alt="">Research</span>
            <span><img src="images/icon-sparkle.svg" alt="">Diagnostics</span>
            <span><img src="images/icon-sparkle.svg" alt="">Innovation</span>
            <span><img src="images/icon-sparkle.svg" alt="">Biotech</span>
        </div>
    </div>
    <!-- Scrolling Ticker End -->
</div>
<!-- Scrolling Ticker Section End -->

<!-- Page Single Post Start -->
<div class="page-single-post">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Post Featured Image Start -->
                <div class="post-image">
                    <figure class="image-anime reveal">
                        <img src="{{ asset('assets/images/post-2.jpg') }}" alt="">
                    </figure>
                </div>
                <!-- Post Featured Image Start -->

                <!-- Post Single Content Start -->
                <div class="post-content">
                    <!-- Post Entry Start -->
                    <div class="post-entry">
                        <h2 class="wow fadeInUp">{{ $new->title}}</h2>

                        <p class="wow fadeInUp" data-wow-delay="0.2s">{!! $new->content !!}</p>

                        <blockquote class="wow fadeInUp" data-wow-delay="0.4s">
                            <p>{{ $new->excerpt}}</p>
                        </blockquote>
                        
                    </div>
                    <!-- Post Entry End -->

                    <!-- Post Tag Links Start -->
                    <div class="post-tag-links">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <!-- Post Tags Start -->
                                <div class="post-tags wow fadeInUp" data-wow-delay="0.5s">
                                    <span class="tag-links">
                                        Tags:
                                        <a href="#">{{ $new->category->name  }}</a>
                                    </span>
                                </div>
                                <!-- Post Tags End -->
                            </div>

                            <div class="col-lg-4">
                                <!-- Post Social Links Start -->
                                <div class="post-social-sharing wow fadeInUp" data-wow-delay="0.5s">
                                    <ul>
                                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    </ul>
                                </div>
                                <!-- Post Social Links End -->
                            </div>
                        </div>
                    </div>
                    <!-- Post Tag Links End -->
                </div>
                <!-- Post Single Content End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Single Post End -->

@endsection