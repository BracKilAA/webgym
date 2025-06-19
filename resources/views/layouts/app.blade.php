<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Gym Management')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            padding-top: 70px;
        }

        main.container {
            flex: 1;
        }

        .custom-navbar {
            background: linear-gradient(90deg, #0066ff, #0052cc);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .nav-button {
            transition: all 0.3s ease-in-out;
            border-radius: 30px;
            padding: 0.4rem 1rem;
            font-weight: 500;
        }

        .nav-button:hover {
            transform: translateY(-2px);
            background-color: rgba(255, 255, 255, 0.15) !important;
        }
    </style>

    @stack('styles')
</head>
<body>

@php
    $authRoutes = ['login', 'register'];
@endphp

@if (!in_array(Route::currentRouteName(), $authRoutes))
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top custom-navbar">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="{{ route('dashboard') }}">
                <i class="bi bi-bar-chart-line-fill"></i> Gym Management
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item">
                        <a class="btn btn-outline-light nav-button" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light nav-button" href="{{ route('users.index') }}">
                            <i class="bi bi-people"></i> Clientes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light nav-button" href="{{ route('plans.index') }}">
                            <i class="bi bi-clipboard-check"></i> Planes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light nav-button" href="{{ route('evaluations.index') }}">
                            <i class="bi bi-clipboard-pulse"></i> Evaluaciones
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger nav-button">
                                <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endif

@if (!in_array(Route::currentRouteName(), $authRoutes))
    <!-- Main content -->
    <main class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-5">
        <div class="container">
            <small>&copy; {{ date('Y') }} Gym Management. Todos los derechos reservados.</small>
        </div>
    </footer>
@else
    <!-- Login/Register content -->
    @yield('content')
@endif

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>
