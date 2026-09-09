@extends('layouts.app')

@section('title', $post->blog_title . ' | GoRide Blog')

@section('meta_description', Str::limit(strip_tags($post->content), 150))

@section('meta_keywords', 'goride, ' . $post->cat_name . ', cab booking, travel blog')

@section('meta_tags')
    <meta property="og:title" content="{{ $post->blog_title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($post->content), 150) }}">
    <meta property="og:image" content="{{ url($post->hero_image) }}">
    <meta property="og:type" content="article">
@endsection

@section('content')

@php
    $iii = 1;
@endphp

<style>
/* Blog Search Bar Styles */
.blog-search-wrapper {
    max-width: 700px;
    position: relative;
    z-index: 10;
    margin: 0 auto;
}

.search-input-box {
    display: flex;
    align-items: center;
    background: #000000; 
    border: 1px solid #f9bf00; 
    border-radius: 30px;
    padding: 0 18px;
    height: 44px;
    transition: all 0.3s ease;
    box-shadow: 0 0 10px rgba(249, 191, 0, 0.15);
}

.search-input-box:focus-within {
    box-shadow: 0 0 15px rgba(249, 191, 0, 0.3);
}

.search-input-box input {
    background: transparent;
    border: none;
    color: #fff;
    width: 100%;
    outline: none;
    font-size: 14px; 
    height: 100%;
    margin: 0;
    padding: 0;
    line-height: 44px;
}

.search-input-box input::placeholder {
    color: #777;
    line-height: normal;
}

.search-input-box .right-icon {
    color: #999; 
    font-size: 16px;
    margin-left: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    height: 100%;
    transition: color 0.2s ease;
}

.search-input-box .right-icon:hover {
    color: #f9bf00;
}

.search-results-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    margin-top: 6px;
    overflow: hidden;
    max-height: 280px;
    overflow-y: auto;
    border: 1px solid #e0e0e0;
}

.search-results-dropdown ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.search-results-dropdown li {
    border-bottom: 1px solid #f5f5f5;
}

.search-results-dropdown li:last-child {
    border-bottom: none;
}

.search-results-dropdown a {
    display: flex;
    align-items: flex-start;
    padding: 10px 16px;
    color: #333;
    text-decoration: none;
    transition: background 0.2s ease;
}

.search-results-dropdown a i {
    color: #f9bf00;
    margin-right: 12px;
    font-size: 14px;
    margin-top: 4px;
    flex-shrink: 0;
}

.search-text-wrapper {
    display: flex;
    flex-direction: column;
    width: 100%;
    overflow: hidden;
}

.search-text-wrapper .search-title {
    font-weight: 600;
    font-size: 14px;
    color: #111;
    margin-bottom: 3px;
    line-height: 1.3;
}

.search-text-wrapper .search-desc {
    font-size: 12px;
    color: #666;
    line-height: 1.4;
    font-weight: 400;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis; 
}

.search-results-dropdown a:hover {
    background: #fff9e6;
    color: #000;
}

.search-no-results {
    padding: 12px 16px;
    color: #777;
    font-style: italic;
    text-align: center;
    font-size: 14px;
}

.blog-section-banner {
    background: linear-gradient(rgba(20, 28, 40, 0.75), rgba(20, 28, 40, 0.75)), url('{{ env('WEBSITE_APP_URL') }}{{ env('COUNTRY_SLUG_II') }}/goride/img/main-banner.webp'), #141c28;
    background-color: #141c28;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 70px 0;
    width: 100%;
}

.blog-detail-page {
    margin-top: 60px;
    font-family: "Inter", "Poppins", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}
.blog-detail-title {
    font-size: 32px;
    font-weight: 800;
    margin-bottom: 15px;
    color: #111;
    line-height: 1.3;
    font-family: "Inter", "Poppins", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}
.blog-detail-title span {
    color: #f9bf00;
}
.blog-breadcrumb {
    font-size: 15px;
    color: #333;
    font-weight: 500;
    text-transform: capitalize;
    font-family: "Inter", "Poppins", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}
.blog-breadcrumb a {
    color: #111;
    text-decoration: none;
    transition: color 0.2s ease;
    font-weight: 600;
}
.blog-breadcrumb a:hover {
    color: #f9bf00;
    text-decoration: underline;
}
.blog-breadcrumb span {
    color: #888;
    margin: 0 6px;
}
.blog-breadcrumb strong {
    color: #333;
    font-weight: 600;
}
.blog-image-wrapper {
    width: 100%;
    border-radius: 20px;
    overflow: hidden;
    aspect-ratio: 16 / 9;
}
.blog-image-wrapper img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
    object-position: center;
}
.blog-detail-content h4 {
    margin-top: 25px;
    font-weight: 700;
}
.blog-detail-content p {
    font-size: 15px;
    line-height: 1.8;
    color: #555;
}
.blog-quote {
    background: #fff7d6;
    border-left: 4px solid #f5a200;
    padding: 20px;
    border-radius: 8px;
    font-style: italic;
}
.blog-quote span {
    display: block;
    margin-top: 8px;
    font-weight: 600;
    color: #333;
}
.blog-faq-section {
    background: #fafafa;
    border-top: 1px solid #eee;
}
.blog-faq-section h2 {
    font-size: 28px;
    font-weight: 800;
}
.blog-faq-section .accordion-item {
    border: none;
    border-radius: 12px;
    margin-bottom: 15px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
}
.blog-faq-section .accordion-button {
    font-size: 16px;
    font-weight: 700;
    padding: 12px 24px;
    background: #fff;
    color: #111;
    box-shadow: none;
}
.blog-faq-section .accordion-button:not(.collapsed) {
    background: #fff7d6;
    color: #111;
}
.blog-faq-section .accordion-button::after {
    background-image: none;
    content: "+";
    font-size: 22px;
    font-weight: 700;
    color: #f5a200;
    transform: none;
}
.blog-faq-section .accordion-button:not(.collapsed)::after {
    content: "–";
}
.blog-faq-section .accordion-body {
    font-size: 14px;
    line-height: 1.7;
    color: #666;
    padding: 20px;
    background: #fff;
}
.blog-faq-section .accordion-button:focus {
    box-shadow: none;
    border-color: transparent;
}
.blog-subscribe-section.subscribe-box {
    background: #fdeeba;
    border-radius: 16px;
    padding: 30px 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}
.blog-subscribe-section .subscribe-text h3 {
    font-size: 22px;
    font-weight: 800;
    margin-bottom: 8px;
}
.blog-subscribe-section .subscribe-text p {
    font-size: 14px;
}
.blog-subscribe-section .subscribe-form {
    display: flex;
    gap: 10px;
}
.blog-subscribe-section .subscribe-form input {
    flex: 1;
    padding: 12px 14px;
    border-radius: 8px;
    border: 1px solid #ddd;
    outline: none;
    margin-bottom: 0px;
}
.blog-subscribe-section .subscribe-form button {
    background: #f9bf00;
    color: #fff;
    border: none;
    padding: 0px 18px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
}
@media (max-width: 768px) {
    .blog-image-wrapper img {
        height: 170px;
    }
    .blog-image-wrapper {
        margin-bottom: 20px;
    }
    .blog-breadcrumb {
        display: flex;
        justify-content: center;
        font-size: 12px;
        gap: 10px;
        line-height: 1.4;
    }
    .blog-detail-title {
        font-size: 23px;
    }
    .blog-section {
        padding-top: 10px;
    }
    .blog-subscribe-section.subscribe-box {
        flex-direction: column;
        margin-top: 10px;
        text-align: center;
    }
    .blog-subscribe-section .subscribe-form {
        width: 100%;
    }
}
.blog-comment-section .comment-title {
    font-size: 24px;
    font-weight: 800;
    margin-bottom: 20px;
}
.blog-comment-section .comment-form input,
.blog-comment-section .comment-form textarea {
    width: 100%;
    padding: 12px 14px;
    border-radius: 8px;
    border: 1px solid #ddd;
    outline: none;
}
.blog-comment-section .comment-form input:focus,
.blog-comment-section .comment-form textarea:focus {
    border-color: #f5a200;
}
.blog-section {
    background: #ffffff;
    font-family: "Segoe UI", sans-serif;
}
.blog-section .blog-title {
    text-align: center;
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 40px;
}
.blog-section .blog-title span {
    color: #f5b301;
}
.blog-section .blog-category {
    font-size: 18px;
    font-weight: 700;
    text-transform: uppercase;
    margin: 30px 0px;
    padding-bottom: 2px;
    border-bottom: 2px solid #f3ba00;
    width: fit-content;
    color: #1b1b1b;
}
.blog-section .blog-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
}
.blog-section .blog-card {
    background: #fff;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    transition: 0.3s ease;
}
.blog-section .blog-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.12);
}
.blog-section .blog-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}
.blog-section .blog-content {
    padding: 20px;
}
.blog-section .blog-tag {
    display: inline-block;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 6px;
    background: #f9bf0045;
    max-width: fit-content;
    padding: 0px 12px;
    border-radius: 10px;
}
.blog-section .blog-content h3 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 10px;
    color: #111;
}
.blog-section .blog-content p {
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 15px;
    font-weight: 400;
}
.blog-section .blog-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 12px;
    color: #999;
}
.blog-section .blog-time {
    color: #1b1b1b;
    font-weight: 500;
}
.blog-section .blog-meta a {
    color: #f3ba00;
    font-weight: 600;
    text-decoration: none;
}
.blog-section .blog-meta a:hover {
    text-decoration: underline;
}
.blog-section .load-more-btn {
    display: block;
    margin: 40px auto 0;
    padding: 12px 30px;
    border: 2px solid #1e73ff;
    background: transparent;
    color: #1e73ff;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}
.blog-section .load-more-btn:hover {
    background: #1e73ff;
    color: #fff;
}
@media (max-width: 992px) {
    .blog-section .blog-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 576px) {
    .blog-section .blog-grid {
        grid-template-columns: 1fr;
    }
}
.btn-agent-super {
    position: relative;
    display: inline-block;
    padding: 14px 30px;
    font-size: 21px;
    font-weight: bold;
    color: #000;
    background: #f9bf00;
    border-radius: 15px;
    text-decoration: none;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(249, 191, 0, 0.5), 0 0 40px rgba(249, 191, 0, 0.3) inset;
    transition: all 0.3s ease;
    animation: bounce 2s infinite;
    font-weight: 600;
}
.btn-agent-super::before {
    content: "";
    position: absolute;
    top: 0;
    left: -75%;
    width: 50%;
    height: 100%;
    background: rgba(255,255,255,0.4);
    transform: skewX(-25deg);
    transition: all 0.7s ease;
}
.btn-agent-super:hover::before {
    left: 125%;
}
.btn-agent-super:hover {
    transform: scale(1.15);
    box-shadow: 0 0 30px rgba(249,191,0,1), 0 0 60px rgba(249,191,0,0.7) inset;
    color: black !important;
}
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
}
@keyframes sparks {
    0% { opacity: 0; transform: translate(-50%, -50%) scale(0.5); }
    50% { opacity: 1; transform: translate(calc(-50% + 12px), calc(-50% - 24px)) scale(1); }
    100% { opacity: 0; transform: translate(-50%, -50%) scale(0.5); }
}
@keyframes gradientBG {
    0% { background-position: 0% 50% }
    50% { background-position: 100% 50% }
    100% { background-position: 0% 50% }
}
.agency-carousel .item {
    width: 100%;
    height: 100% !important;
    display: block;
}
.agency-carousel .item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 6px !important;
}
.agency-btn-wraap {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
}
.agency-section {
    padding: 30px 0px;
    color: #fff;
    text-align: center;
    position: relative;
}
.overlay {
    padding: 60px 20px;
    border-radius: 10px;
}
.agency-section .section-title {
    font-size: 33px;
    margin-bottom: 0px;
}
.agency-button1 {
    --stone-50: #fafaf9;
    --stone-800: #292524;
    --yellow-400: #facc15;
    font-size: 25px;
    cursor: pointer;
    position: relative;
    font-family: "Rubik", sans-serif;
    font-weight: bold;
    line-height: 1;
    padding: 1px;
    transform: translate(-4px, -4px);
    outline: 2px solid transparent;
    outline-offset: 5px;
    background-color: var(--stone-800);
    color: var(--stone-800);
    transition: transform 150ms ease, box-shadow 150ms ease;
    text-align: center;
    box-shadow: 0.5px 0.5px 0 0 var(--stone-800), 1px 1px 0 0 var(--stone-800), 1.5px 1.5px 0 0 var(--stone-800), 2px 2px 0 0 var(--stone-800), 2.5px 2.5px 0 0 var(--stone-800), 3px 3px 0 0 var(--stone-800), 0 0 0 2px var(--stone-50), 0.5px 0.5px 0 2px var(--stone-50), 1px 1px 0 2px var(--stone-50), 1.5px 1.5px 0 2px var(--stone-50), 2px 2px 0 2px var(--stone-50), 2.5px 2.5px 0 2px var(--stone-50), 3px 3px 0 2px var(--stone-50), 3.5px 3.5px 0 2px var(--stone-50), 4px 4px 0 2px var(--stone-50);
}
.agency-button1:hover {
    transform: translate(0, 0);
    box-shadow: 0 0 0 2px var(--stone-50);
    color: black;
}
.agency-button1:active,
.agency-button1:focus-visible {
    outline-color: var(--yellow-400);
}
.agency-button1:focus-visible {
    outline-style: dashed;
}
.agency-button1:hover > div > span {
    color: black;
}
.agency-button1 > div {
    position: relative;
    pointer-events: none;
    background-color: var(--yellow-400);
    border: 2px solid rgba(255, 255, 255, 0.3);
}
.agency-button1 > div::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0.5;
    background-image: radial-gradient(rgb(255 255 255 / 80%) 20%, transparent 20%), radial-gradient(rgb(255 255 255 / 100%) 20%, transparent 20%);
    background-position: 0 0, 4px 4px;
    background-size: 8px 8px;
    mix-blend-mode: hard-light;
    animation: dots 0.5s infinite linear;
}
.agency-button1 > div > span {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px 21px 12px 0px;
    gap: 0.25rem;
    filter: drop-shadow(0 -1px 0 rgba(255, 255, 255, 0.25));
}
.agency-button1 > div > span:active {
    transform: translateY(2px);
}
@keyframes dots {
    0% { background-position: 0 0, 4px 4px; }
    100% { background-position: 8px 0, 12px 4px; }
}
@media (max-width: 600px) {
    .goride-capsule {
        border-radius: 20px;
        flex-direction: column;
        padding: 20px;
    }
    .capsule-info {
        border-right: none;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        padding-bottom: 15px;
        margin-bottom: 15px;
        text-align: center;
    }
}
.goride-routes .tagline {
    color: #f9bf00;
    font-weight: 600;
    font-size: 1.1rem;
    letter-spacing: 1px;
    margin-bottom: 10px;
    text-transform: uppercase;
}
.goride-routes {
    padding: 30px 0;
    background: white;
}
.goride-routes .accordion-item {
    border: none;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    background: #fff;
}
.goride-routes .accordion-button {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 24px;
    padding: 9px;
    font-size: 15px;
    font-weight: 600;
    line-height: 1.4;
    background: #fff8e1;
    color: #111;
    transition: all 0.3s ease;
}
.goride-routes .accordion-button:hover {
    background: #fff;
}
.goride-routes .count {
    width: 42px;
    height: 42px;
    background: #f7b500;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: all 0.4s ease;
}
.goride-routes .count i {
    color: #fff;
    font-size: 18px;
}
.goride-routes .accordion-body {
    padding: 16px 10px;
    border-top: 1px solid #eee;
}
.goride-routes .routes-list ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.goride-routes .routes-list li a {
    display: flex;
    align-items: baseline;
    gap: 10px;
    padding: 0px 8px;
    font-size: 15px;
    color: #222;
    text-decoration: none;
    border-radius: 6px;
    transition: all 0.25s ease;
}
.goride-routes .routes-list li a:hover {
    background: rgba(247, 181, 0, 0.12);
    color: #000;
    padding-left: 12px;
}
.goride-routes .route-icon {
    color: #f82525;
    font-size: 14px;
    flex-shrink: 0;
}
.description {
    color: #1d2b53;
    font-weight: 500;
    font-size: 17px;
}
.upgrade {
    padding: 60px 20px;
    text-align: center;
    background: linear-gradient(135deg, #f4f7ff, #eef2ff);
}
.agency-tag {
    display: inline-block;
    background: rgba(248, 190, 0, 0.1);
    color: #f8be00;
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 24px;
}
.agency-desc {
    font-size: 21px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 30px;
    max-width: 500px;
}
.agency-button {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: #f9bf00;
    color: #1a1a1a;
    text-decoration: none;
    padding: 5px 12px;
    border-radius: 16px;
    font-weight: 600;
    font-size: 17px;
}
.agency-btn:hover {
    color: white;
    transform: translateY(-3px);
}
.agency-btn i {
    transition: transform 0.3s ease;
}
.agency-btn:hover i {
    transform: translateX(5px);
}
.agency-image img {
    max-width: 360px;
    height: auto;
    border-radius: 20px;
    box-shadow: none;
}
.driver-section {
    position: relative;
    padding: 50px 0;
    background: #f2f2f2;
    background-size: cover;
    background-position: center;
}
.driver-section .tagline {
    color: #f9bf00;
    font-weight: 600;
    font-size: 16px;
    letter-spacing: 1px;
    margin-bottom: 10px;
    text-transform: uppercase;
}
.driver-section .highlight {
    color: #f39c12;
    font-weight: 700;
}
.driver-section .driver-section .description {
    font-size: 1.1rem;
    color: #555;
    line-height: 1.7;
}
.driver-section .steps-section {
    margin: 10px 0;
}
.driver-section .steps-title {
    font-size: 1.8rem;
    color: #2c3e50;
    margin-bottom: 30px;
    position: relative;
    padding-bottom: 10px;
}
.driver-section .steps-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 4px;
    background: #f39c12;
    border-radius: 2px;
}
.driver-section .step {
    display: flex;
    align-items: center;
    justify-content: start;
    margin-bottom: 20px;
    padding: 13px;
    border-radius: 15px;
    background: #f8f9fa;
    transition: transform 0.3s ease;
    box-shadow: 0 6px 4px rgba(0, 0, 0, 0.4);
}
.driver-section .step:hover {
    display: flex;
    align-items: center;
    justify-content: start;
    margin-bottom: 20px;
    padding: 13px;
    border-radius: 15px;
    background: #f8f9fa;
    transition: transform 0.3s ease;
    box-shadow: 0 6px 4px rgba(0, 0, 0, 0.4);
}
.driver-section .step-number {
    background: #f9bf00;
    color: white;
    width: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
    margin-right: 20px;
    flex-shrink: 0;
}
.driver-section .step-content {
    font-size: 1.1rem;
    color: #333;
    font-weight: 500;
}
.driver-section .image-container {
    position: relative;
    width: 100%;
}
.driver-section .driver-image {
    width: 100%;
    object-fit: cover;
    border-radius: 20px;
    max-height: 700px;
}
.driver-section .image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(44, 62, 80, 0.1);
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 40px;
    color: white;
}
.driver-section .stats {
    display: flex;
    gap: 10px !important;
    text-align: center;
}
.driver-section .stat-item {
    padding: 9px;
}
.driver-section .stat-number {
    font-size: 21px;
    font-weight: 700;
    color: #f39c12;
    display: block;
}
.driver-section .stat-label {
    font-size: 20px;
    color: #1d2b53;
    margin-top: 5px;
    font-weight: 500;
}
.driver-section .cta-section {
    margin-top: 20px;
    text-align: center;
}
.driver-section .cta-text {
    font-size: 1.3rem;
    color: #2c3e50;
    margin-bottom: 25px;
    font-weight: 600;
    line-height: 1.5;
}
.driver-section .cta-button {
    display: inline-block;
    background: black;
    color: white;
    padding: 5px 14px;
    border-radius: 7px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    letter-spacing: 0.5px;
}
.driver-section .cta-button:hover {
    transform: translateY(-5px);
    background: linear-gradient(to right, #f9bf00, #f9bf00);
    color: black;
}
.mycard p {
    font-size: 15px;
}
.mycard {
    padding: 0px 10px;
}
.step .content {
    padding: 10px;
}
.mycard .overlay {
    width: 85px;
    height: 85px;
    border-radius: 50%;
    background: var(--bg-color);
    position: absolute;
    top: 9px;
    left: 0;
    right: 0;
    margin: 0 auto;
    z-index: 0;
    transition: transform 0.3s ease-out;
    padding: 0px !important;
}
.section-subtitle {
    font-weight: 700;
    color: #040303;
}
.content.blue {
    border-left: 5px solid #1E90FF;
    border-top: none;
}
.content.blue .step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 13px;
    font-size: 22px;
    color: white;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    background: #1E90FF;
}
.content.yellow {
    border-left: 5px solid #FFD700;
    border-top: none;
}
.content.yellow .step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 13px;
    font-size: 22px;
    color: white;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    background: #FFD700;
}
.content.orange {
    border-left: 5px solid #FF4500;
    border-top: none;
}
.content.orange .step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 13px;
    font-size: 22px;
    color: white;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    background: #FF4500;
}
.content.red {
    border-left: 5px solid #a200ff;
    border-top: none;
}
.content.red .step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 13px;
    font-size: 22px;
    color: white;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    background: #a200ff;
}
.features-grid-section {
    padding: 50px;
    background: #fff;
}
.features-grid {
    display: flex;
}
.feature-col {
    display: flex;
}
.feature-card {
    text-align: center;
    padding: 35px 25px;
    border-radius: 22px;
    transition: all 0.35s ease;
    background: #ffffff;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 2px solid #ebebeb;
}
.feature-card:hover {
    transform: translateY(-8px);
    border-color: #ffc107;
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.12), 0 6px 15px rgba(255, 193, 7, 0.25);
}
.feature-img-wrap {
    position: relative;
    display: inline-block;
    margin-bottom: 50px;
}
.feature-img-wrap::before {
    content: "";
    position: absolute;
    width: 130px;
    height: 130px;
    background: #f2f2f2;
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 0;
}
.feature-img-wrap::after {
    display: none;
}
.feature-img-wrap img {
    width: 77px;
    position: relative;
    z-index: 1;
    filter: drop-shadow(0 15px 30px rgba(0, 0, 0, 0.15));
}
.feature-card h3 {
    font-size: 20px;
    font-weight: 700;
}
.feature-card p {
    font-size: 16px;
    color: #444;
    line-height: 1.7;
    max-width: 420px;
    font-weight: 500;
}
.fleet-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    transition: transform 0.4s ease;
    height: 100%;
}
.fleet-card:hover {
    transform: translateY(-10px);
}
.fleet-image {
    position: relative;
    height: 260px;
    overflow: hidden;
}
.fleet-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.fleet-image::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1));
    z-index: 1;
}
.fleet-image::after {
    content: "";
    position: absolute;
    width: 150%;
    height: 55px;
    background: #facc15;
    top: -40px;
    left: -120%;
    transform: rotate(-12deg);
    transition: all 0.5s ease;
    z-index: 2;
}
.fleet-card:hover .fleet-image::after {
    left: -20%;
}
.fleet-content {
    padding: 8px 14px 10px;
}
.fleet-content h3 {
    margin: 0 0 6px;
    color: #1d2b53;
    font-size: 20px;
}
.fleet-models {
    font-style: italic;
    font-size: 15px;
    color: #6b7280;
    font-weight: 600;
}
.fleet-desc {
    font-size: 15px;
    color: #444;
    line-height: 1.6;
    font-weight: 500;
}
.payment-cards {
    max-width: 1000px;
    margin: auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 30px;
}
.payment-card {
    background: #fff;
    border-radius: 20px;
    padding: 35px 25px;
    box-shadow: none;
    transition: all 0.35s ease;
    position: relative;
}
.payment-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
    border: 1px solid #f3ba00;
}
.payment-img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: white;
    margin: auto;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border: 1px solid #f9bf00;
}
.payment-card:hover .payment-img {
    background: #f9bf0087;
}
.payment-card:hover .payment-img img {
    transform: scale(1.1);
}
.payment-img img {
    width: 40px;
    height: 40px;
    object-fit: contain;
}
.payment-card h3 {
    margin: 20px 0 15px;
    color: #1d2b53;
}
.payment-card ul {
    list-style: none;
    padding: 0;
    margin: 0;
    text-align: left;
}
.payment-card ul li {
    margin: 10px 0;
    padding-left: 22px;
    position: relative;
    color: #444;
    font-weight: 500;
    font-size: 15px;
}
.payment-card ul li::before {
    content: "✔";
    position: absolute;
    left: 0;
    color: #4f46e5;
    font-size: 14px;
}
.item.bg-img:before {
    background-color: rgba(0, 0, 0, 1);
    padding: 60px 20px;
}
.theme-btn:focus,
.theme-btn:active,
.theme-btn3:focus,
.theme-btn3:active {
    background-color: #ffc107 !important;
    color: #000 !important;
    outline: none !important;
    box-shadow: none !important;
}
#india-content2 {
    position: absolute;
    bottom: 75px;
    right: 275px;
}
.theme-btn3, .theme-btn {
    background: #FFC107;
    color: #000;
    padding: 7px 10px;
    border-radius: 7px;
    font-weight: 600;
    margin: 10px;
    display: inline-block;
    text-decoration: none;
    transition: 0.3s;
    position: relative;
    z-index: 1;
}
.theme-btn3:hover, .theme-btn:hover {
    background: #e0a800;
    color: #000;
}
.theme-btn:hover {
    transform: translateY(-2px);
}
.theme-btn::before {
    content: '';
    position: absolute;
    top: -4px;
    left: -4px;
    right: -4px;
    bottom: -4px;
    border-radius: 9px;
    z-index: -1;
    background: transparent;
    animation: squareWave 1.5s linear infinite;
}
@keyframes squareWave {
    0% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.8), 0 0 0 0 rgba(255, 193, 7, 0.5); }
    50% { box-shadow: 0 0 0 5px rgba(255, 193, 7, 0.8), 0 0 0 10px rgba(255, 193, 7, 0.3); }
    100% { box-shadow: 0 0 0 10px rgba(255, 193, 7, 0), 0 0 0 15px rgba(255, 193, 7, 0); }
}
.header-jobs.download-app {
    right: 5% !important;
}
.header-jobs {
    right: 20% !important;
    bottom: 100px;
}
@media screen and (max-width: 767px) {
    .agency-button1 { font-size: 16px; }
    .payment-card { padding: 17px 14px; }
    .upgrade { padding: 38px 10px; }
    .agency-btn-wraap { flex-direction: column; gap: 12px; }
    .capsule-cta { display: inline-flex; }
    .driver-section .stat-label { font-size: 16px; }
    .driver-section .stats { gap: 50px; }
    .driver-section .step-content { font-size: 16px; }
    .driver-section .step { padding: 10px; }
    .description { font-size: 16px; }
    .payment-section { padding: 30px 0px; }
    .agency-desc { font-size: 17px; margin-bottom: 12px; }
    .agency-btn { padding: 6px 19px; font-size: 15px; }
    .agency-content { max-width: 100%; }
    .carousel-inner .step { display: block; }
    .mycard { padding: 4px 17px; width: 90% !important; }
    .feature-col { margin-bottom: 20px; }
    .slider-fade .item .caption { left: 0%; }
    .fleet-grid, .features-grid { display: block; }
    .theme-btn, .theme-btn3 { padding: 6px 8px !important; font-size: 12px !important; }
    .header-jobs:hover { transform: translateX(-50%) !important; }
    .header-jobs { top: 225px; }
    .download-app.header-jobs { top: 270px; }
}
@media (max-width: 1400px) {
    .header-jobs { right: 25% !important; padding: 15px 10px !important; }
}
.jobs-heading {
    background: #f9bf00;
    position: absolute;
    padding: 18px;
    height: 32px;
    width: fit-content;
    z-index: 1;
    top: -10px;
    left: 222px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 6px;
}
.job-search {
    max-width: 526px;
}
.see-jobs-btn {
    background: #f9bf00;
    color: black;
    font-weight: 500;
    border-radius: 14px;
}
.badge {
    background: #f9bf00;
    color: black;
}
.phone-mockup {
    width: 100%;
    max-width: 471px;
    background: #f2f2f2;
    border-radius: 40px;
    position: relative;
    height: 483px;
    overflow: scroll;
    max-height: 483px;
    overflow-y: scroll;
    scrollbar-width: none;
    -ms-overflow-style: none;
    padding: 20px;
}
.phone-mockup::-webkit-scrollbar {
    display: none;
}
.notify-card {
    display: flex;
    align-items: center;
    gap: 15px;
    color: #fff;
    padding: 10px;
    border-radius: 12px;
    margin: 25px auto;
    width: 90%;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
    position: relative;
}
.notify-card i {
    font-size: 20px;
}
.notify-card.blue {
    border-right: 8px solid #f9bf00;
    background: white;
}
.notify-card h6 {
    color: #5c5861;
    font-size: 14px;
    margin-bottom: 4px;
}
.notify-card p {
    font-size: 12px;
}
.modal-header {
    background: #fff !important;
    margin: 12px 0 0 0;
}
.modal-body {
    background: #fff !important;
}
.frm-sec {
    padding: 21px;
}
input#exampleInputEmail1 {
    border: 1px solid #bbbbbb;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}
.close1 {
    background: none;
    position: absolute;
    right: 20px;
    font-size: 26px;
}
.close1:hover {
    color: orange;
}
.modal-content {
    background-color: #fefefe;
    margin: 83px 0 0 0;
    padding: 5px;
    border: 1px solid #888;
    width: 100%;
    max-width: 700px;
    position: relative;
}
.modal-body h1 {
    font-weight: 900;
    font-size: 2.3em;
    text-transform: uppercase;
}
.modal-body a.pre-order-btn {
    color: #000;
    background-color: gold;
    border-radius: 1em;
    padding: 1em;
    display: block;
    margin: 2em auto;
    width: 50%;
    font-size: 1.25em;
    font-weight: 6600;
}
.modal-body a.pre-order-btn:hover {
    background-color: #000;
    text-decoration: none;
    color: gold;
}
@media (max-width: 768px) {
    .slider-fade .item { background-position: right; }
    .feature-img-wrap img { width: 50px; }
    .feature-img-wrap::before { width: 90px; height: 90px; }
    .feature-img-wrap::after { width: 110px; height: 110px; }
    .header { height: 80vh !important; }
    .feature-img-wrap { margin-bottom: 45px; }
    .features-grid-section { padding: 25px; }
    .slider-fade .item .caption { top: 60% !important; }
    .jobs-heading { top: -16px; left: 50%; transform: translateX(-50%); }
    #about { padding: 0px !important; }
    .cs_cta.cs_style_1 .cs_section_title { font-size: 24px; }
    section .how { padding: 0px !important; }
    .job-box .title-box { width: 100% !important; }
    .job-search { max-width: 265px !important; }
    .phone-mockup { height: auto; max-height: 600px; }
    .notify-card { margin: 25px 0 !important; width: 100% !important; padding: 10px 10px 20px 10px !important; }
}
.phone-mockup .badge {
    position: absolute;
    bottom: 5px;
    right: 5px;
}
.blog-post-meta {
    display: flex;
    align-items: center;
    margin: 20px 0 25px;
    color: #666;
    font-size: 14px;
    font-weight: 500;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 15px;
}
.blog-post-meta span {
    display: flex;
    align-items: center;
    gap: 8px;
}
.share-text {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-right: 5px;
}
.blog-post-meta i {
    color: #f9bf00;
}
.social-share {
    display: flex;
    gap: 10px;
}
.meta-info {
    display: flex;
    gap: 20px;
    align-items: center;
}
.social-share a {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #fff !important;
    transition: all 0.3s ease;
}
.social-share a.facebook { background: #3b5998; }
.social-share a.twitter { background: #000; }
.social-share a.linkedin { background: #0a66c2; }
.social-share a.whatsapp { background: #25d366; }
.social-share a.instagram { background: radial-gradient(circle at 30% 107%, #fdf497 0, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285aeb 90%); }
.social-share a:hover {
    transform: translateY(-3px) scale(1.08);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}
@media(max-width:768px) {
    .blog-post-meta { flex-wrap: wrap; gap: 15px; }
}
@media only screen and (device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) {
    .i_phone { margin-top: -100px !important; }
}
</style>

<section class="blog-detail-page py-5">
    <div class="container">
        <h1 class="blog-detail-title">
            {{ \Illuminate\Support\Str::title($post->blog_title) }}
        </h1>
        <div class="blog-breadcrumb mb-4">
            <a href="{{env('WEB_APP_URL')}}{{env('COUNTRY_SLUG')}}blog">Blog</a>
            <span> &gt;&gt; </span>
            <a href="{{env('WEB_APP_URL')}}{{env('COUNTRY_SLUG_II')}}{{ $post->cat_url }}" class="text-center text-md-start">{{ $post->cat_name }}</a>
            <span> &gt;&gt; </span>
            <strong>{{ $post->sub_title }}</strong>
        </div>
        <div class="blog-image-wrapper">
            <img src="{{ $post->hero_image }}" alt="{{ $post->blog_title }}">
        </div>
        <div class="blog-post-meta">
            <div class="meta-info">
                <span>
                    <i class="fa-regular fa-calendar-days"></i>
                    {{ \Carbon\Carbon::parse($post->published_date)->format('M d, Y') }}
                </span>
                <span>
                    <i class="fa-regular fa-clock"></i>
                    {{ $post->read_minutes }} min read
                </span>
            </div>
            <div class="social-share">
                <span class="share-text">Share Via :</span>
                <a href="#" class="facebook share-btn" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-facebook-f text-white"></i>
                </a>
                <a href="#" class="twitter share-btn" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-x-twitter text-white"></i>
                </a>
                <a href="#" class="instagram share-btn native-share" rel="noopener noreferrer">
                    <i class="fab fa-instagram text-white"></i>
                </a>
                <a href="#" class="linkedin share-btn" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-linkedin-in text-white"></i>
                </a>
                <a href="#" class="whatsapp share-btn" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-whatsapp text-white"></i>
                </a>
            </div>
        </div>
        <div class="blog-detail-content">
            {!! $post->content !!}
        </div>
    </div>
</section>

<section class="blog-faq-section py-5">
    @php
        $faqs = json_decode($post->faq ?? '[]', true);
        $faqs = is_array($faqs) ? $faqs : [];
        $isFaq = !empty($faqs);
    @endphp
    <div class="container {{ $isFaq ? '' : 'd-none' }}">
        <h2>Frequently Asked Questions</h2>
        <div class="accordion" id="blogFaq">
            @foreach($faqs as $key => $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button {{ $key != 0 ? 'collapsed' : '' }}" data-bs-toggle="collapse" data-bs-target="#faq{{ $key }}">
                            {{ $faq['question'] }}
                        </button>
                    </h2>
                    <div id="faq{{ $key }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}">
                        <div class="accordion-body">
                            {{ $faq['answer'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="blog-section py-5 mt-5 border-top">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center align-items-center mb-4">
                 
                </div>
                
                @if($relatedBlogs->count() > 0)
                
                   <div>
                <h2 class="fw-bold" style="font-size: 32px;">
                    More in This <span style="color: #f9bf00;">Category</span>
                </h2>
            </div>
                <div class="row mb-5">
                    @foreach($relatedBlogs as $blog)
                        <div class="col-md-4 mb-4">
                            <a href="{{env('WEB_APP_URL')}}{{env('COUNTRY_SLUG_II')}}{{ $blog->cat_url.'/'.$blog->slug }}" class="text-decoration-none d-block h-100">
                                <div class="card h-100 p-0" style="background:white;border:none;">
                                    <div style="width: 100%;aspect-ratio: 16 / 9;overflow: hidden; border-radius: 0;">
                                        <img src="{{ asset($blog->thumbnail ?? '/goride/img/default-blog.jpg') }}" style="width: 100%; height: 100%;object-fit: cover;object-position: center;display: block;" alt="{{ $blog->blog_title }}">
                                    </div>
                                    <div class="card-body p-3 d-flex flex-column">
                                        <div class="mb-2 text-uppercase fw-bold" style="display: inline-block;font-size: 13px;font-weight: 700;text-transform: uppercase;margin-bottom: 6px;background: #f9bf0045;max-width: fit-content;padding: 0px 12px; border-radius: 10px;">
                                            {{ $blog->sub_title ?? 'Read More' }}
                                        </div>
                                        <h4 class="fw-bold mb-2" style="color: #0d0d0d; font-size: 20px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            {{ $blog->blog_title }}
                                        </h4>
                                        <p class="mb-3" style="color: #555555; font-size: 15px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            {{ Str::limit(strip_tags($blog->meta_description ?? $blog->description), 120, '...') }}
                                        </p>
                                        <p class="mt-auto mb-0" style="font-size: 14px;color:#1b1b1b;font-weight: 500;">
                                            {{ \Carbon\Carbon::parse($blog->published_date)->format('M d, Y') }} &bull; {{ $blog->read_minutes ?? 5 }} min read
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
               @else
<div class="text-center py-5">
    <h4 class="mb-3">No more articles in this category.</h4>
    <p class="text-muted mb-4">
        Explore our latest articles and discover more interesting content.
    </p>

    <a href="{{ url('/blog') }}"
       class="btn"
       style="background:#f9bf00;color:#000;font-weight:600;padding:10px 20px;border-radius:6px;">
        Explore More Blogs <i class="fa fa-arrow-right"></i>
    </a>
</div>
@endif
                
            </div>
            </div>
    </div>
</section>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close1" data-bs-dismiss="modal">
                    <i class="fa fa-close" style="width: 30px; height: 30px;border-radius: 50%; border: 1px solid #000;"></i>
                </button>
            </div>
            <div class="modal-body text-center mt-4">
                <img src="{{ asset('goride/img/logo-dark.png') }}" class="logo-img" alt="" style="width: 200px;">
                <form class="frm-sec">
                    <div class="mb-3">
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Login with Mobile Number">
                    </div>
                    <button type="submit" class="btn btn-primary mb-3" style="width: 100%;">Get OTP</button>
                    <span class="by-click-text ">Already have an account? 
                        <a class="by-click-text under-line text-danger " href="login" contenteditable="false" style="cursor: pointer;"> Sign In</a>
                    </span>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
function safeGetCookie(name) {
    let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    return match ? match[2] : null;
}

let countryC = (typeof getCookie === 'function' ? getCookie('countryCode') : safeGetCookie('countryCode')) || 'IN';
let isMobile = window.innerWidth <= 768;

try {
    const sliderItem = document.querySelector('#slider-image .item');
    const mobileMockup = document.querySelector('#mobile_mockup');
    const indiaContent = document.querySelector('#india-content');
    const indiaContent2 = document.querySelector('#india-content2');

    if (countryC !== 'IN') {
        if (sliderItem) sliderItem.style.backgroundImage = "url('{{ asset('goride/img/slider/goride_main_banner.webp') }}')";
        if (mobileMockup) mobileMockup.src = '{{ asset('goride/img/slider/mobile_mockup_two.webp') }}';
        if (indiaContent) indiaContent.style.display = "none";
        if (indiaContent2) indiaContent2.style.display = "none";
    } else {
        if (sliderItem) sliderItem.style.backgroundImage = "url('{{ asset('goride/img/blogs.webp') }}')";
        if (indiaContent) indiaContent.style.display = "block";
        if (indiaContent2) indiaContent2.style.display = "block";
        if (mobileMockup) mobileMockup.src = '{{ asset('goride/img/banner-1-mob.webp') }}';
    }

    if (isMobile && sliderItem) {
        sliderItem.style.backgroundImage = "url('{{ asset('goride/img/slider/go_ride_background.png') }}')";
    }
} catch (e) {
    console.warn("DOM elements initialization warning:", e);
}

triggerCalendly = () => {
    sessionStorage.setItem('triggerCalendlyClick', 'true');
    window.location.href = '/dashboard';
}
}

document.addEventListener('DOMContentLoaded', function() {
    if (window.innerWidth < 768) {
        const myCarousel = document.getElementById('stepsCarousel');
        if (myCarousel) {
            const carousel = new bootstrap.Carousel(myCarousel, {
                interval: 4000,
                wrap: true,
                touch: true
            });
        }
    }
});

function convertDateFormat(txt, type = 'full') {
    let dateString = txt;
    let dateObj = new Date(dateString.replace(" ", "T"));
    let day = String(dateObj.getDate()).padStart(2, '0');
    let month = dateObj.toLocaleString('en-US', { month: 'short' });

    if (type === 'date') {
        return `${day} ${month}`;
    }

    let hours = dateObj.getHours();
    let minutes = String(dateObj.getMinutes()).padStart(2, '0');
    let ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12 || 12;

    let formattedDate = `${day} ${month} ${String(hours).padStart(2, '0')}:${minutes} ${ampm}`;
    return formattedDate;
}

$('.agency-carousel').owlCarousel({
    items: 1,
    loop: true,
    margin: 10,
    nav: false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 4000,
    smartSpeed: 700,
    touchDrag: true,
    mouseDrag: true
});

function notifyJobs() {
    if(true){
        $.ajax({
            url: "{{ env('APP_API') }}notify-jobs",
            type: 'POST',
            data: [],
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status) {
                    let data = response.data.jobs ? response.data.jobs : [];
                    $('#notify_jobs').empty();
                    let jobs_content = '';
                    if (data.length > 0) {
                        $.each(data, function (index, value) {
                            value.pickup_date = convertDateFormat(value.pickup_date);
                            value.dropoff_date = value.dropoff_date ? convertDateFormat(value.dropoff_date, 'date') : '';
                            let j_type = value.job_type == 'oneway' ? 'One Way' : 'Round Trip';
                            jobs_content += `
                                <div class="notify-card blue aos-init aos-animate" >
                                    <img src="{{ asset('goride/img/bell.gif') }}" style="height: 42px; width: 42px"/>
                                    <div>
                                      <h6>${value.from_place} → ${value.to_place} <span class="badge ms-3">${j_type}</span></h6>
                                      <div class="d-flex gap-2">
                                        <p class="m-0 text-dark fw-bold">
                                          <strong class="text-danger fw-bold me-1">Pickup:</strong> ${value.pickup_date}
                                        </p>
                                        <p class="m-0 text-dark fw-bold ${value.dropoff_date ? '' : 'd-none'}">
                                          <strong class="text-success fw-bold me-1">Return:</strong> ${value.dropoff_date}
                                        </p>
                                      </div>
                                    </div>
                                </div>`;
                        });
                        jobs_content += `
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="{{ env('APP_URL') }}jobs" class="see-jobs-btn px-3">View Jobs</a>
                            </div>`;
                    } else {
                        jobs_content = `
                            <div class="notify-card blue aos-init aos-animate d-flex justify-content-center" >
                                <i class="fa-solid fa-briefcase text-danger"></i>
                                <h6>No More Jobs</h6>
                            </div>`;
                    }
                    $('#notify_jobs').html(jobs_content);
                } else {
                    showToast('error', response.message, 3000);
                }
            },
            error: function () {
                showToast('error', 'Something went wrong!', 3000);
            }
        });
    }
}

var pageURL = encodeURIComponent(window.location.href);
var pageTitle = encodeURIComponent(document.title);

$('.social-share a.facebook').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + pageURL);
$('.social-share a.twitter').attr('href', 'https://twitter.com/intent/tweet?url=' + pageURL + '&text=' + pageTitle);
$('.social-share a.linkedin').attr('href', 'https://www.linkedin.com/sharing/share-offsite/?url=' + pageURL);
$('.social-share a.whatsapp').attr('href', 'https://api.whatsapp.com/send?text=' + pageTitle + '%20' + pageURL);
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var currentUrl = encodeURIComponent(window.location.href);
    var currentTitle = encodeURIComponent(document.title);
    var rawUrl = window.location.href;
    var rawTitle = document.title;

    document.querySelector('.facebook.share-btn').href = "https://www.facebook.com/sharer/sharer.php?u=" + currentUrl;
    document.querySelector('.twitter.share-btn').href = "https://twitter.com/intent/tweet?url=" + currentUrl + "&text=" + currentTitle;
    document.querySelector('.linkedin.share-btn').href = "https://www.linkedin.com/sharing/share-offsite/?url=" + currentUrl;
    document.querySelector('.whatsapp.share-btn').href = "https://api.whatsapp.com/send?text=" + currentTitle + " - " + currentUrl;

    var instaBtn = document.querySelector('.native-share');
    if (instaBtn) {
        instaBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (navigator.share) {
                navigator.share({
                    title: rawTitle,
                    url: rawUrl
                }).catch(function(error) {
                    console.log('Error sharing:', error);
                });
            } else {
                alert("Direct sharing to Instagram is only supported on mobile devices. Please copy the URL manually to share.");
            }
        });
    }
});
</script>
@endsection