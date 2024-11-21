@extends('manage.layout')
@section('title', 'Website Settings')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <!-- Form Wrapper -->
            <form action="" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Location & Phone Card -->
                <div class="card shadow-lg border-0 mt-5">
                    <div class="card-header text-center">
                        <h3 class="my-2">Location & Phone</h3>
                    </div>
                    <div class="card-body p-4">
                        <!-- Location -->
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" 
                                   value="{{ old('location', $website_settings->location) }}" required>
                            @error('location')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" 
                                   value="{{ old('phone', $website_settings->phone) }}" required>
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Social Media Links Card -->
                <div class="card shadow-lg border-0 mt-4">
                    <div class="card-header text-center">
                        <h3 class="my-2">Social Media Links</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="url" class="form-control" id="facebook" name="facebook" 
                                   value="{{ old('facebook', $website_settings->facebook) }}">
                            @error('facebook')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="twitter" class="form-label">Twitter</label>
                            <input type="url" class="form-control" id="twitter" name="twitter" 
                                   value="{{ old('twitter', $website_settings->twitter) }}">
                            @error('twitter')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="url" class="form-control" id="instagram" name="instagram" 
                                   value="{{ old('instagram', $website_settings->instagram) }}">
                            @error('instagram')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="whatsapp" class="form-label">WhatsApp</label>
                            <input type="url" class="form-control" id="whatsapp" name="whatsapp" 
                                   value="{{ old('whatsapp', $website_settings->whatsapp) }}">
                            @error('whatsapp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="youtube" class="form-label">YouTube</label>
                            <input type="url" class="form-control" id="youtube" name="youtube" 
                                   value="{{ old('youtube', $website_settings->youtube) }}">
                            @error('youtube')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Shipping Fee Card -->
                <div class="card shadow-lg border-0 mt-4">
                    <div class="card-header text-center">
                        <h3 class="my-2">Shipping Fee</h3>
                    </div>
                    <div class="card-body p-4">
                        <!-- Shipping Fee -->
                        <div class="mb-3">
                            <label for="shipping_fee" class="form-label">Shipping Fee Percentage (%)</label>
                            <input type="number" class="form-control" id="shipping_fee" 
                                   name="shipping_fee" 
                                   value="{{ old('shipping_fee', $website_settings->shipping_fee) }}" 
                                   step="0.01" min="0" max="100" required>
                            @error('shipping_fee')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                </div>
            </form>
            <!-- End of Form Wrapper -->
            
        </div>
    </div>
</div>
@endsection
