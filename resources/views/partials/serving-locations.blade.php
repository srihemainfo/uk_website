@php
    $servingLocations = collect([]);
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('dynamic_pages')) {
            $servingLocations = \Illuminate\Support\Facades\Cache::remember('footer_serving_locations_v2', 300, function () {
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

<!-- Our Serving Locations (Light Theme Section) -->
<section class="serving-locations-section">
    <div class="container">
        <div class="locations-header-row">
            <div>
                <div class="locations-badge">
                    <span class="locations-pulse-dot"></span>
                    <i class="fas fa-location-dot me-1 text-warning"></i> UK Coverage
                </div>
                <h3 class="locations-main-title">Our Serving Locations</h3>
                <p class="locations-main-subtitle">
                    Explore top UK airport transfers, fixed-fare city cabs, and chauffeured private hire routes
                </p>
            </div>
        </div>

        <div class="locations-cards-grid">
            @foreach($servingLocations as $location)
                @php
                    $locUrl = $baseLandingUrl . ltrim($location->slug, '/');
                @endphp
                <a href="{{ $locUrl }}" class="location-card-light" title="{{ $location->page_title }}">
                    <div class="location-card-left">
                        <span class="location-card-icon">
                            <i class="fas fa-car-side"></i>
                        </span>
                        <div class="location-card-info">
                            <h4 class="location-card-title">{{ $location->page_title }}</h4>
                            <span class="location-card-meta">
                                <i class="fas fa-check-circle text-success me-1"></i> Fixed Fare &bull; 24/7 Available
                            </span>
                        </div>
                    </div>
                    <span class="location-card-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<style>
    /* Serving Locations - Modern Light Theme */
    .serving-locations-section {
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        border-top: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
        padding: 54px 0 50px;
        position: relative;
    }

    .locations-header-row {
        margin-bottom: 26px;
    }

    .locations-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #fffbeb;
        color: #b45309;
        border: 1px solid #fef08a;
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.4px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .locations-pulse-dot {
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

    .locations-main-title {
        font-size: 26px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 6px;
        letter-spacing: -0.4px;
    }

    .locations-main-subtitle {
        font-size: 15px;
        color: #64748b;
        margin: 0;
        line-height: 1.5;
        max-width: 780px;
    }

    .locations-cards-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    @media (max-width: 1199px) {
        .locations-cards-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }
    }

    @media (max-width: 991px) {
        .locations-cards-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .locations-main-title {
            font-size: 22px;
        }
        .serving-locations-section {
            padding: 42px 0 38px;
        }
    }

    @media (max-width: 575px) {
        .locations-cards-grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }
        .locations-main-title {
            font-size: 20px;
        }
        .locations-main-subtitle {
            font-size: 13.5px;
        }
    }

    .location-card-light {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 16px;
        color: #1e293b;
        text-decoration: none;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 5px rgba(15, 23, 42, 0.03), 0 1px 2px rgba(15, 23, 42, 0.02);
    }

    .location-card-light:hover {
        background: #ffffff;
        border-color: #fdb813;
        color: #0f172a;
        transform: translateY(-3px);
        box-shadow: 0 12px 24px -4px rgba(15, 23, 42, 0.08), 0 4px 12px -2px rgba(253, 184, 19, 0.22);
    }

    .location-card-left {
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
        min-width: 0;
    }

    .location-card-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        min-width: 38px;
        border-radius: 10px;
        background: #fffbeb;
        color: #d97706;
        border: 1px solid #fef3c7;
        font-size: 14px;
        transition: all 0.25s ease;
    }

    .location-card-light:hover .location-card-icon {
        background: #fdb813;
        color: #000000;
        border-color: #fdb813;
        transform: scale(1.06);
    }

    .location-card-info {
        flex: 1;
        min-width: 0;
    }

    .location-card-title {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 3px;
        line-height: 1.35;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.2s ease;
    }

    .location-card-light:hover .location-card-title {
        color: #000000;
    }

    .location-card-meta {
        font-size: 11.5px;
        color: #64748b;
        font-weight: 500;
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .location-card-arrow {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        min-width: 30px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #64748b;
        font-size: 12px;
        transition: all 0.25s ease;
        margin-left: 4px;
    }

    .location-card-light:hover .location-card-arrow {
        background: #fdb813;
        color: #000000;
        transform: translateX(3px);
    }
</style>
