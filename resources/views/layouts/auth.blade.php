<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Application')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

    {{-- App Styles --}}
    <style>
        body {
            background-color: #f5f6fa;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto;
        }

        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }

        .sidebar {
            width: 250px;
            background: #111827;
            min-height: 100vh;
        }

        .sidebar a {
            color: #d1d5db;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            border-radius: 6px;
            margin: 4px 10px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: #2563eb;
            color: #fff;
        }

        .content-wrapper {
            padding: 25px;
        }

        .page-title {
            font-size: 1.4rem;
            font-weight: 600;
        }

        footer {
            border-top: 1px solid #e5e7eb;
            padding: 12px;
            text-align: center;
            font-size: 13px;
            background: #fff;
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- ================= TOP NAVBAR ================= --}}
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">
            <i class="ri-store-2-line"></i> EnteApp
        </a>

        <div class="ms-auto d-flex align-items-center">
            <span class="me-3 text-muted">
                {{ auth()->user()->name ?? 'Guest' }}
            </span>

            @auth
                <form method="POST" action="{{ route('provider.logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm">
                        <i class="ri-logout-box-line"></i>
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>

{{-- ================= MAIN WRAPPER ================= --}}
<div class="d-flex">

    {{-- ========== SIDEBAR ========== --}}
    @auth
    <aside class="sidebar">
        <a href="{{ route('provider.dashboard') }}"
           class="{{ request()->routeIs('provider.dashboard') ? 'active' : '' }}">
            <i class="ri-dashboard-line me-2"></i> Dashboard
        </a>

        <a href="{{ route('provider.vendor-list') }}"
           class="{{ request()->routeIs('provider.vendor*') ? 'active' : '' }}">
            <i class="ri-store-line me-2"></i> Vendors
        </a>

        <a href="{{ route('provider.profile') }}"
           class="{{ request()->routeIs('provider.profile*') ? 'active' : '' }}">
            <i class="ri-user-line me-2"></i> Profile
        </a>
    </aside>
    @endauth

    {{-- ========== PAGE CONTENT ========== --}}
    <main class="flex-fill">
        <div class="content-wrapper">

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="ri-checkbox-circle-line me-1"></i>
                    {{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Page Content --}}
            @yield('content')

        </div>

        <footer>
            © {{ date('Y') }} EnteApp. All rights reserved.
        </footer>
    </main>
</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>
