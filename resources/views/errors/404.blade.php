@extends('layouts.app')

@section('content')
    @php
        $requestedHost = request()->header('X-Forwarded-Host', request()->getHost());
        $isUkHost = ($requestedHost === 'uk.goride.run');
        $homeUrl = $isUkHost ? 'https://uk.goride.run' : url('/uk');
        $contactUrl = $isUkHost ? 'https://uk.goride.run/contact' : url('/uk/contact');
    @endphp

    <style>
        /* Hide the default multi-column website footer on 404 page */
        body > footer,
        footer:not(.footer-classic) {
            display: none !important;
        }

        /* 100vh Single Screen View (Excluding 70px Common Header) */
        .error-stage-container {
            height: calc(100vh - 70px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: #F8FAFC;
            position: relative;
            overflow: hidden;
        }

        /* Subtle Ambient Background Details */
        .error-bg-pattern {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background-image: radial-gradient(rgba(148, 163, 184, 0.14) 1px, transparent 1px);
            background-size: 30px 30px;
            mask-image: radial-gradient(ellipse at center, black 45%, transparent 80%);
            -webkit-mask-image: radial-gradient(ellipse at center, black 45%, transparent 80%);
        }

        .error-bg-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 350px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.06) 0%, rgba(248, 250, 252, 0) 70%);
            pointer-events: none;
            z-index: 0;
        }

        /* Center Content Stage */
        .error-stage-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 24px;
            text-align: center;
            max-width: 680px;
            margin: 0 auto;
            width: 100%;
            position: relative;
            z-index: 2;
        }

        /* Animated Road & Floating Taxi */
        .error-visual-canvas {
            width: 200px;
            height: 80px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }

        .error-road-curve {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .error-road-path {
            stroke: #CBD5E1;
            stroke-width: 2.5;
            fill: none;
            stroke-dasharray: 6, 6;
            animation: err-road-flow 2s linear infinite;
        }

        .error-road-pulse {
            stroke: #F59E0B;
            stroke-width: 3;
            fill: none;
            stroke-dasharray: 20, 160;
            animation: err-pulse-flow 2.5s ease-in-out infinite;
        }

        .error-car-badge {
            width: 44px;
            height: 44px;
            background: #FFFFFF;
            border-radius: 50%;
            box-shadow: 0 6px 16px rgba(15, 23, 42, 0.08), 0 0 0 1px rgba(0, 0, 0, 0.04);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #0F172A;
            position: relative;
            z-index: 3;
            border: 2px solid #F59E0B;
            animation: err-car-float 3s ease-in-out infinite;
            transition: transform 0.2s ease-out;
        }

        /* Status Badge */
        .error-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            padding: 5px 14px;
            border-radius: 9999px;
            font-size: 12.5px;
            font-weight: 600;
            color: #64748B;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            margin-bottom: 12px;
        }

        .error-status-dot {
            width: 7px;
            height: 7px;
            background-color: #F59E0B;
            border-radius: 50%;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2);
            animation: err-blink-dot 1.8s infinite ease-in-out;
        }

        /* 404 Headline & Subtext */
        .error-code-num {
            font-family: 'Space Grotesk', 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(68px, 8vw, 88px);
            font-weight: 700;
            color: #0F172A;
            letter-spacing: -3px;
            line-height: 0.95;
            margin-bottom: 10px;
            user-select: none;
            transition: transform 0.2s ease-out;
        }

        .error-title-text {
            font-size: clamp(20px, 2.8vw, 26px);
            font-weight: 800;
            color: #0F172A;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }

        .error-desc-text {
            font-size: 14.5px;
            color: #64748B;
            max-width: 480px;
            line-height: 1.55;
            margin: 0 auto 24px;
        }

        /* Single Primary Action Button */
        .error-return-btn {
            background: #0F172A;
            color: #FFFFFF !important;
            text-decoration: none !important;
            font-size: 14.5px;
            font-weight: 700;
            padding: 13px 34px;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.16);
            transition: all 0.25s ease;
        }

        .error-return-btn:hover {
            background: #1E293B;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.24);
            color: #FFFFFF !important;
        }

        .error-return-btn i {
            font-size: 13px;
            transition: transform 0.25s ease;
        }

        .error-return-btn:hover i {
            transform: translateX(-3px);
        }

        /* Reverted Classic Minimal Footer */
        .footer-classic {
            height: 60px;
            padding: 0 36px;
            display: flex !important;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #E2E8F0;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            font-size: 13px;
            color: #64748B;
            position: relative;
            z-index: 10;
        }

        .footer-classic .footer-help {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .footer-classic .footer-help a {
            color: #64748B;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .footer-classic .footer-help a:hover {
            color: #0F172A;
        }

        .footer-classic .footer-help a i.fa-whatsapp {
            color: #25D366;
            font-size: 15px;
        }

        /* Animations */
        @keyframes err-road-flow {
            to { stroke-dashoffset: -12; }
        }

        @keyframes err-pulse-flow {
            0% { stroke-dashoffset: 180; opacity: 0.3; }
            50% { opacity: 1; }
            100% { stroke-dashoffset: 0; opacity: 0.3; }
        }

        @keyframes err-car-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }

        @keyframes err-blink-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.85); }
        }

        /* Mobile Adjustments */
        @media (max-width: 768px) {
            .error-stage-container {
                height: auto;
                min-height: calc(100vh - 65px);
            }
            .error-stage-content {
                padding: 40px 20px;
            }
            .error-code-num {
                font-size: 60px;
            }
            .error-title-text {
                font-size: 20px;
            }
            .error-return-btn {
                width: 100%;
                max-width: 280px;
                justify-content: center;
            }
            .footer-classic {
                height: auto;
                padding: 16px 20px;
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
            .footer-classic .footer-help {
                flex-wrap: wrap;
                justify-content: center;
                gap: 14px;
            }
        }
    </style>

    <div class="error-stage-container">
        <!-- Ambient Decor -->
        <div class="error-bg-pattern"></div>
        <div class="error-bg-glow"></div>

        <!-- Center Stage Content -->
        <main class="error-stage-content">
            <!-- Animated Minimalist Road & Car -->
            <div class="error-visual-canvas">
                <svg class="error-road-curve" viewBox="0 0 200 80">
                    <path d="M 10,65 Q 75,10 130,50 T 190,20" class="error-road-path"></path>
                    <path d="M 10,65 Q 75,10 130,50 T 190,20" class="error-road-pulse"></path>
                </svg>
                <div class="error-car-badge" id="errCarBadge">
                    <i class="fas fa-taxi"></i>
                </div>
            </div>

            <!-- Status Pill -->
            <div class="error-status-pill">
                <span class="error-status-dot"></span>
                <span>Page Not Found</span>
            </div>

            <!-- 404 Headline -->
            <h1 class="error-code-num" id="errCodeNum">404</h1>
            <h2 class="error-title-text">You've Taken an Unexpected Route</h2>
            <p class="error-desc-text">
                The page you are looking for doesn't exist or has been moved. Let's get you back to your journey.
            </p>

            <!-- Single Return to Booking Button -->
            <a href="{{ $homeUrl }}" class="error-return-btn">
                <i class="fas fa-arrow-left"></i>
                <span>Return to Booking</span>
            </a>
        </main>

        <!-- Reverted Minimal Classic Footer -->
        <div class="footer-classic">
            <div>
                &copy; {{ date('Y') }} Operated by Goride Plus Ltd. All rights reserved.
            </div>
            <div class="footer-help">
                <a href="https://api.whatsapp.com/send/?phone=447950323242&text=Hi%2C%20I%20need%20help%20booking%20a%20cab%20on%20GoRide.&type=phone_number&app_absent=0" target="_blank">
                    <i class="fab fa-whatsapp"></i> WhatsApp Dispatch
                </a>
                <a href="tel:+442083373777">
                    <i class="fas fa-phone"></i> +44 208 337 3777
                </a>
                <a href="{{ $contactUrl }}">
                    <i class="fas fa-envelope"></i> Support
                </a>
            </div>
        </div>
    </div>

    <!-- Mouse Parallax Interaction -->
    <script>
        document.addEventListener('mousemove', (e) => {
            const num = document.getElementById('errCodeNum');
            const car = document.getElementById('errCarBadge');
            if (!num || window.innerWidth < 768) return;

            const x = (e.clientX - window.innerWidth / 2) * 0.012;
            const y = (e.clientY - window.innerHeight / 2) * 0.012;

            num.style.transform = `translate3d(${x}px, ${y}px, 0)`;
            if (car) {
                car.style.transform = `translate3d(${x * 1.4}px, ${y * 1.4}px, 0)`;
            }
        });
    </script>
@endsection
