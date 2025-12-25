<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Collaboration Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background: #f5f7fa;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #2f3d4a;
            color: #fff;
            padding-top: 60px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }

        .sidebar a:hover {
            background: #4e54c8;
        }

        .main {
            margin-left: 250px;
            padding: 20px;
        }

        .topbar {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            height: 60px;
            background: #fff;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            padding: 0 20px;
            justify-content: space-between;
            z-index: 1000;
        }

        .card {
            border-radius: 0.5rem;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h4 class="text-center mt-2">Portal</h4>
        <a href="{{ route('portal.dashboard') }}"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
        <a href="{{ route('mentor.requests.index') }}"><i class="fa-solid fa-envelope"></i> Requests</a>
        <a href="{{ route('projects.index') }}"><i class="fa-solid fa-folder"></i> Projects</a>
        <a href="{{ route('messages.index') }}"><i class="fa-solid fa-comments"></i> Messages</a>
        <a href="#"><i class="fa-solid fa-user"></i> Profile</a>
        <a href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>

    <div class="topbar">
        <h5>Welcome, {{ auth()->user()->name }}</h5>
        <div>
            <button class="btn btn-sm btn-gradient-primary">Notifications <span class="badge bg-danger">3</span></button>
        </div>
    </div>

    <div class="main mt-5">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>