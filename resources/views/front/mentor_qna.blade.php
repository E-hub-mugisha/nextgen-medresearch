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

<div class="page-faqs">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <!-- Page Single Sidebar Start -->
                <div class="page-single-sidebar">
                    <!-- Page Category List Start -->
                    <div class="page-category-list wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <ul>
                            <li><a href="#faq_1">General Information</a></li>
                            <li><a href="#faq_2">Research Methodology</a></li>
                            <li><a href="#faq_3">Safety Compliance</a></li>
                            <li><a href="#faq_4">Sample Submission</a></li>
                        </ul>
                    </div>
                    <!-- Page Category List End -->

                    <!-- Sidebar CTA Box Start -->
                    <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                        <!-- Sidebar CTA Content Start -->
                        <div class="sidebar-cta-logo">
                            <img src="images/logo.svg" alt="">
                        </div>
                        <!-- Sidebar CTA Content End -->

                        <!-- Sidebar CTA Contact Start -->
                        <div class="sidebar-cta-content">
                            <p>Partner with us to drive innovation and shape a healthier future.</p>
                            <a role="button" class="btn-default btn-highlighted" data-bs-toggle="modal" data-bs-target="#askMentorModal">Ask a Mentor</a>
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
                    <div class="page-single-faqs page-faq-accordion" id="faq_1">
                        <div class="section-title">
                            <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">
                                <div class="split-line" style="display: block; text-align: start; position: relative;">
                                    <div style="position:relative;display:inline-block;">
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">G</div>
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">e</div>
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">n</div>
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">e</div>
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">r</div>
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">a</div>
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">l</div>
                                    </div>
                                    <div style="position:relative;display:inline-block;">
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">I</div>
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">n</div>
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">f</div>
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">o</div>
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">r</div>
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">m</div>
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">a</div>
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">t</div>
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">i</div>
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">o</div>
                                        <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">n</div>
                                    </div>
                                </div>
                            </h2>
                        </div>
                        <!-- FAQ Accordion Start -->
                        <div class="faq-accordion" id="accordion">
                            <!-- FAQ Item Start -->
                            @foreach($questions as $q)
                            <div class="accordion-item wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                <h2 class="accordion-header" id="heading1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        Q{{ $q->id }}. {{ $q->title }}?
                                    </button>
                                </h2>
                                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#accordion" style="">
                                    <div class="accordion-body">
                                        <p>{{ $q->question }}</p>
                                        @foreach($q->answers as $a)
                                        <div>
                                            <strong>Answer by {{ $a->mentor->name ?? 'Mentor' }}:</strong>
                                            <p>{{ $a->answer }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->

                            @endforeach

                            {{ $questions->links() }}
                        </div>
                        <!-- FAQ Accordion End -->
                    </div>
                    <!-- FAQs section End -->

                </div>
                <!-- Page FAQs Catagery End -->
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="askMentorModal" tabindex="-1" aria-labelledby="askMentorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" action="{{ route('mentor_qna.store') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="askMentorModalLabel">Ask a Mentor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="questionTitle" class="form-label">Question Title</label>
            <input type="text" class="form-control" id="questionTitle" name="title" placeholder="Enter question title" required>
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