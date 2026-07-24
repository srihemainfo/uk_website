@extends('layouts.app')
@section('content')
    <div id="mobileActionBar">
        <a href="tel:+441234567890" class="mob-action-btn">
            <div class="mob-action-icon">
                <i class="fas fa-phone"></i>
            </div>
            <span>Call Us</span>
        </a>
        <a href="https://wa.me/441234567890" target="_blank" class="mob-action-btn">
            <div class="mob-action-icon">
                <i class="fab fa-whatsapp"></i>
            </div>
            <span>WhatsApp</span>
        </a>
        <button class="mob-action-btn" onclick="document.getElementById('pickupInput').focus()">
            <div class="mob-action-icon">
                <i class="fas fa-car-side"></i>
            </div>
            <span>Book a Ride</span>
        </button>
    </div>
    <div class="hero-container row g-0">
        <div class="hero-form-section  col-md-5 col-12">
            <!-- MOBILE MAP BAR - only visible on mobile steps >= 2 -->
            <div id="mobileMapBar" style="display: none;">
                <span><i class="fas fa-location-dot" style="color: #333; margin-right:5px;"></i> <span
                        id="mobileMapRouteText">Your route</span></span>
                <button onclick="toggleMobileMap()">
                    <i class="fas fa-map"></i> View Map
                </button>
            </div>
            <!-- COMPACT MOBILE SUMMARY -->
            <div id="mobileCompactSummary" class="mobile-trip-summary">
                <div class="mobile-trip-header" onclick="toggleTripSummary()" style="align-items: flex-start;">
                    <div class="location-group-wrapper" style="width: 100%; gap: 12px; ">
                        <div class="route-indicator"
                            style="padding-top: 4px; padding-bottom: 4px; justify-content: space-between;">
                            <i class="fas fa-location-dot route-dot-start" style="font-size: 15px;"></i>
                            <div class="route-line" style="min-height: 18px; margin: 4px 0;"></div>
                            <i class="fas fa-location-dot route-dot-end" style="font-size: 15px;"></i>
                        </div>
                        <div class="location-fields"
                            style="flex: 1; display: flex; flex-direction: column; justify-content: space-between; padding: 2px 0;">
                            <div class="mobile-from"
                                style="font-weight: 600; font-size: 14px; color: #111; display: flex; align-items: center; gap: 0;">
                                <span id="mcsPickup" class="text-truncate"></span>
                            </div>
                            <div class="mobile-to"
                                style="font-weight: 600; font-size: 14px; color: #111; margin-top: 10px; display: flex; align-items: center; gap: 0;">
                                <span id="mcsDropoff" class="text-truncate"></span>
                            </div>
                        </div>
                    </div>
                    <i class="fas fa-chevron-down" id="tripSummaryArrow" style="margin-top: 6px;"></i>
                </div>
                <div class="mobile-trip-body" id="mobileTripBody">
                    <div class="mobile-trip-item">
                        <i class="fas fa-calendar"></i>
                        <span id="mcsDateTime"></span>
                    </div>
                    <div id="mcsCarDetails"
                        style="display:none; margin-top: 15px; border-top: 1px solid #eee; padding-top: 15px;">
                        <div class="selected-car-row" style="margin-bottom: 8px;">
                            <div class="summary-car-details">
                                <h4
                                    style="font-size:16px; margin-bottom:6px; display:flex; align-items:center; gap:8px;">
                                    <i class="fas fa-car"></i>
                                    <span id="mcsCarName">-</span>
                                </h4>

                            </div>
                            <div class="summary-car-price" id="mcsCarPrice"
                                style="font-size: 17px; font-weight: 700; margin-left: auto;">£0</div>
                        </div>
                        <div class="booking-summary-list" id="mcsEnteredDetails"
                            style="font-size: 14px; display:none; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                            <div class="booking-summary-item" id="mcsPassengerNameContainer"
                                style="display:none;  border-radius: 8px; justify-content: space-between;">
                                <span class="summary-label"><i class="fas fa-user"
                                        style="font-size: 15px;"></i></span>
                                <span class="summary-value" id="mcsPassengerName"
                                   >-</span>
                            </div>
                            <div class="booking-summary-item" id="mcsPassengerPhoneContainer"
                                style="display:none;  border-radius: 8px; justify-content: space-between;">
                                <span class="summary-label"><i class="fas fa-phone"
                                        style=" font-size: 15px;"></i></span>
                                <span class="summary-value" id="mcsPassengerPhone"
                                    >-</span>
                            </div>
                            <div class="booking-summary-item" id="mcsPassengerEmailContainer"
                                style="display:none;   border-radius: 8px; justify-content: space-between;">
                                <span class="summary-label"><i class="fas fa-envelope"
                                        style=" font-size: 15px;"></i></span>
                                <span class="summary-value" id="mcsPassengerEmail"
                                   >-</span>
                            </div>
                            <div class="booking-summary-item"
                                style=" border-radius: 8px; justify-content: space-between;">
                                <span class="summary-label"><i class="fas fa-users"
                                        style=" font-size: 15px;"></i></span>
                                <span class="summary-value" id="mcsPassengerCount"
                                    >1</span>
                            </div>
                            <div class="booking-summary-item" id="mcsLuggageContainer"
                                style="display:none;  border-radius: 8px; justify-content: space-between;">
                                <span class="summary-label"><i class="fas fa-suitcase"
                                        style="color: #666; font-size: 15px;"></i></span>
                                <span class="summary-value" id="mcsLuggageCount"
                                  >0</span>
                            </div>
                            <div class="booking-summary-item" id="mcsHandLuggageContainer"
                                style="display:none; border-radius: 8px; justify-content: space-between;">
                                <span class="summary-label"><i class="fas fa-briefcase"
                                        style="color: #666; font-size: 15px;"></i></span>
                                <span class="summary-value" id="mcsHandLuggageCount"
                                    >0</span>
                            </div>
                            <div class="booking-summary-item" id="mcsBabySeatContainer"
                                style="display:none; border-radius: 8px; justify-content: space-between;">
                                <span class="summary-label"><i class="fas fa-baby-carriage"
                                        style="color: #666; font-size: 15px;"></i></span>
                                <span class="summary-value" id="mcsBabySeats"
                                 >0</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- TIME SELECTION PANEL -->
            <div id="timeSelectionPanel" class="time-selection-panel">
                <div class="time-panel-header">
                    <button class="time-panel-header-back" onclick="hidePickupTimePanel()">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <!-- <button class="time-panel-header-clear" onclick="hidePickupTimePanel()">Clear</button> -->
                </div>
                <h3 class="time-panel-title" id="timePanelTitle">When do you want to be picked up?</h3>
                <p class="time-panel-subtitle">From <span id="timePanelLocation"></span></p>
                <div class="time-inputs" id="genericTimeInputs">
                    <div class="date-time-screen">
                        <!-- Date Column -->
                        <div>
                            <!-- Dynamic Date Label (hidden by default) -->
                            <div class="form-group-uber mb-2" id="dateLabelContainer" style="display:none;">
                                <label id="dateLabel" style="font-size:14px; font-weight:600;"></label>
                            </div>
                            <div class="time-input-wrapper">
                                <i class="fas fa-calendar time-input-icon"></i>
                                <input type="text" id="date" placeholder="Today" class="time-input-field" readonly>
                                <i class="fas fa-chevron-down time-input-chevron"></i>
                            </div>
                        </div>
                        <!-- Time Column -->
                        <div>
                            <!-- Dynamic Time Label (hidden by default) -->
                            <div class="form-group-uber mb-2" id="timeLabelContainer" style="display:none;">
                                <label id="timeLabel" style="font-size:14px; font-weight:600;"></label>
                            </div>
                            <!-- CUSTOM TIME DROPDOWN -->
                            <div class="time-dropdown-wrapper" id="mainTimeDropdownWrapper">
                                <button type="button" class="time-dropdown-btn" id="timeDropdownBtn"
                                    onclick="toggleTimeDropdown()">
                                    <i class="fas fa-clock me-1"></i> <span id="timeDropdownValue">Select time
                                    </span>
                                    <span class="time-dropdown-icon"><i class="fas fa-chevron-down"></i></span>
                                </button>
                                <div class="time-dropdown-list" id="timeDropdownList">
                                    <div class="time-dropdown-item" onclick="selectTime('07:00 AM')">7:00 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('07:30 AM')">7:30 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('08:00 AM')">8:00 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('08:30 AM')">8:30 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('09:00 AM')">9:00 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('09:30 AM')">9:30 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('10:00 AM')">10:00 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('10:30 AM')">10:30 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('11:00 AM')">11:00 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('11:30 AM')">11:30 AM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('12:00 PM')">12:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('12:30 PM')">12:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('01:00 PM')">1:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('01:30 PM')">1:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('02:00 PM')">2:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('02:30 PM')">2:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('03:00 PM')">3:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('03:30 PM')">3:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('04:00 PM')">4:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('04:30 PM')">4:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('05:00 PM')">5:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('05:30 PM')">5:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('06:00 PM')">6:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('06:30 PM')">6:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('07:00 PM')">7:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('07:30 PM')">7:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('08:00 PM')">8:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('08:30 PM')">8:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('09:00 PM')">9:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('09:30 PM')">9:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('10:00 PM')">10:00 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('10:30 PM')">10:30 PM
                                    </div>
                                    <div class="time-dropdown-item" onclick="selectTime('11:30 PM')">11:30 PM
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Close Time Column -->
                    </div> <!-- Close Grid -->
                    <!-- ONLY VISIBLE WHEN AIRPORT †’ AIRPORT -->
                    <div id="airportLandingFields" style="display: none;">
                        <div class="form-group-uber">
                            <label><i class="fas fa-hourglass-end"></i> Pickup After Landing</label>
                            <select id="pickupAfterLanding">
                                <option value="15">15 Min After</option>
                                <option value="30">30 Min After</option>
                                <option value="45" selected>45 Min After</option>
                                <option value="60">60 Min After</option>
                                <option value="75">75 Min After</option>
                                <option value="90">90 Min After</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- <p class="time-hint">
                    <i class="far fa-calendar-alt"></i> Choose your pick-up time up to 90 days in advance
                </p> -->
                <button id="timePanelDoneBtn" class="btn-search-uber mt-5" onclick="saveSchedule()">
                    See Prices
                </button>
            </div>
            <!-- STEP 1: LOCATIONS -->
            <div class="form-section active" id="step1">
                <div class="container">
                    <div class="booking-title-group">
                        <h3 class="booking-title">Where to?</h3>
                        <!--<button type="button" id="addViaBtn" class="btn-add-via" onclick="addViaPoint()">-->
                        <!--    + Add Via-->
                        <!--</button>-->
                    </div>
                    <!-- <div id="selectedDateTime" class="selectdate"></div> -->
                    <div class="location-group-wrapper">
                        <!-- Route indicator: yellow dot, dotted line, black pin -->
                        <div class="route-indicator">
                            <i class="fas fa-location-dot route-dot-start"></i>
                            <div class="route-line"></div>
                            <i class="fas fa-location-dot route-dot-end"></i>
                        </div>
                        <div class="location-fields">
                            <!-- PICKUP -->
                            <div class="form-group-uber">
                                <label>Pickup Location</label>
                                <div class="location-input-wrapper" id="pickupWrapper">

                                    <input type="text" id="pickupInput" placeholder="Enter pickup location"
                                        class="location-input-field" autocomplete="off"
                                        onfocus="scrollToInputMobile(this)"
                                        onkeyup="handleLocationSearch(this.value, 'pickupSuggestions', 'pickup', 'pickupWrapper')"
                                        onclick="if(this.value.length>=2) handleLocationSearch(this.value, 'pickupSuggestions', 'pickup', 'pickupWrapper')">
                                    <div class="location-suggestions" id="pickupSuggestions"></div>
                                </div>
                            </div>
                            <!-- VIA POINTS -->
                            <div id="viaPointsContainer"></div>
                            <!-- DROPOFF -->
                            <div class="form-group-uber">
                                <label>Dropoff Location</label>
                                <div class="location-input-wrapper" id="dropoffWrapper">

                                    <input type="text" id="dropoffInput" placeholder="Enter dropoff location"
                                        class="location-input-field" autocomplete="off"
                                        onfocus="scrollToInputMobile(this)"
                                        onkeyup="handleLocationSearch(this.value, 'dropoffSuggestions', 'dropoff', 'dropoffWrapper')"
                                        onclick="if(this.value.length>=2) handleLocationSearch(this.value, 'dropoffSuggestions', 'dropoff', 'dropoffWrapper')">
                                    <div class="location-suggestions" id="dropoffSuggestions"></div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-swap-locations" onclick="swapLocations()" title="Swap Locations">
                            <i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i>
                        </button>
                    </div>
                    <div class="m-3">
                        <button class="pickup-now-btn" id="pickupNowBtn" onclick="showSchedulePanelFromStep1()">
                            <i class="fas fa-clock"></i>
                            Pickup Now
                            <i class="fas fa-chevron-down ms-2"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <button class="btn-search-uber" onclick="proceedToTripDetails()" style="margin-top: 20px;">
                            <i class="fas fa-arrow-right me-2"></i> See prices
                        </button>
                    </div>

                    <!-- MOBILE TRUST BADGES -->
                    <div class="mob-trust-badges d-none">
                        <div class="mob-trust-badge">
                            <div class="mob-trust-icon">
                                <i class="fas fa-shield-halved"></i>
                            </div>
                            <div class="mob-trust-text">
                                <span class="mob-trust-title">Safe &amp; Secure</span>
                                <!-- <span class="mob-trust-sub">Verified drivers</span> -->
                            </div>
                        </div>
                        <div class="mob-trust-badge">
                            <div class="mob-trust-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="mob-trust-text">
                                <span class="mob-trust-title">Quick &amp; Reliable</span>
                                <!-- <span class="mob-trust-sub">On time, every time</span> -->
                            </div>
                        </div>
                        <div class="mob-trust-badge">
                            <div class="mob-trust-icon">
                                <i class="fas fa-sterling-sign"></i>
                            </div>
                            <div class="mob-trust-text">
                                <span class="mob-trust-title">No Hidden Charges</span>
                                <!-- <span class="mob-trust-sub">Transparent pricing</span> -->
                            </div>
                        </div>
                    </div>
                    <!--<div class="offer-credits-section mt-3">-->
                    <!--    <div class="offer-icon">-->
                    <!--        <i class="fas fa-gift"></i>-->
                    <!--    </div>-->
                    <!--    <div class="offer-content">-->
                    <!--        <div class="offer-title">First Ride Credit</div>-->
                    <!--        <div class="offer-subtitle">Save up to £10</div>-->
                    <!--    </div>-->
                    <!--    <button class="offer-apply-btn" onclick="showAppPromoModal()">Apply</button>-->
                    <!--</div>-->
                </div>
            </div>
            <!-- STEP 2: SUMMARY & PREFERENCES -->
            <div class="form-section" id="step2">
                <div class="container">
                    <div id="tripMainContent">
                        <div class="find-trip-card" id="findTripCard">
                            <div class="find-trip-locations">
                                <!-- SINGLE EDIT AT TOP & LOCATIONS LIKE STEP 1 -->
                                <div
                                    style="display: flex; justify-content: center; align-items: center; ">
                                    <span
                                        style="display: block;font-size: 20px;font-weight: 600;color: black;letter-spacing: 0.5px;">Trip
                                        Details</span>
                                    <button class="edit-icon-btn" onclick="goBackToLocations()" title="Edit trip">
                                        <i class="fas fa-pencil"></i> Edit
                                    </button>
                                </div>
                                <div class="location-group-wrapper">
                                    <div class="route-indicator">
                                        <i class="fas fa-location-dot route-dot-start"></i>
                                        <div class="route-line"></div>
                                        <i class="fas fa-location-dot route-dot-end"></i>
                                    </div>
                                    <div class="location-fields">
                                        <div class="form-group-uber">
                                            <div class="trip-details" id="summaryPickup">–</div>
                                        </div>
                                        <div class="form-group-uber" style="margin-top: 15px;">
                                            <div class="trip-details" id="summaryDropoff">–</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- FOR ME (KEEP EXISTING) -->
                                <button type="button" class="trip-location-item" onclick="showForMeModal()" style="display: none !important;">
                                    <div class="trip-location-icon">
                                        <i class="fas fa-user"></i>
                                        <div class="d-flex flex-column text-start">
                                            <span id="forMeTitle">For me</span>
                                            <small id="forMeDetails"
                                                style="display:none;font-size:18px;line-height:1.4;"></small>
                                        </div>
                                    </div>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="trip-datetime-card" id="tripDateTimeCard">
                                    <div class="trip-datetime-main-wrapper">
                                        <div class="trip-datetime-item">
                                            <div class="trip-datetime-icon">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                            <div class="trip-datetime-content">
                                                <div class="trip-datetime-title">Pickup Date & Time</div>
                                                <div class="trip-datetime-value">
                                                    <span id="tripSelectedDate">--</span>
                                                    <span> • </span>
                                                    <span id="tripSelectedTime">--</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="trip-datetime-item" id="tripRouteMetaContainer" style="display: none;">
                                            <div class="trip-datetime-icon">
                                                <i class="fas fa-route"></i>
                                            </div>
                                            <div class="trip-datetime-content">
                                                <div class="trip-datetime-title">Distance & Duration</div>
                                                <div class="trip-datetime-value">
                                                    <span id="leftTripDistance">--</span>
                                                    <span> • </span>
                                                    <span id="leftTripDuration">--</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Selected Car Summary -->
                            <!-- Selected Car Summary (visible after vehicle selection) -->
                            <div id="selectedCarSummary" class="selected-car-summary">
                                <div style="display: flex; justify-content: space-between; align-items: center; ">
                                    <h5 class="summary-title" style="margin-bottom: 0;"><span><i class="fas fa-car me-2"></i></span>Selected Vehicle</h5>
                                    <button class="edit-icon-btn" onclick="showStep(3)" title="Edit vehicle">
                                        <i class="fas fa-pencil"></i> Edit
                                    </button>
                                </div>
                                <div class="selected-car-row">
                                    <img id="summaryCarImage" src="" alt="Car" class="summary-car-image">
                                    <div class="summary-car-details">
                                        <h4 id="summaryCarName" class="summary-car-name"></h4>
                                        <div class="summary-car-info">
                                            <span>
                                                <i class="fas fa-user"></i>
                                                <span id="summaryCarCapacity"></span>
                                            </span>
                                            <span>
                                                <i class="fas fa-suitcase"></i>
                                                <span id="summaryCarLuggage"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div id="summaryCarPrice" class="summary-car-price"></div>
                                </div>
                            </div>
                            <!-- Entered Details Summary -->
                            <style>
                                @media (min-width: 992px) {
                                    #bookingSummaryListDesktop {
                                        display: none;
                                    }

                                    .combined-counts-desktop-container {
                                        display: flex;
                                        justify-content: space-between;
                                        border-bottom: 1px dashed #d9d9d9;
                                    }

                                    .combined-counts-desktop-container .booking-summary-item {
                                        border-bottom: none !important;
                                        flex: 1;
                                        justify-content: start;
                                        /* flex-direction: column; */
                                        align-items: center;
                                        padding: 10px 0;
                                        gap: 16px;
                                        align-items: center;
                                    }

                                    .combined-counts-desktop-container .count-label {
                                        display: none;
                                    }

                                    .combined-counts-desktop-container .summary-label {
                                        margin-bottom: 4px;
                                        font-size: 16px;
                                    }
                                }

                                @media (max-width: 991.98px) {
                                    .combined-counts-desktop-container {
                                        display: block;
                                    }
                                }
                            </style>
                            <script>
                                function toggleBookingDetailsDesktop() {
                                    if (window.innerWidth >= 992) {
                                        const list = document.getElementById('bookingSummaryListDesktop');
                                        const icon = document.getElementById('bookingDetailsIcon');
                                        if (list.style.display === 'none' || list.style.display === '') {
                                            list.style.display = 'block';
                                            icon.classList.remove('fa-chevron-down');
                                            icon.classList.add('fa-chevron-up');
                                        } else {
                                            list.style.display = 'none';
                                            icon.classList.remove('fa-chevron-up');
                                            icon.classList.add('fa-chevron-down');
                                        }
                                    }
                                }
                            </script>
                            <div id="enteredDetailsSummary" class="booking-summary dropdown-desktop">
                                <h5 class="summary-title"
                                    onclick="toggleBookingDetailsDesktop()" style="cursor:pointer;">
                                    <span class="d-flex justify-content-between align-items-center"><i class="fas fa-clipboard-list me-2"></i> Passenger Details</span>
                                    <i class="fas fa-chevron-down d-none d-lg-block" id="bookingDetailsIcon"></i>
                                </h5>

                                <div class="booking-summary-list" id="bookingSummaryListDesktop">

                                    <div class="booking-summary-item" id="summaryPassengerContainer">
                                        <span class="summary-label"><i class="fas fa-user"></i> </span>
                                        <span id="summaryPassengerName" class="summary-value">–</span>
                                    </div>

                                    <div class="booking-summary-item" id="summaryContactContainer">
                                        <span class="summary-label"><i class="fas fa-phone"></i> </span>
                                        <span id="summaryPassengerContact" class="summary-value">–</span>
                                    </div>

                                    <div class="booking-summary-item" id="summaryEmailContainer">
                                        <span class="summary-label"><i class="fas fa-envelope"></i> </span>
                                        <span id="summaryPassengerEmail" class="summary-value">–</span>
                                    </div>

                                    <div class="combined-counts-desktop-container">
                                        <div class="booking-summary-item" id="summaryPassengersCountContainer">
                                            <span class="summary-label"><i class="fas fa-users"></i> <span
                                                    class="count-label">Passengers</span></span>
                                            <span id="summaryPassengerCount" class="summary-value">1</span>
                                        </div>

                                        <div class="booking-summary-item" id="summaryLuggageCountContainer">
                                            <span class="summary-label"><i class="fas fa-suitcase"></i> <span
                                                    class="count-label">Luggage</span></span>
                                            <span id="summaryLuggageCount" class="summary-value">0</span>
                                        </div>

                                        <div class="booking-summary-item" id="summaryHandLuggageContainer">
                                            <span class="summary-label"><i class="fas fa-briefcase"></i> <span
                                                    class="count-label">Hand Luggage</span></span>
                                            <span id="summaryHandLuggageCount" class="summary-value">0</span>
                                        </div>
                                    </div>

                                    <div class="booking-summary-item" id="summaryBabySeatContainer"
                                        style="display:none;">
                                        <span class="summary-label"><i class="fas fa-child"></i> Baby Seats</span>
                                        <span id="summaryBabySeats" class="summary-value">None</span>
                                    </div>


                                    <div id="summaryFlightContainer" class="booking-summary-item" style="display:none;">
                                        <span class="summary-label" id="summaryFlightLabel">
                                            <i class="fas fa-plane"></i> Flight No.
                                        </span>
                                        <span id="summaryFlightNumber" class="summary-value">–</span>
                                    </div>

                                    <div id="summaryComingFromContainer" class="booking-summary-item"
                                        style="display:none;">
                                        <span class="summary-label" id="summaryComingFromLabel">
                                            <i class="fas fa-map-marker-alt"></i> Coming From
                                        </span>
                                        <span id="summaryComingFrom" class="summary-value">–</span>
                                    </div>

                                    <div id="summaryDropoffAddressContainer" class="booking-summary-item"
                                        style="display:none;">
                                        <span class="summary-label" id="summaryDropoffAddressLabel">
                                            <i class="fas fa-location-dot"></i> Destination
                                        </span>
                                        <span id="summaryDropoffAddress" class="summary-value">–</span>
                                    </div>

                                    <div id="summarySpecialReqContainer" class="booking-summary-item"
                                        style="display:none;">
                                        <span class="summary-label">
                                            <i class="fas fa-comment-dots"></i> Special Req.
                                        </span>
                                        <span id="summarySpecialRequirements" class="summary-value">–</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="btn-group-uber step-bottom-btns" id="step2Buttons">
                            <button class="btn-back-uber" onclick="goBackToLocations()">
                                <i class="fas fa-chevron-left"></i> Back
                            </button>
                            <button class="btn-search-uber" onclick="proceedToVehicles()">
                                <i class="fas fa-arrow-right"></i> Choose a ride
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- STEP 3: VEHICLE SELECTION -->
            <div class="form-section" id="step3">
                <div class="container">
                    <h3 class="booking-title">Choose a ride</h3>
                    <div class="vehicle-grid-uber" id="vehicleGrid"></div>
                    <div class="btn-group-uber step-bottom-btns">
                        <button class="btn-back-uber" onclick="goBackToLocations()">
                            <i class="fas fa-chevron-left"></i> Back
                        </button>
                        <button class="btn-search-uber" onclick="proceedToPassengerDetails()">
                            <i class="fas fa-arrow-right"></i> Continue
                        </button>
                    </div>
                </div>
            </div>
            <!-- STEP 4 : YOUR DETAILS -->
            <!-- <!€” STEP 4: YOUR DETAILS (sectioned, dynamic journey info) €”> -->
            <div class="form-section" id="step5">
                <div class="container">
                    <h3 class="booking-title">Payment Method</h3>
                    <div class="payment-summary" id="dynamicPaymentSummary" style="display:none;">
                        <div class="payment-item">
                            <span>Base Fare</span>
                            <span id="pbBaseFare">£0.00</span>
                        </div>
                        <div class="payment-item">
                            <span>Tax and Other charges</span>
                            <span id="pbTax">£0.00</span>
                        </div>
                        <div class="payment-total grand-total">
                            <span>Total</span>
                            <span id="pbTotalFare">£0.00</span>
                        </div>
                    </div>
                    <div class="form-group-uber">
                        <label><i class="fas fa-credit-card"></i> Payment Method *</label>
                        <select id="paymentMethod" required>
                            <option value="cash" selected>Pay Cash to the Driver</option>
                        </select>
                    </div>
                    <div class="btn-group-uber step-bottom-btns">
                        <button class="btn-back-uber" onclick="goBack(6)">
                            <i class="fas fa-chevron-left"></i> Back
                        </button>
                        <button class="btn-search-uber" onclick="proceedToConfirmation()">
                            <i class="fas fa-credit-card"></i> Make Payment
                        </button>
                    </div>
                </div>
            </div>
            <!-- STEP 4: BOOKING DETAILS -->
            <div class="form-section" id="step4">
                <div class="container p-0">
                    <h3 class="booking-title">Booking Details</h3>
                    <!-- =======================
     SECTION 1 : PERSONAL INFO
======================== -->
                    <div class="booking-form-section" id="personalInfoSection">
                        <div class="booking-section-title">
                            Personal Info
                        </div>
                        <div class="booking-form-grid">
                            <div class="form-group-uber booking-form-group">
                                <label>Full Name</label>
                                <input type="text" id="passengerFirstName" placeholder="Full name" maxlength="100">
                            </div>
                            <div class="form-group-uber booking-form-group">
                                <label>Contact Number</label>
                                <input type="tel" id="passengerPhone" class="phone-number-input"
                                    placeholder="Enter phone number">
                            </div>
                            <div class="form-group-uber booking-form-group">
                                <label>Email Address</label>
                                <input type="email" id="passengerEmail" placeholder="your@email.com" maxlength="100">
                            </div>
                        </div>
                        <!--<div class="booking-checkbox-wrapper">-->
                        <!--    <label class="booking-checkbox-label">-->
                        <!--        <input-->
                        <!--            type="checkbox"-->
                        <!--            id="leadPassengerCheck"-->
                        <!--            class="booking-checkbox">-->
                        <!--        <span>Lead Passenger?</span>-->
                        <!--    </label>-->
                        <!--</div>-->
                    </div>
                    <div id="additionalBookingDetails" style="display: none;">
                        <!-- =======================
     SECTION 2 : PASSENGERS & LUGGAGE
======================== -->
                        <div class="passenger-luggage-card">
                            <div class="passenger-card-title">
                                Passengers & Luggage
                            </div>
                            <!-- Counters -->
                            <div class="passenger-counter-grid">
                                <div class="passenger-counter-item">
                                    <label>Passengers</label>
                                    <div class="counter-widget">
                                        <button type="button" class="counter-btn"
                                            onclick="updateCounter('passengerCount', -1, 1, 8)">-</button>
                                        <span class="counter-val" id="passengerCountDisplay">1</span>
                                        <button type="button" class="counter-btn"
                                            onclick="updateCounter('passengerCount', 1, 1, 8)">+</button>
                                    </div>
                                    <input type="hidden" id="passengerCount" value="1">
                                </div>
                                <div class="passenger-counter-item">
                                    <label>Luggage</label>
                                    <div class="counter-widget">
                                        <button type="button" class="counter-btn"
                                            onclick="updateCounter('luggageCount', -1, 0, 8)">-</button>
                                        <span class="counter-val" id="luggageCountDisplay">0</span>
                                        <button type="button" class="counter-btn"
                                            onclick="updateCounter('luggageCount', 1, 0, 8)">+</button>
                                    </div>
                                    <input type="hidden" id="luggageCount" value="0">
                                </div>
                                <div class="passenger-counter-item">
                                    <label>Hand Luggage</label>
                                    <div class="counter-widget">
                                        <button type="button" class="counter-btn"
                                            onclick="updateCounter('handLuggageCount', -1, 0, 8)">-</button>
                                        <span class="counter-val" id="handLuggageCountDisplay">0</span>
                                        <button type="button" class="counter-btn"
                                            onclick="updateCounter('handLuggageCount', 1, 0, 8)">+</button>
                                    </div>
                                    <input type="hidden" id="handLuggageCount" value="0">
                                </div>
                            </div>
                            <!-- Car Seat -->
                            <div class="car-seat-toggle" id="carSeatToggleContainer">
                                <label class="car-seat-label">
                                    <input type="checkbox" id="carSeatCheckbox" class="booking-checkbox"
                                        onchange="toggleChildSeatOptions()">
                                    Baby Seat Required?
                                </label>
                            </div>
                            <!-- Child Seat Options -->
                            <div id="childSeatOptions" class="child-seat-wrapper">
                                <div class="child-seat-counter">
                                    <label>Number of Baby Seats</label>
                                    <div class="counter-widget">
                                        <button type="button" class="counter-btn"
                                            onclick="updateCarSeatCount(-1)">-</button>
                                        <span class="counter-val" id="childSeatCountDisplay">0</span>
                                        <button type="button" class="counter-btn"
                                            onclick="updateCarSeatCount(1)">+</button>
                                    </div>
                                    <input type="hidden" id="childSeatCount" value="0">
                                </div>
                                <div id="carSeatDropdownsContainer" class="child-seat-dropdowns">
                                </div>
                            </div>
                        </div>
                        <!--<div class="booking-section-title">-->
                        <!--    Journey Information-->
                        <!--</div>-->
                        <!-- Airport -->
                        <div id="journeyAirport" style="display:none;">
                            <div class="booking-form-grid">
                                <div class="form-group-uber booking-form-group">
                                    <label>
                                        <i class="fas fa-plane-departure"></i>
                                        Flight Number *
                                    </label>
                                    <input type="text" id="flightNumber" placeholder="Flight Number">
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label>
                                        <i class="fas fa-clock"></i>
                                        Pick Up Time After Landing?
                                    </label>
                                    <select id="pickupAfterLandingSelect">
                                        <option value="">Select</option>
                                        <option value="15">15 Min After</option>
                                        <option value="30">30 Min After</option>
                                        <option value="45" selected>45 Min After</option>
                                        <option value="60">60 Min After</option>
                                        <option value="75">75 Min After</option>
                                        <option value="90">90 Min After</option>
                                    </select>
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label>Coming From *</label>
                                    <input type="text" id="comingFrom" placeholder="Coming From">
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label>Drop off Address *</label>
                                    <input type="text" id="dropoffAddress" placeholder="Full address with postcode">
                                </div>
                            </div>
                        </div>
                        <!-- Seaport -->
                        <!-- Seaport -->
                        <div id="journeySeaport" style="display:none;">
                            <div class="booking-form-grid">
                                <div class="form-group-uber booking-form-group">
                                    <label><i class="fas fa-ship"></i> Cruise/Ferry Name *</label>
                                    <input type="text" id="ferryName" placeholder="Cruise or Ferry name">
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label><i class="fas fa-clock"></i> Docking Time?</label>
                                    <select id="dockingTimeSelect">
                                        <option value="">Select</option>
                                        <option>15 Min After</option>
                                        <option>30 Min After</option>
                                        <option selected>45 Min After</option>
                                        <option>60 Min After</option>
                                        <option>90 Min After</option>
                                    </select>
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label>Coming From *</label>
                                    <input type="text" id="comingFromPort" placeholder="Port/Terminal name">
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label>Drop off Address *</label>
                                    <input type="text" id="dropoffAddressSeaport"
                                        placeholder="Full address with postcode">
                                </div>
                            </div>
                        </div>
                        <!-- Normal -->
                        <!-- Normal -->
                        <div id="journeyNormal">
                            <div class="booking-form-grid">
                                <div class="form-group-uber booking-form-group">
                                    <label>Pickup Address</label>
                                    <input type="text" id="pickupAddressNormal" placeholder="Full pickup address with postcode">
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label>Dropoff Address</label>
                                    <input type="text" id="dropoffAddressNormal" placeholder="Full dropoff address with postcode">
                                </div>
                            </div>
                        </div>
                        <!-- =======================
     SECTION 5 : SPECIAL REQUIREMENTS
======================== -->
                        <div class="booking-form-section">
                            <div class="booking-section-title">
                                Special Requirements
                            </div>
                            <!-- CHECKBOX TO TOGGLE TEXTAREA -->
                            <div style="margin-bottom: 15px;">
                                <label class="booking-checkbox-label">
                                    <input type="checkbox" id="specialReqCheckbox"
                                        onchange="toggleSpecialRequirements()" class="booking-checkbox">
                                    Add Special Requirements?
                                </label>
                            </div>
                            <!-- TEXTAREA (HIDDEN BY DEFAULT) -->
                            <div class="form-group-uber booking-form-group">
                                <textarea id="specialRequirements" rows="3" placeholder="Enter any special requirements"
                                    style="display: none;"></textarea>
                            </div>
                        </div>
                    </div> <!-- End of additionalBookingDetails -->
                    <div class="btn-group-uber step-bottom-btns" id="personalInfoBtns">
                        <button class="btn-back-uber" onclick="goBack(3)">
                            <i class="fas fa-chevron-left"></i> Back
                        </button>
                        <button class="btn-search-uber" onclick="verifyPersonalInfoAndRequestOTP()">
                            <i class=""></i> Continue
                        </button>
                    </div>
                    <div class="btn-group-uber step-bottom-btns" id="additionalDetailsBtns" style="display: none;">
                        <button class="btn-back-uber" onclick="goBackToPersonalInfo()">
                            <i class="fas fa-chevron-left"></i> Back
                        </button>
                        <button class="btn-search-uber" onclick="verifyPassengerDetails()">
                            <i class="fas fa-search"></i> Find a Driver
                        </button>
                    </div>
                </div>
            </div>
            <!-- STEP 5: DRIVER & CONFIRMATION -->
            <div class="form-section" id="step6">
                <div class="container">
                    <h3 class="booking-title">Pick Your driver</h3>
                    <div id="findingDriversLoader" class="finding-drivers-loader" style="display:none;">
                        <div class="search-circle">
                            <i class="fas fa-magnifying-glass"></i>
                        </div>
                        <h4>Finding your driver...</h4>
                        <p>Searching nearby drivers</p>
                        <div class="loading-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div id="driverList" style="display:none;"></div>
                    <div class="btn-group-uber step-bottom-btns" style="margin-top: auto;">
                        <button class="btn-search-uber" style="width: 100%;" onclick="showCancelJobModal()">
                            <i class="fas fa-times"></i> Cancel Job
                        </button>
                    </div>


                </div>
            </div>
            <!-- STEP 7: REVIEW & CONFIRM (shown after clicking a driver) -->
            <div class="form-section" id="step7">
                <div class="container">
                    <!-- Header -->
                    <div class="rc-header">
                        <button class="rc-back-btn" onclick="showStep(6)">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <h3 class="rc-title">Review & Confirm</h3>
                    </div>

                    <!-- Vehicle Details Card -->
                    <div class="rc-vehicle-card">
                        <div class="rc-card-subtitle">VEHICLE DETAILS</div>
                        <div class="rc-vehicle-top">
                            <div class="rc-vehicle-img-wrapper" style="position: relative;">
                                <img id="rcCarImage" src="goride/img/fleet1.png" alt="Car"
                                    onclick="showCarDetailsModal(bookingData.selectedDriver)"
                                    style="cursor:pointer; width:100%;">
                            </div>
                            <div class="rc-vehicle-info-right">
                                <div class="d-flex justify-content-between gap-4">
                                    <h4 id="rcCarName">-</h4>
                                    <div class="rc-vehicle-tag" id="rcVehicleTag" style="display:none;"></div>
                                </div>
                                <div class="rc-vehicle-features">
                                    <span><i class="far fa-user"></i> <span id="rcPassengerCapacity">4</span></span>
                                    <span><i class="fas fa-suitcase-rolling"></i> <span id="rcLuggageCapacity">2</span></span>
                                    <span><i class="fas fa-cogs"></i> <span id="rcTransmission">Automatic</span></span>
                                </div>
                                <div class="rc-vehicle-amenities-grid" id="rcVehicleAmenitiesGrid">
                                    <!-- populated dynamically -->
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Driver Card -->
                    <div class="rc-new-driver-card">
                        <div class="rc-driver-top-flex">
                            <div class="rc-driver-avatar" id="rcDriverAvatar"></div>
                            <div class="rc-driver-info-main">
                                <div class="rc-driver-name-row">
                                    <h4 id="rcDriverName">-</h4>
                                    <div class="rc-driver-badge-top" id="rcDriverBadge" style="display:none;"></div>
                                </div>
                                <div class="rc-driver-rating-row" id="rcDriverStars"></div>
                            </div>
                            <div class="rc-driver-stats-grid">
                            <div class="rc-driver-stat-col">
                                <i class="fas fa-medal"></i>
                                <div>
                                    <strong id="rcDriverExperience">6+ Years</strong>
                                   
                                </div>
                            </div>
                            <!-- <div class="rc-driver-stat-col border-left-right">
                                <i class="far fa-user"></i>
                                <div>
                                    <strong id="rcDriverTrips">2,145</strong>
                                   
                                </div>
                            </div>
                            <div class="rc-driver-stat-col">
                                <i class="far fa-comment-dots"></i>
                                <div>
                                    <strong id="rcDriverReviewsPct">98%</strong>
                                   
                                </div>
                            </div> -->
                        </div>
                        </div>
                        
                    </div>


                    <!-- Bidded Amount Card -->
                    <div class="rc-bid-card">
                        <div class="rc-bid-top">
                            <div class="rc-card-subtitle">BIDDED AMOUNT</div>
                            <div class="rc-bid-badge"><i class="fas fa-check-circle"></i> Includes all fees</div>
                        </div>
                        <div class="rc-bid-bottom">
                            <div class="rc-bid-amount">
                                <strong id="rcFareAmount">£0</strong>
                                <span class="rc-bid-total-tag">Total</span>
                            </div>
                            <div class="rc-bid-note">No hidden charges</div>
                        </div>
                    </div>
                    <!-- Accept Button -->
                    <div class="btn-group-uber step-bottom-btns rc-accept-wrap">
                        <button class="btn-search-uber" onclick="acceptDriver(this)" style="flex:1;">
                            <i class="fas fa-check me-2"></i> Accept
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-section" id="step8">
                <div class="container">
                    <div class="confirm-modal-content" style="padding: 20px 0;">
                        <div class="confirm-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h2 class="confirm-title" style="text-align: center; margin-top: 15px; margin-bottom: 20px;">
                            Booking Confirmed!</h2>
                        <div class="confirm-booking-id"
                            style="background: #f8f9fa; padding: 15px; border-radius: 8px; text-align: center; margin-bottom: 20px;">
                            <small
                                style="color: #666; font-size: 12px; font-weight: 600; text-transform: uppercase;">Booking
                                ID</small>
                            <div class="id-value" id="confirmNum"
                                style="font-size: 20px; font-weight: 700; color: #000; margin-top: 5px;">GR-2026-14851
                            </div>
                        </div>
                        <div class="confirm-details-grid"
                            style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 25px;">
                            <div class="confirm-detail-item">
                                <small
                                    style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-location-dot"></i> PICKUP</small>
                                <div class="detail-value" id="confirmPickup"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                            <div class="confirm-detail-item">
                                <small
                                    style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-location-dot"></i> DESTINATION</small>
                                <div class="detail-value" id="confirmDropoff"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                            <div class="confirm-detail-item">
                                <small
                                    style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-calendar"></i> DATE & TIME</small>
                                <div class="detail-value" id="confirmDateTime"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                            <div class="confirm-detail-item">
                                <small
                                    style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-car"></i> VEHICLE</small>
                                <div class="detail-value" id="confirmVehicle"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                            <div class="confirm-detail-item">
                                <small
                                    style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-road"></i> DISTANCE</small>
                                <div class="detail-value" id="confirmDistance"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                            <div class="confirm-detail-item">
                                <small
                                    style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-hourglass"></i> DURATION</small>
                                <div class="detail-value" id="confirmDuration"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                        </div>
                        <p class="confirm-info-text"
                            style="text-align: center; color: #666; font-size: 14px; line-height: 1.5; margin-bottom: 25px;">
                            Your booking has been successfully confirmed. A driver will be assigned soon.
                        </p>
                    </div>
                    <div class="btn-group-uber step-bottom-btns">
                        <button class="btn-modal-primary" onclick="completeBooking()"
                            style="width: 100%; background: #000; color: #fff; border: none; padding: 12px; border-radius: 8px; font-weight: 600;">
                            <i class="fas fa-check"></i> Done
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-map-section  col-md-7 col-12">
            <!-- First Screen Image -->
            <div id="bookingImage">
                <div class="hero-banner-content">
                    <span class="hero-badge">GoRide</span>
                    <h1>Ride Anywhere & Anytime With GoRide</h1>
                    <p>Airport transfers, city rides, executive travel and long-distance journeys with professional
                        drivers at fixed prices.</p>
                </div>
                <img src="https://goride-media.s3.ap-south-1.amazonaws.com/cus_app/images/day_6a561ea0b63e7.webp"
                    alt="Airport Transfer" class="hero-side-img">
            </div>
            <div id="bookingMap" style="display: none; width: 100%; height: 100%; "></div>
            <div id="mapRouteBadge" class="map-route-badge" style="display: none;">
                <div class="map-route-badge-content">
                    <div class="map-route-pill">
                        <i class="fas fa-road me-1" style="color: #000;"></i>
                        <span id="mapRouteDistance">--</span>
                    </div>
                    <span class="map-route-divider">•</span>
                    <div class="map-route-pill">
                        <i class="fas fa-clock me-1" style="color: #000;"></i>
                        <span id="mapRouteDuration">--</span>
                    </div>
                </div>
            </div>
            <style>
                .map-marker-label {
                    background-color: #ffffff;
                    color: #111111;
                    font-size: 13px !important;
                    font-weight: 700;
                    padding: 5px 12px;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
                    border: 1px solid #eaeaea;
                    white-space: nowrap;
                    font-family: inherit;
                }
            </style>
            <script
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtkJtXBZPLBZIgjgpu-eAG5WQ1HwW4EwE&libraries=geometry"></script>

            <script>
                let bookingGoogleMap = null;
                let routeBounds     = null;
                let currentRoutePolyline = null;

                function formatTripDistance(dist) {
                    if (!dist && dist !== 0) return '';
                    const str = String(dist).trim();
                    if (!str) return '';
                    if (str.toLowerCase().includes('mile') || str.toLowerCase().includes('mi')) {
                        return str;
                    }
                    return str + ' Miles';
                }

                function formatTripDuration(dur) {
                    if (!dur) return '';
                    return String(dur).trim();
                }

                function updateDistanceDurationUI(dist, dur) {
                    const formattedDist = formatTripDistance(dist);
                    const formattedDur  = formatTripDuration(dur);

                    if (formattedDist || formattedDur) {
                        const dText = formattedDist || '--';
                        const tText = formattedDur || '--';

                        // Left side Trip Details card
                        $('#leftTripDistance').text(dText);
                        $('#leftTripDuration').text(tText);
                        $('#tripRouteMetaContainer').attr('style', 'display: flex !important;');

                        // Map overlay badge
                        $('#mapRouteDistance').text(dText);
                        $('#mapRouteDuration').text(tText);
                        if ($('#bookingMap').is(':visible')) {
                            $('#mapRouteBadge').show();
                        } else {
                            $('#mapRouteBadge').hide();
                        }
                    } else {
                        $('#tripRouteMetaContainer').attr('style', 'display: none !important;');
                        $('#mapRouteBadge').hide();
                    }
                }

                function initRouteMapFromFare() {
                    const mapContainer = document.getElementById('bookingMap');
                    if (!mapContainer) return;
                    mapContainer.style.display = 'block';

                    if (bookingData.apiDistance || bookingData.apiDuration) {
                        updateDistanceDurationUI(bookingData.apiDistance, bookingData.apiDuration);
                    }

                    const polylineStr = bookingData.apiPolyline || null;

                    // If map already exists, just re-draw the polyline
                    if (bookingGoogleMap !== null) {
                        google.maps.event.trigger(bookingGoogleMap, 'resize');
                        if (polylineStr) _drawPolyline(polylineStr);
                        else if (routeBounds) bookingGoogleMap.fitBounds(routeBounds);
                        return;
                    }

                    // Initialise map centred on London as default
                    bookingGoogleMap = new google.maps.Map(mapContainer, {
                        center: { lat: 51.5074, lng: -0.1278 },
                        zoom: 11,
                        mapTypeControl: false,
                        fullscreenControl: false,
                        streetViewControl: false
                    });

                    if (polylineStr) {
                        _drawPolyline(polylineStr);
                    }
                }

                let _lastEncodedPolyline = null;
                function _drawPolyline(encodedPolyline) {
                    if (!bookingGoogleMap || !encodedPolyline) return;
                    
                    if (_lastEncodedPolyline === encodedPolyline && currentRoutePolyline) {
                        return; // already drawn and map has it, don't re-draw
                    }
                    _lastEncodedPolyline = encodedPolyline;

                    // Remove previous polyline if any
                    if (currentRoutePolyline) {
                        currentRoutePolyline.setMap(null);
                        currentRoutePolyline = null;
                    }

                    // Cancel any previous animation
                    if (window.routeAnimationId) {
                        cancelAnimationFrame(window.routeAnimationId);
                        window.routeAnimationId = null;
                    }

                    // Decode the Google-encoded polyline
                    const decodedPath = google.maps.geometry.encoding.decodePath(encodedPolyline);

                    currentRoutePolyline = new google.maps.Polyline({
                        path: [], // Start with an empty path
                        strokeColor:   '#111111',
                        strokeOpacity: 1.0,
                        strokeWeight:  4
                    });
                    currentRoutePolyline.setMap(bookingGoogleMap);

                    // Fit map to the route first so we can watch it draw
                    routeBounds = new google.maps.LatLngBounds();
                    decodedPath.forEach(function(pt) { routeBounds.extend(pt); });
                    bookingGoogleMap.fitBounds(routeBounds);

                    // Animate drawing the line
                    let step = 0;
                    const totalPoints = decodedPath.length;
                    // Target ~1.5s animation at 60fps (90 frames total)
                    const pointsPerFrame = Math.max(1, Math.ceil(totalPoints / 90)); 
                    const polylinePath = currentRoutePolyline.getPath();

                    function animateLine() {
                        for (let i = 0; i < pointsPerFrame; i++) {
                            if (step >= totalPoints) break;
                            polylinePath.push(decodedPath[step]);
                            step++;
                        }
                        if (step < totalPoints) {
                            window.routeAnimationId = requestAnimationFrame(animateLine);
                        } else {
                            window.routeAnimationId = null;
                        }
                    }
                    window.routeAnimationId = requestAnimationFrame(animateLine);

                    // Place pickup and drop-off markers
                    const fareFirst = bookingData.fareDataObj
                        ? Object.values(bookingData.fareDataObj)[0]
                        : null;

                    if (fareFirst) {
                        const fromLat = parseFloat(fareFirst.from_lat);
                        const fromLng = parseFloat(fareFirst.from_lng);
                        const toLat   = parseFloat(fareFirst.to_lat);
                        const toLng   = parseFloat(fareFirst.to_lng);

                        const svgPickup = encodeURIComponent('<svg width="24" height="32" viewBox="0 0 384 512" fill="#f9c106" xmlns="http://www.w3.org/2000/svg"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>');
                        const svgDropoff = encodeURIComponent('<svg width="24" height="32" viewBox="0 0 384 512" fill="#000000" xmlns="http://www.w3.org/2000/svg"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>');

                        const getShortAddress = (addr) => {
                            if (!addr) return '';
                            const parts = addr.split(',');
                            return parts[0].trim();
                        };

                        const pickupName = getShortAddress(bookingData.pickup) || 'Pickup';
                        const dropoffName = getShortAddress(bookingData.dropoff) || 'Drop-off';

                        if (!isNaN(fromLat) && !isNaN(fromLng)) {
                            new google.maps.Marker({
                                position : { lat: fromLat, lng: fromLng },
                                map      : bookingGoogleMap,
                                title    : 'Pickup',
                                label    : {
                                    text: pickupName,
                                    className: 'map-marker-label',
                                },
                                icon     : {
                                    url: 'data:image/svg+xml;charset=UTF-8,' + svgPickup,
                                    scaledSize: new google.maps.Size(24, 32),
                                    anchor: new google.maps.Point(12, 32),
                                    labelOrigin: new google.maps.Point(12, -12)
                                }
                            });
                        }
                        if (!isNaN(toLat) && !isNaN(toLng)) {
                            new google.maps.Marker({
                                position : { lat: toLat, lng: toLng },
                                map      : bookingGoogleMap,
                                title    : 'Drop-off',
                                label    : {
                                    text: dropoffName,
                                    className: 'map-marker-label',
                                },
                                icon     : {
                                    url: 'data:image/svg+xml;charset=UTF-8,' + svgDropoff,
                                    scaledSize: new google.maps.Size(24, 32),
                                    anchor: new google.maps.Point(12, 32),
                                    labelOrigin: new google.maps.Point(12, -12)
                                }
                            });
                        }
                    }
                }

                // Keep backward-compat alias used in showStep()
                function initSingleRouteMap() {
                    initRouteMapFromFare();
                }
            </script>
            <!-- Mobile Map Close Button (rendered outside the map div so it stays above) -->
            <button id="mapCloseBtn" onclick="closeMobileMap()" title="Close Map">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- <section class="fleet-section pt-5">
        <div class="container">
            <div class="section-head text-center mb-4">
                <h2 class="section-title">Available Fleets</h2>
                <p>Choose the perfect ride for your journey</p>
            </div>
            <div class="owl-carousel fleet-carousel">
                <div class="fleet-card">
                    <img src="/goride/img/saloon.png" alt="Saloon">
                    <h5>Saloon</h5>
                    <span>Up to 4 Passengers</span>
                </div>
                <div class="fleet-card">
                    <img src="/goride/img/executive.png" alt="Executive">
                    <h5>Executive</h5>
                    <span>Luxury Business Ride</span>
                </div>
                <div class="fleet-card">
                    <img src="/goride/img/executive mv5.png" alt="Executive MPV">
                    <h5>Executive MPV</h5>
                    <span>Up to 6 Passengers</span>
                </div>
                <div class="fleet-card">
                    <img src="/goride/img/estate.png" alt="Estate">
                    <h5>Estate</h5>
                    <span>Extra Luggage Space</span>
                </div>
                <div class="fleet-card">
                    <img src="/goride/img/8seater.png" alt="8 Seater">
                    <h5>8 Seater</h5>
                    <span>Up to 8 Passengers</span>
                </div>
                <div class="fleet-card">
                    <img src="/goride/img/mpv.png" alt="MPV">
                    <h5>MPV</h5>
                    <span>Family Friendly</span>
                </div>
            </div>
        </div>
    </section> -->
    <section class="reviews-section section-padding mt-5" id="reviews">
        <div class="container">
            <h2 class="section-title">What Customers Say</h2>
            <div class="review-grid">
                <div class="review-card">
                    <div class="review-rating"></div>
                    <div class="review-text">
                        "Fantastic airport transfer. The driver arrived early, helped with our luggage, and the journey
                        was comfortable. Highly recommended!"
                    </div>
                    <div class="review-author">
                        <div class="review-avatar">JW</div>
                        <div>
                            <div class="review-name">James Wilson</div>
                            <div class="review-title">London</div>
                        </div>
                    </div>
                </div>
                <div class="review-card">
                    <div class="review-rating"></div>
                    <div class="review-text">
                        "Excellent service with fixed pricing and no hidden charges. Booking was quick and the driver
                        was very friendly."
                    </div>
                    <div class="review-author">
                        <div class="review-avatar">EH</div>
                        <div>
                            <div class="review-name">Emma Harris</div>
                            <div class="review-title">Manchester</div>
                        </div>
                    </div>
                </div>
                <div class="review-card">
                    <div class="review-rating"></div>
                    <div class="review-text">
                        "Our family booked a ride to Heathrow Airport and everything went perfectly. Clean vehicle and
                        professional driver."
                    </div>
                    <div class="review-author">
                        <div class="review-avatar">DT</div>
                        <div>
                            <div class="review-name">Daniel Thompson</div>
                            <div class="review-title">Birmingham</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Owl Carousel for Mobile - FIXED -->
            <div class="owl-carousel review-carousel owl-theme">
                <div class="review-card">
                    <div class="review-rating"></div>
                    <div class="review-text">
                        "Fantastic airport transfer. The driver arrived early, helped with our luggage, and the journey
                        was comfortable. Highly recommended!"
                    </div>
                    <div class="review-author">
                        <div class="review-avatar">JW</div>
                        <div>
                            <div class="review-name">James Wilson</div>
                            <div class="review-title">London</div>
                        </div>
                    </div>
                </div>
                <div class="review-card">
                    <div class="review-rating"></div>
                    <div class="review-text">
                        "Excellent service with fixed pricing and no hidden charges. Booking was quick and the driver
                        was very friendly."
                    </div>
                    <div class="review-author">
                        <div class="review-avatar">EH</div>
                        <div>
                            <div class="review-name">Emma Harris</div>
                            <div class="review-title">Manchester</div>
                        </div>
                    </div>
                </div>
                <div class="review-card">
                    <div class="review-rating"></div>
                    <div class="review-text">
                        "Our family booked a ride to Heathrow Airport and everything went perfectly. Clean vehicle and
                        professional driver."
                    </div>
                    <div class="review-author">
                        <div class="review-avatar">DT</div>
                        <div>
                            <div class="review-name">Daniel Thompson</div>
                            <div class="review-title">Birmingham</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="operator-register-section">
        <div class="container">
            <div class="operator-register-content">
                <div class="operator-register-text">
                    <h2>Build Your Business & Earn More with <span>GoRide</span> Operator Portal</h2>
                    <p>Manage fleet, drivers, bookings, and earnings from one dashboard</p>
                </div>
                <!--<a href="{{ env('WEBSITE_APP_URL') }}/operator-signup" class="operator-register-btn">-->
                <a href="https://ops.goride.run/" class="operator-register-btn">
                    <i class="fas fa-arrow-right"></i>
                    Become an Operator
                </a>
            </div>
        </div>
    </section>
    <section class="faq-section section-padding" id="faq">
        <div class="container" style="max-width: 700px;">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    How do I book a ride?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">Enter your pickup and dropoff locations, select your preferred time, choose a
                    vehicle type, and confirm your booking. It's that simple!</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    What payment methods do you accept?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">We accept credit/debit cards, UPI, digital wallets, and cash payments. Choose
                    the method that's most convenient for you.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Are the prices fixed?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">Yes! We offer transparent, fixed pricing. The fare you see at booking is the
                    fare you'll pay. No surge pricing.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    How do I contact customer support?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">Our support team is available 24/7. You can reach us through the app, website,
                    or call us directly. We're always here to help!</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Are your drivers verified?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">Absolutely! All our drivers undergo thorough background checks and vehicle
                    inspections for your safety and peace of mind.</div>
            </div>
        </div>
    </section>

    <!-- Premium Cancel Job Modal (Global Overlay) -->
    <div id="cancelJobModal" class="modal" tabindex="-1" role="dialog" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); z-index: 99999; align-items: center; justify-content: center;">
        <div class="modal-dialog" role="document" style="background: white; border-radius: 20px; padding: 30px; max-width: 380px; width: 90%; box-shadow: 0 10px 40px rgba(0,0,0,0.2); text-align: center;">
            <div class="modal-content" style="border: none;">
                <div style="width: 60px; height: 60px; background: #fff0f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <i class="fas fa-exclamation-triangle" style="color: #dc3545; font-size: 24px;"></i>
                </div>
                <h4 style="margin: 0 0 10px; font-weight: 700; color: #333; font-size: 22px;">Cancel Job?</h4>
                <p style="color: #666; font-size: 15px; line-height: 1.5; margin-bottom: 15px;">
                    Are you sure you want to cancel this booking? This action cannot be undone.
                </p>
                <textarea id="cancelJobReason" rows="3" placeholder="Reason for cancellation (optional)" style="width: 100%; box-sizing: border-box; border: 1px solid #ddd; border-radius: 10px; padding: 12px; margin-bottom: 25px; font-family: inherit; font-size: 14px; resize: none; background: #fafafa;"></textarea>
                <div style="display: flex; gap: 12px; justify-content: center;">
                    <button type="button" onclick="confirmCancelJob(this)" style="flex: 1; padding: 12px 0; border-radius: 10px; border: none; background: #dc3545; color: white; font-weight: 600; font-size: 15px; cursor: pointer; box-shadow: 0 2px 8px rgba(220,53,69,0.3);">
                        Yes, Cancel
                    </button>
                    <button type="button" onclick="hideCancelJobModal()" style="flex: 1; padding: 12px 0; border-radius: 10px; border: 1px solid #ddd; background: #fff; color: #333; font-weight: 600; font-size: 15px; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                        Keep It
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function showCancelJobModal() {
            document.getElementById('cancelJobReason').value = '';
            document.getElementById('cancelJobModal').style.display = 'flex';
        }
        function hideCancelJobModal() {
            document.getElementById('cancelJobModal').style.display = 'none';
        }
        function confirmCancelJob(btn) {
            const reason = document.getElementById('cancelJobReason').value.trim();
            
            if (typeof bookingData === 'undefined' || !bookingData.jobId || !bookingData.bookingId) {
                alert('Job details are missing. Cannot cancel.');
                return;
            }

            const payload = {
                job_id: bookingData.jobId,
                job_no: bookingData.bookingId,
                reason: reason
            };

            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Cancelling...';
            btn.disabled = true;

            fetch('{{env("API_URL")}}'+ '/cancel-job', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + getCookieValue('auth_token')
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                btn.innerHTML = originalText;
                btn.disabled = false;
                
                if (data.status) {
                    hideCancelJobModal();
                    showToast(data.message || 'Job cancelled successfully.', 'success');
                    
                    if (typeof BookingStore !== 'undefined' && BookingStore.clear) {
                        BookingStore.clear();
                    }
                    
                    setTimeout(() => {
                        window.location.href = '/'; 
                    }, 1500);
                } else {
                    showToast(data.message || 'Failed to cancel job.', 'error');
                }
            })
            .catch(err => {
                btn.innerHTML = originalText;
                btn.disabled = false;
                showToast('An error occurred while cancelling the job.', 'error');
            });
        }
    </script>
@endsection
