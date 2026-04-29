<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Yosel Enterprise | Premium Lifestyle & Entertainment</title>
    <style>
        /* ---------- RESET & GLOBAL ---------- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Roboto', sans-serif;
            background-color: #fefefe;
            overflow-x: hidden;
        }

        html {
            scroll-behavior: smooth;
        }

        /* ---------- STICKY NAVIGATION ---------- */
        header {
            background: linear-gradient(135deg, #1a1e2b 0%, #2a2f3f 100%);
            color: white;
            padding: 12px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(241, 196, 15, 0.3);
        }

        /* Logo section */
        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            transition: transform 0.25s ease;
        }

        .logo:hover {
            transform: scale(1.02);
        }

        .logo-img {
            height: 54px;
            width: auto;
            filter: drop-shadow(0 2px 6px rgba(0,0,0,0.3));
            transition: all 0.2s ease;
        }

        .logo-img:hover {
            transform: rotate(3deg) scale(1.02);
        }

        .logo-text h1 {
            font-size: 26px;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #f1c40f, #ffdd77);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            line-height: 1.2;
        }

        .logo-text span {
            font-size: 11px;
            letter-spacing: 1px;
            color: #b9c3db;
            font-weight: 400;
        }

        /* navigation */
        nav {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        nav a {
            color: #f0f3fa;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s;
            position: relative;
            padding: 6px 0;
        }

        nav a:hover {
            color: #f1c40f;
        }

        nav a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0%;
            height: 2.5px;
            background: #f1c40f;
            border-radius: 2px;
            transition: width 0.25s ease;
        }

        nav a:hover::after {
            width: 100%;
        }

        .register-btn {
            background: #f1c40f;
            color: #1e1e2a !important;
            padding: 8px 22px;
            border-radius: 40px;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .register-btn:hover {
            background: #ffdd77;
            transform: translateY(-2px);
            color: #111 !important;
        }

        .register-btn::after {
            display: none;
        }

        .logout-btn {
            background: rgba(255,255,240,0.12);
            border: 1px solid rgba(241,196,15,0.6);
            color: #f1c40f;
            padding: 8px 22px;
            border-radius: 40px;
            cursor: pointer;
            margin-left: 20px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            background: #e74c3c;
            border-color: #e74c3c;
            color: white;
            transform: translateY(-2px);
        }

        /* ---------- HERO + SLIDESHOW (cinematic) ---------- */
        .hero {
            position: relative;
            text-align: center;
            padding: 140px 20px;
            color: white;
            min-height: 560px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
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
            background-position: center 30%;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: opacity;
        }

        .slide.active {
            opacity: 1;
        }

        /* elegant overlay */
        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.7) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 850px;
            margin: 0 auto;
            animation: fadeRise 0.9s ease-out;
            backdrop-filter: blur(0px);
        }

        @keyframes fadeRise {
            0% {
                opacity: 0;
                transform: translateY(35px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h2 {
            font-size: 58px;
            font-weight: 800;
            margin-bottom: 18px;
            text-shadow: 0 4px 18px rgba(0,0,0,0.5);
            letter-spacing: -0.02em;
            background: linear-gradient(to right, #ffffff, #ffe6a3);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .hero p {
            font-size: 1.4rem;
            margin-bottom: 32px;
            font-weight: 500;
            text-shadow: 0 2px 6px rgba(0,0,0,0.5);
        }

        .hero .btn {
            background: #f1c40f;
            color: #1e1e2a;
            padding: 14px 38px;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            transition: 0.2s;
            letter-spacing: 0.3px;
        }

        .hero .btn:hover {
            background: #ffd966;
            transform: scale(1.05);
            box-shadow: 0 12px 28px rgba(0,0,0,0.4);
        }

        /* ---------- BRANCH CARDS SECTION (glassmorphism touch) ---------- */
        .branches-container {
            padding: 70px 24px;
            background: #fefaf5;
            text-align: center;
        }

        .branches-container h2 {
            font-size: 3rem;
            margin-bottom: 55px;
            font-weight: 700;
            color: #1f2a3e;
            position: relative;
            display: inline-block;
        }

        .branches-container h2::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 90px;
            height: 4px;
            background: linear-gradient(90deg, #f1c40f, #e67e22);
            border-radius: 4px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 38px;
            max-width: 1300px;
            margin: 0 auto;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(2px);
            border-radius: 32px;
            padding: 32px 24px;
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.1);
            transition: all 0.35s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            border: 1px solid rgba(241, 196, 15, 0.25);
            text-align: center;
        }

        .card:hover {
            transform: translateY(-12px);
            box-shadow: 0 30px 40px -12px rgba(0, 0, 0, 0.2);
            border-color: #f1c40f;
            background: white;
        }

        .card .icon {
            font-size: 58px;
            margin-bottom: 20px;
            display: inline-block;
            background: rgba(241, 196, 15, 0.15);
            padding: 12px;
            border-radius: 60px;
            transition: 0.2s;
        }

        .card:hover .icon {
            transform: scale(1.05);
            background: rgba(241, 196, 15, 0.25);
        }

        .card h3 {
            font-size: 1.8rem;
            margin-bottom: 16px;
            font-weight: 700;
            background: linear-gradient(135deg, #2c3e4e, #1e2a36);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .card p {
            color: #4a5b6e;
            margin-bottom: 28px;
            line-height: 1.5;
            font-weight: 500;
        }

        .card .btn {
            background: #1e2a36;
            color: white;
            border-radius: 40px;
            padding: 12px 28px;
            font-weight: 600;
            border: none;
            font-size: 0.9rem;
            transition: 0.2s;
            display: inline-block;
            text-decoration: none;
        }

        .card .btn:hover {
            background: #f1c40f;
            color: #1e1e2a;
            transform: translateY(-3px);
        }

        /* footer */
        footer {
            background: #111217;
            color: #ddd;
            text-align: center;
            padding: 40px 20px;
            border-top: 1px solid rgba(241,196,15,0.2);
        }

        footer p {
            margin: 8px 0;
            font-size: 0.9rem;
        }

        footer a {
            color: #f1c40f;
            text-decoration: none;
            transition: 0.2s;
        }

        footer a:hover {
            text-decoration: underline;
            color: #ffdd77;
        }

        /* Back to top button */
        #backToTop {
            display: none;
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #f1c40f;
            color: #1e1e2a;
            border: none;
            padding: 14px 18px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 24px;
            font-weight: bold;
            transition: all 0.25s;
            z-index: 99;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            line-height: 1;
        }

        #backToTop:hover {
            background: #ffd966;
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        /* responsive fine-tune */
        @media (max-width: 820px) {
            header {
                padding: 12px 20px;
            }
            .hero h2 {
                font-size: 40px;
            }
            .hero p {
                font-size: 1.1rem;
            }
            .hero {
                padding: 100px 20px;
                min-height: 480px;
            }
            .cards {
                gap: 24px;
            }
            .branches-container h2 {
                font-size: 2.3rem;
            }
        }

        @media (max-width: 580px) {
            nav a {
                margin-left: 12px;
                font-size: 0.85rem;
            }
            .register-btn, .logout-btn {
                padding: 5px 16px;
                margin-left: 8px;
            }
            .hero h2 {
                font-size: 32px;
            }
            .hero .btn {
                padding: 10px 26px;
            }
            .card h3 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <!-- dynamic logo with inline fallback – asset not existing? but we use placeholder with modern emoji/badge -->
        <img src="https://placehold.co/400x200?text=Yosel+Logo" alt="Yosel Enterprise Logo" class="logo-img"
             onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 100\'%3E%3Crect width=\'100\' height=\'100\' fill=\'%23f1c40f\'/%3E%3Ctext x=\'50\' y=\'67\' font-size=\'42\' text-anchor=\'middle\' fill=\'%23222\'%3EY%3C/text%3E%3C/svg%3E';">
        <div class="logo-text">
            <h1>Yosel Enterprise</h1>
            <span>Premium Quality Since 2024</span>
        </div>
    </div>
    <nav>
        <a href="{{ url('/') }}">Home</a>
        <a href="#branches">Our Branches</a>

        <!-- Laravel Authentication simulation (dynamic but blade-ready) -->
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" style="color: #f1c40f; font-weight:700;">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="register-btn">Register</a>
                @endif
            @endauth
        @endif
    </nav>
</header>

<!-- Hero with slideshow -->
<section class="hero">
    <div class="slideshow">
        <!-- professional high-quality unsplash images (culinary, snooker, luxury shop, fine dining) -->
        <div class="slide active" style="background-image: url('https://images.unsplash.com/photo-1513151233558-860c5394b0f0?w=1600&auto=format');"></div>
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1600&auto=format');"></div>
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1552566626-52f8b828add9?w=1600&auto=format');"></div>
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1600&auto=format');"></div>
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092?w=1600&auto=format');"></div>
    </div>
    <div class="hero-content">
        <h2>Elevate Every Experience</h2>
        <p>Where luxury meets lifestyle — snooker, fine dining, curated gifts & premium shopping.</p>
        <a href="#branches" class="btn">Discover Our Universe →</a>
    </div>
</section>

<!-- Branches & Services -->
<section id="branches" class="branches-container">
    <h2>Signature Destinations</h2>
    <div class="cards">
        <!-- Snooker Club -->
        <div class="card">
            <div class="icon">🎱✨</div>
            <h3>Yosel Snooker Club</h3>
            <p>Elite tables, ambient lighting, pro coaching & lounge bar. The ultimate cue sport haven.</p>
            <a href="{{ url('/snooker') }}" class="btn">Explore Club →</a>
        </div>

        <!-- Restaurant -->
        <div class="card">
            <div class="icon">🍽️🔥</div>
            <h3>Yangkhel Khangza</h3>
            <p>Authentic flavors, fusion cuisine, chef’s specialties. Indulge in a memorable dining journey.</p>
            <a href="{{ url('/restaurant') }}" class="btn">View Menu →</a>
        </div>

        <!-- Gift Shop -->
        <div class="card">
            <div class="icon">🎁💎</div>
            <h3>Norphel Bangzay</h3>
            <p>Handcrafted treasures, luxury hampers, exclusive souvenirs — gifts with a story.</p>
            <a href="{{ url('/giftshop') }}" class="btn">Shop Gifts →</a>
        </div>

        <!-- Main Store -->
        <div class="card">
            <div class="icon">🏬🛍️</div>
            <h3>Yosel Enterprise Store</h3>
            <p>Curated collection of premium brands, fashion, electronics & more. Shop excellence.</p>
            <a href="{{ url('/shop') }}" class="btn">Shop Now →</a>
        </div>
    </div>
</section>

<footer>
    <p>&copy; {{ date('Y') }} Yosel Enterprise — Redefining Lifestyle & Hospitality.</p>
    <p style="font-size: 13px; margin-top: 12px;">
        <a href="#">Privacy Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;
        <a href="#">Terms of Service</a>&nbsp;&nbsp;|&nbsp;&nbsp;
        <a href="#">Contact Excellence</a>
    </p>
    <p style="margin-top: 15px; font-size: 11px; opacity: 0.7;">📍 Premium experiences across the capital</p>
</footer>

<button onclick="topFunction()" id="backToTop" title="Back to top">↑</button>

<!-- slideshow + interactive smooth -->
<script>
    (function() {
        // ---------- SLIDESHOW LOGIC ----------
        let currentIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const total = slides.length;
        
        if (total > 0) {
            // ensure first slide active, others hidden
            function showSlide(index) {
                slides.forEach((slide, i) => {
                    if (i === index) {
                        slide.classList.add('active');
                    } else {
                        slide.classList.remove('active');
                    }
                });
            }
            
            function nextSlide() {
                currentIndex = (currentIndex + 1) % total;
                showSlide(currentIndex);
            }
            
            // start interval only if slides exist
            let slideInterval = setInterval(nextSlide, 5000);
            
            // Optional: pause slideshow on hover over hero (enhanced UX)
            const heroSection = document.querySelector('.hero');
            if (heroSection) {
                heroSection.addEventListener('mouseenter', () => {
                    clearInterval(slideInterval);
                });
                heroSection.addEventListener('mouseleave', () => {
                    slideInterval = setInterval(nextSlide, 5000);
                });
            }
        }
        
        // ---------- BACK TO TOP BUTTON (smooth) ----------
        const backBtn = document.getElementById('backToTop');
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > 350) {
                backBtn.style.display = 'block';
            } else {
                backBtn.style.display = 'none';
            }
        });
        
        window.topFunction = function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };
        
        // attach globally
        window.topFunction = window.topFunction || function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };
        
        // fix for any missing anchor highlight on load (if hash present)
        if (window.location.hash === '#branches') {
            setTimeout(() => {
                const branchesSection = document.getElementById('branches');
                if (branchesSection) {
                    branchesSection.scrollIntoView({ behavior: 'smooth' });
                }
            }, 100);
        }
        
        // small interactive console greeting (just for flair)
        console.log('✨ Yosel Enterprise — luxury ecosystem ready ✨');
    })();
    
    // Additional manual override for button event
    document.getElementById('backToTop')?.addEventListener('click', function(e) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    // handle any dynamic resize to keep hero slides aspect friendly
    window.addEventListener('resize', () => {
        // noop - just ensures slides bg cover remains perfect
    });
    
    // additional hover micro-interaction for cards
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', (e) => {
            // gentle style already from CSS, but adds no conflict
        });
    });
</script>

<!-- fallback for Laravel blade if asset not compiled but design is preserved -->
<!-- additional note: logo placeholder ensures design is robust even without actual image -->
</body>
</html>