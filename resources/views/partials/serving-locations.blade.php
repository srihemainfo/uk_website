@php
    $servingLocations = collect([]);
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('dynamic_pages')) {
            $servingLocations = \Illuminate\Support\Facades\Cache::remember('serving_locations_real_v5', 300, function () {
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

    $baseLandingUrl = rtrim(env('WEBSITE_APP_URL') ?: url('/'), '/') . '/' . trim(env('COUNTRY_SLUG_II') ?: (env('COUNTRY_SLUG') ?: 'uk'), '/') . '/';
@endphp

@if($servingLocations->isNotEmpty())
<!-- Our Serving Locations (Classic & Premium Listing) -->
<section class="serving-locations-section">
    <div class="container">
        <!-- Section Header -->
        <div class="classic-locations-header">
            <div class="classic-locations-badge">
                <span class="classic-pulse-dot"></span>
                <i class="fas fa-location-dot"></i>
                <span>UK COVERAGE</span>
            </div>
            <h3 class="classic-locations-title">Our Serving Locations</h3>
            <p class="classic-locations-subtitle">
                Explore top UK airport transfers, city routes, and chauffeured private hire destinations
            </p>
        </div>

        <!-- Classic Listing Grid (Real Published Data Only, Up to 12) -->
        <div class="classic-locations-grid">
            @foreach($servingLocations as $location)
                @php
                    $locUrl = $baseLandingUrl . ltrim($location->slug, '/');
                @endphp
                <a href="{{ $locUrl }}" target="_blank" rel="noopener noreferrer" class="classic-location-item" title="{{ $location->page_title }}">
                    <div class="classic-item-content">
                        <span class="classic-item-icon">
                            <i class="fas fa-car-side"></i>
                        </span>
                        <span class="classic-item-title">{{ $location->page_title }}</span>
                    </div>
                    <span class="classic-item-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<style>
    /* Classic & Premium Serving Locations Listing */
    .serving-locations-section {
        background: #f8fafc;
        border-top: 1px solid #edf2f7;
        border-bottom: 1px solid #edf2f7;
        padding: 54px 0 50px;
        position: relative;
        font-family: 'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .classic-locations-header {
        margin-bottom: 28px;
    }

    .classic-locations-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #fffbeb;
        border: 1px solid #fef08a;
        color: #92400e;
        border-radius: 9999px;
        padding: 4px 13px;
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .classic-pulse-dot {
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

    .classic-locations-title {
        font-size: 28px;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.5px;
        margin: 0 0 6px;
        line-height: 1.25;
    }

    .classic-locations-subtitle {
        font-size: 15px;
        color: #64748b;
        margin: 0;
        line-height: 1.5;
        max-width: 740px;
    }

    /* 3-Column Classic Listing Directory */
    .classic-locations-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }

    @media (max-width: 1199px) {
        .classic-locations-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
    }

    @media (max-width: 991px) {
        .classic-locations-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .classic-locations-title {
            font-size: 24px;
        }
        .serving-locations-section {
            padding: 44px 0 40px;
        }
    }

    @media (max-width: 575px) {
        .classic-locations-grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }
        .classic-locations-title {
            font-size: 21px;
        }
        .classic-locations-subtitle {
            font-size: 13.5px;
        }
    }

    /* Classic Listing Item */
    .classic-location-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 18px;
        text-decoration: none;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 2px 4px rgba(15, 23, 42, 0.02), 0 1px 2px rgba(15, 23, 42, 0.02);
    }

    .classic-location-item:hover {
        background: #ffffff;
        border-color: #fdb813;
        transform: translateY(-2px);
        box-shadow: 0 10px 22px -4px rgba(15, 23, 42, 0.06), 0 4px 10px -2px rgba(253, 184, 19, 0.2);
    }

    .classic-item-content {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
        flex: 1;
    }

    .classic-item-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 9px;
        background: #fffbeb;
        color: #d97706;
        border: 1px solid #fef3c7;
        font-size: 13.5px;
        transition: all 0.25s ease;
    }

    .classic-location-item:hover .classic-item-icon {
        background: #fdb813;
        color: #000000;
        border-color: #fdb813;
        transform: scale(1.05);
    }

    .classic-item-title {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.2s ease;
    }

    .classic-location-item:hover .classic-item-title {
        color: #000000;
    }

    .classic-item-arrow {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        min-width: 28px;
        border-radius: 50%;
        background: #f8fafc;
        color: #94a3b8;
        font-size: 11px;
        transition: all 0.25s ease;
        margin-left: auto;
    }

    .classic-location-item:hover .classic-item-arrow {
        background: #fdb813;
        color: #000000;
        transform: translateX(3px);
    }
</style>
@endif
