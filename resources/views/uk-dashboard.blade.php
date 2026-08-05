@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #f8f9fa !important;
        }

        /* Skeleton Loader Styles */
        @keyframes shimmer {
            0% {
                background-position: -468px 0;
            }

            100% {
                background-position: 468px 0;
            }
        }

        .skeleton {
            background: #f6f7f8;
            background-image: linear-gradient(to right, #f6f7f8 0%, #edeef1 20%, #f6f7f8 40%, #f6f7f8 100%);
            background-repeat: no-repeat;
            background-size: 800px 100%;
            animation: shimmer 1.5s infinite linear forwards;
            border-radius: 8px;
            color: transparent !important;
            user-select: none;
        }

        .skeleton * {
            visibility: hidden !important;
        }

        .skeleton-circle {
            border-radius: 50%;
        }

        .skeleton-text {
            height: 18px;
            margin-bottom: 6px;
        }

        /* Pagination Styles */
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 30px;
            margin-bottom: 50px;
        }

        .page-btn {
            min-width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            background: #fff;
            border: 1px solid #e5e7eb;
            color: #111;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .page-btn:hover {
            background: #f3f4f6;
        }

        .page-btn.active {
            background: #111;
            color: #fff;
            border-color: #111;
        }

        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: #f9fafb;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .empty-state i {
            font-size: 40px;
            color: #d1d5db;
            margin-bottom: 15px;
        }

        .empty-state h5 {
            font-weight: 700;
            color: #111;
            margin-bottom: 5px;
        }

        .empty-state p {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 0;
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
            display: flex;
            align-items: stretch;
            justify-content: flex-end;
            gap: 20px;
        }

        .btn-book-now {
            background: #111;
            color: #fff;
            padding: 0 24px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-book-now:hover {
            background: #333;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
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
                /* flex-direction: column; */
            }

            .stat-info {
                text-align: center;
                   
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 11px;
            }
            .stat-icon {
                width: 30px;
    height: 30px;   
     font-size: 12px;
            }

            .driver-card {
                flex-wrap: wrap;
                justify-content: end;
            }

            .btn-outline-dark-custom {
                padding: 9px 13px;
            }

            .stats-grid {
                gap: 10px;
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
    <!-- Dashboard Content -->
    <div class="container">

        <div class="dashboard-header-flex">
            <div class="welcome-section">
                <h1 class="welcome-title" id="welcomeTitle"><span class="skeleton skeleton-text"
                        style="display: inline-block; width: 250px; height: 34px;"></span></h1>
                <p class="welcome-subtitle" id="welcomeSubtitle">Here is what's happening with your rides today.</p>
            </div>

            <!-- Top Overview -->
            <div class="top-overview-grid">


                <!-- Stats Grid -->
                <div class="stats-grid" id="summaryStatsGrid">
                    <!-- Skeleton Stats -->
                    <div class="stat-card" style="min-width: 180px;">
                        <div class="stat-icon skeleton skeleton-circle" style="width:38px; height:38px;"></div>
                        <div class="stat-info" style="width:100%">
                            <div class="skeleton skeleton-text" style="width: 60%; height: 24px;"></div>
                            <div class="skeleton skeleton-text" style="width: 80%; height: 16px; margin-bottom: 0;"></div>
                        </div>
                    </div>
                    <a href="{{ url('/') }}" class="btn-book-now skeleton" style="pointer-events: none; opacity: 0.5; min-width: 140px;">
                        <i class="fas fa-arrow-left"></i> Book Now
                    </a>
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
            <div id="currentRidesContainer">
                <div class="trip-card">
                    <div class="trip-header">
                        <div class="trip-id skeleton skeleton-text" style="width: 200px; height: 20px;"></div>
                        <div class="trip-actions skeleton skeleton-rect" style="width: 150px; height: 30px;"></div>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="car-image-container" style="height: 180px; padding: 20px;">
                                <div class="skeleton skeleton-rect" style="width: 60%; height: 100px;"></div>
                                <div class="car-details mb-2 w-100 ps-4">
                                    <div class="skeleton skeleton-text" style="width: 70%;"></div>
                                    <div class="skeleton skeleton-text" style="width: 50%;"></div>
                                </div>
                            </div>
                            <div class="fare-breakdown mt-3">
                                <div class="skeleton skeleton-text" style="width: 40%;"></div>
                                <div class="skeleton skeleton-text mt-3" style="width: 100%;"></div>
                                <div class="skeleton skeleton-text" style="width: 100%;"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="otp-banner skeleton skeleton-rect" style="height: 50px;"></div>
                            <div class="route-timeline mt-4">
                                <div class="route-point">
                                    <div class="point-icon skeleton skeleton-circle"></div>
                                    <div class="point-details w-100">
                                        <div class="skeleton skeleton-text" style="width: 80%;"></div>
                                        <div class="skeleton skeleton-text" style="width: 60%;"></div>
                                    </div>
                                </div>
                                <div class="route-point">
                                    <div class="point-icon drop skeleton skeleton-circle"></div>
                                    <div class="point-details w-100">
                                        <div class="skeleton skeleton-text" style="width: 80%;"></div>
                                        <div class="skeleton skeleton-text" style="width: 60%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Rides -->
        <div id="tab-completed" class="tab-content">
            <div id="completedRidesContainer">
                <div class="row g-4">
                    <!-- Skeletons -->
                    <div class="col-md-6">
                        <div class="compact-trip-card" style="cursor: default; pointer-events: none;">
                            <div class="compact-car-img-wrapper skeleton skeleton-rect" style="height: 90px; border: none;">
                            </div>
                            <div class="compact-trip-details w-100">
                                <div class="skeleton skeleton-text" style="width: 60%; height: 16px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 40%; height: 13px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 50%; height: 14px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="compact-trip-card" style="cursor: default; pointer-events: none;">
                            <div class="compact-car-img-wrapper skeleton skeleton-rect" style="height: 90px; border: none;">
                            </div>
                            <div class="compact-trip-details w-100">
                                <div class="skeleton skeleton-text" style="width: 60%; height: 16px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 40%; height: 13px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 50%; height: 14px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="compact-trip-card" style="cursor: default; pointer-events: none;">
                            <div class="compact-car-img-wrapper skeleton skeleton-rect" style="height: 90px; border: none;">
                            </div>
                            <div class="compact-trip-details w-100">
                                <div class="skeleton skeleton-text" style="width: 60%; height: 16px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 40%; height: 13px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 50%; height: 14px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="compact-trip-card" style="cursor: default; pointer-events: none;">
                            <div class="compact-car-img-wrapper skeleton skeleton-rect" style="height: 90px; border: none;">
                            </div>
                            <div class="compact-trip-details w-100">
                                <div class="skeleton skeleton-text" style="width: 60%; height: 16px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 40%; height: 13px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 50%; height: 14px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="compact-trip-card" style="cursor: default; pointer-events: none;">
                            <div class="compact-car-img-wrapper skeleton skeleton-rect" style="height: 90px; border: none;">
                            </div>
                            <div class="compact-trip-details w-100">
                                <div class="skeleton skeleton-text" style="width: 60%; height: 16px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 40%; height: 13px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 50%; height: 14px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="compact-trip-card" style="cursor: default; pointer-events: none;">
                            <div class="compact-car-img-wrapper skeleton skeleton-rect" style="height: 90px; border: none;">
                            </div>
                            <div class="compact-trip-details w-100">
                                <div class="skeleton skeleton-text" style="width: 60%; height: 16px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 40%; height: 13px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 50%; height: 14px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="completedPagination" class="pagination-container"></div>
        </div>

        <!-- Cancelled Rides -->
        <div id="tab-cancelled" class="tab-content">
            <div id="cancelledRidesContainer">
                <div class="row g-4">
                    <!-- Skeletons -->
                    <div class="col-md-6">
                        <div class="compact-trip-card" style="cursor: default; pointer-events: none;">
                            <div class="compact-car-img-wrapper skeleton skeleton-rect" style="height: 90px; border: none;">
                            </div>
                            <div class="compact-trip-details w-100">
                                <div class="skeleton skeleton-text" style="width: 60%; height: 16px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 40%; height: 13px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 50%; height: 14px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="compact-trip-card" style="cursor: default; pointer-events: none;">
                            <div class="compact-car-img-wrapper skeleton skeleton-rect" style="height: 90px; border: none;">
                            </div>
                            <div class="compact-trip-details w-100">
                                <div class="skeleton skeleton-text" style="width: 60%; height: 16px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 40%; height: 13px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 50%; height: 14px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="compact-trip-card" style="cursor: default; pointer-events: none;">
                            <div class="compact-car-img-wrapper skeleton skeleton-rect" style="height: 90px; border: none;">
                            </div>
                            <div class="compact-trip-details w-100">
                                <div class="skeleton skeleton-text" style="width: 60%; height: 16px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 40%; height: 13px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 50%; height: 14px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="compact-trip-card" style="cursor: default; pointer-events: none;">
                            <div class="compact-car-img-wrapper skeleton skeleton-rect" style="height: 90px; border: none;">
                            </div>
                            <div class="compact-trip-details w-100">
                                <div class="skeleton skeleton-text" style="width: 60%; height: 16px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 40%; height: 13px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 50%; height: 14px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="compact-trip-card" style="cursor: default; pointer-events: none;">
                            <div class="compact-car-img-wrapper skeleton skeleton-rect" style="height: 90px; border: none;">
                            </div>
                            <div class="compact-trip-details w-100">
                                <div class="skeleton skeleton-text" style="width: 60%; height: 16px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 40%; height: 13px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 50%; height: 14px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="compact-trip-card" style="cursor: default; pointer-events: none;">
                            <div class="compact-car-img-wrapper skeleton skeleton-rect" style="height: 90px; border: none;">
                            </div>
                            <div class="compact-trip-details w-100">
                                <div class="skeleton skeleton-text" style="width: 60%; height: 16px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 40%; height: 13px; margin-bottom: 6px;">
                                </div>
                                <div class="skeleton skeleton-text" style="width: 50%; height: 14px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="cancelledPagination" class="pagination-container"></div>
        </div>

    </div>
    </div>

    <!-- Cancel Trip Modal -->
    <div id="cancelJobModal" class="modal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"
        style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); z-index: 99999; align-items: center; justify-content: center;">
        <div class="modal-dialog" role="document"
            style="background: white; border-radius: 20px; padding: 30px; max-width: 380px; width: 90%; box-shadow: 0 10px 40px rgba(0,0,0,0.2); text-align: center;">
            <div class="modal-content" style="border: none;">
                <div
                    style="width: 60px; height: 60px; background: #fff0f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <i class="fas fa-exclamation-triangle" style="color: #dc3545; font-size: 24px;"></i>
                </div>
                <h4 style="margin: 0 0 10px; font-weight: 700; color: #333; font-size: 22px;">Cancel Job?</h4>
                <p style="color: #666; font-size: 15px; line-height: 1.5; margin-bottom: 15px;">
                    Are you sure you want to cancel this booking? This action cannot be undone.
                </p>
                <textarea id="cancelJobReason" rows="3" placeholder="Reason for cancellation (optional)"
                    style="width: 100%; box-sizing: border-box; border: 1px solid #ddd; border-radius: 10px; padding: 12px; margin-bottom: 25px; font-family: inherit; font-size: 14px; resize: none; background: #fafafa;"></textarea>
                <div style="display: flex; gap: 12px; justify-content: center;">
                    <button type="button" onclick="confirmDashboardCancelJob(this)"
                        style="flex: 1; padding: 12px 0; border-radius: 10px; border: none; background: #dc3545; color: white; font-weight: 600; font-size: 15px; cursor: pointer; box-shadow: 0 2px 8px rgba(220,53,69,0.3);">
                        Yes, Cancel
                    </button>
                    <button type="button" onclick="hideDashboardCancelModal()"
                        style="flex: 1; padding: 12px 0; border-radius: 10px; border: 1px solid #ddd; background: #fff; color: #333; font-weight: 600; font-size: 15px; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                        Keep It
                    </button>
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

        function getToken() {
            return typeof getCookieValue === 'function' ? getCookieValue('auth_token') : '';
        }

        function switchTab(tabId) {
            document.querySelectorAll('.custom-tab').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            
            // Safely find the tab to make active
            if (window.event && window.event.currentTarget && window.event.currentTarget.classList.contains('custom-tab')) {
                window.event.currentTarget.classList.add('active');
            } else {
                document.querySelectorAll('.custom-tab').forEach(tab => {
                    if (tab.getAttribute('onclick') && tab.getAttribute('onclick').includes(tabId)) {
                        tab.classList.add('active');
                    }
                });
            }
            
            const tabContent = document.getElementById('tab-' + tabId);
            if(tabContent) tabContent.classList.add('active');
        }

        function setAmount(amount) {
            document.querySelectorAll('.topup-amount-btn').forEach(btn => btn.classList.remove('active'));
            event.currentTarget.classList.add('active');
            document.getElementById('customAmount').value = amount;
        }

        function buildPagination(paginationData, containerId, fetchFunctionStr) {
            const container = document.getElementById(containerId);
            if (!paginationData || paginationData.total_pages <= 1) {
                container.innerHTML = '';
                return;
            }

            let html = '';

            // Prev Button
            if (paginationData.current_page > 1) {
                html += `<a href="javascript:void(0)" onclick="${fetchFunctionStr}(${paginationData.current_page - 1})" class="page-btn"><i class="fas fa-chevron-left"></i></a>`;
            } else {
                html += `<button disabled class="page-btn"><i class="fas fa-chevron-left"></i></button>`;
            }

            // Page numbers
            for (let i = 1; i <= paginationData.total_pages; i++) {
                if (i === paginationData.current_page) {
                    html += `<a href="javascript:void(0)" class="page-btn active">${i}</a>`;
                } else {
                    html += `<a href="javascript:void(0)" onclick="${fetchFunctionStr}(${i})" class="page-btn">${i}</a>`;
                }
            }

            // Next Button
            if (paginationData.current_page < paginationData.total_pages) {
                html += `<a href="javascript:void(0)" onclick="${fetchFunctionStr}(${paginationData.current_page + 1})" class="page-btn"><i class="fas fa-chevron-right"></i></a>`;
            } else {
                html += `<button disabled class="page-btn"><i class="fas fa-chevron-right"></i></button>`;
            }

            container.innerHTML = html;
        }

        async function fetchDashboardSummary() {
            try {
                const response = await fetch(`${API_BASE_URL}/customer-dashboard/summary`, {
                    headers: { 'Authorization': `Bearer ${getToken()}` }
                });
                const res = await response.json();
                if (res.status && res.data) {
                    const data = res.data;
                    document.getElementById('welcomeTitle').innerHTML = `Hello, ${data.customer_name}`;
                    document.getElementById('welcomeSubtitle').innerHTML = `Here is what's happening with your rides today.`;



                    document.getElementById('summaryStatsGrid').innerHTML = `
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-car"></i></div>
                                <div class="stat-info">
                                    <div class="stat-value">${data.total_rides}</div>
                                    <div class="stat-label">Total Rides</div>
                                </div>
                            </div>
                            <a href="{{ url('/') }}" class="btn-book-now">
                                <i class="fas fa-arrow-left"></i> Book Now
                            </a>
                        `;
                }
            } catch (error) {
                console.error("Error fetching summary", error);
            }
        }

        async function fetchCurrentRides() {
            try {
                const response = await fetch(`${API_BASE_URL}/customer-dashboard/current-rides`, {
                    headers: { 'Authorization': `Bearer ${getToken()}` }
                });
                const res = await response.json();
                const container = document.getElementById('currentRidesContainer');
                if (res.status && res.data && res.data.length > 0) {
                    let html = '';
                    res.data.forEach(trip => {
                        html += `
                            <div class="trip-card mb-4">
                                <div class="trip-header">
                                    <div class="trip-id">
                                        <div class="trip-status-dot"></div>
                                        Trip #${trip.job_no}
                                    </div>
                                    <div class="trip-actions">
                                        ${trip.buttons && trip.buttons.preview ? `<button class="btn-action-sm" onclick="window.open('${typeof trip.buttons.preview === 'string' ? trip.buttons.preview : '/booking-preview/' + (trip.preview_hash || trip.booking_key || trip.job_no)}', '_blank')"><i class="fas fa-file-alt"></i> Booking Preview</button>` : ''}
                                        ${trip.buttons && trip.buttons.live_map ? `<button class="btn-action-sm" data-bs-toggle="modal" data-bs-target="#liveMapModal"><i class="fas fa-map-marked-alt"></i> Live Map</button>` : ''}
                                        ${trip.buttons && trip.buttons.share_trip ? `<button class="btn-action-sm"><i class="fas fa-share-alt"></i> Share Trip</button>` : ''}
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="car-image-container">
                                            <img src="/goride/img/${trip.vehicle.image.toLowerCase()}.webp" alt="${trip.vehicle.name}" onerror="this.src='/goride/img/saloon.png'">
                                            <div class="car-details mb-2">
                                                <div>
                                                    <div class="car-name">${trip.vehicle.name}</div>
                                                    <div class="car-number">${trip.vehicle.number}</div>
                                                </div>
                                                <div class="car-amenities">
                                                    <span><i class="fas fa-user-friends"></i> ${trip.vehicle.seats} Seats</span>
                                                    <span><i class="fas fa-cog"></i> ${trip.vehicle.transmission}</span>
                                                    <span><i class="fas fa-suitcase"></i> ${trip.vehicle.bags} Bags</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="fare-breakdown mt-3">
                                            <div class="fare-breakdown-title">FARE BREAKDOWN</div>
                                            <div class="d-flex justify-content-between mb-2 fs-13">
                                                <span>Base Fare</span>
                                                <span>£${parseFloat(trip.fare.base).toFixed(2)}</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2 fs-13">
                                                <span>Tax and Other charges</span>
                                                <span>£${parseFloat(trip.fare.tax).toFixed(2)}</span>
                                            </div>
                                            <div class="d-flex justify-content-between mt-3 fw-bold fs-6 text-dark">
                                                <span>Total</span>
                                                <span>£${parseFloat(trip.fare.total).toFixed(2)}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="otp-banner">
                                            <div>
                                                <div class="otp-label">TRIP OTP</div>
                                                <div class="otp-value">${trip.trip_otp}</div>
                                            </div>
                                            <div class="otp-icon">
                                                <i class="fas fa-shield-alt"></i>
                                            </div>
                                        </div>

                                        <div class="route-timeline mt-4">
                                            <div class="route-point">
                                                <div class="point-icon"></div>
                                                <div class="point-details">
                                                    <div class="point-label">PICKUP</div>
                                                    <div class="point-address">${trip.pickup}</div>
                                                </div>
                                            </div>
                                            <div class="route-point">
                                                <div class="point-icon drop"></div>
                                                <div class="point-details">
                                                    <div class="point-label">DROP</div>
                                                    <div class="point-address">${trip.drop}</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-3 mb-4 mt-3">
                                            <div class="col-md-3 col-6">
                                                <div class="info-block-title">DATE</div>
                                                <div class="info-block-value">${trip.pickup_date}</div>
                                            </div>
                                            <div class="col-md-3 col-6">
                                                <div class="info-block-title">PICKUP TIME</div>
                                                <div class="info-block-value">${trip.pickup_time}</div>
                                            </div>
                                            <div class="col-md-3 col-6">
                                                <div class="info-block-title">PAYMENT STATUS</div>
                                                <div class="info-block-value text-dark d-flex align-items-center gap-2">
                                                    <i class="far fa-clock"></i> ${trip.payment_status}
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-6">
                                                <div class="info-block-title">PAYMENT MODE</div>
                                                <div class="info-block-value"><i class="far fa-money-bill-alt"></i> ${trip.payment_mode}</div>
                                            </div>
                                        </div>

                                        <div class="driver-details-heading mt-2">
                                            <i class="fas fa-id-badge me-2"></i>
                                            DRIVER DETAILS
                                        </div>

                                        <div class="driver-card">
                                            <div class="driver-img-wrapper">
                                                <img src="${trip.driver.image}" class="driver-img" onerror="this.src='https://ui-avatars.com/?name=${trip.driver.name.replace(/ /g, '+')}&background=random'">
                                                <div class="driver-rating-badge">
                                                    <i class="fas fa-star text-warning me-1"></i> ${trip.driver.rating ?? 4.2}
                                                </div>
                                            </div>
                                            <div class="driver-info">
                                                <div class="driver-name">${trip.driver.name}</div>
                                                <div class="driver-trips d-none">${trip.driver.completed_trips} trips completed</div>
                                            </div>
                                            <div class="driver-contact-btns">
                                                ${trip.buttons.call ? `<a href="tel:${trip.driver.mobile}" class="btn-contact"><i class="fas fa-phone-alt" style="transform: rotate(90deg);"></i></a>` : ''}
                                                ${trip.buttons.chat ? `<a href="#" class="btn-contact"><i class="fas fa-comment-alt"></i></a>` : ''}
                                            </div>
                                            ${trip.buttons.cancel ? `<button class="btn-outline-dark-custom ms-2" onclick="showDashboardCancelModal('${trip.booking_id || trip.job_id || ''}', '${trip.job_no || trip.job_no || ''}')">CANCEL TRIP</button>` : ''}
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    });
                    container.innerHTML = html;
                } else {
                    container.innerHTML = `
                            <div class="empty-state">
                                <i class="fas fa-car-side"></i>
                                <h5>No active rides</h5>
                                <p>You don't have any ongoing trips right now.</p>
                            </div>
                        `;
                }
            } catch (error) {
                console.error("Error fetching current rides", error);
            }
        }

        async function fetchCompletedRides(page = 1) {
            try {
                const container = document.getElementById('completedRidesContainer');
                container.innerHTML = `
                        <div class="row g-4">
                            ${[1, 2, 3, 4, 5, 6].map(() => '<div class="col-md-6"><div class="compact-trip-card" style="cursor: default; pointer-events: none;"><div class="compact-car-img-wrapper skeleton skeleton-rect" style="height: 90px; border: none;"></div><div class="compact-trip-details w-100"><div class="skeleton skeleton-text" style="width: 60%; height: 16px; margin-bottom: 6px;"></div><div class="skeleton skeleton-text" style="width: 40%; height: 13px; margin-bottom: 6px;"></div><div class="skeleton skeleton-text" style="width: 50%; height: 14px;"></div></div></div></div>').join('')}
                        </div>
                    `;

                const response = await fetch(`${API_BASE_URL}/customer-dashboard/completed-rides?page=${page}&limit=10`, {
                    headers: { 'Authorization': `Bearer ${getToken()}` }
                });
                const res = await response.json();
                if (res.status && res.data && res.data.length > 0) {
                    let html = '<div class="row g-4">';
                    res.data.forEach(trip => {
                        html += `
                            <div class="col-md-6">
                                <div class="compact-trip-card">
                                    <div class="compact-car-img-wrapper">
                                        <img src="/goride/img/${trip.vehicle_image.toLowerCase()}.webp" class="compact-car-img" onerror="this.src='/goride/img/saloon.png'">
                                    </div>
                                    <div class="compact-trip-details">
                                        <div class="compact-trip-title">${trip.drop}</div>
                                        <div class="compact-trip-meta">${trip.pickup_date} • ${trip.pickup_time}</div>
                                        <div class="compact-trip-price-status">£${parseFloat(trip.amount).toFixed(2)} ${trip.currency} • Completed</div>
                                        <div class="compact-trip-actions">
                                            ${trip.receipt_available ? `<a href="#" class="btn-compact-action"><i class="fas fa-file-invoice"></i> Receipt</a>` : ''}
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    });
                    html += '</div>';
                    container.innerHTML = html;
                    buildPagination(res.pagination, 'completedPagination', 'fetchCompletedRides');
                } else {
                    container.innerHTML = `
                            <div class="empty-state">
                                <i class="fas fa-history"></i>
                                <h5>No completed rides</h5>
                                <p>You haven't completed any trips yet.</p>
                            </div>
                        `;
                    document.getElementById('completedPagination').innerHTML = '';
                }
            } catch (error) {
                console.error("Error fetching completed rides", error);
            }
        }

        async function fetchCancelledRides(page = 1) {
            try {
                const container = document.getElementById('cancelledRidesContainer');
                container.innerHTML = `
                        <div class="row g-4">
                            ${[1, 2, 3, 4, 5, 6].map(() => '<div class="col-md-6"><div class="compact-trip-card" style="cursor: default; pointer-events: none;"><div class="compact-car-img-wrapper skeleton skeleton-rect" style="height: 90px; border: none;"></div><div class="compact-trip-details w-100"><div class="skeleton skeleton-text" style="width: 60%; height: 16px; margin-bottom: 6px;"></div><div class="skeleton skeleton-text" style="width: 40%; height: 13px; margin-bottom: 6px;"></div><div class="skeleton skeleton-text" style="width: 50%; height: 14px;"></div></div></div></div>').join('')}
                        </div>
                    `;

                const response = await fetch(`${API_BASE_URL}/customer-dashboard/cancelled-rides?page=${page}&limit=10`, {
                    headers: { 'Authorization': `Bearer ${getToken()}` }
                });
                const res = await response.json();
                if (res.status && res.data && res.data.length > 0) {
                    let html = '<div class="row g-4">';
                    res.data.forEach(trip => {
                        html += `
                            <div class="col-md-6">
                                <div class="compact-trip-card">
                                    <div class="compact-car-img-wrapper">
                                        <img src="/goride/img/${trip.vehicle_image.toLowerCase()}.webp" class="compact-car-img img-grayscale" onerror="this.src='/goride/img/saloon.png'">
                                    </div>
                                    <div class="compact-trip-details">
                                        <div class="compact-trip-title">${trip.drop}</div>
                                        <div class="compact-trip-meta">${trip.pickup_date} • ${trip.pickup_time}</div>
                                        <div class="compact-trip-price-status text-danger">${trip.cancel_reason || 'Cancelled'}</div>
                                    </div>
                                </div>
                            </div>`;
                    });
                    html += '</div>';
                    container.innerHTML = html;
                    buildPagination(res.pagination, 'cancelledPagination', 'fetchCancelledRides');
                } else {
                    container.innerHTML = `
                            <div class="empty-state">
                                <i class="fas fa-ban"></i>
                                <h5>No cancelled rides</h5>
                                <p>You don't have any cancelled trips.</p>
                            </div>
                        `;
                    document.getElementById('cancelledPagination').innerHTML = '';
                }
            } catch (error) {
                console.error("Error fetching cancelled rides", error);
            }
        }

        let currentCancelJobId = null;
        let currentCancelJobNo = null;

        function showDashboardCancelModal(jobId, jobNo) {
            currentCancelJobId = jobId;
            currentCancelJobNo = jobNo || jobId;
            document.getElementById('cancelJobReason').value = '';
            document.getElementById('cancelJobModal').style.display = 'flex';
        }

        function hideDashboardCancelModal() {
            document.getElementById('cancelJobModal').style.display = 'none';
        }

        function confirmDashboardCancelJob(btn) {
            const reason = document.getElementById('cancelJobReason').value.trim();

            if (!currentCancelJobId) {
                alert('Job details are missing. Cannot cancel.');
                return;
            }

            const payload = {
                job_id: currentCancelJobId,
                job_no: currentCancelJobNo,
                reason: reason
            };

            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Cancelling...';
            btn.disabled = true;

            fetch('{{ env("API_URL") }}' + '/cancel-job', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + getToken()
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                btn.innerHTML = originalText;
                btn.disabled = false;

                if (data.status) {
                    hideDashboardCancelModal();
                    if(typeof showToast === 'function') {
                        showToast(data.message || 'Job cancelled successfully.', 'success');
                    } else {
                        alert(data.message || 'Job cancelled successfully.');
                    }
                    
                    fetchCurrentRides();
                    fetchCancelledRides(1);
                    fetchDashboardSummary();
                } else {
                    if(typeof showToast === 'function') {
                        showToast(data.message || 'Failed to cancel job.', 'error');
                    } else {
                        alert(data.message || 'Failed to cancel job.');
                    }
                }
            })
            .catch(err => {
                btn.innerHTML = originalText;
                btn.disabled = false;
                if(typeof showToast === 'function') {
                    showToast('An error occurred while cancelling the job.', 'error');
                } else {
                    alert('An error occurred while cancelling the job.');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            fetchDashboardSummary();
            fetchCurrentRides();
            fetchCompletedRides(1);
            fetchCancelledRides(1);
        });
    </script>
@endsection