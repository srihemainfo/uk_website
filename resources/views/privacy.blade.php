@extends('layouts.app')

@section('content')

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

        /* ===== CONTENT SECTIONS ===== */
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
            /*font-weight: 800;*/
            margin-bottom: 16px;
            color: #fff;
        }



        .section-padding {
            padding: 60px 0;
        }


        .privacy-section {
            margin-bottom: 40px;
        }

        .privacy-section h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #000;
        }

        .privacy-section h3 {
            font-size: 18px;
            font-weight: 700;
            margin-top: 20px;
            margin-bottom: 12px;
            color: #000;
        }

        .privacy-section p {
            font-size: 16px;

            line-height: 1.8;
            margin-bottom: 12px;
        }

        .privacy-section ul,
        .privacy-section ol {
            margin-left: 20px;

            line-height: 1.8;
        }

        .privacy-section ul li,
        .privacy-section ol li {
            margin-bottom: 12px;
            font-size: 16px;
        }



        .privacy-section a {
            color: #000;
            font-weight: 600;
            text-decoration: none;
        }

        .privacy-section a:hover {
            text-decoration: underline;
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

            .page-header p {
                font-size: 16px;
            }

            .section-padding {
                padding: 40px 0;
            }

            .privacy-section h2 {
                font-size: 21px;
            }

            .privacy-section p {
                font-size: 17px;
            }

            .privacy-section ul li,
            .privacy-section ol li {
                font-size: 17px;
            }

            .privacy-section ul,
            .privacy-section ol {
                margin-left: 0px;
            }

            .footer-tagline {
                font-size: 14px;
            }

            .account-dropdown {
                width: 280px;
                right: -10px;
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

            /*.page-header h1 {*/
            /*    font-size: 24px;*/
            /*}*/

            .section-padding {
                padding: 30px 0;
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

    <!-- ===== PAGE HEADER ===== -->
    <section class="page-header">
        <div class="container">
            <h1 data-aos="fade-up" data-aos-duration="800">Privacy Policy</h1>

        </div>
    </section>

    <!-- ===== MAIN CONTENT ===== -->
    <section class="section-padding">
        <div class="container">


            <div class="privacy-section" data-aos="fade-up" data-aos-delay="100" data-aos-duration="700">
                <h2>Introduction</h2>
                <p>GoRide ("we", "our", or "us"), operated by GoRide Plus Ltd, is committed to protecting your privacy.
                    This Privacy Policy explains how we collect, use, store, and protect your personal information when
                    you use the GoRide website, mobile application, and related services ("Platform").</p>
                <p>By using the Platform, you agree to this Privacy Policy.</p>
            </div>

            <div class="privacy-section" data-aos="fade-up" data-aos-delay="150" data-aos-duration="700">
                <h2>1. Information We Collect</h2>
                <p>We may collect:</p>
                <ul>
                    <li>Name</li>
                    <li>Mobile number</li>
                    <li>Email address</li>
                    <li>Profile information</li>
                    <li>Payment information (processed securely by third-party payment providers)</li>
                    <li>Device information, IP address, browser type, and app usage</li>
                    <li>Location data (only when required for booking and trip services)</li>
                </ul>
            </div>

            <div class="privacy-section" data-aos="fade-up" data-aos-delay="200" data-aos-duration="700">
                <h2>2. How We Use Your Information</h2>
                <p>We use your information to:</p>
                <ul>
                    <li>Create and manage your account</li>
                    <li>Process bookings and payments</li>
                    <li>Connect passengers with drivers</li>
                    <li>Provide customer support</li>
                    <li>Improve our services</li>
                    <li>Prevent fraud and enhance security</li>
                    <li>Send booking updates and service notifications</li>
                    <li>Comply with legal obligations</li>
                </ul>
            </div>

            <div class="privacy-section" data-aos="fade-up" data-aos-delay="250" data-aos-duration="700">
                <h2>3. Sharing Your Information</h2>
                <p>We do not sell your personal information.</p>
                <p>We may share your information with:</p>
                <ul>
                    <li>Drivers or passengers where necessary to complete a booking</li>
                    <li>Payment providers</li>
                    <li>Technology and service partners</li>
                    <li>Government or regulatory authorities where legally required</li>
                </ul>
            </div>

            <div class="privacy-section" data-aos="fade-up" data-aos-delay="300" data-aos-duration="700">
                <h2>4. Cookies</h2>
                <p>We use cookies and similar technologies to improve your experience, remember your preferences, and
                    analyse Platform usage. You can manage cookies through your browser settings.</p>
            </div>

            <div class="privacy-section" data-aos="fade-up" data-aos-delay="350" data-aos-duration="700">
                <h2>5. Data Security</h2>
                <p>We use appropriate technical and organisational measures to protect your personal information,
                    including secure servers, encrypted communications, and restricted access.</p>
            </div>

            <div class="privacy-section" data-aos="fade-up" data-aos-delay="400" data-aos-duration="700">
                <h2>6. Your Rights</h2>
                <p>Under the UK GDPR and the Data Protection Act 2018, you may have the right to:</p>
                <ul>
                    <li>Access your personal data</li>
                    <li>Correct inaccurate information</li>
                    <li>Request deletion of your data</li>
                    <li>Object to or restrict certain processing</li>
                    <li>Withdraw consent where applicable</li>
                </ul>
                <p>To exercise your rights, please contact us using the details below.</p>
            </div>

            <div class="privacy-section" data-aos="fade-up" data-aos-delay="450" data-aos-duration="700">
                <h2>7. Third-Party Websites</h2>
                <p>Our Platform may contain links to third-party websites. We are not responsible for their privacy
                    practices or content.</p>
            </div>

            <div class="privacy-section" data-aos="fade-up" data-aos-delay="500" data-aos-duration="700">
                <h2>8. Children's Privacy</h2>
                <p>The Platform is intended for users aged 18 years or over. We do not knowingly collect personal
                    information from children.</p>
            </div>

            <div class="privacy-section" data-aos="fade-up" data-aos-delay="550" data-aos-duration="700">
                <h2>9. Changes to This Policy</h2>
                <p>We may update this Privacy Policy from time to time. Any changes will be published on this page with
                    the updated "Last Updated" date.</p>
            </div>

            <div class="privacy-section" data-aos="fade-up" data-aos-delay="600" data-aos-duration="700">
                <h2>10. Contact Us</h2>
                <p>
                    <strong>GoRide Plus Ltd</strong><br>
                    Email: <a href="mailto:support.uk@goride.run">support.uk@goride.run</a><br>
                    Phone: <a href="tel:+442083373777">+44 208 337 3777</a>
                </p>
                <p style="margin-top: 16px; font-size: 14px; color: #999;">If you have any concerns about our privacy
                    practices or how we handle your data, please don't hesitate to reach out. We're committed to
                    resolving any issues promptly and maintaining your trust in our platform.</p>
            </div>
        </div>
    </section>

   

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
    </script>

@endsection