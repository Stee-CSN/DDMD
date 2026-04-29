<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password - Yosel Enterprise</title>
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
        }
        
        .logo-img {
            height: 50px;
            width: auto;
        }
        
        .logo-text h1 {
            font-size: 24px;
            color: #FF8C00;
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
        }
        
        .reset-container {
            max-width: 450px;
            margin: 60px auto;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .reset-container h2 {
            text-align: center;
            color: #222;
            margin-bottom: 10px;
            font-size: 28px;
        }
        
        .reset-container .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 20px;
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
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #FF8C00;
        }
        
        .btn-reset {
            width: 100%;
            background: #FF8C00;
            color: #222;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
        }
        
        .btn-reset:hover {
            background: #ffa733;
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-link a {
            color: #FF8C00;
            text-decoration: none;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        
        footer {
            background-color: #222;
            color: white;
            text-align: center;
            padding: 30px;
            margin-top: 50px;
        }
        
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            .reset-container {
                margin: 30px 20px;
                padding: 25px;
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

    <div class="reset-container">
        <h2>Reset Password 🔒</h2>
        <p class="subtitle">Enter your email to receive a password reset link</p>
        
        @if(session('status'))
            <div class="alert-success">
                {{ session('status') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                @error('email')
                    <p style="color: #e74c3c; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" class="btn-reset">Send Password Reset Link</button>
        </form>
        
        <div class="back-link">
            <a href="{{ route('login') }}">← Back to Login</a>
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