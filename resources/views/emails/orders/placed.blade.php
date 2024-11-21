<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            margin: 0;
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
        .order-details {
            margin-bottom: 30px;
        }
        .order-details h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 10px;
        }
        .order-details p {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
        }
        .order-summary {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .order-summary h3 {
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
        .total {
            font-weight: bold;
            color: #333;
        }
        .cta-button {
            display: inline-block;
            width: 200px;
            padding: 12px 20px;
            text-align: center;
            background-color: #1077af;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            margin: 0 auto 20px;
            text-transform: uppercase;
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
    </style>
</head>
<body>

    <div class="email-container">
        <!-- Header Section -->
        <div class="header">
            <img src="{{ asset('assets/media/logo.png') }}" alt="Logo">
            <h1>Thank You for Your Order!</h1>
            <p>Your order has been successfully processed. Here are the details:</p>
        </div>

        <!-- Order Details Section -->
        <div class="order-details">
            <h2>Order #{{ $order->id }} Details</h2>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
            <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
            <p><strong>Status:</strong> {{ str_replace('_', ' ', ucfirst($order->status)) }}</p>
        </div>

        <!-- Order Summary Section -->
        <div class="order-summary">
            <h3>Order Summary</h3>
            <table class="summary-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price (JOD)</th>
                        <th>Total (JOD)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price, 2) }}</td>
                            <td>{{ number_format($item->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="total">Total: {{ number_format($order->total, 2) }} JOD</p>
        </div>

        <!-- Call to Action Button -->
        <a href="{{ route('orders.show', $order->id) }}" class="cta-button">View Your Order</a>

        <!-- Footer Section -->
        <div class="footer">
            <p>If you have any questions, feel free to contact us at <a href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a></p>
            <p>Visit our website: <a href="{{ url('/') }}">{{ url('/') }}</a></p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
