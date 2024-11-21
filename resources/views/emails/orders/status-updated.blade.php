<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status Updated</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        .content {
            padding: 20px;
            background-color: #f7f7f7;
            border-radius: 5px;
            color: #333;
        }
        .header {
            background-color: #0074a1;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .footer {
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="header">
            <!-- Add logo at the top -->
            <img src="{{ asset('assets/media/logo.png') }}" alt="Your Company Logo" class="logo">
            <h2>Order Status Update</h2>
        </div>

        <p>Dear {{ $order->user->name }},</p>
        <p>Your order (ID: {{ $order->id }}) status has been updated to <strong>{{ ucfirst($order->status) }}</strong>.</p>

        <p>If you have any questions regarding your order, feel free to contact our support team.</p>

        <p>Thank you for shopping with us!</p>

        <div class="footer">
            <p>&copy; {{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
