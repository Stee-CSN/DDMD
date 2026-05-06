<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Yosel Enterprise - Amazon Style Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        body { background: #EAEDED; }
        
        /* ========== UNIFIED HEADER STYLES (Same as Admin Dashboard) ========== */
        .main-header {
            background-color: #222;
            color: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
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
        
        .search-bar {
            flex: 1;
            max-width: 500px;
            display: flex;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            margin: 0 20px;
        }
        
        .search-bar select {
            padding: 10px;
            border: none;
            background: #f3f3f3;
            font-size: 14px;
        }
        
        .search-bar input {
            flex: 1;
            padding: 10px;
            border: none;
            font-size: 14px;
        }
        
        .search-bar button {
            background: #FF8C00;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            color: #222;
        }
        
        .nav-links {
            display: flex;
            gap: 20px;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .nav-links a, .nav-links span {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }
        
        .nav-links a:hover { color: #FF8C00; }
        
        .cart-btn {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            position: relative;
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -12px;
            background: #FF8C00;
            color: #222;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 50%;
            font-weight: bold;
        }
        
        .logout-btn {
            background: #e74c3c;
            border: none;
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .logout-btn:hover { background: #c0392b; }
        
        /* Hero Banner with Slideshow */
        .hero-banner {
            position: relative;
            height: 400px;
            overflow: hidden;
        }
        
        .slideshow-container {
            position: relative;
            width: 100%;
            height: 100%;
        }
        
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
        
        .slide-content {
            position: absolute;
            bottom: 50px;
            left: 50px;
            background: rgba(0,0,0,0.6);
            color: white;
            padding: 20px 30px;
            border-radius: 8px;
            max-width: 500px;
        }
        
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
        
        /* Main Container */
        .main-container {
            display: flex;
            max-width: 1400px;
            margin: 20px auto;
            gap: 20px;
            padding: 0 20px;
        }
        
        .sidebar {
            width: 260px;
            background: white;
            border-radius: 8px;
            padding: 20px;
            height: fit-content;
            position: sticky;
            top: 80px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .sidebar h3 { margin-bottom: 15px; color: #222; border-left: 4px solid #FF8C00; padding-left: 10px; }
        .sidebar ul { list-style: none; }
        .sidebar li {
            padding: 10px 0;
            cursor: pointer;
            transition: 0.3s;
            border-bottom: 1px solid #eee;
        }
        .sidebar li:hover { color: #FF8C00; padding-left: 10px; }
        
        .products-container {
            flex: 1;
        }
        
        .products-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
        }
        
        .sort-select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }
        
        .product-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: 0.3s;
            position: relative;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        
        .product-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #FF8C00;
            color: #222;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            z-index: 1;
        }
        
        .product-img {
            height: 180px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }
        
        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .product-info { padding: 15px; }
        .product-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 40px;
        }
        
        .product-rating {
            color: #FFA41C;
            margin: 5px 0;
            font-size: 12px;
        }
        
        .product-price {
            font-size: 18px;
            font-weight: bold;
            color: #B12704;
            margin: 8px 0;
        }
        
        .btn-add {
            background: #FFD814;
            border: none;
            width: 100%;
            padding: 10px;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        
        .btn-add:hover { background: #F7CA00; }
        .btn-add:disabled { background: #ccc; cursor: not-allowed; }
        
        /* Cart Sidebar */
        .cart-sidebar {
            position: fixed;
            right: -450px;
            top: 0;
            width: 450px;
            height: 100vh;
            background: white;
            box-shadow: -5px 0 30px rgba(0,0,0,0.3);
            z-index: 1001;
            transition: 0.3s;
            display: flex;
            flex-direction: column;
        }
        
        .cart-sidebar.open { right: 0; }
        
        .cart-header {
            background: #222;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }
        
        .cart-items { flex: 1; overflow-y: auto; padding: 20px; }
        .cart-footer { padding: 20px; border-top: 1px solid #ddd; }
        
        /* Modals */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 12px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            z-index: 1002;
        }
        
        .modal.active { display: block; }
        
        .star-rating { font-size: 30px; cursor: pointer; color: #ddd; margin-bottom: 15px; }
        .star-rating .star:hover, .star-rating .star.active { color: #FFA41C; }
        
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
        }
        
        .overlay.active { display: block; }
        
        /* Orders Section */
        .orders-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
        }
        
        .order-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }
        
        .status-pending { background: #fff3cd; color: #856404; padding: 4px 12px; border-radius: 20px; font-size: 12px; display: inline-block; }
        .status-confirmed { background: #d4edda; color: #155724; padding: 4px 12px; border-radius: 20px; font-size: 12px; display: inline-block; }
        .status-cancelled { background: #f8d7da; color: #721c24; padding: 4px 12px; border-radius: 20px; font-size: 12px; display: inline-block; }
        
        .cancel-order-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 5px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }
        
        .feedback-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        
        .feedback-card {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }
        
        /* Footer */
        .footer {
            background: #222;
            color: white;
            margin-top: 50px;
            padding: 40px 40px 20px;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }
        
        .footer h4 { margin-bottom: 15px; color: #FF8C00; }
        .footer a { color: #ccc; text-decoration: none; display: block; margin-bottom: 8px; }
        .footer a:hover { color: #FF8C00; }
        .footer-bottom { text-align: center; padding-top: 30px; margin-top: 30px; border-top: 1px solid #333; }
        
        /* Image Upload Modal */
        .image-upload-area {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
        }
        
        .image-upload-area:hover { border-color: #FF8C00; }
        
        .product-img-preview {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        @media (max-width: 768px) {
            .main-container { flex-direction: column; }
            .sidebar { width: 100%; position: static; }
            .cart-sidebar { width: 100%; right: -100%; }
            .hero-banner { height: 300px; }
            .slide-content { left: 20px; right: 20px; bottom: 20px; }
            .main-header { padding: 15px 20px; }
            .search-bar { margin: 10px 0; max-width: 100%; }
        }
    </style>
</head>
<body>
    <!-- UNIFIED HEADER (Same as Admin Dashboard) -->
    <header class="main-header">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="logo-img" onerror="this.src='https://placehold.co/50x50?text=YE'">
            <div class="logo-text">
                <h1>Yosel Enterprise</h1>
                <span>Store</span>
            </div>
        </a>
        
        <div class="search-bar">
            <select id="categorySelect">
                <option value="all">All Categories</option>
                <option value="grocery">Groceries</option>
                <option value="beauty">Beauty & Cosmetics</option>
                <option value="household">Household</option>
                <option value="beverage">Beverages</option>
                <option value="stationery">Stationery</option>
            </select>
            <input type="text" id="searchInput" placeholder="Search products...">
            <button onclick="searchProducts()"><i class="fas fa-search"></i></button>
        </div>
        
        <div class="nav-links">
            @auth
                <span>👋 {{ Auth::user()->name }}</span>
                <a href="{{ route('profile') }}"><i class="fas fa-user-circle"></i> Profile</a>
                <a href="#" onclick="scrollToOrders()"><i class="fas fa-box"></i> Orders</a>
                <a href="#" onclick="showFeedbackModal()"><i class="fas fa-star"></i> Rate Us</a>
                @if(Auth::user()->is_admin == 1 || Auth::user()->role == 'admin')
                    <a href="{{ url('/admin/dashboard') }}"><i class="fas fa-chart-line"></i> Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Sign In</a>
                <a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Register</a>
            @endauth
            <button class="cart-btn" onclick="openCart()">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count" id="cartCount">0</span>
            </button>
        </div>
    </header>
    
    <!-- Hero Slideshow Banner -->
    <div class="hero-banner">
        <div class="slideshow-container">
            <div class="slide active" style="background-image: url('{{ asset('images/enterprise/slide1.jpg') }}');">
                <div class="slide-content">
                    <h2>Welcome to Yosel Enterprise</h2>
                    <p>Your one-stop shop for quality products</p>
                </div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('images/enterprise/slide2.jpg') }}');">
                <div class="slide-content">
                    <h2>Latest Arrivals</h2>
                    <p>Discover our new collection</p>
                </div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('images/enterprise/slide3.jpg') }}');">
                <div class="slide-content">
                    <h2>Free Delivery</h2>
                    <p>Available in Samdrup Jongkhar</p>
                </div>
            </div>
            <div class="slide-dots">
                <span class="dot active" onclick="currentSlide(0)"></span>
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
            </div>
        </div>
    </div>
    
    <div class="main-container">
        <!-- Sidebar Categories -->
        <div class="sidebar">
            <h3>📂 Shop by Category</h3>
            <ul>
                <li onclick="filterByCategory('all')"><i class="fas fa-th-large"></i> All Products</li>
                <li onclick="filterByCategory('grocery')"><i class="fas fa-utensils"></i> Grocery & Food</li>
                <li onclick="filterByCategory('beauty')"><i class="fas fa-heart"></i> Beauty & Cosmetics</li>
                <li onclick="filterByCategory('household')"><i class="fas fa-home"></i> Household</li>
                <li onclick="filterByCategory('beverage')"><i class="fas fa-wine-bottle"></i> Beverages</li>
                <li onclick="filterByCategory('stationery')"><i class="fas fa-pen"></i> Stationery</li>
            </ul>
            <hr style="margin: 15px 0;">
            <h3>⭐ Customer Rating</h3>
            <div id="averageRatingDisplay">4.8 ★ (245+ reviews)</div>
        </div>
        
        <div class="products-container">
            <div class="products-header">
                <h2 id="categoryTitle">All Products</h2>
                <select class="sort-select" id="sortSelect" onchange="sortProducts()">
                    <option value="default">Sort by: Featured</option>
                    <option value="price_asc">Price: Low to High</option>
                    <option value="price_desc">Price: High to Low</option>
                    <option value="name_asc">Name: A to Z</option>
                </select>
            </div>
            <div class="products-grid" id="productsGrid">
                <div style="text-align:center; padding:50px;">Loading products...</div>
            </div>
        </div>
    </div>
    
    <!-- My Orders Section -->
    <div class="main-container" id="myOrdersSection" style="margin-top: 0;">
        <div class="products-container">
            <div class="orders-section">
                <h2 style="color:#FF8C00; margin-bottom:20px;"><i class="fas fa-box"></i> My Orders</h2>
                <div id="ordersList">
                    <div style="text-align:center; padding:40px;">Loading orders...</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Customer Feedbacks Section -->
    <div class="main-container">
        <div class="products-container">
            <div class="feedback-section">
                <h2 style="color:#FF8C00; margin-bottom:20px;"><i class="fas fa-star"></i> Customer Reviews</h2>
                <div id="feedbacksList"></div>
            </div>
        </div>
    </div>
    
    <!-- Cart Sidebar -->
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h3><i class="fas fa-shopping-cart"></i> Shopping Cart</h3>
            <button onclick="closeCart()" style="background:none; border:none; color:white; font-size:24px;">×</button>
        </div>
        <div class="cart-items" id="cartItems"></div>
        <div class="cart-footer">
            <div class="cart-total" style="display:flex; justify-content:space-between; margin-bottom:15px;">
                <strong>Subtotal:</strong>
                <strong id="cartTotal">Nu. 0</strong>
            </div>
            <button class="btn-add" onclick="checkout()" style="background:#FF8C00; color:white;"><i class="fas fa-credit-card"></i> Proceed to Checkout</button>
            <p style="font-size:11px; color:#888; text-align:center; margin-top:10px;">🚚 Delivery only in Samdrup Jongkhar</p>
        </div>
    </div>
    
    <!-- Address Modal -->
    <div class="modal" id="addressModal">
        <h3 style="color:#FF8C00;"><i class="fas fa-map-marker-alt"></i> Delivery Address</h3>
        <p style="color:#e74c3c; margin-bottom:15px;">⚠️ Delivery available only in Samdrup Jongkhar</p>
        <div class="form-group" style="margin-bottom:15px;">
            <label>Dzongkhag *</label>
            <select id="deliveryLocation" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px;">
                <option value="">Select Dzongkhag</option>
                <option value="Samdrup Jongkhar">Samdrup Jongkhar ✅</option>
                <option value="Other">Other (Not Available)</option>
            </select>
        </div>
        <div class="form-group" style="margin-bottom:15px;">
            <label>Full Address *</label>
            <textarea id="deliveryAddress" rows="3" placeholder="House number, village, gewog" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px;"></textarea>
        </div>
        <div style="display:flex; gap:10px;">
            <button onclick="confirmOrder()" style="flex:1; background:#FF8C00; padding:12px; border:none; border-radius:8px; cursor:pointer; font-weight:bold;"><i class="fas fa-check"></i> Confirm Order</button>
            <button onclick="closeAddressModal()" style="flex:1; background:#ccc; padding:12px; border:none; border-radius:8px; cursor:pointer;">Cancel</button>
        </div>
    </div>
    
    <!-- Feedback Modal -->
    <div class="modal" id="feedbackModal">
        <h3 style="color:#FF8C00;"><i class="fas fa-star"></i> Rate Your Experience</h3>
        <p>Your feedback helps us improve!</p>
        <div class="star-rating" id="starRating">
            <span class="star" data-rating="1" onclick="setRating(1)">★</span>
            <span class="star" data-rating="2" onclick="setRating(2)">★</span>
            <span class="star" data-rating="3" onclick="setRating(3)">★</span>
            <span class="star" data-rating="4" onclick="setRating(4)">★</span>
            <span class="star" data-rating="5" onclick="setRating(5)">★</span>
        </div>
        <textarea id="feedbackText" rows="4" placeholder="Share your experience with us..." style="width:100%; margin:15px 0; padding:10px; border-radius:8px;"></textarea>
        <div style="display:flex; gap:10px;">
            <button onclick="submitFeedback()" style="flex:1; background:#FF8C00; padding:12px; border:none; border-radius:8px; cursor:pointer; font-weight:bold;"><i class="fas fa-paper-plane"></i> Submit</button>
            <button onclick="closeFeedbackModal()" style="flex:1; background:#ccc; padding:12px; border:none; border-radius:8px; cursor:pointer;">Cancel</button>
        </div>
    </div>
    
    <!-- Add Product Modal (Admin Only) -->
    <div class="modal" id="addProductModal">
        <h3 style="color:#FF8C00;"><i class="fas fa-plus-circle"></i> Add New Product</h3>
        <form id="addProductForm" enctype="multipart/form-data">
            <div class="form-group" style="margin-bottom:15px;">
                <label>Product Name *</label>
                <input type="text" id="productName" required style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px;">
            </div>
            <div class="form-group" style="margin-bottom:15px;">
                <label>Category *</label>
                <select id="productCategory" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px;">
                    <option value="grocery">Groceries</option>
                    <option value="beauty">Beauty & Cosmetics</option>
                    <option value="household">Household</option>
                    <option value="beverage">Beverages</option>
                    <option value="stationery">Stationery</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom:15px;">
                <label>Price (Nu.) *</label>
                <input type="number" id="productPrice" required style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px;">
            </div>
            <div class="form-group" style="margin-bottom:15px;">
                <label>Stock *</label>
                <input type="number" id="productStock" value="10" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px;">
            </div>
            <div class="form-group" style="margin-bottom:15px;">
                <label>Product Image</label>
                <div class="image-upload-area" onclick="document.getElementById('productImageInput').click()">
                    <i class="fas fa-cloud-upload-alt" style="font-size: 40px; color: #FF8C00;"></i>
                    <p>Click to upload product image</p>
                    <input type="file" id="productImageInput" accept="image/*" style="display:none;" onchange="previewProductImage(this)">
                </div>
                <img id="productImagePreview" class="product-img-preview" style="display:none; margin-top:10px;">
            </div>
            <div style="display:flex; gap:10px;">
                <button type="button" onclick="saveNewProduct()" style="flex:1; background:#FF8C00; padding:12px; border:none; border-radius:8px; cursor:pointer; font-weight:bold;">Add Product</button>
                <button type="button" onclick="closeAddProductModal()" style="flex:1; background:#ccc; padding:12px; border:none; border-radius:8px; cursor:pointer;">Cancel</button>
            </div>
        </form>
    </div>
    
    <div id="overlay" class="overlay" onclick="closeAllModals()"></div>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div>
                <h4><i class="fas fa-store"></i> Yosel Enterprise</h4>
                <p>Your trusted partner for quality products in Dewathang, Samdrup Jongkhar.</p>
            </div>
            <div>
                <h4><i class="fas fa-link"></i> Quick Links</h4>
                <a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a>
                <a href="{{ url('/restaurant') }}"><i class="fas fa-utensils"></i> Restaurant</a>
                <a href="{{ url('/giftshop') }}"><i class="fas fa-gift"></i> Gift Shop</a>
                <a href="{{ url('/snooker') }}"><i class="fas fa-table-tennis"></i> Snooker Club</a>
                <a href="{{ url('/shop') }}"><i class="fas fa-shopping-cart"></i> Enterprise Store</a>
            </div>
            <div>
                <h4><i class="fas fa-phone"></i> Contact Us</h4>
                <p><i class="fas fa-phone-alt"></i> 77299776 / 77827571</p>
                <p><i class="fas fa-envelope"></i> yosel@enterprise.bt</p>
                <p><i class="fas fa-clock"></i> Mon-Sat: 9:00 AM - 8:00 PM</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Yosel Enterprise. All rights reserved.</p>
        </div>
    </footer>
    
    <script>
        // ========== COMPLETE PRODUCTS DATABASE WITH IMAGES ==========
        let products = [
            { id: 1, name: "11000 Can Beer", price: 1580, category: "beverage", stock: 11, rating: 4.5, reviews: 12, image: "https://images.unsplash.com/photo-1535958636474-b421ee882fde?w=200&h=180&fit=crop" },
            { id: 2, name: "2X Spicy Noodles", price: 3200, category: "grocery", stock: 6, rating: 4.8, reviews: 45, image: "https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=200&h=180&fit=crop" },
            { id: 3, name: "Atta (Flour)", price: 40, category: "grocery", stock: 5, rating: 4.0, reviews: 50, image: "https://images.unsplash.com/photo-1586201375761-83865001e8ac?w=200&h=180&fit=crop" },
            { id: 4, name: "Butter", price: 450, category: "grocery", stock: 1, rating: 4.3, reviews: 31, image: "https://images.unsplash.com/photo-1589985270953-4ef82f3d48d2?w=200&h=180&fit=crop" },
            { id: 5, name: "Cheese Slice", price: 163, category: "grocery", stock: 180, rating: 4.6, reviews: 56, image: "https://images.unsplash.com/photo-1486297678162-eb2a19b0a32d?w=200&h=180&fit=crop" },
            { id: 6, name: "Dairy Milk Silk", price: 100, category: "grocery", stock: 18, rating: 4.8, reviews: 123, image: "https://images.unsplash.com/photo-1548907040-4baa42e1096d?w=200&h=180&fit=crop" },
            { id: 7, name: "Horlicks", price: 264, category: "grocery", stock: 14, rating: 4.6, reviews: 45, image: "https://images.unsplash.com/photo-1594470114976-a0b9ea88d228?w=200&h=180&fit=crop" },
            { id: 8, name: "Coke 1.5L", price: 60, category: "beverage", stock: 40, rating: 4.7, reviews: 89, image: "https://images.unsplash.com/photo-1629203851122-3726ecdf080e?w=200&h=180&fit=crop" },
            { id: 9, name: "Fanta", price: 60, category: "beverage", stock: 12, rating: 4.5, reviews: 56, image: "https://images.unsplash.com/photo-1625772299848-5b3e5f3a5b5e?w=200&h=180&fit=crop" },
            { id: 10, name: "Breezer", price: 105, category: "beverage", stock: 100, rating: 4.6, reviews: 67, image: "https://images.unsplash.com/photo-1622484215145-4aa6c6b42a29?w=200&h=180&fit=crop" },
            { id: 11, name: "16 Color Eyeshadow", price: 190, category: "beauty", stock: 10, rating: 4.6, reviews: 45, image: "https://images.unsplash.com/photo-1512499617640-c74ae3a79d37?w=200&h=180&fit=crop" },
            { id: 12, name: "4K Day Cream", price: 375, category: "beauty", stock: 4, rating: 4.4, reviews: 34, image: "https://images.unsplash.com/photo-1556228578-8d89f6a3b6b3?w=200&h=180&fit=crop" },
            { id: 13, name: "Aloe Vera Body Lotion", price: 95, category: "beauty", stock: 48, rating: 4.3, reviews: 56, image: "https://images.unsplash.com/photo-1616394584738-fc6e612e71b9?w=200&h=180&fit=crop" },
            { id: 14, name: "Dove Shampoo", price: 375, category: "beauty", stock: 36, rating: 4.7, reviews: 67, image: "https://images.unsplash.com/photo-1599576995890-6b21a9659bd8?w=200&h=180&fit=crop" },
            { id: 15, name: "Colgate Herbal", price: 105, category: "beauty", stock: 60, rating: 4.6, reviews: 45, image: "https://images.unsplash.com/photo-1585255601933-6d3d6b9f6b6b?w=200&h=180&fit=crop" },
            { id: 16, name: "Dettol Soap", price: 40, category: "beauty", stock: 80, rating: 4.8, reviews: 123, image: "https://images.unsplash.com/photo-1616394584738-fc6e612e71b9?w=200&h=180&fit=crop" },
            { id: 17, name: "Harpic Blue", price: 105, category: "household", stock: 69, rating: 4.7, reviews: 56, image: "https://images.unsplash.com/photo-1584568694244-14fbdf83bd30?w=200&h=180&fit=crop" },
            { id: 18, name: "Henko Surf", price: 215, category: "household", stock: 72, rating: 4.6, reviews: 67, image: "https://images.unsplash.com/photo-1585155770447-2f66e5db6b3b?w=200&h=180&fit=crop" },
            { id: 19, name: "Cello Pen", price: 20, category: "stationery", stock: 170, rating: 4.5, reviews: 45, image: "https://images.unsplash.com/photo-1586953208448-b95a79798f07?w=200&h=180&fit=crop" },
            { id: 20, name: "Notebook", price: 90, category: "stationery", stock: 55, rating: 4.3, reviews: 34, image: "https://images.unsplash.com/photo-1531346878377-a5be20888e57?w=200&h=180&fit=crop" }
        ];
        
        let cart = [];
        let currentRating = 0;
        let currentCategory = 'all';
        let currentSort = 'default';
        let currentSearch = '';
        let slideIndex = 0;
        
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');
        
        function showSlide(index) {
            slides.forEach(s => s.classList.remove('active'));
            dots.forEach(d => d.classList.remove('active'));
            slideIndex = index;
            if (slideIndex >= slides.length) slideIndex = 0;
            if (slideIndex < 0) slideIndex = slides.length - 1;
            slides[slideIndex].classList.add('active');
            dots[slideIndex].classList.add('active');
        }
        
        function changeSlide() { slideIndex++; showSlide(slideIndex); }
        function currentSlide(index) { showSlide(index); clearInterval(slideInterval); slideInterval = setInterval(changeSlide, 5000); }
        let slideInterval = setInterval(changeSlide, 5000);
        
        function loadProducts() {
            let filtered = [...products];
            if (currentCategory !== 'all') {
                filtered = filtered.filter(p => p.category === currentCategory);
            }
            if (currentSearch) {
                filtered = filtered.filter(p => p.name.toLowerCase().includes(currentSearch.toLowerCase()));
            }
            if (currentSort === 'price_asc') {
                filtered.sort((a, b) => a.price - b.price);
            } else if (currentSort === 'price_desc') {
                filtered.sort((a, b) => b.price - a.price);
            } else if (currentSort === 'name_asc') {
                filtered.sort((a, b) => a.name.localeCompare(b.name));
            }
            
            const grid = document.getElementById('productsGrid');
            if (filtered.length === 0) {
                grid.innerHTML = '<div style="text-align:center; padding:50px;">No products found</div>';
                return;
            }
            grid.innerHTML = filtered.map(p => `
                <div class="product-card">
                    ${p.stock <= 0 ? '<div class="product-badge">Out of Stock</div>' : ''}
                    <div class="product-img">
                        <img src="${p.image}" alt="${p.name}" onerror="this.src='https://placehold.co/200x180?text=${p.name.charAt(0)}'">
                    </div>
                    <div class="product-info">
                        <div class="product-title">${p.name}</div>
                        <div class="product-rating">${'★'.repeat(Math.floor(p.rating))}${p.rating % 1 >= 0.5 ? '½' : ''} (${p.reviews})</div>
                        <div class="product-price"><small>Nu.</small> ${p.price.toLocaleString()}</div>
                        ${p.stock > 0 ? `<button class="btn-add" onclick="addToCart(${p.id})">Add to Cart</button>` : '<button class="btn-add" disabled>Out of Stock</button>'}
                    </div>
                </div>
            `).join('');
        }
        
        function addToCart(productId) {
            const product = products.find(p => p.id === productId);
            if (product && product.stock <= 0) {
                Swal.fire('Error', 'Product is out of stock!', 'error');
                return;
            }
            const existing = cart.find(c => c.id === productId);
            if (existing) {
                existing.quantity++;
            } else {
                cart.push({ ...product, quantity: 1 });
            }
            updateCart();
            Swal.fire({icon:'success', title:'Added!', text:`${product.name} added to cart`, toast:true, position:'top-end', showConfirmButton:false, timer:1500});
        }
        
        function updateCart() {
            const total = cart.reduce((sum, i) => sum + (i.price * i.quantity), 0);
            const items = cart.reduce((sum, i) => sum + i.quantity, 0);
            document.getElementById('cartCount').innerText = items;
            document.getElementById('cartTotal').innerText = `Nu. ${total.toLocaleString()}`;
            
            const container = document.getElementById('cartItems');
            if (cart.length === 0) {
                container.innerHTML = '<div style="text-align:center;padding:40px;">Your cart is empty</div>';
                return;
            }
            container.innerHTML = cart.map(i => `
                <div style="display:flex; gap:12px; padding:12px 0; border-bottom:1px solid #eee;">
                    <img src="${i.image}" style="width:50px; height:50px; object-fit:cover; border-radius:8px;">
                    <div style="flex:1;">
                        <div style="font-weight:bold;">${i.name}</div>
                        <div style="color:#B12704;">Nu. ${i.price}</div>
                        <div style="display:flex; gap:10px; margin-top:8px;">
                            <button onclick="updateQty(${i.id}, ${i.quantity - 1})" style="background:#f0f0f0; border:none; width:25px; height:25px; border-radius:5px;">-</button>
                            <span>${i.quantity}</span>
                            <button onclick="updateQty(${i.id}, ${i.quantity + 1})" style="background:#f0f0f0; border:none; width:25px; height:25px; border-radius:5px;">+</button>
                        </div>
                    </div>
                </div>
            `).join('');
        }
        
        function updateQty(id, newQty) {
            if (newQty <= 0) {
                cart = cart.filter(i => i.id !== id);
            } else {
                const item = cart.find(i => i.id === id);
                if (item) item.quantity = newQty;
            }
            updateCart();
        }
        
        function openCart() { document.getElementById('cartSidebar').classList.add('open'); document.getElementById('overlay').classList.add('active'); }
        function closeCart() { document.getElementById('cartSidebar').classList.remove('open'); document.getElementById('overlay').classList.remove('active'); }
        
        function filterByCategory(category) {
            currentCategory = category;
            document.getElementById('categoryTitle').innerHTML = category === 'all' ? 'All Products' : category.charAt(0).toUpperCase() + category.slice(1);
            loadProducts();
        }
        
        function searchProducts() {
            currentSearch = document.getElementById('searchInput').value;
            loadProducts();
        }
        
        function sortProducts() {
            currentSort = document.getElementById('sortSelect').value;
            loadProducts();
        }
        
        function checkout() {
            if (cart.length === 0) {
                Swal.fire('Error', 'Your cart is empty!', 'error');
                return;
            }
            document.getElementById('addressModal').style.display = 'block';
            document.getElementById('overlay').classList.add('active');
        }
        
        function closeAddressModal() {
            document.getElementById('addressModal').style.display = 'none';
            document.getElementById('overlay').classList.remove('active');
        }
        
        function confirmOrder() {
            const location = document.getElementById('deliveryLocation').value;
            const address = document.getElementById('deliveryAddress').value;
            
            if (!location || location !== 'Samdrup Jongkhar') {
                Swal.fire('Not Available', 'Sorry! Delivery is only available in Samdrup Jongkhar Dzongkhag.', 'error');
                return;
            }
            if (!address.trim()) {
                Swal.fire('Error', 'Please enter your full delivery address', 'error');
                return;
            }
            
            const total = cart.reduce((sum, i) => sum + (i.price * i.quantity), 0);
            const orderNumber = 'ORD-' + Math.random().toString(36).substr(2, 8).toUpperCase() + '-' + Date.now();
            
            const order = {
                id: Date.now(),
                order_number: orderNumber,
                items: [...cart],
                total_amount: total,
                delivery_address: address,
                status: 'pending',
                created_at: new Date().toLocaleString(),
                order_time: Date.now()
            };
            
            let orders = JSON.parse(localStorage.getItem('storeOrders') || '[]');
            orders.unshift(order);
            localStorage.setItem('storeOrders', JSON.stringify(orders));
            
            cart = [];
            updateCart();
            closeAddressModal();
            loadMyOrders();
            
            Swal.fire({icon:'success', title:'Order Placed!', text:'Your order has been placed and is pending admin approval.', timer:3000});
        }
        
        function loadMyOrders() {
            const orders = JSON.parse(localStorage.getItem('storeOrders') || '[]');
            const container = document.getElementById('ordersList');
            if (orders.length === 0) {
                container.innerHTML = '<div style="text-align:center;padding:40px;">No orders yet. Start shopping!</div>';
                return;
            }
            container.innerHTML = orders.map(order => `
                <div class="order-card">
                    <div style="display:flex; justify-content:space-between; margin-bottom:10px; flex-wrap:wrap; gap:10px;">
                        <strong><i class="fas fa-receipt"></i> Order #${order.order_number}</strong>
                        <span class="status-${order.status}">${order.status.toUpperCase()}</span>
                        ${order.status === 'pending' ? `<button class="cancel-order-btn" onclick="cancelOrder(${order.id})"><i class="fas fa-times"></i> Cancel (1hr)</button>` : ''}
                    </div>
                    <div>${order.items.map(i => `${i.name} x${i.quantity} - Nu. ${(i.price * i.quantity).toLocaleString()}`).join('<br>')}</div>
                    <div style="margin-top:10px;"><strong>Total: Nu. ${parseFloat(order.total_amount).toLocaleString()}</strong></div>
                    <div><strong><i class="fas fa-map-marker-alt"></i> Delivery:</strong> ${order.delivery_address}</div>
                    <div style="font-size:11px; color:#888; margin-top:10px;">📅 ${order.created_at}</div>
                </div>
            `).join('');
        }
        
        function cancelOrder(orderId) {
            let orders = JSON.parse(localStorage.getItem('storeOrders') || '[]');
            const order = orders.find(o => o.id === orderId);
            const timeElapsed = (Date.now() - order.order_time) / (1000 * 60 * 60);
            
            if (timeElapsed > 1) {
                Swal.fire('Cannot Cancel', 'Orders can only be cancelled within 1 hour of placing.', 'error');
                return;
            }
            
            Swal.fire({
                title: 'Cancel Order?',
                text: 'Are you sure you want to cancel this order?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    orders = orders.map(o => o.id === orderId ? { ...o, status: 'cancelled' } : o);
                    localStorage.setItem('storeOrders', JSON.stringify(orders));
                    loadMyOrders();
                    Swal.fire('Cancelled!', 'Order has been cancelled.', 'success');
                }
            });
        }
        
        function setRating(rating) {
            currentRating = rating;
            document.querySelectorAll('.star').forEach((star, index) => {
                if (index < rating) star.classList.add('active');
                else star.classList.remove('active');
            });
        }
        
        function showFeedbackModal() {
            document.getElementById('feedbackModal').classList.add('active');
            document.getElementById('overlay').classList.add('active');
        }
        
        function closeFeedbackModal() {
            document.getElementById('feedbackModal').classList.remove('active');
            document.getElementById('overlay').classList.remove('active');
        }
        
        function submitFeedback() {
            const feedback = document.getElementById('feedbackText').value;
            if (!feedback) {
                Swal.fire('Error', 'Please write your feedback', 'error');
                return;
            }
            if (currentRating === 0) {
                Swal.fire('Error', 'Please select a rating', 'error');
                return;
            }
            
            const feedbackItem = {
                name: '{{ Auth::user()->name ?? "Guest" }}',
                rating: currentRating,
                feedback: feedback,
                date: new Date().toLocaleString()
            };
            
            let feedbacks = JSON.parse(localStorage.getItem('storeFeedbacks') || '[]');
            feedbacks.unshift(feedbackItem);
            localStorage.setItem('storeFeedbacks', JSON.stringify(feedbacks));
            
            loadFeedbacks();
            Swal.fire('Thank You!', 'Your feedback has been submitted.', 'success');
            closeFeedbackModal();
            document.getElementById('feedbackText').value = '';
            currentRating = 0;
            document.querySelectorAll('.star').forEach(s => s.classList.remove('active'));
        }
        
        function loadFeedbacks() {
            const feedbacks = JSON.parse(localStorage.getItem('storeFeedbacks') || '[]');
            const container = document.getElementById('feedbacksList');
            if (feedbacks.length === 0) {
                container.innerHTML = '<div style="text-align:center;padding:40px;">No reviews yet. Be the first to rate us!</div>';
                return;
            }
            container.innerHTML = feedbacks.map(f => `
                <div class="feedback-card">
                    <div><strong>${f.name}</strong> <span style="color:#FFA41C;">${'★'.repeat(f.rating)}${'☆'.repeat(5-f.rating)}</span></div>
                    <p style="margin-top: 5px;">${f.feedback}</p>
                    <small style="color:#888;">${f.date}</small>
                </div>
            `).join('');
        }
        
        function scrollToOrders() {
            document.getElementById('myOrdersSection').scrollIntoView({ behavior: 'smooth' });
        }
        
        function closeAllModals() {
            closeCart();
            closeAddressModal();
            closeFeedbackModal();
            closeAddProductModal();
            document.getElementById('overlay').classList.remove('active');
        }
        
        // Admin functions for adding products
        function showAddProductModal() {
            @auth
                @if(Auth::user()->is_admin == 1 || Auth::user()->role == 'admin')
                    document.getElementById('addProductModal').classList.add('active');
                    document.getElementById('overlay').classList.add('active');
                @else
                    Swal.fire('Access Denied', 'Only administrators can add products.', 'error');
                @endif
            @else
                Swal.fire('Please Login', 'You need to login as admin to add products.', 'info');
            @endauth
        }
        
        function closeAddProductModal() {
            document.getElementById('addProductModal').classList.remove('active');
            document.getElementById('overlay').classList.remove('active');
            document.getElementById('addProductForm').reset();
            document.getElementById('productImagePreview').style.display = 'none';
        }
        
        function previewProductImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('productImagePreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function saveNewProduct() {
            const name = document.getElementById('productName').value;
            const category = document.getElementById('productCategory').value;
            const price = parseFloat(document.getElementById('productPrice').value);
            const stock = parseInt(document.getElementById('productStock').value);
            const imageInput = document.getElementById('productImageInput');
            
            if (!name || !price || !category) {
                Swal.fire('Error', 'Please fill all required fields', 'error');
                return;
            }
            
            let imageUrl = "https://placehold.co/200x180?text=" + name.charAt(0);
            
            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const newProduct = {
                        id: products.length + 1,
                        name: name,
                        category: category,
                        price: price,
                        stock: stock,
                        rating: 0,
                        reviews: 0,
                        image: e.target.result
                    };
                    products.push(newProduct);
                    loadProducts();
                    Swal.fire('Success!', 'Product added successfully!', 'success');
                    closeAddProductModal();
                };
                reader.readAsDataURL(imageInput.files[0]);
            } else {
                const newProduct = {
                    id: products.length + 1,
                    name: name,
                    category: category,
                    price: price,
                    stock: stock,
                    rating: 0,
                    reviews: 0,
                    image: imageUrl
                };
                products.push(newProduct);
                loadProducts();
                Swal.fire('Success!', 'Product added successfully!', 'success');
                closeAddProductModal();
            }
        }
        
        // Initialize
        loadProducts();
        loadMyOrders();
        loadFeedbacks();
        
        // Show add product button for admin (add to sidebar)
        @auth
            @if(Auth::user()->is_admin == 1 || Auth::user()->role == 'admin')
                document.querySelector('.sidebar ul').innerHTML += '<li onclick="showAddProductModal()"><i class="fas fa-plus-circle"></i> Add New Product</li>';
            @endif
        @endauth
    </script>
</body>
</html>