@extends('manage.layout')
@section('title', 'Create New Product')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <!-- Card for Creating Product -->
            <div class="card shadow-lg">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">Create New Product</h5>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">Back to Products</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Promoting Section -->
                        <div class="mb-4 p-3 border rounded">
                            <h5 class="fw-bold mb-3">Promoting</h5>
                            <div class="row align-items-center">
                                <!-- Send to Newsletter -->
                                <div class="col-auto d-flex align-items-center ms-4">
                                    <input type="hidden" name="send_to_newsletter" value="0"> <!-- Hidden input for unchecked state -->
                                    <input type="checkbox" id="send_to_newsletter" name="send_to_newsletter" value="1" class="form-check-input me-2" {{ old('send_to_newsletter') ? 'checked' : '' }}>
                                    <label for="send_to_newsletter" class="form-check-label mb-0">Send to Newsletter</label>
                                </div>
                            </div>
                            <!-- Validation Errors -->
                            <div class="mt-2 text-danger">
                                @if ($errors->has('send_to_newsletter'))
                                    {{ $errors->first('send_to_newsletter') }}
                                @endif
                            </div>
                        </div>


                        <!-- Product Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Product Name</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter product name" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Product Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Describe the product">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Start Price -->
                        <div class="mb-3">
                            <label for="price" class="form-label fw-semibold">Price</label>
                            <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Enter price" value="{{ old('price') }}">
                            @error('price')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Discount -->
                        <div class="mb-3">
                            <label for="discount" class="form-label fw-semibold">Discount</label>
                            <input type="number" id="discount" name="discount" class="form-control @error('discount') is-invalid @enderror" placeholder="Enter discount (Leave empty if no discount)" value="{{ old('discount') }}">
                            @error('discount')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Categories Selection -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Categories</label>
                            <div class="row">
                                @foreach($categories as $category)
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="category-{{ $category->id }}" name="categories[]" value="{{ $category->id }}" @checked(in_array($category->id, old('categories', [])))>
                                            <label class="form-check-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('categories')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dynamic Product Images -->
                        <div class="mb-3">
                            <label for="images" class="form-label fw-semibold">Images</label>
                            <div id="image-fields">
                                <!-- Dynamic image input fields will be appended here -->
                            </div>
                            <div class="mt-2">
                                <button type="button" id="add-image" class="btn btn-outline-primary btn-sm"><i class="bx bx-plus"></i> Add Image</button>
                            </div>
                            @error('images')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit and Cancel Buttons -->
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary me-2"><i class="bx bx-save"></i> Save Product</button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary"><i class="bx bx-x"></i> Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addImageButton = document.getElementById('add-image');
        const imageFieldsContainer = document.getElementById('image-fields');
        let imageCount = 0;

        // Add image field on button click
        addImageButton.addEventListener('click', function () {
            imageCount++;
            const imageFieldHTML = `
                <div class="mb-3 d-flex align-items-center" id="image-field-${imageCount}">
                    <input type="file" id="images-${imageCount}" name="images[]" class="form-control @error('images') is-invalid @enderror" accept="image/*">
                    <div class="image-preview me-2" id="image-preview-${imageCount}" style="width: 40px; height: 40px; background-color: #f5f5f5; border-radius: 4px; overflow: hidden;">
                        <img src="#" id="preview-${imageCount}" alt="Image Preview" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                    </div>
                    <button type="button" class="btn btn-outline-danger btn-sm ms-2" onclick="removeImageField(${imageCount})"><i class="bx bx-trash"></i></button>
                </div>
            `;
            imageFieldsContainer.insertAdjacentHTML('beforeend', imageFieldHTML);

            // Add preview functionality
            const imageInput = document.getElementById(`images-${imageCount}`);
            imageInput.addEventListener('change', function () {
                const file = imageInput.files[0];
                const preview = document.getElementById(`preview-${imageCount}`);

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        // Remove image field
        window.removeImageField = function (id) {
            const fieldToRemove = document.getElementById(`image-field-${id}`);
            fieldToRemove.remove();
        };
    });
</script>

@endsection
