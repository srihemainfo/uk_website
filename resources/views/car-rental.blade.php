@extends('layouts.app')

@section('meta_title', $seoTitle ?? 'Heathrow Airport to Sutton Car Rental | GoRide UK')
@section('meta_description', $seoDescription ?? 'Pre-book your private transfer or car rental from London Heathrow Airport to Sutton. Fixed fares, flight tracking, and 24/7 service.')
@if(!empty($seoKeywords))
@section('meta_keywords', $seoKeywords)
@endif

@section('content')
<style>
    * {
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        margin: 0;
        padding: 0;
        background: #f9f9f9;
        color: #1a1c1c;
        font-size: 16px;
        line-height: 1.6;
        -webkit-font-smoothing: antialiased;
    }

    img {
        max-width: 100%;
        display: block;
    }

    a {
        text-decoration: none;
    }

    p {
        margin-top: 0;
        margin-bottom: 16px;
    }

    h1,
    h2,
    h3,
    h4 {
        color: #1a1c1c;
    }

    .fa,
    .fas,
    .far,
    .fab {
        line-height: 1;
    }


    .btn-primary-custom {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: #000000;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-primary-custom {
        padding: 12px 24px;
    }

    .btn-primary-custom .fas {
        font-size: 14px;
    }

    .hero-section {
        position: relative;
        overflow: hidden;
        /*background: #f9f9f9;*/
        padding: 30px 0;
    }

    .hero-row {
        row-gap: 50px;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .section-label {
        font-size: 12px;
        line-height: 20px;
        font-weight: 500;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        background: black;
        color: white;
        display: inline-flex;
        padding: 4px 9px;
        border-radius: 7px;
        margin-bottom: 10px;
    }

    .hero-heading h1 {
        margin: 0;

        font-size: 48px;
        line-height: 1.17;

        letter-spacing: -0.02em;

        font-weight: 800;
    }

    .hero-description {
        margin-top: 30px;

        color: #504533;

        font-size: 18px;
        line-height: 28px;

        font-weight: 300;
    }

    .hero-description strong {
        color: #1a1c1c;
        font-weight: 600;
    }

    .hero-button-wrapper {
        margin-top: 25px;
    }

    .hero-image-column {
        position: relative;
        z-index: 2;
    }

    .image-glow {
        position: absolute;

        inset: -8px;

        border-radius: 24px;

        filter: blur(12px);

        opacity: 0.7;
    }

    .main-image-card {
        position: relative;

        background: #ffffff;

        padding: 8px;

        border-radius: 24px;

        overflow: hidden;

        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.10);

        border: 1px solid rgba(226, 226, 226, 0.6);
    }

    .main-image-card img {
        width: 100%;

        aspect-ratio: 4 / 3;

        object-fit: cover;

        border-radius: 16px;

        transition: transform 0.7s ease;
    }

    .main-image-card:hover img {
        transform: scale(1.05);
    }

    .content-section {
        width: 100%;
        padding: 30px 0;
        background: #f9f9f9;
    }

    .section-light {
        background: #f3f3f3;
    }

    .section-row {
        row-gap: 60px;
        margin-bottom: 80px;
    }

    .section-row:last-child {
        margin-bottom: 0;
    }

    .section-heading {
        display: flex;
        flex-direction: column;
        gap: 8px;

        margin-bottom: 35px;
    }

    .section-heading h2 {
        font-size: 32px;
        font-weight: 700;
        color: #000;
        margin: 0;
        line-height: 1.3;
    }

    .section-heading p {
        margin: 0;
        font-size: 16px;
        line-height: 28px;

        font-weight: 400;
    }

    .content-image-card {
        background: #ffffff;

        padding: 8px;

        border-radius: 20px;

        overflow: hidden;

        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);

        border: 1px solid rgba(226, 226, 226, 0.6);

        transition:
            transform 0.5s ease,
            box-shadow 0.5s ease;
    }

    .content-image-card:hover {
        transform: translateY(-6px);

        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.12);
    }

    .content-image-card img {
        width: 100%;

        aspect-ratio: 4 / 3;

        object-fit: cover;

        border-radius: 14px;
    }

    .content-card {
        background: #ffffff;

        padding: 32px;

        border-radius: 24px;

        border: 1px solid rgba(226, 226, 226, 0.6);

        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.04);

        display: flow-root;
    }

    .content-card h2 {
        margin-top: 0;
        margin-bottom: 20px;

        font-size: 32px;

    }

    .content-card h3 {
        margin-top: 0;
        margin-bottom: 20px;

        font-size: 24px;
        line-height: 32px;

        font-weight: 600;
    }

    .content-card p {
        color: #504533;

        font-size: 16px;
        line-height: 24px;
    }


    .strong-text {
        color: #1a1c1c !important;
        font-weight: 600 !important;
    }

    .feature-list {
        list-style: none;

        padding: 0;
        margin: 20px 0;

        display: grid;

        grid-template-columns: repeat(2, minmax(0, 1fr));

        column-gap: 25px;
        row-gap: 12px;
    }

    .feature-list li {
        display: flex;
        align-items: flex-start;

        gap: 10px;

        color: #504533;

        font-size: 16px;
    }

    .feature-list .fas {
        color: #000000;
        font-size: 18px;
        width: 22px;
        flex-shrink: 0;
    }

    .info-box {
        margin-top: 20px;

        padding: 18px 20px;

        background: #f9f9f9;

        border-radius: 12px;

        border-left: 4px solid #000000;
    }

    .info-box p {
        margin: 0;

        color: #504533;

        font-style: italic;
    }


    .option-card {
        height: 100%;

        background: #ffffff;

        padding: 32px;

        border-radius: 24px;

        border: 1px solid rgba(226, 226, 226, 0.7);

        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.04);

        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease;
    }

    .option-card:hover {
        transform: translateY(-5px);

        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
    }

    .option-title {
        display: flex;
        align-items: center;

        gap: 10px;

        margin-bottom: 20px;
    }

    .option-title .fas {
        font-size: 24px;
        flex-shrink: 0;
    }

    .option-title h3 {
        margin: 0;

        font-size: 24px;
        line-height: 32px;

        font-weight: 600;
    }

    .option-card p,
    p {
        font-size: 16px;
        line-height: 24px;

        font-weight: 400;
    }

    .place-card {
        height: 100%;
        display: flex;
        flex-direction: column;
        background: #ffffff;
        padding: 8px 8px 20px 8px;
        border-radius: 20px;
        border: 1px solid rgba(226, 226, 226, 0.7);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
        overflow: hidden;
    }

    .place-image {
        border-radius: 14px;
        overflow: hidden;
    }

    .place-image img {
        width: 100%;
        aspect-ratio: 4 / 3;
        object-fit: cover;
        border-radius: 14px;
        transition: transform 0.5s ease;
    }

    .place-card:hover .place-image img {
        transform: scale(1.05);
    }

    .place-content {
        padding: 16px 12px 0 12px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .place-content h4 {
        margin: 0 0 8px;
        font-size: 17px;
        line-height: 24px;
        font-weight: 700;
        color: #1a1c1c;
    }

    .place-content p {
        margin: 0;
        color: #504533;
        font-size: 14px;
        line-height: 20px;
    }

    .large-info-card {
        margin-top: 35px;

        padding: 32px;

        background: #f3f3f3;

        border-radius: 24px;

        border: 1px solid rgba(226, 226, 226, 0.7);
    }

    .large-info-card p {
        color: #504533;

        font-size: 16px;
        line-height: 24px;
    }

    .large-info-card strong {
        color: #1a1c1c;
    }

    .icon-text {
        display: flex;
        align-items: flex-start;

        gap: 12px;

        margin-bottom: 18px;
    }

    .icon-text:last-child {
        margin-bottom: 0;
    }

    .icon-text .fas {

        font-size: 22px;
        width: 24px;
        flex-shrink: 0;
    }

    .icon-text p {
        margin: 0;
    }

    .benefit-item {
        height: 100%;
        background: #ffffff;
        padding: 24px;
        border-radius: 18px;
        border: 1px solid rgba(226, 226, 226, 0.7);
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
    }

    .benefit-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .benefit-icon-box {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #000000;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .benefit-header h4 {
        margin: 0;
        font-size: 17px;
        line-height: 23px;
        font-weight: 700;
        color: #1a1c1c;
    }

    .benefit-title {
        display: flex;
        align-items: center;

        gap: 8px;

        margin-bottom: 8px;
    }

    .benefit-title .fas {
        font-size: 20px;
        width: 22px;
        flex-shrink: 0;
    }

    .benefit-title h4 {
        margin: 0;

        font-size: 17px;
        line-height: 24px;

        font-weight: 600;
    }

    .benefit-item h4 {
        margin: 0 0 8px 0;

        font-size: 18px;
        line-height: 25px;

        font-weight: 700;
        color: #1a1c1c;
    }

    .benefit-item p {
        margin: 0;

        color: #504533;

        font-size: 14px;
        line-height: 21px;
    }

    .button-left {
        display: flex;
        justify-content: flex-start;

        margin-top: 25px;
    }

    .two-column-list {
        margin-bottom: 0;
    }

    .faq-section {
        background: #f9f9f9;
        padding: 60px 0;
    }

    .faq-section .container {
        max-width: 700px;
    }

    .section-title {
        font-size: 32px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 40px;
        color: #000000;
    }

    .faq-item {
        margin-bottom: 16px;
        border-radius: 12px;
        /* background: #ffffff; */
        border: none;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
        padding: 0px;
    }

    .faq-question {
        width: 100%;
        padding: 20px;
        /*background: #ffffff;*/
        border: none;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        font-size: 16px;
        font-weight: 600;
        color: #000000;
        text-align: left;
        transition: all 0.3s ease;
    }

    .faq-question:focus {
        outline: none;
    }

    .faq-icon {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        font-size: 14px;
        color: #000000;
        transition: transform 0.3s ease;
    }

    .faq-question.active .faq-icon {
        transform: rotate(180deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        transition: max-height 0.3s ease, opacity 0.3s ease, padding 0.3s ease;
        background: #f9f9f9;
        color: #504533;
        font-size: 15px;
        line-height: 24px;
    }

    .faq-answer.show {
        max-height: 500px;
        opacity: 1;
        padding: 0px;
    }

    @media (max-width: 991px) {

        .hero-section,
        .content-section {
            padding: 60px 0;
        }

        .hero-heading h1 {
            font-size: 40px;
            line-height: 48px;
        }

        .hero-row {
            row-gap: 40px;
        }

        .section-row {
            row-gap: 40px;
            margin-bottom: 60px;
        }

        .content-card {
            padding: 28px;
        }

        .content-card h2 {
            font-size: 28px;
            line-height: 36px;
        }

        .section-heading h2 {
            font-size: 30px;
            line-height: 38px;
        }

    }

    @media (max-width: 767px) {

        .header-wrapper {
            min-height: 72px;
        }

        .logo-img {
            height: 50px;
        }

        .header-button {
            display: none;
        }

        .hero-section,
        .content-section {
            padding: 45px 0;
        }

        .hero-heading h1 {
            font-size: 30px;
            line-height: 38px;
        }

        .section-label {
            font-size: 11px;
        }

        .hero-description {
            margin-top: 20px;

            font-size: 16px;
            line-height: 25px;
        }

        .hero-button-wrapper {
            margin-top: 20px;
        }

        .main-image-card {
            padding: 6px;
            border-radius: 18px;
        }

        .main-image-card img {
            border-radius: 12px;
        }

        .section-row {
            margin-bottom: 45px;
            row-gap: 30px;
        }

        .section-heading {
            margin-bottom: 25px;
        }

        .section-heading h2 {
            font-size: 26px;
            line-height: 34px;
        }

        .section-heading p {
            font-size: 16px;
            line-height: 25px;
        }

        .content-card {
            padding: 22px;

            border-radius: 18px;
        }

        .content-card h2 {
            font-size: 25px;
            line-height: 33px;
        }

        .content-card h3 {
            font-size: 22px;
            line-height: 30px;
        }

        .content-card .large-text {
            font-size: 16px;
            line-height: 25px;
        }

        .feature-list {
            grid-template-columns: 1fr;

            row-gap: 10px;
        }

        .feature-list li {
            font-size: 15px;
        }

        .option-card {
            padding: 22px;

            border-radius: 18px;
        }

        .option-title h3 {
            font-size: 21px;
            line-height: 28px;
        }

        .large-info-card {
            padding: 22px;

            border-radius: 18px;
        }

        .button-left {
            justify-content: flex-start;
        }

        .button-left .btn-primary-custom {
            width: auto;
        }

        .section-title {
            font-size: 27px;
            margin-bottom: 30px;
        }

        .faq-question {
            padding: 16px;
            font-size: 15px;
        }

        .faq-answer {
            font-size: 14px;
            line-height: 22px;
        }

    }

    @media (max-width: 575px) {

        .hero-section,
        .content-section {
            padding: 35px 0;
        }

        .hero-heading h1 {
            font-size: 28px;
            line-height: 36px;
        }

        .section-heading h2 {
            font-size: 24px;
            line-height: 32px;
        }

        .content-card {
            padding: 20px;
        }

        .content-card h2 {
            font-size: 23px;
            line-height: 31px;
        }

        .content-card h3 {
            font-size: 21px;
            line-height: 29px;
        }

        .info-box {
            padding: 15px;
        }

        .large-info-card {
            padding: 20px;
        }

        .btn-primary-custom {
            padding: 11px 18px;
            font-size: 14px;
        }

        .faq-section {
            padding: 40px 0;
        }

        .section-title {
            font-size: 24px;
            margin-bottom: 25px;
        }

    }

    .heathrow-image-card {
        margin: 12px 0;
    }

    .heathrow-image-card img {
        width: 100%;
        object-fit: cover;
        border-radius: 14px;
    }

    @media (min-width: 768px) {
        .heathrow-image-card {
            float: right;
            max-width: 320px;
            margin: 6px 0 20px 24px;
        }

        .heathrow-image-card img {
            max-height: 220px;
            aspect-ratio: 4 / 3;
        }
    }

    @media (max-width: 767px) {
        .heathrow-image-card {
            float: none;
            max-width: 100%;
            margin: 16px 0;
        }

        .heathrow-image-card img {
            max-height: 180px;
            aspect-ratio: 16 / 9;
        }
    }
</style>
<style>
.fleet-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 24px;
    border: 1px solid rgba(226, 226, 226, 0.7);
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.fleet-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
}
.fleet-price {
    font-size: 28px;
    font-weight: 800;
    color: #1a1c1c;
}
.fleet-specs {
    display: flex;
    gap: 16px;
    font-size: 14px;
    color: #504533;
    margin: 12px 0;
}
.cta-banner-section {
    background: #000000;
    color: #ffffff;
    padding: 60px 0;
    border-radius: 24px;
    margin: 40px auto;
}
.cta-banner-section h2 {
    color: #ffffff;
    font-size: 34px;
    font-weight: 800;
    margin-bottom: 12px;
}
.cta-banner-section p {
    color: #d1d5db;
    font-size: 17px;
    margin-bottom: 24px;
}
.btn-cta-light {
    background: #ffffff;
    color: #000000;
    padding: 12px 28px;
    border-radius: 10px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    transition: all 0.2s ease;
}
.btn-cta-light:hover {
    background: #f3f4f6;
    color: #000000;
    transform: scale(1.02);
}
.step-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 24px;
    border: 1px solid rgba(226, 226, 226, 0.7);
    height: 100%;
    position: relative;
}
.step-badge {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #000000;
    color: #ffffff;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 14px;
}
</style>


@php
    $pageSections = !empty($sections) && is_array($sections) ? $sections : [];
@endphp

@if(count($pageSections) > 0)
    {{-- ======================================================== --}}
    {{-- DYNAMIC MODULAR SECTIONS ENGINE --}}
    {{-- ======================================================== --}}
    @foreach($pageSections as $sec)
        @php
            $secType = $sec['type'] ?? '';
        @endphp

        {{-- 1. HERO SECTION --}}
        @if($secType === 'hero')
            <section class="hero-section">
                <div class="container">
                    <div class="row align-items-center hero-row">
                        <div class="col-lg-6 hero-content">
                            <div class="hero-heading">
                                @if(!empty($sec['badge']))
                                    <span class="section-label">{{ $sec['badge'] }}</span>
                                @endif
                                <h2>{{ $sec['title'] ?? 'Heathrow Airport to Sutton – Taxi, Transfer & Cab Booking' }}</h2>
                            </div>
                            <div class="hero-description">
                                <p>{{ $sec['subtitle'] ?? 'Planning a journey from Heathrow Airport to Sutton? Enjoy stress-free travel with upfront fixed pricing.' }}</p>
                            </div>
                            <div class="d-flex flex-wrap align-items-center gap-3 mt-4">
                                <a href="{{ $sec['btn_url'] ?? '/#booking' }}" class="btn-primary-custom">
                                    {{ $sec['btn_text'] ?? 'Get a Quote Now' }}
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </a>
                                @if(!empty($sec['stat_badge']))
                                    <span class="badge bg-light text-dark border px-3 py-2 fs-6">
                                        <i class="fas fa-stopwatch me-1"></i> {{ $sec['stat_badge'] }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 hero-image-column">
                            <div class="image-glow"></div>
                            <div class="main-image-card">
                                @php
                                    $heroImg = !empty($sec['image']) ? $sec['image'] : 'https://lh3.googleusercontent.com/aida/AEtjO1Uo2mQSfvJT4qOeIc0T11m2tHgxDThjvL1geAi4xxQVpZ_DZMikCYJ_hiz-K2Tbif26TEwluCnTrFZaVSweSPgFn53i8K4op3UL1zIWMGwgko6sd3RFddvIYaTFmODVfnKevLqLCdXq-42VWou7HEjHfDHS9bv-GOEqzz2u_NoZqRS6DUAdMRKeRWgPyj7tRd6d53cYPjURW9yazRbXpna1Vey80bx-UiYycLsHde_EkTXG4ay5JEpza1s';
                                @endphp
                                <img src="{{ $heroImg }}" alt="{{ $sec['title'] ?? 'London taxi transfer' }}" class="img-fluid rounded-4">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        {{-- 2. ROUTE OVERVIEW & HIGHLIGHTS --}}
        @elseif($secType === 'overview')
            @php
                $overviewImg = !empty($sec['image']) ? $sec['image'] : 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=900&q=80';
            @endphp
            <section class="content-section section-light">
                <div class="container">
                    <div class="row section-row">
                        <div class="col-lg-12">
                            <div class="content-card">
                                <div class="row align-items-center g-4">
                                    <div class="{{ !empty($overviewImg) ? 'col-lg-7' : 'col-lg-12' }}">
                                        <h2>{{ !empty($sec['title']) ? $sec['title'] : 'Route Overview & Journey Details' }}</h2>
                                        @if(!empty($sec['subtitle']))
                                            <p class="large-text text-muted mb-3">{{ $sec['subtitle'] }}</p>
                                        @endif
                                        @if(!empty($sec['description']))
                                            <p class="large-text mb-4">{{ $sec['description'] }}</p>
                                        @endif

                                        @if(!empty($sec['items']) && is_array($sec['items']))
                                            <div class="row g-3">
                                                @foreach($sec['items'] as $item)
                                                    <div class="{{ !empty($overviewImg) ? 'col-sm-6 col-md-4' : 'col-md-6 col-lg-3' }}">
                                                        <div class="benefit-item h-100">
                                                            <div class="benefit-header">
                                                                <div class="benefit-icon-box">
                                                                    <i class="fas {{ $item['icon'] ?? 'fa-car' }}" aria-hidden="true"></i>
                                                                </div>
                                                                <h4>{{ $item['title'] ?? '' }}</h4>
                                                            </div>
                                                            <p>{{ $item['desc'] ?? '' }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    @if(!empty($overviewImg))
                                        <div class="col-lg-5">
                                            <div class="route-overview-image-wrapper text-center">
                                                <img src="{{ $overviewImg }}" alt="{{ $sec['title'] ?? 'Route Journey Overview' }}" class="img-fluid rounded-4 shadow-sm w-100" style="object-fit: cover; object-position: center 70%; height: 240px; max-height: 240px; width: 100%; border: 1px solid rgba(0,0,0,0.06);">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        {{-- 3. FLEET PRICING SECTION --}}
        @elseif($secType === 'fleet_pricing')
            <section class="content-section">
                <div class="container">
                    <div class="section-heading text-center mb-5">
                        <h2>{{ !empty($sec['title']) ? $sec['title'] : 'Transparent Fleet Options & Pricing' }}</h2>
                        @if(!empty($sec['subtitle']))
                            <p class="text-muted">{{ $sec['subtitle'] }}</p>
                        @endif
                    </div>

                    @if(!empty($sec['vehicles']) && is_array($sec['vehicles']))
                        <div class="row g-4">
                            @foreach($sec['vehicles'] as $v)
                                <div class="col-md-6 col-lg-3">
                                    <div class="fleet-card">
                                        <div>
                                            <h4 class="fw-bold mb-1">{{ $v['name'] ?? 'Saloon' }}</h4>
                                            <div class="fleet-price mb-2">{{ $v['price'] ?? 'Fixed Quote' }}</div>
                                            <div class="fleet-specs">
                                                <span><i class="fas fa-user-group me-1"></i> {{ $v['passengers'] ?? '4' }} Seats</span>
                                                <span><i class="fas fa-suitcase me-1"></i> {{ $v['luggage'] ?? '2' }} Bags</span>
                                            </div>
                                            <p class="text-muted small mb-4">{{ $v['desc'] ?? 'Comfortable, air-conditioned vehicle' }}</p>
                                        </div>
                                        <a href="/#booking" class="btn btn-dark w-100 py-2 rounded-3 fw-semibold">
                                            Book This Vehicle
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>

        {{-- 4. WHY CHOOSE US SECTION --}}
        @elseif($secType === 'why_choose')
            <section class="content-section section-light">
                <div class="container">
                    <div class="section-heading text-center mb-5">
                        <h2>{{ !empty($sec['title']) ? $sec['title'] : 'Why Choose GoRide UK' }}</h2>
                        @if(!empty($sec['subtitle']))
                            <p class="text-muted">{{ $sec['subtitle'] }}</p>
                        @endif
                    </div>

                    @if(!empty($sec['features']) && is_array($sec['features']))
                        <div class="row g-4">
                            @foreach($sec['features'] as $f)
                                <div class="col-sm-6 col-lg-3">
                                    <div class="benefit-item">
                                        <div class="benefit-header">
                                            <div class="benefit-icon-box">
                                                <i class="fas {{ $f['icon'] ?? 'fa-check' }}" aria-hidden="true"></i>
                                            </div>
                                            <h4>{{ $f['title'] ?? '' }}</h4>
                                        </div>
                                        <p>{{ $f['desc'] ?? '' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>

        {{-- 5. HOW TO BOOK / STEP-BY-STEP --}}
        @elseif($secType === 'booking_steps')
            <section class="content-section">
                <div class="container">
                    <div class="section-heading text-center mb-5">
                        <h2>{{ !empty($sec['title']) ? $sec['title'] : 'How to Book in Simple Steps' }}</h2>
                        @if(!empty($sec['subtitle']))
                            <p class="text-muted">{{ $sec['subtitle'] }}</p>
                        @endif
                    </div>

                    @if(!empty($sec['steps']) && is_array($sec['steps']))
                        <div class="row g-4">
                            @foreach($sec['steps'] as $idx => $st)
                                <div class="col-md-4">
                                    <div class="step-card">
                                        <div class="step-badge">{{ $st['step'] ?? ($idx + 1) }}</div>
                                        <h4 class="fw-bold mb-2">{{ $st['title'] ?? '' }}</h4>
                                        <p class="text-muted small mb-0">{{ $st['desc'] ?? '' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>

        {{-- 6. FAQS SECTION --}}
        @elseif($secType === 'faqs')
            <section class="faq-section">
                <div class="container">
                    <h2 class="section-title">{{ !empty($sec['title']) ? $sec['title'] : 'Frequently Asked Questions' }}</h2>
                    @if(!empty($sec['subtitle']))
                        <p class="text-center text-muted mb-4">{{ $sec['subtitle'] }}</p>
                    @endif

                    @if(!empty($sec['faqs']) && is_array($sec['faqs']))
                        @foreach($sec['faqs'] as $fIdx => $faq)
                            <div class="faq-item">
                                <button class="faq-question {{ $fIdx === 0 ? 'active' : '' }}" onclick="toggleFaq(this)">
                                    {{ $faq['q'] ?? '' }}
                                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                                </button>
                                <div class="faq-answer {{ $fIdx === 0 ? 'show' : '' }}">
                                    {{ $faq['a'] ?? '' }}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </section>

        {{-- 7. CTA BANNER SECTION --}}
        @elseif($secType === 'cta')
            <div class="container">
                <div class="cta-banner-section text-center px-4">
                    <h2>{{ !empty($sec['title']) ? $sec['title'] : 'Ready for a Stress-Free Airport Transfer?' }}</h2>
                    <p>{{ $sec['subtitle'] ?? 'Book your ride in under 2 minutes with guaranteed fixed prices.' }}</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ $sec['btn_url'] ?? '/#booking' }}" class="btn-cta-light">
                            {{ $sec['btn_text'] ?? 'Book Your Ride Now' }}
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        @if(!empty($sec['phone']))
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $sec['phone']) }}" class="btn btn-outline-light px-4 py-2 rounded-3 fw-bold">
                                <i class="fas fa-phone me-2"></i> {{ $sec['phone'] }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>

        {{-- 8. CUSTOM CONTENT / HTML --}}
        @elseif($secType === 'custom_content')
            <section class="content-section">
                <div class="container">
                    @if(!empty($sec['title']))
                        <h2 class="mb-4">{{ $sec['title'] }}</h2>
                    @endif
                    <div>
                        {!! $sec['content'] ?? '' !!}
                    </div>
                </div>
            </section>

        {{-- 9. POPULAR AREAS / PLACES TO VISIT --}}
        @elseif($secType === 'places_showcase' || $secType === 'places')
            <section class="content-section">
                <div class="container">
                    @php
                        $placesTitle = !empty($sec['title']) ? $sec['title'] : (!empty($sec['heading']) ? $sec['heading'] : 'Popular Places & Areas to Visit');
                    @endphp
                    <div class="section-heading mb-4">
                        <h2>{{ $placesTitle }}</h2>
                        @if(!empty($sec['subtitle']))
                            <p class="text-muted">{{ $sec['subtitle'] }}</p>
                        @elseif(!empty($sec['description']))
                            <p class="text-muted">{{ $sec['description'] }}</p>
                        @endif
                    </div>

                    @if(!empty($sec['places']) && is_array($sec['places']))
                        <div class="row g-4">
                            @foreach($sec['places'] as $place)
                                <div class="col-md-6 col-lg-4">
                                    <div class="place-card">
                                        @if(!empty($place['image']))
                                            <div class="place-image">
                                                <img src="{{ $place['image'] }}" alt="{{ $place['title'] ?? '' }}">
                                            </div>
                                        @endif
                                        <div class="place-content">
                                            <h4>{{ $place['title'] ?? '' }}</h4>
                                            <p>{{ $place['desc'] ?? ($place['description'] ?? '') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        @endif

    @endforeach

@else
    {{-- ======================================================== --}}
    {{-- DEFAULT HARDCODED FALLBACK (HEATHROW TO SUTTON) --}}
    {{-- ======================================================== --}}
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center hero-row">
                <div class="col-lg-6 hero-content">
                    <div class="hero-heading">
                        <span class="section-label">Premium Transfer Service</span>
                        <h2>Heathrow Airport to Sutton – Taxi, Transfer &amp; Cab Booking</h2>
                    </div>
                    <div class="hero-description">
                        <p>
                            Planning a journey from <strong>Heathrow Airport to Sutton</strong>?
                            Whether you are arriving in London for business, visiting family, or continuing your journey to South
                            London, there are several ways to travel from Heathrow to Sutton.
                        </p>
                        <p>
                            GoRide makes it easier to arrange your <strong>Heathrow Airport to Sutton taxi</strong>
                            by connecting passengers with drivers and allowing you to compare available driver bids before choosing your ride.
                        </p>
                    </div>
                    <div class="hero-button-wrapper">
                        <a href="/#booking" class="btn-primary-custom">
                            Get a Quote Now
                            <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 hero-image-column">
                    <div class="image-glow"></div>
                    <div class="main-image-card">
                        <img src="https://lh3.googleusercontent.com/aida/AEtjO1Uo2mQSfvJT4qOeIc0T11m2tHgxDThjvL1geAi4xxQVpZ_DZMikCYJ_hiz-K2Tbif26TEwluCnTrFZaVSweSPgFn53i8K4op3UL1zIWMGwgko6sd3RFddvIYaTFmODVfnKevLqLCdXq-42VWou7HEjHfDHS9bv-GOEqzz2u_NoZqRS6DUAdMRKeRWgPyj7tRd6d53cYPjURW9yazRbXpna1Vey80bx-UiYycLsHde_EkTXG4ay5JEpza1s"
                            alt="Modern UK taxi in London">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section section-light">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="content-card">
                        <h2>Heathrow Airport – One of the World's Busiest Airports</h2>
                        <p class="large-text">
                            Heathrow Airport (LHR) is one of the UK's major international airports and an important gateway to
                            London. The airport has multiple terminals and serves passengers travelling to destinations across the UK
                            and around the world.
                        </p>
                        <ul class="feature-list">
                            <li><i class="fas fa-circle-check" aria-hidden="true"></i><span>International arrivals and departures</span></li>
                            <li><i class="fas fa-circle-check" aria-hidden="true"></i><span>Business and executive travel</span></li>
                            <li><i class="fas fa-circle-check" aria-hidden="true"></i><span>Airport transfers across London</span></li>
                            <li><i class="fas fa-circle-check" aria-hidden="true"></i><span>Family and group travel</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Popular Sutton Areas Fallback --}}
    <section class="content-section">
        <div class="container">
            <div class="section-heading mb-4">
                <h2>Popular Sutton Areas and Places to Visit</h2>
                <p class="text-muted">
                    Sutton is part of South London and offers a mixture of parks, heritage locations, shopping areas and leisure facilities. The London Borough of Sutton manages more than 600 hectares of parks and open spaces, giving the borough a strong green-space character.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="place-card">
                        <div class="place-image">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAFpVqcaaCr7A_NAhydaVFpuKZ3CpTtJY3wP1WiOmv0SxMNj_tRqqvVHR1ZesXeDDhdWbIdBIau-5DUtegRiCacbIOoMgKG9GzXxrei98T7sfV8ZosRQda3E6RVpbh_QUhXDQVYYTvyG3rCm1tGtv69pFnfnMh5lQgvBdSeNx0fRpmKt-pToFKPCaMfdJGpx7i3ZLncRfGMslNS9BjtgFdP3X7YpKbMVVopO240U3btaq9qnuQ_67Ky" alt="Sutton Town Centre & High Street">
                        </div>
                        <div class="place-content">
                            <h4>Sutton Town Centre &amp; High Street</h4>
                            <p>A vibrant retail hub with modern pedestrianised streets and diverse shopping options.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="place-card">
                        <div class="place-image">
                            <img src="https://images.unsplash.com/photo-1519331379826-f10be5486c6f?auto=format&fit=crop&w=800&q=80" alt="Nonsuch Park & Cheam">
                        </div>
                        <div class="place-content">
                            <h4>Nonsuch Park &amp; Cheam</h4>
                            <p>Historic parkland featuring the site of Henry VIII's palace and beautiful mature landscapes.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="place-card">
                        <div class="place-image">
                            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80" alt="Carshalton Ponds & Heritage">
                        </div>
                        <div class="place-content">
                            <h4>Carshalton Ponds &amp; Heritage</h4>
                            <p>A serene conservation area with historic architecture, weeping willows, and the River Wandle.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-section">
        <div class="container">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <div class="faq-item">
                <button class="faq-question active" onclick="toggleFaq(this)">
                    How far is Heathrow Airport from Sutton?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer show">
                    The road distance is approximately 22–26 miles, depending on the Heathrow terminal and the route taken via the M25 and A217.
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    How long does Heathrow to Sutton take?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    Travel time averages 45 to 60 minutes depending on traffic and time of day.
                </div>
            </div>
        </div>
    </section>
@endif

<script>
    function toggleFaq(button) {
        const faqItem = button.parentElement;
        const faqAnswer = button.nextElementSibling;
        const allItems = document.querySelectorAll('.faq-item');
        allItems.forEach(item => {
            if (item !== faqItem) {
                item.querySelector('.faq-question').classList.remove('active');
                item.querySelector('.faq-answer').classList.remove('show');
            }
        });
        button.classList.toggle('active');
        faqAnswer.classList.toggle('show');
    }
</script>
@endsection
