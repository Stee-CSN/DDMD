<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - Yosel Enterprise</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #FF8C00;
            --primary-dark: #E67E00;
            --primary-light: #FFB366;
            --danger: #E63946;
            --success: #06D6A0;
            --warning: #FFB703;
            --info: #4D96FF;
            --bg-dark: #0F172A;
            --bg-darker: #0A0F1F;
            --bg-card: #1A2340;
            --text-primary: #F5F7FA;
            --text-secondary: #A0AEC0;
            --border: #2D3E5F;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.2);
            --shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg-darker);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ==================== HEADER ==================== */
        header {
            background: var(--bg-dark);
            border-bottom: 1px solid var(--border);
            padding: 1.25rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-md);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: translateX(2px);
        }

        .logo-img {
            height: 48px;
            width: auto;
            border-radius: 8px;
        }

        .logo-text h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logo-text span {
            font-size: 0.75rem;
            color: var(--text-secondary);
            display: block;
            margin-top: 0.25rem;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        nav a {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        nav a:hover {
            color: var(--primary);
        }

        nav a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        nav a:hover::after {
            width: 100%;
        }

        .logout-btn {
            background: linear-gradient(135deg, var(--danger), #C92A2A);
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            background: linear-gradient(135deg, #C92A2A, #A01F1F);
        }

        .logout-btn:active {
            transform: translateY(0);
        }

        /* ==================== DASHBOARD LAYOUT ==================== */
        .dashboard-container {
            display: flex;
            min-height: calc(100vh - 80px);
        }

        /* ==================== SIDEBAR ==================== */
        .sidebar {
            width: 280px;
            background: var(--bg-dark);
            border-right: 1px solid var(--border);
            padding: 2rem 0;
            overflow-y: auto;
            position: sticky;
            top: 80px;
            height: calc(100vh - 80px);
        }

        .sidebar h3 {
            padding: 0 1.5rem 1.25rem;
            color: var(--primary);
            border-bottom: 1px solid var(--border);
            margin-bottom: 1.5rem;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.5rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            margin: 0.25rem 0.5rem;
            border-radius: 6px;
        }

        .sidebar-menu li a:hover {
            background: rgba(255, 140, 0, 0.1);
            color: var(--primary);
            transform: translateX(4px);
        }

        .sidebar-menu li a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--primary);
            border-radius: 0 3px 3px 0;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-menu li a:hover::before {
            opacity: 1;
        }

        /* ==================== MAIN CONTENT ==================== */
        .main-content {
            flex: 1;
            padding: 2.5rem;
            overflow-y: auto;
        }

        .welcome-card {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 16px;
            padding: 2.5rem;
            color: white;
            margin-bottom: 2.5rem;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .welcome-card-content {
            position: relative;
            z-index: 1;
        }

        .welcome-card h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .welcome-card p {
            font-size: 0.95rem;
            opacity: 0.95;
        }

        /* ==================== STATS GRID ==================== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.75rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            border-color: var(--primary);
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-card h3 {
            color: var(--text-secondary);
            font-size: 0.85rem;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
        }

        .stat-number {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ==================== ADMIN ACTIONS ==================== */
        .admin-actions {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--shadow-md);
        }

        .admin-actions h3 {
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--primary);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.25rem;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.25rem;
        }

        .action-btn {
            background: rgba(255, 140, 0, 0.1);
            border: 1px solid var(--border);
            padding: 1.25rem;
            border-radius: 10px;
            text-align: center;
            text-decoration: none;
            color: var(--primary);
            transition: all 0.3s ease;
            font-weight: 600;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .action-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        /* ==================== FOOTER ==================== */
        footer {
            background: var(--bg-dark);
            border-top: 1px solid var(--border);
            color: var(--text-secondary);
            text-align: center;
            padding: 2rem;
            margin-top: auto;
        }

        footer p {
            margin: 0.5rem 0;
            font-size: 0.9rem;
        }

        /* ==================== MODALS & NOTIFICATIONS ==================== */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.8);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
            max-width: 400px;
            width: 90%;
            box-shadow: var(--shadow-xl);
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        .modal-body {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }

        .modal-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .modal-btn {
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .modal-btn-cancel {
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border);
        }

        .modal-btn-cancel:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--primary);
        }

        .modal-btn-confirm {
            background: linear-gradient(135deg, var(--danger), #C92A2A);
            color: white;
        }

        .modal-btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: var(--success);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            z-index: 3000;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* ==================== SCROLLBAR ==================== */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-darker);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                position: static;
                height: auto;
                border-right: none;
                border-bottom: 1px solid var(--border);
                padding: 1rem 0;
            }

            .main-content {
                padding: 1.5rem;
            }

            header {
                padding: 1rem;
            }

            .welcome-card h1 {
                font-size: 1.5rem;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }

            .modal-content {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .sidebar-menu li a {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }

            header {
                flex-direction: column;
                text-align: center;
            }

            nav {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="logo-img" onerror="this.src='https://placehold.co/48x48?text=YE'">
            <div class="logo-text">
                <h1>Yosel Enterprise</h1>
                <span>Admin Panel</span>
            </div>
        </div>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            <button class="logout-btn" onclick="showLogoutModal()">
                🚪 Log Out
            </button>
        </nav>
    </header>

    <div class="dashboard-container">
        <aside class="sidebar">
            <h3>📊 Navigation</h3>
            <ul class="sidebar-menu">
                <li><a href="{{ route('admin.dashboard') }}">📈 Dashboard</a></li>
                <li><a href="#">👥 Users</a></li>
                <li><a href="#">🍽️ Restaurant</a></li>
                <li><a href="#">🎱 Snooker</a></li>
                <li><a href="#">🎁 Products</a></li>
                <li><a href="#">📦 Orders</a></li>
                <li><a href="#">💬 Feedback</a></li>
                <li><a href="#">⚙️ Settings</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="welcome-card">
                <div class="welcome-card-content">
                    <h1>Welcome, {{ Auth::user()->name }}!</h1>
                    <p>You have full system access. Manage all enterprise operations from here.</p>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <h3>👥 Total Users</h3>
                    <div class="stat-number">{{ \App\Models\User::count() }}</div>
                </div>
                <div class="stat-card">
                    <h3>🎱 Snooker Bookings</h3>
                    <div class="stat-number">{{ \App\Models\SnookerBooking::count() }}</div>
                </div>
                <div class="stat-card">
                    <h3>📦 Total Orders</h3>
                    <div class="stat-number">0</div>
                </div>
                <div class="stat-card">
                    <h3>🎁 Products</h3>
                    <div class="stat-number">30</div>
                </div>
            </div>

            <div class="admin-actions">
                <h3>⚡ Quick Actions</h3>
                <div class="action-buttons">
                    <a href="#" class="action-btn">➕ Add User</a>
                    <a href="#" class="action-btn">🍽️ Add Menu Item</a>
                    <a href="#" class="action-btn">🎱 Manage Bookings</a>
                    <a href="#" class="action-btn">🎁 Add Product</a>
                </div>
            </div>
        </main>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Yosel Enterprise. All rights reserved.</p>
        <p>Designed with ❤️ for excellence</p>
    </footer>

    <!-- Logout Confirmation Modal -->
    <div class="modal" id="logoutModal">
        <div class="modal-content">
            <div class="modal-header">🚪 Confirm Logout</div>
            <div class="modal-body">
                Are you sure you want to logout? You'll need to login again to access the admin panel.
            </div>
            <div class="modal-buttons">
                <button class="modal-btn modal-btn-cancel" onclick="closeLogoutModal()">Cancel</button>
                <button class="modal-btn modal-btn-confirm" onclick="confirmLogout()">Logout</button>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        function showLogoutModal() {
            document.getElementById('logoutModal').classList.add('active');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.remove('active');
        }

        function confirmLogout() {
            document.getElementById('logout-form').submit();
        }

        // Close modal on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeLogoutModal();
        });

        // Optional: Auto logout after 30 minutes of inactivity
        let inactivityTimer;
        const INACTIVITY_TIME = 30 * 60 * 1000; // 30 minutes

        function resetInactivityTimer() {
            clearTimeout(inactivityTimer);
            inactivityTimer = setTimeout(() => {
                showLogoutModal();
            }, INACTIVITY_TIME);
        }

        document.addEventListener('mousemove', resetInactivityTimer);
        document.addEventListener('keypress', resetInactivityTimer);
        document.addEventListener('click', resetInactivityTimer);

        // Initialize
        resetInactivityTimer();
    </script>
</body>
</html>