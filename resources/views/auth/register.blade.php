<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Yosel Enterprise</title>
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
        
        .register-container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .register-logo {
            margin-bottom: 20px;
        }
        
        .register-logo img {
            height: 70px;
            width: auto;
        }
        
        .register-container h2 {
            text-align: center;
            color: #222;
            margin-bottom: 10px;
            font-size: 28px;
        }
        
        .register-container .subtitle {
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
        
        .btn-register {
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
        
        .btn-register:hover {
            background: #ffa733;
            transform: translateY(-2px);
        }
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
        }
        
        .login-link a {
            color: #FF8C00;
            text-decoration: none;
            font-weight: bold;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .terms {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 20px;
        }
        
        .terms a {
            color: #FF8C00;
            text-decoration: none;
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
            .register-container {
                margin: 30px 20px;
                padding: 25px;
            }
            .register-logo img {
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
            <a href="{{ route('login') }}">Login</a>
        </nav>
    </header>

    <div class="register-container">
        <div class="register-logo">
            <img src="{{ asset('image/logo.png') }}" alt="Yosel Enterprise" onerror="this.src='https://placehold.co/70x70?text=YE'">
        </div>
        <h2>Create Account </h2>
        <p class="subtitle">Join Yosel Enterprise and enjoy premium services</p>
        
        @if($errors->any())
            <div class="alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Enter your full name">
            </div>
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Create a password (min 8 characters)">
            </div>
            
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" required placeholder="Confirm your password">
            </div>
            
            <button type="submit" class="btn-register">Create Account</button>
        </form>
        
        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Log in</a>
        </div>
        
        <div class="terms">
            By signing up, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
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