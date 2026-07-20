<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoRide - My Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Bootstrap JS (needed for modals and dropdowns) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 35px 20px;
        }

        /* Navbar */
        .dash-navbar {
            background: #fff;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #eaeaea;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .dropdown-menu {
            position: absolute;
            top: 45px;
            right: 0;
            width: 200px;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            z-index: 1000;
        }

        .dropdown-menu li {
            font-size: 14px;
        }

        .navbar-brand-wrapper {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-logo {
            font-size: 22px;
            font-weight: 800;
            color: #111;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-logo img {
            height: 45px;
        }



        .nav-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-book-ride {
            background: #000;
            color: #fff;
            border-radius: 20px;
            padding: 8px 16px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-book-ride:hover {
            color: #fff;
            background: #333;
        }

        .profile-img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }

        .dropdown-item:active,
        .dropdown-item.active {
            background-color: #111 !important;
            color: #fff !important;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #f3f4f6;
            color: #111;
        }

        .dropdown-item {
            font-weight: 500;
        }

        @media (max-width: 768px) {

            .dash-navbar {
                padding: 12px 16px;
            }
        }

        /* Profile Specific Styles */
        .profile-wrapper {
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
        }

        .profile-header {
            text-align: left;
            margin-bottom: 30px;
        }

        .profile-title {
            font-size: 24px;
            font-weight: 700;
            color: #111;
            margin-bottom: 5px;
        }

        .profile-subtitle {
            font-size: 17px;

        }

        .profile-layout {
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }

        .profile-left {
            flex-shrink: 0;
            width: 150px;
        }

        .profile-right {
            flex: 1;
        }

        .profile-avatar-wrapper {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0;
        }

        .profile-avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .edit-avatar-btn {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #111;
            color: #fff;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #fff;
            cursor: pointer;
            transition: 0.2s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .edit-avatar-btn:hover {
            background: #333;
            transform: scale(1.05);
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;

            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 45px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 500;
            background-color: #fff;
            color: #111;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #111;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            outline: none;
        }

        .form-control:read-only {
            background-color: #f3f4f6;
            color: #9ca3af;
            cursor: not-allowed;
            border-color: transparent;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 42px;
            color: #9ca3af;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus+.input-icon {
            color: #111;
        }

        .readonly-icon {
            position: absolute;
            right: 16px;
            top: 42px;
            color: #d1d5db;
            font-size: 14px;
        }

        .btn-save {
            background: #111;
            color: #fff;
            border: none;
            padding: 16px 24px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-save:hover {
            background: #000;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }



        @media (max-width: 768px) {

            .input-icon {
                top: 47px;
            }

            .form-label {
                font-size: 15px;
            }

            .profile-subtitle {
                font-size: 16px;
                margin-bottom: 0px;
                ;

            }

            .profile-layout {
                flex-direction: column;
                align-items: center;
                gap: 30px;
            }

            .profile-header {
                text-align: center;
                margin-top: 20px;
                margin-bottom: 18px;
            }

            .profile-right {
                width: 100%;
                max-width: 400px;
            }

            .main-content {
                align-items: flex-start;

            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="dash-navbar px-3 px-md-4">
        <div class="navbar-brand-wrapper gap-2 gap-md-3">
            <a href="/" class="nav-logo fs-5 fs-md-4">
                <img src="https://www.goride.net.in/goride/img/logo-light.png" alt="GoRide">
            </a>

        </div>

        <div class="nav-actions gap-2 gap-md-3">
            <a href="/" class="btn-book-ride px-2 px-md-3">
                <i class="fas fa-plus"></i> <span class="d-none d-md-inline">Book Ride</span>
            </a>

            <div class="dropdown">
                <img src="https://ui-avatars.com/api/?name=Alex&background=random" alt="Profile" class="profile-img"
                    data-bs-toggle="dropdown">
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2">
                    <li><a class="dropdown-item py-2 active" href="/uk-profile"><i class="far fa-user me-2"></i>
                            Profile</a></li>
                    <li><a class="dropdown-item py-2" href="/uk-dashboard"><i class="fas fa-chart-line me-2"></i>
                            Dashboard</a></li>
                    <!-- <li><a class="dropdown-item py-2" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li> -->
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item py-2" href="#"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Content -->
    <div class="main-content">
        <div class="container profile-wrapper">
            <div class="profile-header">
                <h1 class="profile-title">Edit Profile</h1>
                <p class="profile-subtitle">Manage your personal information</p>
            </div>

            <div class="profile-layout">
                <div class="profile-left">
                    <div class="profile-avatar-wrapper">
                        <img src="https://ui-avatars.com/api/?name=Alex&background=random" alt="User Avatar"
                            class="profile-avatar" id="profileImagePreview">
                        <label for="avatarUpload" class="edit-avatar-btn" title="Change Avatar">
                            <i class="fas fa-pencil-alt"></i>
                        </label>
                        <input type="file" id="avatarUpload" style="display: none;" accept="image/*">
                    </div>
                </div>

                <div class="profile-right">
                    <form action="#" method="POST" id="profileForm">
                        <div class="form-group">
                            <label class="form-label" for="fullName">Full Name</label>
                            <input type="text" id="fullName" class="form-control" value="Alex Smith" required>
                            <i class="far fa-user input-icon"></i>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="emailAddress">Email Address</label>
                            <input type="email" id="emailAddress" class="form-control" value="alex.smith@example.com"
                                readonly>
                            <i class="far fa-envelope input-icon"></i>
                            <i class="fas fa-lock readonly-icon" title="Cannot be changed"></i>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="phoneNumber">Phone Number</label>
                            <input type="text" id="phoneNumber" class="form-control" value="+44 7700 900077" readonly>
                            <i class="fas fa-phone-alt input-icon"></i>
                            <i class="fas fa-lock readonly-icon" title="Cannot be changed"></i>
                        </div>

                        <button type="submit" class="btn-save">
                            <i class="fas fa-check-circle"></i> Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Handle avatar image preview
            $('#avatarUpload').on('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#profileImagePreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Handle form submission
            $('#profileForm').on('submit', function (e) {
                e.preventDefault();
                const btn = $(this).find('.btn-save');
                const originalText = btn.text();

                btn.html('<i class="fas fa-spinner fa-spin"></i> Saving...');
                btn.prop('disabled', true);

                // Simulate an API call
                setTimeout(() => {
                    btn.html('<i class="fas fa-check"></i> Saved Successfully');

                    setTimeout(() => {
                        btn.html(originalText);
                        btn.prop('disabled', false);
                    }, 2000);
                }, 1000);
            });
        });
    </script>
</body>

</html>