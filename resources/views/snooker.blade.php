<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Yosel Snooker Club - Premier Snooker Experience</title>
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        
        .logo { display: flex; align-items: center; gap: 15px; }
        .logo-img { height: 50px; }
        .logo-text h1 { font-size: 24px; color: #FF8C00; }
        .logo-text span { font-size: 10px; color: #888; display: block; }
        
        nav { display: flex; align-items: center; flex-wrap: wrap; gap: 15px; }
        nav a { color: white; text-decoration: none; font-weight: bold; transition: color 0.3s; }
        nav a:hover { color: #FF8C00; }
        
        .reservations-link {
            background: rgba(255,140,0,0.2);
            border: 1px solid #FF8C00;
            padding: 8px 20px;
            border-radius: 25px;
        }
        
        .reservations-link:hover {
            background: #FF8C00;
            color: #222 !important;
        }
        
        .logout-btn {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            cursor: pointer;
        }
        
        .logout-btn:hover {
            background: #e74c3c;
        }
        
        /* Hero Slideshow */
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
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
            color: white;
            padding: 50px 40px 40px;
            text-align: center;
        }
        
        .slide-overlay h1 { font-size: 48px; margin-bottom: 15px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
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
        
        .container { max-width: 1400px; margin: -40px auto 60px; padding: 0 20px; position: relative; z-index: 10; }
        
        /* Alert Messages */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            animation: slideIn 0.3s ease;
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .alert-success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .alert-error { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        
        /* Rules Card */
        .rules-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .rules-card h2 { color: #222; margin-bottom: 20px; font-size: 28px; border-left: 4px solid #FF8C00; padding-left: 15px; }
        
        .rules-list { list-style: none; }
        .rules-list li {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            gap: 12px;
            font-size: 13px;
            line-height: 1.5;
            color: #555;
        }
        .rule-number { font-weight: bold; color: #FF8C00; min-width: 30px; }
        
        .damage-box {
            background: #fff5f5;
            border-left: 3px solid #e74c3c;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .damage-box h4 { color: #e74c3c; margin-bottom: 10px; }
        .damage-box p { font-size: 12px; margin: 5px 0; color: #666; }
        
        .contact-box {
            background: #f0f8ff;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            margin-top: 20px;
        }
        .contact-box p { margin: 5px 0; color: #555; }
        .contact-box .phone { font-size: 18px; font-weight: bold; color: #FF8C00; }
        
        /* Available Tables Section */
        .tables-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .tables-title {
            font-size: 28px;
            color: #FF8C00;
            margin-bottom: 25px;
            border-left: 4px solid #FF8C00;
            padding-left: 15px;
        }
        
        .tables-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }
        
        .table-card {
            background: #f8f9fa;
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s;
            border: 1px solid #eee;
            cursor: pointer;
        }
        
        .table-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #FF8C00;
        }
        
        .table-card.selected {
            border: 2px solid #FF8C00;
            background: #fff9f0;
        }
        
        .table-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            color: #FF8C00;
        }
        
        .table-info {
            padding: 20px;
        }
        
        .table-name {
            font-size: 22px;
            font-weight: bold;
            color: #222;
            margin-bottom: 8px;
        }
        
        .table-desc {
            color: #666;
            font-size: 13px;
            margin-bottom: 15px;
            line-height: 1.5;
        }
        
        .table-price {
            color: #FF8C00;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 15px;
        }
        
        .select-table-btn {
            background: #FF8C00;
            color: #222;
            border: none;
            padding: 10px 15px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            transition: 0.3s;
        }
        
        .select-table-btn:hover {
            background: #ffa733;
            transform: translateY(-2px);
        }
        
        .select-table-btn.selected {
            background: #28a745;
            color: white;
        }
        
        /* Booking Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        
        .modal.active {
            display: flex;
        }
        
        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 30px;
            max-width: 550px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s ease;
        }
        
        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #FF8C00;
        }
        
        .modal-header h3 {
            color: #222;
            font-size: 24px;
        }
        
        .close-modal {
            font-size: 28px;
            cursor: pointer;
            color: #888;
            transition: 0.3s;
        }
        
        .close-modal:hover {
            color: #e74c3c;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        
        .form-group select,
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }
        
        .total-price {
            font-size: 20px;
            font-weight: bold;
            color: #FF8C00;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #FF8C00;
            text-align: center;
        }
        
        .confirm-booking {
            width: 100%;
            background: #FF8C00;
            color: #222;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            transition: 0.3s;
        }
        
        .confirm-booking:hover {
            background: #ffa733;
            transform: translateY(-2px);
        }
        
        /* My Reservations Section */
        .reservations-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-top: 30px;
            scroll-margin-top: 100px;
        }
        
        .section-title {
            font-size: 24px;
            color: #222;
            margin-bottom: 25px;
            border-left: 4px solid #FF8C00;
            padding-left: 15px;
        }
        
        .reservations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }
        
        .reservation-card {
            background: #f8f9fa;
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #eee;
            transition: 0.3s;
        }
        
        .reservation-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .reservation-header {
            background: linear-gradient(135deg, #FF8C00, #ffa733);
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .reservation-header h4 {
            color: #222;
            font-size: 16px;
        }
        
        .status-badge {
            background: #fff3cd;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            color: #856404;
        }
        
        .status-badge.confirmed { background: #d4edda; color: #155724; }
        .status-badge.cancelled { background: #f8d7da; color: #721c24; }
        .status-badge.completed { background: #d1ecf1; color: #0c5460; }
        
        .reservation-body { padding: 15px; }
        .info-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee; }
        .info-label { font-weight: bold; color: #666; }
        .info-value { color: #333; }
        
        .cancel-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
            transition: 0.3s;
        }
        
        .cancel-btn:hover { background: #c0392b; }
        .cancel-btn:disabled { background: #95a5a6; cursor: not-allowed; }
        
        .empty-state {
            text-align: center;
            padding: 50px;
            color: #888;
            background: #f8f9fa;
            border-radius: 15px;
        }
        
        .login-prompt {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 15px;
            border: 1px solid #eee;
        }
        
        .login-prompt a {
            color: #FF8C00;
            text-decoration: none;
            font-weight: bold;
        }
        
        /* Footer */
        .footer-section {
            background-color: #1a1a1a;
            color: #ccc;
            padding: 50px 40px 30px;
            margin-top: 50px;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }
        
        .footer-col h3 {
            color: #FF8C00;
            font-size: 18px;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-col h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: #FF8C00;
        }
        
        .footer-col p { margin-bottom: 12px; line-height: 1.6; color: #aaa; }
        .footer-col a { color: #ccc; text-decoration: none; display: block; margin-bottom: 10px; transition: color 0.3s; }
        .footer-col a:hover { color: #FF8C00; }
        .footer-col .contact-item { display: flex; align-items: center; gap: 10px; margin-bottom: 15px; }
        
        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            margin-top: 30px;
            border-top: 1px solid #333;
            font-size: 12px;
            color: #888;
        }
        
        @media (max-width: 992px) {
            .tables-grid { grid-template-columns: 1fr; }
        }
        
        @media (max-width: 768px) {
            header { flex-direction: column; gap: 15px; text-align: center; }
            .slide-overlay h1 { font-size: 28px; }
            .hero-slideshow { height: 350px; }
            .reservations-grid { grid-template-columns: 1fr; }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="logo-img" onerror="this.src='https://placehold.co/50x50?text=YE'">
            <div class="logo-text">
                <h1>Yosel Snooker Club</h1>
                <span>Premier Snooker Experience</span>
            </div>
        </div>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/') }}#branches">Our Branches</a>
            @auth
                <span style="color:#FF8C00;">Hi, {{ Auth::user()->name }}</span>
                <a href="{{ route('profile') }}">My Profile</a>
                <a href="#myReservations" class="reservations-link" onclick="scrollToReservations()">📋 My Reservations</a>
                @if(Auth::user()->is_admin == 1 || Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin')
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

    <!-- Hero Slideshow -->
    <div class="hero-slideshow">
        <div class="slideshow-container">
            <div class="slide active" style="background-image: url('{{ asset('images/snooker/slide1.jpg') }}');">
                <div class="slide-overlay">
                    <h1>🎱 Yosel's Snooker & Billiards Club</h1>
                    <p>A premier snooker and billiards club featuring professional tables, a relaxed atmosphere, and a selection of beverages and snacks.</p>
                </div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('images/snooker/slide2.jpg') }}');">
                <div class="slide-overlay">
                    <h1>Professional Tables</h1>
                    <p>Premium quality snooker tables with perfect lighting</p>
                </div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('images/snooker/slide3.jpg') }}');">
                <div class="slide-overlay">
                    <h1>Relaxed Atmosphere</h1>
                    <p>Great ambiance, friendly staff, and exciting games</p>
                </div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('images/snooker/slide4.jpg') }}');">
                <div class="slide-overlay">
                    <h1>Book Your Slot Now</h1>
                    <p>Professional tables • Great atmosphere • Book online</p>
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
        <!-- Show success/error messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <!-- Rules & Regulations -->
        <div class="rules-card">
            <h2>📜 Club Rules</h2>
            <ul class="rules-list">
                <li><span class="rule-number">1.</span><span>All players must maintain silence in the room and respect each other during the game/match.</span></li>
                <li><span class="rule-number">2.</span><span>Follow the signs placed on the walls for smoking, drinking, and eating.</span></li>
                <li><span class="rule-number">3.</span><span>Food and drinks can be ordered and will be delivered to you.</span></li>
                <li><span class="rule-number">4.</span><span>No players should come and play snooker after you are fully drunk.</span></li>
                <li><span class="rule-number">5.</span><span>No drinks, eating, or smoking is allowed while playing.</span></li>
                <li><span class="rule-number">6.</span><span>Please do not keep glasses on the snooker table.</span></li>
                <li><span class="rule-number">7.</span><span>Fighting or quarreling will be reported to authorities.</span></li>
                <li><span class="rule-number">8.</span><span>Damage to equipment must be paid for.</span></li>
            </ul>
            
            <div class="damage-box">
                <h4>⚠️ Damage Charges</h4>
                <p>• Per Cushion: Nu. 25,000 - 30,000</p>
                <p>• Cue Stick: Nu. 1,500</p>
                <p>• Each Ball: Nu. 500</p>
                <p>• Table Cloth Damage: Nu. 15,000</p>
            </div>
            
            <div class="contact-box">
                <p>📞 For inquiries & bookings:</p>
                <p class="phone">77299776 / 77827571</p>
                <p style="font-size: 12px; margin-top: 10px;">Thank you for enjoying the GAME of Snooker!</p>
            </div>
        </div>

        <!-- Available Tables Section - Only 2 Tables -->
        <div class="tables-section" id="tablesSection">
            <h2 class="tables-title">🎯 Available Tables</h2>
            <div class="tables-grid" id="tablesGrid">
                <!-- 2 Tables will be loaded here -->
            </div>
        </div>

        @auth
            <!-- My Reservations Section -->
            <div class="reservations-section" id="myReservations">
                <h2 class="section-title">📋 My Reservations</h2>
                @if(isset($bookings) && $bookings->count() > 0)
                    <div class="reservations-grid">
                        @foreach($bookings as $booking)
                            <div class="reservation-card" data-booking-id="{{ $booking->id }}">
                                <div class="reservation-header">
                                    <h4>{{ ucfirst($booking->table_type) }} Table</h4>
                                    <span class="status-badge {{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                                </div>
                                <div class="reservation-body">
                                    <div class="info-row"><span class="info-label">📅 Date</span><span class="info-value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}</span></div>
                                    <div class="info-row"><span class="info-label">⏰ Time</span><span class="info-value">{{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }}</span></div>
                                    <div class="info-row"><span class="info-label">⏱️ Duration</span><span class="info-value">{{ $booking->duration_hours }} hour(s)</span></div>
                                    <div class="info-row"><span class="info-label">👥 Players</span><span class="info-value">{{ $booking->people_count }}</span></div>
                                    <div class="info-row"><span class="info-label">💰 Total Amount</span><span class="info-value">Nu. {{ number_format($booking->total_amount) }}</span></div>
                                    <div class="info-row"><span class="info-label">📅 Booked on</span><span class="info-value">{{ $booking->created_at->format('M d, Y') }}</span></div>
                                    
                                    @if($booking->status != 'cancelled' && $booking->status != 'completed')
                                        <button type="button" 
                                                class="cancel-btn" 
                                                onclick="confirmCancelBooking({{ $booking->id }}, '{{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}', '{{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }}', '{{ ucfirst($booking->table_type) }}')">
                                            ❌ Cancel Reservation
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <p>🎱 No reservations yet.</p>
                        <p style="font-size: 14px; margin-top: 10px;">Book a table using the options above!</p>
                    </div>
                @endif
            </div>
        @else
            <div class="login-prompt">
                <p>🔐 Please <a href="{{ route('login') }}">login</a> to book a snooker table</p>
                <p style="margin-top: 10px;">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
            </div>
        @endauth
    </div>

    <!-- Booking Modal -->
    <div class="modal" id="bookingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>🎱 Book Your Table</h3>
                <span class="close-modal" onclick="closeBookingModal()">&times;</span>
            </div>
            <form id="bookingForm" method="POST" action="{{ route('snooker.book') }}">
                @csrf
                <div class="form-group">
                    <label>Selected Table</label>
                    <input type="text" id="selectedTableName" readonly style="background: #f5f5f5;">
                    <input type="hidden" name="table_type" id="tableType">
                </div>
                <div class="form-group">
                    <label>Number of Players *</label>
                    <select name="people_count" required>
                        <option value="1">1 Player</option>
                        <option value="2" selected>2 Players</option>
                        <option value="3">3 Players</option>
                        <option value="4">4 Players</option>
                        <option value="5">5 Players</option>
                        <option value="6">6 Players</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Booking Date *</label>
                    <input type="date" name="booking_date" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <label>Start Time *</label>
                    <select name="start_time" required>
                        <option value="10:00">10:00 AM</option>
                        <option value="11:00">11:00 AM</option>
                        <option value="12:00">12:00 PM</option>
                        <option value="13:00">1:00 PM</option>
                        <option value="14:00">2:00 PM</option>
                        <option value="15:00">3:00 PM</option>
                        <option value="16:00">4:00 PM</option>
                        <option value="17:00">5:00 PM</option>
                        <option value="18:00">6:00 PM</option>
                        <option value="19:00">7:00 PM</option>
                        <option value="20:00">8:00 PM</option>
                        <option value="21:00">9:00 PM</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Duration (Hours) *</label>
                    <select name="duration_hours" id="durationHours" required>
                        <option value="1">1 hour</option>
                        <option value="2">2 hours</option>
                        <option value="3">3 hours</option>
                        <option value="4">4 hours</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Special Requests (Optional)</label>
                    <textarea name="special_requests" rows="2" placeholder="Any special requests?"></textarea>
                </div>
                <div class="total-price" id="totalPriceDisplay">
                    Total: Nu. 0
                </div>
                <button type="submit" class="confirm-booking">Confirm Booking</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-section">
        <div class="footer-container">
            <div class="footer-col">
                <h3>Yosel Snooker Club</h3>
                <p>Premier snooker experience in Dewathang. Professional tables, great atmosphere, and exciting games.</p>
            </div>
            <div class="footer-col">
                <h3>Quick Links</h3>
                <a href="{{ url('/') }}">🏠 Home</a>
                <a href="{{ url('/') }}#branches"> Our Branches</a>
                <a href="{{ url('/restaurant') }}"> Restaurant</a>
                <a href="{{ url('/giftshop') }}"> Gift Shop</a>
                <a href="{{ url('/shop') }}"> Yosel Enterprise Store</a>
            </div>
            <div class="footer-col">
                <h3>Contact Us</h3>
                <div class="contact-item"><span>📞</span><span>77299776 / 77827571</span></div>
                <div class="contact-item"><span>📧</span><span>snooker@yosel.com</span></div>
                <div class="contact-item"><span>📍</span><span>Dewathang, Samdrup Jongkhar, Bhutan</span></div>
                <div class="contact-item"><span>⏰</span><span>10:00 AM - 10:00 PM</span></div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Yosel Snooker Club - Yosel Enterprise. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Slideshow
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
        
        // Table Data - ONLY 2 TABLES
        const tables = [
            { 
                id: 1, 
                name: "Tournament Pro Table", 
                type: "standard", 
                description: "Professional 12-foot snooker table with premium cloth, perfect cushion response, and ideal lighting for serious players.", 
                pricePerHour: 100,
                icon: "🏆"
            },
            { 
                id: 2, 
                name: "Championship Elite Table", 
                type: "premium", 
                description: "High-quality tournament-grade table with superior playing surface, responsive cushions, and perfect for competitive matches.", 
                pricePerHour: 100,
                icon: "👑"
            }
        ];
        
        let selectedTable = null;
        
        // Load tables
        function loadTables() {
            const container = document.getElementById('tablesGrid');
            if (!container) return;
            
            container.innerHTML = tables.map(table => `
                <div class="table-card" data-id="${table.id}" data-type="${table.type}" data-name="${table.name}" data-price="${table.pricePerHour}">
                    <div class="table-image">${table.icon}</div>
                    <div class="table-info">
                        <div class="table-name"> ${table.name}</div>
                        <div class="table-desc">${table.description}</div>
                        <div class="table-price"> Nu. ${table.pricePerHour} per hour</div>
                        <button class="select-table-btn" onclick="selectTable(${table.id})">Select Table</button>
                    </div>
                </div>
            `).join('');
        }
        
        function selectTable(tableId) {
            selectedTable = tables.find(t => t.id === tableId);
            
            // Highlight selected table
            document.querySelectorAll('.table-card').forEach(card => {
                card.classList.remove('selected');
                const btn = card.querySelector('.select-table-btn');
                if (btn) btn.textContent = 'Select Table';
            });
            const selectedCard = document.querySelector(`.table-card[data-id="${tableId}"]`);
            if (selectedCard) {
                selectedCard.classList.add('selected');
                const btn = selectedCard.querySelector('.select-table-btn');
                if (btn) btn.textContent = '✓ Selected';
            }
            
            // Open modal and populate form
            openBookingModal();
        }
        
        function openBookingModal() {
            if (!selectedTable) return;
            
            const modal = document.getElementById('bookingModal');
            const selectedTableName = document.getElementById('selectedTableName');
            const tableTypeInput = document.getElementById('tableType');
            
            if (selectedTableName) selectedTableName.value = selectedTable.name;
            if (tableTypeInput) tableTypeInput.value = selectedTable.type;
            
            // Set minimum date to today
            const dateInput = document.querySelector('input[name="booking_date"]');
            if (dateInput) {
                const today = new Date().toISOString().split('T')[0];
                dateInput.min = today;
                dateInput.value = today;
            }
            
            // Update price when duration changes
            const durationSelect = document.getElementById('durationHours');
            if (durationSelect) {
                durationSelect.removeEventListener('change', updateTotalPrice);
                durationSelect.addEventListener('change', updateTotalPrice);
            }
            updateTotalPrice();
            
            modal.classList.add('active');
        }
        
        function updateTotalPrice() {
            if (!selectedTable) return;
            const duration = document.getElementById('durationHours').value;
            const total = selectedTable.pricePerHour * duration;
            document.getElementById('totalPriceDisplay').innerHTML = `Total: Nu. ${total.toLocaleString()}`;
        }
        
        function closeBookingModal() {
            document.getElementById('bookingModal').classList.remove('active');
        }
        
        function scrollToReservations() {
            const reservationsSection = document.getElementById('myReservations');
            if (reservationsSection) {
                reservationsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
        
        // Cancel Booking Function with SweetAlert2 Popup
        function confirmCancelBooking(bookingId, bookingDate, bookingTime, tableType) {
            Swal.fire({
                title: 'Are you sure?',
                html: `
                    <div style="text-align: left;">
                        <p>You are about to cancel this booking:</p>
                        <div style="background: #f8f9fa; padding: 15px; border-radius: 10px; margin: 15px 0;">
                            <strong>🎱 Table:</strong> ${tableType}<br>
                            <strong>📅 Date:</strong> ${bookingDate}<br>
                            <strong>⏰ Time:</strong> ${bookingTime}
                        </div>
                        <p style="color: #e74c3c;"><strong>⚠️ Note:</strong> This action cannot be undone!</p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#95a5a6',
                confirmButtonText: 'Yes, cancel booking!',
                cancelButtonText: 'No, keep it',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Cancelling your booking',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Send AJAX request to cancel booking
                    fetch(`/snooker/${bookingId}`, {
                        method: 'DELETE',
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
                                // Reload the page to show updated status
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: data.message || 'Failed to cancel booking. Please try again.'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Network error. Please try again.'
                        });
                    });
                }
            });
        }
        
        window.onclick = function(event) {
            const modal = document.getElementById('bookingModal');
            if (event.target === modal) {
                closeBookingModal();
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            loadTables();
        });
    </script>
</body>
</html>