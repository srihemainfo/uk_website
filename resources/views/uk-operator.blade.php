<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoRide - Operator Registration</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .main-container {
            display: flex;
            min-height: 100vh;
            background-color: #ffffff;
        }

        .left-section {
            flex: 0 0 45%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px;
            background-color: #ffffff;
        }

        .right-section {
            flex: 0 0 55%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCQ94LgRgL5uqTqfcnX-DTr0sKPon4M9HGTN1Jg1Z2oY1uI42j01Z3M46X-QOnea9jkmVMtMsK0Lew-h69QgquxOA3GgD9ne4JfsL_mFirDxTekPvFo9Uc_gGzMVewmQ7UOOOFLa6mt7tOtL3O4fXrI5BUtZzVYehTSIkSDqpxWy8T5e23c7dE_YIKOxPJ0wVRcSqzbI55coAEDtzXkVqw0EAZVLlR5IS9IaZs0WP3mFGT2oI_TfQI0LckSybzwX2Pji5Tciqo-2wge');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .right-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .content-wrapper {
            max-width: 450px;
            z-index: 10;
            position: relative;
            width: 100%;
        }

        .right-section .content-wrapper {
            max-width: 400px;
        }

        .left-content h1 {
            font-size: 32px;
            font-weight: 600;
            color: #000000;
            margin-bottom: 24px;
            line-height: 40px;
        }

        .left-content p {
            font-size: 18px;
            font-weight: 400;
            color: #000000;
            margin-bottom: 30px;
            line-height: 28px;
        }

        .benefit-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .benefit-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #000000;
        }

        .check-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 1px solid #000000;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000000;
            flex-shrink: 0;
            font-size: 16px;
        }

        .form-card {
            background-color: #ffffff;
            border: 1px solid #cfc4c5;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .left-logo {
            margin-bottom: 24px;
        }

        .left-logo img {
            height: 65px;
            width: auto;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            height: 40px;
            width: auto;
        }

        .form-card h2 {
            font-size: 22px;
            font-weight: 600;
            color: #000000;
            margin-bottom: 6px;
        }

        .form-card .form-subtitle {
            font-size: 13px;
            font-weight: 500;
            color: #4c4546;
            margin-bottom: 18px;
            line-height: 18px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #000000;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            height: 38px;
            padding: 0 10px;
            font-size: 15px;
            border: 1px solid #cfc4c5;
            border-radius: 6px;
            color: #000000;
            background-color: #ffffff;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #000000;
            box-shadow: 0 0 0 1px #000000;
            color: #000000;
        }

        .form-control::placeholder {
            color: #7e7576;
        }

        .form-spacing {
            margin-bottom: 9px;
        }

        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #000000;
            padding: 0;
            font-size: 18px;
        }

        .password-toggle:hover {
            opacity: 0.7;
        }

        .verify-btn {
            position: absolute;
            right: 0px;
            top: 50%;
            transform: translateY(-50%);
            padding: 9px 8px;
            font-size: 11px;
            font-weight: 600;
            border: 1px solid #000000;
            border-radius: 4px;
            background-color: #000000;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .verify-btn:hover {
            background-color: #000000;
            color: #ffffff;
        }

        .phone-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0;
        }

        .phone-input-wrapper .country-code {
            padding: 0 10px;
            font-size: 15px;
            color: #000000;
            position: absolute;
            left: 0;
            z-index: 5;
        }

        .phone-input-wrapper .form-control {
            padding-left: 50px;
            padding-right: 90px;
        }

        .password-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .submit-btn {
            width: 100%;
            height: 40px;
            background-color: #000000;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .submit-btn:hover {
            opacity: 0.9;
        }

        .submit-btn:active {
            transform: scale(0.98);
        }

        .form-divider {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #cfc4c5;
            text-align: center;
        }

        .form-divider p {
            font-size: 11px;
            font-weight: 600;
            color: #000000;
            margin: 0;
            line-height: 16px;
        }

        .form-divider a {
            color: #000000;
            text-decoration: none;
            font-weight: 700;
        }

        .form-divider a:hover {
            text-decoration: underline;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 10px;
        }

        .forgot-password a {
            font-size: 12px;
            color: #000000;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .hidden-form {
            display: none;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .left-logo img {
                display: none;
            }

            .main-container {
                flex-direction: column;
            }

            .left-section {
                order: 2;
                flex: 0 0 auto;
                padding: 20px 16px;
                min-height: auto;
            }

            .right-section {
                order: 1;
                flex: 0 0 auto;
                padding: 40px 16px;
                min-height: 600PX;
            }


            .left-content h1 {
                font-size: 22px;
                line-height: 28px;
                margin-bottom: 12px;
            }

            .left-content p {
                font-size: 14px;
                line-height: 20px;
                margin-bottom: 16px;
            }

            .benefit-list li {
                font-size: 14px;
                margin-bottom: 6px;
                gap: 10px;
            }

            .check-icon {
                width: 20px;
                height: 20px;
                font-size: 14px;
            }

            .password-grid {
                grid-template-columns: 1fr;
                gap: 9px;
            }

            .content-wrapper {
                max-width: 100%;
            }

            .form-card {
                padding: 18px;
            }

            .form-card h2 {
                font-size: 18px;
                margin-bottom: 4px;
            }

            .form-card .form-subtitle {
                font-size: 14px;
                margin-bottom: 14px;
            }

            .logo-container img {
                height: 44px;
            }

            .phone-input-wrapper .form-control {
                padding-right: 80px;
            }

            .form-group label {
                font-size: 14px;
                margin-bottom: 6px;
            }

            .form-divider p {
                font-size: 14px;
            }

        }
    </style>
</head>

<body>
    <div class="main-container">
        <!-- Left Section - Benefits -->
        <section class="left-section">
            <div class="content-wrapper">
                <div class="left-content">
                    <div class="left-logo">
                        <img src="https://www.goride.net.in/goride/img/logo-dark.png" alt="GoRide Logo">
                    </div>
                    <h1>Join GoRide as an Operator</h1>
                    <p>Manage your fleet, receive more bookings, increase revenue, and grow your transportation business
                        with GoRide's powerful operator platform.</p>
                    <ul class="benefit-list">
                        <li>
                            <span class="check-icon">✓</span>
                            <span>Grow your customer base</span>
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            <span>Receive more ride bookings</span>
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            <span>Manage drivers and vehicles</span>
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            <span>Real-time booking management</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Right Section - Forms -->
        <section class="right-section">
            <div class="content-wrapper">
                <!-- Login Card (Shown First) -->
                <div id="loginCard" class="form-card">
                    <div class="logo-container d-block d-md-none">
                        <img src="{{ asset('goride/img/logo-lightt.png') }}" alt="GoRide Logo">
                    </div>
                    <h2>Welcome Back</h2>
                    <p class="form-subtitle">Sign in to manage your operator account.</p>
                    <form id="loginForm">
                        <div class="form-group form-spacing">
                            <label>Email Address</label>
                            <input type="email" class="form-control" placeholder="example@company.com" required>
                        </div>
                        <div class="form-group form-spacing">
                            <label>Password</label>
                            <div class="password-wrapper">
                                <input type="password" class="form-control" id="loginPassword" placeholder="••••••••"
                                    required>
                                <button type="button" class="password-toggle" onclick="toggleLoginPassword()">
                                    <span class="material-icons">visibility</span>
                                </button>
                            </div>
                        </div>
                        <div class="forgot-password">
                            <a href="#">Forgot Password?</a>
                        </div>
                        <button type="submit" class="submit-btn">Login</button>
                    </form>
                    <div class="form-divider">
                        <p>New to GoRide Operator? <a href="#" onclick="switchToRegister(event)">Register now</a></p>
                    </div>
                </div>

                <!-- Register Card (Hidden) -->
                <div id="registerCard" class="form-card hidden-form">
                    <div class="logo-container d-block d-md-none">
                        <img src="{{ asset('goride/img/logo-lightt.png') }}" alt="GoRide Logo">
                    </div>
                    <h2>Create Your Operator Account</h2>
                    <p class="form-subtitle">Register your business and start managing your fleet.</p>
                    <form id="registerForm">
                        <div class="form-group form-spacing">
                            <label>Full Name</label>
                            <input type="text" class="form-control" placeholder="Enter your full name" required>
                        </div>
                        <div class="form-group form-spacing">
                            <label>Email Address</label>
                            <input type="email" class="form-control" placeholder="example@company.com" required>
                        </div>
                        <div class="form-group form-spacing">
                            <label>Phone Number</label>
                            <div class="phone-input-wrapper">
                                <span class="country-code">+44</span>
                                <input type="tel" class="form-control" placeholder="98765 43210" required>
                                <button type="button" class="verify-btn">Verify Now</button>
                            </div>
                        </div>
                        <div class="password-grid">
                            <div class="form-group form-spacing">
                                <label>Password</label>
                                <div class="password-wrapper">
                                    <input type="password" class="form-control" id="registerPassword"
                                        placeholder="••••••••" required>
                                    <button type="button" class="password-toggle" onclick="toggleRegisterPassword()">
                                        <span class="material-icons">visibility</span>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group form-spacing">
                                <label>Confirm Password</label>
                                <div class="password-wrapper">
                                    <input type="password" class="form-control" id="confirmPassword"
                                        placeholder="••••••••" required>
                                    <button type="button" class="password-toggle" onclick="toggleConfirmPassword()">
                                        <span class="material-icons">visibility</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="submit-btn">Register</button>
                    </form>
                    <div class="form-divider">
                        <p>Already have an account? <a href="#" onclick="switchToLogin(event)">Login</a></p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleLoginPassword() {
            const input = $('#loginPassword');
            const btn = event.target.closest('.password-toggle');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                btn.innerHTML = '<span class="material-icons">visibility_off</span>';
            } else {
                input.attr('type', 'password');
                btn.innerHTML = '<span class="material-icons">visibility</span>';
            }
        }

        function toggleRegisterPassword() {
            const input = $('#registerPassword');
            const btn = event.target.closest('.password-toggle');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                btn.innerHTML = '<span class="material-icons">visibility_off</span>';
            } else {
                input.attr('type', 'password');
                btn.innerHTML = '<span class="material-icons">visibility</span>';
            }
        }

        function toggleConfirmPassword() {
            const input = $('#confirmPassword');
            const btn = event.target.closest('.password-toggle');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                btn.innerHTML = '<span class="material-icons">visibility_off</span>';
            } else {
                input.attr('type', 'password');
                btn.innerHTML = '<span class="material-icons">visibility</span>';
            }
        }

        function switchToRegister(e) {
            e.preventDefault();
            $('#loginCard').fadeOut(300, function () {
                $('#registerCard').fadeIn(300);
            });
        }

        function switchToLogin(e) {
            e.preventDefault();
            $('#registerCard').fadeOut(300, function () {
                $('#loginCard').fadeIn(300);
            });
        }

        $(document).ready(function () {
            $('#loginForm').on('submit', function (e) {
                e.preventDefault();
                showToast('Login submitted!', 'success');
            });

            $('#registerForm').on('submit', function (e) {
                e.preventDefault();
                showToast('Registration submitted!', 'success');
            });
        });
    </script>
</body>

</html>