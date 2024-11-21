@extends('manage.layout')
@section('title', 'Orders List')
@section('content')
<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="row g-3">
            <!-- Order ID Filter -->
            <div class="col-md-4 col-lg-4">
                <label for="order_id" class="form-label">Order ID</label>
                <input type="text" id="order_id" class="form-control" name="order_id" placeholder="Order ID" value="{{ request('order_id') }}">
            </div>

            <!-- Status Filter -->
            <div class="col-md-4 col-lg-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="">All Statuses</option>
                    <option value="awaiting_payment" {{ request('status') == 'awaiting_payment' ? 'selected' : '' }}>Awaiting Payment</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
            </div>

            <!-- Date Filters -->
            <div class="col-md-4 col-lg-4">
                <label class="form-label">Order Date</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="order_start" value="{{ request('order_start') }}">
                    <span class="input-group-text">-</span>
                    <input type="date" class="form-control" name="order_end" value="{{ request('order_end') }}">
                </div>
            </div>

            <!-- Filter and Clear Buttons -->
            <div class="col-12 d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-primary mx-2">Filter</button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mx-2">Clear</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Orders Table ({{ $orders->total() }})</h5>
    </div>

    @if($orders->isEmpty())
        <div class="card-body">
            <div class="text-center">
                <h4>No Orders Yet</h4>
            </div>
        </div>
    @else
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Ordered At</th>
                    <th>Last Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>
                            <span class="badge badge-center rounded-pill bg-label-{{
                                $order->status == 'awaiting_payment' ? 'warning' :
                                ($order->status == 'paid' ? 'success' :
                                ($order->status == 'shipped' ? 'info' :
                                ($order->status == 'delivered' ? 'primary' : 'danger')))
                            }}">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </td>
                        <td>JOD {{ $order->total }}</td>
                        <td><span class="me-1">{{ $order->created_at }}</span></td>
                        <td><span class="me-1">{{ $order->updated_at }}</span></td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">
                                <i class="bx bx-run"></i> Track
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <hr class="m-0" />

    <div class="mt-3 d-flex justify-content-center">
        {{ $orders->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
