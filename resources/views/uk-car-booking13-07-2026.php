<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoRide - Ride Like Uber</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        rel="stylesheet">
    <link rel="shortcut icon" href="https://www.goride.net.in/goride/img/Go-Ride-fav-icon.webp" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Minus+Inlier+Sans&display=swap');
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
        /* Common text hover */
        /*.btn-search-uber:hover,*/
        /*.btn-back-uber:hover,*/
        /*.select-driver-btn:hover,*/
        /*.btn-modal-primary:hover,*/
        /*.btn-modal-secondary:hover,*/
        /*.offer-apply-btn:hover {*/
        /*    color: #000 !important;*/
        /*}*/
        /* Active */
        button:active,
        a:active,
        .btn:active {
            color: #000 !important;
        }
        /* Mobile only */
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
        .navbar-menu .user-btn {
            background: #fff;
            color: #000;
            border-radius: 20px;
            font-weight: 600;
            padding: 8px 16px;
        }
        .navbar-menu .user-btn:hover {
            color: #000;
            background: #f5f5f5;
        }
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
        /* ===== HERO SECTION (UBER LAYOUT) ===== */
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
        /* ===== OFFER CREDITS SECTION ===== */
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
        /* ===== LOCATION INPUT WITH SUGGESTIONS ===== */
        .location-input-field {
            width: 100% !important;
            padding: 12px 15px !important;
            border: 2px solid #ddd !important;
            border-radius: 8px !important;
            font-size: 17px !important;
            background: #f5f5f5 !important;
            transition: all 0.3s ease !important;
            cursor: pointer !important;
        }
        .location-input-field:focus {
            outline: none !important;
            background: #fff !important;
            border-color: #000 !important;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
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
        /* ===== CUSTOM TIME DROPDOWN ===== */
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
        /* ===== VIA POINTS ===== */
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
            font-size: 13px !important;
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
        /* ===== FORM LAYOUT ===== */
        .form-group-uber {
            margin-bottom: 15px;
            position: relative;
        }
        .form-group-uber label {
            display: block;
            font-size: 20px;
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
            font-size: 13px;
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
        .vehicle-item {
            display: flex;
            align-items: center;
            gap: 18px;
            border: 1px solid #ddd;
            border-radius: 16px;
            padding: 5px;
            background: #fff;
            cursor: pointer;
            transition: .3s;
            justify-content: space-around;
        }
        .vehicle-item:hover {
            border-color: #000;
        }
        /*.vehicle-image{*/
        /*    flex:0 0 110px;*/
        /*}*/
        .vehicle-image img {
            width: 100%;
            height: 110px;
            object-fit: cover;
        }
        /*.vehicle-content{*/
        /*    flex:1;*/
        /*}*/
        .vehicle-name {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
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
            font-size: 34px;
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
        /* Passenger Grid Layout */
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
            font-size: 37px;
            font-weight: 700;
            margin-bottom: 16px;
            color: black;
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
            padding: 16px;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            margin-bottom: 16px;
        }
        .find-trip-card h4 {
            margin: 0 0 12px 0;
            font-size: 16px;
            font-weight: 700;
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
            font-size: 14px;
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
            font-size: 13px;
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
            font-size: 12px;
            color: #666;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }
        /* ===== FOR ME MODAL ===== */
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
            background: #f9f9f9;
        }
        .section-padding {
            padding: 50px 0;
        }
        .section-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #000;
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
            padding: 20px 0;
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
        @media (max-width:991px) {
            .booking-form-section {
                padding: 16px;
            }
        }
        @media (max-width:767px) {
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
        @media (max-width:768px) {
            .vehicle-grid-uber {
                grid-template-columns: repeat(1, 1fr);
            }
            .vehicle-image img {
                width: 100%;
                height: 85px;
                object-fit: contain;
            }
            .vehicle-price {
                font-size: 26px
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
            /*.form-section.active{*/
            /*    display:flex;*/
            /*    flex-direction:column;*/
            /*    flex:1;*/
            /*    min-height:calc(100vh - 70px);*/
            /*}*/
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
        }
        @media (max-width:768px) {
            .form-group-uber label {
                font-size: 15x;
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
        }
        @media (max-width:480px) {
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
        }
        @media (max-width: 768px) {
            /* Hide map section completely on mobile by default */
            .hero-map-section {
                display: none !important;
            }
            /* Full-width form on mobile */
            .hero-form-section {
                width: 100% !important;
                max-width: 100% !important;
            }
            /* When map icon is tapped, show map as fixed overlay */
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
            /* Map close button */
            #mapCloseBtn {
                position: fixed;
                top: 80px;
                right: 12px;
                z-index: 5001;
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
            /* Map toggle pill button in the form */
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
            /* Sticky mini map toggle bar - shown at top of each step on mobile */
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
        }
        @media (max-width:991px) {
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
        @media(max-width:768px) {
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
        }
        @media (max-width: 768px) {
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
                /* min-height: 100vh !important; */
                display: block;
            }
            /* .form-section {
        min-height: 100vh !important;
    } */
            .form-section.active {
                flex: unset !important;
                display: flex !important;
                flex-direction: column !important;
            }
            /* .form-section > .container {
        display: flex;
        flex-direction: column;
        flex: 1;
        height: 100%;
    } */
            #tripMainContent {
                display: flex;
                flex-direction: column;
                flex: 1;
            }
            .step-bottom-btns {
                margin-top: auto !important;
                padding-bottom: 30px !important;
            }
            .navbar-menu {
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
        }
        @media (max-width: 480px) {
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
        }
        /* ===== EDIT ICON BUTTON (NEW) ===== */
        .edit-icon-btn {
            width: 36px;
            height: 36px;
            min-width: 36px;
            border-radius: 50%;
            background: #f5f5f5;
            border: 1px solid #ddd;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #666;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }
        .edit-icon-btn:hover {
            background: #000;
            color: white;
            border-color: #000;
            transform: scale(1.1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }
        .edit-icon-btn:active {
            transform: scale(0.95);
        }
        .selected-car-summary,
        .booking-summary {
            display: none;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e5e5;
        }
        .summary-title {
            font-size: 15px;
            font-weight: 700;
            color: #666;
            margin-bottom: 15px;
        }
        .selected-car-row {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .summary-car-image {
            width: 90px;
            height: 70px;
            object-fit: contain;
            border-radius: 10px;
        }
        .summary-car-details {
            flex: 1;
        }
        .summary-car-name {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: #111;
        }
        .summary-car-info {
            display: flex;
            gap: 18px;
            margin-top: 8px;
            color: #666;
            font-size: 14px;
        }
        .summary-car-info span {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .summary-car-price {
            margin-left: auto;
            font-size: 24px;
            font-weight: 700;
            color: #000;
            white-space: nowrap;
        }
        .booking-summary-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .booking-summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }
        .summary-label {
            color: #666;
        }
        .summary-value {
            color: #111;
            font-weight: 600;
            text-align: right;
        }
        @media (max-width:768px) {
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
                font-size: 13px;
            }
            .summary-title {
                font-size: 14px;
            }
        }
        @media (max-width:480px) {
            .selected-car-row {
                flex-wrap: wrap;
            }
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
                font-size: 12px;
            }
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
        .driver-details {
            flex: 1;
        }
        .driver-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
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
        @media (max-width:768px) {
            .driver-info {
                display: flex;
                flex-wrap: wrap;
                align-items: flex-start;
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
            }
            .driver-vehicle-info {
                font-size: 12px;
                margin-top: 4px;
            }
            .driver-bid-box {
                width: 100%;
                margin-top: 10px;
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
        }
        .operator-login-section {
            position: relative;
            padding: 70px 0;
            background: url('/goride/img/day.jpg') center center/cover no-repeat;
            overflow: hidden;
        }
        .operator-login-section::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.65);
            /* Overlay */
            z-index: 1;
        }
        .operator-login-section .container {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
        }
        .operator-login-strip {
            background: #fff;
            border-radius: 16px;
            padding: 45px;
            border: 1px solid #e5e5e5;
            text-align: center;
            max-width: 700px;
        }
        .operator-login-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f3f3f3;
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 18px;
        }
        .operator-login-badge i {
            color: #f8be00;
        }
        .operator-login-content h2 {
            font-size: 38px;
            font-weight: 800;
            color: #111;
            margin-bottom: 15px;
        }
        .operator-login-content p {
            max-width: 720px;
            margin: 0 auto 30px;
            color: #666;
            font-size: 17px;
            line-height: 1.8;
        }
        .operator-login-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #000;
            color: #fff;
            text-decoration: none;
            padding: 15px 35px;
            border-radius: 10px;
            font-size: 17px;
            font-weight: 700;
            transition: .3s;
        }
        .operator-login-btn:hover {
            background: #f8be00;
            color: #111;
        }
        @media(max-width:768px) {
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
        @media(max-width:768px) {
            .privacy-modal {
                width: 95%;
            }
            .privacy-btn-group {
                flex-direction: column;
            }
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
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        /* Tablet */
        @media (max-width:768px) {
            .passenger-counter-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .passenger-luggage-card {
                padding: 16px;
            }
        }
        /* Mobile */
        @media (max-width:576px) {
            .passenger-counter-grid {
                grid-template-columns: 1fr;
                gap: 14px;
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
    </style>
    <style id="three-column-styles">
        .hero-form-section.three-column-mode {
            max-width: 100% !important;
            display: flex !important;
            flex-direction: row !important;
            gap: 20px;
            height: calc(100vh - 70px) !important;
            overflow: hidden !important;
            padding-bottom: 0 !important;
        }
        .hero-form-section.three-column-mode .form-section.active.side-by-side {
            flex: 1;
            width: 50%;
            display: flex;
            flex-direction: column;
            height: 100%;
            padding-bottom: 0;
            overflow: hidden;
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
        /* Interactive Counter Widgets */
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
        .vanilla-toast {
            visibility: hidden;
            min-width: 250px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 8px;
            padding: 16px;
            position: fixed;
            z-index: 10000;
            left: 50%;
            bottom: 30px;
            transform: translateX(-50%);
            font-size: 15px;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            opacity: 0;
            transition: opacity 0.3s, bottom 0.3s, visibility 0.3s;
        }
        .vanilla-toast.show {
            visibility: visible;
            opacity: 1;
            bottom: 50px;
        }
        .vanilla-toast.error {
            background-color: #e74c3c;
        }
        .vanilla-toast.success {
            background-color: #2ecc71;
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
            <li><a href="#faq">Help</a></li>
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
        <button class="mobile-menu-btn" id="mobileHamburger" onclick="toggleMobileMenu()">
            <i class="fas fa-bars"></i>
        </button>
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
                <a href="#faq"><i class="fas fa-circle-question"></i>Help</a>
                <a href="#"><i class="fas fa-gear"></i>Settings</a>
            </div>
            <div class="mobile-menu-footer">
                <button><i class="fas fa-right-from-bracket"></i>Logout</button>
            </div>
        </div>
    </nav>
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
            <!-- TIME SELECTION PANEL -->
            <div id="timeSelectionPanel" class="time-selection-panel">
                <div class="time-panel-header">
                    <button class="time-panel-header-back" onclick="hidePickupTimePanel()">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <button class="time-panel-header-clear" onclick="hidePickupTimePanel()">Clear</button>
                </div>
                <h3 class="time-panel-title" id="timePanelTitle">When do you want to be picked up?</h3>
                <p class="time-panel-subtitle">From <span id="timePanelLocation">€”</span></p>
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
                    <div id="airportLandingFields" style="display: none; margin-top: 15px;">
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
                <p class="time-hint">
                    <i class="far fa-calendar-alt"></i> Choose your pick-up time up to 90 days in advance
                </p>
                <button id="timePanelDoneBtn" class="btn-search-uber" onclick="saveSchedule()">
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
                    <div id="selectedDateTime" class="selectdate"></div>
                    <!-- PICKUP -->
                    <div class="form-group-uber">
                        <label><i class="fas fa-location-dot"></i> Pickup Location</label>
                        <div style="position: relative;">
                            <input type="text" id="pickupInput" placeholder="Enter pickup location"
                                class="location-input-field" oninput="handleLocationSearch(this.value, 'pickupSuggestions', 'pickup')" onclick="handleLocationSearch(this.value, 'pickupSuggestions', 'pickup')">
                            <div class="location-suggestions" id="pickupSuggestions"></div>
                        </div>
                        <!--<div class="location-type-badge" id="pickupTypeBadge"></div>-->
                    </div>
                    <!-- VIA POINTS -->
                    <div id="viaPointsContainer"></div>
                    <!-- DROPOFF -->
                    <div class="form-group-uber">
                        <label><i class="fas fa-location-dot"></i> Dropoff Location</label>
                        <div style="position: relative;">
                            <input type="text" id="dropoffInput" placeholder="Enter dropoff location"
                                class="location-input-field" oninput="handleLocationSearch(this.value, 'dropoffSuggestions', 'dropoff')" onclick="handleLocationSearch(this.value, 'dropoffSuggestions', 'dropoff')">
                            <div class="location-suggestions" id="dropoffSuggestions"></div>
                        </div>
                        <!--<div class="location-type-badge" id="dropoffTypeBadge"></div>-->
                    </div>
                    <div class="m-3">
                        <button class="btn btn-dark" id="pickupNowBtn" onclick="showSchedulePanelFromStep1()">
                            <i class="fas fa-clock"></i>
                            Pickup Now
                        </button>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <button class="btn-search-uber" onclick="proceedToTripDetails()" style="margin-top: 20px;">
                            <i class="fas fa-arrow-right me-2"></i> See prices
                        </button>
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
                            <h4>Find a trip</h4>
                            <div class="find-trip-locations">
                                <!-- PICKUP with EDIT BUTTON -->
                                <div
                                    style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                                    <div class="trip-location-item" style="flex: 1; position: relative;">
                                        <div class="trip-location-icon" id="summaryPickupContainer"
                                            style="width: 100%;">
                                            <i class="fas fa-location-dot"></i>
                                            <span id="summaryPickup">–</span>
                                        </div>
                                        <div id="inlinePickupContainer"
                                            style="display: none; width: 100%; padding-left: 25px;">
                                            <input type="text" id="inlinePickupInput" class="location-input-field"
                                                placeholder="Enter pickup location"
                                                oninput="handleLocationSearch(this.value, 'inlinePickupSuggestions', 'inlinePickup')"
                                                onclick="handleLocationSearch(this.value, 'inlinePickupSuggestions', 'inlinePickup')"
                                                style="padding: 8px 12px !important; font-size: 14px !important;">
                                            <div class="location-suggestions" id="inlinePickupSuggestions"></div>
                                        </div>
                                    </div>
                                    <button class="edit-icon-btn" id="editPickupBtn" onclick="enableInlineEditPickup()"
                                        title="Edit pickup location">
                                        <i class="fas fa-pencil"></i>
                                    </button>
                                </div>
                                <!-- DROPOFF with EDIT BUTTON -->
                                <div
                                    style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                                    <div class="trip-location-item dropoff" style="flex: 1; position: relative;">
                                        <div class="trip-location-icon" id="summaryDropoffContainer"
                                            style="width: 100%;">
                                            <i class="fas fa-location-dot"></i>
                                            <span id="summaryDropoff">–</span>
                                        </div>
                                        <div id="inlineDropoffContainer"
                                            style="display: none; width: 100%; padding-left: 25px;">
                                            <input type="text" id="inlineDropoffInput" class="location-input-field"
                                                placeholder="Enter dropoff location"
                                                oninput="handleLocationSearch(this.value, 'inlineDropoffSuggestions', 'inlineDropoff')"
                                                onclick="handleLocationSearch(this.value, 'inlineDropoffSuggestions', 'inlineDropoff')"
                                                style="padding: 8px 12px !important; font-size: 14px !important;">
                                            <div class="location-suggestions" id="inlineDropoffSuggestions"></div>
                                        </div>
                                    </div>
                                    <button class="edit-icon-btn" id="editDropoffBtn"
                                        onclick="enableInlineEditDropoff()" title="Edit dropoff location">
                                        <i class="fas fa-pencil"></i>
                                    </button>
                                </div>
                                <!-- FOR ME (KEEP EXISTING) -->
                                <button type="button" class="trip-location-item" onclick="showForMeModal()">
                                    <div class="trip-location-icon">
                                        <i class="fas fa-user"></i>
                                        <div class="d-flex flex-column text-start">
                                            <span id="forMeTitle">For me</span>
                                            <small id="forMeDetails"
                                                style="display:none;color:#666;font-size:12px;line-height:1.4;"></small>
                                        </div>
                                    </div>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                            <!-- Selected Car Summary -->
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
                                <h5 class="summary-title">Booking Details</h5>
                                <div class="booking-summary-list">
                                    <div class="booking-summary-item">
                                        <span class="summary-label">Passenger</span>
                                        <span id="summaryPassengerName" class="summary-value"></span>
                                    </div>
                                    <div class="booking-summary-item">
                                        <span class="summary-label">Contact</span>
                                        <span id="summaryPassengerContact" class="summary-value"></span>
                                    </div>
                                    <div class="booking-summary-item">
                                        <span class="summary-label">Passengers</span>
                                        <span id="summaryPassengerCount" class="summary-value"></span>
                                    </div>
                                    <div class="booking-summary-item">
                                        <span class="summary-label">Luggage</span>
                                        <span id="summaryLuggageCount" class="summary-value"></span>
                                    </div>
                                    <div id="summaryFlightContainer" class="booking-summary-item" style="display:none;">
                                        <span class="summary-label">Flight No.</span>
                                        <span id="summaryFlightNumber" class="summary-value"></span>
                                    </div>
                                    <div id="summaryJourneyTimeContainer" class="booking-summary-item"
                                        style="display:none;">
                                        <span class="summary-label">Journey Time</span>
                                        <span id="summaryJourneyTime" class="summary-value"></span>
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
                            <span>Ride Fare</span>
                            <span>£55.00</span>
                        </div>
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
                            <option value="card">Cash to Driver</option>
                            <option value="upi">Online Payment</option>
                            <option value="wallet"> Wallet Payment.</option>
                            <!-- <option value="cash">Cash</option> -->
                        </select>
                    </div>
                    <div class="btn-group-uber step-bottom-btns">
                        <button class="btn-back-uber" onclick="goBack(4)">
                            <i class="fas fa-chevron-left"></i> Back
                        </button>
                        <button class="btn-search-uber" onclick="proceedToConfirmation()">
                            <i class="fas fa-check-circle"></i> Continue
                        </button>
                    </div>
                </div>
            </div>
            <!-- STEP 4: BOOKING DETAILS -->
            <div class="form-section" id="step4">
                <style>
                    input,
                    select,
                    textarea {
                        font-size: 16px;
                    }
                </style>
                <div class="container p-0">
                    <h3 class="booking-title">Booking Details</h3>
                    <div class="booking-form-section" id="personalInfoSection">
                        <div class="booking-section-title">
                            Personal Info
                        </div>
                        <div class="booking-form-grid">
                            <div class="form-group-uber booking-form-group">
                                <label>Full Name</label>
                                <input type="text" id="passengerFirstName" placeholder="First name">
                            </div>
                            <div class="form-group-uber booking-form-group">
                                <label>Contact Number</label>
                                <div class="phone-input-wrapper">
                                    <span class="country-code">+44</span>
                                    <input type="tel" id="passengerPhone" class="phone-number-input"
                                        placeholder="7123456789" maxlength="10">
                                </div>
                            </div>
                            <div class="form-group-uber booking-form-group">
                                <label>Email Address</label>
                                <input type="email" id="passengerEmail" placeholder="your@email.com" required>
                            </div>
                        </div>
                    </div>
                    <div id="additionalBookingDetails" style="display: none;">
                        <div class="passenger-luggage-card">
                            <div class="passenger-card-title">
                                Passengers & Luggage
                            </div>
                            <div class="passenger-counter-grid">
                                <div class="passenger-counter-item">
                                    <label>No Of Passenger</label>
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
                            <div class="car-seat-toggle">
                                <label class="car-seat-label">
                                    <input type="checkbox" id="carSeatCheckbox" class="booking-checkbox"
                                        onchange="toggleChildSeatOptions()">
                                    Car Seat Required?
                                </label>
                            </div>
                            <div id="childSeatOptions" class="child-seat-wrapper">
                                <div class="child-seat-counter">
                                    <label>Number of Car Seats</label>
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
                        <div class="booking-form-section">
                            <div class="booking-section-title">
                                Journey Information
                            </div>
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
                                            <option>15 Min After</option>
                                            <option>30 Min After</option>
                                            <option selected>45 Min After</option>
                                            <option>60 Min After</option>
                                            <option>75 Min After</option>
                                            <option>90 Min After</option>
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
                            <div id="journeyNormal">
                                <div class="booking-form-grid">
                                    <div class="form-group-uber booking-form-group">
                                        <label>
                                            <i class="fas fa-calendar"></i>
                                            Journey Date
                                        </label>
                                        <input type="text" id="normalJourneyDate" class="time-input-field" readonly>
                                    </div>
                                    <div class="form-group-uber booking-form-group">
                                        <label><i class="fas fa-clock"></i> Journey Time</label>
                                        <select id="normalJourneyTime">
                                            <option value="">Select</option>
                                            <option value="07:00 AM">7:00 AM</option>
                                            <option value="08:00 AM">8:00 AM</option>
                                            <option value="09:00 AM">9:00 AM</option>
                                            <option value="10:00 AM">10:00 AM</option>
                                            <option value="11:00 AM">11:00 AM</option>
                                            <option value="12:00 PM">12:00 PM</option>
                                            <option value="01:00 PM">1:00 PM</option>
                                            <option value="02:00 PM">2:00 PM</option>
                                            <option value="03:00 PM">3:00 PM</option>
                                            <option value="04:00 PM">4:00 PM</option>
                                            <option value="05:00 PM">5:00 PM</option>
                                            <option value="06:00 PM">6:00 PM</option>
                                            <option value="07:00 PM">7:00 PM</option>
                                            <option value="08:00 PM">8:00 PM</option>
                                            <option value="09:00 PM">9:00 PM</option>
                                            <option value="10:00 PM">10:00 PM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="booking-form-section">
                            <div class="booking-section-title">
                                Special Requirements
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label class="booking-checkbox-label">
                                    <input type="checkbox" id="specialReqCheckbox"
                                        onchange="toggleSpecialRequirements()" class="booking-checkbox">
                                    Add Special Requirements?
                                </label>
                            </div>
                            <div class="form-group-uber booking-form-group">
                                <textarea id="specialRequirements" rows="3" placeholder="Enter any special requirements"
                                    style="display: none;">
                    </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group-uber step-bottom-btns" id="personalInfoBtns">
                        <button class="btn-back-uber" onclick="goBack(3)">
                            <i class="fas fa-chevron-left"></i> Back
                        </button>
                        <button class="btn-search-uber" onclick="proceedToConfirmation()">
                            <i class="fas fa-check-circle"></i> Request Book
                        </button>
                    </div>
                    <div class="btn-group-uber step-bottom-btns" id="additionalDetailsBtns" style="display: none;">
                        <button class="btn-back-uber" onclick="goBack(3)">
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
                    <h3 class="booking-title">Your driver</h3>
                    <div id="driverList"></div>
                    <div class="btn-group-uber step-bottom-btns">
                        <button class="btn-back-uber" onclick="goBack(5)">
                            <i class="fas fa-chevron-left"></i> Back
                        </button>
                        <!--<button class="btn-search-uber" onclick="showConfirmation()">-->
                        <!--    <i class="fas fa-check"></i> Continue-->
                        <!--</button>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-map-section  col-md-7 col-12">
            <!-- First Screen Image -->
            <div id="bookingImage">
                <div class="hero-banner-content">
                    <span class="hero-badge">GoRide</span>
                    <h1>Ride Anywhere & AnytimeWith GoRide</h1>
                    <p>Airport transfers, city rides, executive travel and long-distance journeys with professional
                        drivers at fixed prices.</p>
                </div>
                <img src="goride/img/day.jpg" alt="Airport Transfer" class="hero-side-img">
            </div>
            <!-- Map -->
            <!--<div id="bookingMap" style="display:none;">-->
            <!--    <iframe-->
            <!--        src="https://maps.google.com/maps?saddr=London,+United+Kingdom&daddr=Heathrow+Airport,+London&output=embed"-->
            <!--        width="100%" height="450" style="border:0;" loading="lazy" allowfullscreen>-->
            <!--    </iframe>-->
            <!--</div>-->
            <div id="bookingMap" style="display: none; width: 100%; height: 100%; min-height: 400px;"></div>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtkJtXBZPLBZIgjgpu-eAG5WQ1HwW4EwE&libraries=geometry"></script>
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
                        const response = await fetch('https://mobapi.goride.run/api/get-route-polyline', {
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
                        // console.error('Fetch to /get-route-polyline failed. Drawing fallback.', error);
                        // useFallbackRoute();
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
            <button id="mapCloseBtn" onclick="closeMobileMap()" title="Close Map">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <section class="fleet-section pt-5">
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
    </section>
    <section class="reviews-section section-padding" id="reviews">
        <div class="container">
            <h2 class="section-title">What Customers Say</h2>
            <div class="review-grid">
                <div class="review-card">
                    <div class="review-rating"></div>
                    <div class="review-text">
                        "Fantastic airport transfer. The driver arrived early, helped with our luggage, and the journey was comfortable. Highly recommended!"
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
                        "Excellent service with fixed pricing and no hidden charges. Booking was quick and the driver was very friendly."
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
                        "Our family booked a ride to Heathrow Airport and everything went perfectly. Clean vehicle and professional driver."
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
                        "Fantastic airport transfer. The driver arrived early, helped with our luggage, and the journey was comfortable. Highly recommended!"
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
                        "Excellent service with fixed pricing and no hidden charges. Booking was quick and the driver was very friendly."
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
                        "Our family booked a ride to Heathrow Airport and everything went perfectly. Clean vehicle and professional driver."
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
    <!-- ===== APP DOWNLOAD SECTION ===== -->
    <!--<section class="goride-app-section">-->
    <!--    <div class="container">-->
    <!--        <div class="goride-app-wrapper">-->
    <!--            <div class="row g-0 align-items-stretch">-->
    <!-- Left Content -->
    <!--                <div class="col-lg-8">-->
    <!--                    <div class="goride-app-left">-->
    <!--                        <span class="goride-app-badge">-->
    <!--                            <i class="fas fa-mobile-alt"></i>-->
    <!--                            GoRide Mobile App-->
    <!--                        </span>-->
    <!--                        <h2 class="goride-app-heading">-->
    <!--                            Book your ride in <br>-->
    <!--                            <span>seconds with GoRide</span>-->
    <!--                        </h2>-->
    <!--                        <p class="goride-app-text">-->
    <!--                            Experience faster bookings, live driver tracking,-->
    <!--                            secure payments and exclusive app-only offers-->
    <!--                            across the UK.-->
    <!--                        </p>-->
    <!--                        <div class="goride-app-features">-->
    <!--                            <div class="goride-feature-item">-->
    <!--                                <i class="fas fa-bolt"></i>-->
    <!--                                <span>Instant Booking</span>-->
    <!--                            </div>-->
    <!--                            <div class="goride-feature-item">-->
    <!--                                <i class="fas fa-location-dot"></i>-->
    <!--                                <span>Live Ride Tracking</span>-->
    <!--                            </div>-->
    <!--                            <div class="goride-feature-item">-->
    <!--                                <i class="fas fa-tag"></i>-->
    <!--                                <span>Exclusive Discounts</span>-->
    <!--                            </div>-->
    <!--                            <div class="goride-feature-item">-->
    <!--                                <i class="fas fa-credit-card"></i>-->
    <!--                                <span>Secure Payments</span>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="row g-3 goride-download-btns">-->
    <!--                            <div class="col-md-4 col-6">-->
    <!--                                <a href="https://apps.apple.com/in/app/goride-cab-bike-taxi-pool/id6763038270"-->
    <!--                                    class="goride-store-btn">-->
    <!--                                    <i class="fab fa-apple"></i>-->
    <!--                                    <div>-->
    <!--                                        <small>Download on the</small>-->
    <!--                                        <strong>App Store</strong>-->
    <!--                                    </div>-->
    <!--                                </a>-->
    <!--                            </div>-->
    <!--                            <div class="col-md-4 col-6">-->
    <!--                                <a href="https://play.google.com/store/apps/details?id=com.shi.goride_customer"-->
    <!--                                    class="goride-store-btn">-->
    <!--                                    <i class="fab fa-google-play"></i>-->
    <!--                                    <div>-->
    <!--                                        <small>Get It On</small>-->
    <!--                                        <strong>Google Play</strong>-->
    <!--                                    </div>-->
    <!--                                </a>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!-- Right Image -->
    <!--                <div class="col-lg-4">-->
    <!--                    <div class="goride-app-right">-->
    <!--                        <img src="/goride/img/app-dwld.jpg" alt="GoRide App">-->
    <!--                        <div class="goride-app-overlay"></div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!--<section class="operator-login-section">-->
    <!--    <div class="container">-->
    <!--        <div class="operator-login-strip">-->
    <!--            <div class="operator-login-content">-->
    <!--                <span class="operator-login-badge">-->
    <!--                    <i class="fas fa-user-shield"></i>-->
    <!--                    GoRide Operator Portal-->
    <!--                </span>-->
    <!--                <h2>-->
    <!--                    Already a GoRide Operator?-->
    <!--                </h2>-->
    <!--                <p>-->
    <!--                    Login to manage bookings, assign drivers, monitor trips,-->
    <!--                    view reports and operate your business efficiently from one dashboard.-->
    <!--                </p>-->
    <!--                <a href="/operator/login" class="operator-login-btn">-->
    <!--                    <i class="fas fa-right-to-bracket"></i>-->
    <!--                    Login to Operator Portal-->
    <!--                </a>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- ===== FAQ SECTION ===== -->
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
                <div class="faq-answer">We accept online payments. Choose the payment method that's most convenient for you.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Are the prices fixed?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">No. We offer transparent, driver-based bidding. The fare quoted by the driver is the final amount you'll pay—there are no hidden charges.</div>
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
    <!-- ===== FOOTER ===== -->
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
                            <a href="#" class="social-icon" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-icon" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-icon" title="Instagram">
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
    <!-- ===== OTP MODAL ===== -->
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
        <div class="modal-content-uber" style="max-width:550px;">
            <div class="for-me-modal-header">
                <h5 id="vehicleModalTitle">Vehicle Details</h5>
                <button class="for-me-close-btn" onclick="closeModal('vehicleInfoModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="vehicleModalContent"></div>
        </div>
    </div>
    <div class="modal-uber" id="privacyPolicyModal">
        <div class="modal-content-uber privacy-modal">
            <div class="for-me-modal-header">
                <h4 class="for-me-modal-title">
                    <i class="fas fa-shield-alt"></i>
                    Privacy & Terms
                </h4>
            </div>
            <div class="modal-body-uber">
                <p class="privacy-intro">
                    Welcome to <strong>GoRide</strong>.
                </p>
                <p class="privacy-text">
                    Before continuing, please review and accept our Privacy Policy and Terms of Service.
                </p>
                <p class="privacy-text">
                    By selecting <strong>Accept & Continue</strong>, you agree that GoRide may collect and process your
                    personal information to provide ride booking services, manage bookings, process payments, send ride
                    updates and improve your experience.
                </p>
                <p class="privacy-text">
                    Your information is handled securely in accordance with applicable data protection laws.
                </p>
            </div>
            <div class="privacy-btn-group">
                <button id="privacyRejectBtn" class="btn-modal-secondary">
                    Decline
                </button>
                <button id="privacyAcceptBtn" class="btn-modal-primary">
                    Accept & Continue
                </button>
            </div>
        </div>
    </div>
    <!-- ===== APP PROMO MODAL ===== -->
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
    <!-- ===== BOOKING CONFIRMATION MODAL ===== -->
    <!-- ===== BOOKING CONFIRMATION MODAL ===== -->
    <div id="confirmModal" class="modal-uber">
        <div class="modal-content-uber" style="max-width: 500px;">
            <div class="confirm-modal-content">
                <div class="confirm-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2 class="confirm-title">Booking Confirmed!</h2>
                <div class="confirm-booking-id">
                    <small>Booking ID</small>
                    <div class="id-value" id="confirmNum">GR-2026-14851</div>
                </div>
                <div class="confirm-details-grid">
                    <div class="confirm-detail-item">
                        <small><i class="fas fa-location-dot"></i> PICKUP</small>
                        <div class="detail-value" id="confirmPickup">€”</div>
                    </div>
                    <div class="confirm-detail-item">
                        <small><i class="fas fa-location-dot"></i> DESTINATION</small>
                        <div class="detail-value" id="confirmDropoff">€”</div>
                    </div>
                    <div class="confirm-detail-item">
                        <small><i class="fas fa-calendar"></i> DATE & TIME</small>
                        <div class="detail-value" id="confirmDateTime">€”</div>
                    </div>
                    <div class="confirm-detail-item">
                        <small><i class="fas fa-car"></i> VEHICLE</small>
                        <div class="detail-value" id="confirmVehicle">€”</div>
                    </div>
                    <!--<div class="confirm-detail-item">-->
                    <!--    <small><i class="fas fa-road"></i> DISTANCE</small>-->
                    <!--    <div class="detail-value" id="confirmDistance">€”</div>-->
                    <!--</div>-->
                    <!--<div class="confirm-detail-item">-->
                    <!--    <small><i class="fas fa-hourglass"></i> DURATION</small>-->
                    <!--    <div class="detail-value" id="confirmDuration">€”</div>-->
                    <!--</div>-->
                </div>
                <p class="confirm-info-text">
                    Your booking has been successfully confirmed. A driver will be assigned soon.
                </p>
                <div class="confirm-btn-group" style="grid-template-columns: 1fr;">
                    <button class="btn-modal-primary" onclick="completeBooking()" style="margin-top: 15px;">
                        <i class="fas fa-check"></i> Done
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== DRIVER CONFIRMATION MODAL ===== -->
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
    <!-- ===== CAR DETAILS MODAL ===== -->
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
                        style="width: 100%; height: 100%; object-fit: cover;" alt="Car view">
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
    <!-- ===== FARE BREAKDOWN MODAL ===== -->
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
    <!-- ===== FOR ME MODAL ===== -->
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
                <button class="for-me-option" onclick="selectForMe('Order a trip for someone else')">
                    <div class="for-me-option-left">
                        <div class="for-me-option-avatar user-plus">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <span class="for-me-option-text">Order a trip for someone else</span>
                    </div>
                    <i class="far fa-circle for-me-radio" id="forMeRadioOther" style="color: #999;"></i>
                </button>
            </div>
            <button type="button" class="btn-modal-primary" id="forMeModalDoneBtn" onclick="closeForMeModal()">
                Done
            </button>
        </div>
    </div>
    <!-- Book For Someone Else Modal -->
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
    <script>
        // ===== UK LOCATIONS DATA =====
        const ukLocations = [
            // AIRPORTS
            {
                name: 'London Heathrow Airport (LHR)',
                type: 'airport',
                icon: 'plane-departure',
                badge: 'ðŸ›« Airport'
            },
            {
                name: 'London Gatwick Airport (LGW)',
                type: 'airport',
                icon: 'plane-departure',
                badge: 'ðŸ›« Airport'
            },
            {
                name: 'Manchester Airport',
                type: 'airport',
                icon: 'plane-departure',
                badge: 'ðŸ›« Airport'
            },
            {
                name: 'Luton Airport',
                type: 'airport',
                icon: 'plane-departure',
                badge: 'ðŸ›« Airport'
            },
            {
                name: 'Stansted Airport',
                type: 'airport',
                icon: 'plane-departure',
                badge: 'ðŸ›« Airport'
            },
            // ADDRESSES
            {
                name: 'London City Centre',
                type: 'address',
                icon: 'map-marker-alt',
                badge: 'ðŸ“ Address'
            },
            {
                name: 'Manchester City Centre',
                type: 'address',
                icon: 'map-marker-alt',
                badge: 'ðŸ“ Address'
            },
            {
                name: 'Birmingham City Centre',
                type: 'address',
                icon: 'map-marker-alt',
                badge: 'ðŸ“ Address'
            },
            // SEAPORTS
            {
                name: 'Portsmouth Ferry Terminal',
                type: 'seaport',
                icon: 'anchor',
                badge: '›´ï¸ Terminal'
            },
            {
                name: 'Dover Ferry Terminal',
                type: 'seaport',
                icon: 'anchor',
                badge: '›´ï¸ Terminal'
            },
            {
                name: 'Harwich International',
                type: 'seaport',
                icon: 'anchor',
                badge: '›´ï¸ Terminal'
            },
        ];
        let bookingData = {
            // OUTBOUND TRIP
            pickup: '',
            pickupType: '', // 'airport' | 'address' | 'seaport'
            dropoff: '',
            dropoffType: '',
            // TIME INFO
            date: '',
            time: '',
            landingTime: '', // Only for Airport†’Airport
            pickupAfter: 45, // Minutes (default: 45)
            // RETURN TRIP
            returnTrip: false,
            returnPickup: '',
            returnPickupType: '',
            returnDropoff: '',
            returnDropoffType: ''
        };
        const vehicles = [{
                id: 1,
                name: "Saloon",
                capacity: 4,
                luggage: 2,
                price: 45,
                image: "/goride/img/saloon.png",
                details: "Toyota Prius or similar",
                childSeat: true,
                inclusions: [
                    "Meet & Greet",
                    "Flight Monitoring",
                    "60 Minutes Airport Waiting",
                    "Free Cancellation",
                    "24/7 Customer Support",
                    "Door to Door Service"
                ],
                exclusions: [
                    "Parking Charges",
                    "Toll Charges",
                    "Extra Waiting Time",
                    "Additional Stops"
                ]
            },
            {
                id: 2,
                name: "Estate",
                capacity: 4,
                luggage: 4,
                price: 55,
                image: "/goride/img/estate.png",
                details: "Skoda Octavia Estate",
                childSeat: true,
                inclusions: [
                    "Meet & Greet",
                    "Flight Monitoring",
                    "60 Minutes Airport Waiting",
                    "Free Cancellation",
                    "Extra Luggage Space"
                ],
                exclusions: [
                    "Parking Charges",
                    "Toll Charges",
                    "Extra Waiting Time",
                    "Additional Stops"
                ]
            },
            {
                id: 3,
                name: "Executive",
                capacity: 4,
                luggage: 3,
                price: 75,
                image: "/goride/img/executive.png",
                details: "Mercedes E Class",
                childSeat: false,
                inclusions: [
                    "Meet & Greet",
                    "Professional Chauffeur",
                    "Flight Monitoring",
                    "60 Minutes Waiting",
                    "Luxury Interior"
                ],
                exclusions: [
                    "Parking Charges",
                    "Toll Charges",
                    "Extra Waiting Time"
                ]
            },
            {
                id: 4,
                name: "MPV",
                capacity: 6,
                luggage: 6,
                price: 85,
                image: "/goride/img/mpv.png",
                details: "VW Sharan or Similar",
                childSeat: true,
                inclusions: [
                    "Meet & Greet",
                    "Flight Monitoring",
                    "Large Luggage Capacity",
                    "Free Cancellation",
                    "Family Friendly"
                ],
                exclusions: [
                    "Parking Charges",
                    "Toll Charges",
                    "Extra Waiting Time"
                ]
            },
            {
                id: 5,
                name: "8 Seater",
                capacity: 8,
                luggage: 8,
                price: 120,
                image: "/goride/img/8seater.png",
                details: "Ford Tourneo",
                childSeat: true,
                inclusions: [
                    "Meet & Greet",
                    "Flight Monitoring",
                    "Ideal for Groups",
                    "Large Luggage Space",
                    "Free Cancellation"
                ],
                exclusions: [
                    "Parking Charges",
                    "Toll Charges",
                    "Extra Waiting Time"
                ]
            },
            {
                id: 6,
                name: "Executive MPV",
                capacity: 6,
                luggage: 6,
                price: 160,
                image: "/goride/img/executive mv5.png",
                details: "Mercedes V Class",
                childSeat: true,
                inclusions: [
                    "VIP Meet & Greet",
                    "Professional Chauffeur",
                    "Flight Monitoring",
                    "Luxury Interior",
                    "Complimentary Water",
                    "Free Cancellation"
                ],
                exclusions: [
                    "Parking Charges",
                    "Toll Charges",
                    "Extra Waiting Time"
                ]
            }
        ];
        const drivers = [{
                id: 1,
                name: "Rajesh Kumar",
                rating: 4.9,
                trips: 2840,
                vehicle: "Maruti Swift AB21",
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
                vehicle: "Hyundai i20 CD22",
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
                vehicle: "Tata Nexon EF23",
                avatar: '<img src="https://randomuser.me/api/portraits/men/46.jpg">',
                bid: 47,
                total: 49,
                eta: "6 mins",
                waiting: "15 mins",
                badge: "Premium"
            }
        ];
        let viaPointCount = 0;
        let selectedTime = '';
        let rideFor = "me";
        let otherPassengerData = null;
        function showToast(message, type = 'error') {
            let toast = document.getElementById("vanilla-toast");
            if (!toast) {
                toast = document.createElement("div");
                toast.id = "vanilla-toast";
                document.body.appendChild(toast);
            }
            toast.className = "vanilla-toast " + type + " show";
            toast.textContent = message;
            setTimeout(function() {
                toast.className = toast.className.replace("show", "");
            }, 3000);
        }
        // ===== INITIALIZE ===== 
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#date", {
                dateFormat: "Y-m-d",
                minDate: "today",
                defaultDate: "today"
            });
            // Initialize carousels
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
            const dropdown = document.getElementById(`${type}-dropdown`);
            dropdown.classList.toggle('show');
        }
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.navbar-menu') && !e.target.closest('.dropdown-menu-navbar')) {
                document.querySelectorAll('.dropdown-menu-navbar').forEach(d => d.classList.remove('show'));
            }
            if (!e.target.closest('.user-btn') && !e.target.closest('.account-dropdown')) {
                document.querySelector('.account-dropdown')?.classList.remove('show');
            }
            if (!e.target.closest('.time-dropdown-wrapper')) {
                document.getElementById('timeDropdownList').classList.remove('show');
                document.getElementById('timeDropdownBtn').classList.remove('active');
            }
            if (!e.target.closest('.location-input-field') && !e.target.closest('.location-suggestions')) {
                document.querySelectorAll('.location-suggestions').forEach(s => s.classList.remove('show'));
            }
        });
        function selectLanguage(lang) {
            toggleDropdown('language');
        }
        // ===== CUSTOM TIME DROPDOWN =====
        function toggleTimeDropdown() {
            const list = document.getElementById('timeDropdownList');
            const btn = document.getElementById('timeDropdownBtn');
            list.classList.toggle('show');
            btn.classList.toggle('active');
        }
        function selectTime(time) {
            selectedTime = time;
            document.getElementById('timeDropdownValue').textContent = time;
            document.getElementById('timeDropdownList').classList.remove('show');
            document.getElementById('timeDropdownBtn').classList.remove('active');
            document.querySelectorAll('.time-dropdown-item').forEach(item => {
                item.classList.remove('selected');
                if (item.textContent === time) {
                    item.classList.add('selected');
                }
            });
        }
        let searchTimeout;
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
                    return 'monument';
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
        async function handleLocationSearch(query, containerId, target) {
            const suggestions = document.getElementById(containerId);
            if (!query || query.length < 2) {
                suggestions.classList.remove('show');
                return;
            }
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(async () => {
                try {
                    const response = await fetch('https://mobapi.goride.run/api/web-get-location', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            search: query
                        })
                    });
                    const result = await response.json();
                    if (result.status === 200 && result.data.length > 0) {
                        let clickFunction = '';
                        if (target === 'pickup') clickFunction = 'selectPickup';
                        else if (target === 'dropoff') clickFunction = 'selectDropoff';
                        else if (target === 'inlinePickup') clickFunction = 'selectInlinePickup';
                        else if (target === 'inlineDropoff') clickFunction = 'selectInlineDropoff';
                        const html = result.data.map(loc => `
                            <div class="suggestion-item" onclick="${clickFunction}('${loc.name.replace(/'/g, "\\'")}', '${loc.types}')">
                                <i class="fas fa-${getIconForType(loc.types)}"></i>
                                <span>${loc.name}</span>
                            </div>
                        `).join('');
                        suggestions.innerHTML = html;
                        suggestions.classList.add('show');
                    } else {
                        suggestions.classList.remove('show');
                    }
                } catch (error) {
                    console.error(error);
                }
            }, 300);
        }
        function toggleMobileMenu() {
            document.getElementById("mobileMenu").classList.toggle("show");
            document.getElementById("mobileOverlay").classList.toggle("show");
            document.body.classList.toggle("menu-open");
        }
        function toggleMobileMap() {
            const mapSection = document.getElementById('bookingMap');
            const closeBtn = document.getElementById('mapCloseBtn');
            const formSection = document.querySelector('.hero-form-section');
            // Show map full-screen, hide form
            formSection.style.display = 'none';
            mapSection.classList.add('mobile-fullscreen');
            mapSection.style.display = 'block';
            closeBtn.classList.add('visible');
            // Load Leaflet map after making container visible
            if (typeof initSingleRouteMap === 'function') {
                setTimeout(initSingleRouteMap, 100);
            }
        }
        function closeMobileMap() {
            const mapSection = document.getElementById('bookingMap');
            const closeBtn = document.getElementById('mapCloseBtn');
            const formSection = document.querySelector('.hero-form-section');
            // Hide map, show form
            mapSection.classList.remove('mobile-fullscreen');
            mapSection.style.display = 'none';
            closeBtn.classList.remove('visible');
            formSection.style.display = 'flex';
            formSection.style.width = '100%';
        }
        function selectPickup(location, type) {
            bookingData.pickup = location;
            bookingData.pickupType = type;
            document.getElementById('pickupInput').value = location;
            document.getElementById('pickupSuggestions').classList.remove('show');
            updateTimePanel();
            // ADD THIS ONE LINE:
            updateTripDisplayFromStep1(); // ← ADD THIS
        }
        function selectDropoff(location, type) {
            bookingData.dropoff = location;
            bookingData.dropoffType = type;
            document.getElementById('dropoffInput').value = location;
            document.getElementById('dropoffSuggestions').classList.remove('show');
            updateTimePanel();
            // ADD THIS ONE LINE:
            updateTripDisplayFromStep1(); // ← ADD THIS
        }
        function selectReturnPickup(location, type) {
            bookingData.returnPickup = location;
            bookingData.returnPickupType = type;
            document.getElementById('returnPickupInput').value = location;
            // document.getElementById('returnPickupTypeBadge').innerHTML = getTypeBadge(type);
            document.getElementById('returnPickupSuggestions').classList.remove('show');
        }
        function selectReturnDropoff(location, type) {
            bookingData.returnDropoff = location;
            bookingData.returnDropoffType = type;
            document.getElementById('returnDropoffInput').value = location;
            // document.getElementById('returnDropoffTypeBadge').innerHTML = getTypeBadge(type);
            document.getElementById('returnDropoffSuggestions').classList.remove('show');
        }
        function showReturnPickupSuggestions() {
            const suggestions = document.getElementById('returnPickupSuggestions');
            const html = ukLocations.map(loc => `
        <div class="suggestion-item" onclick="selectReturnPickup('${loc.name}', '${loc.type}')">
            <i class="fas fa-${loc.icon}"></i>
            <div>
                <div style="font-weight: 600;">${loc.name}</div>
            </div>
        </div>
    `).join('');
            suggestions.innerHTML = html;
            suggestions.classList.add('show');
        }
        function showReturnDropoffSuggestions() {
            const suggestions = document.getElementById('returnDropoffSuggestions');
            const html = ukLocations.map(loc => `
        <div class="suggestion-item" onclick="selectReturnDropoff('${loc.name}', '${loc.type}')">
            <i class="fas fa-${loc.icon}"></i>
            <div>
                <div style="font-weight: 600;">${loc.name}</div>
            </div>
        </div>
    `).join('');
            suggestions.innerHTML = html;
            suggestions.classList.add('show');
        }
        function toggleLandingTimeDropdown() {
            const list = document.getElementById('landingTimeDropdownList');
            const btn = document.getElementById('landingTimeBtn');
            list.classList.toggle('show');
            btn.classList.toggle('active');
        }
        function selectLandingTime(time) {
            document.getElementById('landingTimeValue').textContent = time;
            document.getElementById('landingTimeDropdownList').classList.remove('show');
            document.getElementById('landingTimeBtn').classList.remove('active');
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
            // Outbound trip validation
            if (!bookingData.pickup) errors.push('Œ Pickup location required');
            if (!bookingData.pickupType) errors.push('Œ Pickup type missing');
            if (!bookingData.dropoff) errors.push('Œ Dropoff location required');
            if (!bookingData.dropoffType) errors.push('Œ Dropoff type missing');
            if (!bookingData.date) errors.push('Œ Date required');
            // Time validation based on location type
            if (bookingData.pickupType === 'airport' && bookingData.dropoffType === 'airport') {
                // Airport to Airport: Need flight landing details
                if (!bookingData.landingTime) errors.push('Œ Flight landing time required');
                if (!bookingData.pickupAfter) errors.push('Œ Pickup after landing time required');
            } else {
                // All other combinations: Need pickup time
                if (!bookingData.time) errors.push('Œ Pickup time required');
            }
            // Return trip validation (if enabled)
            if (bookingData.returnTrip) {
                if (!bookingData.returnPickup) errors.push('Œ Return pickup required');
                if (!bookingData.returnPickupType) errors.push('Œ Return pickup type missing');
                if (!bookingData.returnDropoff) errors.push('Œ Return dropoff required');
                if (!bookingData.returnDropoffType) errors.push('Œ Return dropoff type missing');
            }
            if (errors.length > 0) {
                showToast(errors[0], "error");
                return false;
            }
            return true;
        }
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.location-input-field') && !e.target.closest('.location-suggestions')) {
                document.querySelectorAll('.location-suggestions').forEach(s => s.classList.remove('show'));
            }
        });
        // ===== VIA POINTS =====
        const MAX_VIA_POINTS = 3;
        function addViaPoint() {
            const container = document.getElementById("viaPointsContainer");
            const viaRows = container.querySelectorAll(".via-point-row");
            if (viaRows.length >= MAX_VIA_POINTS) {
                showToast("Maximum 3 via locations allowed.", "error");
                return;
            }
            const row = document.createElement("div");
            row.className = "via-point-row";
            row.innerHTML = `
        <input type="text" placeholder="Enter via location">
        <button type="button" class="remove-via" onclick="removeViaPoint(this)">
            <i class="fas fa-times"></i>
        </button>
    `;
            container.appendChild(row);
            // Hide Add Via button after 3
            if (container.querySelectorAll(".via-point-row").length >= MAX_VIA_POINTS) {
                document.getElementById("addViaBtn").style.display = "none";
            }
        }
        function showViaSuggestions(id) {
            const suggestions = document.getElementById(`viaSuggestions${id}`);
            const html = ukLocations.map(loc =>
                `<div class="suggestion-item" onclick="selectViaPoint(${id}, '${loc.name}')">
                    <i class="fas fa-${loc.icon}"></i> ${loc.name}
                </div>`
            ).join('');
            suggestions.innerHTML = html;
            suggestions.classList.add('show');
        }
        function selectViaPoint(id, location) {
            document.querySelectorAll('.via-input')[id - 1].value = location;
            document.getElementById(`viaSuggestions${id}`).classList.remove('show');
        }
        function removeViaPoint(btn) {
            btn.closest(".via-point-row").remove();
            // Show Add Via button again if less than 3
            if (document.querySelectorAll(".via-point-row").length < MAX_VIA_POINTS) {
                document.getElementById("addViaBtn").style.display = "inline-flex";
            }
        }
        // ===== FORM NAVIGATION =====
        function proceedToTripDetails() {
            const pickup = document.getElementById('pickupInput').value;
            const dropoff = document.getElementById('dropoffInput').value;
            if (!pickup || !dropoff) {
                showToast("Please select both pickup and dropoff locations", "error");
                return;
            }
            bookingData.pickup = pickup;
            bookingData.dropoff = dropoff;
            document.getElementById('summaryPickup').textContent = pickup;
            document.getElementById('summaryDropoff').textContent = dropoff;
            document.getElementById('timePanelLocation').textContent = pickup;
            // HIDE ALL SECTIONS BELOW FORM
            const sections = document.querySelectorAll('section');
            sections.forEach(section => {
                if (!section.classList.contains('hero-container')) {
                    section.classList.add('sections-hidden');
                }
            });
            document.querySelector('footer')?.classList.add('sections-hidden');
            // DESKTOP: Keep image, do not show map
            if (window.innerWidth > 768) {
                // Do nothing, bookingImage stays visible
            } else {
                // MOBILE: Hide both images, show form only
                $('#bookingImage').hide();
                $('#bookingMap').hide();
                // Hide hamburger, Show map icon
                document.getElementById('mobileHamburger').style.display = 'none';
                document.getElementById('mobileMapBtn').style.display = 'flex';
            }
            proceedToVehicles();
        }
        function updateTimePanel() {
            const {
                pickupType,
                dropoffType
            } = bookingData;
            const airportFields = document.getElementById('airportLandingFields');
            const timePanelTitle = document.getElementById('timePanelTitle');
            const timePanelLocation = document.getElementById('timePanelLocation');
            const dateLabelContainer = document.getElementById('dateLabelContainer');
            const timeLabelContainer = document.getElementById('timeLabelContainer');
            const dateLabel = document.getElementById('dateLabel');
            const timeLabel = document.getElementById('timeLabel');
            timePanelLocation.textContent = bookingData.pickup || '€”';
            // Show labels
            dateLabelContainer.style.display = 'block';
            timeLabelContainer.style.display = 'block';
            // CONDITION 1: AIRPORT PICKUP
            if (pickupType === 'airport') {
                timePanelTitle.textContent = 'Flight Landing Date & Time';
                dateLabel.innerHTML = '<i class="fas fa-calendar"></i> Flight Landing Date *';
                timeLabel.innerHTML = '<i class="fas fa-plane-departure"></i> Flight Landing Time *';
                airportFields.style.display = 'block';
            }
            // CONDITION 2: SEAPORT PICKUP
            else if (pickupType === 'seaport') {
                timePanelTitle.textContent = 'Cruise/Ferry Docking Details';
                dateLabel.innerHTML = '<i class="fas fa-anchor"></i> Cruise/Ferry Docking Date *';
                timeLabel.innerHTML = '<i class="fas fa-clock"></i> Cruise/Ferry Docking Time *';
                airportFields.style.display = 'none';
            }
            // CONDITION 3: DEFAULT (Postcode / Normal)
            else {
                timePanelTitle.textContent = 'When do you want to be picked up?';
                dateLabel.innerHTML = '<i class="fas fa-calendar"></i> Journey Date *';
                timeLabel.innerHTML = '<i class="fas fa-clock"></i> Journey Time *';
                airportFields.style.display = 'none';
            }
        }
        function goBackToLocations() {
            const vGrid = document.getElementById('vehicleGrid');
            if (vGrid) vGrid.classList.remove('single-col');
            // SHOW ALL SECTIONS BELOW FORM
            const sections = document.querySelectorAll('section');
            sections.forEach(section => {
                if (!section.classList.contains('hero-container')) {
                    section.classList.remove('sections-hidden');
                }
            });
            document.querySelector('footer')?.classList.remove('sections-hidden');
            showStep(1);
        }
        function hidePickupTimePanel() {
            document.getElementById("timeSelectionPanel").classList.remove("show");
            document.getElementById("tripMainContent").style.display = "block";
        }
        let bookingType = "now";
        function showSchedulePanel() {
            bookingType = "schedule";
            document.getElementById("timeSelectionPanel").classList.add("show");
        }
        function showSchedulePanelFromStep1() {
            bookingType = "schedule";
            document.getElementById("timeSelectionPanel").classList.add("show");
            // HIDE ALL SECTIONS BELOW FORM
            const sections = document.querySelectorAll('section');
            sections.forEach(section => {
                if (!section.classList.contains('hero-container')) {
                    section.classList.add('sections-hidden');
                }
            });
            document.querySelector('footer')?.classList.add('sections-hidden');
        }
        function updateSchedule() {
            const date = document.getElementById("date").value;
            if (!date || !selectedTime) return;
            bookingData.date = date;
            bookingData.time = selectedTime;
            document.getElementById("selectedDateTime").style.display = "block";
            document.getElementById("selectedDateTime").innerHTML =
                `<i class="fas fa-calendar"></i> ${date} &nbsp;&nbsp; <i class="fas fa-clock"></i> ${selectedTime}`;
        }
        function saveSchedule() {
            const date = document.getElementById("date").value;
            if (!date) {
                showToast('Please select a date', 'error');
                return;
            }
            if (!selectedTime) {
                showToast('Please select a time', 'error');
                return;
            }
            bookingData.date = date;
            bookingData.time = selectedTime;
            const label = `<i class="fas fa-calendar"></i> ${date} &nbsp; <i class="fas fa-clock"></i> ${selectedTime}`;
            document.getElementById("selectedDateTime").style.display = "block";
            document.getElementById("selectedDateTime").innerHTML = label;
            // POPULATE JOURNEY FORM FIELDS
            document.getElementById("normalJourneyDate").value = date;
            document.getElementById("normalJourneyTime").value = selectedTime;
            const btn = document.getElementById("pickupNowBtn");
            const title = document.getElementById("timePanelTitle").textContent;
            if (btn) {
                btn.innerHTML = `<i class="fas fa-clock"></i> ${title}`;
            }
            // Hide the time selection panel
            document.getElementById("timeSelectionPanel").classList.remove("show");
            // AUTOMATICALLY PROCEED TO THE "SEE PRICES" / VEHICLE SELECTION SCREEN
            proceedToTripDetails();
        }
        function showForMeModal() {
            document.getElementById('forMeModal').classList.add('show');
        }
        function closeForMeModal() {
            document.getElementById('forMeModal').classList.remove('show');
        }
        function selectForMe(type) {
            if (type === 'Me') {
                document.getElementById('forMeRadioMe').className = 'fas fa-dot-circle for-me-radio';
                document.getElementById('forMeRadioMe').style.color = '#000';
                document.getElementById('forMeRadioOther').className = 'far fa-circle for-me-radio';
                document.getElementById('forMeRadioOther').style.color = '#999';
                document.getElementById('forMeTitle').textContent = 'For me';
                document.getElementById('forMeDetails').style.display = 'none';
                rideFor = 'me';
                otherPassengerData = null;
            } else {
                document.getElementById('forMeRadioMe').className = 'far fa-circle for-me-radio';
                document.getElementById('forMeRadioMe').style.color = '#999';
                document.getElementById('forMeRadioOther').className = 'fas fa-dot-circle for-me-radio';
                document.getElementById('forMeRadioOther').style.color = '#000';
                rideFor = 'other';
                document.getElementById('otherPassengerName').value = '';
                document.getElementById('otherPassengerPhone').value = '';
                document.getElementById('forMeModal').classList.remove('show');
                document.getElementById('bookForOtherModal').classList.add('show');
            }
        }
        function proceedToVehicles() {
            showStep(3);
            if (window.innerWidth > 768) {
                document.getElementById('vehicleGrid').classList.add('single-col');
            }
            renderVehicles();
        }
        function renderVehicles() {
            const grid = document.getElementById('vehicleGrid');
            grid.innerHTML = '';
            vehicles.forEach(v => {
                const html = `
<div class="vehicle-item"
    onclick="selectVehicle(this, ${JSON.stringify(v).replace(/"/g, '&quot;')})">
    <div class="vehicle-image">
        <img src="${v.image}" alt="${v.name}">
    </div>
    <div class="vehicle-content">
<div class="vehicle-name-row">
    <div class="vehicle-name">${v.name}</div>
    <button
        class="vehicle-info-btn"
        onclick="event.stopPropagation();openVehicleInfo(${v.id})">
        <i class="fas fa-circle-info"></i>
    </button>
</div>
        <div class="vehicle-features">
            <span>
                <i class="fas fa-user"></i>
                ${v.capacity}
            </span>
            <span>
                <i class="fas fa-suitcase"></i>
                ${v.luggage}
            </span>
        </div>
    </div>
    <div class="vehicle-price">
        £${v.price}
    </div>
</div>
`;
                grid.innerHTML += html;
            });
        }
        function selectVehicle(el, vehicle) {
            bookingData.vehicle = vehicle;
            document.querySelectorAll('.vehicle-item').forEach(v => v.classList.remove('selected'));
            el.classList.add('selected');
        }
        function proceedToPassengerDetails() {
            if (!bookingData.vehicle) {
                showToast('Please select a vehicle', 'error');
                return;
            }
            // Populate and show the selected car summary in the left column
            document.getElementById('summaryCarImage').src = bookingData.vehicle.image;
            document.getElementById('summaryCarName').textContent = bookingData.vehicle.name;
            document.getElementById('summaryCarPrice').textContent = '£' + bookingData.vehicle.price;
            document.getElementById('summaryCarCapacity').textContent = bookingData.vehicle.capacity;
            document.getElementById('summaryCarLuggage').textContent = bookingData.vehicle.luggage;
            document.getElementById('selectedCarSummary').style.display = 'block';
            showStep(4);
            updatePassengerForm();
        }
        function updatePassengerForm() {
            const pickup = bookingData.pickupType;
            const dropoff = bookingData.dropoffType;
            // Hide all journey sections first
            document.getElementById('journeyAirport').style.display = 'none';
            document.getElementById('journeySeaport').style.display = 'none';
            document.getElementById('journeyNormal').style.display = 'none';
            // If pickup is airport, show flight details
            if (pickup === 'airport') {
                document.getElementById('journeyAirport').style.display = 'block';
            }
            // If pickup is seaport, show cruise details
            else if (pickup === 'seaport') {
                document.getElementById('journeySeaport').style.display = 'block';
                // Init flatpickr for cruise date if not already
                if (!document.getElementById('cruiseDate')._flatpickr) {
                    flatpickr('#cruiseDate', {
                        dateFormat: 'd/m/Y',
                        minDate: 'today'
                    });
                }
            }
            // Everything else (address/postcode): normal date + time
            else {
                document.getElementById('journeyNormal').style.display = 'block';
                if (!document.getElementById('normalJourneyDate')._flatpickr) {
                    flatpickr('#normalJourneyDate', {
                        dateFormat: 'd/m/Y',
                        minDate: 'today'
                    });
                }
            }
        }
        function verifyPersonalInfoAndRequestOTP() {
            const firstName = document.getElementById('passengerFirstName').value.trim();
            const email = document.getElementById('passengerEmail').value.trim();
            const phone = document.getElementById('passengerPhone').value.trim();
            if (!firstName) {
                showToast('Please enter your full name', 'error');
                document.getElementById('passengerFirstName').focus();
                return;
            }
            if (!phone) {
                showToast('Please enter your contact number', 'error');
                document.getElementById('passengerPhone').focus();
                return;
            }
            if (!email) {
                showToast('Please enter your email', 'error');
                document.getElementById('passengerEmail').focus();
                return;
            }
            bookingData.passengerName = firstName;
            bookingData.passengerEmail = email;
            bookingData.passengerPhone = phone;
            document.getElementById('otpModal').classList.add('show');
            document.getElementById('otpInput').focus();
        }
        function verifyPassengerDetails() {
            const passengers = document.getElementById('passengerCount').value;
            const luggage = document.getElementById('luggageCount').value;
            if (!passengers) {
                showToast('Please select number of passengers', 'error');
                return;
            }
            bookingData.passengers = passengers;
            bookingData.luggage = luggage;
            updatePaymentSummary();
            showStep(5);
        }
        function proceedToOTP() {
            document.getElementById('otpModal').classList.add('show');
            document.getElementById('otpInput').focus();
        }
        function updatePaymentSummary() {
            const baseFare = bookingData.vehicle ? bookingData.vehicle.price : 45;
            document.getElementById('rideFare').textContent = '£' + baseFare.toFixed(2);
            document.getElementById('totalAmount').textContent = '£' + baseFare.toFixed(2);
        }
        function proceedToConfirmation() {
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
            const btn = document.querySelector('#personalInfoBtns .btn-search-uber') || document.querySelector('#step5 .btn-search-uber');
            const originalBtnContent = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            btn.disabled = true;
            const num = 'GR-2026-' + Math.floor(10000 + Math.random() * 90000);
            fetch('https://mobapi.goride.run/api/book', {
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
                        $('#confirmModal').off('click').on('click', function(e) {
                            if ($(e.target).is('#confirmModal')) {
                                e.stopPropagation();
                            }
                        });
                        $('#confirmModal').addClass('show');
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
        function completeBooking() {
            const btn = document.querySelector('#confirmModal .btn-modal-primary');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Refreshing...';
            btn.disabled = true;
            setTimeout(() => {
                window.location.href = window.location.href.split('#')[0];
            }, 300);
        }
        // 4. Handle Page Refresh on Complete
        function completeBooking() {
            $('#confirmModal').removeClass('show');
            setTimeout(() => {
                location.reload();
            }, 500); // Slight delay for smooth animation
        }
        function renderDrivers() {
            const grid = document.getElementById('driverList');
            grid.innerHTML = '';
            // Use the selected vehicle image as a fallback for the car image in the driver list
            const vehicleImg = bookingData.vehicle?.image || 'https://www.goride.net.in/goride/img/saloon.png';
            drivers.forEach(d => {
                const driverJson = JSON.stringify(d).replace(/"/g, '&quot;');
                const html = `
<div class="driver-item driver-card">
    <div class="driver-info">
        <!-- Car Image -->
        <div class="driver-car-image" onclick="showCarDetailsModal(${driverJson})">
            <img src="${vehicleImg}" alt="Car">
        </div>
        <!-- Driver Details -->
        <div class="driver-details">
            <div class="driver-header">
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
            <div class="driver-vehicle-info">
                <i class="fas fa-car"></i>
                <span>${d.vehicle}</span>
            </div>
        </div>
        <!-- Price -->
        <div class="driver-bid-box">
            <div class="driver-price-row">
                <div class="bid-amount">
                    £${d.bid}
                </div>
                <button class="btn-search-uber driver-accept-btn"
                    onclick="acceptDriverFromList(${driverJson})">
                    Accept
                </button>
            </div>
            <div class="bid-eta">
                <i class="fas fa-clock"></i>
                ${d.eta} away
            </div>
        </div>
    </div>
</div>
`;
                grid.innerHTML += html;
            });
        }
        function acceptDriverFromList(driver) {
            bookingData.selectedDriver = driver;
            showStep(5);
            updatePaymentSummary();
        }
        let currentCarImageIndex = 1;
        const totalCarImages = 4;
        function showCarDetailsModal(driver) {
            currentCarImageIndex = 1;
            document.getElementById('carCarouselImage').src = `goride/img/fleet1.png`;
            bookingData.tempDriver = driver;
            document.getElementById('carDetailsModal').classList.add('show');
        }
        function nextCarImage() {
            currentCarImageIndex++;
            if (currentCarImageIndex > totalCarImages) {
                currentCarImageIndex = 1;
            }
            document.getElementById('carCarouselImage').src = `goride/img/fleet${currentCarImageIndex}.png`;
        }
        function prevCarImage() {
            currentCarImageIndex--;
            if (currentCarImageIndex < 1) {
                currentCarImageIndex = totalCarImages;
            }
            document.getElementById('carCarouselImage').src = `goride/img/fleet${currentCarImageIndex}.png`;
        }
        function acceptDriver() {
            if (bookingData.tempDriver) {
                bookingData.selectedDriver = bookingData.tempDriver;
            }
            document.getElementById('carDetailsModal').classList.remove('show');
            setTimeout(function() {
                showStep(5);
                updatePaymentSummary();
            }, 300);
        }
        function verifyPassengerDetails() {
            // Capture and populate passenger info for the left column summary
            const fname = document.getElementById('passengerFirstName')?.value || '';
            // const lname = document.getElementById('passengerLastName')?.value || '';
            const phone = document.getElementById('passengerPhone')?.value || '';
            document.getElementById('summaryPassengerName').textContent = (fname).trim() || 'Guest';
            document.getElementById('summaryPassengerContact').textContent = phone ? ('+44 ' + phone) : '–';
            // Passenger and Luggage counts
            document.getElementById('summaryPassengerCount').textContent = document.getElementById('passengerCount')?.value || 1;
            document.getElementById('summaryLuggageCount').textContent = document.getElementById('luggageCount')?.value || 0;
            // Journey Information based on type
            const pickupType = bookingData.pickupType;
            if (pickupType === 'airport') {
                document.getElementById('summaryFlightNumber').textContent = document.getElementById('flightNumber')?.value || '–';
                document.getElementById('summaryFlightContainer').style.display = 'flex';
                document.getElementById('summaryJourneyTimeContainer').style.display = 'none';
            } else if (pickupType === 'seaport') {
                document.getElementById('summaryFlightNumber').textContent = document.getElementById('ferryName')?.value || '–';
                document.getElementById('summaryFlightContainer').style.display = 'flex';
                document.getElementById('summaryFlightContainer').children[0].textContent = 'Cruise/Ferry';
                document.getElementById('summaryJourneyTimeContainer').style.display = 'none';
            } else {
                document.getElementById('summaryFlightContainer').style.display = 'none';
                document.getElementById('summaryJourneyTime').textContent = document.getElementById('normalJourneyTime')?.value || '–';
                document.getElementById('summaryJourneyTimeContainer').style.display = 'flex';
            }
            // Show the entered details summary block
            document.getElementById('enteredDetailsSummary').style.display = 'block';
            showStep(6);
            renderDrivers();
        }
        function requestOTP() {
            document.getElementById('otpModal').classList.add('show');
            document.getElementById('otpInput').focus();
        }
        function verifyOtp() {
            const otp = document.getElementById('otpInput').value;
            if (otp.length !== 4) {
                showToast("Enter valid OTP", "error");
                return;
            }
            closeModal('otpModal');
            // Hide personal info and buttons
            document.getElementById('personalInfoSection').style.display = 'none';
            document.getElementById('personalInfoBtns').style.display = 'none';
            // Unlock additional passenger details in step 4
            document.getElementById('additionalBookingDetails').style.display = 'block';
            document.getElementById('additionalDetailsBtns').style.display = 'flex';
        }
        function updatePaymentSummary() {
            // Calculate dynamic fare based on selections
            const baseFare = bookingData.vehicle?.price || 45;
            // Check if meet & greet is checked
            const isMeetGreet = document.getElementById('meetGreet')?.checked;
            const meetGreetPrice = isMeetGreet ? 10 : 0;
            bookingData.meetAndGreet = isMeetGreet;
            // Check if child seat is required
            const isChildSeat = document.getElementById('carSeatCheckbox')?.checked;
            const childSeatCount = parseInt(document.getElementById('childSeatCount')?.value || 1);
            const childSeatPrice = 5;
            const totalChildSeat = isChildSeat ? (childSeatCount * childSeatPrice) : 0;
            let totalFare = baseFare + totalChildSeat + meetGreetPrice;
            document.getElementById('rideFare').textContent = '£' + baseFare.toFixed(2);
            if (isChildSeat) {
                document.getElementById('childSeatRow').style.display = 'flex';
                document.getElementById('childSeatPriceDisplay').textContent = '£' + totalChildSeat.toFixed(2);
            } else {
                document.getElementById('childSeatRow').style.display = 'none';
            }
            if (isMeetGreet) {
                document.getElementById('meetGreetRow').style.display = 'flex';
                document.getElementById('meetGreetPriceDisplay').textContent = '£10.00';
            } else {
                document.getElementById('meetGreetRow').style.display = 'none';
            }
            document.getElementById('totalFare').textContent = '£' + totalFare.toFixed(2);
        }
        function showConfirmation() {
            const num = 'GR-2026-' + Math.floor(Math.random() * 100000);
            const baseFare = bookingData.vehicle?.price || 45;
            const meetGreet = bookingData.meetAndGreet ? 10 : 0;
            const isChildSeat = document.getElementById('carSeatCheckbox')?.checked;
            const childSeatCount = parseInt(document.getElementById('childSeatCount')?.value || 1);
            const childSeatPrice = 5;
            const totalChildSeat = isChildSeat ? (childSeatCount * childSeatPrice) : 0;
            const total = baseFare + meetGreet + totalChildSeat;
            // Populate all fields using jQuery
            $('#confirmNum').text(num);
            $('#confirmPickup').text(bookingData.pickup || '—');
            $('#confirmDropoff').text(bookingData.dropoff || '—');
            $('#confirmDateTime').text(`${bookingData.date} | ${bookingData.time}` || '—');
            $('#confirmVehicle').text(bookingData.vehicle?.name || '—');
            $('#confirmDistance').text('~250 kms');
            $('#confirmDuration').text('~4 hours');
            $('#confirmBaseFare').text('£' + baseFare.toFixed(2));
            $('#confirmMeetGreet').text('£' + (meetGreet + totalChildSeat).toFixed(2));
            $('#confirmTotalFare').text('£' + total.toFixed(2));
            $('#confirmModal').addClass('show');
        }
        function showDriverConfirmation(driver) {
            // Populate driver details
            $('#driverConfirmImage').attr('src', driver.image || 'https://randomuser.me/api/portraits/men/32.jpg');
            $('#driverConfirmName').text(driver.name);
            $('#driverConfirmVehicle').text(driver.vehicle || driver.car || 'Vehicle');
            $('#driverConfirmRating').text(driver.rating);
            // Show modal
            $('#driverConfirmModal').addClass('show');
        }
        // jQuery event handlers
        // jQuery event handlers
        // jQuery event handlers
        $(document).ready(function() {
            $('#pickDriverBtn').on('click', function() {
                $('#confirmModal').removeClass('show');
                setTimeout(function() {
                    showStep(6);
                    renderDrivers();
                }, 300);
            });
            $('#closeDriverConfirmBtn').on('click', function() {
                $('#driverConfirmModal').removeClass('show');
                setTimeout(function() {
                    location.reload();
                }, 500);
            });
        });
        function showStep(stepNumber) {
            const sections = document.querySelectorAll('.form-section');
            if (window.innerWidth > 768 && stepNumber >= 3) {
                // Desktop 3-column mode (Step 2 on left, Step N in middle, Map on right)
                const formSection = document.querySelector('.hero-form-section');
                const mapSection = document.querySelector('.hero-map-section');
                formSection.classList.remove('col-md-5');
                formSection.classList.add('col-md-8', 'three-column-mode');
                mapSection.classList.remove('col-md-7');
                mapSection.classList.add('col-md-4');
                sections.forEach(s => s.classList.remove('active', 'side-by-side'));
                // step2 is always active on the left
                document.getElementById('step2').classList.add('active', 'side-by-side');
                // The new step is active on the right side of the form section (middle column)
                document.getElementById(`step${stepNumber}`).classList.add('active', 'side-by-side');
                document.getElementById('step2Buttons').style.display = 'none';
                $('#bookingImage').hide();
                $('#bookingMap').show();
                // Initialize the map ONLY when it's made visible
                if (typeof initSingleRouteMap === 'function') {
                    setTimeout(initSingleRouteMap, 100);
                }
            } else {
                // Standard single column for mobile or steps 1/2 on desktop
                sections.forEach(s => s.classList.remove('active', 'side-by-side'));
                document.getElementById(`step${stepNumber}`).classList.add('active');
                // Reset layout if returning to steps < 3 on desktop
                if (window.innerWidth > 768 && stepNumber < 3) {
                    const formSection = document.querySelector('.hero-form-section');
                    const mapSection = document.querySelector('.hero-map-section');
                    formSection.classList.remove('col-md-8', 'three-column-mode');
                    formSection.classList.add('col-md-5');
                    mapSection.classList.remove('col-md-4');
                    mapSection.classList.add('col-md-7');
                    if (stepNumber === 1) {
                        $('#bookingMap').hide();
                        $('#bookingImage').show();
                    } else if (stepNumber === 2) {
                        document.getElementById('step2Buttons').style.display = 'flex';
                    }
                }
            }
            document.querySelector('.hero-form-section').scrollTop = 0;
            // MOBILE: Control menu visibility
            if (window.innerWidth <= 768) {
                if (stepNumber === 1) {
                    document.getElementById('mobileHamburger').style.display = 'flex';
                    document.getElementById('mobileMapBtn').style.display = 'none';
                    document.getElementById('bookingImage').style.display = 'block';
                    document.getElementById('bookingMap').style.display = 'none';
                } else {
                    document.getElementById('mobileHamburger').style.display = 'none';
                    document.getElementById('mobileMapBtn').style.display = 'flex';
                    document.getElementById('bookingImage').style.display = 'none';
                    // If map happens to be visible in mobile view, recalculate bounds
                    if ($('#bookingMap').is(':visible') && typeof initSingleRouteMap === 'function') {
                        setTimeout(initSingleRouteMap, 100);
                    }
                }
            }
        }
        function goBack(step) {
            showStep(step);
        }
        function closeModal(id) {
            document.getElementById(id).classList.remove('show');
        }
        function toggleFaq(el) {
            const answer = el.nextElementSibling;
            document.querySelectorAll('.faq-answer').forEach(a => {
                if (a !== answer) a.classList.remove('show');
            });
            answer.classList.toggle('show');
        }
        function saveOtherPassenger() {
            const name = document.getElementById('otherPassengerName').value.trim();
            const phone = document.getElementById('otherPassengerPhone').value.trim();
            if (!name) {
                showToast('Please enter recipient name', 'error');
                return;
            }
            otherPassengerData = {
                name,
                phone
            };
            document.getElementById('forMeTitle').textContent = 'Order for someone';
            document.getElementById('forMeDetails').innerHTML = phone ?
                `${name}<br><small style="font-size:11px;">${phone}</small>` :
                name;
            document.getElementById('forMeDetails').style.display = 'block';
            closeModal('bookForOtherModal');
            closeForMeModal();
        }
        function showAppPromoModal() {
            document.getElementById('appPromoModal').classList.add('show');
        }
        async function saveBooking() {
            if (!validateBooking()) return;
            const payload = {
                // Outbound
                from: bookingData.pickup,
                from_type: bookingData.pickupType,
                to: bookingData.dropoff,
                to_type: bookingData.dropoffType,
                // Time
                date: bookingData.date,
                time: bookingData.time,
                // Airport-specific
                flight_landing_time: bookingData.landingTime || null,
                pickup_after_minutes: bookingData.pickupAfter || null,
                // Return trip
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
                    showToast('Booking confirmed! Confirmation #' + result.booking_id, 'success');
                } else {
                    showToast('Booking failed: ' + result.message, 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Network error while saving booking', 'error');
            }
        }
        function enableInlineEditPickup() {
            currentEditingField = 'pickup';
            document.getElementById('summaryPickupContainer').style.display = 'none';
            document.getElementById('inlinePickupContainer').style.display = 'block';
            const input = document.getElementById('inlinePickupInput');
            input.value = bookingData.pickup || '';
            input.focus();
            input.select();
            showInlinePickupSuggestions();
        }
        function enableInlineEditDropoff() {
            currentEditingField = 'dropoff';
            // Hide text, show input
            document.getElementById('summaryDropoffContainer').style.display = 'none';
            document.getElementById('inlineDropoffContainer').style.display = 'block';
            const input = document.getElementById('inlineDropoffInput');
            input.value = bookingData.dropoff || '';
            input.focus();
            input.select();
            showInlineDropoffSuggestions();
        }
        function selectInlinePickup(location, type) {
            bookingData.pickup = location;
            bookingData.pickupType = type;
            document.getElementById('pickupInput').value = location; // sync with step 1
            document.getElementById('inlinePickupSuggestions').classList.remove('show');
            document.getElementById('inlinePickupContainer').style.display = 'none';
            document.getElementById('summaryPickupContainer').style.display = 'block';
            updateTimePanel();
            updateTripDisplayFromStep1();
        }
        function selectInlineDropoff(location, type) {
            bookingData.dropoff = location;
            bookingData.dropoffType = type;
            document.getElementById('dropoffInput').value = location; // sync with step 1
            document.getElementById('inlineDropoffSuggestions').classList.remove('show');
            document.getElementById('inlineDropoffContainer').style.display = 'none';
            document.getElementById('summaryDropoffContainer').style.display = 'block';
            updateTimePanel();
            updateTripDisplayFromStep1();
        }
        function updateTripDisplayFromStep1() {
            const pickupDisplay = document.getElementById('summaryPickup');
            const dropoffDisplay = document.getElementById('summaryDropoff');
            if (pickupDisplay) {
                pickupDisplay.textContent = bookingData.pickup || '–';
            }
            if (dropoffDisplay) {
                dropoffDisplay.textContent = bookingData.dropoff || '–';
            }
        }
        function goBackToLocationsFromVehicles() {
            document.getElementById('selectedCarSummary').style.display = 'none';
            goBackToLocations();
        }
        function updateCounter(inputId, delta, min, max) {
            const input = document.getElementById(inputId);
            const display = document.getElementById(inputId + 'Display');
            if (!input || !display) return;
            let val = parseInt(input.value) || 0;
            val += delta;
            if (val < min) val = min;
            if (val > max) val = max;
            input.value = val;
            display.textContent = val;
        }
        function toggleChildSeatOptions() {
            const checkbox = document.getElementById('carSeatCheckbox');
            const options = document.getElementById('childSeatOptions');
            if (checkbox && options) {
                options.style.display = checkbox.checked ? 'block' : 'none';
            }
        }
        function openVehicleInfo(id) {
            const vehicle = vehicles.find(v => v.id === id);
            document.getElementById("vehicleModalTitle").innerHTML = vehicle.name;
            document.getElementById("vehicleModalContent").innerHTML = `
        <div class="vehicle-info-section">
            <h6><i class="fas fa-circle-check"></i> Inclusions</h6>
            <ul>
                ${vehicle.inclusions.map(i => `<li>${i}</li>`).join("")}
            </ul>
            <h6 style="margin-top:20px;">
                <i class="fas fa-circle-xmark"></i> Exclusions
            </h6>
            <ul>
                ${vehicle.exclusions.map(i => `<li>${i}</li>`).join("")}
            </ul>
            <h6 style="margin-top:20px;">
                <i class="fas fa-child"></i> Child Seat
            </h6>
            <p>
                ${vehicle.childSeat
                    ? `<span style="color:green;font-weight:600;">Available (Max ${Math.floor(vehicle.capacity / 2)})</span>`
                    : '<span style="color:#d32f2f;font-weight:600;">Not Available</span>'
                }
            </p>
        </div>
    `;
            document.getElementById("vehicleInfoModal").classList.add("show");
        }
        $(document).ready(function() {
            // Show only if not accepted before
            // if (localStorage.getItem("goridePrivacyAccepted") !== "true") {
            //     $("#privacyPolicyModal").addClass("show");
            // }
            // Accept
            $("#privacyAcceptBtn").on("click", function() {
                localStorage.setItem("goridePrivacyAccepted", "true");
                $("#privacyPolicyModal").removeClass("show");
            });
            // Decline
            $("#privacyRejectBtn").on("click", function() {
                $("#privacyPolicyModal").removeClass("show");
                // Optional redirect
                // window.location.href="/";
            });
        });
        // ===== CAR SEAT COUNT UPDATE =====
        function updateCarSeatCount(delta) {
            const input = document.getElementById('childSeatCount');
            const display = document.getElementById('childSeatCountDisplay');
            if (!input || !display) return;
            let val = parseInt(input.value) || 0;
            val += delta;
            if (val < 0) val = 0;
            if (val > 4) val = 4; // Max 4 car seats
            input.value = val;
            display.textContent = val;
            // Update dropdowns based on count
            renderCarSeatDropdowns(val);
        }
        // ===== RENDER CAR SEAT DROPDOWNS DYNAMICALLY =====
        function renderCarSeatDropdowns(count) {
            const container = document.getElementById('carSeatDropdownsContainer');
            if (!container) return;
            // Clear existing dropdowns
            container.innerHTML = '';
            // Create a dropdown for each car seat
            for (let i = 1; i <= count; i++) {
                const dropdownHtml = `
            <div class="form-group-uber booking-form-group" style="margin-bottom: 0;">
                <label style="font-size: 13px;">Car Seat ${i} Type</label>
                <select id="childSeatType_${i}" class="carSeatTypeSelect" style="width: 100%;">
                    <option value="">Select Type</option>
                    <option value="infant">Infant (0-1 yr)</option>
                    <option value="toddler">Toddler (1-4 yr)</option>
                    <option value="booster">Booster (4-12 yr)</option>
                </select>
            </div>
        `;
                container.innerHTML += dropdownHtml;
            }
        }
        // ===== TOGGLE CHILD SEAT OPTIONS =====
        function toggleChildSeatOptions() {
            const checkbox = document.getElementById('carSeatCheckbox');
            const options = document.getElementById('childSeatOptions');
            if (!checkbox || !options) return;
            if (checkbox.checked) {
                options.style.display = 'block';
                // Reset count to 0
                document.getElementById('childSeatCount').value = 0;
                document.getElementById('childSeatCountDisplay').textContent = 0;
                renderCarSeatDropdowns(0);
            } else {
                options.style.display = 'none';
                // Clear data
                document.getElementById('childSeatCount').value = 0;
                document.getElementById('childSeatCountDisplay').textContent = 0;
                document.getElementById('carSeatDropdownsContainer').innerHTML = '';
            }
        }
        // ===== GET CAR SEAT DATA (For form submission) =====
        function getCarSeatData() {
            const count = parseInt(document.getElementById('childSeatCount').value) || 0;
            const carSeats = [];
            for (let i = 1; i <= count; i++) {
                const typeSelect = document.getElementById(`childSeatType_${i}`);
                if (typeSelect) {
                    carSeats.push({
                        seat: i,
                        type: typeSelect.value
                    });
                }
            }
            return carSeats;
        }
        // ===== TOGGLE SPECIAL REQUIREMENTS =====
        function toggleSpecialRequirements() {
            const checkbox = document.getElementById('specialReqCheckbox');
            const textarea = document.getElementById('specialRequirements');
            if (!checkbox || !textarea) return;
            if (checkbox.checked) {
                textarea.style.display = 'block';
                textarea.focus();
            } else {
                textarea.style.display = 'none';
                textarea.value = '';
            }
        }
    </script>
</body>
</html>