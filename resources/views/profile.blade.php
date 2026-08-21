@extends('layouts.app')

@section('content')
    <style>
        /* Profile Specific Styles */
        .profile-wrapper {
            width: 100%;
            max-width: 700px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-header-text {
            text-align: left;
        }

        .btn-book-now {
            background: #111;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-book-now:hover {
            background: #333;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
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

        .btn-save:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        /* Toast Notification removed (now global) */

        @media (max-width: 768px) {
            .input-icon {
                top: 47px;
            }

            .form-label {
                font-size: 15px;
            }

            .profile-subtitle {
                font-size: 16px;
                margin-bottom: 0;
            }

            .profile-layout {
                flex-direction: column;
                align-items: center;
                gap: 30px;
            }

            .profile-header {
                flex-direction: column-reverse;
                align-items: flex-end;
                margin-top: 20px;
                margin-bottom: 18px;
                gap: 15px;
            }

            .profile-header-text {
                width: 100%;
                text-align: left;
            }

            .profile-right {
                width: 100%;
                max-width: 400px;
            }
        }

        /* Unauthorized State Styles */
        .unauth-container {
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 20px;
        }

        .unauth-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            padding: 45px 35px;
            max-width: 520px;
            width: 100%;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            animation: unauthFadeIn 0.35s ease-out;
        }

        @keyframes unauthFadeIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .unauth-icon-box {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: #111;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin-bottom: 22px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        .unauth-title {
            font-size: 26px;
            font-weight: 800;
            color: #111;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }

        .unauth-desc {
            font-size: 15px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .unauth-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-unauth-primary {
            background: #111;
            color: #fff !important;
            padding: 13px 26px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: none;
            flex: 1;
            min-width: 180px;
        }

        .btn-unauth-primary:hover {
            background: #000;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.18);
        }

        .btn-unauth-secondary {
            background: #f3f4f6;
            color: #111 !important;
            padding: 13px 26px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            border: 1px solid #e5e7eb;
            cursor: pointer;
            flex: 1;
            min-width: 140px;
        }

        .btn-unauth-secondary:hover {
            background: #e5e7eb;
            transform: translateY(-2px);
        }
    </style>



    <!-- Profile Content -->
    <div class="container profile-wrapper" id="profileMainContent">
        <div class="profile-header">
            <div class="profile-header-text">
                <h1 class="profile-title">Edit Profile</h1>
                <p class="profile-subtitle">Manage your personal information</p>
            </div>
            <a href="{{ url('/') }}" class="btn-book-now">
                <i class="fas fa-arrow-left"></i> Book Now
            </a>
        </div>

        <div class="profile-layout">
            <div class="profile-left">
                <div class="profile-avatar-wrapper">
                    <img src="https://ui-avatars.com/api/?name=U&background=111111&color=fff" alt="User Avatar"
                        class="profile-avatar" id="profileImagePreview">
                    <label for="avatarUpload" class="edit-avatar-btn" title="Change Avatar">
                        <i class="fas fa-pencil-alt"></i>
                    </label>
                    <input type="file" id="avatarUpload" style="display: none;"
                        accept="image/jpeg,image/png,image/jpg,image/webp">
                </div>
            </div>

            <div class="profile-right">
                <form id="profileForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="form-label" for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="c_name" class="form-control" placeholder="Your full name"
                            required>
                        <i class="far fa-user input-icon"></i>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="emailAddress">Email Address</label>
                        <input type="email" id="emailAddress" name="c_email" class="form-control"
                            placeholder="your@email.com" readonly>
                        <i class="far fa-envelope input-icon"></i>
                        <i class="fas fa-lock readonly-icon" title="Cannot be changed"></i>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="phoneNumber">Phone Number</label>
                        <input type="text" id="phoneNumber" class="form-control" placeholder="xxxx xxxxxx" readonly>
                        <i class="fas fa-phone-alt input-icon"></i>
                        <i class="fas fa-lock readonly-icon" title="Cannot be changed"></i>
                    </div>

                    <button type="submit" class="btn-save" id="saveBtn">
                        <i class="fas fa-check-circle"></i> Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Unauthorized State UI -->
    <div class="unauth-container" id="profileUnauthorizedState" style="display: none;">
        <div class="unauth-card">
            <div class="unauth-icon-box">
                <i class="fas fa-shield-halved"></i>
            </div>
            <h2 class="unauth-title">Authorization Required</h2>
            <p class="unauth-desc">
                You must be signed in to view and edit your profile details. Please sign in or return to the home page.
            </p>
            <div class="unauth-actions">
                <a href="{{ url('/') }}" class="btn-unauth-primary">
                    <i class="fas fa-home"></i> Go to Home Page
                </a>
                <button type="button" class="btn-unauth-secondary" onclick="openAuthModal()">
                    <i class="fas fa-arrow-right-to-bracket"></i> Sign In
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ─── Helpers ────────────────────────────────────────────────────────────
            function getToken() {
                return typeof getCookieValue === 'function' ? getCookieValue('auth_token') : '';
            }

            function checkProfileAuth() {
                const token = getToken();
                const mainContent = document.getElementById('profileMainContent');
                const unauthView = document.getElementById('profileUnauthorizedState');

                if (!token || token === 'null' || token === 'undefined' || token.trim() === '') {
                    if (mainContent) mainContent.style.display = 'none';
                    if (unauthView) unauthView.style.display = 'flex';
                    return false;
                } else {
                    if (mainContent) mainContent.style.display = 'block';
                    if (unauthView) unauthView.style.display = 'none';
                    return true;
                }
            }



            // ─── Load Profile Data ───────────────────────────────────────────────────
            function loadProfile() {
                // Instantly fill inputs from cookie data
                const storedUserStr = typeof getCookieValue === 'function' ? getCookieValue('auth_user') : null;
                if (storedUserStr) {
                    try {
                        const user = JSON.parse(storedUserStr);
                        const firstName = user.first_name || '';
                        const lastName = user.last_name || '';
                        const fullName = (firstName + ' ' + lastName).trim();
                        const name = user.c_name || user.name || fullName || '';
                        const email = user.c_email || user.email || '';
                        const phone = user.c_phone || user.phone || user.mobile || user.mobile_number || '';
                        const image = user.c_image || user.profile_image || user.avatar || null;

                        document.getElementById('fullName').value = name;
                        document.getElementById('emailAddress').value = email;
                        document.getElementById('phoneNumber').value = phone;

                        if (image) {
                            document.getElementById('profileImagePreview').src = image;
                        } else if (name) {
                            const avatarUrl = 'https://ui-avatars.com/api/?name='
                                + encodeURIComponent(name)
                                + '&background=111111&color=fff';
                            document.getElementById('profileImagePreview').src = avatarUrl;
                        }
                    } catch (e) { }
                }

                const token = getToken();
                if (!token) return;

                // Fetch from API to ensure data is fresh
                const apiUrl = '{{ env("API_URL") }}/auth/customer/me';
                fetch(apiUrl, {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                    }
                })
                    .then(r => r.json())
                    .then(data => {
                        const user = data.data || data.user || data;
                        if (!user) return;

                        const name = user.c_name || user.name || '';
                        const email = user.c_email || user.email || '';
                        const phone = user.c_phone || user.phone || user.mobile || '';
                        const image = user.c_image || user.profile_image || user.avatar || null;

                        document.getElementById('fullName').value = name;
                        document.getElementById('emailAddress').value = email;
                        document.getElementById('phoneNumber').value = phone;

                        // Avatar
                        if (image) {
                            document.getElementById('profileImagePreview').src = image;
                        } else if (name) {
                            const avatarUrl = 'https://ui-avatars.com/api/?name='
                                + encodeURIComponent(name)
                                + '&background=111111&color=fff';
                            document.getElementById('profileImagePreview').src = avatarUrl;
                        }
                    })
                    .catch(() => { });
            }

            // ─── Avatar Preview ──────────────────────────────────────────────────────
            const avatarUpload = document.getElementById('avatarUpload');
            if (avatarUpload) {
                avatarUpload.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (!file) return;
                    if (file.size > 5 * 1024 * 1024) {
                        showToast('Image must be smaller than 5 MB.', 'error');
                        this.value = '';
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function (ev) {
                        document.getElementById('profileImagePreview').src = ev.target.result;
                    };
                    reader.readAsDataURL(file);
                });
            }

            // ─── Form Submission ──────────────────────────────────────────────
            const profileForm = document.getElementById('profileForm');
            if (profileForm) {
                profileForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const token = getToken();
                    const btn = document.getElementById('saveBtn');
                    const name = document.getElementById('fullName').value.trim();
                    const email = document.getElementById('emailAddress').value.trim();

                    if (!name) {
                        showToast('Full name is required.', 'error');
                        return;
                    }

                    const formData = new FormData();
                    formData.append('c_name', name);
                    formData.append('c_email', email);

                    const fileInput = document.getElementById('avatarUpload');
                    if (fileInput.files.length > 0) {
                        formData.append('c_image', fileInput.files[0]);
                    }

                    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
                    btn.disabled = true;

                    const submitUrl = '{{ env("API_URL") }}/auth/update-profile';
                    fetch(submitUrl, {
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                        .then(r => r.json())
                        .then(data => {
                            if (data.status === 'success') {
                                const user = data.data || {};
                                const newImage = user.c_image || user.profile_image;
                                if (newImage) {
                                    document.getElementById('profileImagePreview').src = newImage;
                                }

                                // Update cookie and navbar UI
                                try {
                                    const storedStr = typeof getCookieValue === 'function' ? getCookieValue('auth_user') : null;
                                    let storedUser = storedStr ? JSON.parse(storedStr) : {};

                                    // Map the updated name
                                    const newName = user.c_name || user.name || user.first_name;
                                    if (newName) {
                                        storedUser.first_name = newName;
                                        storedUser.last_name = ''; // GoRide primarily uses first_name or combines them
                                    }

                                    // Map the updated image
                                    if (newImage) {
                                        storedUser.profile_image = newImage;
                                    }

                                    // Save back to cookie
                                    const expires = new Date();
                                    expires.setTime(expires.getTime() + 7 * 24 * 60 * 60 * 1000);
                                    document.cookie = 'auth_user=' + encodeURIComponent(JSON.stringify(storedUser)) + '; expires=' + expires.toUTCString() + '; path=/; SameSite=Lax';

                                    // Update navbar globally
                                    if (typeof _updateNavbarAfterLogin === 'function') {
                                        _updateNavbarAfterLogin(storedUser);
                                    }
                                } catch (e) {
                                    console.error('Failed to update navbar:', e);
                                }

                                showToast('Profile updated successfully!', 'success');
                                btn.innerHTML = '<i class="fas fa-check-circle"></i> Saved!';
                                setTimeout(() => {
                                    btn.innerHTML = '<i class="fas fa-check-circle"></i> Save Changes';
                                    btn.disabled = false;
                                }, 2000);
                            } else {
                                const errors = data.errors;
                                if (errors) {
                                    const firstError = Object.values(errors)[0];
                                    showToast(Array.isArray(firstError) ? firstError[0] : firstError, 'error');
                                } else {
                                    showToast(data.message || 'Failed to update profile.', 'error');
                                }
                                btn.innerHTML = '<i class="fas fa-check-circle"></i> Save Changes';
                                btn.disabled = false;
                            }
                        })
                        .catch(() => {
                            showToast('Network error. Please try again.', 'error');
                            btn.innerHTML = '<i class="fas fa-check-circle"></i> Save Changes';
                            btn.disabled = false;
                        });
                });
            }

            if (!checkProfileAuth()) {
                return;
            }
            loadProfile();
        });
    </script>
@endsection