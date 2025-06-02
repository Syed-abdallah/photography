<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
        
        body {
            font-family: 'Poppins', Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .booking-details {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .booking-details h2 {
            margin-top: 0;
            color: #764ba2;
            font-size: 20px;
        }
        .detail-item {
            margin-bottom: 10px;
            display: flex;
        }
        .detail-label {
            font-weight: 500;
            min-width: 150px;
            color: #555;
        }
        .detail-value {
            font-weight: 400;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #777;
            font-size: 14px;
        }
        .logo {
            max-width: 180px;
            margin-bottom: 20px;
        }
        .thank-you {
            font-size: 16px;
            margin: 25px 0;
            text-align: center;
        }
        .signature {
            margin-top: 30px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <!-- Replace with your actual logo -->
            <img src="https://via.placeholder.com/180x60?text=Younique" alt="Younique Logo" class="logo">
            <h1>Booking Confirmation</h1>
        </div>
        
        <div class="content">
            <p class="greeting">Hello {{ $booking->name }},</p>
            
            <p>Thank you for choosing Younique! Your booking has been confirmed with the following details:</p>
            
            <div class="booking-details">
                <h2>Booking Information</h2>
                
                <div class="detail-item">
                    <span class="detail-label">Booking Date:</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}</span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Time:</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }} to {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}</span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Number of Guests:</span>
                    <span class="detail-value">{{ $booking->no_of_guest }}</span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Contact Number:</span>
                    <span class="detail-value">{{ $booking->contact_number }}</span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Booking Reference:</span>
                    <span class="detail-value">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
            
            <div class="thank-you">
                <p>We're looking forward to serving you! If you have any questions or need to make changes to your booking, please don't hesitate to contact us.</p>
            </div>
            
            <div class="signature">
                <p>Best regards,<br>
                <strong>The Younique Team</strong></p>
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Younique. All rights reserved.</p>
            {{-- <p>Address: 123 Beauty Street, Cosmetic City | Phone: (123) 456-7890</p> --}}
        </div>
    </div>
</body>
</html>