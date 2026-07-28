    <nav class="navbar-uber">
        <div class="navbar-brand-uber">
            <img src="https://www.goride.net.in/goride/img/logo-light.png" alt="GoRide UK Logo">
        </div>
        <ul class="navbar-menu">
            <!--<li><button onclick="toggleDropdown('language')">-->
            <!--        <i class="fas fa-globe me-2"></i>EN-->
            <!--    </button></li>-->
            <li>
                <a href="#" data-bs-toggle="modal" data-bs-target="#helpModal">
                    Help
                </a>
            </li>
            <!--<li style="position:relative;">-->
            <!--    <button class="user-btn" onclick="toggleDropdown('user')">-->
            <!--        <i class="fas fa-user-circle"></i>-->
            <!--        Mogana-->
            <!--        <i class="fas fa-chevron-down"></i>-->
            <!--    </button>-->
            <!--</li>-->
        </ul>
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
                <a href="#"><i class="fas fa-user"></i><span>My Profile</span></a>
                <a href="#"><i class="fas fa-car"></i><span>My Rides</span></a>
                <a href="#"><i class="fas fa-map-marker-alt"></i><span>Saved Places</span></a>
                <a href="#"><i class="fas fa-wallet"></i><span>Wallet</span></a>
                <a href="#"><i class="fas fa-tag"></i><span>Offers</span></a>
                <a href="#"><i class="fas fa-cog"></i><span>Settings</span></a>
            </div>
            <div class="account-footer">
                <a href="javascript:void(0)" onclick="handleLogout()"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
        </div>
        <!--<button class="mobile-menu-btn" id="mobileHamburger" onclick="toggleMobileMenu()">-->
        <!--    <i class="fas fa-bars"></i>-->
        <!--</button>-->
        <button type="button" class="mobile-header-rider-btn" id="mobileHeaderRiderBtn" style="display:none;" onclick="showForMeModal()">
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
                <a href="#"><i class="fas fa-user"></i>My Profile</a>
                <a href="#"><i class="fas fa-car"></i>My Rides</a>
                <a href="#"><i class="fas fa-map-marker-alt"></i>Saved Places</a>
                <a href="#"><i class="fas fa-wallet"></i>Wallet</a>
                <a href="#"><i class="fas fa-tag"></i>Offers</a>
                <a href="#"><i class="fas fa-language"></i>Language</a>
                <a href="#"><i class="fas fa-circle-question"></i>Help</a>
                <a href="#"><i class="fas fa-gear"></i>Settings</a>
            </div>
            <div class="mobile-menu-footer">
                <button onclick="handleLogout()"><i class="fas fa-right-from-bracket"></i>Logout</button>
            </div>
        </div>
    </nav>
