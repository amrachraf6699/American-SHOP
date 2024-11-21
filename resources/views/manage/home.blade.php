@extends('manage.layout')
@section('title', 'Dashboard')

@section('content')
<div class="col-lg-12 mb-4 order-0">
    <div class="card shadow-sm">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Welcome Back, {{ auth()->user()->name }}! 🎉</h5>
            <p class="mb-4">
              You have earned <span class="fw-bold">{{ number_format($revenueToday, 2) }} JOD</span> in sales today. Keep up the great work! 🚀
            </p>
          </div>
        </div>
        <div class="col-sm-5 text-center">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{ asset('admin/assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User">
          </div>
        </div>
      </div>
    </div>
</div>

<div class="container">
    <!-- Status Cards -->
    <div class="row mb-4 g-4">
        <!-- Total Users Card -->
        <div class="col-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar">
                            <i class="bx bx-user-circle text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="ms-3 mb-0">Total Users</h6>
                    </div>
                    <h3 class="fw-bold">{{ $totalUsers - 1 }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Categories Card -->
        <div class="col-3">
            <div class="card h-100 shadow-sm text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar">
                            <i class="bx bx-category text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="ms-3 mb-0">Total Categories</h6>
                    </div>
                    <h3 class="fw-bold">{{ $totalCategories }}</h3>
                </div>
            </div>
        </div>


        <!-- Total Categories Card -->
        <div class="col-3">
            <div class="card h-100 shadow-sm text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar">
                            <i class="bx bx-news text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="ms-3 mb-0">Subscribers to Newsletter</h6>
                    </div>
                    <h3 class="fw-bold">{{ $totalSubscribers }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Products Card -->
        <div class="col-3">
            <div class="card h-100 shadow-sm text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar">
                            <i class="bx bx-package text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="ms-3 mb-0">Total Products</h6>
                    </div>
                    <h3 class="fw-bold">{{ $totalProducts }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Orders Card -->
        <div class="col-3">
            <div class="card h-100 shadow-sm text-dark">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar">
                            <i class="bx bx-cart text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="ms-3 mb-0">Total Orders</h6>
                    </div>
                    <h3 class="fw-bold">{{ $totalOrders }}</h3>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card h-100 shadow-sm text-dark">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar">
                            <i class="bx bx-calendar-check text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="ms-3 mb-0">Orders Today</h6>
                    </div>
                    <h3 class="fw-bold">{{ $ordersToday }}</h3>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card h-100 shadow-sm text-dark">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar">
                            <i class="bx bx-calendar text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="ms-3 mb-0">Orders This Month</h6>
                    </div>
                    <h3 class="fw-bold">{{ $ordersThisMonth }}</h3>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card h-100 shadow-sm text-dark">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar">
                            <i class="bx bx-calendar text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="ms-3 mb-0">Orders This Year</h6>
                    </div>
                    <h3 class="fw-bold">{{ $ordersThisYear }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4 g-4">
        <!-- Total Users Card -->
        <div class="col-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar">
                            <i class="bx bx-coin-stack text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="ms-3 mb-0">Total Revenue</h6>
                    </div>
                    <h3 class="fw-bold">{{ $totalRevenue }} JOD</h3>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar">
                            <i class="bx bx-coin-stack text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="ms-3 mb-0">Revenue Today</h6>
                    </div>
                    <h3 class="fw-bold">{{ $revenueToday }} JOD</h3>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar">
                            <i class="bx bx-coin-stack text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="ms-3 mb-0">Revenue This Month</h6>
                    </div>
                    <h3 class="fw-bold">{{ $revenueThisMonth }} JOD</h3>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
