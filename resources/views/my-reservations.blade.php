<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Reservations - Yangkhel Khangza</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary: #e67e22;
            --primary-dark: #d35400;
            --primary-light: #f39c12;
            --secondary: #2c1810;
            --danger: #e74c3c;
            --success: #27ae60;
            --bg-light: #fffaf5;
            --bg-white: #ffffff;
            --text-dark: #2d2a24;
            --text-light: #5a4a3a;
            --border: #f0e0d0;
            --shadow-md: 0 8px 16px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* NAVBAR */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(12px);
            box-shadow: var(--shadow-md);
            z-index: 1000;
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-light);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-links a.active {
            color: var(--primary);
            font-weight: 600;
        }

        .user-info {
            background: linear-gradient(135deg, rgba(230, 126, 34, 0.08), rgba(243, 156, 18, 0.05));
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            border: 1px solid var(--border);
            font-weight: 500;
        }

        .nav-btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white !important;
            padding: 0.7rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .nav-btn.logout {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
        }

        /* HERO SECTION */
        .hero {
            min-height: 40vh;
            background: linear-gradient(135deg, #fff5eb 0%, #ffe8d6 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 7rem 5% 4rem;
            text-align: center;
        }

        .hero-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 800;
            color: var(--secondary);
        }

        .hero-content p {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        /* RESERVATIONS SECTION */
        .reservations-section {
            padding: 4rem 5%;
            background: var(--bg-white);
        }

        .section-title {
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: var(--secondary);
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background: var(--primary);
            margin: 10px auto 0;
            border-radius: 2px;
        }

        .reservations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .reservation-card {
            background: var(--bg-white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            border: 1px solid var(--border);
        }

        .reservation-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .reservation-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .reservation-id {
            font-weight: 700;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .status {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-confirmed {
            background: var(--success);
            color: white;
        }

        .status-cancelled {
            background: var(--danger);
            color: white;
        }

        .status-pending {
            background: #f39c12;
            color: white;
        }

        .cancel-btn {
            background: rgba(0, 0, 0, 0.3);
            color: white;
            border: none;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.7rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .cancel-btn:hover {
            background: rgba(0, 0, 0, 0.5);
            transform: scale(1.05);
        }

        .reservation-body {
            padding: 1.5rem;
        }

        .reservation-detail {
            margin-bottom: 0.8rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border);
        }

        .reservation-detail:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: var(--text-dark);
        }

        .detail-value {
            color: var(--text-light);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            background: linear-gradient(135deg, #fffaf5, #fff0e6);
            border-radius: 16px;
            border: 2px dashed var(--border);
            grid-column: 1/-1;
            max-width: 500px;
            margin: 0 auto;
        }

        .empty-state h3 {
            color: var(--secondary);
            margin-bottom: 0.5rem;
        }

        .btn-order {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            margin-top: 1rem;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-order:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        footer {
            background: var(--secondary);
            color: #aaa;
            padding: 2rem;
            text-align: center;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                text-align: center;
            }
            .nav-links {
                justify-content: center;
            }
            .hero-content h1 {
                font-size: 2rem;
            }
            .reservations-grid {
                grid-template-columns: 1fr;
            }
            .reservation-detail {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.3rem;
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
            <a href="{{ url('/my-reservations') }}" class="active">📋 My Reservations</a>
            @auth
                <div class="user-info">👋 {{ Auth::user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-btn logout">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-btn">Login</a>
                <a href="{{ route('register') }}" class="nav-btn">Register</a>
            @endauth
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>📋 My Reservations</h1>
            <p>View and manage all your table reservations</p>
        </div>
    </section>

    <section class="reservations-section">
        <h2 class="section-title">Reservation History</h2>
        
        <div class="reservations-grid">
            @forelse($reservations as $reservation)
                <div class="reservation-card">
                    <div class="reservation-header">
                        <div>
                            <div class="reservation-id">Reservation #{{ $reservation->id }}</div>
                        </div>
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <span class="status status-{{ $reservation->status }}">
                                {{ ucfirst($reservation->status) }}
                            </span>
                            @if($reservation->status != 'cancelled')
                                <button onclick="cancelReservation({{ $reservation->id }})" class="cancel-btn">
                                    ❌ Cancel
                                </button>
                            @endif
                        </div>
                    </div>
                    
                    <div class="reservation-body">
                        <div class="reservation-detail">
                            <span class="detail-label">👤 Name:</span>
                            <span class="detail-value">{{ $reservation->name }}</span>
                        </div>
                        
                        <div class="reservation-detail">
                            <span class="detail-label">📞 Phone:</span>
                            <span class="detail-value">{{ $reservation->phone }}</span>
                        </div>
                        
                        <div class="reservation-detail">
                            <span class="detail-label">👥 Guests:</span>
                            <span class="detail-value">{{ $reservation->guests }} person(s)</span>
                        </div>
                        
                        <div class="reservation-detail">
                            <span class="detail-label">📅 Date:</span>
                            <span class="detail-value">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('F j, Y') }}</span>
                        </div>
                        
                        <div class="reservation-detail">
                            <span class="detail-label">⏰ Time:</span>
                            <span class="detail-value">{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('g:i A') }}</span>
                        </div>
                        
                        @if($reservation->special_requests)
                            <div class="reservation-detail">
                                <span class="detail-label">💬 Requests:</span>
                                <span class="detail-value">{{ $reservation->special_requests }}</span>
                            </div>
                        @endif
                        
                        <div class="reservation-detail">
                            <span class="detail-label">📅 Booked on:</span>
                            <span class="detail-value">{{ $reservation->created_at->format('M d, Y g:i A') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <h3>📭 No Reservations Yet</h3>
                    <p>You haven't made any table reservations yet.</p>
                    <a href="{{ url('/restaurant') }}" class="btn-order">📅 Make a Reservation</a>
                </div>
            @endforelse
        </div>
    </section>

    <footer>
        <p><strong>🍜 Yangkhel Khangza</strong> - Authentic Bhutanese Cuisine</p>
        <p>📍 Dewathang, Bhutan | 📞 77299776 / 77827571</p>
        <p>© 2025 Yangkhel Khangza. All rights reserved.</p>
    </footer>

    <script>
        function cancelReservation(id) {
            Swal.fire({
                title: 'Cancel Reservation?',
                text: 'Are you sure you want to cancel this reservation?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#95a5a6',
                confirmButtonText: 'Yes, cancel it!',
                cancelButtonText: 'No, keep it',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Processing...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    fetch(`/reservation/${id}/cancel`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Cancelled!',
                                text: data.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: data.message || 'Failed to cancel reservation.'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Network error. Please try again.'
                        });
                    });
                }
            });
        }
    </script>
</body>
</html>