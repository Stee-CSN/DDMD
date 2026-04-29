<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Yosel Enterprise - Premium Quality Since 2024</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        html {
            scroll-behavior: smooth;
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
            transition: transform 0.3s ease;
        }
        
        .logo:hover {
            transform: scale(1.02);
        }
        
        .logo-img {
            height: 50px;
            width: auto;
            transition: all 0.3s ease;
        }
        
        .logo-img:hover {
            transform: rotate(5deg);
        }
        
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
        
        nav { 
            display: flex; 
            align-items: center; 
            flex-wrap: wrap; 
            gap: 10px; 
        }
        
        nav a { 
            color: white; 
            text-decoration: none; 
            margin-left: 20px; 
            font-weight: bold; 
            transition: color 0.3s ease;
            position: relative;
        }
        
        nav a:hover { 
            color: #FF8C00;
        }
        
        nav a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #FF8C00;
            transition: width 0.3s ease;
        }
        
        nav a:hover::after {
            width: 100%;
        }
        
        .register-btn {
            background: white;
            color: #222 !important;
            padding: 8px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        
        .register-btn:hover {
            background: #FF8C00;
            transform: translateY(-2px);
            color: #222 !important;
        }
        
        .register-btn::after {
            display: none;
        }
        
        .logout-btn {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            cursor: pointer;
            margin-left: 20px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: #e74c3c;
            transform: translateY(-2px);
            color: white;
        }

        .profile-btn {
            background: rgba(255,140,0,0.2);
            border: 1px solid #FF8C00;
            color: #FF8C00 !important;
            padding: 8px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
            margin-left: 20px;
            text-decoration: none;
        }
        
        .profile-btn:hover {
            background: #FF8C00;
            color: #222 !important;
            transform: translateY(-2px);
        }
        
        .admin-btn {
            background: #FF8C00;
            color: #222 !important;
            padding: 8px 20px;
            border-radius: 25px;
            margin-left: 20px;
            font-weight: bold;
            text-decoration: none;
        }
        
        .admin-btn:hover {
            background: #ffa733;
            transform: translateY(-2px);
        }
        
        .hero {
            position: relative;
            text-align: center;
            padding: 120px 20px;
            color: white;
            overflow: hidden;
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .slideshow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        
        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }
        
        .slide.active {
            opacity: 1;
        }
        
        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.55);
            z-index: 1;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
            animation: fadeInUp 1s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .hero h2 {
            font-size: 48px;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }
        
        .hero .btn {
            display: inline-block;
            background-color: #FF8C00;
            color: #222;
            padding: 12px 30px;
            font-size: 18px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
        .hero .btn:hover {
            background-color: #ffa733;
            transform: scale(1.05);
        }
        
        .branches-container { 
            padding: 50px 20px; 
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            text-align: center; 
        }
        
        .branches-container h2 { 
            margin-bottom: 40px; 
            font-size: 32px; 
            color: #333;
            position: relative;
            display: inline-block;
        }
        
        .branches-container h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: #FF8C00;
        }
        
        .cards { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
            gap: 30px; 
            max-width: 1200px; 
            margin: 0 auto; 
        }
        
        .card { 
            background-color: #fff; 
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover { 
            transform: translateY(-10px); 
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .card-content {
            padding: 25px;
        }
        
        .card h3 { 
            font-size: 24px; 
            margin-bottom: 15px; 
            color: #222; 
        }
        
        .card p { 
            color: #666; 
            margin-bottom: 20px; 
            line-height: 1.5; 
        }
        
        .card-btn { 
            display: inline-block; 
            background-color: #222; 
            color: white; 
            border: none; 
            padding: 10px 20px; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 16px; 
            text-decoration: none; 
            transition: all 0.3s ease;
        }
        
        .card-btn:hover { 
            background-color: #FF8C00; 
            color: #222; 
            transform: translateY(-2px);
        }
        
        /* Footer Styles */
        .footer-section {
            background-color: #1a1a1a;
            color: #ccc;
            padding: 50px 40px 30px;
            margin-top: 0;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }
        
        .footer-col h3 {
            color: #FF8C00;
            font-size: 18px;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-col h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: #FF8C00;
        }
        
        .footer-col p {
            margin-bottom: 12px;
            line-height: 1.6;
            color: #aaa;
        }
        
        .footer-col a {
            color: #ccc;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: color 0.3s;
        }
        
        .footer-col a:hover {
            color: #FF8C00;
        }
        
        .footer-col .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .footer-col .contact-item span:first-child {
            font-size: 18px;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-links a {
            display: inline-block;
            width: 35px;
            height: 35px;
            background: #333;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
            text-decoration: none;
        }
        
        .social-links a:hover {
            background: #FF8C00;
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            margin-top: 30px;
            border-top: 1px solid #333;
            font-size: 12px;
            color: #888;
        }
        
        .footer-bottom a {
            color: #FF8C00;
            text-decoration: none;
            cursor: pointer;
        }
        
        .footer-bottom a:hover {
            text-decoration: underline;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.8);
            z-index: 1000;
            overflow: auto;
        }
        
        .modal-content {
            background-color: white;
            margin: 50px auto;
            padding: 0;
            width: 90%;
            max-width: 800px;
            border-radius: 20px;
            box-shadow: 0 5px 30px rgba(0,0,0,0.3);
            animation: modalFadeIn 0.3s ease;
        }
        
        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .modal-header {
            background: linear-gradient(135deg, #FF8C00, #ffa733);
            padding: 20px 25px;
            border-radius: 20px 20px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-header h2 {
            color: #222;
            font-size: 24px;
        }
        
        .close-modal {
            font-size: 32px;
            font-weight: bold;
            cursor: pointer;
            color: #222;
            transition: 0.3s;
        }
        
        .close-modal:hover {
            color: #fff;
        }
        
        .modal-body {
            padding: 30px;
            max-height: 70vh;
            overflow-y: auto;
            color: #333;
            line-height: 1.6;
        }
        
        .modal-body h3 {
            color: #FF8C00;
            margin: 20px 0 10px;
        }
        
        .modal-body h3:first-child {
            margin-top: 0;
        }
        
        .modal-body p {
            margin-bottom: 15px;
        }
        
        .modal-body ul {
            margin-left: 20px;
            margin-bottom: 15px;
        }
        
        .modal-body li {
            margin-bottom: 8px;
        }
        
        /* Toast Notification */
        .toast-notification {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: #4CAF50;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            z-index: 1001;
            opacity: 0;
            transition: all 0.3s ease;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        .toast-notification.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }
        
        .toast-notification.error {
            background: #e74c3c;
        }
        
        #backToTop {
            display: none;
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #FF8C00;
            color: #222;
            border: none;
            padding: 12px 16px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
            transition: all 0.3s ease;
            z-index: 99;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        
        #backToTop:hover {
            background: #ffa733;
            transform: translateY(-3px);
        }
        
        @media (max-width: 768px) {
            header { 
                flex-direction: column; 
                gap: 15px; 
                text-align: center; 
                padding: 15px 20px;
            }
            
            .logo {
                justify-content: center;
            }
            
            nav a { 
                margin: 0 10px; 
            }
            
            .hero h2 { 
                font-size: 32px; 
            }
            
            .hero p { 
                font-size: 16px; 
            }
            
            .hero { 
                padding: 80px 20px; 
                min-height: 400px; 
            }
            
            .cards {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .footer-container {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .modal-content {
                width: 95%;
                margin: 20px auto;
            }
            
            .modal-body {
                padding: 20px;
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
            <a href="{{ url('/') }}" id="homeLink">Home</a>
            <a href="#branches" id="branchesLink">Our Branches</a>

            @auth
                <span style="color: #FF8C00;">Welcome, {{ Auth::user()->name }}!</span>
                <a href="{{ route('profile') }}" class="profile-btn">👤 My Profile</a>
                @if(Auth::user()->is_admin == 1 || Auth::user()->role == 'admin')
                    <a href="{{ url('/admin/dashboard') }}" class="admin-btn">👑 Admin Panel</a>
                @endif
                <button type="button" class="logout-btn" id="customLogoutBtn">Log Out</button>
            @else
                <a href="{{ route('login') }}">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="register-btn">Register</a>
                @endif
            @endauth
        </nav>
    </header>

    <section class="hero">
        <div class="slideshow">
            <div class="slide active" style="background-image: url('{{ asset('images/slideshow/slide1.jpg') }}');"></div>
            <div class="slide" style="background-image: url('{{ asset('images/slideshow/slide2.jpg') }}');"></div>
            <div class="slide" style="background-image: url('{{ asset('images/slideshow/slide3.jpg') }}');"></div>
            <div class="slide" style="background-image: url('{{ asset('images/slideshow/slide4.jpg') }}');"></div>
        </div>
        <div class="hero-content">
            <h2>Welcome to Yosel Enterprise</h2>
            <p>Your one-stop destination for entertainment, dining, and shopping.</p>
            <a href="#branches" class="btn">Explore Our Branches →</a>
        </div>
    </section>

    <section id="branches" class="branches-container">
        <h2>Our Businesses</h2>
        
        <div class="cards">
            <div class="card">
                <img src="{{ asset('images/branches/snooker-club.jpg') }}" alt="Yosel Snooker Club" class="card-image" onerror="this.src='https://placehold.co/400x200?text=Snooker+Club'">
                <div class="card-content">
                    <h3>Yosel Snooker Club</h3>
                    <p>Premium tables, great lighting, and a relaxed atmosphere.</p>
                    <a href="{{ route('snooker.index') }}" class="card-btn">Explore Club →</a>
                </div>
            </div>

            <div class="card">
                <img src="{{ asset('images/branches/restaurant.jpg') }}" alt="Yangkhel Khangza Restaurant" class="card-image" onerror="this.src='https://placehold.co/400x200?text=Restaurant'">
                <div class="card-content">
                    <h3>Yangkhel Khangza</h3>
                    <p>Delicious, freshly prepared meals for every taste.</p>
                    <a href="{{ url('/restaurant') }}" class="card-btn">View Menu & Reserve →</a>
                </div>
            </div>

            <div class="card">
                <img src="{{ asset('images/branches/gift-shop.jpg') }}" alt="Norphel Bangzay Gift Shop" class="card-image" onerror="this.src='https://placehold.co/400x200?text=Gift+Shop'">
                <div class="card-content">
                    <h3>Norphel Bangzay</h3>
                    <p>Find the perfect gift for your loved ones.</p>
                    <a href="{{ url('/giftshop') }}" class="card-btn">Shop Now →</a>
                </div>
            </div>

            <div class="card">
                <img src="{{ asset('images/branches/enterprise-store.jpg') }}" alt="Yosel Enterprise Store" class="card-image" onerror="this.src='https://placehold.co/400x200?text=Enterprise+Store'">
                <div class="card-content">
                    <h3>Yosel Enterprise</h3>
                    <p>Premium products and great shopping experience.</p>
                    <a href="{{ url('/shop') }}" class="card-btn">Shop Now →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer-section">
        <div class="footer-container">
            <div class="footer-col">
                <h3>Yosel Enterprise</h3>
                <p>Your one-stop destination for entertainment, dining, and shopping. Premium quality service since 2024.</p>
            </div>
            
            <div class="footer-col">
                <h3>Quick Links</h3>
                <a href="{{ url('/') }}">🏠 Home</a>
                <a href="#branches">🏪 Our Branches</a>
                <a href="{{ url('/restaurant') }}">🍽️ Restaurant</a>
                <a href="{{ route('snooker.index') }}">🎱 Snooker Club</a>
                <a href="{{ url('/giftshop') }}">🎁 Gift Shop</a>
                <a href="{{ url('/shop') }}">🛍️ Enterprise Store</a>
            </div>
            
            <div class="footer-col">
                <h3>Our Branches</h3>
                <a href="{{ url('/restaurant') }}">🍽️ Yangkhel Khangza</a>
                <a href="{{ route('snooker.index') }}">🎱 Yosel Snooker Club</a>
                <a href="{{ url('/giftshop') }}">🎁 Norphel Bangzay</a>
                <a href="{{ url('/shop') }}">🏪 Yosel Enterprise Store</a>
            </div>
            
            <div class="footer-col">
                <h3>Contact Us</h3>
                <div class="contact-item">
                    <span>📞</span>
                    <span>77827571 / 77299776</span>
                </div>
                <div class="contact-item">
                    <span>📧</span>
                    <span>yosalbusiness@gmail.com</span>
                </div>
                <div class="contact-item">
                    <span>📍</span>
                    <span>Dewathang, Samdrup Jongkhar, Bhutan</span>
                </div>
                <div class="contact-item">
                    <span>⏰</span>
                    <span>10:00 AM - 10:00 PM</span>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Yosel Enterprise. All rights reserved. | <a href="#" onclick="openModal('privacy')">Privacy Policy</a> | <a href="#" onclick="openModal('terms')">Terms of Service</a></p>
        </div>
    </footer>

    <!-- Privacy Policy Modal -->
    <div id="privacyModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Privacy Policy</h2>
                <span class="close-modal" onclick="closeModal('privacyModal')">&times;</span>
            </div>
            <div class="modal-body">
                <h3>Information We Collect</h3>
                <p>At Yosel Enterprise, we collect information you provide directly to us, such as when you create an account, make a reservation, place an order, or contact us. This may include your name, email address, phone number, and address.</p>
                
                <h3>How We Use Your Information</h3>
                <p>We use the information we collect to:</p>
                <ul>
                    <li>Process your reservations and orders</li>
                    <li>Communicate with you about your bookings</li>
                    <li>Improve our services and customer experience</li>
                    <li>Send you important updates about our business</li>
                </ul>
                
                <h3>Information Sharing</h3>
                <p>We do not sell, trade, or rent your personal information to third parties. Your information is used solely for Yosel Enterprise operations and services.</p>
                
                <h3>Data Security</h3>
                <p>We implement appropriate security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction.</p>
                
                <h3>Cookies</h3>
                <p>Our website uses cookies to enhance your browsing experience and remember your preferences. You can choose to disable cookies in your browser settings.</p>
                
                <h3>Updates to This Policy</h3>
                <p>We may update this privacy policy from time to time. We will notify you of any changes by posting the new policy on this page.</p>
                
                <p><strong>Last updated: {{ date('F j, Y') }}</strong></p>
            </div>
        </div>
    </div>

    <!-- Terms of Service Modal -->
    <div id="termsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Terms of Service</h2>
                <span class="close-modal" onclick="closeModal('termsModal')">&times;</span>
            </div>
            <div class="modal-body">
                <h3>Acceptance of Terms</h3>
                <p>By accessing and using the Yosel Enterprise website, you agree to be bound by these Terms of Service.</p>
                
                <h3>Booking and Reservations</h3>
                <p>When you make a reservation or booking through our website, you agree to provide accurate and complete information. Cancellations must be made at least 2 hours in advance for snooker bookings and 4 hours for restaurant reservations.</p>
                
                <h3>Payment</h3>
                <p>All payments are processed at our physical location. No online payments are accepted at this time. Prices are subject to change without notice.</p>
                
                <h3>Cancellation Policy</h3>
                <ul>
                    <li><strong>Restaurant:</strong> Free cancellation up to 4 hours before reservation time</li>
                    <li><strong>Snooker Club:</strong> Free cancellation up to 2 hours before booking time</li>
                    <li><strong>Gift Shop Orders:</strong> Can be cancelled within 24 hours of placing order</li>
                </ul>
                
                <h3>User Account</h3>
                <p>You are responsible for maintaining the confidentiality of your account credentials. You agree to accept responsibility for all activities that occur under your account.</p>
                
                <h3>Prohibited Conduct</h3>
                <p>You agree not to:</p>
                <ul>
                    <li>Use the website for any unlawful purpose</li>
                    <li>Attempt to gain unauthorized access to our systems</li>
                    <li>Interfere with the proper functioning of the website</li>
                    <li>Harass, abuse, or harm another person</li>
                </ul>
                
                <h3>Intellectual Property</h3>
                <p>All content on this website, including logos, images, and text, is the property of Yosel Enterprise and is protected by copyright laws.</p>
                
                <h3>Limitation of Liability</h3>
                <p>Yosel Enterprise shall not be liable for any indirect, incidental, special, or consequential damages resulting from your use of our services.</p>
                
                <h3>Contact Us</h3>
                <p>If you have any questions about these Terms, please contact us at yosalbusiness@gmail.com or call 77827571 / 77299776.</p>
                
                <p><strong>Last updated: {{ date('F j, Y') }}</strong></p>
            </div>
        </div>
    </div>

    <button onclick="topFunction()" id="backToTop" title="Back to Top">↑</button>

    <!-- Toast Notification -->
    <div id="toastNotification" class="toast-notification"></div>

    <script>
        // Toast notification function
        function showToast(message, isError = false) {
            const toast = document.getElementById('toastNotification');
            toast.textContent = message;
            toast.classList.add('show');
            if (isError) {
                toast.classList.add('error');
            } else {
                toast.classList.remove('error');
            }
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        // Modal Functions
        function openModal(type) {
            if (type === 'privacy') {
                document.getElementById('privacyModal').style.display = 'block';
                document.body.style.overflow = 'hidden';
            } else if (type === 'terms') {
                document.getElementById('termsModal').style.display = 'block';
                document.body.style.overflow = 'hidden';
            }
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            const privacyModal = document.getElementById('privacyModal');
            const termsModal = document.getElementById('termsModal');
            if (event.target === privacyModal) {
                closeModal('privacyModal');
            }
            if (event.target === termsModal) {
                closeModal('termsModal');
            }
        }
        
        // ========== IMPROVED LOGOUT FUNCTIONALITY ==========
        @auth
        // Custom logout handler
        const customLogoutBtn = document.getElementById('customLogoutBtn');
        if (customLogoutBtn) {
            customLogoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Clear ALL localStorage data first
                const keysToClear = [
                    'restaurantOrders', 'restaurantReservations', 'restaurantFeedbacks',
                    'enterpriseOrders', 'enterpriseFeedbacks', 'snookerFeedbacks',
                    'cart', 'giftShopOrders', 'enterpriseCart', 'currentUser',
                    'restaurantUsers', 'snookerBookings', 'giftShopCart'
                ];
                keysToClear.forEach(key => localStorage.removeItem(key));
                localStorage.clear(); // Clear everything to be safe
                
                console.log('Logging out - clearing all localStorage data');
                showToast('Logging out...', false);
                
                // Find and submit the actual logout form
                const logoutForm = document.querySelector('form[action="{{ route('logout') }}"]');
                if (logoutForm) {
                    // Small delay to show toast before redirect
                    setTimeout(() => {
                        logoutForm.submit();
                    }, 200);
                } else {
                    // Fallback - redirect to home with logout parameter
                    window.location.href = '{{ url('/') }}?logout=success';
                }
            });
        }
        @endguest
        
        // ========== CLEAR LOCALSTORAGE FOR NON-LOGGED-IN USERS ==========
        @guest
            // Clear all order/reservation data when user is not logged in
            const keysToClear = [
                'restaurantOrders', 'restaurantReservations', 'restaurantFeedbacks',
                'enterpriseOrders', 'enterpriseFeedbacks', 'snookerFeedbacks',
                'cart', 'giftShopOrders', 'enterpriseCart'
            ];
            keysToClear.forEach(key => localStorage.removeItem(key));
            console.log('Guest user - localStorage cleared for security');
        @endguest
        
        // Slideshow functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;
        
        function changeSlide() {
            if (totalSlides > 0) {
                slides[currentSlide].classList.remove('active');
                currentSlide = (currentSlide + 1) % totalSlides;
                slides[currentSlide].classList.add('active');
            }
        }
        
        if (totalSlides > 0) {
            setInterval(changeSlide, 5000);
        }
        
        // Back to Top functionality
        window.onscroll = function() {
            let btn = document.getElementById("backToTop");
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                btn.style.display = "block";
            } else {
                btn.style.display = "none";
            }
        };
        
        function topFunction() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        
        // Check for logout success parameter on page load
        window.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('logout') === 'success') {
                showToast('Successfully logged out!', false);
                // Clean URL without reloading page
                window.history.replaceState({}, document.title, window.location.pathname);
            }
            
            // Ensure home section is visible on page load
            const homeLink = document.getElementById('homeLink');
            const branchesSection = document.getElementById('branches');
            
            if (window.location.hash === '#branches' && branchesSection) {
                // Do nothing, branches will be shown
            } else if (homeLink) {
                // Make sure home is active
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
        
        // Smooth scroll for branch links
        const branchesLink = document.getElementById('branchesLink');
        if (branchesLink) {
            branchesLink.addEventListener('click', function(e) {
                e.preventDefault();
                const branches = document.getElementById('branches');
                if (branches) {
                    branches.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        }
    </script>
</body>
</html>