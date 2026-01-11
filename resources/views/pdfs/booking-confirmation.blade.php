<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - {{ $booking->booking_reference }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 10px;
        }
        .subtitle {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 5px;
        }
        .booking-number {
            font-size: 18px;
            font-weight: bold;
            color: #059669;
            background: #d1fae5;
            padding: 8px 16px;
            border-radius: 20px;
            display: inline-block;
            margin-top: 10px;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #1f2937;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }
        .info-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }
        .info-row {
            display: table-row;
        }
        .info-label {
            display: table-cell;
            font-weight: bold;
            color: #4b5563;
            width: 35%;
            padding: 8px 0;
            vertical-align: top;
        }
        .info-value {
            display: table-cell;
            padding: 8px 0;
            vertical-align: top;
        }
        .package-details {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .price-summary {
            background: #f0f9ff;
            border: 1px solid #0ea5e9;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: #059669;
            text-align: right;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }
        .contact-info {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        .status-confirmed {
            color: #059669;
            font-weight: bold;
        }
        .status-pending {
            color: #d97706;
            font-weight: bold;
        }
        .status-cancelled {
            color: #dc2626;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">Thambapanni Travel</div>
        <div class="subtitle">Your Gateway to Sri Lanka</div>
        <div class="subtitle">Discover the Magic of the Pearl of the Indian Ocean</div>
        <div class="booking-number">{{ $booking->booking_reference }}</div>
    </div>

    <div class="section">
        <div class="section-title">Booking Confirmation</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Booking Date:</div>
                <div class="info-value">{{ $booking->created_at->format('F j, Y') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Travel Date:</div>
                <div class="info-value">{{ $booking->travel_date->format('F j, Y') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Status:</div>
                <div class="info-value">
                    <span class="status-{{ strtolower($booking->booking_status) }}">
                        {{ ucfirst($booking->booking_status) }}
                    </span>
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Payment Status:</div>
                <div class="info-value">
                    <span class="status-{{ strtolower($booking->payment_status) }}">
                        {{ ucfirst($booking->payment_status) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Traveler Information</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Full Name:</div>
                <div class="info-value">{{ $booking->user->name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value">{{ $booking->user->email }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Phone:</div>
                <div class="info-value">{{ $booking->user->phone ?? 'Not provided' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Address:</div>
                <div class="info-value">{{ $booking->user->address ?? 'Not provided' }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Package Details</div>
        <div class="package-details">
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Package Name:</div>
                    <div class="info-value">{{ $booking->package->name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Destination:</div>
                    <div class="info-value">{{ $booking->package->location }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Duration:</div>
                    <div class="info-value">{{ $booking->package->duration }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Description:</div>
                    <div class="info-value">{{ $booking->package->description }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Highlights:</div>
                    <div class="info-value">
                        @if($booking->package->highlights)
                            {{ implode(', ', $booking->package->highlights) }}
                        @else
                            Not specified
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Booking Details</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Number of Travelers:</div>
                <div class="info-value">{{ $booking->travelers_count }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Special Requirements:</div>
                <div class="info-value">{{ $booking->special_requests ?? 'None' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Additional Notes:</div>
                <div class="info-value">{{ $booking->notes ?? 'None' }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Pricing Summary</div>
        <div class="price-summary">
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Package Price (per person):</div>
                    <div class="info-value">${{ number_format($booking->package->price, 2) }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Number of Travelers:</div>
                    <div class="info-value">{{ $booking->travelers_count }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Subtotal:</div>
                    <div class="info-value">${{ number_format($booking->package->price * $booking->travelers_count, 2) }}</div>
                </div>
                @if($booking->discount_amount > 0)
                <div class="info-row">
                    <div class="info-label">Discount:</div>
                    <div class="info-value">-${{ number_format($booking->discount_amount, 2) }}</div>
                </div>
                @endif
                <div class="info-row">
                    <div class="info-label">Total Amount:</div>
                    <div class="info-value total-amount">${{ number_format($booking->total_amount, 2) }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-info">
        <div class="section-title">Need Help?</div>
        <p>If you have any questions about your booking or need to make changes, please don't hesitate to contact us:</p>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value">info@thambapannitravel.com</div>
            </div>
            <div class="info-row">
                <div class="info-label">Phone:</div>
                <div class="info-value">+94 11 234 5678</div>
            </div>
            <div class="info-row">
                <div class="info-label">WhatsApp:</div>
                <div class="info-value">+94 77 123 4567</div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p><strong>Thank you for choosing Thambapanni Travel!</strong></p>
        <p>We're excited to show you the beauty and wonder of Sri Lanka.</p>
        <p>This confirmation was generated on {{ now()->format('F j, Y \a\t g:i A') }}</p>
        <p>© {{ date('Y') }} Thambapanni Travel. All rights reserved.</p>
    </div>
</body>
</html>
