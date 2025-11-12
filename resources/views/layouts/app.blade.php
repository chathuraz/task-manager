<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task Manager')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-gradient-start: #60a5fa;
            --primary-gradient-end: #34d399;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --bg-light: #f9fafb;
        }
        
        body {
            background: #ffffff;
            min-height: 100vh;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica', 'Arial', sans-serif;
            color: var(--text-primary);
            padding-bottom: 40px;
        }
        
        .navbar {
            background: #ffffff !important;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-weight: 600;
            color: #1f2937 !important;
            font-size: 24px;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand i {
            margin-right: 8px;
            font-size: 28px;
        }
        
        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            margin: 0 1rem;
            transition: color 0.2s;
        }
        
        .nav-link:hover {
            color: var(--text-primary) !important;
        }
        
        .btn-primary {
            background: #000000;
            border: 2px solid #000000;
            border-radius: 25px;
            padding: 12px 28px;
            font-weight: 500;
            color: #ffffff;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: #1f2937;
            border-color: #1f2937;
            transform: translateY(-1px);
        }
        
        .btn-outline-primary {
            border: 2px solid #e5e7eb;
            border-radius: 25px;
            padding: 10px 24px;
            font-weight: 500;
            color: var(--text-primary);
            background: transparent;
            transition: all 0.3s;
        }
        
        .btn-outline-primary:hover {
            border-color: #000000;
            color: #000000;
            background: transparent;
        }
        
        .btn-success {
            background: #10b981;
            border: none;
            border-radius: 8px;
            color: white;
        }
        
        .btn-success:hover {
            background: #059669;
        }
        
        .btn-warning {
            background: #f59e0b;
            border: none;
            border-radius: 8px;
            color: white;
        }
        
        .btn-warning:hover {
            background: #d97706;
        }
        
        .btn-danger {
            background: #ef4444;
            border: none;
            border-radius: 8px;
            color: white;
        }
        
        .btn-danger:hover {
            background: #dc2626;
        }
        
        .btn-secondary {
            background: #6b7280;
            border: none;
            border-radius: 8px;
            color: white;
        }
        
        .hero-section {
            padding: 80px 0;
            text-align: center;
        }
        
        .hero-title {
            font-size: 56px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 24px;
            line-height: 1.2;
        }
        
        .hero-gradient-text {
            background: linear-gradient(135deg, var(--primary-gradient-start), var(--primary-gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-subtitle {
            font-size: 20px;
            color: var(--text-secondary);
            max-width: 700px;
            margin: 0 auto 32px;
            line-height: 1.6;
        }
        
        .content-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            padding: 40px;
            margin-top: 30px;
        }
        
        .feature-section {
            padding: 60px 0;
            background: var(--bg-light);
        }
        
        .feature-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 32px;
            height: 100%;
            transition: all 0.3s;
        }
        
        .feature-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transform: translateY(-4px);
        }
        
        .feature-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        
        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            background: white;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #000000;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
        }
        
        .table {
            background: white;
        }
        
        .table thead {
            background: var(--bg-light);
            border-bottom: 2px solid #e5e7eb;
        }
        
        .table thead th {
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            padding: 16px;
            border: none;
        }
        
        .table tbody td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 13px;
        }
        
        .alert {
            border-radius: 12px;
            border: 1px solid;
        }
        
        .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .page-title {
            font-size: 36px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 12px;
        }
        
        .page-subtitle {
            font-size: 18px;
            color: var(--text-secondary);
            margin-bottom: 32px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-check-circle"></i>TaskManager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('tasks.index') }}">Overview</a></li>
                    @endauth
                </ul>
                <div class="navbar-nav ms-auto">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                {{ auth()->user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a></li>
                            </ul>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Get the app</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
