@extends('manage.layout')
@section('title', 'Create Coupon')
@section('content')
<div class="card">
    <div class="card-header">
        <h5>Create New Coupon</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.coupons.store') }}">
            @csrf

            <!-- Coupon Code -->
            <div class="mb-3">
                <label for="code" class="form-label">Coupon Code</label>
                <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Enter coupon code" value="{{ old('code') }}">
                @error('code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Coupon Type (Fixed or Percentage) -->
            <div class="mb-3">
                <label for="type" class="form-label">Coupon Type</label>
                <select id="type" name="type" class="form-control @error('type') is-invalid @enderror">
                    <option value="">Select Type</option>
                    <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                    <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                </select>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Limit Type (Usage or Time) -->
            <div class="mb-3">
                <label for="limit_type" class="form-label">Limit Type</label>
                <select id="limit_type" name="limit_type" class="form-control @error('limit_type') is-invalid @enderror">
                    <option value="">Select Limit Type</option>
                    <option value="usage" {{ old('limit_type') == 'usage' ? 'selected' : '' }}>Usage</option>
                    <option value="time" {{ old('limit_type') == 'time' ? 'selected' : '' }}>Time</option>
                </select>
                @error('limit_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Discount Amount (for fixed type) -->
            <div class="mb-3" id="discount_amount_div">
                <label for="discount_amount" class="form-label">Discount Amount</label>
                <input type="number" id="discount_amount" name="discount_amount" class="form-control @error('discount_amount') is-invalid @enderror" placeholder="Enter discount amount" value="{{ old('discount_amount') }}" min="0" step="0.01">
                @error('discount_amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Discount Percentage (for percentage type) -->
            <div class="mb-3" id="discount_percentage_div">
                <label for="discount_percentage" class="form-label">Discount Percentage</label>
                <input type="number" id="discount_percentage" name="discount_percentage" class="form-control @error('discount_percentage') is-invalid @enderror" placeholder="Enter discount percentage" value="{{ old('discount_percentage') }}" min="1" max="100" step="0.01">
                @error('discount_percentage')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Max Usage (shown when limit type is usage) -->
            <div class="mb-3" id="max_usage_div">
                <label for="max_usage" class="form-label">Max Usage</label>
                <input type="number" id="max_usage" name="max_usage" class="form-control @error('max_usage') is-invalid @enderror" placeholder="Enter max usage" value="{{ old('max_usage') }}" min="1">
                @error('max_usage')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Expiration Date (shown when limit type is time) -->
            <div class="mb-3" id="expires_at_div">
                <label for="expires_at" class="form-label">Expiration Date</label>
                <input type="datetime-local" id="expires_at" name="expires_at" class="form-control @error('expires_at') is-invalid @enderror" value="{{ old('expires_at') }}">
                @error('expires_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Create Coupon</button>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
    // Show/Hide fields based on coupon type (fixed or percentage)
    document.getElementById('type').addEventListener('change', function () {
        var type = this.value;
        if (type == 'fixed') {
            document.getElementById('discount_amount_div').style.display = 'block';
            document.getElementById('discount_percentage_div').style.display = 'none';
        } else {
            document.getElementById('discount_amount_div').style.display = 'none';
            document.getElementById('discount_percentage_div').style.display = 'block';
        }
    });

    // Show/Hide fields based on limit type (usage or time)
    document.getElementById('limit_type').addEventListener('change', function () {
        var limitType = this.value;
        if (limitType == 'usage') {
            document.getElementById('max_usage_div').style.display = 'block';
            document.getElementById('expires_at_div').style.display = 'none';
        } else {
            document.getElementById('max_usage_div').style.display = 'none';
            document.getElementById('expires_at_div').style.display = 'block';
        }
    });

    // Trigger change event to set initial visibility of fields
    document.getElementById('type').dispatchEvent(new Event('change'));
    document.getElementById('limit_type').dispatchEvent(new Event('change'));
</script>
@endsection
