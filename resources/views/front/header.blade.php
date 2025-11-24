<!-- Header Start -->
<header class="main-header">
    <div class="header-sticky">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo Start -->
                <a class="navbar-brand" href="{{ route('home')}}">
                    <img src="{{ asset('assets/images/logo-white.png') }}" alt="Logo" style="width: 100%; height:10rem">
                </a>
                <!-- Logo End -->

                <!-- Main Menu Start -->
                <div class="collapse navbar-collapse main-menu">
                    <div class="nav-menu-wrapper">
                        <ul class="navbar-nav mr-auto" id="menu">
                            <li class="nav-item submenu"><a class="nav-link" href="#">Who We Are</a>
                                <ul>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('about')}}">About Us</a></li>
                                    <li class="nav-item"><a class="nav-link" href="blog-single.html">Vision, Mission & Our Model</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('partners')}}">Partners</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('our-impact')}}">our Impact</a></li>
                                </ul>
                            </li>
                            <li class="nav-item submenu"><a class="nav-link" href="#">Programs</a>
                                <ul>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('mentorship')}}">Mentorship Hub</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('research_data')}}">Research & Data Support</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('capacity_building')}}">Capacity Building Workshops</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('innovation_projects')}}">Innovation Projects</a></li>
                                </ul>
                            </li>
                            <li class="nav-item submenu"><a class="nav-link" href="#">Knowledge Hub</a>
                                <ul>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('projects') }}">Projects</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('resources') }}">Free Resources</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('mentor_qna.index') }}">Ask a Mentor Q&A</a></li>
                                    <li class="nav-item"><a class="nav-link">Research Kits</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('news')}}">News & Updates</a></li>

                            <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
                        </ul>
                    </div>

                    <!-- Header Btn Start -->
                    <div class="header-btn">
                        <a role="button" data-bs-toggle="modal" data-bs-target="#membershipModal" class="btn-default btn-highlighted">Apply for Membership</a>
                        <a href="{{ route('rescue.sheet.public') }}" class="btn-default btn-highlighted">Rescue sheets</a>
                    </div>
                    <!-- Header Btn End -->
                </div>
                <!-- Main Menu End -->
                <div class="navbar-toggle"></div>
            </div>
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