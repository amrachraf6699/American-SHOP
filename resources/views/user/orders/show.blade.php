@extends('layouts.app')
@section('title', 'Order Details')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg rounded-lg border-0 m-4">
                    <div class="card-header text-white d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">Order Details</h4>
                            <p class="mb-0 text-sm">Order ID: #{{ $order->id }}</p>
                            <p class="mb-0 text-sm">Placed on {{ $order->created_at->format('M d, Y - h:i A') }}</p>
                        </div>
                        <div>
                            <button class="btn btn-light btn-sm me-2" onclick="window.print()">
                                <i class="fas fa-print"></i> Print
                            </button>
                            <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-light btn-sm">
                                <i class="fas fa-envelope"></i> Send Invoice
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <!-- Status -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center">
                                <span class="badge
                                    @switch($order->status)
                                        @case('awaiting_payment') bg-warning @break
                                        @case('paid') bg-primary @break
                                        @case('shipped') bg-info @break
                                        @case('delivered') bg-success @break
                                        @case('canceled') bg-danger @break
                                        @default bg-secondary
                                    @endswitch
                                ">
                                    {{ str_replace('_', ' ', ucfirst($order->status)) }}
                                </span>
                            </div>
                        </div>

                        <!-- Shipping Details -->
                        <div class="mb-4">
                            <h5 class="fw-bold text-uppercase">Shipping Information</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Address Line 1:</strong> {{ $order->address_line_1 }}</p>
                                    <p><strong>Address Line 2:</strong> {{ $order->address_line_2 ?? 'N/A' }}</p>
                                    <p><strong>City:</strong> {{ $order->city }}</p>
                                    <p><strong>State:</strong> {{ $order->state }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>ZIP Code:</strong> {{ $order->zip_code }}</p>
                                    <p><strong>Country:</strong> {{ $order->country }}</p>
                                    <p><strong>Phone:</strong> {{ $order->phone ?? 'N/A' }}</p>
                                    <p><strong>Email:</strong> {{ $order->email ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="mb-4">
                            <h5 class="fw-bold text-uppercase">Payment Information</h5>
                            <p><strong>Payment ID:</strong> {{ $order->payment_id ?? 'N/A' }}</p>
                            <p><strong>Total Amount:</strong> {{ number_format($order->total, 2) }} JOD</p>
                        </div>

                        <!-- Items Table -->
                        <h5 class="fw-bold text-uppercase mb-3">Order Items</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-end">Subtotal:</th>
                                        <th> {{ number_format($order->items->sum('total'), 2) }} JOD</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-end">Fee:</th>
                                        <th> {{ number_format($order->fee, 2) }} JOD</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-end">Discount:</th>
                                        <th> -{{ number_format($order->discount, 2) }} JOD</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-end">Total:</th>
                                        <th> {{ number_format($order->total, 2) }} JOD</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Actions -->
                        <div class="text-end mt-4">
                            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                                <i class="bx bx-arrow-back"></i> Back to Orders
                            </a>
                            @if ($order->status == 'awaiting_payment')
                                <a href="#" class="btn btn-success">
                                    <i class="bx bx-credit-card"></i> Pay Now
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .badge {
            font-size: 0.9rem;
            padding: 0.5em 1em;
        }

        @media print {
            .btn, .card-header {
                display: none !important;
            }

            .card {
                border: none;
                box-shadow: none;
            }

            body {
                background-color: white !important;
            }
        }

        .card-header {
            background-color: #161C2D !important;
        }
    </style>
@endsection
