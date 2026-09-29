<style>

.nav-scroll {
    top:-102px;
}

.logo-img[src="/goride/img/logo-dark-new.png"]{
    top:16px !important;
    width:220px!important;
}
.nav-scroll .logo-img {
    margin-bottom: 0px;
    top: 14px;
    position: absolute;
    background: white;
    border-radius: 48px;
    padding: 5px;

}

.move-right{
position:relative;
left:350px;
transition:all .4s ease;
box-shadow:none !important;
}

@media (max-width:768px){
    
    .nav-scroll {
            top: -119px;
}
    .nav-scroll .logo-img {
        width: 167px;
        top: 32px !important;
    }
.move-right{
position:relative;
left:190px;
}

}

/* MOBILE VIEW */
@media (max-width:768px){

.app-download{
padding:40px 15px;
}

.app-container{
flex-direction:column;
padding:25px;
gap:20px;
text-align:center;
}

/* row fix */
.app-left .row{
flex-direction:column;
align-items:center !important;
justify-content:center !important;
}

.app-left .col-7,
.app-left .col-3{
width:100%;
max-width:100%;
flex:0 0 100%;
text-align:center;
}

/* gift icon */
.gift-icon{
font-size:50px;
margin-bottom:30px;
top:0px !important;
right:0px !important;
}

/* heading */
.app-left h2{
font-size:26px;
}

/* paragraph */
.app-left p{
font-size:14px;
}

/* input box */
.app-input{
max-width:100%;
margin:auto;
}

/* store button */
.store{
display:flex;
justify-content:center;
margin-top:15px;
}

.store img{
width:150px;
}

/* phone image */
.app-right{
margin-top:20px;
}

.app-right img{
width:180px;
margin:auto;
display:block;
}
.app-container::before{
display:none; /* softer look */
}

}

@media (max-width: 768px) {
    .fast-booking-bar{
font-size:13px !important;
display:none !important;
    }
    .logo-booking-wrapper{
justify-content:space-around !important;
}

.fast-booking-bar{
background:none;
border:none;
padding:0;
gap:8px;
}

.booking-text{
display:none;
}

.booking-number{
display:none;
}

.phone-link{
gap:0;
}

    .fare-table th,
.fare-table td{
  padding:12px;
  font-size:13px;
}

.fare-title{
  font-size:24px;
}

}

.phone{
  background:#f9bf00;
  color:#000;
}

.whatsapp{
  background:#25D366;
  color:#fff;
}
.phone-link{
  color:#f9bf00;
  text-decoration:none;
  display:flex;
  align-items:center;
  gap:6px;
}

.fast-booking-bar .i-circle{
  width:28px;
  height:28px;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:16px;
}

.phone-bg{
  background:#f9bf00;
  color:#000;
  font-size:12px;
}

.whatsapp-bg{
  background:#25D366;
  color:#fff;
}
.fast-booking-bar{
    
 display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 8px 16px;

    /* Remove border */
    border: none;

    /* Background */
    background: rgba(60, 42, 18, 0.85);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border-radius: 8px;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    animation: floatBar 4s ease-in-out infinite;

}
@keyframes floatBar{
  0%{
    transform:translateY(0);
  }
  50%{
    transform:translateY(-4px);
  }
  100%{
    transform:translateY(0);
  }
}

.phone-link{
  color:#f9bf00;
  text-decoration:none;
  display:flex;
  align-items:center;
  gap:4px;
}
.i-circle:hover{
    display:flex!important;
}
.phone-link:hover{
    display:flex!important;
}
.whatsapp-icon:hover{
    display:flex!important;
}

.whatsapp-icon{
  width:28px;
  height:28px;
  background:#25D366;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  color:#fff;
  font-size:14px;
}

.navbar .navbar-right .wrap .icon{
        height: 40px;
    width: 40px;
    font-size:20px;
}
.btn-signin {
 position: relative;
    font-size: 16px;
    font-weight: bold;
    padding: 5px 7px;
    border: none;
    transition: color 0.4s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    background: #f9bf00 !important;
    color: #222;
    width: 115px;
    overflow: hidden;
    z-index: 1;
}

/* Top closing */
.btn-signin::before,
.btn-signin::after {
  content: "";
  position: absolute;
  left: 0;
  width: 100%;
  height: 50%;
        background: #f9bf00;
  z-index: -1;
  transition: transform 0.4s ease;
}

/* Top slice */
.btn-signin::before {
  top: 0;
  transform: translateY(-100%);
}

/* Bottom slice */
.btn-signin::after {
  bottom: 0;
  transform: translateY(100%);
}

/* On Hover – bring both inward */
.btn-signin:hover::before {
  transform: translateY(0);
}
.btn-signin:hover::after {
  transform: translateY(0);
}

.btn-signin:hover {
  color: black !important;
}

.notranslate {
  translate: none;
}

.navbar-toggler[aria-expanded="true"] i {
    color: #f9bf00;
  }
  /*.btn-signin:hover {*/
  /*   font-weight: bold;*/
  /* padding: 4px 6px;*/
  /*  border: none;*/
  /*  transition: all 0.4s ease;*/
  /*  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);*/
  /*  background: linear-gradient(135deg, #FFB300, #FF5722);*/
  /*  color: #fff;*/
  /*  transform: translateY(-2px);*/
  /*}*/
  .gradient-globe {
  background: linear-gradient(to right, #ffc107, #ff4081); /* Yellow to pink */
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-size: 18px;
}
.skiptranslate{
    display:none;
}

body {
    position:static !important;
}
@media screen and (max-width: 576px) {
   

    .logo-img {
        margin-bottom: 0px;
        width: 167px;
        padding: 0;
    }
     .header .caption h2 {
        font-size: 23px;
    }
    /*.v-middle {*/
    /*    transform: translate(0%, -65%);*/
    /*    top:0;*/
    /*    margin-top:12px !important;*/
    /*}*/
    .cs_btn.cs_style_2{
        font-size:14px;
        padding:5px 24px;
    }
    /*.logo-img[src="/goride/img/logo-dark-new.png"]{*/
    /*    width: 171px;*/
    /*    top: -16px;*/
    /*}*/
    .btn-signin{
        padding: 6px 6px;
        font-size: 18px;
    }
    .navbar .navbar-right .wrap .icon{
            height: 43px;
    width: 43px;
    }
    
}

#topBar {
    /*position: sticky;*/
    /*top: 0;*/
    z-index: 999;
   
  }

  @media (max-width: 768px) {
    #topBar {
      transition: transform 0.3s ease;
              position: relative;
        top: 12px;
    }
    .navbar .navbar-collapse {
        max-height: 347px;
        /* overflow: auto; */
        /* background: #fff; */
        /* text-align: left; */
        /* position: fixed; */
        top: 85px;
        left: 0;
        width: 100vw;
        /* height: calc(100vh - 85px); */
        background-color: #fff;
        z-index: 99999;
        padding: 1rem;
        overflow-y: auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .slider-fade .item .caption {
        top:38%;
    }
    .slider-fade .item{
            height: 100%;
    }
    
  }
  
  .spinner {
    border: 2px solid #f3f3f3; /* Light grey */
    border-top: 2px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 16px;
    height: 16px;
    animation: spin 0.6s linear infinite;
    display: inline-block;
    vertical-align: middle;
    margin-left: 8px;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  .btn[disabled] {
    opacity: 0.6;
    pointer-events: none;
  }
  
</style>


{{-- <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>GoRide</title>
    <link rel="shortcut icon" href="{{ asset('goride/img/Go-Ride-fav-icon.webp') }}" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('goride/css/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('goride/css/style.css') }}" />
</head> --}}

<!-- Preloader -->
<!--<div id="preloader-wrap">-->
<!--    <div class="car">-->
<!--        <div class="strike"></div>-->
<!--        <div class="strike strike2"></div>-->
<!--        <div class="strike strike3"></div>-->
<!--        <div class="strike strike4"></div>-->
<!--        <div class="strike strike5"></div>-->
<!--        <div class="car-detail spoiler"></div>-->
<!--        <div class="car-detail back"></div>-->
<!--        <div class="car-detail center"></div>-->
<!--        <div class="car-detail center1"></div>-->
<!--        <div class="car-detail front"></div>-->
<!--        <div class="car-detail wheel"></div>-->
<!--        <div class="car-detail wheel wheel2"></div>-->
<!--    </div>-->
<!--</div>-->

<!-- Custom Cursor -->
<div class="custom-cursor"></div>

<!-- Progress scroll totop -->
<div class="progress-wrap cursor-pointer">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg" id="home_header_top">
   <div class="container mt-3" id="container">
   
        <!-- Logo -->
      <div class="logo-booking-wrapper d-flex justify-content-center align-items-center gap-5">

    <div class="logo-wrapper">
    <a class="logo"
       href="{{ request()->routeIs('blog*') || request()->routeIs('categoryIndex') || request()->routeIs('blogDetails') ? route('blog') : url('/') }}">
        <img src="/goride/img/logo-dark.png"
             class="logo-img"  alt="GoRide - Taxi Booking, Carpool & Bikepool Platform">
    </a>
</div>

<!--   <div class="fast-booking-bar">-->

<!--<span class="booking-text">For Bookings & Support :</span>-->

<!--<a href="tel:+916369742104" class="phone-link">-->
<!--<span class="i-circle phone-bg">-->
<!--<i class="fa-solid fa-phone text-white"></i>-->
<!--</span>-->

<!--<span class="booking-number">+91 63697 42104</span>-->
<!--</a>-->

<!--<a href="https://api.whatsapp.com/send/?phone=916369742104&text=Hi%21%20Need%20a%20cab.%20Please%20connect.&type=phone_number&app_absent=0"-->
<!--target="_blank" class="i-circle whatsapp-bg">-->
<!--<i class="fa-brands fa-whatsapp"></i>-->
<!--</a>-->

<!--</div>-->

</div>

        
        <!-- Mobile View - Language Dropdown and Hamburger -->
        
<?php 
/*
        <div class="d-flex d-lg-none align-items-center gap-2 ms-auto">
            <!-- Language Dropdown - Mobile Only -->
            <!--<div class="dropdown notranslate" translate="no">-->
            <!--    <button class="btn dropdown-toggle d-flex align-items-center text-warning p-2" type="button" id="mobileLanguageDropdown" data-bs-toggle="dropdown" aria-expanded="false">-->
            <!--        <i class="fas fa-globe gradient-globe"></i>-->
            <!--    </button>-->
            <!--     <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="mobileLanguageDropdown">-->
            <!--               <li><a class="dropdown-item" href="#" onclick="translatePage('en')">English</a></li> -->
            <!--           <li><a class="dropdown-item" href="#" onclick="translatePage('ar')">Arabic</a></li>-->
            <!--           <li><a class="dropdown-item" href="#" onclick="translatePage('fr')">French</a></li> -->
            <!--           <li><a class="dropdown-item" href="#" onclick="translatePage('es')">Spanish</a></li> -->
            <!--           <li><a class="dropdown-item" href="#" onclick="translatePage('pt')">Portuguese</a></li>-->
            <!--           <li><a class="dropdown-item" href="#" onclick="translatePage('ro')">Romanian</a></li>-->
            <!--           <li><a class="dropdown-item" href="#" onclick="translatePage('el')">Greek</a></li>-->
            <!--    </ul>-->


            <!--</div>-->
            
            <!-- Hamburger Button -->
            <button class="navbar-toggler collapsed d-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> 
                <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span> 
            </button>
        </div>
        
        <div class="row d-none">
            <!-- Desktop View - Top Bar (Language and Auth Buttons) -->
            <div class="col-12 d-none d-lg-flex justify-content-end mb-2 align-items-center gap-2" id="topBar">
                
                    @if ($userDetails != null && isset($userDetails['userID']) && $userDetails['userID'] != null)
           <button class="btn btn-signin" onclick="window.location.href='/dashboard'">
  Dashboard
</button>

<!-- Logout Button -->
<button class="btn btn-signin" onclick="logoutFUN()">
  Logout
</button>
     
     @else
     
<button class="btn btn-signin signin-btn" onclick="handleClick(this, '/login')" id="signin-btn">
  Log in
</button>
<button class="btn btn-signin signup-btn" onclick="handleClick(this, '/signup')" id="signup-btn">
  Sign Up
</button>

     
     @endif
                <!-- Language Dropdown - Desktop Only -->
                <!--<div class="dropdown notranslate" translate="no">-->
                <!--    <button class="btn dropdown-toggle d-flex align-items-center text-warning" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">-->
                <!--        <i class="fas fa-globe me-2 gradient-globe"></i>-->
                <!--        <span class="g_lang">English</span>-->
                <!--    </button>-->
                <!--    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">-->
                <!--       <li><a class="dropdown-item" href="#" onclick="translatePage('en')">English</a></li> -->
                <!--       <li><a class="dropdown-item" href="#" onclick="translatePage('ar')">Arabic</a></li>-->
                <!--       <li><a class="dropdown-item" href="#" onclick="translatePage('fr')">French</a></li> -->
                <!--       <li><a class="dropdown-item" href="#" onclick="translatePage('es')">Spanish</a></li> -->
                <!--       <li><a class="dropdown-item" href="#" onclick="translatePage('pt')">Portuguese</a></li>-->
                <!--       <li><a class="dropdown-item" href="#" onclick="translatePage('ro')">Romanian</a></li>-->
                <!--       <li><a class="dropdown-item" href="#" onclick="translatePage('el')">Greek</a></li>-->
                <!--    </ul>-->
                <!--</div>-->
            </div>

            <div id="google_translate_element" style="display: none;">
            
            </div>

            <div class="col-12">
                <div class="collapse navbar-collapse mb-2" id="navbar">
                    <!--<ul class="navbar-nav ms-auto">-->
                    <!--    <li class="nav-item"><a class="nav-link" href="/features">Features</a></li>-->
                    <!--    <li class="nav-item"><a class="nav-link" href="/crm-with-dispatch">CRM with Dispatch System</a></li>-->
                    <!--    <li class="nav-item"><a class="nav-link" href="/driver-app">My Riders App</a></li>-->
                    <!--    <li class="nav-item"><a class="nav-link" href="/passenger-app">My Passenger App</a></li>-->
                    <!--    <li class="nav-item"><a class="nav-link" href="/pricing">Pricing</a></li>-->
                    <!--</ul>-->
                    
         

<div class="d-lg-none text-center px-3 gap-2">
    @if ($userDetails != null && isset($userDetails['userID']) && $userDetails['userID'] != null)
         Logged In 
        <button class="btn btn-signin" onclick="window.location.href='/dashboard'">
            Dashboard
        </button>
        <button class="btn btn-signin" onclick="logoutFUN()">
            Logout
        </button>
    @else
             
<button class="btn btn-signin signin-btn" onclick="handleClick(this, '/login')">
  Log in
</button>
<button class="btn btn-signin signup-btn" onclick="handleClick(this, '/signup')">
  Sign Up
</button>
        
    @endif
</div>

                    
                    <!--<div class="navbar-right">-->
                    <!--    <div class="wrap">-->
                    <!--        <div class="phone-icon-wrapper">-->
                    <!--            <a href="tel:+919884557004" class="phone-icon">-->
                    <!--                <div class="icon"> <i class="flaticon-phone-call"></i> </div>-->
                    <!--            </a>-->
                    <!--            <div class="menu-icons">-->
                    <!--                <a href="tel:+16473661867" title="For Canada Only">-->
                    <!--                    <div class="icon"> <i class="fa-brands fa-canadian-maple-leaf"></i> </div>-->
                    <!--                </a>-->
                    <!--                <a href="tel:+917299888886" title="International">-->
                    <!--                    <div class="icon"> <i class="fa-solid fa-earth-asia"></i> </div>-->
                    <!--                </a>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
        
        */
        ?>
        
    </div>
</nav>

<script>
    var wind = $(window);

wind.on("scroll", function () {
    var bodyScroll = wind.scrollTop(),
        navbar = $(".navbar"),
        logo = $(".navbar .logo> img"),
        bookingBar = $(".fast-booking-bar");

    if (bodyScroll > 100) {
        navbar.addClass("nav-scroll");
        logo.attr('src', '/goride/img/logo-dark.png');
        bookingBar.addClass("move-right");
    } 
    else {
        navbar.removeClass("nav-scroll");
        logo.attr('src', '/goride/img/logo-light.png');
        bookingBar.removeClass("move-right");
    }

});
   
</script>