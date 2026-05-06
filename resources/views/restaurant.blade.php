<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Yangkhel Khangza - Authentic Bhutanese Restaurant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        body { background: #fffaf5; }
        
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
        
        .logo { display: flex; align-items: center; gap: 15px; }
        .logo-img { height: 50px; }
        .logo-text h1 { font-size: 24px; color: #FF8C00; }
        .logo-text span { font-size: 10px; color: #888; display: block; }
        
        nav a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; transition: color 0.3s ease; }
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
        
        /* Hero Slideshow */
        .hero-slideshow {
            position: relative;
            height: 500px;
            overflow: hidden;
        }
        
        .slideshow-container { position: relative; width: 100%; height: 100%; }
        
        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }
        
        .slide.active { opacity: 1; }
        
        .slide-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: white;
            padding: 60px 40px 40px;
            text-align: center;
        }
        
        .slide-overlay h1 { font-size: 52px; margin-bottom: 15px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
        .slide-overlay p { font-size: 18px; text-shadow: 1px 1px 2px rgba(0,0,0,0.5); }
        
        .slide-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 10;
        }
        
        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255,255,255,0.5);
            cursor: pointer;
        }
        
        .dot.active { background: #FF8C00; width: 30px; border-radius: 10px; }
        
        .container { max-width: 1400px; margin: -30px auto 60px; padding: 0 20px; position: relative; z-index: 10; }
        
        .info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .info-card {
            background: white;
            padding: 25px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .info-card .icon { font-size: 40px; margin-bottom: 10px; }
        .info-card h3 { color: #FF8C00; margin-bottom: 8px; }
        .info-card p { color: #666; }
        
        /* Order Type Selection */
        .order-type-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .order-type-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .order-type-btn {
            flex: 1;
            max-width: 250px;
            padding: 20px;
            border: 2px solid #FF8C00;
            background: white;
            border-radius: 15px;
            cursor: pointer;
            transition: 0.3s;
            text-align: center;
        }
        
        .order-type-btn.active {
            background: #FF8C00;
            color: white;
        }
        
        .order-type-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255,140,0,0.3);
        }
        
        .order-type-btn .icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        
        .order-type-btn h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        
        .order-type-btn p {
            font-size: 12px;
            opacity: 0.8;
        }
        
        /* Menu Category Buttons */
        .menu-categories {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 30px;
            justify-content: center;
        }
        
        .cat-btn {
            background: #f0f0f0;
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            color: #555;
        }
        
        .cat-btn:hover {
            background: #FF8C00;
            color: #222;
            transform: translateY(-2px);
        }
        
        .menu-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            scroll-margin-top: 100px;
        }
        
        .section-title {
            font-size: 28px;
            color: #FF8C00;
            margin-bottom: 25px;
            border-left: 4px solid #FF8C00;
            padding-left: 15px;
        }
        
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }
        
        .menu-item {
            background: #f8f9fa;
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #eee;
            transition: 0.3s;
        }
        
        .menu-item:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        
        .menu-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: linear-gradient(135deg, #FF8C00, #ffa733);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 55px;
            color: white;
        }
        
        .menu-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .menu-info { padding: 18px; }
        .menu-header { display: flex; justify-content: space-between; margin-bottom: 8px; }
        .menu-name { font-size: 18px; font-weight: bold; }
        .menu-price { color: #FF8C00; font-weight: bold; }
        .menu-desc { color: #666; font-size: 13px; margin-bottom: 12px; }
        
        .order-options {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        .btn-dinein, .btn-takeaway {
            flex: 1;
            padding: 8px;
            border: none;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        
        .btn-dinein { background: #2c3e50; color: white; }
        .btn-takeaway { background: #FF8C00; color: #222; }
        
        /* Cart Sidebar */
        .cart-sidebar {
            position: fixed;
            right: -420px;
            top: 0;
            width: 420px;
            height: 100vh;
            background: white;
            box-shadow: -5px 0 30px rgba(0,0,0,0.2);
            z-index: 1000;
            transition: 0.3s;
            display: flex;
            flex-direction: column;
        }
        
        .cart-sidebar.open { right: 0; }
        
        .cart-header {
            background: #FF8C00;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .cart-header h3 { color: #222; }
        .close-cart { background: none; border: none; font-size: 28px; cursor: pointer; color: #222; }
        
        .cart-items {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }
        
        .cart-item {
            display: flex;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        
        .cart-item-img {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
            background: linear-gradient(135deg, #FF8C00, #ffa733);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }
        
        .cart-item-details { flex: 1; }
        .cart-item-title { font-weight: bold; }
        .cart-item-price { color: #FF8C00; font-weight: bold; }
        
        .cart-item-quantity {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 8px;
        }
        
        .quantity-btn {
            background: #f0f0f0;
            border: none;
            width: 25px;
            height: 25px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .cart-footer {
            padding: 20px;
            border-top: 1px solid #eee;
            background: #fafafa;
        }
        
        .cart-total {
            display: flex;
            justify-content: space-between;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .checkout-btn {
            background: #FF8C00;
            color: #222;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
        }
        
        .cart-icon {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #FF8C00;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            z-index: 99;
        }
        
        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #e74c3c;
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
        }
        
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        
        .overlay.active { display: block; }
        
        /* Dine-in Reservation Modal */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 20px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            z-index: 1002;
            max-height: 90vh;
            overflow-y: auto;
        }
        
        .modal.active { display: block; }
        
        .modal-header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .modal-header h3 { color: #FF8C00; font-size: 24px; }
        .modal-header p { color: #666; font-size: 14px; }
        
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        
        .modal-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        .modal-buttons button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .btn-confirm { background: #FF8C00; color: #222; }
        .btn-cancel { background: #ccc; color: #555; }
        
        /* My Orders Section */
        .orders-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-top: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            border-bottom: 2px solid #eee;
        }
        
        .tab-btn {
            padding: 10px 20px;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: bold;
            color: #666;
            transition: 0.3s;
        }
        
        .tab-btn.active {
            color: #FF8C00;
            border-bottom: 2px solid #FF8C00;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .orders-grid {
            display: grid;
            gap: 20px;
        }
        
        .order-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 15px;
            border: 1px solid #eee;
        }
        
        .order-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        
        .order-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #d4edda; color: #155724; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        
        .empty-state {
            text-align: center;
            padding: 50px;
            color: #888;
        }
        
        .login-prompt {
            text-align: center;
            padding: 40px;
            background: #f8f9fa;
            border-radius: 15px;
        }
        
        .login-prompt a { color: #FF8C00; text-decoration: none; font-weight: bold; }
        
        footer { background: #1a1a1a; color: white; text-align: center; padding: 30px; margin-top: 50px; }
        
        @media (max-width: 768px) {
            header { flex-direction: column; gap: 15px; text-align: center; }
            .slide-overlay h1 { font-size: 28px; }
            .hero-slideshow { height: 350px; }
            .menu-grid { grid-template-columns: 1fr; }
            .cart-sidebar { width: 100%; right: -100%; }
            .order-type-btn { max-width: 100%; }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="logo-img" onerror="this.src='https://placehold.co/50x50?text=YE'">
            <div class="logo-text">
                <h1>Yangkhel Khangza</h1>
                <span>Authentic Bhutanese Flavors</span>
            </div>
        </div>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            <a href="#reservation">Reservation</a>
            <a href="#orders">My Orders</a>
            @auth
                <span style="color:#FF8C00;">Hi, {{ Auth::user()->name }}</span>
                <a href="{{ route('profile') }}">My Profile</a>
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

    <!-- Hero Slideshow -->
    <div class="hero-slideshow">
        <div class="slideshow-container">
            <div class="slide active" style="background-image: url('{{ asset('images/restaurant/slide1.jpg') }}');">
                <div class="slide-overlay"><h1>Yangkhel Khangza</h1><p>Experience Authentic Bhutanese Cuisine</p></div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('images/restaurant/slide2.jpg') }}');">
                <div class="slide-overlay"><h1>Traditional Flavors</h1><p>Authentic recipes passed down through generations</p></div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('images/restaurant/slide3.jpg') }}');">
                <div class="slide-overlay"><h1>Spicy & Flavorful</h1><p>Fresh ingredients, rich flavors</p></div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('images/restaurant/slide4.jpg') }}');">
                <div class="slide-overlay"><h1>Taste of the Himalayas</h1><p>Unforgettable dining experience</p></div>
            </div>
            <div class="slide-dots">
                <span class="dot active" onclick="currentSlide(0)"></span>
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="info-cards">
            <div class="info-card"><div class="icon">⏰</div><h3>Opening Hours</h3><p>10:00 AM - 10:00 PM</p></div>
            <div class="info-card"><div class="icon">📍</div><h3>Location</h3><p>Dewathang, Samdrup Jongkhar</p></div>
            <div class="info-card"><div class="icon">📞</div><h3>Contact</h3><p>77299776 / 77827571</p></div>
            <div class="info-card"><div class="icon">🍽️</div><h3>Service</h3><p>Dine-in • Takeaway</p></div>
        </div>

        <!-- Order Type Selection -->
        <div class="order-type-section" id="orderTypeSection">
            <div class="order-type-buttons">
                <div class="order-type-btn" data-type="dinein">
                    <div class="icon">🍽️</div>
                    <h3>Dine In</h3>
                    <p>Enjoy your meal at our restaurant</p>
                </div>
                <div class="order-type-btn" data-type="takeaway">
                    <div class="icon">📦</div>
                    <h3>Take Away</h3>
                    <p>Order food for pickup</p>
                </div>
            </div>
        </div>

        <!-- Menu Category Buttons -->
        <div class="menu-categories" id="menuCategories">
            <button class="cat-btn" data-section="starters">🍢 Starters</button>
            <button class="cat-btn" data-section="maincourse">🍛 Main Course</button>
            <button class="cat-btn" data-section="curries">🥘 Curries & Datshi</button>
            <button class="cat-btn" data-section="noodles">🍜 Noodles & Soups</button>
            <button class="cat-btn" data-section="hotdrinks">☕ Hot Drinks</button>
            <button class="cat-btn" data-section="colddrinks">🥤 Cold Drinks</button>
            <button class="cat-btn" data-section="snacks">🍿 Snacks & Extras</button>
        </div>

        <!-- Menu Sections -->
        <div id="starters" class="menu-section"><h2 class="section-title">🍢 Starters</h2><div class="menu-grid" id="starters-menu"></div></div>
        <div id="maincourse" class="menu-section"><h2 class="section-title">🍛 Main Course</h2><div class="menu-grid" id="maincourse-menu"></div></div>
        <div id="curries" class="menu-section"><h2 class="section-title">🥘 Curries & Datshi</h2><div class="menu-grid" id="curries-menu"></div></div>
        <div id="noodles" class="menu-section"><h2 class="section-title">🍜 Noodles & Soups</h2><div class="menu-grid" id="noodles-menu"></div></div>
        <div id="hotdrinks" class="menu-section"><h2 class="section-title">☕ Hot Drinks</h2><div class="menu-grid" id="hotdrinks-menu"></div></div>
        <div id="colddrinks" class="menu-section"><h2 class="section-title">🥤 Cold Drinks</h2><div class="menu-grid" id="colddrinks-menu"></div></div>
        <div id="snacks" class="menu-section"><h2 class="section-title">🍿 Snacks & Extras</h2><div class="menu-grid" id="snacks-menu"></div></div>

        <!-- My Orders Section -->
        <div class="orders-section" id="orders">
            <h2 class="section-title">📋 My Orders & Reservations</h2>
            @auth
                <div class="tabs">
                    <button class="tab-btn active" data-tab="orders">🛒 Food Orders</button>
                    <button class="tab-btn" data-tab="reservations">📅 Table Reservations</button>
                </div>
                <div id="orders-tab" class="tab-content active">
                    <div id="ordersList"></div>
                </div>
                <div id="reservations-tab" class="tab-content">
                    <div id="reservationsList"></div>
                </div>
            @else
                <div class="login-prompt"><p>🔐 Please <a href="{{ route('login') }}">login</a> to view your orders and reservations</p></div>
            @endauth
        </div>
    </div>

    <!-- Cart Sidebar -->
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header"><h3>🛒 Your Cart</h3><button class="close-cart" onclick="closeCart()">×</button></div>
        <div class="cart-items" id="cartItems"><div class="empty-state">Your cart is empty</div></div>
        <div class="cart-footer">
            <div class="cart-total"><span>Total:</span><span id="cartTotal">Nu. 0</span></div>
            <button class="checkout-btn" onclick="proceedToCheckout()">Proceed to Checkout</button>
            <p style="font-size:11px;color:#888;text-align:center;margin-top:10px;">💰 Pay at restaurant</p>
        </div>
    </div>

    <!-- Cart Icon -->
    <div class="cart-icon" onclick="openCart()">
        🛒
        <span class="cart-count" id="cartCount">0</span>
    </div>
    <div class="overlay" id="overlay" onclick="closeCart()"></div>

    <!-- Dine-in Reservation Modal -->
    <div class="modal" id="dineinModal">
        <div class="modal-header">
            <h3>🍽️ Complete Your Dine-in Order</h3>
            <p>Please provide table reservation details</p>
        </div>
        <form id="dineinForm">
            <div class="form-group">
                <label>Full Name *</label>
                <input type="text" id="dineinName" value="{{ Auth::user()->name ?? '' }}" required>
            </div>
            <div class="form-group">
                <label>Phone Number *</label>
                <input type="tel" id="dineinPhone" value="{{ Auth::user()->phone ?? '' }}" required>
            </div>
            <div class="form-group">
                <label>Number of Guests *</label>
                <select id="dineinGuests" required>
                    <option value="1">1 Guest</option>
                    <option value="2">2 Guests</option>
                    <option value="3">3 Guests</option>
                    <option value="4">4 Guests</option>
                    <option value="5">5 Guests</option>
                    <option value="6">6+ Guests</option>
                </select>
            </div>
            <div class="form-group">
                <label>Reservation Date *</label>
                <input type="date" id="dineinDate" min="{{ date('Y-m-d') }}" required>
            </div>
            <div class="form-group">
                <label>Reservation Time *</label>
                <select id="dineinTime" required>
                    <option value="10:00">10:00 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="12:00">12:00 PM</option>
                    <option value="13:00">1:00 PM</option>
                    <option value="14:00">2:00 PM</option>
                    <option value="15:00">3:00 PM</option>
                    <option value="16:00">4:00 PM</option>
                    <option value="17:00">5:00 PM</option>
                    <option value="18:00">6:00 PM</option>
                    <option value="19:00">7:00 PM</option>
                    <option value="20:00">8:00 PM</option>
                    <option value="21:00">9:00 PM</option>
                </select>
            </div>
            <div class="form-group">
                <label>Special Requests</label>
                <textarea id="dineinRequests" rows="2" placeholder="Any special requests?"></textarea>
            </div>
            <div class="modal-buttons">
                <button type="button" class="btn-confirm" onclick="confirmDineInOrder()">Confirm Order</button>
                <button type="button" class="btn-cancel" onclick="closeDineinModal()">Cancel</button>
            </div>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Yangkhel Khangza - Yosel Enterprise. All rights reserved.</p>
    </footer>

    <script>
        // Slideshow
        let slideIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');
        const totalSlides = slides.length;
        
        function showSlide(index) {
            slides.forEach(s => s.classList.remove('active'));
            dots.forEach(d => d.classList.remove('active'));
            slideIndex = index;
            if (slideIndex >= totalSlides) slideIndex = 0;
            if (slideIndex < 0) slideIndex = totalSlides - 1;
            slides[slideIndex].classList.add('active');
            dots[slideIndex].classList.add('active');
        }
        
        function changeSlide() { slideIndex++; showSlide(slideIndex); }
        function currentSlide(index) { showSlide(index); clearInterval(slideInterval); slideInterval = setInterval(changeSlide, 5000); }
        let slideInterval = setInterval(changeSlide, 5000);

        // Complete Menu Data - YOUR EXACT MENU (All 63 items preserved)
        const menuData = {
            starters: [
                { id: 1, name: "Chicken Chilli", price: 190, desc: "Sautéed chicken with vegetables and seasoned with sauce", img: "{{ asset('images/menu/chicken-chilli.jpg') }}", defaultImg: "🍗" },
                { id: 2, name: "Pork Chilli", price: 190, desc: "Deep fried pork with vegetables and seasoned with sauce", img: "{{ asset('images/menu/pork-chilli.jpg') }}", defaultImg: "🐷" },
                { id: 3, name: "Wai Wai Chit", price: 170, desc: "Soured chicken with vegetables and seasonings", img: "{{ asset('images/menu/wai-wai-chit.jpg') }}", defaultImg: "🍜" },
                { id: 4, name: "Beef Momo", price: 180, desc: "Local beef with onion & peas - 8 pcs", img: "{{ asset('images/menu/beef-momo.jpg') }}", defaultImg: "🥟" },
                { id: 5, name: "Chicken Momo", price: 180, desc: "Chicken dumplings - 8 pcs", img: "{{ asset('images/menu/chicken-momo.jpg') }}", defaultImg: "🥟" },
                { id: 6, name: "Veg Momo", price: 150, desc: "Vegetable dumplings - 8 pcs", img: "{{ asset('images/menu/veg-momo.jpg') }}", defaultImg: "🥟" },
                { id: 7, name: "Fried Momo", price: 200, desc: "Crispy fried dumplings", img: "{{ asset('images/menu/fried-momo.jpg') }}", defaultImg: "🍘" },
                { id: 8, name: "Alu Purata", price: 150, desc: "Boiled potato with onions & peas", img: "{{ asset('images/menu/alu-purata.jpg') }}", defaultImg: "🥔" },
                { id: 9, name: "Green Pea", price: 120, desc: "Boiled green peas with onions", img: "{{ asset('images/menu/green-pea.jpg') }}", defaultImg: "🟢" },
                { id: 10, name: "Papad (Masala)", price: 80, desc: "4 pieces crispy masala papad", img: "{{ asset('images/menu/papad.jpg') }}", defaultImg: "🍘" },
                { id: 11, name: "Noodles", price: 75, desc: "Stir-fried noodles", img: "{{ asset('images/menu/noodles.jpg') }}", defaultImg: "🍝" },
                { id: 12, name: "Scrambled Eggs", price: 70, desc: "Eggs scrambled with spices", img: "{{ asset('images/menu/scrambled-eggs.jpg') }}", defaultImg: "🍳" },
                { id: 13, name: "Boiled Egg", price: 60, desc: "2 boiled eggs", img: "{{ asset('images/menu/boiled-egg.jpg') }}", defaultImg: "🥚" }
            ],
            maincourse: [
                { id: 14, name: "Beef Datshi Meal", price: 230, desc: "Beef datshi gravy with rice + dal + papad", img: "{{ asset('images/menu/beef-datshi-meal.jpg') }}", defaultImg: "🍛" },
                { id: 15, name: "Chicken Pao Meal", price: 260, desc: "Chicken curry with rice + dal + papad", img: "{{ asset('images/menu/chicken-pao-meal.jpg') }}", defaultImg: "🍛" },
                { id: 16, name: "Stir-fried Meal", price: 220, desc: "Stir-fried vegetables with rice + dal + papad", img: "{{ asset('images/menu/stir-fried-meal.jpg') }}", defaultImg: "🍛" },
                { id: 17, name: "Egg Curry Meal", price: 230, desc: "Egg curry with rice + dal + papad", img: "{{ asset('images/menu/egg-curry-meal.jpg') }}", defaultImg: "🍛" },
                { id: 18, name: "Macaroni (Veg)", price: 150, desc: "Macaroni pasta with vegetables", img: "{{ asset('images/menu/macaroni-veg.jpg') }}", defaultImg: "🍝" },
                { id: 19, name: "Macaroni (Egg)", price: 160, desc: "Macaroni pasta with egg", img: "{{ asset('images/menu/macaroni-egg.jpg') }}", defaultImg: "🍝" },
                { id: 20, name: "Macaroni (Chicken)", price: 180, desc: "Macaroni pasta with chicken", img: "{{ asset('images/menu/macaroni-chicken.jpg') }}", defaultImg: "🍝" },
                { id: 21, name: "Soggyfett (Veg)", price: 250, desc: "Soggyfett pasta with vegetables", img: "{{ asset('images/menu/soggyfett-veg.jpg') }}", defaultImg: "🍝" },
                { id: 22, name: "Soggyfett (Egg)", price: 260, desc: "Soggyfett pasta with egg", img: "{{ asset('images/menu/soggyfett-egg.jpg') }}", defaultImg: "🍝" },
                { id: 23, name: "Soggyfett (Chicken)", price: 280, desc: "Soggyfett pasta with chicken", img: "{{ asset('images/menu/soggyfett-chicken.jpg') }}", defaultImg: "🍝" }
            ],
            curries: [
                { id: 24, name: "Ema Datshi", price: 220, desc: "Traditional Bhutanese chili cheese stew", img: "{{ asset('images/menu/ema-datshi.jpg') }}", defaultImg: "🌶️" },
                { id: 25, name: "Shamu Datshi", price: 160, desc: "Mushroom with cheese", img: "{{ asset('images/menu/shamu-datshi.jpg') }}", defaultImg: "🍄" },
                { id: 26, name: "Kewa Datshi", price: 150, desc: "Potato with cheese", img: "{{ asset('images/menu/kewa-datshi.jpg') }}", defaultImg: "🥔" },
                { id: 27, name: "Beef Datshi", price: 190, desc: "Beef with cheese", img: "{{ asset('images/menu/beef-datshi.jpg') }}", defaultImg: "🥩" },
                { id: 28, name: "Chicken Curry", price: 160, desc: "Traditional Bhutanese chicken curry", img: "{{ asset('images/menu/chicken-curry.jpg') }}", defaultImg: "🍗" },
                { id: 29, name: "Egg Curry", price: 170, desc: "Eggs in spicy gravy", img: "{{ asset('images/menu/egg-curry.jpg') }}", defaultImg: "🥚" },
                { id: 30, name: "Mooi Power", price: 170, desc: "Special mooi power dish", img: "{{ asset('images/menu/mooi-power.jpg') }}", defaultImg: "⚡" },
                { id: 31, name: "Park Datshi", price: 220, desc: "Pork with cheese", img: "{{ asset('images/menu/park-datshi.jpg') }}", defaultImg: "🐷" },
                { id: 32, name: "Mix Veg Curry", price: 180, desc: "Mixed vegetables in spiced gravy", img: "{{ asset('images/menu/mix-veg-curry.jpg') }}", defaultImg: "🥕" }
            ],
            noodles: [
                { id: 33, name: "Koka Chowmein (Veg)", price: 130, desc: "Instant noodle chowmein with vegetables", img: "{{ asset('images/menu/koka-chowmein-veg.jpg') }}", defaultImg: "🍝" },
                { id: 34, name: "Koka Chowmein (Egg)", price: 170, desc: "Instant noodle chowmein with egg", img: "{{ asset('images/menu/koka-chowmein-egg.jpg') }}", defaultImg: "🍝" },
                { id: 35, name: "Koka Chowmein (Chicken)", price: 180, desc: "Instant noodle chowmein with chicken", img: "{{ asset('images/menu/koka-chowmein-chicken.jpg') }}", defaultImg: "🍝" },
                { id: 36, name: "Noodle Soup with Egg", price: 110, desc: "Soup noodles with egg", img: "{{ asset('images/menu/noodle-soup-egg.jpg') }}", defaultImg: "🍜" },
                { id: 37, name: "Noodle Soup with Chicken", price: 150, desc: "Soup noodles with chicken", img: "{{ asset('images/menu/noodle-soup-chicken.jpg') }}", defaultImg: "🍜" },
                { id: 38, name: "Thukpa (Veg)", price: 110, desc: "Tibetan noodle soup with vegetables", img: "{{ asset('images/menu/thukpa-veg.jpg') }}", defaultImg: "🍜" },
                { id: 39, name: "Thukpa (Chicken)", price: 150, desc: "Tibetan noodle soup with chicken", img: "{{ asset('images/menu/thukpa-chicken.jpg') }}", defaultImg: "🍜" },
                { id: 40, name: "Thenthuk", price: 220, desc: "Hand-pulled noodle soup", img: "{{ asset('images/menu/thenthuk.jpg') }}", defaultImg: "🍜" },
                { id: 41, name: "Borthep (Veg)", price: 110, desc: "Traditional Bhutanese noodle dish", img: "{{ asset('images/menu/borthep-veg.jpg') }}", defaultImg: "🍜" },
                { id: 42, name: "Borthep (Chicken)", price: 150, desc: "Traditional Bhutanese noodle with chicken", img: "{{ asset('images/menu/borthep-chicken.jpg') }}", defaultImg: "🍜" }
            ],
            hotdrinks: [
                { id: 43, name: "Lemon Ginger Tea", price: 40, desc: "Refreshing lemon ginger tea", img: "{{ asset('images/menu/lemon-ginger-tea.jpg') }}", defaultImg: "🍋" },
                { id: 44, name: "Masala Tea (Single)", price: 40, desc: "Spiced milk tea single", img: "{{ asset('images/menu/masala-tea-single.jpg') }}", defaultImg: "☕" },
                { id: 45, name: "Masala Tea (Double)", price: 60, desc: "Spiced milk tea double", img: "{{ asset('images/menu/masala-tea-double.jpg') }}", defaultImg: "☕" },
                { id: 46, name: "Black Coffee (Single)", price: 40, desc: "Fresh brewed black coffee", img: "{{ asset('images/menu/black-coffee-single.jpg') }}", defaultImg: "☕" },
                { id: 47, name: "Black Coffee (Double)", price: 60, desc: "Fresh brewed black coffee double", img: "{{ asset('images/menu/black-coffee-double.jpg') }}", defaultImg: "☕" },
                { id: 48, name: "Coffee with Milk (Single)", price: 50, desc: "Milk coffee single", img: "{{ asset('images/menu/coffee-milk-single.jpg') }}", defaultImg: "☕" },
                { id: 49, name: "Coffee with Milk (Double)", price: 70, desc: "Milk coffee double", img: "{{ asset('images/menu/coffee-milk-double.jpg') }}", defaultImg: "☕" },
                { id: 50, name: "Milk Shake", price: 90, desc: "Creamy milk shake", img: "{{ asset('images/menu/milk-shake.jpg') }}", defaultImg: "🥛" }
            ],
            colddrinks: [
                { id: 51, name: "Iced Coke", price: 90, desc: "Chilled Coca-Cola", img: "{{ asset('images/menu/iced-coke.jpg') }}", defaultImg: "🥤" },
                { id: 52, name: "Iced Coffee", price: 100, desc: "Chilled coffee", img: "{{ asset('images/menu/iced-coffee.jpg') }}", defaultImg: "🧋" },
                { id: 53, name: "Iced Tea", price: 100, desc: "Chilled lemon tea", img: "{{ asset('images/menu/iced-tea.jpg') }}", defaultImg: "🧋" },
                { id: 54, name: "Soft Drinks", price: 40, desc: "Coke, Fanta, Sprite", img: "{{ asset('images/menu/soft-drinks.jpg') }}", defaultImg: "🥤" },
                { id: 55, name: "Mineral Water", price: 30, desc: "1 liter bottled water", img: "{{ asset('images/menu/water.jpg') }}", defaultImg: "💧" }
            ],
            snacks: [
                { id: 56, name: "Highland Butter", price: 125, desc: "Premium highland butter", img: "{{ asset('images/menu/highland-butter.jpg') }}", defaultImg: "🧈" },
                { id: 57, name: "Rock Cheese", price: 120, desc: "Rock cheese block", img: "{{ asset('images/menu/rock-cheese.jpg') }}", defaultImg: "🧀" },
                { id: 58, name: "Milk (B)", price: 290, desc: "Fresh milk pack", img: "{{ asset('images/menu/milk.jpg') }}", defaultImg: "🥛" },
                { id: 59, name: "Solu", price: 185, desc: "Solu butter", img: "{{ asset('images/menu/solu.jpg') }}", defaultImg: "🧈" },
                { id: 60, name: "Butter", price: 165, desc: "Pure butter", img: "{{ asset('images/menu/butter.jpg') }}", defaultImg: "🧈" },
                { id: 61, name: "Fiber", price: 160, desc: "Fiber biscuits", img: "{{ asset('images/menu/fiber.jpg') }}", defaultImg: "🍪" },
                { id: 62, name: "Kurkure Chips", price: 35, desc: "Crunchy chips", img: "{{ asset('images/menu/kurkure.jpg') }}", defaultImg: "🍟" },
                { id: 63, name: "Cokonutz", price: 60, desc: "Coconut biscuits", img: "{{ asset('images/menu/kokonutz.jpg') }}", defaultImg: "🥥" }
            ]
        };

        let cart = [];
        let orders = [];
        let reservations = [];
        let selectedOrderType = null;

        function loadMenu() {
            loadCategory(menuData.starters, 'starters-menu');
            loadCategory(menuData.maincourse, 'maincourse-menu');
            loadCategory(menuData.curries, 'curries-menu');
            loadCategory(menuData.noodles, 'noodles-menu');
            loadCategory(menuData.hotdrinks, 'hotdrinks-menu');
            loadCategory(menuData.colddrinks, 'colddrinks-menu');
            loadCategory(menuData.snacks, 'snacks-menu');
        }

        function loadCategory(items, containerId) {
            const container = document.getElementById(containerId);
            if (!container) return;
            container.innerHTML = items.map(item => `
                <div class="menu-item">
                    <div class="menu-img"><img src="${item.img}" alt="${item.name}" onerror="this.parentElement.innerHTML='${item.defaultImg}'"></div>
                    <div class="menu-info">
                        <div class="menu-header"><span class="menu-name">${item.name}</span><span class="menu-price">Nu. ${item.price}</span></div>
                        <div class="menu-desc">${item.desc}</div>
                        <div class="order-options">
                            <button class="btn-dinein" onclick="addToCart(${item.id}, 'Dine-in')">🍽️ Dine-in</button>
                            <button class="btn-takeaway" onclick="addToCart(${item.id}, 'Takeaway')">📦 Takeaway</button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function findItem(id) {
            for (let cat in menuData) {
                let found = menuData[cat].find(i => i.id === id);
                if (found) return found;
            }
            return null;
        }

        function addToCart(id, orderType) {
            if (!selectedOrderType) {
                Swal.fire({
                    title: 'Select Order Type',
                    text: 'Please select Dine-in or Takeaway first',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }
            
            if (selectedOrderType !== orderType) {
                Swal.fire({
                    title: 'Order Type Mismatch',
                    text: `You have selected ${selectedOrderType} mode. Please switch to ${orderType} mode or clear your cart.`,
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }
            
            let item = findItem(id);
            if (item) {
                let existing = cart.find(c => c.id === id);
                if (existing) {
                    existing.quantity++;
                } else {
                    cart.push({...item, quantity: 1});
                }
                updateCart();
                Swal.fire({
                    icon: 'success',
                    title: 'Added!',
                    text: `${item.name} added to cart!`,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }

        function updateCart() {
            let total = cart.reduce((sum, i) => sum + (i.price * i.quantity), 0);
            let items = cart.reduce((sum, i) => sum + i.quantity, 0);
            document.getElementById('cartCount').innerText = items;
            document.getElementById('cartTotal').innerText = `Nu. ${total}`;
            
            const container = document.getElementById('cartItems');
            if (cart.length === 0) {
                container.innerHTML = '<div class="empty-state">Your cart is empty</div>';
                return;
            }
            
            container.innerHTML = cart.map(i => `
                <div class="cart-item">
                    <div class="cart-item-img"><img src="${i.img}" style="width:100%;height:100%;object-fit:cover;" onerror="this.parentElement.innerHTML='${i.defaultImg}'"></div>
                    <div class="cart-item-details">
                        <div class="cart-item-title">${i.name}</div>
                        <div class="cart-item-price">Nu. ${i.price}</div>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn" onclick="updateQuantity(${i.id}, ${i.quantity - 1})">-</button>
                            <span>${i.quantity}</span>
                            <button class="quantity-btn" onclick="updateQuantity(${i.id}, ${i.quantity + 1})">+</button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function updateQuantity(id, newQty) {
            if (newQty <= 0) {
                cart = cart.filter(i => i.id !== id);
            } else {
                let item = cart.find(i => i.id === id);
                if (item) item.quantity = newQty;
            }
            updateCart();
        }

        function proceedToCheckout() {
            if (cart.length === 0) {
                Swal.fire('Error', 'Your cart is empty!', 'error');
                return;
            }
            
            if (selectedOrderType === 'Dine-in') {
                openDineinModal();
            } else if (selectedOrderType === 'Takeaway') {
                placeOrder('Takeaway');
            } else {
                Swal.fire('Select Order Type', 'Please select Dine-in or Takeaway first', 'warning');
            }
        }

        function openDineinModal() {
            document.getElementById('dineinModal').classList.add('active');
            document.getElementById('overlay').classList.add('active');
        }

        function closeDineinModal() {
            document.getElementById('dineinModal').classList.remove('active');
            document.getElementById('overlay').classList.remove('active');
        }

        function confirmDineInOrder() {
            const name = document.getElementById('dineinName').value;
            const phone = document.getElementById('dineinPhone').value;
            const guests = document.getElementById('dineinGuests').value;
            const date = document.getElementById('dineinDate').value;
            const time = document.getElementById('dineinTime').value;
            const requests = document.getElementById('dineinRequests').value;
            
            if (!name || !phone || !date) {
                Swal.fire('Error', 'Please fill all required fields!', 'error');
                return;
            }
            
            const reservation = {
                id: Date.now(),
                name: name,
                phone: phone,
                guests: guests,
                date: date,
                time: time,
                requests: requests,
                dateTime: new Date().toLocaleString(),
                status: 'confirmed'
            };
            
            reservations.unshift(reservation);
            localStorage.setItem('restaurantReservations', JSON.stringify(reservations));
            
            placeOrder('Dine-in', reservation);
            closeDineinModal();
        }

        function placeOrder(orderType, reservation = null) {
            const total = cart.reduce((sum, i) => sum + (i.price * i.quantity), 0);
            const order = {
                id: Date.now(),
                items: [...cart],
                total: total,
                orderType: orderType,
                dateTime: new Date().toLocaleString(),
                status: 'pending',
                reservation: reservation
            };
            
            orders.unshift(order);
            localStorage.setItem('restaurantOrders', JSON.stringify(orders));
            
            cart = [];
            selectedOrderType = null;
            updateCart();
            closeCart();
            displayOrders();
            
            Swal.fire({
                icon: 'success',
                title: 'Order Placed!',
                text: `Your ${orderType} order has been placed successfully!`,
                timer: 2000,
                showConfirmButton: false
            });
            
            // Reset order type selection UI
            document.querySelectorAll('.order-type-btn').forEach(btn => {
                btn.classList.remove('active');
            });
        }

        function displayOrders() {
            let savedOrders = localStorage.getItem('restaurantOrders');
            let savedReservations = localStorage.getItem('restaurantReservations');
            
            if (savedOrders) orders = JSON.parse(savedOrders);
            if (savedReservations) reservations = JSON.parse(savedReservations);
            
            // Display food orders
            const ordersContainer = document.getElementById('ordersList');
            if (!ordersContainer) return;
            
            if (orders.length === 0) {
                ordersContainer.innerHTML = '<div class="empty-state">No food orders yet</div>';
            } else {
                ordersContainer.innerHTML = `<div class="orders-grid">${orders.map(order => `
                    <div class="order-card">
                        <div class="order-header">
                            <strong>Order #${order.id}</strong>
                            <span class="order-status status-${order.status}">${order.status.toUpperCase()}</span>
                        </div>
                        <div>${order.items.map(i => `${i.name} x${i.quantity} - Nu. ${i.price * i.quantity}`).join('<br>')}</div>
                        <div style="margin-top: 10px;"><strong>Total: Nu. ${order.total}</strong></div>
                        <div style="margin-top: 5px;"><strong>Type:</strong> ${order.orderType}</div>
                        ${order.reservation ? `<div><strong>Table Reservation:</strong> ${order.reservation.date} at ${order.reservation.time} (${order.reservation.guests} guests)</div>` : ''}
                        <div style="font-size: 11px; color: #888; margin-top: 10px;">📅 ${order.dateTime}</div>
                    </div>
                `).join('')}</div>`;
            }
            
            // Display reservations
            const reservationsContainer = document.getElementById('reservationsList');
            if (reservationsContainer) {
                if (reservations.length === 0) {
                    reservationsContainer.innerHTML = '<div class="empty-state">No table reservations yet</div>';
                } else {
                    reservationsContainer.innerHTML = `<div class="orders-grid">${reservations.map(res => `
                        <div class="order-card">
                            <div class="order-header">
                                <strong>Reservation #${res.id}</strong>
                                <span class="order-status status-${res.status}">${res.status.toUpperCase()}</span>
                            </div>
                            <div><strong>Name:</strong> ${res.name}</div>
                            <div><strong>Phone:</strong> ${res.phone}</div>
                            <div><strong>Guests:</strong> ${res.guests}</div>
                            <div><strong>Date:</strong> ${res.date}</div>
                            <div><strong>Time:</strong> ${res.time}</div>
                            ${res.requests ? `<div><strong>Requests:</strong> ${res.requests}</div>` : ''}
                            <div style="font-size: 11px; color: #888; margin-top: 10px;">📅 Booked on ${res.dateTime}</div>
                        </div>
                    `).join('')}</div>`;
                }
            }
        }

        // Order Type Selection
        document.querySelectorAll('.order-type-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const type = this.getAttribute('data-type');
                if (cart.length > 0) {
                    Swal.fire({
                        title: 'Clear Cart?',
                        text: `Changing order type will clear your cart. Continue?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, clear cart',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            cart = [];
                            updateCart();
                            selectedOrderType = type === 'dinein' ? 'Dine-in' : 'Takeaway';
                            document.querySelectorAll('.order-type-btn').forEach(b => b.classList.remove('active'));
                            this.classList.add('active');
                            Swal.fire('Mode Selected', `${selectedOrderType} mode selected`, 'success');
                        }
                    });
                } else {
                    selectedOrderType = type === 'dinein' ? 'Dine-in' : 'Takeaway';
                    document.querySelectorAll('.order-type-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    Swal.fire('Mode Selected', `${selectedOrderType} mode selected`, 'success');
                }
            });
        });

        // Category buttons - smooth scroll
        document.querySelectorAll('.cat-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const section = this.getAttribute('data-section');
                const element = document.getElementById(section);
                if (element) {
                    element.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Tab switching
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const tab = this.getAttribute('data-tab');
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });
                document.getElementById(`${tab}-tab`).classList.add('active');
            });
        });

        function openCart() { 
            document.getElementById('cartSidebar').classList.add('open'); 
            document.getElementById('overlay').classList.add('active'); 
        }
        
        function closeCart() { 
            document.getElementById('cartSidebar').classList.remove('open'); 
            document.getElementById('overlay').classList.remove('active'); 
        }
        
        // Load everything
        loadMenu();
        displayOrders();
        
        // Close modals when clicking overlay
        document.getElementById('overlay').addEventListener('click', function() {
            closeCart();
            closeDineinModal();
        });
    </script>
</body>
</html>