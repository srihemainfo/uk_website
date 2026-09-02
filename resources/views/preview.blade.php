<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $requestedHost = strtolower(request()->header('X-Forwarded-Host', request()->getHost()));
        $isUkHost = in_array($requestedHost, ['uk.goride.run', 'www.uk.goride.run']);
        $isUkGoride = in_array($requestedHost, ['goride.run', 'www.goride.run']) && request()->is('uk', 'uk/*');
        $loadUkTracking = $isUkHost || $isUkGoride;

        $faviconUrl = ($requestedHost === 'uk.goride.run')
            ? 'https://uk.goride.run/goride/img/Go-Ride-fav-icon.webp'
            : env('WEBSITE_APP_URL') . env('COUNTRY_SLUG_II') . '/goride/img/Go-Ride-fav-icon.webp';
    @endphp

    @if($loadUkTracking)
        <!-- Google Tag Manager -->
        <script>(function (w, d, s, l, i) {
                w[l] = w[l] || []; w[l].push({
                    'gtm.start':
                        new Date().getTime(), event: 'gtm.js'
                }); var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-5SR6M4VH');</script>
        <!-- End Google Tag Manager -->
    @endif
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('partials.seo')
    <link rel="shortcut icon" href="{{ $faviconUrl }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8f9fa;
            color: #111827;
            padding: 15px 10px;
        }

        .main-wrapper {
            max-width: 980px;
            margin: 0 auto;
        }

        .top-brand-bar {
            background: #ffffff;
            padding: 12px 20px;
            border-radius: 14px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            border: 1px solid #e5e7eb;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .top-brand-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-left: auto;
        }

        .brand-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-action-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f8fafc;
            border: 1px solid #d1d5db;
            color: #111827;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-action-icon:hover {
            background: #111827;
            color: #ffffff;
            border-color: #111827;
        }

        .badge-status-pill,
        .badge-status-confirmed,
        .badge-status-dispatched,
        .badge-status-onboarded,
        .badge-status-completed,
        .badge-status-cancelled {
            padding: 9px 23px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* Green: Confirmed & Completed */
        .badge-status-confirmed,
        .badge-status-completed {
            background: rgba(16, 185, 129, 0.12);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.25);
        }

        /* Yellow: Dispatched */
        .badge-status-dispatched {
            background: rgba(245, 158, 11, 0.15);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.35);
        }

        /* Blue: Onboarded */
        .badge-status-onboarded {
            background: rgba(37, 99, 235, 0.12);
            color: #2563eb;
            border: 1px solid rgba(37, 99, 235, 0.25);
        }

        /* Red: Cancelled */
        .badge-status-cancelled {
            background: rgba(239, 68, 68, 0.12);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.25);
        }

        .hero-meta-item {
            font-size: 14px;
            color: #4b5563;
            margin-bottom: 0;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 9px 23px;
            border-radius: 50px;
        }

        .hero-meta-item strong {
            color: #111827;
        }

        .hero-meta-item i {
            color: #f9c106;
        }

        .hero-banner-card {
            background: #ffffff;
            color: #111827;
            border-radius: 14px;
            padding: 20px 24px;
            margin-bottom: 5px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            position: relative;
        }

        .route-stacked-container {
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .route-location-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            position: relative;
        }

        .route-pin-icon {
            font-size: 18px;
            width: 20px;
            display: flex;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .route-pin-icon.pickup {
            color: #f9c106;
        }

        .route-pin-icon.dropoff {
            color: #111827;
        }

        .route-connector-line {
            width: 2px;
            height: 16px;
            border-left: 2px dotted #cbd5e1;
            margin-left: 9px;
            margin-top: 2px;
            margin-bottom: 2px;
        }

        .location-label {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            margin-bottom: 1px;
        }

        .location-address {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            line-height: 1.25;
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        .hero-security-fare-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 14px 16px;
        }

        .hero-sec-item-compact {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .hero-sec-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(249, 193, 6, 0.18);
            color: #111827;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .hero-sec-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            font-weight: 700;
        }

        .hero-sec-otp {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 2px;
            color: #111827;
            line-height: 1;
        }

        .hero-btn-track {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            background: #111827;
            color: #ffffff;
            text-decoration: none;
            border-radius: 16px;
            font-weight: 700;
            font-size: 11px;
            transition: all 0.2s ease;
        }

        .hero-btn-track:hover {
            background: #f9c106;
            color: #111827;
        }

        .pulse-dot-sm {
            width: 6px;
            height: 6px;
            background: #10b981;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: pulse-green 1.6s infinite;
            margin-right: 4px;
        }

        @keyframes pulse-green {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 6px rgba(16, 185, 129, 0);
            }

            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        .fare-amount {
            font-size: 32px;
            font-weight: 800;
            color: #111827;
            line-height: 1;
        }

        .btn-fare-info {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            padding: 0;
            color: #4b5563;
            font-size: 11px;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 22px;
            height: 22px;
            border-radius: 50%;
        }

        .btn-fare-info:hover,
        .btn-fare-info.active {
            color: white;
            background: black;
            border-color: black;
        }

        .btn-fare-info i {
            transition: transform 0.3s ease;
        }

        .btn-fare-info.active i {
            transform: rotate(180deg);
        }

        .fare-breakdown-collapse {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease, margin 0.3s ease;
            opacity: 0;
            margin-top: 0;
        }

        .fare-breakdown-collapse.show {
            max-height: 220px;
            opacity: 1;
            margin-top: 10px;
        }

        .fare-breakdown-inner {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 10px 14px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        .fare-breakdown-header {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #111827;
            padding-bottom: 6px;
            margin-bottom: 6px;
            border-bottom: 1px dashed #e5e7eb;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .fare-breakdown-header i {
            color: #f9c106;
        }

        .fare-line-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #4b5563;
            padding: 3px 0;
        }

        .fare-line-item span {
            font-weight: 500;
        }

        .fare-line-item strong {
            color: #111827;
            font-weight: 700;
        }

        .fare-total-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            font-weight: 800;
            color: #111827;
            padding-top: 6px;
            margin-top: 4px;
            border-top: 1.5px solid #111827;
        }

        .fare-total-line strong {
            color: #059669;
        }

        .preview-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 18px 22px;
            margin-bottom: 5px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        }

        .card-heading {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #111827;
            font-weight: 800;
            padding-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-heading i {
            color: #f9c106;
        }

        .person-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 14px 16px;
            height: 100%;
        }

        .person-info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            padding-bottom: 6px;
            border-bottom: 1px dashed #e5e7eb;
            margin-bottom: 6px;
        }

        .person-info-item a {
            color: #111827;
            font-weight: 700;
            text-decoration: none;
        }

        .person-info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .person-info-item span {
            color: #6b7280;
            font-weight: 600;
        }

        .person-info-item strong {
            color: #111827;
            font-weight: 700;
        }

        .reg-badge {
            display: inline-block;
            background: #111827;
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 5px;
        }

        .info-item-box {
            background: #f9fafb;
            border: 1px solid #f3f4f6;
            border-radius: 10px;
            padding: 6px 10px;
            height: 100%;
            transition: all 0.2s ease;
        }

        .info-item-box:hover {
            border-color: #d1d5db;
        }

        .info-label {
            font-size: 11px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .info-label i {
            color: #f9c106;
        }

        .info-value {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
        }

        .note-alert-banner {
            color: #111827;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .policy-list {
            padding-left: 18px;
            margin-bottom: 0;
        }

        .policy-list li {
            margin-bottom: 4px;
            color: #374151;
            font-size: 13px;
            line-height: 1.5;
        }

        .policy-list li:last-child {
            margin-bottom: 0;
        }

        @media (max-width: 768px) {

            .badge-status-pill,
            .badge-status-confirmed,
            .badge-status-dispatched,
            .badge-status-onboarded,
            .badge-status-completed,
            .badge-status-cancelled,
            .hero-meta-item {
                background: none;
                border: none;
            }

            .badge-status-pill,
            .badge-status-confirmed,
            .badge-status-dispatched,
            .badge-status-onboarded,
            .badge-status-completed,
            .badge-status-cancelled,
            .hero-meta-item {
                padding: 0px;
                font-size: 15px;
                margin: 5px;
            }

            body {
                padding: 10px 8px;
            }

            .top-brand-bar {
                padding: 12px 14px;
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
            }

            .brand-logo {
                order: 1;
            }

            .brand-actions {
                order: 2;
                margin-left: auto;
            }

            .top-brand-meta {
                order: 3;
                width: 100%;
                margin-left: 0;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 0px;
            }

            .hero-banner-card {
                padding: 16px 14px;
            }

            .fare-amount {
                font-size: 26px;
            }

            .preview-card {
                padding: 14px 14px;
            }
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 6mm 8mm;
            }

            body {
                background: #ffffff !important;
                padding: 0 !important;
                color: #000000 !important;
                font-size: 12px !important;
            }

            .main-wrapper {
                max-width: 100% !important;
                width: 100% !important;
                margin: 0 !important;
            }

            .btn-action-icon,
            .btn-fare-info,
            .hero-btn-track {
                display: none !important;
            }

            .top-brand-bar {
                margin-bottom: 4px !important;
                padding: 6px 12px !important;
                box-shadow: none !important;
                border: 1px solid #cbd5e1 !important;
            }

            .hero-banner-card {
                margin-bottom: 4px !important;
                padding: 8px 12px !important;
                box-shadow: none !important;
                border: 1px solid #cbd5e1 !important;
                page-break-inside: avoid;
                break-inside: avoid;
            }

            .preview-card {
                margin-bottom: 4px !important;
                padding: 8px 12px !important;
                box-shadow: none !important;
                border: 1px solid #cbd5e1 !important;
                page-break-inside: avoid;
                break-inside: avoid;
            }

            .card-heading {
                font-size: 11px !important;
                padding-bottom: 3px !important;
                margin-bottom: 4px !important;
            }

            .info-item-box {
                padding: 4px 6px !important;
            }

            .person-box {
                padding: 6px 8px !important;
            }

            .person-info-item {
                font-size: 11px !important;
                padding-bottom: 3px !important;
                margin-bottom: 3px !important;
            }

            .policy-list li {
                font-size: 11px !important;
                margin-bottom: 2px !important;
                line-height: 1.3 !important;
            }

            .fare-amount {
                font-size: 22px !important;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            .card-heading {
                page-break-after: avoid;
                break-after: avoid;
            }
        }
    </style>
</head>

<body>
    @if($loadUkTracking)
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5SR6M4VH" height="0" width="0"
                style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif

    <div class="main-wrapper">

        <div class="top-brand-bar">
            <a href="#" class="brand-logo text-decoration-none">
                <img src="https://www.goride.net.in/goride/img/logo-dark.png" alt="GoRide Logo"
                    style="height: 36px; width: auto;">
            </a>

            <div class="top-brand-meta">
                @php
                    $statusRaw = strtolower(trim($job_status ?? 'confirmed'));
                    if (in_array($statusRaw, ['dispatched', 'dispatch'])) {
                        $statusClass = 'badge-status-dispatched';
                        $statusIcon = 'fa-car-side';
                    } elseif (in_array($statusRaw, ['onboarded', 'onboard', 'started'])) {
                        $statusClass = 'badge-status-onboarded';
                        $statusIcon = 'fa-route';
                    } elseif (in_array($statusRaw, ['completed', 'complete', 'finished'])) {
                        $statusClass = 'badge-status-completed';
                        $statusIcon = 'fa-circle-check';
                    } elseif (in_array($statusRaw, ['cancelled', 'cancel', 'canceled'])) {
                        $statusClass = 'badge-status-cancelled';
                        $statusIcon = 'fa-circle-xmark';
                    } else {
                        $statusClass = 'badge-status-confirmed';
                        $statusIcon = 'fa-circle-check';
                    }
                @endphp
                <div class="badge-status-pill {{ $statusClass }}">
                    <i class="fa-solid {{ $statusIcon }}"></i> {{ $job_status ?? 'Booking Confirmed' }}
                </div>
                <div class="hero-meta-item">
                    <i class="fa-solid fa-hashtag"></i> Booking No : <strong>GRC-260730-00125</strong>
                </div>
            </div>
            <div class="brand-actions">
                <button onclick="window.print()" class="btn-action-icon" title="Print Booking">
                    <i class="fa-solid fa-print"></i>
                </button>
                <a href="tel:+442083373777" class="btn-action-icon" title="Call Support">
                    <i class="fa-solid fa-headset"></i>
                </a>
            </div>
        </div>

        <div class="hero-banner-card">
            <div class="row align-items-center g-3">

                <div class="col-lg-6 col-md-12">
                    <div class="route-stacked-container">
                        <div class="route-location-row">
                            <div class="route-pin-icon pickup">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="location-label">Pickup Location</div>
                                <div class="location-address">Heathrow Airport Terminal 2, Terminal Drop-Off Zone</div>
                            </div>
                        </div>

                        <div class="route-connector-line"></div>

                        <div class="route-location-row">
                            <div class="route-pin-icon dropoff">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="location-label">Dropoff Location</div>
                                <div class="location-address">Hilton London Gatwick Airport, South Terminal</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="hero-security-fare-card">

                        <div class="row g-2 align-items-center pb-2 mb-2 border-bottom">
                            <div class="col-6">
                                <div class="hero-sec-item-compact">
                                    <div class="hero-sec-icon">
                                        <i class="fa-solid fa-key"></i>
                                    </div>
                                    <div>
                                        <div class="hero-sec-label">Ride OTP</div>
                                        <div class="hero-sec-otp">5824</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="hero-sec-item-compact justify-content-end">
                                    <div class="hero-sec-icon">
                                        <i class="fa-solid fa-location-crosshairs"></i>
                                    </div>
                                    <div>
                                        <div class="hero-sec-label">
                                            <span class="pulse-dot-sm"></span> Live Tracking
                                        </div>
                                        <a href="#" class="hero-btn-track">
                                            <i class="fa-solid fa-location-dot"></i> Track
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between pt-1">
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-uppercase text-secondary fw-bold"
                                    style="font-size: 11px; letter-spacing: 0.5px;">Total Fare</span>
                                <button type="button" class="btn-fare-info active" id="btnToggleFareBreakdown"
                                    title="View Fare Breakdown">
                                    <i class="fa-solid fa-circle-info"></i>
                                </button>
                            </div>
                            <div class="fare-amount">£80.14</div>
                        </div>

                        <div class="fare-breakdown-collapse show" id="fareBreakdownCollapse">
                            <div class="fare-breakdown-inner">
                                <div class="fare-breakdown-header">
                                    <i class="fa-solid fa-receipt"></i> Fare Breakdown
                                </div>
                                <div class="fare-line-item">
                                    <span>Base Fare</span>
                                    <strong>£60.14</strong>
                                </div>
                                <div class="fare-line-item">
                                    <span>Airport Taxes &amp; Tolls</span>
                                    <strong>£10.00</strong>
                                </div>
                                <div class="fare-line-item">
                                    <span>Meet &amp; Greet</span>
                                    <strong>£10.00</strong>
                                </div>
                                <div class="fare-total-line">
                                    <span>Total Fare</span>
                                    <strong>£80.14</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="preview-card">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="person-box">
                        <div class="card-heading border-0 pb-0 mb-2">
                            <i class="fa-solid fa-user"></i> Passenger Details
                        </div>
                        <div class="person-info-item">
                            <span>Booked By</span>
                            <strong>John Williams</strong>
                        </div>
                        <div class="person-info-item">
                            <span>Booked For</span>
                            <strong>Deva Vasu</strong>
                        </div>
                        <div class="person-info-item">
                            <span>Mobile Number</span>
                            <strong>+44 9176333791</strong>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="person-box">
                        <div class="card-heading border-0 pb-0 mb-2">
                            <i class="fa-solid fa-id-card"></i> Driver Details
                        </div>
                        <div class="person-info-item">
                            <span>Driver Name</span>
                            <strong>James Smith</strong>
                        </div>
                        <div class="person-info-item">
                            <span>Vehicle Model</span>
                            <strong>Mercedes E-Class</strong>
                        </div>
                        <div class="person-info-item">
                            <span>Contact</span>
                            <div class="d-flex align-items-center gap-2">

                                <a class="btn-call-driver" href="tel:+449176333791">
                                    +449176333791
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="preview-card">
            <div class="card-heading">
                <i class="fa-solid fa-plane-arrival"></i> Pickup Information
            </div>
            <div class="row g-2">
                <div class="col-md-3 col-6">
                    <div class="info-item-box">
                        <div class="info-label"><i class="fa-solid fa-clock"></i> Flight Arrival</div>
                        <div class="info-value">30 Jul 2026 • 06:15 AM</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="info-item-box">
                        <div class="info-label"><i class="fa-solid fa-user-clock"></i> Pickup After Landing</div>
                        <div class="info-value">45 Minutes</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="info-item-box">
                        <div class="info-label"><i class="fa-solid fa-earth-asia"></i> Coming From</div>
                        <div class="info-value">Indonesia</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="info-item-box">
                        <div class="info-label"><i class="fa-solid fa-plane"></i> Flight Number</div>
                        <div class="info-value">BOING93794</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="preview-card">
            <div class="card-heading">
                <i class="fa-solid fa-sliders"></i> Ride Details
            </div>
            <div class="row g-2">
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="info-item-box d-flex align-items-center gap-2">
                        <i class="fa-solid fa-car text-dark fs-5"></i>
                        <div>
                            <div class="info-label mb-0">Vehicle</div>
                            <div class="info-value">Mercedes E-Class</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="info-item-box d-flex align-items-center gap-2">
                        <i class="fa-solid fa-users text-dark fs-5"></i>
                        <div>
                            <div class="info-label mb-0">Passengers</div>
                            <div class="info-value">2 Adults</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="info-item-box d-flex align-items-center gap-2">
                        <i class="fa-solid fa-suitcase text-dark fs-5"></i>
                        <div>
                            <div class="info-label mb-0">Luggage</div>
                            <div class="info-value">2 Bags</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="info-item-box d-flex align-items-center gap-2">
                        <i class="fa-solid fa-briefcase text-dark fs-5"></i>
                        <div>
                            <div class="info-label mb-0">Hand Luggage</div>
                            <div class="info-value">2 Bags</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="info-item-box d-flex align-items-center gap-2">
                        <i class="fa-solid fa-baby text-dark fs-5"></i>
                        <div>
                            <div class="info-label mb-0">Child Seat</div>
                            <div class="info-value">Infant Seat</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="info-item-box d-flex align-items-center gap-2">
                        <i class="fa-solid fa-handshake text-dark fs-5"></i>
                        <div>
                            <div class="info-label mb-0">Meet & Greet</div>
                            <div class="info-value">Included</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="info-item-box d-flex align-items-center gap-2">
                        <i class="fa-solid fa-wheelchair text-dark fs-5"></i>
                        <div>
                            <div class="info-label mb-0">Wheelchair</div>
                            <div class="info-value">Required</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="info-item-box d-flex align-items-center gap-2">
                        <i class="fa-solid fa-location-arrow text-dark fs-5"></i>
                        <div>
                            <div class="info-label mb-0">Distance</div>
                            <div class="info-value">45 Miles</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="preview-card">
            <div class="card-heading">
                <i class="fa-solid fa-clipboard-list"></i> Special Requirements
            </div>
            <div class="note-alert-banner">
                <ul class="policy-list">
                    <li>Meet & Greet required. Please assist with luggage on arrival.
                    </li>

                </ul>

            </div>
        </div>

        <div class="preview-card">
            <h6 class="fw-bold mb-2 text-dark">Terms and Conditions</h6>
            <ul class="policy-list">
                <li><strong>Platform Role:</strong> GoRide acts as a technology platform connecting you with
                    independent, licensed drivers. The transportation agreement is solely between you and the driver.
                </li>
                <li><strong>Fares & Payments:</strong> Final fares may vary depending on actual distance, wait times,
                    traffic conditions, and applicable tolls. You are responsible for all applicable booking charges.
                </li>
                <li><strong>Cancellations:</strong> Cancellation charges may apply depending on when the booking is
                    cancelled, in accordance with our Refund Policy.</li>
                <li><strong>Liability:</strong> GoRide provides the booking platform only and is not responsible for the
                    actions, conduct, or performance of independent drivers.</li>
            </ul>
        </div>

        <div class="preview-card">
            <h6 class="fw-bold mb-2 text-dark">Inclusions & Exclusions</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <strong class="text-dark d-block mb-1" style="font-size: 13px;">Included</strong>
                    <ul class="policy-list">
                        <li>191 miles included in the fare. Additional mileage: £1.2 per mile.</li>
                        <li>Complimentary waiting time of 30 minutes for pickup. Thereafter, £0.50 per minute applies.
                        </li>
                        <li>VAT included (where applicable).</li>
                        <li>Fuel charges included.</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <strong class="text-dark d-block mb-1" style="font-size: 13px;">Excluded</strong>
                    <ul class="policy-list">
                        <li>Parking charges will be charged at actuals.</li>
                        <li>Road tolls, Congestion Charge, and ULEZ charges (where applicable).</li>
                        <li>Any government or local authority charges, if applicable.</li>
                        <li>Additional mileage and waiting charges beyond the included limits.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="preview-card">
            <h6 class="fw-bold mb-2 text-dark">Safety Guidelines</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <strong class="text-dark d-block mb-1" style="font-size: 13px;">Before Starting the Ride</strong>
                    <ul class="policy-list">
                        <li>Verify the driver’s photo and name</li>
                        <li>Check vehicle details (number plate & model)</li>
                        <li>Cross-check ride charges shown in the app</li>
                        <li>Take odometer photo before trip starts</li>
                        <li>Share trip details with trusted contact</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <strong class="text-dark d-block mb-1" style="font-size: 13px;">After Completing the Ride</strong>
                    <ul class="policy-list">
                        <li>Take final odometer photo</li>
                        <li>Cross-check Govt. levy with receipts</li>
                        <li>Collect all your belongings</li>
                        <li>Confirm payment after verifying charges</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="preview-card">
            <h6 class="fw-bold mb-2 text-dark">Support & Assistance</h6>
            <p class="text-secondary mb-2" style="font-size: 13px; line-height: 1.5;">
                If you experience any difficulty in finding a driver or require assistance during your trip, please feel
                free to contact us via Call at <a href="tel:+442083373777"
                    class="fw-bold text-dark text-decoration-underline">+44 20 8337 3777</a>, or email us at <a
                    href="mailto:support.uk@goride.run"
                    class="fw-bold text-dark text-decoration-underline">support.uk@goride.run</a>.
            </p>
            <p class="text-secondary mb-2" style="font-size: 13px; line-height: 1.5;">
                We hope to see you again for your future outstation transport requirements. <strong>Have a safe and
                    pleasant journey.</strong>
            </p>
            <div class="text-dark fw-bold mb-1" style="font-size: 13px;">
                Best Regards, GoRide Team
            </div>
            <div>
                <a href="/terms" class="fw-bold text-dark text-decoration-underline" style="font-size: 13px;">Terms &
                    Conditions</a>
            </div>
        </div>

        <div class="text-center py-2 text-secondary" style="font-size: 12px;">
            © 2026 GoRide • Safe • Reliable • Affordable
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btnToggle = document.getElementById('btnToggleFareBreakdown');
            const collapseEl = document.getElementById('fareBreakdownCollapse');

            if (btnToggle && collapseEl) {
                btnToggle.addEventListener('click', function () {
                    btnToggle.classList.toggle('active');
                    collapseEl.classList.toggle('show');
                });
            }
        });
    </script>

</body>

</html>