<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoRide | Tax Invoice</title>
    @php
        $requestedHost = request()->header('X-Forwarded-Host', request()->getHost());
        $faviconUrl = ($requestedHost === 'uk.goride.run')
            ? 'https://uk.goride.run/goride/img/Go-Ride-fav-icon.webp'
            : env('WEBSITE_APP_URL') . env('COUNTRY_SLUG_II') . '/goride/img/Go-Ride-fav-icon.webp';
    @endphp
    <link rel="shortcut icon" href="{{ $faviconUrl }}" />
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8f9fa;
            color: #111827;
            padding: 10px 8px;
            margin: 0;
        }

        .main-wrapper {
            max-width: 860px;
            margin: 0 auto;
        }

        /* Invoice Container Sheet */
        .invoice-sheet {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            padding: 20px 28px;
            margin-bottom: 0;
        }

        /* Top Header Info Bar */
        .invoice-top-contact {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 10px;
            border-bottom: 1.5px solid #111827;
            gap: 10px;
        }

        .invoice-logo-wrapper {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
        }

        .invoice-brand-logo {
            height: 42px;
            width: auto;
        }

        .invoice-title-block {
            flex: 1;
            text-align: center;
            margin: 0;
        }

        .invoice-main-title {
            font-size: 20px;
            font-weight: 800;
            color: #059669;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 0;
        }

        .invoice-contact-block {
            flex: 0 0 auto;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 2px;
        }

        .contact-info-item {
            font-size: 13px;
            font-weight: 700;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }

        /* Invoice Customer & Details Meta Grid */
        .invoice-details-grid {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 14px;
            margin-bottom: 14px;
            gap: 16px;
        }

        .customer-meta-box {
            flex: 1;
        }

        .customer-name {
            font-size: 14px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 2px;
        }

        .customer-address {
            font-size: 12px;
            font-weight: 500;
            color: #4b5563;
            line-height: 1.4;
        }

        .invoice-meta-box {
            text-align: right;
        }

        .meta-line {
            font-size: 12px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 3px;
        }

        .meta-line strong {
            color: #111827;
            font-weight: 800;
        }

        /* Main Details Table Desktop */
        .invoice-table-responsive {
            overflow-x: auto;
            margin-bottom: 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1.5px solid #d1d5db;
            padding: 8px 10px;
            vertical-align: top;
        }

        .invoice-table th {
            background-color: #e5e7eb;
            color: #111827;
            font-size: 12px;
            font-weight: 800;
            text-align: center;
        }

        .invoice-table .col-job {
            width: 12%;
            text-align: center;
            font-weight: 700;
            font-size: 12px;
        }

        .invoice-table .col-datetime {
            width: 20%;
            text-align: center;
            font-size: 12px;
            font-weight: 600;
        }

        .invoice-table .col-description {
            width: 44%;
            font-size: 12px;
            line-height: 1.4;
            word-break: break-word;
            overflow-wrap: anywhere;
            white-space: normal;
        }

        .invoice-table .col-cost,
        .invoice-table .col-total {
            width: 12%;
            text-align: right;
            font-size: 12px;
            font-weight: 700;
        }

        .desc-row-item {
            margin-bottom: 2px;
            color: #111827;
            word-break: break-word;
            overflow-wrap: anywhere;
            white-space: normal;
        }

        .desc-row-item:last-child {
            margin-bottom: 0;
        }

        .desc-label {
            font-weight: 700;
            color: #111827;
        }

        .desc-value {
            font-weight: 600;
            color: #374151;
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        .mobile-cell-label {
            display: none;
        }

        /* Financial Summary Table */
        .summary-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-top: -1.5px;
        }

        .summary-table {
            width: 100%;
            max-width: 440px;
            border-collapse: collapse;
        }

        .summary-table td {
            border: 1.5px solid #d1d5db;
            padding: 6px 10px;
            font-size: 12px;
        }

        .summary-label-cell {
            font-weight: 700;
            color: #111827;
            text-align: left;
            width: 65%;
        }

        .summary-value-cell {
            font-weight: 700;
            color: #111827;
            text-align: right;
            width: 35%;
        }

        .total-highlight-label {
            color: #059669;
            font-weight: 800;
            font-size: 13px;
        }

        .total-highlight-value {
            color: #111827;
            font-weight: 800;
            font-size: 13px;
        }

        /* Footer & Guarantee Notes */
        .invoice-footer-notes {
            margin-top: 14px;
            padding-top: 8px;
            border-top: 1px dashed #e5e7eb;
            text-align: center;
        }

        .footer-thankyou {
            font-size: 12px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 2px;
        }

        .footer-company-info {
            font-size: 11px;
            color: #6b7280;
            margin-bottom: 0;
        }

        /* Responsive Mobile Breakpoints */
        @media (max-width: 768px) {
            body {
                padding: 6px 4px;
            }

            .invoice-sheet {
                padding: 14px 10px;
                border-radius: 8px;
            }

            /* Responsive Mobile Header: Top Row (Logo + Title), Bottom Row (Email + Phone brought down) */
            .invoice-top-contact {
                flex-wrap: wrap;
                justify-content: space-between;
                align-items: center;
                padding-bottom: 8px;
                gap: 6px;
            }

            .invoice-logo-wrapper {
                flex: 0 0 auto;
            }

            .invoice-title-block {
                flex: 0 0 auto;
                text-align: right;
                margin: 0;
            }

            .invoice-main-title {
                font-size: 18px;
                letter-spacing: 1.5px;
            }

            .invoice-contact-block {
                width: 100%;
                justify-content: space-between;
                align-items: start;
                border-top: 1px dashed #e5e7eb;
                padding-top: 6px;
                margin-top: 2px;
            }

            .contact-info-item {
                font-size: 12px;
                gap: 3px;
            }

            /* Customer & Invoice Meta Grid Mobile */
            .invoice-details-grid {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: flex-start;
                gap: 8px;
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .customer-name {
                font-size: 13px;
            }


            /* Mobile Card Transformation for Details Table */
            .invoice-table-responsive {
                overflow-x: visible;
            }

            .invoice-table,
            .invoice-table tbody,
            .invoice-table tr,
            .invoice-table td {
                display: block;
                width: 100% !important;
                box-sizing: border-box;
            }

            .invoice-table thead {
                display: none !important;
            }

            .invoice-table tr {
                background: #f9fafb;
                border: 1.5px solid #d1d5db;
                border-radius: 8px;
                margin-bottom: 10px;
                padding: 8px 10px;
            }

            .invoice-table td {
                border: none !important;
                border-bottom: 1px dashed #e5e7eb !important;
                padding: 5px 0 !important;
                font-size: 11px;
            }

            .invoice-table td:last-child {
                border-bottom: none !important;
            }

            .invoice-table .col-job,
            .invoice-table .col-datetime,
            .invoice-table .col-description,
            .invoice-table .col-cost,
            .invoice-table .col-total {
                width: 100% !important;
                text-align: left !important;
            }

            .mobile-cell-label {
                display: inline-block;
                font-weight: 700;
                color: #111827;
                margin-right: 4px;
            }

            .mobile-flex-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            /* Summary Table Mobile */
            .summary-wrapper {
                justify-content: stretch;
                margin-top: 0;
            }

            .summary-table {
                width: 100%;
                max-width: 100%;
            }

            .summary-table td {
                padding: 5px 8px;
           
            }
        }

        /* Print Media Styles */
        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                color: #000000 !important;
            }

            .main-wrapper {
                max-width: 100% !important;
                width: 100% !important;
            }

            .invoice-sheet {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                border-radius: 0 !important;
            }

            .invoice-table,
            .invoice-table tbody,
            .invoice-table tr,
            .invoice-table td {
                display: table-cell !important;
            }

            .invoice-table tr {
                display: table-row !important;
                background: none !important;
                border: none !important;
                padding: 0 !important;
            }

            .invoice-table thead {
                display: table-header-group !important;
            }

            .mobile-cell-label {
                display: none !important;
            }

            .invoice-table th,
            .invoice-table td {
                border: 1.5px solid #d1d5db !important;
                padding: 8px 10px !important;
            }

            .invoice-table th {
                background-color: #e5e7eb !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .invoice-main-title {
                color: #059669 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>

    <div class="main-wrapper">

        <!-- Main Invoice Paper Container -->
        <div class="invoice-sheet">

            <!-- 1. Header Contact, Title & Logo Row -->
            <div class="invoice-top-contact">
                <!-- Left Logo -->
                <div class="invoice-logo-wrapper">
                    <img src="https://www.goride.net.in/goride/img/logo-dark.png" alt="GoRide Logo" class="invoice-brand-logo">
                </div>

                <!-- Center Title -->
                <div class="invoice-title-block">
                    <h1 class="invoice-main-title">INVOICE</h1>
                </div>

                <!-- Right Contact Details (Email, Phone below Email) -->
                <div class="invoice-contact-block">
                    <div class="contact-info-item">
                        <span>Email :</span> <strong>support@goride.run</strong>
                    </div>
                    <div class="contact-info-item">
                        <span>Phone :</span> <strong>+44 20 4635 9888</strong>
                    </div>
                </div>
            </div>

            <!-- 2. Customer & Invoice Metadata Grid -->
            <div class="invoice-details-grid">
                <!-- Customer Details (Left) -->
                <div class="customer-meta-box">
                    <div class="customer-name">James Wilson
</div>
                    <div class="customer-address">
                        444 Brixton Road,<br>
                        London, UK
                    </div>
                </div>

                <!-- Invoice Metadata (Right) -->
                <div class="invoice-meta-box">
                    <div class="meta-line">VAT No : <strong>485216870</strong></div>
                    <div class="meta-line">Invoice No : <strong>INP124</strong></div>
                    <div class="meta-line">Invoice Date : <strong>22-Jul-2026</strong></div>
                    <div class="meta-line">Payment Method : <strong>Card</strong></div>
                </div>
            </div>

            <!-- 3. Job Items Table -->
            <div class="invoice-table-responsive">
                <table class="invoice-table">
                    <thead>
                        <tr>
                            <th class="col-job">Job No</th>
                            <th class="col-datetime">Pickup Date &amp; Time</th>
                            <th class="col-description">Description</th>
                            <th class="col-cost">Cost</th>
                            <th class="col-total">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-job">
                                <div class="mobile-flex-row">
                                    <span class="mobile-cell-label">Job No:</span>
                                    <span>BE01670</span>
                                </div>
                            </td>
                            <td class="col-datetime">
                                <div class="mobile-flex-row">
                                    <span class="mobile-cell-label">Pickup Date &amp; Time:</span>
                                    <span>24-07-2026 00:10</span>
                                </div>
                            </td>
                            <td class="col-description">
                                <div class="desc-row-item">
                                    <span class="desc-label">Passenger Name :</span>
                                    <span class="desc-value">James Wilson
</span>
                                </div>
                                <div class="desc-row-item">
                                    <span class="desc-label">From :</span>
                                    <span class="desc-value">Heathrow Airport Terminal 5, Terminal Drop-Off Zone, London, UK</span>
                                </div>
                                <div class="desc-row-item">
                                    <span class="desc-label">To :</span>
                                    <span class="desc-value">Hilton London Gatwick Airport, South Terminal, Crawley RH6 0LL, United Kingdom</span>
                                </div>
                                <div class="desc-row-item">
                                    <span class="desc-label">Vehicle :</span>
                                    <span class="desc-value">Luxury</span>
                                </div>
                            </td>
                            <td class="col-cost">
                                <div class="mobile-flex-row">
                                    <span class="mobile-cell-label">Cost:</span>
                                    <span>£539.10</span>
                                </div>
                            </td>
                            <td class="col-total">
                                <div class="mobile-flex-row">
                                    <span class="mobile-cell-label">Total:</span>
                                    <span>£539.10</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- 4. Financial Calculations / Totals Breakdown -->
            <div class="summary-wrapper">
                <table class="summary-table">
                    <tbody>
                        <tr>
                            <td class="summary-label-cell">Sub Total (Excl. VAT)</td>
                            <td class="summary-value-cell">£449.25</td>
                        </tr>
                        <tr>
                            <td class="summary-label-cell">VAT @ 20%</td>
                            <td class="summary-value-cell">£89.85</td>
                        </tr>
                        <tr>
                            <td class="summary-label-cell total-highlight-label">Total Amount (Incl. VAT)</td>
                            <td class="summary-value-cell total-highlight-value">£539.10</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- 5. Invoice Footer & Thank You Note -->
            <div class="invoice-footer-notes">
                <div class="footer-thankyou">Thank you for choosing GoRide!</div>
                
            </div>

        </div>

    </div>

</body>

</html>
