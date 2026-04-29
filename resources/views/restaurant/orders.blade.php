<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Orders - Yangkhel Khangza</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', 'Georgia', serif; }
        body { background: #fffaf5; }
        
        .main-header {
            background: #1a1a1a;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .logo-area { display: flex; align-items: center; gap: 12px; }
        .logo-img { height: 50px; }
        .logo-text h1 { font-size: 22px; color: #FF8C00; }
        .logo-text p { font-size: 10px; color: #aaa; }
        .nav-links a { color: white; text-decoration: none; margin-left: 25px; }
        .nav-links a:hover { color: #FF8C00; }
        
        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        .page-title { font-size: 32px; color: #FF8C00; margin-bottom: 30px; border-left: 4px solid #FF8C00; padding-left: 15px; }
        
        .orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 25px;
        }
        
        .order-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: 1px solid #eee;
        }
        
        .card-header {
            background: linear-gradient(135deg, #FF8C00, #ffa733);
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-header h3 { color: #222; }
        .status { background: #fff3cd; padding: 4px 12px; border-radius: 20px; font-size: 12px; }
        
        .card-body { padding: 20px; }
        .order-item { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eee; }
        .order-total { display: flex; justify-content: space-between; padding: 10px 0; font-weight: bold; border-top: 2px solid #FF8C00; margin-top: 10px; }
        .order-type { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 11px; margin-left: 5px; }
        .dinein { background: #2c3e50; color: white; }
        .takeaway { background: #FF8C00; color: #222; }
        .order-date { font-size: 11px; color: #888; margin-top: 10px; text-align: right; }
        
        .empty-state { text-align: center; padding: 60px; background: white; border-radius: 15px; color: #888; }
        .btn-back { background: #FF8C00; color: #222; padding: 10px 25px; border-radius: 25px; text-decoration: none; display: inline-block; margin-top: 20px; }
        
        footer { background: #1a1a1a; color: white; text-align: center; padding: 30px; margin-top: 50px; }
        
        @media (max-width: 768px) {
            .main-header { flex-direction: column; gap: 15px; text-align: center; }
            .orders-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="logo-area">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="logo-img">
            <div class="logo-text"><h1>Yangkhel Khangza</h1><p>Authentic Bhutanese Flavors</p></div>
        </div>
        <div class="nav-links">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/restaurant') }}">Menu</a>
            <a href="{{ url('/restaurant/reservations') }}">My Reservations</a>
            <a href="{{ url('/restaurant/orders') }}">My Orders</a>
            @auth
                <span style="color:#FF8C00;">Hi, {{ Auth::user()->name }}</span>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </header>

    <div class="container">
        <h1 class="page-title">🍽️ My Food Orders</h1>
        <div id="ordersList"></div>
        <div style="text-align: center;">
            <a href="{{ url('/restaurant') }}" class="btn-back">← Back to Restaurant</a>
        </div>
    </div>

    <footer><p>&copy; 2024 Yangkhel Khangza - Yosel Enterprise</p></footer>

    <script>
        let orders = [];
        
        function loadOrders() {
            const saved = localStorage.getItem('restaurantOrders');
            if (saved) {
                orders = JSON.parse(saved);
                displayOrders();
            } else {
                displayEmpty();
            }
        }
        
        function displayOrders() {
            const container = document.getElementById('ordersList');
            if (orders.length === 0) {
                container.innerHTML = '<div class="empty-state"><p>🍽️ No orders yet.</p><a href="{{ url('/restaurant') }}#menu" class="btn-back">Order Food</a></div>';
                return;
            }
            
            container.innerHTML = `
                <div class="orders-grid">
                    ${orders.map(order => `
                        <div class="order-card">
                            <div class="card-header">
                                <h3>Order #${order.id}</h3>
                                <span class="status">${order.status}</span>
                            </div>
                            <div class="card-body">
                                ${order.items.map(item => `
                                    <div class="order-item">
                                        <span>${item.name} x${item.quantity} <span class="order-type ${item.orderType === 'Dine-in' ? 'dinein' : 'takeaway'}">${item.orderType}</span></span>
                                        <span>Nu. ${item.price * item.quantity}</span>
                                    </div>
                                `).join('')}
                                <div class="order-total">
                                    <span>Total Amount</span>
                                    <span>Nu. ${order.total}</span>
                                </div>
                                <div class="order-date">📅 ${order.date}</div>
                            </div>
                        </div>
                    `).join('')}
                </div>
            `;
        }
        
        function displayEmpty() {
            document.getElementById('ordersList').innerHTML = '<div class="empty-state"><p>🍽️ No orders yet.</p><a href="{{ url('/restaurant') }}#menu" class="btn-back">Order Food</a></div>';
        }
        
        loadOrders();
    </script>
</body>
</html>