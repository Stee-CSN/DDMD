@extends('layouts.app')

@section('title', 'Edit Profile - Yosel Enterprise')

@section('content')
<style>
    .profile-container {
        max-width: 600px;
        margin: 50px auto;
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .profile-container h2 {
        color: #222;
        margin-bottom: 10px;
        font-size: 28px;
    }
    
    .profile-container .subtitle {
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
    
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 16px;
        transition: all 0.3s;
    }
    
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #FF8C00;
    }
    
    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    .btn-save {
        background: #FF8C00;
        color: #222;
        border: none;
        padding: 14px 30px;
        border-radius: 10px;
        font-weight: bold;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
        width: 100%;
    }
    
    .btn-save:hover {
        background: #ffa733;
        transform: translateY(-2px);
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
</style>

<div class="profile-container">
    <h2>Edit Profile ✏️</h2>
    <p class="subtitle">Update your personal information</p>
    
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')
        
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <small style="color: #e74c3c;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <small style="color: #e74c3c;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Enter your phone number">
            @error('phone')
                <small style="color: #e74c3c;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Address</label>
            <textarea name="address" placeholder="Enter your address">{{ old('address', $user->address) }}</textarea>
            @error('address')
                <small style="color: #e74c3c;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Bio / About Me</label>
            <textarea name="bio" placeholder="Tell us about yourself">{{ old('bio', $user->bio) }}</textarea>
            @error('bio')
                <small style="color: #e74c3c;">{{ $message }}</small>
            @enderror
        </div>
        
        <button type="submit" class="btn-save">Save Changes</button>
    </form>
    
    <div class="back-link">
        <a href="{{ url('/dashboard') }}">← Back to Dashboard</a>
    </div>
</div>
@endsection