<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product Arrival</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap');

        body {
            font-family: 'Cairo', sans-serif;
            margin-top: 10px;
            padding: 0;
            background-color: #f8f8f8;
            color: #333;
        }
        .email-container {
            width: 100%;
            max-width: 650px;
            background-color: #ffffff;
            padding: 40px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            width: 120px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 10px;
        }
        .header p {
            font-size: 16px;
            color: #777;
            margin-bottom: 20px;
        }
        /* Italicized New Arrival Ribbon */
        .new-arrival-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #1077af;
            color: #fff;
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 5px;
            font-weight: bold;
            text-transform: uppercase;
            font-style: italic;
            transform: rotate(45deg);
            margin-top: 30px;
            margin-right: -50px;
            transform-origin: top right;
            white-space: nowrap;
        }
        .product-card {
            overflow: hidden;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            width: 90%; /* Reduced width to make the card smaller */
            margin-left: auto;
            margin-right: auto;
        }
        .product-card img {
            width: 100%;
            height: auto;
        }
        .product-details {
            padding: 20px;
        }
        .product-details h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 10px;
        }
        .product-details p {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
        }
        .product-summary {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .product-summary h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }
        .summary-table th, .summary-table td {
            padding: 12px;
            text-align: left;
            font-size: 16px;
            color: #333;
        }
        .summary-table th {
            background-color: #f1f1f1;
        }
        .summary-table td {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }
        .cta-button {
            display: inline-block;
            padding: 12px 20px;
            text-align: center;
            background-color: #1077af;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            width: 200px;
            text-transform: uppercase;
            margin: 20px auto 0;
            margin-bottom: 20px;
            margin-top: 20px;
            display: block;
        }
        .cta-button:hover {
            background-color: #095e84;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
        }
        .footer p {
            margin: 10px 0;
        }
        .footer a {
            color: #1077af;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .total {
            font-weight: bold;
            color: #1077af;
        }

    </style>
</head>
<body>

    <div class="email-container">
        <!-- New Arrival Badge -->
        <div class="new-arrival-badge">New Arrival!</div>

        <!-- Header Section -->
        <div class="header">
            <img src="{{ asset('assets/media/logo.png') }}" alt="Logo">
            <h1>New Product Arrival!</h1>
            <p>We’re excited to introduce our newest product! Check out all the details below.</p>
        </div>

        <!-- Product Card Section -->
        <div class="product-card">
            <img src="{{ $product->cover }}" alt="Product Image">
            <div class="product-details">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>

                <!-- Check if discount exists and display it -->
                @if($product->discount)
                    <p><strong>Price (After Discount):</strong> {{ number_format($product->price, 2) }} JOD</p>
                    <p><strong>Discount You Save:</strong> {{ number_format($product->discount, 2) }} JOD</p>
                    <p><strong>Original Price:</strong> {{ number_format($product->price + $product->discount, 2) }} JOD</p>
                @else
                    <p><strong>Price:</strong> {{ number_format($product->price, 2) }} JOD</p>
                @endif
            </div>
        </div>

        <!-- CTA Button -->
        <a href="{{ route('product', $product['id']) }}" class="cta-button">Check it out now!</a>

        <!-- Footer Section -->
        <div class="footer">
            <p>If you have any questions, feel free to contact us at <a href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a></p>
            <p>Visit our website: <a href="{{ url('/') }}">{{ url('/') }}</a></p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
