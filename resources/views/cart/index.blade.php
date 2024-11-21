@extends('layouts.app')
@section('title', 'Cart')
@section('content')
<section class="block-blog-single block-cart section-margin mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @forelse($cartItems as $item)
                <div class="row mb-4 d-flex justify-content-between align-items-center box-cart-wrapper">
                    <div class="col-lg-2 col-md-2">
                        <img src="{{ $item->product->cover }}" class="img-fluid rounded-3" alt="Cotton T-shirt">
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <h6 class="text-muted title-product-cart">{{ $item->product->name }}</h6>
                    </div>
                    <div class="col-lg-3 col-md-4 d-flex justify-content-center">
                        <!-- Decrease Quantity Form -->
                        <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                            <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                            <button type="submit" class="btn btn-link px-2" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                <i class="fas fa-minus"></i>
                            </button>
                        </form>

                        <!-- Quantity Input -->
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm" style="width: 60px; text-align: center;" disabled />

                        <!-- Increase Quantity Form -->
                        <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                            <button type="submit" class="btn btn-link px-2">
                                <i class="fas fa-plus"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <h6 class="mb-0 price text-end">JOD {{ $item->getPriceSum() }}</h6>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <form action="{{ route('cart.remove', $item) }}" method="POST">
                            @csrf
                            <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-link text-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="row mb-4 d-flex justify-content-between align-items-center box-cart-wrapper">
                    <div class="col-lg-12 col-md-12">
                        <h6 class="text-muted">No items in cart</h6>
                    </div>
                </div>
                @endforelse
            </div>
            <div class="col-lg-4">
                <div class="order-summery">
                    <h5>Order summary</h5>
                    <div class="order-details d-flex justify-content-between">
                        <p>Price</p>
                        <span>JOD {{ $totalPrice }}</span>
                    </div>
                    <div class="order-details d-flex justify-content-between">
                        <p>Discount</p>
                        <span class="primary-clr">JOD {{ $discount }}</span>
                    </div>
                    <div class="order-details border-btm d-flex justify-content-between">
                        <p>Shipping</p>
                        <span class="primary-clr">JOD {{ $shippingFee }}</span>
                    </div>
                    <div class="order-details mt--32 total d-flex justify-content-between">
                        <p>TOTAL</p>
                        <span class="fw">JOD {{ $finalTotal }}</span>
                    </div>
                    <div class="product-overlay">
                        <form action="{{ route('cart.apply-coupon') }}" method="POST" class="d-flex flex-column align-items-center">
                            @csrf
                            <!-- Coupon Code Input -->
                            <input type="text" name="coupon_code" width="25" height="25" id="coupon_code" placeholder="Enter coupon code" class="form-control mb-3 @error('coupon_code') is-invalid @enderror" value="{{ old('coupon_code') }}" required>
                            @error('coupon_code')
                            <small class="text-danger mb-3">{{ $message }}</small>
                            @enderror


                            <!-- Apply Coupon Button -->

                            <a class="add-btn mb-3 text-center" href="javascript:void(0)" onclick="applyCoupon()">Apply coupon</a>
                        </form>

                        <form action="{{ route('orders.place') }}" method="POST" class="text-center">
                            @csrf

                            <!-- Address Selection -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="h5 mb-0">Select Address</p>
                                <a href="{{ route('addresses.create') }}" class="text-primary fw-bold">
                                    OR Add New Address
                                </a>
                            </div>



                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                                @forelse($addresses as $address)
                                    <label for="address_{{ $address->id }}" class="mb-2 relative block border rounded-lg p-4 shadow-sm hover:shadow-md transition-all duration-200 ease-in-out cursor-pointer group">
                                        <input
                                            type="radio"
                                            id="address_{{ $address->id }}"
                                            name="address_id"
                                            value="{{ $address->id }}"
                                            class="hidden peer"
                                            @if($address->is_default) checked @endif
                                            required>
                                        <div class="peer-checked:ring-2 peer-checked:ring-blue-500 peer-checked:border-blue-500 p-4">
                                            <h6 class="font-bold text-lg mb-2 text-gray-800 group-hover:text-blue-600">
                                                {{ $address->address_line_1 }}
                                            </h6>
                                            <p class="text-sm text-gray-600">
                                                {{ $address->city }}, {{ $address->state }} <br>
                                                {{ $address->zip_code }} <br>
                                                Phone: {{ $address->phone }}
                                            </p>
                                            @if($address->is_default)
                                                <span class="badge bg-success text-white">Default</span>
                                            @endif
                                        </div>
                                    </label>
                                @empty
                                    <div class="col-12 text-center">
                                        <p class="text-muted">No addresses available. Please add a new address.</p>
                                    </div>
                                @endforelse
                            </div>


                            <!-- Error Message -->
                            @error('address_id')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror

                            <!-- Single Textarea for Notes -->
                            <div class="mt-3">
                                <label for="note" class="form-label">Add a Note</label>
                                <textarea
                                    id="note"
                                    name="notes"
                                    class="form-control mb-3"
                                    rows="3"
                                    placeholder="Any Notes?"></textarea>
                            </div>

                            <!-- Proceed to Checkout Button -->
                            <button type="submit" class="add-btn mt-6">
                                Proceed to checkout
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                    <path d="M4.60547 12.4931H20.6055M20.6055 12.4931L14.6055 6.4931M20.6055 12.4931L14.6055 18.4931"
                                          stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                </svg>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
   function applyCoupon() {
        // Get the coupon code value
        var couponCode = document.getElementById('coupon_code').value;

        // Check if the coupon code is empty
        if (couponCode.trim() === '') {
            alert('Please enter a coupon code.');
            return;
        }

        // Create a hidden form element to submit the coupon code
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('cart.apply-coupon') }}';  // Use the correct route for applying coupon

        // Add CSRF token to the form
        var csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        // Add coupon code to the form
        var couponInput = document.createElement('input');
        couponInput.type = 'hidden';
        couponInput.name = 'coupon_code';
        couponInput.value = couponCode;
        form.appendChild(couponInput);

        // Submit the form
        document.body.appendChild(form);
        form.submit();
    }
</script>
@endpush
@endsection
