<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create account - TaskManager</title>
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
            padding: 40px 20px;
        }
        
        .auth-container {
            max-width: 420px;
            width: 100%;
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
        
        .text-muted-custom {
            color: #9ca3af;
            font-size: 13px;
            display: block;
            margin-top: 6px;
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
                <h2>Create your account</h2>
                <p>Start managing your tasks efficiently today</p>
            </div>

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

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Full name</label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           placeholder="John Doe"
                           required 
                           autofocus>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="you@example.com"
                           required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" 
                           name="password" 
                           placeholder="Create a strong password"
                           required>
                    <small class="text-muted-custom">Must be at least 8 characters</small>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Confirm password</label>
                    <input type="password" 
                           class="form-control" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           placeholder="Re-enter your password"
                           required>
                </div>

                <button type="submit" class="btn btn-primary mb-3">
                    Create account
                </button>

                <div class="divider">
                    <span>Already have an account?</span>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="link-text">Sign in instead</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
