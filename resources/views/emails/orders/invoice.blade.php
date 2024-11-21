<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Invoice</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            background-color: #ffffff;
            padding: 30px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            height: 100px;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
            color: #0074a1;
        }
        .header p {
            margin: 10px 0 20px;
            color: #666;
        }
        .order-details h3 {
            margin-top: 0;
            color: #0074a1;
        }
        .order-info {
            font-size: 14px;
            color: #333;
            margin-bottom: 20px;
        }
        .order-info p {
            margin: 5px 0;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table th, .items-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .items-table th {
            background-color: #f8f8f8;
        }
        .summary {
            margin-top: 20px;
            text-align: right;
        }
        .summary h4 {
            margin: 0;
            font-size: 16px;
            color: #0074a1;
        }
        .summary p {
            margin: 5px 0;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #0074a1;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #065675;
            color: #fff;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #999;
            font-size: 12px;
        }
        .footer p {
            margin: 10px 0;
        }
        .footer a {
            color: #065675;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .ActionButton {
            padding: 12px 25px;
            background-color: #0074a1;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <!-- Header Section -->
        <div class="header">
            <img src="{{ asset('assets/media/logo.png') }}" alt="Logo">
            <h2>Order Invoice - #{{ $order->id }}</h2>
            <p>
                {{ str_replace('_', ' ', ucfirst($order->status)) }} on {{ $order->created_at->format('M d, Y') }}
            </p>
        </div>

        <!-- Order Shipping Details -->
        <div class="order-details">
            <h3>Shipping Information</h3>
            <div class="order-info">
                <p><strong>Address:</strong> {{ $order->address_line_1 }} @if($order->address_line_2) , {{ $order->address_line_2 }} @endif</p>
                <p><strong>City:</strong> {{ $order->city }}</p>
                <p><strong>State:</strong> {{ $order->state }}</p>
                <p><strong>ZIP Code:</strong> {{ $order->zip_code }}</p>
                <p><strong>Country:</strong> {{ $order->country }}</p>
            </div>
        </div>

        <!-- Order Items Table -->
        <h3>Order Items</h3>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Product Name</th>
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

        <!-- Summary Section -->
        <div class="summary">
            <h4>Order Summary</h4>
            <p><strong>Subtotal:</strong> {{ number_format($order->items->sum('total'), 2) }} JOD</p>
            <p><strong>Fee:</strong> {{ number_format($order->fee, 2) }} JOD</p>
            <p><strong>Discount:</strong> -{{ number_format($order->discount, 2) }} JOD</p>
            <p><strong>Total:</strong> {{ number_format($order->total, 2) }} JOD</p>
        </div>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>. All rights reserved.</p>
    </div>

</body>
</html>
