<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - GoRide</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="https://www.goride.net.in/goride/img/Go-Ride-fav-icon.webp" />

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
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

        /* ===== NAVBAR ===== */
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

        /* Mobile Menu */
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

        .mobile-menu-overlay.show {
            visibility: visible;
            opacity: 1;
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
            padding: 12px;
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
            /*padding: 10px 0;*/
            overflow-y: auto;
        }

        .mobile-menu-links a {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 10px 22px;
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

        /* ===== CONTENT SECTIONS ===== */
        .page-header {
            position: relative;
            background: url("/goride/img/main-banner.webp") center center/cover no-repeat;
            padding: 120px 0;
            text-align: center;
            color: #fff;
            overflow: hidden;
        }

        .page-header::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
            z-index: 1;
        }

        .page-header .container {
            position: relative;
            z-index: 2;
        }

        .page-header h1 {
            font-size: 48px;
            /*font-weight: 800;*/
            margin-bottom: 16px;
            color: #fff;
        }

        .section-padding {
            padding: 60px 0;
        }

        .contact-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .contact-info-box {
            background: #f9f9f9;
            padding: 40px;
            border-radius: 16px;
            height: 100%;
            border: 1px solid #eee;
        }

        .contact-info-box h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #000;
        }

        .contact-info-text {
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 30px;
            /*color: #666;*/
        }

        .contact-info-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 24px;
        }

        .contact-info-item .icon-circle {
            width: 48px;
            height: 48px;
            min-width: 48px;
            border-radius: 50%;
            background: #000;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .contact-info-item .info-text {
            flex: 1;
        }

        .contact-info-item .info-text h4 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #000;
        }

        .contact-info-item .info-text p {
            font-size: 14px;
            /*color: #666;*/
            margin: 0;
            line-height: 1.6;
        }

        .contact-info-item .info-text a {
            color: inherit;
            /*color: #666;*/
            text-decoration: none;
        }

        .contact-info-item .info-text a:hover {
            color: #000;
        }

        .contact-form-box {
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            border: 1px solid #eee;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .contact-form-box h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #000;
        }

        .contact-form-box .form-subtitle {
            font-size: 14px;

            margin-bottom: 30px;
        }

        .form-control-custom {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s;
            width: 100%;
        }

        .form-control-custom:focus {
            border-color: #000;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
            outline: none;
        }

        .form-control-custom::placeholder {
            color: #aaa;
        }

        .form-label-custom {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }

        .btn-submit {
            background: #000;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 14px 40px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
            cursor: pointer;
            width: 100%;
        }

        .btn-submit:hover {
            background: #1a1a1a;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* ===== SUCCESS POPUP ===== */
        .success-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 99999;
            padding: 20px;
            backdrop-filter: blur(4px);
        }

        .success-overlay.show {
            display: flex;
        }

        .success-popup {
            background: #fff;
            border-radius: 20px;
            padding: 50px 40px;
            max-width: 480px;
            width: 100%;
            text-align: center;
            animation: popIn 0.5s ease;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
        }

        @keyframes popIn {
            0% {
                opacity: 0;
                transform: scale(0.9) translateY(20px);
            }

            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .success-popup .check-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #10b981;
            color: #fff;
            font-size: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .success-popup h3 {
            font-size: 24px;
            font-weight: 700;
            color: #000;
            margin-bottom: 10px;
        }

        .success-popup p {
            font-size: 15px;
            /*color: #666;*/
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .success-popup .btn-close-popup {
            background: #000;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px 40px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .success-popup .btn-close-popup:hover {
            background: #1a1a1a;
            transform: scale(1.02);
        }

        /* ===== FORM ROW STYLES ===== */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* ===== FOOTER ===== */
        footer {
            background: #000;
            color: #fff;
            padding: 60px 0 20px;
        }

        .footer-logo-section {
            margin-bottom: 40px;
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

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            text-align: center;
            font-size: 15px;
            color: rgba(255, 255, 255, 0.6);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .form-label-custom {
                font-size: 17px;
            }

            .contact-info-item .info-text p {
                font-size: 17px;
            }

            .contact-info-text {
                font-size: 17px;
            }

            .contact-info-item .info-text h4 {
                font-size: 18px;
            }


            .contact-info-box h3 {
                font-size: 22px;
            }

            /* .navbar-menu {
                display: none;
            } */

            .mobile-menu-btn {
                display: flex;
            }

            .page-header {
                padding: 80px 0;
            }

            .page-header h1 {
                font-size: 29px;
            }

            .section-padding {
                padding: 40px 0;
            }

            .contact-info-box {
                padding: 25px;
                margin-bottom: 30px;
            }

            .contact-form-box {
                padding: 25px;
            }

            .contact-form-box h3 {
                font-size: 25px;
            }

            .contact-form-box .form-subtitle {
                font-size: 18px;
            }

            .footer-tagline {
                font-size: 14px;
            }

            .account-dropdown {
                width: 280px;
                right: -10px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

        @media (max-width: 480px) {
            .navbar-uber {
                padding: 0 12px;
            }

            .navbar-brand-uber img {
                height: 40px;
            }

            .page-header {
                padding: 60px 0;
            }

            .section-padding {
                padding: 30px 0;
            }

            .contact-info-box {
                padding: 20px;
            }

            .contact-form-box {
                padding: 20px;
            }



            .success-popup {
                padding: 30px 20px;
            }

            .success-popup .check-icon {
                width: 60px;
                height: 60px;
                font-size: 30px;
            }

            .success-popup h3 {
                font-size: 20px;
            }

            .account-dropdown {
                width: 260px;
                right: -20px;
            }
        }

        @media (max-width: 380px) {
            .account-dropdown {
                width: 220px;
                right: -30px;
            }

            .account-header {
                padding: 14px;
                flex-wrap: wrap;
            }

            .account-avatar {
                width: 45px;
                height: 45px;
                font-size: 18px;
            }

            .account-info h5 {
                font-size: 15px;
            }
        }
    </style>
</head>

<body>
    <!-- ===== NAVBAR ===== -->
    <nav class="navbar-uber">
        <div class="navbar-brand-uber">
            <a href="/">
                <img src="https://www.goride.net.in/goride/img/logo-light.png" alt="GoRide UK Logo">
            </a>
        </div>
        <ul class="navbar-menu">
            <!-- <li><button onclick="toggleDropdown('language')">
                <i class="fas fa-globe me-2"></i>EN
            </button></li> -->
            <a href="#" data-bs-toggle="modal" data-bs-target="#helpModal">
                Help
            </a>
            <!-- <li style="position:relative;">
                <button class="user-btn" onclick="toggleDropdown('user')">
                    <i class="fas fa-user-circle"></i>
                    Mogana
                    <i class="fas fa-chevron-down"></i>
                </button>
            </li> -->
        </ul>

        <div id="language-dropdown" class="dropdown-menu-navbar">
            <button onclick="selectLanguage('en')">English</button>
            <button onclick="selectLanguage('hi')">हिंदी</button>
            <button onclick="selectLanguage('ta')">தமிழ்</button>
            <button onclick="selectLanguage('te')">తెలుగు</button>
            <button onclick="selectLanguage('kn')">ಕನ್ನಡ</button>
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

        <!-- <button class="mobile-menu-btn" id="mobileHamburger" onclick="toggleMobileMenu()">
            <i class="fas fa-bars"></i>
        </button> -->

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
                <a href="index.html"><i class="fas fa-home"></i>Home</a>
                <a href="about.html"><i class="fas fa-info-circle"></i>About Us</a>
                <a href="contact.html"><i class="fas fa-envelope"></i>Contact</a>
                <a href="#"><i class="fas fa-user"></i>My Profile</a>
                <a href="#"><i class="fas fa-car"></i>My Rides</a>
                <!--<a href="#"><i class="fas fa-map-marker-alt"></i>Saved Places</a>-->
                <a href="#"><i class="fas fa-wallet"></i>Wallet</a>
                <a href="#"><i class="fas fa-tag"></i>Offers</a>
                <!--<a href="#"><i class="fas fa-language"></i>Language</a>-->
                <a href="terms.html"><i class="fas fa-file-contract"></i>Terms</a>
                <a href="privacy.html"><i class="fas fa-shield-alt"></i>Privacy</a>
                <a href="#"><i class="fas fa-gear"></i>Settings</a>
            </div>

            <div class="mobile-menu-footer">
                <button><i class="fas fa-right-from-bracket"></i>Logout</button>
            </div>
        </div>
    </nav>

    <!-- ===== PAGE HEADER ===== -->
    <section class="page-header">
        <div class="container">
            <h1 data-aos="fade-up" data-aos-duration="800">Contact Us</h1>
        </div>
    </section>

    <!-- ===== CONTACT SECTION ===== -->
    <section class="section-padding">
        <div class="contact-container">
            <div class="row g-4">
                <!-- Left: Contact Info -->
                <div class="col-lg-5" data-aos="fade-up" data-aos-duration="700">
                    <div class="contact-info-box">
                        <h3>Get in Touch</h3>
                        <p class="contact-info-text">
                            Have questions about our AI dispatch software? Want to learn more about how GoRide can
                            transform your transportation business? Contact us today, and our team of experts will be
                            happy to assist you.
                        </p>

                        <div class="contact-info-item">
                            <div class="icon-circle">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="info-text">
                                <h4>Phone</h4>
                                <p><a href="tel:+44 208 337 3777">+44 208 337 3777</a></p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="icon-circle">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-text">
                                <h4>Email</h4>
                                <p><a href="mailto:support.uk@goride.run">support.uk@goride.run</a></p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="icon-circle">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info-text">
                                <h4>Address</h4>
                                <p>
                                    Goride Plus Ltd<br>
                                    83 1st Floor
                                    Surbiton Road
                                    Kingston Upon Thames
                                    KT1 2HW
                                    United Kingdom

                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Contact Form -->
                <div class="col-lg-7" data-aos="fade-up" data-aos-duration="700">
                    <div class="contact-form-box">
                        <h3>Contact With Us!</h3>
                        <p class="form-subtitle">Fill in the details below and we'll get back to you shortly.</p>

                        <form id="contactForm" onsubmit="handleSubmit(event)">
                            <!-- Row 1: Name + Email -->
                            <div class="form-row">
                                <div class="mb-3">
                                    <label class="form-label-custom">Full Name</label>
                                    <input type="text" class="form-control-custom" id="fullName"
                                        placeholder="Enter your full name" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label-custom">Email</label>
                                    <input type="email" class="form-control-custom" id="email"
                                        placeholder="Enter your email address" required>
                                </div>
                            </div>

                            <!-- Row 2: Phone + Subject -->
                            <div class="form-row">
                                <div class="mb-3">
                                    <label class="form-label-custom">Phone Number</label>
                                    <input type="tel" class="form-control-custom" id="phone"
                                        placeholder="+91 Enter your phone number" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label-custom">Subject</label>
                                    <input type="text" class="form-control-custom" id="subject"
                                        placeholder="Enter subject" required>
                                </div>
                            </div>

                            <!-- Row 3: Message (full width) -->
                            <div class="mb-4">
                                <label class="form-label-custom">Message</label>
                                <textarea class="form-control-custom" id="message" rows="4"
                                    placeholder="Write your message here..." required
                                    style="resize: vertical;"></textarea>
                            </div>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SUCCESS POPUP ===== -->
    <div class="success-overlay" id="successOverlay">
        <div class="success-popup">
            <div class="check-icon">
                <i class="fas fa-check"></i>
            </div>
            <h3>Message Sent!</h3>
            <p>Thank you for contacting us. Our team will get back to you within 24 hours. We appreciate your interest
                in GoRide.</p>
            <button class="btn-close-popup" onclick="closePopup()">Got It</button>
        </div>
    </div>

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
                            <a href="#">Blogs</a>
                        </div>
                    </div>
                </div>

                <!-- Legal Links -->
                <div class="col-6 col-md-2">
                    <div class="footer-section">
                        <div class="footer-section-title">Legal</div>
                        <div class="footer-links-list">
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
                                <i class="fas fa-phone" style="margin-right: 8px;"></i>+44 208 337 3777
                            </a>
                            <a href="mailto:support.uk@goride.run">
                                <i class="fas fa-envelope" style="margin-right: 8px;"></i>support.uk@goride.run
                            </a>
                            <a href="#">
                                <i class="fas fa-location-dot" style="margin-right:8px;"></i>
                                83 1st Floor,<br>
                                Surbiton Road,<br>
                                Kingston Upon Thames,<br>
                                KT1 2HW,<br>
                                United Kingdom
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="mb-0">&copy; 2026 Operated by Goride Plus Ltd. All rights reserved. | Privacy • Terms •
                    Cookies</p>
            </div>
        </div>
    </footer>


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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            offset: 50,
            easing: 'ease-out-cubic'
        });

        function toggleDropdown(type) {
            const dropdown = document.getElementById(`${type}-dropdown`);
            dropdown.classList.toggle('show');
        }

        $(document).on('click', function (e) {
            if (!$(e.target).closest('.navbar-menu').length && !$(e.target).closest('.dropdown-menu-navbar').length) {
                $('.dropdown-menu-navbar').removeClass('show');
            }
            if (!$(e.target).closest('.user-btn').length && !$(e.target).closest('.account-dropdown').length) {
                $('.account-dropdown').removeClass('show');
            }
        });

        function selectLanguage(lang) {
            toggleDropdown('language');
        }

        function toggleMobileMenu() {
            document.getElementById("mobileMenu").classList.toggle("show");
            document.getElementById("mobileOverlay").classList.toggle("show");
            document.body.classList.toggle("menu-open");
        }

        // Refresh AOS on resize
        $(window).on('resize', function () {
            AOS.refresh();
        });

        // Handle form submission
        function handleSubmit(event) {
            event.preventDefault();

            // Get form values
            const name = document.getElementById('fullName').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;

            // Basic validation
            if (!name || !email || !phone || !subject || !message) {
                alert('Please fill in all fields.');
                return;
            }

            // Show success popup
            document.getElementById('successOverlay').classList.add('show');

            // Reset form
            document.getElementById('contactForm').reset();
        }

        // Close popup
        function closePopup() {
            document.getElementById('successOverlay').classList.remove('show');
        }

        // Close popup on overlay click
        document.getElementById('successOverlay').addEventListener('click', function (e) {
            if (e.target === this) {
                closePopup();
            }
        });

        // Close popup with Escape key
        $(document).on('keydown', function (e) {
            if (e.key === 'Escape') {
                closePopup();
            }
        });
    </script>
</body>

</html>