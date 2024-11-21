@extends('layouts.app')

@section('title', 'Edit Address')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg rounded-lg border-0">
                    <div class="card-body p-5">
                        <h2 class="mb-4 text-center">Edit Address</h2>

                        <form action="{{ route('addresses.update', $address->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- To specify the PUT request method -->

                            <!-- Address Line 1 -->
                            <div class="mb-4">
                                <label for="address_line_1" class="form-label fw-bold">Address Line 1</label>
                                <input type="text" id="address_line_1" name="address_line_1" class="form-control @error('address_line_1') is-invalid @enderror" value="{{ old('address_line_1', $address->address_line_1) }}">
                                @error('address_line_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Address Line 2 -->
                            <div class="mb-4">
                                <label for="address_line_2" class="form-label fw-bold">Address Line 2 (Optional)</label>
                                <input type="text" id="address_line_2" name="address_line_2" class="form-control @error('address_line_2') is-invalid @enderror" value="{{ old('address_line_2', $address->address_line_2) }}">
                                @error('address_line_2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="mb-4">
                                <label for="city" class="form-label fw-bold">City</label>
                                <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $address->city) }}">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- State -->
                            <div class="mb-4">
                                <label for="state" class="form-label fw-bold">State</label>
                                <input type="text" id="state" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state', $address->state) }}">
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Zip Code -->
                            <div class="mb-4">
                                <label for="zip_code" class="form-label fw-bold">Zip Code</label>
                                <input type="text" id="zip_code" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" value="{{ old('zip_code', $address->zip_code) }}">
                                @error('zip_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Country -->
                            <div class="mb-4">
                                <label for="country" class="form-label fw-bold">Country</label>
                                <input type="text" id="country" name="country" class="form-control @error('country') is-invalid @enderror" value="{{ old('country', $address->country) }}">
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="mb-4">
                                <label for="phone" class="form-label fw-bold">Phone</label>
                                <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $address->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $address->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Default Address Toggle -->
                            <div class="mb-4">
                                <label for="is_default" class="form-label fw-bold">Set as Default Address</label>
                                <div class="form-check form-switch">
                                    <input type="checkbox" id="is_default" name="is_default" class="form-check-input" {{ old('is_default', $address->is_default) ? 'checked' : '' }}>
                                    <label class="form-check-label mt-2 mx-2" for="is_default">Enable Default</label>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('addresses.index') }}" class="btn btn-secondary me-3 px-4 py-2">Cancel</a>
                                <button type="submit" class="btn btn-primary px-4 py-2">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection