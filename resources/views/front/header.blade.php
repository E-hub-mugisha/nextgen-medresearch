@php

if (! function_exists('activeRoute')) {
function activeRoute($routes)
{
return request()->routeIs($routes) ? 'active' : '';
}
}
$programs = \App\Models\Program::where('status', 'published')->orderBy('title')->get();
@endphp

<!-- Header Start -->
<header class="main-header">
    <div class="header-sticky">
        <nav class="navbar navbar-expand-lg">

            <!-- Logo Start -->
            <a class="navbar-brand" href="{{ route('home')}}">
                <img src="{{ asset('assets/images/logo-white.png') }}" alt="Logo" style="width: 100%; height:6rem">
            </a>
            <!-- Logo End -->

            <!-- Main Menu Start -->
            <div class="collapse navbar-collapse main-menu">
                <div class="nav-menu-wrapper">
                    <ul class="navbar-nav mr-auto" id="menu">

                        {{-- WHO WE ARE --}}
                        <li class="nav-item submenu {{ activeRoute(['about','partners','our-impact']) }}">
                            <a class="nav-link" href="#">Who We Are</a>
                            <ul>
                                <li class="nav-item">
                                    <a class="nav-link {{ activeRoute('about') }}"
                                        href="{{ route('about') }}">About Us</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="#">Vision, Mission & Our Model</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ activeRoute('partners') }}"
                                        href="{{ route('partners') }}">Partners</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ activeRoute('our-impact') }}"
                                        href="{{ route('our-impact') }}">Our Impact</a>
                                </li>
                            </ul>
                        </li>

                        {{-- PROGRAMS --}}
                        <li class="nav-item submenu {{ activeRoute(['programs','programs.detail']) }}">
                            <a class="nav-link {{ activeRoute('programs') }}"
                                href="{{ route('programs') }}">Programs</a>

                            <ul>
                                @foreach($programs as $program)
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('programs.detail') && request()->slug === $program->slug ? 'active' : '' }}"
                                        href="{{ route('programs.detail', $program->slug) }}">
                                        {{ $program->title }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>

                        {{-- KNOWLEDGE HUB --}}
                        <li class="nav-item submenu {{ activeRoute(['projects','resources','mentor_qna.*']) }}">
                            <a class="nav-link" href="#">Knowledge Hub</a>
                            <ul>
                                <li class="nav-item">
                                    <a class="nav-link {{ activeRoute('projects') }}"
                                        href="{{ route('projects') }}">Projects</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ activeRoute('resources') }}"
                                        href="{{ route('resources') }}">Free Resources</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ activeRoute('mentor_qna.*') }}"
                                        href="{{ route('mentor_qna.index') }}">Ask a Mentor Q&A</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#">Research Kits</a>
                                </li>
                            </ul>
                        </li>

                        {{-- NEWS --}}
                        <li class="nav-item">
                            <a class="nav-link {{ activeRoute('news') }}"
                                href="{{ route('news') }}">News & Updates</a>
                        </li>

                        {{-- RESEARCH SPACE --}}
                        <li class="nav-item">
                            <a class="nav-link #"
                                href="#">Research Space</a>
                        </li>

                        {{-- CONTACT --}}
                        <li class="nav-item">
                            <a class="nav-link {{ activeRoute('contact') }}"
                                href="{{ route('contact') }}">Contact Us</a>
                        </li>

                    </ul>

                </div>

                <!-- Header Btn Start -->
                <div class="header-btn">
                    <a role="button" data-bs-toggle="modal" data-bs-target="#roleModal" class="btn-default-2 btn-highlighted">Apply for Membership</a>
                    <a href="{{ route('rescue.sheet.public') }}" class="btn-default btn-highlighted">Rescue sheets</a>
                </div>
                <!-- Header Btn End -->
            </div>
            <!-- Main Menu End -->
            <div class="navbar-toggle"></div>

        </nav>
        <div class="responsive-menu"></div>
    </div>
</header>
<!-- Header End -->

<!-- Glass Role Selection Modal -->
<div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content glass-modal border-0 rounded-4">

            <!-- Header -->
            <div class="modal-header border-0 px-4 pt-4">
                <div>
                    <h3 class="fw-bold mb-1" id="roleModalLabel">Welcome 👋</h3>
                    <p class="text-muted mb-0">Choose how you want to join</p>
                </div>
                <button type="button" class="btn-close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body px-4 pb-4">
                <div class="row g-4">

                    <!-- Mentee -->
                    <div class="col-md-6">
                        <div class="role-card mentee text-center p-4 rounded-4 h-100"
                             id="join-mentee" role="button">
                            <div class="icon mb-3">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>
                            <h5 class="fw-bold">Join as Mentee</h5>
                            <p class="text-muted small">
                                Get guidance, explore research, and grow faster.
                            </p>
                            <span class="badge bg-success px-3 py-2">Get Mentored</span>
                        </div>
                    </div>

                    <!-- Mentor -->
                    <div class="col-md-6">
                        <div class="role-card mentor text-center p-4 rounded-4 h-100"
                             id="join-mentor" role="button">
                            <div class="icon mb-3">
                                <i class="bi bi-person-workspace"></i>
                            </div>
                            <h5 class="fw-bold">Join as Mentor</h5>
                            <p class="text-muted small">
                                Share expertise and shape future researchers.
                            </p>
                            <span class="badge bg-info px-3 py-2">Become a Guide</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* Glass Modal Effect */
.glass-modal {
    background: rgba(255, 255, 255, 0.75);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    box-shadow: 0 25px 60px rgba(0,0,0,0.25);
}

/* Role Cards */
.role-card {
    cursor: pointer;
    transition: all 0.35s ease;
    border: 1px solid rgba(255,255,255,0.4);
    background: rgba(255,255,255,0.6);
}

.role-card .icon {
    font-size: 3rem;
    color: #6c757d;
}

.role-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 45px rgba(0,0,0,0.18);
}

.role-card.mentee:hover {
    border-color: #28a745;
}
.role-card.mentee:hover .icon {
    color: #28a745;
}

.role-card.mentor:hover {
    border-color: #0dcaf0;
}
.role-card.mentor:hover .icon {
    color: #0dcaf0;
}

/* Modal Backdrop (subtle blur) */
.modal-backdrop.show {
    backdrop-filter: blur(10px);
    background-color: rgba(0,0,0,0.35);
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('join-mentee').addEventListener('click', function() {
            window.location.href = "{{ route('onboarding.index', 'mentee') }}";
        });
        document.getElementById('join-mentor').addEventListener('click', function() {
            window.location.href = "{{ route('mentor.onboarding', 'mentor') }}";
        });
    });
</script>