<footer>
    <div class="container">
        <div class="row d-flex justify-content-between">
            <!-- Logo & Tagline -->
            <div class="col-12 col-md-4">
                <div class="footer-logo-section">
                    <div class="footer-logo">
                        <img src="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG_II') }}/goride/img/logo-lightt.png" alt="GoRide Logo">
                    </div>
                    <p class="footer-tagline">Safe, affordable, and reliable ride booking for everyone.</p>
                </div>
                <!-- Social Icons -->
                <div class="footer-section">
                    <div class="footer-social-icons">
                        <a href="https://api.whatsapp.com/send/?phone=447950323242&text=Hi%2C%20I%20need%20a%20cab.%20Could%20you%20help%20me%20book%20one%3F&type=phone_number&app_absent=0"
                            class="social-icon" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.facebook.com/people/Goride-Run/pfbid0jVh2iGFREVFLyTYRQFybaLXW3ECbUrgR9kJqcN4EMVYbSzPzFr7SRRLWgsTWf1BJl/"
                            class="social-icon" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com/goride.run_uk/" class="social-icon" title="Instagram">
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
            <!-- Company Links -->
            <div class="col-6 col-md-2">
                <div class="footer-section">
                    <div class="footer-section-title">Company</div>
                    <div class="footer-links-list">
                        <a href="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG') }}about">About Us</a>
                        <a href="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG') }}contact">Contact</a>
                        <a href="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG') }}blog">Blogs</a>
                        <a href="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG') }}privacy">Privacy Policy</a>
                        <a href="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG') }}terms">Terms & Conditions</a>
                    </div>
                </div>
            </div>

            <!-- Contact Column -->
            <div class="col-12 col-md-3">
                <div class="footer-section">
                    <div class="footer-section-title">Contact</div>
                    <div class="footer-links-list">
                        <div class="footer-phone">
                            <i class="fas fa-phone footer-contact-icon"></i>

                            <a href="tel:+442083373777">+44 20 8337 3777</a>

                        </div>
                        <a href="mailto:support.uk@goride.run">
                            <i class="fas fa-envelope footer-contact-icon"></i>
                            support.uk@goride.run
                        </a>
                        <div class="footer-address">
                            <i class="fas fa-location-dot footer-contact-icon"></i>
                            <div>
                                83 1st Floor ,   Surbiton Road ,<br>
                                Kingston Upon Thames ,<br>
                                KT1 2HW ,<br>
                                United Kingdom
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GoRide Driver App Column -->
            <div class="col-12 col-md-3">
                <div class="footer-section">
                    <div class="footer-section-title">GoRide Partner App</div>
                    <div class="footer-app-downloads">
                        <a href="https://play.google.com/store/apps/details?id=com.goride.ukpartner" target="_blank" class="footer-store-btn" title="GET IT ON Google Play">
                            <i class="fab fa-google-play"></i>
                            <div class="footer-store-btn-text">
                                <span class="footer-store-btn-sub">GET IT ON</span>
                                <span class="footer-store-btn-title">Google Play</span>
                            </div>
                        </a>
                        <a href="https://apps.apple.com/gb/app/goride-partner/id6791834578" target="_blank" class="footer-store-btn" title="DOWNLOAD ON THE App Store">
                            <i class="fab fa-apple"></i>
                            <div class="footer-store-btn-text">
                                <span class="footer-store-btn-sub">DOWNLOAD ON THE</span>
                                <span class="footer-store-btn-title">App Store</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="mb-0">© 2026 Operated by Goride Plus Ltd. All rights reserved. | Privacy • Terms • Cookies</p>
        </div>
    </div>
</footer>