<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance | GoRide UK</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/webp" href="https://in.goride.uk/goride/img/Go-Ride-fav-icon.webp">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --brand-primary: #0F172A;
            --brand-surface: #1E293B;
            --brand-accent: #F59E0B;
            --brand-accent-hover: #D97706;
            --text-primary: #0F172A;
            --text-secondary: #64748B;
            --bg-page: #F8FAFC;
            --border-color: #E2E8F0;
            --whatsapp-color: #25D366;
            --whatsapp-hover: #1EBE5B;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-page);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Top Brand Header */
        .maint-header {
            height: 70px;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            position: relative;
            z-index: 50;
        }

        .maint-logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .maint-logo img {
            height: 40px;
            max-width: 180px;
            object-fit: contain;
        }

        .header-phone-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            background: #FFFFFF;
            border: 1px solid var(--border-color);
            border-radius: 9999px;
            font-size: 13.5px;
            font-weight: 600;
            color: var(--brand-primary);
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .header-phone-badge:hover {
            border-color: var(--brand-accent);
            color: var(--brand-accent-hover);
            transform: translateY(-1px);
        }

        .header-phone-badge i {
            color: var(--brand-accent);
            font-size: 12px;
        }

        /* Ambient Background Stage */
        .maint-stage-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            background-color: var(--bg-page);
        }

        .maint-bg-pattern {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background-image: radial-gradient(rgba(148, 163, 184, 0.18) 1.2px, transparent 1.2px);
            background-size: 30px 30px;
            mask-image: radial-gradient(ellipse at center, black 40%, transparent 80%);
            -webkit-mask-image: radial-gradient(ellipse at center, black 40%, transparent 80%);
        }

        .maint-bg-glow {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 360px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.08) 0%, rgba(248, 250, 252, 0) 70%);
            pointer-events: none;
            z-index: 0;
        }

        /* Center Stage Content */
        .maint-stage-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 24px 30px;
            text-align: center;
            max-width: 640px;
            margin: 0 auto;
            width: 100%;
            position: relative;
            z-index: 2;
        }

        /* Animated Vehicle & Maintenance Badge */
        .maint-visual-wrapper {
            position: relative;
            width: 130px;
            height: 130px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
        }

        .maint-pulse-ring {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 2px dashed rgba(245, 158, 11, 0.35);
            animation: ringSpin 22s linear infinite;
        }

        .maint-pulse-ring-inner {
            position: absolute;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.16) 0%, rgba(245, 158, 11, 0.02) 70%);
            animation: pulseFade 2.4s ease-in-out infinite;
        }

        .maint-car-center {
            width: 68px;
            height: 68px;
            background: #FFFFFF;
            border-radius: 50%;
            border: 2.5px solid var(--brand-accent);
            box-shadow: 0 8px 24px rgba(245, 158, 11, 0.22), 0 2px 8px rgba(15, 23, 42, 0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: var(--brand-primary);
            position: relative;
            z-index: 3;
            animation: floatUpDown 3.5s ease-in-out infinite;
            transition: transform 0.2s ease-out;
        }

        .maint-orbit-gear {
            position: absolute;
            width: 32px;
            height: 32px;
            background: #FFFFFF;
            border: 1.5px solid #CBD5E1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            color: var(--brand-accent);
            box-shadow: 0 4px 10px rgba(15, 23, 42, 0.08);
            z-index: 4;
            top: -2px;
            right: 0px;
            animation: gearRotate 5s linear infinite;
        }

        .maint-orbit-wrench {
            position: absolute;
            width: 30px;
            height: 30px;
            background: #FFFFFF;
            border: 1.5px solid #CBD5E1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #64748B;
            box-shadow: 0 4px 10px rgba(15, 23, 42, 0.08);
            z-index: 4;
            bottom: 2px;
            left: 0px;
            animation: toolWiggle 3s ease-in-out infinite;
        }

        /* Status Badge */
        .maint-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #FFFFFF;
            border: 1px solid rgba(245, 158, 11, 0.35);
            padding: 5px 16px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 700;
            color: #92400E;
            box-shadow: 0 2px 6px rgba(245, 158, 11, 0.08);
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .maint-status-dot {
            width: 7px;
            height: 7px;
            background-color: var(--brand-accent);
            border-radius: 50%;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.25);
            animation: blinkDot 1.6s infinite ease-in-out;
        }

        /* Headline & Paragraph */
        .maint-headline {
            font-family: 'Space Grotesk', 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(28px, 4.5vw, 40px);
            font-weight: 800;
            color: var(--brand-primary);
            letter-spacing: -1px;
            line-height: 1.15;
            margin-bottom: 12px;
        }

        .maint-headline span {
            color: var(--brand-accent);
        }

        .maint-description {
            font-size: clamp(15px, 2vw, 16.5px);
            color: var(--text-secondary);
            line-height: 1.6;
            max-width: 500px;
            margin: 0 auto 30px;
        }

        /* Direct Action Buttons */
        .maint-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .btn-maint-whatsapp {
            background: var(--whatsapp-color);
            color: #FFFFFF !important;
            text-decoration: none !important;
            font-size: 14.5px;
            font-weight: 700;
            padding: 13px 26px;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            box-shadow: 0 4px 14px rgba(37, 211, 102, 0.28);
            transition: all 0.25s ease;
        }

        .btn-maint-whatsapp:hover {
            background: var(--whatsapp-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(37, 211, 102, 0.4);
        }

        .btn-maint-call {
            background: var(--brand-primary);
            color: #FFFFFF !important;
            text-decoration: none !important;
            font-size: 14.5px;
            font-weight: 700;
            padding: 13px 26px;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.16);
            transition: all 0.25s ease;
        }

        .btn-maint-call:hover {
            background: var(--brand-surface);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.24);
        }

        /* Refresh Trigger */
        .btn-refresh-status {
            background: transparent;
            border: none;
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px;
            border-radius: 9999px;
            transition: all 0.2s ease;
        }

        .btn-refresh-status:hover {
            color: var(--brand-primary);
            background: rgba(148, 163, 184, 0.14);
        }

        .spin-on-click {
            animation: gearRotate 0.8s ease-in-out;
        }

        /* Footer */
        .footer-classic {
            min-height: 60px;
            padding: 14px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--border-color);
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(10px);
            font-size: 13px;
            color: var(--text-secondary);
            position: relative;
            z-index: 10;
        }

        .footer-classic .footer-help {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        .footer-classic .footer-help a {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .footer-classic .footer-help a:hover {
            color: var(--brand-primary);
        }

        .footer-classic .footer-help a i.fa-whatsapp {
            color: var(--whatsapp-color);
            font-size: 15px;
        }

        /* Keyframes */
        @keyframes floatUpDown {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        @keyframes ringSpin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes gearRotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes toolWiggle {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-15deg); }
            75% { transform: rotate(15deg); }
        }

        @keyframes pulseFade {
            0%, 100% { transform: scale(1); opacity: 0.7; }
            50% { transform: scale(1.12); opacity: 1; }
        }

        @keyframes blinkDot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.35; transform: scale(0.85); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .maint-header {
                height: 64px;
                padding: 0 20px;
            }
            .header-phone-badge {
                padding: 6px 12px;
                font-size: 12px;
            }
            .maint-stage-content {
                padding: 30px 20px;
            }
            .maint-actions {
                flex-direction: column;
                width: 100%;
            }
            .btn-maint-whatsapp,
            .btn-maint-call {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
            .footer-classic {
                flex-direction: column;
                gap: 12px;
                padding: 16px 20px;
                text-align: center;
            }
            .footer-classic .footer-help {
                flex-wrap: wrap;
                justify-content: center;
                gap: 14px;
            }
        }
    </style>
</head>
<body>

    <!-- Top Header -->
    <header class="maint-header">
        <a href="/" class="maint-logo">
            <img id="maintLogoImg"
                 src="/goride/img/logo-darkk.png"
                 alt="GoRide UK"
                 onerror="if(this.src!=='https://in.goride.net.uk/goride/img/logo-darkk.png'){this.src='https://in.goride.net.uk/goride/img/logo-darkk.png';}else{this.src='https://www.goride.net.in/goride/img/Go-Ride-fav-icon.webp';}">
        </a>
        <div class="maint-header-actions">
            <a href="tel:+442083373777" class="header-phone-badge">
                <i class="fas fa-phone-alt"></i>
                <span>24/7 Helpline: +44 208 337 3777</span>
            </a>
        </div>
    </header>

    <div class="maint-stage-container">
        <!-- Ambient Decor -->
        <div class="maint-bg-pattern"></div>
        <div class="maint-bg-glow"></div>

        <!-- Center Stage Content -->
        <main class="maint-stage-content">
            <!-- Animated Visual -->
            <div class="maint-visual-wrapper" id="maintVisualWrapper">
                <div class="maint-pulse-ring"></div>
                <div class="maint-pulse-ring-inner"></div>

                <div class="maint-orbit-gear">
                    <i class="fas fa-cog"></i>
                </div>
                <div class="maint-orbit-wrench">
                    <i class="fas fa-wrench"></i>
                </div>

                <div class="maint-car-center" id="maintCarBadge">
                    <i class="fas fa-taxi"></i>
                </div>
            </div>

            <!-- Status Pill -->
            <div class="maint-status-pill">
                <span class="maint-status-dot"></span>
                <span>Scheduled Maintenance</span>
            </div>

            <!-- Headline & Message -->
            <h1 class="maint-headline">
                We'll Be Back <span>Shortly</span>
            </h1>
            <p class="maint-description">
                Our website is currently undergoing scheduled maintenance to improve your experience. We apologize for any inconvenience.
            </p>

            <!-- Actions: WhatsApp & Call Buttons -->
            <div class="maint-actions">
                <a href="https://api.whatsapp.com/send/?phone=447950323242&text=Hi%2C%20I%20need%20to%20book%20a%20cab%20during%20website%20maintenance.&type=phone_number&app_absent=0"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="btn-maint-whatsapp">
                    <i class="fab fa-whatsapp" style="font-size: 18px;"></i>
                    <span>WhatsApp Dispatch</span>
                </a>
                <a href="tel:+442083373777" class="btn-maint-call">
                    <i class="fas fa-phone-alt"></i>
                    <span>Call +44 208 337 3777</span>
                </a>
            </div>

            <!-- Refresh Trigger -->
            <div>
                <button type="button" class="btn-refresh-status" onclick="handleRefreshCheck(this)">
                    <i class="fas fa-sync-alt" id="refreshIcon"></i>
                    <span id="refreshLabel">Check Status</span>
                </button>
            </div>
        </main>

        <!-- Minimal Classic Footer -->
        <footer class="footer-classic">
            <div>
                &copy; <span id="copyrightYear">2026</span> Operated by Goride Plus Ltd. All rights reserved.
            </div>
            <div class="footer-help">
                <a href="https://api.whatsapp.com/send/?phone=447950323242&text=Hi%2C%20I%20need%20to%20book%20a%20cab%20during%20website%20maintenance.&type=phone_number&app_absent=0"
                   target="_blank"
                   rel="noopener noreferrer">
                    <i class="fab fa-whatsapp"></i> WhatsApp Dispatch
                </a>
                <a href="tel:+442083373777">
                    <i class="fas fa-phone"></i> +44 208 337 3777
                </a>
                <a href="mailto:support.uk@goride.run">
                    <i class="fas fa-envelope"></i> support.uk@goride.run
                </a>
            </div>
        </footer>
    </div>

    <!-- JavaScript -->
    <script>
        // Set dynamic copyright year
        (function() {
            var yearEl = document.getElementById('copyrightYear');
            if (yearEl) {
                yearEl.textContent = new Date().getFullYear();
            }
        })();

        // Interactive 3D Mouse Parallax
        document.addEventListener('mousemove', function(e) {
            if (window.innerWidth < 768) return;
            var car = document.getElementById('maintCarBadge');
            if (!car) return;

            var x = (e.clientX - window.innerWidth / 2) * 0.015;
            var y = (e.clientY - window.innerHeight / 2) * 0.015;

            car.style.transform = 'translate3d(' + (x * 1.5) + 'px, ' + (y * 1.5) + 'px, 0)';
        });

        // Status Refresh Action
        function handleRefreshCheck(button) {
            var icon = document.getElementById('refreshIcon');
            var label = document.getElementById('refreshLabel');
            if (icon) {
                icon.classList.add('spin-on-click');
            }
            if (label) {
                label.textContent = 'Checking...';
            }

            setTimeout(function() {
                window.location.reload();
            }, 800);
        }

        // Auto reload after 5 minutes
        setTimeout(function() {
            window.location.reload();
        }, 300000);
    </script>
</body>
</html>
