@extends('layouts.app')
@section('content')
    <style>
        .rider-select-card {
            margin-top: 10px;
            padding: 0;
            border: none;
            background: transparent;
        }

        .rider-select-strip {
            width: 100%;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 15px;
            font-weight: 600;
            color: #111827;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        .rider-select-strip:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
        }

        .passenger-booked-wrapper {
            /* display: flex; */
            align-items: center;
            gap: 5px;
            flex-wrap: wrap;
        }

        .passenger-details-label {
            font-size: 13px;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            color: #555;
        }

        /* .passenger-booked-for-container {
                margin-top: 6px;
                padding-top: 6px;
                border-top: 1px dashed #e2e8f0;
            } */

        .passenger-booked-for-name {
            font-size: 16px;
            font-weight: 600;
        }

        .passenger-booked-for-phone {
            font-size: 14px;
        }

        .mobile-map-bar-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .mobile-rider-select-btn {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 20px;
            padding: 5px 12px;
            font-size: 12px;
            font-weight: 600;
            color: #0f172a;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.2s ease;
        }

        .mobile-rider-select-btn:hover {
            background-color: #f8fafc;
            border-color: #94a3b8;
        }

        .mobile-header-rider-btn {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 13px;
            font-weight: 600;
            color: #0f172a;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-right: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .mobile-header-rider-btn:hover {
            background-color: #f8fafc;
            border-color: #94a3b8;
        }

        @media (max-width: 768px) {
            .rider-select-strip {
                padding: 9px 12px;
                font-size: 14px;
            }

            /* Custom Premium Mobile driver card styling */
            .driver-item.driver-card {
                position: relative !important;
                padding: 16px !important;
                border-radius: 16px !important;
                background: #ffffff !important;
                border: 1px solid #e2e8f0 !important;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.025) !important;
            }

            .driver-item.driver-card .driver-info {
                display: flex !important;
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 12px !important;
                width: 100% !important;
            }

            .driver-item.driver-card .driver-details {
                width: 100% !important;
                flex: unset !important;
            }

            .driver-item.driver-card .driver-header {
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                gap: 12px !important;
                width: 100% !important;
           
                margin-bottom: 0px !important;
            }

            .driver-item.driver-card .driver-car-banner {
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                text-align: center !important;
                flex-shrink: 0 !important;
                margin-bottom: 0 !important;
                 /* flex: 1 !important; */
            }

            .driver-item.driver-card .driver-car-banner img {
                width: 110px !important;
                height: auto !important;
                max-height: 55px !important;
                object-fit: cover !important;
                margin-bottom: 7px;
         
            }

            .driver-item.driver-card .driver-car-banner-details {
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                gap: 2px !important;
            }

            .driver-item.driver-card .driver-wrap {
                display: flex !important;
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 6px !important;
                min-width: 0 !important;
                width: 100% !important;
            }

            .driver-item.driver-card .driver-avatar-info-row {
                display: flex !important;
                align-items: center !important;
                gap: 10px !important;
                width: 100% !important;
            }

            .driver-item.driver-card .driver-avatar {
                width: 55px !important;
                height: 55px !important;
                border-radius: 50% !important;
                border: 2px solid #f5c00b !important;
                overflow: hidden !important;
                flex-shrink: 0 !important;
            }

            .driver-item.driver-card .driver-meta-info {
                display: flex !important;
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 1px !important;
                min-width: 0 !important;
            }

            .driver-item.driver-card .driver-meta-info h4 {
                font-size: 15px !important;
                font-weight: 600 !important;
                color: #0f172a !important;
                margin: 0 !important;
                white-space: nowrap !important;
                overflow: hidden !important;
                text-overflow: ellipsis !important;
            }

            .driver-item.driver-card .driver-static-label {
                font-size: 12px !important;
                color: #64748b !important;
                font-weight: 400 !important;
            }

            .driver-item.driver-card .driver-review-link-wrapper {
                width: 100% !important;
                margin-top: 2px !important;
            }

            .driver-item.driver-card .driver-review-link {
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                width: 100% !important;
                box-sizing: border-box !important;
                font-size: 11px !important;
                font-weight: 500 !important;
                color: #0f172a !important;
                background: #ffffff !important;
                border: 1px solid #cbd5e1 !important;
                border-radius: 6px !important;
                padding: 4px 8px !important;
                text-decoration: none !important;
                text-align: center !important;
                transition: all 0.2s ease !important;
            }

            .driver-item.driver-card .driver-review-link:hover {
                background-color: #0f172a !important;
                color: #ffffff !important;
            }

            .driver-item.driver-card .driver-bid-box {
               display: flex !important;
        flex-direction: row !important;
        justify-content: end !important;
        align-items: center !important;
        width: 100% !important;
        margin-top: 0 !important;
        gap: 26px !important;
            }

            .driver-item.driver-card .driver-price-row {
                margin: 0 !important;
                display: flex !important;
                align-items: center !important;
            }

            .driver-item.driver-card .bid-amount {
                font-size: 20px !important;
                font-weight: 700 !important;
                color: #0f172a !important;
            }

            .driver-item.driver-card .driver-accept-btn {
               margin-top:0px !important;
            }

            .driver-item.driver-card .driver-accept-btn:hover {
                background-color: #1e293b !important;
            }
        }

        .driver-item.driver-card {
            position: relative !important;
        }

      

        .tax-ribbon-fold {
            position: relative !important;
            top: 1px !important;
            width: 0 !important;
            height: 0 !important;
            right: -1px !important;
            border-bottom: 5px solid #064e3b !important;
            border-left: 5px solid transparent !important;
        }

        .tax-ribbon-fold.not-included {
            border-bottom-color: #7f1d1d !important;
        }

        .tax-ribbon-body {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            color: #ffffff !important;
            font-size: 8px !important;
            font-weight: 800 !important;
            padding: 5px 8px 7px 8px !important;
            text-transform: uppercase !important;
            text-align: center !important;
            letter-spacing: 0.5px !important;
            line-height: 1.2 !important;
            -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 50% calc(100% - 4px), 0 100%) !important;
            clip-path: polygon(0 0, 100% 0, 100% 100%, 50% calc(100% - 4px), 0 100%) !important;
            border-radius: 3px 3px 0 0 !important;
        }

        .tax-ribbon-body.not-included {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
        }

        /* Driver App / Mobile App Promo Section */
        .driver-app-section {
            padding: 0px 0 20px 0;
        }

        .driver-app-card {
            background: #f7f8fa;
            border-radius: 24px;
            padding: 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            position: relative;
            overflow: hidden;
            border: 1px solid #eef0f4;
        }

        .driver-app-content {
            flex: 1 1 55%;
            max-width: 620px;
            z-index: 2;
        }

        .driver-app-badge {
            display: inline-block;
               background: black;
    color: white;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.5px;
            padding: 5px 12px;
            border-radius: 6px;
            margin-bottom: 16px;
            text-transform: uppercase;
        }

        .driver-app-title {
           font-size: 32px;
    font-weight: 700;
    color: #000;
    margin: 0;
    line-height: 1.3;
        }

        .driver-app-subtitle {
     
            line-height: 1.5;

            margin-bottom: 32px;
        }

        .driver-app-features {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px 24px;
            margin-bottom: 36px;
        }

        .driver-app-feature-item {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .driver-app-feature-icon {
               width: 36px;
    height: 36px;
    /* min-width: 44px; */
    border-radius: 50%;
    background: black;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
        }

        .driver-app-feature-text h3 {
            font-size: 16px;
            font-weight: 500;
            margin: 0 0 2px 0;
            line-height: 1.2;
        }

        .driver-app-feature-text p {
            font-size: 14px;
            margin: 0;
            line-height: 1.3;
        }

        .driver-app-store-btns {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .store-btn {
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

        .store-btn:hover {
            color: #ffffff;
            transform: translateY(-2px);
            text-decoration: none;
        }

        .store-btn i {
            font-size: 26px;
        }

        .store-btn-text {
            display: flex;
            flex-direction: column;
        }

        .store-btn-sub {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            line-height: 1;
            margin-bottom: 2px;
        }

        .store-btn-title {
            font-size: 15px;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.1;
        }

        .driver-app-media {
            flex: 1 1 45%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
        }

        .driver-app-circle-bg {
            position: absolute;
            width: 320px;
            height: 320px;
            background: #fde047;
            border-radius: 50%;
            z-index: 1;
            opacity: 0.85;
        }

        .driver-app-img {
            position: relative;
            z-index: 2;
            max-width: 100%;
            height: auto;
            max-height: 380px;
            object-fit: contain;
        }

        @media (max-width: 991px) {
            .driver-app-card {
                flex-direction: column;
                padding: 32px 24px;
                gap: 32px;
            }

            .driver-app-content {
                max-width: 100%;
            }

            .driver-app-title {
                font-size: 26px;
            }

            .driver-app-circle-bg {
                width: 260px;
                height: 260px;
            }

            .driver-app-img {
                max-height: 300px;
            }
        }

        @media (max-width: 576px) {
            .driver-app-card {
                padding: 24px 16px;
                border-radius: 16px;
            }

            .driver-app-title {
                font-size: 22px;
            }

            .driver-app-subtitle {
                font-size: 14px;
                margin-bottom: 24px;
            }

            .driver-app-features {
                grid-template-columns: 1fr;
                gap: 16px;
                margin-bottom: 28px;
            }

            .driver-app-store-btns {
                flex-wrap:nowrap;
            }

            .store-btn {
                justify-content: center;
                padding: 10px 10px;
            }

            .driver-app-circle-bg {
                width: 220px;
                height: 220px;
            }

            .driver-app-img {
                max-height: 250px;
            }
        }
    </style>
    <div id="mobileActionBar">
        <a href="tel:+447950323242" class="mob-action-btn">
            <div class="mob-action-icon">
                <i class="fas fa-phone"></i>
            </div>
            <span>Call Us</span>
        </a>
        <a href="https://wa.me/447950323242" target="_blank" class="mob-action-btn">
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
                <div class="mobile-map-bar-actions">
                    <button type="button" class="mobile-rider-select-btn" onclick="showForMeModal()">
                        <i class="fas fa-user"></i>
                        <span id="mobileRiderTitle">For me</span>
                        <i class="fas fa-chevron-down" style="font-size: 10px;"></i>
                    </button>
                    <button type="button" class="mobile-view-map-btn" onclick="toggleMobileMap()">
                        <i class="fas fa-map"></i> View Map
                    </button>
                </div>
            </div>
            <!-- Mobile Summary Backdrop -->
            <div id="mobileSummaryBackdrop" class="mobile-summary-backdrop" onclick="toggleTripSummary()"></div>
            <!-- COMPACT MOBILE SUMMARY -->
            <div id="mobileCompactSummary" class="mobile-trip-summary">
                <div class="mobile-trip-header" onclick="toggleTripSummary()">
                    <div class="location-group-wrapper">
                        <div class="location-fields">
                            <div class="mobile-from">
                                <i class="fas fa-location-dot route-dot-start"></i>
                                <span id="mcsPickup" class="text-truncate"></span>
                            </div>
                            <div class="mobile-to">
                                <i class="fas fa-location-dot route-dot-end"></i>
                                <span id="mcsDropoff" class="text-truncate"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-trip-header-actions">
                        <button type="button" class="edit-icon-btn" onclick="event.stopPropagation(); goBackToLocations()" title="Edit trip">
                            <i class="fas fa-pencil"></i>
                        </button>
                        <i class="fas fa-chevron-down" id="tripSummaryArrow"></i>
                    </div>
                </div>
                <div class="mobile-trip-body" id="mobileTripBody">
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="trip-stat-box">
                                <div class="stat-icon-circle yellow-icon">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <div class="stat-info-group">
                                    <span class="stat-header-label" id="mcsStatDateLabel">DATE</span>
                                    <div class="stat-main-value" id="mcsDateValue">--</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="trip-stat-box">
                                <div class="stat-icon-circle yellow-icon">
                                    <i class="far fa-clock"></i>
                                </div>
                                <div class="stat-info-group">
                                    <span class="stat-header-label" id="mcsStatTimeLabel">TIME</span>
                                    <div class="stat-main-value" id="mcsTimeValue">--</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="trip-stat-box">
                                <div class="stat-icon-circle navy-icon">
                                    <i class="fas fa-route"></i>
                                </div>
                                <div class="stat-info-group">
                                    <span class="stat-header-label">DISTANCE</span>
                                    <div class="stat-main-value" id="mcsDistanceValue">--</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="trip-stat-box">
                                <div class="stat-icon-circle  navy-icon">
                                    <i class="fas fa-hourglass-half"></i>
                                </div>
                                <div class="stat-info-group">
                                    <span class="stat-header-label">DURATION</span>
                                    <div class="stat-main-value" id="mcsDurationValue">--</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="mcsCarDetails" style="display:none;">
                        <div class="selected-car-row">
                            <div class="summary-car-details">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <h4 class="mcs-car-name-header mb-0">
                                        <i class="fas fa-car"></i>
                                        <span id="mcsCarName">-</span>
                                    </h4>
                                    <button type="button" class="edit-icon-btn" onclick="showStep(3)" title="Edit vehicle">
                                        <i class="fas fa-pencil"></i>
                                    </button>
                                </div>
                                <div class="summary-car-info" id="mcsCarInfo">
                                    <span><i class="fas fa-user"></i> <span id="mcsCarCapacity"></span></span>
                                    <span><i class="fas fa-suitcase"></i> <span id="mcsCarLuggage"></span></span>
                                    <span><i class="fas fa-briefcase"></i> <span id="mcsCarHandLuggage"></span></span>
                                    <span id="mcsCarChildContainer" class="mcs-car-child-container"><i
                                            class="fas fa-baby-carriage"></i> <span id="mcsCarChild"></span></span>
                                </div>
                            </div>
                            <div class="mobile-summary-price-wrapper">
                                <div class="summary-car-price" id="mcsCarPrice">£0</div>
                                <div class="estimated-fare-badge" id="mcsEstimatedFareBadge">Estimated Fare</div>
                            </div>
                        </div>
                    </div>
                    <div class="booking-summary-list" id="mcsEnteredDetails" style="display:none;">
                        <!-- Passenger details header -->
                        <!-- <h5 class="booking-summary-header-item" id="mcsPassengerHeader">PASSENGER DETAILS</h5> -->

                        <div class="passenger-details-layout">
                            <div class="passenger-details-left">
                                <div id="mcsPassengerNameContainer" class="passenger-details-name-container">
                                    <div id="mcsBookedForContainer" class="passenger-booked-for-container"
                                        style="display:none;">
                                        <span class="passenger-details-label">Booked for: </span>
                                        <span class="passenger-booked-for-name" id="mcsBookedForName">-</span>
                                        <span id="mcsBookedForPhone" class="passenger-booked-for-phone"></span>
                                    </div>
                                    <div id="mcsBookedByWrapper" class="passenger-booked-wrapper">
                                        <span class="passenger-details-label" id="mcsBookedByLabel"
                                            style="display:none;">Booked by: </span>
                                        <span class="passenger-details-name" id="mcsPassengerName">-</span>
                                    </div>
                                </div>
                                <div class="booking-summary-item passenger-details-item" id="mcsPassengerPhoneContainer">
                                    <span class="summary-label"><i class="fas fa-phone p-icon-contact"></i></span>
                                    <span class="summary-value" id="mcsPassengerPhone">-</span>
                                </div>
                                <div class="booking-summary-item passenger-details-item" id="mcsPassengerEmailContainer">
                                    <span class="summary-label"><i class="fas fa-envelope p-icon-contact"></i></span>
                                    <span class="summary-value" id="mcsPassengerEmail">-</span>
                                </div>
                            </div>

                            <div class="passenger-details-right">
                                <div class="booking-summary-item passenger-details-item summary-icon-tooltip" id="mcsPassengerCountContainer" title="Passenger Count" data-tooltip="Passenger Count">
                                    <span class="summary-label"><i class="fas fa-user text-navy" title="Passenger Count"></i></span>
                                    <span class="summary-value" id="mcsPassengerCount">1</span>
                                </div>
                                <div class="booking-summary-item passenger-details-item summary-icon-tooltip" id="mcsLuggageContainer" title="Luggage" data-tooltip="Luggage">
                                    <span class="summary-label"><i class="fas fa-suitcase text-navy" title="Luggage"></i></span>
                                    <span class="summary-value" id="mcsLuggageCount">0</span>
                                </div>
                                <div class="booking-summary-item passenger-details-item summary-icon-tooltip" id="mcsHandLuggageContainer" title="Hand Luggage" data-tooltip="Hand Luggage">
                                    <span class="summary-label"><i class="fas fa-briefcase text-navy" title="Hand Luggage"></i></span>
                                    <span class="summary-value" id="mcsHandLuggageCount">0</span>
                                </div>
                                <div class="booking-summary-item passenger-details-item summary-icon-tooltip" id="mcsBabySeatContainer"
                                    style="display:none;" title="Baby Seats" data-tooltip="Baby Seats">
                                    <span class="summary-label"><i class="fas fa-baby-carriage text-navy" title="Baby Seats"></i></span>
                                    <span class="summary-value" id="mcsBabySeats">0</span>
                                </div>
                            </div>
                        </div>

                        <!-- Journey Details -->
                        <h5 class="booking-summary-header-item" id="mcsJourneyDetailsHeader" style="display:none;">
                            ADDITIONAL INFORMATION</h5>
                        <div class="booking-summary-item booking-summary-span2-item" id="mcsFlightContainer"
                            style="display:none;">
                            <span class="summary-label" id="mcsFlightLabel"><i class="fas fa-plane text-navy"></i></span>
                            <span id="mcsFlightNumber" class="summary-value">–</span>
                        </div>
                        <div class="booking-summary-item booking-summary-span2-item" id="mcsComingFromContainer"
                            style="display:none;">
                            <span class="summary-label" id="mcsComingFromLabel"><i
                                    class="fas fa-plane-arrival text-navy"></i> Coming From</span>
                            <span id="mcsComingFrom" class="summary-value">–</span>
                        </div>
                        <div class="booking-summary-item booking-summary-span2-item" id="mcsDropoffAddressContainer"
                            style="display:none;">
                            <span class="summary-label" id="mcsDropoffAddressLabel"><i
                                    class="fas fa-map-marker-alt text-navy"></i> Dropoff Address</span>
                            <span id="mcsDropoffAddress" class="summary-value">–</span>
                        </div>
                        <div class="booking-summary-item booking-summary-span2-item" id="mcsOptionsInlineRow" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap; margin-top: 4px; margin-bottom: 4px;">
                            <div id="mcsMeetGreetContainer" class="summary-inline-item summary-icon-tooltip summary-label" style="display:none;" title="Meet &amp; Greet Included" data-tooltip="Meet &amp; Greet Included">
                                <i class="fas fa-user-check text-navy"></i>
                                <span>Meet &amp; Greet</span>
                            </div>
                            <div id="mcsWheelchairContainer" class="summary-inline-item summary-icon-tooltip summary-label" style="display:none;" title="Wheelchair Access Requested" data-tooltip="Wheelchair Access Requested">
                                <i class="fas fa-wheelchair text-navy"></i>
                                <span>Wheelchair</span>
                            </div>
                        </div>

                        <!-- Special Requirements -->
                        <div class="booking-summary-item booking-summary-span2-item mcs-special-req-container"
                            id="mcsSpecialReqContainer" style="display:none;">
                            <span class="summary-label"><i class="fas fa-comment-dots text-navy"></i> Special Req.</span>
                            <span id="mcsSpecialRequirements" class="summary-value">–</span>
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
                    <!-- NIGHT CHARGE NOTICE CARD -->
                    <div id="nightChargeNoticeCard" class="night-charge-notice-card" style="display: none;">
                        <div class="night-charge-icon-wrap">
                            <i class="fas fa-moon night-charge-moon-icon"></i>
                        </div>
                        <div class="night-charge-text-content">
                            <div class="night-charge-title">Night charges apply from 11:00 PM to 5:00 AM</div>
                            <div class="night-charge-subtitle">A small additional fee will be included in your fare.</div>
                        </div>
                    </div>
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
                    <div id="seaportDockingFields" style="display: none;">
                        <div class="form-group-uber">
                            <label><i class="fas fa-clock"></i> PickUp After Docking?</label>
                            <select id="pickupAfterDocking">
                                <option value="">Select</option>
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
                <button id="timePanelDoneBtn" class="btn-search-uber mt-3 mt-md-5" onclick="saveSchedule()">
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
                                        class="location-input-field" autocomplete="off" onfocus="scrollToInputMobile(this)"
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
                                        class="location-input-field" autocomplete="off" onfocus="scrollToInputMobile(this)"
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

                        <!-- BOX 1: LOCATIONS (TRIP DETAILS) -->
                        <div class="find-trip-card summary-box-card" id="findTripCard">
                            <div class="find-trip-locations">
                                <div class="box-card-header">
                                    <h5 class="box-card-title">Trip Details</h5>
                                    <button class="edit-icon-btn" onclick="goBackToLocations()" title="Edit trip">
                                        <i class="fas fa-pencil"></i>
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
                                        <div class="form-group-uber dropoff-form-group">
                                            <div class="trip-details" id="summaryDropoff">–</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BOX 2: DATE, TIME, DISTANCE & DURATION CARD (STRICT 2 IN A ROW) -->
                        <div class="trip-datetime-card summary-box-card" id="tripDateTimeCard">
                            <div class="row g-2 align-items-center">
                                <!-- DATE STAT (ROW 1, COL 1) -->
                                <div class="col-6 col-md-6">
                                    <div class="trip-stat-box">
                                        <div class="stat-icon-circle yellow-icon">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                        <div class="stat-info-group">
                                            <span class="stat-header-label" id="dtStatDateLabel">DATE</span>
                                            <div class="stat-main-value" id="tripSelectedDate">--</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- TIME STAT (ROW 1, COL 2) -->
                                <div class="col-6 col-md-6">
                                    <div class="trip-stat-box">
                                        <div class="stat-icon-circle yellow-icon">
                                            <i class="far fa-clock"></i>
                                        </div>
                                        <div class="stat-info-group">
                                            <span class="stat-header-label" id="dtStatTimeLabel">TIME</span>
                                            <div class="stat-main-value" id="tripSelectedTime">--</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- DISTANCE & DURATION WRAPPER (ROW 2, SPANS BOTH COLS - 2 IN A ROW) -->
                                <div id="tripRouteMetaContainer" class="row g-2 col-12 p-0 m-0" style="display: none;">
                                    <!-- DISTANCE STAT (ROW 2, COL 1) -->
                                    <div class="col-6 col-md-6">
                                        <div class="trip-stat-box">
                                            <div class="stat-icon-circle navy-icon">
                                                <i class="fas fa-road"></i>
                                            </div>
                                            <div class="stat-info-group">
                                                <span class="stat-header-label">DISTANCE</span>
                                                <div class="stat-main-value" id="leftTripDistance">--</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- DURATION STAT (ROW 2, COL 2) -->
                                    <div class="col-6 col-md-6">
                                        <div class="trip-stat-box">
                                            <div class="stat-icon-circle navy-icon">
                                                <i class="fas fa-hourglass-half"></i>
                                            </div>
                                            <div class="stat-info-group">
                                                <span class="stat-header-label">DURATION</span>
                                                <div class="stat-main-value" id="leftTripDuration">--</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- RIDER SELECTION STRIP BELOW DATE & TIME BOX -->
                        <div class="rider-select-card summary-box-card" id="riderSelectCard">
                            <button type="button" class="trip-location-item rider-select-strip" onclick="showForMeModal()">
                                <div class="trip-location-icon">
                                    <i class="fas fa-user text-navy"></i>
                                    <div class="d-flex flex-column text-start">
                                        <span id="forMeTitle" class="rider-select-title">For me</span>
                                        <small id="forMeDetails" class="for-me-details-subtext"
                                            style="display:none;"></small>
                                    </div>
                                </div>
                                <i class="fas fa-chevron-down text-secondary ms-auto"></i>
                            </button>
                        </div>

                        <!-- BOX 3: SELECTED VEHICLE CARD -->
                        <div id="selectedCarSummary" class="selected-car-summary summary-box-card">
                            <div class="box-card-header">
                                <h5 class="summary-title mb-0">SELECTED VEHICLE</h5>
                                <button class="edit-icon-btn" onclick="showStep(3)" title="Edit vehicle">
                                    <i class="fas fa-pencil"></i>
                                </button>
                            </div>
                            <div class="selected-car-row">
                                <div class="d-flex flex-column align-items-center">
                                    <img id="summaryCarImage" src="" alt="Car" class="summary-car-image">
                                </div>
                                <div class="summary-car-details">
                                    <div id="summaryCarName" class="summary-car-name"></div>
                                    <div class="summary-car-info">
                                        <span>
                                            <i class="fas fa-user text-yellow"></i>
                                            <span id="summaryCarCapacity"></span>
                                        </span>
                                        <span>
                                            <i class="fas fa-suitcase text-navy"></i>
                                            <span id="summaryCarLuggage"></span>
                                        </span>
                                        <span>
                                            <i class="fas fa-briefcase text-yellow"></i>
                                            <span id="summaryCarHandLuggage"></span>
                                        </span>
                                        <span id="summaryCarChildContainer" style="display:none;">
                                            <i class="fas fa-baby-carriage text-navy"></i>
                                            <span id="summaryCarChild"></span>
                                        </span>
                                    </div>
                                    <div id="summaryCarPrice" class="summary-car-price"></div>
                                    <div class="estimated-fare-badge ">Estimated Fare</div>
                                </div>



                            </div>
                        </div>

                        <!-- BOX 4: PASSENGER DETAILS CARD -->

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
                        <div id="enteredDetailsSummary" class="booking-summary dropdown-desktop summary-box-card">
                            <h5 class="summary-title mb-0" onclick="toggleBookingDetailsDesktop()"
                                style="cursor:pointer; display: flex; align-items: center; justify-content: space-between; min-height: 24px;">
                                <span>PASSENGER DETAILS</span>
                                <i class="fas fa-chevron-down d-none d-lg-inline-flex align-items-center justify-content-center"
                                    id="bookingDetailsIcon" style="line-height: 1; height: auto;"></i>
                            </h5>

                            <div class="booking-summary-list" id="bookingSummaryListDesktop">
                                <div class="passenger-details-layout">
                                    <div class="passenger-details-left">
                                        <div id="summaryPassengerContainer" class="passenger-details-name-container">
                                            <div id="summaryBookedForContainer" class="passenger-booked-for-container"
                                                style="display:none;">
                                                <div class="passenger-details-label">Booked for: </div>
                                                <span class="passenger-booked-for-name" id="summaryBookedForName">-</span>
                                                <span id="summaryBookedForPhone" class="passenger-booked-for-phone"></span>
                                            </div>
                                            <div id="summaryBookedByWrapper" class="passenger-booked-wrapper">
                                                <div class="passenger-details-label" id="summaryBookedByLabel"
                                                    style="display:none;">Booked by: </div>
                                                <span id="summaryPassengerName" class="passenger-details-name"
                                                    style="font-weight:600;">-</span>
                                            </div>
                                        </div>
                                        <div class="booking-summary-item passenger-details-item mb-1"
                                            id="summaryContactContainer">
                                            <span class="summary-label"><i class="fas fa-phone"
                                                    style="background: #fff8e7;color: #f39c12;border: 1px solid #fde68a;"></i></span>
                                            <span id="summaryPassengerContact" class="summary-value">-</span>
                                        </div>
                                        <div class="booking-summary-item passenger-details-item" id="summaryEmailContainer">
                                            <span class="summary-label"><i class="fas fa-envelope"
                                                    style="background: #fff8e7;color: #f39c12;border: 1px solid #fde68a;"></i></span>
                                            <span id="summaryPassengerEmail" class="summary-value">-</span>
                                        </div>
                                    </div>

                                    <div class="passenger-details-right">
                                        <div class="booking-summary-item passenger-details-item summary-icon-tooltip"
                                            id="summaryPassengersCountContainer" title="Passenger Count" data-tooltip="Passenger Count">
                                            <span class="summary-label"><i class="fas fa-user text-navy" title="Passenger Count"></i></span>
                                            <span id="summaryPassengerCount" class="summary-value">1</span>
                                        </div>
                                        <div class="booking-summary-item passenger-details-item summary-icon-tooltip"
                                            id="summaryLuggageCountContainer" title="Luggage" data-tooltip="Luggage">
                                            <span class="summary-label"><i class="fas fa-suitcase text-navy" title="Luggage"></i></span>
                                            <span id="summaryLuggageCount" class="summary-value">0</span>
                                        </div>
                                        <div class="booking-summary-item passenger-details-item summary-icon-tooltip"
                                            id="summaryHandLuggageContainer" title="Hand Luggage" data-tooltip="Hand Luggage">
                                            <span class="summary-label"><i class="fas fa-briefcase text-navy" title="Hand Luggage"></i></span>
                                            <span id="summaryHandLuggageCount" class="summary-value">0</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="booking-summary-item" id="summaryBabySeatContainer" style="display:none;">
                                    <span class="summary-label"><i class="fas fa-child text-navy"></i> Baby Seats</span>
                                    <span id="summaryBabySeats" class="summary-value">None</span>
                                </div>
                                <h5 class="summary-title mb-2 mt-3" id="summaryJourneyDetailsHeader" style="display:none;">
                                    ADDITIONAL INFORMATION
                                </h5>

                                <div id="summaryFlightContainer" class="booking-summary-item" style="display:none;">
                                    <span class="summary-label" id="summaryFlightLabel">
                                        <i class="fas fa-plane text-navy"></i>
                                    </span>
                                    <span id="summaryFlightNumber" class="summary-value">–</span>
                                </div>

                                <div id="summaryComingFromContainer" class="booking-summary-item" style="display:none;">
                                    <span class="summary-label" id="summaryComingFromLabel">
                                        <i class="fas fa-map-marker-alt"></i> Coming From
                                    </span>
                                    <span id="summaryComingFrom" class="summary-value">–</span>
                                </div>

                                <div id="summaryDropoffAddressContainer" class="booking-summary-item" style="display:none;">
                                    <span class="summary-label" id="summaryDropoffAddressLabel">
                                        <i class="fas fa-location-dot"></i> Destination
                                    </span>
                                    <span id="summaryDropoffAddress" class="summary-value">–</span>
                                </div>

                                <div id="summaryOptionsInlineRow" class="summary-options-inline-row" style="display: flex; align-items: center; gap: 23px; flex-wrap: wrap; margin-top: 4px; margin-bottom: 4px;">
                                    <div id="summaryMeetGreetContainer" class="summary-inline-item summary-icon-tooltip summary-label" style="display:none;" title="Meet &amp; Greet Included" data-tooltip="Meet &amp; Greet Included">
                                        <i class="fas fa-user-check text-navy"></i>
                                        <span>Meet &amp; Greet</span>
                                    </div>
                                    <div id="summaryWheelchairContainer" class="summary-inline-item summary-icon-tooltip summary-label" style="display:none;" title="Wheelchair Access Requested" data-tooltip="Wheelchair Access Requested">
                                        <i class="fas fa-wheelchair text-navy"></i>
                                        <span>Wheelchair</span>
                                    </div>
                                </div>

                                <div id="summarySpecialReqContainer" class="booking-summary-item" style="display:none;">
                                    <span class="summary-label">
                                        <i class="fas fa-comment-dots text-navy"></i> Special Req.
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
            <!-- STEP 3: VEHICLE SELECTION -->
            <div class="form-section" id="step3">
                <div class="container">
                    <div class="booking-stepper-wrapper">
                        <div class="stepper-track">
                            <div class="stepper-item step-item-1 active">
                                <div class="stepper-num">1</div>
                                <div class="stepper-icon-circle"><i class="fas fa-car"></i></div>
                                <span class="stepper-label">Choose </span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-2 inactive">
                                <div class="stepper-num">2</div>
                                <div class="stepper-icon-circle"><i class="fas fa-clipboard-list"></i></div>
                                <span class="stepper-label">Booking </span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-3 inactive">
                                <div class="stepper-num">3</div>
                                <div class="stepper-icon-circle"><i class="fas fa-user-tie"></i></div>
                                <span class="stepper-label">Pick driver</span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-4 inactive">
                                <div class="stepper-num">4</div>
                                <div class="stepper-icon-circle"><i class="fas fa-credit-card"></i></div>
                                <span class="stepper-label">Pay</span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-5 inactive">
                                <div class="stepper-num badge-green">5</div>
                                <div class="stepper-icon-circle icon-green"><i class="fas fa-check"></i></div>
                                <span class="stepper-label label-green">Confirm</span>
                            </div>
                        </div>
                    </div>
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
                    <style>
                        .premium-tooltip-container {
                            position: relative;
                            display: inline-flex;
                            align-items: center;
                            cursor: pointer;
                        }

                        .premium-tooltip-container .fa-info-circle {
                            color: #888;
                            font-size: 16px;
                            transition: color 0.2s;
                        }

                        .premium-tooltip-container:hover .fa-info-circle {
                            color: #111;
                        }

                        .premium-tooltip-content {
                            visibility: hidden;
                            opacity: 0;
                            position: absolute;
                            top: 130%;
                            bottom: auto;
                            left: -15px;
                            transform: translateY(-10px);
                            width: 340px;
                            background-color: #fff;
                            color: #333;
                            text-align: left;
                            border-radius: 12px;
                            padding: 16px;
                            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
                            z-index: 99999;
                            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
                            font-size: 13px;
                            font-weight: 500;
                            line-height: 1.5;
                            pointer-events: none;
                            border: 1px solid #eaeaea;
                            font-family: inherit;
                        }

                        .premium-tooltip-content::after {
                            content: "";
                            position: absolute;
                            bottom: 100%;
                            top: auto;
                            left: 23px;
                            margin-left: -8px;
                            border-width: 8px;
                            border-style: solid;
                            border-color: transparent transparent #fff transparent;
                        }

                        .premium-tooltip-container:hover .premium-tooltip-content {
                            visibility: visible;
                            opacity: 1;
                            transform: translateY(0);
                        }

                        .tooltip-section-title {
                            font-size: 14px;
                            font-weight: 700;
                            color: #111;
                            margin-bottom: 6px;
                            display: flex;
                            align-items: center;
                        }

                        .tooltip-section-title:not(:first-child) {
                            margin-top: 14px;
                        }

                        .tooltip-list {
                            margin: 0;
                            padding: 0 0 0 20px;
                            color: #555;
                        }

                        .tooltip-list li {
                            margin-bottom: 4px;
                        }

                        @media (min-width: 769px) {
                            .premium-tooltip-content {
                                left: 0;
                                right: auto;
                                width: 340px;
                            }

                            .premium-tooltip-content::after {
                                left: 12px;
                            }
                        }

                        @media (max-width: 768px) {
                            .rc-stat-icon-circle{
                                width: 38px;
    height: 38px;
    font-size: 16px;
                            }
                            .premium-tooltip-content {
                                left: -10px;
                                right: auto;
                                transform: translateY(-10px);
                                width: 280px;
                            }

                            .premium-tooltip-content::after {
                                left: 18px;
                                right: auto;
                                margin-left: 0;
                            }

                            .premium-tooltip-container:hover .premium-tooltip-content {
                                transform: translateY(0);
                            }
                        }
                    </style>
                    <div class="booking-stepper-wrapper">
                        <div class="stepper-track">
                            <div class="stepper-item step-item-1 active">
                                <div class="stepper-num">1</div>
                                <div class="stepper-icon-circle"><i class="fas fa-car"></i></div>
                                <span class="stepper-label">Choose </span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-2 inactive">
                                <div class="stepper-num">2</div>
                                <div class="stepper-icon-circle"><i class="fas fa-clipboard-list"></i></div>
                                <span class="stepper-label">Booking </span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-3 inactive">
                                <div class="stepper-num">3</div>
                                <div class="stepper-icon-circle"><i class="fas fa-user-tie"></i></div>
                                <span class="stepper-label">Pick Driver</span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-4 inactive">
                                <div class="stepper-num">4</div>
                                <div class="stepper-icon-circle"><i class="fas fa-credit-card"></i></div>
                                <span class="stepper-label">Pay</span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-5 inactive">
                                <div class="stepper-num badge-green">5</div>
                                <div class="stepper-icon-circle icon-green"><i class="fas fa-check"></i></div>
                                <span class="stepper-label label-green">Confirm</span>
                            </div>
                        </div>
                    </div>
                    <div class="payment-summary" id="dynamicPaymentSummary" style="display:none;">
                        <div class="payment-item">
                            <span>Base Fare</span>
                            <span id="pbBaseFare">£0.00</span>
                        </div>
                        <div class="payment-item">
                            <span>Tax and Other charges</span>
                            <span id="pbTax">£0.00</span>
                        </div>
                        <div class="payment-item" id="pbFirstDiscountRow" style="display:none;">
                            <span style="display: flex; align-items: center; gap: 8px;">
                                <span style="background-color: #e8f5e9; color: #2e7d32; font-size: 11px; padding: 3px 8px; border-radius: 4px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Offer</span>
                                First Booking Discount
                            </span>
                            <span id="pbFirstDiscount" style="color: #2e7d32; font-weight: 600;">-£0.00</span>
                        </div>

                        <div class="payment-total grand-total">
                            <span style="display: flex; align-items: center; gap: 8px;">
                                Total
                            </span>
                            <div style="display: flex; flex-direction: column; align-items: flex-end;">
                                <span id="pbTotalFare">£0.00</span>
                                <!-- <div class="estimated-fare-badge" style="padding: 6px 8px;">Estimated Fare</div> -->
                            </div>
                        </div>
                    </div>
                    <style>
                        .payment-selection-wrapper {
                            margin-top: 20px;
                            margin-bottom: 25px;
                        }
                        .payment-group-label {
                            font-weight: 700;
                            font-size: 15px;
                            color: #1e293b;
                            margin-bottom: 12px;
                            display: flex;
                            align-items: center;
                            gap: 8px;
                        }
                        .payment-methods-grid {
                            display: grid;
                            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                            gap: 14px;
                            margin-bottom: 15px;
                        }
                        .payment-method-card {
                            background: #ffffff;
                            border: 2px solid #e2e8f0;
                            border-radius: 12px;
                            padding: 16px;
                            display: flex;
                            align-items: center;
                            gap: 14px;
                            cursor: pointer;
                            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
                            position: relative;
                            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
                        }
                        .payment-method-card:hover {
                            border-color: #cbd5e1;
                            transform: translateY(-2px);
                            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
                        }
                        .payment-method-card.active {
                            border-color: #f39c12;
                            background: #fffdf5;
                            box-shadow: 0 4px 14px rgba(243, 156, 18, 0.18);
                        }
                        .pm-card-icon {
                            width: 44px;
                            height: 44px;
                            border-radius: 10px;
                            background: #f8fafc;
                            color: #475569;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 20px;
                            flex-shrink: 0;
                            transition: all 0.25s ease;
                        }
                        .payment-method-card.active .pm-card-icon {
                            background: #f39c12;
                            color: #ffffff;
                        }
                        .pm-card-info {
                            flex-grow: 1;
                        }
                        .pm-card-title {
                            font-weight: 700;
                            font-size: 14px;
                            color: #0f172a;
                        }
                        .pm-card-desc {
                            font-size: 12px;
                            color: #64748b;
                            margin-top: 2px;
                        }
                        .pm-card-badge {
                            width: 22px;
                            height: 22px;
                            border-radius: 50%;
                            border: 2px solid #cbd5e1;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 11px;
                            color: transparent;
                            transition: all 0.2s ease;
                        }
                        .payment-method-card.active .pm-card-badge {
                            background: #f39c12;
                            border-color: #f39c12;
                            color: #ffffff;
                        }
                        .stripe-payment-box {
                            background: #0f172a;
                            color: #f8fafc;
                            border-radius: 14px;
                            padding: 22px;
                            margin-top: 15px;
                            border: 1px solid #1e293b;
                            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.25);
                            animation: fadeInStripe 0.3s ease-out;
                        }
                        @keyframes fadeInStripe {
                            from { opacity: 0; transform: translateY(-8px); }
                            to { opacity: 1; transform: translateY(0); }
                        }
                        .stripe-box-header {
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            margin-bottom: 18px;
                            padding-bottom: 12px;
                            border-bottom: 1px solid #1e293b;
                            flex-wrap: wrap;
                            gap: 10px;
                        }
                        .stripe-box-title {
                            font-weight: 700;
                            font-size: 14px;
                            color: #f8fafc;
                            display: flex;
                            align-items: center;
                            gap: 8px;
                        }
                        .stripe-accepted-icons {
                            display: flex;
                            gap: 10px;
                            font-size: 22px;
                            color: #94a3b8;
                        }
                        .stripe-loading-state {
                            padding: 20px;
                            text-align: center;
                            color: #94a3b8;
                            font-size: 14px;
                        }
                        .stripe-payment-alert {
                            background: #450a0a;
                            border: 1px solid #991b1b;
                            color: #fca5a5;
                            padding: 12px 16px;
                            border-radius: 8px;
                            font-size: 13px;
                            margin-top: 15px;
                        }
                        .stripe-security-footer {
                            display: flex;
                            justify-content: space-around;
                            align-items: center;
                            margin-top: 18px;
                            padding-top: 14px;
                            border-top: 1px solid #1e293b;
                            font-size: 11px;
                            color: #64748b;
                            flex-wrap: wrap;
                            gap: 10px;
                        }
                        .stripe-type-container {
                            margin-top: 15px;
                            margin-bottom: 15px;
                            animation: fadeInStripe 0.25s ease-out;
                        }
                        .payment-subgroup-label {
                            font-weight: 600;
                            font-size: 13px;
                            color: #475569;
                            margin-bottom: 8px;
                            display: flex;
                            align-items: center;
                            gap: 6px;
                        }
                        .stripe-type-grid {
                            display: grid;
                            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                            gap: 12px;
                        }
                        .stripe-type-card {
                            background: #ffffff;
                            border: 2px solid #e2e8f0;
                            border-radius: 10px;
                            padding: 14px;
                            cursor: pointer;
                            transition: all 0.2s ease;
                            box-shadow: 0 1px 4px rgba(0,0,0,0.03);
                        }
                        .stripe-type-card:hover {
                            border-color: #cbd5e1;
                            transform: translateY(-1px);
                        }
                        .stripe-type-card.active {
                            border-color: #f39c12;
                            background: #fffdf5;
                            box-shadow: 0 3px 10px rgba(243, 156, 18, 0.15);
                        }
                        .st-card-header {
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                        }
                        .st-card-title {
                            font-weight: 700;
                            font-size: 13px;
                            color: #0f172a;
                        }
                        .st-card-badge {
                            width: 18px;
                            height: 18px;
                            border-radius: 50%;
                            border: 1.5px solid #cbd5e1;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 9px;
                            color: transparent;
                        }
                        .stripe-type-card.active .st-card-badge {
                            background: #f39c12;
                            border-color: #f39c12;
                            color: #ffffff;
                        }
                        .st-card-amount {
                            font-weight: 800;
                            font-size: 17px;
                            color: #f39c12;
                            margin-top: 5px;
                        }
                        .st-card-desc {
                            font-size: 11px;
                            color: #64748b;
                            margin-top: 2px;
                        }
                    </style>

                    <div class="form-group-uber payment-selection-wrapper">
                        <label class="payment-group-label"><i class="fas fa-credit-card"></i> Payment Method *</label>
                        
                        <!-- Hidden select element for backwards compatibility -->
                        <select id="paymentMethod" required style="display:none;">
                            <option value="stripe" selected>Pay via Credit / Debit Card (Stripe)</option>
                        </select>

                        <!-- Executive Payment Option Cards -->
                        <div class="payment-methods-grid">
                            <div class="payment-method-card active" id="payMethodCardStripe" onclick="selectPaymentMethod('stripe')">
                                <div class="pm-card-icon stripe-icon"><i class="fas fa-credit-card"></i></div>
                                <div class="pm-card-info">
                                    <div class="pm-card-title">Card / Apple Pay / Google Pay</div>
                                    <div class="pm-card-desc">Instant 256-bit encrypted checkout via Stripe</div>
                                </div>
                                <div class="pm-card-badge"><i class="fas fa-check"></i></div>
                            </div>
                        </div>

                        <!-- Stripe Payment Type Sub-Tabs (Full Payment vs Part Payment) -->
                        <div id="stripePaymentTypeWrapper" class="stripe-type-container" style="display: block;">
                            <label class="payment-subgroup-label"><i class="fas fa-coins"></i> Select Payment Type *</label>
                            <div class="stripe-type-grid">
                                <div class="stripe-type-card active" id="stripeTypeFull" onclick="selectStripePaymentType('full')">
                                    <div class="st-card-header">
                                        <span class="st-card-title">Full Payment</span>
                                        <span class="st-card-badge"><i class="fas fa-check"></i></span>
                                    </div>
                                    <div class="st-card-amount" id="stripeFullAmount">£0.00</div>
                                    <div class="st-card-desc">Pay 100% total fare upfront</div>
                                </div>
                                <div class="stripe-type-card" id="stripeTypePart" onclick="selectStripePaymentType('part')">
                                    <div class="st-card-header">
                                        <span class="st-card-title">Part Payment</span>
                                        <span class="st-card-badge"><i class="fas fa-check"></i></span>
                                    </div>
                                    <div class="st-card-amount" id="stripePartAmount">£0.00</div>
                                    <div class="st-card-desc">Pay deposit now, rest to driver</div>
                                </div>
                            </div>
                        </div>

                        <!-- Stripe Payment Element Mount Container -->
                        <div id="stripePaymentContainer" class="stripe-payment-box" style="display: none;">
                            <div class="stripe-box-header">
                                <div class="stripe-box-title">
                                    <i class="fas fa-shield-alt" style="color: #10b981;"></i> Secure Card Checkout
                                </div>
                                <div class="stripe-accepted-icons">
                                    <i class="fab fa-cc-visa" title="Visa"></i>
                                    <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                                    <i class="fab fa-cc-amex" title="American Express"></i>
                                    <i class="fab fa-apple-pay" title="Apple Pay"></i>
                                    <i class="fab fa-google-pay" title="Google Pay"></i>
                                </div>
                            </div>

                            <div id="stripe-element-loading" class="stripe-loading-state">
                                <i class="fas fa-spinner fa-spin"></i> Initializing secure payment session...
                            </div>
                            
                            <!-- Stripe Elements mounts here -->
                            <div id="payment-element"></div>
                            
                            <div id="payment-message" class="stripe-payment-alert" style="display: none;"></div>
                            
                            <div class="stripe-security-footer">
                                <span><i class="fas fa-lock"></i> 256-Bit SSL Encrypted</span>
                                <span><i class="fas fa-check-circle"></i> PCI-DSS Compliant</span>
                                <span><i class="fab fa-stripe"></i> Powered by Stripe</span>
                            </div>
                        </div>
                    </div>

                    <!-- Modern Premium Tab View for Inclusions & Exclusions -->
                    <div class="premium-tab-container">
                        <div class="accordion-content">
                            <div class="accordion-tabs">
                                <button type="button" class="tab-btn active" onclick="switchVehicleTab(this, 'inclusions')">
                                    <i class="fas fa-check-circle tab-icon-check"></i> Inclusions
                                </button>
                                <button type="button" class="tab-btn" onclick="switchVehicleTab(this, 'exclusions')">
                                    <i class="fas fa-times-circle tab-icon-cross"></i> Exclusions
                                </button>
                            </div>
                            <div class="tab-pane inclusions-pane active">
                                <div class="tab-points-list mt-2">
                                    <div class="tab-point-item">
                                        <i class="fas fa-parking point-icon point-icon-check"></i>
                                        <div>Parking Charges</div>
                                    </div>
                                    <div class="tab-point-item">
                                        <i class="fas fa-road point-icon point-icon-check"></i>
                                        <div>Congestion Charges</div>
                                    </div>
                                    <div class="tab-point-item">
                                        <i class="fas fa-moon point-icon point-icon-check"></i>
                                        <div>Night Charges</div>
                                    </div>
                                    <div class="tab-point-item">
                                        <i class="fas fa-calendar-day point-icon point-icon-check"></i>
                                        <div>Special Day Charges</div>
                                    </div>
                                    <div class="tab-point-item">
                                        <i class="fas fa-clock point-icon point-icon-check"></i>
                                        <div>Waiting Charges</div>
                                    </div>
                                    <div class="tab-point-item">
                                        <i class="fas fa-file-invoice-dollar point-icon point-icon-check"></i>
                                        <div>Child Seat is Included</div>
                                    </div>
                                    <div class="tab-point-item">
                                        <i class="fas fa-user-check point-icon point-icon-check"></i>
                                        <div>Meet & Greet</div>
                                    </div>
                                    <div class="tab-point-item">
                                        <i class="fas fa-gas-pump point-icon point-icon-check"></i>
                                        <div>Fuel charges included.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane exclusions-pane" style="display: none;">
                                <div class="tab-points-list">
                                    <div class="tab-point-item">
                                        <i class="fas fa-times point-icon point-icon-cross"></i>
                                        <div>Any government or local authority charges, if applicable.</div>
                                    </div>
                                    <div class="tab-point-item">
                                        <i class="fas fa-times point-icon point-icon-cross"></i>
                                        <div>Additional mileage and waiting charges beyond the included limits.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <div class="booking-stepper-wrapper">
                        <div class="stepper-track">
                            <div class="stepper-item step-item-1 active">
                                <div class="stepper-num">1</div>
                                <div class="stepper-icon-circle"><i class="fas fa-car"></i></div>
                                <span class="stepper-label">Choose </span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-2 inactive">
                                <div class="stepper-num">2</div>
                                <div class="stepper-icon-circle"><i class="fas fa-clipboard-list"></i></div>
                                <span class="stepper-label">Booking </span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-3 inactive">
                                <div class="stepper-num">3</div>
                                <div class="stepper-icon-circle"><i class="fas fa-user-tie"></i></div>
                                <span class="stepper-label">Pick driver</span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-4 inactive">
                                <div class="stepper-num">4</div>
                                <div class="stepper-icon-circle"><i class="fas fa-credit-card"></i></div>
                                <span class="stepper-label">Pay</span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-5 inactive">
                                <div class="stepper-num badge-green">5</div>
                                <div class="stepper-icon-circle icon-green"><i class="fas fa-check"></i></div>
                                <span class="stepper-label label-green">Confirm</span>
                            </div>
                        </div>
                    </div>
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
                                <input type="text" id="passengerFirstName" placeholder="Full name" maxlength="75" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').slice(0, 75)">
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
                                        <button type="button" class="counter-btn" onclick="updateCarSeatCount(1)">+</button>
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
                                    <input type="text" id="flightNumber" placeholder="Flight Number" oninput="this.value = this.value.slice(0, 150)">
                                </div>
                                <!--<div class="form-group-uber booking-form-group">
                                            <label>
                                                <i class="fas fa-clock"></i>
                                                Flight Arriving Time *
                                            </label>
                                            <div class="time-dropdown-wrapper" id="flightTimeDropdownWrapper">
                                                <button type="button" class="time-dropdown-btn" id="flightTimeDropdownBtn"
                                                    onclick="toggleFlightTimeDropdown()">
                                                    <span id="flightTimeDropdownValue"> <i
                                                            class="fas fa-clock me-1"></i>11:00</span>
                                                    <span class="time-dropdown-icon"><i class="fas fa-chevron-down"></i></span>
                                                </button>
                                                <div class="time-dropdown-list flight-time-dual-dropdown"
                                                    id="flightTimeDropdownList">
                                                    <div class="flight-time-col-header">
                                                        <div>Hour</div>
                                                        <div>Min</div>
                                                    </div>
                                                    <div class="flight-time-cols-container">
                                                        <div class="flight-time-col flight-hours-col">
                                                            @for ($h = 0; $h < 24; $h++)
                                                                @php $val = sprintf('%02d', $h); @endphp
                                                                <div class="flight-time-item hour-item" data-val="{{ $val }}"
                                                                    onclick="selectFlightHour('{{ $val }}')">{{ $val }}</div>
                                                            @endfor
                                                        </div>
                                                        <div class="flight-time-col flight-minutes-col">
                                                            @for ($m = 0; $m < 60; $m++)
                                                                @php $val = sprintf('%02d', $m); @endphp
                                                                <div class="flight-time-item minute-item" data-val="{{ $val }}"
                                                                    onclick="selectFlightMinute('{{ $val }}')">{{ $val }}</div>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="flightArrivingTime" value="11:00">
                                        </div>-->
                                <!-- <div class="form-group-uber booking-form-group d-none">
                                    <label>
                                        <i class="fas fa-clock"></i>
                                        PickUp  After Landing?
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
                                </div> -->
                                <div class="form-group-uber booking-form-group">
                                    <label>Coming From *</label>
                                    <input type="text" id="comingFrom" placeholder="Coming From" oninput="this.value = this.value.slice(0, 150)">
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label>Drop off Address</label>
                                    <input type="text" id="dropoffAddress" placeholder="Full address with postcode" oninput="this.value = this.value.slice(0, 150)">
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label>
                                        <i class="fas fa-hourglass-end"></i> Pickup After Landing
                                    </label>
                                    <select id="pickupAfterLandingSelect">
                                        <option value="15">15 Min After</option>
                                        <option value="30">30 Min After</option>
                                        <option value="45" selected>45 Min After</option>
                                        <option value="60">60 Min After</option>
                                        <option value="75">75 Min After</option>
                                        <option value="90">90 Min After</option>
                                    </select>
                                </div>
                                <style>
                                    .meet-greet-tooltip {
                                        position: relative;
                                        display: inline-flex;
                                        align-items: center;
                                    }

                                    .meet-greet-tooltip .tooltip-text {
                                        visibility: hidden;
                                        width: max-content;
                                        max-width: 220px;
                                        background-color: #333;
                                        color: #fff;
                                        text-align: center;
                                        border-radius: 6px;
                                        padding: 6px 12px;
                                        font-size: 12px;
                                        font-weight: 500;
                                        position: absolute;
                                        z-index: 1050;
                                        bottom: 135%;
                                        left: 50%;
                                        transform: translateX(-50%);
                                        opacity: 0;
                                        transition: opacity 0.3s;
                                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
                                        pointer-events: none;
                                        white-space: normal;
                                    }

                                    .meet-greet-tooltip .tooltip-text::after {
                                        content: "";
                                        position: absolute;
                                        top: 100%;
                                        left: 50%;
                                        margin-left: -5px;
                                        border-width: 5px;
                                        border-style: solid;
                                        border-color: #333 transparent transparent transparent;
                                    }

                                    .meet-greet-tooltip:hover .tooltip-text {
                                        visibility: visible;
                                        opacity: 1;
                                    }
                                </style>
                                <div class="form-group-uber booking-form-group"
                                    style="grid-column: 1 / -1; margin-top: 10px;">
                                    <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 15px 25px;">
                                        <div style="display: flex; align-items: center; flex-wrap: nowrap; gap: 8px;">
                                            <input type="checkbox" id="meetAndGreet"
                                                class="booking-checkbox meet-and-greet-cb"
                                                style="margin: 0; flex-shrink: 0; width: 20px; height: 20px; cursor: pointer;"
                                                onchange="if(this.checked) showToast('Meet &amp; Greet may have additional Payment', 'info')">
                                            <label for="meetAndGreet"
                                                style="margin: 0; font-weight: 500; font-size: 15px; cursor: pointer; white-space: nowrap;">
                                                Meet and Greet Options
                                            </label>
                                            <div class="meet-greet-tooltip">
                                                <i class="fas fa-info-circle text-dark"
                                                    style="cursor: pointer; font-size: 16px; margin-top: 2px;"></i>
                                                <span class="tooltip-text">Meet &amp; Greet may have additional
                                                    Payment</span>
                                            </div>
                                        </div>
                                        <div style="display: none; align-items: center; flex-wrap: nowrap; gap: 8px;">
                                            <input type="checkbox" id="wheelchairOptionAirport"
                                                class="booking-checkbox wheelchair-option-cb"
                                                style="margin: 0; flex-shrink: 0; width: 20px; height: 20px; cursor: pointer;"
                                                onchange="if(this.checked) showToast('Wheelchair Option selected', 'info')">
                                            <label for="wheelchairOptionAirport"
                                                style="margin: 0; font-weight: 500; font-size: 15px; cursor: pointer; white-space: nowrap;">
                                                Wheelchair Accessible
                                            </label>
                                            <div class="meet-greet-tooltip">
                                                <i class="fas fa-info-circle text-dark"
                                                    style="cursor: pointer; font-size: 16px; margin-top: 2px;"></i>
                                                <span class="tooltip-text">Wheelchair accessibility option</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Seaport -->
                        <!-- Seaport -->
                        <div id="journeySeaport" style="display:none;">
                            <div class="booking-form-grid">
                                <div class="form-group-uber booking-form-group">
                                    <label><i class="fas fa-ship"></i> Cruise/Ferry Name</label>
                                    <input type="text" id="ferryName" placeholder="Cruise or Ferry name" oninput="this.value = this.value.slice(0, 150)">
                                </div>
                                <div class="form-group-uber booking-form-group d-none">
                                    <label><i class="fas fa-calendar-alt"></i> Docking Date</label>
                                    <input type="text" id="seaportArrivalDate" placeholder="Select Date">
                                </div>
                                <div class="form-group-uber booking-form-group d-none">
                                    <label><i class="fas fa-clock"></i> Docking Time</label>
                                    <div class="time-dropdown-wrapper" id="seaportTimeDropdownWrapper">
                                        <button type="button" class="time-dropdown-btn" id="seaportTimeDropdownBtn"
                                            onclick="toggleSeaportTimeDropdown()">
                                            <span id="seaportTimeDropdownValue"><i
                                                    class="fas fa-clock me-1"></i>11:00</span>
                                            <span class="time-dropdown-icon"><i class="fas fa-chevron-down"></i></span>
                                        </button>
                                        <div class="time-dropdown-list flight-time-dual-dropdown"
                                            id="seaportTimeDropdownList">
                                            <div class="flight-time-col-header">
                                                <div>Hour</div>
                                                <div>Min</div>
                                            </div>
                                            <div class="flight-time-cols-container">
                                                <div class="flight-time-col seaport-hours-col">
                                                    @for ($h = 0; $h < 24; $h++)
                                                        @php $val = sprintf('%02d', $h); @endphp
                                                        <div class="flight-time-item seaport-hour-item" data-val="{{ $val }}"
                                                            onclick="selectSeaportHour('{{ $val }}')">{{ $val }}</div>
                                                    @endfor
                                                </div>
                                                <div class="flight-time-col seaport-minutes-col">
                                                    @for ($m = 0; $m < 60; $m++)
                                                        @php $val = sprintf('%02d', $m); @endphp
                                                        <div class="flight-time-item seaport-minute-item" data-val="{{ $val }}"
                                                            onclick="selectSeaportMinute('{{ $val }}')">{{ $val }}</div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="seaportArrivalTime" value="">
                                </div>
                                <div class="form-group-uber booking-form-group d-none">
                                    <label><i class="fas fa-map-marker-alt"></i> Terminal</label>
                                    <input type="text" id="comingFromPort" placeholder="Terminal name" oninput="this.value = this.value.slice(0, 150)">
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label>Drop off Address</label>
                                    <input type="text" id="dropoffAddressSeaport" placeholder="Full address with postcode" oninput="this.value = this.value.slice(0, 150)">
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label>
                                        <i class="fas fa-clock"></i> PickUp After Docking?
                                    </label>
                                    <select id="pickupAfterDockingSelect">
                                        <option value="">Select</option>
                                        <option value="15">15 Min After</option>
                                        <option value="30">30 Min After</option>
                                        <option value="45" selected>45 Min After</option>
                                        <option value="60">60 Min After</option>
                                        <option value="75">75 Min After</option>
                                        <option value="90">90 Min After</option>
                                    </select>
                                </div>
                                <div class="form-group-uber booking-form-group"
                                    style="grid-column: 1 / -1; margin-top: 10px;">
                                    <div style="display: none; align-items: center; flex-wrap: wrap; gap: 15px 25px;">
                                        <div style="display: flex; align-items: center; flex-wrap: nowrap; gap: 8px;">
                                            <input type="checkbox" id="wheelchairOptionSeaport"
                                                class="booking-checkbox wheelchair-option-cb"
                                                style="margin: 0; flex-shrink: 0; width: 20px; height: 20px; cursor: pointer;"
                                                onchange="if(this.checked) showToast('Wheelchair Option selected', 'info')">
                                            <label for="wheelchairOptionSeaport"
                                                style="margin: 0; font-weight: 500; font-size: 15px; cursor: pointer; white-space: nowrap;">
                                                Wheelchair Accessible
                                            </label>
                                            <div class="meet-greet-tooltip">
                                                <i class="fas fa-info-circle text-dark"
                                                    style="cursor: pointer; font-size: 16px; margin-top: 2px;"></i>
                                                <span class="tooltip-text">Wheelchair accessibility option</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Normal -->
                        <!-- Normal -->
                        <div id="journeyNormal">
                            <div class="booking-form-grid">
                                <div class="form-group-uber booking-form-group">
                                    <label>Pickup Address</label>
                                    <input type="text" id="pickupAddressNormal"
                                        placeholder="Full pickup address with postcode" oninput="this.value = this.value.slice(0, 150)">
                                </div>
                                <div class="form-group-uber booking-form-group">
                                    <label>Dropoff Address</label>
                                    <input type="text" id="dropoffAddressNormal"
                                        placeholder="Full dropoff address with postcode" oninput="this.value = this.value.slice(0, 150)">
                                </div>
                                <div class="form-group-uber booking-form-group"
                                    style="grid-column: 1 / -1; margin-top: 10px;">
                                    <div style="display: none; align-items: center; flex-wrap: wrap; gap: 15px 25px;">
                                        <div style="display: flex; align-items: center; flex-wrap: nowrap; gap: 8px;">
                                            <input type="checkbox" id="wheelchairOptionNormal"
                                                class="booking-checkbox wheelchair-option-cb"
                                                style="margin: 0; flex-shrink: 0; width: 20px; height: 20px; cursor: pointer;"
                                                onchange="if(this.checked) showToast('Wheelchair Option selected', 'info')">
                                            <label for="wheelchairOptionNormal"
                                                style="margin: 0; font-weight: 500; font-size: 15px; cursor: pointer; white-space: nowrap;">
                                                Wheelchair Accessible
                                            </label>
                                            <div class="meet-greet-tooltip">
                                                <i class="fas fa-info-circle text-dark"
                                                    style="cursor: pointer; font-size: 16px; margin-top: 2px;"></i>
                                                <span class="tooltip-text">Wheelchair accessibility option</span>
                                            </div>
                                        </div>
                                    </div>
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
                                    <input type="checkbox" id="specialReqCheckbox" onchange="toggleSpecialRequirements()"
                                        class="booking-checkbox">
                                    Add Special Requirements?
                                </label>
                            </div>
                            <!-- TEXTAREA (HIDDEN BY DEFAULT) -->
                            <div class="form-group-uber booking-form-group">
                                <textarea id="specialRequirements" rows="3" placeholder="Enter any special requirements"
                                    style="display: none;" oninput="this.value = this.value.slice(0, 150)"></textarea>
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
                    <div class="booking-stepper-wrapper">
                        <div class="stepper-track">
                            <div class="stepper-item step-item-1 active">
                                <div class="stepper-num">1</div>
                                <div class="stepper-icon-circle"><i class="fas fa-car"></i></div>
                                <span class="stepper-label">Choose </span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-2 inactive">
                                <div class="stepper-num">2</div>
                                <div class="stepper-icon-circle"><i class="fas fa-clipboard-list"></i></div>
                                <span class="stepper-label">Booking </span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-3 inactive">
                                <div class="stepper-num">3</div>
                                <div class="stepper-icon-circle"><i class="fas fa-user-tie"></i></div>
                                <span class="stepper-label">Pick driver</span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-4 inactive">
                                <div class="stepper-num">4</div>
                                <div class="stepper-icon-circle"><i class="fas fa-credit-card"></i></div>
                                <span class="stepper-label">Pay</span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-5 inactive">
                                <div class="stepper-num badge-green">5</div>
                                <div class="stepper-icon-circle icon-green"><i class="fas fa-check"></i></div>
                                <span class="stepper-label label-green">Confirm</span>
                            </div>
                        </div>
                    </div>
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

                    <!-- BOOKING EXPIRED UI CARD -->
                    <div id="bookingExpiredCard" class="booking-expired-card text-center p-4 rounded-4" style="display: none; background: #ffffff; border: 1px solid #fee2e2; box-shadow: 0 10px 25px rgba(239, 68, 68, 0.08); margin: 20px 0;">
                        <div class="expired-icon-wrapper mb-3" style="width: 70px; height: 70px; background: rgba(239, 68, 68, 0.1); color: #dc2626; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 32px; margin: 0 auto;">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">Booking Expired</h4>
                        <p class="text-secondary mb-3" style="font-size: 14px; max-width: 420px; margin: 0 auto 15px; line-height: 1.5;">
                            Your scheduled pickup time has passed. Drivers can no longer bid on this ride request.
                        </p>
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill bg-light text-danger fw-semibold mb-4" style="font-size: 13px; border: 1px solid #fecaca;" id="expiredPickupTimeDetails">
                            <i class="fa-solid fa-calendar-xmark"></i> Exceeded Pickup Time
                        </div>
                        <div class="mt-2 d-flex justify-content-center">
                            <button type="button" class="btn btn-dark btn-lg w-100 rounded-pill py-3 fw-bold shadow-sm" onclick="resetToNewBooking()" style="max-width: 320px; font-size: 15px; background: #000; color: #fff; border: none; cursor: pointer;">
                                <i class="fa-solid fa-plus me-2"></i> New Booking
                            </button>
                        </div>
                    </div>

                    <div class="btn-group-uber step-bottom-btns" id="step6CancelBtnWrapper" style="margin-top: auto;">
                        <button class="btn-search-uber" style="width: 100%;" onclick="showCancelJobModal()">
                            <i class="fas fa-times"></i> Cancel Job
                        </button>
                    </div>


                </div>
            </div>
            <!-- STEP 7: REVIEW & CONFIRM (shown after clicking a driver) -->
            <div class="form-section" id="step7">
                <div class="container">
                    <div class="booking-stepper-wrapper">
                        <div class="stepper-track">
                            <div class="stepper-item step-item-1 active">
                                <div class="stepper-num">1</div>
                                <div class="stepper-icon-circle"><i class="fas fa-car"></i></div>
                                <span class="stepper-label">Choose </span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-2 inactive">
                                <div class="stepper-num">2</div>
                                <div class="stepper-icon-circle"><i class="fas fa-clipboard-list"></i></div>
                                <span class="stepper-label">Booking </span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-3 inactive">
                                <div class="stepper-num">3</div>
                                <div class="stepper-icon-circle"><i class="fas fa-user-tie"></i></div>
                                <span class="stepper-label">Pick driver</span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-4 inactive">
                                <div class="stepper-num">4</div>
                                <div class="stepper-icon-circle"><i class="fas fa-credit-card"></i></div>
                                <span class="stepper-label">Pay</span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-5 inactive">
                                <div class="stepper-num badge-green">5</div>
                                <div class="stepper-icon-circle icon-green"><i class="fas fa-check"></i></div>
                                <span class="stepper-label label-green">Confirm</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Details Card -->
                    <div class="rc-vehicle-card mb-2">
                        <div class="rc-vehicle-top">
                            <div class="rc-vehicle-img-wrapper">
                                <img id="rcCarImage" src="goride/img/fleet1.png" alt="Car"
                                    onclick="showCarDetailsModal(bookingData.selectedDriver)">
                            </div>
                            <div class="rc-vehicle-info-right">
                                <div class="rc-vehicle-name-block">
                                    <h4>${vehicleName}</h4>
                                </div>
                                <div class="rc-vehicle-stats-row">
                                    <div class="rc-vehicle-stat-item">
                                        <div class="rc-stat-icon-circle">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="rc-stat-val" id="rcPassengerCapacity">8</div>
                                        <div class="rc-stat-lbl">Seats</div>
                                    </div>
                                    <div class="rc-stat-divider"></div>
                                    <div class="rc-vehicle-stat-item">
                                        <div class="rc-stat-icon-circle">
                                            <i class="fas fa-suitcase"></i>
                                        </div>
                                        <div class="rc-stat-val" id="rcLuggageCapacity">8</div>
                                        <div class="rc-stat-lbl">Luggage</div>
                                    </div>
                                    <div class="rc-stat-divider"></div>
                                    <div class="rc-vehicle-stat-item">
                                        <div class="rc-stat-icon-circle">
                                            <i class="fas fa-child"></i>
                                        </div>
                                        <div class="rc-stat-val" id="rcChildSeatCapacity">0</div>
                                        <div class="rc-stat-lbl">Child Seats</div>
                                    </div>
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

                            <div class="rc-bid-card">
                                <div class="rc-bid-top">
                                    <div class="rc-card-subtitle">BIDDED AMOUNT</div>
                                    <!-- <div class="rc-bid-badge"><i class="fas fa-check-circle"></i> Includes all fees</div> -->
                                </div>
                                <div class="rc-bid-bottom">
                                    <div class="rc-bid-amount">
                                        <strong id="rcFareAmount">£0</strong>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>


                    <!-- Bidded Amount Card -->

                    <!-- Accept Button -->
                    <div class="btn-group-uber step-bottom-btns rc-accept-wrap">
                        <button class="btn-back-uber" onclick="showStep(6)">
                            <i class="fas fa-chevron-left"></i> Back
                        </button>
                        <button class="btn-search-uber" onclick="acceptDriver(this)" style="flex:1;">
                            <i class="fas fa-check me-2"></i> Accept
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-section" id="step8">
                <div class="container">
                    <div class="booking-stepper-wrapper">
                        <div class="stepper-track">
                            <div class="stepper-item step-item-1 active">
                                <div class="stepper-num">1</div>
                                <div class="stepper-icon-circle"><i class="fas fa-car"></i></div>
                                <span class="stepper-label">Choose </span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-2 inactive">
                                <div class="stepper-num">2</div>
                                <div class="stepper-icon-circle"><i class="fas fa-clipboard-list"></i></div>
                                <span class="stepper-label">Booking </span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-3 inactive">
                                <div class="stepper-num">3</div>
                                <div class="stepper-icon-circle"><i class="fas fa-user-tie"></i></div>
                                <span class="stepper-label">Pick driver</span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-4 inactive">
                                <div class="stepper-num">4</div>
                                <div class="stepper-icon-circle"><i class="fas fa-credit-card"></i></div>
                                <span class="stepper-label">Pay</span>
                                <div class="stepper-line"></div>
                            </div>
                            <div class="stepper-item step-item-5 inactive">
                                <div class="stepper-num badge-green">5</div>
                                <div class="stepper-icon-circle icon-green"><i class="fas fa-check"></i></div>
                                <span class="stepper-label label-green">Confirm</span>
                            </div>
                        </div>
                    </div>
                    <div class="confirm-modal-content" style="padding: 0px 0;">
                        <!-- <div class="confirm-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div> -->
                        <h2 class="confirm-title" style="text-align: center; margin-top: 15px; margin-bottom: 12px;">
                            Booking Confirmed!</h2>
                        <div class="confirm-booking-id"
                            style="background: #f8f9fa; padding: 10px; border-radius: 8px; text-align: center; margin-bottom: 15px;">
                            <small
                                style="color: #666; font-size: 12px; font-weight: 600; text-transform: uppercase;">Booking
                                No</small>
                            <div class="id-value" id="confirmNum"
                                style="font-size: 20px; font-weight: 700; color: #000; margin-top: 5px;">GR-2026-14851
                            </div>
                        </div>
                        <div class="confirm-details-grid"
                            style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                            <div class="confirm-detail-item">
                                <small style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-location-dot"></i> PICKUP</small>
                                <div class="detail-value" id="confirmPickup"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                            <div class="confirm-detail-item">
                                <small style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-location-dot"></i> DESTINATION</small>
                                <div class="detail-value" id="confirmDropoff"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                            <div class="confirm-detail-item">
                                <small style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-calendar"></i> DATE & TIME</small>
                                <div class="detail-value" id="confirmDateTime"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                            <div class="confirm-detail-item">
                                <small style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-car"></i> VEHICLE</small>
                                <div class="detail-value" id="confirmVehicle"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                            <div class="confirm-detail-item">
                                <small style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-road"></i> DISTANCE</small>
                                <div class="detail-value" id="confirmDistance"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                            <div class="confirm-detail-item">
                                <small style="color: #666; font-size: 11px; font-weight: 600; text-transform: uppercase;"><i
                                        class="fas fa-hourglass"></i> DURATION</small>
                                <div class="detail-value" id="confirmDuration"
                                    style="font-weight: 600; font-size: 14px; margin-top: 5px; color: #333;">—</div>
                            </div>
                        </div>
                        <p class="confirm-info-text"
                            style="text-align: center; color: #666; font-size: 14px; line-height: 1.5; margin-bottom: 25px;">
                            Your booking has been successfully confirmed.
                        </p>
                    </div>
                    <div class="btn-group-uber step-bottom-btns" style="display: flex; gap: 12px; margin-top: auto; padding-top: 15px;">
                        <a href="#" id="viewBookingPreviewBtn" onclick="openBookingPreviewFromConfirmation(event)" target="_blank" class="btn-search-uber text-decoration-none" style="flex: 1; display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-size: 15px; font-weight: 700; height: 48px; border-radius: 8px; background: #000; color: #fff;">
                            <i class="fas fa-file-invoice"></i> Booking Preview
                        </a>
                        <button type="button" class="btn-search-uber" onclick="openTrackRideWithCurrentBooking()" style="flex: 1; display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-size: 15px; font-weight: 700; height: 48px; border-radius: 8px; background: #000; color: #fff;">
                            <i class="fas fa-map-marker-alt"></i> Track Driver
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
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
                    border: 1px solid #eaeaea;
                    white-space: nowrap;
                    font-family: inherit;
                }
            </style>
            <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtkJtXBZPLBZIgjgpu-eAG5WQ1HwW4EwE&libraries=geometry"></script>

            <script>
                let bookingGoogleMap = null;
                let routeBounds = null;
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
                    const formattedDur = formatTripDuration(dur);

                    if (formattedDist || formattedDur) {
                        const dText = formattedDist || '--';
                        const tText = formattedDur || '--';

                        // Left side Trip Details card
                        $('#leftTripDistance').text(dText);
                        $('#leftTripDuration').text(tText);
                        $('#tripRouteMetaContainer').attr('style', 'display: flex !important;');

                        // Mobile Summary
                        $('#mcsDistanceValue').text(dText);
                        $('#mcsDurationValue').text(tText);

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

                        _drawNearbyDrivers(bookingData.nearby_drivers || []);
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

                    _drawNearbyDrivers(bookingData.nearby_drivers || []);
                }

                let _nearbyDriverMarkers = [];
                function _drawNearbyDrivers(drivers) {
                    if (!bookingGoogleMap) return;

                    // Clear existing markers first
                    _nearbyDriverMarkers.forEach(marker => {
                        if (marker && typeof marker.setMap === 'function') {
                            marker.setMap(null);
                        } else if (marker && marker.marker) {
                            marker.marker.setMap(null);
                            if (marker.interval) clearInterval(marker.interval);
                        }
                    });
                    _nearbyDriverMarkers = [];

                    if (!drivers || drivers.length === 0) return;

                    drivers.forEach((driver, index) => {
                        // Generate a pseudo-random angle (0 to 359) based on lat/lng or just random
                        // so each car faces a different direction
                        const angle = Math.floor(Math.random() * 360);

                        // We create the SVG for this specific car with the rotation applied
                        const carSvg = `
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                                            <g transform="translate(64,64) rotate(${angle}) translate(-32,-64)" filter="drop-shadow(0px 4px 6px rgba(0,0,0,0.4))">
                                                <!-- Car Body -->
                                                <rect x="12" y="8" width="40" height="104" rx="18" fill="#111111"/>

                                                <!-- Windshield (dark tinted) -->
                                                <path d="M 17 42 Q 32 32 47 42 L 44 54 H 20 Z" fill="#ffffffff"/>

                                                <!-- Rear Window (dark tinted) -->
                                                <path d="M 19 86 Q 32 94 45 86 L 42 76 H 22 Z" fill="#ffffffff"/>

                                                <!-- Side Mirrors -->
                                                <rect x="9" y="46" width="6" height="10" rx="3" fill="#ffffffff"/>
                                                <rect x="49" y="46" width="6" height="10" rx="3" fill="#ffffffff"/>

                                                <!-- Subtle Metallic Highlights -->
                                                <rect x="15" y="11" width="34" height="98" rx="15" fill="none" stroke="#333333" stroke-width="1.5"/>

                                                <!-- Headlights -->
                                                <rect x="18" y="10" width="8" height="4" rx="2" fill="#E8F0FF"/>
                                                <rect x="38" y="10" width="8" height="4" rx="2" fill="#E8F0FF"/>

                                                <!-- Taillights -->
                                                <rect x="16" y="108" width="10" height="3" rx="1.5" fill="#FF3B30"/>
                                                <rect x="38" y="108" width="10" height="3" rx="1.5" fill="#FF3B30"/>
                                            </g>
                                        </svg>
                                    `;
                        const iconUrl = 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(carSvg);

                        // Stagger animation for a smooth, organic feel
                        setTimeout(() => {
                            let currentLat = parseFloat(driver.lat);
                            let currentLng = parseFloat(driver.lng);

                            const marker = new google.maps.Marker({
                                position: { lat: currentLat, lng: currentLng },
                                map: bookingGoogleMap,
                                icon: {
                                    url: iconUrl,
                                    scaledSize: new google.maps.Size(40, 40),
                                    anchor: new google.maps.Point(20, 20)
                                },
                                animation: google.maps.Animation.DROP,
                                title: `Nearby Driver (${driver.distance_miles} miles away)`
                            });

                            _nearbyDriverMarkers.push(marker);
                        }, index * 200);
                    });
                }

                let _lastEncodedPolyline = null;
                let _routePickupMarker = null;
                let _routeDropoffMarker = null;

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
                    
                    // Remove previous markers if any
                    if (_routePickupMarker) {
                        _routePickupMarker.setMap(null);
                        _routePickupMarker = null;
                    }
                    if (_routeDropoffMarker) {
                        _routeDropoffMarker.setMap(null);
                        _routeDropoffMarker = null;
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
                        strokeColor: '#111111',
                        strokeOpacity: 1.0,
                        strokeWeight: 4
                    });
                    currentRoutePolyline.setMap(bookingGoogleMap);

                    // Fit map to the route first so we can watch it draw
                    routeBounds = new google.maps.LatLngBounds();
                    decodedPath.forEach(function (pt) { routeBounds.extend(pt); });
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
                        const toLat = parseFloat(fareFirst.to_lat);
                        const toLng = parseFloat(fareFirst.to_lng);

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
                            _routePickupMarker = new google.maps.Marker({
                                position: { lat: fromLat, lng: fromLng },
                                map: bookingGoogleMap,
                                title: 'Pickup',
                                label: {
                                    text: pickupName,
                                    className: 'map-marker-label',
                                },
                                icon: {
                                    url: 'data:image/svg+xml;charset=UTF-8,' + svgPickup,
                                    scaledSize: new google.maps.Size(24, 32),
                                    anchor: new google.maps.Point(12, 32),
                                    labelOrigin: new google.maps.Point(12, -12)
                                }
                            });
                        }
                        if (!isNaN(toLat) && !isNaN(toLng)) {
                            _routeDropoffMarker = new google.maps.Marker({
                                position: { lat: toLat, lng: toLng },
                                map: bookingGoogleMap,
                                title: 'Drop-off',
                                label: {
                                    text: dropoffName,
                                    className: 'map-marker-label',
                                },
                                icon: {
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
    <section class="driver-app-section">
        <div class="container">
            <div class="driver-app-card">
                <div class="driver-app-content">
                    <span class="driver-app-badge">DRIVER APP</span>
                    <h2 class="driver-app-title">Take Every Ride Further.<br>Download the GoRide Driver App</h2>
                    <p class="driver-app-subtitle">Manage rides, track earnings, navigate smoothly and grow your business — all from your phone.</p>
                    
                    <div class="driver-app-features">
                        <div class="driver-app-feature-item">
                            <div class="driver-app-feature-icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <div class="driver-app-feature-text">
                                <h3>More Earnings</h3>
                                <p>Get more rides &amp; increase income</p>
                            </div>
                        </div>
                        
                        <div class="driver-app-feature-item">
                            <div class="driver-app-feature-icon">
                                <i class="fas fa-location-arrow"></i>
                            </div>
                            <div class="driver-app-feature-text">
                                <h3>Smart Navigation</h3>
                                <p>Real-time routes &amp; updates</p>
                            </div>
                        </div>
                        
                        <div class="driver-app-feature-item">
                            <div class="driver-app-feature-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div class="driver-app-feature-text">
                                <h3>Performance Stats</h3>
                                <p>Track your trips &amp; earnings</p>
                            </div>
                        </div>
                        
                        <div class="driver-app-feature-item">
                            <div class="driver-app-feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="driver-app-feature-text">
                                <h3>Safe &amp; Secure</h3>
                                <p>Your safety is our priority</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="driver-app-store-btns">
                        <a href="https://play.google.com/store/apps/details?id=com.goride.ukpartner" class="store-btn google-play">
                            <i class="fab fa-google-play"></i>
                            <div class="store-btn-text">
                                <span class="store-btn-sub">GET IT ON</span>
                                <span class="store-btn-title">Google Play</span>
                            </div>
                        </a>
                        <a href="https://apps.apple.com/gb/app/goride-partner/id6791834578" class="store-btn app-store">
                            <i class="fab fa-apple"></i>
                            <div class="store-btn-text">
                                <span class="store-btn-sub">Download on the</span>
                                <span class="store-btn-title">App Store</span>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="driver-app-media">
                    <div class="driver-app-circle-bg"></div>
                    <img src="{{ asset('goride/img/mobile-app.webp') }}" alt="GoRide Driver App" class="driver-app-img">
                </div>
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
                    vehicle type, and confirm your booking. It's that simple to book!</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    What payment methods do you accept?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">We accept all major credit/debit cards (Visa, MasterCard, American Express), Apple Pay, and Google Pay securely processed via Stripe. Choose full payment or part payment at checkout.</div>
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
    <div id="cancelJobModal" class="modal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"
        style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); z-index: 99999; align-items: center; justify-content: center;">
        <div class="modal-dialog" role="document"
            style="background: white; border-radius: 20px; padding: 30px; max-width: 380px; width: 90%; box-shadow: 0 10px 40px rgba(0,0,0,0.2); text-align: center;">
            <div class="modal-content" style="border: none;">
                <div
                    style="width: 60px; height: 60px; background: #fff0f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <i class="fas fa-exclamation-triangle" style="color: #dc3545; font-size: 24px;"></i>
                </div>
                <h4 style="margin: 0 0 10px; font-weight: 700; color: #333; font-size: 22px;">Cancel Job?</h4>
                <p style="color: #666; font-size: 15px; line-height: 1.5; margin-bottom: 15px;">
                    Are you sure you want to cancel this booking? This action cannot be undone.
                </p>
                <textarea id="cancelJobReason" rows="3" placeholder="Reason for cancellation (optional)"
                    style="width: 100%; box-sizing: border-box; border: 1px solid #ddd; border-radius: 10px; padding: 12px; margin-bottom: 25px; font-family: inherit; font-size: 14px; resize: none; background: #fafafa;"></textarea>
                <div style="display: flex; gap: 12px; justify-content: center;">
                    <button type="button" onclick="confirmCancelJob(this)"
                        style="flex: 1; padding: 12px 0; border-radius: 10px; border: none; background: #dc3545; color: white; font-weight: 600; font-size: 15px; cursor: pointer; box-shadow: 0 2px 8px rgba(220,53,69,0.3);">
                        Yes, Cancel
                    </button>
                    <button type="button" onclick="hideCancelJobModal()"
                        style="flex: 1; padding: 12px 0; border-radius: 10px; border: 1px solid #ddd; background: #fff; color: #333; font-weight: 600; font-size: 15px; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                        Keep It
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Prevent outside click from closing any modal or popup on uk-car-booking
        (function () {
            function preventOutsideModalClose(e) {
                const modalOverlay = e.target.closest('.modal, .modal-uber, #authLoginModal, .auth-modal-backdrop, #cancelJobModal');
                if (modalOverlay) {
                    const isInsideContent = e.target.closest('.modal-content-uber, .auth-modal-card, .modal-content, .modal-dialog');
                    const isCloseBtn = e.target.closest('.btn-close, .for-me-close-btn, .app-promo-close, .auth-modal-close, [data-bs-dismiss="modal"]');

                    if (!isInsideContent && !isCloseBtn) {
                        e.stopPropagation();
                        if (e.stopImmediatePropagation) e.stopImmediatePropagation();
                        e.preventDefault();
                        return false;
                    }
                }
            }

            document.addEventListener('click', preventOutsideModalClose, true);
            document.addEventListener('mousedown', preventOutsideModalClose, true);
            document.addEventListener('touchstart', preventOutsideModalClose, true);

            document.addEventListener('DOMContentLoaded', function () {
                if (typeof $ !== 'undefined') {
                    $('.modal').attr('data-bs-backdrop', 'static').attr('data-bs-keyboard', 'false');
                    $('.auth-modal-backdrop').removeAttr('onclick');
                    $(document).on('hide.bs.modal', '.modal', function (e) {
                        if (e.trigger === 'backdropClick') {
                            e.preventDefault();
                        }
                    });
                }
            });
        })();

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

            fetch('{{env("API_URL")}}' + '/cancel-job', {
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

                        // Show a full-screen loading overlay to prevent empty UI flash
                        $('<div style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:99999;display:flex;align-items:center;justify-content:center;"><i class="fas fa-spinner fa-spin fa-3x" style="color:#fff;"></i></div>').appendTo('body');

                        setTimeout(() => {
                            if (typeof BookingStore !== 'undefined' && BookingStore.clear) {
                                BookingStore.clear();
                            }
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