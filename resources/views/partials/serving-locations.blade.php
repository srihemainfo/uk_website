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

    // Ensure adequate items per marquee sequence to guarantee seamless loop across ultra-wide monitors
    $marqueeList = $servingLocations;
    if ($marqueeList->count() > 0 && $marqueeList->count() < 8) {
        $marqueeList = $marqueeList->concat($servingLocations);
    }
@endphp

@if($servingLocations->isNotEmpty())
<!-- Our Serving Locations (Continuous Smooth Auto-Scroll Marquee) -->
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
    </div>

    <!-- Smooth Infinite Marquee Track -->
    <div class="locations-marquee-wrapper">
        <div class="locations-marquee-track">
            <!-- Sequence 1 -->
            <div class="locations-marquee-group">
                @foreach($marqueeList as $location)
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

            <!-- Sequence 2 (Duplicate for Seamless Infinite Loop) -->
            <div class="locations-marquee-group" aria-hidden="true">
                @foreach($marqueeList as $location)
                    @php
                        $locUrl = $baseLandingUrl . ltrim($location->slug, '/');
                    @endphp
                    <a href="{{ $locUrl }}" target="_blank" rel="noopener noreferrer" class="classic-location-item" tabindex="-1">
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
    </div>
</section>

<style>
    /* Classic & Premium Serving Locations with Continuous Smooth Marquee */
    .serving-locations-section {
        background: #f8fafc;
        border-top: 1px solid #edf2f7;
        border-bottom: 1px solid #edf2f7;
        padding: 54px 0 46px;
        position: relative;
        overflow: hidden;
        font-family: 'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .classic-locations-header {
        margin-bottom: 24px;
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

    /* Continuous Smooth Marquee Track */
    .locations-marquee-wrapper {
        width: 100%;
        overflow: hidden;
        position: relative;
        padding: 8px 0 14px;
        mask-image: linear-gradient(to right, transparent 0%, black 4%, black 96%, transparent 100%);
        -webkit-mask-image: linear-gradient(to right, transparent 0%, black 4%, black 96%, transparent 100%);
    }

    .locations-marquee-track {
        display: flex;
        width: max-content;
        gap: 16px;
        user-select: none;
    }

    .locations-marquee-group {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-shrink: 0;
        animation: smooth-scroll-marquee 38s linear infinite;
        will-change: transform;
    }

    @keyframes smooth-scroll-marquee {
        0% {
            transform: translate3d(0, 0, 0);
        }
        100% {
            transform: translate3d(calc(-100% - 16px), 0, 0);
        }
    }

    /* Pause on hover so user can easily click */
    .locations-marquee-wrapper:hover .locations-marquee-group {
        animation-play-state: paused;
    }

    /* Classic Listing Item inside Marquee */
    .classic-location-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        width: 320px;
        min-width: 320px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 18px;
        text-decoration: none;
        flex-shrink: 0;
        transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1),
                    border-color 0.25s ease,
                    box-shadow 0.25s ease,
                    background-color 0.25s ease;
        box-shadow: 0 2px 4px rgba(15, 23, 42, 0.02), 0 1px 2px rgba(15, 23, 42, 0.02);
    }

    .classic-location-item:hover {
        background: #ffffff;
        border-color: #fdb813;
        transform: translateY(-3px);
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

    @media (max-width: 767px) {
        .classic-location-item {
            width: 270px;
            min-width: 270px;
            padding: 12px 15px;
        }
        .classic-locations-title {
            font-size: 22px;
        }
        .classic-locations-subtitle {
            font-size: 13.5px;
        }
        .locations-marquee-group {
            animation-duration: 28s;
        }
    }
</style>
@endif
