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
    @vite('resources/css/default-layout.css')

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

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Department
                        </a>
                        <ul class="dropdown-menu">
                            @foreach (config('navigation.departments') as $route => $name)
                                <li>
                                    <a class="dropdown-item {{ request()->is($route) ? 'active' : '' }}"
                                        href="/{{ $route }}/announcements">
                                        {{ $name }}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </li>
                    @if(auth()->guard('student')->check())
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/account">Account</a>
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
                        @if (auth()->guard('admin')->check())
                            @foreach (config('navigation.card_nav') as $route => $name)
                                @php
                                    $segments = request()->segments();

                                    $isAnnouncementGeneral = $segments[0] == 'announcements';
                                    $isDepartment = in_array(
                                        $segments[0] ?? null,
                                        array_keys(config('navigation.departments')),
                                    );
                                    $url = url($route);

                                    if ($route == 'announcements' && !$isAnnouncementGeneral && $isDepartment) {
                                        $url = url(implode('/', [request()->segment(1), $route]));
                                    }

                                    $isActive = request()->is("*{$route}*");
                                    $class = $isActive ? 'active' : '';

                                @endphp
                                <li class="nav-item">
                                    <a class="nav-link {{ $class }}" href="{{ $url }}">
                                        {{ $name }}
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <span class="nav-link active">
                                Accouncements
                            </span>

                        @endif
                    </ul>
                </div>
            </div>


            @yield('content')

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
@yield('scripts')
</body>

</html>
