<footer>
    <div class="container">
@php
    $servingLocations = collect([]);
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('dynamic_pages')) {
            $servingLocations = \Illuminate\Support\Facades\Cache::remember('footer_serving_locations_v1', 300, function () {
                return \Illuminate\Support\Facades\DB::table('dynamic_pages')
                    ->where('is_published', 1)
                    ->select('id', 'page_title', 'slug')
                    ->orderBy('id', 'asc')
                    ->get();
            });
        }
    } catch (\Throwable $e) {
        $servingLocations = collect([]);
    }

    // Graceful fallback with popular UK routes if database has no published pages yet
    if ($servingLocations->isEmpty()) {
        $servingLocations = collect([
            (object)['page_title' => 'Heathrow Airport to Sutton Car Rental', 'slug' => 'car-rental'],
            (object)['page_title' => 'Heathrow Airport to Westminster Abbey', 'slug' => 'heathrow-airport-to-westminster-abbey'],
            (object)['page_title' => 'Heathrow to Central London Transfers', 'slug' => 'heathrow-to-central-london'],
            (object)['page_title' => 'Gatwick Airport to London Cab', 'slug' => 'gatwick-to-london-cab'],
        ]);
    }

    $baseLandingUrl = rtrim(env('WEBSITE_APP_URL') ?: url('/'), '/') . '/' . trim(env('COUNTRY_SLUG_II') ?: (env('COUNTRY_SLUG') ?: 'uk'), '/') . '/';
@endphp

        <!-- Our Serving Locations Section -->
        <div class="footer-serving-locations">
            <div class="footer-locations-header">
                <div class="footer-locations-title-group">
                    <span class="footer-locations-tag">
                        <i class="fas fa-location-dot me-1"></i> UK Coverage
                    </span>
                    <h3 class="footer-locations-heading">Our Serving Locations</h3>
                </div>
                <p class="footer-locations-lead">
                    Explore top UK airport transfers, city routes, and private hire destinations
                </p>
            </div>

            <div class="footer-locations-grid">
                @foreach($servingLocations as $location)
                    @php
                        $locUrl = $baseLandingUrl . ltrim($location->slug, '/');
                    @endphp
                    <a href="{{ $locUrl }}" class="footer-location-card" title="{{ $location->page_title }}">
                        <span class="footer-location-icon-wrapper">
                            <i class="fas fa-car-side"></i>
                        </span>
                        <span class="footer-location-text">{{ $location->page_title }}</span>
                        <i class="fas fa-arrow-right footer-location-chevron"></i>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="footer-locations-divider"></div>

        <div class="row d-flex justify-content-between">
            <!-- Logo & Tagline -->
            <div class="col-12 col-md-4">
                <div class="footer-logo-section">
                    <div class="footer-logo">
                        <img src="{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG_II') }}/goride/img/logo-lightt.png" alt="GoRide Logo" loading="lazy" decoding="async">
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
                        <a href="https://www.facebook.com/people/Goride-Run/61591600963177/"
                             class="social-icon" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://x.com/Goride_UK" class="social-icon" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com/goride.run_uk/" class="social-icon" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/goride-uk-65924b425/" class="social-icon" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://www.youtube.com/@Goride_UK" class="social-icon" title="YouTube">
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

<style>
    /* Our Serving Locations - Premium Theme Styles */
    .footer-serving-locations {
        margin-bottom: 36px;
        padding-top: 10px;
    }

    .footer-locations-header {
        margin-bottom: 22px;
    }

    .footer-locations-title-group {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 6px;
        flex-wrap: wrap;
    }

    .footer-locations-tag {
        display: inline-flex;
        align-items: center;
        background: rgba(253, 184, 19, 0.12);
        color: #fdb813;
        border: 1px solid rgba(253, 184, 19, 0.28);
        border-radius: 20px;
        padding: 3px 11px;
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .footer-locations-heading {
        font-size: 22px;
        font-weight: 800;
        color: #ffffff;
        margin: 0;
        letter-spacing: -0.3px;
    }

    .footer-locations-lead {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.65);
        margin: 0;
        line-height: 1.5;
    }

    .footer-locations-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }

    @media (max-width: 1199px) {
        .footer-locations-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 991px) {
        .footer-locations-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .footer-locations-heading {
            font-size: 20px;
        }
    }

    @media (max-width: 575px) {
        .footer-locations-grid {
            grid-template-columns: 1fr;
            gap: 8px;
        }
        .footer-locations-heading {
            font-size: 18px;
        }
        .footer-locations-lead {
            font-size: 13px;
        }
    }

    .footer-location-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 11px 14px;
        color: rgba(255, 255, 255, 0.88);
        text-decoration: none;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(4px);
    }

    .footer-location-card:hover {
        background: rgba(253, 184, 19, 0.1);
        border-color: #fdb813;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.35), 0 0 12px rgba(253, 184, 19, 0.15);
    }

    .footer-location-icon-wrapper {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        min-width: 30px;
        border-radius: 8px;
        background: rgba(253, 184, 19, 0.12);
        color: #fdb813;
        font-size: 12.5px;
        transition: all 0.25s ease;
    }

    .footer-location-card:hover .footer-location-icon-wrapper {
        background: #fdb813;
        color: #000000;
        transform: scale(1.05);
    }

    .footer-location-text {
        flex: 1;
        font-size: 13.5px;
        font-weight: 600;
        line-height: 1.35;
        color: inherit;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .footer-location-chevron {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.35);
        transition: all 0.25s ease;
        margin-left: auto;
    }

    .footer-location-card:hover .footer-location-chevron {
        color: #fdb813;
        transform: translateX(3px);
    }

    .footer-locations-divider {
        height: 1px;
        background: linear-gradient(90deg, rgba(255, 255, 255, 0.03) 0%, rgba(255, 255, 255, 0.14) 50%, rgba(255, 255, 255, 0.03) 100%);
        margin: 32px 0 38px;
    }
</style>