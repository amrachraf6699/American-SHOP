@extends('manage.layout')
@section('title', 'Create Category')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Create New Category</h5>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">Back to Categories</a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Category Name -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Category Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-tag"></i></span>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter category name" value="{{ old('name') }}">
                </div>
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label fw-semibold">Description</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Brief description of the category">{{ old('description') }}</textarea>
                <small class="text-muted">Provide a short and concise description for the category.</small>
                @error('description')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Parent Category (Subcategory) -->
            <div class="mb-3">
                <label for="parent_id" class="form-label fw-semibold">Parent Category</label>
                <select id="parent_id" name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                    <option value="">Select Parent Category (Optional)</option>
                    @foreach($parentCategories as $category)
                        <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">If this category is a subcategory, select the parent category.</small>
                @error('parent_id')
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
                <small class="text-muted">Recommended size: 600x400px.</small>
                @error('cover')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit and Cancel Buttons -->
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary me-2"><i class="bx bx-save"></i> Save Category</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary"><i class="bx bx-x"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
