<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Profile - Yosel Enterprise</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        body {
            background: #f0f2f5;
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
            position: sticky;
            top: 0;
            z-index: 100;
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
            transition: color 0.3s ease;
        }
        
        nav a:hover { color: #FF8C00; }
        
        .logout-btn {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            cursor: pointer;
            margin-left: 20px;
        }
        
        .profile-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
        }
        
        .profile-sidebar {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            height: fit-content;
            position: sticky;
            top: 100px;
        }
        
        .avatar-container {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        .avatar-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #FF8C00;
            background: #f0f0f0;
        }
        
        .avatar-upload-btn {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: #FF8C00;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: 0.3s;
            color: #222;
        }
        
        .avatar-upload-btn:hover {
            background: #ffa733;
            transform: scale(1.1);
        }
        
        #fileInput {
            display: none;
        }
        
        .profile-name {
            font-size: 22px;
            font-weight: bold;
            color: #222;
            margin-bottom: 5px;
        }
        
        .profile-email {
            font-size: 13px;
            color: #888;
            margin-bottom: 15px;
        }
        
        .member-since {
            font-size: 12px;
            color: #888;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        
        .profile-content {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }
        
        .content-header {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #FF8C00;
        }
        
        .content-header h2 {
            font-size: 24px;
            color: #222;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            font-size: 13px;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: 0.3s;
            background: #fafafa;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #FF8C00;
            background: white;
        }
        
        .form-group input[readonly] {
            background: #f5f5f5;
            cursor: not-allowed;
        }
        
        /* Address field with button side by side */
        .address-container {
            display: flex;
            gap: 15px;
            align-items: flex-start;
        }
        
        .address-container textarea {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: 0.3s;
            background: #fafafa;
            resize: vertical;
            min-height: 80px;
        }
        
        .address-container textarea:focus {
            outline: none;
            border-color: #FF8C00;
            background: white;
        }
        
        .location-btn {
            background: #FF8C00;
            color: #222;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
            white-space: nowrap;
            height: fit-content;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .location-btn:hover {
            background: #ffa733;
            transform: translateY(-2px);
        }
        
        .location-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }
        
        .location-status {
            font-size: 12px;
            margin-top: 8px;
            padding: 8px 12px;
            border-radius: 8px;
            display: none;
        }
        
        .location-status.success {
            background: #d4edda;
            color: #155724;
            display: block;
        }
        
        .location-status.error {
            background: #f8d7da;
            color: #721c24;
            display: block;
        }
        
        .location-status.loading {
            background: #fff3cd;
            color: #856404;
            display: block;
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
            transition: 0.3s;
            margin-top: 10px;
            width: 100%;
        }
        
        .btn-save:hover {
            background: #ffa733;
            transform: translateY(-2px);
        }
        
        .success-message, .error-message {
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            display: none;
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error-message {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .upload-loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            display: none;
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
            .profile-container {
                grid-template-columns: 1fr;
            }
            .profile-sidebar {
                position: static;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
            .avatar-preview {
                width: 120px;
                height: 120px;
            }
            .address-container {
                flex-direction: column;
            }
            .location-btn {
                width: 100%;
                justify-content: center;
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
            @auth
                @if(Auth::user()->is_admin == 1)
                    <a href="{{ url('/admin/dashboard') }}">Admin Panel</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </nav>
    </header>

    <div class="profile-container">
        <!-- Left Sidebar -->
        <div class="profile-sidebar">
            <div class="avatar-container">
                <img id="avatarPreview" class="avatar-preview" src="https://ui-avatars.com/api/?background=FF8C00&color=fff&rounded=true&size=150&bold=true" alt="Profile">
                <button class="avatar-upload-btn" onclick="document.getElementById('fileInput').click()">
                    📷
                </button>
                <input type="file" id="fileInput" accept="image/jpeg,image/png,image/jpg" style="display: none;">
                <div id="uploadLoading" class="upload-loading">Uploading...</div>
            </div>
            <h3 class="profile-name" id="profileName">Loading...</h3>
            <div class="profile-email" id="profileEmail">email@example.com</div>
            <div class="member-since" id="memberSince">Member since --</div>
        </div>

        <!-- Right Content -->
        <div class="profile-content">
            <div class="content-header">
                <h2>Personal Details</h2>
            </div>
            
            <div id="successMessage" class="success-message">✅ Profile updated successfully!</div>
            <div id="errorMessage" class="error-message">❌ Something went wrong. Please try again.</div>

            <form id="profileForm">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" id="firstName" name="first_name" placeholder="Enter first name">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" id="lastName" name="last_name" placeholder="Enter last name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter phone number">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" id="email" name="email" readonly placeholder="Email address">
                    </div>
                </div>
                
                <!-- Address field with location button side by side -->
                <div class="form-group">
                    <label>📍 Address</label>
                    <div class="address-container">
                        <textarea id="address" name="address" rows="3" placeholder="Enter your address"></textarea>
                        <button type="button" class="location-btn" id="autoLocationBtn" onclick="detectLocation()">
                            📍 Auto-Detect
                        </button>
                    </div>
                    <div id="locationStatus" class="location-status"></div>
                </div>
                
                <button type="submit" class="btn-save">💾 Save Changes</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Yosel Enterprise. All rights reserved.</p>
        <p style="font-size: 12px; margin-top: 10px;">
            <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
        </p>
    </footer>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Load user profile
        async function loadProfile() {
            try {
                const response = await fetch('/user/profile', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    credentials: 'same-origin'
                });
                
                if (response.ok) {
                    const user = await response.json();
                    
                    const nameParts = (user.name || '').split(' ');
                    const firstName = nameParts[0] || '';
                    const lastName = nameParts.slice(1).join(' ') || '';
                    
                    document.getElementById('firstName').value = firstName;
                    document.getElementById('lastName').value = lastName;
                    document.getElementById('email').value = user.email || '';
                    document.getElementById('phone').value = user.phone || '';
                    document.getElementById('address').value = user.address || '';
                    document.getElementById('profileName').textContent = user.name || 'User';
                    document.getElementById('profileEmail').textContent = user.email || '';
                    
                    if (user.avatar_url && user.avatar_url !== 'null') {
                        document.getElementById('avatarPreview').src = user.avatar_url + '?t=' + new Date().getTime();
                    } else {
                        document.getElementById('avatarPreview').src = `https://ui-avatars.com/api/?background=FF8C00&color=fff&rounded=true&size=150&bold=true&name=${encodeURIComponent(user.name || 'User')}`;
                    }
                    
                    if (user.created_at) {
                        const date = new Date(user.created_at);
                        document.getElementById('memberSince').textContent = `Member since ${date.toLocaleDateString('en-US', { month: 'long', year: 'numeric' })}`;
                    }
                }
            } catch (error) {
                console.error('Error loading profile:', error);
            }
        }
        
        // Get detailed address from coordinates
        async function getAddressFromCoords(lat, lon) {
            try {
                const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&zoom=18&addressdetails=1`);
                const data = await response.json();
                
                if (data && data.address) {
                    const address = data.address;
                    
                    const parts = [];
                    if (address.road || address.street) parts.push(address.road || address.street);
                    if (address.suburb) parts.push(address.suburb);
                    if (address.city || address.town || address.village) {
                        parts.push(address.city || address.town || address.village);
                    }
                    if (address.state) parts.push(address.state);
                    if (address.country) parts.push(address.country);
                    
                    let formattedAddress = parts.join(', ');
                    if (!formattedAddress && data.display_name) {
                        formattedAddress = data.display_name;
                    }
                    
                    formattedAddress += `\n📍 (${lat.toFixed(6)}, ${lon.toFixed(6)})`;
                    return formattedAddress;
                }
                return `Location: ${lat.toFixed(6)}, ${lon.toFixed(6)}`;
            } catch (error) {
                console.error('Geocoding error:', error);
                return `Location: ${lat.toFixed(6)}, ${lon.toFixed(6)}`;
            }
        }
        
        // Auto-detect location
        async function detectLocation() {
            const locationBtn = document.getElementById('autoLocationBtn');
            const locationStatus = document.getElementById('locationStatus');
            const addressField = document.getElementById('address');
            
            if (!navigator.geolocation) {
                locationStatus.textContent = '❌ Geolocation is not supported by your browser';
                locationStatus.className = 'location-status error';
                return;
            }
            
            locationStatus.textContent = '📍 Detecting your location...';
            locationStatus.className = 'location-status loading';
            locationBtn.disabled = true;
            
            navigator.geolocation.getCurrentPosition(
                async (position) => {
                    const { latitude, longitude } = position.coords;
                    
                    locationStatus.textContent = '📍 Getting address from coordinates...';
                    
                    const formattedAddress = await getAddressFromCoords(latitude, longitude);
                    
                    addressField.value = formattedAddress;
                    locationStatus.textContent = '✅ Location detected successfully! Address added.';
                    locationStatus.className = 'location-status success';
                    
                    setTimeout(() => {
                        locationStatus.style.display = 'none';
                    }, 3000);
                    
                    locationBtn.disabled = false;
                },
                (error) => {
                    let errorMessage = '';
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            errorMessage = '❌ Location permission denied. Please enable location access.';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMessage = '❌ Location information unavailable. Please check your GPS.';
                            break;
                        case error.TIMEOUT:
                            errorMessage = '❌ Location request timed out. Please try again.';
                            break;
                        default:
                            errorMessage = '❌ An unknown error occurred. Please try again.';
                    }
                    locationStatus.textContent = errorMessage;
                    locationStatus.className = 'location-status error';
                    locationBtn.disabled = false;
                    
                    setTimeout(() => {
                        locationStatus.style.display = 'none';
                    }, 5000);
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        }
        
        // Save profile
        async function saveProfile(event) {
            if (event) event.preventDefault();
            
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const fullName = `${firstName} ${lastName}`.trim();
            
            const formData = {
                name: fullName,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                address: document.getElementById('address').value,
                _token: csrfToken
            };
            
            try {
                const response = await fetch('/user/profile', {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(formData)
                });
                
                const data = await response.json();
                
                if (response.ok && data.success) {
                    document.getElementById('successMessage').style.display = 'block';
                    document.getElementById('profileName').textContent = fullName;
                    
                    const avatarImg = document.getElementById('avatarPreview');
                    if (!avatarImg.src.includes('/uploads/')) {
                        avatarImg.src = `https://ui-avatars.com/api/?background=FF8C00&color=fff&rounded=true&size=150&bold=true&name=${encodeURIComponent(fullName)}`;
                    }
                    
                    setTimeout(() => {
                        document.getElementById('successMessage').style.display = 'none';
                    }, 3000);
                } else {
                    document.getElementById('errorMessage').style.display = 'block';
                    setTimeout(() => {
                        document.getElementById('errorMessage').style.display = 'none';
                    }, 3000);
                }
            } catch (error) {
                console.error('Error saving profile:', error);
                document.getElementById('errorMessage').style.display = 'block';
                setTimeout(() => {
                    document.getElementById('errorMessage').style.display = 'none';
                }, 3000);
            }
        }
        
        // Upload avatar
        async function uploadAvatar(file) {
            const formData = new FormData();
            formData.append('avatar', file);
            formData.append('_token', csrfToken);
            
            document.getElementById('uploadLoading').style.display = 'block';
            
            try {
                const response = await fetch('/user/profile/avatar', {
                    method: 'POST',
                    body: formData,
                    credentials: 'same-origin'
                });
                
                const data = await response.json();
                
                if (response.ok && data.success) {
                    document.getElementById('avatarPreview').src = data.avatar_url + '?t=' + new Date().getTime();
                    showNotification('Profile photo updated!', 'success');
                } else {
                    showNotification('Upload failed', 'error');
                }
            } catch (error) {
                console.error('Upload error:', error);
                showNotification('Upload failed', 'error');
            } finally {
                document.getElementById('uploadLoading').style.display = 'none';
            }
        }
        
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                bottom: 30px;
                right: 30px;
                background: ${type === 'success' ? '#4CAF50' : '#e74c3c'};
                color: white;
                padding: 12px 20px;
                border-radius: 10px;
                z-index: 1000;
                animation: slideIn 0.3s ease;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 3000);
        }
        
        // File input handler
        document.getElementById('fileInput').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const file = e.target.files[0];
                
                if (!file.type.match('image.*')) {
                    showNotification('Please select an image file!', 'error');
                    return;
                }
                
                if (file.size > 2 * 1024 * 1024) {
                    showNotification('File too large! Max 2MB', 'error');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
                
                uploadAvatar(file);
            }
        });
        
        document.getElementById('profileForm').addEventListener('submit', saveProfile);
        loadProfile();
        
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>