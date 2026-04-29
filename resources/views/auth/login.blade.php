<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Yosel Enterprise</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
        }
        
        header { 
            background-color: #222; 
            color: white; 
            padding: 15px 40px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            flex-wrap: wrap;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            transition: transform 0.3s ease;
        }
        
        .logo:hover { transform: scale(1.02); }
        
        .logo-img {
            height: 50px;
            width: auto;
            transition: all 0.3s ease;
        }
        
        .logo-img:hover { transform: rotate(5deg); }
        
        .logo-text h1 {
            font-size: 24px;
            color: #FF8C00;
            line-height: 1.2;
        }
        
        .logo-text span {
            font-size: 10px;
            color: #888;
            display: block;
        }
        
        nav a { 
            color: white; 
            text-decoration: none; 
            margin-left: 20px; 
            font-weight: bold; 
            transition: color 0.3s ease;
        }
        
        nav a:hover { color: #FF8C00; }
        
        .login-container {
            max-width: 450px;
            margin: 60px auto;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .login-logo {
            margin-bottom: 20px;
        }
        
        .login-logo img {
            height: 70px;
            width: auto;
        }
        
        .login-container h2 {
            text-align: center;
            color: #222;
            margin-bottom: 10px;
            font-size: 28px;
        }
        
        .login-container .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #FF8C00;
        }
        
        .btn-login {
            width: 100%;
            background: #FF8C00;
            color: #222;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background: #ffa733;
            transform: translateY(-2px);
        }
        
        .checkbox-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .checkbox-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
            font-size: 14px;
        }
        
        .forgot-link {
            text-align: center;
            margin-top: 15px;
        }
        
        .forgot-link a {
            color: #FF8C00;
            text-decoration: none;
            font-size: 14px;
        }
        
        .forgot-link a:hover {
            text-decoration: underline;
        }
        
        .register-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
        }
        
        .register-link a {
            color: #FF8C00;
            text-decoration: none;
            font-weight: bold;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            text-align: left;
        }
        
        footer {
            background-color: #222;
            color: white;
            text-align: center;
            padding: 30px;
            margin-top: 50px;
        }
        
        footer a {
            color: #FF8C00;
            text-decoration: none;
        }
        
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            .login-container {
                margin: 30px 20px;
                padding: 25px;
            }
            .login-logo img {
                height: 50px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('image/logo.png') }}" alt="Yosel Enterprise Logo" class="logo-img" onerror="this.src='https://placehold.co/50x50?text=YE'">
            <div class="logo-text">
                <h1>Yosel Enterprise</h1>
                <span>Premium Quality Since 2024</span>
            </div>
        </div>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/') }}#branches">Our Branches</a>
            <a href="{{ route('register') }}">Register</a>
        </nav>
    </header>

    <div class="login-container">
        <div class="login-logo">
            <img src="{{ asset('image/logo.png') }}" alt="Yosel Enterprise" onerror="this.src='https://placehold.co/70x70?text=YE'">
        </div>
        <h2>Welcome Back! </h2>
        <p class="subtitle">Sign in to your Yosel Enterprise account</p>
        
        @if($errors->any())
            <div class="alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Enter your password">
            </div>
            
            <div class="checkbox-group">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
            </div>
            
            <button type="submit" class="btn-login">Log In</button>
        </form>
        
        <div class="forgot-link">
            <a href="{{ route('password.request') }}">Forgot your password?</a>
        </div>
        
        <div class="register-link">
            Don't have an account? <a href="{{ route('register') }}">Sign up</a>
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Yosel Enterprise. All rights reserved.</p>
        <p style="font-size: 12px; margin-top: 10px;">
            <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
        </p>
    </footer>
</body>
</html>