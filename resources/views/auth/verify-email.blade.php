@extends('layouts.app')

@section('title', 'Reset Password - Yosel Enterprise')

@section('content')
<style>
    .reset-container {
        max-width: 450px;
        margin: 50px auto;
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
        transition: all 0.3s;
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
        transition: all 0.3s;
    }
    
    .btn-reset:hover {
        background: #ffa733;
        transform: translateY(-2px);
    }
</style>

<div class="reset-container">
    <h2>Reset Password 🔒</h2>
    <p class="subtitle">Create a new password for your account</p>
    
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
            @error('email')
                <small style="color: #e74c3c; font-size: 12px;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="password" required placeholder="Enter new password">
            @error('password')
                <small style="color: #e74c3c; font-size: 12px;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Confirm New Password</label>
            <input type="password" name="password_confirmation" required placeholder="Confirm new password">
        </div>
        
        <button type="submit" class="btn-reset">Reset Password</button>
    </form>
</div>
@endsection