<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoRide - Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Bootstrap JS (needed for modals and dropdowns) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding-bottom: 30px;
        }

        /* Navbar */
        .dash-navbar {
            background: #fff;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #eaeaea;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .dropdown-menu {
            position: absolute;
            top: 45px;
            right: 0;
            width: 200px;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            z-index: 1000;
        }

        .dropdown-menu li {
            font-size: 14px;
        }

        .navbar-brand-wrapper {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-logo {
            font-size: 22px;
            font-weight: 800;
            color: #111;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-logo img {
            height: 45px;
        }

        .search-container {
            position: relative;
            width: 300px;
        }

        .search-container input {
            width: 100%;
            background: #f3f4f6;
            border: none;
            border-radius: 20px;
            padding: 10px 15px 10px 40px;
            font-size: 14px;
            color: #333;
        }

        .search-container input:focus {
            outline: none;
            box-shadow: 0 0 0 2px #e5e7eb;
        }

        .search-container i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-book-ride {
            background: #000;
            color: #fff;
            border-radius: 20px;
            padding: 8px 16px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-book-ride:hover {
            color: #fff;
            background: #333;
        }

        .profile-img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }

        .dropdown-item:active,
        .dropdown-item.active {
            background-color: #111 !important;
            color: #fff !important;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #f3f4f6;
            color: #111;
        }

        .dropdown-item {
            font-weight: 500;
        }

        .dashboard-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            margin-bottom: 20px;
            gap: 20px;
        }

        .welcome-section {
            flex-shrink: 0;
        }

        .welcome-title {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 5px 0;
            color: #111;
        }

        .welcome-subtitle {
            color: #6b7280;
            font-size: 15px;
            margin-bottom: 0;
        }


        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: #f3f4f6;
            color: #111;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .stat-info {
            flex: 1;
        }

        .stat-value {
            font-size: 22px;
            font-weight: 800;
            color: #111;
            line-height: 1.2;
        }

        .stat-label {
            font-size: 13px;
            color: #6b7280;
            font-weight: 500;
        }

        /* Tabs */
        .custom-tabs {
            display: flex;
            gap: 30px;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 24px;
        }

        .custom-tab {
            padding: 10px 0;
            font-size: 15px;
            font-weight: 600;
            color: #6b7280;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            position: relative;
            top: 1px;
        }

        .custom-tab.active {
            color: #111;
            border-bottom-color: #111;
        }

        .dropdown-item:active,
        .dropdown-item.active {
            background-color: #111 !important;
            color: #fff !important;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Trip Card */
        .trip-card {
            background: #fff;
            border-radius: 16px;
            padding: 15px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            margin-bottom: 24px;
        }

        .trip-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding-bottom: 15px;
        }

        .trip-id {
            font-weight: 700;
            font-size: 16px;
            color: #111;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .trip-status-dot {
            width: 8px;
            height: 8px;
            background: #111;
            border-radius: 50%;
        }

        .help-modal {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
        }

        .help-modal .modal-header {
            border-bottom: 1px solid #eee;
            padding: 16px 20px;
        }

        .help-modal .modal-title {
            font-size: 20px;
            font-weight: 700;
        }

        .help-modal .btn-close {
            font-size: 14px;
            opacity: 1;
        }

        .help-modal .modal-body {
            padding: 28px 20px;
        }

        .help-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: #f8be00;
            color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .help-modal a {
            color: #111;
            text-decoration: none;
            font-weight: 600;
        }

        .trip-actions {
            display: flex;
            gap: 10px;
        }


        .btn-action-sm {
            background: #f3f4f6;
            color: #111;
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-action-sm:hover {
            background: #e5e7eb;
            color: #111;
        }

        .car-image-container {
            background: #f8f9fa;
            border-radius: 12px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            text-align: center;
            margin-bottom: 20px;
        }

        .car-image-container img {
            max-width: 100%;
            height: auto;
            max-height: 180px;
        }

        .img-grayscale {
            filter: grayscale(100%);
        }

        .map-placeholder {
            height: 400px;
            border: 1px solid #e5e7eb;
        }

        .fs-13 {
            font-size: 15px;
        }

        .car-name {
            font-size: 18px;
            font-weight: 700;
            color: #111;
        }

        .car-details {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            gap: 10px;
        }

        .car-number {
            font-size: 14px;

        }

        .car-driver-mini {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }

        .car-amenities {
            font-size: 14px;

        }

        .car-amenities span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .fare-breakdown {
            border-top: 1px solid #f3f4f6;
            padding-top: 15px;
        }

        .fare-breakdown-title {
            font-size: 15px;
            font-weight: 700;

            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .otp-banner {
            background: #111;
            border-radius: 12px;
            padding: 7px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .otp-label {
            font-size: 11px;
            font-weight: 700;
            color: #ccc;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .otp-value {
            font-size: 24px;
            font-weight: 800;
            color: #fff;
            letter-spacing: 4px;
        }

        .otp-icon {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 16px;
        }

        .info-block-title {
            font-size: 12px;
            font-weight: 700;
            color: #666;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .info-block-value {
            font-size: 14px;
            font-weight: 600;
            color: #111;
        }

        .route-timeline {
            position: relative;
            margin-bottom: 24px;
        }

        .route-point {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            position: relative;
        }

        .route-point:last-child {
            margin-bottom: 0;
        }

        .route-point::before {
            content: '';
            position: absolute;
            left: 7px;
            top: 20px;
            bottom: -20px;
            width: 2px;
            background: #e5e7eb;
        }

        .route-point:last-child::before {
            display: none;
        }

        .point-icon {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2px solid #111;
            background: #fff;
            z-index: 1;
            margin-top: 3px;
        }

        .point-icon.drop {
            border-color: #111;
            background: #111;
        }

        .point-details {
            flex: 1;
        }

        .point-label {
            font-size: 14px;
            font-weight: 700;

            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .point-address {
            font-size: 14px;
            font-weight: 500;
            color: #111;
        }

        .driver-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .driver-details-heading {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .driver-img-wrapper {
            position: relative;
        }

        .driver-img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
        }

        .driver-rating-badge {
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            background: #111;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 2px;
        }

        .driver-info {
            flex: 1;
        }

        .driver-name {
            font-size: 15px;
            font-weight: 700;
            color: #111;
            margin-bottom: 2px;
        }

        .driver-trips {
            font-size: 12px;
            color: #6b7280;
        }

        .driver-contact-btns {
            display: flex;
            gap: 8px;
        }

        .btn-contact {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #111;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 14px;
            transition: opacity 0.2s;
        }

        .btn-contact:hover {
            opacity: 0.8;
            color: #fff;
        }

        .btn-outline-dark-custom {

            padding: 9px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #111;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-dark-custom:hover {
            background: #f3f4f6;
            color: #111;
        }

        .btn-dark-custom {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            background: #111;
            color: #fff;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .btn-dark-custom:hover {
            background: #333;
            color: #fff;
        }

        /* Rating System */
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 4px;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #d1d5db;
            font-size: 24px;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star-rating input:checked~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #f59e0b;
        }

        /* Floating Chat Widget */
        .chat-widget {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1050;
        }

        .chat-widget-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #111;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            border: none;
            transition: transform 0.2s;
            text-decoration: none;
        }

        .chat-widget-btn:hover {
            transform: scale(1.05);
        }

        /* Top-up Amounts */
        .topup-amounts {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .topup-amount-btn {
            flex: 1;
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
            color: #111;
            transition: all 0.2s;
        }

        .topup-amount-btn:hover,
        .topup-amount-btn.active {
            background: #111;
            color: #fff;
            border-color: #111;
        }

        /* Compact Trip Card (Uber Style) */
        .compact-trip-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            display: flex;
            gap: 16px;
            align-items: flex-start;
            transition: box-shadow 0.2s;
            cursor: pointer;
        }

        .compact-trip-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .compact-car-img-wrapper {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 130px;
        }

        .compact-car-img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .compact-trip-details {
            flex: 1;
            min-width: 0;
        }

        .compact-trip-title {
            font-size: 16px;
            font-weight: 700;
            color: #111;
            margin-bottom: 4px;

            text-overflow: ellipsis;
        }

        .compact-trip-meta {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .compact-trip-price-status {
            font-size: 14px;
            font-weight: 600;
            color: #111;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .compact-trip-actions {
            display: flex;
            gap: 8px;
        }

        .btn-compact-action {
            background: #f3f4f6;
            border: none;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            color: #111;
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-compact-action:hover {
            background: #e5e7eb;
            color: #111;
        }

        @media (max-width: 992px) {
            .dashboard-header-flex {
                flex-direction: column;
                align-items: flex-start;
            }

            .top-overview-grid {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .car-image-container {
                flex-direction: column;
            }

            .car-amenities {
                display: flex;
                gap: 15px;
            }

          

            .stat-value {
                font-size: 17px;
            }

            .search-container {
                display: none;
            }

            .stat-card {
                padding: 9px;
                justify-content: center;
                gap: 6px;
                flex-direction: column;
            }
.stat-info{
    text-align: center;
}
.driver-card{
     flex-wrap: wrap;   
     justify-content: end;
}
.btn-outline-dark-custom{
        padding: 9px 13px;
}
.stats-grid
{
    gap:10px;
}
            .trip-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .trip-actions {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="dash-navbar px-3 px-md-4">
        <div class="navbar-brand-wrapper gap-2 gap-md-3">
            <a href="/" class="nav-logo fs-5 fs-md-4">
                <img src="https://www.goride.net.in/goride/img/logo-light.png" alt="GoRide">

            </a>
            <div class="search-container">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Find a ride, location, or transaction...">
            </div>
        </div>

        <div class="nav-actions gap-2 gap-md-3">
            <a href="/" class="btn-book-ride px-2 px-md-3">
                <i class="fas fa-plus"></i> <span class="d-none d-md-inline">Book Ride</span>
            </a>

            <div class="dropdown">
                <img src="https://ui-avatars.com/api/?name=Alex&background=random" alt="Profile" class="profile-img"
                    data-bs-toggle="dropdown">
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2">
                    <li><a class="dropdown-item  py-2" href="/uk-profile"><i class="far fa-user me-2 w-20px"></i>
                            Profile</a></li>
                    <li><a class="dropdown-item  py-2" href="/uk-dashboard"><i class="fas fa-chart-line me-2"></i>
                            Dashboard</a></li>
                    <!-- <li><a class="dropdown-item  py-2" href="#"><i class="fas fa-cog me-2"></i> Settings</a>
                    </li> -->
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item  py-2" href="#"><i class="fas fa-sign-out-alt me-2"></i>
                            Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container">

        <div class="dashboard-header-flex">
            <div class="welcome-section">
                <h1 class="welcome-title">Hello, Alex</h1>
                <p class="welcome-subtitle">Here is what's happening with your rides today.</p>
            </div>

            <!-- Top Overview -->
            <div class="top-overview-grid">


                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-car"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">148</div>
                            <div class="stat-label">Total Rides</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-route"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">1,240 <small class="fs-6 fw-bold">mi</small></div>
                            <div class="stat-label">Total Distance</div>
                        </div>
                    </div>
                   
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-star text-warning"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">4.9</div>
                            <div class="stat-label">Avg Rating Given</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Tabs -->
        <div class="custom-tabs">
            <div class="custom-tab active" onclick="switchTab('current')">Current Rides</div>
            <div class="custom-tab" onclick="switchTab('completed')">Completed Rides</div>
            <div class="custom-tab" onclick="switchTab('cancelled')">Cancelled Rides</div>
        </div>

        <!-- Tab Contents -->

        <!-- Current Rides -->
        <div id="tab-current" class="tab-content active">
            <div class="trip-card">
                <div class="trip-header">
                    <div class="trip-id">
                        <div class="trip-status-dot"></div>
                        Trip #CB-98231 (Live)
                    </div>
                    <div class="trip-actions">

                        <button class="btn-action-sm" data-bs-toggle="modal" data-bs-target="#liveMapModal"><i
                                class="fas fa-map-marked-alt"></i> Live Map</button>
                        <button class="btn-action-sm"><i class="fas fa-share-alt"></i> Share Trip</button>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Left Side: Car Details -->
                    <div class="col-md-6">
                        <div class="car-image-container">
                            <img src="/goride/img/saloon.png" alt="Innova Crysta">

                            <div class="car-details mb-2">
                                <div>
                                    <div class="car-name">Innova Crysta</div>
                                    <div class="car-number">TN 09 AB 4567</div>
                                </div>
                                <div class="car-amenities">
                                    <span><i class="fas fa-user-friends"></i> 7 Seats</span>
                                    <span><i class="fas fa-cog"></i> Automatic</span>
                                    <span><i class="fas fa-suitcase"></i> 3 Bags</span>
                                </div>
                            </div>
                        </div>





                        <div class="fare-breakdown">
                            <div class="fare-breakdown-title">FARE BREAKDOWN</div>
                            <div class="d-flex justify-content-between mb-2 fs-13">
                                <span>Base Fare</span>
                                <span>£10.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 fs-13">
                                <span>Distance (12.4 mi)</span>
                                <span>£25.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 fs-13">
                                <span>Surge & Taxes</span>
                                <span>£10.00</span>
                            </div>
                            <div class="d-flex justify-content-between mt-3 fw-bold fs-6 text-dark">
                                <span>Total</span>
                                <span>£45.00</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Trip Details -->
                    <div class="col-md-6">
                        <div class="otp-banner">
                            <div>
                                <div class="otp-label">TRIP OTP</div>
                                <div class="otp-value">4829</div>
                            </div>
                            <div class="otp-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                        </div>

                        <div class="route-timeline">
                            <div class="route-point">
                                <div class="point-icon"></div>
                                <div class="point-details">
                                    <div class="point-label">PICKUP</div>
                                    <div class="point-address">123 Tech Park Blvd, Sector 64</div>
                                </div>
                            </div>
                            <div class="route-point">
                                <div class="point-icon drop"></div>
                                <div class="point-details">
                                    <div class="point-label">DROP</div>
                                    <div class="point-address">Grand Central Mall</div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-3 col-6">
                                <div class="info-block-title">DATE</div>
                                <div class="info-block-value">Oct 24, 2023</div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="info-block-title">PICKUP TIME</div>
                                <div class="info-block-value">10:30 AM</div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="info-block-title">PAYMENT STATUS</div>
                                <div class="info-block-value text-dark d-flex align-items-center gap-2"><i
                                        class="far fa-clock"></i> Pending</div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="info-block-title">PAYMENT MODE</div>
                                <div class="info-block-value"><i class="far fa-money-bill-alt"></i> Wallet</div>
                            </div>
                        </div>



                        <div class="driver-details-heading">
                            <i class="fas fa-id-badge me-2"></i>
                            DRIVER DETAILS
                        </div>

                        <div class="driver-card">
                            <div class="driver-img-wrapper">
                                <img src="https://ui-avatars.com/api/?name=RS&amp;background=random" class="driver-img">
                                <div class="driver-rating-badge">
                                    <i class="fas fa-star text-warning me-1"></i> 4.9
                                </div>
                            </div>

                            <div class="driver-info">
                                <div class="driver-name">James Wilson</div>
                                <div class="driver-trips">3.2k+ trips completed</div>
                            </div>

                            <div class="driver-contact-btns">
                                <a href="tel:#" class="btn-contact"><i class="fas fa-phone-alt"
                                        style="  transform: rotate(90deg);"></i></a>
                                <a href="#" class="btn-contact"><i class="fas fa-comment-alt"></i></a>
                            </div>
                            <button class="btn-outline-dark-custom">CANCEL TRIP</button>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Rides -->
        <div id="tab-completed" class="tab-content">
            <div class="row g-4">
                <!-- Completed Trip 1 -->
                <div class="col-md-6">
                    <div class="compact-trip-card">
                        <div class="compact-car-img-wrapper">
                            <img src="/goride/img/saloon.png" class="compact-car-img" alt="Innova">
                        </div>
                        <div class="compact-trip-details">
                            <div class="compact-trip-title">Downtown Hotel, Central Blvd</div>
                            <div class="compact-trip-meta">23 Oct • 09:00 AM</div>
                            <div class="compact-trip-price-status">£35.00 • Completed</div>
                            <div class="compact-trip-actions">

                                <a href="#" class="btn-compact-action"><i class="fas fa-file-invoice"></i> Receipt</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Completed Trip 2 -->
                <div class="col-md-6">
                    <div class="compact-trip-card">
                        <div class="compact-car-img-wrapper">
                            <img src="/goride/img/saloon.png" class="compact-car-img" alt="Innova">
                        </div>
                        <div class="compact-trip-details">
                            <div class="compact-trip-title">Business Park, Sector 45</div>
                            <div class="compact-trip-meta">20 Oct • 02:15 PM</div>
                            <div class="compact-trip-price-status">£45.00 • Completed</div>
                            <div class="compact-trip-actions">

                                <a href="#" class="btn-compact-action"><i class="fas fa-file-invoice"></i> Receipt</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Completed Trip 3 -->
                <div class="col-md-6">
                    <div class="compact-trip-card">
                        <div class="compact-car-img-wrapper">
                            <img src="/goride/img/saloon.png" class="compact-car-img" alt="Innova">
                        </div>
                        <div class="compact-trip-details">
                            <div class="compact-trip-title">Airport Terminal 2</div>
                            <div class="compact-trip-meta">15 Oct • 06:30 AM</div>
                            <div class="compact-trip-price-status">£65.00 • Completed</div>
                            <div class="compact-trip-actions">

                                <a href="#" class="btn-compact-action"><i class="fas fa-file-invoice"></i> Receipt</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cancelled Rides -->
        <div id="tab-cancelled" class="tab-content">
            <div class="row g-4">
                <!-- Cancelled Trip 1 -->
                <div class="col-md-6">
                    <div class="compact-trip-card ">
                        <div class="compact-car-img-wrapper">
                            <img src="/goride/img/saloon.png" class="compact-car-img img-grayscale" alt="Innova">
                        </div>
                        <div class="compact-trip-details">
                            <div class="compact-trip-title">Residential Complex, North St</div>
                            <div class="compact-trip-meta">22 Oct • 04:30 PM</div>
                            <div class="compact-trip-price-status">£0.00 • Cancelled</div>

                        </div>
                    </div>
                </div>

                <!-- Cancelled Trip 2 -->
                <div class="col-md-6">
                    <div class="compact-trip-card ">
                        <div class="compact-car-img-wrapper">
                            <img src="/goride/img/saloon.png" class="compact-car-img img-grayscale" alt="Innova">
                        </div>
                        <div class="compact-trip-details">
                            <div class="compact-trip-title">Tech Hub 2, City Center</div>
                            <div class="compact-trip-meta">18 Oct • 08:15 AM</div>
                            <div class="compact-trip-price-status">£0.00 • Cancelled</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    <!-- Live Map Modal -->
    <div class="modal fade" id="liveMapModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 overflow-hidden">
                <div class="modal-header border-0 bg-white pb-0">
                    <h5 class="modal-title fw-bold">Live Tracking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center map-placeholder">
                        <div class="text-center text-secondary">
                            <i class="fas fa-map-marker-alt fs-1 mb-3"></i>
                            <h4>Interactive Map Integration Here</h4>
                            <p>Tracking Driver: James Wilson • ETA: 5 mins</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Wallet Top-Up Modal -->
    <div class="modal fade" id="walletModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold">Add Money to Wallet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-secondary mb-4">Current Balance: <strong class="text-dark">£45.50</strong></p>

                    <label class="info-block-title mb-2">QUICK AMOUNTS</label>
                    <div class="topup-amounts">
                        <button class="topup-amount-btn" onclick="setAmount(20)">£20</button>
                        <button class="topup-amount-btn active" onclick="setAmount(50)">£50</button>
                        <button class="topup-amount-btn" onclick="setAmount(100)">£100</button>
                    </div>

                    <div class="mb-4">
                        <label class="info-block-title mb-2">CUSTOM AMOUNT</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 fw-bold">£</span>
                            <input type="number" class="form-control border-start-0 ps-0 fw-bold fs-5" id="customAmount"
                                value="50">
                        </div>
                    </div>

                    <button class="btn-dark-custom w-100 py-3 fs-5">Proceed to Pay</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content help-modal">

                <div class="modal-header">
                    <h5 class="modal-title" id="helpModalLabel">Contact Us</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-center">

                    <div class="help-icon">
                        <i class="fas fa-headset"></i>
                    </div>

                    <h6>Need Assistance?</h6>

                    <p class="mb-3 text-muted">
                        Our support team is here to help.
                    </p>

                    <p class="mb-2">
                        <i class="fas fa-phone-alt me-2 text-warning" style=" transform: rotate(90deg);"></i>
                        <a href="tel:+442083373777">+44 208 337 3777</a>
                    </p>

                    <p class="mb-0">
                        <i class="fas fa-envelope me-2 text-warning"></i>
                        <a href="mailto:support.uk@goride.run">support.uk@goride.run</a>
                    </p>

                </div>

            </div>
        </div>
    </div>
    <!-- Floating Chat Widget -->
    <div class="chat-widget">
        <a href="#" class="chat-widget-btn" title="Support Chat" data-bs-toggle="modal" data-bs-target="#helpModal">

            <i class="fas fa-comment-dots"></i>

        </a>
    </div>

    <script>
        function switchTab(tabId) {
            document.querySelectorAll('.custom-tab').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            event.currentTarget.classList.add('active');
            document.getElementById('tab-' + tabId).classList.add('active');
        }

        function setAmount(amount) {
            document.querySelectorAll('.topup-amount-btn').forEach(btn => btn.classList.remove('active'));
            event.currentTarget.classList.add('active');
            document.getElementById('customAmount').value = amount;
        }
    </script>
</body>

</html>