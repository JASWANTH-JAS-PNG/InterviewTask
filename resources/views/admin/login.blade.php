<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - BlogHub</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { background: #fff; border-radius: 20px; padding: 2.5rem; width: 100%; max-width: 420px; box-shadow: 0 20px 60px rgba(0,0,0,.2); }
        .login-logo { text-align: center; margin-bottom: 2rem; }
        .login-logo h2 { font-weight: 700; font-size: 1.8rem; color: #1e293b; }
        .login-logo h2 span { color: #06b6d4; }
        .login-logo p { color: #64748b; font-size: .9rem; margin: 0; }
        .form-label { font-weight: 600; font-size: .88rem; color: #374151; }
        .form-control { border-radius: 10px; border: 1.5px solid #e2e8f0; padding: .7rem 1rem; font-size: .95rem; }
        .form-control:focus { border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79,70,229,.12); }
        .input-group-text { border-radius: 10px 0 0 10px; border: 1.5px solid #e2e8f0; background: #f8fafc; color: #64748b; border-right: none; }
        .input-group .form-control { border-radius: 0 10px 10px 0; border-left: none; }
        .btn-login { width: 100%; background: #4f46e5; color: #fff; border: none; border-radius: 10px; padding: .8rem; font-weight: 700; font-size: 1rem; transition: background .2s; }
        .btn-login:hover { background: #3730a3; }
        .back-link { text-align: center; margin-top: 1.25rem; font-size: .88rem; color: #64748b; }
        .back-link a { color: #4f46e5; font-weight: 600; text-decoration: none; }
    </style>
</head>
<body>
<div class="login-card">
    <div class="login-logo">
        <h2>Blog<span>Hub</span></h2>
        <p>Admin Panel Login</p>
    </div>

    @if($errors->any())
    <div class="alert alert-danger alert-sm mb-3" style="border-radius:10px;font-size:.88rem;">
        <i class="fas fa-exclamation-circle me-1"></i> {{ $errors->first() }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-warning mb-3" style="border-radius:10px;font-size:.88rem;">
        <i class="fas fa-info-circle me-1"></i> {{ session('error') }}
    </div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="admin@bloghub.com" value="{{ old('email') }}" required autofocus>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>
        </div>
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember" style="font-size:.88rem;color:#64748b;">Remember me</label>
        </div>
        <button type="submit" class="btn-login">
            <i class="fas fa-sign-in-alt me-2"></i> Login to Admin Panel
        </button>
    </form>
    <div class="back-link">
        <a href="{{ route('blogs.index') }}"><i class="fas fa-arrow-left me-1"></i>Back to Website</a>
    </div>
</div>
</body>
</html>
