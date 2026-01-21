@extends('layouts.guest')
@section('title','Ask a Mentor Q&A')

@section('content')

<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">
                        Ask a Mentor Q&A
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div class="page-faqs">
    <div class="container">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="page-single-sidebar">

                    <div class="page-category-list wow fadeInUp">
                        <ul>
                            <li><a href="#faq_1">General Information</a></li>
                            <li><a href="#faq_2">Research Methodology</a></li>
                            <li><a href="#faq_3">Safety Compliance</a></li>
                            <li><a href="#faq_4">Sample Submission</a></li>
                        </ul>
                    </div>

                    <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.25s">
                        <div class="sidebar-cta-logo">
                            <img src="{{ asset('assets/images/logo-white.png') }}" alt="Logo">
                        </div>

                        <div class="sidebar-cta-content">
                            <p>Partner with us to drive innovation and shape a healthier future.</p>
                            <button
                                type="button"
                                class="btn-default btn-highlighted"
                                data-bs-toggle="modal"
                                data-bs-target="#askMentorModal">
                                Ask a Mentor
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="page-faqs-catagery" id="faq_1">

                    <div class="section-title">
                        <h2 class="text-anime-style-3" data-cursor="-opaque">
                            General Information
                        </h2>
                    </div>

                    <!-- Accordion -->
                    <div class="faq-accordion accordion" id="mentorAccordion">

                        @forelse($questions as $index => $q)
                            @php
                                $headingId = 'heading-'.$q->id;
                                $collapseId = 'collapse-'.$q->id;
                                $isFirst = $index === 0;
                            @endphp

                            <div class="accordion-item wow fadeInUp">
                                <h2 class="accordion-header" id="{{ $headingId }}">
                                    <button
                                        class="accordion-button {{ !$isFirst ? 'collapsed' : '' }}"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#{{ $collapseId }}"
                                        aria-expanded="{{ $isFirst ? 'true' : 'false' }}"
                                        aria-controls="{{ $collapseId }}"
                                    >
                                        Q{{ $q->id }}. {{ $q->title }}?
                                    </button>
                                </h2>

                                <div
                                    id="{{ $collapseId }}"
                                    class="accordion-collapse collapse {{ $isFirst ? 'show' : '' }}"
                                    aria-labelledby="{{ $headingId }}"
                                    data-bs-parent="#mentorAccordion"
                                >
                                    <div class="accordion-body">
                                        <p>{{ $q->question }}</p>

                                        <hr>

                                        @forelse($q->answers as $a)
                                            <div class="mb-3">
                                                <strong>
                                                    Answer by {{ $a->mentor->name ?? 'Mentor' }}:
                                                </strong>
                                                <p class="mb-0">{{ $a->answer }}</p>
                                            </div>
                                        @empty
                                            <p class="text-muted">
                                                No answers yet. Be the first to ask a mentor!
                                            </p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                        @empty
                            <p class="text-muted">No questions available.</p>
                        @endforelse

                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $questions->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Ask Mentor Modal -->
<div class="modal fade" id="askMentorModal" tabindex="-1" aria-labelledby="askMentorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="POST" action="{{ route('mentor_qna.store') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="askMentorModalLabel">
                        Ask a Mentor
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Question Title</label>
                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            placeholder="Enter question title"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Your Question</label>
                        <textarea
                            class="form-control"
                            name="question"
                            rows="5"
                            placeholder="Type your question here..."
                            required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Submit Question
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
