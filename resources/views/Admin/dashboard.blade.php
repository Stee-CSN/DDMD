<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - Yosel Enterprise</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fb;
        }

        .admin-container { display: flex; min-height: 100vh; }

        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header h2 { color: #FF8C00; font-size: 20px; }
        .sidebar-header p { font-size: 11px; opacity: 0.7; }

        .sidebar-menu { padding: 10px 0; }

        .menu-item {
            padding: 14px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #ddd;
            border-left: 3px solid transparent;
        }

        .menu-item:hover { background: rgba(255,140,0,0.1); color: #FF8C00; }
        .menu-item.active {
            background: rgba(255,140,0,0.15);
            color: #FF8C00;
            border-left-color: #FF8C00;
            font-weight: 600;
        }

        .menu-icon { font-size: 18px; width: 24px; text-align: center; }

        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 20px 30px;
            min-height: 100vh;
        }

        .top-bar {
            background: white;
            padding: 15px 25px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            flex-wrap: wrap;
            gap: 15px;
        }

        .top-bar h1 { font-size: 24px; color: #333; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            cursor: pointer;
            transition: transform 0.3s;
            border-left: 4px solid transparent;
        }

        .stat-card:hover { transform: translateY(-3px); }
        .stat-card:nth-child(1) { border-left-color: #4CAF50; }
        .stat-card:nth-child(2) { border-left-color: #2196F3; }
        .stat-card:nth-child(3) { border-left-color: #FF9800; }
        .stat-card:nth-child(4) { border-left-color: #9C27B0; }

        .stat-info { display: flex; justify-content: space-between; align-items: flex-start; }
        .stat-info h3 { font-size: 28px; color: #333; }
        .stat-info p { color: #666; font-size: 13px; }
        .stat-icon { font-size: 32px; opacity: 0.7; }

        .content-section { display: none; }
        .content-section.active { display: block; }

        .recent-section {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .section-title {
            font-size: 18px;
            margin-bottom: 20px;
            color: #333;
            border-left: 4px solid #FF8C00;
            padding-left: 15px;
        }

        .table-container { overflow-x: auto; margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; }
        table th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
            font-size: 12px;
        }
        table td { padding: 12px; border-bottom: 1px solid #eee; font-size: 13px; }
        table tr:hover { background: #f8f9fa; }

        .pill {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
        }
        .pill-green { background: #d4edda; color: #155724; }
        .pill-red { background: #f8d7da; color: #721c24; }
        .pill-amber { background: #fff3cd; color: #856404; }
        .pill-blue { background: #d1ecf1; color: #0c5460; }

        .action-btn {
            padding: 5px 12px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 11px;
            font-weight: 600;
            margin-right: 5px;
        }
        .btn-confirm { background: #28a745; color: white; }
        .btn-cancel { background: #dc3545; color: white; }
        .btn-view { background: #17a2b8; color: white; }
        .btn-edit { background: #ffc107; color: #333; }

        .btn {
            padding: 8px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-back { background: #FF8C00; color: white; }
        .btn-logout { background: #e74c3c; color: white; }

        .empty-state { text-align: center; padding: 40px; color: #999; }
        .empty-state-icon { font-size: 48px; margin-bottom: 15px; }

        .loading {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        @media (max-width: 768px) {
            .sidebar { width: 100%; height: auto; position: relative; }
            .main-content { margin-left: 0; padding: 15px; }
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="admin-container">

    <div class="sidebar">
        <div class="sidebar-header">
            <h2>🏢 Yosel Enterprise</h2>
            <p>Admin Panel</p>
        </div>
        <div class="sidebar-menu">
            <div class="menu-item active" data-section="dashboard">
                <span class="menu-icon">📊</span> Dashboard
            </div>
            <div class="menu-item" data-section="store">
                <span class="menu-icon">🏬</span> Store Orders
            </div>
            <div class="menu-item" data-section="restaurant">
                <span class="menu-icon">🍽️</span> Restaurant
            </div>
            <div class="menu-item" data-section="snooker">
                <span class="menu-icon">🎱</span> Snooker
            </div>
            <div class="menu-item" data-section="users">
                <span class="menu-icon">👥</span> Users
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <h1 id="pageTitle">📊 Dashboard</h1>
            <div class="top-bar-right">
                <a href="{{ url('/') }}" class="btn btn-back">🏠 Back to Site</a>
                <span class="pill pill-amber">{{ ucfirst(Auth::user()->role ?? 'Admin') }}</span>
                <span>{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit" class="btn btn-logout">🚪 Logout</button>
                </form>
            </div>
        </div>

        <!-- Dashboard Section -->
        <div id="dashboardSection" class="content-section active">
            <div class="stats-grid">
                <div class="stat-card" onclick="showSection('store')">
                    <div class="stat-info">
                        <div><h3 id="totalStoreOrders">0</h3><p>Store Orders</p></div>
                        <div class="stat-icon">🏬</div>
                    </div>
                </div>
                <div class="stat-card" onclick="showSection('restaurant')">
                    <div class="stat-info">
                        <div><h3 id="totalReservations">0</h3><p>Reservations</p></div>
                        <div class="stat-icon">🍽️</div>
                    </div>
                </div>
                <div class="stat-card" onclick="showSection('snooker')">
                    <div class="stat-info">
                        <div><h3 id="totalSnooker">0</h3><p>Snooker Bookings</p></div>
                        <div class="stat-icon">🎱</div>
                    </div>
                </div>
                <div class="stat-card" onclick="showSection('users')">
                    <div class="stat-info">
                        <div><h3 id="totalUsers">0</h3><p>Total Users</p></div>
                        <div class="stat-icon">👥</div>
                    </div>
                </div>
            </div>

            <div class="recent-section">
                <h3 class="section-title">🔄 Quick Actions</h3>
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <button class="btn btn-view" onclick="showSection('store')">📦 Manage Store Orders</button>
                    <button class="btn btn-view" onclick="showSection('restaurant')">🍽️ Manage Restaurant</button>
                    <button class="btn btn-view" onclick="showSection('snooker')">🎱 Manage Snooker</button>
                    <button class="btn btn-view" onclick="showSection('users')">👥 Manage Users</button>
                </div>
            </div>
        </div>

        <!-- Store Orders Section -->
        <div id="storeSection" class="content-section">
            <div class="recent-section">
                <h3 class="section-title">🏬 Store Orders</h3>
                <div class="table-container">
                    <div id="storeOrdersLoading" class="loading">Loading orders...</div>
                    <table id="storeOrdersTable" style="display: none;">
                        <thead>
                            <tr><th>Order #</th><th>Customer</th><th>Items</th><th>Total</th><th>Status</th><th>Actions</th></tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Restaurant Section -->
        <div id="restaurantSection" class="content-section">
            <div class="recent-section">
                <h3 class="section-title">🍽️ Restaurant Reservations</h3>
                <div class="table-container">
                    <div id="restaurantLoading" class="loading">Loading reservations...</div>
                    <table id="restaurantTable" style="display: none;">
                        <thead>
                            <tr><th>Customer</th><th>Date & Time</th><th>Guests</th><th>Status</th><th>Actions</th></tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Snooker Section -->
        <div id="snookerSection" class="content-section">
            <div class="recent-section">
                <h3 class="section-title">🎱 Snooker Bookings</h3>
                <div class="table-container">
                    <div id="snookerLoading" class="loading">Loading bookings...</div>
                    <table id="snookerTable" style="display: none;">
                        <thead>
                            <tr><th>Customer</th><th>Date & Time</th><th>Duration</th><th>Status</th><th>Actions</th></tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Users Section -->
        <div id="usersSection" class="content-section">
            <div class="recent-section">
                <h3 class="section-title">👥 User Management</h3>
                <div class="table-container">
                    <div id="usersLoading" class="loading">Loading users...</div>
                    <table id="usersTable" style="display: none;">
                        <thead>
                            <tr><th>Name</th><th>Email</th><th>Role</th><th>Joined</th><th>Actions</th></tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function showToast(message, isError = false) {
        Swal.fire({
            text: message,
            icon: isError ? 'error' : 'success',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    }

    function showSection(sectionName) {
        document.querySelectorAll('.content-section').forEach(s => s.classList.remove('active'));
        document.getElementById(sectionName + 'Section').classList.add('active');
        
        const titles = {
            'dashboard': '📊 Dashboard',
            'store': '🏬 Store Orders',
            'restaurant': '🍽️ Restaurant',
            'snooker': '🎱 Snooker',
            'users': '👥 Users'
        };
        document.getElementById('pageTitle').innerText = titles[sectionName];
        
        document.querySelectorAll('.menu-item').forEach(item => {
            item.classList.remove('active');
            if (item.dataset.section === sectionName) item.classList.add('active');
        });
        localStorage.setItem('activeAdminSection', sectionName);
        
        // Load data for section
        if (sectionName === 'store') loadStoreOrders();
        else if (sectionName === 'restaurant') loadRestaurantOrders();
        else if (sectionName === 'snooker') loadSnookerBookings();
        else if (sectionName === 'users') loadUsers();
    }

    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', () => showSection(item.dataset.section));
    });

    // Load Dashboard Stats
    function loadDashboardStats() {
        fetch('/admin/api/stats')
            .then(res => res.json())
            .then(data => {
                document.getElementById('totalStoreOrders').innerText = data.store_orders || 0;
                document.getElementById('totalReservations').innerText = data.reservations || 0;
                document.getElementById('totalSnooker').innerText = data.snooker_bookings || 0;
                document.getElementById('totalUsers').innerText = data.users || 0;
            })
            .catch(err => console.error('Error loading stats:', err));
    }

    // Load Store Orders
    function loadStoreOrders() {
        const loadingDiv = document.getElementById('storeOrdersLoading');
        const table = document.getElementById('storeOrdersTable');
        const tbody = table.querySelector('tbody');
        
        loadingDiv.style.display = 'block';
        table.style.display = 'none';
        
        fetch('/admin/api/store-orders')
            .then(res => res.json())
            .then(data => {
                loadingDiv.style.display = 'none';
                if (!data.orders || data.orders.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="6" style="text-align:center">No orders found</td></tr>';
                } else {
                    tbody.innerHTML = data.orders.map(order => `
                        <tr>
                            <td>#${order.order_number || order.id}</td>
                            <td>${order.customer_name || order.user?.name || 'Guest'}</td>
                            <td>${order.items?.length || 0} items</td>
                            <td>Nu. ${parseFloat(order.total_amount || 0).toLocaleString()}</td>
                            <td><span class="pill ${order.status === 'confirmed' ? 'pill-green' : (order.status === 'cancelled' ? 'pill-red' : 'pill-amber')}">${order.status || 'pending'}</span></td>
                            <td>
                                <button class="action-btn btn-view" onclick="viewOrder(${order.id})">View</button>
                                ${order.status === 'pending' ? `<button class="action-btn btn-confirm" onclick="approveOrder(${order.id})">Approve</button>
                                <button class="action-btn btn-cancel" onclick="rejectOrder(${order.id})">Reject</button>` : ''}
                            </td>
                        </tr>
                    `).join('');
                }
                table.style.display = 'table';
            })
            .catch(err => {
                loadingDiv.style.display = 'none';
                tbody.innerHTML = '<tr><td colspan="6" style="text-align:center">Error loading orders</td></tr>';
                table.style.display = 'table';
                console.error('Error:', err);
            });
    }

    // Load Restaurant Reservations
    function loadRestaurantOrders() {
        const loadingDiv = document.getElementById('restaurantLoading');
        const table = document.getElementById('restaurantTable');
        const tbody = table.querySelector('tbody');
        
        loadingDiv.style.display = 'block';
        table.style.display = 'none';
        
        fetch('/admin/api/reservations')
            .then(res => res.json())
            .then(data => {
                loadingDiv.style.display = 'none';
                if (!data.reservations || data.reservations.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="5" style="text-align:center">No reservations found</td></tr>';
                } else {
                    tbody.innerHTML = data.reservations.map(res => `
                        <tr>
                            <td>${res.customer_name || res.user?.name || 'Guest'}</td>
                            <td>${new Date(res.reservation_datetime).toLocaleString()}</td>
                            <td>${res.people_count || res.guests || 1}</td>
                            <td><span class="pill ${res.status === 'confirmed' ? 'pill-green' : (res.status === 'cancelled' ? 'pill-red' : 'pill-amber')}">${res.status || 'pending'}</span></td>
                            <td>
                                <button class="action-btn btn-confirm" onclick="updateReservation(${res.id}, 'confirmed')">Confirm</button>
                                <button class="action-btn btn-cancel" onclick="updateReservation(${res.id}, 'cancelled')">Cancel</button>
                            </td>
                        </tr>
                    `).join('');
                }
                table.style.display = 'table';
            })
            .catch(err => {
                loadingDiv.style.display = 'none';
                tbody.innerHTML = '<tr><td colspan="5" style="text-align:center">Error loading reservations</td></tr>';
                table.style.display = 'table';
                console.error('Error:', err);
            });
    }

    // Load Snooker Bookings
    function loadSnookerBookings() {
        const loadingDiv = document.getElementById('snookerLoading');
        const table = document.getElementById('snookerTable');
        const tbody = table.querySelector('tbody');
        
        loadingDiv.style.display = 'block';
        table.style.display = 'none';
        
        fetch('/admin/api/snooker-bookings')
            .then(res => res.json())
            .then(data => {
                loadingDiv.style.display = 'none';
                if (!data.bookings || data.bookings.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="5" style="text-align:center">No bookings found</td></tr>';
                } else {
                    tbody.innerHTML = data.bookings.map(booking => `
                        <tr>
                            <td>${booking.customer_name || booking.user?.name || 'Guest'}</td>
                            <td>${new Date(booking.start_time || booking.booking_datetime).toLocaleString()}</td>
                            <td>${booking.duration_hours || 1} hrs</td>
                            <td><span class="pill ${booking.status === 'confirmed' ? 'pill-green' : (booking.status === 'cancelled' ? 'pill-red' : 'pill-amber')}">${booking.status || 'pending'}</span></td>
                            <td>
                                <button class="action-btn btn-confirm" onclick="updateSnooker(${booking.id}, 'confirmed')">Confirm</button>
                                <button class="action-btn btn-cancel" onclick="updateSnooker(${booking.id}, 'cancelled')">Cancel</button>
                             </td>
                        </tr>
                    `).join('');
                }
                table.style.display = 'table';
            })
            .catch(err => {
                loadingDiv.style.display = 'none';
                tbody.innerHTML = '<tr><td colspan="5" style="text-align:center">Error loading bookings</td></tr>';
                table.style.display = 'table';
                console.error('Error:', err);
            });
    }

    // Load Users
    function loadUsers() {
        const loadingDiv = document.getElementById('usersLoading');
        const table = document.getElementById('usersTable');
        const tbody = table.querySelector('tbody');
        
        loadingDiv.style.display = 'block';
        table.style.display = 'none';
        
        fetch('/admin/api/users')
            .then(res => res.json())
            .then(data => {
                loadingDiv.style.display = 'none';
                if (!data.users || data.users.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="5" style="text-align:center">No users found</td></tr>';
                } else {
                    tbody.innerHTML = data.users.map(user => `
                        <tr>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td><span class="pill ${user.role === 'admin' ? 'pill-blue' : 'pill-green'}">${user.role || 'user'}</span></td>
                            <td>${new Date(user.created_at).toLocaleDateString()}</td>
                            <td>
                                ${user.id !== {{ Auth::id() }} ? `<button class="action-btn btn-edit" onclick="toggleUserRole(${user.id}, '${user.role === 'admin' ? 'user' : 'admin'}')">${user.role === 'admin' ? 'Demote' : 'Promote'}</button>
                                <button class="action-btn btn-cancel" onclick="deleteUser(${user.id})">Delete</button>` : '<span>Current User</span>'}
                             </td>
                        </tr>
                    `).join('');
                }
                table.style.display = 'table';
            })
            .catch(err => {
                loadingDiv.style.display = 'none';
                tbody.innerHTML = '<tr><td colspan="5" style="text-align:center">Error loading users</td></tr>';
                table.style.display = 'table';
                console.error('Error:', err);
            });
    }

    // API Action Functions
    function approveOrder(id) {
        Swal.fire({
            title: 'Approve Order?',
            text: 'This will confirm the order',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Yes, approve!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/api/store-order/${id}/approve`, { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken } })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            showToast('Order approved!');
                            loadStoreOrders();
                            loadDashboardStats();
                        }
                    });
            }
        });
    }

    function rejectOrder(id) {
        Swal.fire({
            title: 'Reject Order?',
            text: 'This will cancel the order',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Yes, reject!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/api/store-order/${id}/reject`, { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken } })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            showToast('Order rejected!');
                            loadStoreOrders();
                            loadDashboardStats();
                        }
                    });
            }
        });
    }

    function viewOrder(id) {
        Swal.fire({
            title: 'Order Details',
            text: `Viewing order #${id}`,
            icon: 'info',
            confirmButtonText: 'OK'
        });
    }

    function updateReservation(id, status) {
        Swal.fire({
            title: `${status === 'confirmed' ? 'Confirm' : 'Cancel'} Reservation?`,
            text: `Are you sure you want to ${status} this reservation?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: status === 'confirmed' ? '#28a745' : '#dc3545',
            confirmButtonText: `Yes, ${status}!`
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/api/reservation/${id}/status`, {
                    method: 'PUT',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' },
                    body: JSON.stringify({ status })
                }).then(res => res.json()).then(data => {
                    if (data.success) {
                        showToast(`Reservation ${status}!`);
                        loadRestaurantOrders();
                        loadDashboardStats();
                    }
                });
            }
        });
    }

    function updateSnooker(id, status) {
        Swal.fire({
            title: `${status === 'confirmed' ? 'Confirm' : 'Cancel'} Booking?`,
            text: `Are you sure you want to ${status} this booking?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: status === 'confirmed' ? '#28a745' : '#dc3545',
            confirmButtonText: `Yes, ${status}!`
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/api/snooker-booking/${id}/status`, {
                    method: 'PUT',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' },
                    body: JSON.stringify({ status })
                }).then(res => res.json()).then(data => {
                    if (data.success) {
                        showToast(`Booking ${status}!`);
                        loadSnookerBookings();
                        loadDashboardStats();
                    }
                });
            }
        });
    }

    function toggleUserRole(id, role) {
        Swal.fire({
            title: `Change User Role?`,
            text: `Set this user as ${role}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            confirmButtonText: 'Yes, change!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/api/user/${id}/role`, {
                    method: 'PUT',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' },
                    body: JSON.stringify({ role })
                }).then(res => res.json()).then(data => {
                    if (data.success) {
                        showToast('User role updated!');
                        loadUsers();
                    }
                });
            }
        });
    }

    function deleteUser(id) {
        Swal.fire({
            title: 'Delete User?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Yes, delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/api/user/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': csrfToken } })
                    .then(res => res.json()).then(data => {
                        if (data.success) {
                            showToast('User deleted!');
                            loadUsers();
                            loadDashboardStats();
                        } else {
                            showToast(data.message || 'Cannot delete user', true);
                        }
                    });
            }
        });
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        loadDashboardStats();
        const activeSection = localStorage.getItem('activeAdminSection');
        if (activeSection && activeSection !== 'dashboard') showSection(activeSection);
    });
</script>
</body>
</html>