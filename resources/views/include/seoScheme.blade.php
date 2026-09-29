@php
    // Safe initialization with fallback values to prevent "Undefined variable" errors
    $currentUrl = url()->current();
    $firstSegment  = request()->segment(1);
    $secondSegment = request()->segment(2);
    $thirdSegment  = request()->segment(3);
    
    $seoTags = $seoTags ?? [];
    
    $faqData = $seoTags['faqData'] ?? [];
    $blogPages = $seoTags['blogPages'] ?? [];
    
    // Fallback support mobile (you may want to update the fallback to a UK number)
    $supportMobile = env('SUPPORT_MOBILE') ?: '+91 63697 42104';
@endphp

{{-- Blog Single Article Schema --}}
@if ($firstSegment == 'blog' && $thirdSegment != null)
    @php
        $articleSchema = [
            "@context" => "https://schema.org",
            "@type" => "Article",
            "mainEntityOfPage" => [
                "@type" => "WebPage",
                "@id" => $currentUrl
            ],
            "headline" => $seoTags['shortNote'] ?? '',
            "description" => $seoTags['wikiDes'] ?? '',
            "image" => $seoTags['img'] ?? '',  
            "author" => [
                "@type" => "Organization",
                "name" => "GoRide Run Pvt. Ltd.",
                "url" => url('/')
            ],  
            "publisher" => [
                "@type" => "Organization",
                "name" => "GoRide",
                "url" => url('/'),
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => url('goride/img/logo-light.webp')
                ]
            ],
            "datePublished" => $seoTags['wikiDesHtml'] ?? '',
            "dateModified" => $seoTags['wikiDesHtml'] ?? ''
        ];
        
        $breadcrumbSchema = [
            "@context" => "https://schema.org/", 
            "@type" => "BreadcrumbList", 
            "itemListElement" => [
                [
                    "@type" => "ListItem", 
                    "position" => 1, 
                    "name" => "Blog",
                    "item" => url($firstSegment)
                ],
                [
                    "@type" => "ListItem", 
                    "position" => 2, 
                    "name" => $seoTags['blogPages']['second'] ?? '',
                    "item" => url("$firstSegment/$secondSegment")
                ],
                [
                    "@type" => "ListItem", 
                    "position" => 3, 
                    "name" => $seoTags['blogPages']['third'] ?? '',
                    "item" => url("$firstSegment/$secondSegment/$thirdSegment")  
                ]
            ]
        ];
    @endphp
    
    <script type="application/ld+json">
        {!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    
    @if (!empty($faqData))
        @php
            $faqSchema = [
                "@context" => "https://schema.org",
                "@type" => "FAQPage",
                "mainEntity" => []
            ];
            foreach ($faqData as $faq) {
                $faqSchema['mainEntity'][] = [
                    "@type" => "Question",
                    "name" => $faq['question'] ?? '',
                    "acceptedAnswer" => [
                        "@type" => "Answer",
                        "text" => $faq['answer'] ?? ''
                    ]
                ];
            }
        @endphp
        <script type="application/ld+json">
            {!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>
    @endif
      
    <script type="application/ld+json">
        {!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endif

{{-- Blog Index / List Schema --}}
@if ($firstSegment == 'blog' && $thirdSegment == null)
    @php
        $localBusinessSchema = [
            "@context" => "https://schema.org",
            "@type" => "LocalBusiness",
            "name" => "GoRide",
            "image" => url('goride/img/logo-dark-2.png'),
            "@id" => url('/'),
            "url" => url('/'),
            "telephone" => $supportMobile,
            "priceRange" => "0-9999",
            "address" => [
                "@type" => "PostalAddress",
                "addressCountry" => "GB" // Updated to UK ISO code
            ],
            "openingHoursSpecification" => [
                "@type" => "OpeningHoursSpecification",
                "dayOfWeek" => ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                "opens" => "00:00",
                "closes" => "23:59"
            ],
            "sameAs" => [
                "https://www.facebook.com/goride25",
                "https://twitter.com/go_rides8499",
                "https://www.instagram.com/goride.run/",
                "https://www.youtube.com/channel/UCK60VSKjbjLDhNlGzDCYDow",
                "https://www.linkedin.com/company/goride-run/posts/?feedView=all",
                url('/')
            ]
        ];

        $organizationSchema = [
            "@context" => "https://schema.org",
            "@type" => "Organization",
            "name" => "GoRide",
            "url" => url('/'),
            "logo" => url('goride/img/logo-dark.png'),
            "contactPoint" => [
                "@type" => "ContactPoint",
                "telephone" => $supportMobile,
                "contactType" => "customer service",
                "areaServed" => "GB", // Updated to UK ISO code
                "availableLanguage" => "en"
            ],
            "sameAs" => [
                "https://www.facebook.com/goride25",
                "https://x.com/go_rides8499",
                "https://www.instagram.com/go_ride.run/",
                "https://www.youtube.com/channel/UCK60VSKjbjLDhNlGzDCYDow",
                "https://www.linkedin.com/company/goride-run",
                url('/')
            ]
        ];

        $blogPostsArr = [];
        foreach($blogPages as $post) {
            $postUrl = $post['slug'] ?? '';
            $date = !empty($post['published_date']) ? \Carbon\Carbon::parse($post['published_date'])->toIso8601String() : \Carbon\Carbon::now()->toIso8601String();
            
            $blogPostsArr[] = [
                "@type" => "BlogPosting",
                "@id" => url($postUrl),
                "headline" => $post['blog_title'] ?? '',
                "url" => url($postUrl),
                "image" => [
                    "@type" => "ImageObject",
                    "url" => url($post['thumbnail'] ?? '')
                ],
                "datePublished" => $date,
                "dateModified" => $date,
                "author" => [
                    "@type" => "Organization",
                    "name" => "GoRide",
                    "url" => url('/')
                ]
            ];
        }
        
        $blogSchema = [
            "@context" => "https://schema.org",
            "@type" => "Blog",
            "@id" => $currentUrl,
            "name" => "GoRide Blog",
            "url" => $currentUrl,
            "description" => "GoRide Blog shares everything you need to know about taxi services, one way cab booking, round trip cabs, online cab booking tips, affordable rides, and safe travel guides.",
            "publisher" => [
                "@type" => "Organization",
                "name" => "GoRide",
                "url" => url('/'),
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => url('goride/img/logo-dark.png')
                ]
            ],
            "blogPost" => $blogPostsArr
        ];
    @endphp
    
    <script type="application/ld+json">
        {!! json_encode($localBusinessSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    
    <script type="application/ld+json">
        {!! json_encode($organizationSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    <script type="application/ld+json">
        {!! json_encode($blogSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endif