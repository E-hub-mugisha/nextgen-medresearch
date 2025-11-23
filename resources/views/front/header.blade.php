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
                                    <li class="nav-item"><a class="nav-link" href="case-study.html">Capacity Building Workshops</a></li>
                                    <li class="nav-item"><a class="nav-link">Innovation Projects</a></li>
                                </ul>
                            </li>
                            <li class="nav-item submenu"><a class="nav-link" href="#">Knowledge Hub</a>
                                <ul>
                                    <li class="nav-item"><a class="nav-link" href="service-single.html">Blog Articles</a></li>
                                    <li class="nav-item"><a class="nav-link" href="blog-single.html">Free Resources</a></li>
                                    <li class="nav-item"><a class="nav-link" href="case-study.html">Ask a Mentor Q&A</a></li>
                                    <li class="nav-item"><a class="nav-link">Research Kits</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('news')}}">News & Updates</a></li>
                            
                            <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
                        </ul>
                    </div>

                    <!-- Header Btn Start -->
                    <div class="header-btn">
                        <a href="contact.html" class="btn-default btn-highlighted">Apply for Membership</a>
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