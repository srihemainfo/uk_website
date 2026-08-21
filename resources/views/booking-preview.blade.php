<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('partials.seo')
    <title>GoRide | Booking Confirmation Preview</title>
    <link rel="shortcut icon" href="https://www.goride.net.in/goride/img/Go-Ride-fav-icon.webp" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8f9fa;
            color: #111827;
            padding: 15px 10px;
        }

        .main-wrapper {
            max-width: 980px;
            margin: 0 auto;
        }

        .top-brand-bar {
            background: #ffffff;
            padding: 12px 20px;
            border-radius: 14px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            border: 1px solid #e5e7eb;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .top-brand-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-left: auto;
        }

        .brand-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-action-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f8fafc;
            border: 1px solid #d1d5db;
            color: #111827;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-action-icon:hover {
            background: #111827;
            color: #ffffff;
            border-color: #111827;
        }

        .badge-status-pill,
        .badge-status-confirmed,
        .badge-status-dispatched,
        .badge-status-onboarded,
        .badge-status-completed,
        .badge-status-cancelled {
            padding: 9px 23px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* Green: Confirmed & Completed */
        .badge-status-confirmed,
        .badge-status-completed {
            background: rgba(16, 185, 129, 0.12);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.25);
        }

        /* Yellow: Dispatched */
        .badge-status-dispatched {
            background: rgba(245, 158, 11, 0.15);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.35);
        }

        /* Blue: Onboarded */
        .badge-status-onboarded {
            background: rgba(37, 99, 235, 0.12);
            color: #2563eb;
            border: 1px solid rgba(37, 99, 235, 0.25);
        }

        /* Red: Cancelled */
        .badge-status-cancelled {
            background: rgba(239, 68, 68, 0.12);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.25);
        }

        .hero-meta-item {
            font-size: 14px;
            color: #4b5563;
            margin-bottom: 0;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 9px 23px;
            border-radius: 50px;
        }

        .hero-meta-item strong {
            color: #111827;
        }

        .hero-meta-item i {
            color: #f9c106;
        }

        .hero-banner-card {
            background: #ffffff;
            color: #111827;
            border-radius: 14px;
            padding: 20px 24px;
            margin-bottom: 5px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            position: relative;
        }

        .route-stacked-container {
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .route-location-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            position: relative;
        }

        .route-pin-icon {
            font-size: 18px;
            width: 20px;
            display: flex;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .route-pin-icon.pickup {
            color: #f9c106;
        }

        .route-pin-icon.dropoff {
            color: #111827;
        }

        .route-connector-line {
            width: 2px;
            height: 16px;
            border-left: 2px dotted #cbd5e1;
            margin-left: 9px;
            margin-top: 2px;
            margin-bottom: 2px;
        }

        .location-label {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            margin-bottom: 1px;
        }

        .location-address {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            line-height: 1.25;
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        .hero-security-fare-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 14px 16px;
        }

        .hero-sec-item-compact {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .hero-sec-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(249, 193, 6, 0.18);
            color: #111827;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .hero-sec-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            font-weight: 700;
        }

        .hero-sec-otp {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 2px;
            color: #111827;
            line-height: 1;
        }

        .hero-btn-track {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            background: #111827;
            color: #ffffff;
            text-decoration: none;
            border-radius: 16px;
            font-weight: 700;
            font-size: 11px;
            transition: all 0.2s ease;
        }

        .hero-btn-track:hover {
            background: #f9c106;
            color: #111827;
        }

        .pulse-dot-sm {
            width: 6px;
            height: 6px;
            background: #10b981;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: pulse-green 1.6s infinite;
            margin-right: 4px;
        }

        @keyframes pulse-green {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 6px rgba(16, 185, 129, 0);
            }

            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        .fare-amount {
            font-size: 32px;
            font-weight: 800;
            color: #111827;
            line-height: 1;
        }

        .btn-fare-info {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            padding: 0;
            color: #4b5563;
            font-size: 11px;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 22px;
            height: 22px;
            border-radius: 50%;
        }

        .btn-fare-info:hover,
        .btn-fare-info.active {
            color: white;
            background: black;
            border-color: black;
        }

        .btn-fare-info i {
            transition: transform 0.3s ease;
        }

        .btn-fare-info.active i {
            transform: rotate(180deg);
        }

        .fare-breakdown-collapse {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease, margin 0.3s ease;
            opacity: 0;
            margin-top: 0;
        }

        .fare-breakdown-collapse.show {
            max-height: 1000px;
            opacity: 1;
            margin-top: 10px;
        }

        .fare-breakdown-inner {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 10px 14px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        .fare-breakdown-header {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #111827;
            padding-bottom: 6px;
            margin-bottom: 6px;
            border-bottom: 1px dashed #e5e7eb;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .fare-breakdown-header i {
            color: #f9c106;
        }

        .fare-line-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #4b5563;
            padding: 3px 0;
        }

        .fare-line-item span {
            font-weight: 500;
        }

        .fare-line-item strong {
            color: #111827;
            font-weight: 700;
        }

        .fare-total-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            font-weight: 800;
            color: #111827;
            padding-top: 6px;
            margin-top: 4px;
            border-top: 1.5px solid #111827;
        }

        .fare-total-line strong {
            color: #059669;
        }

        .preview-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 18px 22px;
            margin-bottom: 5px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        }

        .card-heading {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #111827;
            font-weight: 800;
            padding-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-heading i {
            color: #f9c106;
        }

        .person-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 14px 16px;
            height: 100%;
        }

        .person-info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            padding-bottom: 6px;
            border-bottom: 1px dashed #e5e7eb;
            margin-bottom: 6px;
        }

        .person-info-item a {
            color: #111827;
            font-weight: 700;
            text-decoration: none;
        }

        .person-info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .person-info-item span {
            color: #6b7280;
            font-weight: 600;
        }

        .person-info-item strong {
            color: #111827;
            font-weight: 700;
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: break-word;
            word-break: break-word;
        }

        .reg-badge {
            display: inline-block;
            background: #111827;
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 5px;
        }

        .info-item-box {
            background: #f9fafb;
            border: 1px solid #f3f4f6;
            border-radius: 10px;
            padding: 6px 10px;
            height: 100%;
            transition: all 0.2s ease;
        }

        .info-item-box:hover {
            border-color: #d1d5db;
        }

        .info-label {
            font-size: 11px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .info-label i {
            color: #f9c106;
        }

        .info-value {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: break-word;
            word-break: break-word;
        }

        .note-alert-banner {
            color: #111827;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .policy-list {
            padding-left: 18px;
            margin-bottom: 0;
        }

        .policy-list li {
            margin-bottom: 4px;
            color: #374151;
            font-size: 13px;
            line-height: 1.5;
        }

        .policy-list li:last-child {
            margin-bottom: 0;
        }

        /* Gallery Modal */
        .gallery-modal {
            display: none;
            position: fixed;
            z-index: 99999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            align-items: center;
            justify-content: center;
        }

        .gallery-image {
            max-width: 90%;
            max-height: 80%;
            border-radius: 10px;
        }

        .gallery-close {
            position: absolute;
            top: 25px;
            right: 40px;
            font-size: 40px;
            color: white;
            cursor: pointer;
        }

        .gallery-prev,
        .gallery-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 30px;
            padding: 10px 18px;
            cursor: pointer;
            border-radius: 6px;
        }

        .gallery-prev {
            left: 20px;
        }

        .gallery-next {
            right: 20px;
        }

        @media (max-width: 768px) {

            .badge-status-pill,
            .badge-status-confirmed,
            .badge-status-dispatched,
            .badge-status-onboarded,
            .badge-status-completed,
            .badge-status-cancelled,
            .hero-meta-item {
                background: none;
                border: none;
            }

            .badge-status-pill,
            .badge-status-confirmed,
            .badge-status-dispatched,
            .badge-status-onboarded,
            .badge-status-completed,
            .badge-status-cancelled,
            .hero-meta-item {
                padding: 0px;
                font-size: 15px;
                margin: 5px;
            }

            body {
                padding: 10px 8px;
            }

            .top-brand-bar {
                padding: 12px 14px;
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
            }

            .brand-logo {
                order: 1;
            }

            .brand-actions {
                order: 2;
                margin-left: auto;
            }

            .top-brand-meta {
                order: 3;
                width: 100%;
                margin-left: 0;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 0px;
            }

            .hero-banner-card {
                padding: 16px 14px;
            }

            .fare-amount {
                font-size: 26px;
            }

            .preview-card {
                padding: 14px 14px;
            }
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 6mm 8mm;
            }

            body {
                background: #ffffff !important;
                padding: 0 !important;
                color: #000000 !important;
                font-size: 12px !important;
            }

            .main-wrapper {
                max-width: 100% !important;
                width: 100% !important;
                margin: 0 !important;
            }

            .btn-action-icon,
            .btn-fare-info,
            .hero-btn-track,
            .gallery-modal {
                display: none !important;
            }

            .top-brand-bar {
                margin-bottom: 4px !important;
                padding: 6px 12px !important;
                box-shadow: none !important;
                border: 1px solid #cbd5e1 !important;
            }

            .hero-banner-card {
                margin-bottom: 4px !important;
                padding: 8px 12px !important;
                box-shadow: none !important;
                border: 1px solid #cbd5e1 !important;
                page-break-inside: avoid;
                break-inside: avoid;
            }

            .preview-card {
                margin-bottom: 4px !important;
                padding: 8px 12px !important;
                box-shadow: none !important;
                border: 1px solid #cbd5e1 !important;
                page-break-inside: avoid;
                break-inside: avoid;
            }

            .card-heading {
                font-size: 11px !important;
                padding-bottom: 3px !important;
                margin-bottom: 4px !important;
            }

            .info-item-box {
                padding: 4px 6px !important;
            }

            .person-box {
                padding: 6px 8px !important;
            }

            .person-info-item {
                font-size: 11px !important;
                padding-bottom: 3px !important;
                margin-bottom: 3px !important;
            }

            .policy-list li {
                font-size: 11px !important;
                margin-bottom: 2px !important;
                line-height: 1.3 !important;
            }

            .fare-amount {
                font-size: 22px !important;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            .card-heading {
                page-break-after: avoid;
                break-after: avoid;
            }

            .fare-breakdown-collapse {
                max-height: none !important;
                opacity: 1 !important;
                display: block !important;
                margin-top: 8px !important;
            }
        }

        /* Live Tracking Overlay Modal */
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
            top: 30px;
            right: 30px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: #fff;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .track-close-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }

        .track-ride-container {
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

        .track-result-container {
            background: #fff;
            border-radius: 24px;
            padding: 30px;
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
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            color: #374151;
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

        .track-status-header h4 {
            font-size: 22px;
            font-weight: 800;
            color: #111;
            margin: 0;
        }

        .booking-details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 15px;
            background: #f9fafb;
            padding: 15px;
            border-radius: 12px;
            border: 1px solid #eee;
        }

        .booking-detail-item {
            display: flex;
            flex-direction: column;
        }

        .booking-detail-item .detail-label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .booking-detail-item .detail-value {
            font-size: 14px;
            color: #111;
            font-weight: 700;
            word-break: break-word;
        }

        .booking-detail-item .otp-value {
            color: #10b981;
            font-size: 16px;
            letter-spacing: 2px;
        }

        @media (max-width: 576px) {
            .booking-details-grid {
                grid-template-columns: 1fr;
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
            padding-right: 10px;
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

        .tracking-timeline {
            list-style: none;
            padding: 10px 0 0 15px;
            margin: 0;
            border-left: 3px solid #e5e7eb;
            position: relative;
        }

        .tracking-timeline li {
            position: relative;
            padding-left: 25px;
            margin-bottom: 30px;
            text-align: left;
        }

        .tracking-timeline li:last-child {
            margin-bottom: 0;
        }

        .tracking-timeline li::before {
            content: '';
            position: absolute;
            left: -28px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #fff;
            border: 4px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .tracking-timeline li.active::before {
            border-color: #111;
            background: #111;
            box-shadow: 0 0 0 4px rgba(17, 17, 17, 0.1);
        }

        .tracking-timeline li.completed::before {
            border-color: #10b981;
            background: #10b981;
        }

        .tracking-timeline li.cancelled::before {
            border-color: #ef4444;
            background: #ef4444;
        }

        .tracking-timeline .step-title {
            font-weight: 700;
            font-size: 16px;
            color: #9ca3af;
            display: block;
            margin-bottom: 4px;
        }

        .tracking-timeline li.active .step-title,
        .tracking-timeline li.completed .step-title {
            color: #111;
        }

        .tracking-timeline .step-desc {
            font-size: 13px;
            color: #6b7280;
        }

        .tracking-timeline li.cancelled .step-title {
            color: #ef4444;
        }

        .track-spinner {
            display: none;
            width: 24px;
            height: 24px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @media (max-width: 768px) {
            .track-content-flex {
                flex-direction: column;
                overflow-y: auto;
            }

            .track-timeline-wrapper {
                flex: none;
                height: auto;
            }

            .track-map-wrapper {
                min-height: 300px;
                flex: none;
            }

            .track-result-container {
                height: 90vh;
                padding: 20px;
                overflow-y: auto;
            }
        }
    </style>
</head>

<body>

    @php
        if (!isset($user_details) || $user_details == null) {
            $base_fare = $base_fare ?? 0;
        } else {
            if (is_string($user_details)) {
                $user_details = json_decode($user_details, true);
            }
        }

        // dd($user_details);
    @endphp

    <div class="main-wrapper">

        <!-- Vehicle Image Gallery Modal -->
        <div id="vehicleGallery" class="gallery-modal">
            <span class="gallery-close" onclick="closeVehicleGallery()">&times;</span>
            <img id="galleryImage" class="gallery-image">
            <button class="gallery-prev" onclick="changeImage(-1)">❮</button>
            <button class="gallery-next" onclick="changeImage(1)">❯</button>
        </div>

        <!-- Live Tracking Overlay Modal -->
        <div class="track-ride-overlay" id="trackRideOverlay">
            <button class="track-close-btn" onclick="toggleTrackRideOverlay(event)"><i
                    class="fa-solid fa-xmark"></i></button>

            <!-- Search Container -->
            <div class="track-ride-container" id="trackSearchContainer">
                <h3>Track Your Ride</h3>
                <p>Live status & real-time driver tracking</p>
                <div class="track-input-wrapper">
                    <i class="fa-solid fa-hashtag"></i>
                    <input type="text" id="trackBookingNumber" placeholder="e.g. GRC-12345"
                        value="{{ $job_no ?? '' }}" />
                </div>
                <button class="btn-track-submit" id="btnTrackSubmit" onclick="submitTrackRide()">
                    Track Now <i class="fa-solid fa-arrow-right ms-2"></i>
                </button>
            </div>

            <!-- Result Container -->
            <div class="track-result-container" id="trackResultContainer" style="display: none;">
                <div class="track-status-header">
                    <div class="track-header-badges">
                        <div class="booking-id-badge" id="displayBookingNo">{{ $job_no ?? '' }}</div>
                        <div class="track-header-right-actions">
                            <button type="button" class="track-refresh-btn" id="trackRefreshBtn"
                                onclick="refreshTrackingData(event)" title="Refresh tracking status"
                                aria-label="Refresh tracking">
                                <i class="fa-solid fa-rotate-right"></i>
                                <span class="refresh-text">Refresh</span>
                            </button>
                        </div>
                    </div>
                    <h4 id="displayTrackingMessage">Driver is on the way.</h4>
                    <div id="trackingBookingDetails" style="display: none;"></div>
                </div>

                <div class="track-content-flex">
                    <div class="track-timeline-wrapper">
                        <ul class="tracking-timeline" id="trackingTimeline">
                            <!-- Rendered dynamically -->
                        </ul>
                    </div>

                    <div class="track-map-wrapper" id="trackMapWrapper" style="display: none;">
                        <div id="liveTrackingMap"></div>
                    </div>

                    <div class="track-status-placeholder" id="trackStatusPlaceholder" style="display: none;">
                        <!-- Rendered dynamically -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Brand Bar -->
        <div class="top-brand-bar">
            <a href="#" class="brand-logo text-decoration-none">
                <img src="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG_II') }}/goride/img/logo-dark.png"
                    alt="GoRide Logo" style="height: 36px; width: auto;"
                    onerror="this.src='{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG_II') }}/goride/img/logo-darkk.png'">
            </a>

            <div class="top-brand-meta">
                @php
                    $statusRaw = strtolower(trim($job_status ?? 'confirmed'));
                    if (in_array($statusRaw, ['dispatched', 'dispatch'])) {
                        $statusClass = 'badge-status-dispatched';
                        $statusIcon = 'fa-car-side';
                    } elseif (in_array($statusRaw, ['onboarded', 'onboard', 'started'])) {
                        $statusClass = 'badge-status-onboarded';
                        $statusIcon = 'fa-route';
                    } elseif (in_array($statusRaw, ['completed', 'complete', 'finished'])) {
                        $statusClass = 'badge-status-completed';
                        $statusIcon = 'fa-circle-check';
                    } elseif (in_array($statusRaw, ['cancelled', 'cancel', 'canceled'])) {
                        $statusClass = 'badge-status-cancelled';
                        $statusIcon = 'fa-circle-xmark';
                    } else {
                        $statusClass = 'badge-status-confirmed';
                        $statusIcon = 'fa-circle-check';
                    }
                @endphp
                <div class="badge-status-pill {{ $statusClass }}">
                    <i class="fa-solid {{ $statusIcon }}"></i> {{ $job_status ?? 'Booking Confirmed' }}
                </div>
                <div class="hero-meta-item">
                    <i class="fa-solid fa-hashtag"></i> Booking No : <strong>{{ $job_no ?? '' }}</strong>
                </div>
            </div>
            <div class="brand-actions">
                <button onclick="shareBooking()" class="btn-action-icon d-none" title="Share Booking">
                    <i class="fa-solid fa-share-nodes"></i>
                </button>
                <a href="tel:+{{ env('SUPPORT_NO_I') }}" class="btn-action-icon" title="Call Support">
                    <i class="fa-solid fa-headset"></i>
                </a>
            </div>
        </div>

        <!-- Hero Banner Card -->
        <div class="hero-banner-card">
            <div class="row align-items-center g-3">

                <!-- Route Column -->
                <div class="col-lg-6 col-md-12">
                    <div class="route-stacked-container">
                        <div class="route-location-row">
                            <div class="route-pin-icon pickup">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="location-label">Pickup Location</div>
                                <div class="location-address">{{ $from_place ?? '' }}</div>
                            </div>
                        </div>

                        <div class="route-connector-line"></div>

                        <div class="route-location-row">
                            <div class="route-pin-icon dropoff">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="location-label">Dropoff Location</div>
                                <div class="location-address">{{ $to_place ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security & Fare Card -->
                <div class="col-lg-6 col-md-12">
                    <div class="hero-security-fare-card">

                        @php
                            $statusClean = strtolower(trim($job_status ?? ''));
                            $isJobCompletedOrCancelled = in_array($statusClean, ['completed', 'complete', 'finished', 'cancelled', 'cancel', 'canceled']);
                        @endphp

                        @if(!$isJobCompletedOrCancelled)
                        <div class="row g-2 align-items-center pb-2 mb-2 border-bottom">
                            <div class="col-6">
                                <div class="hero-sec-item-compact">
                                    <div class="hero-sec-icon">
                                        <i class="fa-solid fa-key"></i>
                                    </div>
                                    <div>
                                        <div class="hero-sec-label">Ride OTP</div>
                                        <div class="hero-sec-otp">
                                            {{ $otp ?? $job_otp ?? $user_details['otp'] ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 d-none">
                                <div class="hero-sec-item-compact justify-content-end">
                                    <div class="hero-sec-icon">
                                        <i class="fa-solid fa-location-crosshairs"></i>
                                    </div>
                                    <div>
                                        <div class="hero-sec-label">
                                            <span class="pulse-dot-sm"></span> Live Tracking
                                        </div>
                                        <a href="javascript:void(0)" onclick="openLiveTrackingModal(event)"
                                            class="hero-btn-track" title="Track Ride Live">
                                            <i class="fa-solid fa-location-dot"></i> Track
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="d-flex align-items-center justify-content-between pt-1">
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-uppercase text-secondary fw-bold"
                                    style="font-size: 11px; letter-spacing: 0.5px;">Total Fare</span>
                                <button type="button" class="btn-fare-info active" id="btnToggleFareBreakdown"
                                    onclick="toggleFareBreakdown()" title="View Fare Breakdown">
                                    <i class="fa-solid fa-circle-info"></i>
                                </button>
                            </div>
                            <div class="fare-amount">£{{ number_format((float) ($total_fare ?? 0), 2) }}</div>
                        </div>

                        <!-- Collapsible Fare Breakdown -->
                        <div class="fare-breakdown-collapse show" id="fareBreakdownCollapse">
                            <div class="fare-breakdown-inner">
                                <div class="fare-breakdown-header">
                                    <i class="fa-solid fa-receipt"></i> Fare Breakdown
                                </div>
                                <div class="fare-line-item">
                                    <span>Base Fare</span>
                                    @if(isset($isDiscount) && $isDiscount == 'yes')
                                        <span>
                                            <strong>£{{ $base_fare ?? 0 }}</strong>
                                            <span
                                                style="text-decoration: line-through; color: #9ca3af; font-size: 11px; margin-left: 4px;">£{{ $actual_base ?? 0 }}</span>
                                            <span style="display: block; font-size: 11px; color: #059669;">Saved
                                                £{{ $credit_bonus ?? 0 }} (GoRide Bonus)</span>
                                        </span>
                                    @else
                                        <strong>£{{ $base_fare ?? 0 }}</strong>
                                    @endif
                                </div>
                                <div class="fare-line-item">
                                    <span> {{ $isTax ? 'Tax with Other Charges' : 'Other Charges' }}</span>
                                    <strong>£{{ $tax ?? 0 }}</strong>
                                </div>
                                @if(isset($meet_amt) && $meet_amt > 0)
                                    <div class="fare-line-item">
                                        <span>Meet &amp; Greet</span>
                                        <strong>£{{ $meet_amt }}</strong>
                                    </div>
                                @endif
                                @if(isset($govt_levy) && $govt_levy > 0)
                                    <div class="fare-line-item">
                                        <span>Toll (Govt. Levy / Extra)</span>
                                        <strong>£{{ $govt_levy }}</strong>
                                    </div>
                                @endif
                                @if((isset($firstAmt) && (float) $firstAmt != 0) || (isset($user_details['firstAmt']) && (float) $user_details['firstAmt'] != 0))
                                    @php
                                        $firstDiscount = $firstAmt ?? $user_details['firstAmt'];
                                    @endphp
                                    <div class="fare-line-item">
                                        <span>First Booking Discount</span>
                                        <strong
                                            style="color: #059669;">-£{{ number_format((float) $firstDiscount, 2) }}</strong>
                                    </div>
                                @endif
                                <div class="fare-total-line">
                                    <span>Total Fare</span>
                                    <strong>£{{ number_format((float) ($total_fare ?? 0), 2) }}</strong>
                                </div>

                                @if(isset($isPayment) && $isPayment)
                                    <div class="fare-breakdown-header mt-2 pt-2">
                                        <i class="fa-solid fa-wallet"></i> Payment Details
                                    </div>
                                    @if(isset($deductAmt) && $deductAmt == 0)
                                        <div class="fare-line-item">
                                            <span>Paid via Online</span>
                                            <strong style="color:#059669;">£{{ $paid_amt ?? 0 }}</strong>
                                        </div>
                                    @endif
                                    @if(isset($deductAmt) && $deductAmt == 0 && (isset($wallet_amt) && ($wallet_amt != 0 && $wallet_amt != null)))
                                        <div class="fare-line-item">
                                            <span>Paid via Wallet</span>
                                            <strong style="color:#4338ca;">£{{ $wallet_amt ?? 0 }}</strong>
                                        </div>
                                    @endif
                                    <div class="fare-line-item fare-balance-item" style="font-size: 13.5px; padding-top: 5px; margin-top: 3px; border-top: 1px dashed #e5e7eb;">
                                        <span style="font-weight: 700; color: #111827;">{{ (isset($gateway) && $gateway == 'cash') ? 'Cash To Driver' : 'Balance Pay to Driver' }}</span>
                                        <strong style="color:#c2410c; font-size: 15px; font-weight: 800;">£{{ $balance_amt ?? 0 }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Passenger & Driver Details Card -->
        <div class="preview-card">
            <div class="row g-3">
                <!-- Passenger Details -->
                <div class="col-md-6">
                    <div class="person-box">
                        <div class="card-heading border-0 pb-0 mb-2">
                            <i class="fa-solid fa-user"></i> Passenger Details
                        </div>
                        <div class="person-info-item">
                            <span>Name</span>
                            <strong>{{ !empty($name) ? ucwords(strtolower($name)) : '' }}</strong>
                        </div>
                        @if(!empty($user_details['c_booked_for']) || !empty($booked_for))
                            <div class="person-info-item">
                                <span>Booked For</span>
                                <strong>{{ ucwords(strtolower($user_details['c_booked_for'] ?? $booked_for ?? '')) }}</strong>
                            </div>
                        @endif
                        <div class="person-info-item">
                            <span>Mobile Number</span>
                            <strong>
                                <a href="tel:{{ $mobile ?? '' }}">{{ $mobile ?? '' }}</a>
                            </strong>
                        </div>
                        @if(!empty($email))
                            <div class="person-info-item">
                                <span>Email</span>
                                <strong>{{ $email }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Driver Details -->
                <div class="col-md-6">
                    <div class="person-box">
                        <div class="card-heading border-0 pb-0 mb-2">
                            <i class="fa-solid fa-id-card"></i> Driver Details
                        </div>
                        @php
                            $currentStatus = strtolower(trim($job_status ?? ''));
                            $isCompletedOrCancelled = in_array($currentStatus, ['completed', 'complete', 'finished', 'cancelled', 'cancel', 'canceled']);
                            $canShowDriver = !empty($driver_name) && !$isCompletedOrCancelled && in_array($currentStatus, ['confirmed', 'assign', 'assigned', 'accept', 'accepted', 'started', 'onboarded', 'dispatched']);
                        @endphp
                        @if($canShowDriver)
                            <div class="person-info-item">
                                <span>Driver Name</span>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ !empty($driver_image) ? $driver_image : env('WEBSITE_APP_URL') . env('COUNTRY_SLUG_II') . '/goride/img/driver-dummy.png' }}"
                                        style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover;"
                                        onerror="this.src='{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG_II') }}/goride/img/driver-dummy.png'">
                                    <strong>{{ !empty($driver_name) ? ucwords(strtolower($driver_name)) : '' }}</strong>
                                </div>
                            </div>
                            @if(!empty($cab_type) || !empty($vehicle_model))
                                <div class="person-info-item">
                                    <span>Vehicle Model</span>
                                    <strong>{{ ucwords(strtolower($cab_type ?? $vehicle_model ?? '')) }}</strong>
                                </div>
                            @endif
                            @if(!empty($vehicle_number))
                                <div class="person-info-item">
                                    <span>Vehicle Number</span>
                                    <strong><span class="reg-badge">{{ $vehicle_number }}</span></strong>
                                </div>
                            @endif
                            <div class="person-info-item">
                                <span>Contact</span>
                                <div class="d-flex align-items-center gap-2">
                                    <a class="btn-call-driver" href="tel:{{ $driver_mobile ?? '' }}">
                                        {{ $driver_mobile ?? '' }}
                                    </a>
                                </div>
                            </div>
                            @if(isset($vehicle_images) && is_array($vehicle_images) && count($vehicle_images) > 0)
                                <div class="person-info-item">
                                    <span>Vehicle Photos</span>
                                    <button class="btn btn-sm btn-primary py-0 px-2" style="font-size:11px;"
                                        onclick="openVehicleGallery()">
                                        View Images
                                    </button>
                                </div>
                            @endif
                        @else
                            <div class="text-secondary py-2" style="font-size: 13px;">
                                @if($isCompletedOrCancelled)
                                    Driver details are not available for {{ strtolower($job_status ?? 'this') }} bookings.
                                @else
                                    Driver details will be assigned prior to your pickup time.
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <!-- Ride Details Card -->
        <div class="preview-card">
            <div class="card-heading">
                <i class="fa-solid fa-sliders"></i> Ride Details
            </div>
            <div class="row g-2">
                @if(isset($pickup_date))
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="info-item-box d-flex align-items-center gap-2">
                            <i class="fa-solid fa-calendar-days text-dark fs-5"></i>
                            <div>
                                <div class="info-label mb-0">Pickup Time</div>
                                <div class="info-value" style="font-size: 12px;">
                                    {{ \Carbon\Carbon::parse($pickup_date)->format('jS M Y, g:i A') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(!empty($distance))
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="info-item-box d-flex align-items-center gap-2">
                            <i class="fa-solid fa-location-arrow text-dark fs-5"></i>
                            <div>
                                <div class="info-label mb-0">Distance</div>
                                <div class="info-value">{{ $distance }} Miles</div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(!empty($cab_type))
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="info-item-box d-flex align-items-center gap-2">
                            <i class="fa-solid fa-car text-dark fs-5"></i>
                            <div>
                                <div class="info-label mb-0">Vehicle</div>
                                <div class="info-value">{{ ucwords(strtolower($cab_type)) }}</div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(!empty($user_details['c_meet_and_greet']) || (isset($meet_amt) && $meet_amt > 0))
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="info-item-box d-flex align-items-center gap-2">
                            <i class="fa-solid fa-handshake text-dark fs-5"></i>
                            <div>
                                <div class="info-label mb-0">Meet & Greet</div>
                                <div class="info-value">Included</div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(isset($pass_count) && $pass_count !== '')
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="info-item-box d-flex align-items-center gap-2">
                            <i class="fa-solid fa-users text-dark fs-5"></i>
                            <div>
                                <div class="info-label mb-0">Passengers</div>
                                <div class="info-value">{{ $pass_count }}</div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(isset($lugg_count) && $lugg_count !== '')
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="info-item-box d-flex align-items-center gap-2">
                            <i class="fa-solid fa-suitcase text-dark fs-5"></i>
                            <div>
                                <div class="info-label mb-0">Luggage</div>
                                <div class="info-value">{{ $lugg_count }}</div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(!empty($hand_lugg_count) || !empty($user_details['c_hand_lagguage']))
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="info-item-box d-flex align-items-center gap-2">
                            <i class="fa-solid fa-briefcase text-dark fs-5"></i>
                            <div>
                                <div class="info-label mb-0">Hand Luggage</div>
                                <div class="info-value">{{ $hand_lugg_count ?? $user_details['c_hand_lagguage'] }}</div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- @if(!empty($child_seat) || !empty($user_details['c_child_count']))
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="info-item-box d-flex align-items-center gap-2">
                        <i class="fa-solid fa-baby text-dark fs-5"></i>
                        <div>
                            <div class="info-label mb-0">Child Seat</div>
                            <div class="info-value">{{ $child_seat ?? $user_details['c_child_count'] }}</div>
                        </div>
                    </div>
                </div>
                @endif -->

                @php
                    $childCount = $child_seat ?? $user_details['c_child_count'] ?? 0;

                    // Format "toddler,booster" to "Toddler, Booster"
                    $childTypes = (!empty($user_details['c_child_type']) && strtolower($user_details['c_child_type']) !== 'none')
                        ? ucwords(str_replace(',', ', ', $user_details['c_child_type']))
                        : null;
                @endphp

                @if(!empty($childCount) && $childCount != '0')
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="info-item-box d-flex align-items-center gap-2">
                            <i class="fa-solid fa-baby text-dark fs-5"></i>
                            <div>
                                <div class="info-label mb-0">Child Seat</div>
                                <div class="info-value">
                                    {{ $childCount }}
                                    @if($childTypes)
                                        <span class="text-muted">({{ $childTypes }})</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(!empty($wheelchair) || !empty($user_details['c_wheelchair']))
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="info-item-box d-flex align-items-center gap-2">
                            <i class="fa-solid fa-wheelchair text-dark fs-5"></i>
                            <div>
                                <div class="info-label mb-0">Wheelchair</div>
                                <div class="info-value">{{ $wheelchair ?? $user_details['c_wheelchair'] }}</div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(isset($day) && $day)
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="info-item-box d-flex align-items-center gap-2">
                            <i class="fa-solid fa-clock text-dark fs-5"></i>
                            <div>
                                <div class="info-label mb-0">Duration</div>
                                <div class="info-value">{{ $day }}</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @php
            $keysToCheck = [
                'c_pick_after_time',
                'c_flight_number',
                'c_coming_from',
                'c_drop_address',
                'c_pick_address',
                'c_flight_arriving_time',
                'c_seaport_arrival_time',
                'c_seaport_pick_after_time',
                'c_cruise_name',
            ];

            $hasValidDetails = collect($user_details)
                ->only($keysToCheck)
                ->filter(function ($value) {
                    $val = strtolower(trim($value ?? ''));
                    return $val !== '' && $val !== 'none';
                })
                ->isNotEmpty();

            // dd($user_details);
        @endphp

        @if($hasValidDetails)
            <div class="preview-card">
                <div class="card-heading">
                    <i class="fa-solid fa-plane-arrival"></i> Pickup & Journey Information
                </div>

                <div class="row g-2">

                    {{-- ================= FLIGHT DETAILS ================= --}}
                    @if(!empty($user_details['c_flight_number']) && strtolower($user_details['c_flight_number']) !== 'none')
                        @if(!empty($user_details['c_flight_number']))
                            <div class="col-md-3 col-6">
                                <div class="info-item-box">
                                    <div class="info-label"><i class="fa-solid fa-plane"></i> Flight Number</div>
                                    <div class="info-value">{{ $user_details['c_flight_number'] }}</div>
                                </div>
                            </div>
                        @endif

                        @if(!empty($user_details['c_flight_arriving_time']))
                            <div class="col-md-3 col-6">
                                <div class="info-item-box">
                                    <div class="info-label"><i class="fa-solid fa-clock"></i> Flight Arrival Time</div>
                                    <div class="info-value">{{ $user_details['c_flight_arriving_time'] }}</div>
                                </div>
                            </div>
                        @endif

                        @if(!empty($user_details['c_pick_after_time']))
                            <div class="col-md-3 col-6">
                                <div class="info-item-box">
                                    <div class="info-label"><i class="fa-solid fa-user-clock"></i> Pickup After Landing</div>
                                    <div class="info-value">{{ $user_details['c_pick_after_time'] }} mins</div>
                                </div>
                            </div>
                        @endif

                        @if(!empty($user_details['c_coming_from']) && strtolower($user_details['c_coming_from']) !== 'none')
                            <div class="col-md-3 col-6">
                                <div class="info-item-box">
                                    <div class="info-label"><i class="fa-solid fa-earth-asia"></i> Coming From</div>
                                    <div class="info-value">{{ $user_details['c_coming_from'] }}</div>
                                </div>
                            </div>
                        @endif
                    @endif

                    {{-- ================= PICKUP & DROP ADDRESSES ================= --}}
                    @if(!empty($user_details['c_pick_address']) && strtolower($user_details['c_pick_address']) !== 'none')
                        <div class="col-md-6 col-12">
                            <div class="info-item-box">
                                <div class="info-label"><i class="fa-solid fa-location-dot"></i> Pickup Address</div>
                                <div class="info-value">{{ $user_details['c_pick_address'] }}</div>
                            </div>
                        </div>
                    @endif

                    @if(!empty($user_details['c_drop_address']) && strtolower($user_details['c_drop_address']) !== 'none')
                        <div class="col-md-6 col-12">
                            <div class="info-item-box">
                                <div class="info-label"><i class="fa-solid fa-location-pin"></i> Dropoff Address</div>
                                <div class="info-value">{{ $user_details['c_drop_address'] }}</div>
                            </div>
                        </div>
                    @endif

                    {{-- ================= SEAPORT / CRUISE DETAILS ================= --}}
                    @php
                        $cruiseName = $user_details['c_cruise_name'] ?? $user_details['c_ferry_name'] ?? null;
                    @endphp

                    @if(!empty($cruiseName) && strtolower($cruiseName) !== 'none')
                        <div class="col-md-3 col-6">
                            <div class="info-item-box">
                                <div class="info-label"><i class="fa-solid fa-ship"></i> Cruise / Ferry Name</div>
                                <div class="info-value">{{ ucwords(strtolower($cruiseName)) }}</div>
                            </div>
                        </div>

                        @if(!empty($user_details['c_seaport_arrival_time']))
                            <div class="col-md-3 col-6">
                                <div class="info-item-box">
                                    <div class="info-label"><i class="fa-solid fa-clock"></i> Docking Arrival Time</div>
                                    <div class="info-value">{{ $user_details['c_seaport_arrival_time'] }} </div>
                                </div>
                            </div>
                        @endif

                        @if(!empty($user_details['c_seaport_pick_after_time']))
                            <div class="col-md-3 col-6">
                                <div class="info-item-box">
                                    <div class="info-label"><i class="fa-solid fa-user-clock"></i> Pickup After Docking</div>
                                    <div class="info-value">{{ $user_details['c_seaport_pick_after_time'] }} mins</div>
                                </div>
                            </div>
                        @endif

                        @if(!empty($user_details['c_coming_from_port']) && strtolower($user_details['c_coming_from_port']) !== 'none')
                            <div class="col-md-3 col-6">
                                <div class="info-item-box">
                                    <div class="info-label"><i class="fa-solid fa-anchor"></i> Departure Port</div>
                                    <div class="info-value">{{ $user_details['c_coming_from_port'] }}</div>
                                </div>
                            </div>
                        @endif
                    @endif

                    {{-- ================= OTHER PASSENGER DETAILS ================= --}}
                    @if(!empty($user_details['c_is_other']) && $user_details['c_is_other'])
                        @if(!empty($user_details['c_pass_name']))
                            <div class="col-md-6 col-6">
                                <div class="info-item-box">
                                    <div class="info-label"><i class="fa-solid fa-user"></i> Passenger Name</div>
                                    <div class="info-value">{{ ucwords(strtolower($user_details['c_pass_name'])) }}</div>
                                </div>
                            </div>
                        @endif

                        @if(!empty($user_details['c_pass_mobile']))
                            <div class="col-md-6 col-6">
                                <div class="info-item-box">
                                    <div class="info-label"><i class="fa-solid fa-phone"></i> Passenger Mobile</div>
                                    <div class="info-value">{{ $user_details['c_pass_mobile'] }}</div>
                                </div>
                            </div>
                        @endif
                    @endif

                    {{-- ================= SPECIAL REQUIREMENTS & ADD-ONS ================= --}}
                    <!-- @if(!empty($user_details['c_meet_and_greet']) && $user_details['c_meet_and_greet'] == '1')
                        <div class="col-md-3 col-6">
                            <div class="info-item-box">
                                <div class="info-label"><i class="fa-solid fa-handshake"></i> Service</div>
                                <div class="info-value">Meet & Greet Included</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($user_details['c_wheel_chair']) && $user_details['c_wheel_chair'] == '1')
                        <div class="col-md-3 col-6">
                            <div class="info-item-box">
                                <div class="info-label"><i class="fa-solid fa-wheelchair"></i> Accessibility</div>
                                <div class="info-value">Wheelchair Required</div>
                            </div>
                        </div>
                        @endif -->

                    @if(!empty($user_details['c_special_require']) && strtolower($user_details['c_special_require']) !== 'none')
                        <div class="col-md-6 col-12">
                            <div class="info-item-box">
                                <div class="info-label"><i class="fa-solid fa-note-sticky"></i> Special Instructions</div>
                                <div class="info-value">{{ $user_details['c_special_require'] }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif



        <!-- Special Requirements Card -->
        @if(!empty($user_details['c_special_require']) || !empty($special_require))
            <div class="preview-card d-none">
                <div class="card-heading">
                    <i class="fa-solid fa-clipboard-list"></i> Special Requirements
                </div>
                <div class="note-alert-banner">
                    <ul class="policy-list">
                        <li>{{ $user_details['c_special_require'] ?? $special_require }}</li>
                    </ul>
                </div>
            </div>
        @endif

        <!-- Terms and Conditions Card -->
        <div class="preview-card d-none">
            <h6 class="fw-bold mb-2 text-dark">Terms and Conditions</h6>
            <ul class="policy-list">
                <li><strong>Platform Role:</strong> GoRide acts as a technology platform connecting you with
                    independent, licensed drivers. The transportation agreement is solely between you and the driver.
                </li>
                <li><strong>Fares & Payments:</strong> Final fares may vary depending on actual distance, wait times,
                    traffic conditions, and applicable tolls. You are responsible for all applicable booking charges.
                </li>
                <li><strong>Cancellations:</strong> Cancellation charges may apply depending on when the booking is
                    cancelled, in accordance with our Refund Policy.</li>
                <li><strong>Liability:</strong> GoRide provides the booking platform only and is not responsible for the
                    actions, conduct, or performance of independent drivers.</li>
            </ul>
        </div>

        <!-- Inclusions & Exclusions Card -->
        <div class="preview-card d-none">
            <h6 class="fw-bold mb-2 text-dark">Inclusions & Exclusions</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <strong class="text-dark d-block mb-1" style="font-size: 13px;">Included</strong>
                    <ul class="policy-list">
                        <li>{{ $distance ?? '360' }} miles included in the fare. Additional mileage:
                            £{{ $perKm ?? '1.50' }} per mile.</li>
                        <li>Complimentary waiting time of 30 minutes for pickup. Thereafter, £0.50 per minute applies.
                        </li>
                        <li>VAT included (where applicable).</li>
                        <li>Fuel charges included.</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <strong class="text-dark d-block mb-1" style="font-size: 13px;">Excluded</strong>
                    <ul class="policy-list">
                        <li>Parking charges will be charged at actuals.</li>
                        <li>Road tolls, Congestion Charge, and ULEZ charges (where applicable).</li>
                        <li>Any government or local authority charges, if applicable.</li>
                        <li>Additional mileage and waiting charges beyond the included limits.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Safety Guidelines Card -->
        <div class="preview-card d-none">
            <h6 class="fw-bold mb-2 text-dark">Safety Guidelines</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <strong class="text-dark d-block mb-1" style="font-size: 13px;">Before Starting the Ride</strong>
                    <ul class="policy-list">
                        <li>Verify the driver’s photo and name</li>
                        <li>Check vehicle details (number plate & model)</li>
                        <li>Cross-check ride charges shown in the app</li>
                        <li>Take odometer photo before trip starts</li>
                        <li>Share trip details with trusted contact</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <strong class="text-dark d-block mb-1" style="font-size: 13px;">After Completing the Ride</strong>
                    <ul class="policy-list">
                        <li>Take final odometer photo</li>
                        <li>Cross-check Govt. levy with receipts</li>
                        <li>Collect all your belongings</li>
                        <li>Confirm payment after verifying charges</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Support & Assistance Card -->
        <div class="preview-card">
            <h6 class="fw-bold mb-2 text-dark">Support & Assistance</h6>
            <p class="text-secondary mb-2" style="font-size: 13px; line-height: 1.5;">
                If you experience any difficulty in finding a driver or require assistance during your trip, please feel
                free to contact us via Call at <a href="tel:+{{ env('SUPPORT_NO_I') }}"
                    class="fw-bold text-dark text-decoration-underline">+{{ env('SUPPORT_NO_I') }}</a>, or email us at
                <a href="mailto:{{ env('SUPPORT_EMAIL') }}"
                    class="fw-bold text-dark text-decoration-underline">{{ env('SUPPORT_EMAIL') }}</a>.
            </p>
            <p class="text-secondary mb-2" style="font-size: 13px; line-height: 1.5;">
                We hope to see you again for your future outstation transport requirements. <strong>Have a safe and
                    pleasant journey.</strong>
            </p>
            <div class="text-dark fw-bold mb-1" style="font-size: 13px;">
                Best Regards, GoRide Team
            </div>
            <div>
                <a href="/terms" target="_blank" class="fw-bold text-dark text-decoration-underline"
                    style="font-size: 13px;">Terms &
                    Conditions</a>
            </div>
        </div>

        <div class="text-center py-2 text-secondary" style="font-size: 12px;">
            © {{ date('Y') }} GoRide • Safe • Reliable • Affordable
        </div>

    </div>

    <!-- Schema.org Structured Data -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "LocalBusiness",
      "name": "GoRide",
      "image": "https://www.goride.run/goride/img/logo-dark-2.png",
      "@@id": "https://www.goride.run/",
      "url": "https://www.goride.run/",
      "telephone": "+442083373777",
      "priceRange": "0-9999",
      "address": {
        "@@type": "PostalAddress",
        "addressCountry": "UK"
      },
      "openingHoursSpecification": {
        "@@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"
        ],
        "opens": "00:00",
        "closes": "23:59"
      }
    }
    </script>

    <script id="socketIoScript" src="{{ asset('js/socket.io.min.js') }}" data-cfasync="false"></script>
    <script>
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

        function toggleFareBreakdown() {
            const btnToggle = document.getElementById('btnToggleFareBreakdown');
            const collapseEl = document.getElementById('fareBreakdownCollapse');
            if (btnToggle && collapseEl) {
                btnToggle.classList.toggle('active');
                collapseEl.classList.toggle('show');
            }
        }

        // document.addEventListener('DOMContentLoaded', function () {
        //     const btnToggle = document.getElementById('btnToggleFareBreakdown');
        //     const collapseEl = document.getElementById('fareBreakdownCollapse');

        //     if (btnToggle && collapseEl) {
        //         btnToggle.addEventListener('click', toggleFareBreakdown);
        //     }
        // });

        function shareBooking() {
            let shareData = {
                title: "GoRide Booking Preview",
                text: "Here is my GoRide booking details.",
                url: window.location.href
            };

            if (navigator.share) {
                navigator.share(shareData)
                    .then(() => console.log("Shared successfully"))
                    .catch((err) => console.log("Share failed:", err));
            } else {
                navigator.clipboard.writeText(window.location.href);
                alert("Link copied! You can share it manually.");
            }
        }

        let vehicleImages = [
            @if(isset($vehicle_images) && is_array($vehicle_images))
                @foreach($vehicle_images as $img)
                    "{{ $img }}",
                @endforeach
            @endif
        ];

        let currentImageIndex = 0;

        function openVehicleGallery() {
            if (vehicleImages.length === 0) return;
            document.getElementById("vehicleGallery").style.display = "flex";
            showImage();
        }

        function closeVehicleGallery() {
            document.getElementById("vehicleGallery").style.display = "none";
        }

        function changeImage(step) {
            currentImageIndex += step;

            if (currentImageIndex >= vehicleImages.length) {
                currentImageIndex = 0;
            }

            if (currentImageIndex < 0) {
                currentImageIndex = vehicleImages.length - 1;
            }

            showImage();
        }

        function showImage() {
            document.getElementById("galleryImage").src = vehicleImages[currentImageIndex];
        }

        /* ================= LIVE TRACKING FUNCTIONS ================= */
        let liveTrackingSocket = null;
        let currentLiveTrackingId = null;
        let currentTrackedBookingNo = '';
        let driverMarker = null;
        let trackingMap = null;

        function toggleTrackRideOverlay(e) {
            if (e) e.preventDefault();
            const overlay = document.getElementById('trackRideOverlay');
            if (overlay.classList.contains('show')) {
                overlay.classList.remove('show');
                document.body.style.overflow = '';
                setTimeout(() => {
                    document.getElementById('trackSearchContainer').style.display = 'block';
                    document.getElementById('trackResultContainer').style.display = 'none';
                    currentTrackedBookingNo = '';
                    currentLiveTrackingId = null;
                    if (liveTrackingSocket) {
                        try { liveTrackingSocket.close(); } catch (e) { }
                    }
                }, 400);
            } else {
                overlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            }
        }

        function openLiveTrackingModal(e) {
            if (e) e.preventDefault();
            const overlay = document.getElementById('trackRideOverlay');
            if (!overlay.classList.contains('show')) {
                overlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            }
            const jobNo = "{{ $job_no ?? '' }}" || document.getElementById('trackBookingNumber').value.trim();
            if (jobNo) {
                document.getElementById('trackBookingNumber').value = jobNo;
                submitTrackRide(jobNo);
            }
        }

        async function submitTrackRide(jobNoOverride) {
            const num = jobNoOverride || document.getElementById('trackBookingNumber').value.trim();
            if (!num) {
                alert('Please enter a booking number');
                return;
            }

            const btn = document.getElementById('btnTrackSubmit');
            let originalHtml = '';
            if (btn) {
                originalHtml = btn.innerHTML;
                btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin me-2"></i> Tracking...';
                btn.disabled = true;
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
                } else {
                    alert(res.message || 'Booking not found');
                }
            } catch (error) {
                console.error('Tracking Error:', error);
                alert('Failed to track booking. Try again.');
            } finally {
                if (btn) {
                    btn.innerHTML = originalHtml;
                    btn.disabled = false;
                }
            }
        }

        async function refreshTrackingData(e) {
            if (e) e.preventDefault();
            const num = currentTrackedBookingNo ||
                (document.getElementById('displayBookingNo') ? document.getElementById('displayBookingNo').innerText.trim() : '') ||
                (document.getElementById('trackBookingNumber') ? document.getElementById('trackBookingNumber').value.trim() : '');

            if (!num) {
                alert('No active booking to refresh');
                return;
            }

            const refreshBtn = document.getElementById('trackRefreshBtn');
            let originalHtml = '';
            if (refreshBtn) {
                originalHtml = refreshBtn.innerHTML;
                refreshBtn.disabled = true;
                refreshBtn.classList.add('is-refreshing');
                refreshBtn.innerHTML = '<i class="fa-solid fa-rotate-right fa-spin"></i> <span class="refresh-text">Refreshing...</span>';
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
                } else {
                    alert(res.message || 'Failed to refresh tracking data');
                }
            } catch (error) {
                console.error('Refresh Tracking Error:', error);
                alert('Failed to refresh tracking. Please try again.');
            } finally {
                if (refreshBtn) {
                    refreshBtn.disabled = false;
                    refreshBtn.classList.remove('is-refreshing');
                    refreshBtn.innerHTML = originalHtml;
                }
            }
        }

        function renderTrackingResult(jobNo, data) {
            document.getElementById('trackSearchContainer').style.display = 'none';
            document.getElementById('trackResultContainer').style.display = 'flex';

            document.getElementById('displayBookingNo').innerText = jobNo;
            document.getElementById('displayTrackingMessage').innerText = data.tracking ? data.tracking.message : 'Booking details found';

            const bookingDetails = document.getElementById('trackingBookingDetails');
            if (data.booking) {
                bookingDetails.style.display = 'block';
                bookingDetails.innerHTML = `
                    <div class="booking-details-grid">
                        <div class="booking-detail-item">
                            <span class="detail-label">From</span>
                            <span class="detail-value">${data.booking.from_place || '-'}</span>
                        </div>
                        <div class="booking-detail-item">
                            <span class="detail-label">To</span>
                            <span class="detail-value">${data.booking.to_place || '-'}</span>
                        </div>
                        <div class="booking-detail-item">
                            <span class="detail-label">Pickup Time</span>
                            <span class="detail-value">${data.booking.pickup_date || '-'}</span>
                        </div>
                        ${(['onboard', 'onboarded', 'started', 'completed', 'complete', 'finished', 'cancelled', 'cancel', 'canceled'].includes((data.booking.status || data.status || '{{ strtolower($job_status ?? "") }}').toLowerCase()) || (data.timeline && (data.timeline.onboard || data.timeline.completed || data.timeline.cancelled))) ? '' : `
                        <div class="booking-detail-item">
                            <span class="detail-label">OTP</span>
                            <span class="detail-value otp-value">${data.booking.otp || '-'}</span>
                        </div>`}
                    </div>
                `;
            } else {
                bookingDetails.style.display = 'none';
                bookingDetails.innerHTML = '';
            }

            // Render Timeline
            const tl = data.timeline || {};
            const ul = document.getElementById('trackingTimeline');
            ul.innerHTML = '';

            const steps = [
                { key: 'created', title: 'Booking Created', desc: 'Your booking has been placed' },
                { key: 'confirmed', title: 'Confirmed', desc: 'Driver has accepted your ride' },
                { key: 'dispatch', title: 'Dispatched', desc: 'Driver is on the way to pickup' },
                { key: 'onboard', title: 'Onboard', desc: 'Trip has started' },
                { key: 'completed', title: 'Completed', desc: 'You have reached destination' }
            ];

            if (tl.cancelled) {
                ul.innerHTML += `<li class="cancelled"><span class="step-title">Cancelled</span><span class="step-desc">This booking was cancelled</span></li>`;
            } else {
                let lastActive = -1;
                steps.forEach((step, idx) => {
                    if (tl[step.key]) lastActive = idx;
                });

                steps.forEach((step, idx) => {
                    let liClass = '';
                    if (idx < lastActive) liClass = 'completed';
                    else if (idx === lastActive) liClass = 'active';

                    ul.innerHTML += `<li class="${liClass}">
                        <span class="step-title">${step.title}</span>
                        <span class="step-desc">${step.desc}</span>
                    </li>`;
                });
            }

            // Handle Live Tracking Map / Status Placeholder
            const mapWrap = document.getElementById('trackMapWrapper');
            const placeholderWrap = document.getElementById('trackStatusPlaceholder');

            if (data.tracking && data.tracking.live_tracking === 'yes' && data.tracking.socket_url) {
                if (mapWrap) mapWrap.style.display = 'block';
                if (placeholderWrap) placeholderWrap.style.display = 'none';
                initLiveTrackingMap();
                connectLiveTrackingSocket(data.tracking.socket_url, data.tracking.tracking_id);
            } else {
                if (mapWrap) mapWrap.style.display = 'none';
                if (placeholderWrap) {
                    placeholderWrap.style.display = 'flex';
                    renderStatusPlaceholder(data);
                }
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
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <h4 class="status-placeholder-title">Trip Completed Successfully!</h4>
                        <p class="status-placeholder-desc">
                            Thank you for riding with GoRide. We hope you enjoyed your journey!
                        </p>
                        <div class="status-info-pills">
                            <span class="status-pill-item green-badge"><i class="fa-solid fa-flag-checkered me-1"></i> Destination Reached</span>
                        </div>
                    </div>
                `;
            } else if (currentStatus === 'cancelled') {
                html = `
                    <div class="status-placeholder-card status-cancelled">
                        <div class="status-icon-wrapper red-pulse">
                            <i class="fa-solid fa-circle-xmark"></i>
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
                            <i class="fa-solid fa-route"></i>
                        </div>
                        <h4 class="status-placeholder-title">Driver En Route</h4>
                        <p class="status-placeholder-desc">
                            Your trip is in progress! Your driver is on the way to your destination.
                        </p>
                        <div class="status-info-pills">
                            <span class="status-pill-item"><i class="fa-solid fa-shield-halved me-1"></i> Driver Assigned</span>
                        </div>
                    </div>
                `;
            } else {
                html = `
                    <div class="status-placeholder-card status-preparing">
                        <div class="status-icon-wrapper yellow-pulse">
                            <i class="fa-solid fa-car-side"></i>
                        </div>
                        <h4 class="status-placeholder-title">Driver Preparing for Departure</h4>
                        <p class="status-placeholder-desc">
                            Your booking is confirmed! Your assigned driver is currently preparing for your trip. Live map tracking will be activated once the driver starts heading to your location.
                        </p>
                        <div class="status-info-pills">
                            <span class="status-pill-item"><i class="fa-solid fa-clock me-1"></i> Pickup Scheduled</span>
                            <span class="status-pill-item"><i class="fa-solid fa-circle-check me-1"></i> Booking Confirmed</span>
                        </div>
                    </div>
                `;
            }

            placeholderWrap.innerHTML = html;
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
                center: { lat: 51.5074, lng: -0.1278 },
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

                    liveTrackingSocket = io(url, {
                        transports: ['websocket', 'polling'],
                        auth: {
                            token: {!! json_encode($auth_token ?? $token ?? null) !!},
                            user_type: "customer",
                            user_id: {!! json_encode($user_details['id'] ?? $user_details['user_id'] ?? $user_id ?? null) !!},
                            platform: "{{ env('SOCKET_PLATFORM', 'development') }}"
                        }
                    });

                    liveTrackingSocket.on("connect", () => {
                        console.log('Customer connected to tracking socket');
                        liveTrackingSocket.emit("join_trip", { trip_id: trackingId });
                    });

                    let lastPos = null;

                    liveTrackingSocket.on("driver_location", (locationData) => {
                        try {
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
                        } catch (e) { console.error('Socket message error', e); }
                    });

                    liveTrackingSocket.on("driver_arrived", () => {
                        updateLiveTrackingTimeline('onboard');
                    });

                    liveTrackingSocket.on("trip_completed", () => {
                        updateLiveTrackingTimeline('completed');
                        liveTrackingSocket.emit("leave_trip", { trip_id: trackingId });
                        setTimeout(() => toggleTrackRideOverlay(), 3000);
                    });

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
    </script>

</body>

</html>