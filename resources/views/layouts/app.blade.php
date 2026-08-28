<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('partials.seo')

    @php
        // Checks the original domain requested by the browser
        $requestedHost = request()->header('X-Forwarded-Host', request()->getHost());
        if ($requestedHost === 'uk.goride.run') {
            $faviconUrl = 'https://uk.goride.run/goride/img/Go-Ride-fav-icon.webp';
        } else {
            $faviconUrl = env('WEBSITE_APP_URL') . env('COUNTRY_SLUG_II') . '/goride/img/Go-Ride-fav-icon.webp';
        }
    @endphp

    {{-- Only add noindex if the user/bot actually typed uk.goride.run --}}
    @if($requestedHost === 'uk.goride.run' || $requestedHost === 'in.goride.uk' || $requestedHost === 'www.goride.uk' || $requestedHost === 'goride.uk')
        <meta name="robots" content="noindex, nofollow">
    @endif

    <!-- Google Identity Services -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <!-- Stripe JS SDK v3 -->
    <script src="https://js.stripe.com/v3/"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        rel="stylesheet">
    <link rel="shortcut icon" href="{{ $faviconUrl }}" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/css/intlTelInput.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Minus+Inlier+Sans&display=swap');

        .btn-swap-locations {
            position: absolute;
            right: 15px;
            top: 54%;
            transform: translateY(-50%);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
            color: #333;
        }

        .btn-swap-locations:hover {
            background: #f8f9fa;
        }

        .location-group-wrapper .location-input-field {
            padding-right: 45px;
        }

        .location-group-wrapper {
            position: relative;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Premium Full Card Skeleton Effect */
        .rc-loading-skeleton {
            pointer-events: none !important;
        }

        .rc-loading-skeleton .rc-vehicle-card,
        .rc-loading-skeleton .rc-new-driver-card,
        .rc-loading-skeleton .rc-bid-card {
            position: relative;
            overflow: hidden;
        }

        .rc-loading-skeleton h4,
        .rc-loading-skeleton span,
        .rc-loading-skeleton strong,
        .rc-loading-skeleton .rc-amenity-box,
        .rc-loading-skeleton .rc-bid-note,
        .rc-loading-skeleton .rc-bid-badge,
        .rc-loading-skeleton .rc-fare-amount,
        .rc-loading-skeleton .rc-vehicle-tag {
            background-color: #e5e7eb !important;
            color: transparent !important;
            border-color: transparent !important;
            border-radius: 6px !important;
            box-shadow: none !important;
        }

        .rc-loading-skeleton .rc-bid-amount strong {
            background-color: #e5e7eb !important;
            color: transparent !important;
        }

        .rc-loading-skeleton .rc-vehicle-features span {
            display: inline-block;
            min-width: 70px;
            height: 22px;
        }

        .rc-loading-skeleton .rc-driver-stat-col strong,
        .rc-loading-skeleton .rc-driver-stat-col span {
            display: inline-block;
            min-width: 80px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        .rc-loading-skeleton i,
        .rc-loading-skeleton img {
            opacity: 0 !important;
        }

        .rc-loading-skeleton .rc-driver-avatar,
        .rc-loading-skeleton .rc-vehicle-img-wrapper {
            background-color: #e5e7eb !important;
            border: none !important;
        }

        .rc-loading-skeleton .rc-driver-avatar {
            border-radius: 50% !important;
        }

        .rc-loading-skeleton .rc-vehicle-img-wrapper {
            border-radius: 8px !important;
            min-height: 150px;
        }

        .rc-loading-skeleton .rc-vehicle-card::after,
        .rc-loading-skeleton .rc-new-driver-card::after,
        .rc-loading-skeleton .rc-bid-card::after {
            content: "";
            position: absolute;
            top: 0;
            left: -150%;
            width: 150%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.7), transparent);
            animation: premiumShimmer 1.5s infinite ease-in-out;
            z-index: 10;
        }

        @keyframes premiumShimmer {
            100% {
                left: 150%;
            }
        }

        .premium-otp-input {
            width: 100%;
            padding: 3px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 24px;
            letter-spacing: 12px;
            text-align: center;
            font-weight: 700;
            transition: all 0.3s ease;
            box-sizing: border-box;
            outline: none;
            color: #111;
            background: #f9fafb;
        }

        .premium-otp-input:focus {
            border-color: #111;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.05);
        }

        .premium-otp-input::placeholder {
            letter-spacing: normal;
            font-weight: 500;
            font-size: 16px;
            color: #9ca3af;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont,
                "Segoe UI", "Helvetica Neue", Helvetica, Arial, sans-serif;
            color: #333;
            background: #fff;
            overflow-x: hidden;
        }

        #bookingMap {
            width: 100%;
            height: 100%;
            min-height: calc(100vh - 70px);
        }

        .date-time-screen {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .selectdate {
            display: none;
            font-size: 13px;
            font-weight: 600;
            color: #555;
            margin-top: -8px;
            margin-bottom: 15px;
        }

        #mapCloseBtn {
            display: none !important;
        }

        .confirm-modal-content {
            text-align: center;
            padding: 0px 0;
        }

        .confirm-icon {
            font-size: 36px;
            color: #000;
            margin-bottom: 0px;
        }

        .confirm-title {
            font-size: 24px;
            font-weight: 700;
            margin: 4px 0;
            color: #000;
        }

        .confirm-booking-id {
            background: #f5f5f5;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 10px;
            border: 2px solid #ddd;
        }

        .confirm-booking-id small {
            color: #999;
            font-size: 12px;
            display: block;
            margin-bottom: 4px;
        }

        .confirm-booking-id .id-value {
            font-weight: 700;
            font-size: 16px;
            color: #000;
        }

        .confirm-details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin: 12px;
        }

        .confirm-detail-item {
            text-align: left;
        }

        .confirm-detail-item small {
            /*color: #999;*/
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            margin-bottom: 6px;
        }

        .confirm-detail-item .detail-value {
            font-weight: 600;
            font-size: 14px;
            color: #000;
        }

        .confirm-fare-summary {
            background: #f9f9f9;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 10px;
            text-align: left;
        }

        .fare-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .fare-row span:first-child {
            color: #666;
        }

        .fare-row span:last-child {
            font-weight: 600;
            color: #000;
        }

        .fare-total {
            border-top: 2px solid #ddd;
            padding-top: 8px;
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            font-size: 16px;
        }

        .fare-total .total-amount {
            font-size: 18px;
            color: #000;
        }

        .confirm-info-text {
            font-size: 13px;
            color: #666;
            text-align: center;
            margin-bottom: 0px;
        }

        .confirm-btn-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .confirm-btn-group .btn-modal-secondary,
        .confirm-btn-group .btn-modal-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        button:active,
        a:active,
        .btn:active {
            color: #000 !important;
        }

        .location-type-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            /*background: #f0f0f0;*/
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            /*color: #666;*/
            margin-top: 4px;
        }

        .location-suggestions {
            position: absolute;
            top: calc(100% + 5px);
            left: 0;
            right: 0;
            background: #fff;
            border-radius: 8px;
            max-height: 280px;
            overflow-y: auto;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .15);
            display: none;
            z-index: 10000;
            border: 1px solid #eee;
        }

        .location-suggestions.show {
            display: block;
        }

        .suggestion-item {
            padding: 6px 15px;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 17px;
        }

        .suggestion-item:hover {
            background: #f5f5f5;
            padding-left: 20px;
        }

        .payment-summary {
            background: #f5f5f5;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .payment-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px dashed #d9d9d9;
            font-size: 14px;
        }

        .payment-item:last-of-type {
            border-bottom: none;
        }

        .payment-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0 0;
            font-size: 16px;
            font-weight: 700;
        }

        .grand-total {
            margin-top: 10px;
            padding-top: 14px;
            border-top: 2px solid #d5d5d5;
        }

        .navbar-uber {
            background: white;
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand-uber {
            font-size: 24px;
            font-weight: 700;
            color: white;
            margin-right: auto;
            cursor: pointer;
        }

        .navbar-brand-uber img {
            height: 50px;
            width: auto;
            display: block;
        }

        .account-dropdown {
            display: none;
            position: absolute;
            top: 55px;
            right: 0;
            width: 320px;
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .18);
            z-index: 9999;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .account-dropdown.show {
            display: block;
        }

        .account-header {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            border-bottom: 1px solid #ececec;
        }

        .account-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #000 0%, #000 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            color: #fff;
            font-weight: 700;
        }

        .account-info h5 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
        }

        .account-info span {
            color: #777;
            font-size: 13px;
        }

        .account-menu a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 10px 20px;
            color: #222;
            text-decoration: none;
            transition: .3s;
        }

        .account-menu a i:first-child {
            width: 22px;
            text-align: center;
            font-size: 16px;
        }

        .account-menu a span {
            flex: 1;
            font-size: 15px;
        }

        .account-menu a:hover {
            background: #f7f7f7;
        }

        .account-footer {
            border-top: 1px solid #ececec;
        }

        .meet-greet-option {
            display: flex;
            align-items: center;
            gap: 14px;
            border-radius: 12px;
            cursor: pointer;
        }

        .meet-greet-option:hover {
            border-color: #000;
        }

        .meet-greet-option input {
            width: 18px;
            height: 18px;
            accent-color: #000;
        }

        .meet-greet-content {
            flex: 1;
        }

        .meet-greet-content small {
            display: block;
            margin-top: 4px;
            color: #666;
            font-size: 13px;
        }

        .meet-price {
            font-weight: 700;
            font-size: 15px;
            color: #000;
        }

        .account-footer a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 16px 20px;
            color: black;
            font-weight: 600;
            text-decoration: none;
        }

        .account-footer a:hover {
            background: #fff4f4;
        }

        .navbar-menu {
            display: flex;
            gap: 2rem;
            align-items: center;
            margin: 0;
            list-style: none;
        }

        .navbar-menu a,
        .navbar-menu button {
            color: black;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            border: none;
            background: none;
            cursor: pointer;
            transition: color 0.3s;
        }

        .navbar-menu a:hover,
        .navbar-menu button:hover {
            color: #000;
        }

        /*.navbar-menu .user-btn {*/
        /*    background: #fff;*/
        /*    color: #000;*/
        /*    border-radius: 20px;*/
        /*    font-weight: 600;*/
        /*    padding: 8px 16px;*/
        /*}*/
        /*.navbar-menu .user-btn:hover {*/
        /*    color: #000;*/
        /*    background: #f5f5f5;*/
        /*}*/
        .dropdown-menu-navbar {
            display: none;
            position: absolute;
            top: 64px;
            right: 20px;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            min-width: 200px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1001;
        }

        .dropdown-menu-navbar.show {
            display: block;
        }

        .dropdown-menu-navbar a,
        .dropdown-menu-navbar button {
            display: block;
            width: 100%;
            padding: 12px 16px;
            text-align: left;
            border: none;
            background: none;
            color: #333;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.2s;
        }

        .dropdown-menu-navbar a:hover,
        .dropdown-menu-navbar button:hover {
            background: #f5f5f5;
        }

        .hero-container {
            display: flex;
            min-height: calc(100vh - 70px);
            position: relative;

        }

        .hero-form-section {
            /* width: 100%; */
            background: #fff;
            padding: 20px 10px;
            overflow-y: auto;
            overflow-x: visible;
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: calc(100vh - 70px);
            max-width: 600px;
        }

        .hero-form-section::before {
            content: "";
            position: absolute;
            inset: 0;
            background: white;
            z-index: -1;
        }

        .hero-map-section {
            flex: 1;
            background: linear-gradient(135deg, #f5f5f517 0%, #e8e8e81c 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            min-height: calc(100vh - 70px);
        }

        .hero-map-section iframe {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #bookingMap {
            width: 100%;
            height: 100%;
        }

        #bookingImage {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .hero-side-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .hero-banner-content {
            position: absolute;
            top: 50%;
            left: 60px;
            transform: translateY(-50%);
            z-index: 2;
            max-width: 550px;
            color: #fff;
        }

        .hero-banner-content h1 {
            font-size: 52px;
            line-height: 1.15;
            margin-bottom: 18px;
        }

        .hero-banner-content p {
            font-size: 18px;
            line-height: 1.7;
            color: rgba(255, 255, 255, .9);
        }

        .hero-badge {
            display: inline-block;
            padding: 8px 16px;
            margin-bottom: 18px;
            background: rgba(255, 255, 255, .15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, .25);
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
        }

        #bookingImage::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .72);
            z-index: 1;
        }

        .offer-credits-section {
            background: #a9a9a980;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 16px;
            border: 1px solid #dddddd;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .offer-icon {
            font-size: 20px;
            /*color: grey;*/
            width: 47px;
            height: 47px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .offer-content {
            flex: 1;
        }

        .offer-title {
            font-size: 13px;
            font-weight: 700;
            color: #333;
            margin-bottom: 2px;
        }

        .offer-subtitle {
            font-size: 12px;
            color: black;
        }

        .offer-apply-btn {
            background: black;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .offer-apply-btn:hover {
            background: #f9c106;
            transform: translateY(-2px);
        }

        .location-input-field {
            width: 100% !important;
            padding: 12px 15px 12px 15px !important;
            border: 2px solid #e0e0e0 !important;
            border-radius: 10px !important;
            font-size: 17px !important;
            background: #fff !important;
            transition: border-color 0.25s ease;
            /* box-shadow 0.25s ease; */
            background 0.25s ease !important;
            cursor: text !important;
        }

        .location-input-field:focus {
            outline: none !important;
            background: #fff !important;
            border-color: #111 !important;

        }

        .location-input-wrapper {
            position: relative;
        }

        .location-input-wrapper .loc-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #bbb;
            font-size: 15px;
            pointer-events: none;
            transition: color 0.25s;
            z-index: 1;
        }

        .location-input-wrapper:focus-within .loc-icon {
            color: #111;
        }

        .location-input-wrapper.is-loading::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 10px;
            pointer-events: none;
            animation: locInputPulse 0.9s ease-in-out infinite;
            border: 2px solid #f9c106;
        }

        @keyframes locInputPulse {
            0% {
                opacity: 0.8;
                box-shadow: 0 0 0 0px rgba(249, 193, 6, 0.3);
            }

            50% {
                opacity: 1;
                box-shadow: 0 0 0 5px rgba(249, 193, 6, 0);
            }

            100% {
                opacity: 0.8;
                box-shadow: 0 0 0 0px rgba(249, 193, 6, 0);
            }
        }

        /* Skeleton shimmer for loading state in suggestions */
        .suggestion-skeleton {
            padding: 10px 15px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .suggestion-skeleton .sk-icon {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: linear-gradient(90deg, #ececec 25%, #f5f5f5 50%, #ececec 75%);
            background-size: 200% 100%;
            animation: shimmer 1.2s infinite;
            flex-shrink: 0;
        }

        .suggestion-skeleton .sk-line {
            height: 13px;
            border-radius: 6px;
            background: linear-gradient(90deg, #ececec 25%, #f5f5f5 50%, #ececec 75%);
            background-size: 200% 100%;
            animation: shimmer 1.2s infinite;
        }

        .suggestion-skeleton .sk-line.long {
            width: 70%;
        }

        .suggestion-skeleton .sk-line.short {
            width: 45%;
        }

        .suggestion-skeleton .sk-line.medium {
            width: 58%;
        }

        @keyframes shimmer {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .find-trip-locations .route-indicator {
            padding-top: 19px;
            padding-bottom: 15px;
        }

        .location-suggestions {
            position: absolute;
            top: calc(100% + 5px);
            left: 0;
            right: 0;
            background: #fff;
            border-radius: 8px;
            max-height: 280px;
            overflow-y: auto;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .15);
            display: none;
            z-index: 10000;
            border: 1px solid #eee;
        }

        .location-suggestions.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        .suggestion-item {
            padding: 10px 15px;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 17px;
        }

        .suggestion-item:last-child {
            border-bottom: none;
        }

        .suggestion-item:hover {
            background: #f5f5f5;
            padding-left: 20px;
        }

        .suggestion-item i {
            color: #000;
            font-size: 14px;
            width: 18px;
        }

        .time-dropdown-wrapper {
            position: relative;
            width: 100%;
        }

        .time-dropdown-btn {
            width: 100%;
            padding: 12px 18px 12px 15px;
            background: #fff;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s;
            text-align: left;
        }

        .time-dropdown-btn:hover {
            border-color: #000;
            background: #fff;
        }

        .time-dropdown-btn.active {
            border-color: #000;
            background: #fff;
        }

        .time-dropdown-list {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 10px 10px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 10000;
            display: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .time-dropdown-list.show {
            display: block;
        }

        .time-dropdown-item {
            padding: 12px 16px;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.2s;
            font-size: 15px;
            font-weight: 500;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .night-moon-icon {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #e5e7eb;
            color: #1f2937;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            margin-left: 8px;
            flex-shrink: 0;
        }

        .night-charge-notice-card {
            background: #fff8e7;
            border: 1px solid #ffd54f;
            border-radius: 12px;
            padding: 12px 16px;
            margin-top: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.08);
            transition: all 0.3s ease;
        }

        .night-charge-icon-wrap {
            width: 33px;
            height: 33px;
            border-radius: 50%;
            background: #f9bf0078;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .night-charge-moon-icon {
            font-size: 16px;
            color: #624b00;
        }

        .night-charge-text-content {
            display: flex;
            flex-direction: column;
            gap: 2px;
            text-align: left;
        }

        .night-charge-title {
            font-size: 14px;
            font-weight: 700;
            color: #78350f;
            line-height: 1.3;
        }

        .night-charge-subtitle {
            font-size: 12px;
            font-weight: 400;
            color: #92400e;
            line-height: 1.3;
        }

        .time-dropdown-icon {
            font-size: 12px;
            transition: transform 0.3s;
        }

        .time-dropdown-btn.active .time-dropdown-icon {
            transform: rotate(180deg);
        }

        .via-point-row {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            animation: slideInUp .3s ease;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .via-point-row input {
            flex: 1;
            padding: 10px 12px !important;
            border: 2px solid #ddd !important;
            border-radius: 8px !important;
            font-size: 16px !important;
            background: #f5f5f5 !important;
            transition: all 0.3s ease !important;
        }

        .via-point-row input:focus {
            outline: none !important;
            background: #fff !important;
            border-color: #000 !important;
        }

        .via-point-row .remove-via {
            background: #f5f5f5;
            border: 1px solid #ddd;
            color: #666;
            border-radius: 8px;
            width: 25px;
            height: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
        }

        .via-point-row .remove-via:hover {
            background: black;
            color: white;
        }

        .btn-add-via {
            background: transparent;
            border: 2px dashed #ddd;
            color: black;
            padding: 5px 13px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-add-via:hover {
            color: black;
            background: rgba(102, 126, 234, 0.05);
        }

        .form-group-uber {
            margin-bottom: 15px;
            position: relative;
        }

        .form-group-uber label {
            display: block;
            font-size: 18px;
            font-weight: 600;
            color: black;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
        }

        .form-group-uber input,
        .form-group-uber select {
            width: 100%;
            box-sizing: border-box !important;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding: 11px 13px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 17px;
            transition: all 0.3s ease;
            background: #fff;
        }

        .form-group-uber input:focus,
        .form-group-uber select:focus {
            outline: none;
            background: #fff;
            border-color: #000;
        }

        .flight-time-dual-dropdown {
            width: 100% !important;
            padding: 0 !important;
            display: none;
            flex-direction: column;
        }

        .flight-time-dual-dropdown.show {
            display: flex !important;
        }

        .flight-time-col-header {
            display: flex;
            border-bottom: 1px solid #eee;
            background: #f9f9f9;
            font-size: 11px;
            font-weight: 700;
            color: #666;
            text-transform: uppercase;
            text-align: center;
        }

        .flight-time-col-header div {
            flex: 1;
            padding: 6px 0;
        }

        .flight-time-cols-container {
            display: flex;
            height: 200px;
        }

        .flight-time-col {
            flex: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .flight-time-col:first-child {
            border-right: 1px solid #eee;
        }

        .flight-time-col::-webkit-scrollbar {
            width: 4px;
        }

        .flight-time-col::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 4px;
        }

        .flight-time-item {
            padding: 8px 0;
            text-align: center;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: #333;
            transition: all 0.2s;
        }

        .flight-time-item:hover {
            background: #f0f0f0;
        }

        .flight-time-item.selected {
            background: #f0f0f0;
            color: #000;

        }

        .btn-search-uber {
            padding: 10px;
            background: linear-gradient(135deg, #000 0%, #000 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-search-uber:hover {
            transform: translateY(-2px);
        }

        .form-section {
            display: none;
            animation: fadeIn 0.4s ease;
            flex-direction: column;
            flex: 1;
            min-height: 100%;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-section.active {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-height: 100%;
        }

        .step-bottom-btns {
            margin-top: auto;
            padding-top: 12px;
            padding-bottom: 0px;
        }

        .vehicle-grid-uber {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 9px;
            margin: 20px 0;
        }

        .vehicle-info-section h6 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #111;
        }

        .vehicle-info-section h6 i {
            color: #000;
        }

        .vehicle-recommended-list {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
        }

        .vehicle-recommended-list li {
            margin-bottom: 8px;
            font-size: 14px;
            color: #444;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            line-height: 1.4;
        }

        .vehicle-recommended-list li i.fa-check-circle {
            color: #28a745;
            margin-top: 3px;
        }

        .vehicle-recommended-list li i.fa-exclamation-triangle {
            color: #dc3545;
            margin-top: 3px;
        }

        .vehicle-recommended-list li i.fa-star {
            color: #f8be00;
            margin-top: 3px;
        }

        .child-seat-status {
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            margin-bottom: 25px;
        }

        .child-seat-status.available {
            background-color: #e6f4ea;
            color: #1e8e3e;
        }

        .child-seat-status.unavailable {
            background-color: #fce8e6;
            color: #d93025;
        }

        .vehicle-modal-price-btn {
            width: 100%;
            background: #000;
            color: #fff;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .vehicle-modal-price-btn:hover {
            background: #333;
        }

        .vehicle-modal-price-range {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f5f5f5;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 15px;
            color: #333;
        }

        .vehicle-modal-price-range i {
            color: #f8be00;
            font-size: 16px;
        }

        .vehicle-image img {
            width: 100%;
            height: 110px;
            object-fit: cover;
        }

        .vehicle-name {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
            max-width: 100px;
        }

        .vehicle-name-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .vehicle-info-btn {
            width: 24px;
            height: 24px;
            border: none;
            border-radius: 50%;
            background: #f3f3f3;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .3s;
        }

        .vehicle-info-btn:hover {
            background: #000;
            color: #fff;
        }

        .vehicle-info-btn i {
            font-size: 13px;
        }

        .vehicle-features {
            display: flex;
            gap: 18px;
            color: #666;
            font-size: 15px;
        }

        .vehicle-features span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .vehicle-features i {
            font-size: 14px;
        }

        .vehicle-price {
            font-size: 23px;
            font-weight: 700;
            white-space: nowrap;
        }

        .driver-item {
            background: #fff;
            border: 2px solid #e8e8e8;
            border-radius: 16px;
            padding: 10px;
            margin-bottom: 18px;
            transition: .3s;
            cursor: pointer;
        }

        .rc-car-image {
            background: #f9f9f9;
            border-radius: 14px;
            /*overflow: hidden;*/
            margin-bottom: 16px;
            text-align: center;
            padding: 20px;
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .rc-car-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            max-width: 100%;
        }

        .driver-item:hover {
            border-color: #000;
            box-shadow: 0 12px 30px rgba(0, 0, 0, .08);
            transform: translateY(-3px);
        }

        .driver-item.selected {
            border: 2px solid #000;
            background: #fafafa;
        }

        .driver-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
        }

        .driver-left {
            display: flex;
            gap: 15px;
        }

        .driver-avatar {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
        }

        .driver-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .driver-name {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
        }

        .driver-rating {
            margin-top: 4px;
            color: #777;
            font-size: 14px;
        }

        .driver-rating i {
            color: #FFC107;
        }

        .driver-vehicle {
            margin-top: 5px;
            font-size: 14px;
            color: #444;
        }

        .driver-eta {
            margin-top: 6px;
            color: #0d6efd;
            font-size: 13px;
            font-weight: 600;
        }

        .driver-price-box {
            text-align: right;
            min-width: 110px;
        }

        .driver-price-box span {
            display: block;
            font-size: 12px;
            color: #888;
        }

        .driver-price-box h3 {
            margin: 3px 0 0;
            font-size: 32px;
            font-weight: 800;
            color: #000;
        }

        .driver-tags {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 18px;
        }

        .driver-tag {
            padding: 7px 12px;
            background: #f5f5f5;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        .driver-tag.lowest {
            background: #dff5df;
            color: #0a7b0a;
        }

        .driver-footer {
            margin-top: 18px;
            padding-top: 18px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .driver-total {
            font-size: 14px;
            color: #666;
        }

        .driver-total strong {
            display: block;
            font-size: 22px;
            color: #000;
            margin-top: 3px;
        }

        .select-driver-btn {
            background: #000;
            color: #fff;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 700;
            transition: .3s;
        }

        .select-driver-btn:hover {
            background: #222;
        }

        .btn-group-uber {
            display: flex;
            gap: 10px;
            justify-content: space-between;
        }

        .btn-back-uber {
            padding: 11px;
            background: #f5f5f5;
            color: #000;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-back-uber:hover {
            background: #eee;
            border-color: #999;
        }

        .btn-cancel-job-small {
            padding: 11px 22px;
            background: #dc2626;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
            letter-spacing: 0.2px;
        }

        .btn-cancel-job-small:hover {
            background: #b91c1c;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(220, 38, 38, 0.35);
        }

        .btn-cancel-job-small:active {
            transform: translateY(0);
        }

        .passenger-form-uber {
            background: #f9f9f9;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 12px;
            border: 1px solid #eee;
        }

        .passenger-form-uber input {
            width: 100%;
            padding: 9px;
            margin-bottom: 6px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 12px;
        }

        .passenger-form-uber input:last-child {
            margin-bottom: 0;
        }

        #passengerFields {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 20px;
        }

        #passengerFields .passenger-form-uber {
            margin-bottom: 0;
        }

        .booking-title {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 10px;
            color: black;
            font-family: 'Poppins', sans-serif;
        }

        .modal-uber {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }

        .modal-uber.show {
            display: flex;
        }

        .modal-content-uber {
            background: #fff;
            border-radius: 16px;
            max-width: 400px;
            width: 90%;
            padding: 20px 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.4s cubic-bezier(0.22, 1, 0.36, 1);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header-uber {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #000;
        }

        .modal-body-uber {
            margin-bottom: 20px;
            color: #666;
            font-size: 14px;
            line-height: 1.5;
        }

        .otp-input-uber {
            width: 100%;
            padding: 14px;
            font-size: 24px;
            text-align: center;
            letter-spacing: 8px;
            border: 2px solid #ddd;
            border-radius: 8px;
            margin: 16px 0;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .otp-input-uber:focus {
            outline: none;
            border-color: #000;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-modal-primary {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #000 0%, #000 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 12px;
            transition: all 0.3s ease;
        }

        .btn-modal-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-modal-secondary {
            width: 100%;
            padding: 12px;
            background: #f5f5f5;
            color: #000;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
            transition: all 0.3s ease;
        }

        .btn-modal-secondary:hover {
            background: #eee;
        }

        .otp-btn-group {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .otp-btn-group .btn-modal-primary,
        .otp-btn-group .btn-modal-secondary {
            flex: 1;
            margin-top: 0;
        }

        .app-promo-modal-content {
            text-align: center;
            position: relative;
        }

        .app-promo-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #000;
        }

        .app-promo-subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .app-promo-benefits {
            background: #f9f9f9;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: left;
        }

        .app-promo-benefit {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 14px;
            color: #333;
        }

        .btn-modal-primary,
        .btn-modal-secondary {
            flex: 1;
            border: none;
            border-radius: 12px;
            padding: 9px 18px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            text-decoration: none;
            text-align: center;
        }

        .btn-modal-primary {
            background: #000;
            color: #fff;
        }

        .btn-modal-primary:hover {
            background: #222;
        }

        .btn-modal-secondary {
            background: #f3f3f3;
            color: #000;
        }

        .btn-modal-secondary:hover {
            background: #e7e7e7;
        }

        .app-promo-benefit:last-child {
            margin-bottom: 0;
        }

        .app-promo-benefit i {
            color: #f9c106;
            font-size: 16px;
            width: 20px;
        }

        .find-trip-card {
            /* background: #f9f9f9; */
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            margin-bottom: 16px;
        }

        .find-trip-card h4 {
            display: block;
            font-size: 18px;
            font-weight: 600;
            color: black;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
        }

        .find-trip-locations {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .trip-location-item {
            background: #fff;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            cursor: pointer;
            justify-content: space-between;
        }

        .trip-location-item.dropoff {
            justify-content: space-between;
        }

        .trip-location-icon {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .location-dot {
            font-size: 8px;
        }

        .location-square {
            font-size: 10px;
        }

        /* FIXED TIME PANEL */
        .time-selection-panel {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            z-index: 100;
            padding: 20px 40px;
            overflow-y: auto;
            z-index: 99999;
        }

        .time-selection-panel.show {
            display: block;
        }

        .time-panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .time-panel-header-back {
            cursor: pointer;
            padding: 4px;
            background: none;
            border: none;
            font-size: 16px;
        }

        .time-panel-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 16px;
            line-height: 1.2;
        }

        .time-panel-subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 16px;
        }

        .time-inputs {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 16px;
        }

        .time-input-wrapper {
            position: relative;
            width: 100%;
            box-sizing: border-box !important;
        }

        .time-input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #333;
            z-index: 2;
            pointer-events: none;
            font-size: 14px;
        }

        .time-input-field {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box !important;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding: 12px 35px 12px 38px;
            border-radius: 10px;
            border: 2px solid #ddd;
            background: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            color: #000;
            height: 48px;
            line-height: 1.2;
            margin: 0;
            display: block;
            -webkit-tap-highlight-color: transparent;
        }

        .flatpickr-input {
            box-sizing: border-box !important;
            -webkit-appearance: none !important;
            max-width: 100% !important;
        }

        .time-input-field:hover,
        .time-input-field:focus {
            border-color: #000;
            background: #fff;
            outline: none;
        }

        .form-group-uber textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background: #fff;
            box-sizing: border-box !important;
            -webkit-appearance: none;
            /*resize:vertical;*/
            /*min-height:120px;*/
        }

        .form-group-uber textarea:focus {
            outline: none;
            border-color: #000;
            background: #fff;
        }

        .time-input-chevron {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #333;
            font-size: 12px;
            pointer-events: none;
            z-index: 2;
        }

        .time-hint {
            font-size: 15px;
            color: #666;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .for-me-modal-header {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 16px;
            position: relative;
        }

        .for-me-modal-title {
            font-size: 21px;
            font-weight: 700;
            text-align: center;
        }

        .for-me-close-btn {
            cursor: pointer;
            background: none;
            border: none;
            font-size: 18px;
            position: absolute;
            right: 0;
        }

        .for-me-options {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }

        .passenger-details-layout {
            display: flex;
            gap: 15px;
            align-items: center;
            justify-content: space-between;
        }

        .for-me-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            padding: 8px 0;
            background: none;
            border: none;
            text-align: left;
            width: 100%;
        }

        .for-me-option-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .for-me-option-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ccc;
            font-size: 18px;
        }

        .for-me-option-avatar.user-plus {
            color: #000;
        }

        .for-me-option-text {
            font-weight: 500;
            font-size: 14px;
        }

        .for-me-radio {
            font-size: 16px;
        }

        .reviews-section {
            background: #ddddddd9;
        }

        .section-padding {
            padding: 50px 0;
        }

        .section-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #000;
            font-family: 'Poppins', sans-serif;
        }

        .review-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .review-card {
            background: #fff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .review-rating {
            color: #ffc107;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .review-text {
            font-size: 14px;
            color: #666;
            margin-bottom: 16px;
            line-height: 1.6;
            font-style: italic;
        }

        .review-author {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .review-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, #000 0%, #000 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #fff;
            font-size: 12px;
            flex-shrink: 0;
        }

        .review-name {
            font-weight: 600;
            font-size: 13px;
            color: #000;
        }

        .review-title {
            font-size: 12px;
            color: #999;
        }

        .app-download-section {
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            color: #fff;
            padding: 60px 0;
        }

        .app-download-content {
            text-align: center;
        }

        .app-download-title {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .app-download-subtitle {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 40px;
        }

        .app-store-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
        }

        .app-store-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            background: black;
            color: #000;
            padding: 4px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
        }

        .app-store-btn i {
            font-size: 24px;
            color: white;
        }

        .app-store-btn-text {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .app-store-btn-label {
            font-size: 11px;
            opacity: 0.8;
            color: white;
        }

        .app-store-btn-name {
            font-size: 16px;
            font-weight: 700;
            color: white;
        }

        .owl-carousel {
            display: none;
        }

        footer {
            background: #000;
            color: #fff;
            padding: 60px 0 20px;
        }

        .footer-logo-section {
            margin-bottom: 30px;
        }

        .footer-logo {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 8px;
        }

        .footer-logo img {
            height: 70px;
            width: auto;
            object-fit: contain;
        }

        .footer-tagline {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 0px;
        }

        .footer-section {
            margin-bottom: 30px;
        }

        .footer-section-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #fff;
        }

        .footer-phone {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-phone a {
            display: inline;
        }

        .footer-links-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-links-list a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }

        .footer-app-downloads {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 25px;
            margin-top: 10px;
        }

        .footer-store-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: white;
            color: #ffffff !important;
            padding: 8px 14px;
            border-radius: 10px;
            width: 185px;
            text-decoration: none !important;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .footer-store-btn:hover {
            color: #ffffff !important;
            transform: translateY(-2px);
        }

        .footer-store-btn i {
            font-size: 22px;
            color: black;
        }

        .footer-store-btn-text {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .footer-store-btn-sub {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: black;
            opacity: 0.9;
            margin-bottom: 2px;
        }

        .footer-store-btn-title {
            font-size: 15px;
            font-weight: 700;
            color: black;
        }

        .footer-links-list a:hover {
            color: #fff;
        }

        .footer-social-icons {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .social-icon:hover {
            background: #fff;
            color: #000;
            transform: translateY(-3px);
        }

        .footer-app-section {
            margin-bottom: 30px;
        }

        .footer-app-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .footer-app-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .footer-app-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.2);
            width: 100%;
        }

        .footer-app-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            text-align: center;
            font-size: 15px;
            color: rgba(255, 255, 255, 0.6);
        }

        .app-promo-close {
            position: absolute;
            top: -16px;
            right: -16px;
            width: 30px;
            height: 30px;
            border: none;
            border-radius: 50%;
            background: #f5f5f5;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            z-index: 10;
        }

        .app-promo-close i {
            font-size: 14px;
        }

        .app-promo-close:hover {
            background: #e9e9e9;
            transform: scale(1.05);
        }

        .app-promo-close:active {
            transform: scale(0.95);
        }

        .faq-section {
            background: #ddddddd9;
        }

        .faq-item {
            border-bottom: 1px solid white;
            padding: 20px;
        }

        .faq-item:last-child {
            border-bottom: none;
        }

        .faq-question {
            font-weight: 600;
            font-size: 16px;
            color: #000;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            margin: -12px;
            transition: all 0.3s;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
        }

        .faq-question:hover {
            color: #000;
        }

        .faq-icon {
            font-size: 12px;
            /*color: #999;*/
            transition: all 0.3s;
        }

        .faq-answer {
            display: none;
            font-size: 16px;
            /*color: #666;*/
            margin-top: 12px;
            line-height: 1.6;
        }

        .faq-answer.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        .ride-dropdown-btn {
            width: 100%;
            height: 42px;
            padding: 0 15px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: .3s;
        }

        .ride-dropdown-btn:hover {
            border-color: #000;
        }

        .ride-dropdown-btn span {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .ride-dropdown-btn i {
            font-size: 13px;
        }

        .ride-dropdown-menu {
            position: absolute;
            top: 48px;
            left: 0;
            width: 240px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .15);
            overflow: hidden;
            display: none;
            z-index: 10000;
        }

        .ride-dropdown-menu.show {
            display: block;
        }

        .ride-dropdown-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 11px 12px;
            cursor: pointer;
            transition: .25s;
        }

        .ride-dropdown-item:hover {
            background: #f6f6f6;
        }

        .ride-dropdown-item.active {
            background: #f3f3f3;
        }

        .ride-dropdown-item i:first-child {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #efefef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-size: 13px;
        }

        .ride-dropdown-item strong {
            display: block;
            font-size: 14px;
            color: #111;
        }

        .ride-dropdown-item small {
            display: block;
            font-size: 12px;
            color: #777;
            margin-top: 2px;
        }

        .confirm-modal-content {
            text-align: center;
            padding: 0px 0;
        }

        .confirm-icon {
            font-size: 36px;
            color: #000;
            margin-bottom: 0px;
        }

        .confirm-details {
            background: #f5f5f5;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: left;
            font-size: 13px;
        }

        .confirm-detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .confirm-detail-row:last-child {
            margin-bottom: 0;
        }

        .confirm-detail-label {
            color: #999;
        }

        .confirm-detail-value {
            font-weight: 600;
            color: #000;
        }

        input[type="radio"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
            margin: 0;
            accent-color: #000;
        }

        .booking-title-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 4px;
        }

        .phone-input-wrapper {
            display: flex;
            align-items: center;
            border: 2px solid #ddd;
            border-radius: 8px;
            background: #f5f5f5;
            overflow: hidden;
            transition: .3s;
        }

        .country-code {
            padding: 11px 14px;
            background: #ececec;
            border-right: 1px solid #ddd;
            font-size: 14px;
            font-weight: 600;
            color: #000;
            white-space: nowrap;
        }

        .phone-number-input {
            flex: 1;
            border: none !important;
            background: transparent !important;
            box-shadow: none !important;
            padding: 11px 14px !important;
        }

        .phone-number-input:focus {
            outline: none;
        }

        .mobile-menu-btn {
            display: none;
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 50%;
            background: #f5f5f5;
            cursor: pointer;
            font-size: 18px;
            color: #000;
            align-items: center;
            justify-content: center;
        }

        .goride-app-section {
            padding: 45px 0;
        }

        .goride-app-wrapper {
            background: #111;
            border-radius: 24px;
            overflow: hidden;
        }

        .goride-app-left {
            padding: 35px;
            color: #fff;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .goride-app-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            background: rgb(249 249 249);
            border-radius: 50px;
            font-size: 14px;
            width: max-content;
            margin-bottom: 10px;
            color: black;
        }

        .goride-app-heading {
            font-size: 34px;
            font-weight: 800;
            line-height: 1.2;
        }

        .goride-app-heading span {
            color: #f9c106;
        }

        .goride-app-text {
            font-size: 16px;
            color: #d6d6d6;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        .goride-app-features {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .goride-feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #fff;
        }

        .goride-feature-item i {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #fff;
            color: #111;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .goride-download-btns {
            display: flex;
            justify-content: center;
        }

        .goride-store-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            background: #fff;
            color: #111;
            text-decoration: none;
            padding: 7px 20px;
            border-radius: 14px;
            transition: .3s;
        }

        .goride-store-btn:hover {
            transform: translateY(-4px);
            color: #111;
        }

        .goride-store-btn i {
            font-size: 28px;
        }

        .goride-store-btn small {
            display: block;
            font-size: 11px;
            color: #777;
        }

        .goride-store-btn strong {
            display: block;
            font-size: 16px;
        }

        .goride-app-right {
            height: 500px;
            width: 100%;
        }

        .goride-app-right img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }

        .goride-app-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg,
                    rgba(0, 0, 0, .45) 0%,
                    rgba(0, 0, 0, .15) 45%,
                    rgba(0, 0, 0, .05) 100%);
        }

        .mobile-menu-btn:hover {
            background: #ececec;
        }

        .mobile-menu-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .45);
            visibility: hidden;
            opacity: 0;
            transition: .35s;
            z-index: 9998;
        }

        .fleet-section {
            background: #fff;
        }

        .section-head p {
            color: #777;
            font-size: 16px;
            margin-bottom: 0px;
        }

        .fleet-card {
            background: #fff;
            border: 1px solid #ececec;
            border-radius: 18px;
            padding: 18px 10px;
            text-align: center;
            transition: .3s;
        }

        .fleet-card:hover {
            transform: translateY(-8px);
            cursor: pointer;
        }

        .fleet-card img {
            width: 100%;
            height: 130px;
            object-fit: contain;
        }

        .fleet-card h5 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 0px;
        }

        .fleet-card span {
            color: #777;
            font-size: 14px;
        }

        .fleet-carousel .owl-stage {
            display: flex;
        }

        .fleet-carousel .owl-item {
            display: flex;
        }

        .fleet-carousel .fleet-card {
            width: 100%;
        }

        .fleet-carousel .owl-dot span {
            width: 10px;
            height: 10px;
        }

        .fleet-carousel .owl-dot.active span {
            background: #000 !important;
        }

        .mobile-menu-overlay.show {
            visibility: visible;
            opacity: 1;
        }

        .mobile-menu {
            position: fixed;
            top: 0;
            right: -320px;
            width: 300px;
            height: 100vh;
            background: #fff;
            z-index: 9999;
            transition: .35s;
            display: flex;
            flex-direction: column;
            box-shadow: -5px 0 30px rgba(0, 0, 0, .15);
        }

        .mobile-menu.show {
            right: 0;
        }

        .mobile-menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .mobile-menu-header img {
            height: 45px;
        }

        .mobile-menu-header button {
            border: none;
            background: none;
            font-size: 22px;
            cursor: pointer;
        }

        .mobile-user {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .mobile-avatar {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: #000;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            font-size: 18px;
        }

        .mobile-user h5 {
            margin: 0;
            font-size: 17px;
            font-weight: 700;
        }

        .mobile-user span {
            color: #777;
            font-size: 13px;
        }

        .mobile-menu-links {
            flex: 1;
            padding: 10px 0;
            overflow-y: auto;
        }

        .mobile-menu-links a {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 15px 22px;
            text-decoration: none;
            color: #222;
            font-size: 15px;
            transition: .25s;
        }

        .mobile-menu-links a:hover {
            background: #f7f7f7;
        }

        .mobile-menu-links i {
            width: 22px;
            text-align: center;
        }

        .mobile-menu-footer {
            padding: 20px;
            border-top: 1px solid #eee;
        }

        .mobile-menu-footer button {
            width: 100%;
            height: 46px;
            border: none;
            border-radius: 8px;
            background: #000;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
        }

        .mobile-menu-footer button:hover {
            opacity: .9;
        }

        .sections-hidden {
            display: none !important;
        }

        .flatpickr-calendar {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid #eee;
        }

        .flatpickr-day.selected {
            background: #000 !important;
            border-color: #000 !important;
        }

        .flatpickr-time input:hover,
        .flatpickr-time .flatpickr-am-pm:hover,
        .flatpickr-time input:focus,
        .flatpickr-time .flatpickr-am-pm:focus {
            background: #f5f5f5;
        }

        .owl-carousel.review-carousel {
            padding: 10px 0;
            display: none;
        }

        .owl-carousel.review-carousel .owl-item {
            padding: 0 10px;
        }

        .owl-dots {
            margin-top: 20px;
        }

        .owl-dots .owl-dot.active span {
            background: #000 !important;
        }

        .booking-form-section {
            background: #f9f9f9;
            border: 1px solid #e7e7e7;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 8px;
        }

        .booking-section-title {
            font-size: 13px;
            font-weight: 700;
            color: #555;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 10px;
        }

        .booking-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
            margin-bottom: 15px;
        }

        /* Full width for any input box that sits alone in its row (desktop & mobile) */
        .booking-form-grid>.booking-form-group:only-child,
        .booking-form-grid>.booking-form-group:only-of-type {
            grid-column: 1 / -1;
        }

        .booking-form-group {
            margin-bottom: 0;
        }

        .booking-checkbox-wrapper {
            margin-top: 15px;
        }

        .booking-checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
        }

        .booking-checkbox {
            width: 18px;
            height: 18px;
            accent-color: #000;
            appearance: auto !important;
            -webkit-appearance: auto !important;
            -moz-appearance: auto !important;
        }

        .booking-form-group input,
        .booking-form-group select,
        .booking-form-group textarea {
            width: 100%;
        }

        .driver-confirm-card {
            background: #f9f9f9;
            padding: 24px;
            border-radius: 12px;
            margin: 20px 0;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .driver-confirm-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 16px;
        }

        .driver-confirm-card h3 {
            font-size: 18px;
            font-weight: 700;
            margin: 8px 0;
            color: #000;
        }

        .driver-vehicle {
            color: #666;
            font-size: 14px;
            margin: 4px 0;
        }

        .driver-confirm-rating {
            color: #f39c12;
            font-size: 16px;
            font-weight: 600;
            margin-top: 8px;
        }

        .edit-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            padding: 0;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            color: #495057;
            cursor: pointer;
            transition: all 0.25s ease;
            height: 28px;
            width: 28px;
            flex-shrink: 0;
        }

        .edit-icon-btn i {
            font-size: 12px;
            color: #495057;
        }

        .edit-icon-btn:hover {
            background: #e9ecef;
            color: #212529;
        }

        .edit-icon-btn:active {
            transform: scale(0.95);
        }



        .booking-summary {
            display: none;
            /* margin-top: 10px; */
            padding-top: 10px;
            border-top: 1px solid #e5e5e5;
        }

        #bookingDetailsIcon {
            background: none;
            color: #3a3434;
            height: auto;
            line-height: 1;
            display: inline-flex;
            align-items: center;
        }

        .summary-title {
            font-size: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-transform: uppercase;
            color: #555;
            margin-bottom: 0px;

        }

        .summary-title i {
            font-size: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #000;
            border-radius: 50%;
        }


        .selected-car-row {
            display: flex;
            align-items: center;
            gap: 7px;
            justify-content: space-between;
        }

        .summary-car-image {
            width: 130px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
            flex: 1;

        }

        .estimated-fare-badge {
            display: inline-block;
            margin-top: 2px;
            padding: 7px 10px;
            font-size: 13px;
            font-weight: 600;
            color: white;
            background: black;
            border-radius: 20px;
            line-height: 1;
        }


        .summary-car-name {
            margin-bottom: 0px !important;
            font-size: 16px;
            /* font-weight: 700; */
            color: #111;
            flex-wrap: nowrap;
            line-height: 1.2;
            flex: 1;
        }

        .summary-car-info {
            display: flex;
            gap: 10px;
            font-size: 14px;
        }

        .summary-car-details {
            display: flex;
            flex-direction: column;
            align-items: end;
        }

        .summary-car-info span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .summary-car-price {
            font-size: 19px;
            font-weight: 700;
            color: #000;
            white-space: nowrap;
        }

        .booking-summary-list {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 10px;
        }

        .booking-summary-item {
            display: flex;
            justify-content: start;
            /* align-items: center; */
            font-size: 14px;
            gap: 6px;
            min-width: 0;
            word-break: break-all;
            overflow-wrap: anywhere;
        }

        .summary-label {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .summary-label i {
            font-size: 13px;
            text-align: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            flex-shrink: 0;

        }

        /* 
        .summary-label {
            color: #666;
        } */

        .summary-value {
            color: #111;
            min-width: 0;
            word-break: break-all;
            overflow-wrap: anywhere;
            /* text-align: right; */
        }

        .driver-info {
            display: flex;
            gap: 15px;
            width: 100%;
            align-items: center;
        }

        .driver-card {
            cursor: default;
        }

        .driver-info {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .driver-car-image {
            flex-shrink: 0;
            cursor: pointer;
        }

        .driver-car-image img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 10px;
        }

        .tax-ribbon-wrapper {
            position: absolute !important;
            top: -5px !important;
            right: -4px !important;
            display: flex !important;
            align-items: flex-start !important;
            filter: drop-shadow(0 2px 2px rgba(0, 0, 0, 0.15)) !important;
            z-index: 10 !important;
            margin: 0 !important;
        }

        .tax-ribbon-fold {
            position: relative !important;
            top: 1px !important;
            width: 0 !important;
            height: 0 !important;
            right: -1px !important;
            border-bottom: 5px solid #064e3b !important;
            border-left: 5px solid transparent !important;
        }

        .tax-ribbon-fold.not-included {
            border-bottom-color: #7f1d1d !important;
        }

        .tax-ribbon-body {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            color: #ffffff !important;
            font-size: 8px !important;
            font-weight: 800 !important;
            padding: 5px 8px 7px 8px !important;
            text-transform: uppercase !important;
            text-align: center !important;
            letter-spacing: 0.5px !important;
            line-height: 1.2 !important;
            -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 50% calc(100% - 4px), 0 100%) !important;
            clip-path: polygon(0 0, 100% 0, 100% 100%, 50% calc(100% - 4px), 0 100%) !important;
            border-radius: 3px 3px 0 0 !important;
        }

        .tax-ribbon-body.not-included {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
        }

        /* 
        .driver-car-banner {
            align-items: center;
            gap: 14px;
            background: #f7f7f7;
            border-radius: 12px;
            padding: 12px 14px;
            margin-bottom: 14px;
        } */
        .driver-car-banner img {
            width: 145px;
            height: 86px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .driver-car-banner-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0px;
            flex-direction: column;
        }

        .driver-car-banner-name {
            font-size: 15px;
            font-weight: 700;
            color: #111;
            /* margin-bottom: 4px; */
        }

        .driver-car-banner-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            font-size: 13px;
            color: #555;
        }

        .driver-car-banner-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .driver-details {
            flex: 1;
        }

        .driver-header {
            display: flex;
            align-items: baseline;
            /* margin-bottom: 8px; */
            justify-content: space-around;
            align-items: center;
        }

        .driver-wrap {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
        }

        .driver-avatar-info-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .driver-meta-info h4 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .driver-static-label {
            font-size: 12px;
            color: #666;
            font-weight: 500;
            margin-top: 1px;
        }

        .driver-review-link-wrapper {
            margin-top: 2px;
        }

        .driver-review-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 500;
            color: #000;
            background: #fff;
            padding: 4px 15px;
            border-radius: 6px;
            border: 1px solid #000;
            text-decoration: none;
            white-space: nowrap;
            transition: all 0.2s ease;
        }

        .driver-review-link:hover {
            background: #000;
            color: #fff;
            text-decoration: none;
        }

        .driver-text h4 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .driver-rating-info {
            margin-top: 3px;
            font-size: 12px;
            color: #666;
        }

        .driver-rating-info i {
            color: #f59e0b;
        }

        .driver-vehicle-info {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 500;
            color: #333;
        }

        .driver-vehicle-info .fa-car {
            color: #666;
            width: 15px;
        }

        .fare-info-icon {
            color: #007bff;
            cursor: pointer;
            transition: .3s;
        }

        .fare-info-icon:hover {
            color: #0056b3;
        }

        .driver-bid-box {
            flex-shrink: 0;
            text-align: right;
        }

        .driver-price-row {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 15px;
            margin-bottom: 6px;
        }

        .bid-amount {
            font-size: 26px;
            font-weight: 700;
        }

        .driver-accept-btn {
            width: 100%;
            padding: 4px 10px;
            margin-top: 10px;
            border: none;
            border-radius: 6px;
            background: #111;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .driver-review-link {
            display: inline-block;
            font-size: 12px;
            font-weight: 500;
            color: black;
            text-decoration: none;
            background: white;
            padding: 5px 15x;
            border-radius: 6px;
            transition: background 0.2s ease;
            border: 1px solid black;
        }

        .driver-review-link:hover {
            background: linear-gradient(135deg, #000 0%, #000 100%) color: #fff;
            text-decoration: none;
        }

        .bid-eta {
            font-size: 13px;
            color: #666;
        }

        .rc-header {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 0 12px;
            /* border-bottom: 1px solid #f0f0f0;
            margin-bottom: 20px; */
        }

        .rc-back-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid #e0e0e0;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            color: #333;
            flex-shrink: 0;
            transition: background 0.2s;
        }

        .rc-back-btn:hover {
            background: #f5f5f5;
        }

        .rc-title {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
        }

        .rc-driver-card {
            background: #fafafa;
            border: 1px solid #eee;
            border-radius: 14px;
            padding: 14px 16px;
            margin-bottom: 16px;
        }

        .rc-driver-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #999;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .rc-driver-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .rc-driver-avatar img {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            object-fit: cover;
            /* border: 2px solid #f9c106; */
        }

        .rc-driver-info {
            flex: 1;
        }

        .rc-driver-name {
            font-size: 16px;
            font-weight: 700;
            color: #111;
        }

        .rc-driver-stars {
            display: flex;
            align-items: center;
            gap: 3px;
            margin-top: 3px;
            font-size: 14px;
            color: #f59e0b;
        }

        .rc-driver-stars span {
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-left: 4px;
        }

        .rc-driver-badge {
            background: #e8f5e9;
            color: #2e7d32;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .rc-info-block {
            margin-bottom: 14px;
        }

        .rc-info-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #999;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .rc-info-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .rc-info-sub {
            font-size: 13px;
            color: #666;
        }

        .rc-fare-amount {
            font-size: 26px;
            font-weight: 800;
            color: #111;
        }

        .rc-divider {
            height: 1px;
            background: #f0f0f0;
            margin: 14px 0;
        }

        .rc-journey-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 6px;
        }

        .rc-journey-row>i {
            margin-top: 3px;
            font-size: 16px;
        }

        .rc-journey-route {
            font-size: 14px;
            font-weight: 600;
            color: #111;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 4px;
        }

        .rc-journey-sub {
            font-size: 12px;
            color: #888;
            margin-top: 4px;
        }

        .rc-accept-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 16px;
            background: #f9c106;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 700;
            color: #000;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
        }

        .rc-details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .rc-details-grid .rc-detail-row {
            display: flex;
            /* flex-direction: column; */
            gap: 13px;
            /* padding: 12px; */
            /* border: 1px solid #e9ecef; */
            border-radius: 8px;
            background: #fff;
        }

        .rc-details-grid .rc-detail-row span {
            font-size: 13px;
            color: #666;
        }

        .rc-details-grid .rc-detail-row strong {
            font-size: 15px;
            color: #222;
            font-weight: 600;
        }

        .trip-details {
            color: #000;
            min-height: 48px;
            display: flex;
            align-items: center;
            font-size: 15px;
        }

        /* NEW STEP 7 CLASSES */
        .rc-new-driver-card,
        .rc-vehicle-card {
            background: #fff;
            border: 1px solid #f0f0f0;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        }

        .rc-driver-top-flex {
            display: flex;
            align-items: center;
            gap: 16px;

        }

        .rc-driver-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #f9c106;
            position: relative;
        }

        .rc-driver-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .rc-driver-info-main {
            flex: 1;
        }

        .rc-driver-name-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 4px;
        }

        .rc-driver-name-row h4 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: #111;
        }

        .rc-driver-badge-top {
            background: #e6f7eb;
            color: #128741;
            font-size: 10px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .rc-driver-rating-row {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 13px;
            font-weight: 600;
            color: #333;
        }

        .rc-driver-stats-grid {
            display: grid;
            /* grid-template-columns: 1fr 1fr 1fr; */

            border-radius: 8px;

            text-align: center;
        }

        .rc-driver-stat-col {
            display: flex;

            align-items: center;
            gap: 11px;
        }

        .rc-driver-stat-col.border-left-right {
            border-left: 1px solid #eee;
            border-right: 1px solid #eee;
        }

        .rc-driver-stat-col i {
            color: #444;
            font-size: 16px;

        }

        .rc-driver-stat-col strong {
            display: block;
            font-size: 14px;
            color: #111;
        }


        .rc-card-subtitle {
            font-size: 11px;
            font-weight: 700;
            color: #888;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .rc-vehicle-top {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .rc-vehicle-img-wrapper {
            width: 240px;
            height: 150px;
            flex-shrink: 0;
            border-radius: 14px;
            overflow: hidden;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .rc-vehicle-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 14px;
        }

        .rc-vehicle-info-right {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 16px;
        }

        .rc-vehicle-name-block h4 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.5px;
        }

        .rc-vehicle-subname {
            font-size: 15px;
            color: #475569;
            font-weight: 500;
            margin-top: 2px;
        }

        .rc-vehicle-stats-row {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .rc-vehicle-stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            min-width: 60px;
        }

        .rc-stat-icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0f172a;
            font-size: 18px;
            margin-bottom: 8px;
        }

        .rc-stat-val {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.2;
        }

        .rc-stat-lbl {
            font-size: 12px;
            font-weight: 500;
            color: #64748b;
            margin-top: 2px;
            white-space: nowrap;
        }

        .rc-stat-divider {
            width: 1px;
            height: 50px;
            background: #e2e8f0;
            flex-shrink: 0;
        }

        .rc-vehicle-bottom-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: nowrap;
        }

        .rc-vehicle-amenities-grid {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: nowrap;
            margin: 0;
        }

        .rc-amenity-box {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .rc-vehicle-tag {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff3e0;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 16px;
            margin: 0;
            color: #e67e22;
            white-space: nowrap;
        }

        /* Wi-Fi */
        .rc-amenity-box:has(.fa-snowflake) {
            background: #EAF4FF;
            color: #1976D2;
        }

        .rc-amenity-box .fa-snowflake {
            color: #2196F3;
        }

        /* A/C */
        .rc-amenity-box:has(.fa-wifi) {
            background: #FFECEC;
            color: #D32F2F;
        }

        .rc-amenity-box .fa-wifi {
            color: #F44336;
        }

        .rc-bid-top {
            display: flex;
            justify-content: space-between;
            align-items: center;

        }

        .rc-bid-badge {
            background: #e6f7eb;
            color: #128741;
            font-size: 13px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .rc-bid-bottom {
            /* display: flex; */
            justify-content: space-between;
            align-items: center;
        }

        .rc-bid-amount {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .rc-bid-amount strong {
            font-size: 24px;
            color: #111;
        }

        .rc-bid-total-tag {
            background: #f9c106;
            color: #000;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 12px;
        }

        .rc-bid-note {
            font-size: 13px;
            color: #111;
            font-weight: 600;
        }

        /* Help / Support Modal Redesign (Compact) */
        .help-modal-dialog {
            max-width: 450px;
            margin: 0.5rem auto;
        }

        .help-modal {
            border: none;
            border-radius: 18px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            background: #ffffff;
            overflow: hidden;
        }

        .help-modal-header {
            padding: 16px 20px 4px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: transparent;
        }

        .help-modal-header-title {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .help-modal .modal-title {
            font-size: 18px;
            font-weight: 800;
            color: #111827;
            margin: 0;
            line-height: 1.2;
        }

        .title-underline {
            width: 32px;
            height: 3.5px;
            background: #ffb800;
            border-radius: 2px;
            margin-top: 4px;
        }

        .help-btn-close {
            background-color: #f3f4f6;
            border-radius: 50%;
            padding: 6px;
            font-size: 11px;
            opacity: 0.7;
            transition: all 0.2s ease;
            box-shadow: none;
        }

        .help-btn-close:hover {
            opacity: 1;
            background-color: #e5e7eb;
            transform: rotate(90deg);
        }

        .help-modal-body {
            padding: 0 20px 18px 20px;
        }

        .help-banner-wrapper {
            width: 100%;
            text-align: center;
            margin-bottom: 8px;
        }

        .help-banner-img {
            max-width: 170px;
            max-height: 120px;
            height: auto;
            object-fit: contain;
            display: inline-block;
        }

        .help-subtitle {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 3px;
        }

        .help-subtitle .text-highlight {
            color: #ffb800;
        }

        .help-desc {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 14px;
            font-weight: 500;
        }

        .help-cards-list {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .help-card {
            display: flex;
            align-items: center;
            padding: 10px 14px;
            background: #ffffff;
            border: 1px solid #f0f2f5;
            border-radius: 14px;
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
            position: relative;
            cursor: pointer;
        }

        .help-card:hover {
            transform: translateY(-1.5px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.06);
            border-color: #e2e8f0;
            text-decoration: none;
        }

        .help-card-icon-box {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            flex-shrink: 0;
            margin-right: 12px;
        }

        .whatsapp-bg {
            background-color: #25d366;
            color: white;
        }

        .call-bg {
            background-color: #ffb800;
            color: white;
        }

        .email-bg {
            background-color: #3b82f6;
            color: white;
        }

        .help-card-info {
            flex: 1;
            text-align: left;
            min-width: 0;
        }

        .help-card-title {
            font-size: 14px;
            font-weight: 700;
            color: #1f2937;
            line-height: 1.2;
        }

        .help-card-sub {
            font-size: 11px;
            color: #6b7280;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .help-card-action {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-left: 8px;
            flex-shrink: 0;
            text-align: right;
        }

        .help-card-contact {
            font-size: 14px;
            font-weight: 700;
            text-decoration: none !important;
            transition: opacity 0.2s;
        }

        .help-card-contact:hover {
            opacity: 0.8;
        }

        .whatsapp-color {
            color: #25d366 !important;
        }

        .call-color {
            color: #ffb800 !important;
        }

        .email-color {
            color: #3b82f6 !important;
        }

        .help-card-arrow {
            font-size: 11px;
            transition: transform 0.2s ease;
        }

        .help-card:hover .help-card-arrow {
            transform: translateX(2px);
        }

        /* Media Queries for Mobile Responsiveness */
        @media (max-width: 576px) {
            .help-modal-dialog {
                margin: 0.5rem auto;
                max-width: calc(100% - 1.5rem);
            }

            .help-modal {
                border-radius: 16px;
            }

            .help-modal-header {
                padding: 14px 16px 2px 16px;
            }

            .help-modal-body {
                padding: 0 14px 14px 14px;
            }

            .help-banner-wrapper {
                margin-bottom: 4px;
            }



            .help-subtitle {

                margin-bottom: 2px;
            }

            .help-desc {

                margin-bottom: 10px;
            }

            .help-cards-list {
                gap: 7px;
            }

            .help-card {
                padding: 8px 10px;
                border-radius: 10px;
                flex-wrap: nowrap !important;
            }

            .help-card-icon-box {
                width: 32px;
                height: 32px;

                margin-right: 8px;
            }

            .help-card-info {
                flex: 1 1 auto;
                min-width: 0;
            }

            .help-card-title {

                white-space: nowrap;
            }

            .help-card-action {
                margin-left: auto;
                gap: 4px;
                flex-shrink: 0;
            }

            .help-card-contact {

                white-space: nowrap;
            }

            .help-card-arrow {
                font-size: 10px;
            }
        }

        @media (max-width: 380px) {
            .help-modal-dialog {
                margin: 0.35rem auto;
                max-width: calc(100% - 1rem);
            }

            .help-modal-header {
                padding: 12px 12px 2px 12px;
            }

            .help-modal-body {
                padding: 0 12px 12px 12px;
            }

            .help-desc {

                margin-bottom: 8px;
            }

            .help-card {
                padding: 7px 8px;
            }

            .help-card-icon-box {
                width: 28px;
                height: 28px;
                font-size: 13px;
                margin-right: 6px;
            }




        }

        .driver-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .more-drivers-loader {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            min-height: 400px;
            position: relative;
            margin-top: 20px;
        }

        .radar-container {
            position: relative;
            width: 220px;
            height: 220px;
            margin-bottom: 50px;
            border-radius: 50%;
            border: 1px solid #f4f4f4;
        }

        .radar-core {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 44px;
            height: 44px;
            background: #000;
            border-radius: 50%;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .radar-core-icon {
            color: #fff;
            font-size: 18px;
        }

        .radar-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            border: 2px solid rgba(0, 0, 0, 0.05);
            animation: radarPulse 1.5s infinite ease-out;
        }

        .radar-ring-1 {
            animation-delay: 0s;
        }

        .radar-ring-2 {
            animation-delay: 0.5s;
        }

        .radar-ring-3 {
            animation-delay: 1s;
        }

        .radar-sweep {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: conic-gradient(rgba(0, 0, 0, 0.04) 0deg,
                    rgba(0, 0, 0, 0.01) 45deg,
                    transparent 80deg,
                    transparent 360deg);
            animation: radarSpin 1.5s infinite linear;
            border-radius: 50%;
            z-index: 5;
        }

        .radar-node {
            position: absolute;
            opacity: 0;
            z-index: 6;
        }

        .radar-node-1 {
            top: 25%;
            left: 10%;
            font-size: 14px;
            animation: blinkNode 1.5s infinite ease-in-out;
        }

        .radar-node-2 {
            top: 65%;
            left: 15%;
            font-size: 16px;
            animation: blinkNode 1.5s infinite ease-in-out 0.75s;
        }

        .radar-node-3 {
            top: 30%;
            right: 15%;
            font-size: 15px;
            animation: blinkNode 1.5s infinite ease-in-out 0.4s;
        }

        .radar-node-4 {
            top: 75%;
            right: 5%;
            font-size: 14px;
            animation: blinkNode 1.5s infinite ease-in-out 1.1s;
        }

        .loader-pill {
            background: #fff;
            padding: 14px 30px;
            border-radius: 40px;
            border: 1px solid #e5e5e5;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
        }

        .loader-spin {
            color: #444;
            font-size: 16px;
            margin-right: 12px;
            animation-duration: 1.5s;
        }

        .loader-text {
            font-size: 15px;
            color: #333;
            font-weight: 500;
            letter-spacing: 0.2px;
            transition: opacity 0.4s ease;
        }

        @keyframes radarPulse {
            0% {
                width: 44px;
                height: 44px;
                opacity: 1;
            }

            100% {
                width: 280px;
                height: 280px;
                opacity: 0;
            }
        }

        @keyframes radarSpin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes blinkNode {
            0% {
                transform: scale(0.5);
                opacity: 0;
                color: #aaa;
            }

            30% {
                transform: scale(1.2);
                opacity: 1;
                color: #000;
                text-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
            }

            70% {
                transform: scale(1);
                opacity: 0.8;
                color: #555;
            }

            100% {
                transform: scale(0.8);
                opacity: 0;
                color: #aaa;
            }
        }

        /* Responsive */
        @media (max-width: 767px) {

            .footer-app-downloads {
                flex-direction: row;
                gap: 10px;
                margin-top: 15px;
                justify-content: space-around;
            }

            .footer-store-btn i {
                font-size: 18px;
            }

            .accordion-content {
                padding: 12px !important;
                margin-top: 0px !important;
            }

            .rc-driver-top-flex {
                gap: 8px;
            }

            .rc-new-driver-card {
                padding: 9px;
            }

            .rc-driver-avatar {
                width: 50px;
                height: 50px;
            }

            .more-drivers-loader {
                min-height: 320px;
                margin-top: 15px;
            }

            .radar-container {
                width: 180px;
                height: 180px;
                margin-bottom: 35px;
            }

            .loader-pill {
                padding: 12px 20px;
            }

            .loader-text {
                font-size: 14px;
                text-align: center;
            }

            @keyframes radarPulse {
                0% {
                    width: 44px;
                    height: 44px;
                    opacity: 1;
                }

                100% {
                    width: 220px;
                    height: 220px;
                    opacity: 0;
                }
            }
        }

        @media (max-width: 576px) {
            .rc-vehicle-bottom-row {
                display: flex;
                align-items: center;
                gap: 6px;
                flex-wrap: nowrap;
                justify-content: center;
            }

            .rc-vehicle-amenities-grid {
                display: flex;
                align-items: center;
                gap: 6px;
                flex-wrap: nowrap;
            }

            .rc-amenity-box,
            .rc-vehicle-tag {
                padding: 5px 10px;
                font-size: 11px;
            }

            .rc-vehicle-top {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
                justify-content: center;
                align-items: center;
            }
        }

        @media (max-width: 576px) {
            .rc-details-grid {
                grid-template-columns: 1fr;
            }
        }

        .rc-accept-btn:hover {
            background: #e6b000;
            transform: scale(1.01);
        }

        .operator-register-section {
            position: relative;
            padding: 35px 0;
            background: white;
            overflow: hidden;
        }

        .operator-register-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .operator-register-text h2 {
            font-size: 32px;
            font-weight: 700;
            color: #000;
            margin: 0;
            line-height: 1.3;
        }

        .operator-register-text h2 span {
            color: #000;
        }

        .operator-register-text p {
            font-size: 18px;
            margin: 8px 0 0 0;
        }

        .operator-register-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #000;
            color: #fff;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .pickup-now-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: #f2f2f2;
            color: #000;
            border: none;
            border-radius: 30px;
            padding: 12px 22px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .pickup-now-btn:hover {
            background: #e7e7e7;
        }

        .pickup-now-btn i:first-child {
            font-size: 15px;
        }

        .pickup-now-btn i:last-child {
            font-size: 12px;
        }

        .privacy-modal {
            max-width: 520px;
        }

        .privacy-intro {
            font-size: 15px;
            color: #222;
            margin-bottom: 15px;
        }

        .privacy-text {
            font-size: 17px;
            /*color:#666;*/
            line-height: 1.8;
            margin-bottom: 15px;
        }

        .privacy-text:last-child {
            margin-bottom: 0;
        }

        .privacy-btn-group {
            display: flex;
            gap: 12px;
            margin-top: 25px;
        }

        .privacy-btn-group button {
            flex: 1;
        }

        .footer-contact-icon {
            width: 18px;
            margin-right: 8px;
            color: #fff;
            flex-shrink: 0;
        }

        .footer-address {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            color: rgba(255, 255, 255, .7);
            font-size: 16px;
            line-height: 1.8;
            margin-top: 10px;
        }

        .footer-address div {
            flex: 1;
        }

        .passenger-luggage-card {
            background: #f9f9f9;
            border: 1px solid #e5e5e5;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 18px;
        }

        .passenger-card-title {
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #555;
            margin-bottom: 18px;
        }

        .passenger-counter-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .passenger-counter-item label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #222;
        }

        .car-seat-toggle {
            margin-top: 18px;
            padding-top: 18px;
            border-top: 1px solid #e5e5e5;
        }

        .car-seat-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .child-seat-wrapper {
            display: none;
            margin-top: 18px;
            padding-top: 18px;
            border-top: 1px solid #e5e5e5;
        }

        .child-seat-counter {
            margin-bottom: 18px;
        }

        .child-seat-counter label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .child-seat-dropdowns {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        #personalInfoSection .booking-form-grid {
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }

        .child-seat-counter .counter-widget {
            width: 35%;
        }

        .location-group-wrapper {
            display: flex;
            gap: 10px;
            position: relative;
            z-index: 1000;
            overflow: visible;
        }

        .route-indicator {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 20px;
            flex-shrink: 0;
            padding-top: 40px;
            /* aligns dot with center of pickup input */
            padding-bottom: 40px;
            /* aligns pin with center of dropoff input */
        }

        .route-dot-start {
            border-radius: 50%;
            border: 2px solid #fff;
            flex-shrink: 0;
            color: #f9c106;
            font-size: 21px;
        }

        .route-line {
            flex: 1;
            width: 0;
            border-left: 2px dotted #bbb;
            min-height: 30px;
            margin: 6px 0;
        }

        .route-dot-end {
            color: #000;
            font-size: 21px;
            flex-shrink: 0;
        }

        .location-fields {
            flex: 1;
            min-width: 0;
            overflow: visible;
            position: relative;
        }

        #mobileActionBar {
            display: none;
        }

        * {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        *::-webkit-scrollbar {
            display: none;
        }

        .cookie-consent-banner {
            position: fixed;
            bottom: 0px;
            left: 0;
            z-index: 2147483645;
            box-sizing: border-box;
            width: 100%;
            background-color: #f3ba00;
        }

        .cookie-consent-banner__inner {
            margin: 0 auto;
            padding: 20px 20px;
            background: #000;
        }

        .cookie-consent-banner__description {
            color: #fff;
            font-size: 19px;
        }

        .cookie-consent-banner__cta--secondary {
            padding: 9px 13px;
            background-color: #fff;
            color: #000;
            border-radius: 7px;
            border: 0;
            margin-right: 4px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
        }

        .cookie-consent-banner__cta {
            box-sizing: border-box;
            display: inline-block;
            min-width: 135px;
            padding: 10px 13px;
            margin-top: 15px;
            border-radius: 7px;
            background-color: white;
            color: #000;
            text-decoration: none;
            text-align: center;
            font-size: 16px;
            line-height: 20px;
            border: 0;
            cursor: pointer;
            font-weight: 600;
        }

        .finding-drivers-loader {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 350px;
            text-align: center;
        }

        .search-circle {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 34px;
            color: #000;
            margin-bottom: 25px;
            animation: searchPulse 1.5s infinite;
        }

        .search-circle i {
            animation: searchRotate 2s linear infinite;
        }

        .finding-drivers-loader h4 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #111;
        }

        .finding-drivers-loader p {
            color: #777;
            font-size: 15px;
        }

        .loading-dots {
            display: flex;
            gap: 8px;
            margin-top: 20px;
        }

        .loading-dots span {
            width: 8px;
            height: 8px;
            background: #000;
            border-radius: 50%;
            animation: bounce .8s infinite alternate;
        }

        .loading-dots span:nth-child(2) {
            animation-delay: .2s;
        }

        .loading-dots span:nth-child(3) {
            animation-delay: .4s;
        }

        @keyframes searchPulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(0, 0, 0, .25);
            }

            70% {
                transform: scale(1.08);
                box-shadow: 0 0 0 18px rgba(0, 0, 0, 0);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            }
        }

        @keyframes searchRotate {
            from {
                transform: rotate(-10deg);
            }

            to {
                transform: rotate(10deg);
            }
        }

        @keyframes bounce {
            from {
                transform: translateY(0);
                opacity: .4;
            }

            to {
                transform: translateY(-8px);
                opacity: 1;
            }
        }

        .iti {
            width: 100%;
        }

        .iti input {
            width: 100%;
            height: 48px;
            padding-left: 100px !important;
            padding-right: 12px;
            border: 2px solid #ddd !important;
            border-radius: 8px;
            background: #fff !important;
            font-size: 16px;
            transition: .3s;
        }

        .iti input:focus {
            outline: none;
            border-color: #000;
            background: #fff;
        }

        .iti__flag-container {
            border-right: 1px solid #ddd;
        }

        .iti__selected-country {
            padding: 0 10px;
        }

        .iti__country-list {
            z-index: 999999;
        }

        /* ===========================
   MOBILE COLLAPSIBLE TRIP SUMMARY
=========================== */
        .mobile-trip-summary {
            background: #fff;
            border: 1px solid #e9e9e9;
            /* border-radius: 14px; */
            overflow: hidden;
            margin-bottom: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        .mobile-trip-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 14px 16px;
            cursor: pointer;
            transition: .3s;
        }

        .mobile-trip-header .location-group-wrapper {
            flex: 1;
            min-width: 0;
        }

        .mobile-trip-header .location-fields {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
            min-width: 0;
        }

        .mobile-trip-header .mobile-from,
        .mobile-trip-header .mobile-to {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
            color: #111;
            line-height: 1.4;
            position: relative;
            min-width: 0;
            width: 100%;
            margin-bottom: 0;
        }

        .mobile-trip-header .mobile-from .route-dot-start {
            color: #f9c106;
            font-size: 15px;
            flex-shrink: 0;
            margin-top: 3px;
            width: 16px;
            text-align: center;
        }

        .mobile-trip-header .mobile-from::after {
            content: '';
            position: absolute;
            left: 7px;
            top: 20px;
            bottom: -8px;
            border-left: 2px dotted #bbb;
        }

        .mobile-trip-header .mobile-to .route-dot-end {
            color: #000;
            font-size: 15px;
            flex-shrink: 0;
            margin-top: 3px;
            width: 16px;
            text-align: center;
        }

        .mobile-trip-header #mcsPickup,
        .mobile-trip-header #mcsDropoff {
            flex: 1;
            min-width: 0;
        }

        .mobile-trip-header-actions {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-shrink: 0;
            padding-left: 8px;
            margin-top: 4px;
        }

        /*.mobile-trip-header:hover {*/
        /*    background: #fafafa;*/
        /*}*/
        .mobile-route {
            flex: 1;
        }

        .mobile-from,
        .mobile-to {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #222;
            line-height: 1.5;
        }

        .mobile-from {
            margin-bottom: 6px;
        }

        .mobile-from i {
            color: #f8be00;
            width: 16px;
        }

        .mobile-to i {
            color: #ff4d4f;
            width: 16px;
        }

        #tripSummaryArrow {
            font-size: 15px;
            color: #666;
            transition: transform .3s ease;
        }

        #tripSummaryArrow.rotate {
            transform: rotate(180deg);
        }

        /* Hidden by default */
        .mobile-trip-body {
            display: none;
            border-top: 1px solid #eee;
            padding: 14px 16px;
            background: white;
            overflow-y: auto;
            max-height: calc(100vh - 150px);
            -webkit-overflow-scrolling: touch;
        }

        .mobile-trip-item {
            display: flex;
            align-items: center;
            gap: 10px;
            /* padding: 8px 0; */
            font-size: 14px;
            color: #444;
            font-weight: 600;
            color: #222;
        }

        .mobile-trip-item i {
            width: 18px;
            color: #f8be00;
        }

        .mobile-trip-item:last-child {
            padding-bottom: 0;
        }

        .rc-info-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #222;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .rc-detail-row span {
            color: #666;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .rc-detail-row span i {
            color: #f8be00;
            width: 18px;
        }

        .rc-detail-row strong {
            color: #222;
            font-weight: 600;
        }

        .rc-fare-amount {
            font-size: 22px;
            color: #0b8b35;
            font-weight: 700;
        }

        .trip-datetime-card {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            border-top: 1px solid #e5e5e5;
            /* margin: 2px; */
            margin-top: 0px;
            padding-top: 10px;
        }

        .trip-datetime-main-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            gap: 12px;
            flex-wrap: wrap;
        }

        .trip-datetime-item,
        .trip-route-meta-item {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .trip-route-meta-item {
            padding-left: 10px;
            border-left: 1px solid #eee;
        }

        /* Wrapper */
        .cookie-banner-wrapper {
            position: fixed;
            bottom: 15px;
            right: 30px;
            z-index: 99999;
        }

        /* Banner */
        .cookie-banner {
            max-width: 300px;
            background: #fff;
            border: 1px solid #f0f0f0;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 16px;
            gap: 16px;
            flex-direction: column;
            animation: cookieSlideUp 0.6s ease-out;
        }

        @keyframes cookieSlideUp {
            0% {
                opacity: 0;
                transform: translateY(80px) scale(0.95);
            }

            60% {
                opacity: 1;
                transform: translateY(-8px) scale(1.02);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Content */
        .cookie-banner-content {
            flex: 1;
        }

        .cookie-banner-title {
            font-size: 16px;
            font-weight: 700;
            color: #111;
            margin-bottom: 6px;
        }

        .cookie-banner-text {
            font-size: 14px;
            line-height: 1.5;

            margin: 0;
        }

        /* Actions */
        .cookie-banner-actions {
            display: flex;
            gap: 10px;
            flex-shrink: 0;
            width: 100%;
        }

        /* Buttons */
        .cookie-btn {
            border: none;
            border-radius: 8px;
            padding: 10px 18px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: .3s;
            flex: 1;
            width: 100%;
        }

        .cookie-btn-reject {
            background: #f3f4f6;
            color: #333;
        }

        .cookie-btn-reject:hover {
            background: #e5e7eb;
        }

        .cookie-btn-accept {
            background: #000;
            color: #fff;
        }

        .cookie-btn-accept:hover {
            background: #222;
        }

        /* Mobile */
        @media (max-width: 767px) {
            .cookie-banner-wrapper {
                left: 15px;
                right: 15px;

            }

            .cookie-banner {
                flex-direction: column;
                align-items: flex-start;
                max-width: 100%;
            }

            .cookie-banner-actions {
                width: 100%;
            }

            .cookie-btn {
                flex: 1;
            }
        }

        @media (max-width: 576px) {
            .trip-route-meta-item {
                border-left: none;
                padding-left: 0;
                padding-top: 8px;
                border-top: 1px solid #eee;
                width: 100%;
            }
        }

        .map-route-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 99;
            background: #ffffff;
            padding: 10px 18px;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.15);
            border: 1px solid #e0e0e0;
            pointer-events: auto;
            transition: all 0.3s ease;
        }

        .map-route-badge-content {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 700;
            color: #111;
        }

        .map-route-pill {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .map-route-divider {
            color: #ccc;
            font-weight: 400;
        }

        @media (max-width: 768px) {
            .map-route-badge {
                top: 85px;
                left: 15px;
                z-index: 10001;
                padding: 8px 14px;
                font-size: 13px;
            }
        }

        .trip-datetime-icon {
            /* width: 42px;
            height: 42px; */
            border-radius: 50%;
            background: #f8f8f8;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f9c106;
            font-size: 18px;
        }

        .trip-datetime-icon i {
            font-size: 19px;
        }

        .trip-datetime-title {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            color: #555;
            letter-spacing: 1px;
        }

        .trip-datetime-value {
            font-size: 16px;
            /* font-weight:700; */
            color: #111;
            margin-top: 2px;
        }

        /* Separate Box Card Styling */
        .summary-box-card {
            background: #ffffff;
            border: 1px solid #eaedf0;
            border-radius: 16px;
            padding: 12px;
            margin-bottom: 6px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
        }

        /* ==========================================
           BOOKING STEPPER HEADER (MATCHING UI IMAGE)
           ========================================== */
        .booking-stepper-wrapper {
            width: 100%;
            margin-bottom: 12px;
            padding: 4px 0;
            user-select: none;
        }

        .stepper-track {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            position: relative;
            width: 100%;
        }

        .stepper-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            flex: 1;
            text-align: center;
            cursor: pointer;
            z-index: 2;
        }

        .stepper-num {
            display: none !important;
        }

        .stepper-icon-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #ffffff;
            border: 2px solid #e5e7eb;
            color: #9a9faa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            position: relative;
            z-index: 3;
            transition: all 0.3s ease;
            /* box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04); */
        }

        .stepper-item.active .stepper-icon-circle {
            background: #f9c106;
            border-color: #f9c106;
            color: #000000;
            box-shadow: 0 4px 10px rgba(249, 193, 6, 0.35);
        }

        .stepper-item.completed .stepper-icon-circle {
            background: black;
            border-color: black;
            color: white;
        }

        /* .stepper-item.step-item-5 .stepper-icon-circle {
            border-color: #a5d6a7;
            color: #28a745;
        } */

        .stepper-item.step-item-5.active .stepper-icon-circle,
        .stepper-item.step-item-5.completed .stepper-icon-circle {
            background: #28a745;
            border-color: #28a745;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.35);
        }

        .stepper-line {
            position: absolute;
            top: 19px;
            left: 50%;
            width: 100%;
            height: 0px;
            border-top: 2px dashed #d1d5db;
            z-index: 1;
        }

        .stepper-item.completed .stepper-line {
            border-top: 2px dashed #f9c106;
        }

        .stepper-item:last-child .stepper-line {
            display: none;
        }

        .stepper-label {
            margin-top: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #111827;
            line-height: 1.2;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stepper-item.inactive .stepper-label {
            color: #4b5563;
            font-weight: 600;
        }

        .stepper-item.step-item-5 .stepper-label {
            color: #4b5563;
            font-weight: 600;
        }

        .stepper-item.step-item-5.active .stepper-label,
        .stepper-item.step-item-5.completed .stepper-label {
            color: #28a745;
            font-weight: 700;
        }

        @media (max-width: 768px) {
            .track-status-header h4 {
                font-size: 20px !important;
            }

            .booking-stepper-wrapper {
                margin-bottom: 8px;
                padding: 2px 0;
            }

            .stepper-icon-circle {
                width: 35px;
                height: 35px;
                font-size: 14px;
                border-width: 1.5px;
            }

            .stepper-line {
                top: 15px;
                left: 70%;
            }

            .stepper-item {
                flex: none;
            }

            .stepper-label {
                font-size: 14px;
                margin-top: 4px;
                line-height: 1.1;
            }
        }

        .box-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

        }

        .box-card-title {
            font-size: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-transform: uppercase;
            color: #555;
            margin-bottom: 0px;

        }

        .dropoff-form-group {
            margin-top: 15px;
        }

        .for-me-btn-hidden {
            display: none !important;
        }

        /* Step 2 Date/Time/Distance/Duration Grid (Strict 2 in a Row) */
        .trip-datetime-card.summary-box-card {
            padding: 10px;
            margin-top: 0;
        }

        .trip-stat-box {
            display: flex;
            align-items: center;
            gap: 6px;
            width: 100%;
            min-width: 0;
        }

        #tripRouteMetaContainer {
            width: 100%;
        }

        .stat-icon-circle {
            width: 27px;
            height: 27px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            flex-shrink: 0;
        }

        .stat-icon-circle.yellow-icon {
            background: #fff8e7;
            color: #f39c12;
            border: 1px solid #fde68a;
        }

        .stat-icon-circle.navy-icon {
            background: #f0f4f8;
            color: #1a2b4c;
            border: 1px solid #e2e8f0;
        }

        .text-navy {
            color: #1a2b4c;
        }

        .text-yellow {
            color: #f39c12;
        }

        .stat-info-group {
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .stat-header-label {
            font-size: 11px;
            font-weight: 700;
            color: #555;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .stat-main-value {
            font-size: 15px;
            color: #000;

        }

        .v-price-onwards {
            font-size: 12px;
            color: #666;
            font-weight: 500;
            text-align: right;
            margin-top: -5px;
        }

        /* Mobile only */
        @media (max-width:768px) {
            .time-panel-title {
                font-size: 18px;
            }

            .time-panel-title,
            .time-panel-subtitle {
                margin-bottom: 7px;
            }

            .stat-header-label {
                font-size: 12px;
            }

            .stat-main-value {
                font-size: 14px;
                font-weight: 600;
            }

            .iti input {
                padding: 12px;
                font-size: 17px;
            }

            /* .time-hint {
    font-size: 14px;
   
    margin-bottom: 7px;
} */
            .time-inputs {
                margin-bottom: 0px;
            }

            .time-panel-header {
                margin-bottom: 8px;
            }

            .time-selection-panel {
                padding: 10px 25px;
            }

            .driver-divider {
                display: none;
            }

            .driver-wrap {
                display: flex;
                /* flex-direction: column; */
                align-items: center;
            }

            .mobile-trip-summary {
                display: block;
            }

            .mobile-trip-header {
                padding: 12px 14px;
            }

            .mobile-from,
            .mobile-to {
                font-size: 14px !important;
                display: flex;
                align-items: flex-start;
                gap: 10px;
                width: 100%;
                cursor: pointer;
            }

            .mobile-from.expanded-text #mcsPickup,
            .mobile-to.expanded-text #mcsDropoff {
                white-space: normal;
                word-wrap: break-word;
            }

            .mobile-trip-item {
                font-size: 16px;
            }
        }

        @media (min-width: 992px) {
            #bookingSummaryListDesktop {
                display: none;
            }

            .combined-counts-desktop-container {
                display: flex;
                justify-content: start;
                border-bottom: 1px dashed #d9d9d9;
                gap: 21px;
                align-items: center;
            }

            .combined-counts-desktop-container .booking-summary-item {
                border-bottom: none !important;
                /* flex: 1; */
                justify-content: start;
                align-items: center;
                padding: 10px 0;
                gap: 10px;
            }

            .combined-counts-desktop-container .count-label {
                display: none;
            }

            .combined-counts-desktop-container .summary-label {

                font-size: 16px;
            }
        }

        @media (max-width: 991.98px) {
            .combined-counts-desktop-container {
                display: block;
            }
        }

        /* Hide on desktop */
        @media (min-width:769px) {
            .mobile-trip-summary {
                display: none;
            }
        }

        /*#step8 .confirm-details-grid {*/
        /*    display: none !important;*/
        /*}*/
        /*.cookie-consent-banner__cta:hover {*/
        /*    background-color: #f9c106;*/
        /*}*/
        @media screen and (max-width: 576px) {
            .cookie-consent-banner__description {
                font-size: 12px;
            }

            .cookie-consent-banner__actions {
                display: flex;
                gap: 10px;
            }

            .cookie-consent-banner__cta {
                min-width: auto;
                padding: 8px 12px;
                font-size: 12px;
                margin-top: 10px;
            }

            .cookie-consent-banner__cta--secondary {
                padding: 8px 12px;
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .booking-form-section {
                padding: 12px;
            }

            .booking-checkbox {
                width: 16px;
                height: 16px;
            }

            .booking-checkbox-label {
                font-size: 12px;
            }

            .navbar-uber {
                padding: 0 12px;
            }

            .navbar-brand-uber img {
                height: 40px;
            }

            .hero-form-section {
                padding: 12px 10px;
            }

            .booking-title {
                font-size: 23px;
            }

            .modal-content-uber {
                width: 95%;
                padding: 20px;
            }

            .app-download-title {
                font-size: 20px;
            }

            .section-title {
                font-size: 20px;
            }

            .app-store-btn {
                padding: 4px 10px;
                font-size: 13px;
            }

            .app-store-btn-name {
                font-size: 14px;
            }

            .time-dropdown-list {
                max-height: 150px;
            }

            .time-dropdown-btn {
                padding: 10px 30px 10px 35px;
                font-size: 14px;
            }

            /*.selected-car-row {*/
            /*    flex-wrap: wrap;*/
            /*}*/
            .summary-car-price {
                width: 100%;
                margin-left: 0;
                text-align: right;
                margin-top: 10px;
                font-size: 22px;
            }

            .summary-car-image {
                width: 65px;
                height: 50px;
            }

            .summary-car-name {
                font-size: 15px;
            }

            .summary-car-info {
                font-size: 15px;
                gap: 8px;
            }

            .booking-summary-item {
                font-size: 16px;
            }
        }

        @media (max-width: 576px) {
            .counter-btn {
                width: 28px !important;
                height: 28px !important;
            }

            .passenger-luggage-card {
                padding: 14px;
                border-radius: 10px;
            }

            .passenger-card-title {
                font-size: 13px;
            }

            .passenger-counter-item label {
                font-size: 13px;
            }

            .car-seat-label {
                font-size: 13px;
            }
        }

        @media (max-width: 767px) {
            .summary-car-details {
                align-items: start;
            }

            .booking-form-section {
                padding: 14px;
                margin-bottom: 14px;
                border-radius: 10px;
            }

            .booking-form-grid {
                gap: 12px;
            }

            .booking-section-title {
                font-size: 17px;
                margin-bottom: 12px;
            }

            .booking-checkbox-label {
                font-size: 13px;
            }
        }

        @media (max-width: 768px) {
            .edit-icon-btn {
                padding: 0;
                width: 28px;
                height: 28px;
                flex-shrink: 0;
            }

            .edit-icon-btn i {
                font-size: 12px;
            }

            .pickup-now-btn {
                padding: 10px 18px;
                font-size: 15px;
                gap: 8px;
                border-radius: 25px;
            }

            .pickup-now-btn i:first-child {
                font-size: 14px;
            }

            .pickup-now-btn i:last-child {
                font-size: 11px;
            }

            .operator-register-section {
                padding: 30px 0;
            }

            .operator-register-content {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .operator-register-text h2 {
                font-size: 24px;
            }

            .operator-register-text p {
                font-size: 14px;
            }

            .operator-register-btn {
                width: 100%;
                justify-content: center;
            }

            .vehicle-grid-uber {
                grid-template-columns: repeat(1, 1fr);
            }

            .vehicle-image img {
                width: 100%;
                height: 85px;
                object-fit: contain;
            }

            .vehicle-item {
                gap: 10px;
            }

            .vehicle-name {
                font-size: 17px;
            }

            .form-group-uber label {
                font-size: 16px;
            }

            .hero-form-section {
                display: flex;
                flex-direction: column;
                min-height: calc(100vh - 70px);
                padding: 16px 12px;
            }

            #tripMainContent {
                display: flex;
                flex-direction: column;
                flex: 1;
            }

            .step-bottom-btns {
                margin-top: auto !important;
                padding-top: 20px;
                padding-bottom: 20px;
            }

            .form-group-uber label {
                font-size: 15px;
            }

            .return-journey-label {
                font-size: 17px;
            }

            .offer-subtitle {
                font-size: 14px;
            }

            .offer-title,
            .app-promo-subtitle,
            .app-promo-benefit {
                font-size: 16px;
            }

            .step-bottom-btns {
                position: fixed;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 999;
                background: #fff;
                padding: 12px;
                border-top: 1px solid #e5e5e5;
                box-shadow: 0 -5px 15px rgba(0, 0, 0, .08);
            }

            .btn-group-uber {
                display: flex;
                gap: 10px;
            }

            .form-section {
                padding-bottom: 90px;
            }

            .hero-map-section {
                display: none !important;
            }

            #mobileCompactSummary {
                position: fixed !important;
                top: 70px !important;
                left: 0;
                width: 100%;
                max-height: calc(100vh - 75px);
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
                z-index: 1000;
                background: #fff;
                border-bottom: 1px solid #eee;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
                /* padding: 12px 16px; */
                display: none;
                flex-direction: column;
                gap: 6px;
            }

            #mobileCompactSummary.visible {
                display: flex !important;
            }

            .mobile-summary-backdrop {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(0, 0, 0, 0.4);
                z-index: 999;
                display: none;
            }

            /* Passenger Details Layout Classes */
            .passenger-details-layout {
                display: flex;
                gap: 15px;
                align-items: stretch;
                justify-content: space-between;
                margin-top: 9px;
                border-top: 1px solid #eee;
                padding-top: 8px;

            }

            .summary-car-info span {
                display: inline-flex;
            }

            .passenger-details-left {

                min-width: 0;
            }

            .passenger-details-right {
                border-left: 1px solid #eee;
                padding-left: 15px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .passenger-details-name-container {
                margin-bottom: 4px;
            }

            .passenger-details-name {
                font-size: 18px;
                font-weight: 500;
                display: block;
                color: #111;
                word-break: break-word;
                white-space: normal;
            }

            .passenger-details-item {
                border-bottom: none !important;
                padding-bottom: 0 !important;
                margin-bottom: 5px;
            }

            .passenger-details-item .summary-value {
                word-break: break-all;
                overflow-wrap: anywhere;
                white-space: normal;
                min-width: 0;
            }

            .booking-summary-item {
                min-width: 0;
            }

            .booking-summary-item .summary-value {
                word-break: break-all;
                overflow-wrap: anywhere;
                white-space: normal;
                min-width: 0;
            }

            .summary-inline-item {
                display: inline-flex;
                align-items: center;
                gap: 5px;
                font-size: 13px;
                font-weight: 500;
                color: #111;
                background: #f8f9fa;
                border: 1px solid #e9ecef;
                padding: 3px 8px;
                border-radius: 6px;
            }

            .summary-inline-item i {
                font-size: 13px;
            }

            .p-icon-contact {
                background: #fff8e7;
                color: #f39c12;
                border: 1px solid #fde68a;
            }

            /* Tooltip styling for Passenger Details Icons */
            .summary-icon-tooltip {
                position: relative;
            }

            .summary-icon-tooltip::after {
                content: attr(data-tooltip);
                position: absolute;
                bottom: 125%;
                right: 0;
                transform: translateY(4px);
                background-color: #111111;
                color: #ffffff;
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 11px;
                font-weight: 500;
                white-space: nowrap;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.2s ease, transform 0.2s ease;
                pointer-events: none;
                z-index: 1000;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            }

            .summary-icon-tooltip::before {
                content: '';
                position: absolute;
                bottom: 105%;
                right: 12px;
                transform: translateY(4px);
                border-width: 5px 5px 0 5px;
                border-style: solid;
                border-color: #111111 transparent transparent transparent;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.2s ease, transform 0.2s ease;
                pointer-events: none;
                z-index: 1000;
            }

            .summary-icon-tooltip:hover::after,
            .summary-icon-tooltip:hover::before {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }


            .mcs-route {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 14px;
                font-weight: 500;
                color: #000;
            }

            .mcs-route i {
                font-size: 12px;
                color: #f9c106;
            }

            .mcs-route-arrow {
                color: #999;
                font-size: 10px;
            }

            .mcs-details {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                font-size: 16px;
                color: #555;
            }

            .mcs-details-item {
                display: flex;
                align-items: center;
                gap: 4px;
            }

            .mcs-details-item i {
                color: #f9c106;
            }

            .hero-form-section {
                width: 100% !important;
                max-width: 100% !important;
            }

            #bookingMap.mobile-fullscreen {
                position: fixed;
                top: 0px;
                left: 0;
                width: 100vw;
                height: calc(100vh - 70px);
                z-index: 5000;
                display: block !important;
            }

            #bookingMap.mobile-fullscreen iframe {
                width: 100%;
                height: 100%;
                border: 0;
            }

            #mapCloseBtn {
                position: fixed;
                top: 80px;
                right: 12px;
                z-index: 9999;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: #fff;
                border: none;
                box-shadow: 0 4px 16px rgba(0, 0, 0, .30);
                cursor: pointer;
                display: none;
                align-items: center;
                justify-content: center;
                font-size: 16px;
            }

            #mapCloseBtn.visible {
                display: flex !important;
            }

            #mobileMapBtn {
                display: none;
                align-items: center;
                gap: 6px;
                background: #000;
                color: #fff;
                border: none;
                border-radius: 20px;
                padding: 6px 14px;
                font-size: 13px;
                font-weight: 600;
                cursor: pointer;
            }

            #mobileMapBar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                background: #f5f5f5;
                border-radius: 10px;
                padding: 8px 12px;
                margin-bottom: 12px;
                font-size: 13px;
                color: #333;
            }

            #mobileMapBar button {
                background: #000;
                color: #fff;
                border: none;
                border-radius: 20px;
                padding: 5px 12px;
                font-size: 12px;
                font-weight: 600;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .driver-item {
                padding: 12px;
            }

            .driver-top {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 10px;
            }

            .driver-left {
                display: flex;
                align-items: flex-start;
                gap: 10px;
                flex: 1;
                min-width: 0;
            }

            .driver-avatar {
                width: 45px;
                height: 45px;
                flex-shrink: 0;
            }

            .driver-name {
                font-size: 16px;
                line-height: 1.2;
                margin-bottom: 2px;
            }

            .driver-rating {
                font-size: 11px;
            }

            .driver-vehicle {
                font-size: 12px;
                margin-top: 2px;
            }

            .driver-price-box {
                min-width: auto;
                text-align: right;
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                gap: 6px;
            }

            .driver-price-box h3 {
                font-size: 18px;
                margin: 0;
            }

            .driver-price-box span {
                font-size: 11px;
            }

            .select-driver-btn {
                padding: 6px 12px;
                font-size: 12px;
                border-radius: 8px;
            }

            .driver-eta {
                font-size: 11px;
                margin-top: 0;
            }

            .goride-app-right {
                height: 400px;
            }

            .vehicle-image {
                flex-direction: column;
            }

            .vehicle-features {
                display: flex;
            }

            .owl-carousel.review-carousel {
                display: block !important;
                z-index: 0;
            }

            .section-head h2 {
                font-size: 28px;
            }

            .fleet-card {
                padding: 18px;
            }

            .fleet-card img {
                height: 150px;
            }

            .date-time-screen {
                grid-template-columns: 1fr;
            }

            .hero-banner-content {
                left: 8px;
            }

            .hero-banner-content h1 {
                font-size: 24px;
            }

            .footer {
                padding: 33px 0 20px !important;
            }

            .footer-bottom {
                font-size: 17px;
            }

            .footer-app-btn {
                width: auto;
            }

            .footer-app-buttons {
                justify-content: center;
                align-items: center;
            }

            .app-store-btn-label {
                font-size: 14px;
            }

            #bookingImage {
                display: none;
            }

            .night-charge-notice-card {
                padding: 5px;
                margin-top: 0px;
            }

            .hero-form-section {
                width: 100%;
                max-width: 100%;
                /* min-height: fit-content; */
                padding: 16px 12px;
                display: block;
            }

            .goride-app-overlay {
                display: none;
            }

            .hero-container {
                display: block;
            }

            .form-section.active {
                flex: unset !important;
                display: flex !important;
                flex-direction: column !important;
            }

            .form-section#step1 {
                padding-bottom: 0px;
            }

            .step-bottom-btns {
                margin-top: auto !important;
                padding-bottom: 30px !important;
            }

            .navbar-menu {
                display: none !important;
            }

            .section-title {
                font-size: 24px;
                margin-bottom: 24px;
            }

            .section-padding {
                padding: 40px 0;
            }

            .booking-title {
                margin-bottom: 12px;
            }

            .review-grid {
                display: none;
            }

            .owl-carousel {
                display: block;
            }

            .hero-container {
                min-height: auto;
                flex-direction: column;
                /*margin-bottom: 0px;*/
            }

            .hero-map-section {
                min-height: auto;
            }

            .app-download-section {
                padding: 40px 0;
            }

            .app-download-title {
                font-size: 24px;
                margin-bottom: 12px;
            }

            .app-download-subtitle {
                font-size: 14px;
                margin-bottom: 24px;
            }

            .app-store-buttons {
                gap: 12px;
            }

            .app-store-btn {
                justify-content: center;
            }

            .footer-links {
                flex-direction: column;
                gap: 12px;
            }

            .mobile-menu-btn {
                display: flex;
            }

            .navbar-uber {
                justify-content: space-between;
            }

            .time-dropdown-list {
                max-height: 180px;
            }

            .location-suggestions {
                right: 0;
            }

            .review-carousel .owl-carousel {
                display: block !important;
            }

            .selected-car-row {
                align-items: flex-start;
                gap: 12px;
            }

            .summary-car-image {
                width: 70px;
                height: 55px;
            }

            .summary-car-name {
                font-size: 16px;
            }

            .summary-car-info {
                /* flex-wrap: wrap; */
                gap: 10px;
                font-size: 15px;
            }

            .summary-car-price {
                font-size: 20px;
            }

            .booking-summary-item {
                font-size: 16px;
            }

            #mcsCarDetails {
                display: none;
                margin-top: 10px;
                border-top: 1px solid #eee;
                padding-top: 8px;
            }

            #mcsCarDetails .mcs-car-name-header {
                font-size: 18px;
                margin-bottom: 6px;
                display: flex;
                align-items: center;
                gap: 8px;
                color: #111;
            }

            #mcsCarDetails .mcs-car-child-container {
                display: none;
            }

            .mobile-summary-price-wrapper {
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                justify-content: center;
                gap: 4px;
                margin-left: auto;
            }

            .mobile-summary-price-wrapper .summary-car-price {
                font-size: 20px;
                font-weight: 800;
                color: #111;
                line-height: 1.1;
            }

            .mobile-summary-price-wrapper .estimated-fare-badge {
                display: inline-block;
                padding: 6px 12px;
                font-size: 13px;
                font-weight: 600;
                color: white;
                background: black;
                border-radius: 20px;
                line-height: 1;
                margin-top: 0;
            }

            #mcsEnteredDetails {
                display: none;
                gap: 4px;
            }

            #mcsEnteredDetails .booking-summary-item {
                display: flex;
                align-items: center;
                gap: 8px;
                /* background: #f7f7f7;
                border: 1px solid #efefef; */
                border-radius: 10px;
                /* padding: 8px 10px; */
                justify-content: flex-start !important;
                min-width: 0;
                overflow: hidden;
            }

            #mcsEnteredDetails .booking-summary-header-item {
                grid-column: span 2;
                font-size: 13px;
                font-weight: 700;
                color: #555;
                border-top: 1px dashed #ddd;
                padding-top: 10px;
                margin-top: 5px;
                margin-bottom: 5px;
                text-transform: uppercase;
                display: none;
            }

            #mcsEnteredDetails .booking-summary-span2-item {
                grid-column: span 2;
                /* justify-content: space-between !important; */
            }

            /* #mcsEnteredDetails .mcs-special-req-container {
                border-top: 1px dashed #ddd;
                padding-top: 8px;
            } */

            #mcsEnteredDetails .summary-label {
                flex-shrink: 0;
                display: flex;
                align-items: center;
            }



            #mcsEnteredDetails .summary-value {
                font-size: 16px !important;
                color: #111;
                text-align: left !important;
                word-break: break-all;
                overflow-wrap: break-word;
                min-width: 0;
            }

            #mcsCarDetails .selected-car-row {
                border-radius: 10px;
                align-items: center;
                justify-content: space-between;
                gap: 8px;
            }

            .confirm-modal-content {
                padding: 0px !important;
            }

            #mcsCarDetails .summary-car-name {
                font-size: 14px;
                font-weight: 700;
                color: #111;
                margin-bottom: 0 !important;
            }

            #mcsCarDetails .summary-car-price {
                font-size: 16px !important;
                font-weight: 700;
                color: #111;
                white-space: nowrap;
                margin-top: 0px;
            }

            .summary-title {
                font-size: 14px;
            }

            .driver-info {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: 0px;
                flex-direction: column;
            }

            .driver-car-image {
                width: 80px;
                flex-shrink: 0;
            }

            .driver-car-image img {
                width: 80px;
                height: 60px;
                object-fit: contain;
            }

            .driver-details {
                flex: 1;
                min-width: 0;
            }

            .driver-header {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 0px;
                margin-bottom: 5px;
                width: 100%;
            }

            .driver-car-banner {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .driver-car-banner img {
                width: 120px;
                height: 60px;
                object-fit: cover;
            }

            .driver-car-banner-name {
                font-size: 13px;
                margin-bottom: 2px;
            }

            .driver-car-banner-meta {
                font-size: 13px;
                gap: 6px;
                justify-content: center;
            }

            .driver-text a {
                white-space: nowrap;
                display: inline-block;
                text-align: center;
            }

            .driver-avatar {
                width: 40px;
                height: 40px;
            }

            .driver-text h4 {
                font-size: 15px;
                margin: 0;
            }

            .driver-rating-info {
                font-size: 11px;
                display: flex;
                flex-direction: column;
            }

            .driver-vehicle-info {
                font-size: 12px;
                margin-top: 4px;
            }

            .driver-price-row {
                display: flex;
                justify-content: end;
                align-items: end;
                margin-bottom: 0px;
            }

            .driver-bid-box {
                display: flex;
                gap: 18px;
            }

            .bid-amount {
                font-size: 22px;
            }

            .driver-accept-btn {
                width: 150px;
            }

            .bid-eta {
                margin-top: 6px;
            }

            .operator-login-section {
                padding: 40px 0;
            }

            .operator-login-strip {
                padding: 30px 20px;
            }

            .operator-login-content h2 {
                font-size: 28px;
            }

            .operator-login-content p {
                font-size: 15px;
            }

            .operator-login-btn {
                width: 100%;
                justify-content: center;
            }

            .privacy-modal {
                width: 95%;
            }

            .privacy-btn-group {
                flex-direction: column;
            }

            .passenger-counter-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .passenger-luggage-card {
                padding: 16px;
            }

            #mobileActionBar {
                display: flex;
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                z-index: 2000;
                background: #fff;
                border-top: 1px solid #eee;
                box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.10);
                padding: 10px 0 14px;
                justify-content: space-around;
                align-items: center;
                animation: slideUpBar 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            }

            @keyframes slideUpBar {
                from {
                    transform: translateY(100%);
                    opacity: 0;
                }

                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            .mob-action-btn {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 4px;
                text-decoration: none;
                color: #222;
                font-size: 14px;
                font-weight: 600;
                padding: 4px 12px;
                border-radius: 12px;
                transition: transform 0.18s ease, color 0.18s ease;
                position: relative;
                cursor: pointer;
                border: none;
                background: none;
            }

            .mob-action-btn:hover,
            .mob-action-btn:active {
                transform: scale(1.12);
                color: #f9c106;
            }

            .mob-action-icon {
                width: 43px;
                height: 43px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 17px;
                transition: box-shadow 0.2s ease, transform 0.2s ease;
                background: black;
                color: white;
            }

            .mob-action-btn:hover .mob-action-icon {
                transform: translateY(-4px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            }


            @keyframes pulse-book {
                0% {
                    box-shadow: 0 0 0 0 rgba(249, 193, 6, 0.5);
                }

                60% {
                    box-shadow: 0 0 0 10px rgba(249, 193, 6, 0);
                }

                100% {
                    box-shadow: 0 0 0 0 rgba(249, 193, 6, 0);
                }
            }

            #mobileActionBar.hidden {
                display: none !important;
            }
        }

        @media (max-width: 991px) {
            .booking-form-section {
                padding: 16px;
            }

            .goride-app-left {
                padding: 35px 15px;
            }

            .goride-app-heading {
                font-size: 32px;
            }

            .goride-app-features {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .goride-store-btn {
                width: 100%;
                padding: 7px 13px;
                gap: 0px;
            }

            .goride-app-right img {
                object-fit: contain;
            }
        }

        .vehicle-item {
            position: relative;
            display: flex;
            background: #fff;
            border: 2px solid #eaeaea;
            border-radius: 12px;
            padding: 9px;
            margin-bottom: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            gap: 12px;
        }

        .vehicle-item:hover {
            border-color: #d0d0d0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .vehicle-item.selected {
            border-color: #f9c106;
            background: #fffbf0;
        }

        .vehicle-left {
            position: relative;
            width: 175px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .vehicle-left img {
            width: 100%;
            object-fit: contain;
        }



        .vehicle-right {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        .v-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 4px;
        }

        .v-name {
            font-size: 22px;
            font-weight: 700;
            color: #111;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: nowrap;
            line-height: 1.2;
            flex: 1;
        }

        .v-price {
            font-size: 22px;
            font-weight: 700;
            color: #111;
        }

        .v-sub {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #666;
            margin-bottom: 5px;
        }

        .v-rating {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .v-rating i {
            color: #f9c106;
            font-size: 12px;
        }

        .v-features {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            color: #111;
            /* margin-bottom: 12px; */
            flex-wrap: wrap;
        }

        .v-features span {
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 600;
        }

        .v-features i {
            color: #444;
            font-size: 14px;
        }

        .v-tag {
            margin-left: auto;
            text-align: right;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 2px;
        }

        .v-tag-pill {
            font-size: 12px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 12px;
        }

        .v-tag-pill.cheapest {
            background: #e6f7eb;
            color: #0b8c4c;
        }

        .v-tag-pill.popular {
            background: #f1ecff;
            color: #7b4dfb;
        }

        .v-tag-pill.families {
            background: #e8f3ff;
            color: #1a73e8;
        }

        .v-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .v-amenities {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .v-amenity-pill {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 600;
            color: #444;
            border: 1px solid #e0e0e0;
            padding: 4px;
            border-radius: 6px;
        }

        .btn-v-select {
            background: black;
            color: white;
            border: 1px solid #d0d0d0;
            padding: 4px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .vehicle-item.selected .btn-v-select {
            background: #101828;
            color: #fff;
            border-color: #101828;
            padding: 4px 8px;
        }

        @media (max-width: 768px) {

            .vehicle-item {
                flex-direction: row;
                gap: 2px;
                padding: 10px;
                align-items: flex-start;
                margin-bottom: 0px;
            }

            .vehicle-left {
                width: 125px;
                height: auto;
                min-height: 90px;
                margin: 0;
                flex-shrink: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                position: relative;
            }

            .vehicle-left img {
                width: 100%;
                height: 100px;
                object-fit: contain;
            }



            .vehicle-right {
                flex: 1;
                min-width: 0;
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            .v-header {
                display: flex;
                justify-content: space-between;
                align-items: end;
                gap: 0px;
                margin-bottom: 0;
                flex-direction: column-reverse;

            }

            .v-name {
                font-size: 17px;
                font-weight: 700;
                margin-bottom: 0;
                flex: 1;
                min-width: 0;
                word-wrap: break-word;
            }

            .v-price {
                font-size: 20px;

            }

            .v-sub {
                display: flex;
                justify-content: end;
                font-size: 15px;
                margin-bottom: 0;
                gap: 8px;
                align-items: center;
            }

            .v-rating {
                display: flex;
                align-items: center;
                gap: 2px;
                white-space: nowrap;
            }

            .v-rating i {
                font-size: 10px;
            }

            .v-tag {
                margin-left: 0;
                margin-top: 0;
            }

            .v-tag-pill {
                font-size: 13px;
                padding: 2px 6px;
                border-radius: 8px;
            }

            .v-features {
                display: flex;
                gap: 5px;
                font-size: 15px;
                margin-top: 4px;
                margin-bottom: 0;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
                width: 100%;
            }

            .v-features span {
                display: flex;
                align-items: center;
                gap: 4px;
                font-weight: 600;
                white-space: nowrap;
            }

            .v-features i {
                font-size: 11px;
            }

            .v-amenities {
                display: flex;
                gap: 4px;
                flex-wrap: wrap;
            }

            .v-amenity-pill {
                display: flex;
                align-items: center;
                gap: 2px;
                font-size: 15px;
                padding: 2px 5px;
                border: none;
                border-radius: 4px;
                white-space: nowrap;
            }

            .v-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 0px;
                margin-top: 2px;
            }

            .btn-v-select {
                background: black;
                color: white;
                border: none;
                padding: 4px 11px;
                border-radius: 6px;
                font-size: 15px;
                font-weight: 600;
                cursor: pointer;
                width: auto;
                flex-shrink: 0;
            }

            .vehicle-item.selected .btn-v-select {
                background: #101828;
            }

            .mob-trust-badges {
                display: flex;
                justify-content: space-around;
                align-items: flex-start;
                background: #fff;
                margin-top: 18px;
            }

            .mob-trust-badge {
                display: flex;
                align-items: center;
                gap: 8px;
                flex: 1;
                /* padding: 0 6px;
                flex-direction: column; */
            }

            .mob-trust-badge:last-child {
                border-right: none;
            }

            .mob-trust-icon {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background: #fffbe6;
                border: 1.5px solid #f9c106;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }

            .mob-trust-icon i {
                color: #f9c106;
                font-size: 15px;
            }

            .mob-trust-text {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .mob-trust-title {
                font-size: 13px;
                font-weight: 500;
                color: #111;
                line-height: 1.3;
            }

            .mob-trust-sub {
                font-size: 10.5px;
                color: #777;
                line-height: 1.3;
            }

        }

        /* ===== ULTRA-PREMIUM ADAPTIVE FLOATING SCROLL INDICATOR ===== */
        .cab-scroll-floating-controls {
            position: sticky;
            bottom: 72px;
            left: 0;
            right: 0;
            z-index: 99;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
            margin-top: -42px;
            margin-bottom: 8px;
            padding: 0 15px;
            transition: all 0.3s ease;
        }

        .cab-scroll-pill-btn {
            pointer-events: auto;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px 6px 14px;
            background: rgba(255, 255, 255, 0.96);
            color: #0f172a;
            border: 1.5px solid #f39c12;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.3px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.12), 0 2px 10px rgba(243, 156, 18, 0.25);
            backdrop-filter: blur(12px) saturate(180%);
            -webkit-backdrop-filter: blur(12px) saturate(180%);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            user-select: none;
            position: relative;
            overflow: hidden;
        }

        .cab-scroll-pill-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(243, 156, 18, 0.25), transparent);
            transition: left 0.6s ease;
        }

        .cab-scroll-pill-btn:hover::before {
            left: 100%;
        }

        .cab-scroll-pill-btn:hover {
            background: #0f172a;
            color: #ffffff;
            border-color: #0f172a;
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.3), 0 0 18px rgba(243, 156, 18, 0.4);
        }

        .cab-scroll-pill-btn:active {
            transform: translateY(0) scale(0.97);
        }

        .cab-scroll-pill-btn .icon-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #f39c12;
            color: #000000;
            font-size: 10px;
            transition: all 0.25s ease;
            box-shadow: 0 2px 5px rgba(243, 156, 18, 0.4);
        }

        .cab-scroll-pill-btn:hover .icon-circle {
            background: #ffffff;
            color: #0f172a;
            transform: scale(1.08);
        }

        .cab-scroll-pill-btn.mode-top {
            background: rgba(255, 255, 255, 0.96);
            border-color: #f39c12;
            color: #0f172a;
        }

        .cab-scroll-pill-btn.mode-top:hover {
            background: #0f172a;
            color: #ffffff;
            border-color: #0f172a;
        }

        .cab-scroll-pill-btn .animated-bounce {
            animation: cabBounce 1.5s infinite ease-in-out;
        }

        .cab-scroll-pill-btn .animated-bounce-up {
            animation: cabBounceUp 1.5s infinite ease-in-out;
        }

        @keyframes cabBounce {
            0%, 100% {
                transform: translateY(-2px);
            }
            50% {
                transform: translateY(3px);
            }
        }

        @keyframes cabBounceUp {
            0%, 100% {
                transform: translateY(2px);
            }
            50% {
                transform: translateY(-3px);
            }
        }

        @media (max-width: 768px) {
            .cab-scroll-floating-controls {
                position: fixed !important;
                bottom: 92px !important;
                left: 0 !important;
                right: 0 !important;
                z-index: 10000 !important;
                margin-top: 0 !important;
                margin-bottom: 0 !important;
                padding: 0 15px !important;
                pointer-events: none !important;
            }
        }

        #step3ContinueBtn:disabled,
        #step3ContinueBtn.disabled-btn,
        #step3 .btn-search-uber:disabled,
        #step3 .btn-search-uber.disabled-btn {
            opacity: 0.95 !important;
            cursor: not-allowed !important;
            pointer-events: auto !important;
            background: #94a3b8 !important;
            border-color: #94a3b8 !important;
            box-shadow: none !important;
            transform: none !important;
        }

        #step3ContinueBtn:disabled:hover,
        #step3ContinueBtn.disabled-btn:hover,
        #step3 .btn-search-uber:disabled:hover,
        #step3 .btn-search-uber.disabled-btn:hover {
            cursor: not-allowed !important;
            transform: none !important;
            background: #94a3b8 !important;
            box-shadow: none !important;
        }
    </style>
    <style id="three-column-styles">
        .hero-form-section.three-column-mode {
            max-width: 100% !important;
            display: flex !important;
            flex-direction: row !important;
            gap: 0px;
            height: calc(100vh - 70px) !important;
            overflow: hidden !important;
            padding-bottom: 0 !important;
        }

        .hero-form-section.three-column-mode .form-section.active.side-by-side {
            display: flex;
            flex-direction: column;
            height: 100%;
            padding-bottom: 0;
            overflow: hidden;
        }

        .hero-form-section.three-column-mode #step2.active.side-by-side {
            flex: 3;
            width: auto;
        }

        .hero-form-section.three-column-mode .form-section.active.side-by-side:not(#step2) {
            flex: 5;
            width: auto;
        }

        .hero-form-section.three-column-mode .form-section.active.side-by-side>.container {
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
            padding-bottom: 0;
            position: relative;
        }

        .hero-form-section.three-column-mode .form-section.active.side-by-side>.container>.step-bottom-btns {
            position: sticky;
            bottom: 0;
            background: #fff;
            margin-top: auto;
            z-index: 10;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .hero-form-section.three-column-mode #step3 .container>.vehicle-grid-uber {
            margin-bottom: 15px;
        }

        .hero-form-section.three-column-mode #step2 .container>#tripMainContent {
            margin-bottom: 15px;
        }

        .vehicle-grid-uber.single-col {
            grid-template-columns: 1fr !important;
        }

        .counter-widget {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 4px;
            height: 48px;
            width: 100%;
        }

        .counter-btn {
            background: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 6px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #333;
            font-size: 16px;
            transition: background 0.2s;
        }

        .counter-btn:hover {
            background: #e9ecef;
        }

        .counter-val {
            font-weight: 600;
            font-size: 16px;
            color: #000;
        }

        /* ===== AUTH LOGIN MODAL ===== */
        #authLoginModal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 99999;
            align-items: center;
            justify-content: center;
            animation: fadeInModal 0.25s ease;
        }

        #authLoginModal.show {
            display: flex;
        }

        @keyframes fadeInModal {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .auth-modal-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
        }


        .otp-code {
            font-size: 15px;
            color: #555;
            line-height: 1.5;
            margin: 0;
        }

        .auth-modal-card {
            position: relative;
            z-index: 1;
            background: #fff;
            border-radius: 24px;
            width: 100%;
            max-width: 460px;
            margin: 16px;
            padding: 16px 24px 16px;
            box-shadow: 0 32px 80px rgba(0, 0, 0, 0.22);
            animation: slideUpModal 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes slideUpModal {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.96);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .auth-modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: none;
            background: #f4f4f4;
            color: #555;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .auth-modal-close:hover {
            background: #e8e8e8;
        }

        .auth-modal-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            /* margin-bottom: 6px; */
        }

        .auth-modal-logo img {
            height: 45px;
            object-fit: contain;
        }

        .auth-modal-headline {
            text-align: center;
            font-size: 26px;
            font-weight: 800;
            color: #111;
            margin-bottom: 4px;
            letter-spacing: -0.3px;
        }

        .auth-modal-sub {
            text-align: center;
            font-size: 14px;
            /* color: #777; */
            margin-bottom: 10px;
            line-height: 1.5;
        }

        /* Google button */
        .auth-google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            padding: 14px 20px;
            border: 1.5px solid #e0e0e0;
            border-radius: 14px;
            background: #fff;
            font-size: 15px;
            font-weight: 600;
            color: #111;
            cursor: pointer;
            transition: all 0.22s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            text-decoration: none;
        }

        .auth-google-btn:hover {
            border-color: #4285f4;
            background: #f8f9ff;
            box-shadow: 0 4px 16px rgba(66, 133, 244, 0.15);
            transform: translateY(-1px);
            color: #111;
        }

        .navbar-user-item {
            position: relative;
        }

        .navbar-user-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            border: 1.5px solid #ddd;
            border-radius: 30px;
            padding: 6px 14px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .navbar-user-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #000;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            overflow: hidden;
        }

        .navbar-user-arrow {
            font-size: 11px;
        }

        .navbar-user-dropdown {
            display: none;
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

        .navbar-user-menu {
            list-style: none;
            margin: 0;
            padding: 10px 0;
        }

        .navbar-user-menu-btn {
            width: 100%;
            padding: 10px 20px;
            border: none;
            background: transparent;
            display: flex;
            align-items: center;
            gap: 10px;
            text-align: left;
            font-size: 15px;
            color: #333;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .navbar-user-menu-btn:hover {
            background: #f8f9fa;
        }

        .navbar-user-logout {
            color: #d93025;
        }

        .auth-google-btn:active {
            transform: translateY(0);
        }

        .auth-google-icon {
            width: 22px;
            height: 22px;
            flex-shrink: 0;
        }

        /* divider */
        .auth-divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 20px 0;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #ebebeb;
        }

        .auth-divider span {
            font-size: 14px;
            /* color: #aaa; */
            font-weight: 600;
            white-space: nowrap;
        }

        /* email/phone input row - REMOVED (replaced by intl-tel-input) */
        /* ===== intl-tel-input overrides for auth modal ===== */
        #authPhoneWrapper {
            position: relative;
        }

        #authPhoneWrapper .iti {
            width: 100%;
        }

        #authPhoneWrapper .iti__tel-input {
            width: 100%;
            padding: 14px 14px 14px 6px;
            padding-left: 119px !important;
            /* beats intl-tel-input JS inline style */
            border: 1.5px solid #e0e0e0;
            border-radius: 14px;
            font-size: 15px;
            color: #111;
            background: #fafafa;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            height: 52px;
            box-sizing: border-box;
        }

        #authPhoneWrapper .iti__tel-input:focus {
            border-color: #111;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.06);
            background: #fff;
        }

        #authPhoneWrapper .iti__tel-input::placeholder {
            color: #bbb;
        }

        /* Flag button styling */
        #authPhoneWrapper .iti__flag-container {
            padding: 0;
        }

        #authPhoneWrapper .iti__selected-country {
            padding: 0 10px 0 14px;
            border-right: 1.5px solid #e0e0e0;
            border-radius: 14px 0 0 14px;
            height: 52px;
            /* background: #fafafa; */
            gap: 6px;
        }

        #authPhoneWrapper .iti__selected-country:hover {
            background: #f2f2f2;
        }

        #authPhoneWrapper .iti__selected-country-primary {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        #authPhoneWrapper .iti__selected-dial-code {
            font-size: 13px;
            font-weight: 600;
            color: #333;
        }

        #authPhoneWrapper .iti__arrow {
            border-top-color: #999;
        }

        /* Dropdown list — appended to <body> so must be targeted globally */
        .iti.iti--container {
            z-index: 9999999 !important;
        }

        .iti.iti--container .iti__dropdown-content {
            border-radius: 14px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.18);
            border: 1px solid #eee;
            overflow: hidden;
        }

        #authPhoneWrapper .iti__search-input {
            padding: 10px 14px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            outline: none;
            width: 100%;
            box-sizing: border-box;
        }

        .iti.iti--container .iti__search-input {
            padding: 10px 14px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            outline: none;
            width: 100%;
            box-sizing: border-box;
        }

        #authPhoneWrapper .iti__country,
        .iti.iti--container .iti__country {
            padding: 10px 14px;
            font-size: 14px;
        }

        #authPhoneWrapper .iti__country.iti__highlight,
        .iti.iti--container .iti__country.iti__highlight {
            background: #f5f5f5;
        }

        #authPhoneWrapper .iti__flag-box {
            margin-right: 8px;
        }

        /* Logo fix: light/white logo needs to be dark on white card */

        .auth-continue-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            margin-top: 14px;
            padding: 15px;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: 0.2px;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.18);
        }

        .auth-continue-btn:hover {
            background: #000;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.22);
        }

        .auth-continue-btn:active {
            transform: translateY(0);
        }

        .auth-modal-terms {
            text-align: center;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 0px;
        }

        .auth-modal-terms a {
            color: #777;
            text-decoration: underline;
        }
    </style>
    <style>
        /* Global Toast Notification */
        .global-toast {
            position: fixed;
            top: 90px;
            right: 24px;
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            z-index: 99999;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            transform: translateY(-80px);
            opacity: 0;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            pointer-events: none;
        }

        .global-toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .global-toast.success {
            background: #111;
        }

        .global-toast.error {
            background: #dc2626;
        }

        .global-toast.info {
            background: #111;
        }

        /* Track Ride Modal Specific Toast (White Background, Black Text) */
        .track-ride-overlay.show~.global-toast,
        .track-ride-overlay.show~.global-toast.success,
        .track-ride-overlay.show~.global-toast.info,
        .track-ride-overlay .global-toast,
        .track-ride-overlay .global-toast.success,
        .track-ride-overlay .global-toast.info,
        body:has(.track-ride-overlay.show) .global-toast,
        body:has(.track-ride-overlay.show) .global-toast.success,
        body:has(.track-ride-overlay.show) .global-toast.info {
            background: #ffffff !important;
            color: #111111 !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(0, 0, 0, 0.1) !important;
            z-index: 100000 !important;
        }

        .track-ride-overlay.show~.global-toast span,
        .track-ride-overlay .global-toast span,
        body:has(.track-ride-overlay.show) .global-toast span,
        .track-ride-overlay.show~.global-toast #globalToastMsg,
        .track-ride-overlay .global-toast #globalToastMsg,
        body:has(.track-ride-overlay.show) .global-toast #globalToastMsg {
            color: #111111 !important;
        }

        /* Global Floating WhatsApp Button (Icon Only with Attractive Animations) */
        .global-whatsapp-btn {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            color: #ffffff !important;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            z-index: 9990;
            text-decoration: none !important;
            box-shadow: 0 8px 24px rgba(37, 211, 102, 0.45), 0 2px 8px rgba(0, 0, 0, 0.15);
            border: 3px solid #ffffff;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            animation: waFloatBounce 3s infinite ease-in-out;
        }

        .global-whatsapp-btn i {
            color: #ffffff;
            line-height: 1;
            transition: transform 0.3s ease;
            animation: waWiggle 4s infinite ease-in-out;
        }

        .global-whatsapp-btn:hover {
            background: linear-gradient(135deg, #20ba5a 0%, #0e766a 100%);
            transform: scale(1.12) rotate(-8deg);
            box-shadow: 0 12px 30px rgba(37, 211, 102, 0.65), 0 4px 12px rgba(0, 0, 0, 0.2);
            color: #ffffff !important;
            text-decoration: none !important;
        }

        .global-whatsapp-btn:hover i {
            transform: scale(1.1);
        }

        /* Dual Expanding Pulse Rings */
        .global-whatsapp-btn::before,
        .global-whatsapp-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 50%;
            background: rgba(37, 211, 102, 0.45);
            z-index: -1;
            pointer-events: none;
        }

        .global-whatsapp-btn::before {
            animation: waPulseRing 2.4s infinite cubic-bezier(0.215, 0.61, 0.355, 1);
        }

        .global-whatsapp-btn::after {
            animation: waPulseRing 2.4s infinite cubic-bezier(0.215, 0.61, 0.355, 1) 0.8s;
        }

        /* Floating Bounce Animation */
        @keyframes waFloatBounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-8px);
            }
        }

        /* Periodic Eye-Catching Wiggle Animation */
        @keyframes waWiggle {
            0%, 80%, 100% {
                transform: rotate(0deg);
            }
            85% {
                transform: rotate(-14deg);
            }
            90% {
                transform: rotate(14deg);
            }
            95% {
                transform: rotate(-8deg);
            }
        }

        /* Expanding Pulse Waves Keyframes */
        @keyframes waPulseRing {
            0% {
                transform: scale(0.95);
                opacity: 0.8;
            }
            70%, 100% {
                transform: scale(1.6);
                opacity: 0;
            }
        }

        /* Hide on mobile screens <= 768px where bottom mobile action bar is present */
        @media (max-width: 768px) {
            .global-whatsapp-btn {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    @if(request()->has('payment_intent') && request()->has('redirect_status'))
        <div id="paymentRedirectOverlay"
            style="position: fixed; inset: 0; z-index: 9999999; background: #0a0f1d; display: flex; flex-direction: column; align-items: center; justify-content: center; font-family: 'Manrope', 'Poppins', sans-serif; color: #ffffff; padding: 24px; text-align: center;">
            <div
                style="background: radial-gradient(circle, rgba(243, 156, 18, 0.15) 0%, rgba(10, 15, 29, 0) 70%); position: absolute; inset: 0; pointer-events: none;">
            </div>
            <div
                style="position: relative; z-index: 2; display: flex; flex-direction: column; align-items: center; max-width: 480px; width: 100%;">
                <!-- Brand Logo -->
                <div style="margin-bottom: 32px;">
                    <img src="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG_II') }}/goride/img/logo-lightt.png"
                        alt="GoRide" style="height: 48px; max-width: 200px; object-fit: contain;"
                        onerror="this.src='https://www.goride.net.in/goride/img/Go-Ride-fav-icon.webp'">
                </div>

                <!-- Glowing Animated Spinner -->
                <div style="position: relative; width: 84px; height: 84px; margin-bottom: 28px;">
                    <div
                        style="position: absolute; inset: 0; border-radius: 50%; border: 4px solid rgba(243, 156, 18, 0.15);">
                    </div>
                    <div
                        style="position: absolute; inset: 0; border-radius: 50%; border: 4px solid transparent; border-top-color: #f39c12; border-right-color: #f39c12; animation: overlaySpin 1s cubic-bezier(0.55, 0.15, 0.45, 0.85) infinite;">
                    </div>
                    <div
                        style="position: absolute; inset: 10px; border-radius: 50%; border: 3px solid transparent; border-bottom-color: #10b981; animation: overlaySpinReverse 1.4s linear infinite;">
                    </div>
                    <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-lock" style="font-size: 22px; color: #f39c12;"></i>
                    </div>
                </div>

                <h3 style="font-size: 24px; font-weight: 800; margin: 0 0 12px 0; color: #ffffff; letter-spacing: -0.5px;">
                    Finalizing Your Booking...</h3>
                <p style="font-size: 15px; color: #94a3b8; line-height: 1.6; margin: 0 0 24px 0; font-weight: 500;">
                    We're securely confirming your payment with Stripe. Please do not close or refresh this page.
                </p>

                <!-- Progress Indicator -->
                <div
                    style="display: inline-flex; align-items: center; gap: 10px; background: rgba(255, 255, 255, 0.06); padding: 10px 22px; border-radius: 999px; border: 1px solid rgba(255, 255, 255, 0.08);">
                    <div
                        style="width: 8px; height: 8px; border-radius: 50%; background: #10b981; box-shadow: 0 0 12px #10b981; animation: overlayPulse 1.5s infinite;">
                    </div>
                    <span style="font-size: 13px; font-weight: 600; color: #e2e8f0;" id="overlayStatusText">Authorizing
                        payment settlement...</span>
                </div>
            </div>
        </div>
        <style>
            @keyframes overlaySpin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            @keyframes overlaySpinReverse {
                0% {
                    transform: rotate(360deg);
                }

                100% {
                    transform: rotate(0deg);
                }
            }

            @keyframes overlayPulse {

                0%,
                100% {
                    opacity: 1;
                    transform: scale(1);
                }

                50% {
                    opacity: 0.4;
                    transform: scale(0.85);
                }
            }
        </style>
    @endif
    @include('partials.header')
    @yield('content')
    @include('partials.footer')
    <div id="otpModal" class="modal-uber">
        <div class="modal-content-uber">
            <div class="modal-header-uber">Verify Your Number</div>
            <div class="modal-body-uber">We've sent a 4-digit OTP to your registered phone number.</div>
            <input type="text" id="otpInput" class="otp-input-uber" placeholder="0000" maxlength="4" inputmode="numeric"
                autofocus>
            <div class="otp-btn-group">
                <button class="btn-modal-secondary" onclick="closeModal('otpModal')">Cancel</button>
                <button class="btn-modal-primary" onclick="verifyOtp()">Verify</button>
            </div>
        </div>
    </div>
    <div class="modal-uber" id="vehicleInfoModal">
        <div class="modal-content-uber" style="max-width:400px;">
            <div class="for-me-modal-header"
                style="border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 15px;">
                <h5 id="vehicleModalTitle" style="font-weight: 700; font-size: 18px; margin: 0;">Vehicle Details</h5>
                <button class="for-me-close-btn" onclick="closeModal('vehicleInfoModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="vehicleModalContent"></div>
        </div>
    </div>

    <div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered help-modal-dialog">
            <div class="modal-content help-modal">

                <div class="modal-header help-modal-header border-0 pb-0">
                    <div class="help-modal-header-title">
                        <h5 class="modal-title" id="helpModalLabel">Contact Us</h5>
                        <div class="title-underline"></div>
                    </div>
                    <button type="button" class="btn-close help-btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body help-modal-body text-center pt-2">

                    <div class="help-banner-wrapper">
                        <img src="{{ asset('goride/img/support-call.png') }}" alt="Customer Support"
                            class="help-banner-img">
                    </div>

                    <h5 class="help-subtitle">Need <span class="text-highlight">Assistance?</span></h5>

                    <p class="help-desc">
                        Our support team is here to help you 24/7.
                    </p>

                    <div class="help-cards-list">
                        <!-- WhatsApp Card -->
                        <a href="https://api.whatsapp.com/send/?phone=447950323242&text=Hi%2C%20I%20need%20a%20cab.%20Could%20you%20help%20me%20book%20one%3F&type=phone_number&app_absent=0" target="_blank" class="help-card help-card-whatsapp">
                            <div class="help-card-icon-box whatsapp-bg">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="help-card-info">
                                <div class="help-card-title">WhatsApp Us</div>
                            </div>
                            <div class="help-card-action">
                                <span class="help-card-contact whatsapp-color">+44 79 5032 3242</span>
                                <i class="fas fa-chevron-right help-card-arrow whatsapp-color"></i>
                            </div>
                        </a>

                        <!-- Call Card -->
                        <div class="help-card help-card-call">
                            <div class="help-card-icon-box call-bg">
                                <i class="fas fa-phone-alt" style="transform: rotate(90deg);"></i>
                            </div>
                            <div class="help-card-info">
                                <div class="help-card-title">Call Us</div>
                            </div>
                            <div class="help-card-action flex-column align-items-end">
                                <a href="tel:+442083373777" class="help-card-contact call-color">+44 20 8337 3777</a>

                            </div>
                            <i class="fas fa-chevron-right help-card-arrow call-color ms-1"></i>
                        </div>

                        <!-- Email Card -->
                        <a href="mailto:support.uk@goride.run" class="help-card help-card-email">
                            <div class="help-card-icon-box email-bg">
                                <i class="far fa-envelope"></i>
                            </div>
                            <div class="help-card-info">
                                <div class="help-card-title">Email Us</div>
                            </div>
                            <div class="help-card-action">
                                <span class="help-card-contact email-color">support.uk@goride.run</span>
                                <i class="fas fa-chevron-right help-card-arrow email-color"></i>
                            </div>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div id="appPromoModal" class="modal-uber">
        <div class="modal-content-uber">
            <div class="app-promo-modal-content">
                <button class="app-promo-close" onclick="closeModal('appPromoModal')" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <div class="app-promo-title">Unlock Exclusive Offers</div>
                <div class="app-promo-subtitle">Download the GoRide app to use your credit instantly and access
                    exclusive deals</div>
                <div class="app-promo-benefits">
                    <div class="app-promo-benefit">
                        <i class="fas fa-star"></i>
                        <span>Exclusive app-only discounts</span>
                    </div>
                    <div class="app-promo-benefit">
                        <i class="fas fa-bolt"></i>
                        <span>Faster booking process</span>
                    </div>
                    <div class="app-promo-benefit">
                        <i class="fas fa-shield-alt"></i>
                        <span>Safer payment methods</span>
                    </div>
                    <div class="app-promo-benefit">
                        <i class="fas fa-location-arrow"></i>
                        <span>Real-time tracking & updates</span>
                    </div>
                </div>
                <div class="app-store-buttons">
                    <a href="https://apps.apple.com/in/app/goride-cab-bike-taxi-pool/id6763038270"
                        class="app-store-btn">
                        <i class="fab fa-apple"></i>
                        <div class="app-store-btn-text">
                            <span class="app-store-btn-label">Download on the</span>
                            <span class="app-store-btn-name">App Store</span>
                        </div>
                    </a>
                    <a href="https://play.google.com/store/apps/details?id=com.shi.goride_customer"
                        class="app-store-btn">
                        <i class="fab fa-google-play"></i>
                        <div class="app-store-btn-text">
                            <span class="app-store-btn-label">Get it on</span>
                            <span class="app-store-btn-name">Google Play</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="driverConfirmModal" class="modal-uber">
        <div class="modal-content-uber" style="max-width: 500px;">
            <div class="confirm-modal-content">
                <div class="confirm-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2 class="confirm-title">Driver Assigned!</h2>
                <div class="driver-confirm-card">
                    <img id="driverConfirmImage" src="" alt="Driver" class="driver-confirm-image">
                    <h3 id="driverConfirmName">Driver Name</h3>
                    <p id="driverConfirmVehicle" class="driver-vehicle">Vehicle Type</p>
                    <p class="driver-confirm-rating">
                        <i class="fas fa-star"></i> <span id="driverConfirmRating">4.8</span>
                    </p>
                </div>
                <div class="confirm-fare-summary">
                    <div class="fare-row">
                        <span>Base Fare</span>
                        <span id="confirmBaseFare">£0.00</span>
                    </div>

                    <div class="fare-total">
                        <span>Estimated Fare</span>
                        <span class="total-amount" id="confirmTotalFare">£0.00</span>
                    </div>
                </div>
                <p class="confirm-info-text">
                    Your driver has been assigned. They will arrive shortly.
                </p>
                <button class="btn-modal-primary" id="closeDriverConfirmBtn" style="width: 100%;">
                    <i class="fas fa-check"></i> Complete Booking
                </button>
            </div>
        </div>
    </div>
    <div id="carDetailsModal" class="modal-uber">
        <div class="modal-content-uber" style="max-width: 600px;">
            <div class="confirm-modal-content">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h3 style="margin: 0; font-size: 20px; font-weight: 700;">Vehicle Details</h3>
                    <button class="for-me-close-btn" onclick="closeModal('carDetailsModal')" style="position: static;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!-- Carousel -->
                <div
                    style="position: relative; width: 100%; height: 300px; margin-bottom: 20px; overflow: hidden; border-radius: 8px;">
                    <img id="carCarouselImage"
                        src="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG_II') }}/goride/img/fleet1.png"
                        style="width: 100%; height: 100%; object-fit: contain;" alt="Car view">
                    <button onclick="prevCarImage()"
                        style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.8); border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                        <i class="fas fa-chevron-left" style="color: #333;"></i>
                    </button>
                    <button onclick="nextCarImage()"
                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.8); border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                        <i class="fas fa-chevron-right" style="color: #333;"></i>
                    </button>
                </div>
                <!-- Thumbnails -->
                <div id="carThumbnailsContainer"
                    style="display: flex; gap: 10px; justify-content: center; margin-bottom: 20px;">
                    <!-- <img src="goride/img/fleet1.png" onclick="setCarImageIndex(1)" class="car-thumbnail"
                        style="width: 60px; height: 45px; object-fit: cover; border-radius: 4px; cursor: pointer; border: 2px solid #f5c00b;">
                    <img src="goride/img/fleet2.png" onclick="setCarImageIndex(2)" class="car-thumbnail"
                        style="width: 60px; height: 45px; object-fit: cover; border-radius: 4px; cursor: pointer; border: 2px solid transparent;">
                    <img src="goride/img/fleet3.png" onclick="setCarImageIndex(3)" class="car-thumbnail"
                        style="width: 60px; height: 45px; object-fit: cover; border-radius: 4px; cursor: pointer; border: 2px solid transparent;">
                    <img src="goride/img/fleet4.png" onclick="setCarImageIndex(4)" class="car-thumbnail"
                        style="width: 60px; height: 45px; object-fit: cover; border-radius: 4px; cursor: pointer; border: 2px solid transparent;"> -->
                </div>
            </div>
        </div>
    </div>
    <div id="fareBreakdownModal" class="modal-uber">
        <div class="modal-content-uber" style="max-width: 400px; padding: 25px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <h3 style="margin: 0; font-size: 20px; font-weight: 700;">Fare Breakdown</h3>
                <button class="for-me-close-btn" onclick="closeModal('fareBreakdownModal')"
                    style="position: static; font-size: 20px; background: none; border: none; cursor: pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div style="display: flex; flex-direction: column; gap: 15px; font-size: 15px; color: #333;">
                <div
                    style="display: flex; justify-content: space-between; padding-bottom: 15px; border-bottom: 1px dotted #ccc;">
                    <span>Base fare</span>
                    <span id="fbBaseFare">£7.43</span>
                </div>
                <div
                    style="display: flex; justify-content: space-between; padding-bottom: 15px; border-bottom: 1px dotted #ccc;">
                    <span>Minimum fare</span>
                    <span id="fbMinFare">£11.80</span>
                </div>
                <div
                    style="display: flex; justify-content: space-between; padding-bottom: 15px; border-bottom: 1px dotted #ccc;">
                    <span>+ per minute</span>
                    <span id="fbPerMinute">£0.10</span>
                </div>
                <div
                    style="display: flex; justify-content: space-between; padding-bottom: 15px; border-bottom: 1px dotted #ccc;">
                    <span>+ per mile</span>
                    <span id="fbPerMile">£0.71</span>
                </div>
                <div
                    style="display: flex; justify-content: space-between; padding-bottom: 15px; border-bottom: 1px dotted #ccc;">
                    <span>Estimated surcharges</span>
                    <span id="fbSurcharges">£22.47</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-weight: 700;">
                    <span>Estimated Operating Fee</span>
                    <span id="fbTotal">£35.67</span>
                </div>
            </div>
        </div>
    </div>
    <div id="forMeModal" class="modal-uber">
        <div class="modal-content-uber" style="max-width: 350px;">
            <div class="for-me-modal-header">
                <div class="for-me-modal-title">Choose a rider</div>
                <button class="for-me-close-btn" onclick="closeModal('forMeModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="for-me-options">
                <button class="for-me-option" onclick="selectForMe('Me')">
                    <div class="for-me-option-left">
                        <div class="for-me-option-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="for-me-option-text">Me</span>
                    </div>
                    <i class="fas fa-dot-circle for-me-radio" id="forMeRadioMe" style="color: #000;"></i>
                </button>
                <button class="for-me-option" onclick="selectForMe('Book a trip for someone else')">
                    <div class="for-me-option-left">
                        <div class="for-me-option-avatar user-plus">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <span class="for-me-option-text">Book a trip for someone else</span>
                    </div>
                    <i class="far fa-circle for-me-radio" id="forMeRadioOther" style="color: #999;"></i>
                </button>
            </div>
            <button type="button" class="btn-modal-primary" id="forMeModalDoneBtn" onclick="closeForMeModal()">
                Done
            </button>
        </div>
    </div>
    <div class="modal-uber" id="bookForOtherModal">
        <div class="modal-content-uber">
            <div class="for-me-modal-header">
                <h5 class="for-me-modal-title">Passenger Details</h5>
                <button class="for-me-close-btn" onclick="closeModal('bookForOtherModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="form-group-uber">
                <label>Passenger Name</label>
                <input type="text" id="otherPassengerName" placeholder="Enter passenger name" maxlength="75"
                    oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').slice(0, 75)">
            </div>
            <div class="form-group-uber">
                <label>Mobile Number</label>
                <input type="text" id="otherPassengerPhone" placeholder="Enter Mobile Number" maxlength="12"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12)">
            </div>
            <button class="btn-search-uber" onclick="saveOtherPassenger()">
                Save Details
            </button>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <div id="cookiecontent" class="cookie-banner-wrapper" style="display: none;">
        <div class="cookie-banner">
            <div class="cookie-banner-content">
                <h5 class="cookie-banner-title">We Value Your Privacy</h5>
                <p class="cookie-banner-text">
                    We use cookies to improve your browsing experience, personalize
                    content and analyze our traffic.
                </p>
            </div>

            <div class="cookie-banner-actions">
                <button type="button" class="cookie-btn cookie-btn-reject"
                    onclick="document.getElementById('cookiecontent').style.display='none'">
                    Reject
                </button>

                <button type="button" class="cookie-btn cookie-btn-accept" onclick="acceptCookieConsent()">
                    Accept
                </button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/intlTelInput.min.js"></script>

    <script>
        function scrollToInputMobile(element) {
            if (window.innerWidth <= 768) {
                setTimeout(() => {
                    const topPos = element.getBoundingClientRect().top + window.scrollY - 100;
                    window.scrollTo({ top: topPos, behavior: 'smooth' });
                }, 300);
            }
        }

        // Returns a Date object whose local fields match the current UK time.
        // This ensures the frontend date comparisons and flatpickr instances use UK time regardless of the user's timezone.
        // Cache the formatter to prevent heavy instantiation lag on mobile devices
        const _ukTimeFormatter = new Intl.DateTimeFormat("en-US", {
            timeZone: "Europe/London",
            year: "numeric",
            month: "numeric",
            day: "numeric",
            hour: "numeric",
            minute: "numeric",
            second: "numeric",
            hour12: true
        });

        function getUKDate() {
            return new Date(_ukTimeFormatter.format(new Date()));
        }

        function normalizeLocationType(type) {
            if (!type) return 'address';
            const t = type.toLowerCase();
            if (t.includes('airport')) return 'airport';
            if (t.includes('seaport')) return 'seaport';
            if (t.includes('railway_station') || t.includes('train')) return 'railway_station';
            if (t.includes('hotel')) return 'hotel';
            if (t.includes('mall') || t.includes('shopping')) return 'mall';
            if (t.includes('hospital')) return 'hospital';
            if (t.includes('university')) return 'university';
            if (t.includes('school')) return 'school';
            if (t.includes('landmark') || t.includes('point_of_interest')) return 'landmark';
            return type;
        }

        function getIconForType(type) {
            const normalized = normalizeLocationType(type);
            switch (normalized) {
                case 'airport':
                    return 'plane-departure';
                case 'railway_station':
                    return 'train';
                case 'hotel':
                    return 'hotel';
                case 'mall':
                    return 'shopping-bag';
                case 'hospital':
                    return 'hospital';
                case 'university':
                    return 'graduation-cap';
                case 'school':
                    return 'school';
                case 'landmark':
                    return 'location-dot';
                case 'city':
                    return 'city';
                case 'area':
                    return 'city';
                case 'seaport':
                    return 'anchor';
                default:
                    return 'map-marker-alt';
            }
        }
        let searchAbortController = null;
        async function handleLocationSearch(query, containerId, target, wrapperId) {
            const suggestions = document.getElementById(containerId);
            const wrapper = wrapperId ? document.getElementById(wrapperId) : null;
            if (!query || query.length < 2) {
                if (searchAbortController) {
                    searchAbortController.abort();
                    searchAbortController = null;
                }
                clearTimeout(searchTimeout);
                suggestions.classList.remove('show');
                if (wrapper) wrapper.classList.remove('is-loading');
                return;
            }

            // Cancel any previous pending API search request
            if (searchAbortController) {
                searchAbortController.abort();
            }
            searchAbortController = new AbortController();
            const signal = searchAbortController.signal;

            // Show skeleton immediately for visual feedback
            const skeletonHtml = `
                <div class="suggestion-skeleton"><div class="sk-icon"></div><div class="sk-line long"></div></div>
                <div class="suggestion-skeleton"><div class="sk-icon"></div><div class="sk-line medium"></div></div>
                <div class="suggestion-skeleton"><div class="sk-icon"></div><div class="sk-line short"></div></div>
                <div class="suggestion-skeleton"><div class="sk-icon"></div><div class="sk-line long"></div></div>
            `;
            suggestions.innerHTML = skeletonHtml;
            suggestions.classList.add('show');
            if (wrapper) wrapper.classList.add('is-loading');

            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(async () => {
                try {
                    const authToken = getCookieValue('auth_token');
                    const headers = {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    };
                    if (authToken && authToken !== 'null' && authToken !== 'undefined' && authToken.trim() !== '') {
                        headers['Authorization'] = 'Bearer ' + authToken;
                    }
                    const response = await fetch(API_BASE_URL + '/web-get-location?search=' + encodeURIComponent(query), {
                        method: 'GET',
                        signal: signal,
                        headers: headers
                    });
                    const result = await response.json();
                    if (wrapper) wrapper.classList.remove('is-loading');
                    if (result.status === 200 && result.data.length > 0) {
                        let clickFunction = '';
                        if (target === 'pickup') clickFunction = 'selectPickup';
                        else if (target === 'dropoff') clickFunction = 'selectDropoff';
                        const html = result.data.map(loc => `
                        <div class="suggestion-item" onclick="${clickFunction}('${loc.name.replace(/'/g, "\\'")}', '${loc.types}')">
                            <i class="fas fa-${getIconForType(loc.types)}"></i>
                            <span>${loc.name}</span>
                        </div>
                    `).join('');
                        suggestions.innerHTML = html;
                        suggestions.classList.add('show');
                    } else {
                        suggestions.innerHTML = `<div class="suggestion-skeleton" style="justify-content:center; color:#999; font-size:13px;">No results found</div>`;
                    }
                } catch (error) {
                    if (error.name === 'AbortError') {
                        // Silently drop aborted requests
                        return;
                    }
                    if (wrapper) wrapper.classList.remove('is-loading');
                    console.error(error);
                    suggestions.classList.remove('show');
                }
            }, 300);
        }
        // ============================================================
        // BOOKING STATE MANAGEMENT
        // ============================================================
        // A lightweight reactive store for all booking state.
        // Usage:
        //   BookingStore.setState({ pickup: 'Heathrow' });
        //   const { pickup } = BookingStore.getState();
        //   BookingStore.subscribe((state, prev) => { /* react */ });
        // ============================================================

        function createBookingStore(initial) {
            let _state = Object.assign({}, initial);
            const _subscribers = [];
            const _STORAGE_KEY = 'gorideBookingState_v2';

            // Keys that are too large / non-serializable to persist (fareDataObj/vehicle are allowed so UI restores correctly)
            const _SKIP_PERSIST = ['apiPolyline', 'selectedDriver'];

            function _persist(s) {
                try {
                    const toSave = {};
                    Object.keys(s).forEach(k => {
                        if (!_SKIP_PERSIST.includes(k)) toSave[k] = s[k];
                    });
                    sessionStorage.setItem(_STORAGE_KEY, JSON.stringify(toSave));
                } catch (e) { /* quota exceeded – silently ignore */ }
            }

            return {
                getState() { return Object.assign({}, _state); },

                setState(partial) {
                    const prev = _state;
                    _state = Object.assign({}, _state, partial);
                    _subscribers.forEach(fn => { try { fn(_state, prev); } catch (e) { console.warn('BookingStore subscriber error', e); } });
                    _persist(_state);
                },

                subscribe(fn) {
                    _subscribers.push(fn);
                    return () => { const i = _subscribers.indexOf(fn); if (i > -1) _subscribers.splice(i, 1); };
                },

                restore() {
                    try {
                        const raw = sessionStorage.getItem(_STORAGE_KEY);
                        if (raw) {
                            const saved = JSON.parse(raw);
                            _state = Object.assign({}, _state, saved);
                        }
                    } catch (e) { /* corrupt data – silently ignore */ }
                },

                clear() {
                    try { sessionStorage.removeItem(_STORAGE_KEY); } catch (e) { }
                    _state = Object.assign({}, initial);
                    _subscribers.forEach(fn => { try { fn(_state, {}); } catch (e) { } });
                }
            };
        }

        // ---- Initial state (canonical, all booking fields) ----
        const _bookingInitialState = {
            // Step 1 – Locations
            pickup: '',
            pickupType: '',
            pickupSelected: false,
            dropoff: '',
            dropoffType: '',
            dropoffSelected: false,

            // Date / Time
            date: '',
            time: '',
            bookingType: 'now',      // 'now' | 'schedule'

            // Airport / Seaport
            landingTime: '',
            pickupAfter: 45,

            // Return trip
            returnTrip: false,
            returnPickup: '',
            returnPickupType: '',
            returnDropoff: '',
            returnDropoffType: '',

            // Vehicle (Step 3)
            vehicle: null,
            fareDataObj: null,
            apiDistance: null,
            apiDuration: null,
            apiPolyline: null,
            apiDistanceMiles: null,

            // Passenger (Step 4)
            passengerFirstName: '',
            passengerLastName: '',
            passengerPhone: '',
            passengerEmail: '',
            passengerCount: 1,
            luggageCount: 0,
            handLuggageCount: 0,
            isBabySeat: false,
            childSeatCount: 0,
            childSeatTypes: [],

            // Rider selection
            rideFor: 'me',
            otherPassengerData: null,

            // Journey-specific
            flightNumber: '',
            comingFrom: '',
            dropoffAddress: '',
            pickAfterTime: '',
            ferryName: '',
            dockingTime: '',
            comingFromPort: '',
            dropoffAddressSeaport: '',
            normalJourneyDate: '',
            normalJourneyTime: '',

            // Special requirements
            isSpecialReq: false,
            specialRequirements: '',

            // Payment (Step 5)
            paymentMethod: '',
            meetAndGreet: false,
            wheelchairOption: false,
            paymentBreakdown: null,
            total_fare: null,
            part_pay_fare: null,
            base_fare: null,
            tax: null,
            firstAmt: null,
            id: null,
            payment_id: null,
            paymentId: null,
            transaction_id: '',

            // Driver (Steps 6/7)
            bookingId: null,
            job_no: null,
            jobId: null,
            job_id: null,
            selectedDriver: null,
            tempDriver: null,
            firebaseConfig: null,
            firebaseCustomToken: null,

            // Expiration logic
            effectivePickupDateTime: null,
            isBookingExpired: false,

            // Booking confirmation
            currentStep: 1,
        };

        // ---- Create the store ----
        const BookingStore = createBookingStore(_bookingInitialState);

        const WEBSITE_APP_URL = "{{ env('WEBSITE_APP_URL') }}";
        const COUNTRY_SLUG_II = "{{ env('COUNTRY_SLUG_II') }}";
        const GORIDE_IMG_PREFIX = `${WEBSITE_APP_URL}${COUNTRY_SLUG_II}/goride/img/`;

        // ---- Backward-compatible Proxy shim ----
        // All existing code that reads/writes bookingData.xyz continues working.
        // Reads always reflect current store state; writes call setState automatically.
        const bookingData = new Proxy({}, {
            get(_, key) { return BookingStore.getState()[key]; },
            set(_, key, val) { BookingStore.setState({ [key]: val }); return true; }
        });
        const vehicles = [{
            id: 1,
            name: "Standard",
            capacity: 4,
            luggage: 2,
            price: 45,
            priceMax: 65,
            image: `${GORIDE_IMG_PREFIX}saloon.png`,
            details: "Toyota Prius or Similar",
            fuel: "Hybrid",
            transmission: "Automatic",
            airCondition: "Yes",
            childSeat: true,
            vehicleYear: "2023",
            rating: 4.9,
            reviews: "320+",
            arrivalTime: "12 min",
            recommended: true,
            tag: "Cheapest",
            tagDesc: "Save up to £18",
            amenities: ["WiFi", "Air Con", "Child Seat"],
            inclusions: [
                "Meet & Greet",
                "Flight Monitoring",
                "60 Minutes Airport Waiting",
                "Free Cancellation",
                "24/7 Customer Support",
                "Door to Door Service"
            ]
        },
        {
            id: 2,
            name: "Estate",
            capacity: 4,
            luggage: 4,
            price: 55,
            priceMax: 80,
            image: `${GORIDE_IMG_PREFIX}estate.png`,
            details: "Skoda Octavia Estate",
            fuel: "Diesel",
            transmission: "Automatic",
            airCondition: "Yes",
            childSeat: true,
            vehicleYear: "2022",
            rating: 4.8,
            reviews: "210+",
            arrivalTime: "15 min",
            recommended: false,
            tag: "Most Popular",
            tagDesc: "",
            amenities: ["WiFi", "Air Con", "Child Seat"],
            inclusions: [
                "Meet & Greet",
                "Flight Monitoring",
                "60 Minutes Airport Waiting",
                "Free Cancellation",
                "Extra Luggage Space"
            ]
        },
        {
            id: 3,
            name: "Executive",
            capacity: 4,
            luggage: 3,
            price: 75,
            priceMax: 110,
            image: `${GORIDE_IMG_PREFIX}executive.png`,
            details: "Mercedes E-Class",
            fuel: "Hybrid",
            transmission: "Automatic",
            airCondition: "Yes",
            childSeat: true,
            vehicleYear: "2024",
            rating: 4.9,
            reviews: "180+",
            arrivalTime: "12 min",
            recommended: false,
            tag: "",
            tagDesc: "",
            amenities: ["WiFi", "Air Con", "Child Seat"],
            inclusions: [
                "Meet & Greet",
                "Professional Chauffeur",
                "Flight Monitoring",
                "60 Minutes Waiting",
                "Luxury Interior"
            ]
        },
        {
            id: 4,
            name: "MPV",
            capacity: 6,
            luggage: 6,
            price: 85,
            priceMax: 125,
            image: `${GORIDE_IMG_PREFIX}mpv.png`,
            details: "VW Sharan or Similar",
            fuel: "Diesel",
            transmission: "Automatic",
            airCondition: "Yes",
            childSeat: true,
            vehicleYear: "2023",
            rating: 4.7,
            reviews: "150+",
            arrivalTime: "18 min",
            recommended: false,
            tag: "Best for Families",
            tagDesc: "",
            amenities: ["WiFi", "Air Con", "Child Seat"],
            inclusions: [
                "Meet & Greet",
                "Flight Monitoring",
                "Large Luggage Capacity",
                "Free Cancellation",
                "Family Friendly"
            ]
        }
        ];
        const drivers = [
            {
                id: 1,
                name: "Rajesh Kumar",
                rating: 4.9,
                trips: 2840,
                experience: "8+ Years",
                languages: "English, Hindi",
                licence: "Licensed Chauffeur",
                avatar: '<img src="https://randomuser.me/api/portraits/men/32.jpg">',
                bid: 42.50,
                total: 44.50,
                eta: "3 mins",
                waiting: "15 mins",
                badge: "Lowest Bid"
            },
            {
                id: 2,
                name: "Priya Singh",
                rating: 4.95,
                trips: 1950,
                experience: "6+ Years",
                languages: "English, Hindi",
                licence: "Licensed Chauffeur",
                avatar: '<img src="https://randomuser.me/api/portraits/women/44.jpg">',
                bid: 45,
                total: 47,
                eta: "4 mins",
                waiting: "10 mins",
                badge: "Top Rated"
            },
            {
                id: 3,
                name: "Mohammad Ahmed",
                rating: 4.8,
                trips: 3200,
                experience: "10+ Years",
                languages: "English, Urdu",
                licence: "Licensed Chauffeur",
                avatar: '<img src="https://randomuser.me/api/portraits/men/46.jpg">',
                bid: 47,
                total: 49,
                eta: "6 mins",
                waiting: "15 mins",
                badge: "Premium"
            }
        ];
        let viaPointCount = 0;
        let searchTimeout;
        let currentEditingField = null;
        let currentCarImageIndex = 1;
        let totalCarImages = 4;
        let dynamicCarImages = [];
        const MAX_VIA_POINTS = 3;

        // ---- Store-backed globals (these stay in sync via the Proxy) ----
        // selectedTime, rideFor, otherPassengerData, bookingType are now
        // read/written through the store for full reactivity.
        Object.defineProperties(window, {
            selectedTime: { get() { return BookingStore.getState().time; }, set(v) { BookingStore.setState({ time: v }); }, configurable: true },
            rideFor: { get() { return BookingStore.getState().rideFor; }, set(v) { BookingStore.setState({ rideFor: v }); }, configurable: true },
            otherPassengerData: { get() { return BookingStore.getState().otherPassengerData; }, set(v) { BookingStore.setState({ otherPassengerData: v }); }, configurable: true },
            bookingType: { get() { return BookingStore.getState().bookingType; }, set(v) { BookingStore.setState({ bookingType: v }); }, configurable: true },
        });

        // ============================================================
        // VIEW UPDATER SUBSCRIBERS
        // Each updater is focused on a specific region of the UI.
        // They are registered once in document.ready.
        // ============================================================

        function _updateLocationUI(state) {
            // Step 1 inputs - do NOT overwrite input text if user is actively typing in the field
            const pickupEl = document.getElementById('pickupInput');
            const dropoffEl = document.getElementById('dropoffInput');
            if (pickupEl && document.activeElement !== pickupEl && pickupEl.value !== (state.pickup || '')) {
                pickupEl.value = state.pickup || '';
            }
            if (dropoffEl && document.activeElement !== dropoffEl && dropoffEl.value !== (state.dropoff || '')) {
                dropoffEl.value = state.dropoff || '';
            }

            // Step 2 summary display
            const summaryPickup = document.getElementById('summaryPickup');
            const summaryDropoff = document.getElementById('summaryDropoff');
            if (summaryPickup) summaryPickup.textContent = state.pickup || '\u2013';
            if (summaryDropoff) summaryDropoff.textContent = state.dropoff || '\u2013';

            // Mobile compact summary
            const mcsPickup = document.getElementById('mcsPickup');
            const mcsDropoff = document.getElementById('mcsDropoff');
            if (mcsPickup) { mcsPickup.textContent = state.pickup; mcsPickup.title = state.pickup || ''; }
            if (mcsDropoff) { mcsDropoff.textContent = state.dropoff; mcsDropoff.title = state.dropoff || ''; }

            // Time panel location label
            const tpl = document.getElementById('timePanelLocation');
            if (tpl) tpl.textContent = state.pickup || '\u2014';
        }

        function formatUIOrdinalDate(dateStr) {
            if (!dateStr || dateStr.toLowerCase() === 'today') return dateStr;
            const parts = dateStr.split('-');
            if (parts.length !== 3) return dateStr;
            const d = new Date(parts[0], parts[1] - 1, parts[2]);
            if (isNaN(d.getTime())) return dateStr;
            const day = d.getDate();
            const nth = function (d) {
                if (d > 3 && d < 21) return 'th';
                switch (d % 10) {
                    case 1: return "st";
                    case 2: return "nd";
                    case 3: return "rd";
                    default: return "th";
                }
            };
            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            const month = monthNames[d.getMonth()];
            const year = d.getFullYear();
            return day + nth(day) + ' ' + month + ' ' + year;
        }

        function _updateDateTimeUI(state) {
            // Trip date/time card (Step 2)
            const tripDate = document.getElementById('tripSelectedDate');
            const tripTime = document.getElementById('tripSelectedTime');
            if (tripDate) tripDate.textContent = state.date ? formatUIOrdinalDate(state.date) : '--';
            const displayTime = (state.pickupType === 'airport' ? (state.landingTime || state.flightLandingTime || state.flightArrivingTime || state.time) : (state.pickupType === 'seaport' ? (state.dockingTime || state.cruiseDockingTime || state.time) : state.time));
            if (tripTime) tripTime.textContent = displayTime || '--';

            // Mobile compact summary grid
            const d = state.date ? formatUIOrdinalDate(state.date) : 'Today';
            const t = displayTime || 'Now';
            $('#mcsDateValue').text(d);
            $('#mcsTimeValue').text(t);

            if (state.time && typeof checkNightChargeNotice === 'function') {
                checkNightChargeNotice(state.time);
            }

            // Sync the actual date picker input
            if (state.date) {
                const dateElement = document.getElementById('date');
                if (dateElement && dateElement._flatpickr) {
                    dateElement._flatpickr.setDate(state.date, false);
                } else if (dateElement) {
                    dateElement.value = state.date;
                }
            }

            // Dynamic Date and Time header labels for Desktop & Mobile stat boxes
            if (state.pickupType === 'airport') {
                $('#dtStatDateLabel, #mcsStatDateLabel').text('FLIGHT ARRIVAL DATE');
                $('#dtStatTimeLabel, #mcsStatTimeLabel').text('FLIGHT LANDING TIME');
            } else if (state.pickupType === 'seaport') {
                $('#dtStatDateLabel, #mcsStatDateLabel').text('DOCKING DATE');
                $('#dtStatTimeLabel, #mcsStatTimeLabel').text('DOCKING TIME');
            } else {
                $('#dtStatDateLabel, #mcsStatDateLabel').text('DATE');
                $('#dtStatTimeLabel, #mcsStatTimeLabel').text('TIME');
            }

            // pickupNowBtn label
            const pnb = document.getElementById('pickupNowBtn');
            if (pnb && state.date && state.time) {
                const uiDate = formatUIOrdinalDate(state.date);
                if (state.pickupType === 'airport') {
                    pnb.innerHTML = `<i class="fas fa-plane-departure"></i> ${uiDate} &nbsp; <i class="fas fa-clock"></i> ${state.time} <i class="fas fa-chevron-down ms-2"></i>`;
                } else if (state.pickupType === 'seaport') {
                    pnb.innerHTML = `<i class="fas fa-anchor"></i> ${uiDate} &nbsp; <i class="fas fa-clock"></i> ${state.time} <i class="fas fa-chevron-down ms-2"></i>`;
                } else {
                    pnb.innerHTML = `<i class="fas fa-calendar"></i> ${uiDate} &nbsp; <i class="fas fa-clock"></i> ${state.time} <i class="fas fa-chevron-down ms-2"></i>`;
                }
            }
        }

        function extractExtraCharges(faresResult, fareDataObj) {
            let raw = null;
            if (faresResult) {
                if (faresResult.extra_charge !== undefined) raw = faresResult.extra_charge;
                else if (faresResult.extra_charges !== undefined) raw = faresResult.extra_charges;
                else if (faresResult.extraCharge !== undefined) raw = faresResult.extraCharge;
                else if (faresResult.extraCharges !== undefined) raw = faresResult.extraCharges;
                else if (faresResult.data && faresResult.data.extra_charge !== undefined) raw = faresResult.data.extra_charge;
                else if (faresResult.data && faresResult.data.extra_charges !== undefined) raw = faresResult.data.extra_charges;
            }
            if (!raw && fareDataObj && typeof fareDataObj === 'object') {
                const first = Object.values(fareDataObj)[0];
                if (first) {
                    if (first.extra_charge !== undefined) raw = first.extra_charge;
                    else if (first.extra_charges !== undefined) raw = first.extra_charges;
                }
            }

            let childSeatRate = 0;
            let meetAndGreetRate = 0;

            if (raw) {
                if (typeof raw === 'string') {
                    try { raw = JSON.parse(raw); } catch (e) { }
                }
                if (typeof raw === 'number') {
                    childSeatRate = parseFloat(raw) || 0;
                    meetAndGreetRate = parseFloat(raw) || 0;
                } else if (Array.isArray(raw)) {
                    raw.forEach(item => {
                        if (item && typeof item === 'object') {
                            const name = (item.name || item.type || item.title || item.key || '').toLowerCase();
                            const val = parseFloat(item.charge || item.price || item.amount || item.value || item.cost || 0) || 0;
                            if (name.includes('child') || name.includes('baby') || name.includes('seat')) {
                                childSeatRate = val;
                            } else if (name.includes('meet') || name.includes('greet')) {
                                meetAndGreetRate = val;
                            }
                        }
                    });
                } else if (typeof raw === 'object' && raw !== null) {
                    // Check possible keys for child seat
                    if (raw.child_seat !== undefined) childSeatRate = parseFloat(raw.child_seat) || 0;
                    else if (raw.baby_seat !== undefined) childSeatRate = parseFloat(raw.baby_seat) || 0;
                    else if (raw.child !== undefined) childSeatRate = parseFloat(raw.child) || 0;
                    else if (raw.child_seat_charge !== undefined) childSeatRate = parseFloat(raw.child_seat_charge) || 0;
                    else if (raw.childSeat !== undefined) childSeatRate = parseFloat(raw.childSeat) || 0;

                    // Check possible keys for meet and greet
                    if (raw.meet_and_greet !== undefined) meetAndGreetRate = parseFloat(raw.meet_and_greet) || 0;
                    else if (raw.meet_greet !== undefined) meetAndGreetRate = parseFloat(raw.meet_greet) || 0;
                    else if (raw.meetAndGreet !== undefined) meetAndGreetRate = parseFloat(raw.meetAndGreet) || 0;
                    else if (raw.meet_and_greet_charge !== undefined) meetAndGreetRate = parseFloat(raw.meet_and_greet_charge) || 0;
                    else if (raw.meet !== undefined) meetAndGreetRate = parseFloat(raw.meet) || 0;
                }
            }

            return {
                raw: raw,
                child_seat: childSeatRate,
                meet_and_greet: meetAndGreetRate
            };
        }

        function _updateVehicleSummaryUI(state) {
            if (!state.vehicle) {
                $('#selectedCarSummary').hide();
                $('#mcsCarDetails').hide();
                return;
            }
            const v = state.vehicle;
            const basePriceFrom = parseFloat(v.price || v.fare || 0);
            const basePriceTo = (v.priceMax !== undefined && v.priceMax !== null && v.priceMax !== '') ? parseFloat(v.priceMax) : null;

            // Extract rates from stored extra_charge or vehicle breakdown
            const extraChargeObj = (v && v.fareBreakdown && (v.fareBreakdown.extra_charge || v.fareBreakdown.extra_charges))
                ? extractExtraCharges(null, { v: v.fareBreakdown })
                : (state.extraCharge || bookingData.extra_charge || {});

            const childSeatUnitRate = parseFloat(extraChargeObj.child_seat || extraChargeObj.baby_seat || 0) || 0;
            const meetGreetRate = parseFloat(extraChargeObj.meet_and_greet || extraChargeObj.meet_greet || extraChargeObj.meet || 0) || 0;

            const isBabySeat = state.isBabySeat || $('#carSeatCheckbox').is(':checked');
            const childSeatCount = isBabySeat ? (parseInt(state.childSeatCount !== undefined ? state.childSeatCount : $('#childSeatCount').val()) || 0) : 0;
            const isMeetGreet = state.meetAndGreet === '1' || state.meetAndGreet === true || $('#meetAndGreet').is(':checked') || $('#meetAndGreetSeaport').is(':checked') || $('.meet-and-greet-cb').is(':checked');

            const childSeatTotalExtra = childSeatUnitRate * childSeatCount;
            const meetGreetTotalExtra = isMeetGreet ? meetGreetRate : 0;
            const totalExtra = childSeatTotalExtra + meetGreetTotalExtra;

            // Add the extra charge to the "to" value (upper bound) of the price range
            let priceText = '';
            if (basePriceTo !== null && basePriceTo > 0) {
                const updatedPriceTo = basePriceTo + totalExtra;
                priceText = `\u00a3${basePriceFrom} \u2013 \u00a3${updatedPriceTo}`;
            } else if (totalExtra > 0) {
                const updatedPriceTo = basePriceFrom + totalExtra;
                priceText = `\u00a3${basePriceFrom} \u2013 \u00a3${updatedPriceTo}`;
            } else {
                priceText = `\u00a3${basePriceFrom}`;
            }
            const carImg = v.image || (typeof getCarImageUrl === 'function' ? getCarImageUrl(1) : `${GORIDE_IMG_PREFIX}fleet1.png`);

            // Sidebar selected vehicle summary (Step 2 side panel)
            $('#summaryCarImage').attr('src', carImg);
            $('#summaryCarName').text(v.name || 'Standard');
            $('#summaryCarCapacity').text(v.capacity || 4);
            $('#summaryCarLuggage').text(v.luggage || 2);
            $('#summaryCarHandLuggage').text(v.handLuggage || v.capacity || 4);
            if (v.child && v.child > 0) {
                $('#summaryCarChild').text(v.child);
                $('#summaryCarChildContainer').show();
            } else {
                $('#summaryCarChildContainer').hide();
            }
            $('#summaryCarPrice').text(priceText);
            $('#selectedCarSummary').show();

            // Mobile compact summary car details
            $('#mcsCarName').text(v.name || 'Standard');
            $('#mcsCarCapacity').text(v.capacity || 4);
            $('#mcsCarLuggage').text(v.luggage || 2);
            $('#mcsCarHandLuggage').text(v.handLuggage || v.capacity || 4);
            if (v.child && v.child > 0) {
                $('#mcsCarChild').text(v.child);
                $('#mcsCarChildContainer').show();
            } else {
                $('#mcsCarChildContainer').hide();
            }
            $('#mcsCarPrice').text(priceText);
            $('#mcsCarDetails').show();
        }

        function _updatePassengerSummaryUI(state) {
            function _fmtPhone(val) {
                if (!val) return '';
                const clean = val.trim();
                if (clean.startsWith('+')) return clean;
                return '+44 ' + clean;
            }

            // Passenger name
            const pName = (state.passengerFirstName + ' ' + (state.passengerLastName || '')).trim();
            $('#summaryPassengerName').text(state.passengerFirstName || '–');
            if (pName) {
                $('#mcsPassengerName').text(pName);
                $('#mcsPassengerNameContainer').css('display', 'flex');
            } else {
                $('#mcsPassengerNameContainer').hide();
            }

            // Booked for someone else support
            const isOther = state.rideFor === 'other' && state.otherPassengerData && state.otherPassengerData.name;
            if (isOther) {
                const otherName = state.otherPassengerData.name;
                const otherPhone = state.otherPassengerData.phone || '';

                $('#summaryBookedByLabel, #mcsBookedByLabel').show();
                $('#summaryBookedForName, #mcsBookedForName').text(otherName);
                if (otherPhone) {
                    $('#summaryBookedForPhone, #mcsBookedForPhone').text('(' + _fmtPhone(otherPhone) + ')').show();
                } else {
                    $('#summaryBookedForPhone, #mcsBookedForPhone').hide().text('');
                }
                $('#summaryBookedForContainer, #mcsBookedForContainer').show();
            } else {
                $('#summaryBookedByLabel, #mcsBookedByLabel').hide();
                $('#summaryBookedForContainer, #mcsBookedForContainer').hide();
            }

            // Phone
            const phone = state.passengerPhone || '';
            const fmtMainPhone = _fmtPhone(phone);
            $('#summaryPassengerContact').text(fmtMainPhone || '–');
            if (phone) {
                $('#mcsPassengerPhone').text(fmtMainPhone);
                $('#mcsPassengerPhoneContainer').css('display', 'flex');
            } else {
                $('#mcsPassengerPhoneContainer').hide();
            }

            // Email
            const email = state.passengerEmail || '';
            $('#summaryPassengerEmail').text(email || '\u2013');
            if (email) {
                $('#mcsPassengerEmail').text(email);
                $('#mcsPassengerEmailContainer').css('display', 'flex');
            } else {
                $('#mcsPassengerEmailContainer').hide();
            }

            // Counts
            $('#summaryPassengerCount').text(state.passengerCount || 1);
            $('#mcsPassengerCount').text(state.passengerCount || 1);
            $('#summaryLuggageCount').text(state.luggageCount || 0);
            $('#mcsLuggageCount').text(state.luggageCount || 0);
            if ((state.luggageCount || 0) > 0) { $('#mcsLuggageContainer').show(); } else { $('#mcsLuggageContainer').hide(); }

            $('#summaryHandLuggageCount').text(state.handLuggageCount || 0);
            $('#mcsHandLuggageCount').text(state.handLuggageCount || 0);
            if ((state.handLuggageCount || 0) > 0) { $('#mcsHandLuggageContainer').show(); } else { $('#mcsHandLuggageContainer').hide(); }

            // Baby seats
            if (state.isBabySeat && state.childSeatCount > 0) {
                const seatStr = state.childSeatTypes && state.childSeatTypes.length
                    ? `${state.childSeatCount} (${state.childSeatTypes.filter(Boolean).join(', ')})`
                    : String(state.childSeatCount);
                $('#summaryBabySeats').text(seatStr);
                $('#mcsBabySeats').text(seatStr);
                $('#summaryBabySeatContainer').show();
                $('#mcsBabySeatContainer').show();
            } else {
                $('#summaryBabySeatContainer').hide();
                $('#mcsBabySeatContainer').hide();
            }

            // Show/hide mcsEnteredDetails grid
            const currentStep = state.currentStep || 1;
            const hasDetails = (pName || email || phone) && currentStep >= 5;
            if (hasDetails) { $('#mcsEnteredDetails').css('display', 'grid'); } else { $('#mcsEnteredDetails').hide(); }
        }

        function _updateJourneySummaryUI(state) {
            const pickupType = state.pickupType;
            if (pickupType === 'airport') {
                $('#dtStatDateLabel, #mcsStatDateLabel').text('FLIGHT ARRIVAL DATE');
                $('#dtStatTimeLabel, #mcsStatTimeLabel').text('FLIGHT LANDING TIME');
                $('#summaryDateLabel').html('<i class="fas fa-calendar"></i> Flight Arrival Date');
                $('#summaryBookingDate').text(state.date || '\u2013');
                $('#summaryTimeLabel').html('<i class="fas fa-clock"></i> Flight Landing Time');
                $('#summaryBookingTime').text(state.landingTime || state.flightLandingTime || state.flightArrivingTime || state.time || '\u2013');

                const airportDetails = [state.flightNumber, state.comingFrom, state.dropoffAddress]
                    .filter(v => v && v.trim() !== '' && v.trim() !== '\u2013' && v.trim() !== '-')
                    .join(', ') || '\u2013';

                $('#summaryFlightLabel').html('<i class="fas fa-plane text-navy"></i>');
                $('#summaryFlightNumber').text(airportDetails);
                $('#summaryFlightContainer').show();
                $('#summaryComingFromContainer').hide();
                $('#summaryDropoffAddressContainer').hide();
                $('#summaryJourneyDetailsHeader').text('ADDITIONAL INFORMATION').show();

                $('#mcsFlightLabel').html('<i class="fas fa-plane text-navy"></i>');
                $('#mcsFlightNumber').text(airportDetails);
                $('#mcsFlightContainer').show();
                $('#mcsComingFromContainer').hide();
                $('#mcsDropoffAddressContainer').hide();
                $('#mcsJourneyDetailsHeader').text('ADDITIONAL INFORMATION').show();
            } else if (pickupType === 'seaport') {
                $('#dtStatDateLabel, #mcsStatDateLabel').text('DOCKING DATE');
                $('#dtStatTimeLabel, #mcsStatTimeLabel').text('DOCKING TIME');
                $('#summaryDateLabel').html('<i class="fas fa-calendar"></i> Docking Date');
                $('#summaryBookingDate').text(state.date || '\u2013');
                $('#summaryTimeLabel').html('<i class="fas fa-clock"></i> Docking Time');
                $('#summaryBookingTime').text(state.dockingTime || state.time || '\u2013');

                const seaportDetails = [state.ferryName, state.comingFromPort, state.dropoffAddressSeaport]
                    .filter(v => v && v.trim() !== '' && v.trim() !== '\u2013' && v.trim() !== '-')
                    .join(', ') || '\u2013';

                $('#summaryFlightLabel').html('<i class="fas fa-ship text-navy"></i>');
                $('#summaryFlightNumber').text(seaportDetails);
                $('#summaryFlightContainer').show();
                $('#summaryComingFromContainer').hide();
                $('#summaryDropoffAddressContainer').hide();
                $('#summaryJourneyDetailsHeader').text('ADDITIONAL INFORMATION').show();

                $('#mcsFlightLabel').html('<i class="fas fa-ship text-navy"></i>');
                $('#mcsFlightNumber').text(seaportDetails);
                $('#mcsFlightContainer').show();
                $('#mcsComingFromContainer').hide();
                $('#mcsDropoffAddressContainer').hide();
                $('#mcsJourneyDetailsHeader').text('ADDITIONAL INFORMATION').show();
            } else {
                $('#dtStatDateLabel, #mcsStatDateLabel').text('DATE');
                $('#dtStatTimeLabel, #mcsStatTimeLabel').text('TIME');
                $('#summaryDateLabel').html('<i class="fas fa-calendar"></i> Date');
                $('#summaryBookingDate').text(state.date || '\u2013');
                $('#summaryTimeLabel').html('<i class="fas fa-clock"></i> Time');
                $('#summaryBookingTime').text(state.time || '\u2013');
                $('#summaryFlightContainer').hide();
                $('#summaryComingFromContainer').hide();
                $('#summaryDropoffAddressContainer').hide();
                $('#summaryJourneyDetailsHeader').hide();

                $('#mcsFlightContainer').hide();
                $('#mcsComingFromContainer').hide();
                $('#mcsDropoffAddressContainer').hide();
                $('#mcsJourneyDetailsHeader').hide();
            }

            // Meet & Greet
            const isMeetGreetSub = state.meetAndGreet === '1' || state.meetAndGreet === true;
            if (isMeetGreetSub) {
                $('#summaryMeetGreetContainer').css('display', 'inline-flex');
                $('#mcsMeetGreetContainer').css('display', 'inline-flex');
            } else {
                $('#summaryMeetGreetContainer').hide();
                $('#mcsMeetGreetContainer').hide();
            }

            // Wheelchair Access
            const isWheelchairSub = state.wheelchairOption === '1' || state.wheelchairOption === true;
            if (isWheelchairSub) {
                $('#summaryWheelchairContainer').css('display', 'inline-flex');
                $('#mcsWheelchairContainer').css('display', 'inline-flex');
            } else {
                $('#summaryWheelchairContainer').hide();
                $('#mcsWheelchairContainer').hide();
            }

            // Special requirements
            const isSpecialReqSub = state.isSpecialReq && state.specialRequirements;
            if (isSpecialReqSub) {
                $('#summarySpecialRequirements').text(state.specialRequirements);
                $('#summarySpecialReqContainer').show();
                $('#mcsSpecialRequirements').text(state.specialRequirements);
                $('#mcsSpecialReqContainer').show();
            } else {
                $('#summarySpecialReqContainer').hide();
                $('#mcsSpecialReqContainer').hide();
            }

            const hasFlightOrCruiseSub = (pickupType === 'airport' || pickupType === 'seaport');
            const hasAddInfoSub = hasFlightOrCruiseSub || isMeetGreetSub || isWheelchairSub || !!isSpecialReqSub;
            if (hasAddInfoSub) {
                $('#summaryJourneyDetailsHeader').text('ADDITIONAL INFORMATION').css('display', 'block');
                $('#mcsJourneyDetailsHeader').text('ADDITIONAL INFORMATION').css('display', 'block');
            } else {
                $('#summaryJourneyDetailsHeader').hide();
                $('#mcsJourneyDetailsHeader').hide();
            }
        }

        function _updateDistanceDurationUI(state) {
            if (!state) state = (typeof BookingStore !== 'undefined' && BookingStore.getState) ? BookingStore.getState() : {};
            let dist = state.apiDistance || state.vehicle?.fareBreakdown?.distance || (state.fareDataObj && Object.values(state.fareDataObj)[0]?.distance) || (typeof bookingData !== 'undefined' ? bookingData.apiDistance : null);
            let dur = state.apiDuration || state.vehicle?.fareBreakdown?.duration || (state.fareDataObj && Object.values(state.fareDataObj)[0]?.duration) || (typeof bookingData !== 'undefined' ? bookingData.apiDuration : null);

            if (typeof bookingData !== 'undefined') {
                if (dist && !bookingData.apiDistance) bookingData.apiDistance = dist;
                if (dur && !bookingData.apiDuration) bookingData.apiDuration = dur;
            }

            if (typeof updateDistanceDurationUI === 'function') {
                updateDistanceDurationUI(dist, dur);
            } else {
                const formattedDist = typeof formatTripDistance === 'function' ? formatTripDistance(dist) : (dist || '');
                const formattedDur = typeof formatTripDuration === 'function' ? formatTripDuration(dur) : (dur || '');
                const dText = formattedDist || '--';
                const tText = formattedDur || '--';

                $('#leftTripDistance').text(dText);
                $('#leftTripDuration').text(tText);
                $('#mcsDistanceValue').text(dText);
                $('#mcsDurationValue').text(tText);
                $('#mapRouteDistance').text(dText);
                $('#mapRouteDuration').text(tText);

                if (formattedDist || formattedDur) {
                    $('#tripRouteMetaContainer').attr('style', 'display: flex !important;');
                } else {
                    $('#tripRouteMetaContainer').attr('style', 'display: none !important;');
                }
            }
        }

        function swapLocations() {
            const state = BookingStore.getState();
            if (!state.pickup && !state.dropoff) return; // Nothing to swap

            BookingStore.setState({
                pickup: state.dropoff || '',
                pickupType: state.dropoffType || '',
                pickupSelected: !!state.dropoffSelected,
                dropoff: state.pickup || '',
                dropoffType: state.pickupType || '',
                dropoffSelected: !!state.pickupSelected,
                vehicle: null
            });

            if (typeof updateTimePanel === 'function') updateTimePanel();
            if (typeof updatePickupUI === 'function') updatePickupUI();
            if (typeof updateBookingSummary === 'function') updateBookingSummary();
        }

        // ===== INITIALIZE =====
        $(document).ready(function () {
            showCookieConsentIfNeeded();

            // ---- Restore persisted booking state ----
            BookingStore.restore();
            const _restoredState = BookingStore.getState();

            // Check if returning from Stripe Redirect Payment (e.g. PayPal, Revolut Pay, Klarna, 3DS)
            const urlParams = new URLSearchParams(window.location.search);
            const redirectStatus = urlParams.get('redirect_status');
            const paymentIntentId = urlParams.get('payment_intent');

            if (paymentIntentId && redirectStatus) {
                if (typeof handleStripeRedirectReturn === 'function') {
                    handleStripeRedirectReturn(paymentIntentId, redirectStatus);
                    return;
                }
            }

            // If there are saved locations, restore them into the form inputs
            if (_restoredState.pickup) { $('#pickupInput').val(_restoredState.pickup); }
            if (_restoredState.dropoff) { $('#dropoffInput').val(_restoredState.dropoff); }
            if (_restoredState.date) { /* flatpickr will be set after init below */ }
            if (_restoredState.flightNumber) { $('#flightNumber').val(_restoredState.flightNumber); }
            if (_restoredState.comingFrom) { $('#comingFrom').val(_restoredState.comingFrom); }
            if (_restoredState.dropoffAddress) { $('#dropoffAddress').val(_restoredState.dropoffAddress); }
            if (_restoredState.pickAfterTime) { $('#pickupAfterLandingSelect').val(_restoredState.pickAfterTime); }
            if (_restoredState.ferryName) { $('#ferryName').val(_restoredState.ferryName); }
            if (_restoredState.dockingTime) { $('#seaportArrivalTime').val(_restoredState.dockingTime); }
            if (_restoredState.comingFromPort) { $('#comingFromPort').val(_restoredState.comingFromPort); }
            if (_restoredState.dropoffAddressSeaport) { $('#dropoffAddressSeaport').val(_restoredState.dropoffAddressSeaport); }
            if (_restoredState.normalJourneyDate) { $('#normalJourneyDate').val(_restoredState.normalJourneyDate); }
            if (_restoredState.normalJourneyTime) { $('#normalJourneyTime').val(_restoredState.normalJourneyTime); }

            if (_restoredState.passengerFirstName) { $('#passengerFirstName').val(_restoredState.passengerFirstName); }
            if (_restoredState.passengerLastName) { $('#passengerLastName').val(_restoredState.passengerLastName); }
            if (_restoredState.passengerEmail) { $('#passengerEmail').val(_restoredState.passengerEmail); }
            if (_restoredState.passengerPhone) { $('#passengerPhone').val(_restoredState.passengerPhone); }
            if (_restoredState.passengerCount) { $('#passengerCount').val(_restoredState.passengerCount); }
            if (_restoredState.luggageCount) { $('#luggageCount').val(_restoredState.luggageCount); }
            if (_restoredState.handLuggageCount) { $('#handLuggageCount').val(_restoredState.handLuggageCount); }

            if (_restoredState.rideFor === 'other' && _restoredState.otherPassengerData) {
                $('#otherPassengerName').val(_restoredState.otherPassengerData.name || '');
                $('#otherPassengerPhone').val(_restoredState.otherPassengerData.phone || '');
                $('#forMeTitle, #mobileRiderTitle, #mobileHeaderRiderTitle').text('Booked for ' + _restoredState.otherPassengerData.name);
                if (_restoredState.otherPassengerData.phone) {
                    $('#forMeDetails').text(_restoredState.otherPassengerData.phone).show();
                } else {
                    $('#forMeDetails').hide().text('');
                }
                $('#forMeRadioMe').attr('class', 'far fa-circle for-me-radio').css('color', '#999');
                $('#forMeRadioOther').attr('class', 'fas fa-dot-circle for-me-radio').css('color', '#000');
            }

            if (_restoredState.specialRequirements) { $('#specialRequirements').val(_restoredState.specialRequirements); }
            if (_restoredState.isSpecialReq) {
                $('#specialReqCheckbox').prop('checked', true);
                $('#specialRequirements').show();
            }

            // ---- Register view-updater subscribers ----
            // These fire automatically on every BookingStore.setState() call
            BookingStore.subscribe(_updateLocationUI);
            BookingStore.subscribe(_updateDateTimeUI);
            BookingStore.subscribe(_updateVehicleSummaryUI);
            BookingStore.subscribe(_updatePassengerSummaryUI);
            BookingStore.subscribe(_updateJourneySummaryUI);
            BookingStore.subscribe(_updateDistanceDurationUI);
            BookingStore.subscribe(function () {
                if (typeof updateStep3ContinueButtonState === 'function') updateStep3ContinueButtonState();
            });

            const _nowUKInit = getUKDate();
            const _todayInitStr = `${_nowUKInit.getFullYear()}-${String(_nowUKInit.getMonth() + 1).padStart(2, '0')}-${String(_nowUKInit.getDate()).padStart(2, '0')}`;
            const _validRestoredDate = (_restoredState.date && _restoredState.date >= _todayInitStr) ? _restoredState.date : _todayInitStr;

            flatpickr("#date", {
                dateFormat: "Y-m-d",
                minDate: getUKDate(),
                defaultDate: _validRestoredDate,
                disableMobile: true,
                onReady(selectedDates, dateStr, instance) {
                    let dStr = dateStr;
                    if (!dStr && selectedDates.length > 0) {
                        dStr = instance.formatDate(selectedDates[0], "Y-m-d");
                    }
                    if (!dStr || dStr < _todayInitStr) {
                        dStr = _todayInitStr;
                    }
                    BookingStore.setState({ date: dStr, bookingType: 'schedule' });
                    generateTimeOptions(dStr);
                },
                onChange(selectedDates, dateStr) {
                    BookingStore.setState({ date: dateStr, bookingType: 'schedule' });
                    generateTimeOptions(dateStr);
                }
            });
            if (typeof adjustBookingFormGrids === 'function') adjustBookingFormGrids();
            $('.fleet-carousel').owlCarousel({
                loop: true,
                margin: 20,
                items: 3,
                nav: false,
                dots: true,
                autoplay: true,
                autoplayTimeout: 2500,
                autoplayHoverPause: true,
                smartSpeed: 800,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 4
                    }
                }
            });
            $(".review-carousel").owlCarousel({
                items: 1,
                loop: true,
                margin: 20,
                autoplay: true,
                autoplayTimeout: 5000,
                smartSpeed: 800,
                responsive: {
                    0: {
                        items: 1
                    }
                }
            });

            // Run initial UI sync from restored state (e.g. after page refresh)
            if (_restoredState.pickup && _restoredState.pickupType) {
                BookingStore.setState({ pickupSelected: true });
            }
            if (_restoredState.dropoff && _restoredState.dropoffType) {
                BookingStore.setState({ dropoffSelected: true });
            }
            _updateLocationUI(_restoredState);
            _updateDateTimeUI(_restoredState);
            if (typeof updateTimePanel === 'function') {
                updateTimePanel();
            }
            _updateVehicleSummaryUI(_restoredState);
            _updateDistanceDurationUI(_restoredState);

            // Invalidate location selections if user manually types/edits inputs
            $('#pickupInput').on('input keyup change', function () {
                const currentVal = $(this).val();
                const state = BookingStore.getState();
                if (currentVal !== state.pickup || !state.pickupSelected) {
                    BookingStore.setState({ pickup: currentVal, pickupSelected: false, pickupType: '', vehicle: null });
                }
            });

            $('#dropoffInput').on('input keyup change', function () {
                const currentVal = $(this).val();
                const state = BookingStore.getState();
                if (currentVal !== state.dropoff || !state.dropoffSelected) {
                    BookingStore.setState({ dropoff: currentVal, dropoffSelected: false, dropoffType: '', vehicle: null });
                }
            });

            // Realtime formatters for Personal Info fields
            $(document).on('input', '#passengerFirstName, #authNameInput, #otherPassengerName', function () {
                formatFullName(this);
            }).on('blur', '#passengerFirstName, #authNameInput, #otherPassengerName', function () {
                this.value = this.value.trim();
            });

            $(document).on('input', '#passengerPhone, #authContactInput, #otherPassengerPhone', function () {
                formatContactNumber(this);
            });

            $(document).on('input', '#passengerEmail, #authEmailInput', function () {
                formatEmailAddress(this);
            });

            // Re-render vehicles if we have cached fares
            if (_restoredState.fareDataObj) {
                // apiPolyline is skipped in persistence due to size, restore it from fareDataObj
                if (!bookingData.apiPolyline && Object.keys(_restoredState.fareDataObj).length > 0) {
                    const firstFare = Object.values(_restoredState.fareDataObj)[0];
                    if (firstFare && firstFare.polyline) {
                        BookingStore.setState({ apiPolyline: firstFare.polyline });
                    }
                }

                renderVehicles(_restoredState.fareDataObj);

                // Re-select previously chosen vehicle visually
                if (_restoredState.vehicle) {
                    const selectedName = _restoredState.vehicle.name;
                    $('#vehicleGrid .vehicle-item').each(function () {
                        // The .v-name text might contain the info button, so get only the first text node
                        const vName = $(this).find('.v-name').contents().filter(function () {
                            return this.nodeType === Node.TEXT_NODE;
                        }).text().trim();

                        if (vName === selectedName) {
                            $(this).addClass('selected');
                        }
                    });
                }
            } else if (_restoredState.currentStep >= 3) {
                // If we are on step 3+ but have no fare data, refetch it
                proceedToVehicles();
            }

            // Restore the user's current step (if they refreshed the page)
            if (_restoredState.currentStep && _restoredState.currentStep > 1) {
                if (_restoredState.currentStep === 8) {
                    BookingStore.clear();
                    showStep(1);
                } else if (_restoredState.currentStep === 5) {
                    showStep(5);
                    if (typeof renderPaymentBreakdownUI === 'function') {
                        renderPaymentBreakdownUI(_restoredState.paymentBreakdown);
                    }
                    if (typeof selectPaymentMethod === 'function') {
                        selectPaymentMethod('stripe');
                    }
                    $('#stripePaymentContainer').show();
                    if (typeof initStripePaymentElement === 'function') {
                        initStripePaymentElement();
                    }
                } else if (_restoredState.currentStep === 6 || _restoredState.currentStep === 7) {
                    showStep(6);
                    if (typeof updatePassengerForm === 'function') {
                        updatePassengerForm();
                    }
                    if (_restoredState.bookingId || _restoredState.job_no) {
                        if (typeof startDynamicDriverSearch === 'function') {
                            startDynamicDriverSearch(_restoredState.firebaseConfig, _restoredState.firebaseCustomToken);
                        }
                    } else {
                        // If there's no bookingId, they shouldn't be here, fallback to passenger details
                        showStep(4);
                    }
                } else {
                    showStep(_restoredState.currentStep);

                    if (typeof updatePassengerForm === 'function') {
                        updatePassengerForm();
                    }
                }
            }
        });
        // ===== DROPDOWN FUNCTIONS =====
        function toggleDropdown(type) {
            $(`#${type}-dropdown`).toggleClass('show');
        }
        function showCookieConsentIfNeeded() {
            const cookieAccepted = localStorage.getItem('gorideAcceptCookie');
            if (!cookieAccepted) {
                document.getElementById('cookiecontent').style.display = 'block';
            } else {
                document.getElementById('cookiecontent').style.display = 'none';
            }
        }
        // Handle accept button click
        function acceptCookieConsent() {
            // Store acceptance in localStorage
            localStorage.setItem('gorideAcceptCookie', 'Accepted');
            localStorage.setItem('gorideAcceptCookieTime', new Date().toISOString());
            // Hide banner
            document.getElementById('cookiecontent').style.display = 'none';
            console.log('✓ Cookie consent accepted');
        }
        // Optional: Function to reset cookie consent (useful for testing)
        function resetCookieConsent() {
            localStorage.removeItem('gorideAcceptCookie');
            localStorage.removeItem('gorideAcceptCookieTime');
            document.getElementById('cookiecontent').style.display = 'block';
        }
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.navbar-menu').length && !$(e.target).closest('.dropdown-menu-navbar').length) {
                $('.dropdown-menu-navbar').removeClass('show');
            }
            // if (!$(e.target).closest('.user-btn').length && !$(e.target).closest('.account-dropdown').length) {
            //     $('.account-dropdown').removeClass('show');
            // }
            if (!$(e.target).closest('.time-dropdown-wrapper').length) {
                $('#timeDropdownList').removeClass('show');
                $('#timeDropdownBtn').removeClass('active');
                $('#flightTimeDropdownList').removeClass('show');
                $('#flightTimeDropdownBtn').removeClass('active');
                $('#seaportTimeDropdownList').removeClass('show');
                $('#seaportTimeDropdownBtn').removeClass('active');
            }
            if (!$(e.target).closest('.location-input-field').length && !$(e.target).closest('.location-suggestions').length) {
                $('.location-suggestions').removeClass('show');
            }
        });
        function selectLanguage(lang) {
            toggleDropdown('language');
        }
        // ===== CUSTOM TIME DROPDOWN & NIGHT CHARGE LOGIC =====
        function isNightChargeTime(timeStr) {
            if (!timeStr) return false;
            const match = timeStr.trim().match(/^(\d{1,2}):(\d{2})\s*(AM|PM)$/i);
            if (!match) return false;

            let hour = parseInt(match[1], 10);
            const minute = parseInt(match[2], 10);
            const ampm = match[3].toUpperCase();

            if (ampm === 'PM' && hour < 12) hour += 12;
            if (ampm === 'AM' && hour === 12) hour = 0;

            // Night charges apply from 11:00 PM (23:00) to 5:00 AM (05:00) inclusive
            return (hour === 23 || (hour >= 0 && hour < 5) || (hour === 5 && minute === 0));
        }

        function checkNightChargeNotice(timeStr) {
            const noticeCard = document.getElementById('nightChargeNoticeCard');
            if (!noticeCard) return;

            if (isNightChargeTime(timeStr)) {
                $(noticeCard).slideDown(200);
            } else {
                $(noticeCard).slideUp(200);
            }
        }

        // ===== DATE NORMALIZATION HELPER =====
        function normalizeDateToYYYYMMDD(dStr) {
            if (!dStr || typeof dStr !== 'string') return '';
            dStr = dStr.trim();
            if (/^\d{4}-\d{2}-\d{2}$/.test(dStr)) return dStr;
            const matchYMD = dStr.match(/^(\d{4})-(\d{1,2})-(\d{1,2})$/);
            if (matchYMD) {
                return `${matchYMD[1]}-${matchYMD[2].padStart(2, '0')}-${matchYMD[3].padStart(2, '0')}`;
            }
            const matchDMY = dStr.match(/^(\d{1,2})[-/](\d{1,2})[-/](\d{4})$/);
            if (matchDMY) {
                return `${matchDMY[3]}-${matchDMY[2].padStart(2, '0')}-${matchDMY[1].padStart(2, '0')}`;
            }
            const cleaned = dStr.replace(/(\d+)(st|nd|rd|th)/i, '$1');
            const parsed = new Date(cleaned);
            if (!isNaN(parsed.getTime())) {
                const yr = parsed.getFullYear();
                const mo = String(parsed.getMonth() + 1).padStart(2, '0');
                const da = String(parsed.getDate()).padStart(2, '0');
                return `${yr}-${mo}-${da}`;
            }
            return dStr;
        }

        // ===== VALIDATE AND AUTO-SET IF PAST TIME =====
        function checkAndAutoSetIfPastTime() {
            const state = (typeof BookingStore !== 'undefined' && BookingStore.getState) ? BookingStore.getState() : {};

            // CRITICAL FIX: If a booking has already been created/submitted (currentStep >= 5 or job_no / bookingId / jobId exists),
            // NEVER mutate the booking date and time! The booking is locked in with its original requested pickup time.
            if (state.currentStep >= 5 || state.job_no || state.bookingId || state.jobId || state.isBookingExpired) {
                return false;
            }

            const nowUK = getUKDate();
            const yr = nowUK.getFullYear();
            const mo = String(nowUK.getMonth() + 1).padStart(2, '0');
            const da = String(nowUK.getDate()).padStart(2, '0');
            const todayStr = `${yr}-${mo}-${da}`;
            const currentHours = nowUK.getHours();
            const currentMinutes = nowUK.getMinutes();
            let rawDate = state.date || (typeof bookingData !== 'undefined' ? bookingData.date : null) || $('#date').val();
            let selectedDate = normalizeDateToYYYYMMDD(rawDate);
            let selectedTime = state.time || (typeof bookingData !== 'undefined' ? bookingData.time : null);

            let isPast = false;

            // 1. If date is missing or earlier than today
            if (!selectedDate || selectedDate < todayStr) {
                isPast = true;
            } else if (selectedDate === todayStr) {
                // 2. If date is today, check if time is missing or in the past
                if (!selectedTime) {
                    isPast = true;
                } else {
                    let parsedHours = null;
                    let parsedMinutes = null;

                    const timeParts12 = selectedTime.trim().match(/^(\d{1,2}):(\d{2})\s*(AM|PM)?$/i);
                    if (timeParts12) {
                        let h = parseInt(timeParts12[1], 10);
                        const m = parseInt(timeParts12[2], 10);
                        const ampm = timeParts12[3] ? timeParts12[3].toUpperCase() : null;
                        if (ampm === 'PM' && h < 12) h += 12;
                        if (ampm === 'AM' && h === 12) h = 0;
                        parsedHours = h;
                        parsedMinutes = m;
                    } else {
                        const timeParts24 = selectedTime.trim().match(/^(\d{1,2}):(\d{2})(?::(\d{2}))?$/);
                        if (timeParts24) {
                            parsedHours = parseInt(timeParts24[1], 10);
                            parsedMinutes = parseInt(timeParts24[2], 10);
                        }
                    }

                    if (parsedHours === null || parsedMinutes === null) {
                        isPast = true;
                    } else if (parsedHours < currentHours || (parsedHours === currentHours && parsedMinutes <= currentMinutes)) {
                        isPast = true;
                    }
                }
            }

            if (isPast) {
                let targetDate = (!selectedDate || selectedDate < todayStr) ? todayStr : selectedDate;

                // Collect all valid future 30-min slots for targetDate
                const futureSlots = [];
                for (let hour = 0; hour < 24; hour++) {
                    for (let minute = 0; minute < 60; minute += 30) {
                        if (targetDate === todayStr) {
                            if (hour < currentHours || (hour === currentHours && minute <= currentMinutes)) {
                                continue;
                            }
                        }
                        const ampm = hour >= 12 ? 'PM' : 'AM';
                        const displayHour = hour % 12 === 0 ? 12 : hour % 12;
                        const displayMinute = minute === 0 ? '00' : '30';
                        futureSlots.push(`${String(displayHour).padStart(2, '0')}:${displayMinute} ${ampm}`);
                    }
                }

                let autoSelectedSlot = null;
                if (targetDate === todayStr) {
                    if (futureSlots.length < 2) {
                        // If second slot is not available for current day, advance to next day
                        const tomorrow = getUKDate();
                        tomorrow.setDate(tomorrow.getDate() + 1);
                        const tYr = tomorrow.getFullYear();
                        const tMo = String(tomorrow.getMonth() + 1).padStart(2, '0');
                        const tDa = String(tomorrow.getDate()).padStart(2, '0');
                        targetDate = `${tYr}-${tMo}-${tDa}`;
                        // For tomorrow, select the second slot (12:30 AM)
                        autoSelectedSlot = '12:30 AM';
                    } else {
                        // Select the second slot for today
                        autoSelectedSlot = futureSlots[1];
                    }
                } else {
                    // For future dates, select the second slot
                    autoSelectedSlot = futureSlots.length >= 2 ? futureSlots[1] : (futureSlots[0] || '12:30 AM');
                }

                // Sync flatpickr input if present
                const dateInput = document.getElementById('date');
                if (dateInput && dateInput._flatpickr) {
                    dateInput._flatpickr.setDate(targetDate, false);
                } else if (dateInput) {
                    dateInput.value = targetDate;
                }

                // Update state in BookingStore and bookingData
                if (typeof BookingStore !== 'undefined') {
                    BookingStore.setState({
                        date: targetDate,
                        time: autoSelectedSlot,
                        bookingType: 'schedule'
                    });
                }
                if (typeof bookingData !== 'undefined') {
                    bookingData.date = targetDate;
                    bookingData.time = autoSelectedSlot;
                }

                // Re-generate time options dropdown for targetDate
                if (typeof generateTimeOptions === 'function') {
                    generateTimeOptions(targetDate);
                }

                // Update all related UI fields
                $('#normalJourneyDate').val(targetDate);
                $('#normalJourneyTime').val(autoSelectedSlot);
                $('#timeDropdownValue').text(autoSelectedSlot);

                if (typeof checkNightChargeNotice === 'function') {
                    checkNightChargeNotice(autoSelectedSlot);
                }
                if (typeof _updateDateTimeUI === 'function' && typeof BookingStore !== 'undefined') {
                    _updateDateTimeUI(BookingStore.getState());
                }
                if (typeof updatePickupUI === 'function') {
                    updatePickupUI();
                }
                if (typeof updateBookingSummary === 'function') {
                    updateBookingSummary();
                }

                return true;
            }

            return false;
        }

        function generateTimeOptions(dateStr) {
            const state = (typeof BookingStore !== 'undefined' && BookingStore.getState) ? BookingStore.getState() : {};
            if (state.currentStep >= 5 || state.job_no || state.bookingId || state.jobId || state.isBookingExpired) {
                return;
            }
            const timeDropdownList = document.getElementById('timeDropdownList');
            if (!timeDropdownList) return;
            timeDropdownList.innerHTML = '';

            const now = getUKDate();
            const yr = now.getFullYear();
            const mo = String(now.getMonth() + 1).padStart(2, '0');
            const da = String(now.getDate()).padStart(2, '0');
            const todayStr = `${yr}-${mo}-${da}`;

            let selectedDate = getUKDate();
            if (dateStr && typeof dateStr === 'string') {
                if (dateStr < todayStr) {
                    dateStr = todayStr;
                    const dateInput = document.getElementById('date');
                    if (dateInput && dateInput._flatpickr) {
                        dateInput._flatpickr.setDate(todayStr, false);
                    } else if (dateInput) {
                        dateInput.value = todayStr;
                    }
                    if (typeof BookingStore !== 'undefined') {
                        BookingStore.setState({ date: todayStr, bookingType: 'schedule' });
                    }
                }
                const parts = dateStr.split('-');
                if (parts.length === 3) {
                    selectedDate = new Date(parts[0], parts[1] - 1, parts[2]);
                }
            }
            const isToday = selectedDate.toDateString() === now.toDateString();

            const currentSelectedTime = (typeof BookingStore !== 'undefined' && BookingStore.getState) ? BookingStore.getState().time : '';
            let foundCurrentTime = false;
            const availableSlots = [];

            // Generate times every 30 minutes from 00:00 to 23:30
            for (let hour = 0; hour < 24; hour++) {
                for (let minute = 0; minute < 60; minute += 30) {
                    // Skip past time slots for TODAY
                    if (isToday) {
                        if (hour < now.getHours() || (hour === now.getHours() && minute <= now.getMinutes())) {
                            continue;
                        }
                    }

                    const ampm = hour >= 12 ? 'PM' : 'AM';
                    const displayHour = hour % 12 === 0 ? 12 : hour % 12;
                    const displayMinute = minute === 0 ? '00' : '30';

                    const timeValue = `${String(displayHour).padStart(2, '0')}:${displayMinute} ${ampm}`;
                    const timeValueNoZero = `${displayHour}:${displayMinute} ${ampm}`;
                    const timeDisplay = `${displayHour}:${displayMinute} ${ampm}`;

                    const isCurrentSelected = currentSelectedTime && (
                        currentSelectedTime === timeValue ||
                        currentSelectedTime === timeValueNoZero ||
                        currentSelectedTime.replace(/^0/, '') === timeValueNoZero
                    );

                    availableSlots.push({
                        timeValue: timeValue,
                        timeDisplay: timeDisplay,
                        hour: hour,
                        minute: minute,
                        isCurrentSelected: isCurrentSelected
                    });

                    if (isCurrentSelected) {
                        foundCurrentTime = true;
                    }
                }
            }

            // If second slot is not available for current day (e.g. fewer than 2 slots remaining today), jump to next day
            if (isToday && availableSlots.length < 2) {
                const tomorrow = getUKDate();
                tomorrow.setDate(tomorrow.getDate() + 1);
                const tYr = tomorrow.getFullYear();
                const tMo = String(tomorrow.getMonth() + 1).padStart(2, '0');
                const tDa = String(tomorrow.getDate()).padStart(2, '0');
                const tomorrowStr = `${tYr}-${tMo}-${tDa}`;

                const dateInput = document.getElementById('date');
                if (dateInput && dateInput._flatpickr) {
                    dateInput._flatpickr.setDate(tomorrowStr, false);
                } else if (dateInput) {
                    dateInput.value = tomorrowStr;
                }
                if (typeof BookingStore !== 'undefined') {
                    BookingStore.setState({ date: tomorrowStr, bookingType: 'schedule' });
                }
                generateTimeOptions(tomorrowStr);
                return;
            }

            // Build all dropdown items so the user can still manually select the 1st slot or any other slot
            availableSlots.forEach(slot => {
                const isNightSlot = (slot.hour === 23 || (slot.hour >= 0 && slot.hour < 5) || (slot.hour === 5 && slot.minute === 0));

                const item = document.createElement('div');
                item.className = 'time-dropdown-item' + (slot.isCurrentSelected ? ' selected' : '');
                item.setAttribute('data-time', slot.timeValue);
                item.onclick = function () { selectTime(slot.timeValue); };

                if (isNightSlot) {
                    item.innerHTML = `<span>${slot.timeDisplay}</span><span class="night-moon-icon"><i class="fas fa-moon"></i></span>`;
                } else {
                    item.textContent = slot.timeDisplay;
                }
                timeDropdownList.appendChild(item);
            });

            if (foundCurrentTime && currentSelectedTime && currentSelectedTime.trim() !== '') {
                // Keep existing user-selected valid future time
                selectTime(currentSelectedTime);
            } else if (availableSlots.length >= 2) {
                // Default auto-select to the SECOND slot (index 1)
                selectTime(availableSlots[1].timeValue);
            } else if (availableSlots.length === 1) {
                selectTime(availableSlots[0].timeValue);
            } else {
                const item = document.createElement('div');
                item.className = 'time-dropdown-item';
                item.textContent = 'No times available';
                timeDropdownList.appendChild(item);
            }
        }

        function toggleTimeDropdown() {
            checkAndAutoSetIfPastTime();
            const currentDate = (typeof BookingStore !== 'undefined' && BookingStore.getState) ? BookingStore.getState().date : null;
            if (typeof generateTimeOptions === 'function' && currentDate) {
                generateTimeOptions(currentDate);
            }
            $('#flightTimeDropdownList').removeClass('show');
            $('#flightTimeDropdownBtn').removeClass('active');
            $('#seaportTimeDropdownList').removeClass('show');
            $('#seaportTimeDropdownBtn').removeClass('active');
            $('#timeDropdownList').toggleClass('show');
            $('#timeDropdownBtn').toggleClass('active');

            if ($('#timeDropdownList').hasClass('show') && window.innerWidth <= 768) {
                var panel = document.getElementById('timeSelectionPanel');
                if (panel) {
                    panel.scrollTop = 0;
                }
                var el = document.getElementById('mainTimeDropdownWrapper') || document.getElementById('timeDropdownBtn');
                if (el) {
                    setTimeout(function () {
                        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }, 50);
                }
            }
        }

        function selectTime(time) {
            // Unblock expired state and store new time
            if (typeof BookingStore !== 'undefined' && BookingStore.setState) {
                BookingStore.setState({ time: time, isBookingExpired: false });
            }
            $('#bookingExpiredCard').hide();
            $('#timeDropdownValue').text(time);
            $('#timeDropdownList').removeClass('show');
            $('#timeDropdownBtn').removeClass('active');
            $('#timeDropdownList .time-dropdown-item').each(function () {
                $(this).removeClass('selected');
                const itemDataTime = $(this).attr('data-time');
                const itemText = $(this).text().trim().replace(/[\s🌙]+$/, '');
                if (itemDataTime === time || itemText === time || itemText.replace(/^0/, '') === time.replace(/^0/, '')) {
                    $(this).addClass('selected');
                }
            });
            checkNightChargeNotice(time);
        }
        let selectedFlightHour = '11';
        let selectedFlightMinute = '00';

        function toggleFlightTimeDropdown() {
            $('#timeDropdownList').removeClass('show');
            $('#timeDropdownBtn').removeClass('active');
            $('#seaportTimeDropdownList').removeClass('show');
            $('#seaportTimeDropdownBtn').removeClass('active');
            $('#flightTimeDropdownList').toggleClass('show');
            $('#flightTimeDropdownBtn').toggleClass('active');

            if ($('#flightTimeDropdownList').hasClass('show') && window.innerWidth <= 768) {
                var panel = document.getElementById('timeSelectionPanel');
                if (panel) panel.scrollTop = 0;
                var el = document.getElementById('flightTimeDropdownBtn');
                if (el) {
                    setTimeout(function () {
                        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }, 50);
                }
            }
        }

        function selectFlightHour(hour) {
            selectedFlightHour = hour;
            $('#flightTimeDropdownList .hour-item').removeClass('selected');
            $('#flightTimeDropdownList .hour-item[data-val="' + hour + '"]').addClass('selected');
            updateFlightTimeValue();
        }

        function selectFlightMinute(minute) {
            selectedFlightMinute = minute;
            $('#flightTimeDropdownList .minute-item').removeClass('selected');
            $('#flightTimeDropdownList .minute-item[data-val="' + minute + '"]').addClass('selected');
            updateFlightTimeValue();

            // Close dropdown on minute selection
            $('#flightTimeDropdownList').removeClass('show');
            $('#flightTimeDropdownBtn').removeClass('active');
        }

        function updateFlightTimeValue() {
            const time = selectedFlightHour + ':' + selectedFlightMinute;
            BookingStore.setState({ flightArrivingTime: time });
            $('#flightTimeDropdownValue').html('<i class="fas fa-clock me-1"></i>' + time);
            $('#flightArrivingTime').val(time).trigger('change');
        }

        function selectFlightTime(time) {
            // Store time in the store (triggers subscribers)
            BookingStore.setState({ flightArrivingTime: time });
            $('#flightTimeDropdownValue').html('<i class="fas fa-clock me-1"></i>' + time);
            $('#flightArrivingTime').val(time).trigger('change');

            const parts = time.split(':');
            if (parts.length === 2) {
                selectedFlightHour = parts[0];
                selectedFlightMinute = parts[1];
                $('#flightTimeDropdownList .hour-item').removeClass('selected');
                $('#flightTimeDropdownList .hour-item[data-val="' + parts[0] + '"]').addClass('selected');
                $('#flightTimeDropdownList .minute-item').removeClass('selected');
                $('#flightTimeDropdownList .minute-item[data-val="' + parts[1] + '"]').addClass('selected');
            }

            $('#flightTimeDropdownList').removeClass('show');
            $('#flightTimeDropdownBtn').removeClass('active');
        }

        let selectedSeaportHour = '11';
        let selectedSeaportMinute = '00';

        function toggleSeaportTimeDropdown() {
            $('#timeDropdownList').removeClass('show');
            $('#timeDropdownBtn').removeClass('active');
            $('#flightTimeDropdownList').removeClass('show');
            $('#flightTimeDropdownBtn').removeClass('active');
            $('#seaportTimeDropdownList').toggleClass('show');
            $('#seaportTimeDropdownBtn').toggleClass('active');

            if ($('#seaportTimeDropdownList').hasClass('show') && window.innerWidth <= 768) {
                var panel = document.getElementById('timeSelectionPanel');
                if (panel) panel.scrollTop = 0;
                var el = document.getElementById('seaportTimeDropdownBtn');
                if (el) {
                    setTimeout(function () {
                        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }, 50);
                }
            }
        }

        function selectSeaportHour(hour) {
            selectedSeaportHour = hour;
            $('#seaportTimeDropdownList .seaport-hour-item').removeClass('selected');
            $('#seaportTimeDropdownList .seaport-hour-item[data-val="' + hour + '"]').addClass('selected');
            updateSeaportArrivalTime();
            $('#seaportTimeDropdownValue').html('<i class="fas fa-clock me-1"></i>' + selectedSeaportHour + ':' + selectedSeaportMinute);
        }

        function selectSeaportMinute(minute) {
            selectedSeaportMinute = minute;
            $('#seaportTimeDropdownList .seaport-minute-item').removeClass('selected');
            $('#seaportTimeDropdownList .seaport-minute-item[data-val="' + minute + '"]').addClass('selected');
            updateSeaportArrivalTime();
            $('#seaportTimeDropdownValue').html('<i class="fas fa-clock me-1"></i>' + selectedSeaportHour + ':' + selectedSeaportMinute);

            // Close dropdown on minute selection
            $('#seaportTimeDropdownList').removeClass('show');
            $('#seaportTimeDropdownBtn').removeClass('active');
        }

        function updateSeaportArrivalTime() {
            const dateVal = $('#seaportArrivalDate').val() || BookingStore.getState().date || '';
            if (dateVal) {
                const timeVal = selectedSeaportHour + ':' + selectedSeaportMinute;
                const combined = dateVal + ' ' + timeVal;
                $('#seaportArrivalTime').val(combined).trigger('change');
            }
        }
        function toggleMobileMenu() {
            $("#mobileMenu").toggleClass("show");
            $("#mobileOverlay").toggleClass("show");
            $("body").toggleClass("menu-open");
        }
        function toggleMobileMap() {
            $('.hero-form-section').hide();
            $('.hero-map-section').css('display', 'block').attr('style', function (i, s) {
                return (s || '') + ';display:block !important;';
            });
            $('#bookingMap').addClass('mobile-fullscreen').show();
            $('#mapCloseBtn').addClass('visible');
            if (typeof initSingleRouteMap === 'function') {
                initSingleRouteMap();
            }
        }
        function closeMobileMap() {
            $('.hero-map-section').attr('style', function (i, s) {
                return (s || '') + ';display:none !important;';
            });
            $('#bookingMap').removeClass('mobile-fullscreen').hide();
            $('#mapRouteBadge').hide();
            $('#mapCloseBtn').removeClass('visible');
            $('.hero-form-section').css({
                display: 'flex',
                width: '100%'
            });
        }
        function selectPickup(location, type) {
            const currentDropoff = BookingStore.getState().dropoff ? BookingStore.getState().dropoff.trim().toLowerCase() : '';
            if (location && currentDropoff && location.trim().toLowerCase() === currentDropoff) {
                showToast("Pickup and dropoff locations cannot be the same.", 'error');
                return;
            }
            const normalizedType = normalizeLocationType(type);
            // Batch update (fires subscribers once)
            BookingStore.setState({ pickup: location, pickupType: normalizedType, pickupSelected: true, vehicle: null });
            $('#pickupInput').val(location);
            $('#pickupSuggestions').removeClass('show');
            updateTimePanel();
            updatePickupUI();
            updateBookingSummary();
        }
        function selectDropoff(location, type) {
            const currentPickup = BookingStore.getState().pickup ? BookingStore.getState().pickup.trim().toLowerCase() : '';
            if (location && currentPickup && location.trim().toLowerCase() === currentPickup) {
                showToast("Pickup and dropoff locations cannot be the same.", 'error');
                return;
            }
            const normalizedType = normalizeLocationType(type);
            // Batch update (fires subscribers once)
            BookingStore.setState({ dropoff: location, dropoffType: normalizedType, dropoffSelected: true, vehicle: null });
            $('#dropoffInput').val(location);
            $('#dropoffSuggestions').removeClass('show');
            updateTimePanel();
            updateBookingSummary();
        }
        function selectReturnPickup(location, type) {
            BookingStore.setState({ returnPickup: location, returnPickupType: type });
            $('#returnPickupInput').val(location);
            $('#returnPickupSuggestions').removeClass('show');
        }
        function selectReturnDropoff(location, type) {
            BookingStore.setState({ returnDropoff: location, returnDropoffType: type });
            $('#returnDropoffInput').val(location);
            $('#returnDropoffSuggestions').removeClass('show');
        }
        function showReturnPickupSuggestions() {
            const html = ukLocations.map(loc => `
        <div class="suggestion-item" onclick="selectReturnPickup('${loc.name}', '${loc.type}')">
            <i class="fas fa-${loc.icon}"></i>
            <div>
                <div style="font-weight: 600;">${loc.name}</div>
            </div>
        </div>
    `).join('');
            $('#returnPickupSuggestions').html(html).addClass('show');
        }
        function showReturnDropoffSuggestions() {
            const html = ukLocations.map(loc => `
        <div class="suggestion-item" onclick="selectReturnDropoff('${loc.name}', '${loc.type}')">
            <i class="fas fa-${loc.icon}"></i>
            <div>
                <div style="font-weight: 600;">${loc.name}</div>
            </div>
        </div>
    `).join('');
            $('#returnDropoffSuggestions').html(html).addClass('show');
        }
        function toggleLandingTimeDropdown() {
            $('#landingTimeDropdownList').toggleClass('show');
            $('#landingTimeBtn').toggleClass('active');
        }
        function selectLandingTime(time) {
            $('#landingTimeValue').text(time);
            $('#landingTimeDropdownList').removeClass('show');
            $('#landingTimeBtn').removeClass('active');
            bookingData.landingTime = time;
        }
        function getTypeBadge(type) {
            const badges = {
                'airport': '<i class="fas fa-plane-departure"></i> Airport',
                'seaport': '<i class="fas fa-anchor"></i> Terminal',
                'address': '<i class="fas fa-map-marker-alt"></i> Address'
            };
            return badges[type] || '';
        }
        function validateBooking() {
            const errors = [];
            if (!bookingData.pickup) errors.push('Pickup location required');
            if (!bookingData.pickupType) errors.push('Pickup type missing');
            if (!bookingData.dropoff) errors.push('Dropoff location required');
            if (!bookingData.dropoffType) errors.push('Dropoff type missing');
            if (!bookingData.date) errors.push('Date required');
            if (bookingData.pickupType === 'airport' && bookingData.dropoffType === 'airport') {
                if (!bookingData.landingTime) errors.push('Flight landing time required');
                if (!bookingData.pickupAfter) errors.push('Pickup after landing time required');
            } else {
                if (!bookingData.time) errors.push('Pickup time required');
            }
            if (bookingData.returnTrip) {
                if (!bookingData.returnPickup) errors.push('Return pickup required');
                if (!bookingData.returnPickupType) errors.push('Return pickup type missing');
                if (!bookingData.returnDropoff) errors.push('Return dropoff required');
                if (!bookingData.returnDropoffType) errors.push('Return dropoff type missing');
            }
            if (errors.length > 0) {
                showToast(errors.join('\n'), 'error');
                return false;
            }
            return true;
        }
        // ===== VIA POINTS =====
        function addViaPoint() {
            const viaRows = $("#viaPointsContainer .via-point-row");
            if (viaRows.length >= MAX_VIA_POINTS) {
                showToast("Maximum 3 via locations allowed.", 'error');
                return;
            }
            const row = $(`
        <div class="via-point-row">
            <input type="text" placeholder="Enter via location">
            <button type="button" class="remove-via" onclick="removeViaPoint(this)">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `);
            $("#viaPointsContainer").append(row);
            if ($("#viaPointsContainer .via-point-row").length >= MAX_VIA_POINTS) {
                $("#addViaBtn").hide();
            }
        }
        function showViaSuggestions(id) {
            const html = ukLocations.map(loc =>
                `<div class="suggestion-item" onclick="selectViaPoint(${id}, '${loc.name}')">
                    <i class="fas fa-${loc.icon}"></i> ${loc.name}
                </div>`
            ).join('');
            $(`#viaSuggestions${id}`).html(html).addClass('show');
        }
        function selectViaPoint(id, location) {
            $('.via-input').eq(id - 1).val(location);
            $(`#viaSuggestions${id}`).removeClass('show');
        }
        function removeViaPoint(btn) {
            $(btn).closest(".via-point-row").remove();
            if ($(".via-point-row").length < MAX_VIA_POINTS) {
                $("#addViaBtn").css('display', 'inline-flex');
            }
        }
        // ===== AUTH HELPERS =====
        function getCookieValue(name) {
            const match = document.cookie.match(new RegExp('(?:^|;\\s*)' + name.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + '=([^;]*)'));
            return match ? decodeURIComponent(match[1]) : null;
        }
        function isAuthenticated() {
            return !!getCookieValue('auth_token');
        }
        function openAuthModal() {
            if (typeof _resetGoogleBtn === 'function') {
                _resetGoogleBtn();
            }
            const modal = document.getElementById('authLoginModal');
            if (modal) modal.classList.add('show');
        }
        function closeAuthModal() {
            const modal = document.getElementById('authLoginModal');
            if (modal) modal.classList.remove('show');
            if (typeof _resetGoogleBtn === 'function') {
                _resetGoogleBtn();
            }
        }
        // Store pending action so we can resume after login
        let _pendingAfterAuth = null;

        // ===== FORM NAVIGATION =====
        function proceedToTripDetails() {
            const pickupVal = $('#pickupInput').val() ? $('#pickupInput').val().trim() : '';
            const dropoffVal = $('#dropoffInput').val() ? $('#dropoffInput').val().trim() : '';
            const state = BookingStore.getState();

            const isPickupValid = pickupVal && state.pickupSelected && state.pickupType && (pickupVal === state.pickup);
            const isDropoffValid = dropoffVal && state.dropoffSelected && state.dropoffType && (dropoffVal === state.dropoff);

            if (!isPickupValid || !isDropoffValid) {
                $("#timeSelectionPanel").removeClass("show");
                $('section').each(function () {
                    if (!$(this).hasClass('hero-container')) {
                        $(this).removeClass('sections-hidden');
                    }
                });
                $('footer').removeClass('sections-hidden');
                showStep(1);
                if (!isPickupValid) {
                    showToast("Please select a valid pickup location from the suggestions.", 'error');
                    $('#pickupInput').focus();
                } else if (!isDropoffValid) {
                    showToast("Please select a valid dropoff location from the suggestions.", 'error');
                    $('#dropoffInput').focus();
                }
                return;
            }

            if (pickupVal.toLowerCase() === dropoffVal.toLowerCase()) {
                $("#timeSelectionPanel").removeClass("show");
                $('section').each(function () {
                    if (!$(this).hasClass('hero-container')) {
                        $(this).removeClass('sections-hidden');
                    }
                });
                $('footer').removeClass('sections-hidden');
                showStep(1);
                showToast("Pickup and dropoff locations cannot be the same.", 'error');
                $('#dropoffInput').focus();
                return;
            }
            _doTripDetails();
        }
        function _doTripDetails() {
            checkAndAutoSetIfPastTime();
            const pickup = $('#pickupInput').val();
            const dropoff = $('#dropoffInput').val();
            // Batch update pickup + dropoff in one store call (fires subscribers once)
            BookingStore.setState({ pickup, dropoff });
            // The subscriber _updateLocationUI handles all DOM updates,
            // but we also keep these direct updates for non-subscriber elements:
            $('#timePanelLocation').text(pickup);
            const currentBookingState = BookingStore.getState();
            let selDate = currentBookingState.date ? formatUIOrdinalDate(currentBookingState.date) : ($('#date').val() || 'Today');
            let selTime = currentBookingState.time || 'Now';
            $('#mcsDateValue').text(selDate);
            $('#mcsTimeValue').text(selTime);
            $('section').each(function () {
                if (!$(this).hasClass('hero-container')) {
                    $(this).addClass('sections-hidden');
                }
            });
            $('footer').addClass('sections-hidden');
            if (window.innerWidth > 768) {
                // Do nothing, bookingImage stays visible
            } else {
                $('#bookingImage').hide();
                $('#bookingMap').hide();
                $('#mobileHamburger').hide();
                $('#mobileMapBtn').css('display', 'flex');
            }
            proceedToVehicles();
        }

        // ===== FETCH FARES FROM API =====
        async function fetchFaresFromAPI() {
            // Check if selected time is in the past, and auto-set if needed before calling API
            checkAndAutoSetIfPastTime();

            const token = getCookieValue('auth_token');

            // Build pickup datetime string (Y-m-d H:i:s)
            let pickupDate = bookingData.date;
            let pickupTime = bookingData.time;

            // Fallback to today + now if not set
            if (!pickupDate) {
                const now = getUKDate();
                const yr = now.getFullYear();
                const mo = String(now.getMonth() + 1).padStart(2, '0');
                const da = String(now.getDate()).padStart(2, '0');
                pickupDate = `${yr}-${mo}-${da}`;
            }
            if (!pickupTime) {
                // Use current time
                const now = getUKDate();
                pickupTime = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0') + ':00';
            } else {
                // Convert "07:00 AM" → "07:00:00"
                const timeParts = pickupTime.match(/(\d+):(\d+)\s*(AM|PM)/i);
                if (timeParts) {
                    let hours = parseInt(timeParts[1]);
                    const mins = timeParts[2];
                    const meridiem = timeParts[3].toUpperCase();
                    if (meridiem === 'PM' && hours !== 12) hours += 12;
                    if (meridiem === 'AM' && hours === 12) hours = 0;
                    pickupTime = hours.toString().padStart(2, '0') + ':' + mins + ':00';
                } else {
                    const timeParts24 = pickupTime.match(/^(\d{1,2}):(\d{2})(?::(\d{2}))?$/);
                    if (timeParts24) {
                        pickupTime = timeParts24[1].padStart(2, '0') + ':' + timeParts24[2] + ':00';
                    } else {
                        pickupTime = pickupTime + ':00';
                    }
                }
            }

            const pickupDatetime = pickupDate + ' ' + pickupTime;

            const params = new URLSearchParams({
                from_place: bookingData.pickup,
                to_place: bookingData.dropoff,
                pickup_date: pickupDatetime,
                way_type: bookingData.returnTrip ? 'roundtrip' : 'oneway',
            });

            const headers = {
                'Accept': 'application/json'
            };
            if (token) {
                headers['Authorization'] = 'Bearer ' + token;
            }

            try {
                const response = await fetch(API_BASE_URL + '/w-get-fares?' + params.toString(), {
                    method: 'GET',
                    headers: headers
                });

                if (!response.ok) {
                    console.error('Fares API error:', response.status, response.statusText);
                    return null;
                }

                const result = await response.json();
                return result;
            } catch (err) {
                console.error('Fares API fetch failed:', err);
                return null;
            }
        }
        function updateTimePanel() {
            const {
                pickupType,
                dropoffType
            } = bookingData;
            $('#timePanelLocation').text(bookingData.pickup || '\u2014');
            $('#dateLabelContainer').show();
            $('#timeLabelContainer').show();
            if (pickupType === 'airport') {
                $('#timePanelTitle').text('Flight Landing Date & Time');
                $('#dateLabel').html('<i class="fas fa-calendar"></i> Flight Landing Date *');
                $('#timeLabel').html('<i class="fas fa-plane-departure"></i> Flight Landing Time *');
                $('#airportLandingFields').show();
                $('#seaportDockingFields').hide();
            } else if (pickupType === 'seaport') {
                $('#timePanelTitle').text('Cruise/Ferry Docking Details');
                $('#dateLabel').html('<i class="fas fa-anchor"></i> Cruise/Ferry Docking Date *');
                $('#timeLabel').html('<i class="fas fa-clock"></i> Cruise/Ferry Docking Time *');
                $('#airportLandingFields').hide();
                $('#seaportDockingFields').show();
            } else {
                $('#timePanelTitle').text('When do you want to be picked up?');
                $('#dateLabel').html('<i class="fas fa-calendar"></i> Journey Date *');
                $('#timeLabel').html('<i class="fas fa-clock"></i> Journey Time *');
                $('#airportLandingFields').hide();
                $('#seaportDockingFields').hide();
            }
        }
        function goBackToLocations() {
            if (window._routeMapTimer) {
                clearTimeout(window._routeMapTimer);
                window._routeMapTimer = null;
            }
            BookingStore.setState({ vehicle: null });
            if (typeof bookingData !== 'undefined') {
                bookingData.vehicle = null;
            }
            $('#bookingMap').hide();
            $('#mapRouteBadge').hide();
            $('#bookingImage').show();
            $('#vehicleGrid').removeClass('single-col');
            $('section').each(function () {
                if (!$(this).hasClass('hero-container')) {
                    $(this).removeClass('sections-hidden');
                }
            });
            $('footer').removeClass('sections-hidden');
            showStep(1);
        }
        function hidePickupTimePanel() {
            $("#timeSelectionPanel").removeClass("show");
            // Show background sections again
            $('section').not('.hero-container').removeClass('sections-hidden');
            $('footer').removeClass('sections-hidden');
            // Re-enable body scroll
            $('body').css('overflow', 'auto');
        }
        window.hidePickupTimePanel = hidePickupTimePanel;

        function showSchedulePanel() {
            bookingType = "schedule";
            checkAndAutoSetIfPastTime();
            const currentDate = (typeof BookingStore !== 'undefined' && BookingStore.getState) ? BookingStore.getState().date : null;
            if (typeof generateTimeOptions === 'function' && currentDate) {
                generateTimeOptions(currentDate);
            }
            $("#timeSelectionPanel").addClass("show");
        }
        window.showSchedulePanel = showSchedulePanel;

        function showSchedulePanelFromStep1() {
            bookingType = "schedule";
            checkAndAutoSetIfPastTime();
            const currentDate = (typeof BookingStore !== 'undefined' && BookingStore.getState) ? BookingStore.getState().date : null;
            if (typeof generateTimeOptions === 'function' && currentDate) {
                generateTimeOptions(currentDate);
            }
            // Hide all background sections
            $('section').not('.hero-container').addClass('sections-hidden');
            $('footer').addClass('sections-hidden');
            // Show the panel with fixed positioning
            $("#timeSelectionPanel").addClass("show");
            // Prevent body scroll
            $('body').css('overflow', 'hidden');
            updatePickupUI();
        }
        window.showSchedulePanelFromStep1 = showSchedulePanelFromStep1;
        // Call this whenever pickup location changes
        function updatePickupUI() {
            const pickupType = bookingData.pickupType; // airport, seaport, or address
            const state = BookingStore.getState();

            if (state.date && state.time) {
                const uiDate = formatUIOrdinalDate(state.date);
                if (pickupType === 'airport') {
                    $('#pickupNowBtn').html(`<i class="fas fa-plane-departure"></i> ${uiDate} &nbsp; <i class="fas fa-clock"></i> ${state.time} <i class="fas fa-chevron-down ms-2"></i>`);
                } else if (pickupType === 'seaport') {
                    $('#pickupNowBtn').html(`<i class="fas fa-anchor"></i> ${uiDate} &nbsp; <i class="fas fa-clock"></i> ${state.time} <i class="fas fa-chevron-down ms-2"></i>`);
                } else {
                    $('#pickupNowBtn').html(`<i class="fas fa-calendar"></i> ${uiDate} &nbsp; <i class="fas fa-clock"></i> ${state.time} <i class="fas fa-chevron-down ms-2"></i>`);
                }
            } else {
                if (pickupType === 'airport') {
                    $('#pickupNowBtn').html(`
                <i class="fas fa-plane-departure"></i>
                Flight Landing Details
                <i class="fas fa-chevron-down ms-2"></i>
            `);
                } else if (pickupType === 'seaport') {
                    $('#pickupNowBtn').html(`
                <i class="fas fa-anchor"></i>
                Cruise Details
                <i class="fas fa-chevron-down ms-2"></i>
            `);
                } else {
                    $('#pickupNowBtn').html(`
                <i class="fas fa-clock"></i>
                Pickup Now
                <i class="fas fa-chevron-down ms-2"></i>
            `);
                }
            }
        }
        function updateSchedule() {
            const date = $("#date").val();
            if (!date || !selectedTime) return;
            bookingData.date = date;
            bookingData.time = selectedTime;
            updateBookingSummary();
            const uiDate = formatUIOrdinalDate(date);
            $("#selectedDateTime").show().html(
                `<i class="fas fa-calendar"></i> ${uiDate} &nbsp;&nbsp; <i class="fas fa-clock"></i> ${selectedTime}`
            );
        }
        function saveSchedule() {
            const wasAutoUpdated = checkAndAutoSetIfPastTime();
            const date = BookingStore.getState().date;
            $("#date").val(date);
            const currentTime = BookingStore.getState().time;
            if (!date) {
                showToast('Please select a date', 'error');
                return;
            }
            if (!currentTime) {
                showToast('Please select a time', 'error');
                return;
            }
            if (wasAutoUpdated) {
                showToast('Pickup time was updated to ' + currentTime + ' as the previous time had passed.', 'info');
            }
            // Batch update date + time + bookingType in one store call
            BookingStore.setState({ date, time: currentTime, bookingType: 'schedule' });
            updateTripDateTimeCard();
            updateBookingSummary();
            $("#normalJourneyDate").val(date);
            $("#normalJourneyTime").val(currentTime);
            if ($("#pickupNowBtn").length) {
                const uiDate = formatUIOrdinalDate(date);
                $("#pickupNowBtn").html(`<i class="fas fa-calendar"></i> ${uiDate} &nbsp; <i class="fas fa-clock"></i> ${currentTime} <i class="fas fa-chevron-down ms-2"></i>`);
            }
            $("#timeSelectionPanel").removeClass("show");
            $('section').each(function () {
                if (!$(this).hasClass('hero-container')) {
                    $(this).removeClass('sections-hidden');
                }
            });
            $('footer').removeClass('sections-hidden');
            if (window.innerWidth > 768) {
                $('#bookingImage').show();
            }
            // Open the car selection
            proceedToTripDetails();
        }
        window.saveSchedule = saveSchedule;
        function showForMeModal() {
            $('#forMeModal').addClass('show');
        }
        function closeForMeModal() {
            $('#forMeModal').removeClass('show');
        }
        function selectForMe(type) {
            if (type === 'Me') {
                $('#forMeRadioMe').attr('class', 'fas fa-dot-circle for-me-radio').css('color', '#000');
                $('#forMeRadioOther').attr('class', 'far fa-circle for-me-radio').css('color', '#999');
                $('#forMeTitle, #mobileRiderTitle, #mobileHeaderRiderTitle').text('For me');
                $('#forMeDetails').hide().text('');
                // Batch update rideFor + clear other passenger
                BookingStore.setState({ rideFor: 'me', otherPassengerData: null });
                closeForMeModal();
            } else {
                $('#forMeRadioMe').attr('class', 'far fa-circle for-me-radio').css('color', '#999');
                $('#forMeRadioOther').attr('class', 'fas fa-dot-circle for-me-radio').css('color', '#000');
                BookingStore.setState({ rideFor: 'other' });
                $('#otherPassengerName').val('');
                $('#otherPassengerPhone').val('');
                $('#forMeModal').removeClass('show');
                $('#bookForOtherModal').addClass('show');
            }
        }
        async function proceedToVehicles() {
            BookingStore.setState({ vehicle: null });
            if (typeof bookingData !== 'undefined') {
                bookingData.vehicle = null;
            }
            showStep(3);
            if (window.innerWidth > 768) {
                $('#vehicleGrid').addClass('single-col');
            }
            // Show loading skeleton while fetching fares
            const grid = $('#vehicleGrid');
            grid.html(`
                <div class="fare-loading-state" style="padding: 30px 20px; text-align: center;">
                    <div style="display: inline-flex; align-items: center; gap: 12px; background: #f8f9fa; padding: 16px 24px; border-radius: 14px; border: 1px solid #e5e7eb;">
                        <i class="fas fa-spinner fa-spin" style="font-size: 20px; color: #f59e0b;"></i>
                        <span style="font-size: 15px; font-weight: 600; color: #333;">Fetching best prices for you…</span>
                    </div>
                    <div style="margin-top: 20px; display: flex; flex-direction: column; gap: 14px;">
                        ${[1, 2, 3].map(() => `
                        <div class="vehicle-item" style="pointer-events:none; opacity: 0.5;">
                            <div class="vehicle-left"><div style="width:100px;height:70px;background:#eee;border-radius:8px;"></div></div>
                            <div class="vehicle-right">
                                <div class="v-header">
                                    <div class="v-name" style="background:#eee;height:18px;width:100px;border-radius:4px;"></div>
                                    <div class="v-price" style="background:#eee;height:18px;width:60px;border-radius:4px;"></div>
                                </div>
                                <div class="v-sub"><div style="background:#eee;height:14px;width:80%;border-radius:4px;margin-top:8px;"></div></div>
                            </div>
                        </div>`).join('')}
                    </div>
                </div>
            `);

            // Fetch from API
            const faresResult = await fetchFaresFromAPI();

            if (faresResult && faresResult.status === false && faresResult.message) {
                showToast(faresResult.message, 'error');
            }

            // data comes back as an object keyed by vehicle type (e.g. { standard:{...}, mpv:{...} })
            const fareDataObj = faresResult && faresResult.status === true && faresResult.data &&
                typeof faresResult.data === 'object' && !Array.isArray(faresResult.data)
                ? faresResult.data : null;

            if (fareDataObj && Object.keys(fareDataObj).length > 0) {
                // Extract and update extra charges whenever carlist API is called
                const extraChargeData = extractExtraCharges(faresResult, fareDataObj);
                bookingData.extra_charge = extraChargeData;
                BookingStore.setState({ extraCharge: extraChargeData });

                // Store trip meta + polyline from first vehicle fare
                const firstFare = Object.values(fareDataObj)[0];
                bookingData.apiDistance = firstFare.distance || null;
                bookingData.apiDuration = firstFare.duration || null;
                bookingData.apiPolyline = firstFare.polyline || null;
                bookingData.apiDistanceMiles = firstFare.distance ? (typeof formatTripDistance === 'function' ? formatTripDistance(firstFare.distance) : firstFare.distance) : null;
                bookingData.fareDataObj = fareDataObj;  // keep full object for map markers
                bookingData.nearby_drivers = faresResult.nearby_drivers || [];

                BookingStore.setState({
                    apiDistance: firstFare.distance || null,
                    apiDuration: firstFare.duration || null,
                    apiDistanceMiles: bookingData.apiDistanceMiles,
                    fareDataObj: fareDataObj,
                    nearby_drivers: faresResult.nearby_drivers || []
                });

                if (typeof updateDistanceDurationUI === 'function') {
                    updateDistanceDurationUI(firstFare.distance, firstFare.duration);
                }
                renderVehicles(fareDataObj);
                // Draw route on map from the fare polyline
                if (typeof initRouteMapFromFare === 'function') {
                    if (window._routeMapTimer) clearTimeout(window._routeMapTimer);
                    window._routeMapTimer = setTimeout(function () {
                        const stepNow = (typeof BookingStore !== 'undefined' && BookingStore.getState) ? (BookingStore.getState().currentStep || 1) : 1;
                        if (stepNow >= 3) {
                            initRouteMapFromFare();
                        }
                    }, 300);
                }
            } else {
                // No fares — show unavailable message
                BookingStore.setState({
                    fareDataObj: null,
                    selectedVehicle: null,
                    apiDistance: null,
                    apiDuration: null,
                    apiPolyline: null
                });
                console.warn('Fares API returned no data.', faresResult);
                $('#vehicleGrid').html(`
                    <div style="padding: 40px 20px; text-align: center;">
                        <div style="display: inline-flex; flex-direction: column; align-items: center; gap: 14px; background: #fff8f8; border: 1.5px solid #fcd5d5; border-radius: 16px; padding: 30px 36px; max-width: 400px;">
                            <i class="fas fa-map-marker-slash" style="font-size: 36px; color: #e53e3e;"></i>
                            <h4 style="font-size: 18px; font-weight: 800; color: #1a1a1a; margin: 0;">No Cabs Available</h4>
                            <p style="font-size: 14px; color: #666; margin: 0; line-height: 1.6;">Cab service is not available in this selected area. Please try a different pickup or drop-off location.</p>
                            <button onclick="goBack(1)" style="margin-top: 4px; padding: 10px 24px; background: #111; color: #fff; border: none; border-radius: 10px; font-size: 14px; font-weight: 700; cursor: pointer;">
                                <i class="fas fa-arrow-left"></i> Change Location
                            </button>
                        </div>
                    </div>
                `);
            }
        }

        function getInclusionIcon(text) {
            const t = (text || '').toLowerCase();
            if (t.includes('zone') || t.includes('surge') || t.includes('area')) return 'fa-map-marked-alt';
            if (t.includes('park')) return 'fa-parking';
            if (t.includes('congestion') || t.includes('toll') || t.includes('road')) return 'fa-road';
            if (t.includes('night')) return 'fa-moon';
            if (t.includes('special') || t.includes('day') || t.includes('holiday') || t.includes('event')) return 'fa-calendar-day';
            if (t.includes('wait') || t.includes('delay') || t.includes('time')) return 'fa-clock';
            if (t.includes('child') || t.includes('baby') || t.includes('seat')) return 'fa-baby-carriage';
            if (t.includes('meet') || t.includes('greet')) return 'fa-user-check';
            if (t.includes('fuel') || t.includes('gas') || t.includes('petrol')) return 'fa-gas-pump';
            if (t.includes('flight') || t.includes('airport')) return 'fa-plane-arrival';
            if (t.includes('wifi') || t.includes('wi-fi') || t.includes('internet')) return 'fa-wifi';
            if (t.includes('air') || t.includes('ac') || t.includes('climate')) return 'fa-snowflake';
            if (t.includes('charge') || t.includes('tax') || t.includes('vat') || t.includes('fee')) return 'fa-file-invoice-dollar';
            return 'fa-check-circle';
        }

        function renderVehicles(fareData) {
            const grid = $('#vehicleGrid');
            grid.html('');

            // fareData is a plain object keyed by vehicle type: { standard:{...}, mpv:{...}, ... }
            // Normalise keys to lower-case for matching
            const fareMap = {};
            if (fareData && typeof fareData === 'object' && !Array.isArray(fareData)) {
                Object.entries(fareData).forEach(([key, fare]) => {
                    fareMap[key.toLowerCase().trim()] = fare;
                });
            }

            Object.entries(fareMap).forEach(([vKey, fare]) => {
                // Strictly use API from_range / to_range — no static fallback
                if (!fare || (fare.from_range == null && fare.to_range == null)) {
                    return; // skip vehicles with no API price
                }
                // If fare doesn't have a name, default to capitalizing the key
                const vehicleName = fare.name || (vKey.charAt(0).toUpperCase() + vKey.slice(1));
                const vehicleImage = `${GORIDE_IMG_PREFIX}${vKey}.webp`;

                // Try to find if we have static data for amenities/inclusions
                const staticV = vehicles.find(v => v.name.toLowerCase().trim() === vKey) || {};

                const displayPrice = parseFloat(fare.from_range || 0);
                const displayPriceMax = parseFloat(fare.to_range || 0);

                const dynamicPassenger = fare.passenger ? parseInt(fare.passenger) : (staticV.capacity ? parseInt(staticV.capacity) : 4);
                const dynamicLuggage = fare.luggage ? parseInt(fare.luggage) : (staticV.luggage ? parseInt(staticV.luggage) : 2);
                const dynamicChild = fare.child ? parseInt(fare.child) : 0;
                const dynamicHandLuggage = fare.hand_luggage ? parseInt(fare.hand_luggage) : (staticV.handLuggage || dynamicPassenger);

                // Build vehicle object with real API prices
                const vData = Object.assign({}, staticV, {
                    id: fare.id || staticV.id || vKey,
                    key: vKey,
                    name: vehicleName,
                    image: vehicleImage,
                    price: parseFloat(displayPrice),
                    priceMax: parseFloat(displayPriceMax),
                    capacity: dynamicPassenger,
                    luggage: dynamicLuggage,
                    child: dynamicChild,
                    handLuggage: dynamicHandLuggage,
                    fareBreakdown: fare
                });

                const amenitiesHtml = (staticV.amenities || ["WiFi", "Air Con", "Child Seat"])
                    .filter(a => {
                        if (a.toLowerCase().includes('seat')) {
                            return dynamicChild > 0;
                        }
                        return true;
                    })
                    .map(a => {
                        let icon = 'fa-check';
                        if (a.toLowerCase().includes('wifi')) icon = 'fa-wifi text-danger';
                        if (a.toLowerCase().includes('air')) icon = 'fa-snowflake text-primary';
                        if (a.toLowerCase().includes('seat')) icon = 'fa-baby-carriage text-success';
                        return `<span class="v-amenity-pill"><i class="fas ${icon}"></i> <span class="d-none d-md-inline">${a}</span></span>`;
                    }).join('');

                let tag = fare.tag || staticV.tag;
                let tagClass = 'popular';
                if (tag && tag.toLowerCase().includes('cheapest')) tagClass = 'cheapest';
                if (tag && tag.toLowerCase().includes('families')) tagClass = 'families';

                const tagHtml = tag ? `
    <div class="v-tag">
        <span class="v-tag-pill ${tagClass}">${tag}</span>
    </div>
` : '';

                // Price display
                const priceHtml = displayPriceMax
                    ? `£${displayPrice} – £${displayPriceMax}`
                    : `£${displayPrice}`;

                // Distance/duration badge if available
                const tripInfoHtml = '';

                const rawInclusions = fare.included_list || fare.inclusions || fare.included || [];
                const inclusionsList = Array.isArray(rawInclusions)
                    ? rawInclusions
                    : (typeof rawInclusions === 'string' ? (() => { try { return JSON.parse(rawInclusions); } catch (e) { return [rawInclusions]; } })() : []);

                const inclusionsHtml = (inclusionsList && inclusionsList.length > 0) ?
                    inclusionsList.map((inc) => {
                        const text = typeof inc === 'object' && inc !== null ? (inc.name || inc.text || inc.title || inc.value || JSON.stringify(inc)) : String(inc || '');
                        const icon = (typeof inc === 'object' && inc !== null && inc.icon) ? inc.icon : getInclusionIcon(text);
                        return `<li class="tab-point-item"><i class="fas ${icon} point-icon point-icon-check"></i><div>${text}</div></li>`;
                    }).join('') :
                    `<li class="tab-point-item" style="grid-column: 1 / -1; color: #6b7280;"><i class="fas fa-info-circle point-icon" style="color: #6b7280;"></i><div>No additional inclusions are included in this fare.</div></li>`;

                const rawExclusions = fare.excluded_list || fare.exclusions || fare.excluded || [];
                const exclusionsList = Array.isArray(rawExclusions)
                    ? rawExclusions
                    : (typeof rawExclusions === 'string' ? (() => { try { return JSON.parse(rawExclusions); } catch (e) { return [rawExclusions]; } })() : []);

                const exclusionsHtml = (exclusionsList && exclusionsList.length > 0) ?
                    exclusionsList.map((exc) => {
                        const text = typeof exc === 'object' && exc !== null ? (exc.name || exc.text || exc.title || exc.value || JSON.stringify(exc)) : String(exc || '');
                        return `<li class="tab-point-item"><i class="fas fa-times point-icon point-icon-cross"></i><div>${text}</div></li>`;
                    }).join('') :
                    `<li class="tab-point-item" style="grid-column: 1 / -1; color: #6b7280;"><i class="fas fa-info-circle point-icon" style="color: #6b7280;"></i><div>No extra exclusions specified for this fare.</div></li>`;

                const stateVehicle = typeof BookingStore !== 'undefined' ? BookingStore.getState().vehicle : null;
                const isSelected = stateVehicle && (stateVehicle.id === vData.id || stateVehicle.key === vData.key);
                const selectedClass = isSelected ? 'selected' : '';
                const btnHtml = isSelected ? '<i class="fas fa-check"></i> Selected' : 'Select';

                const html = `
<div class="vehicle-item ${selectedClass}" id="vehicle-item-${vData.id}" onclick="selectVehicle(this, ${JSON.stringify(vData).replace(/"/g, '&quot;')})">
    <div class="vehicle-left">
        <img src="${vData.image}" alt="${vData.name}">
    </div>
    <div class="vehicle-right">
       <div class="v-header">
    <div class="v-name">
        ${vData.name}
        <button
            type="button"
            class="vehicle-info-btn"
            onclick="event.stopPropagation(); openVehicleInfo(${JSON.stringify(vData).replace(/"/g, '&quot;')})"
            title="Vehicle Details">
            <i class="fas fa-info-circle"></i>
        </button>
    </div>
    <div class="v-price" style="display: flex; flex-direction: column; align-items: flex-end;">

        <div>${priceHtml}${tripInfoHtml}</div>
        <div class="v-price-onwards">Onwards</div>
    </div>
</div>
        <div class="v-sub">
           <div class="v-features">
            <span><i class="fas fa-user"></i> ${dynamicPassenger}</span>
            <span><i class="fas fa-suitcase"></i> ${dynamicLuggage}</span>
            <span><i class="fas fa-briefcase"></i> ${dynamicHandLuggage}</span>
            ${dynamicChild > 0 ? `<span><i class="fas fa-baby-carriage"></i> ${dynamicChild}</span>` : ''}
           </div>
              ${tagHtml}
        </div>
        <div class="v-footer">
            <div class="v-amenities">
                ${amenitiesHtml}
            </div>
            <button class="btn-v-select">${btnHtml}</button>
        </div>
    </div>
    <!-- Accordion Section -->
    <div class="vehicle-accordion" onclick="event.stopPropagation();">
        <button type="button" class="accordion-toggle" onclick="toggleVehicleAccordion(this)">
            <span class="acc-text">View Inclusions & Exclusions</span> <i class="fas fa-chevron-down ms-1"></i>
        </button>
        <div class="premium-tab-container">
            <div class="accordion-content">
                <div class="accordion-tabs">
                    <button type="button" class="tab-btn active" onclick="switchVehicleTab(this, 'inclusions')"><i class="fas fa-check-circle tab-icon-check"></i> Inclusions</button>
                    <button type="button" class="tab-btn" onclick="switchVehicleTab(this, 'exclusions')"><i class="fas fa-times-circle tab-icon-cross"></i> Exclusions</button>
                </div>
                <div class="tab-pane inclusions-pane active">
                    <ul class="tab-points-list inclusions-list">
                        ${inclusionsHtml}
                    </ul>
                </div>
                <div class="tab-pane exclusions-pane" style="display:none;">
                    <ul class="tab-points-list exclusions-list">
                        ${exclusionsHtml}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
`;
                grid.append(html);
            });
            updateFeaturesLayout();
            if (typeof updateCabScrollIndicators === 'function') {
                setTimeout(updateCabScrollIndicators, 150);
            }
        }

        function updateFeaturesLayout() {
            if ($(window).width() <= 768) {
                $('.vehicle-item').each(function () {
                    const features = $(this).find('.v-features');
                    if (features.parent().hasClass('v-sub')) {
                        $(this).find('.vehicle-left').append(features);
                    }
                });
            } else {
                $('.vehicle-item').each(function () {
                    const features = $(this).find('.v-features');
                    if (features.parent().hasClass('vehicle-left')) {
                        $(this).find('.v-sub').prepend(features);
                    }
                });
            }
        }
        $(window).on('resize', updateFeaturesLayout);

        function selectVehicle(el, vehicle) {
            const maxPassenger = vehicle ? (parseInt(vehicle.capacity) || 8) : 8;
            const maxLuggage = vehicle ? (parseInt(vehicle.luggage) || 8) : 8;
            const maxHandLuggage = vehicle ? (parseInt(vehicle.handLuggage) || 8) : 8;
            const maxChild = vehicle ? (parseInt(vehicle.child) || 8) : 8;

            let passenger = parseInt($('#passengerCount').val()) || BookingStore.getState().passengerCount || 1;
            let luggage = parseInt($('#luggageCount').val()) || BookingStore.getState().luggageCount || 0;
            let handLuggage = parseInt($('#handLuggageCount').val()) || BookingStore.getState().handLuggageCount || 0;
            let child = parseInt($('#childSeatCount').val()) || BookingStore.getState().childSeatCount || 0;

            if (passenger > maxPassenger) passenger = maxPassenger;
            if (luggage > maxLuggage) luggage = maxLuggage;
            if (handLuggage > maxHandLuggage) handLuggage = maxHandLuggage;
            if (child > maxChild) child = maxChild;

            $('#passengerCount').val(passenger);
            $('#passengerCountDisplay').text(passenger);
            $('#luggageCount').val(luggage);
            $('#luggageCountDisplay').text(luggage);
            $('#handLuggageCount').val(handLuggage);
            $('#handLuggageCountDisplay').text(handLuggage);
            $('#childSeatCount').val(child);
            $('#childSeatCountDisplay').text(child);

            BookingStore.setState({
                passengerCount: passenger,
                luggageCount: luggage,
                handLuggageCount: handLuggage,
                childSeatCount: child
            });

            // Single setState fires _updateVehicleSummaryUI subscriber automatically
            BookingStore.setState({ vehicle });
            $('.vehicle-item').removeClass('selected');
            $('.btn-v-select').html('Select');
            $(el).addClass('selected');
            $(el).find('.btn-v-select').html('<i class="fas fa-check"></i> Selected');
            if (typeof updateStep3ContinueButtonState === 'function') updateStep3ContinueButtonState();
            console.log('Vehicle selected:', vehicle.name, '- Price: £' + vehicle.price);
        }
        function _autoFillPassengerDetailsFromAuth() {
            const userStr = typeof getCookieValue === 'function' ? getCookieValue('auth_user') : null;
            if (!userStr) return;
            try {
                const user = JSON.parse(decodeURIComponent(userStr));
                if (!user) return;

                let nameParts = (user.name || '').trim().split(' ');
                let fname = nameParts[0] || '';
                let lname = nameParts.slice(1).join(' ') || '';
                let email = user.email || '';
                let phone = user.mobile || user.mobile_number || user.phone || '';

                const updates = {};
                if (fname && !$('#passengerFirstName').val()) {
                    $('#passengerFirstName').val(fname);
                    updates.passengerFirstName = fname;
                }
                if (lname && !$('#passengerLastName').val()) {
                    $('#passengerLastName').val(lname);
                    updates.passengerLastName = lname;
                }
                if (email && !$('#passengerEmail').val()) {
                    $('#passengerEmail').val(email);
                    updates.passengerEmail = email;
                }
                if (phone && !$('#passengerPhone').val()) {
                    if (window.passengerPhoneIti) {
                        window.passengerPhoneIti.setNumber(phone);
                    } else {
                        $('#passengerPhone').val(phone);
                    }
                    updates.passengerPhone = phone;
                }

                if (Object.keys(updates).length > 0) {
                    BookingStore.setState(updates);
                }
            } catch (e) {
                console.error('Error autofilling passenger data from auth', e);
            }
        }

        function proceedToPassengerDetails() {
            const vehicle = BookingStore.getState().vehicle;
            if (!vehicle) {
                showToast('Please select a vehicle first', 'error');
                return;
            }

            // ---- AUTH GATE ON CONTINUE BUTTON (AFTER CAR LIST SELECTION) ----
            if (!isAuthenticated()) {
                _pendingAfterAuth = _doProceedToPassengerDetails;
                openAuthModal();
                return;
            }

            _doProceedToPassengerDetails();
        }

        function _doProceedToPassengerDetails() {
            _autoFillPassengerDetailsFromAuth();
            _updateVehicleSummaryUI(BookingStore.getState());
            updatePassengerForm();
            updateBookingSummary();
            showStep(4);
            const vehicle = BookingStore.getState().vehicle;
            if (vehicle) {
                console.log('Proceeding with vehicle:', vehicle.name, 'Price:', vehicle.price);
            }
        }
        function adjustBookingFormGrids() {
            $('.booking-form-grid').each(function () {
                const $grid = $(this);
                const visibleGroups = $grid.children('.booking-form-group').filter(function () {
                    const $el = $(this);
                    if ($el.css('display') === 'none' || $el.hasClass('d-none')) return false;
                    if ($el.find('input[type="checkbox"]').length && !$el.find('input[type="text"], select').length) return false;
                    return true;
                });

                visibleGroups.css('grid-column', 'auto');

                const count = visibleGroups.length;
                if (count === 1) {
                    visibleGroups.eq(0).css('grid-column', '1 / -1');
                } else if (count === 3) {
                    visibleGroups.eq(2).css('grid-column', '1 / -1');
                } else if (count === 5) {
                    visibleGroups.eq(4).css('grid-column', '1 / -1');
                }
            });
        }

        function updatePassengerForm() {
            const state = typeof BookingStore !== 'undefined' ? BookingStore.getState() : {};
            console.log('UpdatePassengerForm state:', state);
            const pickup = state.pickupType || (typeof bookingData !== 'undefined' ? bookingData.pickupType : null);
            const dropoff = state.dropoffType || (typeof bookingData !== 'undefined' ? bookingData.dropoffType : null);

            $('#journeyAirport').hide();
            $('#journeySeaport').hide();
            $('#journeyNormal').hide();

            // Reset dropoff address visibility
            $('#dropoffAddress').closest('.form-group-uber').show();
            $('#dropoffAddressSeaport').closest('.form-group-uber').show();
            $('#dropoffAddressNormal').closest('.form-group-uber').show();

            // Hide dropoff address if dropoff location is airport
            if (dropoff === 'airport') {
                $('#dropoffAddress').closest('.form-group-uber').hide();
                $('#dropoffAddressSeaport').closest('.form-group-uber').hide();
                $('#dropoffAddressNormal').closest('.form-group-uber').hide();
            }

            if (pickup === 'airport') {
                $('#journeyAirport').show();
            } else if (pickup === 'seaport') {
                $('#journeySeaport').show();
                if (document.getElementById('seaportArrivalDate') && !document.getElementById('seaportArrivalDate')._flatpickr) {
                    flatpickr('#seaportArrivalDate', {
                        enableTime: false,
                        dateFormat: 'Y-m-d',
                        minDate: getUKDate(),
                        disableMobile: true,
                        onChange: function () {
                            updateSeaportArrivalTime();
                        }
                    });
                }
            } else {
                $('#journeyNormal').show();
            }

            const vehicle = BookingStore.getState().vehicle;
            if (vehicle && vehicle.child && parseInt(vehicle.child) > 0) {
                $('#carSeatToggleContainer').show();
            } else {
                $('#carSeatToggleContainer').hide();
                $('#carSeatCheckbox').prop('checked', false);
                if (typeof toggleChildSeatOptions === 'function') toggleChildSeatOptions();
            }

            if (typeof adjustBookingFormGrids === 'function') {
                adjustBookingFormGrids();
                setTimeout(adjustBookingFormGrids, 50);
            }
        }
        // Global Toast implementation
        window.showToast = function (msg, type = 'success') {
            const toast = document.getElementById('globalToast');
            if (!toast) {
                alert(msg);
                return;
            }
            const icon = document.getElementById('globalToastIcon');
            const msgEl = document.getElementById('globalToastMsg');
            toast.className = 'global-toast ' + type;
            icon.className = (type === 'success' || type === 'info')
                ? 'fas fa-check-circle'
                : 'fas fa-exclamation-circle';
            msgEl.textContent = msg;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3500);
        };
        // ===== INPUT FORMATTERS & VALIDATORS =====
        function formatFullName(inputEl) {
            if (!inputEl) return;
            let v = inputEl.value;
            v = v.replace(/[^A-Za-z ]/g, '');
            v = v.replace(/^ +/, '');
            v = v.replace(/ {2,}/g, ' ');
            if (v.length > 75) v = v.substring(0, 75);
            inputEl.value = v;
        }

        function formatContactNumber(inputEl) {
            if (!inputEl) return;
            let v = inputEl.value.replace(/\D/g, '');
            if (v.length > 12) v = v.substring(0, 12);
            inputEl.value = v;
        }

        function formatEmailAddress(inputEl) {
            if (!inputEl) return;
            let v = inputEl.value;
            v = v.replace(/\s+/g, '');
            if (v.length > 100) v = v.substring(0, 100);
            inputEl.value = v;
        }

        function validateFullName(name) {
            const trimmed = (name || '').trim();
            if (!trimmed) {
                return { valid: false, message: 'Full Name is mandatory.' };
            }
            if (trimmed.length > 75) {
                return { valid: false, message: 'Full Name cannot exceed 75 characters.' };
            }
            if (!/^[A-Za-z]+( [A-Za-z]+)*$/.test(trimmed)) {
                return { valid: false, message: 'Full Name must contain only alphabets (A-Z, a-z) with single spaces between words.' };
            }
            return { valid: true };
        }

        function validateContactNumber(inputEl, itiInstance) {
            const rawVal = (inputEl ? inputEl.value : '').replace(/\D/g, '');
            if (!rawVal) {
                return { valid: false, message: 'Contact Number is mandatory.' };
            }
            const countryData = itiInstance ? itiInstance.getSelectedCountryData() : null;
            const countryName = countryData && countryData.name ? countryData.name.split(' (')[0] : 'selected country';
            const placeholder = inputEl ? inputEl.getAttribute('placeholder') || '' : '';
            const expectedDigits = placeholder.replace(/\D/g, '').length || 10;

            if (rawVal.length < Math.min(expectedDigits, 7) || rawVal.length > Math.max(expectedDigits, 15) || (itiInstance && itiInstance.isValidNumber && !itiInstance.isValidNumber())) {
                return { valid: false, message: `Please enter a valid mobile number for ${countryName}.` };
            }
            return { valid: true };
        }

        function validateEmailAddress(email) {
            const trimmed = (email || '').trim();
            if (!trimmed) {
                return { valid: false, message: 'Email Address is mandatory.' };
            }
            if (trimmed.length > 100) {
                return { valid: false, message: 'Email Address cannot exceed 100 characters.' };
            }
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(trimmed)) {
                return { valid: false, message: 'Please enter a valid email address (e.g., name@example.com).' };
            }
            return { valid: true };
        }

        function verifyPersonalInfoAndRequestOTP() {
            const firstName = $('#passengerFirstName').val().trim();
            const email = $('#passengerEmail').val().trim();
            const phoneEl = document.getElementById('passengerPhone');

            const nameCheck = validateFullName(firstName);
            if (!nameCheck.valid) {
                showToast(nameCheck.message, 'error');
                $('#passengerFirstName').focus();
                return;
            }

            const phoneCheck = validateContactNumber(phoneEl, window.passengerPhoneIti);
            if (!phoneCheck.valid) {
                showToast(phoneCheck.message, 'error');
                if (phoneEl) phoneEl.focus();
                return;
            }

            const emailCheck = validateEmailAddress(email);
            if (!emailCheck.valid) {
                showToast(emailCheck.message, 'error');
                $('#passengerEmail').focus();
                return;
            }

            bookingData.passengerName = firstName;
            bookingData.passengerEmail = email;
            bookingData.passengerPhone = phoneEl.value.trim();

            // Check if user is logged in but missing mobile number
            const userStr = typeof getCookieValue === 'function' ? getCookieValue('auth_user') : null;
            if (userStr) {
                try {
                    const user = JSON.parse(decodeURIComponent(userStr));
                    const userPhone = user.mobile || user.mobile_number || user.phone || '';
                    if (!userPhone) {
                        // User is logged in but has no mobile. We must verify this new phone number.
                        _startBookingOtpVerification(phoneEl.value.trim(), firstName, email);
                        return; // Stop here until OTP is done
                    }
                } catch (e) { console.error('Error parsing auth_user', e); }
            }

            _proceedFromPersonalInfo();
        }

        function _proceedFromPersonalInfo() {
            $('#passengerPhone').prop('disabled', true); // Make contact number disabled

            $('#personalInfoSection').hide();
            $('#personalInfoBtns').hide();
            $('#additionalBookingDetails').show();
            $('#additionalDetailsBtns').css('display', 'flex');
        }

        async function _startBookingOtpVerification(rawPhone, name, email) {
            let mobileNumber = rawPhone;
            let dialCode = '91';
            if (window.passengerPhoneIti) {
                const countryData = window.passengerPhoneIti.getSelectedCountryData();
                dialCode = countryData && countryData.dialCode ? String(countryData.dialCode) : '91';
                const rawVal = rawPhone.replace(/\D/g, '');
                mobileNumber = '+' + dialCode + rawVal;
            }

            // Find the Step 4 continue button
            const btn = document.querySelector('#personalInfoBtns .btn-search-uber') || document.querySelector('button[onclick="verifyPersonalInfoAndRequestOTP()"]');
            let origHtml = '';
            if (btn) {
                origHtml = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = `<i class="fas fa-spinner fa-spin"></i>&nbsp; Checking...`;
            }

            _currentMobile = mobileNumber;
            _isIndiaFlow = (dialCode === '91' || mobileNumber.startsWith('+91'));
            _indiaOtpEnc = null;

            try {
                // Check if number is valid/used
                const response = await fetch(API_BASE_URL + '/auth/check-user', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ login: 'mobile', value: mobileNumber }),
                });

                const result = await response.json();
                if (result.status === false) {
                    showToast(result.message || 'Failed to verify number.', 'error');
                    if (btn) { btn.disabled = false; btn.innerHTML = origHtml; }
                    return;
                }

                _isNewUser = !result.exists;

                if (_isIndiaFlow) {
                    if (btn) btn.innerHTML = `<i class="fas fa-spinner fa-spin"></i>&nbsp; Sending OTP...`;

                    const sendOtpResponse = await fetch(API_BASE_URL + '/auth/send-otp', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                        body: JSON.stringify({
                            mobile: mobileNumber,
                            dialCode: dialCode
                        }),
                    });

                    const sendOtpResult = await sendOtpResponse.json();

                    if (sendOtpResult.status === 'success' || sendOtpResult.status === true) {
                        _indiaOtpEnc = (sendOtpResult.data && sendOtpResult.data.enc) ? sendOtpResult.data.enc : (sendOtpResult.enc || null);
                    } else {
                        showToast(sendOtpResult.message || 'Failed to send OTP.', 'error');
                        if (btn) { btn.disabled = false; btn.innerHTML = origHtml; }
                        return;
                    }
                } else {
                    if (result.firebase) {
                        if (!firebase.apps || !firebase.apps.length) {
                            firebase.initializeApp(result.firebase);
                        }
                        _firebaseAuthObj = firebase.auth();
                    } else if (firebase.apps && firebase.apps.length) {
                        _firebaseAuthObj = firebase.auth();
                    }

                    if (!_firebaseAuthObj) {
                        throw new Error('Firebase configuration missing.');
                    }
                    _firebaseAuthObj.languageCode = 'en';

                    if (btn) btn.innerHTML = `<i class="fas fa-spinner fa-spin"></i>&nbsp; Sending OTP...`;

                    // Recaptcha
                    if (window.recaptchaVerifier) {
                        try {
                            window.recaptchaVerifier.clear();
                        } catch (e) { }
                        window.recaptchaVerifier = null;
                    }

                    let recapContainer = document.getElementById('booking-recaptcha-container');
                    if (!recapContainer) {
                        recapContainer = document.createElement('div');
                        recapContainer.id = 'booking-recaptcha-container';
                        document.body.appendChild(recapContainer);
                    } else {
                        recapContainer.innerHTML = '';
                    }

                    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('booking-recaptcha-container', {
                        'size': 'invisible'
                    });

                    _confirmationResult = await _firebaseAuthObj.signInWithPhoneNumber(mobileNumber, window.recaptchaVerifier);
                }

                // Setup callback for after OTP is successful
                _pendingAfterAuth = function () {
                    if (document.getElementById('booking-recaptcha-container')) {
                        document.getElementById('booking-recaptcha-container').remove();
                    }
                    _proceedFromPersonalInfo();
                };

                // Show the OTP UI inside the auth modal
                document.getElementById('authLoginModal').classList.add('show');
                document.getElementById('authStep1').style.display = 'none';
                document.getElementById('authOtpSection').style.display = 'block';
                document.getElementById('authOtpTarget').textContent = _currentMobile;
                _startResendTimer(30);

                const changeBtn = document.getElementById('authChangeNumberBtn');
                if (changeBtn) changeBtn.style.display = 'none';

                if (_isNewUser) {
                    document.getElementById('authNewUserFields').style.display = 'block';
                    document.getElementById('authNameInput').value = name;
                    document.getElementById('authEmailInput').value = email;
                } else {
                    document.getElementById('authNewUserFields').style.display = 'none';
                }

            } catch (err) {
                console.error('OTP Error:', err);
                showToast('Failed to send OTP. Please try again.', 'error');
            } finally {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = origHtml;
                }
            }
        }
        function goBackToPersonalInfo() {
            $('#additionalBookingDetails').hide();
            $('#additionalDetailsBtns').hide();
            $('#personalInfoSection').show();
            $('#personalInfoBtns').show();
            $('#personalInfoBtns').css('display', 'flex');
        }
        // ===== STRIPE PAYMENT INTEGRATION =====
        window.selectedStripePaymentType = 'full';

        window.resetStripePayment = function () {
            window.stripeElements = null;
            window.stripeInstance = null;
            window.isPaymentAlreadyTerminal = false;
            $('#payment-element').empty();
            const loadingEl = document.getElementById('stripe-element-loading');
            if (loadingEl) {
                loadingEl.style.display = 'none';
                loadingEl.innerHTML = '';
            }
            const msgEl = document.getElementById('payment-message');
            if (msgEl) {
                msgEl.style.display = 'none';
                msgEl.textContent = '';
            }
            const btn = document.querySelector('#step5 .btn-search-uber') || document.querySelector('#personalInfoBtns .btn-search-uber');
            if (btn) {
                btn.innerHTML = '<i class="fas fa-arrow-right"></i> Proceed to Card Payment';
                btn.disabled = false;
            }
        };

        window.selectPaymentMethod = function (method = 'stripe') {
            $('#paymentMethod').val('stripe').trigger('change');
            $('#payMethodCardStripe').addClass('active');
            $('#stripePaymentTypeWrapper').slideDown(250);
            updateStripeTypeAmounts();

            const btn = document.querySelector('#step5 .btn-search-uber') || document.querySelector('#personalInfoBtns .btn-search-uber');
            if (btn && !window.stripeElements) {
                btn.innerHTML = '<i class="fas fa-arrow-right"></i> Proceed to Card Payment';
            }
        };

        window.selectStripePaymentType = function (type) {
            window.selectedStripePaymentType = type;
            if (type === 'full') {
                $('#stripeTypeFull').addClass('active');
                $('#stripeTypePart').removeClass('active');
            } else {
                $('#stripeTypePart').addClass('active');
                $('#stripeTypeFull').removeClass('active');
            }

            // Reset existing Stripe session and re-initialize with selected type/amount
            window.resetStripePayment();
            if (typeof initStripePaymentElement === 'function') {
                initStripePaymentElement();
            }
        };

        window.updateStripeTypeAmounts = function () {
            const state = typeof BookingStore !== 'undefined' ? BookingStore.getState() : {};
            const totalFare = parseFloat(window.paymentTotalFare || state.total_fare || (state.vehicle ? state.vehicle.price || state.vehicle.fare || 0 : 0));
            const partFare = parseFloat(window.paymentPartPayFare || state.part_pay_fare || (totalFare * 0.20));

            const fullAmtStr = '£' + totalFare.toFixed(2);
            const partAmtStr = '£' + partFare.toFixed(2);

            $('#stripeFullAmount').text(fullAmtStr);
            $('#stripePartAmount').text(partAmtStr);
        };

        window.initStripePaymentElement = async function () {
            const loadingEl = document.getElementById('stripe-element-loading');
            const msgEl = document.getElementById('payment-message');
            if (msgEl) msgEl.style.display = 'none';
            if (loadingEl) {
                loadingEl.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Initializing secure payment session...';
                loadingEl.style.display = 'block';
            }
            $('#stripePaymentContainer').slideDown(250);

            const state = typeof BookingStore !== 'undefined' ? BookingStore.getState() : {};
            const totalFare = parseFloat(window.paymentTotalFare || state.total_fare || (state.vehicle ? state.vehicle.price || state.vehicle.fare || 0 : 0));
            const partFare = parseFloat(window.paymentPartPayFare || state.part_pay_fare || (totalFare * 0.20));

            const payType = window.selectedStripePaymentType || 'full';
            const payAmount = payType === 'part' ? partFare.toFixed(2) : totalFare.toFixed(2);

            const email = document.getElementById('passengerEmail')?.value.trim() || bookingData.passengerEmail || '';
            const name = document.getElementById('passengerFirstName')?.value.trim() || bookingData.passengerFirstName || '';
            const phone = document.getElementById('passengerPhone')?.value.trim() || bookingData.passengerPhone || '';
            const jobId = bookingData.jobId || bookingData.job_id || '';
            const jobNo = bookingData.job_no || bookingData.bookingId || '';
            const currentPaymentId = parseInt(window.paymentId || state.paymentId || state.id || state.payment_id || 0);

            try {
                const response = await fetch(API_BASE_URL + '/stripe/payment-intent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + (typeof getCookieValue === 'function' ? getCookieValue('auth_token') : '')
                    },
                    body: JSON.stringify({
                        id: currentPaymentId,
                        payment_id: currentPaymentId,
                        job_id: jobId,
                        job_no: jobNo,
                        pay_no: jobNo,
                        payment_type: payType,
                        amount: payAmount,
                        currency: 'gbp',
                        email: email,
                        name: name,
                        phone: phone,
                        payment_method_types: ['card']
                    })
                });

                const data = await response.json();

                if (!data.status && !data.client_secret && !data.clientSecret && (!data.data || !data.data.client_secret)) {
                    const errMsg = data.message || (data.errors ? Object.values(data.errors).flat().join(' ') : 'Unable to initialize Stripe payment session.');
                    if (loadingEl) loadingEl.innerHTML = `<span style="color:#ef4444;"><i class="fas fa-exclamation-triangle"></i> ${errMsg}</span>`;
                    showToast('Stripe Error: ' + errMsg, 'error');
                    return false;
                }

                const resolvedPaymentId = parseInt(data.payment_id || data.id || data.data?.payment_id || data.data?.id || 0);
                const resolvedTxnId = data.transaction_id || data.data?.transaction_id || '';

                if (resolvedPaymentId) {
                    window.paymentId = resolvedPaymentId;
                }
                if (resolvedTxnId) {
                    window.transactionId = resolvedTxnId;
                }

                if (typeof BookingStore !== 'undefined') {
                    BookingStore.setState({
                        id: resolvedPaymentId || window.paymentId,
                        payment_id: resolvedPaymentId || window.paymentId,
                        paymentId: resolvedPaymentId || window.paymentId,
                        transaction_id: resolvedTxnId || window.transactionId || '',
                        selectedStripePaymentType: payType
                    });
                }

                const clientSecret = data.client_secret || data.clientSecret || data.data?.client_secret;
                const pubKey = data.publishable_key || data.publishableKey || data.data?.publishable_key || (typeof STRIPE_PUBLISHABLE_KEY !== 'undefined' ? STRIPE_PUBLISHABLE_KEY : '');

                if (typeof Stripe === 'undefined') {
                    if (loadingEl) loadingEl.innerHTML = `<span style="color:#ef4444;"><i class="fas fa-exclamation-triangle"></i> Stripe SDK script missing or failed to load.</span>`;
                    return false;
                }

                window.stripeInstance = Stripe(pubKey);

                // Clear element container before mounting to prevent duplicate element errors
                const elContainer = document.getElementById('payment-element');
                if (elContainer) elContainer.innerHTML = '';

                try {
                    window.stripeElements = window.stripeInstance.elements({
                        clientSecret: clientSecret,
                        appearance: {
                            theme: 'night',
                            variables: {
                                colorPrimary: '#f39c12',
                                colorBackground: '#1e293b',
                                colorText: '#f8fafc',
                                colorDanger: '#ef4444',
                                fontFamily: 'Manrope, Poppins, sans-serif',
                                borderRadius: '8px'
                            }
                        }
                    });

                    const paymentElement = window.stripeElements.create('payment', {
                        layout: 'tabs'
                    });

                    paymentElement.on('ready', function () {
                        if (loadingEl) loadingEl.style.display = 'none';
                        const btn = document.querySelector('#step5 .btn-search-uber') || document.querySelector('#personalInfoBtns .btn-search-uber');
                        if (btn) {
                            btn.innerHTML = `<i class="fas fa-lock"></i> Confirm & Pay £${payAmount}`;
                            btn.disabled = false;
                        }
                    });

                    paymentElement.on('loaderror', function (event) {
                        console.warn('Stripe Element loaderror event:', event);
                        const err = event.error || {};
                        const errMsg = err.message || 'Failed to load payment session.';

                        if (errMsg.toLowerCase().includes('terminal state') || err.status === 400) {
                            if (loadingEl) loadingEl.innerHTML = `<div style="color:#10b981; font-weight:600; padding:12px; background: rgba(16,185,129,0.1); border-radius:8px; border: 1px solid rgba(16,185,129,0.3);"><i class="fas fa-check-circle me-1"></i> Payment session initialized (Sandbox). Click 'Complete Booking' below to finish.</div>`;
                            const btn = document.querySelector('#step5 .btn-search-uber') || document.querySelector('#personalInfoBtns .btn-search-uber');
                            if (btn) {
                                btn.innerHTML = `<i class="fas fa-check"></i> Complete Booking`;
                                btn.disabled = false;
                            }
                            window.isPaymentAlreadyTerminal = true;
                        } else {
                            if (loadingEl) loadingEl.innerHTML = `<div style="color:#ef4444; padding:10px;"><i class="fas fa-exclamation-triangle me-1"></i> ${errMsg}</div>`;
                            const btn = document.querySelector('#step5 .btn-search-uber') || document.querySelector('#personalInfoBtns .btn-search-uber');
                            if (btn) btn.disabled = false;
                        }
                    });

                    paymentElement.on('change', function (event) {
                        if (msgEl) {
                            if (event.error) {
                                msgEl.textContent = event.error.message;
                                msgEl.style.display = 'block';
                            } else {
                                msgEl.style.display = 'none';
                            }
                        }
                    });

                    paymentElement.mount('#payment-element');

                    window.isPaymentAlreadyTerminal = false;
                    return true;

                } catch (elementsErr) {
                    console.warn('Stripe elements mount exception:', elementsErr);
                    // Check if PaymentIntent is in a terminal state (already paid / completed)
                    const errText = elementsErr.message || String(elementsErr);
                    if (errText.toLowerCase().includes('terminal state') || errText.includes('400')) {
                        if (loadingEl) loadingEl.innerHTML = `<div style="color:#10b981; font-weight:600; padding:10px;"><i class="fas fa-check-circle me-1"></i> Payment session active. Click below to complete booking.</div>`;
                        const btn = document.querySelector('#step5 .btn-search-uber') || document.querySelector('#personalInfoBtns .btn-search-uber');
                        if (btn) btn.innerHTML = `<i class="fas fa-check"></i> Complete Booking`;
                        window.isPaymentAlreadyTerminal = true;
                        return true;
                    } else {
                        if (loadingEl) loadingEl.innerHTML = `<span style="color:#ef4444;"><i class="fas fa-exclamation-triangle"></i> ${errText}</span>`;
                        return false;
                    }
                }

            } catch (err) {
                console.error('Error initializing Stripe:', err);
                if (loadingEl) loadingEl.innerHTML = `<span style="color:#ef4444;"><i class="fas fa-exclamation-triangle"></i> Connection error initializing Stripe.</span>`;
                return false;
            }
        };

        function proceedToConfirmation() {
            // Stripe is the default and only active payment method
            bookingData.paymentMethod = 'stripe';
            $('#paymentMethod').val('stripe');

            const state = BookingStore.getState();
            let email = document.getElementById('passengerEmail').value.trim();
            let name = document.getElementById('passengerFirstName').value.trim();
            let phone = document.getElementById('passengerPhone').value.trim();

            // Restore from state if empty due to page reload
            if (!email && state.passengerEmail) {
                email = state.passengerEmail;
                document.getElementById('passengerEmail').value = email;
            }
            if (!name && state.passengerFirstName) {
                name = state.passengerFirstName;
                document.getElementById('passengerFirstName').value = name;
            }
            if (!phone && state.passengerPhone) {
                phone = state.passengerPhone;
                document.getElementById('passengerPhone').value = phone;
            }

            if (!name) {
                showToast('Full name is required to process your booking.', 'error');
                document.getElementById('passengerFirstName').focus();
                return;
            }
            if (!phone) {
                showToast('Contact number is required to process your booking.', 'error');
                document.getElementById('passengerPhone').focus();
                return;
            }
            if (!email) {
                showToast('Email address is required to process your booking.', 'error');
                document.getElementById('passengerEmail').focus();
                return;
            }
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showToast('Please enter a valid email address.', 'error');
                document.getElementById('passengerEmail').focus();
                return;
            }

            // Restore other inputs to prevent gatherAllBookingData from wiping state
            if (!$('#passengerLastName').val() && state.passengerLastName) $('#passengerLastName').val(state.passengerLastName);
            if (!$('#passengerCount').val() && state.passengerCount) $('#passengerCount').val(state.passengerCount);
            if (!$('#luggageCount').val() && state.luggageCount) $('#luggageCount').val(state.luggageCount);
            if (!$('#handLuggageCount').val() && state.handLuggageCount) $('#handLuggageCount').val(state.handLuggageCount);

            gatherAllBookingData();

            // Loading state
            const btn = document.querySelector('#step5 .btn-search-uber') || document.querySelector('#personalInfoBtns .btn-search-uber');
            const originalBtnContent = btn.innerHTML;

            // STRIPE PAYMENT FLOW
            // If PaymentIntent was already terminal (succeeded), directly call /stripe/payment-confirm
            if (window.isPaymentAlreadyTerminal) {
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Finalizing Booking...';
                btn.disabled = true;

                const pId = parseInt(window.paymentId || state.paymentId || state.id || state.payment_id || 0);
                const txnId = window.transactionId || state.transaction_id || '';
                const cleanJobId = bookingData.jobId || bookingData.job_id || state.jobId || state.job_id || '';
                const cleanJobNo = bookingData.job_no || bookingData.bookingId || state.job_no || state.bookingId || '';

                fetch(API_BASE_URL + '/stripe/payment-confirm', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getCookieValue('auth_token')
                    },
                    body: JSON.stringify({
                        id: pId,
                        payment_id: pId,
                        transaction_id: txnId,
                        job_id: cleanJobId,
                        job_no: cleanJobNo,
                        pay_no: cleanJobNo,
                        payment_type: window.selectedStripePaymentType || 'full'
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status || data.success) {
                            const confirmedJobNo = data.job_no || data.data?.job_no || data.booking_no || data.data?.booking_no || data.jobNo || data.data?.jobNo || bookingData.job_no || (typeof data.data === 'string' && isNaN(data.data) ? data.data : null) || bookingData.bookingId;
                            $('#confirmNum').text(confirmedJobNo);
                            const previewHash = data.data?.preview_hash || data.preview_hash || data.data?.booking_key || data.booking_key || confirmedJobNo || bookingData.job_no || bookingData.bookingId;
                            if (previewHash) {
                                window.currentBookingPreviewHash = previewHash;
                                $('#viewBookingPreviewBtn').attr('href', '/booking-preview/' + encodeURIComponent(previewHash)).css('display', 'inline-flex');
                            } else {
                                $('#viewBookingPreviewBtn').css('display', 'inline-flex');
                            }
                            $('#confirmPickup').text(bookingData.pickup || '—');
                            $('#confirmDropoff').text(bookingData.dropoff || '—');
                            if (bookingData.date && bookingData.time) {
                                $('#confirmDateTime').text(`${bookingData.date} | ${bookingData.time}`);
                                $('#confirmDateTime').parent().show();
                            } else {
                                $('#confirmDateTime').parent().hide();
                            }
                            $('#confirmVehicle').text(bookingData.vehicle?.name || '—');
                            let finalDistance = bookingData.apiDistance || bookingData.vehicle?.fareBreakdown?.distance || '—';
                            if (typeof formatTripDistance === 'function' && finalDistance !== '—') {
                                finalDistance = formatTripDistance(finalDistance);
                            }
                            const finalDuration = bookingData.apiDuration || bookingData.vehicle?.fareBreakdown?.duration || '—';
                            $('#confirmDistance').text(finalDistance);
                            $('#confirmDuration').text(finalDuration);
                            showStep(8);
                        } else {
                            showToast(data.message || 'Confirmation failed', 'error');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        showToast('Server connection error', 'error');
                    })
                    .finally(() => {
                        btn.innerHTML = originalBtnContent;
                        btn.disabled = false;
                    });
                return;
            }

            // Phase 1: If Stripe Elements is NOT initialized yet, trigger payment-intent and show card UI
            if (!window.stripeElements) {
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Secure Session...';
                btn.disabled = true;

                initStripePaymentElement().then(success => {
                    if (!success) {
                        btn.innerHTML = originalBtnContent;
                        btn.disabled = false;
                    } else {
                        btn.disabled = false;
                    }
                });
                return;
            }

            // Phase 2: If Stripe Elements IS ALREADY initialized and visible, process card/redirect payment confirmation
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing Payment...';
            btn.disabled = true;

            const returnUrl = window.location.origin + window.location.pathname;

            window.stripeInstance.confirmPayment({
                elements: window.stripeElements,
                confirmParams: {
                    return_url: returnUrl
                },
                redirect: 'if_required'
            }).then(async function (result) {
                if (result.error) {
                    showToast(result.error.message || 'Payment processing failed.', 'error');
                    const msgBox = document.getElementById('payment-message');
                    if (msgBox) {
                        msgBox.textContent = result.error.message;
                        msgBox.style.display = 'block';
                    }
                    btn.innerHTML = originalBtnContent;
                    btn.disabled = false;
                } else if (result.paymentIntent && (result.paymentIntent.status === 'succeeded' || result.paymentIntent.status === 'processing')) {
                    try {
                        const pId = parseInt(window.paymentId || state.paymentId || state.id || state.payment_id || (result.paymentIntent && result.paymentIntent.metadata ? result.paymentIntent.metadata.payment_id : 0) || 0);
                        const txnId = window.transactionId || state.transaction_id || (result.paymentIntent && result.paymentIntent.metadata ? result.paymentIntent.metadata.transaction_id : '') || '';
                        const cleanJobId = bookingData.jobId || bookingData.job_id || state.jobId || state.job_id || '';
                        const cleanJobNo = bookingData.job_no || bookingData.bookingId || state.job_no || state.bookingId || '';

                        const confirmResp = await fetch(API_BASE_URL + '/stripe/payment-confirm', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'Authorization': 'Bearer ' + getCookieValue('auth_token')
                            },
                            body: JSON.stringify({
                                id: pId,
                                payment_id: pId,
                                transaction_id: txnId,
                                payment_intent_id: result.paymentIntent.id,
                                job_id: cleanJobId,
                                job_no: cleanJobNo,
                                pay_no: cleanJobNo,
                                status: result.paymentIntent.status,
                                credit_pay: (result.paymentIntent.amount / 100).toFixed(2),
                                payment_type: window.selectedStripePaymentType || 'full'
                            })
                        });
                        const data = await confirmResp.json();
                        if (data.status || data.success) {
                            const confirmedJobNo = data.job_no || data.data?.job_no || data.booking_no || data.data?.booking_no || data.jobNo || data.data?.jobNo || bookingData.job_no || (typeof data.data === 'string' && isNaN(data.data) ? data.data : null) || bookingData.bookingId;
                            $('#confirmNum').text(confirmedJobNo);

                            const previewHash = data.data?.preview_hash || data.preview_hash || data.data?.booking_key || data.booking_key || confirmedJobNo || bookingData.job_no || bookingData.bookingId;
                            if (previewHash) {
                                window.currentBookingPreviewHash = previewHash;
                                $('#viewBookingPreviewBtn').attr('href', '/booking-preview/' + encodeURIComponent(previewHash)).css('display', 'inline-flex');
                            } else {
                                $('#viewBookingPreviewBtn').css('display', 'inline-flex');
                            }

                            $('#confirmPickup').text(bookingData.pickup || '—');
                            $('#confirmDropoff').text(bookingData.dropoff || '—');
                            if (bookingData.date && bookingData.time) {
                                $('#confirmDateTime').text(`${bookingData.date} | ${bookingData.time}`);
                                $('#confirmDateTime').parent().show();
                            } else {
                                $('#confirmDateTime').parent().hide();
                            }
                            $('#confirmVehicle').text(bookingData.vehicle?.name || '—');
                            let finalDistance = bookingData.apiDistance || bookingData.vehicle?.fareBreakdown?.distance || '—';
                            if (typeof formatTripDistance === 'function' && finalDistance !== '—') {
                                finalDistance = formatTripDistance(finalDistance);
                            }
                            const finalDuration = bookingData.apiDuration || bookingData.vehicle?.fareBreakdown?.duration || '—';
                            $('#confirmDistance').text(finalDistance);
                            $('#confirmDuration').text(finalDuration);
                            showStep(8);
                        } else {
                            showToast('Payment Confirmation Error: ' + (data.message || 'Unknown error'), 'error');
                        }
                    } catch (err) {
                        console.error('Payment confirm error:', err);
                        showToast('Server connection error during payment confirmation.', 'error');
                    } finally {
                        btn.innerHTML = originalBtnContent;
                        btn.disabled = false;
                    }
                }
            }).catch(function (err) {
                console.error('Stripe error:', err);
                showToast('An unexpected error occurred with Stripe.', 'error');
                btn.innerHTML = originalBtnContent;
                btn.disabled = false;
            });
        }

        function showPaymentRedirectOverlay() {
            if ($('#paymentRedirectOverlay').length) {
                $('#paymentRedirectOverlay').show();
                return;
            }
            const overlayHtml = `
            <div id="paymentRedirectOverlay" style="position: fixed; inset: 0; z-index: 9999999; background: #0a0f1d; display: flex; flex-direction: column; align-items: center; justify-content: center; font-family: 'Manrope', 'Poppins', sans-serif; color: #ffffff; padding: 24px; text-align: center;">
                <div style="background: radial-gradient(circle, rgba(243, 156, 18, 0.15) 0%, rgba(10, 15, 29, 0) 70%); position: absolute; inset: 0; pointer-events: none;"></div>
                <div style="position: relative; z-index: 2; display: flex; flex-direction: column; align-items: center; max-width: 480px; width: 100%;">
                    <div style="margin-bottom: 32px;">
                        <img src="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG_II') }}/goride/img/logo-lightt.png" alt="GoRide" style="height: 48px; max-width: 200px; object-fit: contain;" onerror="this.src='https://www.goride.net.in/goride/img/Go-Ride-fav-icon.webp'">
                    </div>
                    <div style="position: relative; width: 84px; height: 84px; margin-bottom: 28px;">
                        <div style="position: absolute; inset: 0; border-radius: 50%; border: 4px solid rgba(243, 156, 18, 0.15);"></div>
                        <div style="position: absolute; inset: 0; border-radius: 50%; border: 4px solid transparent; border-top-color: #f39c12; border-right-color: #f39c12; animation: overlaySpin 1s cubic-bezier(0.55, 0.15, 0.45, 0.85) infinite;"></div>
                        <div style="position: absolute; inset: 10px; border-radius: 50%; border: 3px solid transparent; border-bottom-color: #10b981; animation: overlaySpinReverse 1.4s linear infinite;"></div>
                        <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-lock" style="font-size: 22px; color: #f39c12;"></i>
                        </div>
                    </div>
                    <h3 style="font-size: 24px; font-weight: 800; margin: 0 0 12px 0; color: #ffffff; letter-spacing: -0.5px;">Finalizing Your Booking...</h3>
                    <p style="font-size: 15px; color: #94a3b8; line-height: 1.6; margin: 0 0 24px 0; font-weight: 500;">
                        We're securely confirming your payment with Stripe. Please do not close or refresh this page.
                    </p>
                    <div style="display: inline-flex; align-items: center; gap: 10px; background: rgba(255, 255, 255, 0.06); padding: 10px 22px; border-radius: 999px; border: 1px solid rgba(255, 255, 255, 0.08);">
                        <div style="width: 8px; height: 8px; border-radius: 50%; background: #10b981; box-shadow: 0 0 12px #10b981; animation: overlayPulse 1.5s infinite;"></div>
                        <span style="font-size: 13px; font-weight: 600; color: #e2e8f0;" id="overlayStatusText">Authorizing payment settlement...</span>
                    </div>
                </div>
            </div>
            `;
            $('body').append(overlayHtml);
        }

        async function handleStripeRedirectReturn(paymentIntentId, redirectStatus) {
            if (typeof showPaymentRedirectOverlay === 'function') {
                showPaymentRedirectOverlay();
            }

            if (typeof BookingStore !== 'undefined') {
                BookingStore.restore();
            }
            const state = typeof BookingStore !== 'undefined' ? BookingStore.getState() : {};
            const pId = parseInt(state.id || state.payment_id || state.paymentId || window.paymentId || 0);
            const txnId = state.transaction_id || window.transactionId || '';
            const cleanJobId = state.jobId || state.job_id || (typeof bookingData !== 'undefined' ? bookingData.jobId || bookingData.job_id : '');
            const cleanJobNo = state.job_no || state.bookingId || (typeof bookingData !== 'undefined' ? bookingData.job_no || bookingData.bookingId : '') || '';

            // Clean up the URL query params without reloading the page
            window.history.replaceState({}, document.title, window.location.pathname);

            // Populate and synchronize the full left sidebar UI immediately from restored state
            if (typeof _updateLocationUI === 'function') _updateLocationUI(state);
            if (typeof _updateDateTimeUI === 'function') _updateDateTimeUI(state);
            if (typeof _updateVehicleSummaryUI === 'function') _updateVehicleSummaryUI(state);
            if (typeof _updatePassengerSummaryUI === 'function') _updatePassengerSummaryUI(state);
            if (typeof _updateJourneySummaryUI === 'function') _updateJourneySummaryUI(state);

            let finalDistance = state.apiDistance || state.vehicle?.fareBreakdown?.distance || '—';
            if (typeof formatTripDistance === 'function' && finalDistance !== '—') {
                finalDistance = formatTripDistance(finalDistance);
            }
            const finalDuration = state.apiDuration || state.vehicle?.fareBreakdown?.duration || '—';
            if (finalDistance !== '—' || finalDuration !== '—') {
                $('#leftTripDistance').text(finalDistance);
                $('#leftTripDuration').text(finalDuration);
                $('#tripRouteMetaContainer').show();
            }

            if (typeof updateBookingSummary === 'function') {
                updateBookingSummary();
            }

            showToast('Confirming your payment and booking...', 'info');

            try {
                const confirmResp = await fetch(API_BASE_URL + '/stripe/payment-confirm', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + (typeof getCookieValue === 'function' ? getCookieValue('auth_token') : '')
                    },
                    body: JSON.stringify({
                        id: pId,
                        payment_id: pId,
                        transaction_id: txnId,
                        payment_intent_id: paymentIntentId,
                        job_id: cleanJobId,
                        job_no: cleanJobNo,
                        pay_no: cleanJobNo,
                        status: redirectStatus,
                        payment_type: state.selectedStripePaymentType || window.selectedStripePaymentType || 'full'
                    })
                });

                const data = await confirmResp.json();
                if (data.status === true || data.success === true) {
                    const confirmedJobNo = data.job_no || data.data?.job_no || data.booking_no || data.data?.booking_no || data.jobNo || data.data?.jobNo || state.job_no || state.bookingId || jobNo;
                    $('#confirmNum').text(confirmedJobNo);

                    const previewHash = data.data?.preview_hash || data.preview_hash || data.data?.booking_key || data.booking_key || confirmedJobNo || state.job_no || state.bookingId;
                    if (previewHash) {
                        window.currentBookingPreviewHash = previewHash;
                        $('#viewBookingPreviewBtn').attr('href', '/booking-preview/' + encodeURIComponent(previewHash)).css('display', 'inline-flex');
                    } else {
                        $('#viewBookingPreviewBtn').css('display', 'inline-flex');
                    }

                    $('#confirmPickup').text(state.pickup || '—');
                    $('#confirmDropoff').text(state.dropoff || '—');
                    if (state.date && state.time) {
                        $('#confirmDateTime').text(`${state.date} | ${state.time}`);
                        $('#confirmDateTime').parent().show();
                    } else {
                        $('#confirmDateTime').parent().hide();
                    }
                    $('#confirmVehicle').text(state.vehicle?.name || '—');
                    $('#confirmDistance').text(finalDistance);
                    $('#confirmDuration').text(finalDuration);

                    // Re-run all UI updaters to ensure every card and sidebar is completely populated
                    if (typeof _updateLocationUI === 'function') _updateLocationUI(state);
                    if (typeof _updateDateTimeUI === 'function') _updateDateTimeUI(state);
                    if (typeof _updateVehicleSummaryUI === 'function') _updateVehicleSummaryUI(state);
                    if (typeof _updatePassengerSummaryUI === 'function') _updatePassengerSummaryUI(state);
                    if (typeof _updateJourneySummaryUI === 'function') _updateJourneySummaryUI(state);
                    if (typeof updateBookingSummary === 'function') updateBookingSummary();

                    // Switch directly to Step 8 (Booking Confirmed)
                    showStep(8);

                    // Remove/Fade out the black loading overlay
                    const $overlay = $('#paymentRedirectOverlay');
                    if ($overlay.length) {
                        $overlay.fadeOut(300, function () {
                            $(this).remove();
                        });
                    }

                    showToast('Payment successful! Your booking is confirmed.', 'success');
                } else {
                    // Payment failed or was canceled - redirect back to Payment step (Step 5)
                    const $overlay = $('#paymentRedirectOverlay');
                    if ($overlay.length) {
                        $overlay.fadeOut(300, function () {
                            $(this).remove();
                        });
                    }

                    // Bring user to Payment step
                    showStep(5);
                    if (typeof selectPaymentMethod === 'function') {
                        selectPaymentMethod('stripe');
                    }
                    if (typeof renderPaymentBreakdownUI === 'function') {
                        renderPaymentBreakdownUI(state.paymentBreakdown);
                    }
                    $('#stripePaymentContainer').show();
                    if (typeof initStripePaymentElement === 'function') {
                        initStripePaymentElement();
                    }

                    const failMessage = data.message || (typeof data.data === 'string' ? data.data : 'Payment failed. Please try again or choose another payment method.');
                    const msgBox = document.getElementById('payment-message');
                    if (msgBox) {
                        msgBox.textContent = failMessage;
                        msgBox.style.display = 'block';
                    }

                    showToast(failMessage, 'error');
                }
            } catch (err) {
                console.error('Error confirming redirected payment:', err);
                const $overlay = $('#paymentRedirectOverlay');
                if ($overlay.length) {
                    $overlay.fadeOut(300, function () {
                        $(this).remove();
                    });
                }
                showStep(5);
                if (typeof selectPaymentMethod === 'function') {
                    selectPaymentMethod('stripe');
                }
                if (typeof renderPaymentBreakdownUI === 'function') {
                    renderPaymentBreakdownUI(state.paymentBreakdown);
                }
                $('#stripePaymentContainer').show();
                if (typeof initStripePaymentElement === 'function') {
                    initStripePaymentElement();
                }

                const errMsg = 'Payment verification failed. Please try again.';
                const msgBox = document.getElementById('payment-message');
                if (msgBox) {
                    msgBox.textContent = errMsg;
                    msgBox.style.display = 'block';
                }
                showToast(errMsg, 'error');
            }
        }


        function updateBookingSummary() {
            const bData = BookingStore.getState();
            if (typeof _updateVehicleSummaryUI === 'function') _updateVehicleSummaryUI(bData);
            if (typeof updateStripeTypeAmounts === 'function') updateStripeTypeAmounts();

            // 1. Passenger Name
            const fname = bData.passengerFirstName || '';
            const lname = bData.passengerLastName || '';
            const pName = (fname + ' ' + lname).trim();
            $('#summaryPassengerName').text(fname.trim() || '–');

            if (pName) {
                $('#mcsPassengerName').text(pName);
                $('#mcsPassengerNameContainer').css({
                    'display': 'flex',
                    'flex-direction': 'column'
                });
            } else {
                $('#mcsPassengerNameContainer').hide();
            }
            // 2. Contact
            const phone = bData.passengerPhone || '';
            if (phone.trim()) {
                let displayPhone = phone.trim();
                if (window.passengerPhoneIti) {
                    const countryData = window.passengerPhoneIti.getSelectedCountryData();
                    if (countryData && countryData.dialCode) {
                        displayPhone = phone.startsWith('+') ? phone : '+' + countryData.dialCode + ' ' + phone.trim();
                    } else {
                        displayPhone = phone.startsWith('+') ? phone : '+44 ' + phone.trim();
                    }
                } else {
                    displayPhone = phone.startsWith('+') ? phone : '+44 ' + phone.trim();
                }

                $('#summaryPassengerContact').text(displayPhone);
                $('#mcsPassengerPhone').text(displayPhone);
                $('#mcsPassengerPhoneContainer').css('display', 'flex');
            } else {
                $('#summaryPassengerContact').text('–');
                $('#mcsPassengerPhoneContainer').hide();
            }
            // 3. Email
            const email = bData.passengerEmail || '';
            $('#summaryPassengerEmail').text(email.trim() || '–');
            if (email.trim()) {
                $('#mcsPassengerEmail').text(email.trim());
                $('#mcsPassengerEmailContainer').css('display', 'flex');
            } else {
                $('#mcsPassengerEmailContainer').hide();
            }
            let showEnteredDetails = false;
            // 4. Passengers count
            const pCount = bData.passengerCount || '1';
            $('#summaryPassengerCount').text(pCount);
            $('#mcsPassengerCount').text(pCount);
            if (parseInt(pCount) > 1 || pName !== '' || email.trim() !== '' || phone.trim() !== '') showEnteredDetails = true;
            // 5. Luggage count
            const lCount = bData.luggageCount || '0';
            $('#summaryLuggageCount').text(lCount);
            $('#mcsLuggageCount').text(lCount);
            if (parseInt(lCount) > 0) {
                $('#mcsLuggageContainer').show();
                showEnteredDetails = true;
            } else {
                $('#mcsLuggageContainer').hide();
            }
            // 6. Hand Luggage count
            const hlCount = bData.handLuggageCount || '0';
            $('#summaryHandLuggageCount').text(hlCount);
            $('#mcsHandLuggageCount').text(hlCount);
            if (parseInt(hlCount) > 0) {
                $('#mcsHandLuggageContainer').show();
                showEnteredDetails = true;
            } else {
                $('#mcsHandLuggageContainer').hide();
            }
            // 7. Baby Seats
            const isBabySeat = bData.isBabySeat;
            if (isBabySeat) {
                const bsCount = parseInt(bData.childSeatCount) || 0;
                if (bsCount > 0) {
                    const seatTypes = bData.childSeatTypes || [];
                    const seatTypesStr = seatTypes.length > 0 ? ` (${seatTypes.join(', ')})` : '';
                    $('#summaryBabySeats').text(bsCount + seatTypesStr);
                    $('#mcsBabySeats').text(bsCount + seatTypesStr);
                    showEnteredDetails = true;
                } else {
                    $('#summaryBabySeats').text('0');
                    $('#mcsBabySeats').text('0');
                }
                $('#summaryBabySeatContainer').show();
                $('#mcsBabySeatContainer').show();
            } else {
                $('#summaryBabySeatContainer').hide();
                $('#mcsBabySeatContainer').hide();
            }

            // passenger header visibility
            if (pName || email.trim() || phone.trim()) {
                $('#mcsPassengerHeader').show();
            } else {
                $('#mcsPassengerHeader').hide();
            }

            // 8. Date & Time & Journey Info depending on pickupType
            const pickupType = bookingData.pickupType;
            if (pickupType === 'airport') {
                // Flight details
                $('#dtStatDateLabel, #mcsStatDateLabel').text('FLIGHT ARRIVAL DATE');
                $('#dtStatTimeLabel, #mcsStatTimeLabel').text('FLIGHT LANDING TIME');
                $('#summaryDateLabel').html('<i class="fas fa-calendar text-yellow"></i> Flight Arrival Date');
                $('#summaryBookingDate').text(bookingData.date || '–');
                $('#summaryTimeLabel').html('<i class="fas fa-clock text-yellow"></i> Flight Landing Time');
                $('#summaryBookingTime').text(bookingData.time || '–');

                const flightNum = $('#flightNumber').val() || '';
                const comingFrom = $('#comingFrom').val() || '';
                const dropoffAddress = $('#dropoffAddress').val() || '';
                const airportDetails = [flightNum, comingFrom, dropoffAddress]
                    .filter(v => v && v.trim() !== '' && v.trim() !== '–' && v.trim() !== '-')
                    .join(', ') || '–';

                $('#summaryFlightLabel').html('<i class="fas fa-plane text-navy"></i>');
                $('#summaryFlightNumber').text(airportDetails);
                $('#summaryFlightContainer').show();
                $('#summaryComingFromContainer').hide();
                $('#summaryDropoffAddressContainer').hide();
                $('#summaryJourneyDetailsHeader').text('ADDITIONAL INFORMATION').show();

                // Mobile Flight details
                $('#mcsFlightLabel').html('<i class="fas fa-plane text-navy"></i>');
                $('#mcsFlightNumber').text(airportDetails);
                $('#mcsFlightContainer').show();
                $('#mcsComingFromContainer').hide();
                $('#mcsDropoffAddressContainer').hide();
                $('#mcsJourneyDetailsHeader').text('ADDITIONAL INFORMATION').show();

                if (flightNum.trim() !== '' || comingFrom.trim() !== '' || dropoffAddress.trim() !== '') {
                    showEnteredDetails = true;
                }
            } else if (pickupType === 'seaport') {
                // Cruise details
                $('#dtStatDateLabel, #mcsStatDateLabel').text('DOCKING DATE');
                $('#dtStatTimeLabel, #mcsStatTimeLabel').text('DOCKING TIME');
                $('#summaryDateLabel').html('<i class="fas fa-calendar text-yellow"></i> Docking Date');
                $('#summaryBookingDate').text(bookingData.date || '–');
                $('#summaryTimeLabel').html('<i class="fas fa-clock text-yellow"></i> Docking Time');
                const dockingTime = $('#seaportArrivalTime').val() || bookingData.time || '–';
                $('#summaryBookingTime').text(dockingTime);

                const ferryName = $('#ferryName').val() || '';
                const comingFromPort = $('#comingFromPort').val() || '';
                const dropoffAddressSeaport = $('#dropoffAddressSeaport').val() || '';
                const seaportDetails = [ferryName, comingFromPort, dropoffAddressSeaport]
                    .filter(v => v && v.trim() !== '' && v.trim() !== '–' && v.trim() !== '-')
                    .join(', ') || '–';

                $('#summaryFlightLabel').html('<i class="fas fa-ship text-navy"></i>');
                $('#summaryFlightNumber').text(seaportDetails);
                $('#summaryFlightContainer').show();
                $('#summaryComingFromContainer').hide();
                $('#summaryDropoffAddressContainer').hide();
                $('#summaryJourneyDetailsHeader').text('ADDITIONAL INFORMATION').show();

                // Mobile Cruise details
                $('#mcsFlightLabel').html('<i class="fas fa-ship text-navy"></i>');
                $('#mcsFlightNumber').text(seaportDetails);
                $('#mcsFlightContainer').show();
                $('#mcsComingFromContainer').hide();
                $('#mcsDropoffAddressContainer').hide();
                $('#mcsJourneyDetailsHeader').text('ADDITIONAL INFORMATION').show();

                if (ferryName.trim() !== '' || comingFromPort.trim() !== '' || dropoffAddressSeaport.trim() !== '') {
                    showEnteredDetails = true;
                }
            } else {
                // Normal details
                $('#dtStatDateLabel, #mcsStatDateLabel').text('DATE');
                $('#dtStatTimeLabel, #mcsStatTimeLabel').text('TIME');
                $('#summaryDateLabel').html('<i class="fas fa-calendar text-yellow"></i> Date');
                const normalDate = $('#normalJourneyDate').val() || bookingData.date || '–';
                $('#summaryBookingDate').text(normalDate);
                $('#summaryTimeLabel').html('<i class="fas fa-clock text-yellow"></i> Time');
                const normalTime = $('#normalJourneyTime').val() || bookingData.time || '–';
                $('#summaryBookingTime').text(normalTime);
                // Hide airport/seaport specific details
                $('#summaryFlightContainer').hide();
                $('#summaryComingFromContainer').hide();
                $('#summaryDropoffAddressContainer').hide();
                $('#summaryJourneyDetailsHeader').hide();

                // Mobile details hide
                $('#mcsFlightContainer').hide();
                $('#mcsComingFromContainer').hide();
                $('#mcsDropoffAddressContainer').hide();
                $('#mcsJourneyDetailsHeader').hide();
            }

            // Meet & Greet
            const isMeetGreet = $('#meetAndGreet').is(':checked') || $('#meetAndGreetSeaport').is(':checked') || $('.meet-and-greet-cb').is(':checked') || bData.meetAndGreet === '1' || bData.meetAndGreet === true;
            if (isMeetGreet) {
                $('#summaryMeetGreetContainer').css('display', 'inline-flex');
                $('#mcsMeetGreetContainer').css('display', 'inline-flex');
                showEnteredDetails = true;
            } else {
                $('#summaryMeetGreetContainer').hide();
                $('#mcsMeetGreetContainer').hide();
            }

            // Wheelchair Access
            const isWheelchair = $('#wheelchairOptionAirport').is(':checked') || $('#wheelchairOptionSeaport').is(':checked') || $('#wheelchairOptionNormal').is(':checked') || $('.wheelchair-option-cb').is(':checked') || bData.wheelchairOption === '1' || bData.wheelchairOption === true;
            if (isWheelchair) {
                $('#summaryWheelchairContainer').css('display', 'inline-flex');
                $('#mcsWheelchairContainer').css('display', 'inline-flex');
                showEnteredDetails = true;
            } else {
                $('#summaryWheelchairContainer').hide();
                $('#mcsWheelchairContainer').hide();
            }

            // Special Requirements
            const isSpecialReq = $('#specialReqCheckbox').is(':checked') || (bData.isSpecialReq && bData.specialRequirements);
            const specReqVal = $('#specialRequirements').val() ? $('#specialRequirements').val().trim() : (bData.specialRequirements || '');
            if (isSpecialReq && specReqVal !== '') {
                $('#summarySpecialRequirements').text(specReqVal);
                $('#summarySpecialReqContainer').show();

                // Mobile
                $('#mcsSpecialRequirements').text(specReqVal);
                $('#mcsSpecialReqContainer').show();
                showEnteredDetails = true;
            } else {
                $('#summarySpecialReqContainer').hide();
                $('#mcsSpecialReqContainer').hide();
            }

            const hasFlightOrCruise = (pickupType === 'airport' || pickupType === 'seaport');
            const hasAddInfo = hasFlightOrCruise || isMeetGreet || isWheelchair || (isSpecialReq && specReqVal !== '');
            if (hasAddInfo) {
                $('#summaryJourneyDetailsHeader').text('ADDITIONAL INFORMATION').css('display', 'block');
                $('#mcsJourneyDetailsHeader').text('ADDITIONAL INFORMATION').css('display', 'block');
            } else {
                $('#summaryJourneyDetailsHeader').hide();
                $('#mcsJourneyDetailsHeader').hide();
            }

            const currentStep = bData.currentStep || 1;
            if (showEnteredDetails && currentStep >= 5) {
                $('#mcsEnteredDetails').css('display', 'grid');
            } else {
                $('#mcsEnteredDetails').hide();
            }
        }

        function gatherAllBookingData() {
            // Read all form fields into a single batch update
            const isBabySeat = $('#carSeatCheckbox').is(':checked');
            const childSeatCount = isBabySeat ? (parseInt($('#childSeatCount').val()) || 0) : 0;
            const childSeatTypes = [];
            for (let i = 1; i <= childSeatCount; i++) {
                childSeatTypes.push($(`#childSeatType_${i}`).val() || '');
            }

            const isSpecialReq = $('#specialReqCheckbox').is(':checked');
            const currentPickupType = BookingStore.getState().pickupType;

            const isMeetGreet = $('#meetAndGreet').is(':checked') || $('#meetAndGreetSeaport').is(':checked');
            const isWheelchair = $('#wheelchairOptionAirport').is(':checked') || $('#wheelchairOptionSeaport').is(':checked') || $('#wheelchairOptionNormal').is(':checked');

            // Build journey-specific fields
            let journeyFields = {};
            if (currentPickupType === 'airport') {
                journeyFields = {
                    flightNumber: $('#flightNumber').val(),
                    flightArrivingTime: BookingStore.getState().time || $('#flightArrivingTime').val(),
                    comingFrom: $('#comingFrom').val(),
                    dropoffAddress: $('#dropoffAddress').val(),
                    pickAfterTime: $('#pickupAfterLandingSelect').val() || $('#pickupAfterLanding').val() || BookingStore.getState().pickAfterTime || '45',
                    meetAndGreet: isMeetGreet ? '1' : '0',
                    wheelchairOption: isWheelchair ? '1' : '0',
                };
            } else if (currentPickupType === 'seaport') {
                journeyFields = {
                    dockingTime: BookingStore.getState().time || $('#seaportArrivalTime').val(),
                    ferryName: $('#ferryName').val(),
                    comingFromPort: $('#comingFromPort').val(),
                    dropoffAddressSeaport: $('#dropoffAddressSeaport').val(),
                    meetAndGreet: isMeetGreet ? '1' : '0',
                    wheelchairOption: isWheelchair ? '1' : '0',
                    pickAfterTime: $('#pickupAfterDockingSelect').val() || BookingStore.getState().pickAfterTime || '45',
                };
            } else {
                journeyFields = {
                    pickupAddressNormal: $('#pickupAddressNormal').val(),
                    dropoffAddressNormal: $('#dropoffAddressNormal').val(),
                    meetAndGreet: '0',
                    wheelchairOption: isWheelchair ? '1' : '0',
                };
            }

            // Single batch setState – fires subscribers exactly once
            BookingStore.setState({
                passengerFirstName: $('#passengerFirstName').val() || '',
                passengerLastName: $('#passengerLastName').val() || '',
                passengerPhone: $('#passengerPhone').val() || '',
                passengerEmail: $('#passengerEmail').val() || '',
                passengerCount: $('#passengerCount').val() || 1,
                luggageCount: $('#luggageCount').val() || 0,
                handLuggageCount: $('#handLuggageCount').val() || 0,
                isBabySeat,
                childSeatCount,
                childSeatTypes,
                isSpecialReq,
                specialRequirements: isSpecialReq ? ($('#specialRequirements').val().trim() || '') : '',
                ...journeyFields,
            });
        }

        function verifyPassengerDetails() {
            gatherAllBookingData();

            // Validate Personal Info Fields
            const nameCheck = validateFullName(bookingData.passengerFirstName);
            if (!nameCheck.valid) {
                showToast(nameCheck.message, 'error');
                $('#passengerFirstName').focus();
                return;
            }

            const phoneEl = document.getElementById('passengerPhone');
            const phoneCheck = validateContactNumber(phoneEl, window.passengerPhoneIti);
            if (!phoneCheck.valid) {
                showToast(phoneCheck.message, 'error');
                if (phoneEl) phoneEl.focus();
                return;
            }

            const emailCheck = validateEmailAddress(bookingData.passengerEmail);
            if (!emailCheck.valid) {
                showToast(emailCheck.message, 'error');
                $('#passengerEmail').focus();
                return;
            }

            // --- Baby Seat Validation ---
            if (bookingData.isBabySeat) {
                const seatCount = parseInt($('#childSeatCount').val()) || 0;
                if (seatCount <= 0) {
                    showToast('Please select at least 1 baby seat.', 'error');
                    return;
                }
                for (let i = 1; i <= seatCount; i++) {
                    const seatType = $(`#childSeatType_${i}`).val();
                    if (!seatType) {
                        showToast(`Please select a type for Baby Seat ${i}.`, 'error');
                        $(`#childSeatType_${i}`).focus();
                        return;
                    }
                }
            }

            // --- Special Requirements Validation ---
            if (bookingData.isSpecialReq && !bookingData.specialRequirements) {
                showToast('Please enter your special requirements.', 'error');
                $('#specialRequirements').focus();
                return;
            }

            // --- Combined Luggage validation ---
            const currentVehicle = bookingData.vehicle;
            const maxLuggageCap = currentVehicle ? (parseInt(currentVehicle.luggage) || 8) : 8;
            const totalLuggageCount = (parseInt(bookingData.luggageCount) || 0) + (parseInt(bookingData.handLuggageCount) || 0);
            // if (totalLuggageCount > maxLuggageCap) {
            //     showToast(`Total combined luggage (Luggage + Hand Luggage) cannot exceed ${maxLuggageCap} for this vehicle.`, 'error');
            //     return;
            // }

            // --- Journey specific validation ---
            if (bookingData.pickupType === 'airport') {
                if (!bookingData.flightNumber) { showToast('Flight Number is required.', 'error'); return; }
                if (!bookingData.pickAfterTime) {
                    BookingStore.setState({ pickAfterTime: $('#pickupAfterLandingSelect').val() || $('#pickupAfterLanding').val() || '45' });
                }
                if (!bookingData.comingFrom) { showToast('Coming From is required.', 'error'); return; }
                // Dropoff Address validation removed as requested
            } else if (bookingData.pickupType !== 'seaport') {
                // Validation removed for Pickup and Dropoff Address as requested
            }

            const btn = document.querySelector('#additionalDetailsBtns .btn-search-uber');
            let originalBtnContent = 'Continue';
            if (btn) {
                originalBtnContent = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Finding Driver...';
                btn.disabled = true;
            }

            const fareDetails = bookingData.vehicle?.fareBreakdown || {};

            let pDate = bookingData.date;
            let pTime = bookingData.time;
            if (!pDate) {
                pDate = new Date().toISOString().slice(0, 10);
            } else if (pDate.includes('/')) {
                const parts = pDate.split('/');
                if (parts.length === 3) {
                    pDate = `${parts[2]}-${parts[1]}-${parts[0]}`;
                }
            }
            if (!pTime) {
                pTime = "00:00:00";
            } else {
                const match = pTime.trim().match(/^(\d{1,2}):(\d{2})\s*(AM|PM)?$/i);
                if (match) {
                    let hours = parseInt(match[1], 10);
                    const minutes = match[2];
                    const modifier = match[3] ? match[3].toUpperCase() : null;
                    if (modifier === 'PM' && hours < 12) hours += 12;
                    if (modifier === 'AM' && hours === 12) hours = 0;
                    pTime = `${hours.toString().padStart(2, '0')}:${minutes}:00`;
                } else if (pTime.length === 5) {
                    pTime += ':00';
                }
            }
            const pickupDateTime = pDate + ' ' + pTime;

            const payload = {
                job_type: bookingData.returnTrip ? 'roundtrip' : 'oneway',
                from_place: bookingData.pickup || '',
                to_place: bookingData.dropoff || '',
                pick_address: bookingData.pickupAddressNormal || bookingData.pickup || '',
                drop_address: bookingData.dropoffAddressNormal || bookingData.dropoffAddress || bookingData.dropoffAddressSeaport || bookingData.dropoff || '',
                pickup_date: pickupDateTime,
                dropoff_date: '',
                day: '',
                pass_count: bookingData.passengerCount || '1',
                lugg_count: bookingData.luggageCount || '0',
                fare: String(bookingData.vehicle?.price || '0'),
                distance: String(bookingData.apiDistance || fareDetails.distance || '0'),
                duration: String(bookingData.apiDuration || fareDetails.duration || '0'),
                cab_type: (bookingData.vehicle?.key || 'standard').toLowerCase().trim(),
                cab_name: (bookingData.vehicle?.name || 'standard'),
                add_fare_details: {
                    bata: String(fareDetails.bata || '0'),
                    parking: String(fareDetails.parking_charge || '0'),
                    toll: String(fareDetails.toll_fare || '0')
                },
                type: 'web',
                c_id: 0,
                c_name: bookingData.passengerFirstName + ' ' + bookingData.passengerLastName,
                c_email: bookingData.passengerEmail || '',
                c_mobile: bookingData.passengerPhone || '',
                isDriver: 'no',
                c_pick_after_time: bookingData.pickAfterTime || '',
                c_luggage: bookingData.luggageCount || '0',
                c_hand_lagguage: bookingData.handLuggageCount || '0',
                c_child_count: bookingData.childSeatCount ? bookingData.childSeatCount.toString() : '0',
                c_child_type: bookingData.childSeatTypes && bookingData.childSeatTypes.length ? bookingData.childSeatTypes.join(',') : '',
                c_flight_number: bookingData.flightNumber || bookingData.ferryName || 'none',
                c_coming_from: bookingData.comingFrom || bookingData.comingFromPort || 'none',
                c_drop_address: bookingData.dropoffAddressNormal || bookingData.dropoffAddress || bookingData.dropoffAddressSeaport || '',
                c_pick_address: bookingData.pickupAddressNormal || '',
                c_special_require: bookingData.specialRequirements || 'none',
                c_flight_arriving_time: bookingData.flightArrivingTime || '',
                c_meet_and_greet: bookingData.meetAndGreet || '0',
                c_wheel_chair: bookingData.wheelchairOption || '0',
                c_seaport_arrival_time: bookingData.dockingTime || '',
                c_pass_name: (bookingData.rideFor === 'other' && bookingData.otherPassengerData) ? bookingData.otherPassengerData.name : '',
                c_pass_mobile: (bookingData.rideFor === 'other' && bookingData.otherPassengerData) ? bookingData.otherPassengerData.phone : '',
                c_is_other: bookingData.rideFor === 'other'
            };

            // Using the user-provided API Route via the local controller proxy
            fetch(API_BASE_URL + '/w-book-notify-driver', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    // Assuming sanctum token is required for all these secure routes
                    'Authorization': 'Bearer ' + getCookieValue('auth_token')
                },
                body: JSON.stringify(payload)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === true) {
                        const jobNo = data.job_no || data.booking_no || data.data?.job_no || data.data?.booking_no || (typeof data.data === 'string' && isNaN(data.data) ? data.data : '') || (typeof data.jobNo === 'string' ? data.jobNo : '');
                        const jobId = data.jd || data.job_id || data.id || data.data?.job_id || data.data?.jd || (typeof data.data === 'number' || /^\d+$/.test(data.data) ? data.data : '') || '';

                        const cleanJobNo = String(jobNo || '').trim();
                        const cleanJobId = jobId || '';

                        BookingStore.setState({
                            bookingId: cleanJobNo || (cleanJobId ? String(cleanJobId) : ''),
                            job_no: cleanJobNo,
                            jobId: cleanJobId,     // DB numeric ID
                            job_id: cleanJobId,
                            firebaseConfig: data.firebase || null,
                            firebaseCustomToken: data.firebase_custom_token || null
                        });

                        updateBookingSummary();
                        $('#enteredDetailsSummary').show();
                        showStep(6);
                        startDynamicDriverSearch(data.firebase, data.firebase_custom_token);
                    } else {
                        showToast(data.message || 'Error occurred while saving booking.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('There was a problem connecting to the server.', 'error');
                })
                .finally(() => {
                    if (btn) {
                        btn.innerHTML = originalBtnContent;
                        btn.disabled = false;
                    }
                });
        }
        let driversListener = null;
        let existingRenderedDrivers = new Set();
        let _authStateUnsubscribe = null; // Track onAuthStateChanged unsubscribe fn

        // Dedicated separate variables for pickup time expiration logic (Don't disturb existing variables!)
        let effectivePickupDateTime = null;
        let bookingExpirationTimer = null;

        function parseDateTimeToJSDate(dateStr, timeStr) {
            if (!dateStr) return null;
            const normalizedDate = (typeof normalizeDateToYYYYMMDD === 'function') ? normalizeDateToYYYYMMDD(dateStr) : dateStr;
            if (!normalizedDate) return null;

            let hours = 0;
            let minutes = 0;
            if (timeStr) {
                timeStr = String(timeStr).trim().toUpperCase();
                const match12 = timeStr.match(/^(\d{1,2}):(\d{2})\s*(AM|PM)?$/i);
                if (match12) {
                    hours = parseInt(match12[1], 10);
                    minutes = parseInt(match12[2], 10);
                    const ampm = match12[3];
                    if (ampm === 'PM' && hours < 12) hours += 12;
                    if (ampm === 'AM' && hours === 12) hours = 0;
                } else {
                    const match24 = timeStr.match(/^(\d{1,2}):(\d{2})$/);
                    if (match24) {
                        hours = parseInt(match24[1], 10);
                        minutes = parseInt(match24[2], 10);
                    }
                }
            }
            const hh = String(hours).padStart(2, '0');
            const mm = String(minutes).padStart(2, '0');
            const dt = new Date(`${normalizedDate}T${hh}:${mm}:00`);
            return isNaN(dt.getTime()) ? null : dt;
        }

        function calculateEffectivePickupTime(state) {
            state = state || BookingStore.getState();
            let dateStr = '';
            let timeStr = '';
            let extraMins = 0;
            let scenario = '';

            const pType = (state.pickupType || '').toLowerCase();
            const pLoc = (state.pickup || '').toLowerCase();

            const isAirport = pType === 'airport' || pLoc.includes('airport') || pLoc.includes('terminal');
            const isSeaport = pType === 'seaport' || pLoc.includes('seaport') || pLoc.includes('port') || pLoc.includes('cruise');

            if (isAirport) {
                // 1. Airport: Flight arrival date & landing time + After pickup landing time
                scenario = 'Airport (Scenario 1)';
                dateStr = state.flightArrivalDate || state.date || state.normalJourneyDate || '';
                timeStr = state.landingTime || state.flightLandingTime || state.time || state.normalJourneyTime || '';
                extraMins = parseInt(state.pickAfterTime || state.pickupAfter || 0, 10) || 0;
            } else if (isSeaport) {
                // 2. Seaport: Cruise docking date & docking time + After docking time
                scenario = 'Seaport (Scenario 2)';
                dateStr = state.cruiseDockingDate || state.seaportDate || state.date || state.normalJourneyDate || '';
                timeStr = state.dockingTime || state.cruiseDockingTime || state.time || state.normalJourneyTime || '';
                extraMins = parseInt(state.pickAfterTime || state.dockingAfterMins || state.pickupAfter || 0, 10) || 0;
            } else {
                // 3. Otherwise: Only pickup time (pickup date & time)
                scenario = 'Standard Pickup (Scenario 3)';
                dateStr = state.date || state.normalJourneyDate || '';
                timeStr = state.time || state.normalJourneyTime || '';
                extraMins = 0;
            }

            if (!dateStr) {
                console.warn('[PickupTimeCheck] No date string found in state:', state);
                return null;
            }

            let dt = parseDateTimeToJSDate(dateStr, timeStr);
            if (!dt || isNaN(dt.getTime())) {
                console.warn('[PickupTimeCheck] Failed to parse date/time:', { dateStr, timeStr });
                return null;
            }

            if (extraMins > 0) {
                dt = new Date(dt.getTime() + extraMins * 60 * 1000);
            }

            console.log(`[PickupTimeCheck] Scenario: %c${scenario}`, 'color: #3b82f6; font-weight: bold;', {
                baseDate: dateStr,
                baseTime: timeStr,
                afterTimeMins: extraMins,
                calculatedEffectiveTime: dt.toLocaleString('en-GB')
            });

            return dt;
        }

        function getUKCurrentTime() {
            try {
                const now = new Date();
                const formatter = new Intl.DateTimeFormat('en-GB', {
                    timeZone: 'Europe/London',
                    year: 'numeric', month: '2-digit', day: '2-digit',
                    hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false
                });
                const parts = formatter.formatToParts(now).reduce((acc, part) => {
                    acc[part.type] = part.value;
                    return acc;
                }, {});
                return new Date(`${parts.year}-${parts.month}-${parts.day}T${parts.hour}:${parts.minute}:${parts.second}`);
            } catch (e) {
                return new Date();
            }
        }

        function changeExpiredPickupTime() {
            if (typeof BookingStore !== 'undefined' && BookingStore.setState) {
                BookingStore.setState({ isBookingExpired: false });
            }
            $('#bookingExpiredCard').hide();
            checkAndAutoSetIfPastTime();
            showSchedulePanelFromStep1();
        }
        window.changeExpiredPickupTime = changeExpiredPickupTime;

        function triggerBookingExpiredState(effectiveTime) {
            if (driversListener) {
                driversListener();
                driversListener = null;
            }
            if (bookingExpirationTimer) {
                clearInterval(bookingExpirationTimer);
                bookingExpirationTimer = null;
            }

            BookingStore.setState({ isBookingExpired: true });

            $('#findingDriversLoader').hide();
            $('#moreDriversLoader').hide();
            $('#driverList').hide();
            $('#step6CancelBtnWrapper').hide();

            if (effectiveTime) {
                try {
                    const formattedStr = effectiveTime.toLocaleString('en-GB', {
                        day: 'numeric', month: 'short', year: 'numeric',
                        hour: '2-digit', minute: '2-digit', hour12: true
                    });
                    $('#expiredPickupTimeDetails').html('<i class="fa-solid fa-calendar-xmark me-1"></i> Scheduled Time: ' + formattedStr);
                } catch (e) { }
            }

            $('#bookingExpiredCard').slideDown(400);
        }

        function checkBookingExpiration() {
            const state = BookingStore.getState();
            if (state.currentStep !== 6 && state.currentStep !== 3) {
                return false;
            }

            effectivePickupDateTime = calculateEffectivePickupTime(state);
            if (!effectivePickupDateTime) return false;

            // Current live time in UK (Europe/London) timezone
            const nowUK = getUKCurrentTime();
            const isExpired = nowUK.getTime() > effectivePickupDateTime.getTime();

            console.log('%c[PickupTimeCheck] Expiration Assessment:', 'color: #f59e0b; font-weight: bold;', {
                currentUKTime: nowUK.toLocaleString('en-GB'),
                effectivePickupTime: effectivePickupDateTime.toLocaleString('en-GB'),
                isExpired: isExpired
            });

            if (isExpired) {
                if (state.currentStep === 3) {
                    const wasAutoUpdated = checkAndAutoSetIfPastTime();
                    if (wasAutoUpdated) {
                        BookingStore.setState({ isBookingExpired: false });
                        $('#bookingExpiredCard').hide();
                        return false;
                    }
                }
                console.log('%c[PickupTimeCheck] ❌ Pickup time has EXPIRED! Triggering Expired UI & stopping Firebase.', 'color: #ef4444; font-weight: bold;');
                triggerBookingExpiredState(effectivePickupDateTime);
                return true;
            } else {
                if (state.isBookingExpired) {
                    BookingStore.setState({ isBookingExpired: false });
                }
                $('#bookingExpiredCard').hide();
                console.log('%c[PickupTimeCheck] ✅ Booking active - pickup time is in future.', 'color: #10b981;');
            }
            return false;
        }

        // Immediately check expiration when tab becomes active after user was away
        document.addEventListener('visibilitychange', function () {
            if (!document.hidden) {
                const state = (typeof BookingStore !== 'undefined' && BookingStore.getState) ? BookingStore.getState() : {};
                if (state.currentStep === 6 || state.currentStep === 3) {
                    checkBookingExpiration();
                }
            }
        });
        window.addEventListener('focus', function () {
            const state = (typeof BookingStore !== 'undefined' && BookingStore.getState) ? BookingStore.getState() : {};
            if (state.currentStep === 6 || state.currentStep === 3) {
                checkBookingExpiration();
            }
        });

        function resetToNewBooking() {
            try {
                sessionStorage.clear();
                sessionStorage.removeItem('gorideBookingState_v2');
            } catch (e) { }
            window.location.href = '/';
        }

        function startDynamicDriverSearch(firebaseConfig, firebaseCustomToken) {
            $('#bookingExpiredCard').hide();
            $('#findingDriversLoader').show();
            $('#step6CancelBtnWrapper').show();

            const state = BookingStore.getState();
            firebaseConfig = firebaseConfig || state.firebaseConfig || window.firebaseConfig;
            firebaseCustomToken = firebaseCustomToken || state.firebaseCustomToken || window.firebaseCustomToken;

            // Check if pickup time is expired FIRST
            if (checkBookingExpiration()) {
                console.log("Pickup time has expired. Stopping Firebase listening.");
                return;
            }

            if (bookingExpirationTimer) {
                clearInterval(bookingExpirationTimer);
                bookingExpirationTimer = null;
            }
            bookingExpirationTimer = setInterval(checkBookingExpiration, 5000);

            const grid = $('#driverList');
            grid.html(''); // Clear previous drivers
            existingRenderedDrivers.clear(); // Reset tracked drivers

            // Unsubscribe any previous onAuthStateChanged listener to prevent duplicates
            if (_authStateUnsubscribe) {
                _authStateUnsubscribe();
                _authStateUnsubscribe = null;
            }

            // Unsubscribe any previous Firestore listener
            if (driversListener) {
                driversListener();
                driversListener = null;
            }

            // Add the loader element at the bottom if not already present
            if ($('#moreDriversLoader').length === 0) {
                grid.after(`
                    <div id="moreDriversLoader" class="more-drivers-loader">
    <!-- Radar Animation -->
    <div class="radar-container">
        <div class="radar-core">
            <i class="fas fa-car radar-core-icon"></i>
        </div>

        <!-- Fast Radar Rings -->
        <div class="radar-ring radar-ring-1"></div>
        <div class="radar-ring radar-ring-2"></div>
        <div class="radar-ring radar-ring-3"></div>

        <!-- Fast Sweep -->
        <div class="radar-sweep"></div>

        <!-- Surrounding Icons -->
        <i class="fas fa-car radar-node radar-node-1"></i>
        <i class="fas fa-car radar-node radar-node-2"></i>
        <i class="fas fa-car radar-node radar-node-3"></i>
        <i class="fas fa-car radar-node radar-node-4"></i>
    </div>

    <!-- Text Pill -->
    <div class="loader-pill">
        <i class="fas fa-circle-notch fa-spin loader-spin"></i>
        <span id="moreDriversText" class="loader-text">Scanning for nearby drivers...</span>
    </div>
</div>
                `);

                const phrases = [
                    'Scanning for nearby drivers...',
                    'Drivers are reviewing your request...',
                    'Hold tight, matching you now...',
                    'Alerting top-rated drivers...',
                    'Drivers getting ready...',
                    'Optimizing best matches...',
                    'Please wait, we found nearby drivers!',
                    'We are sending trip details directly to active drivers in your area.',
                    'Sending priority reminders to available nearby drivers.',
                    'Drivers are bidding on your ride request'
                ];
                let currentPhraseIndex = 0;
                setInterval(() => {
                    const textEl = $('#moreDriversText');
                    textEl.css('opacity', 0);
                    setTimeout(() => {
                        let newIndex;
                        do {
                            newIndex = Math.floor(Math.random() * phrases.length);
                        } while (newIndex === currentPhraseIndex && phrases.length > 1);
                        currentPhraseIndex = newIndex;
                        textEl.text(phrases[currentPhraseIndex]);
                        textEl.css('opacity', 1);
                    }, 400);
                }, 1500);
            }

            $('#findingDriversLoader').hide();
            $('#driverList').show();
            $('#moreDriversLoader').css('display', 'flex');

            // Setup Firebase Listener
            if (typeof firebase === 'undefined') {
                console.error("Firebase library is not loaded.");
                return;
            }

            if (!firebase.apps.length && firebaseConfig) {
                try {
                    firebase.initializeApp(firebaseConfig);
                    _firebaseAuthObj = firebase.auth();
                } catch (e) {
                    console.error("Error initializing Firebase:", e);
                }
            } else if (!firebase.apps.length) {
                console.error("Firebase is not initialized and no config provided.");
                return;
            }

            if (!_firebaseAuthObj) {
                _firebaseAuthObj = firebase.auth();
            }

            // Helper: attach the Firestore listener once authenticated
            function attachFirestoreListener() {
                const targetJobNo = String(bookingData.job_no || bookingData.bookingId || bookingData.jobId || bookingData.job_id || BookingStore.getState().job_no || BookingStore.getState().bookingId || '').trim();
                if (!targetJobNo) {
                    console.error("No valid booking job_no found to listen for bids.");
                    return;
                }

                const db = firebase.firestore();

                if (driversListener) {
                    driversListener(); // Unsubscribe previous snapshot
                }

                const collectionName = '{{ env("FIREBASE_COLLECTION", "uk_dev_jobs") }}';
                console.log(`[Firebase] Attaching listener to collection: "${collectionName}", doc: "${targetJobNo}"`);

                driversListener = db.collection(collectionName).doc(targetJobNo)
                    .onSnapshot((doc) => {
                        console.log(`[Firebase] Snapshot received for doc: "${doc.id}", exists: ${doc.exists}`);
                        if (doc.exists) {
                            const data = doc.data() || {};
                            console.log('[Firebase] Document data:', data);

                            const realJobNo = data.job_no || data.booking_no || doc.id || bookingData.job_no;
                            const realJobId = data.job_id || data.jd || bookingData.jobId;

                            if (realJobNo && typeof realJobNo === 'string') {
                                BookingStore.setState({
                                    job_no: realJobNo,
                                    bookingId: realJobNo
                                });
                            }
                            if (realJobId) {
                                BookingStore.setState({
                                    jobId: realJobId,
                                    job_id: realJobId
                                });
                            }

                            if (data.status === 'cancel' || data.status === 'cancelled') {
                                if (BookingStore.getState().currentStep < 5) {
                                    showToast('Booking already cancelled or no more', 'error');
                                    setTimeout(() => { window.location.reload(); }, 2000);
                                }
                                return;
                            }
                            renderRealtimeDrivers(data.bids_details || {});
                        } else {
                            console.warn(`[Firebase] Document "${targetJobNo}" does not exist in collection "${collectionName}".`);
                            renderRealtimeDrivers({});
                            if (BookingStore.getState().currentStep < 5) {
                                showToast('Booking already cancelled or no more', 'error');
                                setTimeout(() => { window.location.reload(); }, 2000);
                            }
                        }
                    }, (error) => {
                        console.error("[Firebase] Error listening to bids: ", error);
                    });
            }

            // Use signInWithCustomToken directly (avoid onAuthStateChanged race condition)
            if (firebaseCustomToken) {
                // Check if already signed in with the same token
                const currentUser = _firebaseAuthObj.currentUser;
                if (currentUser) {
                    console.log("Firebase already authenticated. Attaching Firestore listener.");
                    attachFirestoreListener();
                } else {
                    console.log("Authenticating Firebase silently with custom token...");
                    _firebaseAuthObj.signInWithCustomToken(firebaseCustomToken)
                        .then((userCredential) => {
                            console.log("Firebase sign-in successful. Attaching Firestore listener.");
                            attachFirestoreListener();
                        })
                        .catch((error) => {
                            console.error("Failed to sign in with custom token:", error);
                            // If token is expired or invalid, fetch a new one silently
                            if (error.code === 'auth/invalid-custom-token') {
                                console.log("Token expired. Fetching a new custom token...");
                                fetch(API_BASE_URL + '/refresh-firebase-token', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'Accept': 'application/json',
                                        'Authorization': 'Bearer ' + getCookieValue('auth_token')
                                    },
                                    body: JSON.stringify({
                                        job_id: bookingData.jobId,
                                        c_mobile: bookingData.passengerPhone || ''
                                    })
                                })
                                    .then(res => res.json())
                                    .then(data => {
                                        if (data.status && data.firebase_custom_token) {
                                            console.log("New token received. Retrying sign in...");
                                            BookingStore.setState({ firebaseCustomToken: data.firebase_custom_token });

                                            _firebaseAuthObj.signInWithCustomToken(data.firebase_custom_token)
                                                .then(() => {
                                                    console.log("Re-authentication successful. Attaching listener.");
                                                    attachFirestoreListener();
                                                })
                                                .catch(err => console.error("Re-authentication failed:", err));
                                        } else {
                                            console.error("Failed to refresh token:", data.message);
                                        }
                                    })
                                    .catch(err => console.error("Error fetching refreshed token:", err));
                            }
                        });
                }
            } else {
                // Fallback: wait for existing auth state
                _authStateUnsubscribe = _firebaseAuthObj.onAuthStateChanged((user) => {
                    if (user) {
                        console.log("Firebase user authenticated via state. Attaching listener.");
                        attachFirestoreListener();
                        // Unsubscribe after first authenticated state
                        if (_authStateUnsubscribe) {
                            _authStateUnsubscribe();
                            _authStateUnsubscribe = null;
                        }
                    } else {
                        console.error("Firebase user is not authenticated. Cannot listen for bids.");
                    }
                });
            }
        }

        function renderRealtimeDrivers(bidsDetails) {
            bidsDetails = bidsDetails || {};
            const grid = $('#driverList');
            const incomingKeys = new Set(Object.keys(bidsDetails));

            // Remove drivers whose bids were deleted/removed from Firebase
            existingRenderedDrivers.forEach(key => {
                if (!incomingKeys.has(key)) {
                    existingRenderedDrivers.delete(key);
                    const driverElem = $(`#driver-bid-${key}`);
                    if (driverElem.length) {
                        driverElem.slideUp(300, function () {
                            $(this).remove();
                        });
                    }
                }
            });

            incomingKeys.forEach(key => {
                if (!existingRenderedDrivers.has(key)) {
                    existingRenderedDrivers.add(key);
                    const bid = bidsDetails[key];

                    const d = {
                        id: key,
                        name: bid.b_name || 'Driver',
                        rating: bid.b_rating || '4.2',
                        trips: '100+',
                        experience: 'Pro',
                        bid: bid.show_amount || 0,
                        eta: '5 mins',
                        avatar: `<img src="${bid.b_image || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(bid.b_name || 'Driver') + '&background=f5c00b&color=000'}" alt="${bid.b_name || 'Driver'}" style="width:100%;height:100%;object-fit:cover;">`,
                        mobile: bid.b_mobile || '',
                        carName: bid.b_cab || null,
                        childSeat: bid.b_child || 0,
                        b_child: bid.b_child || 0,
                        carCapacity: bid.b_seater || null,
                        carLuggage: bid.b_luggage || null,
                        isTax: bid.isTax === true || bid.isTax === 'true'
                    };

                    let vehicleName = bid.b_cab || bookingData.vehicle?.name || 'Standard';
                    const vehicleCapacity = bid.b_seater || bookingData.vehicle?.capacity || 4;
                    const vehicleLuggage = bid.b_luggage || bookingData.vehicle?.luggage || 2;
                    let vehicleImg = bookingData.vehicle?.image || `${GORIDE_IMG_PREFIX}saloon.png`;

                    if (bid.b_cab) {
                        const vKey = bid.b_cab.toLowerCase().replace(/\s+/g, '');
                        const nameMap = {
                            'standard': 'Standard',
                            'estate': 'Estate',
                            'executive': 'Executive',
                            'mpv': 'MPV',
                            'mpv5': 'MPV 5',
                            'mpv6': 'MPV 6',
                            'mpv6l': 'MPV 6 Luxury',
                            'mpv7': 'MPV 7',
                            'mpv7l': 'MPV 7 Luxury',
                            'mpv8': 'MPV 8',
                            'mpv8l': 'MPV 8 Luxury'
                        };
                        if (nameMap[vKey]) {
                            vehicleName = nameMap[vKey];
                        } else {
                            vehicleName = bid.b_cab.charAt(0).toUpperCase() + bid.b_cab.slice(1);
                        }
                        vehicleImg = `${GORIDE_IMG_PREFIX}${vKey}.webp`;
                    }

                    const driverJson = JSON.stringify(d).replace(/"/g, '&quot;');

                    const fare = bookingData.vehicle?.fareBreakdown || {};
                    const rawInclusions = fare.included_list || fare.inclusions || fare.included || [];
                    const inclusionsList = Array.isArray(rawInclusions)
                        ? rawInclusions
                        : (typeof rawInclusions === 'string' ? (() => { try { return JSON.parse(rawInclusions); } catch (e) { return [rawInclusions]; } })() : []);

                    const inclusionsHtml = (inclusionsList && inclusionsList.length > 0) ?
                        inclusionsList.map(inc => {
                            const text = typeof inc === 'object' && inc !== null ? (inc.name || inc.text || inc.title || inc.value || JSON.stringify(inc)) : String(inc || '');
                            const icon = (typeof inc === 'object' && inc !== null && inc.icon) ? inc.icon : getInclusionIcon(text);
                            return `<li class="tab-point-item"><i class="fas ${icon} point-icon point-icon-check"></i><div>${text}</div></li>`;
                        }).join('') :
                        `<li class="tab-point-item" style="grid-column: 1 / -1; color: #6b7280;"><i class="fas fa-info-circle point-icon" style="color: #6b7280;"></i><div>No additional inclusions are included in this fare.</div></li>`;

                    const rawExclusions = fare.excluded_list || fare.exclusions || fare.excluded || [];
                    const exclusionsList = Array.isArray(rawExclusions)
                        ? rawExclusions
                        : (typeof rawExclusions === 'string' ? (() => { try { return JSON.parse(rawExclusions); } catch (e) { return [rawExclusions]; } })() : []);

                    const exclusionsHtml = (exclusionsList && exclusionsList.length > 0) ?
                        exclusionsList.map(exc => {
                            const text = typeof exc === 'object' && exc !== null ? (exc.name || exc.text || exc.title || exc.value || JSON.stringify(exc)) : String(exc || '');
                            return `<li class="tab-point-item"><i class="fas fa-times point-icon point-icon-cross"></i><div>${text}</div></li>`;
                        }).join('') :
                        `<li class="tab-point-item" style="grid-column: 1 / -1; color: #6b7280;"><i class="fas fa-info-circle point-icon" style="color: #6b7280;"></i><div>No extra exclusions specified for this fare.</div></li>`;

                    const taxHtml = d.isTax ? `
            <div class="tax-ribbon-wrapper">
                <div class="tax-ribbon-fold"></div>
                <div class="tax-ribbon-body">
                    Tax (VAT 20%)<br>Included
                </div>
            </div>
                    ` : '';

                    const html = `
<div class="driver-item driver-card" id="driver-bid-${key}" style="display:none; margin-bottom:15px; position:relative;">
    ${taxHtml}
    <div class="driver-info">
        <div class="driver-details">
            <div class="driver-header">
                 <div class="driver-car-banner">
                    <img src="${vehicleImg}" alt="${vehicleName}">
                    <div class="driver-car-banner-details">
                        <div class="driver-car-banner-name">${vehicleName}</div>
                        <div class="driver-car-banner-meta">
                            <span><i class="fas fa-user"></i> ${vehicleCapacity}</span>
                            <span><i class="fas fa-suitcase"></i> ${vehicleLuggage}</span>
                        </div>
                    </div>
                </div>
                <div class="driver-wrap">
                    <div class="driver-avatar-info-row">
                        <div class="driver-avatar">
                            ${d.avatar}
                        </div>
                        <div class="driver-meta-info">
                            <h4>${d.name}</h4>
                            <div class="driver-static-label">Driver</div>
                        </div>
                    </div>
                    <div class="driver-review-link-wrapper">
                        <a href="javascript:void(0)" onclick="openDriverReview(${driverJson})" class="driver-review-link">
                            <i class="fas fa-external-link-alt me-1"></i> Click to view more
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="driver-bid-box">
            <div class="driver-price-col" style="display: flex; flex-direction: column; align-items: flex-end; justify-content: flex-end;">
                <div class="driver-price-row" style="margin-bottom: 0;">
                    <div class="bid-amount">
                        £${d.bid}
                    </div>
                </div>
            </div>
         
            <button onclick="acceptDriverFromList(${driverJson}, this)" class="driver-accept-btn">
    <i class="fas fa-check me-1"></i>Review & Pay
</button>
        </div>
    </div>
    <!-- Accordion Section -->
    <div class="vehicle-accordion" style="display: none;" onclick="event.stopPropagation();">
        <button type="button" class="accordion-toggle" onclick="toggleVehicleAccordion(this)">
            <span class="acc-text">View Inclusions & Exclusions</span> <i class="fas fa-chevron-down ms-1"></i>
        </button>
        <div class="premium-tab-container">
            <div class="accordion-content">
                <div class="accordion-tabs">
                    <button type="button" class="tab-btn active" onclick="switchVehicleTab(this, 'inclusions')"><i class="fas fa-check-circle tab-icon-check"></i> Inclusions</button>
                    <button type="button" class="tab-btn" onclick="switchVehicleTab(this, 'exclusions')"><i class="fas fa-times-circle tab-icon-cross"></i> Exclusions</button>
                </div>
                <div class="tab-pane inclusions-pane active">
                    <ul class="tab-points-list inclusions-list">
                        ${inclusionsHtml}
                    </ul>
                </div>
                <div class="tab-pane exclusions-pane" style="display:none;">
                    <ul class="tab-points-list exclusions-list">
                        ${exclusionsHtml}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>`;
                    const newElem = $(html);
                    grid.append(newElem);
                    newElem.slideDown(400);
                } else {
                    const bid = bidsDetails[key];
                    const driverElem = $(`#driver-bid-${key}`);
                    if (driverElem.length) {
                        const newAmount = bid.show_amount || 0;
                        const currentAmountText = driverElem.find('.bid-amount').text().trim();
                        if (currentAmountText !== '£' + newAmount) {
                            driverElem.find('.bid-amount').text('£' + newAmount);

                            const d = {
                                id: key,
                                name: bid.b_name || 'Driver',
                                rating: bid.b_rating || '4.9',
                                trips: '100+',
                                experience: 'Pro',
                                bid: newAmount,
                                eta: '5 mins',
                                avatar: `<img src="${bid.b_image || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(bid.b_name || 'Driver') + '&background=f5c00b&color=000'}" alt="${bid.b_name || 'Driver'}" style="width:100%;height:100%;object-fit:cover;">`,
                                mobile: bid.b_mobile || '',
                                carName: bid.b_cab || null,
                                carCapacity: bid.b_seater || null,
                                carLuggage: bid.b_luggage || null
                            };
                            const driverJson = JSON.stringify(d).replace(/"/g, '&quot;');
                            const rawDriverJson = JSON.stringify(d);
                            driverElem.find('.driver-accept-btn').attr('onclick', `acceptDriverFromList(${rawDriverJson}, this)`);
                            driverElem.find('.driver-review-link').attr('onclick', `openDriverReview(${rawDriverJson})`);

                            const priceElem = driverElem.find('.bid-amount');
                            priceElem.css({ 'color': '#28a745', 'transition': 'color 0.3s ease' });
                            setTimeout(() => {
                                priceElem.css('color', '');
                            }, 800);
                        }
                    }
                }
            });
        }
        function proceedToOTP() {
            $('#otpModal').addClass('show');
            $('#otpInput').focus();
        }
        function requestOTP() {
            $('#otpModal').addClass('show');
            $('#otpInput').focus();
        }
        function verifyOtp() {
            const otp = $('#otpInput').val();
            if (otp.length !== 4) {
                showToast("Enter valid OTP", 'error');
                return;
            }
            closeModal('otpModal');
            $('#personalInfoSection').hide();
            $('#personalInfoBtns').hide();
            $('#additionalBookingDetails').show();
            $('#additionalDetailsBtns').css('display', 'flex');
        }
        function updatePaymentSummary() {
            const baseFare = bookingData.vehicle ? bookingData.vehicle.price : 45;
            const isMeetGreet = $('#meetGreet').is(':checked');
            const meetGreetPrice = isMeetGreet ? 10 : 0;
            bookingData.meetAndGreet = isMeetGreet;
            const isChildSeat = $('#carSeatCheckbox').is(':checked');
            const childSeatCount = parseInt($('#childSeatCount').val() || 1);
            const childSeatPrice = 5;
            const totalChildSeat = isChildSeat ? (childSeatCount * childSeatPrice) : 0;
            let totalFare = baseFare + totalChildSeat + meetGreetPrice;
            $('#rideFare').text('\u00a3' + baseFare.toFixed(2));
            if (isChildSeat) {
                $('#childSeatRow').css('display', 'flex');
                $('#childSeatPriceDisplay').text('\u00a3' + totalChildSeat.toFixed(2));
            } else {
                $('#childSeatRow').hide();
            }
            if (isMeetGreet) {
                $('#meetGreetRow').css('display', 'flex');
                $('#meetGreetPriceDisplay').text('\u00a310.00');
            } else {
                $('#meetGreetRow').hide();
            }
            $('#totalFare').text('\u00a3' + totalFare.toFixed(2));
        }
        function renderDrivers() {
            const grid = $('#driverList');
            grid.html('');
            const vehicle = bookingData.vehicle;
            const vehicleImg = vehicle?.image || `${GORIDE_IMG_PREFIX}saloon.png`;
            const vehicleName = vehicle?.name || 'Standard';
            const vehicleCapacity = vehicle?.capacity || 4;
            const vehicleLuggage = vehicle?.luggage || 2;
            const vehiclePrice = vehicle?.price || '-';
            const vehiclePriceMax = vehicle?.priceMax || '';
            const priceDisplay = vehiclePriceMax ? `£${vehiclePrice} – £${vehiclePriceMax}` : `£${vehiclePrice}`;
            const fare = bookingData.vehicle?.fareBreakdown || {};
            const rawInclusions = fare.included_list || fare.inclusions || fare.included || [];
            const inclusionsList = Array.isArray(rawInclusions)
                ? rawInclusions
                : (typeof rawInclusions === 'string' ? (() => { try { return JSON.parse(rawInclusions); } catch (e) { return [rawInclusions]; } })() : []);

            const inclusionsHtml = (inclusionsList && inclusionsList.length > 0) ?
                inclusionsList.map(inc => {
                    const text = typeof inc === 'object' && inc !== null ? (inc.name || inc.text || inc.title || inc.value || JSON.stringify(inc)) : String(inc || '');
                    const icon = (typeof inc === 'object' && inc !== null && inc.icon) ? inc.icon : getInclusionIcon(text);
                    return `<li class="tab-point-item"><i class="fas ${icon} point-icon point-icon-check"></i><div>${text}</div></li>`;
                }).join('') :
                `<li class="tab-point-item" style="grid-column: 1 / -1; color: #6b7280;"><i class="fas fa-info-circle point-icon" style="color: #6b7280;"></i><div>No additional inclusions are included in this fare.</div></li>`;

            const rawExclusions = fare.excluded_list || fare.exclusions || fare.excluded || [];
            const exclusionsList = Array.isArray(rawExclusions)
                ? rawExclusions
                : (typeof rawExclusions === 'string' ? (() => { try { return JSON.parse(rawExclusions); } catch (e) { return [rawInclusions]; } })() : []);

            const exclusionsHtml = (exclusionsList && exclusionsList.length > 0) ?
                exclusionsList.map(exc => {
                    const text = typeof exc === 'object' && exc !== null ? (exc.name || exc.text || exc.title || exc.value || JSON.stringify(exc)) : String(exc || '');
                    return `<li class="tab-point-item"><i class="fas fa-times point-icon point-icon-cross"></i><div>${text}</div></li>`;
                }).join('') :
                `<li class="tab-point-item" style="grid-column: 1 / -1; color: #6b7280;"><i class="fas fa-info-circle point-icon" style="color: #6b7280;"></i><div>No extra exclusions specified for this fare.</div></li>`;

            drivers.forEach(d => {
                const driverJson = JSON.stringify(d).replace(/"/g, '&quot;');

                const taxHtml = d.isTax ? `
        <div class="tax-ribbon-wrapper">
            <div class="tax-ribbon-fold"></div>
            <div class="tax-ribbon-body">
                Tax (VAT 20%)<br>Included
            </div>
        </div>
                ` : '';

                const html = `
<div class="driver-item driver-card" style="position:relative;">
    ${taxHtml}
    <!-- Car Banner -->
    <div class="driver-info">
        <div class="driver-details">
            <div class="driver-header">
                 <div class="driver-car-banner">
        <img src="${vehicleImg}" alt="${vehicleName}">
        <div class="driver-car-banner-details">
            <div class="driver-car-banner-name">${vehicleName}</div>
              <div class="driver-car-banner-meta">
                <span><i class="fas fa-user"></i> ${vehicleCapacity}</span>
                <span><i class="fas fa-suitcase"></i> ${vehicleLuggage}</span>
            </div>
        </div>
    </div>
                <div class="driver-wrap">
                    <div class="driver-avatar-info-row">
                        <div class="driver-avatar">
                            ${d.avatar}
                        </div>
                        <div class="driver-meta-info">
                            <h4>${d.name}</h4>
                            <div class="driver-static-label">Driver</div>
                        </div>
                    </div>
                    <div class="driver-review-link-wrapper">
                        <a href="javascript:void(0)" onclick="openDriverReview(${driverJson})" class="driver-review-link"><i class="fas fa-external-link-alt me-1"></i> Click to view more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="driver-bid-box">
            <div class="driver-price-col" style="display: flex; flex-direction: column; align-items: flex-end; justify-content: flex-end;">
                <div class="driver-price-row" style="margin-bottom: 0;">
                    <div class="bid-amount">
                        £${d.bid}
                    </div>
                </div>
                <div class="bid-eta" style="margin-top: 0;">
                    <i class="fas fa-clock"></i>
                    ${d.eta} away
                </div>
            </div>
            <button onclick="acceptDriverFromList(${driverJson}, this)" style="width:100%;     padding: 6px 10px; background:#111; color:#fff; border:none; border-radius:6px; font-size:14px; font-weight:600;cursor:pointer;" onmouseover="this.style.background='#000'" onmouseout="this.style.background='#111'"><i class="fas fa-check me-1"></i> Accept</button>
        </div>
    </div>
    <!-- Accordion Section -->
    <div class="vehicle-accordion" style="display: none;" onclick="event.stopPropagation();">
        <button type="button" class="accordion-toggle" onclick="toggleVehicleAccordion(this)">
            <span class="acc-text">View Inclusions & Exclusions</span> <i class="fas fa-chevron-down ms-1"></i>
        </button>
        <div class="premium-tab-container">
            <div class="accordion-content">
                <div class="accordion-tabs">
                    <button type="button" class="tab-btn active" onclick="switchVehicleTab(this, 'inclusions')"><i class="fas fa-check-circle tab-icon-check"></i> Inclusions</button>
                    <button type="button" class="tab-btn" onclick="switchVehicleTab(this, 'exclusions')"><i class="fas fa-times-circle tab-icon-cross"></i> Exclusions</button>
                </div>
                <div class="tab-pane inclusions-pane active">
                    <ul class="tab-points-list inclusions-list">
                        ${inclusionsHtml}
                    </ul>
                </div>
                <div class="tab-pane exclusions-pane" style="display:none;">
                    <ul class="tab-points-list exclusions-list">
                        ${exclusionsHtml}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
`;
                grid.append(html);
            });
        }
        function openDriverReview(driver) {
            bookingData.selectedDriver = driver;
            const vehicle = bookingData.vehicle;
            const vehicleImg = bookingData.vehicle?.image || `${GORIDE_IMG_PREFIX}fleet1.png`;
            let vehicleName = driver.carName || bookingData.vehicle?.name || '-';
            if (driver.carName) {
                const vKey = driver.carName.toLowerCase().replace(/\s+/g, '');
                const nameMap = {
                    'standard': 'Standard',
                    'estate': 'Estate',
                    'executive': 'Executive',
                    'mpv': 'MPV',
                    'mpv5': 'MPV 5',
                    'mpv6': 'MPV 6',
                    'mpv6l': 'MPV 6 Luxury',
                    'mpv7': 'MPV 7',
                    'mpv7l': 'MPV 7 Luxury',
                    'mpv8': 'MPV 8',
                    'mpv8l': 'MPV 8 Luxury'
                };
                if (nameMap[vKey]) {
                    vehicleName = nameMap[vKey];
                } else {
                    vehicleName = driver.carName.charAt(0).toUpperCase() + driver.carName.slice(1);
                }
            }
            const vehiclePrice = bookingData.vehicle?.price || driver.bid;
            $('#rcDriverAvatar').html(driver.avatar);
            $('#rcDriverName').text(driver.name);
            // const rating = parseFloat(driver.rating);
            // let starsHtml = '';
            // for (let i = 1; i <= 5; i++) {
            //     starsHtml += `<i class="fas fa-star" style="color:${i <= Math.round(rating) ? '#f59e0b' : '#ddd'}"></i>`;
            // }
            // starsHtml += `<span>${rating}</span>`;
            // $('#rcDriverStars').html(starsHtml);
            if (driver.badge) {
                $('#rcDriverBadge').text(driver.badge).show();
            } else {
                $('#rcDriverBadge').hide();
            }
            $('#rcCarImage').attr('src', vehicleImg);
            $('#rcFareAmount').text('£' + (driver.bid || vehiclePrice));
            $('.rc-vehicle-name-block h4').text(vehicleName);
            $('#rcPassengerCapacity').text(driver.carCapacity || vehicle?.capacity || 8);
            $('#rcLuggageCapacity').text(driver.carLuggage || vehicle?.luggage || 8);
            $('#rcChildSeatCapacity').text(driver.b_child !== undefined && driver.b_child !== null ? driver.b_child : (driver.childSeat !== undefined && driver.childSeat !== null ? driver.childSeat : 0));
            $('#rcTransmission').text(vehicle?.transmission || 'Automatic');

            const tagVal = vehicle?.tag || driver.tag || (driver.badge ? driver.badge : null);
            if (tagVal) {
                $('#rcVehicleTag').text(tagVal).show();
            } else {
                $('#rcVehicleTag').hide();
            }

            // Premium full-card skeleton setup
            $('#step7').addClass('rc-loading-skeleton');

            const amenitiesGrid = $('#rcVehicleAmenitiesGrid');
            amenitiesGrid.empty();
            if (vehicle.amenities) {
                vehicle.amenities.filter(am => {
                    if (am.toLowerCase().includes('seat')) {
                        return vehicle.child > 0;
                    }
                    return true;
                }).forEach(am => {
                    let icon = 'fa-check';
                    let label = am;
                    if (am.toLowerCase().includes('wifi')) { icon = 'fa-wifi'; label = 'Wi-Fi'; }
                    else if (am.toLowerCase().includes('air con') || am.toLowerCase().includes('a/c')) { icon = 'fa-snowflake'; label = 'A/C'; }
                    else if (am.toLowerCase().includes('charg')) { icon = 'fa-usb'; label = 'USB Charger'; }
                    else if (am.toLowerCase().includes('water')) { icon = 'fa-bottle-water'; label = 'Water'; }
                    else if (am.toLowerCase().includes('child seat')) { icon = 'fa-baby-carriage'; label = 'Child Seat'; }

                    amenitiesGrid.append(`
                        <div class="rc-amenity-box">
                            <i class="fas ${icon}"></i>
                            <span>${label}</span>
                        </div>
                    `);
                });
            }

            // Fetch dynamic driver vehicle data
            $.ajax({
                url: API_BASE_URL + '/driver-vehicle',
                type: 'GET',
                data: { user_id: driver.id },
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + getCookieValue('auth_token')
                },
                success: function (res) {
                    if (res && res.status && res.data) {
                        const uid = driver.id;
                        if (res.data.vehicle && res.data.vehicle[uid]) {
                            const vDetails = res.data.vehicle[uid];
                            const pImages = [
                                vDetails.front_view_image_url,
                                vDetails.back_view_image_url,
                                vDetails.side_view_image_url,
                                vDetails.car_top_view_image_url,
                                vDetails.interior_front_image_url,
                                vDetails.interior_rear_image_url,
                                vDetails.extra_image_1_url,
                                vDetails.extra_image_2_url,
                                vDetails.special_features_image_url
                            ];
                            dynamicCarImages = pImages.filter(url => url && typeof url === 'string' && url.trim() !== "");
                            if (dynamicCarImages.length > 0) {
                                totalCarImages = dynamicCarImages.length;
                                currentRcCarImageIndex = 1;
                                $('#rcCarImage').attr('src', dynamicCarImages[0]);

                                // Render thumbnails dynamically
                                let thumbHtml = '';
                                dynamicCarImages.forEach((url, idx) => {
                                    let borderStr = (idx === 0) ? '2px solid #f5c00b' : '2px solid transparent';
                                    thumbHtml += `<img src="${url}" onclick="setCarImageIndex(${idx + 1})" class="car-thumbnail" style="width: 60px; height: 45px; object-fit: cover; border-radius: 4px; cursor: pointer; border: ${borderStr};">`;
                                });
                                $('#carThumbnailsContainer').html(thumbHtml);
                            } else {
                                dynamicCarImages = [];
                                totalCarImages = 4; // fallback
                            }
                        }
                        if (res.data.user_details && res.data.user_details[uid]) {
                            const uDetails = res.data.user_details[uid];
                            if (uDetails.name) $('#rcDriverName').text(uDetails.name);
                            if (uDetails.exp) $('#rcDriverExperience').text(uDetails.exp);
                            if (uDetails.completed_jobs !== undefined && uDetails.completed_jobs !== null) {
                                $('#rcDriverTrips').text(uDetails.completed_jobs);
                            }
                            if (uDetails.review) $('#rcDriverReviewsPct').text(uDetails.review + '%');

                            if (uDetails.profile_image_url) {
                                $('#rcDriverAvatar').html(`<img src="${uDetails.profile_image_url}" style="width:100%;height:100%;object-fit:cover;">`);
                            } else {
                                $('#rcDriverAvatar').html(`<img src="https://ui-avatars.com/api/?name=${encodeURIComponent(uDetails.name || driver.name || 'Driver')}&background=f5c00b&color=000" style="width:100%;height:100%;object-fit:cover;">`);
                            }
                        }
                        if (res.data.rc_number && res.data.rc_number[uid]) {
                            // Update RC number if there's an element for it
                            if ($('#rcVehicleRcNumber').length) {
                                $('#rcVehicleRcNumber').text(res.data.rc_number[uid]).show();
                            }
                        }
                    }
                },
                error: function (err) {
                    console.error("Failed to load driver vehicle data", err);
                    // Fallback to static text on error
                    $('#rcDriverExperience').text(driver.experience || '6+ Years');
                    $('#rcDriverTrips').text(driver.trips || '2,145');
                    $('#rcDriverReviewsPct').text(driver.positiveReviews || '98%');
                },
                complete: function () {
                    // Remove premium skeleton
                    $('#step7').removeClass('rc-loading-skeleton');
                }
            });

            showStep(7);
            startRcCarCarousel();
        }
        window.renderPaymentBreakdownUI = function (breakdownData) {
            const state = typeof BookingStore !== 'undefined' ? BookingStore.getState() : {};
            const bd = breakdownData || state.paymentBreakdown || {};

            const baseFare = parseFloat(bd.base_fare !== undefined && bd.base_fare !== null ? bd.base_fare : (state.base_fare !== undefined && state.base_fare !== null ? state.base_fare : (state.vehicle ? state.vehicle.price || state.vehicle.fare || 0 : 0)));
            const tax = parseFloat(bd.tax !== undefined && bd.tax !== null ? bd.tax : (state.tax !== undefined && state.tax !== null ? state.tax : 0));
            const firstAmt = parseFloat(bd.firstAmt !== undefined && bd.firstAmt !== null ? bd.firstAmt : (state.firstAmt !== undefined && state.firstAmt !== null ? state.firstAmt : 0));
            const totalFare = parseFloat(bd.total_fare !== undefined && bd.total_fare !== null ? bd.total_fare : (bd.actual_total_fare !== undefined && bd.actual_total_fare !== null ? bd.actual_total_fare : (state.total_fare !== undefined && state.total_fare !== null ? state.total_fare : (baseFare + tax - firstAmt))));
            const partFare = parseFloat(bd.part_pay_fare !== undefined && bd.part_pay_fare !== null ? bd.part_pay_fare : (state.part_pay_fare !== undefined && state.part_pay_fare !== null ? state.part_pay_fare : (totalFare * 0.20)));

            if (totalFare > 0) window.paymentTotalFare = totalFare;
            if (partFare > 0) window.paymentPartPayFare = partFare;

            $('#pbBaseFare').text('£' + baseFare.toFixed(2));
            $('#pbTax').text('£' + tax.toFixed(2));

            // Meet & greet is removed from the fare breakdown UI per updated logic
            $('#pbMeetGreetRow').hide();

            if (firstAmt > 0) {
                $('#pbFirstDiscount').text('-£' + firstAmt.toFixed(2));
                $('#pbFirstDiscountRow').show();
            } else {
                $('#pbFirstDiscountRow').hide();
            }

            $('#pbTotalFare').text('£' + totalFare.toFixed(2));
            $('#dynamicIncludedMiles').text(`${bookingData.apiDistance || state.apiDistance || 360} miles`);

            if (typeof updateStripeTypeAmounts === 'function') {
                updateStripeTypeAmounts();
            }

            // Dynamically render Inclusions & Exclusions from fare breakdown response
            try {
                const rawInclusions = bd.inclusion || bd.inclusions || bd.included_list || bd.included || [];
                const inclusionsList = Array.isArray(rawInclusions) ? rawInclusions : (typeof rawInclusions === 'string' ? (() => { try { return JSON.parse(rawInclusions); } catch (e) { return [rawInclusions]; } })() : []);
                if (inclusionsList && inclusionsList.length > 0 && typeof getInclusionIcon === 'function') {
                    const incHtml = inclusionsList.map(inc => {
                        const text = typeof inc === 'object' && inc !== null ? (inc.name || inc.text || inc.title || inc.value || JSON.stringify(inc)) : String(inc || '');
                        const icon = (typeof inc === 'object' && inc !== null && inc.icon) ? inc.icon : getInclusionIcon(text);
                        return `<div class="tab-point-item"><i class="fas ${icon} point-icon point-icon-check"></i><div>${text}</div></div>`;
                    }).join('');
                    $('#paymentInclusionsList, #step6 .inclusions-pane .tab-points-list').html(incHtml);
                } else {
                    $('#paymentInclusionsList, #step6 .inclusions-pane .tab-points-list').html(
                        `<div class="tab-point-item" style="grid-column: 1 / -1; color: #6b7280;"><i class="fas fa-info-circle point-icon" style="color: #6b7280;"></i><div>No additional inclusions are included in this fare.</div></div>`
                    );
                }

                const rawExclusions = bd.exclusion || bd.exclusions || bd.excluded_list || bd.excluded || [];
                const exclusionsList = Array.isArray(rawExclusions) ? rawExclusions : (typeof rawExclusions === 'string' ? (() => { try { return JSON.parse(rawExclusions); } catch (e) { return [rawExclusions]; } })() : []);
                if (exclusionsList && exclusionsList.length > 0) {
                    const excHtml = exclusionsList.map(exc => {
                        const text = typeof exc === 'object' && exc !== null ? (exc.name || exc.text || exc.title || exc.value || JSON.stringify(exc)) : String(exc || '');
                        return `<div class="tab-point-item"><i class="fas fa-times point-icon point-icon-cross"></i><div>${text}</div></div>`;
                    }).join('');
                    $('#paymentExclusionsList, #step6 .exclusions-pane .tab-points-list').html(excHtml);
                } else {
                    $('#paymentExclusionsList, #step6 .exclusions-pane .tab-points-list').html(
                        `<div class="tab-point-item" style="grid-column: 1 / -1; color: #6b7280;"><i class="fas fa-info-circle point-icon" style="color: #6b7280;"></i><div>No extra exclusions specified for this fare.</div></div>`
                    );
                }
            } catch (err) {
                console.error('Error rendering payment breakdown inclusions:', err);
            }

            $('#dynamicPaymentSummary').show();
        };

        async function proceedToPaymentWithDriver(driver, btnElement) {
            bookingData.selectedDriver = driver;

            if (typeof resetStripePayment === 'function') {
                resetStripePayment();
            }

            let originalText = '';
            let $btn = null;
            if (btnElement) {
                $btn = $(btnElement);
                originalText = $btn.html();
                $btn.html('<i class="fas fa-spinner fa-spin"></i> Processing...');
                $btn.prop('disabled', true);
            }

            const payload = {
                job_id: bookingData.jobId || bookingData.job_id || '',
                job_no: bookingData.job_no || bookingData.bookingId || '',
                user_id: driver.id || '',
                date: bookingData.date || '',
                isCredit: 'no',
                payType: 'full',
                isWallet: 'no'
            };

            try {
                const response = await fetch(API_BASE_URL + '/w-payment-break-down', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getCookieValue('auth_token')
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();
                if (data.status === true && data.data) {
                    if (data.data.total_fare !== undefined) window.paymentTotalFare = parseFloat(data.data.total_fare);
                    if (data.data.part_pay_fare !== undefined) window.paymentPartPayFare = parseFloat(data.data.part_pay_fare);
                    const pId = data.data.payment_id || data.data.id || data.payment_id || data.id;
                    if (pId) window.paymentId = parseInt(pId);

                    BookingStore.setState({
                        paymentBreakdown: data.data,
                        base_fare: data.data.base_fare,
                        tax: data.data.tax,
                        firstAmt: data.data.firstAmt,
                        total_fare: data.data.total_fare,
                        part_pay_fare: data.data.part_pay_fare,
                        id: window.paymentId,
                        payment_id: window.paymentId,
                        paymentId: window.paymentId,
                        job_no: data.data.job_no || data.job_no || bookingData.job_no || bookingData.bookingId,
                        job_id: data.data.job_id || data.job_id || bookingData.jobId
                    });

                    renderPaymentBreakdownUI(data.data);
                    showStep(5);
                    if (typeof selectPaymentMethod === 'function') {
                        selectPaymentMethod('stripe');
                    }
                    $('#stripePaymentContainer').show();
                    if (typeof initStripePaymentElement === 'function') {
                        initStripePaymentElement();
                    }
                } else {
                    showToast(data.message || 'Failed to fetch payment breakdown.', 'error');
                }
            } catch (err) {
                console.error(err);
                showToast('Failed to connect to server.', 'error');
            } finally {
                if ($btn) {
                    $btn.html(originalText);
                    $btn.prop('disabled', false);
                }
            }
        }

        function acceptDriverFromList(driver, btnElement) {
            proceedToPaymentWithDriver(driver, btnElement);
        }
        function getCarImageUrl(index) {
            if (dynamicCarImages && dynamicCarImages.length > 0) {
                return dynamicCarImages[index - 1];
            }
            return `${GORIDE_IMG_PREFIX}fleet${index}.png`;
        }

        function showCarDetailsModal(driver) {
            currentCarImageIndex = 1;
            $('#carCarouselImage').attr('src', getCarImageUrl(1));
            updateCarThumbnails();
            bookingData.tempDriver = driver;
            $('#carDetailsModal').addClass('show');
        }
        function nextCarImage() {
            currentCarImageIndex++;
            if (currentCarImageIndex > totalCarImages) {
                currentCarImageIndex = 1;
            }
            $('#carCarouselImage').attr('src', getCarImageUrl(currentCarImageIndex));
            updateCarThumbnails();
        }
        function prevCarImage() {
            currentCarImageIndex--;
            if (currentCarImageIndex < 1) {
                currentCarImageIndex = totalCarImages;
            }
            $('#carCarouselImage').attr('src', getCarImageUrl(currentCarImageIndex));
            updateCarThumbnails();
        }
        function setCarImageIndex(index) {
            currentCarImageIndex = index;
            $('#carCarouselImage').attr('src', getCarImageUrl(currentCarImageIndex));
            updateCarThumbnails();
        }
        function updateCarThumbnails() {
            $('.car-thumbnail').css('border', '2px solid transparent');
            $('.car-thumbnail').eq(currentCarImageIndex - 1).css('border', '2px solid #f5c00b');
        }

        let currentRcCarImageIndex = 1;
        let rcCarCarouselInterval = null;

        function nextRcCarImage(e) {
            if (e) e.stopPropagation();
            if (totalCarImages <= 1) return;
            currentRcCarImageIndex++;
            if (currentRcCarImageIndex > totalCarImages) {
                currentRcCarImageIndex = 1;
            }
            $('#rcCarImage').fadeOut(150, function () {
                $(this).attr('src', getCarImageUrl(currentRcCarImageIndex)).fadeIn(150);
            });
        }
        function prevRcCarImage(e) {
            if (e) e.stopPropagation();
            if (totalCarImages <= 1) return;
            currentRcCarImageIndex--;
            if (currentRcCarImageIndex < 1) {
                currentRcCarImageIndex = totalCarImages;
            }
            $('#rcCarImage').fadeOut(150, function () {
                $(this).attr('src', getCarImageUrl(currentRcCarImageIndex)).fadeIn(150);
            });
        }
        function startRcCarCarousel() {
            if (rcCarCarouselInterval) clearInterval(rcCarCarouselInterval);
            rcCarCarouselInterval = setInterval(() => nextRcCarImage(), 2500);
        }
        function stopRcCarCarousel() {
            if (rcCarCarouselInterval) clearInterval(rcCarCarouselInterval);
        }

        function acceptDriver(btnElement) {
            let driver = bookingData.tempDriver || bookingData.selectedDriver;
            if (driver) {
                $('#carDetailsModal').removeClass('show');
                proceedToPaymentWithDriver(driver, btnElement);
            }
        }
        function showConfirmation() {
            const num = 'GR-2026-' + Math.floor(Math.random() * 100000);
            const baseFare = bookingData.vehicle?.price || 45;
            const meetGreet = bookingData.meetAndGreet ? 10 : 0;
            const isChildSeat = $('#carSeatCheckbox').is(':checked');
            const childSeatCount = parseInt($('#childSeatCount').val() || 1);
            const childSeatPrice = 5;
            const totalChildSeat = isChildSeat ? (childSeatCount * childSeatPrice) : 0;
            const total = baseFare + meetGreet + totalChildSeat;
            $('#confirmNum').text(num);
            $('#confirmPickup').text(bookingData.pickup || '\u2014');
            $('#confirmDropoff').text(bookingData.dropoff || '\u2014');
            $('#confirmDateTime').text(`${bookingData.date} | ${bookingData.time}` || '\u2014');
            $('#confirmVehicle').text(bookingData.vehicle?.name || '\u2014');
            let finalDistance = bookingData.apiDistance || bookingData.vehicle?.fareBreakdown?.distance || '\u2014';
            if (typeof formatTripDistance === 'function' && finalDistance !== '\u2014') {
                finalDistance = formatTripDistance(finalDistance);
            }
            const finalDuration = bookingData.apiDuration || bookingData.vehicle?.fareBreakdown?.duration || '\u2014';
            $('#confirmDistance').text(finalDistance);
            $('#confirmDuration').text(finalDuration);
            $('#confirmBaseFare').text('\u00a3' + baseFare.toFixed(2));
            $('#confirmTotalFare').text('\u00a3' + total.toFixed(2));
            showStep(8);
        }
        function showDriverConfirmation(driver) {
            $('#driverConfirmImage').attr('src', driver.image || 'https://randomuser.me/api/portraits/men/32.jpg');
            $('#driverConfirmName').text(driver.name);
            $('#driverConfirmVehicle').text(driver.vehicle || driver.car || 'Vehicle');
            $('#driverConfirmRating').text(driver.rating);
            $('#driverConfirmModal').addClass('show');
        }
        $(document).ready(function () {
            // Bind scroll indicators for cab and driver lists using capture phase
            document.addEventListener('scroll', function () {
                if (typeof updateCabScrollIndicators === 'function') updateCabScrollIndicators();
            }, true);
            $(window).on('resize', function () {
                if (typeof updateCabScrollIndicators === 'function') updateCabScrollIndicators();
            });
            setTimeout(function () {
                if (typeof updateCabScrollIndicators === 'function') updateCabScrollIndicators();
            }, 500);

            // Initialize flight time dropdown value from hidden input
            const initialFlightTime = $('#flightArrivingTime').val() || '11:00';
            $('#flightTimeDropdownValue').html('<i class="fas fa-clock me-1"></i>' + initialFlightTime);
            const parts = initialFlightTime.split(':');
            if (parts.length === 2) {
                selectedFlightHour = parts[0];
                selectedFlightMinute = parts[1];
                $('#flightTimeDropdownList .hour-item[data-val="' + parts[0] + '"]').addClass('selected');
                $('#flightTimeDropdownList .minute-item[data-val="' + parts[1] + '"]').addClass('selected');
            }

            // Initialize seaport date and time dropdown values from hidden input
            const initialSeaportArrival = $('#seaportArrivalTime').val() || '';
            if (initialSeaportArrival) {
                const seaportParts = initialSeaportArrival.split(' ');
                if (seaportParts.length === 2) {
                    $('#seaportArrivalDate').val(seaportParts[0]);
                    const timeParts = seaportParts[1].split(':');
                    if (timeParts.length === 2) {
                        selectedSeaportHour = timeParts[0];
                        selectedSeaportMinute = timeParts[1];
                        $('#seaportTimeDropdownValue').html('<i class="fas fa-clock me-1"></i>' + seaportParts[1]);
                        $('#seaportTimeDropdownList .seaport-hour-item[data-val="' + timeParts[0] + '"]').addClass('selected');
                        $('#seaportTimeDropdownList .seaport-minute-item[data-val="' + timeParts[1] + '"]').addClass('selected');
                    }
                }
            } else {
                // If empty, pre-populate with default date and time
                const defDate = BookingStore.getState().date || '';
                $('#seaportArrivalDate').val(defDate);
                $('#seaportTimeDropdownValue').html('<i class="fas fa-clock me-1"></i>11:00');
                $('#seaportTimeDropdownList .seaport-hour-item[data-val="11"]').addClass('selected');
                $('#seaportTimeDropdownList .seaport-minute-item[data-val="00"]').addClass('selected');
                updateSeaportArrivalTime();
            }

            // Sync meet and greet & wheelchair checkboxes across pickup types
            $(document).on('change', '.meet-and-greet-cb', function () {
                $('.meet-and-greet-cb').prop('checked', this.checked);
            });
            $(document).on('change', '.wheelchair-option-cb', function () {
                $('.wheelchair-option-cb').prop('checked', this.checked);
            });

            // Bind input change events to update the store + booking summary live
            $(document).on('input change',
                '#passengerFirstName, #passengerPhone, #passengerEmail, #passengerCount, #luggageCount, #handLuggageCount, #carSeatCheckbox, #childSeatCount, .carSeatTypeSelect, #flightNumber, #flightArrivingTime, #meetAndGreet, #meetAndGreetSeaport, #wheelchairOptionAirport, #wheelchairOptionSeaport, #wheelchairOptionNormal, .meet-and-greet-cb, .wheelchair-option-cb, #pickupAfterLanding, #pickupAfterLandingSelect, #comingFrom, #dropoffAddress, #ferryName, #seaportArrivalDate, #seaportArrivalTime, #comingFromPort, #dropoffAddressSeaport, #normalJourneyDate, #normalJourneyTime, #specialReqCheckbox, #specialRequirements',
                function () {
                    // gatherAllBookingData does a single batch setState, which fires
                    // _updatePassengerSummaryUI and _updateJourneySummaryUI subscribers
                    gatherAllBookingData();
                    updateBookingSummary();
                }
            );

            $(document).on('change', '#pickupAfterLanding', function () {
                const val = $(this).val();
                console.log('pickupAfterLanding ' + val);

                const $target = $('#pickupAfterLandingSelect');
                // Only update and trigger if value actually changed (prevents infinite loop)
                if ($target.val() !== val) {
                    $target.val(val).trigger('change');
                }
            });

            $(document).on('change', '#pickupAfterLandingSelect', function () {
                const val = $(this).val();
                console.log('pickupAfterLandingSelect ' + val);

                const $target = $('#pickupAfterLanding');
                if ($target.val() !== val) {
                    $target.val(val).trigger('change');
                }
            });

            $(document).on('change', '#pickupAfterDocking', function () {
                const val = $(this).val();
                // console.log('pickupAfterDocking ' + val);

                const $target = $('#pickupAfterDockingSelect');
                // Only update and trigger if value actually changed (prevents infinite loop)
                if ($target.val() !== val) {
                    $target.val(val).trigger('change');
                }
            });

            $(document).on('change', '#pickupAfterDockingSelect', function () {
                const val = $(this).val();
                // console.log('pickupAfterDockingSelect ' + val);

                const $target = $('#pickupAfterDocking');
                if ($target.val() !== val) {
                    $target.val(val).trigger('change');
                }
            });

            // Synchronize normal journey date/time back to store
            $(document).on('change', '#normalJourneyDate', function () {
                BookingStore.setState({ date: $(this).val() });
                updateBookingSummary();
            });
            $(document).on('change', '#normalJourneyTime', function () {
                BookingStore.setState({ time: $(this).val() });
                updateBookingSummary();
            });
            $('#viewBookingBtn').on('click', function () {
                const bookingId = $('#confirmNum').text();
                showToast('Booking details saved successfully!', 'success');
            });
            $('#pickDriverBtn').on('click', function () {
                showStep(6);
                startDynamicDriverSearch();
            });
            $('#closeDriverConfirmBtn').on('click', function () {
                $('#driverConfirmModal').removeClass('show');
                setTimeout(function () {
                    location.reload();
                }, 500);
            });
        });
        function completeBooking() {
            const btn = document.querySelector('#step8 .btn-modal-primary');
            if (btn) {
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
                btn.disabled = true;
            }

            $('<div style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:99999;display:flex;align-items:center;justify-content:center;"><i class="fas fa-spinner fa-spin fa-3x" style="color:#fff;"></i></div>').appendTo('body');

            setTimeout(() => {
                BookingStore.clear();
                window.location.href = window.location.href.split('#')[0];
            }, 500);
        }
        function updateStepperHeader(stepNumber) {
            let activeStepperIndex = 1;
            if (stepNumber === 3) activeStepperIndex = 1;
            else if (stepNumber === 4) activeStepperIndex = 2;
            else if (stepNumber === 6 || stepNumber === 7) activeStepperIndex = 3;
            else if (stepNumber === 5) activeStepperIndex = 4;
            else if (stepNumber === 8) activeStepperIndex = 5;

            $('.booking-stepper-wrapper').each(function () {
                const wrapper = $(this);
                wrapper.find('.stepper-item').each(function (idx) {
                    const itemStepIndex = idx + 1;
                    const item = $(this);
                    item.removeClass('active completed inactive');
                    if (itemStepIndex < activeStepperIndex) {
                        item.addClass('completed');
                    } else if (itemStepIndex === activeStepperIndex) {
                        item.addClass('active');
                    } else {
                        item.addClass('inactive');
                    }
                });
            });
        }

        // ===== FLOATING SCROLL INDICATORS FOR VEHICLES & DRIVERS =====
        window.handleCabScrollClick = function (stepId) {
            const btn = document.getElementById('cabScrollBtn_' + stepId);
            const isTopMode = btn && btn.classList.contains('mode-top');

            if (isTopMode) {
                scrollCabList(stepId, 'up');
            } else {
                scrollCabList(stepId, 'down');
            }
        };

        window.scrollCabList = function (stepId, direction) {
            const stepElem = document.getElementById(stepId);
            if (!stepElem) return;

            const listId = stepId === 'step3' ? 'vehicleGrid' : 'driverList';
            const listElem = document.getElementById(listId);

            let container = stepElem.querySelector('.container');
            let heroSection = document.querySelector('.hero-form-section');
            let isContainerScrollable = container && (container.scrollHeight > container.clientHeight + 20);

            let scrollTarget = isContainerScrollable ? container : (heroSection && heroSection.scrollHeight > heroSection.clientHeight + 20 ? heroSection : window);

            if (direction === 'up') {
                if (listElem) {
                    listElem.scrollIntoView({ behavior: 'smooth', block: 'start' });
                } else if (scrollTarget === window) {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                } else {
                    scrollTarget.scrollTo({ top: 0, behavior: 'smooth' });
                }
            } else {
                const itemClass = stepId === 'step3' ? '.vehicle-item' : '.driver-item';
                const items = listElem ? listElem.querySelectorAll(itemClass) : [];
                if (items && items.length > 0) {
                    const lastItem = items[items.length - 1];
                    lastItem.scrollIntoView({ behavior: 'smooth', block: 'end' });
                }
                if (scrollTarget === window) {
                    window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
                } else {
                    scrollTarget.scrollTo({ top: scrollTarget.scrollHeight, behavior: 'smooth' });
                }
            }
        };

        window.updateCabScrollIndicators = function () {
            const steps = [
                { stepId: 'step3', listId: 'vehicleGrid', itemClass: '.vehicle-item', defaultText: 'More Cabs' },
                { stepId: 'step6', listId: 'driverList', itemClass: '.driver-item', defaultText: 'More Drivers' }
            ];

            steps.forEach(config => {
                const stepElem = document.getElementById(config.stepId);
                const controls = document.getElementById('cabScrollControls_' + config.stepId);
                const btn = document.getElementById('cabScrollBtn_' + config.stepId);
                const textElem = document.getElementById('cabScrollText_' + config.stepId);
                const iconElem = document.getElementById('cabScrollIcon_' + config.stepId);

                if (!stepElem || !controls || !btn) return;

                const isStepVisible = $(stepElem).is(':visible') && stepElem.classList.contains('active');
                if (!isStepVisible) {
                    controls.style.display = 'none';
                    return;
                }

                const listElem = document.getElementById(config.listId);
                if (!listElem) {
                    controls.style.display = 'none';
                    return;
                }

                const items = listElem.querySelectorAll(config.itemClass);
                if (!items || items.length <= 1) {
                    controls.style.display = 'none';
                    return;
                }

                const firstItem = items[0];
                const lastItem = items[items.length - 1];

                const container = stepElem.querySelector('.container');
                const heroSection = document.querySelector('.hero-form-section');

                let viewportTop = 0;
                let viewportBottom = window.innerHeight;

                const isMobile = window.innerWidth <= 768;
                if (!isMobile) {
                    if (container && container.scrollHeight > container.clientHeight + 20 && container.clientHeight > 0) {
                        const cRect = container.getBoundingClientRect();
                        viewportTop = cRect.top;
                        viewportBottom = cRect.bottom;
                    } else if (heroSection && heroSection.scrollHeight > heroSection.clientHeight + 20 && heroSection.clientHeight > 0) {
                        const hRect = heroSection.getBoundingClientRect();
                        viewportTop = hRect.top;
                        viewportBottom = hRect.bottom;
                    }
                } else {
                    viewportTop = 80;
                    viewportBottom = window.innerHeight - 70;
                }

                const firstRect = firstItem.getBoundingClientRect();
                const lastRect = lastItem.getBoundingClientRect();

                const listTotalHeight = lastRect.bottom - firstRect.top;
                const viewportHeight = viewportBottom - viewportTop;

                if (listTotalHeight <= viewportHeight - 30) {
                    controls.style.display = 'none';
                    return;
                }

                controls.style.display = 'flex';

                // Check if first card is near the top of the viewport
                const isAtTop = firstRect.top >= (viewportTop - 40);

                if (isAtTop) {
                    btn.classList.remove('mode-top');
                    btn.classList.add('mode-down');
                    if (textElem) textElem.textContent = config.defaultText;
                    if (iconElem) {
                        iconElem.className = 'fas fa-chevron-down animated-bounce';
                    }
                } else {
                    btn.classList.remove('mode-down');
                    btn.classList.add('mode-top');
                    if (textElem) textElem.textContent = 'Top';
                    if (iconElem) {
                        iconElem.className = 'fas fa-chevron-up animated-bounce-up';
                    }
                }
            });
        };

        function showStep(stepNumber) {
            // Cancel any pending map initialization timer immediately
            if (window._routeMapTimer) {
                clearTimeout(window._routeMapTimer);
                window._routeMapTimer = null;
            }

            const currentStep = BookingStore.getState().currentStep || 1;

            // Close mobile summary if it is open (so it doesn't block the screen)
            if ($('#mobileTripBody').length && $('#mobileTripBody').is(':visible') && typeof toggleTripSummary === 'function') {
                toggleTripSummary();
            }

            // Prevent going back to pre-bidding steps if already in bidding or beyond
            if (currentStep >= 5 && stepNumber < 5) {
                return;
            }

            BookingStore.setState({ currentStep: stepNumber });
            updateStepperHeader(stepNumber);
            $('body').css('overflow', 'auto');
            const sections = $('.form-section');
            if (window.innerWidth > 768 && stepNumber >= 3) {
                const formSection = $('.hero-form-section');
                const mapSection = $('.hero-map-section');
                formSection.removeClass('col-md-5').addClass('col-md-8 three-column-mode');
                mapSection.removeClass('col-md-4').addClass('col-md-7');
                sections.removeClass('active side-by-side');
                $('#step2').addClass('active side-by-side');
                $(`#step${stepNumber}`).addClass('active side-by-side');
                $('#step2Buttons').hide();
                $('#bookingImage').hide();
                $('#bookingMap').show();
                if (bookingData.apiDistance || bookingData.apiDuration) {
                    $('#mapRouteBadge').show();
                }
                $('#vehicleGrid').addClass('single-col');
                window._routeMapTimer = setTimeout(function () {
                    const stepNow = (typeof BookingStore !== 'undefined' && BookingStore.getState) ? (BookingStore.getState().currentStep || 1) : 1;
                    if (stepNow >= 3 && typeof initSingleRouteMap === 'function') {
                        initSingleRouteMap();
                    }
                }, 300);
            } else {
                sections.removeClass('active side-by-side');
                $(`#step${stepNumber}`).addClass('active');
                if (stepNumber < 3) {
                    const formSection = $('.hero-form-section');
                    const mapSection = $('.hero-map-section');
                    formSection.removeClass('col-md-8 three-column-mode').addClass('col-md-5');
                    mapSection.removeClass('col-md-4').addClass('col-md-7');
                    $('#vehicleGrid').removeClass('single-col');
                    if (stepNumber === 1) {
                        $('#bookingMap').hide();
                        $('#mapRouteBadge').hide();
                        $('#bookingImage').show();
                    } else if (stepNumber === 2) {
                        $('#step2Buttons').css('display', 'flex');
                    }
                }
            }
            // DYNAMIC SIDEBAR & MOBILE SUMMARY VISIBILITY BASED ON STATE
            if (stepNumber >= 3) {
                if (bookingData.vehicle) {
                    $('#selectedCarSummary').show();
                    $('#mcsCarDetails').show();
                } else {
                    $('#selectedCarSummary').hide();
                    $('#mcsCarDetails').hide();
                }
                if (stepNumber >= 5) {
                    $('#enteredDetailsSummary').show();
                    $('#mcsEnteredDetails').css('display', 'grid');
                    $('#riderSelectCard').hide();
                    updateBookingSummary();
                } else {
                    $('#enteredDetailsSummary').hide();
                    $('#mcsEnteredDetails').hide();
                    $('#riderSelectCard').show();
                }
            } else {
                $('#selectedCarSummary').hide();
                $('#mcsCarDetails').hide();
                $('#enteredDetailsSummary').hide();
                $('#mcsEnteredDetails').hide();
                $('#riderSelectCard').show();
            }
            if (stepNumber >= 5) {
                $('.edit-icon-btn').hide();
            } else {
                $('.edit-icon-btn').show();
                if (stepNumber === 3) {
                    $('#selectedCarSummary .edit-icon-btn').hide();
                    $('#mcsCarDetails .edit-icon-btn').hide();
                }
            }
            $('.hero-form-section').scrollTop(0);
            if (window.innerWidth <= 768) {
                const actionBar = $('#mobileActionBar');

                if (stepNumber === 1) {
                    $('.navbar-menu').removeClass('hide-on-mobile');
                    $('#mobileHamburger').css('display', 'flex');
                    $('#mobileMapBtn, #mobileHeaderRiderBtn').hide();
                    $('#bookingImage').show();
                    $('#bookingMap').hide();
                    $('#mapRouteBadge').hide();
                    $('#mobileCompactSummary').removeClass('visible');
                    $('#mobileTripBody').hide();
                    $('#mobileSummaryBackdrop').hide();
                    $('#tripSummaryArrow').removeClass('rotate');
                    $(`#step1`).css('padding-top', '0');
                    if (actionBar.length) actionBar.removeClass('hidden');
                } else if (stepNumber === 8) {
                    $('.navbar-menu').addClass('hide-on-mobile');
                    $('#mobileHamburger').hide();
                    $('#mobileMapBtn, #mobileHeaderRiderBtn').hide();
                    $('#bookingImage').hide();
                    $('#mapRouteBadge').hide();
                    $('#mobileCompactSummary').removeClass('visible');
                    $('#mobileTripBody').hide();
                    $('#mobileSummaryBackdrop').hide();
                    $('#tripSummaryArrow').removeClass('rotate');
                    if (actionBar.length) actionBar.addClass('hidden');
                    $(`#step8`).css('padding-top', '20px');
                } else {
                    $('.navbar-menu').addClass('hide-on-mobile');
                    $('#mobileHamburger').hide();
                    $('#mobileMapBtn').css('display', 'flex');
                    if (stepNumber < 5) {
                        $('#mobileHeaderRiderBtn').css('display', 'inline-flex');
                    } else {
                        $('#mobileHeaderRiderBtn').hide();
                    }
                    $('#bookingImage').hide();
                    $('#mobileCompactSummary').addClass('visible');
                    if (actionBar.length) actionBar.addClass('hidden');
                    $(`#step${stepNumber}`).css('padding-top', '80px');
                }
            }

            if (stepNumber === 6) {
                if (typeof startDynamicDriverSearch === 'function') {
                    startDynamicDriverSearch();
                }
            } else if (stepNumber === 5) {
                if (typeof renderPaymentBreakdownUI === 'function') {
                    renderPaymentBreakdownUI();
                }
            }
            if (typeof updateCabScrollIndicators === 'function') {
                setTimeout(updateCabScrollIndicators, 150);
            }
            if (typeof updateStep3ContinueButtonState === 'function') {
                updateStep3ContinueButtonState();
            }
        }

        window.updateStep3ContinueButtonState = function () {
            const vehicle = BookingStore.getState().vehicle;
            const btn = $('#step3ContinueBtn, #step3 .btn-search-uber');
            if (!btn.length) return;

            if (!vehicle) {
                btn.prop('disabled', true)
                   .addClass('disabled-btn')
                   .attr('title', 'Please select a vehicle to continue')
                   .css({
                       'opacity': '0.95',
                       'cursor': 'not-allowed',
                       'pointer-events': 'auto',
                       'background': '#94a3b8',
                       'border-color': '#94a3b8',
                       'box-shadow': 'none'
                   });
            } else {
                btn.prop('disabled', false)
                   .removeClass('disabled-btn')
                   .removeAttr('title')
                   .css({
                       'opacity': '1',
                       'cursor': 'pointer',
                       'pointer-events': 'auto',
                       'background': '',
                       'border-color': '',
                       'box-shadow': ''
                   });
            }
        };
        function goBack(step) {
            if (step === 6 && typeof resetStripePayment === 'function') {
                resetStripePayment();
            }
            showStep(step);
            if (step === 6) {
                if (typeof startDynamicDriverSearch === 'function') {
                    startDynamicDriverSearch();
                }
            } else if (step === 5) {
                if (typeof renderPaymentBreakdownUI === 'function') {
                    renderPaymentBreakdownUI();
                }
            }
        }
        function closeModal(id) {
            $(`#${id}`).removeClass('show');
        }
        function toggleFaq(el) {
            const answer = $(el).next();
            $('.faq-answer').each(function () {
                if (!$(this).is(answer)) $(this).removeClass('show');
            });
            answer.toggleClass('show');
        }
        function saveOtherPassenger() {
            let name = $('#otherPassengerName').val().trim();
            let phone = $('#otherPassengerPhone').val().trim();

            if (!name) {
                showToast('Please enter passenger name', 'error');
                return;
            }
            if (!phone) {
                showToast('Please enter passenger mobile number', 'error');
                return;
            }
            if (!/^[a-zA-Z\s]{1,75}$/.test(name)) {
                showToast('Passenger name can only contain letters (max 75 characters)', 'error');
                return;
            }
            if (phone && !/^[0-9]{1,12}$/.test(phone)) {
                showToast('Mobile number can only contain numbers (max 12 digits)', 'error');
                return;
            }

            const otherData = {
                name: name,
                phone: phone
            };
            $('#forMeTitle, #mobileRiderTitle, #mobileHeaderRiderTitle').text('Booked for ' + name);
            if (phone) {
                $('#forMeDetails').text(phone).show();
            } else {
                $('#forMeDetails').hide().text('');
            }
            BookingStore.setState({ rideFor: 'other', otherPassengerData: otherData });
            closeModal('bookForOtherModal');
            closeForMeModal();
        }
        function showAppPromoModal() {
            $('#appPromoModal').addClass('show');
        }
        async function saveBooking() {
            if (!validateBooking()) return;
            const payload = {
                from: bookingData.pickup,
                from_type: bookingData.pickupType,
                to: bookingData.dropoff,
                to_type: bookingData.dropoffType,
                date: bookingData.date,
                time: bookingData.time,
                flight_landing_time: bookingData.landingTime || null,
                pickup_after_minutes: bookingData.pickupAfter || null,
                is_return: bookingData.returnTrip,
                return_from: bookingData.returnTrip ? bookingData.returnPickup : null,
                return_from_type: bookingData.returnTrip ? bookingData.returnPickupType : null,
                return_to: bookingData.returnTrip ? bookingData.returnDropoff : null,
                return_to_type: bookingData.returnTrip ? bookingData.returnDropoffType : null,
            };
            try {
                const response = await fetch(API_BASE_URL + '/api/bookings', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + getCookieValue('auth_token')
                    },
                    body: JSON.stringify(payload)
                });
                const result = await response.json();
                if (result.success) {
                    showToast('Booking confirmed! Confirmation #' + result.booking_id, 'success');
                } else {
                    showToast('Booking failed: ' + result.message, 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Network error while saving booking', 'error');
            }
        }
        function goBackToLocationsFromVehicles() {
            BookingStore.setState({ vehicle: null });
            $('#selectedCarSummary').hide();
            goBackToLocations();
        }
        function updateCounter(inputId, delta, min, max) {
            const input = $(`#${inputId}`);
            const display = $(`#${inputId}Display`);
            if (!input.length || !display.length) return;

            const vehicle = BookingStore.getState().vehicle;
            let dynamicMax = max;
            if (vehicle) {
                if (inputId === 'passengerCount') {
                    dynamicMax = parseInt(vehicle.capacity) || max;
                } else if (inputId === 'luggageCount') {
                    dynamicMax = parseInt(vehicle.luggage) || max;
                } else if (inputId === 'handLuggageCount') {
                    dynamicMax = parseInt(vehicle.handLuggage) || max;
                }
            }

            let val = parseInt(input.val()) || 0;

            val += delta;
            if (val < min) val = min;
            if (val > dynamicMax) val = dynamicMax;
            input.val(val);
            display.text(val);

            if (inputId === 'luggageCount') BookingStore.setState({ luggageCount: val });
            if (inputId === 'handLuggageCount') BookingStore.setState({ handLuggageCount: val });
            if (inputId === 'passengerCount') BookingStore.setState({ passengerCount: val });
        }
        function toggleChildSeatOptions() {
            const checkbox = $('#carSeatCheckbox');
            const options = $('#childSeatOptions');
            if (!checkbox.length || !options.length) return;
            if (checkbox.is(':checked')) {
                if (typeof showToast === 'function') {
                    showToast('Child seat may have additional payments', 'info');
                }
                options.show();
                let count = parseInt($('#childSeatCount').val()) || 0;
                if (count === 0) count = 1;
                $('#childSeatCount').val(count);
                $('#childSeatCountDisplay').text(count);
                renderCarSeatDropdowns(count);
            } else {
                options.hide();
                $('#childSeatCount').val(0);
                $('#childSeatCountDisplay').text(0);
                $('#carSeatDropdownsContainer').html('');
            }
            if (typeof gatherAllBookingData === 'function') {
                gatherAllBookingData();
            }
            if (typeof updateBookingSummary === 'function') {
                updateBookingSummary();
            }
        }
        let currentModalVehicleData = null;
        function openVehicleInfo(vData) {
            currentModalVehicleData = vData;
            const vehicle = vData;
            $("#vehicleModalTitle").html(vehicle.name);

            const price = vehicle.price;
            const priceMax = vehicle.priceMax;

            let priceTextHtml = '';
            if (priceMax && parseFloat(priceMax) > 0) {
                priceTextHtml = `Price Range: <strong>£${price} – £${priceMax}</strong>`;
            } else {
                priceTextHtml = `Price: <strong>£${price}</strong>`;
            }

            let recommendedHtml = '';
            switch (vehicle.name) {
                case 'Standard':
                    recommendedHtml = `
                  <ul class="vehicle-recommended-list">
    <li><i class="fas fa-check-circle"></i> <strong>Vehicle:</strong> Toyota Prius or similar</li>
    <li><i class="fas fa-check-circle"></i> <strong>Capacity:</strong> Up to 4 passengers</li>
    <li><i class="fas fa-check-circle"></i> <strong>Luggage:</strong> 2 large suitcases (20kg max each) + 2 hand luggage</li>
</ul>
                    `;
                    break;
                case 'Executive':
                    recommendedHtml = `
                  <ul class="vehicle-recommended-list">
    <li><i class="fas fa-check-circle"></i> <strong>Vehicle:</strong> Mercedes-Benz E-Class or similar</li>
    <li><i class="fas fa-check-circle"></i> <strong>Capacity:</strong> Up to 4 passengers</li>
    <li><i class="fas fa-check-circle"></i> <strong>Luggage:</strong> 2 large suitcases (20kg max each) + 2 hand luggage</li>
</ul>
                    `;
                    break;
                case 'Estate':
                    recommendedHtml = `
                       <ul class="vehicle-recommended-list">
    <li><i class="fas fa-check-circle"></i> <strong>Vehicle:</strong> Toyota Corolla or similar</li>
    <li><i class="fas fa-check-circle"></i> <strong>Capacity:</strong> Up to 4 passengers</li>
    <li><i class="fas fa-check-circle"></i> <strong>Luggage:</strong> 3 large suitcases (20kg max each) + 3 hand luggage</li>
</ul>
                    `;
                    break;
                case 'MPV':
                    recommendedHtml = `
                      <ul class="vehicle-recommended-list">
    <li><i class="fas fa-check-circle"></i> <strong>Vehicle:</strong> Volkswagen Sharan or similar</li>
    <li><i class="fas fa-check-circle"></i> <strong>Capacity:</strong> Up to 4 passengers</li>
    <li><i class="fas fa-check-circle"></i> <strong>Luggage:</strong> 4 large suitcases (20kg max each) + 4 hand luggage</li>
</ul>
                    `;
                    break;
                case 'MPV+ (6 Passengers)':
                case 'MPV 6':
                    recommendedHtml = `
                       <ul class="vehicle-recommended-list">
    <li><i class="fas fa-check-circle"></i> <strong>Vehicle:</strong> Mercedes-Benz V-Class or similar</li>
    <li><i class="fas fa-check-circle"></i> <strong>Capacity:</strong> Up to 6 passengers</li>
    <li><i class="fas fa-check-circle"></i> <strong>Luggage:</strong> 6 large suitcases (20kg max each) + 6 hand luggage</li>
    <li><i class="fas fa-check-circle"></i> <strong>Ideal for:</strong> Families and group airport transfers</li>
</ul>
                    `;
                    break;
                case 'MPV 7':
                    recommendedHtml = `
                       <ul class="vehicle-recommended-list">
    <li><i class="fas fa-check-circle"></i> <strong>Vehicle:</strong> Volkswagen Transporter or similar</li>
    <li><i class="fas fa-check-circle"></i> <strong>Capacity:</strong> Up to 7 passengers</li>
    <li><i class="fas fa-check-circle"></i> <strong>Luggage:</strong> 7 large suitcases (20kg max each) + 7 hand luggage</li>
    <li><i class="fas fa-check-circle"></i> <strong>Ideal for:</strong> Large groups and extended families</li>
</ul>
                    `;
                    break;
                case 'MPV 7 Luxury':
                    recommendedHtml = `
                    <ul class="vehicle-recommended-list">
    <li><i class="fas fa-check-circle"></i> <strong>Vehicle:</strong> Mercedes-Benz V-Class or similar</li>
    <li><i class="fas fa-check-circle"></i> <strong>Capacity:</strong> Up to 7 passengers</li>
    <li><i class="fas fa-check-circle"></i> <strong>Luggage:</strong> 7 large suitcases (20kg max each) + 7 hand luggage</li>
    <li><i class="fas fa-check-circle"></i> <strong>Features:</strong> Spacious cabin, premium interiors & first-class travel experience</li>
</ul>
                    `;
                    break;
                case '8 Seater':
                case 'MPV 8':
                    recommendedHtml = `
                       <ul class="vehicle-recommended-list">
    <li><i class="fas fa-check-circle"></i> <strong>Vehicle:</strong> Volkswagen Transporter or similar</li>
    <li><i class="fas fa-check-circle"></i> <strong>Capacity:</strong> Up to 8 passengers</li>
    <li><i class="fas fa-check-circle"></i> <strong>Luggage:</strong> 8 large suitcases (20kg max each) + 8 hand luggage (10kg max each)</li>
    <li><i class="fas fa-check-circle"></i> <strong>Ideal for:</strong> Large families, tours & group travel</li>
</ul>
                    `;
                    break;
                case 'MPV 8 Luxury':
                    recommendedHtml = `
                       <ul class="vehicle-recommended-list">
    <li><i class="fas fa-check-circle"></i> <strong>Vehicle:</strong> Mercedes-Benz Vito or similar</li>
    <li><i class="fas fa-check-circle"></i> <strong>Capacity:</strong> Up to 8 passengers</li>
    <li><i class="fas fa-check-circle"></i> <strong>Luggage:</strong> 8 large suitcases (20kg max each) + 8 hand luggage (10kg max each)</li>
    <li><i class="fas fa-check-circle"></i> <strong>Ideal for:</strong> Large families, tours & group travel</li>
</ul>
                    `;
                    break;
                case 'Executive MPV':
                case 'Executive MPV +':
                case 'MPV 6 Luxury':
                    recommendedHtml = `
                      <ul class="vehicle-recommended-list">
    <li><i class="fas fa-check-circle"></i> <strong>Vehicle:</strong> Mercedes Vito, VW Transporter or similar MPV6</li>
    <li><i class="fas fa-check-circle"></i> <strong>Capacity:</strong> Up to 6 passengers</li>
    <li><i class="fas fa-check-circle"></i> <strong>Luggage:</strong> 6 large suitcases (20kg max each) + 6 hand luggage</li>
    <li><i class="fas fa-check-circle"></i> <strong>Ideal for:</strong> Executive travel, airport transfers, business trips & family journeys</li>
</ul>
                    `;
                    break;
                default:
                    recommendedHtml = `
                        <ul class="vehicle-recommended-list">
                            <li><i class="fas fa-check-circle"></i> Comfortable and reliable airport transfer.</li>
                            <li><i class="fas fa-check-circle"></i> Ample space for passengers and standard luggage.</li>
                            <li><i class="fas fa-check-circle"></i> Professional driver and meet & greet service included.</li>
                        </ul>
                    `;
                    break;
            }
            $("#vehicleModalContent").html(`
    <div class="vehicle-info-section">
        <div class="vehicle-modal-price-range">
            <i class="fas fa-tag"></i>
            <span>${priceTextHtml}</span>
        </div>

        <h6><i class="fas fa-info-circle"></i> Recommended for:</h6>
        ${recommendedHtml}

        <button class="vehicle-modal-price-btn" onclick="selectCabFromModal()">
            Select Cabs
        </button>
    </div>
`);

            $("#vehicleInfoModal").addClass("show");
        }

        function selectCabFromModal() {
            closeModal('vehicleInfoModal');
            if (currentModalVehicleData) {
                const el = document.getElementById('vehicle-item-' + currentModalVehicleData.id);
                if (el) selectVehicle(el, currentModalVehicleData);
            }
        }
        // ===== CAR SEAT COUNT UPDATE =====
        function updateCarSeatCount(delta) {
            const input = $('#childSeatCount');
            const display = $('#childSeatCountDisplay');
            if (!input.length || !display.length) return;

            const vehicle = BookingStore.getState().vehicle;
            let maxSeats = 4;
            if (vehicle && vehicle.child !== undefined) {
                maxSeats = parseInt(vehicle.child) || 0;
            }

            let val = parseInt(input.val()) || 0;
            val += delta;
            if (val < 0) val = 0;
            if (val > maxSeats) val = maxSeats;
            input.val(val);
            display.text(val);
            renderCarSeatDropdowns(val);
            if (typeof gatherAllBookingData === 'function') {
                gatherAllBookingData();
            }
            if (typeof updateBookingSummary === 'function') {
                updateBookingSummary();
            }
        }
        // ===== RENDER CAR SEAT DROPDOWNS DYNAMICALLY =====
        function renderCarSeatDropdowns(count) {
            const container = $('#carSeatDropdownsContainer');
            if (!container.length) return;
            const existingValues = {};
            for (let i = 1; i <= count; i++) {
                existingValues[i] = $(`#childSeatType_${i}`).val() || '';
            }
            container.html('');
            for (let i = 1; i <= count; i++) {
                const val = existingValues[i] || '';
                const dropdownHtml = `
            <div class="form-group-uber booking-form-group" style="margin-bottom: 0;">
                <label style="font-size: 13px;">Baby Seat ${i} Type *</label>
                <select id="childSeatType_${i}" class="carSeatTypeSelect" style="width: 100%;" required>
                    <option value="" ${val === '' ? 'selected' : ''}>Select Type</option>
                    <option value="infant" ${val === 'infant' ? 'selected' : ''}>Infant (0-1 yr)</option>
                    <option value="toddler" ${val === 'toddler' ? 'selected' : ''}>Toddler (1-4 yr)</option>
                    <option value="booster" ${val === 'booster' ? 'selected' : ''}>Booster (4-12 yr)</option>
                </select>
            </div>
        `;
                container.append(dropdownHtml);
            }
        }
        // ===== GET CAR SEAT DATA =====
        function getCarSeatData() {
            const count = parseInt($('#childSeatCount').val()) || 0;
            const carSeats = [];
            for (let i = 1; i <= count; i++) {
                const typeSelect = $(`#childSeatType_${i}`);
                if (typeSelect.length) {
                    carSeats.push({
                        seat: i,
                        type: typeSelect.val()
                    });
                }
            }
            return carSeats;
        }
        // ===== TOGGLE SPECIAL REQUIREMENTS =====
        function toggleSpecialRequirements() {
            const checkbox = $('#specialReqCheckbox');
            const textarea = $('#specialRequirements');
            if (!checkbox.length || !textarea.length) return;
            if (checkbox.is(':checked')) {
                textarea.show().focus();
            } else {
                textarea.hide().val('');
            }
        }
        function toggleTripSummary() {
            const body = $('#mobileTripBody');
            const arrow = $('#tripSummaryArrow');
            const backdrop = $('#mobileSummaryBackdrop');

            if (body.is(':visible')) {
                body.slideUp(300);
                backdrop.fadeOut(300);
                arrow.removeClass('rotate');
                $('.mobile-from, .mobile-to').removeClass('expanded-text');
                $('#mcsPickup, #mcsDropoff').addClass('text-truncate');
            } else {
                if (typeof _updateDistanceDurationUI === 'function') {
                    _updateDistanceDurationUI(BookingStore.getState());
                }
                body.slideDown(300);
                backdrop.fadeIn(300);
                arrow.addClass('rotate');
                $('.mobile-from, .mobile-to').addClass('expanded-text');
                $('#mcsPickup, #mcsDropoff').removeClass('text-truncate');
            }
        }
        function updateTripDateTimeCard() {
            const uiDate = bookingData.date ? formatUIOrdinalDate(bookingData.date) : '--';
            $('#tripSelectedDate').text(uiDate);
            $('#tripSelectedTime').text(bookingData.time || '--');
        }
        // mcsPickup / mcsDropoff are now updated reactively by _updateLocationUI subscriber
        // (called on every BookingStore.setState and on page load restore)

        const phoneInput = document.querySelector("#passengerPhone");
        if (phoneInput && typeof window.intlTelInput === 'function') {
            const iti = window.intlTelInput(phoneInput, {
                initialCountry: "auto",
                geoIpLookup: function (success, failure) {
                    fetch("https://get.geojs.io/v1/ip/geo.json")
                        .then(function (res) { return res.json(); })
                        .then(function (data) { success(data && data.country_code ? data.country_code.toLowerCase() : "gb"); })
                        .catch(function () { success("gb"); });
                },
                preferredCountries: ["gb", "us", "in", "ae", "au"],
                separateDialCode: true,
                nationalMode: true,
                autoPlaceholder: "polite",
                strictMode: true,
                loadUtils: () =>
                    import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js")
            });
            window.passengerPhoneIti = iti;
        }
    </script>


    <!-- ===== AUTH LOGIN MODAL ===== -->
    <div id="authLoginModal" role="dialog" aria-modal="true" aria-labelledby="authModalHeadline">
        <div class="auth-modal-backdrop" onclick="closeAuthModal()"></div>
        <div class="auth-modal-card">
            <button class="auth-modal-close" onclick="closeAuthModal()" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>

            <!-- Logo -->
            <div class="auth-modal-logo">
                <img src="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG_II') }}/goride/img/logo-darkk.png"
                    alt="GoRide Logo">
            </div>

            <h2 class="auth-modal-headline" id="authModalHeadline">Sign in to continue</h2>
            <p class="auth-modal-sub">See prices and book your ride in seconds.<br>No card required to browse.</p>

            <!-- STEP 1: Phone / Google Login -->
            <div id="authStep1">
                <!-- Continue with Google -->
                <button class="auth-google-btn" id="authGoogleBtn" onclick="handleGoogleSignIn()">
                    <!-- Google SVG icon -->
                    <svg class="auth-google-icon" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#EA4335"
                            d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z" />
                        <path fill="#4285F4"
                            d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z" />
                        <path fill="#FBBC05"
                            d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z" />
                        <path fill="#34A853"
                            d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z" />
                        <path fill="none" d="M0 0h48v48H0z" />
                    </svg>
                    Continue with Google
                </button>

                <!-- Divider -->
                <div class="auth-divider"><span>or continue with email / mobile</span></div>

                <!-- Email / Phone input (intl-tel-input) -->
                <div id="authPhoneWrapper">
                    <input type="tel" id="authContactInput" placeholder="Enter mobile number" autocomplete="off">
                </div>

                <button id="authContinueBtn" class="auth-continue-btn" onclick="handleAuthContinue()">
                    <i class="fas fa-arrow-right"></i> Continue
                </button>
            </div>

            <!-- OTP Input Step (Hidden initially) -->
            <div id="authOtpSection" style="display: none; width: 100%; animation: fadeIn 0.4s ease-out;">
                <div style="text-align: center; margin-bottom: 15px;">
                    <div style="display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: #111;
    color: #fff;
    margin-bottom: 3px;">
                        <i class="fas fa-lock" style="font-size: 20px;"></i>
                    </div>
                    <h3 style="font-size: 22px; font-weight: 800; color: #111; margin-bottom: 3px;">Verify your number
                    </h3>
                    <p class="otp-code">
                        We've sent a 6-digit code to <br>
                        <span id="authOtpTarget" style="font-weight: 700; color: #111;"></span>
                        <a href="javascript:void(0)" id="authChangeNumberBtn"
                            style="font-size: 13px; color: #c89f17; font-weight: 600; text-decoration: underline; margin-left: 10px; display: none;"
                            onclick="_showPhoneUI()">Change</a>
                    </p>
                </div>

                <div id="authNewUserFields"
                    style="display: none; margin-bottom: 10px; animation: slideUp 0.4s ease-out;">
                    <div class="d-flex flex-column flex-md-row gap-3">
                        <div style="position: relative; flex: 1;">
                            <i class="fas fa-user"
                                style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #888; font-size: 15px;"></i>
                            <input type="text" id="authNameInput" placeholder="Full Name" maxlength="100"
                                style="width: 100%; padding: 15px 15px 15px 48px; border: 1.5px solid #e5e7eb; border-radius: 12px; font-size: 15px; font-weight: 500; transition: all 0.2s ease; box-sizing: border-box; outline: none; background: #fff;"
                                autocomplete="off"
                                onfocus="this.style.borderColor='#111'; this.style.boxShadow='0 0 0 4px rgba(0,0,0,0.05)'"
                                onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
                        </div>
                        <div style="position: relative; flex: 1;">
                            <i class="fas fa-envelope"
                                style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #888; font-size: 15px;"></i>
                            <input type="email" id="authEmailInput" placeholder="Email Address" maxlength="100"
                                style="width: 100%; padding: 15px 15px 15px 48px; border: 1.5px solid #e5e7eb; border-radius: 12px; font-size: 15px; font-weight: 500; transition: all 0.2s ease; box-sizing: border-box; outline: none; background: #fff;"
                                autocomplete="off"
                                onfocus="this.style.borderColor='#111'; this.style.boxShadow='0 0 0 4px rgba(0,0,0,0.05)'"
                                onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 15px; position: relative;">
                    <input type="text" id="authOtpInput" class="premium-otp-input" placeholder="Enter 6-digit OTP"
                        maxlength="6" autocomplete="off" inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>

                <button id="authVerifyBtn"
                    style="width: 100%; padding: 10px 14px; background: #111; color: #fff; border: none; border-radius: 12px; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 10px; box-shadow: 0 6px 15px rgba(0,0,0,0.1);"
                    onclick="handleVerifyOtp()"
                    onmouseover="this.style.background='#000'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.2)'"
                    onmouseout="this.style.background='#111'; this.style.transform='none'; this.style.boxShadow='0 6px 15px rgba(0,0,0,0.1)'">
                    Verify &amp; Continue <i class="fas fa-arrow-right" style="font-size: 14px;"></i>
                </button>

                <div
                    style="display: flex; align-items: center; justify-content: center; margin-top: 14px; font-size: 13px; color: #666; gap: 6px;">
                    <span>Didn't receive the code?</span>
                    <button type="button" id="authResendOtpBtn" onclick="handleResendOtp()"
                        style="background: none; border: none; padding: 0; color: #111; font-weight: 700; cursor: pointer; text-decoration: underline; font-size: 13px;">Resend
                        OTP</button>
                    <span id="authResendTimer" style="font-size: 12px; color: #888; display: none;"></span>
                </div>
            </div>

            <!-- Firebase Recaptcha Container -->
            <div id="recaptcha-container" style="margin-top: 7px; display: flex; justify-content: center;"></div>

            <p class="auth-modal-terms">
                By continuing, you agree to our
                <a href="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG') }}terms" target="_blank">Terms of
                    Service</a> &amp;
                <a href="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG') }}privacy" target="_blank">Privacy
                    Policy</a>.
            </p>
        </div>
    </div>

    <!-- Firebase Scripts -->
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js" defer></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-auth-compat.js" defer></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-firestore-compat.js" defer></script>

    <!-- intl-tel-input JS config -->
    <script>
        // ===== AUTH MODAL: intl-tel-input init =====
        let _itiInstance = null;
        function updateAuthInputMaxLength() {
            const inputEl = document.getElementById('authContactInput');
            if (!inputEl || !_itiInstance) return;
            const placeholder = inputEl.getAttribute('placeholder') || '';
            const digitsInPlaceholder = placeholder.replace(/\D/g, '').length;
            if (digitsInPlaceholder >= 6) {
                inputEl.maxLength = digitsInPlaceholder;
            } else {
                inputEl.maxLength = 15;
            }
        }

        (function initIti() {
            const inputEl = document.getElementById('authContactInput');
            if (!inputEl) return;

            // Restrict input to numbers only
            inputEl.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, '');
                updateAuthInputMaxLength();
            });

            _itiInstance = window.intlTelInput(inputEl, {
                initialCountry: 'auto',
                geoIpLookup: function (success, failure) {
                    fetch("https://get.geojs.io/v1/ip/geo.json")
                        .then(function (res) { return res.json(); })
                        .then(function (data) { success(data && data.country_code ? data.country_code.toLowerCase() : "gb"); })
                        .catch(function () { success("gb"); });
                },
                separateDialCode: true,
                countrySearch: true,
                showFlags: true,
                autoPlaceholder: "polite",
                strictMode: true,
                preferredCountries: ['gb', 'us', 'in', 'au', 'ca', 'de', 'fr', 'ae', 'sg', 'za'],
                dropdownContainer: document.body,
                loadUtils: () =>
                    import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js")
            });

            inputEl.addEventListener('countrychange', function () {
                inputEl.value = inputEl.value.replace(/\D/g, '');
                setTimeout(updateAuthInputMaxLength, 100);
            });

            inputEl.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    handleAuthContinue();
                }
            });

            const otpInput = document.getElementById('authOtpInput');
            if (otpInput) {
                otpInput.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        handleVerifyOtp();
                    }
                });
            }

            setTimeout(updateAuthInputMaxLength, 600);
        })();

        // ===== GOOGLE IDENTITY SERVICES AUTH =====
        const GOOGLE_CLIENT_ID = '{{ env("GOOGLE_CLIENT_ID") }}';
        const API_BASE_URL = '{{ env("API_URL") }}';
        const STRIPE_PUBLISHABLE_KEY = '{{ env("STRIPE_KEY") }}';

        // Reset the Google Sign-In button to its default state
        function _resetGoogleBtn() {
            if (window._googleBtnTimer) {
                clearTimeout(window._googleBtnTimer);
                window._googleBtnTimer = null;
            }
            const btn = document.getElementById('authGoogleBtn');
            if (!btn) return;
            btn.disabled = false;
            btn.innerHTML = `
                <svg class="auth-google-icon" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                    <path fill="none" d="M0 0h48v48H0z"/>
                </svg>
                Continue with Google`;
        }

        // Main Google Sign-In handler — called when user clicks the button
        function handleGoogleSignIn() {
            const btn = document.getElementById('authGoogleBtn');
            btn.disabled = true;
            btn.innerHTML = `<i class="fas fa-spinner fa-spin"></i>&nbsp; Connecting to Google…`;

            // Clear any error messages
            const errEl = document.getElementById('authGoogleError');
            if (errEl) errEl.textContent = '';

            // Ensure GSI library is loaded
            if (!window.google || !window.google.accounts) {
                _showAuthError('Google Sign-In library not loaded yet. Please try again.');
                _resetGoogleBtn();
                return;
            }

            // Safety timeout to reset button if popup is closed or blocked
            if (window._googleBtnTimer) clearTimeout(window._googleBtnTimer);
            window._googleBtnTimer = setTimeout(() => {
                const btnNow = document.getElementById('authGoogleBtn');
                if (btnNow && btnNow.disabled && btnNow.innerHTML.includes('fa-spinner')) {
                    _resetGoogleBtn();
                }
            }, 10000);

            // Reset button if user returns focus to main window after cancelling popup
            const resetOnFocus = () => {
                setTimeout(() => {
                    const btnNow = document.getElementById('authGoogleBtn');
                    if (btnNow && btnNow.disabled && btnNow.innerHTML.includes('fa-spinner')) {
                        _resetGoogleBtn();
                    }
                }, 800);
            };
            window.addEventListener('focus', resetOnFocus, { once: true });

            // Initialize GSI and trigger the popup
            window.google.accounts.id.initialize({
                client_id: GOOGLE_CLIENT_ID,
                callback: _onGoogleCredential,
                auto_select: false,
                cancel_on_tap_outside: true,
            });

            // Use the One-Tap prompt with a callback;
            // fall back to renderButton + click simulation
            window.google.accounts.id.prompt((notification) => {
                if (notification.isNotDisplayed() || notification.isSkippedMoment()) {
                    // One-Tap not available — use a token client popup instead
                    _triggerGoogleOAuthPopup();
                } else if (notification.isDismissedMoment()) {
                    _resetGoogleBtn();
                }
            });
        }

        // Trigger OAuth popup via TokenClient (reliable cross-browser fallback)
        function _triggerGoogleOAuthPopup() {
            const tokenClient = window.google.accounts.oauth2.initTokenClient({
                client_id: GOOGLE_CLIENT_ID,
                scope: 'openid email profile',
                callback: '', // Will be overwritten below
            });

            tokenClient.callback = async (tokenResponse) => {
                if (tokenResponse.error) {
                    _showAuthError('Google sign-in was cancelled or failed.');
                    _resetGoogleBtn();
                    return;
                }
                // Exchange access_token for id_token via userinfo endpoint
                try {
                    const userinfoRes = await fetch(
                        'https://www.googleapis.com/oauth2/v3/userinfo', {
                        headers: { Authorization: 'Bearer ' + tokenResponse.access_token }
                    }
                    );
                    const userinfo = await userinfoRes.json();
                    // Build a JWT-like id_token from the access token
                    // Actually the backend expects an id_token; use access_token as substitute
                    // since we verified userinfo. Send access_token as id_token.
                    await _sendTokenToBackend(tokenResponse.access_token);
                } catch (err) {
                    _showAuthError('Failed to fetch user info from Google.');
                    _resetGoogleBtn();
                }
            };

            tokenClient.requestAccessToken({ prompt: 'select_account' });
        }

        // Called by GSI One-Tap with a credential (id_token)
        async function _onGoogleCredential(response) {
            if (!response || !response.credential) {
                _showAuthError('Google sign-in failed. Please try again.');
                _resetGoogleBtn();
                return;
            }
            await _sendTokenToBackend(response.credential);
        }

        // POST the token to the Laravel backend
        async function _sendTokenToBackend(idToken) {
            const btn = document.getElementById('authGoogleBtn');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = `<i class="fas fa-spinner fa-spin"></i>&nbsp; Signing you in…`;
            }

            try {
                const response = await fetch(API_BASE_URL + '/auth/google-login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ id_token: idToken }),
                });

                const result = await response.json();

                if (result.status === true && result.token) {
                    // ✅ Success — store token in cookie (7 days)
                    _setAuthCookie('auth_token', result.token, 7);

                    // Store user info
                    if (result.user) {
                        _setAuthCookie('auth_user', JSON.stringify(result.user), 7);
                    }

                    // Update navbar UI to show logged-in state
                    _updateNavbarAfterLogin(result.user);

                    // Close the modal
                    closeAuthModal();

                    // If on dashboard or profile page, reload the page to load user data
                    const currentPath = window.location.pathname.toLowerCase();
                    if (currentPath.includes('/dashboard') || currentPath.includes('/profile') || currentPath.endsWith('dashboard') || currentPath.endsWith('profile')) {
                        window.location.reload();
                        return;
                    }

                    // Resume any pending action (e.g., "See prices")
                    if (typeof _pendingAfterAuth === 'function') {
                        const fn = _pendingAfterAuth;
                        _pendingAfterAuth = null;
                        fn();
                    }
                } else {
                    const msg = result.message || 'Authentication failed. Please try again.';
                    _showAuthError(msg);
                    _resetGoogleBtn();
                }
            } catch (err) {
                console.error('Google login API error:', err);
                _showAuthError('Network error. Please check your connection and try again.');
                _resetGoogleBtn();
            }
        }

        // Set a cookie with expiry
        function _setAuthCookie(name, value, days) {
            const expires = new Date();
            expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
            document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expires.toUTCString()}; path=/; SameSite=Lax`;
        }

        // Show an inline error message below the Google button
        function _showAuthError(message) {
            let errEl = document.getElementById('authGoogleError');
            if (!errEl) {
                errEl = document.createElement('p');
                errEl.id = 'authGoogleError';
                errEl.style.cssText = 'color:#d93025;font-size:13px;text-align:center;margin-top:10px;font-weight:600;';
                const btn = document.getElementById('authGoogleBtn');
                btn && btn.parentNode.insertBefore(errEl, btn.nextSibling);
            }
            errEl.textContent = message;
            // Auto-clear after 5 s
            setTimeout(() => { if (errEl) errEl.textContent = ''; }, 5000);
        }

        // Update the navbar/account dropdown to show the logged-in user
        function _updateNavbarAfterLogin(user) {
            if (!user) return;

            const firstName = user.first_name || '';
            const lastName = user.last_name || '';
            const fullName = (firstName + ' ' + lastName).trim() || 'User';
            const email = user.email || '';
            const avatar = user.profile_image || '';
            const initials = (firstName.charAt(0) + lastName.charAt(0)).toUpperCase() || 'U';

            // Update desktop account dropdown
            const avatarEl = document.querySelector('.account-avatar');
            if (avatarEl) {
                if (avatar) {
                    avatarEl.innerHTML = `<img src="${avatar}" alt="${fullName}" style="width:60px;height:60px;border-radius:50%;object-fit:cover;">`;
                } else {
                    avatarEl.textContent = initials;
                }
            }
            const nameEl = document.querySelector('.account-info h5');
            if (nameEl) nameEl.textContent = fullName;
            const emailEl = document.querySelector('.account-info span');
            if (emailEl) emailEl.textContent = email;

            // Auto-fill passenger details (if inputs exist and are currently empty)
            const pNameInput = document.getElementById('passengerFirstName');
            if (pNameInput && !pNameInput.value) {
                pNameInput.value = fullName;
            }
            const pEmailInput = document.getElementById('passengerEmail');
            if (pEmailInput && !pEmailInput.value) {
                pEmailInput.value = email;
            }
            const pPhoneInput = document.getElementById('passengerPhone');
            const userPhone = user.mobile || user.mobile_number || user.phone || '';
            if (pPhoneInput && !pPhoneInput.value && userPhone && window.passengerPhoneIti) {
                window.passengerPhoneIti.setNumber(userPhone);
                pPhoneInput.readOnly = true;
                pPhoneInput.style.backgroundColor = '#f3f4f6';
                pPhoneInput.style.cursor = 'not-allowed';
                pPhoneInput.title = 'Cannot change verified mobile number';
            }

            // Update mobile menu
            const mobileAvatar = document.querySelector('.mobile-avatar');
            if (mobileAvatar) mobileAvatar.textContent = initials;
            const mobileName = document.querySelector('.mobile-user h5');
            if (mobileName) mobileName.textContent = fullName;
            const mobileEmail = document.querySelector('.mobile-user span');
            if (mobileEmail) mobileEmail.textContent = email;

            // Show a user icon button in the navbar if there isn't one
            _showNavbarUserBtn(fullName, initials, avatar);
        }

        // Show the user icon/button in the navbar
        function _showNavbarUserBtn(fullName, initials, avatar) {
            // Ensure values are strings to prevent undefined/empty
            fullName = (fullName && fullName.trim() !== '') ? fullName.trim() : 'User';
            initials = (initials && initials.trim() !== '') ? initials.trim() : 'U';

            // Un-hide the hardcoded desktop auth menu item if it exists
            const desktopAuthItem = document.getElementById('desktopUserAuthItem');
            if (desktopAuthItem) {
                desktopAuthItem.style.setProperty('display', 'block', 'important');
            }

            // Update values
            const avatarSpan = document.getElementById('navbarUserAvatar');
            const nameSpan = document.getElementById('navbarUserName');
            if (avatarSpan) {
                if (avatar) {
                    avatarSpan.innerHTML = `<img src="${avatar}" style="width:28px;height:28px;border-radius:50%;object-fit:cover;">`;
                } else {
                    avatarSpan.innerHTML = ''; // Clear img if any
                    avatarSpan.textContent = initials;
                }
            }
            if (nameSpan) {
                nameSpan.textContent = fullName.split(' ')[0]; // First name only
            }

            // Update mobile user block
            const mobileUserBlock = document.getElementById('mobileUserBlock');
            const mobileUserAvatar = document.getElementById('mobileUserAvatar');
            const mobileUserName = document.getElementById('mobileUserName');

            if (mobileUserBlock) {
                mobileUserBlock.style.display = 'flex';
            }
            if (mobileUserAvatar) {
                if (avatar) {
                    mobileUserAvatar.innerHTML = `<img src="${avatar}" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">`;
                } else {
                    mobileUserAvatar.innerHTML = '';
                    mobileUserAvatar.textContent = initials;
                }
            }
            if (mobileUserName) {
                mobileUserName.textContent = fullName;
            }

            // Un-hide mobile auth-only menu links (Profile, Dashboard, Logout)
            document.querySelectorAll('.mobile-auth-only').forEach(el => {
                el.style.setProperty('display', 'flex', 'important');
            });
        }

        // Close dropdown if clicked outside
        document.addEventListener('click', function (e) {
            const dropdown = document.getElementById('navbarUserDropdown');
            const btn = document.getElementById('navbarUserBtn');
            if (dropdown && btn && !btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        });

        // Toggle user dropdown
        function _toggleUserDropdown(e) {
            if (e) e.stopPropagation();
            const dropdown = document.getElementById('navbarUserDropdown');
            if (dropdown) {
                dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
            }
        }

        // Logout functionality
        async function handleLogout() {
            const token = getCookieValue('auth_token');
            if (token) {
                try {
                    // Call logout API
                    await fetch(API_BASE_URL + '/auth/logout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + token
                        }
                    });
                } catch (e) {
                    console.error('Logout API failed', e);
                }
            }

            // 1. Clear BookingStore
            try {
                if (typeof BookingStore !== 'undefined' && BookingStore.clear) {
                    BookingStore.clear();
                }
            } catch (e) { }

            // 2. Clear all SessionStorage and LocalStorage
            try {
                sessionStorage.clear();
            } catch (e) { }

            try {
                localStorage.clear();
            } catch (e) { }

            // 3. Clear all Cookies across all paths and domain scopes
            const cookies = document.cookie.split(";");
            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i];
                const eqPos = cookie.indexOf("=");
                const name = eqPos > -1 ? cookie.substring(0, eqPos).trim() : cookie.trim();
                if (name) {
                    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=" + window.location.hostname + ";";
                }
            }

            // 4. Sign out from Firebase if initialized
            if (window.firebase && firebase.auth) {
                try {
                    await firebase.auth().signOut();
                } catch (e) { }
            }

            // 5. Reload page to reset state
            window.location.href = '/';
        }

        // Email / phone continue handler
        let _firebaseAuthObj = null;
        let _confirmationResult = null;
        let _isNewUser = false;
        let _currentMobile = '';
        let _currentDialCode = '';
        let _isIndiaFlow = false;
        let _indiaOtpEnc = null;
        let _isSendingAuthOtp = false;
        let _isVerifyingOtp = false;
        let _resendTimerInterval = null;
        let _resendCountdown = 0;

        function _startResendTimer(seconds = 30) {
            _resendCountdown = seconds;
            const btn = document.getElementById('authResendOtpBtn');
            const timerEl = document.getElementById('authResendTimer');
            if (!btn) return;

            btn.disabled = true;
            btn.style.opacity = '0.5';
            btn.style.cursor = 'not-allowed';
            btn.style.textDecoration = 'none';

            if (timerEl) {
                timerEl.style.display = 'inline';
                timerEl.textContent = `(${_resendCountdown}s)`;
            }

            if (_resendTimerInterval) clearInterval(_resendTimerInterval);
            _resendTimerInterval = setInterval(() => {
                _resendCountdown--;
                if (_resendCountdown <= 0) {
                    clearInterval(_resendTimerInterval);
                    _resendTimerInterval = null;
                    btn.disabled = false;
                    btn.style.opacity = '1';
                    btn.style.cursor = 'pointer';
                    btn.style.textDecoration = 'underline';
                    if (timerEl) timerEl.style.display = 'none';
                } else {
                    if (timerEl) timerEl.textContent = `(${_resendCountdown}s)`;
                }
            }, 1000);
        }

        async function _sendOtpProcess(isResend = false) {
            if (_isSendingAuthOtp) return;
            _isSendingAuthOtp = true;

            const continueBtn = document.getElementById('authContinueBtn');
            const resendBtn = document.getElementById('authResendOtpBtn');

            if (isResend) {
                if (resendBtn) {
                    resendBtn.disabled = true;
                    resendBtn.textContent = 'Sending...';
                }
            } else {
                if (continueBtn) {
                    continueBtn.disabled = true;
                    continueBtn.innerHTML = `<i class="fas fa-spinner fa-spin"></i>&nbsp; Checking…`;
                }
            }

            try {
                // 1. Check User
                const response = await fetch(API_BASE_URL + '/auth/check-user', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ login: 'mobile', value: _currentMobile }),
                });

                const result = await response.json();

                if (result.status === false) {
                    _showAuthError(result.message || 'Failed to verify number.');
                    if (!isResend) _resetContinueBtn();
                    return;
                }

                _isNewUser = !result.exists;

                if (_isIndiaFlow) {
                    // India Flow: Call POST /send-otp
                    if (!isResend && continueBtn) continueBtn.innerHTML = `<i class="fas fa-spinner fa-spin"></i>&nbsp; Sending OTP…`;

                    const sendOtpResponse = await fetch(API_BASE_URL + '/auth/send-otp', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                        body: JSON.stringify({
                            mobile: _currentMobile,
                            dialCode: _currentDialCode || '91'
                        }),
                    });

                    const sendOtpResult = await sendOtpResponse.json();

                    if (sendOtpResult.status === 'success' || sendOtpResult.status === true) {
                        _indiaOtpEnc = (sendOtpResult.data && sendOtpResult.data.enc) ? sendOtpResult.data.enc : (sendOtpResult.enc || null);
                        _showOtpUI();
                        _startResendTimer(30);
                    } else {
                        _showAuthError(sendOtpResult.message || 'Failed to send OTP.');
                        if (!isResend) _resetContinueBtn();
                        return;
                    }
                } else {
                    // Non-India Flow: Initialize Firebase and send SMS OTP
                    if (result.firebase) {
                        if (!firebase.apps || !firebase.apps.length) {
                            firebase.initializeApp(result.firebase);
                        }
                        _firebaseAuthObj = firebase.auth();
                    } else if (firebase.apps && firebase.apps.length) {
                        _firebaseAuthObj = firebase.auth();
                    }

                    if (!_firebaseAuthObj) {
                        throw new Error('Firebase configuration missing.');
                    }
                    _firebaseAuthObj.languageCode = 'en';

                    if (!isResend && continueBtn) continueBtn.innerHTML = `<i class="fas fa-spinner fa-spin"></i>&nbsp; Sending OTP…`;

                    // Safely clear old recaptchaVerifier
                    if (window.recaptchaVerifier) {
                        try {
                            window.recaptchaVerifier.clear();
                        } catch (e) {
                            console.warn('Recaptcha clear warning:', e);
                        }
                        window.recaptchaVerifier = null;
                    }

                    const recapContainer = document.getElementById('recaptcha-container');
                    if (recapContainer) {
                        recapContainer.innerHTML = '';
                    }

                    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                        'size': 'invisible'
                    });

                    _confirmationResult = await _firebaseAuthObj.signInWithPhoneNumber(_currentMobile, window.recaptchaVerifier);

                    // Show OTP UI & start countdown
                    _showOtpUI();
                    _startResendTimer(30);
                }

            } catch (err) {
                console.error('Check user / OTP Error:', err);
                _showAuthError(err.message || 'Failed to send OTP. Please try again.');
                if (!isResend) _resetContinueBtn();
            } finally {
                _isSendingAuthOtp = false;
                if (isResend && resendBtn) {
                    resendBtn.textContent = 'Resend OTP';
                }
            }
        }

        async function handleAuthContinue() {
            if (!_itiInstance || _isSendingAuthOtp) return;

            const inputEl = document.getElementById('authContactInput');
            const countryData = _itiInstance.getSelectedCountryData();
            const dialCode = countryData && countryData.dialCode ? String(countryData.dialCode) : '';
            const countryName = countryData && countryData.name ? countryData.name.split(' (')[0] : 'selected country';
            const rawVal = inputEl.value.replace(/\D/g, '');

            const placeholder = inputEl.getAttribute('placeholder') || '';
            const expectedDigits = placeholder.replace(/\D/g, '').length || 10;

            if (!rawVal) {
                _showAuthError('Please enter your mobile number.');
                inputEl.focus();
                return;
            }

            if (rawVal.length < Math.min(expectedDigits, 7) || rawVal.length > Math.max(expectedDigits, 15) || (_itiInstance.isValidNumber && !_itiInstance.isValidNumber())) {
                _showAuthError(`Please enter a valid mobile number for ${countryName}.`);
                inputEl.focus();
                return;
            }

            // Construct the E164 format
            let mobileNumber = _itiInstance.getNumber();
            if (!mobileNumber) {
                mobileNumber = '+' + dialCode + rawVal;
            }
            _currentMobile = mobileNumber;
            _currentDialCode = dialCode;
            _isIndiaFlow = (dialCode === '91' || mobileNumber.startsWith('+91'));
            _indiaOtpEnc = null;

            await _sendOtpProcess(false);
        }

        async function handleResendOtp() {
            if (_resendCountdown > 0 || _isSendingAuthOtp || !_currentMobile) return;
            await _sendOtpProcess(true);
            const otpInput = document.getElementById('authOtpInput');
            if (otpInput) {
                otpInput.value = '';
                otpInput.focus();
            }
            if (typeof showToast === 'function') {
                showToast('A new 6-digit OTP has been sent.', 'success');
            }
        }

        function _resetContinueBtn() {
            const btn = document.getElementById('authContinueBtn');
            if (btn) {
                btn.disabled = false;
                btn.innerHTML = `<i class="fas fa-arrow-right"></i> Continue`;
            }
        }

        function _showOtpUI() {
            // Hide step 1 wrapper entirely
            document.getElementById('authStep1').style.display = 'none';

            // Show OTP section
            document.getElementById('authOtpSection').style.display = 'block';
            document.getElementById('authOtpTarget').textContent = _currentMobile;

            const changeBtn = document.getElementById('authChangeNumberBtn');
            if (changeBtn) {
                if (typeof isAuthenticated === 'function' && isAuthenticated()) {
                    changeBtn.style.display = 'none';
                } else {
                    changeBtn.style.display = 'inline';
                }
            }

            // Show name/email if new user
            if (_isNewUser) {
                document.getElementById('authNewUserFields').style.display = 'block';
            } else {
                document.getElementById('authNewUserFields').style.display = 'none';
            }

            const otpInput = document.getElementById('authOtpInput');
            if (otpInput) {
                otpInput.value = '';
                setTimeout(() => otpInput.focus(), 150);
            }
        }

        function _showPhoneUI() {
            // Show step 1 wrapper entirely
            document.getElementById('authStep1').style.display = 'block';

            // Hide OTP section
            document.getElementById('authOtpSection').style.display = 'none';
            document.getElementById('authOtpInput').value = '';
            if (_resendTimerInterval) {
                clearInterval(_resendTimerInterval);
                _resendTimerInterval = null;
            }
            _resendCountdown = 0;
            _resetContinueBtn();
        }

        async function handleVerifyOtp() {
            if (_isVerifyingOtp) return;

            const otpInput = document.getElementById('authOtpInput');
            let otp = otpInput ? otpInput.value.trim().replace(/\D/g, '') : '';
            if (!otp || otp.length < 4) {
                _showAuthError('Please enter a valid 6-digit OTP.');
                if (otpInput) otpInput.focus();
                return;
            }

            let name = '';
            let email = '';

            if (_isNewUser) {
                name = document.getElementById('authNameInput').value.trim();
                email = document.getElementById('authEmailInput').value.trim();

                const nameCheck = validateFullName(name);
                if (!nameCheck.valid) {
                    _showAuthError(nameCheck.message);
                    document.getElementById('authNameInput').focus();
                    return;
                }

                const emailCheck = validateEmailAddress(email);
                if (!emailCheck.valid) {
                    _showAuthError(emailCheck.message);
                    document.getElementById('authEmailInput').focus();
                    return;
                }
            }

            const btn = document.getElementById('authVerifyBtn');
            const oldHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = `<i class="fas fa-spinner fa-spin"></i>&nbsp; Verifying…`;
            _isVerifyingOtp = true;

            try {
                const verifyPayload = {
                    mobile: _currentMobile,
                    name: name,
                    email: email,
                    otp: otp
                };

                if (_isIndiaFlow) {
                    // India Flow: Bypass Firebase confirmation, include enc & otp in payload
                    verifyPayload.enc = _indiaOtpEnc;
                } else {
                    // Non-India Flow: Verify OTP with Firebase
                    if (!_confirmationResult) {
                        throw new Error('SESSION_EXPIRED');
                    }
                    const result = await _confirmationResult.confirm(otp);
                    const idToken = await result.user.getIdToken();
                    verifyPayload.firebase_token = idToken;
                }

                // Send token/enc to backend
                const response = await fetch(API_BASE_URL + '/auth/verify-otp', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify(verifyPayload),
                });

                const verifyRes = await response.json();

                if (verifyRes.status === true && verifyRes.token) {
                    // Success!
                    _setAuthCookie('auth_token', verifyRes.token, 7);
                    if (verifyRes.user) {
                        _setAuthCookie('auth_user', JSON.stringify(verifyRes.user), 7);
                    }
                    _updateNavbarAfterLogin(verifyRes.user);
                    closeAuthModal();

                    // If on dashboard or profile page, reload the page to load user data
                    const currentPath = window.location.pathname.toLowerCase();
                    if (currentPath.includes('/dashboard') || currentPath.includes('/profile') || currentPath.endsWith('dashboard') || currentPath.endsWith('profile')) {
                        window.location.reload();
                        return;
                    }

                    if (typeof _pendingAfterAuth === 'function') {
                        const fn = _pendingAfterAuth;
                        _pendingAfterAuth = null;
                        fn();
                    }
                } else {
                    _showAuthError(verifyRes.message || 'OTP verification failed on server.');
                    btn.disabled = false;
                    btn.innerHTML = oldHtml;
                }

            } catch (error) {
                console.error('OTP Verify Error:', error);
                let errorMsg = 'Invalid OTP. Please check and try again.';

                const errCode = (error && error.code) ? String(error.code).toLowerCase() : '';
                const errMsg = (error && error.message) ? String(error.message) : '';

                if (errCode === 'auth/session-expired' || errCode === 'auth/code-expired' || errMsg.includes('SESSION_EXPIRED') || errMsg.includes('session-expired') || errMsg.includes('code-expired')) {
                    errorMsg = 'OTP session has expired. Please click "Resend OTP" to receive a new code.';
                    // Immediately enable Resend OTP button
                    if (_resendTimerInterval) {
                        clearInterval(_resendTimerInterval);
                        _resendTimerInterval = null;
                    }
                    _resendCountdown = 0;
                    const resendBtn = document.getElementById('authResendOtpBtn');
                    const timerEl = document.getElementById('authResendTimer');
                    if (resendBtn) {
                        resendBtn.disabled = false;
                        resendBtn.style.opacity = '1';
                        resendBtn.style.cursor = 'pointer';
                        resendBtn.style.textDecoration = 'underline';
                    }
                    if (timerEl) timerEl.style.display = 'none';
                } else if (errCode === 'auth/invalid-verification-code' || errMsg.includes('invalid-verification-code')) {
                    errorMsg = 'The 6-digit OTP you entered is incorrect. Please check and try again.';
                } else if (errCode === 'auth/too-many-requests') {
                    errorMsg = 'Too many attempts. Please wait a moment before trying again.';
                } else if (errMsg && errMsg !== 'SESSION_EXPIRED') {
                    errorMsg = errMsg;
                }

                _showAuthError(errorMsg);
                btn.disabled = false;
                btn.innerHTML = oldHtml;
            } finally {
                _isVerifyingOtp = false;
            }
        }

        // ===== AUTO-RESTORE SESSION ON PAGE LOAD =====
        (function restoreSession() {
            const token = getCookieValue('auth_token');
            const userJson = getCookieValue('auth_user');
            if (token && userJson) {
                try {
                    const user = JSON.parse(userJson);
                    _updateNavbarAfterLogin(user);
                } catch (e) { /* ignore malformed cookie */ }
            }
        })();
    </script>
    <!-- Track Ride Overlay -->
    <div class="track-ride-overlay" id="trackRideOverlay">
        <!-- Search Container -->
        <div class="track-ride-container" id="trackSearchContainer">
            <button class="track-inner-close-btn" onclick="toggleTrackRideOverlay(event)" aria-label="Close modal"><i
                    class="fas fa-times"></i></button>
            <h3>Track Your Ride</h3>
            <p>Enter your booking number to get live status</p>
            <div class="track-input-wrapper">
                <i class="fas fa-hashtag"></i>
                <input type="text" id="trackBookingNumber" placeholder="e.g. BKG-12345" />
            </div>
            <button class="btn-track-submit" id="btnTrackSubmit" onclick="submitTrackRide()">
                Track Now <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </div>

        <!-- Result Container -->
        <div class="track-result-container" id="trackResultContainer" style="display: none;">
            <button class="track-inner-close-btn" onclick="toggleTrackRideOverlay(event)" aria-label="Close modal"><i
                    class="fas fa-times"></i></button>
            <div class="track-status-header">
                <div class="track-header-badges">
                    <div class="booking-id-badge" id="displayBookingNo">BKG-12345</div>
                    <div class="track-header-right-actions">
                        <button type="button" class="track-refresh-btn" id="trackRefreshBtn"
                            onclick="refreshTrackingData(event)" title="Refresh tracking status"
                            aria-label="Refresh tracking">
                            <i class="fas fa-rotate-right"></i>
                            <span class="refresh-text">Refresh</span>
                        </button>
                        <div class="track-otp-badge" id="displayOtpBadge" style="display: none;">OTP: <span
                                id="displayOtpValue">--</span></div>
                    </div>
                </div>
                <h4 id="displayTrackingMessage">Driver is on the way.</h4>
                <div id="trackingBookingDetails" style="display: none;"></div>
            </div>

            <div class="track-content-flex">
                <div class="mobile-timeline-hint mobile-only" onclick="scrollToTimelineStatus()">
                    <i class="fas fa-list-check"></i>
                    <span>Scroll Down for Trip Status</span>
                    <i class="fas fa-chevron-down bounce-arrow"></i>
                </div>

                <div class="track-timeline-wrapper">
                    <ul class="tracking-timeline" id="trackingTimeline">
                        <!-- Rendered by JS -->
                    </ul>
                </div>

                <div class="track-map-wrapper" id="trackMapWrapper" style="display: none;">
                    <div id="liveTrackingMap"></div>
                </div>

                <div class="track-status-placeholder" id="trackStatusPlaceholder" style="display: none;">
                    <!-- Rendered by JS -->
                </div>
            </div>
        </div>
    </div>

    <style>
        .track-ride-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(10px);
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
        }

        .track-ride-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .track-close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .track-close-btn:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: rotate(90deg);
        }

        .track-inner-close-btn {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f3f4f6;
            color: #111;
            border: 1px solid #e5e7eb;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 20;
            transition: all 0.2s ease;
        }

        .track-inner-close-btn:hover {
            background: #111;
            color: #fff;
            border-color: #111;
        }

        .track-ride-container {
            position: relative;
            background: #fff;
            border-radius: 24px;
            padding: 40px;
            width: 90%;
            max-width: 450px;
            text-align: center;
            transform: translateY(30px) scale(0.95);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .track-ride-overlay.show .track-ride-container {
            transform: translateY(0) scale(1);
        }

        .track-ride-container h3 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
            color: #111;
        }

        .track-ride-container p {
            color: #666;
            margin-bottom: 30px;
            font-size: 15px;
        }

        .track-input-wrapper {
            position: relative;
            margin-bottom: 24px;
        }

        .track-input-wrapper i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 18px;
        }

        .track-input-wrapper input {
            width: 100%;
            padding: 18px 20px 18px 50px;
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 600;
            color: #111;
            transition: all 0.3s ease;
            outline: none;
            background: #f9fafb;
            text-transform: uppercase;
        }

        .track-input-wrapper input:focus {
            border-color: #111;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.05);
        }

        .track-input-wrapper input::placeholder {
            text-transform: none;
            font-weight: 500;
            color: #9ca3af;
        }

        .btn-track-submit {
            width: 100%;
            padding: 18px;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 16px;
            font-size: 17px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-track-submit:hover {
            background: #000;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-track-submit:active {
            transform: translateY(0);
            color: #fff !important;
        }

        /* Result Container */
        .track-result-container {
            position: relative;
            background: #fff;
            border-radius: 24px;
            padding: 20px;
            width: 95%;
            max-width: 900px;
            height: 85vh;
            display: flex;
            flex-direction: column;
            transform: translateY(30px) scale(0.95);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }

        .track-ride-overlay.show .track-result-container {
            transform: translateY(0) scale(1);
        }

        .track-status-header {
            text-align: left;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .track-header-badges {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 12px;
            padding-right: 45px;
        }

        .booking-id-badge {
            display: inline-block;
            background: #f3f4f6;
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            color: #111;
            border: 1px solid #e5e7eb;
            margin-bottom: 0;
        }

        .track-header-right-actions {
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .track-refresh-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: #ffffff;
            color: #111827;
            padding: 6px 13px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            border: 1px solid #e5e7eb;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            user-select: none;
            line-height: 1.2;
        }

        .track-refresh-btn:hover {
            background: #f3f4f6;
            border-color: #d1d5db;
            color: #000;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
        }

        .track-refresh-btn:active {
            transform: translateY(0);
            box-shadow: none;
        }

        .track-refresh-btn.is-refreshing {
            pointer-events: none;
            opacity: 0.85;
            background: #f9fafb;
        }

        .track-refresh-btn.is-refreshing i {
            animation: spin-refresh 0.75s linear infinite;
        }

        @keyframes spin-refresh {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .track-otp-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #000;
            color: #fff;
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .track-otp-badge span {
            /* color: #f9c106; */
            font-weight: 800;
            font-size: 15px;
            letter-spacing: 1px;
        }

        .track-status-header h4 {
            font-size: 22px;
            font-weight: 500;
            color: #111;
            margin: 0;
        }

        /* Track Route Details Card & Route Visualizer */
        .track-route-details-card {
            position: relative;
            background: #f9fafb;
            padding: 16px;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            margin-top: 15px;
        }

        .track-pickup-corner {
            position: absolute;
            top: 14px;
            right: 16px;
            text-align: right;
            background: #fff;
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            max-width: 220px;
        }

        .track-pickup-corner .pickup-label {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 5px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .track-pickup-corner .pickup-label i {
            color: #f9c106;
        }

        .track-pickup-corner .pickup-value {
            font-size: 13px;
            font-weight: 500;
            color: #111827;
            display: block;
        }

        .track-route-flow {
            margin-top: 4px;
            position: relative;
            padding-right: 195px;
            pointer-events: none;
        }

        .route-point-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            position: relative;
            z-index: 2;
        }

        .route-point-item:first-child {
            margin-bottom: 14px;
        }

        .route-point-item:first-child::after {
            content: '';
            position: absolute;
            left: 7px;
            top: 18px;
            bottom: -14px;
            width: 0;
            border-left: 2px dashed #9ca3af;
            z-index: 1;
        }

        .point-icon-pin {
            font-size: 16px;
            width: 16px;
            text-align: center;
            margin-top: 1px;
            flex-shrink: 0;
            position: relative;
            z-index: 2;
        }

        .point-icon-pin.yellow-pin {
            color: #f9c106;
        }

        .point-icon-pin.black-pin {
            color: #111;
        }

        .point-address {
            font-size: 14px;
            font-weight: 500;
            color: #111827;
            line-height: 1.35;
            word-break: break-word;
        }

        .route-line-dots {
            display: none;
        }

        .mobile-only {
            display: none !important;
        }

        .desktop-only {
            display: block;
        }

        .route-expand-btn {
            display: none;
        }

        .mobile-pickup-time-bar {
            display: none;
        }

        @media (max-width: 768px) {
            .track-header-badges {
                flex-direction: column;
                align-items: start;
                gap: 8px;
            }

            .track-header-right-actions {
                width: 100%;
                justify-content: flex-start;
                gap: 8px;
                flex-wrap: wrap;
            }

            .mobile-only {
                display: flex !important;
            }

            .desktop-only {
                display: none !important;
            }

            .track-route-details-card {
                padding: 12px 42px 12px 14px;
                cursor: pointer;
                user-select: none;
                transition: all 0.3s ease;
            }

            .track-route-flow {
                padding-right: 0;
            }

            .point-address {
                /* font-size: 13px; */
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: calc(100vw - 140px);
            }

            .track-route-details-card.expanded .point-address {
                white-space: normal;
                word-break: break-word;
                max-width: 100%;
            }

            .route-expand-btn {
                display: flex !important;
                align-items: center;
                justify-content: center;
                position: absolute;
                top: 14px;
                right: 12px;
                background: #fff;
                border: 1px solid #e5e7eb;
                border-radius: 50%;
                width: 26px;
                height: 26px;
                color: #6b7280;
                font-size: 11px;
                pointer-events: none;
                transition: transform 0.3s ease, background-color 0.2s ease;
            }

            .track-route-details-card.expanded .route-expand-btn i {
                transform: rotate(180deg);
            }

            .mobile-pickup-time-bar {
                display: flex !important;
                align-items: center;
                gap: 6px;
                margin-top: 10px;
            }

            .mobile-pickup-time-bar .pickup-label {
                font-weight: 700;
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .mobile-pickup-time-bar .pickup-value {
                font-size: 13px;
                font-weight: 500;
                color: #111827;
            }
        }

        .track-content-flex {
            display: flex;
            flex: 1;
            gap: 30px;
            overflow: hidden;
        }

        .track-timeline-wrapper {
            flex: 0 0 300px;
            overflow-y: auto;
            padding-left: 15px;
        }

        .track-map-wrapper {
            flex: 1;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            background: #f9fafb;
            border: 1px solid #eee;
        }

        .track-status-placeholder {
            flex: 1;
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 35px 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            min-height: 300px;
        }

        .status-placeholder-card {
            max-width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .status-icon-wrapper {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin-bottom: 20px;
            position: relative;
        }

        .status-icon-wrapper.yellow-pulse {
            background: rgba(245, 158, 11, 0.12);
            color: #d97706;
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4);
            animation: pulse-yellow-glow 2s infinite;
        }

        .status-icon-wrapper.blue-pulse {
            background: rgba(37, 99, 235, 0.12);
            color: #2563eb;
            box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4);
            animation: pulse-blue-glow 2s infinite;
        }

        .status-icon-wrapper.green-pulse {
            background: rgba(16, 185, 129, 0.12);
            color: #059669;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
            animation: pulse-green-glow 2s infinite;
        }

        .status-icon-wrapper.red-pulse {
            background: rgba(239, 68, 68, 0.12);
            color: #dc2626;
        }

        @keyframes pulse-yellow-glow {
            0% {
                transform: scale(0.98);
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 12px rgba(245, 158, 11, 0);
            }

            100% {
                transform: scale(0.98);
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0);
            }
        }

        @keyframes pulse-blue-glow {
            0% {
                transform: scale(0.98);
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 12px rgba(37, 99, 235, 0);
            }

            100% {
                transform: scale(0.98);
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0);
            }
        }

        @keyframes pulse-green-glow {
            0% {
                transform: scale(0.98);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 12px rgba(16, 185, 129, 0);
            }

            100% {
                transform: scale(0.98);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        .status-placeholder-title {
            font-size: 18px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 8px;
        }

        .status-placeholder-desc {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.5;
            margin-bottom: 18px;
        }

        .status-info-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
        }

        .status-pill-item {
            font-size: 12px;
            font-weight: 600;
            color: #374151;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            padding: 5px 12px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
        }

        .status-pill-item.green-badge {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border-color: rgba(16, 185, 129, 0.25);
        }

        #liveTrackingMap {
            width: 100%;
            height: 100%;
        }

        /* Modern Stepper-Matching Tracking Timeline */
        .tracking-timeline {
            list-style: none;
            padding: 10px 0 0 0;
            margin: 0;
            position: relative;
        }

        .tracking-timeline li {
            position: relative;
            padding-left: 48px;
            margin-bottom: 22px;
            text-align: left;
        }

        .tracking-timeline li:last-child {
            margin-bottom: 0;
        }

        /* Connecting vertical line */
        .tracking-timeline li::after {
            content: '';
            position: absolute;
            left: 17px;
            top: 34px;
            bottom: -22px;
            width: 0;
            border-left: 2px dotted #9ca3af;
            transition: all 0.4s ease;
        }

        .tracking-timeline li:last-child::after {
            display: none;
        }

        /* Timeline Icons - Matches Main Booking Stepper */
        .timeline-icon {
            position: absolute;
            left: 0;
            top: 0;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            background: #f3f4f6;
            color: #9ca3af;
            border: 1px solid #e5e7eb;
            z-index: 2;
            transition: all 0.3s ease;
        }

        /* Completed & Active State: Brand Yellow (#f9c106) with Dark Icon (#111) */
        .tracking-timeline li.completed .timeline-icon,
        .tracking-timeline li.active .timeline-icon {
            background: #f9c106;
            color: #111;
            border-color: #f9c106;
            box-shadow: 0 3px 8px rgba(249, 193, 6, 0.35);
        }

        /* Active State Pulse */
        .tracking-timeline li.active .timeline-icon {
            animation: stepperPulse 1.8s infinite;
        }

        @keyframes stepperPulse {
            0% {
                box-shadow: 0 0 0 0 rgba(249, 193, 6, 0.6);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(249, 193, 6, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(249, 193, 6, 0);
            }
        }

        /* Cancelled State */
        .tracking-timeline li.cancelled .timeline-icon {
            background: #ef4444;
            color: #fff;
            border-color: #ef4444;
        }

        .tracking-timeline .step-title {
            font-weight: 700;
            font-size: 15px;
            color: #9ca3af;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 2px;
            transition: all 0.3s ease;
        }

        .tracking-timeline li.completed .step-title,
        .tracking-timeline li.active .step-title {
            color: #111827;
            /* font-weight: 800; */
        }

        .tracking-timeline .step-desc {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.3;
        }

        .mobile-timeline-hint {
            display: none;
        }

        @media (max-width: 768px) {
            .track-status-header {
                margin-bottom: 0px;
                border-bottom: none;
            }

            .mobile-timeline-hint {
                display: none !important;
            }

            .mobile-timeline-hint.has-map {
                display: flex !important;
                align-items: center;
                justify-content: center;
                gap: 8px;
                background: #111827;
                color: #ffffff;
                padding: 9px 18px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 700;
                cursor: pointer;
                margin: 4px auto 6px auto;
                width: fit-content;
                transition: all 0.25s ease;
            }

            .mobile-timeline-hint:active {
                transform: scale(0.96);
            }

            .mobile-timeline-hint .bounce-arrow {
                font-size: 11px;
                /* color: #f9c106; */
                animation: bounceDown 1.6s infinite;
            }

            @keyframes bounceDown {

                0%,
                20%,
                50%,
                80%,
                100% {
                    transform: translateY(0);
                }

                40% {
                    transform: translateY(4px);
                }

                60% {
                    transform: translateY(2px);
                }
            }

            .track-content-flex {
                display: flex;
                flex-direction: column;
                overflow-y: auto;
                gap: 16px;
            }

            .track-map-wrapper {
                order: 1;
                min-height: 260px;
                flex: none;
            }

            .track-timeline-wrapper {
                order: 2;
                flex: none;
                height: auto;
                padding-left: 0;
            }

            .track-result-container {
                height: 90vh;
                padding: 20px;
                overflow-y: auto;
            }
        }

        /* Vehicle Accordion Styles - Premium & Elegant */
        .vehicle-item {
            flex-wrap: wrap;
        }

        .vehicle-accordion {
            flex: 1 1 100%;
            margin-top: 4px;
            border-top: 1px solid #f0f0f0;
            width: 100%;
            background-color: #fdfbf7;
            border-radius: 8px;
        }

        .accordion-toggle {

            border: none;
            color: black;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 8px 0;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .accordion-toggle:hover {
            color: #111;
        }

        .accordion-toggle i {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-left: 8px;
            font-size: 11px;
        }

        .accordion-toggle.open {
            color: #111;
        }

        .accordion-toggle.open i {
            transform: rotate(180deg);
        }

        .accordion-content {
            display: none;
            background: #ffffff;
            border-radius: 0 0 12px 12px;
            padding: 15px 20px 20px;
            margin-top: 5px;
            border-top: none;
            box-shadow: inset 0 4px 6px -6px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .accordion-tabs {
            display: flex;
            gap: 20px;
            /* margin-bottom: 20px; */
            padding-bottom: 4px;
            /* border-bottom: 1px solid #eaeaea; */
        }

        .accordion-tabs .tab-btn {
            background: none;
            border: none;
            font-weight: 600;
            font-size: 14px;
            color: #6b7280;
            cursor: pointer;
            /* padding: 8px 4px; */
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.3s ease;
        }

        .accordion-tabs .tab-btn:hover {
            color: #111;
        }

        .accordion-tabs .tab-btn.active {
            color: #111;
            font-weight: 700;
        }

        .accordion-tabs .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #111;
            border-radius: 2px 2px 0 0;
        }

        /* Inclusions & Exclusions Tab Container */
        .premium-tab-container {
            margin-bottom: 25px;
            border: 1px solid #e8e8e8;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
            flex-shrink: 0;
        }

        .premium-tab-container .accordion-content {
            padding: 0;
        }

        :not(.vehicle-accordion)>.premium-tab-container .accordion-content,
        #step5 .premium-tab-container .accordion-content {
            display: block;
        }

        .vehicle-accordion .accordion-content {
            display: none;
        }

        .vehicle-accordion .premium-tab-container {
            margin-bottom: 0;
            border: none;
            box-shadow: none;
            background: transparent;
        }

        .premium-tab-container .accordion-tabs {
            display: flex;
            gap: 15px;
            padding: 12px 18px 0 18px;
            /* margin-bottom: 16px; */
            /* border-bottom: 1px solid #eaeaea;
            background: #fafafa; */
        }

        .premium-tab-container .tab-btn {
            background: none;
            border: none;
            font-weight: 600;
            font-size: 14px;
            color: #6b7280;
            cursor: pointer;
            /* padding: 10px 6px; */
            position: relative;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.3s ease;
        }

        .premium-tab-container .tab-btn.active {
            color: #111;
        }

        .tab-icon-check {
            color: #28a745;
        }

        .tab-icon-cross {
            color: #dc3545;
        }

        .tab-pane {
            padding: 12px 18px 18px 18px;
        }

        .tab-points-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .tab-pane.inclusions-pane .tab-points-list,
        .inclusions-list {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 12px 24px !important;
        }

        .inclusions-list li.tab-point-item,
        .exclusions-list li.tab-point-item {
            padding-left: 0 !important;
        }

        .inclusions-list li.tab-point-item::before,
        .exclusions-list li.tab-point-item::before {
            display: none !important;
        }

        @media (max-width: 576px) {

            .tab-pane.inclusions-pane .tab-points-list,
            .inclusions-list {
                grid-template-columns: 1fr !important;
            }
        }

        .tab-point-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13.5px;
            color: #374151;
            line-height: 1.5;
        }

        .tab-point-item .point-icon {
            font-size: 12px;
            margin-top: 3.5px;
            flex-shrink: 0;
        }

        .tab-point-item .point-icon-check {
            color: #27ae60;
        }

        .tab-point-item .point-icon-cross {
            color: #e74c3c;
        }

        .vehicle-details-list {
            list-style: none;
            padding: 0;
            margin: 0 0 0 10px;
            text-align: left;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .vehicle-details-list li {
            position: relative;
            padding-left: 24px;
            font-size: 13px;
            color: #555;
            line-height: 1.6;
        }

        .vehicle-details-list li::before {
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            left: 0;
            top: 2px;
            font-size: 13px;
        }

        .inclusions-list li::before {
            content: "\f00c";
            color: #27ae60;
        }

        .exclusions-list li::before {
            content: "\f00d";
            color: #e74c3c;
        }

        @media (max-width: 576px) {
            .premium-tab-container {
                margin-bottom: 20px;
            }

            .premium-tab-container .accordion-tabs {
                padding: 0px;
                gap: 10px;
            }

            .premium-tab-container .tab-btn {
                font-size: 13px;
                padding: 8px 4px;
            }

            .tab-pane {
                padding: 14px 16px;
            }

            .tab-point-item {
                font-size: 13px;
                gap: 8px;
            }
        }
    </style>

    <script id="socketIoScript" src="{{ asset('js/socket.io.min.js') }}" data-cfasync="false"></script>
    <script>
        let liveTrackingSocket = null;
        let currentLiveTrackingId = null;
        let currentTrackedBookingNo = '';
        let driverMarker = null;
        let trackingMap = null;

        function ensureSocketIoLoaded(callback) {
            if (typeof io !== 'undefined') {
                if (callback) callback();
                return;
            }

            function loadCdnFallback() {
                if (typeof io !== 'undefined') {
                    if (callback) callback();
                    return;
                }
                const existingCdn = document.getElementById('socketIoCdnScript');
                if (existingCdn) return;
                const cdnS = document.createElement('script');
                cdnS.id = 'socketIoCdnScript';
                cdnS.setAttribute('data-cfasync', 'false');
                cdnS.src = 'https://cdn.socket.io/4.7.5/socket.io.min.js';
                cdnS.onload = function () {
                    console.log('Socket.io loaded from CDN.');
                    if (callback) callback();
                };
                cdnS.onerror = function () {
                    console.error('Failed to load Socket.io from CDN fallback.');
                };
                document.head.appendChild(cdnS);
            }

            let attempts = 0;
            const interval = setInterval(() => {
                attempts++;
                if (typeof io !== 'undefined') {
                    clearInterval(interval);
                    if (callback) callback();
                } else if (attempts > 15) { // after 1.5 seconds, load CDN fallback
                    clearInterval(interval);
                    console.warn("Local Socket.io not detected, falling back to CDN...");
                    loadCdnFallback();
                }
            }, 100);
        }

        function toggleTrackRideOverlay(e) {
            if (e) e.preventDefault();
            const overlay = document.getElementById('trackRideOverlay');
            if (overlay.classList.contains('show')) {
                overlay.classList.remove('show');
                document.body.style.overflow = '';

                // reset state
                setTimeout(() => {
                    document.getElementById('trackSearchContainer').style.display = 'block';
                    document.getElementById('trackResultContainer').style.display = 'none';
                    document.getElementById('trackBookingNumber').value = '';
                    currentTrackedBookingNo = '';
                    currentLiveTrackingId = null;
                    if (liveTrackingSocket) {
                        try { liveTrackingSocket.close(); } catch (e) { }
                    }
                }, 400);

            } else {
                overlay.classList.add('show');
                document.body.style.overflow = 'hidden';
                setTimeout(() => {
                    document.getElementById('trackBookingNumber').focus();
                }, 400);
            }
        }

        function openBookingPreviewFromConfirmation(e) {
            if (e) e.preventDefault();
            const currentNum = $('#confirmNum').text().trim();
            const state = typeof BookingStore !== 'undefined' ? BookingStore.getState() : {};
            const key = window.currentBookingPreviewHash || state.preview_hash || bookingData.preview_hash || state.job_no || bookingData.job_no || (currentNum && currentNum !== '—' && currentNum !== 'GR-2026-14851' ? currentNum : (bookingData.bookingId || state.bookingId || ''));
            if (key) {
                const bookingKey = encodeURIComponent(key);
                const url = '{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG_II') }}/booking-preview/' + bookingKey;
                window.open(url, '_blank');
            } else {
                showToast('Booking preview will be available shortly.', 'info');
            }
        }

        function openTrackRideWithCurrentBooking() {
            const bookingId = $('#confirmNum').text().trim();
            if (bookingId) {
                const overlay = document.getElementById('trackRideOverlay');
                if (!overlay.classList.contains('show')) {
                    toggleTrackRideOverlay();
                }
                setTimeout(() => {
                    document.getElementById('trackBookingNumber').value = bookingId;
                    submitTrackRide();
                }, 450);
            } else {
                toggleTrackRideOverlay();
            }
        }

        function toggleMobileRouteDetails(card) {
            if (window.innerWidth <= 768) {
                card.classList.toggle('expanded');
            }
        }

        async function submitTrackRide() {
            const num = document.getElementById('trackBookingNumber').value.trim();
            if (!num) {
                showGlobalToast('Please enter a booking number', false);
                return;
            }

            const btn = document.getElementById('btnTrackSubmit');
            const originalHtml = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin me-2"></i> Tracking...';
            btn.disabled = true;

            try {
                // Determine API URL
                let apiUrl = '{{ env("API_URL") }}';
                if (!apiUrl || apiUrl.includes('env(')) apiUrl = window.location.origin + '/api';

                const response = await fetch(apiUrl + '/tracking/booking', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ job_no: num })
                });

                const res = await response.json();

                if (res.status === true && res.data) {
                    currentTrackedBookingNo = num;
                    renderTrackingResult(num, res.data);
                } else {
                    showGlobalToast(res.message || 'Booking not found', false);
                }
            } catch (error) {
                console.error('Tracking Error:', error);
                showGlobalToast('Failed to track booking. Try again.', false);
            } finally {
                btn.innerHTML = originalHtml;
                btn.disabled = false;
            }
        }

        async function refreshTrackingData(e) {
            if (e) e.preventDefault();
            const num = currentTrackedBookingNo ||
                (document.getElementById('displayBookingNo') ? document.getElementById('displayBookingNo').innerText.trim() : '') ||
                (document.getElementById('trackBookingNumber') ? document.getElementById('trackBookingNumber').value.trim() : '');

            if (!num) {
                showGlobalToast('No active booking to refresh', false);
                return;
            }

            const refreshBtn = document.getElementById('trackRefreshBtn');
            let originalHtml = '';
            if (refreshBtn) {
                originalHtml = refreshBtn.innerHTML;
                refreshBtn.disabled = true;
                refreshBtn.classList.add('is-refreshing');
                refreshBtn.innerHTML = '<i class="fas fa-rotate-right fa-spin"></i> <span class="refresh-text">Refreshing...</span>';
            }

            try {
                let apiUrl = '{{ env("API_URL") }}';
                if (!apiUrl || apiUrl.includes('env(')) apiUrl = window.location.origin + '/api';

                const response = await fetch(apiUrl + '/tracking/booking', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ job_no: num })
                });

                const res = await response.json();

                if (res.status === true && res.data) {
                    currentTrackedBookingNo = num;
                    renderTrackingResult(num, res.data);
                    showGlobalToast('Tracking status refreshed', true);
                } else {
                    showGlobalToast(res.message || 'Failed to refresh tracking data', false);
                }
            } catch (error) {
                console.error('Refresh Tracking Error:', error);
                showGlobalToast('Failed to refresh tracking. Please try again.', false);
            } finally {
                if (refreshBtn) {
                    refreshBtn.disabled = false;
                    refreshBtn.classList.remove('is-refreshing');
                    refreshBtn.innerHTML = originalHtml;
                }
            }
        }

        function formatPickupDateTime(dateStr) {
            if (!dateStr || dateStr === '-') return '-';
            if (typeof dateStr === 'string' && /[a-zA-Z]{3}/.test(dateStr)) {
                return dateStr;
            }
            try {
                let cleanStr = String(dateStr).trim();
                let parsableStr = cleanStr.replace(/-/g, '/').replace('T', ' ').split('.')[0];
                let d = new Date(parsableStr);

                if (isNaN(d.getTime())) {
                    d = new Date(cleanStr);
                }

                if (isNaN(d.getTime())) return dateStr;

                const day = d.getDate();
                let ordinal = 'th';
                const j = day % 10, k = day % 100;
                if (j === 1 && k !== 11) ordinal = 'st';
                else if (j === 2 && k !== 12) ordinal = 'nd';
                else if (j === 3 && k !== 13) ordinal = 'rd';

                const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                const month = monthNames[d.getMonth()];
                const year = d.getFullYear();

                let hours = d.getHours();
                const minutes = d.getMinutes().toString().padStart(2, '0');
                const ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12;
                const strHours = hours.toString().padStart(2, '0');

                return `${day}${ordinal} ${month} ${year} ${strHours}:${minutes} ${ampm}`;
            } catch (e) {
                return dateStr;
            }
        }

        function renderTrackingResult(jobNo, data) {
            document.getElementById('trackSearchContainer').style.display = 'none';
            document.getElementById('trackResultContainer').style.display = 'flex';

            document.getElementById('displayBookingNo').innerText = jobNo;
            document.getElementById('displayTrackingMessage').innerText = data.tracking.message;

            const otpBadge = document.getElementById('displayOtpBadge');
            const otpValue = document.getElementById('displayOtpValue');
            const otp = (data.booking && data.booking.otp) ? data.booking.otp : (data.tracking && data.tracking.otp ? data.tracking.otp : '');
            const tl = data.timeline || {};
            const rawStatus = (data.booking && data.booking.status) || (data.tracking && data.tracking.status) || (data.tracking && data.tracking.job_status) || (data.status || '');
            const normStatus = String(rawStatus).toLowerCase();
            const hideOtpForStatus = !!(tl.onboard || tl.completed || tl.cancelled || ['onboard', 'onboarded', 'started', 'completed', 'complete', 'finished', 'cancelled', 'cancel', 'canceled'].includes(normStatus));

            if (otpBadge && otp && !hideOtpForStatus) {
                otpBadge.style.display = 'inline-flex';
                if (otpValue) otpValue.innerText = otp;
            } else if (otpBadge) {
                otpBadge.style.display = 'none';
            }

            const bookingDetails = document.getElementById('trackingBookingDetails');
            if (data.booking) {
                bookingDetails.style.display = 'block';
                bookingDetails.innerHTML = `
                    <div class="track-route-details-card" onclick="toggleMobileRouteDetails(this)">
                        <div class="track-pickup-corner desktop-only">
                            <span class="pickup-label"><i class="fas fa-clock"></i> PICKUP TIME</span>
                            <span class="pickup-value">${formatPickupDateTime(data.booking.pickup_date)}</span>
                        </div>
                        <button type="button" class="route-expand-btn mobile-only" aria-label="Expand route details">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="track-route-flow">
                            <div class="route-point-item">
                                <div class="point-icon-pin yellow-pin">
                                    <i class="fas fa-location-dot"></i>
                                </div>
                                <div class="point-address">${data.booking.from_place || '-'}</div>
                            </div>
                            <div class="route-line-dots"></div>
                            <div class="route-point-item">
                                <div class="point-icon-pin black-pin">
                                    <i class="fas fa-location-dot"></i>
                                </div>
                                <div class="point-address">${data.booking.to_place || '-'}</div>
                            </div>
                        </div>
                        <div class="mobile-pickup-time-bar mobile-only">
                            <span class="pickup-label"><i class="fas fa-clock"></i> PICKUP TIME:</span>
                            <span class="pickup-value">${formatPickupDateTime(data.booking.pickup_date)}</span>
                        </div>
                    </div>
                `;
            } else {
                bookingDetails.style.display = 'none';
                bookingDetails.innerHTML = '';
            }

            // Render Animated Timeline
            const ul = document.getElementById('trackingTimeline');
            ul.innerHTML = '';

            const steps = [
                { key: 'created', title: 'Booking Created', desc: 'Your booking has been placed', icon: 'fa-file-invoice' },
                { key: 'confirmed', title: 'Confirmed', desc: 'Driver has accepted your ride', icon: 'fa-user-check' },
                { key: 'dispatch', title: 'Dispatched', desc: 'Driver is on the way to pickup', icon: 'fa-car-side' },
                { key: 'onboard', title: 'Onboard', desc: 'Trip has started', icon: 'fa-route' },
                { key: 'completed', title: 'Completed', desc: 'You have reached destination', icon: 'fa-check-circle' }
            ];

            if (tl.cancelled) {
                ul.innerHTML += `
                    <li class="cancelled">
                        <div class="timeline-icon"><i class="fas fa-times"></i></div>
                        <div class="timeline-content">
                            <span class="step-title">Cancelled</span>
                            <span class="step-desc">This booking was cancelled</span>
                        </div>
                    </li>`;
            } else {
                let lastActive = 0;
                steps.forEach((step, idx) => {
                    if (tl && tl[step.key]) {
                        lastActive = idx;
                    }
                });

                steps.forEach((step, idx) => {
                    let liClass = 'inactive';
                    if (idx < lastActive) {
                        liClass = 'completed';
                    } else if (idx === lastActive) {
                        liClass = 'active';
                    }

                    const iconHtml = `<i class="fas ${step.icon}"></i>`;

                    ul.innerHTML += `
                        <li class="${liClass}">
                            <div class="timeline-icon">${iconHtml}</div>
                            <div class="timeline-content">
                                <span class="step-title">${step.title}</span>
                                <span class="step-desc">${step.desc}</span>
                            </div>
                        </li>`;
                });
            }

            // Handle Live Tracking Map / Status Placeholder
            const mapWrap = document.getElementById('trackMapWrapper');
            const placeholderWrap = document.getElementById('trackStatusPlaceholder');
            const hintElem = document.querySelector('.mobile-timeline-hint');

            if (data.tracking && data.tracking.live_tracking === 'yes' && data.tracking.socket_url) {
                if (mapWrap) mapWrap.style.display = 'block';
                if (placeholderWrap) placeholderWrap.style.display = 'none';
                if (hintElem) hintElem.classList.add('has-map');
                initLiveTrackingMap();
                connectLiveTrackingSocket(data.tracking.socket_url, data.tracking.tracking_id);
            } else {
                if (mapWrap) mapWrap.style.display = 'none';
                if (placeholderWrap) {
                    placeholderWrap.style.display = 'flex';
                    renderStatusPlaceholder(data);
                }
                if (hintElem) hintElem.classList.remove('has-map');
            }
        }

        function renderStatusPlaceholder(data) {
            const placeholderWrap = document.getElementById('trackStatusPlaceholder');
            if (!placeholderWrap) return;

            const tl = (data && data.timeline) ? data.timeline : {};
            let currentStatus = 'confirmed';

            if (tl.cancelled) {
                currentStatus = 'cancelled';
            } else if (tl.completed) {
                currentStatus = 'completed';
            } else if (tl.onboard) {
                currentStatus = 'onboard';
            } else if (tl.dispatch) {
                currentStatus = 'dispatch';
            } else if (tl.confirmed) {
                currentStatus = 'confirmed';
            } else if (tl.created) {
                currentStatus = 'created';
            }

            let html = '';
            if (currentStatus === 'completed') {
                html = `
                    <div class="status-placeholder-card status-completed">
                        <div class="status-icon-wrapper green-pulse">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h4 class="status-placeholder-title">Trip Completed Successfully!</h4>
                        <p class="status-placeholder-desc">
                            Thank you for riding with GoRide. We hope you enjoyed your journey!
                        </p>
                        <div class="status-info-pills">
                            <span class="status-pill-item green-badge"><i class="fas fa-flag-checkered me-1"></i> Destination Reached</span>
                        </div>
                    </div>
                `;
            } else if (currentStatus === 'cancelled') {
                html = `
                    <div class="status-placeholder-card status-cancelled">
                        <div class="status-icon-wrapper red-pulse">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h4 class="status-placeholder-title">Booking Cancelled</h4>
                        <p class="status-placeholder-desc">
                            This booking was cancelled. If you need assistance or wish to rebook, please contact support.
                        </p>
                    </div>
                `;
            } else if (currentStatus === 'dispatch' || currentStatus === 'onboard') {
                html = `
                    <div class="status-placeholder-card status-ontheway">
                        <div class="status-icon-wrapper blue-pulse">
                            <i class="fas fa-route"></i>
                        </div>
                        <h4 class="status-placeholder-title">Driver En Route</h4>
                        <p class="status-placeholder-desc">
                            Your trip is in progress! Your driver is on the way to your destination.
                        </p>
                        <div class="status-info-pills">
                            <span class="status-pill-item"><i class="fas fa-shield-alt me-1"></i> Driver Assigned</span>
                        </div>
                    </div>
                `;
            } else {
                html = `
                    <div class="status-placeholder-card status-preparing">
                        <div class="status-icon-wrapper yellow-pulse">
                            <i class="fas fa-car-side"></i>
                        </div>
                        <h4 class="status-placeholder-title">Driver Preparing for Departure</h4>
                        <p class="status-placeholder-desc">
                            Your booking is confirmed! Your assigned driver is currently preparing for your trip. Live map tracking will be activated once the driver starts heading to your location.
                        </p>
                        <div class="status-info-pills">
                            <span class="status-pill-item"><i class="fas fa-clock me-1"></i> Pickup Scheduled</span>
                            <span class="status-pill-item"><i class="fas fa-check-circle me-1"></i> Booking Confirmed</span>
                        </div>
                    </div>
                `;
            }

            placeholderWrap.innerHTML = html;
        }

        function scrollToTimelineStatus() {
            const el = document.getElementById('trackingTimeline');
            if (el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        function initLiveTrackingMap() {
            if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
                const script = document.createElement('script');
                script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCtkJtXBZPLBZIgjgpu-eAG5WQ1HwW4EwE&libraries=geometry";
                script.onload = () => setupMap();
                document.head.appendChild(script);
            } else {
                setupMap();
            }
        }

        function getLiveTrackingCarIcon(angle) {
            const carSvg = `
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                    <g transform="translate(64,64) rotate(${angle}) translate(-32,-64)" filter="drop-shadow(0px 4px 6px rgba(0,0,0,0.4))">
                        <rect x="12" y="8" width="40" height="104" rx="18" fill="#111111"/>
                        <path d="M 17 42 Q 32 32 47 42 L 44 54 H 20 Z" fill="#ffffffff"/>
                        <path d="M 19 86 Q 32 94 45 86 L 42 76 H 22 Z" fill="#ffffffff"/>
                        <rect x="9" y="46" width="6" height="10" rx="3" fill="#ffffffff"/>
                        <rect x="49" y="46" width="6" height="10" rx="3" fill="#ffffffff"/>
                        <rect x="15" y="11" width="34" height="98" rx="15" fill="none" stroke="#333333" stroke-width="1.5"/>
                        <rect x="18" y="10" width="8" height="4" rx="2" fill="#E8F0FF"/>
                        <rect x="38" y="10" width="8" height="4" rx="2" fill="#E8F0FF"/>
                        <rect x="16" y="108" width="10" height="3" rx="1.5" fill="#FF3B30"/>
                        <rect x="38" y="108" width="10" height="3" rx="1.5" fill="#FF3B30"/>
                        <rect x="22" y="58" width="20" height="8" rx="2" fill="#FFC107"/>
                    </g>
                </svg>
            `;
            return {
                url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(carSvg.trim()),
                scaledSize: new google.maps.Size(40, 40),
                anchor: new google.maps.Point(20, 20)
            };
        }

        function setupMap() {
            if (trackingMap) {
                if (google.maps.event && google.maps.event.trigger) {
                    google.maps.event.trigger(trackingMap, 'resize');
                }
                return;
            }
            const mapEl = document.getElementById('liveTrackingMap');
            if (!mapEl) return;

            const mapOptions = {
                zoom: 15,
                center: { lat: 51.5074, lng: -0.1278 }, // Default to London initially
                disableDefaultUI: true,
                zoomControl: true,
                styles: [
                    { "featureType": "all", "elementType": "geometry.fill", "stylers": [{ "weight": "2.00" }] },
                    { "featureType": "all", "elementType": "geometry.stroke", "stylers": [{ "color": "#9c9c9c" }] },
                    { "featureType": "all", "elementType": "labels.text", "stylers": [{ "visibility": "on" }] },
                    { "featureType": "landscape", "elementType": "all", "stylers": [{ "color": "#f2f2f2" }] },
                    { "featureType": "landscape", "elementType": "geometry.fill", "stylers": [{ "color": "#ffffff" }] },
                    { "featureType": "landscape.man_made", "elementType": "geometry.fill", "stylers": [{ "color": "#ffffff" }] },
                    { "featureType": "poi", "elementType": "all", "stylers": [{ "visibility": "off" }] },
                    { "featureType": "road", "elementType": "all", "stylers": [{ "saturation": -100 }, { "lightness": 45 }] },
                    { "featureType": "road", "elementType": "geometry.fill", "stylers": [{ "color": "#eeeeee" }] },
                    { "featureType": "road", "elementType": "labels.text.fill", "stylers": [{ "color": "#7b7b7b" }] },
                    { "featureType": "road", "elementType": "labels.text.stroke", "stylers": [{ "color": "#ffffff" }] },
                    { "featureType": "road.highway", "elementType": "all", "stylers": [{ "visibility": "simplified" }] },
                    { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{ "visibility": "off" }] },
                    { "featureType": "transit", "elementType": "all", "stylers": [{ "visibility": "off" }] },
                    { "featureType": "water", "elementType": "all", "stylers": [{ "color": "#46bcec" }, { "visibility": "on" }] },
                    { "featureType": "water", "elementType": "geometry.fill", "stylers": [{ "color": "#c8d7d4" }] }
                ]
            };
            trackingMap = new google.maps.Map(mapEl, mapOptions);

            driverMarker = new google.maps.Marker({
                map: trackingMap,
                icon: getLiveTrackingCarIcon(0)
            });
        }

        function connectLiveTrackingSocket(url, trackingId) {
            ensureSocketIoLoaded(() => {
                try {
                    if (typeof io === 'undefined') {
                        console.error("Socket.io is not loaded.");
                        return;
                    }

                    if (liveTrackingSocket && currentLiveTrackingId === trackingId && liveTrackingSocket.connected) {
                        return;
                    }

                    if (liveTrackingSocket) {
                        try { liveTrackingSocket.close(); } catch (e) { }
                    }
                    currentLiveTrackingId = trackingId;

                    // 1. Connect Customer to Socket Server
                    let token = '';
                    if (typeof getCookieValue === 'function') {
                        token = getCookieValue('auth_token') || 'CUSTOMER_BEARER_TOKEN';
                    } else {
                        token = 'CUSTOMER_BEARER_TOKEN';
                    }

                    liveTrackingSocket = io(url, {
                        transports: ['websocket', 'polling'],
                        auth: {
                            token: token,
                            user_type: "customer",
                            platform: "{{ env('SOCKET_PLATFORM', 'development') }}"
                        }
                    });

                    const socketPlatform = "{{ env('SOCKET_PLATFORM', 'development') }}";
                    const formattedTripId = String(trackingId).startsWith(socketPlatform + '_') ? String(trackingId) : `${socketPlatform}_${trackingId}`;

                    // 2. Join the specific trip room after connecting
                    liveTrackingSocket.on("connect", () => {
                        console.log('Customer connected to socket for trip:', formattedTripId);
                        liveTrackingSocket.emit("join_trip", { trip_id: formattedTripId });
                    });

                    let lastPos = null;

                    // 3. Listen for driver location updates
                    liveTrackingSocket.on("driver_location", (locationData) => {
                        try {
                            // console.log("New Driver Location Received:", locationData);
                            if (locationData && locationData.lat && locationData.lng) {
                                const newPos = new google.maps.LatLng(locationData.lat, locationData.lng);

                                if (!lastPos) {
                                    trackingMap.setCenter(newPos);
                                    driverMarker.setPosition(newPos);
                                    if (locationData.heading !== undefined) {
                                        driverMarker.setIcon(getLiveTrackingCarIcon(locationData.heading));
                                    }
                                } else {
                                    animateMarker(driverMarker, lastPos, newPos);
                                    let calculatedHeading = 0;
                                    if (locationData.heading !== undefined) {
                                        calculatedHeading = locationData.heading;
                                    } else if (google.maps.geometry && google.maps.geometry.spherical) {
                                        calculatedHeading = google.maps.geometry.spherical.computeHeading(lastPos, newPos);
                                    }
                                    driverMarker.setIcon(getLiveTrackingCarIcon(calculatedHeading));
                                    trackingMap.panTo(newPos);
                                }
                                lastPos = newPos;
                            }
                        } catch (e) { console.error('Socket message parse error', e); }
                    });

                    // 4. Listen for other trip status events
                    // liveTrackingSocket.on("driver_arrived", () => {
                    //     showGlobalToast("Driver has arrived at your pickup location!", true);
                    //     const msgEl = document.getElementById('displayTrackingMessage');
                    //     if (msgEl) msgEl.innerText = "Driver has arrived.";
                    // });

                    liveTrackingSocket.on("driver_arrived", () => {
                        showGlobalToast("Your trip has started.", true);
                        updateLiveTrackingTimeline('onboard');
                    });

                    liveTrackingSocket.on("trip_completed", () => {
                        showGlobalToast("Trip finished successfully.", true);
                        updateLiveTrackingTimeline('completed');
                        liveTrackingSocket.emit("leave_trip", { trip_id: formattedTripId });
                        setTimeout(() => toggleTrackRideOverlay(), 3000); // auto-close after 3s
                    });

                    liveTrackingSocket.on("connect_error", (e) => console.error('Socket Error', e));

                } catch (e) {
                    console.error("WebSocket connection failed", e);
                }
            });
        }

        function updateLiveTrackingTimeline(activeKey) {
            const steps = ['created', 'confirmed', 'dispatch', 'onboard', 'completed'];
            const activeIdx = steps.indexOf(activeKey);
            if (activeIdx === -1) return;

            const ul = document.getElementById('trackingTimeline');
            if (!ul) return;
            const lis = ul.querySelectorAll('li');

            lis.forEach((li, idx) => {
                li.className = '';
                if (idx < activeIdx) li.classList.add('completed');
                else if (idx === activeIdx) li.classList.add('active');
            });

            if (activeKey === 'onboard' || activeKey === 'completed') {
                const otpBadge = document.getElementById('displayOtpBadge');
                if (otpBadge) otpBadge.style.display = 'none';
            }

            // Also update the display message based on activeKey
            const msgs = {
                'dispatch': 'Driver is on the way.',
                'onboard': 'Trip has started.',
                'completed': 'Trip finished successfully.'
            };
            if (msgs[activeKey]) {
                const msgEl = document.getElementById('displayTrackingMessage');
                if (msgEl) msgEl.innerText = msgs[activeKey];
            }
        }

        function animateMarker(marker, startPos, endPos) {
            let start = null;
            const duration = 1000;

            function step(timestamp) {
                if (!start) start = timestamp;
                const progress = timestamp - start;
                const percent = Math.min(progress / duration, 1);

                const currentLat = startPos.lat() + (endPos.lat() - startPos.lat()) * percent;
                const currentLng = startPos.lng() + (endPos.lng() - startPos.lng()) * percent;

                marker.setPosition(new google.maps.LatLng(currentLat, currentLng));

                if (progress < duration) {
                    window.requestAnimationFrame(step);
                } else {
                    marker.setPosition(endPos);
                }
            }
            window.requestAnimationFrame(step);
        }

        function showGlobalToast(msg, success = true) {
            const toastMsg = document.getElementById('globalToastMsg');
            if (toastMsg) {
                toastMsg.innerText = msg;
                document.getElementById('globalToastIcon').className = success ? 'fas fa-check-circle' : 'fas fa-exclamation-circle text-danger';
                document.getElementById('globalToast').classList.add('show');
                setTimeout(() => {
                    document.getElementById('globalToast').classList.remove('show');
                    document.getElementById('globalToastIcon').className = 'fas fa-check-circle';
                }, 3000);
            } else {
                alert(msg);
            }
        }

        // Vehicle Accordion Functions
        function toggleVehicleAccordion(btn) {
            $(btn).toggleClass('open');
            const content = $(btn).parent().find('.accordion-content');
            content.slideToggle(300);

            if ($(btn).hasClass('open')) {
                $(btn).find('.acc-text').text('Hide Details');
            } else {
                $(btn).find('.acc-text').text('View Inclusions & Exclusions');
            }
        }

        function switchVehicleTab(btn, tab) {
            const tabsContainer = $(btn).closest('.accordion-tabs');
            const contentContainer = $(btn).closest('.accordion-content');

            tabsContainer.find('.tab-btn').removeClass('active');
            $(btn).addClass('active');

            contentContainer.find('.tab-pane').hide();
            contentContainer.find('.' + tab + '-pane').fadeIn(300);
        }
    </script>
    <!-- Global Floating WhatsApp Button (Icon Only) -->
    <a href="https://api.whatsapp.com/send/?phone=447950323242&text=Hi%2C%20I%20need%20a%20cab.%20Could%20you%20help%20me%20book%20one%3F&type=phone_number&app_absent=0" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="global-whatsapp-btn"
       aria-label="WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    <!-- Global Toast -->
    <div id="globalToast" class="global-toast">
        <i id="globalToastIcon" class="fas fa-check-circle"></i>
        <span id="globalToastMsg"></span>
    </div>
</body>

</html>