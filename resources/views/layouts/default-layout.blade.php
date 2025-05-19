<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Student Portal</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
            display: flex;
            align-items: center;

            justify-content: center;

            padding: 2rem;
        }

        .main-card {
            margin: auto auto;
            max-width: 1200px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-navbar {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            padding: 0.5rem 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            position: relative;
            /* Needed for absolute positioning of account link */
        }

        .card-navbar .container-fluid {
            display: inline-block;
            /* Makes container fit content */
            width: auto;
            /* Prevents full-width behavior */
            min-width: 100%;
            /* Ensures it takes full width when needed */
        }

        .card-navbar .navbar-nav {
            display: inline-flex;
            width: auto;
        }

        /* Account link positioning */
        .card-navbar .account-link {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: #f8f9fa;
            /* Match navbar background */
            padding: 0.5rem 0;
        }

        /* Ensure nav items have spacing */
        .card-navbar .nav-item {
            padding: 0 0.5rem;
        }

        .main-card {
            overflow: hidden;
            height: 80vh;

        }

        .navbar-brand {

            left: 1rem;
        }

        .navbar-collapse {
            width: 100%;
        }

        /* Center the nav items on desktop */
        @media (min-width: 992px) {
            .navbar-brand {
                position: absolute;
                left: 1rem;
            }

            .navbar-collapse {
                width: 100%;
            }
        }

        /* Mobile styles */
        @media (max-width: 991.98px) {
            .navbar-nav.mx-auto {
                margin: 0.5rem 0 !important;
                /* Reset margin for mobile */
            }

            .dropdown-menu {
                position: static !important;
                /* Better dropdown behavior on mobile */
            }
        }

        @media (max-width: 1200px) {
            .main-card {
                margin: 2rem 1rem;
            }
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid position-relative"> <!-- Added position-relative -->
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="https://fsciences.univ-setif.dz/assets/logo-81a7d49ffa8b5951d78705e52e50f0b3778d870202ed2632e5b9a437bd4a5e08.png"
                    alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                Student Portal
            </a>

            <!-- Toggler Button (visible on mobile) -->
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible Content -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Centered Navigation Items -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    @if (auth()->guard('admin')->check() || auth()->guard('student')->check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Department
                            </a>
                            <ul class="dropdown-menu">
                                @foreach (config('navigation.departments') as $route => $name)
                                    <li>
                                        <a class="dropdown-item {{ request()->is($route) ? 'active' : '' }}"
                                            href="/{{ $route }}">
                                            {{ $name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                </ul>

                <!-- Right-aligned Auth Links -->
                <div class="d-flex">
                    @if (auth()->guard('admin')->check())
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input type="hidden" name="user_type" value="admin">
                            <button type="submit" class="btn btn-link nav-link">Logout</button>
                        </form>
                    @elseif(auth()->guard('student')->check())
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input type="hidden" name="user_type" value="student">
                            <button type="submit" class="btn btn-link nav-link">Logout</button>
                        </form>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    @endauth
            </div>
        </div>
    </div>
</nav>

@if (session()->has('success'))
    <div class="container container--narrow">
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    </div>
@endif

@if (session()->has('failure'))
    <div class="container container--narrow">
        <div class="alert alert-danger text-center">
            {{ session('failure') }}
        </div>
    </div>
@elseif (count($errors) > 0)
    <div class="container container--narrow">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<main class="flex-grow-1">
    <div class="container">
        <div class="card main-card">
            <!-- Card Navbar -->
            <div class="card-navbar navbar navbar-expand navbar-light bg-light">
                <div class="container-fluid">
                    <ul class="navbar-nav card-nav-list">
                        @if (auth()->guard('admin')->check() || auth()->guard('student')->check())
                            @foreach (config('navigation.card_nav') as $route => $name)
                                @php
                                    // Get current URL segments
                                    $segments = request()->segments();
                                    // Check if we're in a department section
$isDepartment = in_array(
    $segments[0] ?? null,
    array_keys(config('navigation.departments')),
);
// Build the correct URL
$url = $isDepartment
    ? url(implode('/', [request()->segment(1), $route]))
                                        : url($route);
                                    // Check active state
                                    $isActive = request()->is("*{$route}*");
                                @endphp
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is($route) ? 'active' : '' }}"
                                        href="{{ $url }}">
                                        {{ $name }}
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <a class="nav-link active" href="/">
                                Accouncements
                            </a>

                        @endif
                    </ul>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                @yield('content')
            </div>
        </div>
    </div>
</main>

<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top mt-auto">
    <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 mx-2 mb-md-0 text-body-secondary text-decoration-none lh-1"
            aria-label="Bootstrap">
            <img src="https://fsciences.univ-setif.dz/assets/logo-81a7d49ffa8b5951d78705e52e50f0b3778d870202ed2632e5b9a437bd4a5e08.png"
                alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
        </a>
        <span class="mb-3 mb-md-0 text-body-secondary">© 2025 Student Portal</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
