<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Yosel Enterprise')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold text-warning" href="{{ url('/') }}">
            Yosel Enterprise
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- LEFT LINKS -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('snooker.index') }}">Snooker</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/restaurant') }}">Restaurant</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/giftshop') }}">Gift Shop</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/shop') }}">Shop</a>
                </li>
            </ul>

            <!-- RIGHT SIDE -->
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn btn-warning text-dark ms-2 px-3" href="{{ route('register') }}">
                            Register
                        </a>
                    </li>
                @else

                    <!-- USER NAME -->
                    <li class="nav-item">
                        <span class="nav-link text-warning">
                            👋 {{ auth()->user()->name }}
                        </span>
                    </li>

                    <!-- PROFILE -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                    </li>

                    <!-- ADMIN -->
                    @if(auth()->user()->is_admin || auth()->user()->role === 'super_admin')
                        <li class="nav-item">
                            <a class="nav-link text-warning fw-bold" href="{{ url('/admin/dashboard') }}">
                                Admin
                            </a>
                        </li>
                    @endif

                    <!-- LOGOUT -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger ms-2 px-3">Logout</button>
                        </form>
                    </li>

                @endguest
            </ul>

        </div>
    </div>
</nav>

<!-- MAIN CONTENT -->
<main class="py-4">
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="bg-dark text-center text-light py-3 mt-5">
    <small>© {{ date('Y') }} Yosel Enterprise. All rights reserved.</small>
</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>