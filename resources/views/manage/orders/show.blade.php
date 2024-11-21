@extends('manage.layout')
@section('title', 'Order Details')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        <h5 class="mb-0">Order #{{ $order->id }} Details</h5>
    </div>
    <div class="card-body">
        <!-- Order Information -->
        <div class="row mb-4">
            <div class="col-md-6">
                <strong>Order ID:</strong> #{{ $order->id }}
            </div>
            <div class="col-md-6">
                <strong>Status:</strong>
                <span class="bg-label-{{
                    $order->status == 'awaiting_payment' ? 'warning' :
                    ($order->status == 'paid' ? 'primary' :
                    ($order->status == 'shipped' ? 'info' :
                    ($order->status == 'delivered' ? 'success' : 'danger')))
                }}">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}
                <span class="text-muted">({{ $order->created_at->diffForHumans() }})</span>
            </div>
            <div class="col-md-6">
                <strong>Customer:</strong> {{ $order->user->name }} <br>
                <strong>Email:</strong> <a href="mailto:{{ $order->email }}">{{ $order->email }}</a><br>
                <strong>Phone:</strong> {{ $order->phone }}
            </div>
        </div>

        <!-- Order Items -->
        <div class="table-responsive mb-4">
            <h5>Order Items</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>
                                @if ($item->product)
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($item->product->cover) }}" alt="{{ $item->product->name }}" class="img-thumbnail me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                        <a href="{{ route('admin.products.show', $item->product) }}" target="_blank" class="text-decoration-none">{{ $item->product->name }}</a>
                                    </div>
                                @else
                                    {{ $item->name }}
                                @endif
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>JOD {{ number_format($item->product->price, 2) }}</td>
                            <td>JOD {{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Order Totals -->
        <div class="row mb-4">
            <div class="col-md-6">
                <strong>Subtotal:</strong> JOD {{ number_format($order->items->sum('total'), 2) }}
            </div>
            <div class="col-md-6">
                <strong>Shipping:</strong> JOD {{ number_format($order->fee , 2) }}
            </div>
            <div class="col-md-6">
                <strong>Discount:</strong> JOD {{ number_format($order->discount, 2) }}
            </div>
            <div class="col-md-6">
                <strong>Total:</strong> JOD {{ number_format($order->total, 2) }}
            </div>
        </div>

        <!-- Buttons Section -->
        <div class="d-flex justify-content-between">
            <!-- Update Status Button -->
            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Update Status
                    </button>
                    <ul class="dropdown-menu">
                        <li><button class="dropdown-item" type="submit" name="status" value="awaiting_payment">Awaiting Payment</button></li>
                        <li><button class="dropdown-item" type="submit" name="status" value="paid">Paid</button></li>
                        <li><button class="dropdown-item" type="submit" name="status" value="shipped">Shipped</button></li>
                        <li><button class="dropdown-item" type="submit" name="status" value="delivered">Delivered</button></li>
                        <li><button class="dropdown-item" type="submit" name="status" value="canceled">Canceled</button></li>
                    </ul>
                </div>
            </form>

            <!-- Direct Call Button -->
            <a href="tel:{{ $order->phone }}" class="btn btn-primary">
                <i class="bx bx-phone"></i> Direct Call
            </a>

            <!-- Direct Call Button -->
            <a href="#"  onclick="window.print()" class="btn btn-warning">
                <i class="bx bx-printer"></i> Print
            </a>
            <!-- WhatsApp Contact Button -->
            <a href="https://wa.me/{{ $order->phone }}" class="btn btn-success" target="_blank">
                <i class="bx bxl-whatsapp"></i> Contact Via WhatsApp
            </a>

            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                Back to Orders <i class="bx bx-arrow-back"></i>
            </a>
        </div>
    </div>
</div>
@endsection
