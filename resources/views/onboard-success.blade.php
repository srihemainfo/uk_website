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
    <title>Stripe Onboarding Complete | GoRide UK</title>
    <meta name="description"
        content="Your Stripe account has been successfully connected to GoRide UK. Your fleet payout account is verified and ready for operations.">

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
            --emerald-50: #ecfdf5;
            --emerald-100: #d1fae5;
            --emerald-500: #10b981;
            --emerald-600: #059669;
            --emerald-700: #047857;
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

        /* Canvas for celebratory confetti */
        #confettiCanvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 9999;
        }

        /* Background glow effect */
        .bg-glow {
            position: absolute;
            width: 700px;
            height: 700px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.09) 0%, rgba(99, 91, 255, 0.04) 45%, rgba(255, 255, 255, 0) 70%);
            top: -120px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 0;
            pointer-events: none;
        }

        /* Navigation Bar */
        .success-navbar {
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
            background: linear-gradient(90deg, #10b981 0%, #635bff 50%, #10b981 100%);
        }

        /* Animated Success Icon */
        .success-icon-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
        }

        .success-pulse-ring {
            position: absolute;
            top: -14px;
            left: -14px;
            right: -14px;
            bottom: -14px;
            border-radius: 50%;
            background: rgba(16, 185, 129, 0.14);
            animation: pulseWave 2.4s infinite cubic-bezier(0.4, 0, 0.6, 1);
        }

        .success-pulse-ring-2 {
            position: absolute;
            top: -28px;
            left: -28px;
            right: -28px;
            bottom: -28px;
            border-radius: 50%;
            background: rgba(16, 185, 129, 0.07);
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

        .success-circle {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 44px;
            position: relative;
            z-index: 2;
            box-shadow: 0 12px 28px -6px rgba(16, 185, 129, 0.45);
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

        .badge-verified {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--emerald-50);
            border: 1px solid var(--emerald-100);
            color: var(--emerald-700);
            font-size: 13.5px;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 30px;
            margin-bottom: 20px;
            letter-spacing: 0.3px;
        }

        .badge-verified .live-dot {
            width: 8px;
            height: 8px;
            background-color: var(--emerald-500);
            border-radius: 50%;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.25);
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
        .success-footer {
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

        /* Toast notifications */
        .toast-notification {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: var(--gray-900);
            color: #ffffff;
            padding: 12px 20px;
            border-radius: var(--radius-md);
            font-size: 13.5px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            z-index: 10000;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .toast-notification.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
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

    <!-- Celebratory Confetti Canvas -->
    <canvas id="confettiCanvas"></canvas>

    <!-- Background glow orb -->
    <div class="bg-glow"></div>

    <!-- Navigation Bar -->
    <nav class="success-navbar">
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
            <!-- Animated Green Checkmark Icon -->
            <div class="success-icon-wrapper">
                <div class="success-pulse-ring"></div>
                <div class="success-pulse-ring-2"></div>
                <div class="success-circle">
                    <i class="fas fa-check"></i>
                </div>
            </div>

            <div class="badge-verified">
                <span class="live-dot"></span>
                <span>Stripe Account Connected & Verified</span>
            </div>

            <h1 class="hero-title">You're All Set to Receive Payouts!</h1>
            <p class="hero-subtitle">
                Your Stripe Express merchant account is successfully linked with <strong>GoRide UK</strong>.
                Your UK bank account is verified to receive direct GBP (£) fare payouts with automated settlements.
            </p>

            <!-- Quick Partner Highlights -->
            <div class="quick-highlights-row">
                <div class="highlight-item">
                    <div class="highlight-icon-wrap">
                        <i class="fas fa-bolt-lightning text-warning"></i>
                    </div>
                    <div class="highlight-text">Direct GBP Bank Payouts</div>
                </div>

                <div class="highlight-item">
                    <div class="highlight-icon-wrap">
                        <i class="fas fa-shield-heart text-success"></i>
                    </div>
                    <div class="highlight-text">Fraud & Dispute Shield</div>
                </div>

                <div class="highlight-item">
                    <div class="highlight-icon-wrap">
                        <i class="fas fa-file-invoice text-primary"></i>
                    </div>
                    <div class="highlight-text">HMRC Ready Invoices</div>
                </div>

                <div class="highlight-item">
                    <div class="highlight-icon-wrap">
                        <i class="fas fa-headset text-danger"></i>
                    </div>
                    <div class="highlight-text">24/7 Priority Support</div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="success-footer">
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

    <!-- Toast Notification -->
    <div id="toastNotification" class="toast-notification">
        <i class="fas fa-circle-check text-emerald"></i>
        <span id="toastMessage">Success</span>
    </div>

    <!-- Confetti Script -->
    <script>
        function initConfetti() {
            const canvas = document.getElementById('confettiCanvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');

            let width = canvas.width = window.innerWidth;
            let height = canvas.height = window.innerHeight;

            window.addEventListener('resize', () => {
                width = canvas.width = window.innerWidth;
                height = canvas.height = window.innerHeight;
            });

            const colors = ['#10b981', '#059669', '#635bff', '#f59e0b', '#3b82f6', '#ec4899'];
            const particles = [];
            const particleCount = 80;

            for (let i = 0; i < particleCount; i++) {
                particles.push({
                    x: width / 2 + (Math.random() - 0.5) * 220,
                    y: height * 0.35 + (Math.random() - 0.5) * 120,
                    size: Math.random() * 8 + 4,
                    color: colors[Math.floor(Math.random() * colors.length)],
                    vx: (Math.random() - 0.5) * 12,
                    vy: (Math.random() - 1.2) * 14 - 2,
                    gravity: 0.28,
                    rotation: Math.random() * 360,
                    rotSpeed: (Math.random() - 0.5) * 10,
                    opacity: 1
                });
            }

            let animationFrame;
            let startTime = Date.now();

            function render() {
                const elapsed = Date.now() - startTime;
                ctx.clearRect(0, 0, width, height);

                let hasAlive = false;

                particles.forEach(p => {
                    p.vy += p.gravity;
                    p.x += p.vx;
                    p.y += p.vy;
                    p.rotation += p.rotSpeed;

                    if (elapsed > 2000) {
                        p.opacity -= 0.015;
                    }

                    if (p.opacity > 0) {
                        hasAlive = true;
                        ctx.save();
                        ctx.translate(p.x, p.y);
                        ctx.rotate((p.rotation * Math.PI) / 180);
                        ctx.globalAlpha = Math.max(0, p.opacity);
                        ctx.fillStyle = p.color;
                        ctx.fillRect(-p.size / 2, -p.size / 2, p.size, p.size * 0.6);
                        ctx.restore();
                    }
                });

                if (hasAlive && elapsed < 6000) {
                    animationFrame = requestAnimationFrame(render);
                } else {
                    ctx.clearRect(0, 0, width, height);
                }
            }

            render();
        }

        function showToast(msg) {
            const toast = document.getElementById('toastNotification');
            const toastMsg = document.getElementById('toastMessage');
            if (!toast || !toastMsg) return;

            toastMsg.textContent = msg;
            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        document.addEventListener('DOMContentLoaded', () => {
            initConfetti();
        });
    </script>
</body>

</html>