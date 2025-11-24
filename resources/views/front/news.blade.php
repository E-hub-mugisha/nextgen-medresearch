@extends('layouts.guest')
@section('title','news & updates')
@section('content')

<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Our news & updates</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home')}}">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Our news & updates</li>
                        </ol>
                    </nav>
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

<!-- Page Blog Start -->
<div class="page-blog">
    <div class="container">
        <div class="row">
            @forelse($news as $new)
            <div class="col-lg-4 col-md-6">
                <!-- Post Item Start -->
                <div class="post-item wow fadeInUp">
                    <!-- Post Featured Image Start-->
                    <div class="post-featured-image">
                        <a href="{{ route('news.detail', $new->slug )}}" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="{{ asset('assets/images/post-1.jpg') }}" alt="">
                            </figure>
                        </a>
                    </div>
                    <!-- Post Featured Image End -->

                    <!-- Post Item Body Start -->
                    <div class="post-item-body">
                        <!-- Post Item Content Start -->
                        <div class="post-item-content">
                            <h2><a href="{{ route('news.detail', $new->slug )}}">{{ $new->title}}</a></h2>
                        </div>
                        <!-- Post Item Content End -->

                        <!-- Post Item Readmore Button Start-->
                        <div class="post-item-btn">
                            <a href="{{ route('news.detail', $new->slug )}}" class="readmore-btn">learn more</a>
                        </div>
                        <!-- Post Item Readmore Button End-->
                    </div>
                    <!-- Post Item Body End -->
                </div>
                <!-- Post Item End -->
            </div>
            @empty
            <p class="text-center text-muted">No recent news available.</p>
            @endforelse

            <div class="col-lg-12">
                <!-- Page Pagination Start -->
                <div class="page-pagination wow fadeInUp" data-wow-delay="1.2s">
                    {{ $news->links() }}
                </div>
                <!-- Page Pagination End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Blog End -->

@endsection