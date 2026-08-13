@extends('layouts.app')

@section('content')

@php
use Illuminate\Support\Str;
    $iii = 1;
    //dd($seoTags);
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

/* --- Modify these existing rules --- */

.search-results-dropdown a {
    display: flex;
    align-items: flex-start; /* Changed from center: keeps the icon at the top if text wraps */
    padding: 10px 16px;
    color: #333;
    text-decoration: none;
    transition: background 0.2s ease;
}

.search-results-dropdown a i {
    color: #f9bf00;
    margin-right: 12px;
    font-size: 14px;
    margin-top: 4px; /* Pushes the icon down slightly to align with the title text */
    flex-shrink: 0; /* Prevents the icon from squishing if the description is long */
}


/* --- Add these NEW rules --- */

/* Wrapper to stack title and description vertically */
.search-text-wrapper {
    display: flex;
    flex-direction: column;
    width: 100%;
    overflow: hidden;
}

/* Style for the Title */
.search-text-wrapper .search-title {
    font-weight: 600;
    font-size: 14px;
    color: #111;
    margin-bottom: 3px;
    line-height: 1.3;
}

/* Style for the Short Description */
.search-text-wrapper .search-desc {
    font-size: 12px;
    color: #666;
    line-height: 1.4;
    font-weight: 400;
    /* CSS safeguard to force truncation if JS misses anything */
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
.category-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  /*padding: 10px 0;*/
  color: #222;
  transition: 0.3s;
  font-weight: 600;
  font-size: 14px;
}

.category-item:hover {
text-decoration:underline !important;
display:flex;
}

.category-count {
  background: #f9bf0045;
  color: #111;
  padding: 2px 8px;
  border-radius: 50%;
  font-size: 12px;
  font-weight: 700;
  height: 30px;
    width: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.category-count:hover {
    text-decoration:none;
}
.blog-section-banner{
    background: linear-gradient(rgba(20, 28, 40, 0.75), rgba(20, 28, 40, 0.75)), url('{{ asset('goride/img/blog-main-banner.webp') }}'), #141c28;
    background-color: #141c28;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 70px 0;
    width: 100%;
}
/* REPLACE the blog-grid and sidebar CSS with this */

.blog-section .blog-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
}



.blog-section .blog-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  display: block;
}

/* Sidebar */
.blog-sidebar {
  /*position: sticky;*/
  /*top: 100px;*/
  background: #fff;
  border-radius: 14px;
  padding: 20px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.07);
}

.sidebar-title {
  font-size: 16px;
  font-weight: 800;
  margin-bottom: 10px;
  letter-spacing: 1px;
  padding-bottom: 10px;
  border-bottom: 2px solid #f9bf00;
  color: #111;
}

.recent-post-item {
  display: flex;
  gap: 12px;
  margin-bottom: 15px;
  align-items: flex-start;
}

.recent-thumb {
  flex-shrink: 0;
}

.recent-thumb img {
  width: 80px;
  height: 60px;
  object-fit: cover;
  border-radius: 8px;
  display: block;
}

.recent-info {
  flex: 1;
  min-width: 0;
}

.recent-date {
    font-size: 13px;
    color: #6d6d6d;
    display: inline;
    margin-bottom: 4px;
    font-weight: 600;
    border-radius: 7px;
}

.recent-title {
  font-size: 13px;
  font-weight: 600;
  margin-bottom: 6px;
  line-height: 1.4;
}

.recent-title a {
  text-decoration: none;
  color: #222;
  transition: 0.3s;
}
.recent-title a:hover{
    text-decoration: underline;
}
.recent-btn {
 display: inline;
    font-size: 11px;
    padding: 5px 10px;
    border-radius: 6px;
    background: #f9bf00;
    text-decoration: none;
    font-weight: 600;
    color: #000;
}

.recent-btn:hover{
   color: #000;
    display: inline;
    transform: translateX(4px);
    box-shadow: 0 4px 12px rgba(249,191,0,0.4);
}
.sidebar-divider {
  height: 1px;
  background: #eee;
  margin: 12px 0;
}

/* Responsive */
@media (max-width: 992px) {
  .blog-section .blog-grid {
    grid-template-columns: repeat(1, 1fr);
  }
}

@media (max-width: 768px) {
  .blog-section .blog-grid {
    grid-template-columns: 1fr;
  }
  .blog-sidebar {
    position: relative;
    top: 0;
    margin-top: 30px;
  }
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
    /*display: flex;*/
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
    .blog-section-banner {
        padding:60px 0px;
}
    .blog-breadcrumb{
        display:flex;
        justify-content:center;
        align-items:center;
    }
    .blog-section {
        padding-top:10px;
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
  font-family: "Segoe UI", sans-serif;
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

/* Grid */
.blog-section .blog-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 25px;
}

/* Card */
.blog-section .blog-card {
  background: #fff;
  border-radius: 14px;
  overflow: hidden;
  box-shadow: 0 8px 25px rgba(0,0,0,0.08);
  transition: 0.3s ease;
  height:100%;
}

.blog-section .blog-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 15px 35px rgba(0,0,0,0.12);
}

.blog-section .blog-card-img-wrap {
  width: 100%;
  aspect-ratio: 16 / 9;
  overflow: hidden;
  border-radius: 0;
}

.blog-section .blog-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  display: block;
}

.blog-card-link {
    color: inherit !important;
    text-decoration: none !important;
    display: block;
}

/* Content */
.blog-section .blog-content {
  padding: 20px;
}

/* Tag */
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
<<<<<<< HEAD
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 10px;
    color: #111 !important;
    line-height: 1.4;
    transition: color 0.2s ease;
}
.blog-grid a:hover .blog-content h3 {
    color: #f9bf00 !important;
=======
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 10px;
  color: #111111 !important;
  line-height: 1.4;
  transition: color 0.2s ease;
}

.blog-card-link:hover .blog-content h3 {
  color: #f9bf00 !important;
>>>>>>> 3a768fb42bbd48d52c79dbe1bbf53e3bfd36b2f7
}
.blog-section .blog-content p {
    font-size: 14px;
<<<<<<< HEAD
    color: #555 !important;
=======
    color: #555555 !important;
>>>>>>> 3a768fb42bbd48d52c79dbe1bbf53e3bfd36b2f7
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

.blog-section .blog-time{
    color: #1b1b1b !important;
    font-weight: 500;
}

.blog-section .blog-meta a {
    color: #f3ba00 !important;
    font-weight: 600;
    text-decoration: none;
}

.blog-section .blog-meta a:hover {
  text-decoration: underline;
}

/* Load More Button */
.load-more-btn {
    display: inline-block;
    padding: 12px 32px;
    background: #f9bf00;
    color: #000 !important;
    font-weight: 700;
    font-size: 15px;
    border-radius: 30px;
    border: 2px solid #f9bf00;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(249, 191, 0, 0.3);
    text-decoration: none !important;
    outline: none;
}

.load-more-btn:hover {
    background: #000;
    color: #f9bf00 !important;
    border-color: #000;
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
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
    font-size: 21px;
    font-weight: bold;
    color: #000;
    background: #f9bf00;
    border-radius: 15px;
    /*text-transform: uppercase;*/
    text-decoration: none;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(249, 191, 0, 0.5), 0 0 40px rgba(249, 191, 0, 0.3) inset;
    transition: all 0.3s ease;
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
    }

    .cs_btn.cs_style_2 {
        background: #f9bf00;
        color: #000;
        font-weight: 600;
        padding: 10px 24px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .cs_btn.cs_style_2:hover {
        background: #e0a800;
        color: #000;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(249, 191, 0, 0.4);
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
        
         .blog-sidebar {
        position: relative;
        top: 0;
        margin-top: 40px;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 12px;
    }

    .recent-post-item {
        gap: 10px;
    }

    .recent-thumb img {
        width: 60px;
        height: 60px;
    }

    .recent-title {
        font-size: 13px;
    }

    .recent-btn {
        padding: 4px 10px;
        font-size: 10px;
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

    @media only screen and (device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) {
        .i_phone {
            margin-top: -100px !important;
        }
    }
</style>

    
    
<section class="blog-section-banner">
    <div class="container position-relative">
        <div class="section-title mt-5 text-center text-white">
            Our <span>Blogs</span> 
        </div>
        
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
</section>

<section class="blog-section">
  <div class="container">
    <div class="row">

      {{-- LEFT: Blog Cards (col-8) --}}
      <div class="col-12 col-lg-8 order-1">
        <div class="my-3">

          @foreach($groupedBlogs as $categoryBlogs)

            <a href="{{env('WEB_APP_URL')}}{{env('COUNTRY_SLUG_II')}}{{$categoryBlogs[0]->cat_url}}" class="blog-category-link text-decoration-none">
              <div class="blog-category">
                {{ \Illuminate\Support\Str::upper($categoryBlogs[0]->cat_name) }}
              </div>
            </a>

            <div class="blog-grid">
              @foreach($categoryBlogs as $blog)
                <a href="{{env('WEB_APP_URL')}}{{env('COUNTRY_SLUG_II')}}{{ $categoryBlogs[0]->cat_url.'/'.$blog->slug }}" class="blog-card-link text-decoration-none">
                  <div class="blog-card">

                    <div class="blog-card-img-wrap">
                      <img src="{{ asset($blog->thumbnail) }}" alt="{{ $blog->blog_title }}">
                    </div>

                    <div class="blog-content">
                      <span class="blog-tag">{{ $blog->sub_title }}</span>
                      <h3>{{ Str::limit($blog->blog_title, 55, '...') }}</h3>
                      <p>{{ Str::limit(strip_tags($blog->description), 120, '...') }}</p>
                      <div class="blog-meta">
                        <span class="blog-time">
                          {{ \Carbon\Carbon::parse($blog->published_date)->format('M d, Y') }}
                          &bull; {{ $blog->read_minutes }} min read
                        </span>
                        <span class="text-warning fw-semibold" style="font-size:12px;">Read More →</span>
                      </div>
                    </div>

                  </div>
                </a>
              @endforeach
            </div>

            <div class="text-center mt-4 mb-5">
              <button class="load-more-btn"
                onclick="window.location.href='{{env('WEB_APP_URL')}}{{env('COUNTRY_SLUG_II')}}{{ $categoryBlogs[0]->cat_url }}'">
                Load More Articles
              </button>
            </div>

          @endforeach

        </div>
      </div>

      {{-- RIGHT: Sidebar (col-4) --}}
<div class="col-12 col-lg-4 order-2">
    <div class="blog-sidebar mt-3 mt-lg-5">
        <h5 class="sidebar-title">CATEGORIES</h5>
        <div class="category-list category-list-scroll">
            {{-- Loop through the dedicated sidebar variable --}}
            @foreach($sidebarCategories as $category)
                <a href="{{env('WEB_APP_URL')}}{{env('COUNTRY_SLUG_II')}}{{ $category->cat_url }}" class="category-item text-decoration-none">
                    <span class="category-name">{{ \Illuminate\Support\Str::upper($category->cat_name) }}</span>
                    <span class="category-count">{{ $category->total }}</span>
                </a>
                <div class="sidebar-divider"></div>
            @endforeach
        </div>
    </div>
</div>

    </div>
  </div>
</section>

<!--    <section class="blog-comment-section my-5">-->
<!--  <div class="container">-->
<!--<div class="row d-flex justify-content-center align-items-center ">-->
     
<!--    <div class=" col-md-6 col-12">-->
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
<!--</section>-->



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

(function() {
    function initBlogSearch() {
        const searchInput = document.getElementById('blogSearchInput');
        const resultsContainer = document.getElementById('blogSearchResults');
        if (!searchInput || !resultsContainer) return;

        let searchTimeout = null;

<<<<<<< HEAD
        <div class="row">
            <div class="col-md-6">
                <h2>About Us</h2>
                <p>Learn more about our mission, values, and team.</p>
            </div>
            <div class="col-md-6">
                <h2>Contact Us</h2>
                <p>Get in touch with us for any inquiries or support.</p>
            </div>
        </div>
    </div> --}}

=======
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = searchInput.value.trim();

            if (query.length < 2) {
                resultsContainer.style.display = 'none';
                resultsContainer.innerHTML = '';
                return;
            }
>>>>>>> 3a768fb42bbd48d52c79dbe1bbf53e3bfd36b2f7

            searchTimeout = setTimeout(function() {
                const webAppUrl = "{{ env('WEB_APP_URL') }}".replace(/\/$/, '');
                const countrySlug = "{{ env('COUNTRY_SLUG_II') ?: env('COUNTRY_SLUG') }}";
                const baseUrl = (webAppUrl || window.location.origin) + (countrySlug ? (countrySlug.startsWith('/') ? countrySlug : '/' + countrySlug) : '');
                const searchUrl = baseUrl + "/blog/search?q=" + encodeURIComponent(query);

<<<<<<< HEAD
    $('#blogSearchInput').on('keyup', function() {
        clearTimeout(searchTimeout);
        let query = $(this).val().trim();
        let resultsContainer = $('#blogSearchResults');

        if (query.length < 2) {
            resultsContainer.hide().empty();
            return;
        }

        searchTimeout = setTimeout(function() {
            $.ajax({
                url: "{{ route('blog.search') }}",
                type: "GET",
                data: { q: query },
                global: false,
                crossDomain: true,
                xhrFields: {
                    withCredentials: false
                },
                success: function(response) {
                    resultsContainer.empty();
                    
                    if (response.length > 0) {
=======
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
>>>>>>> 3a768fb42bbd48d52c79dbe1bbf53e3bfd36b2f7
                        let html = '<ul>';
                        response.forEach(function(blog) {
                            const catPath = blog.cat_url ? (blog.cat_url.startsWith('/') ? blog.cat_url : '/' + blog.cat_url) : '';
                            const link = baseUrl + catPath + '/' + blog.slug;
                            
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

if (typeof $ !== 'undefined' && $.fn && $.fn.owlCarousel) {
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
}
</script>

@endsection