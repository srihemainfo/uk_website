<footer>
    <div class="container">
        <div class="row d-flex justify-content-between">
            <!-- Logo & Tagline -->
            <div class="col-12 col-md-3">
                <div class="footer-logo-section">
                    <div class="footer-logo">
                        <img src="{{ asset('goride/img/logo-lightt.png') }}" alt="GoRide Logo">
                    </div>
                    <p class="footer-tagline">Safe, affordable, and reliable ride booking for everyone.</p>
                </div>
                <!-- Social Icons -->
                <div class="footer-section">
                    <div class="footer-social-icons">
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
                        <a href="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG') }}/about">About Us</a>
                        <a href="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG') }}/contact">Contact</a>
                        <a href="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG') }}/blog">Blogs</a>
                    </div>
                </div>
            </div>
            <!-- Legal Links -->
            <div class="col-6 col-md-2">
                <div class="footer-section">
                    <div class="footer-section-title">Legal</div>
                    <div class="footer-links-list">
                        <!--<a href="#">Security Policy</a>-->
                        <a href="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG') }}/privacy">Privacy Policy</a>
                        <a href="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG') }}/terms">Terms & Conditions</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="footer-section">
                    <div class="footer-section-title">Contact</div>
                    <div class="footer-links-list">
                        <div class="footer-phone">
                            <i class="fas fa-phone footer-contact-icon"></i>

                            <a href="tel:+442083373777">+44 208 337 3777</a>

                            <span>/</span>

                            <a href="tel:+447950323242">+44 7950 323242</a>
                        </div>
                        <a href="mailto:support.uk@goride.run">
                            <i class="fas fa-envelope footer-contact-icon"></i>
                            support.uk@goride.run
                        </a>
                        <div class="footer-address">
                            <i class="fas fa-location-dot footer-contact-icon"></i>
                            <div>
                                83 1st Floor<br>
                                Surbiton Road<br>
                                Kingston Upon Thames<br>
                                KT1 2HW<br>
                                United Kingdom
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="mb-0">© 2026 Operated by Goride Plus Ltd. All rights reserved. | Privacy • Terms • Cookies</p>
        </div>
    </div>
</footer>