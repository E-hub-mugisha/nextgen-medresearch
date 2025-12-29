<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Collaboration Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet" media="screen">
    <!-- Animated Css -->
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <!-- Magnific Popup Core Css File -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <!-- Mouse Cursor Css File -->
    <link rel="stylesheet" href="{{ asset('assets/css/mousecursor.css') }}">
    <!-- Main Custom Css -->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" media="screen">
    <style>
        body {
            background: #f5f7fa;
        }

        .navbar {
            background: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.07);
        }

        .nav-link {
            font-weight: 500;
        }

        .notification-bell {
            position: relative;
            cursor: pointer;
        }

        .notification-bell .badge {
            position: absolute;
            top: -6px;
            right: -6px;
            font-size: 10px;
        }

        .profile-img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
        }

        .dropdown-menu {
            border-radius: 10px;
        }

        .main {
            padding: 90px 25px 25px;
        }

        .profile-card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-brand fw-bold text-primary">
                <img src="{{ asset('assets/images/logo-new-white.png') }}" alt="Logo" style="width: 100%; height:4rem">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 m-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('portal.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mentor.requests.index') }}">Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('projects.index') }}">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('messages.index') }}">Messages</a>
                    </li>
                </ul>

                <!-- RIGHT SIDE -->
                <div class="d-flex align-items-center gap-3">

                    <!-- Notifications -->
                    <div class="dropdown">
                        <i class="fa-solid fa-bell fs-5 notification-bell" data-bs-toggle="dropdown"></i>
                        <span class="badge bg-danger">3</span>

                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li class="dropdown-header fw-bold">Notifications</li>
                            <li>
                                <hr>
                            </li>
                            <li><a class="dropdown-item">New collaboration request</a></li>
                            <li><a class="dropdown-item">Project update received</a></li>
                            <li><a class="dropdown-item">New message from mentor</a></li>
                            <li>
                                <hr>
                            </li>
                            <li><a class="dropdown-item text-center text-primary">View All</a></li>
                        </ul>
                    </div>

                    <!-- Profile Dropdown -->
                    <div class="dropdown">
                        <img src="https://i.pravatar.cc/150?img=12" class="profile-img" data-bs-toggle="dropdown">

                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li class="dropdown-header text-center">
                                <strong>{{ auth()->user()->name }}</strong>
                                <p class="text-muted small mb-0">{{ auth()->user()->email }}</p>
                            </li>
                            <li>
                                <hr>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('mentee.profile') }}"><i class="fa-solid fa-user"></i> Profile</a></li>
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
            </div>

        </div>
    </nav>


    <!-- MAIN CONTENT -->
    <div class="container main">

        @yield('content')

    </div>
    <footer class="mt-5 py-3" style="background:#f5f7fa; border-top:1px solid #ddd;">
        <div class="container text-center text-muted">
            © {{ date('Y') }} Research Collaboration Portal • Built with ❤️ for Researchers
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')

</body>

</html>