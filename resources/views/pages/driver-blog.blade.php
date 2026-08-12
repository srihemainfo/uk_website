@extends('layouts.app')
@section('title', $categoryData->seo_title ? $categoryData->seo_title : $categoryData->cat_name)
@section('meta_description', $categoryData->seo_description ?? 'Default Goride blog description')
@section('meta_keywords', $categoryData->meta_keywords ?? 'Goride, transport, blog, travel')
@section('content')
@php
use Illuminate\Support\Str;
    $iii = 1;
    //dd($categoryData);
@endphp

<style>
/* Blog Search Bar Styles */
.blog-search-wrapper {
    max-width: 700px;
    position: relative;
    z-index: 10;
    margin: 0 auto;
}
/* Wrapper for the stacked text */
.search-text-wrapper {
    display: flex;
    flex-direction: column;
    overflow: hidden;
    width: 100%;
}

/* Style for the Title */
.search-text-wrapper .search-title {
    font-weight: 600;
    font-size: 14px;
    line-height: 1.2;
    margin-bottom: 4px;
    color: #111;
}

/* Style for the Description snippet */
.search-text-wrapper .search-desc {
    font-size: 12px;
    color: #777;
    line-height: 1.4;
    font-weight: 400;
    /* This ensures long descriptions don't break the layout if JS truncation misses something */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis; 
}
.search-input-box {
    display: flex;
    align-items: center; /* Centers everything vertically */
    background: #000000; 
    border: 1px solid #f9bf00; 
    border-radius: 30px;
    padding: 0 18px; /* Removed vertical padding from container to let height handle centering */
    height: 44px; /* Set a fixed height for absolute alignment control */
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
    height: 100%; /* Spans the full height of the container */
    margin: 0;   /* Removes default browser structural margins */
    padding: 0;  /* Removes default browser paddings shifting the text baseline */
    line-height: 44px; /* Matches container height exactly to center placeholder text */
}

.search-input-box input::placeholder {
    color: #777;
    line-height: normal; /* Normalizes placeholder baseline engine */
}

.search-input-box .right-icon {
    color: #999; 
    font-size: 16px;
    margin-left: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    height: 100%; /* Ensures the icon area matches layout center bounds */
    transition: color 0.2s ease;
}

.search-input-box .right-icon:hover {
    color: #f9bf00;
}

/* Autocomplete Dropdown Styles */
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
    text-align: left;
    padding: 10px 16px;
    color: #333;
    text-decoration: none;
    transition: background 0.2s ease;
}

.search-results-dropdown a:hover {
    background: #fff9e6;
    color: #000;
}

.search-results-dropdown a i {
    color: #f9bf00;
    margin-right: 10px;
    font-size: 14px;
    margin-top: 4px; /* Slightly pushes the icon down to align perfectly with the first line of text */
    flex-shrink: 0; /* Prevents the icon from squishing when the text is very long */
}
.search-text-wrapper {
    display: flex;
    flex-direction: column;
    overflow: hidden;
    width: 100%;
}
.search-no-results {
    padding: 12px 16px;
    color: #777;
    font-style: italic;
    text-align: center;
    font-size: 14px;
}
/* --- PAGINATION YELLOW & BLACK THEME --- */

/* Force the pagination container to the right */
.blog-pagination nav {
    display: flex;
    justify-content: flex-end;
    width: 100%;
}

/* Hide the "Showing 1 to X results" text for a cleaner look */
.blog-pagination p.small.text-muted {
    display: none !important; 
}

/* Base style for the pagination buttons */
.blog-pagination .page-link {
    color: #000 !important;
    background-color: #fff !important;
    border: 1px solid #ddd !important;
    margin: 0 4px;
    border-radius: 8px !important; /* Rounded corners to match your cards */
    font-weight: 600;
    padding: 8px 16px;
    transition: all 0.3s ease;
    box-shadow: none !important;
}

/* Hover state (Yellow Background) */
.blog-pagination .page-link:hover {
    background-color: #f9bf00 !important;
    color: #000 !important;
    border-color: #f9bf00 !important;
    transform: translateY(-2px);
}

/* Active current page state (Yellow Background) */
.blog-pagination .page-item.active .page-link,
.blog-pagination .page-item.active span {
    background-color: #f9bf00 !important;
    border-color: #f9bf00 !important;
    color: #000 !important;
    font-weight: bold;
}

/* Disabled state (e.g., 'Previous' on page 1) */
.blog-pagination .page-item.disabled .page-link,
.blog-pagination .page-item.disabled span {
    color: #999 !important;
    background-color: #f8f9fa !important;
    border-color: #ddd !important;
    transform: none;
    cursor: not-allowed;
}

/* Fix for Laravel pagination arrow svg sizing */
.blog-pagination nav svg {
    height: 18px;
    width: 18px;
}
.cap-text{
    text-transform: capitalize;
}

.blog-breadcrumb {
    font-size: 15px;
    color: #333;
    font-weight: 500;
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
  /*min-width: 320px;*/
}

.blog-subscribe-section .subscribe-form input {
  flex: 1;
  padding: 12px 14px;
  border-radius: 8px;
  border: 1px solid #ddd;
  outline: none;
  margin-bottom:0px;
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

/* Mobile */
@media (max-width: 768px) {
     .blog-breadcrumb{
        display:flex;
        justify-content:center;
        align-items:center;
    }
.blog-subscribe-section.subscribe-box{
    flex-direction:column;
    margin-top:10px;
}
  .blog-subscribe-section .subscribe-box {
    flex-direction: column;
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
    padding-top: 30px;
}

/* Title */
.blog-section .blog-title {
  text-align: center;
  font-size: 32px;
  font-weight: 700;
  margin-bottom: 40px;
}

.blog-section .blog-title span {
  color: #f5b301;
}

/* Category Heading */
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

/* Update your existing blog-grid to 2 columns */
.blog-section .blog-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Changed from 3 to 2 */
    gap: 25px;
}

.blog-sidebar {
    background: #fff;
    padding: 25px;
    border-radius: 14px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    
    /* Sticky Magic */
    position: -webkit-sticky; /* For Safari compatibility */
    position: sticky;
    top: 100px; /* Increase this if your website has a fixed navbar */
    z-index: 10; 
}

.blog-sidebar-title {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f3ba00;
    text-transform: uppercase;
    color: #1b1b1b;
}

.blog-sidebar-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.blog-sidebar-list li {
    margin-bottom: 12px;
    border-bottom: 1px solid #f5f5f5;
    padding-bottom: 12px;
}

.blog-sidebar-list li:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.blog-sidebar-list a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #444;
    text-decoration: none;
    font-weight: 500;
    font-size: 15px;
    transition: color 0.3s;
}

.blog-sidebar-list a:hover {
    color: #f9bf00;
}

.blog-sidebar-list .cat-count {
    background: #f9bf0045;
    padding: 2px 10px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 700;
    color: #111;
}

/* Mobile Responsive adjustment for the grid */
@media (max-width: 992px) {
    .blog-section .blog-grid {
        grid-template-columns: 1fr; /* Switch to 1 column on tablets and below */
    }
    .blog-sidebar {
        margin-top: 40px;
    }
}

/* Card */
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

/* Image */
.blog-section .blog-card img {
  width: 100%;
  height: 200px;
  object-fit: fill;
}

/* Content */
.blog-section .blog-content {
  padding: 20px;
}

.blog-section .blog-tag {
    display: inline-block;
    font-size: 13px;
    font-weight: 700;
    color: #111111 !important;
    text-transform: uppercase;
    margin-bottom: 6px;
    background: #f9bf0045;
    max-width: fit-content;
    padding: 2px 12px;
    border-radius: 10px;
}

.blog-grid a {
    text-decoration: none !important;
    color: inherit !important;
    display: block;
}
.blog-section .blog-content h3 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 10px;
    color: #111 !important;
    line-height: 1.4;
    transition: color 0.2s ease;
}
.blog-grid a:hover .blog-content h3 {
    color: #f9bf00 !important;
}
.blog-section .blog-content p {
    font-size: 14px;
    color: #555 !important;
    line-height: 1.6;
    margin-bottom: 15px;
    font-weight: 400;
}

/* Meta */
.blog-section .blog-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 12px;
  color: #999;
}

.blog-section .blog-time{
    color:#1b1b1b;
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

/* Load More Button */
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

/* Responsive */
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
    font-size: 21px;Manage Smarter
    font-weight: bold;
    color: #000;
    background: #f9bf00;
    border-radius: 15px;
    /*text-transform: uppercase;*/
    text-decoration: none;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(249, 191, 0, 0.5), 0 0 40px rgba(249, 191, 0, 0.3) inset;
    transition: all 0.3s 
ease;
    animation: bounce 2s infinite;
    font-weight:600;
}

/* Shimmer effect */
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

/* Hover glow and scale */
.btn-agent-super:hover {
    transform: scale(1.15);
    box-shadow: 0 0 30px rgba(249,191,0,1), 0 0 60px rgba(249,191,0,0.7) inset;
    color:black !important;
}



/* Keyframes */
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
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
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
    border-radius:6px !important;

}

.agency-btn-wraap{
     display: flex;
    justify-content: space-evenly;
    align-items: center;
}

.agency-section{
    padding: 30px 0px;
         
  color: #fff;
  text-align: center;
  position: relative;
}

.overlay{

  padding: 60px 20px;
  border-radius: 10px;
}

.agency-section .section-title{
        font-size: 33px;
        margin-bottom:0px;
}
/* From Uiverse.io by augustin_4687 */ 
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
  transition:
    transform 150ms ease,
    box-shadow 150ms ease;
  text-align: center;
  box-shadow:
    0.5px 0.5px 0 0 var(--stone-800),
    1px 1px 0 0 var(--stone-800),
    1.5px 1.5px 0 0 var(--stone-800),
    2px 2px 0 0 var(--stone-800),
    2.5px 2.5px 0 0 var(--stone-800),
    3px 3px 0 0 var(--stone-800),
    0 0 0 2px var(--stone-50),
    0.5px 0.5px 0 2px var(--stone-50),
    1px 1px 0 2px var(--stone-50),
    1.5px 1.5px 0 2px var(--stone-50),
    2px 2px 0 2px var(--stone-50),
    2.5px 2.5px 0 2px var(--stone-50),
    3px 3px 0 2px var(--stone-50),
    3.5px 3.5px 0 2px var(--stone-50),
    4px 4px 0 2px var(--stone-50);

  &:hover {
    transform: translate(0, 0);
    box-shadow: 0 0 0 2px var(--stone-50);
  }


  &:active,
  &:focus-visible {
    outline-color: var(--yellow-400);
  }

  &:focus-visible {
    outline-style: dashed;
  }
  &:hover {
  transform: translate(0, 0);
  box-shadow: 0 0 0 2px var(--stone-50);

  color: black; // fallback

  & > div > span {
    color: black;
  }
}


  & > div {
    position: relative;
    pointer-events: none;
    background-color: var(--yellow-400);
    border: 2px solid rgba(255, 255, 255, 0.3);
  

    &::before {
      content: "";
      position: absolute;
      inset: 0;
      
      opacity: 0.5;
      background-image: radial-gradient(
          rgb(255 255 255 / 80%) 20%,
          transparent 20%
        ),
        radial-gradient(rgb(255 255 255 / 100%) 20%, transparent 20%);
      background-position:
        0 0,
        4px 4px;
      background-size: 8px 8px;
      mix-blend-mode: hard-light;
      animation: dots 0.5s infinite linear;
    }

    & > span {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 12px 21px 12px 0px;
      gap: 0.25rem;
      filter: drop-shadow(0 -1px 0 rgba(255, 255, 255, 0.25));

      &:active {
        transform: translateY(2px);
      }
    }
  }
}

@keyframes dots {
  0% {
    background-position:
      0 0,
      4px 4px;
  }
  100% {
    background-position:
      8px 0,
      12px 4px;
  }
}



/* Mobile */
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
        line-height: 21px;
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

    /* The Yellow Button */
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
        background-position: center
    }


    .driver-section .tagline {
        color: #f9bf00;
        font-weight: 600;
        font-size:16px;
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

    /* Image Column */
    /*   .driver-section  .image-col {*/
    /*        background: linear-gradient(135deg, #edece9 0%, #f3ba00 100%);*/
    /*position: relative;*/
    /*overflow: hidden;*/
    /*display: flex;*/
    /*align-items: center;*/
    /*justify-content: center;*/
    /*padding: 30px;*/
    /*height: 100%;*/
    /*    }*/

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
        /*justify-content: space-around;*/
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
        /* Center horizontally */
        z-index: 0;
        transition: transform 0.3s ease-out;
        padding:0px !important;
    }

    .section-subtitle {
        font-weight: 700;
        color: #040303;
    }

    /*.slider-fade .item .caption{*/
    /*    left:50%;*/
    /*}*/
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

    /* CARD */
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
        /* brand highlight */
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.12),
            0 6px 15px rgba(255, 193, 7, 0.25);
    }

    /* IMAGE WRAPPER */
    .feature-img-wrap {
        position: relative;
        display: inline-block;
        margin-bottom: 50px;
    }

    /* BEFORE – soft yellow blob */
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

    /* AFTER – subtle ring */
    /*.feature-img-wrap::after {*/
    /*    content: "";*/
    /*    position: absolute;*/
    /*    width: 130px;*/
    /*    height: 130px;*/
    /*    border: 2px dashed #ea0a04;*/
    /*    border-radius: 50%;*/
    /*    top: 50%;*/
    /*    left: 50%;*/
    /*    transform: translate(-50%, -50%);*/
    /*    z-index: 0;*/
    /*    opacity: 0.6;*/
    /*}*/

    /* IMAGE */
    .feature-img-wrap img {
        width: 77px;
        position: relative;
        z-index: 1;
        filter: drop-shadow(0 15px 30px rgba(0, 0, 0, 0.15));
    }

    /* TEXT */
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

    /* IMAGE WRAPPER */
    .fleet-image {
        position: relative;
        height: 260px;
        overflow: hidden;
    }

    /* IMAGE */
    .fleet-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* OVERLAY */
    .fleet-image::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1));
        z-index: 1;
    }

    /* ACCENT STRIPE */
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

    /* Hover accent */
    .fleet-card:hover .fleet-image::after {
        left: -20%;
    }

    /* CONTENT BELOW IMAGE */
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

    /* Small round image */
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
        background-color: rgba(0, 0, 0, 0.6);
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

    .theme-btn3 {
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

    .theme-btn3:hover {
        background: #e0a800;
        color: #000;
    }

    .theme-btn {
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

    .theme-btn:hover {
        background: #e0a800;
        transform: translateY(-2px);
        color: #000;
    }

    /* Fixed square wave effect with yellow only */
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
        0% {
            box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.8),
                0 0 0 0 rgba(255, 193, 7, 0.5);
        }

        50% {
            box-shadow: 0 0 0 5px rgba(255, 193, 7, 0.8),
                0 0 0 10px rgba(255, 193, 7, 0.3);
        }

        100% {
            box-shadow: 0 0 0 10px rgba(255, 193, 7, 0),
                0 0 0 15px rgba(255, 193, 7, 0);
        }
    }

    .header-jobs.download-app {
        right: 5% !important;
    }

    .header-jobs {
        right: 20% !important;
        bottom: 100px;
    }

    @media screen and (max-width: 767px) {
        .agency-button1{
            font-size:16px;
        }
        .payment-card{
                padding: 17px 14px;
        }
        .upgrade {
            padding: 38px 10px;
        }
        .agency-btn-wraap{
        flex-direction: column;
        gap:12px;
        }
        .capsule-cta{
              display: inline-flex;
        }
     
        .driver-section .stat-label {
            font-size: 16px;
        }

        .driver-section .stats {
            gap: 50px;
        }

        .driver-section .step-content {
            font-size: 16px;
        }

        .driver-section .step {
            padding: 10px;
        }

        .description {
            font-size: 16px;
        }

        .payment-section {
            padding: 30px 0px;
        }

        .agency-desc {
            font-size: 17px;
            margin-bottom: 12px;
        }

        .agency-btn {
            padding: 6px 19px;
            font-size: 15px;
        }

        .agency-content {
            max-width: 100%;
        }

        .carousel-inner .step {
            display: block;
        }

        .mycard {
            padding: 4px 17px;
            width: 90% !important;
        }

        .feature-col {
            margin-bottom: 20px;
        }

        .slider-fade .item .caption {
            left: 0%;
        }

        .fleet-grid {
            display: block;
        }


        .features-grid {
            display: block;
        }

        .theme-btn {
            padding: 6px 8px !important;
            font-size: 12px !important;
        }

        .theme-btn3 {
            padding: 6px 8px !important;
            font-size: 12px !important;
        }

        .header-jobs:hover {
            transform: translateX(-50%) !important;
        }

        .header-jobs {
            top: 225px;
        }

        .download-app.header-jobs {
            top: 270px;
        }
    }

    @media (max-width: 1400px) {

        .header-jobs {
            right: 25% !important;
        }

        .header-jobs {
            padding: 15px 10px !important;
        }

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
        #f2f2f2
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
        /* or whatever height you want */
        overflow-y: scroll;
        /* enable vertical scroll */

        /* hide scrollbar for all browsers */
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* IE 10+ */
        padding: 20px;
    }


    .phone-mockup::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari, Opera */
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
        .blog-main-heading{
            font-size:27px !important;
        }
           .blog-hero-section {
        padding: 60px 0px !important;
    }
    .blog-sub-heading{
        font-size:32px;
    }
        .slider-fade .item {
            background-position: right;
        }

        .feature-img-wrap img {
            width: 50px;

        }

        .feature-img-wrap::before {
            width: 90px;
            height: 90px;
        }

        .feature-img-wrap::after {
            width: 110px;
            height: 110px;
        }

        .header {
            height: 80vh !important;
        }

        .feature-img-wrap {
            margin-bottom: 45px;
        }

        .features-grid-section {
            padding: 25px;
        }

        .slider-fade .item .caption {
            top: 60% !important;
        }

        .jobs-heading {
            top: -16px;
            left: 50%;
            transform: translateX(-50%);
        }

        #about {
            padding: 0px !important;
        }

        .cs_cta.cs_style_1 .cs_section_title {
            font-size: 24px;
        }

        section .how {
            padding: 0px !important;
        }

        .job-box .title-box {
            width: 100% !important;
        }

        .job-search {
            max-width: 265px !important;

        }

        .phone-mockup {
            height: auto;
            max-height: 600px;
        }

        .notify-card {
            margin: 25px 0 !important;
            width: 100% !important;
            padding: 10px 10px 20px 10px !important;
        }

    }

    .notify-card {
        position: relative;
    }

    .phone-mockup .badge {
        position: absolute;
        bottom: 5px;
        right: 5px;
    }
.blog-hero-section {
    background:
        linear-gradient(rgba(20, 28, 40, 0.75), rgba(20, 28, 40, 0.75)),
        url('{{ asset('goride/img/main-banner.webp') }}'),
        #141c28;
    background-color: #141c28;

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;

    padding: 70px 0;
    width: 100%;
}

.blog-hero-inner{
    color:white;
}
.blog-main-heading{
    color:#f9bf00;
}

    @media only screen and (device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) {
        .i_phone {
            margin-top: -100px !important;
        }
    }
</style>

    

    <section class="blog-hero-section">
    <div class="container position-relative">
        <div class="blog-hero-inner text-center">
            <h1 class="blog-sub-heading text-white mt-5">{{ $categoryData->cat_name }}</h1>
            <!--<h2 class="blog-main-heading">-->
            <!--    Recent <span>Articles</span>-->
            <!--</h2>-->
            
            <!-- Blog Search Added Here -->
            <div class="blog-search-wrapper mt-4 mx-auto">
                <div class="search-input-box">
                    <!-- Car icon removed -->
                    <input type="text" id="blogSearchInput" placeholder="Search for blogs..." autocomplete="off">
                    <i class="fa fa-search right-icon"></i>
                </div>
                
                <div id="blogSearchResults" class="search-results-dropdown" style="display:none;">
                </div>
            </div>
            
        </div>
    </div>
</section>
<section class="blog-section">
    <div class="container">
        
        <div class="blog-breadcrumb mb-4">
            <a href="{{env('WEB_APP_URL')}}{{env('COUNTRY_SLUG')}}blog">Blog</a> 
            <span> &gt;&gt; </span>
            <a href="{{env('WEB_APP_URL')}}{{env('COUNTRY_SLUG_II')}}{{ $categoryData->cat_url }}" class="cap-text">{{ $categoryData->cat_name }}</a> 
        </div>

        <div class="my-3">
            <div class="row align-items-start">
                
                <div class="col-lg-8">
                    <div id="blog-data-wrapper">
                        
                        <div class="blog-grid">
                            @foreach($blogs as $blog)
                               <a href="{{ env('WEB_APP_URL') . env('COUNTRY_SLUG_II') . $categoryData->cat_url . '/' . $blog->slug }}">
                                    <div class="blog-card">
                                        <img src="{{ asset($blog->thumbnail) }}" alt="{{ $blog->blog_title }}">
                                        <div class="blog-content">
                                            <span class="blog-tag">{{ $blog->sub_title }}</span>
                                            <h3>{{ Str::limit($blog->blog_title, 50, '...') }}</h3>
                                            <p>{{ Str::limit(strip_tags($blog->description), 140, '...') }}</p>
                                            <div class="blog-meta">
                                                <span class="blog-time">
                                                    {{ \Carbon\Carbon::parse($blog->published_date)->format('M d, Y') }}
                                                    • {{ $blog->read_minutes }} min read
                                                </span>
                                                <span>Read More →</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div> 

                        <div class="blog-pagination mt-4 d-flex justify-content-end">
    {{ $blogs->withPath(env('WEB_APP_URL') . env('COUNTRY_SLUG_II') . $categoryData->cat_url)->links('pagination::bootstrap-5') }}
</div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="blog-sidebar">
                        <h3 class="blog-sidebar-title">Categories</h3>
                        <ul class="blog-sidebar-list">
                            @foreach($sidebarCategories as $sideCat)
                                <li>
                                    <a href="{{ env('WEB_APP_URL') . env('COUNTRY_SLUG_II') . '/' . trim($sideCat->cat_url, '/') }}">
                                        {{ $sideCat->cat_name }}
                                        <span class="cat-count">{{ $sideCat->total }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div> </div>
    </div>
</section>

<!--   <section class="blog-comment-section my-5">-->
<!--  <div class="container">-->
<!--<div class="row d-flex justify-content-center align-items-center ">-->

<!--    <div class="col-md-6 col-12">-->
<!--          <div class="blog-subscribe-section subscribe-box">-->
<!--      <div class="subscribe-text">-->
<!--        <h3>Stay in the loop</h3>-->
<!--        <p>-->
<!--          Join 50,000+ readers and get the latest urban mobility news and exclusive offers delivered straight to your inbox.-->
<!--        </p>-->
<!--      </div>-->

<!--      <form class="subscribe-form">-->
<!--        <input type="email" placeholder="your@email.com" required>-->
<!--        <button type="submit">Subscribe</button>-->
<!--      </form>-->
<!--    </div>-->
<!--    </div>-->
   
<!--    </div>-->

<!--  </div>-->
<!--</section>  -->


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close1" data-bs-dismiss="modal"><i class="fa fa-close"
                        style="width: 30px; height: 30px;border-radius: 50%; border: 1px solid #000;"></i></button>
                <!--         <h4 class="modal-title">Modal Header</h4> -->
            </div>
            <div class="modal-body text-center mt-4">
                <img src="{{ asset('goride/img/logo-dark.png') }}" class="logo-img" alt="" style="width: 200px;">
                <form class="frm-sec">
                    <div class="mb-3">
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Login with Mobile Number">

                    </div>
                    <button type="submit" class="btn btn-primary mb-3" style="width: 100%;">Get OTP</button>
                    <span class="by-click-text ">Already have an account? <a
                            class="by-click-text under-line text-danger " href="login" contenteditable="false"
                            style="cursor: pointer;"> Sign In
                        </a>
                    </span>
                </form>
            </div>
            <div class="modal-footer">
                <!--         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
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
        if (sliderItem) sliderItem.style.backgroundImage = "url('{{ asset('goride/img/new-home-banner3.webp') }}')";
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

(function() {
    function initBlogSearch() {
        const searchInput = document.getElementById('blogSearchInput');
        const resultsContainer = document.getElementById('blogSearchResults');
        if (!searchInput || !resultsContainer) return;

        let searchTimeout = null;

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = searchInput.value.trim();

            if (query.length < 2) {
                resultsContainer.style.display = 'none';
                resultsContainer.innerHTML = '';
                return;
            }

            searchTimeout = setTimeout(function() {
                const searchUrl = "{{ route('blog.search') }}?q=" + encodeURIComponent(query);
                fetch(searchUrl, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(function(res) { return res.json(); })
                .then(function(response) {
                    resultsContainer.innerHTML = '';
                    if (response && response.length > 0) {
                        let html = '<ul>';
                        response.forEach(function(blog) {
                            const baseUrl = "{{ env('WEB_APP_URL') }}{{ env('COUNTRY_SLUG_II') }}";
                            const link = baseUrl + blog.cat_url + '/' + blog.slug;
                            
                            let shortDesc = "";
                            if (blog.description) {
                                const tempDiv = document.createElement('div');
                                tempDiv.innerHTML = blog.description;
                                const plainText = tempDiv.textContent || tempDiv.innerText || "";
                                shortDesc = plainText.length > 70 ? plainText.substring(0, 70) + '...' : plainText;
                            }

                            html += '<li>' +
                                        '<a href="' + link + '">' +
                                            '<i class="fa fa-search"></i>' +
                                            '<div class="search-text-wrapper">' +
                                                '<div class="search-title">' + blog.blog_title + '</div>' +
                                                (shortDesc ? '<div class="search-desc">' + shortDesc + '</div>' : '') +
                                            '</div>' +
                                        '</a>' +
                                    '</li>';
                        });
                        html += '</ul>';
                        resultsContainer.innerHTML = html;
                        resultsContainer.style.display = 'block';
                    } else {
                        resultsContainer.innerHTML = '<div class="search-no-results">No blogs found for "' + query + '"</div>';
                        resultsContainer.style.display = 'block';
                    }
                })
                .catch(function(err) {
                    console.error("Error fetching search results:", err);
                });
            }, 300);
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.blog-search-wrapper')) {
                resultsContainer.style.display = 'none';
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initBlogSearch);
    } else {
        initBlogSearch();
    }
})();
    $(document).ready(function() {
    
    // Listen for clicks on the pagination links
    $(document).on('click', '.blog-pagination a', function(e) {
        e.preventDefault(); // Stop the page from reloading
        
        let url = $(this).attr('href'); // Get the URL of the clicked page
        
        // Slightly fade the grid to indicate it's loading
        $('#blog-data-wrapper').css('transition', 'opacity 0.3s').css('opacity', '0.4');

        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                let newContent = $(response).find('#blog-data-wrapper').html();
                
                $('#blog-data-wrapper').html(newContent).css('opacity', '1');
                
                $('html, body').animate({
                    scrollTop: $("#blog-data-wrapper").offset().top - 150
                }, 400);
                
            },
            error: function() {
                showToast('error', 'Could not load the next page. Please try again.', 3000);
                $('#blog-data-wrapper').css('opacity', '1');
            }
        });
    });

});
    $(document).ready(function(){       
    //   notifyJobs()
    }); 
    
    document.addEventListener('DOMContentLoaded', function() {
  // Initialize carousel with auto rotation on mobile
  if (window.innerWidth < 768) {
    const myCarousel = document.getElementById('stepsCarousel');
    if (myCarousel) {
      const carousel = new bootstrap.Carousel(myCarousel, {
        interval: 4000, // Rotate every 4 seconds
        wrap: true,
        touch: true
      });
    }
  }
});
    function convertDateFormat(txt, type = 'full') {
        let dateString = txt;
    
        // Create Date object (replace space with T so it's ISO compatible)
        let dateObj = new Date(dateString.replace(" ", "T"));
    
        // Extract day and month
        let day = String(dateObj.getDate()).padStart(2, '0');
        let month = dateObj.toLocaleString('en-US', { month: 'short' });
    
        if (type === 'date') {
            // Return only date format (e.g., "05 Sep")
            return `${day} ${month}`;
        }
    
        // Extract time components
        let hours = dateObj.getHours();
        let minutes = String(dateObj.getMinutes()).padStart(2, '0');
        let ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12; // Convert 24h to 12h format
    
        // Return full format (e.g., "05 Sep 02:15 PM")
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
            // headers: {
            //     "Authorization": "Bearer " + getCookie('sessionToken')
            // },
            data: [],
            contentType: false,
            processData: false,
            // beforeSend: function () {
            //     let btn = $("#con_create");
            //     btn.prop('disabled', true)
            //         .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...');
            // },
            success: function (response) {
                if (response.status) {
                    let data = response.data.jobs ? response.data.jobs : [];
                    $('#notify_jobs').empty();
                    let jobs_content = '';
                    if (data.length > 0) {

                        $.each(data, function (index, value) {

                            // let expiryTime = expiryCals(value.pickup_date);
                            value.pickup_date = convertDateFormat(value.pickup_date);
                            value.dropoff_date = value.dropoff_date ? convertDateFormat(value.dropoff_date, 'date') : '';
                            
                            let j_type = value.job_type == 'oneway' ? 'One Way' : 'Round Trip';

                            jobs_content +=

                                `<div class="notify-card blue aos-init aos-animate" >
                                    <img  src="{{ asset('goride/img/bell.gif') }}"  style="height: 42px; width: 42px"/>
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
                                  </div>`

                                ;
                        })
                        
                        jobs_content += `
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="{{ env('APP_URL') }}jobs" class="see-jobs-btn px-3">View Jobs</a>
                            </div>
                            
                        `;

                    }
                    else {
                        jobs_content = `
                                        
                                        <div class="notify-card blue aos-init aos-animate d-flex justify-content-center" >
                                                <i class="fa-solid fa-briefcase text-danger"></i>
                                              <h6>No More Jobs</h6>
                                              
                                          </div>
                                    `;
                                    
                        // hasMore = false;
                    }
                    $('#notify_jobs').html(jobs_content);
                    // // console.log(response.data);
                    
                    // page = response.data.next_page;
                    // hasMore = !!response.data.next_page;
                } else {
                    showToast('error', response.message, 3000);
                }
                
            },
            error: function () {
                showToast('error', 'Something went wrong!', 3000);
            },
            // complete: function () {
            //     loading = false;
            //     $("#loader").hide();
            // }
    });
        }
        
    
    }
 
</script>

@endsection