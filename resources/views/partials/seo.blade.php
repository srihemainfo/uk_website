@php
    // Allow custom view-level overrides via Blade sections or variables
    $overrides = [
        'title' => trim($__env->yieldContent('meta_title')) ?: ($seoTitle ?? null),
        'description' => trim($__env->yieldContent('meta_description')) ?: ($seoDescription ?? null),
        'keywords' => trim($__env->yieldContent('meta_keywords')) ?: ($seoKeywords ?? null),
        'canonical_url' => trim($__env->yieldContent('canonical_url')) ?: ($canonicalUrl ?? null),
        'og_image' => trim($__env->yieldContent('og_image')) ?: ($ogImage ?? null),
        'og_type' => trim($__env->yieldContent('og_type')) ?: ($ogType ?? null),
    ];

    $seo = App\Services\SeoService::get(null, $overrides);
@endphp

<!-- Primary Meta Tags -->
<title>{{ $seo['title'] }}</title>
<meta name="title" content="{{ $seo['title'] }}">
<meta name="description" content="{{ $seo['description'] }}">
@if(!empty($seo['keywords']))
<meta name="keywords" content="{{ $seo['keywords'] }}">
@endif
<meta name="robots" content="{{ $seo['robots'] ?? 'index, follow' }}">
<link rel="alternate" hreflang="x-default" href="https://www.goride.run/global">
<link rel="alternate" hreflang="en-IN" href="https://www.goride.run/in">
<link rel="alternate" hreflang="en-GB" href="https://www.goride.run/uk">
<link rel="canonical" href="{{ $seo['canonical_url'] }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $seo['og_type'] ?? 'website' }}">
<meta property="og:url" content="{{ $seo['canonical_url'] }}">
<meta property="og:title" content="{{ $seo['title'] }}">
<meta property="og:description" content="{{ $seo['description'] }}">
<meta property="og:image" content="{{ $seo['og_image'] }}">
<meta property="og:site_name" content="GoRide UK">
<meta property="og:locale" content="en_GB">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $seo['canonical_url'] }}">
<meta name="twitter:title" content="{{ $seo['title'] }}">
<meta name="twitter:description" content="{{ $seo['description'] }}">
<meta name="twitter:image" content="{{ $seo['og_image'] }}">

<!-- JSON-LD Structured Data Schema -->
@if(!empty($seo['schema']))
<script type="application/ld+json">
{!! json_encode($seo['schema'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif

@php
    $allowedClarityHosts = ['goride.run', 'www.goride.run', 'uk.goride.run', 'www.uk.goride.run'];
    $currentHost = request()->getHost();
@endphp
@if(in_array($currentHost, $allowedClarityHosts))
<!-- Clarity tracking script (Deferred) -->
<script type="text/javascript">
    if (['goride.run', 'www.goride.run', 'uk.goride.run', 'www.uk.goride.run'].includes(window.location.hostname)) {
        function initClarity() {
            (function(c,l,a,r,i,t,y){
                c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
                t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
                y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
            })(window, document, "clarity", "script", "y5rcj0m8tw");
        }
        if (document.readyState === 'complete') {
            setTimeout(initClarity, 800);
        } else {
            window.addEventListener('load', function() { setTimeout(initClarity, 800); });
        }
    }
</script>
@endif
