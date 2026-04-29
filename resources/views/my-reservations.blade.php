<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Reservations - Yangkhel Khangza</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', 'Segoe UI', system-ui, sans-serif;
            background: #fffaf5;
            color: #2d2a24;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            z-index: 1000;
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #e67e22, #f39c12);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav-links a {
            text-decoration: none;
            color: #4a4a4a;
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: #e67e22;
        }

        .nav-btn {
            background: #e67e22;
            color: white !important;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: #f0e0d0;
            padding: 0.5rem 1rem;
            border-radius: 50px;
        }

        /* Hero Section */
        .hero {
            min-height: 50vh;
            background: linear-gradient(135deg, #fff5eb 0%, #ffe8d6 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 7rem 5% 4rem;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: #2c1810;
        }

        .hero-content p {
            color: #5a4a3a;
            font-size: 1.1rem;
        }

        /* Reservations Section */
        .reservations-section {
            padding: 4rem 5%;
            background: white;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: #2c1810;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: #e67e22;
        }

        .reservations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .reservation-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
            border: 1px solid #f0e0d0;
        }

        .reservation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .reservation-header {
            background: linear-gradient(135deg, #e67e22, #f39c12);
            color: white;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .reservation-id {
            font-weight: bold;
            font-size: 0.9rem;
        }

        .status {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending {
            background: #f39c12;
            color: white;
        }

        .status-confirmed {
            background: #27ae60;
            color: white;
        }

        .status-completed {
            background: #3498db;
            color: white;
        }

        .status-cancelled {
            background: #e74c3c;
            color: white;
        }

        .reservation-body {
            padding: 1.5rem;
        }

        .reservation-detail {
            margin-bottom: 0.8rem;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #f0e0d0;
            padding-bottom: 0.5rem;
        }

        .detail-label {
            font-weight: 600;
            color: #5a4a3a;
        }

        .detail-value {
            color: #2c1810;
        }

        .order-items {
            margin-top: 1rem;
            background: #fef9f2;
            padding: 1rem;
            border-radius: 12px;
        }

        .order-items h4 {
            margin-bottom: 0.5rem;
            color: #2c1810;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            padding: 0.3rem 0;
        }

        .total-amount {
            margin-top: 1rem;
            padding-top: 0.5rem;
            border-top: 2px solid #e67e22;
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 1.1rem;
            color: #e67e22;
        }

        .empty-state {
            text-align: center;
            padding: 4rem;
            background: #fef9f2;
            border-radius: 20px;
            grid-column: 1/-1;
        }

        .empty-state h3 {
            color: #2c1810;
            margin-bottom: 1rem;
        }

        .btn-order {
            display: inline-block;
            background: #e67e22;
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            margin-top: 1rem;
            transition: 0.3s;
        }

        .btn-order:hover {
            background: #d35400;
            transform: translateY(-2px);
        }

        footer {
            background: #1a1a1a;
            color: #aaa;
            padding: 3rem 5%;
            text-align: center;
        }

        @media (max-width: 768px) {
            .reservations-grid {
                grid-template-columns: 1fr;
            }
            .hero-content h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">🍜 Yangkhel Khangza</div>
        <div class="nav-links">
            <a href="{{ url('/restaurant') }}">Home</a>
            <a href="{{ url('/restaurant#menu') }}">Menu</a>
            <a href="{{ url('/restaurant#feedback') }}">Reviews</a>
            <a href="{{ url('/my-reservations') }}" style="color: #e67e22; font-weight: bold;">📋 My Reservations</a>
            @auth
                <div class="user-info">👋 {{ Auth::user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-btn" style="background: #e74c3c;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-btn">Login</a>
                <a href="{{ route('register') }}" class="nav-btn">Register</a>
            @endauth
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>📋 My Reservations & Orders</h1>
            <p>View all your past and upcoming reservations with order details and total amounts</p>
        </div>
    </section>

    <section class="reservations-section">
        <h2 class="section-title">Your Reservation History</h2>
        
        <div class="reservations-grid">
            @forelse($reservations as $reservation)
                <div class="reservation-card">
                    <div class="reservation-header">
                        <span class="reservation-id">#{{ $reservation->id }}</span>
                        <span class="status status-{{ $reservation->status }}">
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </div>
                    
                    <div class="reservation-body">
                        <div class="reservation-detail">
                            <span class="detail-label">📅 Date & Time:</span>
                            <span class="detail-value">
                                @if($reservation->reservation_datetime)
                                    {{ \Carbon\Carbon::parse($reservation->reservation_datetime)->format('M d, Y h:i A') }}
                                @else
                                    Takeaway Order
                                @endif
                            </span>
                        </div>
                        
                        <div class="reservation-detail">
                            <span class="detail-label">🍽️ Dining Type:</span>
                            <span class="detail-value">{{ $reservation->dining_type == 'eat-in' ? 'Eat In Restaurant' : 'Takeaway' }}</span>
                        </div>
                        
                        <div class="reservation-detail">
                            <span class="detail-label">👥 People:</span>
                            <span class="detail-value">{{ $reservation->people_count }} {{ $reservation->people_count == 1 ? 'person' : 'people' }}</span>
                        </div>
                        
                        <div class="reservation-detail">
                            <span class="detail-label">📞 Contact:</span>
                            <span class="detail-value">{{ $reservation->customer_phone }}</span>
                        </div>
                        
                        @if($reservation->order_items && count($reservation->order_items) > 0)
                            <div class="order-items">
                                <h4>🍜 Order Items:</h4>
                                @foreach($reservation->order_items as $item)
                                    <div class="order-item">
                                        <span>{{ $item['name'] }} x{{ $item['quantity'] }}</span>
                                        <span>Nu. {{ number_format(floatval(str_replace('Nu.', '', $item['price'])) * $item['quantity'], 2) }}</span>
                                    </div>
                                @endforeach
                                <div class="total-amount">
                                    <span>💰 Total Amount:</span>
                                    <span>Nu. {{ number_format($reservation->order_total, 2) }}</span>
                                </div>
                            </div>
                        @else
                            <div class="order-items">
                                <p style="color: #999; text-align: center;">No food items ordered</p>
                            </div>
                        @endif
                        
                        @if($reservation->special_requests)
                            <div class="reservation-detail" style="margin-top: 0.8rem;">
                                <span class="detail-label">💬 Special Request:</span>
                                <span class="detail-value">{{ $reservation->special_requests }}</span>
                            </div>
                        @endif
                        
                        <div class="reservation-detail" style="margin-top: 0.8rem;">
                            <span class="detail-label">📅 Booked on:</span>
                            <span class="detail-value">{{ $reservation->created_at->format('M d, Y h:i A') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <h3>📭 No Reservations Yet</h3>
                    <p>You haven't made any reservations or orders yet.</p>
                    <a href="{{ url('/restaurant') }}" class="btn-order">Make a Reservation & Order Food</a>
                </div>
            @endforelse
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Yangkhel Khangza. All rights reserved.</p>
        <p>📍 Dewathang, Bhutan | 📞 +975 1234 5678 | ✉️ hello@yangkhel.bt</p>
        <p style="margin-top: 0.5rem;">⏰ Open Daily: 11:00 AM - 10:00 PM</p>
    </footer>

</body>
</html>