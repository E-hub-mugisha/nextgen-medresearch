@extends('layouts.guest')
@section('title', $new->title)
@section('content')

<!-- Page Single Post Start -->
<div class="page-single-post">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <!-- Post Featured Image Start -->
                <div class="post-image" style="margin-top: 2rem;">
                    <figure class="image-anime ">
                        @if ($new->featured_image)
                        <img src="{{asset('image/posts')}}/{{ $new->featured_image }}" alt="">
                        @else
                        <span class="text-muted">No Image</span>
                        @endif
                    </figure>
                </div>
                <!-- Post Featured Image Start -->

                <!-- Post Single Content Start -->
                <div class="post-content">
                    <!-- Post Entry Start -->
                    <div class="post-entry">
                        <h2 class="wow fadeInUp">{{ $new->title}}</h2>
                        <p>{!! $new->excerpt !!}</p>
                        <p class="wow fadeInUp" data-wow-delay="0.2s"> {!! $new->content !!}</p>

                    </div>
                    <!-- Post Entry End -->

                    <!-- Post Tag Links Start -->
                    <div class="post-tag-links">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <!-- Post Tags Start -->
                                <div class="post-tags wow fadeInUp" data-wow-delay="0.5s">
                                    <span class="tag-links">
                                        Category:
                                        <a href="#" class="text-white">{{ $new->category->name  }}</a>
                                    </span>
                                </div>
                                <!-- Post Tags End -->
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