@extends('layouts.guest')
@section('title','news')
@section('content')

<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Our news</h1>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->


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
                                <img src="{{ asset($new->featured_image) }}" alt="">
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