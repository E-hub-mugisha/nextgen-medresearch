<div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ms-n1"><a href="#"
                    class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em
                        class="icon ni ni-menu"></em></a></div>
            <div class="nk-header-brand d-xl-none"><a href="{{ route('dashboard')}}" class="logo-link"><img
                        class="logo-light logo-img" src="images/logo.png"
                        srcset="{{ asset('assets/images/logo-white.png') }} 2x" alt="logo"><img class="logo-dark logo-img"
                        src="images/logo-dark.png" srcset="{{ asset('assets/images/logo-dark.png') }} 2x"
                        alt="logo-dark"></a></div>
            <div class="nk-header-news d-none d-xl-block">
                <div class="nk-news-list"><a class="nk-news-item" href="#">
                        <div class="nk-news-icon"><em class="icon ni ni-card-view"></em></div>
                        <div class="nk-news-text">
                            
                        </div>
                    </a></div>
            </div>
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown user-dropdown"><a href="#" class="dropdown-toggle"
                            data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm"><em class="icon ni ni-user-alt"></em></div>
                                <div class="user-info d-none d-md-block">
                                    <div class="user-status">Administrator</div>
                                    <div class="user-name dropdown-indicator">{{ Auth::user()->name }}</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar"><span>AB</span></div>
                                    <div class="user-info">
                                        <span class="lead-text">
                                            {{ Auth::user()->name }}
                                        </span><span
                                            class="sub-text">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
</div>