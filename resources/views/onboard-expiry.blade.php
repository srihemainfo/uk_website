<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $rawHost = request()->header('X-Forwarded-Host') ?: request()->getHost();
        $cleanHost = strtolower(trim(preg_replace('/:\d+$/', '', explode(',', $rawHost)[0])));
        $requestedHost = $cleanHost;

        $ukHosts = [
            'uk.goride.run',
            'www.uk.goride.run',
            'goride.run',
            'www.goride.run'
        ];
        $isUkHost = in_array($cleanHost, $ukHosts);
        $loadUkTracking = $isUkHost;
    @endphp


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onboarding Link Expired | GoRide UK</title>
    <meta name="description"
        content="Your Stripe onboarding session link has expired. Generate a new secure link to continue setting up your GoRide UK fleet payouts.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome & Bootstrap 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #000000;
            --primary-dark: #0a0f1d;
            --amber-50: #fffbeb;
            --amber-100: #fef3c7;
            --amber-500: #f59e0b;
            --amber-600: #d97706;
            --amber-700: #b45309;
            --stripe-purple: #635bff;
            --stripe-dark: #0a2540;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 18px;
            --radius-xl: 24px;
            --shadow-subtle: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
            --shadow-card: 0 16px 40px -8px rgba(0, 0, 0, 0.07), 0 0 1px 1px rgba(0, 0, 0, 0.04);
        }

        * {
            font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%);
            min-height: 100vh;
            color: var(--gray-900);
            display: flex;
            flex-direction: column;
            position: relative;
            overflow-x: hidden;
        }

        /* Background glow effect (Warm Amber & Indigo) */
        .bg-glow {
            position: absolute;
            width: 700px;
            height: 700px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.09) 0%, rgba(99, 91, 255, 0.04) 45%, rgba(255, 255, 255, 0) 70%);
            top: -120px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 0;
            pointer-events: none;
        }

        /* Navigation Bar */
        .expiry-navbar {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--gray-200);
            padding: 16px 32px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-brand-group {
            display: flex;
            align-items: center;
            gap: 16px;
            text-decoration: none;
        }

        .nav-logo-img {
            height: 40px;
            width: auto;
            object-fit: contain;
        }

        .nav-badge-pill {
            background: var(--gray-100);
            border: 1px solid var(--gray-200);
            color: var(--gray-700);
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .nav-badge-pill i {
            color: var(--stripe-purple);
        }

        .nav-help-btn {
            background: #ffffff;
            border: 1px solid var(--gray-200);
            color: var(--gray-700);
            font-size: 13.5px;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: var(--radius-md);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .nav-help-btn:hover {
            background: var(--gray-50);
            border-color: var(--gray-300);
            color: var(--primary);
            transform: translateY(-1px);
        }

        /* Main Content Wrapper */
        .main-content {
            position: relative;
            z-index: 1;
            padding: 60px 16px 70px;
            max-width: 800px;
            margin: 0 auto;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Hero Card */
        .hero-card {
            background: #ffffff;
            border-radius: var(--radius-xl);
            border: 1px solid var(--gray-200);
            box-shadow: var(--shadow-card);
            padding: 60px 48px 48px;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .hero-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #f59e0b 0%, #635bff 50%, #f59e0b 100%);
        }

        /* Animated Amber Warning/Expiry Icon */
        .expiry-icon-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
        }

        .expiry-pulse-ring {
            position: absolute;
            top: -14px;
            left: -14px;
            right: -14px;
            bottom: -14px;
            border-radius: 50%;
            background: rgba(245, 158, 11, 0.15);
            animation: pulseWave 2.4s infinite cubic-bezier(0.4, 0, 0.6, 1);
        }

        .expiry-pulse-ring-2 {
            position: absolute;
            top: -28px;
            left: -28px;
            right: -28px;
            bottom: -28px;
            border-radius: 50%;
            background: rgba(245, 158, 11, 0.08);
            animation: pulseWave 2.4s infinite 0.6s cubic-bezier(0.4, 0, 0.6, 1);
        }

        @keyframes pulseWave {
            0% {
                transform: scale(0.85);
                opacity: 0.9;
            }

            70% {
                transform: scale(1.18);
                opacity: 0;
            }

            100% {
                transform: scale(1.18);
                opacity: 0;
            }
        }

        .expiry-circle {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 42px;
            position: relative;
            z-index: 2;
            box-shadow: 0 12px 28px -6px rgba(245, 158, 11, 0.45);
            animation: scaleIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .badge-expiry {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--amber-50);
            border: 1px solid var(--amber-100);
            color: var(--amber-700);
            font-size: 13.5px;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 30px;
            margin-bottom: 20px;
            letter-spacing: 0.3px;
        }

        .badge-expiry .amber-dot {
            width: 8px;
            height: 8px;
            background-color: var(--amber-500);
            border-radius: 50%;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.25);
            animation: blink 1.6s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }

        .hero-title {
            font-size: 34px;
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: 14px;
            letter-spacing: -0.6px;
            line-height: 1.25;
        }

        .hero-subtitle {
            font-size: 16.5px;
            color: var(--gray-600);
            max-width: 640px;
            margin: 0 auto 40px;
            line-height: 1.65;
        }

        /* Quick Feature Highlight Badges */
        .quick-highlights-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            border-top: 1px solid var(--gray-100);
            padding-top: 32px;
        }

        .highlight-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 10px;
            padding: 8px 4px;
        }

        .highlight-icon-wrap {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: var(--gray-800);
        }

        .highlight-text {
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-700);
            line-height: 1.35;
        }

        /* Footer */
        .expiry-footer {
            border-top: 1px solid var(--gray-200);
            padding: 28px 0;
            text-align: center;
            font-size: 13px;
            color: var(--gray-600);
            background: #ffffff;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-bottom: 12px;
        }

        .footer-links a {
            color: var(--gray-600);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        .security-badge-group {
            display: inline-flex;
            align-items: center;
            gap: 16px;
            margin-top: 10px;
            color: var(--gray-600);
            font-size: 12px;
        }

        .security-badge-group span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* Responsive Breakpoints */
        @media (max-width: 768px) {
            .hero-card {
                padding: 44px 20px 32px;
            }

            .hero-title {
                font-size: 26px;
            }

            .hero-subtitle {
                font-size: 15px;
                margin-bottom: 28px;
            }

            .quick-highlights-row {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
                padding-top: 24px;
            }
        }
    </style>
</head>

<body>

    <!-- Background glow orb -->
    <div class="bg-glow"></div>

    <!-- Navigation Bar -->
    <nav class="expiry-navbar">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="nav-brand-group">
                <img src="{{ asset('goride/img/logo-darkk.png') }}" alt="GoRide Logo" class="nav-logo-img"
                    onerror="this.onerror=null; this.src='https://www.goride.net.in/goride/img/logo-dark.png';">
                <span class="nav-badge-pill d-none d-sm-inline-flex">
                    <i class="fab fa-stripe"></i> Operator Connect
                </span>
            </a>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('contact') }}" class="nav-help-btn">
                    <i class="far fa-circle-question"></i>
                    <span>Need Help?</span>
                </a>
                <a href="{{ route('home') }}" class="nav-help-btn d-none d-md-inline-flex">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to GoRide</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero-card">
            <!-- Animated Amber Expiry / Hourglass Icon -->
            <div class="expiry-icon-wrapper">
                <div class="expiry-pulse-ring"></div>
                <div class="expiry-pulse-ring-2"></div>
                <div class="expiry-circle">
                    <i class="fas fa-clock-rotate-left"></i>
                </div>
            </div>

            <div class="badge-expiry">
                <span class="amber-dot"></span>
                <span>Onboarding Session Expired</span>
            </div>

            <h1 class="hero-title">Your Onboarding Link Has Expired</h1>
            <p class="hero-subtitle">
                For security reasons, Stripe verification links expire after a short period of inactivity. Don't worry —
                your progress is securely saved. You can request a fresh link through your fleet portal to continue
                setting up your payouts.
            </p>

            <!-- Quick Partner Highlights -->
            <div class="quick-highlights-row">
                <div class="highlight-item">
                    <div class="highlight-icon-wrap">
                        <i class="fas fa-shield-halved text-success"></i>
                    </div>
                    <div class="highlight-text">Progress Securely Saved</div>
                </div>

                <div class="highlight-item">
                    <div class="highlight-icon-wrap">
                        <i class="fas fa-bolt-lightning text-warning"></i>
                    </div>
                    <div class="highlight-text">Instant Link Renewal</div>
                </div>

                <div class="highlight-item">
                    <div class="highlight-icon-wrap">
                        <i class="fas fa-lock text-primary"></i>
                    </div>
                    <div class="highlight-text">256-Bit Bank Encryption</div>
                </div>

                <div class="highlight-item">
                    <div class="highlight-icon-wrap">
                        <i class="fas fa-headset text-danger"></i>
                    </div>
                    <div class="highlight-text">24/7 Fleet Support</div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="expiry-footer">
        <div class="container">
            <div class="footer-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('about') }}">About GoRide</a>
                <a href="{{ route('terms') }}">Terms & Conditions</a>
                <a href="{{ route('privacy') }}">Privacy Policy</a>
                <a href="{{ route('contact') }}">Support</a>
            </div>
            <p class="mb-1">&copy; {{ date('Y') }} GoRide UK Ltd. All rights reserved.</p>
            <div class="security-badge-group">
                <span><i class="fab fa-stripe text-primary"></i> Powered by Stripe</span>
                <span>•</span>
                <span><i class="fas fa-lock text-success"></i> 256-Bit SSL Encrypted</span>
                <span>•</span>
                <span><i class="fas fa-shield-alt text-info"></i> Transport for London & UK Council Ready</span>
            </div>
        </div>
    </footer>
</body>

</html>