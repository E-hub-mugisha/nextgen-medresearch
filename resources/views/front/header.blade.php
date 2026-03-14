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
                                            href="{{ route('our-impact') }}">Our Impact</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('partners') }}">Partnerships</a>
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
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('projects') }}">Projects</a>
                                    </li>
                                     <li class="nav-item">
                                        <a class="nav-link" href="{{ route('research.index') }}">Research</a>
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

<!-- Role Selection Modal -->
<div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 560px;">
        <div class="modal-content border-0 rounded-4 shadow-lg">

            <!-- Header -->
            <div class="modal-header border-0 px-4 pt-4 pb-0 align-items-start">
                <div>
                    <p class="text-uppercase fw-semibold text-muted mb-1" style="font-size: 11px; letter-spacing: 0.08em;">
                        Research Portal
                    </p>
                    <h4 class="fw-semibold mb-1" id="roleModalLabel">How will you contribute?</h4>
                    <p class="text-muted mb-0" style="font-size: 14px;">Select your role to get started</p>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body px-4 pb-4 pt-3">
                <div class="row g-3 mb-3">

                    <!-- Mentee Card -->
                    <div class="col-6">
                        <div class="role-card p-3 rounded-3 h-100 border"
                            id="card-mentee"
                            data-role="mentee"
                            role="button"
                            onclick="selectRole('mentee')">
                            <div class="role-icon mb-3 d-flex align-items-center justify-content-center rounded-3"
                                style="width:42px;height:42px;background:#E1F5EE;">
                                <i class="bi bi-mortarboard-fill" style="color:#0F6E56;font-size:18px;"></i>
                            </div>
                            <p class="fw-semibold mb-1" style="font-size:15px;">Join as Mentee</p>
                            <p class="text-muted mb-3" style="font-size:12px;line-height:1.5;">
                                Explore research, get guidance and grow faster with expert support.
                            </p>
                            <span class="badge rounded-pill px-3 py-2"
                                style="background:#E1F5EE;color:#0F6E56;font-size:11px;">
                                Get mentored
                            </span>
                        </div>
                    </div>

                    <!-- Mentor Card -->
                    <div class="col-6">
                        <div class="role-card p-3 rounded-3 h-100 border"
                            id="card-mentor"
                            data-role="mentor"
                            role="button"
                            onclick="selectRole('mentor')">
                            <div class="role-icon mb-3 d-flex align-items-center justify-content-center rounded-3"
                                style="width:42px;height:42px;background:#E6F1FB;">
                                <i class="bi bi-person-check-fill" style="color:#185FA5;font-size:18px;"></i>
                            </div>
                            <p class="fw-semibold mb-1" style="font-size:15px;">Join as Mentor</p>
                            <p class="text-muted mb-3" style="font-size:12px;line-height:1.5;">
                                Share expertise, guide researchers and shape the next generation.
                            </p>
                            <span class="badge rounded-pill px-3 py-2"
                                style="background:#E6F1FB;color:#185FA5;font-size:11px;">
                                Become a guide
                            </span>
                        </div>
                    </div>

                </div>

                <!-- Continue Button (hidden until role selected) -->
                <div id="continueWrapper" class="mb-3" style="display:none;">
                    <a id="continueBtn" href="#" class="btn w-100 py-2 fw-semibold text-white rounded-3"
                        style="font-size:14px;">
                        Continue
                    </a>
                </div>

                <!-- Login Divider -->
                <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                    <p class="text-muted mb-0" style="font-size:13px;">Already have an account?</p>
                    <a href="{{ route('login') }}"
                        class="btn btn-sm btn-outline-secondary rounded-3 px-3"
                        style="font-size:13px;">
                        Sign in
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .role-card {
        cursor: pointer;
        transition: border-color 0.15s ease, background 0.15s ease;
        border-color: #dee2e6 !important;
    }

    .role-card:hover {
        background: #f8f9fa;
    }

    .role-card.selected-mentee {
        border: 2px solid #1D9E75 !important;
        background: rgba(225, 245, 238, 0.3) !important;
    }

    .role-card.selected-mentor {
        border: 2px solid #185FA5 !important;
        background: rgba(230, 241, 251, 0.3) !important;
    }
</style>

<script>
    function selectRole(role) {
        // Reset both cards
        document.getElementById('card-mentee').className = 'role-card p-3 rounded-3 h-100 border';
        document.getElementById('card-mentor').className = 'role-card p-3 rounded-3 h-100 border';

        // Highlight selected
        document.getElementById('card-' + role).classList.add('selected-' + role);

        // Update continue button
        const btn = document.getElementById('continueBtn');
        const wrapper = document.getElementById('continueWrapper');
        const routeBase = "{{ url('/onboarding') }}";

        btn.href = routeBase + '?role=' + role;
        btn.style.background = role === 'mentee' ? '#0F6E56' : '#185FA5';
        wrapper.style.display = 'block';
    }
</script>

<!-- Membership Modal -->
<div class="modal fade" id="membershipModal" tabindex="-1" aria-labelledby="membershipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">

            <div class="modal-header border-0 px-4 pt-4 pb-0">
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