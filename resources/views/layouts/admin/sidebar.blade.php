<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
        <div class="nk-sidebar-element nk-sidebar-head">
                <div class="nk-menu-trigger"><a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none"
                                data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a><a href="#"
                                class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                                data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a></div>
                <div class="nk-sidebar-brand"><a href="{{ route('dashboard')}}" class="logo-link nk-sidebar-logo"><img
                                        class="logo-light logo-img" src="{{ asset('assets/images/logo-white.png') }}" srcset="{{ asset('assets/images/logo-white.png') }} 2x"
                                        alt="logo"><img class="logo-dark logo-img" src="{{ asset('assets/images/logo-white.png') }}"
                                        srcset="{{ asset('assets/images/logo-dark.png') }} 2x" alt="logo-dark"></a></div>
        </div>
        <div class="nk-sidebar-element nk-sidebar-body">
                <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                                <ul class="nk-menu">
                                        <li class="nk-menu-heading">
                                                <h6 class="overline-title text-primary-alt">Use-Case Preview</h6>
                                        </li>

                                        <li class="nk-menu-item"><a href="{{ route('dashboard')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span><span
                                                                class="nk-menu-text">Dashboard</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.users.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-bitcoin-cash"></em></span><span
                                                                class="nk-menu-text">Users</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.categories.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-growth"></em></span><span
                                                                class="nk-menu-text">Category</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.posts.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-coins"></em></span><span
                                                                class="nk-menu-text">Posts</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.programs.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-coins"></em></span><span
                                                                class="nk-menu-text">Programs</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.stories.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span><span
                                                                class="nk-menu-text">Stories</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.resources.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-bitcoin-cash"></em></span><span
                                                                class="nk-menu-text">Resources</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.partners.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-growth"></em></span><span
                                                                class="nk-menu-text">Partners</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.events.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-coins"></em></span><span
                                                                class="nk-menu-text">Events</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.rescue.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span><span
                                                                class="nk-menu-text">Rescue Sheets</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.projects.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-bitcoin-cash"></em></span><span
                                                                class="nk-menu-text">Projects</span></a></li>
                                        
                                        <li class="nk-menu-item"><a href="{{ route('admin.memberships.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-coins"></em></span><span
                                                                class="nk-menu-text">Memberships</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.research.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span><span
                                                                class="nk-menu-text">Research</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.research_spaces.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-bitcoin-cash"></em></span><span
                                                                class="nk-menu-text">Research Spaces</span></a></li>
                                                                <li class="nk-menu-item"><a href="{{ route('admin.research_kits.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-bitcoin-cash"></em></span><span
                                                                class="nk-menu-text">Research Kits</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.faqs.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-bitcoin-cash"></em></span><span
                                                                class="nk-menu-text">FAQs</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.testimonials.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-growth"></em></span><span
                                                                class="nk-menu-text">Testimonials</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.team.index')}}" class="nk-menu-link"><span
                                                                class="nk-menu-icon"><em class="icon ni ni-coins"></em></span><span
                                                                class="nk-menu-text">Team members</span></a></li>
                                </ul>
                        </div>
                </div>
        </div>
</div>