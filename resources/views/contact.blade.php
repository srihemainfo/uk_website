@extends('layouts.app')
@section('content')

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Helvetica, Arial, sans-serif;
            color: #333;
            background: #fff;
            overflow-x: hidden;
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

        .page-header {
            position: relative;
            background: url('{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG_II') }}/goride/img/main-banner.webp') center center/cover no-repeat;
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
        }

        .contact-info-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 24px;
        }

        .contact-info-item .icon-circle {
            width: 40px;
            height: 40px;
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
            margin: 0;
            line-height: 1.6;
        }

        .contact-info-item .info-text a {
            color: inherit;
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

        .custom-dropdown-container {
            display: flex;
            gap: 10px;
            width: 100%;
            position: relative;
        }

        .country-select-custom {
            flex: 0 0 110px;
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 10px;
            cursor: pointer;
            font-size: 14px;
            user-select: none;
            transition: all 0.3s;
        }

        .country-select-custom:hover {
            border-color: #000;
        }

        .country-dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 300px;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            margin-top: 8px;
            overflow: hidden;
        }

        .country-dropdown-menu.show {
            display: block;
            animation: popIn 0.2s ease;
        }

        .country-dropdown-menu .form-control-custom {
            padding: 10px 12px;
            font-size: 13px;
            border: 1px solid #eee;
        }

        .country-list {
            list-style: none;
            margin: 0;
            padding: 0;
            max-height: 220px;
            overflow-y: auto;
        }

        .country-list li {
            padding: 12px 15px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid #f5f5f5;
            transition: background 0.2s;
        }

        .country-list li:last-child {
            border-bottom: none;
        }

        .country-list li:hover {
            background-color: #f8f9fa;
        }

        .country-list li strong {
            min-width: 45px;
            color: #000;
        }

        .country-list li span {
            color: #555;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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

        .btn-submit:hover:not(:disabled) {
            background: #1a1a1a;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

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

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast-message {
            padding: 16px 24px;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.3s ease-out forwards;
            max-width: 350px;
            word-wrap: break-word;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .toast-error {
            background-color: #ef4444;
        }

        .toast-success {
            background-color: #10b981;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

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

            .country-select-custom {
                flex: 0 0 90px;
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

    <div id="toast-container"></div>

    <section class="page-header">
        <div class="container">
            <h1 data-aos="fade-up" data-aos-duration="800">Contact Us</h1>
        </div>
    </section>
    <section class="section-padding">
        <div class="contact-container">
            <div class="row g-4">
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
                                <i class="fab fa-whatsapp"></i>
                            </div>

                            <div class="info-text">
                                <h4>WhatsApp</h4>
                                <p>
                                    <a href="https://api.whatsapp.com/send/?phone=447950323242&text=Hi%2C%20I%20need%20a%20cab.%20Could%20you%20help%20me%20book%20one%3F&type=phone_number&app_absent=0" target="_blank">
                                        +44 79 5032 3242
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="icon-circle">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="info-text">
                                <h4>Phone</h4>
                                <p><a href="tel:+44 20 8337 3777">+44 20 8337 3777</a></p>
                                                     
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
                                    83 1st Floor , Surbiton Road<br>                                  
                                    Kingston Upon Thames , KT1 2HW ,<br>
                                    United Kingdom
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-up" data-aos-duration="700">
                    <div class="contact-form-box">
                        <h3>Contact With Us!</h3>
                        <p class="form-subtitle">Fill in the details below and we'll get back to you shortly.</p>
                        <form id="contactForm" onsubmit="handleSubmit(event)">
                            <div class="form-row">
                                <div class="mb-3">
                                    <label class="form-label-custom">Full Name</label>
                                    <input type="text" class="form-control-custom" id="fullName"
                                        placeholder="Enter your full name" maxlength="50" required autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label-custom">Email</label>
                                    <input type="email" class="form-control-custom" id="email"
                                        placeholder="Enter your email address" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="mb-3">
                                    <label class="form-label-custom">Mobile Number</label>
                                    <div class="custom-dropdown-container">
                                        <div class="country-select-custom" id="selectedCountry"
                                            onclick="toggleCountryDropdown()">
                                            <span id="selectedCountryCode">+44 UK</span>
                                            <i class="fas fa-chevron-down ms-1" style="font-size: 10px; color: #777;"></i>
                                        </div>
                                        <div class="country-dropdown-menu" id="countryDropdownMenu">
                                            <div class="p-2 border-bottom">
                                                <input type="text" id="countrySearch" class="form-control-custom"
                                                    placeholder="Search country or code..." autocomplete="off">
                                            </div>
                                            <ul class="country-list" id="countryList">
                                            </ul>
                                        </div>
                                        <input type="hidden" id="countryCodeVal" value="+44">
                                        <input type="tel" class="form-control-custom" id="phone"
                                            placeholder="Enter mobile number" maxlength="10" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label-custom">Subject</label>
                                    <input type="text" class="form-control-custom" id="subject" placeholder="Enter subject"
                                        maxlength="100" required autocomplete="off">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label-custom">Message</label>
                                <textarea class="form-control-custom" id="message" rows="4"
                                    placeholder="Write your message here..." maxlength="250" required
                                    style="resize: vertical;"></textarea>
                            </div>
                            <button type="submit" id="submitBtn" class="btn-submit">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

   
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, offset: 50, easing: 'ease-out-cubic' });

        const countries = [
            { code: "+44", name: "United Kingdom", short: "UK" },
            { code: "+91", name: "India", short: "IN" },
            { code: "+1", name: "United States", short: "US" },
            { code: "+1", name: "Canada", short: "CA" },
            { code: "+61", name: "Australia", short: "AU" },
            { code: "+971", name: "United Arab Emirates", short: "AE" },
            { code: "+65", name: "Singapore", short: "SG" },
            { code: "+49", name: "Germany", short: "DE" },
            { code: "+33", name: "France", short: "FR" },
            { code: "+39", name: "Italy", short: "IT" },
            { code: "+81", name: "Japan", short: "JP" },
            { code: "+86", name: "China", short: "CN" },
            { code: "+27", name: "South Africa", short: "ZA" },
            { code: "+55", name: "Brazil", short: "BR" },
            { code: "+52", name: "Mexico", short: "MX" },
            { code: "+7", name: "Russia", short: "RU" },
            { code: "+34", name: "Spain", short: "ES" },
            { code: "+31", name: "Netherlands", short: "NL" },
            { code: "+41", name: "Switzerland", short: "CH" },
            { code: "+46", name: "Sweden", short: "SE" },
            { code: "+64", name: "New Zealand", short: "NZ" },
            { code: "+92", name: "Pakistan", short: "PK" },
            { code: "+880", name: "Bangladesh", short: "BD" },
            { code: "+94", name: "Sri Lanka", short: "LK" },
            { code: "+60", name: "Malaysia", short: "MY" },
            { code: "+62", name: "Indonesia", short: "ID" },
            { code: "+66", name: "Thailand", short: "TH" },
            { code: "+63", name: "Philippines", short: "PH" },
            { code: "+84", name: "Vietnam", short: "VN" },
            { code: "+82", name: "South Korea", short: "KR" },
            { code: "+353", name: "Ireland", short: "IE" },
            { code: "+54", name: "Argentina", short: "AR" },
            { code: "+56", name: "Chile", short: "CL" },
            { code: "+57", name: "Colombia", short: "CO" },
            { code: "+51", name: "Peru", short: "PE" },
            { code: "+20", name: "Egypt", short: "EG" },
            { code: "+254", name: "Kenya", short: "KE" },
            { code: "+234", name: "Nigeria", short: "NG" },
            { code: "+212", name: "Morocco", short: "MA" },
            { code: "+966", name: "Saudi Arabia", short: "SA" },
            { code: "+974", name: "Qatar", short: "QA" },
            { code: "+965", name: "Kuwait", short: "KW" },
            { code: "+973", name: "Bahrain", short: "BH" },
            { code: "+968", name: "Oman", short: "OM" },
            { code: "+32", name: "Belgium", short: "BE" },
            { code: "+43", name: "Austria", short: "AT" },
            { code: "+45", name: "Denmark", short: "DK" },
            { code: "+47", name: "Norway", short: "NO" },
            { code: "+358", name: "Finland", short: "FI" },
            { code: "+48", name: "Poland", short: "PL" },
            { code: "+351", name: "Portugal", short: "PT" },
            { code: "+30", name: "Greece", short: "GR" },
            { code: "+90", name: "Turkey", short: "TR" },
            { code: "+380", name: "Ukraine", short: "UA" },
            { code: "+40", name: "Romania", short: "RO" },
            { code: "+36", name: "Hungary", short: "HU" },
            { code: "+420", name: "Czech Republic", short: "CZ" },
            { code: "+98", name: "Iran", short: "IR" },
            { code: "+964", name: "Iraq", short: "IQ" },
            { code: "+972", name: "Israel", short: "IL" },
            { code: "+962", name: "Jordan", short: "JO" },
            { code: "+961", name: "Lebanon", short: "LB" },
            { code: "+213", name: "Algeria", short: "DZ" },
            { code: "+216", name: "Tunisia", short: "TN" },
            { code: "+233", name: "Ghana", short: "GH" },
            { code: "+225", name: "Ivory Coast", short: "CI" },
            { code: "+221", name: "Senegal", short: "SN" },
            { code: "+255", name: "Tanzania", short: "TZ" },
            { code: "+256", name: "Uganda", short: "UG" },
            { code: "+260", name: "Zambia", short: "ZM" },
            { code: "+263", name: "Zimbabwe", short: "ZW" },
            { code: "+53", name: "Cuba", short: "CU" },
            { code: "+58", name: "Venezuela", short: "VE" },
            { code: "+593", name: "Ecuador", short: "EC" },
            { code: "+591", name: "Bolivia", short: "BO" },
            { code: "+595", name: "Paraguay", short: "PY" },
            { code: "+598", name: "Uruguay", short: "UY" },
            { code: "+502", name: "Guatemala", short: "GT" },
            { code: "+504", name: "Honduras", short: "HN" },
            { code: "+503", name: "El Salvador", short: "SV" },
            { code: "+505", name: "Nicaragua", short: "NI" },
            { code: "+506", name: "Costa Rica", short: "CR" },
            { code: "+507", name: "Panama", short: "PA" },
            { code: "+886", name: "Taiwan", short: "TW" },
            { code: "+852", name: "Hong Kong", short: "HK" },
            { code: "+853", name: "Macau", short: "MO" },
            { code: "+976", name: "Mongolia", short: "MN" },
            { code: "+977", name: "Nepal", short: "NP" },
            { code: "+975", name: "Bhutan", short: "BT" },
            { code: "+960", name: "Maldives", short: "MV" },
            { code: "+93", name: "Afghanistan", short: "AF" },
            { code: "+994", name: "Azerbaijan", short: "AZ" },
            { code: "+995", name: "Georgia", short: "GE" },
            { code: "+374", name: "Armenia", short: "AM" },
            { code: "+998", name: "Uzbekistan", short: "UZ" },
            { code: "+7", name: "Kazakhstan", short: "KZ" },
            { code: "+996", name: "Kyrgyzstan", short: "KG" },
            { code: "+992", name: "Tajikistan", short: "TJ" },
            { code: "+993", name: "Turkmenistan", short: "TM" },
            { code: "+370", name: "Lithuania", short: "LT" },
            { code: "+371", name: "Latvia", short: "LV" },
            { code: "+372", name: "Estonia", short: "EE" },
            { code: "+375", name: "Belarus", short: "BY" },
            { code: "+373", name: "Moldova", short: "MD" },
            { code: "+381", name: "Serbia", short: "RS" },
            { code: "+385", name: "Croatia", short: "HR" },
            { code: "+386", name: "Slovenia", short: "SI" },
            { code: "+387", name: "Bosnia and Herzegovina", short: "BA" },
            { code: "+389", name: "North Macedonia", short: "MK" },
            { code: "+382", name: "Montenegro", short: "ME" },
            { code: "+355", name: "Albania", short: "AL" },
            { code: "+359", name: "Bulgaria", short: "BG" },
            { code: "+421", name: "Slovakia", short: "SK" },
            { code: "+356", name: "Malta", short: "MT" },
            { code: "+357", name: "Cyprus", short: "CY" },
            { code: "+354", name: "Iceland", short: "IS" },
            { code: "+352", name: "Luxembourg", short: "LU" },
            { code: "+423", name: "Liechtenstein", short: "LI" },
            { code: "+377", name: "Monaco", short: "MC" },
            { code: "+378", name: "San Marino", short: "SM" },
            { code: "+376", name: "Andorra", short: "AD" },
            { code: "+298", name: "Faroe Islands", short: "FO" },
            { code: "+299", name: "Greenland", short: "GL" }
        ];

        const countryListEl = document.getElementById('countryList');
        const searchInput = document.getElementById('countrySearch');
        const selectedCountryText = document.getElementById('selectedCountryCode');
        const countryCodeVal = document.getElementById('countryCodeVal');
        const countryDropdownMenu = document.getElementById('countryDropdownMenu');

        function renderCountries(list) {
            countryListEl.innerHTML = '';
            if (list.length === 0) {
                countryListEl.innerHTML = '<li class="text-muted p-3">No countries found</li>';
                return;
            }
            list.forEach(country => {
                const li = document.createElement('li');
                li.innerHTML = `<strong>${country.code}</strong> <span>${country.name}</span>`;
                li.onclick = () => selectCountry(country.code, country.short);
                countryListEl.appendChild(li);
            });
        }

        function toggleCountryDropdown() {
            countryDropdownMenu.classList.toggle('show');
            if (countryDropdownMenu.classList.contains('show')) {
                searchInput.focus();
                searchInput.value = '';
                renderCountries(countries);
            }
        }

        function selectCountry(code, shortName) {
            selectedCountryText.textContent = `${code} ${shortName}`;
            countryCodeVal.value = code;
            countryDropdownMenu.classList.remove('show');
        }

        searchInput.addEventListener('input', (e) => {
            const term = e.target.value.toLowerCase().replace(/\s+/g, '');
            const filtered = countries.filter(c =>
                c.name.toLowerCase().replace(/\s+/g, '').includes(term) ||
                c.code.includes(term) ||
                c.short.toLowerCase().includes(term)
            );
            renderCountries(filtered);
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.custom-dropdown-container')) {
                countryDropdownMenu.classList.remove('show');
            }
        });

        renderCountries(countries);

        function showToast(message, type = 'error') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `toast-message toast-${type}`;

            const icon = document.createElement('i');
            icon.className = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';

            const textNode = document.createTextNode(message);
            toast.appendChild(icon);
            toast.appendChild(textNode);

            container.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'fadeOut 0.3s ease-out forwards';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        const fullNameInput = document.getElementById('fullName');
        fullNameInput.addEventListener('input', function () {
            this.value = this.value.replace(/[^A-Za-z\s]/g, '');
        });

        const emailInput = document.getElementById('email');
        emailInput.addEventListener('input', function () {
            this.value = this.value.replace(/\s/g, '');
        });

        const phoneInput = document.getElementById('phone');
        phoneInput.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '');
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

        $(window).on('resize', function () {
            AOS.refresh();
        });

        async function handleSubmit(event) {
            event.preventDefault();

            const name = document.getElementById('fullName').value.trim();
            const email = document.getElementById('email').value.trim();
            const countryCode = document.getElementById('countryCodeVal').value;
            const phone = document.getElementById('phone').value.trim();
            const subject = document.getElementById('subject').value.trim();
            const message = document.getElementById('message').value.trim();

            if (!name || !email || !phone || !subject || !message) {
                showToast('Please fill in all required fields.', 'error');
                return;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                showToast('Please enter a valid email address.', 'error');
                return;
            }

            // if (phone.length !== 10) {
            //     showToast('Mobile number must be exactly 10 digits.', 'error');
            //     return;
            // }

            const fullPhoneNumber = countryCode + phone;
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
            submitBtn.disabled = true;

            try {
                const response = await fetch('{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG_II') }}/submit-contact', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        fullName: name,
                        email: email,
                        phone: fullPhoneNumber,
                        subject: subject,
                        message: message
                    })
                });

                const result = await response.json();

                if (response.ok && result.status === 'success') {
                    document.getElementById('successOverlay').classList.add('show');
                    document.getElementById('contactForm').reset();
                } else {
                    showToast(result.message || 'Please check your inputs and try again.', 'error');
                }
            } catch (error) {
                showToast('An error occurred. Please try again later.', 'error');
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        }

        function closePopup() {
            document.getElementById('successOverlay').classList.remove('show');
        }

        document.getElementById('successOverlay').addEventListener('click', function (e) {
            if (e.target === this) {
                closePopup();
            }
        });

        $(document).on('keydown', function (e) {
            if (e.key === 'Escape') {
                closePopup();
            }
        });
    </script>

@endsection