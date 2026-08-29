<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class SeoService
{
    /**
     * Path to the SEO JSON file.
     */
    protected static string $jsonPath = 'resources/data/seo.json';

    /**
     * Cache for parsed SEO items.
     */
    protected static ?array $seoData = null;

    /**
     * Get all SEO data from the JSON file.
     */
    public static function all(): array
    {
        if (self::$seoData === null) {
            $fullPath = base_path(self::$jsonPath);
            if (File::exists($fullPath)) {
                $content = File::get($fullPath);
                self::$seoData = json_decode($content, true) ?: [];
            } else {
                self::$seoData = [];
            }
        }

        return self::$seoData;
    }

    /**
     * Find SEO entry for the current request or a given key/path.
     */
    public static function get(?string $key = null, array $overrides = []): array
    {
        $all = self::all();

        // 1. Direct key match (e.g., 'home', 'about', 'contact', 'blog', 'privacy', 'terms')
        if ($key && isset($all[$key])) {
            return self::formatEntry($all[$key], $overrides);
        }

        // 2. Detect from current Route name
        $routeName = Route::currentRouteName();
        if ($routeName) {
            foreach ($all as $itemKey => $item) {
                if (isset($item['route_names']) && in_array($routeName, $item['route_names'], true)) {
                    return self::formatEntry($item, $overrides);
                }
                if ($itemKey === $routeName) {
                    return self::formatEntry($item, $overrides);
                }
            }
        }

        // 3. Detect from current Request path (e.g. 'uk', 'uk/about', 'about', 'uk/contact', etc.)
        $currentPath = trim(request()->path(), '/');
        $rawPath = '/' . $currentPath;

        foreach ($all as $itemKey => $item) {
            if (isset($item['paths'])) {
                foreach ($item['paths'] as $pathOption) {
                    $normalized = trim($pathOption, '/');
                    if ($normalized === $currentPath || $pathOption === $rawPath || $pathOption === request()->getRequestUri()) {
                        return self::formatEntry($item, $overrides);
                    }
                }
            }

            if (isset($item['slug']) && (trim($item['slug'], '/') === $currentPath || $item['slug'] === $rawPath)) {
                return self::formatEntry($item, $overrides);
            }
        }

        // 4. Fallback matching without 'uk/' prefix if requested
        $strippedPath = preg_replace('#^uk(/|$)#', '', $currentPath);
        $strippedPath = trim($strippedPath, '/');

        if ($strippedPath === '' && isset($all['home'])) {
            return self::formatEntry($all['home'], $overrides);
        }

        if ($strippedPath && isset($all[$strippedPath])) {
            return self::formatEntry($all[$strippedPath], $overrides);
        }

        // 5. Default fallback to home or generic
        $default = $all['home'] ?? [
            'title' => 'GoRide UK – Taxi, Cab & Airport Transfer Booking',
            'description' => 'Book reliable taxis, cabs and airport transfers across the UK with GoRide. Get competitive fares, choose your preferred vehicle and book your ride online with ease.',
            'keywords' => 'GoRide UK, taxi booking UK, cab booking UK, airport transfer UK, UK taxi service, private hire taxi, airport taxi UK, online taxi booking',
            'og_type' => 'website',
            'og_image' => '/goride/img/logo-dark.png',
        ];

        return self::formatEntry($default, $overrides);
    }

    /**
     * Format entry with canonical URLs, images, and schema markup.
     */
    protected static function formatEntry(array $data, array $overrides = []): array
    {
        $merged = array_merge($data, array_filter($overrides, fn($val) => $val !== null && $val !== ''));

        $title = $merged['title'] ?? 'GoRide UK';
        $description = $merged['description'] ?? '';
        $keywords = $merged['keywords'] ?? '';
        $ogType = $merged['og_type'] ?? 'website';
        $robots = $merged['robots'] ?? 'index, follow';

        // Base URL & Canonical formatting
        $websiteUrl = env('WEBSITE_APP_URL') ?: (env('WEB_APP_URL') ?: url('/'));
        $websiteUrl = rtrim($websiteUrl, '/');

        $countrySlug = env('COUNTRY_SLUG_II') ?: (env('COUNTRY_SLUG') ?: '/uk');
        $countrySlug = '/' . trim($countrySlug, '/');

        if (!empty($merged['canonical_url'])) {
            $canonicalUrl = $merged['canonical_url'];
        } else {
            $slug = isset($merged['slug']) ? '/' . ltrim($merged['slug'], '/') : ('/' . trim(request()->path(), '/'));
            if ($slug !== '/' && !str_starts_with($slug, $countrySlug)) {
                $canonicalUrl = $websiteUrl . $countrySlug . $slug;
            } else {
                $canonicalUrl = $websiteUrl . ($slug === '/' ? $countrySlug : $slug);
            }
        }

        // Image formatting: Prefix with WEBSITE_APP_URL and COUNTRY_SLUG
        $ogImage = $merged['og_image'] ?? '/goride/img/logo-dark.png';
        if (!str_starts_with($ogImage, 'http://') && !str_starts_with($ogImage, 'https://')) {
            $imagePath = '/' . ltrim($ogImage, '/');
            $ogImage = $websiteUrl . $countrySlug . $imagePath;
        }

        // Schema markup
        $schema = self::buildSchema($title, $description, $canonicalUrl, $ogImage, $ogType, $websiteUrl, $countrySlug);

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'canonical_url' => $canonicalUrl,
            'og_type' => $ogType,
            'og_image' => $ogImage,
            'robots' => $robots,
            'schema' => $schema,
        ];
    }

    /**
     * Generate JSON-LD Schema.
     */
    protected static function buildSchema(string $title, string $description, string $url, string $image, string $type, ?string $websiteUrl = null, ?string $countrySlug = null): array
    {
        $websiteUrl = $websiteUrl ?: rtrim(env('WEBSITE_APP_URL') ?: (env('WEB_APP_URL') ?: url('/')), '/');
        $countrySlug = $countrySlug ?: ('/' . trim(env('COUNTRY_SLUG_II') ?: (env('COUNTRY_SLUG') ?: '/uk'), '/'));

        $siteUrl = $websiteUrl . $countrySlug;
        $logoUrl = $websiteUrl . $countrySlug . '/goride/img/logo-dark.png';

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Organization',
                    '@id' => $siteUrl . '/#organization',
                    'name' => 'GoRide UK',
                    'url' => $siteUrl,
                    'logo' => [
                        '@type' => 'ImageObject',
                        '@id' => $siteUrl . '/#logo',
                        'url' => $logoUrl,
                        'caption' => 'GoRide UK'
                    ],
                    'sameAs' => [
                        'https://www.facebook.com/goride25',
                        'https://x.com/go_rides8499',
                        'https://www.instagram.com/goride.run/',
                        'https://www.linkedin.com/company/goride-run'
                    ]
                ],
                [
                    '@type' => 'WebSite',
                    '@id' => $siteUrl . '/#website',
                    'url' => $siteUrl,
                    'name' => 'GoRide UK',
                    'description' => 'Taxi, Cab & Airport Transfer Booking in the UK',
                    'publisher' => [
                        '@id' => $siteUrl . '/#organization'
                    ],
                    'inLanguage' => 'en-GB'
                ],
                [
                    '@type' => 'WebPage',
                    '@id' => $url . '/#webpage',
                    'url' => $url,
                    'name' => $title,
                    'description' => $description,
                    'isPartOf' => [
                        '@id' => $siteUrl . '/#website'
                    ],
                    'inLanguage' => 'en-GB'
                ]
            ]
        ];
    }
}
