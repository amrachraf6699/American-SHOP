@extends('layouts.app')
@section('title' , 'Give Feedback')

@section('content')
<div class="container py-5">
    <!-- Page Header -->
    <div class="text-center mb-5">
        <h1 class="display-5">Give Feedback</h1>
        <p class="text-muted">Your thoughts matter! Please rate and review the items from your order <strong>#{{ $order->id }}</strong>.</p>
    </div>

    <!-- Feedback Form -->
    <form action="" method="POST">
        @csrf

        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 justify-content-center">
                @foreach ($order->items as $item)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <!-- Item Image -->
                            <img
                                src="{{ $item->cover }}"
                                alt="{{ $item->name }}"
                                class="card-img-top"
                                style="height: 200px; object-fit: cover;"
                            >

                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text text-muted mb-1">Quantity: {{ $item->quantity }}</p>
                                <p class="card-text fw-bold">Price: ${{ number_format($item->price * $item->quantity, 2) }}</p>

                                <!-- Rating Dropdown -->
                                <div class="mt-auto">
                                    <label for="rating_{{ $item->id }}" class="form-label">Rate this item:</label>
                                    <select id="rating_{{ $item->id }}" name="feedback[{{ $item->id }}][rating]" class="form-select mb-3 @error('feedback.' . $item->id . '.rating') is-invalid @enderror">
                                        <option value="">Select Rating</option>
                                        <option value="5" {{ old('feedback.' . $item->id . '.rating') == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ Excellent</option>
                                        <option value="4" {{ old('feedback.' . $item->id . '.rating') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ Good</option>
                                        <option value="3" {{ old('feedback.' . $item->id . '.rating') == 3 ? 'selected' : '' }}>⭐⭐⭐ Average</option>
                                        <option value="2" {{ old('feedback.' . $item->id . '.rating') == 2 ? 'selected' : '' }}>⭐⭐ Poor</option>
                                        <option value="1" {{ old('feedback.' . $item->id . '.rating') == 1 ? 'selected' : '' }}>⭐ Terrible</option>
                                    </select>
                                    @error('feedback.' . $item->id . '.rating')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <!-- Feedback Textarea -->
                                    <label for="feedback_{{ $item->id }}" class="form-label">Your feedback:</label>
                                    <textarea
                                        id="feedback_{{ $item->id }}"
                                        name="feedback[{{ $item->id }}][comment]"
                                        class="form-control @error('feedback.' . $item->id . '.comment') is-invalid @enderror"
                                        rows="3"
                                        placeholder="Write your feedback here..."
                                    >{{ old('feedback.' . $item->id . '.comment') }}</textarea>
                                    @error('feedback.' . $item->id . '.comment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center mt-5">
            <button type="submit" class="btn btn-primary btn-lg px-5">Give Feedback</button>
        </div>
    </form>

</div>
@endsection
