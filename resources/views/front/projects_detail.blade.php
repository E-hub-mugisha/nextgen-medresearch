@extends('layouts.guest')
@section('title', $project->title)
@section('content')

<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">{{ $project->title}}</h1>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->


<div class="page-case-study-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <!-- Page Single Sidebar Start -->
                <div class="page-single-sidebar">
                    <!-- Page Category List Start -->
                    <div class="page-category-list case-study-category-list wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <h3>Project Information</h3>
                        <ul>
                            <li>Status :<span>{{ $project->status ?? 'N/A' }}</span></li>
                            <li>Category :<span>{{ $project->category->name }}</span></li>
                            <li>Location :<span>Rwanda</span></li>
                            <li>Duration :<span>6 Month</span></li>
                            <li>Date :<span>{{ $project->created_at->format('d M Y') ?? 'N/A' }}</span></li>
                            <li><a href="{{ $project->project_link }}" class="btn-default btn-highlighted">Project Link</a></li>
                        </ul>
                    </div>
                    <!-- Page Category List End -->

                </div>
                <!-- Page Single Sidebar End -->
            </div>

            <div class="col-lg-8">
                <!-- Case Study Single Content Start -->
                <div class="case-study-single-content">
                    <!-- Page Single image Start -->
                    <div class="page-single-image">
                        <figure class="image-anime reveal" style="transform: translate(0px, 0px); opacity: 1; visibility: inherit;">
                            <img src="{{ asset($project->banner) }}" alt="" style="transform: translate(0px, 0px);">
                        </figure>
                    </div>
                    <!-- Page Single image End -->

                    <!-- Case Study Entry Start -->
                    <div class="case-study-entry">
                        <p class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">{{ $project->summary}}</p>
                        <p class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">{{ $project->description }}</p>

                        <!-- Empowering Agriculture Box Start -->
                        <div class="empowering-agriculture-box">
                            <h2 class="text-anime-style-3" style="perspective: 400px;">
                                {{ $project->title}}
                            </h2>
                            <!-- Empowering Box List Start -->
                            <div class="empowering-box-list">
                                <!-- Empowering Box Start -->
                                <div class="empowering-box wow fadeInUp" data-wow-delay="0.2s" style="visibility: hidden; animation-delay: 0.2s; animation-name: none;">
                                    <!-- Empowering Item Start -->
                                    <div class="empowering-item">
                                        <div class="empowering-item-content">
                                            <p>{{ $project->summary}}</p>
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

@endsection