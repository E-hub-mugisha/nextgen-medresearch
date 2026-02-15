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
            <div class="container-fluid d-flex flex-wrap align-items-center justify-content-between">
                <!-- Logo Start -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/logo-white.png') }}" alt="Logo" style="width: 100%; height:5rem">
                </a>
                <!-- Logo End -->

                <!-- Mobile Toggle -->
                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button> -->

                <!-- Main Menu Start -->
                <div class="collapse navbar-collapse flex-wrap main-menu" id="mainNavbar">
                    <div class="nav-menu-wrapper">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex flex-wrap align-items-center" id="menu">
                            <!-- About -->
                            <li class="nav-item submenu {{ activeRoute(['about','partners','our-impact']) }}">
                                <a class="nav-link" href="#">About</a>
                                <ul>
                                    <!-- <li class="nav-item">
                                    <a class="nav-link {{ activeRoute('about') }}"
                                        href="{{ route('about') }}">About Us</a>
                                </li> -->

                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('about') }}">Vision, Mission</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('partners') }}">Partnerships</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('our-impact') }}">Our Impact</a>
                                    </li>
                                </ul>
                            </li>


                            <li class="nav-item submenu {{ activeRoute(['programs','programs.detail']) }}">
                                <a class="nav-link {{ activeRoute('programs') }}"
                                    href="#!">Programs</a>

                                <ul>
                                    @foreach($programs as $program)
                                    <li class="nav-item">
                                        <a class="nav-link "
                                            href="{{ route('programs.detail', $program->slug) }}">
                                            {{ $program->title }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>


                            <li class="nav-item submenu {{ activeRoute(['projects','resources','mentor_qna.*']) }}">
                                <a class="nav-link" href="#">Knowledge Hub</a>
                                <ul>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('mentor_qna.index') }}">Ask a Mentor</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('kits.index') }}">Research Kits</a>
                                    </li>
                                </ul>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link {{ activeRoute('news') }}"
                                    href="{{ route('news') }}">News</a>
                            </li>


                            <li class="nav-item  {{ activeRoute('research.space') }}">
                                <a class="nav-link " href="{{ route('research.space')}}">Research Space</a>
                            </li>
                            {{-- CONTACT --}}
                            <li class="nav-item">
                                <a class="nav-link {{ activeRoute('contact') }}"
                                    href="{{ route('contact') }}">Contact</a>
                            </li>

                            <!-- Mobile Buttons -->
                            <li class="nav-item d-lg-none mt-2">
                                <a role="button" data-bs-toggle="modal" data-bs-target="#roleModal" class="nav-link btn btn-default-2 btn-highlighted w-50 text-center" style="color: #fff; border: 1px solid #fff;">Join</a>
                            </li>
                            <li class="nav-item d-lg-none mt-2">
                                <a href="{{ route('rescue.sheet.public') }}" class="nav-link btn btn-default btn-highlighted w-50 text-center" style="color: #00697E;">Rescue Sheets</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Desktop Buttons -->
                    <div class="header-btn d-none d-lg-flex ms-3 d-flex flex-wrap mt-2 mt-lg-0 ms-lg-3 ">
                        <a role="button" data-bs-toggle="modal" data-bs-target="#roleModal" class="btn btn-default-2 btn-highlighted me-2">Join</a>
                        <a href="{{ route('rescue.sheet.public') }}" class="btn btn-default btn-highlighted">Rescue Sheets</a>
                    </div>
                </div>
                <!-- Main Menu End -->
                <div class="navbar-toggle"></div>
            </div>
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
                    <h3 class="fw-bold mb-1" id="roleModalLabel">Welcome!</h3>
                    <p class="text-muted mb-0">Choose how you want to join</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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

                    <div class="d-flex justify-content-center text-center">
                        <p class="mb-3 px-2">already joined the platform? click below to enter into the account!</p>
                        <a href="{{ route('login') }}" class="btn-default mb-3">Login</a>
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
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
    }

    /* Role Cards */
    .role-card {
        cursor: pointer;
        transition: all 0.35s ease;
        border: 1px solid rgba(255, 255, 255, 0.4);
        background: rgba(255, 255, 255, 0.6);
    }

    .role-card .icon {
        font-size: 3rem;
        color: #6c757d;
    }

    .role-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.18);
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
        background-color: rgba(0, 0, 0, 0.35);
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

<!-- Membership Modal -->
<div class="modal fade" id="membershipModal" tabindex="-1" aria-labelledby="membershipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="membershipModalLabel">
                    Membership Application
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('membership.store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">

                        <!-- Full Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control">
                        </div>

                        <!-- Membership Type -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Membership Type *</label>
                            <select name="type" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="individual">Individual</option>
                                <option value="trainer">Trainer</option>
                                <option value="institutional">Institutional</option>
                                <option value="corporate">Corporate</option>
                                <option value="honorary">Honorary</option>
                            </select>
                        </div>

                        <!-- Organization -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Organization (if applicable)</label>
                            <input type="text" name="organization" class="form-control">
                        </div>

                        <!-- Motivation -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Why do you want to join?</label>
                            <textarea name="motivation" class="form-control" rows="4"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Submit Application
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
