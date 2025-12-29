@extends('layouts.guest')
@section('title','Research Space')
@section('content')

<div class="container py-5">

    <!-- Page Header -->
    <div class="text-center mb-4">
        <h2 class="fw-bold">🎓 Dissertation-Ready Topics</h2>
        <p class="text-muted">
            These Dissertation-Ready Topics are carefully curated through systematic literature reviews, analysis of the University of Rwanda research portal,
            and consultations with clinicians, researchers, and academic supervisors. Each topic is designed to be feasible, ethically sound, impactful,
            and aligned with national and global health priorities.
        </p>
    </div>

    <!-- Example Dissertation Topic Card -->
    <div class="card shadow-sm p-4 mb-4">
        <h4 class="fw-bold mb-3">Sample Dissertation Topic</h4>

        <div class="mb-3">
            <h6 class="fw-bold">1️⃣ Title</h6>
            <p>
                Assessing the Impact of Early Diabetes Screening on Preventing Complications among Adults in Rwanda.
            </p>
        </div>

        <div class="mb-3">
            <h6 class="fw-bold">2️⃣ Who It’s For</h6>
            <p>
                Medical Students, Medical Residents, Public Health Researchers, and Healthcare Policy Trainees who want a clinically meaningful,
                data-driven research topic that contributes to improving patient outcomes.
            </p>
        </div>

        <div class="mb-3">
            <h6 class="fw-bold">3️⃣ Why This Is Important</h6>
            <p>
                Diabetes complications such as kidney failure, cardiovascular disease, and amputations remain a major burden in Rwanda and globally.
                Early screening and timely intervention can significantly reduce morbidity and mortality.
                This topic helps generate evidence that can inform clinical guidelines, hospital protocols, and national health policy.
            </p>
        </div>

        <div>
            <h6 class="fw-bold">4️⃣ Confirm with a Mentor</h6>
            <p>
                Before starting your dissertation, a mentor review ensures the topic meets academic standards,
                has available data sources, ethical approval feasibility, and fits your academic level.
                A mentor helps refine objectives, methodology, and scope to make the project successful.
            </p>
        </div>
    </div>

    <!-- Who This Page Serves -->
    <div class="card shadow-sm p-4 mb-4">
        <h4 class="fw-bold mb-3">Who This Research Space Supports</h4>
        <p>
            This page is designed for learners and health professionals who want structured, high-quality research inspiration without starting from scratch:
        </p>
        <ul>
            <li>🎓 Medical Students preparing final year dissertations</li>
            <li>🏥 Medical Residents developing specialty theses</li>
            <li>📚 Fellows and Early-Career Researchers exploring advanced topics</li>
            <li>👩‍⚕️ Public Health and Allied Health Professionals interested in evidence-based practice</li>
        </ul>
    </div>

    <!-- Importance Section -->
    <div class="card shadow-sm p-4 mb-4">
        <h4 class="fw-bold mb-3">Why This Space is Important</h4>
        <p>
            Many students struggle with unclear topics, lack of direction, or choosing research ideas that are either too broad or not academically relevant.
            This Research Space bridges that gap by offering well-thought-out, realistic, and academically strong dissertation ideas
            that respond to real healthcare challenges in Rwanda and beyond.
        </p>
    </div>

    <!-- Action Button -->
    <div class="text-center">
        <button class="btn btn-primary px-4 py-2">
            Confirm with a Mentor
        </button>
    </div>

</div>

<style>
    .card{
        border-radius: 12px;
        border: none;
    }
    button.btn-primary{
        background: linear-gradient(45deg,#4e54c8,#8f94fb);
        border: none;
        font-weight: 600;
    }
    button.btn-primary:hover{
        opacity: .9;
    }
</style>

@endsection