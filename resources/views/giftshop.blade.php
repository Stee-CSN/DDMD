<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Norphel Bangzay - Gift Shop | Yosel Enterprise</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        body { background: #f8f9fa; }
        
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
        }
        
        .logo { display: flex; align-items: center; gap: 15px; }
        .logo-img { height: 50px; }
        .logo-text h1 { font-size: 24px; color: #FF8C00; }
        .logo-text span { font-size: 10px; color: #888; display: block; }
        
        nav a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; cursor: pointer; }
        nav a:hover { color: #FF8C00; }
        
        .logout-btn {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            cursor: pointer;
        }
        
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
        
        .category-section {
            background: white;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .category-title {
            font-size: 28px;
            color: #222;
            margin-bottom: 25px;
            padding-left: 15px;
            border-left: 4px solid #FF8C00;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
        
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: 0.3s;
            border: 1px solid #eee;
        }
        
        .product-card:hover { transform: translateY(-5px); }
        
        .product-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #FF8C00, #ffa733);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            overflow: hidden;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .product-info { padding: 20px; }
        .product-title { font-size: 16px; font-weight: bold; color: #222; }
        .product-price { color: #FF8C00; font-size: 22px; font-weight: bold; margin: 8px 0; }
        .product-desc { color: #666; font-size: 12px; margin-bottom: 10px; line-height: 1.4; }
        .product-stock { font-size: 12px; margin-bottom: 10px; }
        .stock-in { color: green; }
        .stock-low { color: orange; }
        .stock-out { color: red; }
        
        .btn-add {
            background: #FF8C00;
            color: #222;
            border: none;
            padding: 10px;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: 0.3s;
        }
        
        .btn-add:hover { background: #e67e22; }
        .btn-add:disabled { background: #ccc; cursor: not-allowed; }
        
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
            background: linear-gradient(135deg, #FF8C00, #ffa733);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            overflow: hidden;
        }
        
        .cart-item-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .cart-item-details { flex: 1; }
        .cart-item-title { font-weight: bold; font-size: 14px; }
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
        
        /* My Orders Section */
        .orders-section {
            background: white;
            border-radius: 20px;
            padding: 25px;
            margin-top: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .section-title {
            font-size: 28px;
            color: #222;
            margin-bottom: 25px;
            padding-left: 15px;
            border-left: 4px solid #FF8C00;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .view-orders-btn {
            background: #FF8C00;
            color: #222;
            border: none;
            padding: 8px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
        }
        
        .orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .order-card {
            background: #f8f9fa;
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #eee;
        }
        
        .order-header {
            background: linear-gradient(135deg, #FF8C00, #ffa733);
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .order-header h4 { color: #222; font-size: 16px; }
        .order-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #d4edda; color: #155724; }
        
        .order-body { padding: 15px; max-height: 300px; overflow-y: auto; }
        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            font-size: 13px;
            border-bottom: 1px dashed #eee;
        }
        .order-total {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-weight: bold;
            border-top: 2px solid #FF8C00;
            margin-top: 10px;
        }
        .order-date { font-size: 11px; color: #888; margin-top: 10px; text-align: right; }
        
        .empty-orders { text-align: center; padding: 50px; color: #888; }
        .login-prompt { text-align: center; padding: 60px; background: white; border-radius: 15px; }
        .login-prompt a { color: #FF8C00; text-decoration: none; font-weight: bold; }
        
        .confirm-btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 11px;
            margin-left: 10px;
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 20px;
            padding: 30px;
            max-width: 400px;
            width: 90%;
            z-index: 1001;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        
        .modal input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        
        .modal button {
            background: #FF8C00;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
        }
        
        .modal .close-modal {
            position: absolute;
            top: 15px;
            right: 20px;
            cursor: pointer;
            font-size: 24px;
        }
        
        .category-filter {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 30px;
            background: white;
            padding: 15px 25px;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .filter-btn {
            padding: 8px 20px;
            border-radius: 25px;
            cursor: pointer;
            background: #f0f0f0;
            border: none;
            font-weight: bold;
            transition: 0.3s;
        }
        
        .filter-btn.active {
            background: #FF8C00;
            color: #222;
        }
        
        .filter-btn:hover { background: #e0e0e0; }
        
        .search-bar {
            margin-bottom: 25px;
            display: flex;
            gap: 10px;
        }
        
        .search-bar input {
            flex: 1;
            padding: 12px 20px;
            border: 2px solid #eee;
            border-radius: 30px;
            font-size: 16px;
            outline: none;
        }
        
        .search-bar input:focus { border-color: #FF8C00; }
        
        .search-bar button {
            background: #FF8C00;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            cursor: pointer;
            font-weight: bold;
        }
        
        /* Enhanced Footer */
        footer {
            background: #1a1a2e;
            color: white;
            padding: 50px 40px 20px;
            margin-top: 60px;
        }
        
        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }
        
        .footer-section h3 {
            color: #FF8C00;
            margin-bottom: 20px;
            font-size: 18px;
        }
        
        .footer-section p {
            color: #aaa;
            line-height: 1.8;
            margin: 8px 0;
        }
        
        .footer-section .contact-info p {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }
        
        .social-links a {
            color: white;
            background: rgba(255,255,255,0.1);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: 0.3s;
        }
        
        .social-links a:hover {
            background: #FF8C00;
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #888;
            font-size: 12px;
        }
        
        @media (max-width: 768px) {
            header { flex-direction: column; gap: 15px; text-align: center; }
            .slide-overlay h1 { font-size: 28px; }
            .hero-slideshow { height: 350px; }
            .products-grid { grid-template-columns: 1fr; }
            .cart-sidebar { width: 100%; right: -100%; }
            .footer-container { grid-template-columns: 1fr; text-align: center; }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="logo-img" onerror="this.src='https://placehold.co/50x50?text=YE'">
            <div class="logo-text">
                <h1>Norphel Bangzay</h1>
                <span>Find the Perfect Gift</span>
            </div>
        </div>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/') }}#branches">Our Branches</a>
            <a onclick="scrollToOrders()">📋 My Orders</a>
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

    <div class="hero-slideshow">
        <div class="slideshow-container">
            <div class="slide active" style="background-image: url('{{ asset('images/giftshop/slide1.jpg') }}');">
                <div class="slide-overlay">
                    <h1>🎁 Norphel Bangzay</h1>
                    <p>Find the perfect gift for your loved ones</p>
                </div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('images/giftshop/slide2.jpg') }}');">
                <div class="slide-overlay">
                    <h1>🇧🇹 Traditional Bhutanese Crafts</h1>
                    <p>Authentic handmade gifts and souvenirs</p>
                </div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('images/giftshop/slide3.jpg') }}');">
                <div class="slide-overlay">
                    <h1>🎀 Modern & Trendy Gifts</h1>
                    <p>Something special for everyone</p>
                </div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('images/giftshop/slide4.jpg') }}');">
                <div class="slide-overlay">
                    <h1>📿 Unique Souvenirs</h1>
                    <p>Memories that last a lifetime</p>
                </div>
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
        @auth
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="🔍 Search products..." onkeyup="filterProducts()">
                <button onclick="filterProducts()">Search</button>
            </div>
            
            <div class="category-filter" id="categoryFilter"></div>
            
            <div id="productsContainer"></div>

            <!-- My Orders Section -->
            <div class="orders-section" id="ordersSection">
                <div class="section-title">
                    📋 My Orders
                    <button class="view-orders-btn" onclick="refreshOrders()">🔄 Refresh Orders</button>
                </div>
                <div id="ordersList"></div>
            </div>
        @else
            <div class="login-prompt">
                <p>🔐 Please <a href="{{ route('login') }}">login</a> to browse our gift collection</p>
            </div>
        @endauth
    </div>

    @auth
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h3>🛒 Your Cart</h3>
            <button class="close-cart" onclick="closeCart()">×</button>
        </div>
        <div class="cart-items" id="cartItems">
            <div style="text-align: center; padding: 40px; color: #888;">Your cart is empty</div>
        </div>
        <div class="cart-footer">
            <div class="cart-total">
                <span>Total:</span>
                <span id="cartTotal">Nu. 0</span>
            </div>
            <button class="checkout-btn" onclick="placeOrder()">Place Order</button>
            <p style="font-size: 11px; color: #888; text-align: center; margin-top: 10px;">Pay at counter when you visit</p>
        </div>
    </div>

    <div class="cart-icon" onclick="openCart()">
        🛒
        <span class="cart-count" id="cartCount">0</span>
    </div>
    <div class="overlay" id="overlay" onclick="closeCart()"></div>

    <div class="modal" id="orderModal" style="max-width: 450px;">
        <span class="close-modal" onclick="closeOrderModal()">&times;</span>
        <h3>✅ Order Placed Successfully!</h3>
        <p>Your order has been recorded. Please visit Norphel Bangzay to make payment and collect your items.</p>
        <p style="font-size: 14px; margin-top: 15px;">📍 Yosel Enterprise, Dewathang</p>
        <p style="font-size: 14px;">📞 77299776 / 77827571</p>
        <button onclick="closeOrderModal()">Close</button>
    </div>
    @endauth

    <!-- Enhanced Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>🏪 Norphel Bangzay</h3>
                <p>Your one-stop gift shop in Dewathang</p>
                <p>Quality products at affordable prices</p>
                <p>Find the perfect gift for your loved ones</p>
                <div class="social-links">
                    <a href="#">📘</a>
                    <a href="#">📷</a>
                    <a href="#">📞</a>
                </div>
            </div>
            <div class="footer-section">
                <h3>📞 Contact Us</h3>
                <div class="contact-info">
                    <p>📱 +975 77299776</p>
                    <p>📱 +975 77827571</p>
                    <p>📍 Yosel Enterprise, Dewathang</p>
                    <p>🇧🇹 Bhutan</p>
                </div>
            </div>
            <div class="footer-section">
                <h3>🕒 Opening Hours</h3>
                <p>Monday - Saturday: 9:00 AM - 7:00 PM</p>
                <p>Sunday: 10:00 AM - 5:00 PM</p>
                <p>Closed on Public Holidays</p>
            </div>
            <div class="footer-section">
                <h3>📧 Email Us</h3>
                <p>norphelbangzay@yosel.bt</p>
                <p>support@yosel.bt</p>
                <p>📦 Free local delivery on orders above Nu. 5000</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Norphel Bangzay - Yosel Enterprise. All rights reserved. | Dewathang, Bhutan</p>
        </div>
    </footer>

    @auth
    <script>
        // ============ ALL PRODUCTS ============
        const allProducts = [
            { id: 1, name: "Baby Blanket", price: 750, quantity: 6, category: "Baby", desc: "Soft cozy baby blanket", img: "/images/products/baby-blanket.jpg", defaultImg: "🛏️" },
            { id: 2, name: "Baby Feeding Bottle", price: 150, quantity: 50, category: "Baby", desc: "BPA free feeding bottle", img: "/images/products/baby-bottle.jpg", defaultImg: "🍼" },
            { id: 3, name: "Baby Toothbrush", price: 60, quantity: 13, category: "Baby", desc: "Soft silicone toothbrush", img: "/images/products/baby-toothbrush.jpg", defaultImg: "🪥" },
            { id: 4, name: "Baby Fruit Feeder", price: 229, quantity: 6, category: "Baby", desc: "Mesh fruit feeder", img: "/images/products/baby-feeder.jpg", defaultImg: "🍎" },
            { id: 5, name: "Baby Hat", price: 180, quantity: 27, category: "Baby", desc: "Cute baby hat", img: "/images/products/baby-hat.jpg", defaultImg: "🧢" },
            { id: 6, name: "Baby Leggings", price: 650, quantity: 14, category: "Baby", desc: "Stretchable leggings", img: "/images/products/baby-leggings.jpg", defaultImg: "👖" },
            { id: 7, name: "Baby Potty", price: 850, quantity: 8, category: "Baby", desc: "Training potty seat", img: "/images/products/baby-potty.jpg", defaultImg: "🚽" },
            { id: 8, name: "Baby Sleeping Bag", price: 650, quantity: 7, category: "Baby", desc: "Warm sleeping bag", img: "/images/products/baby-sleeping-bag.jpg", defaultImg: "🛌" },
            { id: 9, name: "Baby Shoes", price: 350, quantity: 24, category: "Baby", desc: "Soft sole shoes", img: "/images/products/baby-shoes.jpg", defaultImg: "👟" },
            { id: 10, name: "Baby Wipes", price: 99, quantity: 24, category: "Baby", desc: "Soft baby wipes", img: "/images/products/baby-wipes.jpg", defaultImg: "🧻" },
            { id: 11, name: "Momy Poko L22", price: 399, quantity: 40, category: "Baby", desc: "L size 22 pcs", img: "/images/products/diapers.jpg", defaultImg: "📦" },
            { id: 12, name: "Baby Winter Suit", price: 1750, quantity: 12, category: "Baby", desc: "Warm winter suit", img: "/images/products/baby-winter-suit.jpg", defaultImg: "🧥" },
            { id: 13, name: "Milton Hot Case", price: 1500, quantity: 24, category: "Kitchen", desc: "Steel hot case large", img: "/images/products/milton-case.jpg", defaultImg: "🍱" },
            { id: 14, name: "Milton Flask", price: 930, quantity: 24, category: "Kitchen", desc: "Vacuum flask", img: "/images/products/milton-flask.jpg", defaultImg: "🧴" },
            { id: 15, name: "Thai Plates", price: 350, quantity: 80, category: "Kitchen", desc: "Beautiful Thai plates", img: "/images/products/thai-plates.jpg", defaultImg: "🍽️" },
            { id: 16, name: "Special Mugs", price: 1600, quantity: 30, category: "Kitchen", desc: "Premium mugs", img: "/images/products/mugs.jpg", defaultImg: "☕" },
            { id: 17, name: "Lunch Box", price: 1800, quantity: 11, category: "Kitchen", desc: "Insulated lunch box", img: "/images/products/lunch-box.jpg", defaultImg: "🍱" },
            { id: 18, name: "Kitchen Scissors", price: 369, quantity: 24, category: "Kitchen", desc: "Multi-purpose", img: "/images/products/scissors.jpg", defaultImg: "✂️" },
            { id: 19, name: "Spoon & Fork Set", price: 120, quantity: 200, category: "Kitchen", desc: "Steel set", img: "/images/products/spoon-fork.jpg", defaultImg: "🥄" },
            { id: 20, name: "Dish Washing Liquid", price: 90, quantity: 65, category: "Kitchen", desc: "150gm dish wash", img: "/images/products/dish-wash.jpg", defaultImg: "🧼" },
            { id: 21, name: "Hair Dryer", price: 1500, quantity: 5, category: "Beauty", desc: "Professional hair dryer", img: "/images/products/hair-dryer.jpg", defaultImg: "💨" },
            { id: 22, name: "Hair Brush", price: 150, quantity: 36, category: "Beauty", desc: "Styling brush", img: "/images/products/hair-brush.jpg", defaultImg: "🪮" },
            { id: 23, name: "Nail Polish", price: 100, quantity: 150, category: "Beauty", desc: "Premium nail polish", img: "/images/products/nail-polish.jpg", defaultImg: "💅" },
            { id: 24, name: "Facial Wipes", price: 180, quantity: 150, category: "Beauty", desc: "Cleansing wipes", img: "/images/products/facial-wipes.jpg", defaultImg: "🧻" },
            { id: 25, name: "Tooth Brush", price: 90, quantity: 300, category: "Beauty", desc: "Soft bristle", img: "/images/products/toothbrush.jpg", defaultImg: "🪥" },
            { id: 26, name: "Wall Hook", price: 200, quantity: 450, category: "Home", desc: "Adhesive hook", img: "/images/products/wall-hook.jpg", defaultImg: "📌" },
            { id: 27, name: "Laundry Basket", price: 1580, quantity: 8, category: "Home", desc: "Large basket", img: "/images/products/laundry-basket.jpg", defaultImg: "🧺" },
            { id: 28, name: "Spin Mop", price: 1350, quantity: 10, category: "Home", desc: "Mop with bucket", img: "/images/products/spin-mop.jpg", defaultImg: "🧹" },
            { id: 29, name: "Large Towel", price: 850, quantity: 36, category: "Home", desc: "Bath towel", img: "/images/products/towel.jpg", defaultImg: "🧣" },
            { id: 30, name: "School Bag", price: 1450, quantity: 40, category: "Home", desc: "Backpack", img: "/images/products/school-bag.jpg", defaultImg: "🎒" },
            { id: 31, name: "Computer Desktop", price: 45000, quantity: 1, category: "Electronics", desc: "Desktop computer", img: "/images/products/computer.jpg", defaultImg: "💻" },
            { id: 32, name: "HP Printer", price: 35000, quantity: 1, category: "Electronics", desc: "Multi-function", img: "/images/products/printer.jpg", defaultImg: "🖨️" },
            { id: 33, name: "Air Conditioner", price: 45000, quantity: 2, category: "Electronics", desc: "Split AC", img: "/images/products/ac.jpg", defaultImg: "❄️" },
            { id: 34, name: "Mens Shorts", price: 850, quantity: 4, category: "Clothing", desc: "Casual shorts", img: "/images/products/mens-shorts.jpg", defaultImg: "🩳" },
            { id: 35, name: "Ladies Leggings", price: 500, quantity: 50, category: "Clothing", desc: "Stretch leggings", img: "/images/products/leggings.jpg", defaultImg: "👖" },
            { id: 36, name: "Kids Tshirt", price: 600, quantity: 20, category: "Clothing", desc: "Cotton t-shirt", img: "/images/products/kids-tshirt.jpg", defaultImg: "👕" },
            { id: 37, name: "Robot Car", price: 320, quantity: 6, category: "Toys", desc: "Transformable", img: "/images/products/robot-car.jpg", defaultImg: "🚗" },
            { id: 38, name: "Rubik Cube", price: 200, quantity: 10, category: "Toys", desc: "Puzzle cube", img: "/images/products/cube.jpg", defaultImg: "🧩" },
            { id: 39, name: "Balloon", price: 10, quantity: 200, category: "Toys", desc: "Party balloons", img: "/images/products/balloon.jpg", defaultImg: "🎈" },
        ];

        let currentUser = null;
        let isAdmin = false;
        let cart = [];
        let orders = [];
        let currentCategory = "all";
        let searchTerm = "";

        function loadData() {
            const savedUser = localStorage.getItem('giftShopUser');
            if (savedUser) {
                currentUser = JSON.parse(savedUser);
                isAdmin = currentUser.email === 'admin@norphel.bt';
            }
            const savedOrders = localStorage.getItem('giftShopOrders');
            if (savedOrders) {
                orders = JSON.parse(savedOrders);
                displayOrders();
            }
            const savedCart = localStorage.getItem('giftShopCart');
            if (savedCart) {
                cart = JSON.parse(savedCart);
                updateCart();
            }
            displayProducts();
        }

        function saveOrders() {
            localStorage.setItem('giftShopOrders', JSON.stringify(orders));
        }

        function saveCart() {
            localStorage.setItem('giftShopCart', JSON.stringify(cart));
        }

        function displayProducts() {
            let filtered = [...allProducts];
            if (currentCategory !== 'all') {
                filtered = filtered.filter(p => p.category === currentCategory);
            }
            if (searchTerm) {
                filtered = filtered.filter(p => 
                    p.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                    p.category.toLowerCase().includes(searchTerm.toLowerCase())
                );
            }
            
            const container = document.getElementById('productsContainer');
            if (!container) return;
            
            if (filtered.length === 0) {
                container.innerHTML = '<div style="text-align:center; padding:60px; background:white; border-radius:20px;">No products found.</div>';
                return;
            }
            
            container.innerHTML = `
                <div class="category-section">
                    <h2 class="category-title">${currentCategory === "all" ? "All Products" : currentCategory + " Products"} (${filtered.length} items)</h2>
                    <div class="products-grid">
                        ${filtered.map(product => `
                            <div class="product-card">
                                <div class="product-image">
                                    ${product.img ? `<img src="${product.img}" alt="${product.name}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">` : ''}
                                    <span style="${product.img ? 'display:none' : 'display:flex'}">${product.defaultImg}</span>
                                </div>
                                <div class="product-info">
                                    <div class="product-title">${product.name}</div>
                                    <div class="product-price">Nu. ${product.price}</div>
                                    <div class="product-desc">${product.desc}</div>
                                    <div class="product-stock ${product.quantity > 10 ? 'stock-in' : (product.quantity > 0 ? 'stock-low' : 'stock-out')}">
                                        ${product.quantity > 0 ? `📦 In stock: ${product.quantity}` : '❌ Out of stock'}
                                    </div>
                                    <button class="btn-add" onclick="addToCart(${product.id})" ${product.quantity === 0 ? 'disabled' : ''}>
                                        ${product.quantity > 0 ? 'Add to Cart 🛒' : 'Out of Stock'}
                                    </button>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;
        }

        function filterProducts() {
            searchTerm = document.getElementById('searchInput').value;
            displayProducts();
        }

        function showCategory(category) {
            currentCategory = category;
            displayProducts();
            document.querySelectorAll('.filter-btn').forEach(btn => {
                if (btn.dataset.category === category) btn.classList.add('active');
                else btn.classList.remove('active');
            });
        }

        function buildCategoryFilter() {
            const categories = ["all", "Baby", "Kitchen", "Beauty", "Home", "Electronics", "Clothing", "Toys"];
            const container = document.getElementById('categoryFilter');
            if (!container) return;
            container.innerHTML = categories.map(cat => `
                <button class="filter-btn ${cat === "all" ? "active" : ""}" data-category="${cat}" onclick="showCategory('${cat}')">${cat === "all" ? "All" : cat}</button>
            `).join('');
        }

        function findProductById(id) {
            return allProducts.find(p => p.id === id);
        }

        function addToCart(productId) {
            const product = findProductById(productId);
            if (!product || product.quantity === 0) {
                showNotification('Out of stock!', 'error');
                return;
            }
            const existing = cart.find(item => item.id === productId);
            if (existing) {
                if (existing.quantity + 1 > product.quantity) {
                    showNotification(`Only ${product.quantity} left!`, 'error');
                    return;
                }
                existing.quantity++;
            } else {
                cart.push({ ...product, quantity: 1 });
            }
            updateCart();
            saveCart();
            showNotification(`Added ${product.name}`, 'success');
        }

        function updateCart() {
            const cartContainer = document.getElementById('cartItems');
            const cartCount = document.getElementById('cartCount');
            const cartTotal = document.getElementById('cartTotal');
            if (!cartContainer) return;
            
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            if (cartCount) cartCount.textContent = totalItems;
            if (cartTotal) cartTotal.textContent = `Nu. ${totalPrice.toFixed(2)}`;
            
            if (cart.length === 0) {
                cartContainer.innerHTML = '<div style="text-align:center; padding:40px; color:#888;">Your cart is empty</div>';
                return;
            }
            
            cartContainer.innerHTML = cart.map(item => `
                <div class="cart-item">
                    <div class="cart-item-img">
                        ${item.img ? `<img src="${item.img}" onerror="this.style.display='none'; this.parentElement.innerHTML='${item.defaultImg}';">` : `<span>${item.defaultImg}</span>`}
                    </div>
                    <div class="cart-item-details">
                        <div class="cart-item-title">${item.name}</div>
                        <div class="cart-item-price">Nu. ${item.price}</div>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity - 1})">-</button>
                            <span>${item.quantity}</span>
                            <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function updateQuantity(id, newQuantity) {
            if (newQuantity <= 0) {
                cart = cart.filter(item => item.id !== id);
            } else {
                const product = findProductById(id);
                const item = cart.find(i => i.id === id);
                if (item && newQuantity <= product.quantity) {
                    item.quantity = newQuantity;
                } else {
                    showNotification(`Only ${product.quantity} available!`, 'error');
                    return;
                }
            }
            updateCart();
            saveCart();
        }

        function placeOrder() {
            if (cart.length === 0) {
                showNotification('Cart is empty!', 'error');
                return;
            }
            const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const order = {
                id: Date.now(),
                date: new Date().toLocaleString(),
                items: [...cart],
                total: totalPrice,
                status: 'pending'
            };
            orders.unshift(order);
            saveOrders();
            displayOrders();
            cart = [];
            updateCart();
            saveCart();
            displayProducts();
            const modal = document.getElementById('orderModal');
            if (modal) modal.style.display = 'block';
            showNotification('Order placed!', 'success');
        }

        function displayOrders() {
            const ordersContainer = document.getElementById('ordersList');
            if (!ordersContainer) return;
            
            if (orders.length === 0) {
                ordersContainer.innerHTML = '<div class="empty-orders">No orders yet. Start shopping!</div>';
                return;
            }
            
            ordersContainer.innerHTML = `
                <div class="orders-grid">
                    ${orders.map(order => `
                        <div class="order-card">
                            <div class="order-header">
                                <h4>Order #${order.id}</h4>
                                <span class="order-status status-${order.status}">${order.status === 'pending' ? 'Pending' : 'Confirmed'}</span>
                            </div>
                            <div class="order-body">
                                ${order.items.map(item => `<div class="order-item"><span>${item.name} x ${item.quantity}</span><span>Nu. ${(item.price * item.quantity).toFixed(2)}</span></div>`).join('')}
                                <div class="order-total"><span>Total:</span><span>Nu. ${order.total.toFixed(2)}</span></div>
                                <div class="order-date">📅 ${order.date}</div>
                            </div>
                        </div>
                    `).join('')}
                </div>
            `;
        }

        function refreshOrders() {
            displayOrders();
            showNotification('Orders refreshed!', 'success');
        }

        function scrollToOrders() {
            const ordersSection = document.getElementById('ordersSection');
            if (ordersSection) {
                ordersSection.scrollIntoView({ behavior: 'smooth' });
            }
        }

        function openCart() { 
            const sidebar = document.getElementById('cartSidebar');
            const overlay = document.getElementById('overlay');
            if (sidebar) sidebar.classList.add('open');
            if (overlay) overlay.classList.add('active');
        }
        
        function closeCart() { 
            const sidebar = document.getElementById('cartSidebar');
            const overlay = document.getElementById('overlay');
            if (sidebar) sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('active');
        }
        
        function closeOrderModal() { 
            const modal = document.getElementById('orderModal');
            if (modal) modal.style.display = 'none';
        }
        
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.style.cssText = `position:fixed; bottom:100px; right:30px; background:${type === 'success' ? '#28a745' : '#dc3545'}; color:white; padding:12px 20px; border-radius:10px; z-index:1002; animation:slideIn 0.3s ease;`;
            notification.textContent = message;
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 3000);
        }

        // Slideshow
        let slideIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');
        
        function showSlide(index) {
            if (!slides.length) return;
            slides.forEach(s => s.classList.remove('active'));
            dots.forEach(d => d.classList.remove('active'));
            slideIndex = index;
            if (slideIndex >= slides.length) slideIndex = 0;
            if (slideIndex < 0) slideIndex = slides.length - 1;
            if (slides[slideIndex]) slides[slideIndex].classList.add('active');
            if (dots[slideIndex]) dots[slideIndex].classList.add('active');
        }
        
        function changeSlide() { slideIndex++; showSlide(slideIndex); }
        function currentSlide(index) { showSlide(index); clearInterval(slideInterval); slideInterval = setInterval(changeSlide, 5000); }
        
        let slideInterval = setInterval(changeSlide, 5000);
        
        const style = document.createElement('style');
        style.textContent = `@keyframes slideIn { from { transform: translateX(100px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }`;
        document.head.appendChild(style);
        
        buildCategoryFilter();
        loadData();
    </script>
    @else
    <script>
        console.log('Please login to shop');
    </script>
    @endauth
</body>
</html>