@extends('layouts.guest')
@section('title','Ask a Mentor Q&A')

@section('content')

<!-- Page Header -->
<div class="page-header parallaxie">
    <div class="container">
        <h1 class="text-anime-style-3 text-center">Ask a Mentor Q&A</h1>
    </div>
</div>

<div class="page-faqs">
    <div class="container">
        <div class="row">

            <div class="col-lg-10">
                <div class="sidebar-cta-box wow fadeInUp mt-4">
                    <div class="sidebar-cta-content text-center">
                        <p>Have a question? Our mentors are here to help.</p>
                        <button class="btn-default btn-highlighted"
                            data-bs-toggle="modal"
                            data-bs-target="#askMentorModal">
                            Ask a Mentor
                        </button>
                    </div>
                </div>
            </div>
            <!-- Sidebar Categories -->
            <div class="col-lg-4">
                <div class="page-single-sidebar mt-4">

                    <div class="page-category-list wow fadeInUp">
                        <ul>
                            @foreach($categories as $category)
                            <li>
                                <a href="#{{ $category->slug }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-8">

                @forelse($categories as $category)
                <div class="page-faqs-catagery mb-5 mt-4" id="{{ $category->slug }}">

                    <div class="section-title">
                        <h2 class="text-anime-style-3">
                            {{ $category->name }}
                        </h2>
                    </div>

                    <div class="accordion" id="accordion-{{ $category->id }}">

                        @forelse($category->questions as $index => $q)
                        @php
                        $headingId = 'heading-'.$q->id;
                        $collapseId = 'collapse-'.$q->id;
                        @endphp

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="{{ $headingId }}">
                                <button
                                    class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#{{ $collapseId }}">
                                    Q{{ $q->id }}. {{ $q->title }}?
                                </button>
                            </h2>

                            <div
                                id="{{ $collapseId }}"
                                class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                data-bs-parent="#accordion-{{ $category->id }}">
                                <div class="accordion-body">
                                    <p>{{ $q->question }}</p>
                                    <hr>

                                    @forelse($q->answers as $a)
                                    <div class="mb-3">
                                        <strong>
                                            Answer by {{ $a->mentor->name ?? 'Mentor' }}:
                                        </strong>
                                        <p>{{ $a->answer }}</p>
                                    </div>
                                    @empty
                                    <p class="text-muted">
                                        No answers yet.
                                    </p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        @empty
                        <p class="text-muted">
                            No questions in this category yet.
                        </p>
                        @endforelse

                    </div>
                </div>
                @empty
                <p class="text-muted">No categories available.</p>
                @endforelse

            </div>
        </div>
    </div>
</div>

<!-- Ask Mentor Modal -->
<div class="modal fade" id="askMentorModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="POST" action="{{ route('mentor_qna.store') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Ask a Mentor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="mentor_category_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Question Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Your Question</label>
                        <textarea name="question" class="form-control" rows="5" required></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button class="btn btn-primary">
                        Submit Question
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection