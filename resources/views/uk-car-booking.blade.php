<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoRide</title>
    <!-- Google Identity Services -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.8.1/build/css/intlTelInput.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        rel="stylesheet">
    <link rel="shortcut icon" href="https://www.goride.net.in/goride/img/Go-Ride-fav-icon.webp" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/css/intlTelInput.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Minus+Inlier+Sans&display=swap');

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .premium-otp-input {
            width: 100%; padding: 5px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 24px; letter-spacing: 12px; text-align: center; font-weight: 700; transition: all 0.3s ease; box-sizing: border-box; outline: none; color: #111; background: #f9fafb;
        }
        .premium-otp-input:focus {
            border-color: #111; background: #fff; box-shadow: 0 0 0 4px rgba(0,0,0,0.05);
        }
        .premium-otp-input::placeholder {
            letter-spacing: normal; font-weight: 500; font-size: 16px; color: #9ca3af;
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
            font-size: 14px;
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
            background: #f7f7f7 !important;
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
            padding-bottom: 25px;
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
            background: #f9f9f9;
            border: 1px solid #ddd;
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
        }

        .time-dropdown-item:last-child {
            border-bottom: none;
        }

        .time-dropdown-item:hover {
            background: #f5f5f5;
            padding-left: 20px;
        }

        .time-dropdown-item.selected {
            background: #f0f0f0;
            color: #000;
            font-weight: 700;
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
            padding: 11px 13px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 17px;
            transition: all 0.3s ease;
            background: #f5f5f5;
        }

        .form-group-uber input:focus,
        .form-group-uber select:focus {
            outline: none;
            background: #fff;
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
            width: 55px;
            height: 55px;
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
            background: #f9f9f9;
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

        .time-panel-header-clear {
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            background: none;
            border: none;
            color: #000;
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
        }

        .time-input-icon {
            position: absolute;
            left: 12px;
            top: 14px;
            color: #333;
        }

        .time-input-field {
            width: 100%;
            padding: 12px 35px;
            border-radius: 8px;
            border: 1px solid #ddd;
            background: #f9f9f9;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            color: #000;
        }

        .form-group-uber textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background: #f5f5f5;
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
            right: 12px;
            top: 16px;
            color: #333;
            font-size: 12px;
            pointer-events: none;
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
            margin-bottom: 40px;
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
            margin-bottom: 12px;
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
            left: -320px;
            width: 300px;
            height: max-content;
            background: #fff;
            z-index: 9999;
            transition: .35s;
            display: flex;
            flex-direction: column;
            box-shadow: 5px 0 30px rgba(0, 0, 0, .15);
        }

        .mobile-menu.show {
            left: 0;
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
            padding: 9px 24px;
            background: black;
            border: 1px solid #dcdcdc;
            border-radius: 2px;
            color: white;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.25s ease;
            border-radius: 23px;
        }

        .edit-icon-btn i {
            font-size: 11px;
        }

        .edit-icon-btn:active {
            transform: scale(0.95);
        }

        .selected-car-summary,
        .booking-summary {
            display: none;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #e5e5e5;
        }

        .summary-title {
            font-size: 15px;
    /* font-weight: 700; */
    /* color: #666; */
    margin-bottom: 15px;
        }

        .selected-car-row {
            display: flex;
            align-items: center;
            gap: 7px;
            justify-content: center;
        }

        .summary-car-image {
            width: 70px;
            height: 70px;
            object-fit: contain;
            border-radius: 10px;
        }

        .summary-car-details {
            flex: 1;
        }

        .summary-car-name {
            margin-bottom: 0px !important;
            font-size: 18px;
            font-weight: 700;
            color: #111;
        }

        .summary-car-info {
            display: flex;
            gap: 18px;

            color: #666;
            font-size: 14px;
        }

        .summary-car-info span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .summary-car-price {
            font-size: 20px;
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
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .summary-label {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .summary-label i {
            width: 16px;
            text-align: center;
            color: #666;
        }

        .summary-label {
            color: #666;
        }

        .summary-value {
            color: #111;
            font-weight: 600;
            text-align: right;
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
            width: 104px;
            height: 73px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .driver-car-banner-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
        }

        .driver-car-banner-name {
            font-size: 15px;
            font-weight: 700;
            color: #111;
            margin-bottom: 4px;
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
            margin-bottom: 8px;
            justify-content: space-around;
            align-items: center;
        }

        .driver-text h4 {
            margin: 0;
            font-size: 16px;
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
            font-size: 20px;
            font-weight: 700;
        }

        .driver-accept-btn {
            padding: 6px 18px;
            min-height: auto;
            font-size: 14px;
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
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 20px;
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
            font-size: 16px;
        }

        /* NEW STEP 7 CLASSES */
        .rc-new-driver-card,
        .rc-vehicle-card,
        .rc-bid-card {
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
            margin-bottom: 16px;
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
            grid-template-columns: 1fr 1fr 1fr;
            background: #fafafa;
            border-radius: 8px;
            padding: 12px;
            text-align: center;
        }

        .rc-driver-stat-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .rc-driver-stat-col.border-left-right {
            border-left: 1px solid #eee;
            border-right: 1px solid #eee;
        }

        .rc-driver-stat-col i {
            color: #444;
            font-size: 16px;
            margin-bottom: 4px;
        }

        .rc-driver-stat-col strong {
            display: block;
            font-size: 14px;
            color: #111;
        }

        .rc-driver-stat-col span {
            font-size: 14px;
        }

        .rc-card-subtitle {
            font-size: 11px;
            font-weight: 700;
            color: #888;
            letter-spacing: 1px;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        .rc-vehicle-top {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
            align-items: center;
        }

        .rc-vehicle-img-wrapper {
            width: 140px;
            height: 90px;
            flex-shrink: 0;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .rc-vehicle-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .rc-vehicle-info-right h4 {
            margin: 0 0 6px 0;
            font-size: 16px;
            font-weight: 700;
        }

        .rc-vehicle-tag {
            display: inline-block;
            border: 1px solid #f9c106;
            color: #d77f00;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 12px;
            margin-bottom: 8px;
        }

        .rc-vehicle-features {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 14px;
            color: #555;
            font-weight: 600;
        }

        .rc-vehicle-features span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .rc-vehicle-amenities-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 8px;
        }

        .rc-amenity-box {
            border: 1px solid #f0f0f0;
            border-radius: 8px;
            padding: 10px 4px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            text-align: center;
        }

        .rc-amenity-box i {
            color: #444;
            font-size: 16px;
        }

        .rc-amenity-box span {
            font-size: 14px;
            font-weight: 500;
        }

        .rc-bid-card {
            background: #fafafa;
        }

        .rc-bid-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .rc-bid-badge {
            background: #e6f7eb;
            color: #128741;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .rc-bid-bottom {
            display: flex;
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
            font-size: 11px;
            color: #111;
            font-weight: 600;
        }
        .help-modal{
    border:0;
    border-radius:16px;
    overflow:hidden;
}

.help-modal .modal-header{
    border-bottom:1px solid #eee;
    padding:16px 20px;
}

.help-modal .modal-title{
    font-size:20px;
    font-weight:700;
}

.help-modal .btn-close{
    font-size:14px;
    opacity:1;
}

.help-modal .modal-body{
    padding:28px 20px;
}

.help-icon{
    width:70px;
    height:70px;
    margin:0 auto 18px;
    border-radius:50%;
    background:#f8be00;
    color:#000;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
}

.help-modal a{
    color:#111;
    text-decoration:none;
    font-weight:600;
}

.driver-wrap{
        display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
}

        @media (max-width: 576px) {
            .rc-vehicle-amenities-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .rc-vehicle-top {
                /* flex-direction: column; */
                align-items: flex-start;
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
            padding: 50px 0;
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
            background: #f5f5f5 !important;
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
            align-items: center;
            padding: 14px 16px;
            cursor: pointer;
            transition: .3s;
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
        }

        .trip-datetime-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #f8f8f8;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-size: 18px;
        }

        .trip-datetime-title {
            font-size: 13px;
           
            font-weight: 600;
        }

        .trip-datetime-value {
            font-size: 16px;
            /* font-weight:700; */
            color: #111;
            margin-top: 2px;
        }

        /* Mobile only */
        @media (max-width:768px) {

.iti input{
        padding:   12px;
        font-size: 17px;
}

            /* .time-hint {
    font-size: 14px;
   
    margin-bottom: 7px;
} */
.time-inputs {
    margin-bottom:0px;
}

.time-panel-header {
    margin-bottom: 8px;
}
             .time-selection-panel {
                            padding: 10px 40px;
                    }
            .driver-divider {
                display: none;
            }

            .driver-wrap {
                display: flex;
                flex-direction: column;
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
                font-size: 16px !important;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                display: block;
                width: 100%;
                cursor: pointer;
                max-width: 300px;
            }

            .mobile-from.expanded-text,
            .mobile-to.expanded-text {
                white-space: normal;
                word-wrap: break-word;
            }

            .mobile-trip-item {
                font-size: 16px;
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
                font-size: 12px;
                gap: 8px;
            }

            .booking-summary-item {
                font-size: 16px;
            }
        }

        @media (max-width: 576px) {
            .counter-btn{
                width: 28px;
    height: 28px;
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
            .driver-car-banner-details {
                flex-direction: column;
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
                padding: 8px 10px;
                font-size: 12px;
            }

            .edit-icon-btn i {
                font-size: 10px;
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
                top: 70px;
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

            .hero-form-section {
                width: 100%;
                max-width: 100%;
                min-height: fit-content;
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
            .form-section#step1{
                padding-bottom: 0px;
            }

            .step-bottom-btns {
                margin-top: auto !important;
                padding-bottom: 30px !important;
            }

            .navbar-menu.hide-on-mobile {
                display: none;
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
                flex-wrap: wrap;
                gap: 10px;
                font-size: 13px;
            }

            .summary-car-price {
                font-size: 20px;
            }

            .booking-summary-item {
                font-size: 16px;
            }

            #mcsEnteredDetails {
                display: grid !important;
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 12px !important;
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

            #mcsEnteredDetails .summary-label {
                flex-shrink: 0;
                display: flex;
                align-items: center;
            }

            #mcsEnteredDetails .summary-label i {
                font-size: 13px;
                color: #555;
                width: auto;
            }

            #mcsEnteredDetails .summary-value {
                font-size: 16px !important;
                font-weight: 700;
                color: #111;
                text-align: left !important;
                word-break: break-all;
                overflow-wrap: break-word;
                min-width: 0;
            }

            #mcsCarDetails .selected-car-row {
                     background: #f9f9f9;
        border-radius: 10px;
        padding: 8px 12px;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
            }
.confirm-modal-content{
    padding:0px !important;
}
            #mcsCarDetails .summary-car-name {
                font-size: 14px;
                font-weight: 700;
                color: #111;
                margin-bottom: 0 !important;
            }

            #mcsCarDetails .summary-car-price {
                font-size: 16px !important;
                font-weight: 800;
                color: #111;
                white-space: nowrap;
            }

            .summary-title {
                font-size: 14px;
            }

            .driver-info {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: 12px;
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
                align-items: center;
                gap: 8px;
                margin-bottom: 5px;
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
                justify-content: space-between;
                align-items: center;
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
            gap: 20px;
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
            align-items: center;
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
            align-items: center;
            margin-bottom: 4px;
        }

        .v-name {
            font-size: 20px;
            font-weight: 700;
            color: #111;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: nowrap;
        }

        .v-price {
            font-size: 22px;
            font-weight: 700;
            color: #111;
        }

        .v-sub {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
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
            font-size: 13px;
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
            font-size: 11px;
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
                gap: 10px;
                padding: 10px;
                align-items: flex-start;
                margin-bottom: 0px;
            }

            .vehicle-left {
                width: 100px;
                height: 80px;
                margin: 0;
                flex-shrink: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
            }

            .vehicle-left img {
                width: 100%;
                height: 80px;
                object-fit: contain;
            }

           

            .vehicle-right {
                flex: 1;
                display: flex;
                flex-direction: column;
                gap: 3px;
            }

            .v-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 8px;
                margin-bottom: 0;
            }

            .v-name {
                font-size: 17px;
                font-weight: 700;
                margin-bottom: 0;
            }

            .v-price {
                font-size: 17px;
                font-weight: 700;
                white-space: nowrap;
            }

            .v-sub {
                display: flex;
                justify-content: flex-start;
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
                gap: 6px;
                font-size: 15px;
                margin-bottom: 0;
                flex-wrap: wrap;
                align-items: center;
            }

            .v-features span {
                display: flex;
                align-items: center;
                gap: 2px;
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
                font-size: 13px;
                padding: 2px 5px;
                border: 1px solid #ddd;
                border-radius: 4px;
                white-space: nowrap;
            }

            .v-footer {
                display: flex;
                justify-content: flex-end;
                align-items: center;
                gap: 8px;
                margin-top: 2px;
            }

            .btn-v-select {
                      background: black;
        color: white;
        border: none;
        padding: 7px 11px;
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
                padding: 0 6px;
                flex-direction: column;
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
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        .auth-modal-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
        }

        
        .otp-code{
            font-size: 15px; color: #555; line-height: 1.5; margin: 0;
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
            from { opacity: 0; transform: translateY(40px) scale(0.96); }
            to   { opacity: 1; transform: translateY(0)  scale(1);    }
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
        .auth-modal-close:hover { background: #e8e8e8; }
        .auth-modal-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 6px;
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
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            text-decoration: none;
        }
        .auth-google-btn:hover {
            border-color: #4285f4;
            background: #f8f9ff;
            box-shadow: 0 4px 16px rgba(66,133,244,0.15);
            transform: translateY(-1px);
            color: #111;
        }
        .auth-google-btn:active { transform: translateY(0); }
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
            padding-left: 119px !important; /* beats intl-tel-input JS inline style */
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
            box-shadow: 0 0 0 3px rgba(0,0,0,0.06);
            background: #fff;
        }
        #authPhoneWrapper .iti__tel-input::placeholder { color: #bbb; }
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
            box-shadow: 0 12px 40px rgba(0,0,0,0.18);
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
            box-shadow: 0 4px 16px rgba(0,0,0,0.18);
        }
        .auth-continue-btn:hover {
            background: #000;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.22);
        }
        .auth-continue-btn:active { transform: translateY(0); }
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
</head>

<body>
    <nav class="navbar-uber">
        <div class="navbar-brand-uber">
            <img src="https://www.goride.net.in/goride/img/logo-light.png" alt="GoRide UK Logo">
        </div>
        <ul class="navbar-menu">
            <!--<li><button onclick="toggleDropdown('language')">-->
            <!--        <i class="fas fa-globe me-2"></i>EN-->
            <!--    </button></li>-->
           <li>
    <a href="#" data-bs-toggle="modal" data-bs-target="#helpModal">
        Help
    </a>
</li>
            <!--<li style="position:relative;">-->
            <!--    <button class="user-btn" onclick="toggleDropdown('user')">-->
            <!--        <i class="fas fa-user-circle"></i>-->
            <!--        Mogana-->
            <!--        <i class="fas fa-chevron-down"></i>-->
            <!--    </button>-->
            <!--</li>-->
        </ul>
        <div id="language-dropdown" class="dropdown-menu-navbar">
            <button onclick="selectLanguage('en')">English</button>
            <button onclick="selectLanguage('hi')">à¤¹à¤¿à¤‚à¤¦à¥€</button>
            <button onclick="selectLanguage('ta')">à®¤à®®à®¿à®´à¯</button>
            <button onclick="selectLanguage('te')">à°¤à±†à°²à±à°—à±</button>
            <button onclick="selectLanguage('kn')">à²•à²¨à³à²¨à²¡</button>
        </div>
        <div id="user-dropdown" class="account-dropdown">
            <div class="account-header">
                <div class="account-avatar">MG</div>
                <div class="account-info">
                    <h5>Mogana Priya</h5>
                    <span>mogana@email.com</span>
                </div>
            </div>
            <div class="account-menu">
                <a href="#"><i class="fas fa-user"></i><span>My Profile</span></a>
                <a href="#"><i class="fas fa-car"></i><span>My Rides</span></a>
                <a href="#"><i class="fas fa-map-marker-alt"></i><span>Saved Places</span></a>
                <a href="#"><i class="fas fa-wallet"></i><span>Wallet</span></a>
                <a href="#"><i class="fas fa-tag"></i><span>Offers</span></a>
                <a href="#"><i class="fas fa-cog"></i><span>Settings</span></a>
            </div>
            <div class="account-footer">
                <a href="#"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
        </div>
        <!--<button class="mobile-menu-btn" id="mobileHamburger" onclick="toggleMobileMenu()">-->
        <!--    <i class="fas fa-bars"></i>-->
        <!--</button>-->
        <button class="mobile-menu-btn" id="mobileMapBtn" style="display:none;" onclick="toggleMobileMap()">
            <i class="fas fa-map"></i>
        </button>
        <div class="mobile-menu-overlay" id="mobileOverlay" onclick="toggleMobileMenu()"></div>
        <div class="mobile-menu" id="mobileMenu">
            <div class="mobile-menu-header">
                <img src="https://www.goride.net.in/goride/img/logo-light.png" alt="GoRide">
                <button onclick="toggleMobileMenu()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mobile-user">
                <div class="mobile-avatar">MG</div>
                <div>
                    <h5>Mogana Priya</h5>
                    <span>mogana@email.com</span>
                </div>
            </div>
            <div class="mobile-menu-links">
                <a href="#"><i class="fas fa-user"></i>My Profile</a>
                <a href="#"><i class="fas fa-car"></i>My Rides</a>
                <a href="#"><i class="fas fa-map-marker-alt"></i>Saved Places</a>
                <a href="#"><i class="fas fa-wallet"></i>Wallet</a>
                <a href="#"><i class="fas fa-tag"></i>Offers</a>
                <a href="#"><i class="fas fa-language"></i>Language</a>
                <a href="#"><i class="fas fa-circle-question"></i>Help</a>
                <a href="#"><i class="fas fa-gear"></i>Settings</a>
            </div>
            <div class="mobile-menu-footer">
                <button><i class="fas fa-right-from-bracket"></i>Logout</button>
            </div>
        </div>
    </nav>
    <div id="mobileActionBar">
        <a href="tel:+441234567890" class="mob-action-btn">
            <div class="mob-action-icon">
                <i class="fas fa-phone"></i>
            </div>
            <span>Call Us</span>
        </a>
        <a href="https://wa.me/441234567890" target="_blank" class="mob-action-btn">
            <div class="mob-action-icon">
                <i class="fab fa-whatsapp"></i>
            </div>
            <span>WhatsApp</span>
        </a>
        <button class="mob-action-btn" onclick="document.getElementById('pickupInput').focus()">
            <div class="mob-action-icon">
                <i class="fas fa-car-side"></i>
            </div>
            <span>Book a Ride</span>
        </button>
    </div>
    <div class="hero-container row g-0">
        <div class="hero-form-section  col-md-5 col-12">
            <!-- MOBILE MAP BAR - only visible on mobile steps >= 2 -->
            <div id="mobileMapBar" style="display: none;">
                <span><i class="fas fa-location-dot" style="color: #333; margin-right:5px;"></i> <span
                        id="mobileMapRouteText">Your route</span></span>
                <button onclick="toggleMobileMap()">
                    <i class="fas fa-map"></i> View Map
                </button>
            </div>
            <!-- COMPACT MOBILE SUMMARY -->
            <div id="mobileCompactSummary" class="mobile-trip-summary">
                <div class="mobile-trip-header" onclick="toggleTripSummary()" style="align-items: flex-start;">
                    <div class="location-group-wrapper" style="width: 100%; gap: 12px; margin-right: 15px;">
                        <div class="route-indicator"
                            style="padding-top: 4px; padding-bottom: 4px; justify-content: space-between;">
                            <i class="fas fa-location-dot route-dot-start" style="font-size: 15px;"></i>
                            <div class="route-line" style="min-height: 18px; margin: 4px 0;"></div>
                            <i class="fas fa-location-dot route-dot-end" style="font-size: 15px;"></i>
                        </div>
                        <div class="location-fields"
                            style="flex: 1; display: flex; flex-direction: column; justify-content: space-between; padding: 2px 0;">
                            <div class="mobile-from"
                                style="font-weight: 600; font-size: 14px; color: #111; display: flex; align-items: center; gap: 0;">
                                <span id="mcsPickup" class="text-truncate"></span>
                            </div>
                            <div class="mobile-to"
                                style="font-weight: 600; font-size: 14px; color: #111; margin-top: 10px; display: flex; align-items: center; gap: 0;">
                                <span id="mcsDropoff" class="text-truncate"></span>
                            </div>
                        </div>
                    </div>
                    <i class="fas fa-chevron-down" id="tripSummaryArrow" style="margin-top: 6px;"></i>
                </div>
                <div class="mobile-trip-body" id="mobileTripBody">
                    <div class="mobile-trip-item">
                        <i class="fas fa-calendar"></i>
                        <span id="mcsDateTime"></span>
                    </div>
                    <div id="mcsCarDetails"
                        style="display:none; margin-top: 15px; border-top: 1px solid #eee; padding-top: 15px;">
                        <div class="selected-car-row" style="margin-bottom: 8px;">
                            <div class="summary-car-details">
                               <h4 style="font-size:16px; margin-bottom:6px; font-weight:700; display:flex; align-items:center; gap:8px;">
    <i class="fas fa-car text-secondary"></i>
    <span id="mcsCarName">-</span>
</h4>

                            </div>
                            <div class="summary-car-price" id="mcsCarPrice"
                                style="font-size: 17px; font-weight: 700; margin-left: auto;">£0</div>
                        </div>
                        <div class="booking-summary-list" id="mcsEnteredDetails"
                            style="font-size: 14px; display:none; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                            <div class="booking-summary-item" id="mcsPassengerNameContainer"
                                style="display:none;  border-radius: 8px; justify-content: space-between;">
                                <span class="summary-label"><i class="fas fa-user"
                                        style="color: #666; font-size: 15px;"></i></span>
                                <span class="summary-value" id="mcsPassengerName"
                                    style="font-weight: 700; font-size: 14px; text-align: right; word-break: break-word;">-</span>
                            </div>
                            <div class="booking-summary-item" id="mcsPassengerPhoneContainer"
                                style="display:none;  border-radius: 8px; justify-content: space-between;">
                                <span class="summary-label"><i class="fas fa-phone"
                                        style="color: #666; font-size: 15px;"></i></span>
                                <span class="summary-value" id="mcsPassengerPhone"
                                    style="font-weight: 700; font-size: 14px; text-align: right; word-break: break-word;">-</span>
                            </div>
                            <div class="booking-summary-item" id="mcsPassengerEmailContainer"
                                style="display:none;   border-radius: 8px; justify-content: space-between;">
                                <span class="summary-label"><i class="fas fa-envelope"
                                        style="color: #666; font-size: 15px;"></i></span>
                                <span class="summary-value" id="mcsPassengerEmail"
                                    style="font-weight: 700; font-size: 14px; text-transform: none; text-align: right; word-break: break-word;">-</span>
                            </div>
                            <div class="booking-summary-item"
                                style=" border-radius: 8px; justify-content: space-between;">
                                <span class="summary-label"><i class="fas fa-users"
                                        style="color: #666; font-size: 15px;"></i></span>
                                <span class="summary-value" id="mcsPassengerCount"
                                    style="font-weight: 700; font-size: 15px;">1</span>
                            </div>
                            <div class="booking-summary-item" id="mcsLuggageContainer"
                                style="display:none;  border-radius: 8px; justify-content: space-between;">
                                <span class="summary-label"><i class="fas fa-suitcase"
                                        style="color: #666; font-size: 15px;"></i></span>
                                <span class="summary-value" id="mcsLuggageCount"
                                    style="font-weight: 700; font-size: 15px;">0</span>
                            </div>
                            <div class="booking-summary-item" id="mcsHandLuggageContainer"
                                style="display:none; border-radius: 8px; justify-content: space-between;">
                                <span class="summary-label"><i class="fas fa-briefcase"
                                        style="color: #666; font-size: 15px;"></i></span>
                                <span class="summary-value" id="mcsHandLuggageCount"
                                    style="font-weight: 700; font-size: 15px;">0</span>
                            </div>
                            <div class="booking-summary-item" id="mcsBabySeatContainer"
                                style="display:none; border-radius: 8px; justify-content: space-between;">
                                <span class="summary-label"><i class="fas fa-baby-carriage"
                                        style="color: #666; font-size: 15px;"></i></span>
                                <span class="summary-value" id="mcsBabySeats"
                                    style="font-weight: 700; font-size: 15px;">0</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- TIME SELECTION PANEL -->
            <div id="timeSelectionPanel" class="time-selection-panel">
                <div class="time-panel-header">
                    <button class="time-panel-header-back" onclick="hidePickupTimePanel()">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <button class="time-panel-header-clear" onclick="hidePickupTimePanel()">Clear</button>
                </div>
                <h3 class="time-panel-title" id="timePanelTitle">When do you want to be picked up?</h3>
                <p class="time-panel-subtitle">From <span id="timePanelLocation"></span></p>
                <div class="time-inputs" id="genericTimeInputs">
                    <div class="date-time-screen">
                        <!-- Date Column -->
                        <div>
                            <!-- Dynamic Date Label (hidden by default) -->
                            <div class="form-group-uber mb-2" id="dateLabelContainer" style="display:none;">
                                <label id="dateLabel" style="font-size:14px; font-weight:600;"></label>
                            </div>
                            <div class="time-input-wrapper">
                                <i class="fas fa-calendar time-input-icon"></i>
                                <input type="text" id="date" placeholder="Today" class="time-input-field" readonly>
                                <i class="fas fa-chevron-down time-input-chevron"></i>
                            </div>
                        </div>
                        <!-- Time Column -->
                        <div>
                            <!-- Dynamic Time Label (hidden by default) -->
                            <div class="form-group-uber mb-2" id="timeLabelContainer" style="display:none;">
                                <label id="timeLabel" style="font-size:14px; font-weight:600;"></label>
                            </div>
                            <!-- CUSTOM TIME DROPDOWN -->
                            <div class="time-dropdown-wrapper" id="mainTimeDropdownWrapper">
                                <button type="button" class="time-dropdown-btn" id="timeDropdownBtn"
                                    onclick="toggleTimeDropdown()">
                                    <i class="fas fa-clock me-1"></i> <span id="timeDropdownValue">Select time
                                    </span>
                                    <span class="time-dropdown-icon"><i class="fas fa-chevron-down"></i></span>
                                </button>
                                <div class="time-dropdown-list" id="timeDropdownList">
                                    <div class="time-dropdown-item" onclick="selectTime('07:00 AM')">7:00 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('07:30 AM')">7:30 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('08:00 AM')">8:00 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('08:30 AM')">8:30 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('09:00 AM')">9:00 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('09:30 AM')">9:30 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('10:00 AM')">10:00 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('10:30 AM')">10:30 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('11:00 AM')">11:00 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('11:30 AM')">11:30 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('12:00 PM')">12:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('12:30 PM')">12:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('01:00 PM')">1:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('01:30 PM')">1:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('02:00 PM')">2:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('02:30 PM')">2:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('03:00 PM')">3:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('03:30 PM')">3:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('04:00 PM')">4:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('04:30 PM')">4:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('05:00 PM')">5:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('05:30 PM')">5:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('06:00 PM')">6:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('06:30 PM')">6:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('07:00 PM')">7:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('07:30 PM')">7:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('08:00 PM')">8:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('08:30 PM')">8:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('09:00 PM')">9:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('09:30 PM')">9:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('10:00 PM')">10:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('10:30 PM')">10:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('11:30 PM')">11:30 PM
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Close Time Column -->
                    </div> <!-- Close Grid -->
                    <!-- ONLY VISIBLE WHEN AIRPORT †’ AIRPORT -->
                    <div id="airportLandingFields" style="display: none;">
                        <div class="form-group-uber">
                            <label><i class="fas fa-hourglass-end"></i> Pickup After Landing</label>
                            <select id="pickupAfterLanding">
                                <option value="15">15 Min After</option>
                                <option value="30">30 Min After</option>
                                <option value="45" selected>45 Min After</option>
                                <option value="60">60 Min After</option>
                                <option value="75">75 Min After</option>
                                <option value="90">90 Min After</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- <p class="time-hint">
                    <i class="far fa-calendar-alt"></i> Choose your pick-up time up to 90 days in advance
                </p> -->
                <button id="timePanelDoneBtn" class="btn-search-uber mt-5" onclick="saveSchedule()">
                    See Prices
                </button>
            </div>
            <!-- STEP 1: LOCATIONS -->
            <div class="form-section active" id="step1">
                <div class="container">
                    <div class="booking-title-group">
                        <h3 class="booking-title">Where to?</h3>
                        <!--<button type="button" id="addViaBtn" class="btn-add-via" onclick="addViaPoint()">-->
                        <!--    + Add Via-->
                        <!--</button>-->
                    </div>
                    <!-- <div id="selectedDateTime" class="selectdate"></div> -->
                    <div class="location-group-wrapper">
                        <!-- Route indicator: yellow dot, dotted line, black pin -->
                        <div class="route-indicator">
                            <i class="fas fa-location-dot route-dot-start"></i>
                            <div class="route-line"></div>
                            <i class="fas fa-location-dot route-dot-end"></i>
                        </div>
                        <div class="location-fields">
                            <!-- PICKUP -->
                            <div class="form-group-uber">
                                <label>Pickup Location</label>
                                <div class="location-input-wrapper" id="pickupWrapper">

                                    <input type="text" id="pickupInput" placeholder="Enter pickup location"
                                        class="location-input-field" autocomplete="off"
                                        onfocus="scrollToInputMobile(this)"
                                        onkeyup="handleLocationSearch(this.value, 'pickupSuggestions', 'pickup', 'pickupWrapper')"
                                        onclick="if(this.value.length>=2) handleLocationSearch(this.value, 'pickupSuggestions', 'pickup', 'pickupWrapper')">
                                    <div class="location-suggestions" id="pickupSuggestions"></div>
                                </div>
                            </div>
                            <!-- VIA POINTS -->
                            <div id="viaPointsContainer"></div>
                            <!-- DROPOFF -->
                            <div class="form-group-uber">
                                <label>Dropoff Location</label>
                                <div class="location-input-wrapper" id="dropoffWrapper">

                                    <input type="text" id="dropoffInput" placeholder="Enter dropoff location"
                                        class="location-input-field" autocomplete="off"
                                        onfocus="scrollToInputMobile(this)"
                                        onkeyup="handleLocationSearch(this.value, 'dropoffSuggestions', 'dropoff', 'dropoffWrapper')"
                                        onclick="if(this.value.length>=2) handleLocationSearch(this.value, 'dropoffSuggestions', 'dropoff', 'dropoffWrapper')">
                                    <div class="location-suggestions" id="dropoffSuggestions"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-3">
                        <button class="pickup-now-btn" id="pickupNowBtn" onclick="showSchedulePanelFromStep1()">
                            <i class="fas fa-clock"></i>
                            Pickup Now
                            <i class="fas fa-chevron-down ms-2"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <button class="btn-search-uber" onclick="proceedToTripDetails()" style="margin-top: 20px;">
                            <i class="fas fa-arrow-right me-2"></i> See prices
                        </button>
                    </div>
                    <!-- MOBILE TRUST BADGES -->
                    <div class="mob-trust-badges d-md-none">
                        <div class="mob-trust-badge">
                            <div class="mob-trust-icon">
                                <i class="fas fa-shield-halved"></i>
                            </div>
                            <div class="mob-trust-text">
                                <span class="mob-trust-title">Safe &amp; Secure</span>
                                <span class="mob-trust-sub">Verified drivers</span>
                            </div>
                        </div>
                        <div class="mob-trust-badge">
                            <div class="mob-trust-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="mob-trust-text">
                                <span class="mob-trust-title">Quick &amp; Reliable</span>
                                <span class="mob-trust-sub">On time, every time</span>
                            </div>
                        </div>
                        <div class="mob-trust-badge">
                            <div class="mob-trust-icon">
                                <i class="fas fa-sterling-sign"></i>
                            </div>
                            <div class="mob-trust-text">
                                <span class="mob-trust-title">No Hidden Charges</span>
                                <span class="mob-trust-sub">Transparent pricing</span>
                            </div>
                        </div>
                    </div>
                    <!--<div class="offer-credits-section mt-3">-->
                    <!--    <div class="offer-icon">-->
                    <!--        <i class="fas fa-gift"></i>-->
                    <!--    </div>-->
                    <!--    <div class="offer-content">-->
                    <!--        <div class="offer-title">First Ride Credit</div>-->
                    <!--        <div class="offer-subtitle">Save up to £10</div>-->
                    <!--    </div>-->
                    <!--    <button class="offer-apply-btn" onclick="showAppPromoModal()">Apply</button>-->
                    <!--</div>-->
                </div>
            </div>
            <!-- STEP 2: SUMMARY & PREFERENCES -->
            <div class="form-section" id="step2">
                <div class="container">
                    <div id="tripMainContent">
                        <div class="find-trip-card" id="findTripCard">
                            <div class="find-trip-locations">
                                <!-- SINGLE EDIT AT TOP & LOCATIONS LIKE STEP 1 -->
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                                    <span
                                        style="display: block;font-size: 20px;font-weight: 600;color: black;margin-bottom: 6px;letter-spacing: 0.5px;">Trip
                                        Details</span>
                                    <button class="edit-icon-btn" onclick="goBackToLocations()" title="Edit trip">
                                        <i class="fas fa-pencil"></i> Edit
                                    </button>
                                </div>
                                <div class="location-group-wrapper">
                                    <div class="route-indicator">
                                        <i class="fas fa-location-dot route-dot-start"></i>
                                        <div class="route-line"></div>
                                        <i class="fas fa-location-dot route-dot-end"></i>
                                    </div>
                                    <div class="location-fields">
                                        <div class="form-group-uber">
                                            <div class="trip-details" id="summaryPickup">–</div>
                                        </div>
                                        <div class="form-group-uber" style="margin-top: 15px;">
                                            <div class="trip-details" id="summaryDropoff">–</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- FOR ME (KEEP EXISTING) -->
                                <button type="button" class="trip-location-item" onclick="showForMeModal()">
                                    <div class="trip-location-icon">
                                        <i class="fas fa-user"></i>
                                        <div class="d-flex flex-column text-start">
                                            <span id="forMeTitle">For me</span>
                                            <small id="forMeDetails"
                                                style="display:none;font-size:18px;line-height:1.4;"></small>
                                        </div>
                                    </div>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="trip-datetime-card" id="tripDateTimeCard">
                                    <div class="trip-datetime-icon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>

                                    <div class="trip-datetime-content">
                                        <div class="trip-datetime-title">Pickup Date & Time</div>
                                        <div class="trip-datetime-value">
                                            <span id="tripSelectedDate">--</span>
                                            <span> • </span>
                                            <span id="tripSelectedTime">--</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Selected Car Summary -->
                            <!-- Selected Car Summary (visible after vehicle selection) -->
                            <div id="selectedCarSummary" class="selected-car-summary">
                                <h5 class="summary-title">Selected Vehicle</h5>
                                <div class="selected-car-row">
                                    <img id="summaryCarImage" src="" alt="Car" class="summary-car-image">
                                    <div class="summary-car-details">
                                        <h4 id="summaryCarName" class="summary-car-name"></h4>
                                        <div class="summary-car-info">
                                            <span>
                                                <i class="fas fa-user"></i>
                                                <span id="summaryCarCapacity"></span>
                                            </span>
                                            <span>
                                                <i class="fas fa-suitcase"></i>
                                                <span id="summaryCarLuggage"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div id="summaryCarPrice" class="summary-car-price"></div>
                                </div>
                            </div>
                            <!-- Entered Details Summary -->
                            <div id="enteredDetailsSummary" class="booking-summary">
                                <h5 class="summary-title">
                                    <i class="fas fa-clipboard-list"></i> Booking Details
                                </h5>

                                <div class="booking-summary-list">

                                    <div class="booking-summary-item" id="summaryPassengerContainer">
                                        <span class="summary-label"><i class="fas fa-user"></i> Passenger</span>
                                        <span id="summaryPassengerName" class="summary-value">–</span>
                                    </div>

                                    <div class="booking-summary-item" id="summaryContactContainer">
                                        <span class="summary-label"><i class="fas fa-phone"></i> Contact</span>
                                        <span id="summaryPassengerContact" class="summary-value">–</span>
                                    </div>

                                    <div class="booking-summary-item" id="summaryEmailContainer">
                                        <span class="summary-label"><i class="fas fa-envelope"></i> Email</span>
                                        <span id="summaryPassengerEmail" class="summary-value">–</span>
                                    </div>

                                    <div class="booking-summary-item" id="summaryPassengersCountContainer">
                                        <span class="summary-label"><i class="fas fa-users"></i> Passengers</span>
                                        <span id="summaryPassengerCount" class="summary-value">1</span>
                                    </div>

                                    <div class="booking-summary-item" id="summaryLuggageCountContainer">
                                        <span class="summary-label"><i class="fas fa-suitcase"></i> Luggage</span>
                                        <span id="summaryLuggageCount" class="summary-value">0</span>
                                    </div>

                                    <div class="booking-summary-item" id="summaryHandLuggageContainer">
                                        <span class="summary-label"><i class="fas fa-briefcase"></i> Hand Luggage</span>
                                        <span id="summaryHandLuggageCount" class="summary-value">0</span>
                                    </div>

                                    <div class="booking-summary-item" id="summaryBabySeatContainer"
                                        style="display:none;">
                                        <span class="summary-label"><i class="fas fa-child"></i> Baby Seats</span>
                                        <span id="summaryBabySeats" class="summary-value">None</span>
                                    </div>

                                    <div class="booking-summary-item" id="summaryDateContainer">
                                        <span class="summary-label" id="summaryDateLabel">
                                            <i class="fas fa-calendar-alt"></i> Date
                                        </span>
                                        <span id="summaryBookingDate" class="summary-value">–</span>
                                    </div>

                                    <div class="booking-summary-item" id="summaryTimeContainer">
                                        <span class="summary-label" id="summaryTimeLabel">
                                            <i class="fas fa-clock"></i> Time
                                        </span>
                                        <span id="summaryBookingTime" class="summary-value">–</span>
                                    </div>

                                    <div id="summaryFlightContainer" class="booking-summary-item" style="display:none;">
                                        <span class="summary-label" id="summaryFlightLabel">
                                            <i class="fas fa-plane"></i> Flight No.
                                        </span>
                                        <span id="summaryFlightNumber" class="summary-value">–</span>
                                    </div>

                                    <div id="summaryComingFromContainer" class="booking-summary-item"
                                        style="display:none;">
                                        <span class="summary-label" id="summaryComingFromLabel">
                                            <i class="fas fa-map-marker-alt"></i> Coming From
                                        </span>
                                        <span id="summaryComingFrom" class="summary-value">–</span>
                                    </div>

                                    <div id="summaryDropoffAddressContainer" class="booking-summary-item"
                                        style="display:none;">
                                        <span class="summary-label" id="summaryDropoffAddressLabel">
                                            <i class="fas fa-location-dot"></i> Destination
                                        </span>
                                        <span id="summaryDropoffAddress" class="summary-value">–</span>
                                    </div>

                                    <div id="summarySpecialReqContainer" class="booking-summary-item"
                                        style="display:none;">
                                        <span class="summary-label">
                                            <i class="fas fa-comment-dots"></i> Special Req.
                                        </span>
                                        <span id="summarySpecialRequirements" class="summary-value">–</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="btn-group-uber step-bottom-btns" id="step2Buttons">
                            <button class="btn-back-uber" onclick="goBackToLocations()">
                                <i class="fas fa-chevron-left"></i> Back
                            </button>
                            <button class="btn-search-uber" onclick="proceedToVehicles()">
                                <i class="fas fa-arrow-right"></i> Choose a ride
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- STEP 3: VEHICLE SELECTION -->
            <div class="form-section" id="step3">
                <div class="container">
                    <h3 class="booking-title">Choose a ride</h3>
                    <div class="vehicle-grid-uber" id="vehicleGrid"></div>
                    <div class="btn-group-uber step-bottom-btns">
                        <button class="btn-back-uber" onclick="goBackToLocations()">
                            <i class="fas fa-chevron-left"></i> Back
                        </button>
                        <button class="btn-search-uber" onclick="proceedToPassengerDetails()">
                            <i class="fas fa-arrow-right"></i> Continue
                        </button>
                    </div>
                </div>
            </div>
            <!-- STEP 4 : YOUR DETAILS -->
            <!-- <!€” STEP 4: YOUR DETAILS (sectioned, dynamic journey info) €”> -->
            <div class="form-section" id="step5">
                <div class="container">
                    <h3 class="booking-title">Payment Method</h3>
                    <div class="payment-summary">
                        <div class="payment-item">
                            <span>Base fare</span>
                            <span>£8.50</span>
                        </div>
                        <div class="payment-item">
                            <span>Minimum fare</span>
                            <span>£12.75</span>
                        </div>
                        <div class="payment-item">
                            <span>+ per minute</span>
                            <span>£0.10</span>
                        </div>
                        <div class="payment-item">
                            <span>+ per mile</span>
                            <span>£0.71</span>
                        </div>
                        <div class="payment-item">
                            <span>Estimated surcharges</span>
                            <span>£10.63</span>
                        </div>
                        <div class="payment-total">
                            <span>Estimated Operating Fee</span>
                            <span>£42.50</span>
                        </div>
                        <div class="payment-total grand-total">
                            <span>Total</span>
                            <span>£55.00</span>
                        </div>
                    </div>
                    <div class="form-group-uber">
                        <label><i class="fas fa-credit-card"></i> Payment Method *</label>
                        <select id="paymentMethod" required>
                            <option value="">Select payment method</option>
                            <option value="card">Pay Cash to the Driver</option>
                            <option value="upi" selected>Credit/Debit Card</option>
                            <option value="wallet">Confirm Now, Pay Later</option>
                            <!-- <option value="cash">Cash</option> -->
                        </select>
                    </div>
                    <div class="btn-group-uber step-bottom-btns">
                        <button class="btn-back-uber" onclick="goBack(4)">
                            <i class="fas fa-chevron-left"></i> Back
                        </button>
                        <button class="btn-search-uber" onclick="proceedToConfirmation()">
                            <i class="fas fa-credit-card"></i> Make Payment
                        </button>
                    </div>
                </div>
            </div>
            <!-- STEP 4: BOOKING DETAILS -->
            <div class="form-section" id="step4">
                <div class="container p-0">
                    <h3 class="booking-title">Booking Details</h3>
                    <!-- =======================
     SECTION 1 : PERSONAL INFO
======================== -->
                    <div class="booking-form-section" id="personalInfoSection">
                        <div class="booking-section-title">
                            Personal Info
                        </div>
                        <div class="booking-form-grid">
                            <div class="form-group-uber booking-form-group">
                                <label>Full Name</label>
                                <input type="text" id="passengerFirstName" placeholder="First name">
                            </div>
                            <!-- <div class="form-group-uber booking-form-group">
                                <label>Last Name</label>
                                <input type="text" id="passengerLastName" placeholder="Last name">
                            </div> -->
                            <div class="form-group-uber booking-form-group">
                                <label>Contact Number</label>

                                <input type="tel" id="passengerPhone" class="phone-number-input"
                                    placeholder="Enter phone number">
                            </div>
                            <div class="form-group-uber booking-form-group">
                                <label>Email Address</label>
                                <input type="email" id="passengerEmail" placeholder="your@email.com">
                            </div>
                        </div>
                        <!--<div class="booking-checkbox-wrapper">-->
                        <!--    <label class="booking-checkbox-label">-->
                        <!--        <input-->
                        <!--            type="checkbox"-->
                        <!--            id="leadPassengerCheck"-->
                        <!--            class="booking-checkbox">-->
                        <!--        <span>Lead Passenger?</span>-->
                        <!--    </label>-->
                        <!--</div>-->
                    </div>
                    <div id="additionalBookingDetails" style="display: none;">
                        <!-- =======================
     SECTION 2 : PASSENGERS & LUGGAGE
======================== -->
                        <div class="passenger-luggage-card">
                            <div class="passenger-card-title">
                                Passengers & Luggage
                            </div>
                            <!-- Counters -->
                            <div class="passenger-counter-grid">
                                <div class="passenger-counter-item">
                                    <label>Passengers</label>
                                    <div class="counter-widget">
                                        <button type="button" class="counter-btn"
                                            onclick="updateCounter('passengerCount', -1, 1, 8)">-</button>
                                        <span class="counter-val" id="passengerCountDisplay">1</span>
                                        <button type="button" class="counter-btn"
                                            onclick="updateCounter('passengerCount', 1, 1, 8)">+</button>
                                    </div>
                                    <input type="hidden" id="passengerCount" value="1">
                                </div>
                                <div class="passenger-counter-item">
                                    <label>Luggage</label>
                                    <div class="counter-widget">
                                        <button type="button" class="counter-btn"
                                            onclick="updateCounter('luggageCount', -1, 0, 8)">-</button>
                                        <span class="counter-val" id="luggageCountDisplay">0</span>
                                        <button type="button" class="counter-btn"
                                            onclick="updateCounter('luggageCount', 1, 0, 8)">+</button>
                                    </div>
                                    <input type="hidden" id="luggageCount" value="0">
                                </div>
                                <div class="passenger-counter-item">
                                    <label>Hand Luggage</label>
                                    <div class="counter-widget">
                                        <button type="button" class="counter-btn"
                                            onclick="updateCounter('handLuggageCount', -1, 0, 8)">-</button>
                                        <span class="counter-val" id="handLuggageCountDisplay">0</span>
                                        <button type="button" class="counter-btn"
                                            onclick="updateCounter('handLuggageCount', 1, 0, 8)">+</button>
                                    </div>
                                    <input type="hidden" id="handLuggageCount" value="0">
                                </div>
                            </div>
                            <!-- Car Seat -->
                            <div class="car-seat-toggle">
                                <label class="car-seat-label">
                                    <input type="checkbox" id="carSeatCheckbox" class="booking-checkbox"
                                        onchange="toggleChildSeatOptions()">
                                    Baby Seat Required?
                                </label>
                            </div>
                            <!-- Child Seat Options -->
                            <div id="childSeatOptions" class="child-seat-wrapper">
                                <div class="child-seat-counter">
                                    <label>Number of Baby Seats</label>
                                    <div class="counter-widget">
                                        <button type="button" class="counter-btn"
                                            onclick="updateCarSeatCount(-1)">-</button>
                                        <span class="counter-val" id="childSeatCountDisplay">0</span>
                                        <button type="button" class="counter-btn"
                                            onclick="updateCarSeatCount(1)">+</button>
                                    </div>
                                    <input type="hidden" id="childSeatCount" value="0">
                                </div>
                                <div id="carSeatDropdownsContainer" class="child-seat-dropdowns">
                                </div>
                            </div>
                        </div>
                        <!--<div class="booking-section-title">-->
                        <!--    Journey Information-->
                        <!--</div>-->
                        <!-- Airport -->
                        <div id="journeyAirport" style="display:none;">
                            <div class="booking-form-grid">
                                <div class="form-group-uber booking-form-group">
                                    <label>
                                        <i class="fas fa-plane-departure"></i>
                                        Flight Number *
                                    </label>
                                    <input type="text" id="flightNumber" placeholder="Flight Number">
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label>
                                        <i class="fas fa-clock"></i>
                                        Pick Up Time After Landing?
                                    </label>
                                    <select id="pickupAfterLandingSelect">
                                        <option value="">Select</option>
                                        <option value="15">15 Min After</option>
                                        <option value="30">30 Min After</option>
                                        <option value="45" selected>45 Min After</option>
                                        <option value="60">60 Min After</option>
                                        <option value="75">75 Min After</option>
                                        <option value="90">90 Min After</option>
                                    </select>
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label>Coming From *</label>
                                    <input type="text" id="comingFrom" placeholder="Coming From">
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label>Drop off Address *</label>
                                    <input type="text" id="dropoffAddress" placeholder="Full address with postcode">
                                </div>
                            </div>
                        </div>
                        <!-- Seaport -->
                        <!-- Seaport -->
                        <div id="journeySeaport" style="display:none;">
                            <div class="booking-form-grid">
                                <div class="form-group-uber booking-form-group">
                                    <label><i class="fas fa-ship"></i> Cruise/Ferry Name *</label>
                                    <input type="text" id="ferryName" placeholder="Cruise or Ferry name">
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label><i class="fas fa-clock"></i> Docking Time?</label>
                                    <select id="dockingTimeSelect">
                                        <option value="">Select</option>
                                        <option>15 Min After</option>
                                        <option>30 Min After</option>
                                        <option selected>45 Min After</option>
                                        <option>60 Min After</option>
                                        <option>90 Min After</option>
                                    </select>
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label>Coming From *</label>
                                    <input type="text" id="comingFromPort" placeholder="Port/Terminal name">
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label>Drop off Address *</label>
                                    <input type="text" id="dropoffAddressSeaport"
                                        placeholder="Full address with postcode">
                                </div>
                            </div>
                        </div>
                        <!-- Normal -->
                        <div id="journeyNormal">
                            <div class="booking-form-grid">
                                <div class="form-group-uber booking-form-group">
                                    <!--<label>-->
                                    <!--    <i class="fas fa-calendar"></i>-->
                                    <!--    Journey Date-->
                                    <!--</label>-->
                                    <!--<input type="text" id="normalJourneyDate" class="time-input-field" readonly>-->
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <!--<label><i class="fas fa-clock"></i> Journey Time</label>-->
                                    <!--<select id="normalJourneyTime">-->
                                    <!--    <option value="">Select</option>-->
                                    <!--    <option value="07:00 AM">7:00 AM</option>-->
                                    <!--    <option value="08:00 AM">8:00 AM</option>-->
                                    <!--    <option value="09:00 AM">9:00 AM</option>-->
                                    <!--    <option value="10:00 AM">10:00 AM</option>-->
                                    <!--    <option value="11:00 AM">11:00 AM</option>-->
                                    <!--    <option value="12:00 PM">12:00 PM</option>-->
                                    <!--    <option value="01:00 PM">1:00 PM</option>-->
                                    <!--    <option value="02:00 PM">2:00 PM</option>-->
                                    <!--    <option value="03:00 PM">3:00 PM</option>-->
                                    <!--    <option value="04:00 PM">4:00 PM</option>-->
                                    <!--    <option value="05:00 PM">5:00 PM</option>-->
                                    <!--    <option value="06:00 PM">6:00 PM</option>-->
                                    <!--    <option value="07:00 PM">7:00 PM</option>-->
                                    <!--    <option value="08:00 PM">8:00 PM</option>-->
                                    <!--    <option value="09:00 PM">9:00 PM</option>-->
                                    <!--    <option value="10:00 PM">10:00 PM</option>-->
                                    <!--</select>-->
                                </div>
                            </div>
                        </div>
                        <!-- =======================
     SECTION 5 : SPECIAL REQUIREMENTS
======================== -->
                        <div class="booking-form-section">
                            <div class="booking-section-title">
                                Special Requirements
                            </div>
                            <!-- CHECKBOX TO TOGGLE TEXTAREA -->
                            <div style="margin-bottom: 15px;">
                                <label class="booking-checkbox-label">
                                    <input type="checkbox" id="specialReqCheckbox"
                                        onchange="toggleSpecialRequirements()" class="booking-checkbox">
                                    Add Special Requirements?
                                </label>
                            </div>
                            <!-- TEXTAREA (HIDDEN BY DEFAULT) -->
                            <div class="form-group-uber booking-form-group">
                                <textarea id="specialRequirements" rows="3" placeholder="Enter any special requirements"
                                    style="display: none;">
                            </textarea>
                            </div>
                        </div>
                    </div> <!-- End of additionalBookingDetails -->
                    <div class="btn-group-uber step-bottom-btns" id="personalInfoBtns">
                        <button class="btn-back-uber" onclick="goBack(3)">
                            <i class="fas fa-chevron-left"></i> Back
                        </button>
                        <button class="btn-search-uber" onclick="verifyPersonalInfoAndRequestOTP()">
                            <i class=""></i> Continue
                        </button>
                    </div>
                    <div class="btn-group-uber step-bottom-btns" id="additionalDetailsBtns" style="display: none;">
                        <button class="btn-back-uber" onclick="goBackToPersonalInfo()">
                            <i class="fas fa-chevron-left"></i> Back
                        </button>
                        <button class="btn-search-uber" onclick="verifyPassengerDetails()">
                            <i class="fas fa-arrow-right"></i> Continue
                        </button>
                    </div>
                </div>
            </div>
            <!-- STEP 5: DRIVER & CONFIRMATION -->
            <div class="form-section" id="step6">
                <div class="container">
                    <h3 class="booking-title">Pick Your driver</h3>
                    <div id="findingDriversLoader" class="finding-drivers-loader" style="display:none;">
                        <div class="search-circle">
                            <i class="fas fa-magnifying-glass"></i>
                        </div>
                        <h4>Finding your driver...</h4>
                        <p>Searching nearby drivers</p>
                        <div class="loading-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div id="driverList" style="display:none;"></div>
                    <div class="btn-group-uber step-bottom-btns">
                        <button class="btn-back-uber" onclick="goBack(4)">
                            <i class="fas fa-chevron-left"></i> Back
                        </button>
                    </div>
                </div>
            </div>
            <!-- STEP 7: REVIEW & CONFIRM (shown after clicking a driver) -->
            <div class="form-section" id="step7">
                <div class="container">
                    <!-- Header -->
                    <div class="rc-header">
                        <button class="rc-back-btn" onclick="showStep(6)">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <h3 class="rc-title">Review & Confirm</h3>
                    </div>
                    <!-- Driver Card -->
                    <div class="rc-new-driver-card">
                        <div class="rc-driver-top-flex">
                            <div class="rc-driver-avatar" id="rcDriverAvatar"></div>
                            <div class="rc-driver-info-main">
                                <div class="rc-driver-name-row">
                                    <h4 id="rcDriverName">-</h4>
                                    <div class="rc-driver-badge-top" id="rcDriverBadge" style="display:none;"></div>
                                </div>
                                <div class="rc-driver-rating-row" id="rcDriverStars"></div>
                            </div>
                        </div>
                        <div class="rc-driver-stats-grid">
                            <div class="rc-driver-stat-col">
                                <i class="fas fa-medal"></i>
                                <div>
                                    <strong id="rcDriverExperience">6+ Years</strong>
                                    <span>Experience</span>
                                </div>
                            </div>
                            <div class="rc-driver-stat-col border-left-right">
                                <i class="far fa-user"></i>
                                <div>
                                    <strong id="rcDriverTrips">2,145</strong>
                                    <span>Trips Completed</span>
                                </div>
                            </div>
                            <div class="rc-driver-stat-col">
                                <i class="far fa-comment-dots"></i>
                                <div>
                                    <strong id="rcDriverReviewsPct">98%</strong>
                                    <span>Positive Reviews</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Details Card -->
                    <div class="rc-vehicle-card">
                        <div class="rc-card-subtitle">VEHICLE DETAILS</div>
                        <div class="rc-vehicle-top">
                            <div class="rc-vehicle-img-wrapper"
                                onclick="showCarDetailsModal(bookingData.selectedDriver)" style="cursor:pointer;">
                                <img id="rcCarImage" src="goride/img/fleet1.png" alt="Car">
                            </div>
                            <div class="rc-vehicle-info-right">
                                <h4 id="rcCarName">-</h4>
                                <div class="rc-vehicle-tag" id="rcVehicleTag" style="display:none;"></div>
                                <div class="rc-vehicle-features">
                                    <span><i class="far fa-user"></i> <span id="rcPassengerCapacity">4</span>
                                        Seats</span>
                                    <span><i class="fas fa-suitcase-rolling"></i> <span id="rcLuggageCapacity">2</span>
                                        Large</span>
                                    <span><i class="fas fa-cogs"></i> <span id="rcTransmission">Automatic</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="rc-vehicle-amenities-grid" id="rcVehicleAmenitiesGrid">
                            <!-- populated dynamically -->
                        </div>
                    </div>

                    <!-- Bidded Amount Card -->
                    <div class="rc-bid-card">
                        <div class="rc-bid-top">
                            <div class="rc-card-subtitle">BIDDED AMOUNT</div>
                            <div class="rc-bid-badge"><i class="fas fa-check-circle"></i> Includes all fees</div>
                        </div>
                        <div class="rc-bid-bottom">
                            <div class="rc-bid-amount">
                                <strong id="rcFareAmount">£0</strong>
                                <span class="rc-bid-total-tag">Total</span>
                            </div>
                            <div class="rc-bid-note">No hidden charges</div>
                        </div>
                    </div>
                    <!-- Accept Button -->
                    <div class="btn-group-uber step-bottom-btns rc-accept-wrap">
                        <button class="btn-search-uber" onclick="acceptDriver()" style="flex:1;">
                            <i class="fas fa-check me-2"></i> Accept
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-section" id="step8">
                <div class="container">
                    <div class="confirm-modal-content" style="padding: 20px 0;">
                        <div class="confirm-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h2 class="confirm-title" style="text-align: center; margin-top: 15px; margin-bottom: 20px;">
                            Booking Confirmed!</h2>
                        <div class="confirm-booking-id"
                            style="background: #f8f9fa; padding: 15px; border-radius: 8px; text-align: center; margin-bottom: 20px;">
                            <small
                                style="color: #666; font-size: 12px; font-weight: 600; text-transform: uppercase;">Booking
                                ID</small>
                            <div class="id-value" id="confirmNum"
                                style="font-size: 20px; font-weight: 700; color: #000; margin-top: 5px;">GR-2026-14851
                            </div>
                        </div>
                        <div class="confirm-details-grid"
                            style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 25px;">
                            <div class="confirm-detail-item">
                                <small
                                    style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-location-dot"></i> PICKUP</small>
                                <div class="detail-value" id="confirmPickup"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                            <div class="confirm-detail-item">
                                <small
                                    style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-location-dot"></i> DESTINATION</small>
                                <div class="detail-value" id="confirmDropoff"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                            <div class="confirm-detail-item">
                                <small
                                    style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-calendar"></i> DATE & TIME</small>
                                <div class="detail-value" id="confirmDateTime"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                            <div class="confirm-detail-item">
                                <small
                                    style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-car"></i> VEHICLE</small>
                                <div class="detail-value" id="confirmVehicle"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                            <div class="confirm-detail-item">
                                <small
                                    style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-road"></i> DISTANCE</small>
                                <div class="detail-value" id="confirmDistance"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                            <div class="confirm-detail-item">
                                <small
                                    style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-hourglass"></i> DURATION</small>
                                <div class="detail-value" id="confirmDuration"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                        </div>
                        <p class="confirm-info-text"
                            style="text-align: center; color: #666; font-size: 14px; line-height: 1.5; margin-bottom: 25px;">
                            Your booking has been successfully confirmed. A driver will be assigned soon.
                        </p>
                    </div>
                    <div class="btn-group-uber step-bottom-btns">
                        <button class="btn-modal-primary" onclick="completeBooking()"
                            style="width: 100%; background: #000; color: #fff; border: none; padding: 12px; border-radius: 8px; font-weight: 600;">
                            <i class="fas fa-check"></i> Done
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-map-section  col-md-7 col-12">
            <!-- First Screen Image -->
            <div id="bookingImage">
                <div class="hero-banner-content">
                    <span class="hero-badge">GoRide</span>
                    <h1>Ride Anywhere & Anytime With GoRide</h1>
                    <p>Airport transfers, city rides, executive travel and long-distance journeys with professional
                        drivers at fixed prices.</p>
                </div>
                <img src="https://goride-media.s3.ap-south-1.amazonaws.com/cus_app/images/day_6a561ea0b63e7.webp"
                    alt="Airport Transfer" class="hero-side-img">
            </div>
            <div id="bookingMap" style="display: none; width: 100%; height: 100%; min-height: 400px;"></div>
            <script
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtkJtXBZPLBZIgjgpu-eAG5WQ1HwW4EwE&libraries=geometry"></script>

            <script>
                let bookingGoogleMap = null;
                let routeBounds = null;
                async function initSingleRouteMap() {
                    const mapContainer = document.getElementById('bookingMap');
                    if (mapContainer.style.display === 'none') {
                        mapContainer.style.display = 'block';
                    }
                    if (bookingGoogleMap !== null) {
                        google.maps.event.trigger(bookingGoogleMap, 'resize');
                        if (routeBounds) bookingGoogleMap.fitBounds(routeBounds);
                        return;
                    }
                    bookingGoogleMap = new google.maps.Map(mapContainer, {
                        center: {
                            lat: 51.5074,
                            lng: -0.1278
                        },
                        zoom: 11
                    });
                    const startLng = -0.127596;
                    const startLat = 51.507194;
                    const endLng = -0.142377;
                    const endLat = 51.502205;
                    try {
                        const response = await fetch('{{ env('API_URL') }}/get-route-polyline', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                                // 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                            },
                            body: JSON.stringify({
                                start_lng: startLng,
                                start_lat: startLat,
                                end_lng: endLng,
                                end_lat: endLat
                            })
                        });
                        if (!response.ok) throw new Error(`HTTP Error: ${response.status}`);
                        const jsonResponse = await response.json();
                        if (jsonResponse.success && jsonResponse.data.routes && jsonResponse.data.routes.length > 0) {
                            drawPolylineAndMarkers(jsonResponse.data.routes[0].geometry, startLat, startLng, endLat, endLng);
                        } else {
                            console.error('Backend returned false or no routes found. Drawing fallback.', jsonResponse);
                            useFallbackRoute();
                        }
                    } catch (error) {
                        console.error('Fetch to /get-route-polyline failed. Drawing fallback.', error);
                        useFallbackRoute();
                    }
                    function useFallbackRoute() {
                        const fallbackGeometry = "}~jyHn|WBh@q@jBw@tNzAnHd@jAdIb[`@b@pH}GlIpX_@jAFzEG~C";
                        drawPolylineAndMarkers(fallbackGeometry, startLat, startLng, endLat, endLng);
                    }
                    function drawPolylineAndMarkers(encodedGeometry, sLat, sLng, eLat, eLng) {
                        const decodedPath = google.maps.geometry.encoding.decodePath(encodedGeometry);
                        const routePolyline = new google.maps.Polyline({
                            path: decodedPath,
                            strokeColor: '#2A64EC',
                            strokeOpacity: 0.8,
                            strokeWeight: 6
                        });
                        routePolyline.setMap(bookingGoogleMap);
                        routeBounds = new google.maps.LatLngBounds();
                        for (let i = 0; i < decodedPath.length; i++) {
                            routeBounds.extend(decodedPath[i]);
                        }
                        bookingGoogleMap.fitBounds(routeBounds);
                        new google.maps.Marker({
                            position: {
                                lat: sLat,
                                lng: sLng
                            },
                            map: bookingGoogleMap
                        });
                        new google.maps.Marker({
                            position: {
                                lat: eLat,
                                lng: eLng
                            },
                            map: bookingGoogleMap
                        });
                    }
                }
            </script>
            <!-- Mobile Map Close Button (rendered outside the map div so it stays above) -->
            <button id="mapCloseBtn" onclick="closeMobileMap()" title="Close Map">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- <section class="fleet-section pt-5">
        <div class="container">
            <div class="section-head text-center mb-4">
                <h2 class="section-title">Available Fleets</h2>
                <p>Choose the perfect ride for your journey</p>
            </div>
            <div class="owl-carousel fleet-carousel">
                <div class="fleet-card">
                    <img src="/goride/img/saloon.png" alt="Saloon">
                    <h5>Saloon</h5>
                    <span>Up to 4 Passengers</span>
                </div>
                <div class="fleet-card">
                    <img src="/goride/img/executive.png" alt="Executive">
                    <h5>Executive</h5>
                    <span>Luxury Business Ride</span>
                </div>
                <div class="fleet-card">
                    <img src="/goride/img/executive mv5.png" alt="Executive MPV">
                    <h5>Executive MPV</h5>
                    <span>Up to 6 Passengers</span>
                </div>
                <div class="fleet-card">
                    <img src="/goride/img/estate.png" alt="Estate">
                    <h5>Estate</h5>
                    <span>Extra Luggage Space</span>
                </div>
                <div class="fleet-card">
                    <img src="/goride/img/8seater.png" alt="8 Seater">
                    <h5>8 Seater</h5>
                    <span>Up to 8 Passengers</span>
                </div>
                <div class="fleet-card">
                    <img src="/goride/img/mpv.png" alt="MPV">
                    <h5>MPV</h5>
                    <span>Family Friendly</span>
                </div>
            </div>
        </div>
    </section> -->
    <section class="reviews-section section-padding mt-5" id="reviews">
        <div class="container">
            <h2 class="section-title">What Customers Say</h2>
            <div class="review-grid">
                <div class="review-card">
                    <div class="review-rating"></div>
                    <div class="review-text">
                        "Fantastic airport transfer. The driver arrived early, helped with our luggage, and the journey
                        was comfortable. Highly recommended!"
                    </div>
                    <div class="review-author">
                        <div class="review-avatar">JW</div>
                        <div>
                            <div class="review-name">James Wilson</div>
                            <div class="review-title">London</div>
                        </div>
                    </div>
                </div>
                <div class="review-card">
                    <div class="review-rating"></div>
                    <div class="review-text">
                        "Excellent service with fixed pricing and no hidden charges. Booking was quick and the driver
                        was very friendly."
                    </div>
                    <div class="review-author">
                        <div class="review-avatar">EH</div>
                        <div>
                            <div class="review-name">Emma Harris</div>
                            <div class="review-title">Manchester</div>
                        </div>
                    </div>
                </div>
                <div class="review-card">
                    <div class="review-rating"></div>
                    <div class="review-text">
                        "Our family booked a ride to Heathrow Airport and everything went perfectly. Clean vehicle and
                        professional driver."
                    </div>
                    <div class="review-author">
                        <div class="review-avatar">DT</div>
                        <div>
                            <div class="review-name">Daniel Thompson</div>
                            <div class="review-title">Birmingham</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Owl Carousel for Mobile - FIXED -->
            <div class="owl-carousel review-carousel owl-theme">
                <div class="review-card">
                    <div class="review-rating"></div>
                    <div class="review-text">
                        "Fantastic airport transfer. The driver arrived early, helped with our luggage, and the journey
                        was comfortable. Highly recommended!"
                    </div>
                    <div class="review-author">
                        <div class="review-avatar">JW</div>
                        <div>
                            <div class="review-name">James Wilson</div>
                            <div class="review-title">London</div>
                        </div>
                    </div>
                </div>
                <div class="review-card">
                    <div class="review-rating"></div>
                    <div class="review-text">
                        "Excellent service with fixed pricing and no hidden charges. Booking was quick and the driver
                        was very friendly."
                    </div>
                    <div class="review-author">
                        <div class="review-avatar">EH</div>
                        <div>
                            <div class="review-name">Emma Harris</div>
                            <div class="review-title">Manchester</div>
                        </div>
                    </div>
                </div>
                <div class="review-card">
                    <div class="review-rating"></div>
                    <div class="review-text">
                        "Our family booked a ride to Heathrow Airport and everything went perfectly. Clean vehicle and
                        professional driver."
                    </div>
                    <div class="review-author">
                        <div class="review-avatar">DT</div>
                        <div>
                            <div class="review-name">Daniel Thompson</div>
                            <div class="review-title">Birmingham</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="operator-register-section">
        <div class="container">
            <div class="operator-register-content">
                <div class="operator-register-text">
                    <h2>Build Your Business & Earn More with <span>GoRide</span> Operator Portal</h2>
                    <p>Manage fleet, drivers, bookings, and earnings from one dashboard</p>
                </div>
                <!--<a href="{{ env('WEBSITE_APP_URL') }}/operator-signup" class="operator-register-btn">-->
                <a href="/operator-signup" class="operator-register-btn">
                    <i class="fas fa-arrow-right"></i>
                    Become an Operator
                </a>
            </div>
        </div>
    </section>
    <section class="faq-section section-padding" id="faq">
        <div class="container" style="max-width: 700px;">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    How do I book a ride?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">Enter your pickup and dropoff locations, select your preferred time, choose a
                    vehicle type, and confirm your booking. It's that simple!</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    What payment methods do you accept?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">We accept credit/debit cards, UPI, digital wallets, and cash payments. Choose
                    the method that's most convenient for you.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Are the prices fixed?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">Yes! We offer transparent, fixed pricing. The fare you see at booking is the
                    fare you'll pay. No surge pricing.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    How do I contact customer support?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">Our support team is available 24/7. You can reach us through the app, website,
                    or call us directly. We're always here to help!</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Are your drivers verified?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">Absolutely! All our drivers undergo thorough background checks and vehicle
                    inspections for your safety and peace of mind.</div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="row d-flex justify-content-between">
                <!-- Logo & Tagline -->
                <div class="col-12 col-md-3">
                    <div class="footer-logo-section">
                        <div class="footer-logo">
                            <img src="https://www.goride.net.in/goride/img/logo-light.png" alt="GoRide UK Logo">
                        </div>
                        <p class="footer-tagline">Safe, affordable, and reliable ride booking for everyone.</p>
                    </div>
                    <!-- Social Icons -->
                    <div class="footer-section">
                        <div class="footer-social-icons">
                            <a href="https://www.facebook.com/people/Goride-Run/pfbid0jVh2iGFREVFLyTYRQFybaLXW3ECbUrgR9kJqcN4EMVYbSzPzFr7SRRLWgsTWf1BJl/"
                                class="social-icon" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-icon" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.instagram.com/goride.run_uk/" class="social-icon" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-icon" title="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="social-icon" title="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Company Links -->
                <div class="col-6 col-md-2">
                    <div class="footer-section">
                        <div class="footer-section-title">Company</div>
                        <div class="footer-links-list">
                            <a href="uk-about">About Us</a>
                            <a href="uk-contact">Contact</a>
                        </div>
                    </div>
                </div>
                <!-- Legal Links -->
                <div class="col-6 col-md-2">
                    <div class="footer-section">
                        <div class="footer-section-title">Legal</div>
                        <div class="footer-links-list">
                            <!--<a href="#">Security Policy</a>-->
                            <a href="uk-privacy">Privacy Policy</a>
                            <a href="uk-terms">Terms & Conditions</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="footer-section">
                        <div class="footer-section-title">Contact</div>
                        <div class="footer-links-list">
                            <a href="tel:+442083373777">
                                <i class="fas fa-phone footer-contact-icon"></i>
                                +44 208 337 3777
                            </a>
                            <a href="mailto:support.uk@goride.run">
                                <i class="fas fa-envelope footer-contact-icon"></i>
                                support.uk@goride.run
                            </a>
                            <div class="footer-address">
                                <i class="fas fa-location-dot footer-contact-icon"></i>
                                <div>
                                    83 1st Floor<br>
                                    Surbiton Road<br>
                                    Kingston Upon Thames<br>
                                    KT1 2HW<br>
                                    United Kingdom
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0">© 2026 Operated by Goride Plus Ltd. All rights reserved. | Privacy • Terms • Cookies</p>
            </div>
        </div>
    </footer>
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
                    <i class="fas fa-phone-alt me-2 text-warning"></i>
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
                    <div class="fare-row">
                        <span>Meet & Greet</span>
                        <span id="confirmMeetGreet">£0.00</span>
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
                    <img id="carCarouselImage" src="goride/img/fleet1.png"
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
                <input type="text" id="otherPassengerName" placeholder="Enter passenger name">
            </div>
            <div class="form-group-uber">
                <label>Mobile Number(Optional)</label>
                <input type="text" id="otherPassengerPhone" placeholder="+44 7123456789">
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
    <div class="cookie-consent-banner" id="cookiecontent" style="display: none;">
        <div class="cookie-consent-banner__inner">
            <div class="row">
                <div class="col-md-9">
                    <div class="cookie-consent-banner__copy">
                        <div class="cookie-consent-banner__description">
                            This website stores cookies on your browser. These cookies are used to improve your
                            experience and provide more personalized service. To learn more, please review our Privacy
                            Policy.
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="cookie-consent-banner__actions">
                        <a target="_blank" href="/uk-privacy"
                            class="cookie-consent-banner__cta cookie-consent-banner__cta--secondary">
                            PRIVACY POLICY
                        </a>
                        <button class="cookie-consent-banner__cta" onclick="acceptCookieConsent()">ACCEPT</button>
                    </div>
                </div>
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

        function getIconForType(type) {
            switch (type) {
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
        async function handleLocationSearch(query, containerId, target, wrapperId) {
            const suggestions = document.getElementById(containerId);
            const wrapper = wrapperId ? document.getElementById(wrapperId) : null;
            if (!query || query.length < 2) {
                suggestions.classList.remove('show');
                if (wrapper) wrapper.classList.remove('is-loading');
                return;
            }
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
                    const response = await fetch('{{ env('API_URL') }}/web-get-location', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ search: query })
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
                    if (wrapper) wrapper.classList.remove('is-loading');
                    console.error(error);
                    suggestions.classList.remove('show');
                }
            }, 300);
        }
        let bookingData = {
            pickup: '',
            pickupType: '',
            dropoff: '',
            dropoffType: '',
            date: '',
            time: '',
            landingTime: '',
            pickupAfter: 45,
            returnTrip: false,
            returnPickup: '',
            returnPickupType: '',
            returnDropoff: '',
            returnDropoffType: ''
        };
        const vehicles = [{
            id: 1,
            name: "Standard",
            capacity: 4,
            luggage: 2,
            price: 45,
            priceMax: 65,
            image: "/goride/img/saloon.png",
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
            image: "/goride/img/estate.png",
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
            image: "/goride/img/executive.png",
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
            image: "/goride/img/mpv.png",
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
        let selectedTime = '';
        let rideFor = "me";
        let otherPassengerData = null;
        let currentEditingField = null;
        let bookingType = "now";
        let currentCarImageIndex = 1;
        const totalCarImages = 4;
        const MAX_VIA_POINTS = 3;
        // ===== INITIALIZE =====
        $(document).ready(function () {
            showCookieConsentIfNeeded();
            flatpickr("#date", {
                dateFormat: "Y-m-d",
                minDate: "today",
                defaultDate: "today"
            });
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
            }
            if (!$(e.target).closest('.location-input-field').length && !$(e.target).closest('.location-suggestions').length) {
                $('.location-suggestions').removeClass('show');
            }
        });
        function selectLanguage(lang) {
            toggleDropdown('language');
        }
        // ===== CUSTOM TIME DROPDOWN =====
        function toggleTimeDropdown() {
            $('#timeDropdownList').toggleClass('show');
            $('#timeDropdownBtn').toggleClass('active');
        }
        function selectTime(time) {
            selectedTime = time;
            $('#timeDropdownValue').text(time);
            $('#timeDropdownList').removeClass('show');
            $('#timeDropdownBtn').removeClass('active');
            $('.time-dropdown-item').each(function () {
                $(this).removeClass('selected');
                if ($(this).text() === time) {
                    $(this).addClass('selected');
                }
            });
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
            $('#mapCloseBtn').removeClass('visible');
            $('.hero-form-section').css({
                display: 'flex',
                width: '100%'
            });
        }
        function selectPickup(location, type) {
            bookingData.pickup = location;
            bookingData.pickupType = type;
            $('#pickupInput').val(location);
            $('#pickupSuggestions').removeClass('show');
            updateTimePanel();
            updatePickupUI(); // ← ADD THIS LINE
            updateBookingSummary();
            // updateTripDisplayFromStep1();
        }
        function selectDropoff(location, type) {
            bookingData.dropoff = location;
            bookingData.dropoffType = type;
            $('#dropoffInput').val(location);
            $('#dropoffSuggestions').removeClass('show');
            updateTimePanel();
            updateBookingSummary();
            // updateTripDisplayFromStep1();
        }
        function selectReturnPickup(location, type) {
            bookingData.returnPickup = location;
            bookingData.returnPickupType = type;
            $('#returnPickupInput').val(location);
            $('#returnPickupSuggestions').removeClass('show');
        }
        function selectReturnDropoff(location, type) {
            bookingData.returnDropoff = location;
            bookingData.returnDropoffType = type;
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
                alert(errors.join('\n'));
                return false;
            }
            return true;
        }
        // ===== VIA POINTS =====
        function addViaPoint() {
            const viaRows = $("#viaPointsContainer .via-point-row");
            if (viaRows.length >= MAX_VIA_POINTS) {
                alert("Maximum 3 via locations allowed.");
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
            document.getElementById('authLoginModal').classList.add('show');
        }
        function closeAuthModal() {
            document.getElementById('authLoginModal').classList.remove('show');
        }
        // Store pending action so we can resume after login
        let _pendingAfterAuth = null;

        // ===== FORM NAVIGATION =====
        function proceedToTripDetails() {
            const pickup = $('#pickupInput').val();
            const dropoff = $('#dropoffInput').val();
            if (!pickup || !dropoff) {
                $("#timeSelectionPanel").removeClass("show");
                $('section').each(function () {
                    if (!$(this).hasClass('hero-container')) {
                        $(this).removeClass('sections-hidden');
                    }
                });
                $('footer').removeClass('sections-hidden');
                showStep(1);
                if (!pickup) $('#pickupInput').focus();
                else if (!dropoff) $('#dropoffInput').focus();
                return;
            }
            // ---- AUTH GATE ----
            if (!isAuthenticated()) {
                _pendingAfterAuth = _doTripDetails;
                openAuthModal();
                return;
            }
            _doTripDetails();
        }
        function _doTripDetails() {
            const pickup = $('#pickupInput').val();
            const dropoff = $('#dropoffInput').val();
            bookingData.pickup = pickup;
            bookingData.dropoff = dropoff;
            $('#summaryPickup').text(pickup);
            $('#summaryDropoff').text(dropoff);
            $('#timePanelLocation').text(pickup);
            $('#mcsPickup').text(pickup);
            $('#mcsDropoff').text(dropoff);
            let selDate = $('#date').val() || 'Today';
            let selTime = $('#timeDropdownValue').text() || 'Now';
            $('#mcsDateTime').text(selDate + ' ' + selTime);
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
            } else if (pickupType === 'seaport') {
                $('#timePanelTitle').text('Cruise/Ferry Docking Details');
                $('#dateLabel').html('<i class="fas fa-anchor"></i> Cruise/Ferry Docking Date *');
                $('#timeLabel').html('<i class="fas fa-clock"></i> Cruise/Ferry Docking Time *');
                $('#airportLandingFields').hide();
            } else {
                $('#timePanelTitle').text('When do you want to be picked up?');
                $('#dateLabel').html('<i class="fas fa-calendar"></i> Journey Date *');
                $('#timeLabel').html('<i class="fas fa-clock"></i> Journey Time *');
                $('#airportLandingFields').hide();
            }
        }
        function goBackToLocations() {
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
        function showSchedulePanel() {
            bookingType = "schedule";
            $("#timeSelectionPanel").addClass("show");
        }
        function showSchedulePanelFromStep1() {
            bookingType = "schedule";
            // Hide all background sections
            $('section').not('.hero-container').addClass('sections-hidden');
            $('footer').addClass('sections-hidden');
            // Show the panel with fixed positioning
            $("#timeSelectionPanel").addClass("show");
            // Prevent body scroll
            $('body').css('overflow', 'hidden');
            updatePickupUI();
        }
        // Call this whenever pickup location changes
        function updatePickupUI() {
            const pickupType = bookingData.pickupType; // airport, seaport, or address
            // Update button text
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
        function updateSchedule() {
            const date = $("#date").val();
            if (!date || !selectedTime) return;
            bookingData.date = date;
            bookingData.time = selectedTime;
            updateBookingSummary();
            $("#selectedDateTime").show().html(
                `<i class="fas fa-calendar"></i> ${date} &nbsp;&nbsp; <i class="fas fa-clock"></i> ${selectedTime}`
            );
        }
        function saveSchedule() {
            const date = $("#date").val();
            if (!date) {
                alert('Please select a date');
                return;
            }
            if (!selectedTime) {
                alert('Please select a time');
                return;
            }
            bookingData.date = date;
            bookingData.time = selectedTime;
            updateTripDateTimeCard();
            updateBookingSummary();
            const label = `<i class="fas fa-calendar"></i> ${date} &nbsp; <i class="fas fa-clock"></i> ${selectedTime}`;
            // $("#selectedDateTime").show().html(label);
            $("#normalJourneyDate").val(date);
            $("#normalJourneyTime").val(selectedTime);
            if ($("#pickupNowBtn").length) {
                $("#pickupNowBtn").html(`<i class="fas fa-calendar"></i> ${date} &nbsp; <i class="fas fa-clock"></i> ${selectedTime} <i class="fas fa-chevron-down ms-2"></i>`);
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
                $('#forMeTitle').text('For me');
                $('#forMeDetails').hide();
                rideFor = 'me';
                otherPassengerData = null;
            } else {
                $('#forMeRadioMe').attr('class', 'far fa-circle for-me-radio').css('color', '#999');
                $('#forMeRadioOther').attr('class', 'fas fa-dot-circle for-me-radio').css('color', '#000');
                rideFor = 'other';
                $('#otherPassengerName').val('');
                $('#otherPassengerPhone').val('');
                $('#forMeModal').removeClass('show');
                $('#bookForOtherModal').addClass('show');
            }
        }
        function proceedToVehicles() {
            showStep(3);
            if (window.innerWidth > 768) {
                $('#vehicleGrid').addClass('single-col');
            }
            renderVehicles();
        }
        function renderVehicles() {
            const grid = $('#vehicleGrid');
            grid.html('');
            vehicles.forEach(v => {
                const amenitiesHtml = (v.amenities || []).map(a => {
                    let icon = 'fa-check';
                    if (a.toLowerCase().includes('wifi')) icon = 'fa-wifi text-danger';
                    if (a.toLowerCase().includes('air')) icon = 'fa-snowflake text-primary';
                    if (a.toLowerCase().includes('seat')) icon = 'fa-baby-carriage text-success';
                    return `<span class="v-amenity-pill"><i class="fas ${icon}"></i> ${a}</span>`;
                }).join('');

                let tagClass = 'popular';
                if (v.tag && v.tag.toLowerCase().includes('cheapest')) tagClass = 'cheapest';
                if (v.tag && v.tag.toLowerCase().includes('families')) tagClass = 'families';

                const tagHtml = v.tag ? `
    <div class="v-tag">
        <span class="v-tag-pill ${tagClass}">${v.tag}</span>
    </div>
` : '';

              

                const html = `
<div class="vehicle-item" onclick="selectVehicle(this, ${JSON.stringify(v).replace(/"/g, '&quot;')})">
    <div class="vehicle-left">
   
        <img src="${v.image}" alt="${v.name}">
    </div>
    <div class="vehicle-right">
       <div class="v-header">
    <div class="v-name">
        ${v.name}
        <button
            type="button"
            class="vehicle-info-btn"
            onclick="event.stopPropagation(); openVehicleInfo(${v.id})"
            title="Vehicle Details">
            <i class="fas fa-info-circle"></i>
        </button>

      
    </div>

    <div class="v-price">£${v.price} – £${v.priceMax}</div>
</div>
        <div class="v-sub">
           <div class="v-features">
            <span><i class="fas fa-user"></i> ${v.capacity} </span>
            <span><i class="fas fa-suitcase"></i> ${v.luggage} </span>
            <span><i class="fas fa-clock"></i> ${v.arrivalTime || '10 min'} Arrival</span>
           
        </div>
              ${tagHtml}
        </div>
       
        <div class="v-footer">
            <div class="v-amenities">
                ${amenitiesHtml}
            </div>
            <button class="btn-v-select">Select</button>
        </div>
    </div>
</div>
`;
                grid.append(html);
            });
        }
        function selectVehicle(el, vehicle) {
            bookingData.vehicle = vehicle;
            $('.vehicle-item').removeClass('selected');
            $('.btn-v-select').html('Select');
            $(el).addClass('selected');
            $(el).find('.btn-v-select').html('<i class="fas fa-check"></i> Selected');
            // Update sidebar selected vehicle summary immediately
            $('#summaryCarImage').attr('src', vehicle.image);
            $('#summaryCarName').text(vehicle.name);
            $('#summaryCarCapacity').text(vehicle.capacity);
            $('#summaryCarLuggage').text(vehicle.luggage);
            if (vehicle.priceMax) {
                $('#summaryCarPrice').text('£' + vehicle.price + ' – £' + vehicle.priceMax);
            } else {
                $('#summaryCarPrice').text('£' + vehicle.price);
            }
            $('#selectedCarSummary').show();
            // Update mobile compact summary
            $('#mcsCarImage').attr('src', vehicle.image);
            $('#mcsCarName').text(vehicle.name);
            $('#mcsCarCapacity').text(vehicle.capacity);
            $('#mcsCarLuggage').text(vehicle.luggage);
            if (vehicle.priceMax) {
                $('#mcsCarPrice').text('£' + vehicle.price + ' – £' + vehicle.priceMax);
            } else {
                $('#mcsCarPrice').text('£' + vehicle.price);
            }
            $('#mcsCarDetails').show();
            // NEW: Show confirmation message
            console.log('Vehicle selected:', vehicle.name, '- Price: £' + vehicle.price);
        }
        function proceedToPassengerDetails() {
            // Step 1: Check if vehicle is selected
            if (!bookingData.vehicle) {
                alert('Please select a vehicle first');
                return;
            }
            // Step 2: Populate the summary with vehicle details
            const vehicle = bookingData.vehicle;
            $('#summaryCarImage').attr('src', vehicle.image);
            $('#summaryCarName').text(vehicle.name);
            $('#summaryCarCapacity').text(vehicle.capacity);
            $('#summaryCarLuggage').text(vehicle.luggage);
            // IMPORTANT: Display the price range
            if (vehicle.priceMax) {
                $('#summaryCarPrice').text('£' + vehicle.price + ' – £' + vehicle.priceMax);
            } else {
                $('#summaryCarPrice').text('£' + vehicle.price);
            }
            // Show the summary
            $('#selectedCarSummary').show();
            // Step 3: Move to next screen (Booking Details)
            updatePassengerForm();
            updateBookingSummary();
            showStep(4);
            // Optional: Log for debugging
            console.log('Proceeding with vehicle:', vehicle.name, 'Price:', vehicle.price);
        }
        function updatePassengerForm() {
            const pickup = bookingData.pickupType;
            $('#journeyAirport').hide();
            $('#journeySeaport').hide();
            $('#journeyNormal').hide();
            if (pickup === 'airport') {
                $('#journeyAirport').show();
            } else if (pickup === 'seaport') {
                $('#journeySeaport').show();
                if (!document.getElementById('cruiseDate')._flatpickr) {
                    flatpickr('#cruiseDate', {
                        dateFormat: 'd/m/Y',
                        minDate: 'today'
                    });
                }
            } else {
                // $('#journeyNormal').show();
                // if (!document.getElementById('normalJourneyDate')._flatpickr) {
                //     flatpickr('#normalJourneyDate', {
                //         dateFormat: 'd/m/Y',
                //         minDate: 'today'
                //     });
                // }
            }
        }
        // Fallback for showToast if it's not defined globally
        window.showToast = window.showToast || function (msg, type) {
            alert(msg);
        };
        function verifyPersonalInfoAndRequestOTP() {
            const firstName = $('#passengerFirstName').val().trim();
            const email = $('#passengerEmail').val().trim();
            const phone = $('#passengerPhone').val().trim();
            if (!firstName) {
                alert('Please enter your name');
                return;
            }
            if (!phone) {
                alert('Please enter your phone number');
                return;
            }
            if (!email) {
                alert('Please enter your email');
                return;
            }
            bookingData.passengerName = firstName;
            bookingData.passengerEmail = email;
            bookingData.passengerPhone = phone;
            // Skip OTP Modal completely and go to the next section
            $('#personalInfoSection').hide();
            $('#personalInfoBtns').hide();
            $('#additionalBookingDetails').show();
            $('#additionalDetailsBtns').css('display', 'flex');
        }
        function goBackToPersonalInfo() {
            $('#additionalBookingDetails').hide();
            $('#additionalDetailsBtns').hide();
            $('#personalInfoSection').show();
            $('#personalInfoBtns').show();
            $('#personalInfoBtns').css('display', 'flex');
        }
        function proceedToConfirmation() {
            // Ensure payment is selected before triggering API
            const paymentMethod = $('#paymentMethod').val();
            if (!paymentMethod) {
                showToast('Please select payment method', 'error');
                return;
            }
            bookingData.paymentMethod = paymentMethod;
            const email = document.getElementById('passengerEmail').value.trim();
            const name = document.getElementById('passengerFirstName').value.trim();
            const phone = document.getElementById('passengerPhone').value.trim();
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
            const btn = document.querySelector('#step5 .btn-search-uber') || document.querySelector('#personalInfoBtns .btn-search-uber');
            const originalBtnContent = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            btn.disabled = true;
            const num = 'GR-2026-' + Math.floor(10000 + Math.random() * 90000);
            fetch('{{env('API_URL')}}/book', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    email: email,
                    name: name,
                    phone: phone,
                    bookingId: num,
                    pickup: bookingData.pickup || 'Not specified',
                    dropoff: bookingData.dropoff || 'Not specified'
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        $('#confirmNum').text(num);
                        $('#confirmPickup').text(bookingData.pickup || '—');
                        $('#confirmDropoff').text(bookingData.dropoff || '—');
                        if (bookingData.date && bookingData.time) {
                            $('#confirmDateTime').text(`${bookingData.date} | ${bookingData.time}`);
                            $('#confirmDateTime').parent().show();
                        } else {
                            $('#confirmDateTime').parent().hide();
                        }
                        $('#confirmVehicle').text(bookingData.vehicle?.name || '—');
                        $('#confirmDistance').text('~250 kms');
                        $('#confirmDuration').text('~4 hours');
                        showStep(8);
                    } else {
                        showToast('Booking Error: ' + data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('There was a problem connecting to the server. Please try again.', 'error');
                })
                .finally(() => {
                    btn.innerHTML = originalBtnContent;
                    btn.disabled = false;
                });
        }
        function updateBookingSummary() {
            // 1. Passenger Name
            const fname = $('#passengerFirstName').val() || '';
            const lname = $('#passengerLastName').val() || '';
            const pName = (fname + ' ' + lname).trim();
            $('#summaryPassengerName').text(fname.trim() || '–');

            if (pName) {
                $('#mcsPassengerName').text(pName);
                $('#mcsPassengerNameContainer').css('display', 'flex');
            } else {
                $('#mcsPassengerNameContainer').hide();
            }
            // 2. Contact
            const phone = $('#passengerPhone').val() || '';
            $('#summaryPassengerContact').text(phone.trim() ? ('+44 ' + phone.trim()) : '–');
            if (phone.trim()) {
                $('#mcsPassengerPhone').text('+44 ' + phone.trim());
                $('#mcsPassengerPhoneContainer').css('display', 'flex');
            } else {
                $('#mcsPassengerPhoneContainer').hide();
            }
            // 3. Email
            const email = $('#passengerEmail').val() || '';
            $('#summaryPassengerEmail').text(email.trim() || '–');
            if (email.trim()) {
                $('#mcsPassengerEmail').text(email.trim());
                $('#mcsPassengerEmailContainer').css('display', 'flex');
            } else {
                $('#mcsPassengerEmailContainer').hide();
            }
            let showEnteredDetails = false;
            // 4. Passengers count
            const pCount = $('#passengerCount').val() || '1';
            $('#summaryPassengerCount').text(pCount);
            $('#mcsPassengerCount').text(pCount);
            if (parseInt(pCount) > 1 || pName !== '' || email.trim() !== '' || phone.trim() !== '') showEnteredDetails = true;
            // 5. Luggage count
            const lCount = $('#luggageCount').val() || '0';
            $('#summaryLuggageCount').text(lCount);
            $('#mcsLuggageCount').text(lCount);
            if (parseInt(lCount) > 0) {
                $('#mcsLuggageContainer').show();
                showEnteredDetails = true;
            } else {
                $('#mcsLuggageContainer').hide();
            }
            // 6. Hand Luggage count
            const hlCount = $('#handLuggageCount').val() || '0';
            $('#summaryHandLuggageCount').text(hlCount);
            $('#mcsHandLuggageCount').text(hlCount);
            if (parseInt(hlCount) > 0) {
                $('#mcsHandLuggageContainer').show();
                showEnteredDetails = true;
            } else {
                $('#mcsHandLuggageContainer').hide();
            }
            // 7. Baby Seats
            const isBabySeat = $('#carSeatCheckbox').is(':checked');
            if (isBabySeat) {
                const bsCount = parseInt($('#childSeatCount').val()) || 0;
                if (bsCount > 0) {
                    const seatTypes = [];
                    for (let i = 1; i <= bsCount; i++) {
                        const val = $(`#childSeatType_${i}`).val();
                        if (val) {
                            seatTypes.push(val.charAt(0).toUpperCase() + val.slice(1));
                        }
                    }
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

            if (showEnteredDetails) {
                $('#mcsEnteredDetails').css('display', 'grid');
            } else {
                $('#mcsEnteredDetails').hide();
            }
            // 8. Date & Time & Journey Info depending on pickupType
            const pickupType = bookingData.pickupType;
            if (pickupType === 'airport') {
                // Flight details
                $('#summaryDateLabel').html('<i class="fas fa-calendar"></i> Flight Date');
                $('#summaryBookingDate').text(bookingData.date || '–');
                $('#summaryTimeLabel').html('<i class="fas fa-clock"></i> Flight Time');
                $('#summaryBookingTime').text(bookingData.time || '–');
                $('#summaryFlightLabel').text('Flight No.');
                $('#summaryFlightNumber').text($('#flightNumber').val() || '–');
                $('#summaryFlightContainer').show();
                $('#summaryComingFromLabel').text('Coming From');
                $('#summaryComingFrom').text($('#comingFrom').val() || '–');
                $('#summaryComingFromContainer').show();
                $('#summaryDropoffAddressLabel').text('Dropoff Address');
                $('#summaryDropoffAddress').text($('#dropoffAddress').val() || '–');
                $('#summaryDropoffAddressContainer').show();
            } else if (pickupType === 'seaport') {
                // Cruise details
                $('#summaryDateLabel').html('<i class="fas fa-calendar"></i> Docking Date');
                $('#summaryBookingDate').text(bookingData.date || '–');
                $('#summaryTimeLabel').html('<i class="fas fa-clock"></i> Docking Time');
                const dockingTime = $('#dockingTimeSelect').val() || bookingData.time || '–';
                $('#summaryBookingTime').text(dockingTime);
                $('#summaryFlightLabel').text('Cruise/Ferry');
                $('#summaryFlightNumber').text($('#ferryName').val() || '–');
                $('#summaryFlightContainer').show();
                $('#summaryComingFromLabel').text('Coming From');
                $('#summaryComingFrom').text($('#comingFromPort').val() || '–');
                $('#summaryComingFromContainer').show();
                $('#summaryDropoffAddressLabel').text('Dropoff Address');
                $('#summaryDropoffAddress').text($('#dropoffAddressSeaport').val() || '–');
                $('#summaryDropoffAddressContainer').show();
            } else {
                // Normal details
                $('#summaryDateLabel').html('<i class="fas fa-calendar"></i> Journey Date');
                const normalDate = $('#normalJourneyDate').val() || bookingData.date || '–';
                $('#summaryBookingDate').text(normalDate);
                $('#summaryTimeLabel').html('<i class="fas fa-clock"></i> Journey Time');
                const normalTime = $('#normalJourneyTime').val() || bookingData.time || '–';
                $('#summaryBookingTime').text(normalTime);
                // Hide airport/seaport specific details
                $('#summaryFlightContainer').hide();
                $('#summaryComingFromContainer').hide();
                $('#summaryDropoffAddressContainer').hide();
            }
            // Special Requirements
            const isSpecialReq = $('#specialReqCheckbox').is(':checked');
            if (isSpecialReq) {
                $('#summarySpecialRequirements').text($('#specialRequirements').val().trim() || '–');
                $('#summarySpecialReqContainer').show();
            } else {
                $('#summarySpecialReqContainer').hide();
            }
        }
        function verifyPassengerDetails() {
            updateBookingSummary();
            $('#enteredDetailsSummary').show();
            showStep(6);
            startDynamicDriverSearch();
        }
        function startDynamicDriverSearch() {
            const grid = $('#driverList');
            grid.html(''); // Clear previous drivers
            // Add the loader element at the bottom if not already present
            if ($('#moreDriversLoader').length === 0) {
                grid.after(`
                    <div id="moreDriversLoader" class="more-drivers-loader" style="display:none; text-align:center; padding:15px; margin: 15px 0; background: #fdfaf0; border-radius: 8px; border: 1px dashed #f5c00b3b;">
                        <span class="spinner-border spinner-border-sm text-warning" role="status" style="width: 1.2rem; height: 1.2rem; border-width: 0.2em; vertical-align: middle;"></span>
                        <span style="font-size: 13.5px; color: #7c6204; margin-left: 8px; font-weight: 600;">Searching for more drivers...</span>
                    </div>
                `);
            }
            $('#findingDriversLoader').show();
            $('#driverList').hide();
            $('#moreDriversLoader').hide();
            setTimeout(function () {
                // Fade out main loader and show driver list area
                $('#findingDriversLoader').fadeOut(300, function () {
                    $('#driverList').fadeIn(300);
                    $('#moreDriversLoader').fadeIn(300);
                    // Load drivers dynamically one by one
                    loadDriverDynamically(0);
                });
            }, 2000);
        }
        function loadDriverDynamically(index) {
            if (index >= drivers.length) {
                // All drivers loaded
                $('#moreDriversLoader').fadeOut(300);
                return;
            }
            const d = drivers[index];
            const vehicle = bookingData.vehicle;
            const vehicleImg = vehicle?.image || '/goride/img/saloon.png';
            const vehicleName = vehicle?.name || 'Standard';
            const vehicleCapacity = vehicle?.capacity || 4;
            const vehicleLuggage = vehicle?.luggage || 2;
            const driverJson = JSON.stringify(d).replace(/"/g, '&quot;');
            const html = `
<div class="driver-item driver-card" onclick="openDriverReview(${driverJson})" style="cursor:pointer; display:none; margin-bottom:15px;">
    <div class="driver-info">
        <div class="driver-details">
            <div class="driver-header">
                 <div class="driver-car-banner">
                    <img src="${vehicleImg}" alt="${vehicleName}">
                    <div class="driver-car-banner-details">
                        <div class="driver-car-banner-name">${vehicleName}</div>
                        <div class="driver-car-banner-meta">
                            <span><i class="fas fa-user"></i>  ${vehicleCapacity}</span>
                            <span><i class="fas fa-suitcase"></i> ${vehicleLuggage}</span>
                        </div>
                    </div>
                </div>
                <div class="driver-wrap">
                <div class="driver-avatar">
                    ${d.avatar}
                </div>
               <div class="driver-text">
                    <h4>${d.name}</h4>
                
                    <div class="driver-rating-info">
                        <span>
                            <i class="fas fa-star"></i>
                            ${d.rating} (${d.trips} trips)
                        </span>
                
                        <span class="driver-divider">•</span>
                
                        <span>
                            <i class="fas fa-id-badge"></i>
                            ${d.experience}
                        </span>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="driver-bid-box">
            <div class="driver-price-row">
                <div class="bid-amount">
                    £${d.bid}
                </div>
            </div>
            <div class="bid-eta">
                <i class="fas fa-clock"></i>
                ${d.eta} away
            </div>
        </div>
    </div>
</div>`;
            const newElem = $(html);
            $('#driverList').append(newElem);
            newElem.slideDown(400);
            // Set timeout for next driver
            setTimeout(function () {
                loadDriverDynamically(index + 1);
            }, 2000);
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
                alert("Enter valid OTP");
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
            const vehicleImg = vehicle?.image || '/goride/img/saloon.png';
            const vehicleName = vehicle?.name || 'Standard';
            const vehicleCapacity = vehicle?.capacity || 4;
            const vehicleLuggage = vehicle?.luggage || 2;
            const vehiclePrice = vehicle?.price || '-';
            const vehiclePriceMax = vehicle?.priceMax || '';
            const priceDisplay = vehiclePriceMax ? `£${vehiclePrice} – £${vehiclePriceMax}` : `£${vehiclePrice}`;
            drivers.forEach(d => {
                const driverJson = JSON.stringify(d).replace(/"/g, '&quot;');
                const html = `
<div class="driver-item driver-card" onclick="openDriverReview(${driverJson})" style="cursor:pointer;">
    <!-- Car Banner -->
    <div class="driver-info">
        <div class="driver-details">
            <div class="driver-header">
                 <div class="driver-car-banner">
        <img src="${vehicleImg}" alt="${vehicleName}">
        <div class="driver-car-banner-details">
            <div class="driver-car-banner-name">${vehicleName}</div>
              <div class="driver-car-banner-meta">
                <span><i class="fas fa-user"></i>  ${vehicleCapacity}</span>
                <span><i class="fas fa-suitcase"></i> ${vehicleLuggage}</span>
            </div>
        </div>
    </div>
                <div class="driver-avatar">
                    ${d.avatar}
                </div>
                <div class="driver-text">
                    <h4>${d.name}</h4>
                    <div class="driver-rating-info">
                        <i class="fas fa-star"></i>
                        ${d.rating} (${d.trips} trips)
                    </div>
                </div>
            </div>
        </div>
        <div class="driver-bid-box">
            <div class="driver-price-row">
                <div class="bid-amount">
                    £${d.bid}
                </div>
            </div>
            <div class="bid-eta">
                <i class="fas fa-clock"></i>
                ${d.eta} away
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
            const vehicleImg = bookingData.vehicle?.image || 'goride/img/fleet1.png';
            const vehicleName = bookingData.vehicle?.name || '-';
            const vehiclePrice = bookingData.vehicle?.price || driver.bid;
            $('#rcDriverAvatar').html(driver.avatar);
            $('#rcDriverName').text(driver.name);
            const rating = parseFloat(driver.rating);
            let starsHtml = '';
            for (let i = 1; i <= 5; i++) {
                starsHtml += `<i class="fas fa-star" style="color:${i <= Math.round(rating) ? '#f59e0b' : '#ddd'}"></i>`;
            }
            starsHtml += `<span>${rating}</span>`;
            $('#rcDriverStars').html(starsHtml);
            if (driver.badge) {
                $('#rcDriverBadge').text(driver.badge).show();
            } else {
                $('#rcDriverBadge').hide();
            }
            $('#rcCarImage').attr('src', vehicleImg);
            $('#rcFareAmount').text('\u00a3' + vehiclePrice);
            $('#rcCarName').text(vehicleName);
            $('#rcPassengerCapacity').text(vehicle.capacity);
            $('#rcLuggageCapacity').text(vehicle.luggage);
            $('#rcTransmission').text(vehicle.transmission || 'Automatic');

            if (vehicle.tag) {
                $('#rcVehicleTag').text(vehicle.tag).show();
            } else {
                $('#rcVehicleTag').hide();
            }

            $('#rcDriverExperience').text(driver.experience || '6+ Years');
            $('#rcDriverTrips').text(driver.trips || '2,145');
            $('#rcDriverReviewsPct').text(driver.positiveReviews || '98%');

            const amenitiesGrid = $('#rcVehicleAmenitiesGrid');
            amenitiesGrid.empty();
            if (vehicle.amenities) {
                vehicle.amenities.forEach(am => {
                    let icon = 'fa-check';
                    let label = am;
                    if (am.toLowerCase().includes('wifi')) { icon = 'fa-wifi'; label = 'Free Wi-Fi'; }
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
            showStep(7);
        }
        function acceptDriverFromList(driver) {
            openDriverReview(driver);
        }
        function showCarDetailsModal(driver) {
            currentCarImageIndex = 1;
            $('#carCarouselImage').attr('src', `goride/img/fleet1.png`);
            bookingData.tempDriver = driver;
            $('#carDetailsModal').addClass('show');
        }
        function nextCarImage() {
            currentCarImageIndex++;
            if (currentCarImageIndex > totalCarImages) {
                currentCarImageIndex = 1;
            }
            $('#carCarouselImage').attr('src', `goride/img/fleet${currentCarImageIndex}.png`);
        }
        function prevCarImage() {
            currentCarImageIndex--;
            if (currentCarImageIndex < 1) {
                currentCarImageIndex = totalCarImages;
            }
            $('#carCarouselImage').attr('src', `goride/img/fleet${currentCarImageIndex}.png`);
        }
        function acceptDriver() {
            if (bookingData.tempDriver) {
                bookingData.selectedDriver = bookingData.tempDriver;
            }
            $('#carDetailsModal').removeClass('show');
            setTimeout(function () {
                showStep(5);
                updatePaymentSummary();
            }, 300);
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
            $('#confirmDistance').text('~250 kms');
            $('#confirmDuration').text('~4 hours');
            $('#confirmBaseFare').text('\u00a3' + baseFare.toFixed(2));
            $('#confirmMeetGreet').text('\u00a3' + (meetGreet + totalChildSeat).toFixed(2));
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
            // Bind input change events to update the booking summary live
            $(document).on('input change',
                '#passengerFirstName, #passengerPhone, #passengerEmail, #passengerCount, #luggageCount, #handLuggageCount, #carSeatCheckbox, #childSeatCount, .carSeatTypeSelect, #flightNumber, #comingFrom, #dropoffAddress, #ferryName, #dockingTimeSelect, #comingFromPort, #dropoffAddressSeaport, #normalJourneyDate, #normalJourneyTime, #specialReqCheckbox, #specialRequirements, #date',
                function () {
                    updateBookingSummary();
                }
            );
            // Synchronize normal journey date/time inputs back to bookingData
            $(document).on('change', '#normalJourneyDate', function () {
                bookingData.date = $(this).val();
                updateBookingSummary();
            });
            $(document).on('change', '#normalJourneyTime', function () {
                bookingData.time = $(this).val();
                updateBookingSummary();
            });
            $('#viewBookingBtn').on('click', function () {
                const bookingId = $('#confirmNum').text();
                alert('Booking Information:\n\nID: ' + bookingId + '\n\nBooking details saved successfully!');
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
            setTimeout(() => {
                window.location.href = window.location.href.split('#')[0];
            }, 300);
        }
        function showStep(stepNumber) {
            $('body').css('overflow', 'auto');
            const sections = $('.form-section');
            if (window.innerWidth > 768 && stepNumber >= 3) {
                const formSection = $('.hero-form-section');
                const mapSection = $('.hero-map-section');
                formSection.removeClass('col-md-5').addClass('col-md-8 three-column-mode');
                mapSection.removeClass('col-md-7').addClass('col-md-4');
                sections.removeClass('active side-by-side');
                $('#step2').addClass('active side-by-side');
                $(`#step${stepNumber}`).addClass('active side-by-side');
                $('#step2Buttons').hide();
                $('#bookingImage').hide();
                $('#bookingMap').show();
                setTimeout(function () {
                    if (typeof initSingleRouteMap === 'function') {
                        initSingleRouteMap();
                    }
                }, 300);
            } else {
                sections.removeClass('active side-by-side');
                $(`#step${stepNumber}`).addClass('active');
                if (window.innerWidth > 768 && stepNumber < 3) {
                    const formSection = $('.hero-form-section');
                    const mapSection = $('.hero-map-section');
                    formSection.removeClass('col-md-8 three-column-mode').addClass('col-md-5');
                    mapSection.removeClass('col-md-4').addClass('col-md-7');
                    if (stepNumber === 1) {
                        $('#bookingMap').hide();
                        $('#bookingImage').show();
                    } else if (stepNumber === 2) {
                        $('#step2Buttons').css('display', 'flex');
                    }
                }
            }
            // DYNAMIC SIDEBAR VISIBILITY BASED ON STATE
            if (stepNumber >= 3) {
                if (bookingData.vehicle) {
                    $('#selectedCarSummary').show();
                } else {
                    $('#selectedCarSummary').hide();
                }
                if (stepNumber >= 5) {
                    $('#enteredDetailsSummary').show();
                    updateBookingSummary();
                } else {
                    $('#enteredDetailsSummary').hide();
                }
            }
            if (stepNumber >= 5) {
                // $('#selectedCarSummary').hide();
                $('.edit-icon-btn').hide();
            } else if (stepNumber === 2) {
                $('.edit-icon-btn').show();
            } else {
                // $('#selectedCarSummary').hide();
                $('#enteredDetailsSummary').hide();
            }
            $('.hero-form-section').scrollTop(0);
            if (window.innerWidth <= 768) {
                const actionBar = $('#mobileActionBar');

                if (stepNumber === 1) {
                    $('.navbar-menu').removeClass('hide-on-mobile');
                    $('#mobileHamburger').css('display', 'flex');
                    $('#mobileMapBtn').hide();
                    $('#bookingImage').show();
                    $('#bookingMap').hide();
                    $('#mobileCompactSummary').removeClass('visible');
                    $(`#step1`).css('padding-top', '0');
                    if (actionBar.length) actionBar.removeClass('hidden');
                } else if (stepNumber === 8) {
                    $('.navbar-menu').addClass('hide-on-mobile');
                    $('#mobileHamburger').hide();
                    $('#mobileMapBtn').hide();
                    $('#bookingImage').hide();
                    $('#mobileCompactSummary').removeClass('visible');
                    if (actionBar.length) actionBar.addClass('hidden');
                    $(`#step8`).css('padding-top', '20px');
                } else {
                    $('.navbar-menu').addClass('hide-on-mobile');
                    $('#mobileHamburger').hide();
                    $('#mobileMapBtn').css('display', 'flex');
                    $('#bookingImage').hide();
                    $('#mobileCompactSummary').addClass('visible');
                    if (actionBar.length) actionBar.addClass('hidden');
                    $(`#step${stepNumber}`).css('padding-top', '120px');
                }
            }
        }
        function goBack(step) {
            showStep(step);
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
            const name = $('#otherPassengerName').val().trim();
            const phone = $('#otherPassengerPhone').val().trim();
            if (!name) {
                alert('Please enter recipient name');
                return;
            }
            otherPassengerData = {
                name,
                phone
            };
            $('#forMeTitle').text('Book for someone');
            $('#forMeDetails').html(phone ?
                `${name}<br><small style="font-size:18px;">${phone}</small>` :
                name).show();
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
                const response = await fetch('/api/bookings', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });
                const result = await response.json();
                if (result.success) {
                    alert('Booking confirmed! Confirmation #' + result.booking_id);
                } else {
                    alert('Booking failed: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Network error while saving booking');
            }
        }
        function goBackToLocationsFromVehicles() {
            $('#selectedCarSummary').hide();
            goBackToLocations();
        }
        function updateCounter(inputId, delta, min, max) {
            const input = $(`#${inputId}`);
            const display = $(`#${inputId}Display`);
            if (!input.length || !display.length) return;
            let val = parseInt(input.val()) || 0;
            val += delta;
            if (val < min) val = min;
            if (val > max) val = max;
            input.val(val);
            display.text(val);
        }
        function toggleChildSeatOptions() {
            const checkbox = $('#carSeatCheckbox');
            const options = $('#childSeatOptions');
            if (!checkbox.length || !options.length) return;
            if (checkbox.is(':checked')) {
                options.show();
                $('#childSeatCount').val(0);
                $('#childSeatCountDisplay').text(0);
                renderCarSeatDropdowns(0);
            } else {
                options.hide();
                $('#childSeatCount').val(0);
                $('#childSeatCountDisplay').text(0);
                $('#carSeatDropdownsContainer').html('');
            }
        }
        function openVehicleInfo(id) {
            const vehicle = vehicles.find(v => v.id === id);
            $("#vehicleModalTitle").html(vehicle.name);
            let recommendedHtml = '';
            switch (vehicle.name) {
                case 'Standard':
                    recommendedHtml = `
                        <ul class="vehicle-recommended-list">
                            <li><i class="fas fa-check-circle"></i> 1 Passenger + 3 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 2 Passengers + 2 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 3 Passengers + 1 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 4 Passengers + 2 Cabin Bags</li>
                            <li><i class="fas fa-exclamation-triangle"></i> Not recommended for 4 passengers with more than 2 large suitcases.</li>
                        </ul>
                    `;
                    break;
                case 'Estate':
                    recommendedHtml = `
                        <ul class="vehicle-recommended-list">
                            <li><i class="fas fa-check-circle"></i> 1 Passenger + 4 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 2 Passengers + 4 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 3 Passengers + 3 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 4 Passengers + 4 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> Ideal for airport transfers with extra baggage.</li>
                        </ul>
                    `;
                    break;
                case 'Executive':
                    recommendedHtml = `
                        <ul class="vehicle-recommended-list">
                            <li><i class="fas fa-check-circle"></i> 1 Passenger + 3 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 2 Passengers + 3 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 3 Passengers + 2 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 4 Passengers + 2 Cabin Bags</li>
                            <li><i class="fas fa-star"></i> Premium vehicle for business and executive travel.</li>
                        </ul>
                    `;
                    break;
                case 'MPV':
                    recommendedHtml = `
                        <ul class="vehicle-recommended-list">
                            <li><i class="fas fa-check-circle"></i> 2 Passengers + 6 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 4 Passengers + 4 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 5 Passengers + 3 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 6 Passengers + 4 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> Great choice for families and group airport transfers.</li>
                        </ul>
                    `;
                    break;
                case '8 Seater':
                    recommendedHtml = `
                        <ul class="vehicle-recommended-list">
                            <li><i class="fas fa-check-circle"></i> 4 Passengers + 8 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 6 Passengers + 6 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 7 Passengers + 5 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 8 Passengers + 4–6 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> Best for large families, tours, and group travel.</li>
                        </ul>
                    `;
                    break;
                case 'Executive MPV':
                    recommendedHtml = `
                        <ul class="vehicle-recommended-list">
                            <li><i class="fas fa-check-circle"></i> 2 Passengers + 6 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 4 Passengers + 4 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 5 Passengers + 3 Large Luggage</li>
                            <li><i class="fas fa-check-circle"></i> 6 Passengers + 4 Large Luggage</li>
                            <li><i class="fas fa-star"></i> Luxury MPV with premium comfort for executive and VIP travel.</li>
                        </ul>
                    `;
                    break;
            }
        $("#vehicleModalContent").html(`
    <div class="vehicle-info-section">
        <div class="vehicle-modal-price-range">
            <i class="fas fa-tag"></i>
            <span>Price Range: <strong>£${vehicle.price} – £${vehicle.priceMax}</strong></span>
        </div>

        <h6><i class="fas fa-info-circle"></i> Recommended for:</h6>
        ${recommendedHtml}

        <button class="vehicle-modal-price-btn" onclick="closeModal('vehicleInfoModal')">
            Select Cabs
        </button>
    </div>
`);

$("#vehicleInfoModal").addClass("show");
        }
        // ===== CAR SEAT COUNT UPDATE =====
        function updateCarSeatCount(delta) {
            const input = $('#childSeatCount');
            const display = $('#childSeatCountDisplay');
            if (!input.length || !display.length) return;
            let val = parseInt(input.val()) || 0;
            val += delta;
            if (val < 0) val = 0;
            if (val > 4) val = 4;
            input.val(val);
            display.text(val);
            renderCarSeatDropdowns(val);
        }
        // ===== RENDER CAR SEAT DROPDOWNS DYNAMICALLY =====
        function renderCarSeatDropdowns(count) {
            const container = $('#carSeatDropdownsContainer');
            if (!container.length) return;
            container.html('');
            for (let i = 1; i <= count; i++) {
                const dropdownHtml = `
            <div class="form-group-uber booking-form-group" style="margin-bottom: 0;">
                <label style="font-size: 13px;">Baby Seat ${i} Type</label>
                <select id="childSeatType_${i}" class="carSeatTypeSelect" style="width: 100%;">
                    <option value="">Select Type</option>
                    <option value="infant">Infant (0-1 yr)</option>
                    <option value="toddler">Toddler (1-4 yr)</option>
                    <option value="booster">Booster (4-12 yr)</option>
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
            $('#mobileTripBody').slideToggle(200);
            $('#tripSummaryArrow').toggleClass('rotate');
            $('.mobile-from, .mobile-to').toggleClass('expanded-text');
            $('#mcsPickup, #mcsDropoff').toggleClass('text-truncate');
        }
        function updateTripDateTimeCard() {
            $('#tripSelectedDate').text(bookingData.date || '--');
            $('#tripSelectedTime').text(bookingData.time || '--');
        }
        $('#mcsPickup')
            .text(bookingData.pickup)
            .attr('title', bookingData.pickup);

        $('#mcsDropoff')
            .text(bookingData.dropoff)
            .attr('title', bookingData.dropoff);

        const phoneInput = document.querySelector("#passengerPhone");

        const iti = window.intlTelInput(phoneInput, {
            initialCountry: "gb", // Default UK
            preferredCountries: ["gb", "us", "in", "ae", "au"],
            separateDialCode: true,
            nationalMode: true,
            autoPlaceholder: "polite",
            strictMode: true,
            loadUtils: () =>
                import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js")
        });
    </script>


    <!-- intl-tel-input JS -->
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.8.1/build/js/intlTelInput.min.js"></script>


    <!-- ===== AUTH LOGIN MODAL ===== -->
    <div id="authLoginModal" role="dialog" aria-modal="true" aria-labelledby="authModalHeadline">
        <div class="auth-modal-backdrop" onclick="closeAuthModal()"></div>
        <div class="auth-modal-card">
            <button class="auth-modal-close" onclick="closeAuthModal()" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>

            <!-- Logo -->
            <div class="auth-modal-logo">
                <img src="https://www.goride.net.in/goride/img/logo-light.png" alt="GoRide">
            </div>

            <h2 class="auth-modal-headline" id="authModalHeadline">Sign in to continue</h2>
            <p class="auth-modal-sub">See prices and book your ride in seconds.<br>No card required to browse.</p>

            <!-- STEP 1: Phone / Google Login -->
            <div id="authStep1">
                <!-- Continue with Google -->
                <button class="auth-google-btn" id="authGoogleBtn" onclick="handleGoogleSignIn()">
                    <!-- Google SVG icon -->
                    <svg class="auth-google-icon" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                        <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                        <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                        <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                        <path fill="none" d="M0 0h48v48H0z"/>
                    </svg>
                    Continue with Google
                </button>

                <!-- Divider -->
                <div class="auth-divider"><span>or continue with email / mobile</span></div>

                <!-- Email / Phone input (intl-tel-input) -->
                <div id="authPhoneWrapper">
                    <input
                        type="tel"
                        id="authContactInput"
                        placeholder="Email or phone number"
                        autocomplete="off"
                    >
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
                    <h3 style="font-size: 22px; font-weight: 800; color: #111; margin-bottom: 8px;">Verify your number</h3>
                    <p class ="otp-code">
                        We've sent a 6-digit code to <br>
                        <span id="authOtpTarget" style="font-weight: 700; color: #111;"></span>
                    </p>
                </div>
                
                <div id="authNewUserFields" style="display: none; margin-bottom: 24px; animation: slideUp 0.4s ease-out;">
                    <div style="margin-bottom: 16px; position: relative;">
                        <i class="fas fa-user" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #888; font-size: 15px;"></i>
                        <input type="text" id="authNameInput" placeholder="Full Name" style="width: 100%; padding: 15px 15px 15px 48px; border: 1.5px solid #e5e7eb; border-radius: 12px; font-size: 15px; font-weight: 500; transition: all 0.2s ease; box-sizing: border-box; outline: none; background: #fff;" autocomplete="off" onfocus="this.style.borderColor='#111'; this.style.boxShadow='0 0 0 4px rgba(0,0,0,0.05)'" onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
                    </div>
                    <div style="position: relative;">
                        <i class="fas fa-envelope" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #888; font-size: 15px;"></i>
                        <input type="email" id="authEmailInput" placeholder="Email Address" style="width: 100%; padding: 15px 15px 15px 48px; border: 1.5px solid #e5e7eb; border-radius: 12px; font-size: 15px; font-weight: 500; transition: all 0.2s ease; box-sizing: border-box; outline: none; background: #fff;" autocomplete="off" onfocus="this.style.borderColor='#111'; this.style.boxShadow='0 0 0 4px rgba(0,0,0,0.05)'" onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
                    </div>
                </div>

                <div style="margin-bottom: 15px; position: relative;">
                    <input type="text" id="authOtpInput" class="premium-otp-input" placeholder="Enter 6-digit OTP" maxlength="6" autocomplete="off">
                </div>
                
                <button id="authVerifyBtn" style="width: 100%; padding: 14px; background: #111; color: #fff; border: none; border-radius: 12px; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 10px; box-shadow: 0 6px 15px rgba(0,0,0,0.1);" onclick="handleVerifyOtp()" onmouseover="this.style.background='#000'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.2)'" onmouseout="this.style.background='#111'; this.style.transform='none'; this.style.boxShadow='0 6px 15px rgba(0,0,0,0.1)'">
                    Verify &amp; Continue <i class="fas fa-arrow-right" style="font-size: 14px;"></i>
                </button>
                
                <div style="text-align: center; margin-top: 15px;">
                    <button style="background: none; border: none;color:black; font-size: 14px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;" onclick="_showPhoneUI()" onmouseover="this.style.color='#111'" onmouseout="this.style.color='#666'">
                        <i class="fas fa-pen" style="font-size: 12px;"></i> Change Phone Number
                    </button>
                </div>
            </div>

            <!-- Firebase Recaptcha Container -->
            <div id="recaptcha-container" style="margin-top: 15px; display: flex; justify-content: center;"></div>

            <p class="auth-modal-terms">
                By continuing, you agree to our
                <a href="/uk-terms" target="_blank">Terms of Service</a> &amp;
                <a href="/uk-privacy" target="_blank">Privacy Policy</a>.
            </p>
        </div>
    </div>

    <!-- Firebase JS SDK (v8 compat for easy global access) -->
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-auth-compat.js"></script>

    <!-- intl-tel-input JS -->
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.8.1/build/js/intlTelInput.min.js"></script>
    
    <script>
        // ===== AUTH MODAL: intl-tel-input init =====
        let _itiInstance = null;
        (function initIti() {
            const inputEl = document.getElementById('authContactInput');
            if (!inputEl) return;
            _itiInstance = window.intlTelInput(inputEl, {
                initialCountry: 'gb',
                separateDialCode: true,
                countrySearch: true,
                showFlags: true,
                loadUtilsOnInit: 'https://cdn.jsdelivr.net/npm/intl-tel-input@23.8.1/build/js/utils.js',
                preferredCountries: ['gb', 'us', 'in', 'au', 'ca', 'de', 'fr', 'ae', 'sg', 'za'],
                dropdownContainer: document.body,
            });
        })();

        // ===== GOOGLE IDENTITY SERVICES AUTH =====
        const GOOGLE_CLIENT_ID = '{{ env("GOOGLE_CLIENT_ID") }}';
        const API_BASE_URL = '{{ env("API_URL") }}';

        // Reset the Google Sign-In button to its default state
        function _resetGoogleBtn() {
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

            // Ensure GSI library is loaded
            if (!window.google || !window.google.accounts) {
                _showAuthError('Google Sign-In library not loaded yet. Please try again.');
                _resetGoogleBtn();
                return;
            }

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
            // Check if a user button already exists
            let existingBtn = document.getElementById('navbarUserBtn');
            if (!existingBtn) {
                const navMenu = document.querySelector('.navbar-menu');
                if (!navMenu) return;

                const li = document.createElement('li');
                li.style.position = 'relative';
                li.innerHTML = `
                    <button id="navbarUserBtn" style="display:flex;align-items:center;gap:8px;background:none;border:1.5px solid #ddd;border-radius:30px;padding:6px 14px;cursor:pointer;font-size:14px;font-weight:600;" onclick="_toggleUserDropdown(event)">
                        <span id="navbarUserAvatar" style="width:28px;height:28px;border-radius:50%;background:#000;color:#fff;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;overflow:hidden;"></span>
                        <span id="navbarUserName"></span>
                        <i class="fas fa-chevron-down" style="font-size:11px;"></i>
                    </button>
                    <!-- User Dropdown Menu -->
                    <div id="navbarUserDropdown" style="display:none; position:absolute; right:0; top:45px; background:#fff; border:1px solid #eee; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,0.1); width:200px; z-index:1000; overflow:hidden;">
                        <ul style="list-style:none; margin:0; padding:10px 0;">
                            <li>
                                <button onclick="handleLogout()" style="width:100%; text-align:left; background:none; border:none; padding:12px 20px; font-size:15px; color:#d93025; cursor:pointer; display:flex; align-items:center; gap:10px; transition:background 0.2s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='none'">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </li>
                        </ul>
                    </div>`;
                navMenu.appendChild(li);
                
                // Close dropdown if clicked outside
                document.addEventListener('click', function(e) {
                    const dropdown = document.getElementById('navbarUserDropdown');
                    const btn = document.getElementById('navbarUserBtn');
                    if (dropdown && btn && !btn.contains(e.target) && !dropdown.contains(e.target)) {
                        dropdown.style.display = 'none';
                    }
                });
            }

            // Update values
            const avatarSpan = document.getElementById('navbarUserAvatar');
            const nameSpan = document.getElementById('navbarUserName');
            if (avatarSpan) {
                if (avatar) {
                    avatarSpan.innerHTML = `<img src="${avatar}" style="width:28px;height:28px;border-radius:50%;object-fit:cover;">`;
                } else {
                    avatarSpan.textContent = initials;
                }
            }
            if (nameSpan) nameSpan.textContent = fullName.split(' ')[0]; // First name only
        }

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

            // Clear cookies (set expiration to past)
            document.cookie = 'auth_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'auth_user=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            
            // Sign out from Firebase if initialized
            if (window.firebase && firebase.auth) {
                try {
                    await firebase.auth().signOut();
                } catch(e) {}
            }

            // Reload page to reset state
            window.location.reload();
        }

        // Email / phone continue handler
        let _firebaseAuthObj = null;
        let _confirmationResult = null;
        let _isNewUser = false;
        let _currentMobile = '';

        async function handleAuthContinue() {
            if (!_itiInstance) return;
            
            // Get selected country data and raw input
            const countryData = _itiInstance.getSelectedCountryData();
            const dialCode = countryData && countryData.dialCode ? countryData.dialCode : '';
            const rawVal = document.getElementById('authContactInput').value.replace(/\D/g, '');
            
            // Construct the E164 format manually if getNumber() fails
            let mobileNumber = _itiInstance.getNumber();
            if (!mobileNumber) {
                mobileNumber = '+' + dialCode + rawVal;
            }

            if (!rawVal || rawVal.length < 6) {
                _showAuthError('Please enter a valid phone number.');
                return;
            }
            _currentMobile = mobileNumber;

            const btn = document.getElementById('authContinueBtn');
            btn.disabled = true;
            btn.innerHTML = `<i class="fas fa-spinner fa-spin"></i>&nbsp; Checking…`;

            try {
                // 1. Check User
                const response = await fetch(API_BASE_URL + '/auth/check-user', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ login: 'mobile', value: mobileNumber }),
                });
                
                const result = await response.json();
                
                if (result.status === false) {
                    _showAuthError(result.message || 'Failed to verify number.');
                    _resetContinueBtn();
                    return;
                }

                _isNewUser = !result.exists;

                // 2. Initialize Firebase if not done
                if (!_firebaseAuthObj && result.firebase) {
                    firebase.initializeApp(result.firebase);
                    _firebaseAuthObj = firebase.auth();
                }

                // 3. Send OTP
                btn.innerHTML = `<i class="fas fa-spinner fa-spin"></i>&nbsp; Sending OTP…`;
                
                // Clear old recaptcha
                document.getElementById('recaptcha-container').innerHTML = '';
                window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                    'size': 'invisible'
                });

                _confirmationResult = await _firebaseAuthObj.signInWithPhoneNumber(mobileNumber, window.recaptchaVerifier);
                
                // 4. Show OTP UI
                _showOtpUI();
                
            } catch (err) {
                console.error('Check user / OTP Error:', err);
                _showAuthError('Failed to send OTP. Please try again.');
                _resetContinueBtn();
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

            // Show name/email if new user
            if (_isNewUser) {
                document.getElementById('authNewUserFields').style.display = 'block';
            } else {
                document.getElementById('authNewUserFields').style.display = 'none';
            }
        }

        function _showPhoneUI() {
            // Show step 1 wrapper entirely
            document.getElementById('authStep1').style.display = 'block';
            
            // Hide OTP section
            document.getElementById('authOtpSection').style.display = 'none';
            _resetContinueBtn();
        }

        async function handleVerifyOtp() {
            const otp = document.getElementById('authOtpInput').value.trim();
            if (!otp || otp.length < 6) {
                _showAuthError('Please enter a valid 6-digit OTP.');
                return;
            }

            let name = '';
            let email = '';
            
            if (_isNewUser) {
                name = document.getElementById('authNameInput').value.trim();
                email = document.getElementById('authEmailInput').value.trim();
                if (!name || !email) {
                    _showAuthError('Please enter your Name and Email to register.');
                    return;
                }
            }

            const btn = document.getElementById('authVerifyBtn');
            const oldHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = `<i class="fas fa-spinner fa-spin"></i>&nbsp; Verifying…`;

            try {
                // Verify OTP with Firebase
                const result = await _confirmationResult.confirm(otp);
                const idToken = await result.user.getIdToken();

                // Send token to backend
                const response = await fetch(API_BASE_URL + '/auth/verify-otp', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({
                        mobile: _currentMobile,
                        firebase_token: idToken,
                        name: name,
                        email: email
                    }),
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
                _showAuthError('Invalid OTP. Please check and try again.');
                btn.disabled = false;
                btn.innerHTML = oldHtml;
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
</body>

</html>