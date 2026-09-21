@php
    $servingLocations = collect([]);
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('dynamic_pages')) {
            $servingLocations = \Illuminate\Support\Facades\Cache::remember('serving_locations_classic_v3', 300, function () {
                return \Illuminate\Support\Facades\DB::table('dynamic_pages')
                    ->where('is_published', 1)
                    ->select('id', 'page_title', 'slug')
                    ->orderBy('id', 'asc')
                    ->limit(12)
                    ->get();
            });
        }
    } catch (\Throwable $e) {
        $servingLocations = collect([]);
    }

    // Curated high-volume UK route fallbacks to ensure exactly 12 items are displayed
    if ($servingLocations->count() < 12) {
        $fallbackPool = collect([
            (object)['page_title' => 'Heathrow Airport to Sutton Car Rental', 'slug' => 'car-rental'],
            (object)['page_title' => 'Heathrow Airport to Westminster Abbey', 'slug' => 'heathrow-airport-to-westminster-abbey'],
            (object)['page_title' => 'Heathrow to Central London Transfers', 'slug' => 'heathrow-to-central-london'],
            (object)['page_title' => 'Gatwick Airport to London Cab', 'slug' => 'gatwick-to-london-cab'],
            (object)['page_title' => 'London Luton Airport to Central London', 'slug' => 'luton-to-london-transfer'],
            (object)['page_title' => 'Manchester Airport to City Centre Cab', 'slug' => 'manchester-airport-taxi'],
            (object)['page_title' => 'Birmingham Airport to London Transfers', 'slug' => 'birmingham-to-london-transfer'],
            (object)['page_title' => 'Heathrow Airport to Cambridge Taxi', 'slug' => 'heathrow-to-cambridge'],
            (object)['page_title' => 'London City Airport to Canary Wharf', 'slug' => 'city-airport-to-canary-wharf'],
            (object)['page_title' => 'London to Oxford Street Cab Transfer', 'slug' => 'london-to-oxford-street'],
            (object)['page_title' => 'Stansted Airport to Central London', 'slug' => 'stansted-to-london-transfer'],
            (object)['page_title' => 'Heathrow Airport to Windsor Castle', 'slug' => 'heathrow-to-windsor'],
        ]);

        $existingSlugs = $servingLocations->pluck('slug')->all();
        foreach ($fallbackPool as $fb) {
            if (!in_array($fb->slug, $existingSlugs)) {
                $servingLocations->push($fb);
                if ($servingLocations->count() >= 12) {
                    break;
                }
            }
        }
    }

    // Strictly limit to exactly 12 items
    $servingLocations = $servingLocations->take(12);

    $baseLandingUrl = rtrim(env('WEBSITE_APP_URL') ?: url('/'), '/') . '/' . trim(env('COUNTRY_SLUG_II') ?: (env('COUNTRY_SLUG') ?: 'uk'), '/') . '/';
@endphp

<!-- Our Serving Locations (Classic & Modern Light Theme) -->
<section class="serving-locations-section">
    <div class="container">
        <!-- Section Header -->
        <div class="locations-classic-header">
            <div class="locations-header-main">
                <div class="locations-eyebrow-badge">
                    <span class="eyebrow-dot"></span>
                    <i class="fas fa-route text-warning me-1"></i>
                    <span>UK POPULAR TRANSFERS</span>
                </div>
                <h3 class="locations-classic-title">Our Serving Locations</h3>
                <p class="locations-classic-desc">
                    Explore top UK airport transfers, city routes, and chauffeured private hire destinations with guaranteed fixed prices.
                </p>
            </div>
            <div class="locations-header-pills">
                <div class="feature-tag">
                    <i class="fas fa-shield-halved text-success"></i>
                    <span>Fixed Fares</span>
                </div>
                <div class="feature-tag">
                    <i class="fas fa-plane-arrival text-primary"></i>
                    <span>Flight Tracking</span>
                </div>
                <div class="feature-tag">
                    <i class="fas fa-clock text-warning"></i>
                    <span>24/7 Service</span>
                </div>
            </div>
        </div>

        <!-- 12 Classic & Modern Cards Grid -->
        <div class="locations-classic-grid">
            @foreach($servingLocations as $location)
                @php
                    $locUrl = $baseLandingUrl . ltrim($location->slug, '/');
                @endphp
                <a href="{{ $locUrl }}" class="classic-location-card" title="{{ $location->page_title }}">
                    <div class="card-accent-bar"></div>
                    <div class="card-top-meta">
                        <span class="route-category-tag">
                            <i class="fas fa-car-side me-1"></i> Private Transfer
                        </span>
                        <span class="card-arrow-circle">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>

                    <div class="card-main-content">
                        <h4 class="route-title-text">{{ $location->page_title }}</h4>
                    </div>

                    <div class="card-bottom-bar">
                        <div class="route-perk">
                            <i class="fas fa-check-circle text-success me-1"></i> Fixed Fare &bull; 24/7
                        </div>
                        <span class="book-route-cta">
                            <span>Book</span>
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<style>
    /* Serving Locations - Classic & Modern Theme */
    .serving-locations-section {
        background: #fbfbfd;
        border-top: 1px solid #edf2f7;
        border-bottom: 1px solid #edf2f7;
        padding: 64px 0 60px;
        position: relative;
        font-family: 'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .locations-classic-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 24px;
        margin-bottom: 34px;
        flex-wrap: wrap;
    }

    .locations-header-main {
        max-width: 680px;
    }

    .locations-eyebrow-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: #78350f;
        border-radius: 9999px;
        padding: 5px 14px;
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: 0.6px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        margin-bottom: 12px;
    }

    .eyebrow-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #f59e0b;
        box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
        animation: pulse-dot 2s infinite;
    }

    @keyframes pulse-dot {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
        }
        70% {
            transform: scale(1);
            box-shadow: 0 0 0 6px rgba(245, 158, 11, 0);
        }
        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0);
        }
    }

    .locations-classic-title {
        font-size: 30px;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.6px;
        margin: 0 0 8px;
        line-height: 1.25;
    }

    .locations-classic-desc {
        font-size: 15px;
        color: #64748b;
        margin: 0;
        line-height: 1.55;
    }

    .locations-header-pills {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .feature-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 7px 12px;
        font-size: 12.5px;
        font-weight: 600;
        color: #334155;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
    }

    /* 12 Classic Grid */
    .locations-classic-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
    }

    @media (max-width: 1199px) {
        .locations-classic-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }
    }

    @media (max-width: 991px) {
        .locations-classic-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }
        .locations-classic-title {
            font-size: 24px;
        }
        .serving-locations-section {
            padding: 48px 0 44px;
        }
    }

    @media (max-width: 575px) {
        .locations-classic-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        .locations-classic-title {
            font-size: 21px;
        }
        .locations-classic-desc {
            font-size: 14px;
        }
        .locations-header-pills {
            display: none;
        }
    }

    /* Classic Location Card */
    .classic-location-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 160px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 18px 20px 16px;
        text-decoration: none;
        position: relative;
        overflow: hidden;
        transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 2px 5px rgba(15, 23, 42, 0.03), 0 1px 2px rgba(15, 23, 42, 0.02);
    }

    .card-accent-bar {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #fdb813 0%, #f59e0b 100%);
        opacity: 0;
        transition: opacity 0.25s ease;
    }

    .classic-location-card:hover {
        background: #ffffff;
        border-color: #fdb813;
        transform: translateY(-4px);
        box-shadow: 0 14px 28px -4px rgba(15, 23, 42, 0.08), 0 6px 14px -2px rgba(253, 184, 19, 0.2);
    }

    .classic-location-card:hover .card-accent-bar {
        opacity: 1;
    }

    .card-top-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .route-category-tag {
        display: inline-flex;
        align-items: center;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #92400e;
        background: #fef3c7;
        border-radius: 6px;
        padding: 3px 8px;
    }

    .card-arrow-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #64748b;
        font-size: 11px;
        transition: all 0.25s ease;
    }

    .classic-location-card:hover .card-arrow-circle {
        background: #fdb813;
        border-color: #fdb813;
        color: #000000;
        transform: translateX(3px);
    }

    .card-main-content {
        margin-bottom: 14px;
        flex: 1;
    }

    .route-title-text {
        font-size: 14.5px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.4;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.2s ease;
    }

    .classic-location-card:hover .route-title-text {
        color: #000000;
    }

    .card-bottom-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid #f1f5f9;
        padding-top: 10px;
        margin-top: auto;
    }

    .route-perk {
        font-size: 11.5px;
        font-weight: 600;
        color: #64748b;
        display: flex;
        align-items: center;
    }

    .book-route-cta {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
        font-weight: 700;
        color: #0f172a;
        transition: all 0.2s ease;
    }

    .classic-location-card:hover .book-route-cta {
        color: #d97706;
        transform: translateX(2px);
    }
</style>
