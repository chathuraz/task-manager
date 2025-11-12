<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - TaskManager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica', 'Arial', sans-serif;
            color: #1f2937;
        }
        
        .auth-container {
            max-width: 420px;
            width: 100%;
            padding: 20px;
        }
        
        .auth-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 48px 40px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .brand {
            text-align: center;
            margin-bottom: 32px;
        }
        
        .brand-logo {
            display: inline-flex;
            align-items: center;
            font-size: 24px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
        }
        
        .brand-logo i {
            margin-right: 8px;
            font-size: 28px;
        }
        
        .auth-header h2 {
            font-size: 28px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
            text-align: center;
        }
        
        .auth-header p {
            color: #6b7280;
            font-size: 15px;
            text-align: center;
            margin-bottom: 32px;
        }
        
        .form-label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .form-control {
            border-radius: 10px;
            padding: 11px 14px;
            border: 1px solid #d1d5db;
            transition: all 0.2s;
            font-size: 15px;
        }
        
        .form-control:focus {
            border-color: #000000;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
            outline: none;
        }
        
        .form-control::placeholder {
            color: #9ca3af;
        }
        
        .btn-primary {
            background: #000000;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 500;
            color: white;
            transition: all 0.2s;
            width: 100%;
            font-size: 15px;
        }
        
        .btn-primary:hover {
            background: #1f2937;
            transform: translateY(-1px);
        }
        
        .form-check-input {
            border-radius: 4px;
            border: 1px solid #d1d5db;
        }
        
        .form-check-input:checked {
            background-color: #000000;
            border-color: #000000;
        }
        
        .form-check-label {
            font-size: 14px;
            color: #374151;
        }
        
        .alert {
            border-radius: 10px;
            border: 1px solid;
            font-size: 14px;
        }
        
        .link-text {
            color: #000000;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
        }
        
        .link-text:hover {
            text-decoration: underline;
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 28px 0;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .divider span {
            padding: 0 16px;
            color: #9ca3af;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="brand">
                <div class="brand-logo">
                    <i class="fas fa-check-circle"></i>TaskManager
                </div>
            </div>
            
            <div class="auth-header">
                <h2>Welcome back</h2>
                <p>Enter your credentials to access your account</p>
            </div>

            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="you@example.com"
                           required 
                           autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" 
                           name="password" 
                           placeholder="Enter your password"
                           required>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="link-text">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary mb-3">
                    Sign in
                </button>

                <div class="divider">
                    <span>Don't have an account?</span>
                </div>

                <div class="text-center">
                    <a href="{{ route('register') }}" class="link-text">Create an account</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
