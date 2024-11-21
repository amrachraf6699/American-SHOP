@extends('manage.layout')
@section('title', 'Create Home Slider')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Create New Home Slider</h5>
        <a href="{{ route('admin.home_sliders.index') }}" class="btn btn-outline-secondary btn-sm">Back to Home Sliders</a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.home_sliders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label fw-semibold">Slider Title</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-heading"></i></span>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter slider title" value="{{ old('title') }}">
                </div>
                @error('title')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label fw-semibold">Description</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Enter slider description">{{ old('description') }}</textarea>
                <small class="text-muted">Provide a brief description for the slider.</small>
                @error('description')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Link -->
            <div class="mb-3">
                <label for="link" class="form-label fw-semibold">Link</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-link"></i></span>
                    <input type="url" id="link" name="link" class="form-control @error('link') is-invalid @enderror" placeholder="Enter link URL" value="{{ old('link') }}">
                </div>
                <small class="text-muted">Example: https://example.com</small>
                @error('link')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            
            <!-- Opens in New Tab -->
            <div class="mb-3">
                <label for="opens_new_tab" class="form-label fw-semibold">Opens in New Tab</label>
                <input type="hidden" name="opens_new_tab" value="0"> <!-- Ensures false is sent when unchecked -->
                <div class="form-check form-switch">
                    <input
                        class="form-check-input @error('opens_new_tab') is-invalid @enderror"
                        type="checkbox"
                        id="opens_new_tab"
                        name="opens_new_tab"
                        value="1"
                        {{ old('opens_new_tab') ? 'checked' : '' }}>
                    <label class="form-check-label" for="opens_new_tab">Yes, open the link in a new tab</label>
                </div>
                @error('opens_new_tab')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>


            <!-- Cover Image -->
            <div class="mb-3">
                <label for="cover" class="form-label fw-semibold">Cover Image</label>
                <div class="input-group">
                    <input type="file" id="cover" name="cover" class="form-control @error('cover') is-invalid @enderror" accept="image/*">
                    <label class="input-group-text" for="cover"><i class="bx bx-image"></i></label>
                </div>
                <small class="text-muted">Recommended size: 1200x600px.</small>
                @error('cover')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit and Cancel Buttons -->
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary me-2"><i class="bx bx-save"></i> Save Slider</button>
                <a href="{{ route('admin.home_sliders.index') }}" class="btn btn-outline-secondary"><i class="bx bx-x"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
