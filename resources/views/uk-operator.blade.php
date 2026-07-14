<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>About Us - GoRide </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="https://www.goride.net.in/goride/img/Go-Ride-fav-icon.webp" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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

        /* NAVBAR */
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
            color: black;
            margin-right: auto;
            cursor: pointer;
            text-decoration: none;
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

        /* PAGE HEADER */
        .page-header {
            position: relative;
            background: url("/goride/img/main-banner.webp") center center/cover no-repeat;
            padding: 160px 0;
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

        /* SECTION PADDING */
        .section-padding {
            padding: 60px 0;
        }

        .section-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #000;
        }

        /* FORM STYLES */
        .operator-form-container {
            background: #f9f9f9;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .form-section {
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 1px solid #e5e5e5;
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .form-section-title {
            font-size: 22px;
            font-weight: 700;
            color: #000;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-section-icon {
            width: 35px;
            height: 35px;
            background: #000;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .form-group-operator {
            margin-bottom: 20px;
        }

        .form-group-operator label {
            display: block;
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .form-group-operator label .required {
            color: #dc3545;
            margin-left: 3px;
        }

        .form-group-operator input,
        .form-group-operator select,
        .form-group-operator textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 17px;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .form-group-operator input:focus,
        .form-group-operator select:focus,
        .form-group-operator textarea:focus {
            outline: none;
            border-color: #000;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
        }

        .form-group-operator textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-row-full {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .form-group-operator .help-text {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        /* FILE UPLOAD */
        .file-upload-wrapper {
            position: relative;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 30px;
            border: 2px dashed #ddd;
            border-radius: 8px;
            background: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-label:hover {
            border-color: #000;
            background: #f5f5f5;
        }

        .file-upload-label.drag-over {
            border-color: #000;
            background: #f0f0f0;
        }

        .file-upload-icon {
            font-size: 32px;
            color: #999;
            margin-right: 15px;
        }

        .file-upload-text h4 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .file-upload-text p {
            margin: 5px 0 0 0;
            font-size: 12px;
            color: #999;
        }

        .file-upload-input {
            display: none;
        }

        .file-upload-preview {
            margin-top: 15px;
            padding: 12px;
            background: #f0f8ff;
            border-radius: 6px;
            display: none;
        }

        .file-upload-preview.show {
            display: block;
        }

        .file-upload-preview-text {
            font-size: 13px;
            color: #0066cc;
            word-break: break-all;
        }

        .file-upload-preview-remove {
            background: none;
            border: none;
            color: #dc3545;
            cursor: pointer;
            font-size: 12px;
            margin-top: 8px;
            font-weight: 600;
        }

        /* ── CUSTOM PHONE DIAL-CODE PICKER ── */
        .phone-field {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            transition: border-color 0.3s, box-shadow 0.3s;
            position: relative;
            height: 50px;          /* same height as other inputs */
            overflow: visible;
        }

        .phone-field:focus-within {
            border-color: #000;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
        }

        .phone-field.error {
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220,53,69,0.12);
        }

        /* Flag-only trigger button */
        .dial-trigger {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 0 10px 0 12px;
            background: #f5f5f5;
            border: none;
            border-right: 1px solid #ddd;
            border-radius: 8px 0 0 8px;
            cursor: pointer;
            height: 100%;
            flex-shrink: 0;
            user-select: none;
            transition: background 0.2s;
            white-space: nowrap;
            min-width: 90px;
        }

        .dial-trigger:hover {
            background: #eaeaea;
        }

        /* Flag emoji */
        .dial-trigger .dial-flag-img {
            width: 24px;
            height: 16px;
            object-fit: cover;
            border-radius: 2px;
            display: block;
            box-shadow: 0 0 0 1px rgba(0,0,0,0.08);
        }

        /* Dial code text */
        .dial-trigger .dial-code {
            font-size: 14px;
            font-weight: 700;
            color: #222;
            letter-spacing: 0.2px;
        }

        /* Small chevron */
        .dial-trigger .dial-arrow {
            font-size: 9px;
            color: #777;
            margin-top: 1px;
            line-height: 1;
        }

        /* Phone number text input */
        .phone-field input[type="tel"] {
            flex: 1;
            border: none;
            outline: none;
            padding: 0 14px;
            font-size: 17px;
            font-family: inherit;
            background: transparent;
            color: #333;
            border-radius: 0 8px 8px 0;
            height: 100%;
            min-width: 0;
        }

        .phone-field input[type="tel"]::placeholder {
            color: #bbb;
        }

        /* Dropdown panel */
        .dial-dropdown {
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            width: 290px;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
            z-index: 9999;
            display: none;
            flex-direction: column;
            overflow: hidden;
        }

        .dial-dropdown.open {
            display: flex;
        }

        /* Search box */
        .dial-search-wrap {
            padding: 10px 10px 8px;
            border-bottom: 1px solid #f0f0f0;
        }

        .dial-search {
            width: 100%;
            padding: 8px 12px 8px 34px;
            border: 1px solid #e0e0e0;
            border-radius: 7px;
            font-size: 13px;
            background: #fafafa url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='13' height='13' viewBox='0 0 24 24' fill='none' stroke='%23aaa' stroke-width='2.5'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cline x1='21' y1='21' x2='16.65' y2='16.65'/%3E%3C/svg%3E") no-repeat 11px center;
            outline: none;
            transition: border-color 0.2s;
            font-family: inherit;
            color: #333;
        }

        .dial-search:focus {
            border-color: #000;
            background-color: #fff;
        }

        /* Country list */
        .dial-list {
            overflow-y: auto;
            max-height: 220px;
            padding: 4px 0;
        }

        .dial-list::-webkit-scrollbar { width: 4px; }
        .dial-list::-webkit-scrollbar-track { background: transparent; }
        .dial-list::-webkit-scrollbar-thumb { background: #ddd; border-radius: 4px; }

        .dial-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            cursor: pointer;
            transition: background 0.12s;
            font-size: 14px;
            color: #222;
        }

        .dial-option:hover,
        .dial-option.selected {
            background: #f5f5f5;
        }

        .dial-option .opt-flag-img {
            width: 22px;
            height: 15px;
            object-fit: cover;
            border-radius: 2px;
            flex-shrink: 0;
            box-shadow: 0 0 0 1px rgba(0,0,0,0.08);
        }

        .dial-option .opt-name {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 13.5px;
        }

        .dial-option .opt-code {
            font-weight: 700;
            color: #444;
            font-size: 13px;
            flex-shrink: 0;
            background: #f0f0f0;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .dial-divider {
            height: 1px;
            background: #f0f0f0;
            margin: 3px 0;
        }

        /* BUTTONS */
        .btn-operator {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-operator {
            background: #000;
            color: #fff;
        }

        .btn-primary-operator:hover {
            background: #222;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-secondary-operator {
            background: #f5f5f5;
            color: #000;
            border: 1px solid #ddd;
        }

        .btn-secondary-operator:hover {
            background: #eee;
        }

        .btn-group-operator {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #e5e5e5;
        }


        /* FOOTER */
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

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .navbar-menu {
                display: none;
            }

            .mobile-menu-btn {
                display: flex;
            }

            .page-header {
                padding: 90px 0;
            }

            .page-header h1 {
                font-size: 32px;
            }

            .section-title {
                font-size: 24px;
            }

            .section-padding {
                padding: 40px 0;
            }

            .operator-form-container {
                padding: 25px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-section-title {
                font-size: 18px;
            }

            .admin-table {
                font-size: 12px;
            }

            .admin-table th,
            .admin-table td {
                padding: 12px 8px;
            }
        }

        @media (max-width: 480px) {
            .navbar-uber {
                padding: 0 12px;
            }

            .navbar-brand-uber img {
                height: 40px;
            }

            .page-header h1 {
                font-size: 28px;
            }

            .section-padding {
                padding: 30px 0;
            }

            .operator-form-container {
                padding: 15px;
            }


            .form-group-operator input,
            .form-group-operator select,
            .form-group-operator textarea {
                /*font-size: 13px;*/
                padding: 10px 12px;
            }

            .btn-operator {
                padding: 10px 20px;
                font-size: 13px;
            }

            .btn-group-operator {
                flex-direction: column;
            }

            .btn-group-operator .btn-operator {
                width: 100%;
                justify-content: center;
            }
        }
        /* Enhanced UI Animations */
        .form-control-operator:focus, .form-select-operator:focus {
            box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.15);
            border-color: #198754;
            transition: all 0.3s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .is-invalid {
            border-color: #dc3545 !important;
            animation: shake 0.4s;
        }
        
        .is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.2) !important;
        }

        .btn-operator {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-operator:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .btn-operator:active:not(:disabled) {
            transform: translateY(0);
        }

    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar-uber">
        <a href="/uk-car-booking" class="navbar-brand-uber">
            <img src="https://www.goride.net.in/goride/img/logo-light.png" alt="GoRide UK Logo">
        </a>
        <ul class="navbar-menu">
            <li><button onclick="toggleDropdown('language')">
                    <i class="fas fa-globe me-2"></i>EN
                </button></li>
            <li><a href="#help">Help</a></li>
            <li style="position:relative;">
                <button class="user-btn" onclick="toggleDropdown('user')">
                    <i class="fas fa-user-circle"></i>
                    Mogana
                    <i class="fas fa-chevron-down"></i>
                </button>
            </li>
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

        <button class="mobile-menu-btn" id="mobileHamburger" onclick="toggleMobileMenu()">
            <i class="fas fa-bars"></i>
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
                <a href="/uk-car-booking"><i class="fas fa-home"></i>Home</a>
                <a href="/uk-about"><i class="fas fa-info-circle"></i>About Us</a>
                <a href="/uk-operator-registration"><i class="fas fa-briefcase"></i>Operator Registration</a>
                <a href="#"><i class="fas fa-user"></i>My Profile</a>
                <a href="#"><i class="fas fa-car"></i>My Rides</a>
                <a href="#"><i class="fas fa-map-marker-alt"></i>Saved Places</a>
                <a href="#"><i class="fas fa-wallet"></i>Wallet</a>
                <a href="#"><i class="fas fa-tag"></i>Offers</a>
                <a href="#"><i class="fas fa-language"></i>Language</a>
                <a href="/uk-terms"><i class="fas fa-file-contract"></i>Terms</a>
                <a href="/uk-privacy"><i class="fas fa-shield-alt"></i>Privacy</a>
                <a href="#"><i class="fas fa-gear"></i>Settings</a>
            </div>

            <div class="mobile-menu-footer">
                <button><i class="fas fa-right-from-bracket"></i>Logout</button>
            </div>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <section class="page-header">
        <div class="container">
            <h1>Become a GoRide Operator</h1>
        </div>
    </section>

    <!-- OPERATOR REGISTRATION FORM -->
    <section class="section-padding">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 col-12">
                    <div class="operator-form-container">
                        <form id="operatorRegistrationForm" novalidate>
                            <!-- COMPANY DETAILS SECTION -->
                            <div class="form-section">
                                <h2 class="form-section-title">
                                    <div class="form-section-icon">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    Company Details
                                </h2>

                                <div class="form-row">
                                    <div class="form-group-operator">
                                        <label for="companyName">
                                            Company Name <span class="required">*</span>
                                        </label>
                                        <input type="text" id="companyName" name="company_name"
                                            placeholder="Enter legal company name" required>
                                    </div>

                                    <div class="form-group-operator">
                                        <label for="tradingName">
                                            Trading Name <span class="required">*</span>
                                        </label>
                                        <input type="text" id="tradingName" name="trading_name"
                                            placeholder="Business trading name">
                                    </div>
                                </div>

                                <div class="form-group-operator">
                                    <label for="companyNumber">
                                        Registered Company Number <span class="required">*</span>
                                    </label>
                                    <input type="text" id="companyNumber" name="company_number"
                                        placeholder="e.g., 12345678" required>
                                    <div class="help-text">UK Companies House Registration Number</div>
                                </div>

                                <h3 style="font-size: 16px; font-weight: 600; margin: 25px 0 15px; color: #333;">Company
                                    Address</h3>

                                <div class="form-group-operator">
                                    <label for="companyStreet">
                                        Street Address <span class="required">*</span>
                                    </label>
                                    <input type="text" id="companyStreet" name="company_street"
                                        placeholder="Street address" required>
                                </div>

                                <div class="form-row">
                                    <div class="form-group-operator">
                                        <label for="companyCity">
                                            City <span class="required">*</span>
                                        </label>
                                        <input type="text" id="companyCity" name="company_city" placeholder="City"
                                            required>
                                    </div>

                                    <div class="form-group-operator">
                                        <label for="companyPostcode">
                                            Postcode <span class="required">*</span>
                                        </label>
                                        <input type="text" id="companyPostcode" name="company_postcode"
                                            placeholder="Postcode" required>
                                    </div>
                                </div>

                                <div class="form-group-operator">
                                    <label for="companyCountry">
                                        Country <span class="required">*</span>
                                    </label>
                                    <select id="companyCountry" name="company_country" required>
                                        <option value="">Select Country</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                    </select>
                                </div>
                            </div>

                            <!-- CONTACT PERSON SECTION -->
                            <div class="form-section">
                                <h2 class="form-section-title">
                                    <div class="form-section-icon">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    Contact Person
                                </h2>

                                <div class="form-row">
                                    <div class="form-group-operator">
                                        <label for="contactName">
                                            Full Name <span class="required">*</span>
                                        </label>
                                        <input type="text" id="contactName" name="contact_name"
                                            placeholder="Contact person name" required>
                                    </div>

                                    <div class="form-group-operator">
                                        <label for="contactPosition">
                                            Position <span class="required">*</span>
                                        </label>
                                        <input type="text" id="contactPosition" name="contact_position"
                                            placeholder="e.g., Director, Manager" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group-operator">
                                        <label for="contactEmail">
                                            Email Address <span class="required">*</span>
                                        </label>
                                        <input type="email" id="contactEmail" name="contact_email"
                                            placeholder="email@company.com" required>
                                    </div>

                                    <div class="form-group-operator">
                                        <label for="contactPhone">
                                            Phone Number <span class="required">*</span>
                                            <span id="verifiedBadge" style="display: none; color: #198754; font-size: 14px; margin-left: 5px;"><i class="fas fa-check-circle"></i> Verified</span>
                                        </label>
                                        <div class="phone-field" id="phoneField">
                                            <!-- Dial code trigger -->
                                            <button type="button" class="dial-trigger" id="dialTrigger"
                                                aria-haspopup="listbox" aria-expanded="false"
                                                title="Select country dial code">
                                                <img id="dialFlagImg" class="dial-flag-img"
                                                    src="https://flagcdn.com/w40/gb.png" alt="GB">
                                                <span class="dial-code" id="dialCodeLabel">+44</span>
                                                <span class="dial-arrow">▾</span>
                                            </button>

                                            <!-- Dropdown -->
                                            <div class="dial-dropdown" id="dialDropdown" role="listbox">
                                                <div class="dial-search-wrap">
                                                    <input type="text" class="dial-search" id="dialSearch" placeholder="Search country..." autocomplete="off">
                                                </div>
                                                <div class="dial-list" id="dialList"></div>
                                            </div>

                                            <!-- Hidden field for dial code -->
                                            <input type="hidden" id="dialCodeValue" name="dial_code" value="+44">

                                            <!-- Actual phone number input -->
                                            <input type="tel" id="contactPhone" name="contact_phone"
                                                placeholder="20 xxxx xxxx" required autocomplete="tel-national">
                                        </div>
                                        <button type="button" class="btn-operator btn-secondary-operator mt-3" style="width: 100%; justify-content: center; padding: 8px;" id="verifyPhoneBtn">Verify Number</button>
                                        
                                        <!-- OTP Section (Hidden by default) -->
                                        <div id="otpSection" style="display: none; margin-top: 15px; border-top: 1px solid #ddd; padding-top: 15px;">
                                            <label for="otpInput" style="font-size:14px; font-weight:600;">Enter 6-digit OTP</label>
                                            <div style="display: flex; gap: 10px; margin-top: 5px;">
                                                <input type="text" id="otpInput" maxlength="6" style="letter-spacing: 5px; font-weight: bold; font-size: 18px; text-align: center; width: 100%; border: 1px solid #ddd; border-radius: 8px; padding: 8px;">
                                                <button type="button" class="btn-operator btn-primary-operator" id="confirmOtpBtn" style="border-radius: 8px; padding: 8px 15px;">Verify</button>
                                            </div>
                                            <small id="otpMessage" style="display: none; font-weight: 600; margin-top: 8px;"></small>
                                            <input type="hidden" id="isPhoneVerified" name="is_phone_verified" value="0">
                                            <input type="hidden" id="verificationToken" name="verification_token" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- LICENSING AND COMPLIANCE SECTION -->
                            <div class="form-section">
                                <h2 class="form-section-title">
                                    <div class="form-section-icon">
                                        <i class="fas fa-certificate"></i>
                                    </div>
                                    Licensing & Compliance
                                </h2>

                                <div class="form-row">
                                    <div class="form-group-operator">
                                        <label for="licenseNumber">
                                            Operator License Number <span class="required">*</span>
                                        </label>
                                        <input type="text" id="licenseNumber" name="license_number"
                                            placeholder="License number" required>
                                        <div class="help-text">Local authority operator license number</div>
                                    </div>

                                    <div class="form-group-operator">
                                        <label for="licenseIssueAuthority">
                                            License Issue Authority <span class="required">*</span>
                                        </label>
                                        <input type="text" id="licenseIssueAuthority" name="license_issue_authority"
                                            placeholder="e.g., Transport for London" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group-operator">
                                        <label for="licenseIssueDate">
                                            License Issue Date <span class="required">*</span>
                                        </label>
                                        <input type="date" id="licenseIssueDate" name="license_issue_date" required>
                                    </div>

                                    <div class="form-group-operator">
                                        <label for="licenseExpiryDate">
                                            License Expiry Date <span class="required">*</span>
                                        </label>
                                        <input type="date" id="licenseExpiryDate" name="license_expiry_date" required>
                                    </div>
                                </div>

                                <div class="form-group-operator">
                                    <label for="licenseDocument">
                                        Upload Operator License Certificate <span class="required">*</span>
                                    </label>
                                    <div class="file-upload-wrapper">
                                        <label for="licenseDocument" class="file-upload-label" id="licenseDocLabel">
                                            <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                            <div class="file-upload-text">
                                                <h4>Click to upload or drag and drop</h4>
                                                <p>JPG, JPEG, PNG (Max 5MB)</p>
                                            </div>
                                        </label>
                                        <input type="file" id="licenseDocument" name="license_document"
                                            class="file-upload-input" accept=".jpg,.jpeg,.png" required>
                                        <div class="file-upload-preview" id="licenseDocPreview">
                                            <div class="file-upload-preview-text" id="licenseDocName"></div>
                                            <button type="button" class="file-upload-preview-remove"
                                                onclick="removeFile('licenseDocument')">Remove file</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- INSURANCE AND SAFETY SECTION -->
                            <div class="form-section">
                                <h2 class="form-section-title">
                                    <div class="form-section-icon">
                                        <i class="fas fa-shield-halved"></i>
                                    </div>
                                    Insurance & Safety
                                </h2>

                                <h3 style="font-size: 16px; font-weight: 600; margin: 0 0 15px; color: #333;">Public
                                    Liability Insurance</h3>

                                <div class="form-row">
                                    <div class="form-group-operator">
                                        <label for="publicLiabilityNumber">
                                            Policy Number <span class="required">*</span>
                                        </label>
                                        <input type="text" id="publicLiabilityNumber" name="public_liability_number"
                                            placeholder="Insurance policy number" required>
                                    </div>

                                    <div class="form-group-operator">
                                        <label for="publicLiabilityProvider">
                                            Insurance Provider <span class="required">*</span>
                                        </label>
                                        <input type="text" id="publicLiabilityProvider" name="public_liability_provider"
                                            placeholder="Insurance company name" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group-operator">
                                        <label for="publicLiabilityExpiryDate">
                                            Policy Expiry Date <span class="required">*</span>
                                        </label>
                                        <input type="date" id="publicLiabilityExpiryDate"
                                            name="public_liability_expiry_date" required>
                                    </div>

                                    <div class="form-group-operator">
                                        <label for="publicLiabilityDocument">
                                            Upload Insurance Certificate <span class="required">*</span>
                                        </label>
                                        <div style="position: relative;">
                                            <input type="file" id="publicLiabilityDocument"
                                                name="public_liability_document" class="file-upload-input"
                                                accept=".jpg,.jpeg,.png" required>
                                            <label for="publicLiabilityDocument" class="file-upload-label"
                                                id="publicLiabilityLabel">
                                                <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                                <div class="file-upload-text">
                                                    <h4>Upload Certificate</h4>
                                                    <p>JPG, JPEG, PNG</p>
                                                </div>
                                            </label>
                                            <div class="file-upload-preview" id="publicLiabilityPreview">
                                                <div class="file-upload-preview-text" id="publicLiabilityName"></div>
                                                <button type="button" class="file-upload-preview-remove"
                                                    onclick="removeFile('publicLiabilityDocument')">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h3 style="font-size: 16px; font-weight: 600; margin: 25px 0 15px; color: #333;">Vehicle
                                    Insurance (Optional)</h3>

                                <div class="form-row">
                                    <div class="form-group-operator">
                                        <label for="vehicleInsurancePolicyNumber">Policy Number</label>
                                        <input type="text" id="vehicleInsurancePolicyNumber"
                                            name="vehicle_insurance_number"
                                            placeholder="Vehicle insurance policy number">
                                    </div>

                                    <div class="form-group-operator">
                                        <label for="vehicleInsuranceProvider">Provider Name</label>
                                        <input type="text" id="vehicleInsuranceProvider"
                                            name="vehicle_insurance_provider" placeholder="Insurance provider">
                                    </div>
                                </div>

                                <div class="form-group-operator">
                                    <label for="vehicleInsuranceExpiryDate">Policy Expiry Date</label>
                                    <input type="date" id="vehicleInsuranceExpiryDate"
                                        name="vehicle_insurance_expiry_date">
                                </div>
                            </div>

                            <!-- BANKING INFORMATION SECTION -->
                            <div class="form-section">
                                <h2 class="form-section-title">
                                    <div class="form-section-icon">
                                        <i class="fas fa-bank"></i>
                                    </div>
                                    Banking Information
                                </h2>

                                <div class="form-row">
                                    <div class="form-group-operator">
                                        <label for="bankName">
                                            Bank Name <span class="required">*</span>
                                        </label>
                                        <input type="text" id="bankName" name="bank_name" placeholder="Bank name"
                                            required>
                                    </div>

                                    <div class="form-group-operator">
                                        <label for="accountName">
                                            Account Name <span class="required">*</span>
                                        </label>
                                        <input type="text" id="accountName" name="account_name"
                                            placeholder="Account holder name" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group-operator">
                                        <label for="sortCode">
                                            Sort Code <span class="required">*</span>
                                        </label>
                                        <input type="text" id="sortCode" name="sort_code" placeholder="XX-XX-XX"
                                            pattern="\d{2}-\d{2}-\d{2}" required>
                                        <div class="help-text">Format: XX-XX-XX</div>
                                    </div>

                                    <div class="form-group-operator">
                                        <label for="accountNumber">
                                            Account Number <span class="required">*</span>
                                        </label>
                                        <input type="text" id="accountNumber" name="account_number"
                                            placeholder="8-digit account number" pattern="\d{8}" required>
                                        <div class="help-text">8-digit UK account number</div>
                                    </div>
                                </div>
                            </div>

                            <!-- TERMS AND AGREEMENT -->
                            <div class="form-section form-row-full">
                                <div class="form-group-operator">
                                    <label
                                        style="display: flex; align-items: flex-start; gap: 10px; font-weight: 500; cursor: pointer;">
                                        <input type="checkbox" id="agreeTerms" name="agree_terms"
                                            style="width: 18px; height: 18px; margin-top: 3px; cursor: pointer;"
                                            required>
                                        <span>I agree to GoRide's Terms & Conditions and Privacy Policy</span>
                                    </label>
                                </div>

                                <div class="form-group-operator">
                                    <label
                                        style="display: flex; align-items: flex-start; gap: 10px; font-weight: 500; cursor: pointer;">
                                        <input type="checkbox" id="agreeNotifications" name="agree_notifications"
                                            style="width: 18px; height: 18px; margin-top: 3px; cursor: pointer;">
                                        <span>Send me updates and notifications about my operator account</span>
                                    </label>
                                </div>
                            </div>

                            <!-- ACTION BUTTONS -->
                            <div class="btn-group-operator">
                                <button type="reset" class="btn-operator btn-secondary-operator">
                                    <i class="fas fa-undo"></i>
                                    Clear Form
                                </button>
                                <button type="submit" class="btn-operator btn-primary-operator">
                                    <i class="fas fa-paper-plane"></i>
                                    Submit Registration
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-12 col-md-3">
                    <div class="footer-logo-section">
                        <div class="footer-logo">
                            <a href="/uk-car-booking">
                                <img src="https://www.goride.net.in/goride/img/logo-light.png" alt="GoRide UK Logo">
                            </a>
                        </div>
                        <p class="footer-tagline">Safe, affordable, and reliable ride booking for everyone.</p>
                    </div>

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

                <div class="col-6 col-md-2">
                    <div class="footer-section">
                        <div class="footer-section-title">Company</div>
                        <div class="footer-links-list">
                            <a href="/uk-about">About Us</a>
                            <a href="/uk-contact">Contact</a>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <div class="footer-section">
                        <div class="footer-section-title">Legal</div>
                        <div class="footer-links-list">
                            <a href="/uk-privacy">Privacy Policy</a>
                            <a href="/uk-terms">Terms & Conditions</a>
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
                                83 1st Floor, Surbiton Road, Kingston Upon Thames, KT1 2HW, United Kingdom
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

    <div id="recaptcha-container"></div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Firebase SDK Compat mode -->
    <script src="https://www.gstatic.com/firebasejs/10.7.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.7.1/firebase-auth-compat.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            offset: 50,
            easing: 'ease-out-cubic'
        });

        // Toggle dropdown functions
        function toggleDropdown(type) {
            const dropdown = document.getElementById(`${type}-dropdown`);
            dropdown.classList.toggle('show');
        }

        function selectLanguage(lang) {
            toggleDropdown('language');
        }

        function toggleMobileMenu() {
            document.getElementById("mobileMenu").classList.toggle("show");
            document.getElementById("mobileOverlay").classList.toggle("show");
            document.body.classList.toggle("menu-open");
        }

        // Close dropdowns when clicking outside
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.navbar-menu').length && !$(e.target).closest('.dropdown-menu-navbar').length) {
                $('.dropdown-menu-navbar').removeClass('show');
            }
            if (!$(e.target).closest('.user-btn').length && !$(e.target).closest('.account-dropdown').length) {
                $('.account-dropdown').removeClass('show');
            }
        });

        // FILE UPLOAD HANDLING
        function setupFileUpload(inputId, labelId, previewId, previewNameId) {
            const input = document.getElementById(inputId);
            const label = document.getElementById(labelId);
            const preview = document.getElementById(previewId);
            const previewName = document.getElementById(previewNameId);

            if (!input || !label) return;

            input.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    const maxSize = 5 * 1024 * 1024; // 5MB

                    if (file.size > maxSize) {
                        Toast.fire({ icon: 'warning', title: 'File size exceeds 5MB limit' });
                        this.value = '';
                        return;
                    }

                    if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                        Toast.fire({ icon: 'warning', title: 'Please upload a JPG, JPEG, or PNG file' });
                        this.value = '';
                        return;
                    }

                    previewName.textContent = `✓ ${file.name} (${(file.size / 1024).toFixed(2)} KB)`;
                    preview.classList.add('show');
                    label.style.opacity = '0.5';
                }
            });

            // Drag and drop
            label.addEventListener('dragover', (e) => {
                e.preventDefault();
                label.classList.add('drag-over');
            });

            label.addEventListener('dragleave', () => {
                label.classList.remove('drag-over');
            });

            label.addEventListener('drop', (e) => {
                e.preventDefault();
                label.classList.remove('drag-over');
                if (e.dataTransfer.files[0]) {
                    input.files = e.dataTransfer.files;
                    input.dispatchEvent(new Event('change'));
                }
            });
        }

        // Remove file function
        function removeFile(inputId) {
            const input = document.getElementById(inputId);
            input.value = '';
            const preview = document.getElementById(inputId + 'Preview');
            if (preview) preview.classList.remove('show');
        }

        // ── CUSTOM DIAL-CODE PICKER DATA ──
        const COUNTRIES = [
            // Preferred (shown first)
            { iso:'gb', name:'United Kingdom',    code:'+44',  preferred:true },
            { iso:'us', name:'United States',     code:'+1',   preferred:true },
            { iso:'in', name:'India',             code:'+91',  preferred:true },
            { iso:'au', name:'Australia',         code:'+61',  preferred:true },
            { iso:'ca', name:'Canada',            code:'+1',   preferred:true },
            // All countries A-Z
            { iso:'af', name:'Afghanistan',       code:'+93'  },
            { iso:'al', name:'Albania',           code:'+355' },
            { iso:'dz', name:'Algeria',           code:'+213' },
            { iso:'ad', name:'Andorra',           code:'+376' },
            { iso:'ao', name:'Angola',            code:'+244' },
            { iso:'ar', name:'Argentina',         code:'+54'  },
            { iso:'am', name:'Armenia',           code:'+374' },
            { iso:'at', name:'Austria',           code:'+43'  },
            { iso:'az', name:'Azerbaijan',        code:'+994' },
            { iso:'bh', name:'Bahrain',           code:'+973' },
            { iso:'bd', name:'Bangladesh',        code:'+880' },
            { iso:'by', name:'Belarus',           code:'+375' },
            { iso:'be', name:'Belgium',           code:'+32'  },
            { iso:'bz', name:'Belize',            code:'+501' },
            { iso:'bj', name:'Benin',             code:'+229' },
            { iso:'bt', name:'Bhutan',            code:'+975' },
            { iso:'bo', name:'Bolivia',           code:'+591' },
            { iso:'ba', name:'Bosnia',            code:'+387' },
            { iso:'bw', name:'Botswana',          code:'+267' },
            { iso:'br', name:'Brazil',            code:'+55'  },
            { iso:'bn', name:'Brunei',            code:'+673' },
            { iso:'bg', name:'Bulgaria',          code:'+359' },
            { iso:'bf', name:'Burkina Faso',      code:'+226' },
            { iso:'bi', name:'Burundi',           code:'+257' },
            { iso:'cv', name:'Cape Verde',        code:'+238' },
            { iso:'cm', name:'Cameroon',          code:'+237' },
            { iso:'cf', name:'Central African Republic', code:'+236' },
            { iso:'td', name:'Chad',              code:'+235' },
            { iso:'cl', name:'Chile',             code:'+56'  },
            { iso:'cn', name:'China',             code:'+86'  },
            { iso:'co', name:'Colombia',          code:'+57'  },
            { iso:'km', name:'Comoros',           code:'+269' },
            { iso:'cg', name:'Congo',             code:'+242' },
            { iso:'cr', name:'Costa Rica',        code:'+506' },
            { iso:'hr', name:'Croatia',           code:'+385' },
            { iso:'cu', name:'Cuba',              code:'+53'  },
            { iso:'cy', name:'Cyprus',            code:'+357' },
            { iso:'cz', name:'Czech Republic',    code:'+420' },
            { iso:'dk', name:'Denmark',           code:'+45'  },
            { iso:'dj', name:'Djibouti',          code:'+253' },
            { iso:'do', name:'Dominican Republic',code:'+1'   },
            { iso:'ec', name:'Ecuador',           code:'+593' },
            { iso:'eg', name:'Egypt',             code:'+20'  },
            { iso:'sv', name:'El Salvador',       code:'+503' },
            { iso:'gq', name:'Equatorial Guinea', code:'+240' },
            { iso:'er', name:'Eritrea',           code:'+291' },
            { iso:'ee', name:'Estonia',           code:'+372' },
            { iso:'sz', name:'Eswatini',          code:'+268' },
            { iso:'et', name:'Ethiopia',          code:'+251' },
            { iso:'fj', name:'Fiji',              code:'+679' },
            { iso:'fi', name:'Finland',           code:'+358' },
            { iso:'fr', name:'France',            code:'+33'  },
            { iso:'ga', name:'Gabon',             code:'+241' },
            { iso:'gm', name:'Gambia',            code:'+220' },
            { iso:'ge', name:'Georgia',           code:'+995' },
            { iso:'de', name:'Germany',           code:'+49'  },
            { iso:'gh', name:'Ghana',             code:'+233' },
            { iso:'gr', name:'Greece',            code:'+30'  },
            { iso:'gt', name:'Guatemala',         code:'+502' },
            { iso:'gn', name:'Guinea',            code:'+224' },
            { iso:'gy', name:'Guyana',            code:'+592' },
            { iso:'ht', name:'Haiti',             code:'+509' },
            { iso:'hn', name:'Honduras',          code:'+504' },
            { iso:'hk', name:'Hong Kong',         code:'+852' },
            { iso:'hu', name:'Hungary',           code:'+36'  },
            { iso:'is', name:'Iceland',           code:'+354' },
            { iso:'id', name:'Indonesia',         code:'+62'  },
            { iso:'ir', name:'Iran',              code:'+98'  },
            { iso:'iq', name:'Iraq',              code:'+964' },
            { iso:'ie', name:'Ireland',           code:'+353' },
            { iso:'il', name:'Israel',            code:'+972' },
            { iso:'it', name:'Italy',             code:'+39'  },
            { iso:'jm', name:'Jamaica',           code:'+1'   },
            { iso:'jp', name:'Japan',             code:'+81'  },
            { iso:'jo', name:'Jordan',            code:'+962' },
            { iso:'kz', name:'Kazakhstan',        code:'+7'   },
            { iso:'ke', name:'Kenya',             code:'+254' },
            { iso:'kw', name:'Kuwait',            code:'+965' },
            { iso:'kg', name:'Kyrgyzstan',        code:'+996' },
            { iso:'la', name:'Laos',              code:'+856' },
            { iso:'lv', name:'Latvia',            code:'+371' },
            { iso:'lb', name:'Lebanon',           code:'+961' },
            { iso:'ls', name:'Lesotho',           code:'+266' },
            { iso:'lr', name:'Liberia',           code:'+231' },
            { iso:'ly', name:'Libya',             code:'+218' },
            { iso:'li', name:'Liechtenstein',     code:'+423' },
            { iso:'lt', name:'Lithuania',         code:'+370' },
            { iso:'lu', name:'Luxembourg',        code:'+352' },
            { iso:'mo', name:'Macau',             code:'+853' },
            { iso:'mg', name:'Madagascar',        code:'+261' },
            { iso:'mw', name:'Malawi',            code:'+265' },
            { iso:'my', name:'Malaysia',          code:'+60'  },
            { iso:'mv', name:'Maldives',          code:'+960' },
            { iso:'ml', name:'Mali',              code:'+223' },
            { iso:'mt', name:'Malta',             code:'+356' },
            { iso:'mr', name:'Mauritania',        code:'+222' },
            { iso:'mu', name:'Mauritius',         code:'+230' },
            { iso:'mx', name:'Mexico',            code:'+52'  },
            { iso:'md', name:'Moldova',           code:'+373' },
            { iso:'mc', name:'Monaco',            code:'+377' },
            { iso:'mn', name:'Mongolia',          code:'+976' },
            { iso:'me', name:'Montenegro',        code:'+382' },
            { iso:'ma', name:'Morocco',           code:'+212' },
            { iso:'mz', name:'Mozambique',        code:'+258' },
            { iso:'mm', name:'Myanmar',           code:'+95'  },
            { iso:'na', name:'Namibia',           code:'+264' },
            { iso:'np', name:'Nepal',             code:'+977' },
            { iso:'nl', name:'Netherlands',       code:'+31'  },
            { iso:'nz', name:'New Zealand',       code:'+64'  },
            { iso:'ni', name:'Nicaragua',         code:'+505' },
            { iso:'ne', name:'Niger',             code:'+227' },
            { iso:'ng', name:'Nigeria',           code:'+234' },
            { iso:'mk', name:'North Macedonia',   code:'+389' },
            { iso:'no', name:'Norway',            code:'+47'  },
            { iso:'om', name:'Oman',              code:'+968' },
            { iso:'pk', name:'Pakistan',          code:'+92'  },
            { iso:'pa', name:'Panama',            code:'+507' },
            { iso:'pg', name:'Papua New Guinea',  code:'+675' },
            { iso:'py', name:'Paraguay',          code:'+595' },
            { iso:'pe', name:'Peru',              code:'+51'  },
            { iso:'ph', name:'Philippines',       code:'+63'  },
            { iso:'pl', name:'Poland',            code:'+48'  },
            { iso:'pt', name:'Portugal',          code:'+351' },
            { iso:'qa', name:'Qatar',             code:'+974' },
            { iso:'ro', name:'Romania',           code:'+40'  },
            { iso:'ru', name:'Russia',            code:'+7'   },
            { iso:'rw', name:'Rwanda',            code:'+250' },
            { iso:'sa', name:'Saudi Arabia',      code:'+966' },
            { iso:'sn', name:'Senegal',           code:'+221' },
            { iso:'rs', name:'Serbia',            code:'+381' },
            { iso:'sl', name:'Sierra Leone',      code:'+232' },
            { iso:'sg', name:'Singapore',         code:'+65'  },
            { iso:'sk', name:'Slovakia',          code:'+421' },
            { iso:'si', name:'Slovenia',          code:'+386' },
            { iso:'so', name:'Somalia',           code:'+252' },
            { iso:'za', name:'South Africa',      code:'+27'  },
            { iso:'kr', name:'South Korea',       code:'+82'  },
            { iso:'ss', name:'South Sudan',       code:'+211' },
            { iso:'es', name:'Spain',             code:'+34'  },
            { iso:'lk', name:'Sri Lanka',         code:'+94'  },
            { iso:'sd', name:'Sudan',             code:'+249' },
            { iso:'sr', name:'Suriname',          code:'+597' },
            { iso:'se', name:'Sweden',            code:'+46'  },
            { iso:'ch', name:'Switzerland',       code:'+41'  },
            { iso:'sy', name:'Syria',             code:'+963' },
            { iso:'tw', name:'Taiwan',            code:'+886' },
            { iso:'tj', name:'Tajikistan',        code:'+992' },
            { iso:'tz', name:'Tanzania',          code:'+255' },
            { iso:'th', name:'Thailand',          code:'+66'  },
            { iso:'tg', name:'Togo',              code:'+228' },
            { iso:'tt', name:'Trinidad and Tobago',code:'+1'  },
            { iso:'tn', name:'Tunisia',           code:'+216' },
            { iso:'tr', name:'Turkey',            code:'+90'  },
            { iso:'tm', name:'Turkmenistan',      code:'+993' },
            { iso:'ug', name:'Uganda',            code:'+256' },
            { iso:'ua', name:'Ukraine',           code:'+380' },
            { iso:'ae', name:'United Arab Emirates',code:'+971'},
            { iso:'uy', name:'Uruguay',           code:'+598' },
            { iso:'uz', name:'Uzbekistan',        code:'+998' },
            { iso:'ve', name:'Venezuela',         code:'+58'  },
            { iso:'vn', name:'Vietnam',           code:'+84'  },
            { iso:'ye', name:'Yemen',             code:'+967' },
            { iso:'zm', name:'Zambia',            code:'+260' },
            { iso:'zw', name:'Zimbabwe',          code:'+263' },
        ];

        // Initialize file uploads on page load
        document.addEventListener('DOMContentLoaded', function () {
            setupFileUpload('licenseDocument', 'licenseDocLabel', 'licenseDocPreview', 'licenseDocName');
            setupFileUpload('publicLiabilityDocument', 'publicLiabilityLabel', 'publicLiabilityPreview', 'publicLiabilityName');

            // ── DIAL-CODE PICKER LOGIC ──
            const trigger    = document.getElementById('dialTrigger');
            const dropdown   = document.getElementById('dialDropdown');
            const list       = document.getElementById('dialList');
            const search     = document.getElementById('dialSearch');
            const flagImgEl  = document.getElementById('dialFlagImg');
            const codeEl     = document.getElementById('dialCodeLabel');
            const hidden     = document.getElementById('dialCodeValue');

            function buildList(filter) {
                list.innerHTML = '';
                const q = (filter || '').toLowerCase();
                const preferred = COUNTRIES.filter(c => c.preferred);
                const rest      = COUNTRIES.filter(c => !c.preferred);
                const all       = q ? COUNTRIES.filter(c =>
                    c.name.toLowerCase().includes(q) || c.code.includes(q)
                ) : null;

                const flagUrl = (iso) => `https://flagcdn.com/w40/${iso}.png`;

                const render = (arr) => arr.forEach(c => {
                    const div = document.createElement('div');
                    div.className = 'dial-option';
                    div.innerHTML = `<img class="opt-flag-img" src="${flagUrl(c.iso)}" alt="${c.iso.toUpperCase()}"><span class="opt-name">${c.name}</span><span class="opt-code">${c.code}</span>`;
                    div.addEventListener('mousedown', (e) => {
                        e.preventDefault();
                        flagImgEl.src = flagUrl(c.iso);
                        flagImgEl.alt = c.iso.toUpperCase();
                        codeEl.textContent = c.code;
                        hidden.value       = c.code;
                        closeDropdown();
                    });
                    list.appendChild(div);
                });

                if (all) {
                    render(all);
                } else {
                    render(preferred);
                    const divider = document.createElement('div');
                    divider.className = 'dial-divider';
                    list.appendChild(divider);
                    render(rest);
                }
            }

            function openDropdown() {
                dropdown.classList.add('open');
                trigger.setAttribute('aria-expanded', 'true');
                search.value = '';
                buildList('');
                setTimeout(() => search.focus(), 50);
            }

            function closeDropdown() {
                dropdown.classList.remove('open');
                trigger.setAttribute('aria-expanded', 'false');
            }

            trigger.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdown.classList.contains('open') ? closeDropdown() : openDropdown();
            });

            search.addEventListener('input', () => buildList(search.value));

            // Close on outside click
            document.addEventListener('click', (e) => {
                if (!document.getElementById('phoneField').contains(e.target)) {
                    closeDropdown();
                }
            });

            buildList('');

            // ── VERIFY PHONE BTN ──
            document.getElementById('verifyPhoneBtn').addEventListener('click', function(e) {
                const dialCode = document.getElementById('dialCodeValue').value;
                const phone = document.getElementById('contactPhone').value;
                
                if (!phone) {
                    Toast.fire({ icon: 'warning', title: 'Please enter a phone number first' });
                    return;
                }
                
                const mobile = dialCode + phone;
                const verifyBtn = this;
                const originalBtnText = verifyBtn.innerHTML;
                verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending OTP...';
                verifyBtn.disabled = true;

                // 1. Send OTP Request to backend to get Firebase Config
                $.ajax({
                    url: '{{ env("API_URL") }}/operator/send-otp',
                    type: 'POST',
                    data: {
                        mobile: mobile,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status) {
                            // 2. Initialize Firebase with the config provided by the backend
                            if (!firebase.apps.length) {
                                firebase.initializeApp(response.data.firebase);
                            }
                            
                            // 3. Setup Recaptcha Verifier
                            if(!window.recaptchaVerifier) {
                                window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                                    'size': 'invisible',
                                    'callback': (response) => {
                                        // reCAPTCHA solved
                                    }
                                });
                            }

                            // 4. Trigger Firebase Phone Auth
                            const auth = firebase.auth();
                            auth.signInWithPhoneNumber(mobile, window.recaptchaVerifier)
                                .then((confirmationResult) => {
                                    window.confirmationResult = confirmationResult;
                                    
                                    // Reset button state
                                    verifyBtn.innerHTML = originalBtnText;
                                    verifyBtn.style.display = 'none'; // Hide verify button
                                    
                                    // Show OTP Section
                                    document.getElementById('otpSection').style.display = 'block';
                                    Toast.fire({ icon: 'success', title: 'OTP sent successfully. Please check your mobile.' });
                                }).catch((error) => {
                                    console.error("Firebase SMS error:", error);
                                    Toast.fire({ icon: 'error', title: 'Failed to send OTP via Firebase: ' + error.message });
                                    verifyBtn.innerHTML = originalBtnText;
                                    verifyBtn.disabled = false;
                                    
                                    if(window.recaptchaVerifier) {
                                        window.recaptchaVerifier.render().then(function(widgetId) {
                                            grecaptcha.reset(widgetId);
                                        });
                                    }
                                });
                        } else {
                            Toast.fire({ icon: 'error', title: response.message || 'Failed to initialize OTP process.' });
                            verifyBtn.innerHTML = originalBtnText;
                            verifyBtn.disabled = false;
                        }
                    },
                    error: function(xhr) {
                        Toast.fire({ icon: 'error', title: 'Error occurred while communicating with the server.' });
                        verifyBtn.innerHTML = originalBtnText;
                        verifyBtn.disabled = false;
                    }
                });
            });

            // ── CONFIRM OTP BTN ──
            document.getElementById('confirmOtpBtn').addEventListener('click', function(e) {
                const otp = document.getElementById('otpInput').value;
                if(otp.length !== 6) {
                    Toast.fire({ icon: 'warning', title: 'Please enter a valid 6-digit OTP.' });
                    return;
                }
                
                const btn = this;
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                btn.disabled = true;

                window.confirmationResult.confirm(otp).then((result) => {
                    // User signed in successfully, get the ID token
                    result.user.getIdToken().then(function(idToken) {
                        // Call Backend API to verify token
                        $.ajax({
                            url: '{{ env("API_URL") }}/operator/verify-otp',
                            type: 'POST',
                            data: {
                                firebase_token: idToken,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if(response.status) {
                                    const msgEl = document.getElementById('otpMessage');
                                    msgEl.textContent = response.message || 'Phone number verified successfully!';
                                    msgEl.style.color = '#198754';
                                    msgEl.style.display = 'block';
                                    
                                    document.getElementById('isPhoneVerified').value = "1";
                                    document.getElementById('verificationToken').value = response.data.verification_token;
                                    
                                    // Show verified badge
                                    document.getElementById('verifiedBadge').style.display = 'inline-block';
                                    
                                    // Hide OTP section
                                    document.getElementById('otpSection').style.display = 'none';
                                    document.getElementById('contactPhone').readOnly = true;
                                    document.getElementById('dialTrigger').disabled = true;
                                } else {
                                    Toast.fire({ icon: 'error', title: response.message || 'Verification failed on server.' });
                                    btn.innerHTML = originalText;
                                    btn.disabled = false;
                                }
                            },
                            error: function(xhr) {
                                Toast.fire({ icon: 'error', title: 'Error verifying OTP with the server.' });
                                btn.innerHTML = originalText;
                                btn.disabled = false;
                            }
                        });
                    }).catch(function(error) {
                        Toast.fire({ icon: 'error', title: 'Error getting Firebase token: ' + error.message });
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    });
                }).catch((error) => {
                    Toast.fire({ icon: 'error', title: 'Invalid OTP. Please try again.' });
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                });
            });

            // ── FORM SUBMIT ──
            document.getElementById('operatorRegistrationForm').addEventListener('submit', function (e) {
                e.preventDefault();

                let isValid = true;
                const form = this;
                
                // Clear all previous errors
                form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

                // Basic required fields validation
                const requiredFields = form.querySelectorAll('[required]');
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    }
                });

                if (!isValid) {
                    Toast.fire({ icon: 'warning', title: 'Please fill in all required fields properly.' });
                    
                    // Scroll to first invalid element
                    const firstInvalid = form.querySelector('.is-invalid');
                    if(firstInvalid) {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    return;
                }
                
                const isVerified = document.getElementById('isPhoneVerified').value;
                if (isVerified !== "1") {
                    Toast.fire({ icon: 'warning', title: 'Please verify your phone number first.' });
                    return;
                }
                
                const agreeTerms = document.getElementById('agreeTerms').checked;
                if (!agreeTerms) { Toast.fire({ icon: "warning", title: "Please agree to terms and conditions" }); return; }
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerHTML;
                
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';

                const formData = new FormData(form);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    url: '{{ env("API_URL") }}/operator/register',
                    type: 'POST',
                    data: formData,
                    processData: false, // Required for FormData
                    contentType: false, // Required for FormData
                    success: function(response) {
                        if(response.status) {
                            Swal.fire({ icon: 'success', title: 'Success!', text: response.message || 'Registration submitted successfully!', confirmButtonColor: '#198754' });
                            
                            // Reset the form
                            form.reset();
                            
                            // Reset Verification state
                            document.getElementById('isPhoneVerified').value = "0";
                            document.getElementById('verificationToken').value = "";
                            document.getElementById('verifiedBadge').style.display = 'none';
                            
                            // Enable inputs back
                            document.getElementById('contactPhone').readOnly = false;
                            document.getElementById('dialTrigger').disabled = false;
                            
                            submitBtn.innerHTML = originalBtnText;
                            submitBtn.disabled = false;
                            
                            // Optional: Redirect to a success page or login
                            // window.location.href = '/success';
                        } else {
                            Toast.fire({ icon: 'error', title: response.message || 'Registration failed.' });
                            submitBtn.innerHTML = originalBtnText;
                            submitBtn.disabled = false;
                        }
                    },
                    error: function(xhr) {
                        let errorMsg = 'An error occurred during submission.';
                        if(xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        } else if(xhr.responseJSON && xhr.responseJSON.errors) {
                            // Extract first validation error
                            const firstError = Object.values(xhr.responseJSON.errors)[0];
                            errorMsg = firstError[0];
                        }
                        Toast.fire({ icon: 'error', title: errorMsg });
                        
                        submitBtn.innerHTML = originalBtnText;
                        submitBtn.disabled = false;
                    }
                });
            });
        });

        // Refresh AOS on window resize
        $(window).on('resize', function () {
            AOS.refresh();
        });
    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
</body>

</html>