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
                    <a role="button" data-bs-toggle="modal" data-bs-target="#membershipModal" class="btn-default-2 btn-highlighted">Apply for Membership</a>
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

<!-- Modal -->
<div class="modal fade" id="membershipModal" tabindex="-1" aria-labelledby="membershipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('membership.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="membershipModalLabel">Apply for Membership</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Full Name</label>
                        <input type="text" class="form-control" name="full_name" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="mb-3">
                        <label>Membership Type</label>
                        <select class="form-control" name="type" required>
                            <option value="individual">Individual</option>
                            <option value="trainer">Trainer / Expert</option>
                            <option value="institutional">Institutional</option>
                            <option value="corporate">Corporate</option>
                            <option value="honorary">Honorary / Support</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Organization (if any)</label>
                        <input type="text" class="form-control" name="organization">
                    </div>
                    <div class="mb-3">
                        <label>Why do you want to join?</label>
                        <textarea class="form-control" name="motivation" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Application</button>
                </div>
            </form>
        </div>
    </div>
</div>