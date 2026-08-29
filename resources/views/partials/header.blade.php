<nav class="navbar-uber">
    <div class="navbar-brand-uber">
        <img src="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG_II') }}/goride/img/logo-darkk.png" alt="GoRide Logo">
    </div>
    <ul class="navbar-menu">
        <li>
            <a href="#" onclick="toggleTrackRideOverlay(event)">
                Track Ride
            </a>
        </li>
        <li>
            <a href="#" data-bs-toggle="modal" data-bs-target="#helpModal">
                Help
            </a>
        </li>
        <li class="navbar-user-item" id="desktopUserAuthItem" style="display: none !important;">
            <button id="navbarUserBtn" class="navbar-user-btn" onclick="_toggleUserDropdown(event)">
                <span id="navbarUserAvatar" class="navbar-user-avatar"></span>
                <span id="navbarUserName"></span>
                <i class="fas fa-chevron-down navbar-user-arrow"></i>
            </button>
            <div id="navbarUserDropdown" class="navbar-user-dropdown">
                <ul class="navbar-user-menu">
                    <li>
                        <a href="{{env('WEBSITE_APP_URL')}}{{env('COUNTRY_SLUG_II')}}/profile" class="navbar-user-menu-btn">
                            <i class="far fa-user me-2"></i> Profile
                        </a>
                    </li>
                    <li id="desktopNavDashboardLink">
                        <a href="{{env('WEBSITE_APP_URL')}}{{env('COUNTRY_SLUG_II')}}/dashboard" class="navbar-user-menu-btn">
                            <i class="fas fa-chart-line me-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="navbar-user-menu-btn navbar-user-logout"
                            onclick="handleLogout()">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    <button class="mobile-menu-btn" id="mobileHamburger" onclick="toggleMobileMenu()">
        <i class="fas fa-bars"></i>
    </button>
    <div id="language-dropdown" class="dropdown-menu-navbar">
        <button onclick="selectLanguage('en')">English</button>
        <button onclick="selectLanguage('hi')">à¤¹à¤¿à¤‚à¤¦à¥€</button>
        <button onclick="selectLanguage('ta')">à®¤à®®à®¿à®´à¯</button>
        <button onclick="selectLanguage('te')">à°¤à±†à°²à±à°—à±</button>
        <button onclick="selectLanguage('kn')">à²•à²¨à³à²¨à²¡</button>
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
            <a href="{{ route('profile') }}"><i class="fas fa-user"></i><span>Profile</span></a>
            <a href="{{ route('dashboard') }}"><i class="fas fa-table-columns"></i><span>Dashboard</span></a>
            <a href="#" onclick="toggleTrackRideOverlay(event)"><i class="fas fa-location-arrow"></i><span>Track
                    Ride</span></a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#helpModal"><i
                    class="fas fa-circle-question"></i><span>Help</span></a>
        </div>
        <div class="account-footer">
            <a href="javascript:void(0)" onclick="handleLogout()"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </div>

    <button type="button" class="mobile-header-rider-btn" id="mobileHeaderRiderBtn" style="display:none;"
        onclick="showForMeModal()">
        <i class="fas fa-user"></i>
        <span id="mobileHeaderRiderTitle">For me</span>
        <i class="fas fa-chevron-down" style="font-size: 10px;"></i>
    </button>
    <div class="mobile-menu-btn" id="mobileMapBtn" style="display:none;" onclick="toggleMobileMap()">
        <i class="fas fa-map"></i>
    </div>
    <div class="mobile-menu-overlay" id="mobileOverlay" onclick="toggleMobileMenu()"></div>
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <img src="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG_II') }}/goride/img/logo-darkk.png" alt="GoRide Logo">
            <button onclick="toggleMobileMenu()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mobile-user" id="mobileUserBlock" style="display:none;">
            <div class="mobile-avatar" id="mobileUserAvatar">--</div>
            <div>
                <h5 id="mobileUserName">--</h5>
            </div>
        </div>
        <div class="mobile-menu-links">
            <a href="{{ route('profile') }}" class="mobile-auth-only" style="display: none !important;"><i
                    class="fas fa-user"></i>Profile</a>
            <a href="{{ route('dashboard') }}" class="mobile-auth-only" style="display: none !important;"><i
                    class="fas fa-table-columns"></i>Dashboard</a>
            <a href="#" onclick="toggleTrackRideOverlay(event)"><i class="fas fa-location-arrow"></i>Track Ride</a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#helpModal"><i
                    class="fas fa-circle-question"></i>Help</a>
            <a href="javascript:void(0)" class="mobile-auth-only" onclick="handleLogout()"
                style="display: none !important;"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </div>
</nav>