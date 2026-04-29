<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Yosel Enterprise Store - Premium Products</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        body { background: #f5f5f5; }
        
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
        
        nav a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; }
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
        
        .container { max-width: 1200px; margin: -30px auto 60px; padding: 0 20px; position: relative; z-index: 10; }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
        
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: 0.3s;
        }
        
        .product-card:hover { transform: translateY(-5px); }
        
        .product-img {
            height: 200px;
            background: linear-gradient(135deg, #FF8C00, #ffa733);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
        }
        
        .product-info { padding: 20px; }
        .product-title { font-size: 18px; font-weight: bold; }
        .product-price { color: #FF8C00; font-size: 20px; font-weight: bold; margin: 8px 0; }
        .product-desc { color: #666; font-size: 13px; margin-bottom: 15px; }
        
        .btn-add {
            background: #FF8C00;
            color: #222;
            border: none;
            padding: 10px;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
        }
        
        .login-prompt { text-align: center; padding: 60px; background: white; border-radius: 15px; }
        .login-prompt a { color: #FF8C00; text-decoration: none; font-weight: bold; }
        
        footer { background: #1a1a1a; color: white; text-align: center; padding: 30px; margin-top: 50px; }
        
        @media (max-width: 768px) {
            header { flex-direction: column; gap: 15px; text-align: center; }
            .slide-overlay h1 { font-size: 28px; }
            .hero-slideshow { height: 350px; }
            .products-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="logo-img" onerror="this.src='https://placehold.co/50x50?text=YE'">
            <div class="logo-text">
                <h1>Yosel Enterprise Store</h1>
                <span>Premium Products</span>
            </div>
        </div>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/') }}#branches">Our Branches</a>
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
            <div class="slide active" style="background-image: url('{{ asset('images/enterprise/slide1.jpg') }}');">
                <div class="slide-overlay">
                    <h1>🏪 Yosel Enterprise Store</h1>
                    <p>Premium quality products for your everyday needs</p>
                </div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('images/enterprise/slide2.jpg') }}');">
                <div class="slide-overlay">
                    <h1>📱 Electronics & Gadgets</h1>
                    <p>Latest technology at best prices</p>
                </div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('images/enterprise/slide3.jpg') }}');">
                <div class="slide-overlay">
                    <h1>🏠 Home & Living</h1>
                    <p>Make your home beautiful</p>
                </div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('images/enterprise/slide4.jpg') }}');">
                <div class="slide-overlay">
                    <h1>🎁 Shop with Confidence</h1>
                    <p>Quality products • Great service</p>
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
            <div class="products-grid" id="productsGrid"></div>
        @else
            <div class="login-prompt">
                <p>🔐 Please <a href="{{ route('login') }}">login</a> to shop our products</p>
            </div>
        @endauth
    </div>

    <footer>
        <p>&copy; 2024 Yosel Enterprise Store - Yosel Enterprise. All rights reserved.</p>
    </footer>

    @auth
    <script>
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
        
        const products = [
            { id: 1, name: "Wireless Headphones", price: 2500, desc: "High-quality sound", img: "🎧" },
            { id: 2, name: "Smart Watch", price: 4500, desc: "Fitness tracker", img: "⌚" },
            { id: 3, name: "Power Bank", price: 1800, desc: "20000mAh", img: "🔋" },
            { id: 4, name: "LED Desk Lamp", price: 850, desc: "Adjustable", img: "💡" },
            { id: 5, name: "Water Bottle", price: 450, desc: "Stainless steel", img: "🧴" },
            { id: 6, name: "Pen Set", price: 350, desc: "Executive set", img: "✒️" }
        ];
        
        function loadProducts() {
            const grid = document.getElementById('productsGrid');
            if (!grid) return;
            grid.innerHTML = products.map(p => `
                <div class="product-card">
                    <div class="product-img">${p.img}</div>
                    <div class="product-info">
                        <div class="product-title">${p.name}</div>
                        <div class="product-price">Nu. ${p.price}</div>
                        <div class="product-desc">${p.desc}</div>
                        <button class="btn-add" onclick="alert('Added to cart! (Demo)')">Add to Cart</button>
                    </div>
                </div>
            `).join('');
        }
        
        loadProducts();
    </script>
    @endauth
</body>
</html>