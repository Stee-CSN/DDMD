<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Yosel Enterprise</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background: #f5f5f5; }
        header { background: #222; color: white; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center; }
        .logo h1 { color: #FF8C00; font-size: 24px; }
        nav a, nav button { color: white; text-decoration: none; margin-left: 20px; background: none; border: none; cursor: pointer; }
        .dashboard { display: flex; min-height: calc(100vh - 80px); }
        .sidebar { width: 260px; background: #222; color: white; padding: 20px 0; }
        .sidebar h3 { padding: 0 25px 20px; color: #FF8C00; }
        .sidebar a { display: block; padding: 12px 25px; color: #ccc; text-decoration: none; }
        .sidebar a:hover { background: #FF8C00; color: #222; }
        .main { flex: 1; padding: 30px; }
        .welcome { background: linear-gradient(135deg, #FF8C00, #ffa733); border-radius: 15px; padding: 30px; margin-bottom: 30px; color: #222; }
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; border-radius: 15px; padding: 25px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .stat-number { font-size: 36px; font-weight: bold; color: #FF8C00; }
        footer { background: #222; color: white; text-align: center; padding: 20px; }
    </style>
</head>
<body>
    <header>
        <div class="logo"><h1>Yosel Enterprise - Admin Panel</h1></div>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </nav>
    </header>
    <div class="dashboard">
        <div class="sidebar">
            <h3>Menu</h3>
            <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
            <a href="#">👥 Users</a>
            <a href="#">🎱 Snooker</a>
            <a href="#">🍽️ Restaurant</a>
            <a href="#">🎁 Products</a>
            <a href="#">📦 Orders</a>
        </div>
        <div class="main">
            <div class="welcome">
                <h1>Welcome, {{ Auth::user()->name }}!</h1>
                <p>You are logged in as Administrator.</p>
            </div>
            <div class="stats">
                <div class="stat-card"><h3>Total Users</h3><div class="stat-number">{{ \App\Models\User::count() }}</div></div>
                <div class="stat-card"><h3>Snooker Bookings</h3><div class="stat-number">{{ \App\Models\SnookerBooking::count() }}</div></div>
                <div class="stat-card"><h3>Total Orders</h3><div class="stat-number">0</div></div>
                <div class="stat-card"><h3>Products</h3><div class="stat-number">30</div></div>
            </div>
        </div>
    </div>
    <footer><p>&copy; {{ date('Y') }} Yosel Enterprise. All rights reserved.</p></footer>
</body>
</html>