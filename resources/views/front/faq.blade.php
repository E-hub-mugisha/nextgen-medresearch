@extends('layouts.guest')
@section('title', 'Frequently Asked Questions')
@section('content')

<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Frequently asked question</h1>
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

<!-- Page Faqs Start -->
<div class="page-faqs">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <!-- Page Single Sidebar Start -->
                <div class="page-single-sidebar">
                    <!-- Page Category List Start -->
                    <div class="page-category-list wow fadeInUp">
                        <ul>
                            @foreach($faqs as $category => $items)
                            <li><a href="#{{ Str::slug($category) }}">{{ $category }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Page Category List End -->

                    <!-- Sidebar CTA Box Start -->
                    <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.25s">
                        <!-- Sidebar CTA Content Start -->
                        <div class="sidebar-cta-logo">
                            <img src="images/logo.svg" alt="">
                        </div>
                        <!-- Sidebar CTA Content End -->

                        <!-- Sidebar CTA Contact Start -->
                        <div class="sidebar-cta-content">
                            <p>Partner with us to drive innovation and shape a healthier future.</p>
                            <a role="button" class="btn-default btn-highlighted" data-bs-toggle="modal" data-bs-target="#askQuestionModal">Ask your Question</a>
                        </div>
                        <!-- Sidebar CTA Contact End -->
                    </div>
                    <!-- Sidebar CTA Box End -->
                </div>
                <!-- Page Single Sidebar End -->
            </div>

            <div class="col-lg-8">
                <!-- Page FAQs Catagery Start -->
                <div class="page-faqs-catagery">
                    <!-- FAQs section start -->
                    @foreach($faqs as $category => $items)
                    <div class="page-single-faqs page-faq-accordion" id="{{ Str::slug($category) }}">
                        <div class="section-title">
                            <h2 class="text-anime-style-3" data-cursor="-opaque">{{ $category }}</h2>
                        </div>
                        <!-- FAQ Accordion Start -->
                        <div class="faq-accordion" id="acc_{{ Str::slug($category) }}">
                            <!-- FAQ Item Start -->
                            @foreach($items as $index => $faq)
                            <div class="accordion-item wow fadeInUp ">
                                <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                    <button class="accordion-button {{ $index != 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}" aria-expanded="false" aria-controls="#faq{{ $faq->id }}">
                                        Q{{ $index+1 }}. {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="faq{{ $faq->id }}" class="accordion-collapse collapse show {{ $index == 0 ? 'show' : '' }}" aria-labelledby="#acc_{{ Str::slug($category) }}" data-bs-parent="#acc_{{ Str::slug($category) }}">
                                    <div class="accordion-body">
                                        <p>{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- FAQ Item End -->

                        </div>
                        <!-- FAQ Accordion End -->
                    </div>
                    @endforeach
                    <!-- FAQs section End -->
                </div>
                <!-- Page FAQs Catagery End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Faqs End -->

<!-- Modal -->
<div class="modal fade" id="askQuestionModal" tabindex="-1" aria-labelledby="askQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('faq.question.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="askQuestionModalLabel">Ask a Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="questionTitle" class="form-label">Question Title</label>
                        <input type="text" class="form-control" id="questionTitle" name="title" placeholder="Enter question title" required>
                    </div>
                    <div class="mb-3">
                        <label for="questionCategory" class="form-label">Category</label>
                        <select class="form-select" id="Category" name="category" required>
                            <option value="" disabled selected>Select a category</option>
                            <option value="General">General</option>
                            <option value="membership">membership</option>
                            <option value="mentorship">Mentorship</option>
                            <option value="platform">Platform</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="questionBody" class="form-label">Your Question</label>
                        <textarea class="form-control" id="questionBody" name="question" rows="5" placeholder="Type your question here..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Question</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection