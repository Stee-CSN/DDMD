<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - Yosel Enterprise</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        body {
            background: #f5f5f5;
        }
        
        header { 
            background-color: #222; 
            color: white; 
            padding: 15px 40px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            flex-wrap: wrap;
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
        
        nav a, nav button {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        
        .dashboard-container {
            display: flex;
            min-height: calc(100vh - 80px);
        }
        
        .sidebar {
            width: 280px;
            background: #222;
            color: white;
            padding: 20px 0;
        }
        
        .sidebar h3 {
            padding: 0 25px 20px;
            color: #FF8C00;
            border-bottom: 1px solid #444;
            margin-bottom: 20px;
        }
        
        .sidebar-menu {
            list-style: none;
        }
        
        .sidebar-menu li a {
            display: block;
            padding: 12px 25px;
            color: #ccc;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .sidebar-menu li a:hover {
            background: #FF8C00;
            color: #222;
        }
        
        .main-content {
            flex: 1;
            padding: 30px;
        }
        
        .welcome-card {
            background: linear-gradient(135deg, #FF8C00, #ffa733);
            border-radius: 15px;
            padding: 30px;
            color: #222;
            margin-bottom: 30px;
        }
        
        .welcome-card h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .stat-card h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #FF8C00;
        }
        
        .admin-actions {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .admin-actions h3 {
            color: #222;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #FF8C00;
        }
        
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .action-btn {
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            text-decoration: none;
            color: #333;
            transition: all 0.3s;
        }
        
        .action-btn:hover {
            background: #FF8C00;
            color: #222;
            transform: translateY(-2px);
        }
        
        footer {
            background-color: #222;
            color: white;
            text-align: center;
            padding: 20px;
        }
        
        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="logo-img" onerror="this.src='https://placehold.co/50x50?text=YE'">
            <div class="logo-text">
                <h1>Yosel Enterprise</h1>
                <span>Admin Panel</span>
            </div>
        </div>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit">Log Out</button>
            </form>
        </nav>
    </header>

    <div class="dashboard-container">
        <div class="sidebar">
            <h3>Navigation</h3>
            <ul class="sidebar-menu">
                <li><a href="{{ route('admin.dashboard') }}">📊 Dashboard</a></li>
                <li><a href="#">👥 Users</a></li>
                <li><a href="#">🍽️ Restaurant</a></li>
                <li><a href="#">🎱 Snooker</a></li>
                <li><a href="#">🎁 Products</a></li>
                <li><a href="#">📦 Orders</a></li>
                <li><a href="#">💬 Feedback</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="welcome-card">
                <h1>Welcome, {{ Auth::user()->name }}!</h1>
                <p>You are logged in as <strong>Administrator</strong>. You have full access to manage the system.</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Users</h3>
                    <div class="stat-number">{{ \App\Models\User::count() }}</div>
                </div>
                <div class="stat-card">
                    <h3>Snooker Bookings</h3>
                    <div class="stat-number">{{ \App\Models\SnookerBooking::count() }}</div>
                </div>
                <div class="stat-card">
                    <h3>Total Orders</h3>
                    <div class="stat-number">0</div>
                </div>
                <div class="stat-card">
                    <h3>Products</h3>
                    <div class="stat-number">30</div>
                </div>
            </div>

            <div class="admin-actions">
                <h3>Quick Actions</h3>
                <div class="action-buttons">
                    <a href="#" class="action-btn">➕ Add User</a>
                    <a href="#" class="action-btn">🍽️ Add Menu Item</a>
                    <a href="#" class="action-btn">🎱 Manage Bookings</a>
                    <a href="#" class="action-btn">🎁 Add Product</a>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Yosel Enterprise. All rights reserved.</p>
    </footer>
</body>
</html>