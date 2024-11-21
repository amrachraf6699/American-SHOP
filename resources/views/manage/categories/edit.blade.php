@extends('manage.layout')
@section('title', 'Edit ' . $category->name)

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit {{ $category->name }}</h5>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">Back to Categories</a>
    </div>
    <div class="card-body">
        <!-- Cover Image Preview (above the form) -->
        <div class="text-center mb-4">
            <label for="cover" class="form-label fw-semibold">Cover</label>
            <div id="image-preview-container" class="mt-3">
                <!-- If a cover image exists, display it -->
                @if($category->cover)
                    <img id="image-preview" src="{{ $category->cover }}" alt="Cover Image Preview" class="img-fluid rounded" style="width: 210px; height: auto;">
                @endif
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Category Name -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Category Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-tag"></i></span>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter category name" value="{{ old('name', $category->name) }}" >
                </div>
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label fw-semibold">Description</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Brief description of the category">{{ old('description', $category->description) }}</textarea>
                <small class="text-muted">Provide a short and concise description for the category.</small>
                @error('description')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Subcategory (Dropdown) -->
            <div class="mb-3">
                <label for="parent_id" class="form-label fw-semibold">Parent Category (Optional)</label>
                <select id="parent_id" name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                    <option value="">Select Parent Category (If Any)</option>
                    @foreach($categories as $subcategory)
                        <option value="{{ $subcategory->id }}" {{ (old('parent_id', $category->parent_id) == $subcategory->id) ? 'selected' : '' }}>
                            {{ $subcategory->name }}
                        </option>
                    @endforeach
                </select>
                @error('parent_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Cover Image Input (below the image preview) -->
            <div class="mb-3">
                <label for="cover" class="form-label fw-semibold">Change Cover Image</label>
                <div class="input-group">
                    <input type="file" id="cover" name="cover" class="form-control @error('cover') is-invalid @enderror" accept="image/*">
                    <label class="input-group-text" for="cover"><i class="bx bx-image"></i></label>
                </div>
                <small class="text-muted">Recommended size: 600x400px.</small>
                @error('cover')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit and Cancel Buttons -->
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary me-2"><i class="bx bx-save"></i> Save Changes</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary"><i class="bx bx-x"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Preview the image when selected
    document.getElementById('cover').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imagePreview = document.getElementById('image-preview');
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
@endsection
