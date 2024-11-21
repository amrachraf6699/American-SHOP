@extends('manage.layout')
@section('title', 'Coupons List')
@section('content')
<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.coupons.index') }}" class="row g-3">

            <!-- Coupon Code Filter -->
            <div class="col-md-4 col-lg-4">
                <label for="code" class="form-label">Coupon Code</label>
                <input type="text" id="code" class="form-control" name="code" placeholder="Coupon Code" value="{{ request('code') }}">
            </div>

            <!-- Type Filter -->
            <div class="col-md-4 col-lg-4">
                <label for="type" class="form-label">Coupon Type</label>
                <select id="type" class="form-select" name="type">
                    <option value="">Select Type</option>
                    <option value="fixed" {{ request('type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                    <option value="percentage" {{ request('type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                </select>
            </div>

            <!-- Limit Type Filter -->
            <div class="col-md-4 col-lg-4">
                <label for="limit_type" class="form-label">Limit Type</label>
                <select id="limit_type" class="form-select" name="limit_type">
                    <option value="">Select Limit Type</option>
                    <option value="usage" {{ request('limit_type') == 'usage' ? 'selected' : '' }}>Usage</option>
                    <option value="time" {{ request('limit_type') == 'time' ? 'selected' : '' }}>Time</option>
                </select>
            </div>

            <!-- Filter and Clear Buttons -->
            <div class="col-12 d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-primary mx-2">Filter</button>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary mx-2">Clear</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Coupons Table</h5>
        @if($coupons->isEmpty())
        @else
        <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">Create Coupon</a>
        @endif
    </div>

    @if($coupons->isEmpty())
        <div class="card-body">
            <div class="text-center">
                <h4>No Coupons Available</h4>
                <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">Create Coupon</a>
            </div>
        </div>
    @else
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Discount</th>
                    <th>Usage Times</th>
                    <th>Limit Type</th>
                    <th>Usage Limit</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($coupons as $coupon)
                    <tr>
                        <td><strong>{{ $coupon->code }}</strong></td>
                        <td>{{ ucfirst($coupon->type) }}</td>
                        <td>
                            @if ($coupon->type == 'percentage')
                                {{ $coupon->discount_percentage }}%
                            @else
                                JOD {{ $coupon->discount_amount }}
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $coupon->usage_count > 0 ? 'primary' : 'danger' }}">{{ $coupon->usage_count }}</span>
                        </td>
                        <td>{{ ucfirst($coupon->limit_type) }}</td>

                        <!-- Conditional display of columns based on limit_type -->
                        @if($coupon->limit_type == 'usage')
                            <td>{{ $coupon->max_usage ? $coupon->max_usage : 'Unlimited' }}</td>
                        @elseif($coupon->limit_type == 'time')
                            <td>{{ $coupon->expires_at ? $coupon->expires_at->format('Y-m-d') : 'No Expiry' }}</td>
                        @endif

                        <td>
                            <span class="badge bg-{{ $coupon->is_active ? 'success' : 'danger' }}">
                                {{ $coupon->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ $coupon->created_at->format('Y-m-d') }} ({{ $coupon->created_at->diffForHumans() }})</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.coupons.edit', $coupon->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <!-- Delete Button -->
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal" data-coupon-id="{{ $coupon->id }}">
                                        <i class="bx bx-trash me-1"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <hr class="m-0" />

    <div class="mt-3 d-flex justify-content-center">
        {{ $coupons->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>

</div>

<!-- Modal for delete confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this coupon?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="delete-coupon-form" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const deleteButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const couponId = this.getAttribute('data-coupon-id');
            const form = document.getElementById('delete-coupon-form');
            form.action = '/manage/coupons/' + couponId;
        });
    });
</script>
@endsection
