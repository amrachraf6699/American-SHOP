@extends('manage.layout')
@section('title', 'Edit Product')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <!-- Card for Product Info -->
            <div class="card shadow-lg">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold text-primary">Edit Product</h4>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">Back to Products</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Product Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}">
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Product Price -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0">
                            @error('price')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Product discount -->
                        <div class="mb-3">
                            <label for="discount" class="form-label">Discount</label>
                            <input type="number" class="form-control" id="discount" name="discount" value="{{ old('discount', $product->discount) }}" step="0.01" min="0">
                            @error('discount')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Product Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Product Categories (Checkboxes) -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Categories</label>
                            <div class="row">
                                @foreach ($categories as $category)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="category_{{ $category->id }}" name="categories[]" value="{{ $category->id }}"
                                                {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="category_{{ $category->id }}">
                                                {{ $category->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('categories')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Product Images -->
                        <div class="mb-3">
                            <label for="images" class="form-label fw-semibold">Images</label>
                            <div class="col-md">
                                @if($product->files->isEmpty())
                                    <p class="text-muted">No images available for this product yet.</p>
                                @else
                                    <div id="carouselExample-cf" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
                                        <!-- Carousel Indicators -->
                                        <ol class="carousel-indicators">
                                            @foreach ($product->files as $index => $file)
                                                <li data-bs-target="#carouselExample-cf" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
                                            @endforeach
                                        </ol>

                                        <!-- Carousel Items -->
                                        <div class="carousel-inner">
                                            @foreach ($product->files as $index => $file)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <img class="d-block w-100" src="{{ asset('storage/' . $file->path) }}" alt="Product Image" style="height: 400px; object-fit: cover;" />
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <p>Product image {{ $index + 1 }} of {{ $product->files->count() }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Carousel Controls -->
                                        <a class="carousel-control-prev" href="#carouselExample-cf" role="button" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon bg-dark p-2 rounded-circle" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExample-cf" role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon bg-dark p-2 rounded-circle" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-2">
                                <button type="button" id="add-image" class="btn btn-outline-primary btn-sm"><i class="bx bx-plus"></i> Add Image</button>
                            </div>
                            @error('images')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary me-2"><i class="bx bx-save"></i> Save Changes</button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary"><i class="bx bx-x"></i> Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const addImageButton = document.getElementById('add-image');
    const imageFieldsContainer = document.getElementById('image-fields');
    let imageCount = {{ $product->files->count() }};

    // Add image field on button click
    addImageButton.addEventListener('click', function () {
        imageCount++;
        const imageFieldHTML = `
            <div class="mb-3 d-flex align-items-center me-2" id="image-field-${imageCount}">
                <input type="file" id="images-${imageCount}" name="images[]" class="form-control @error('images') is-invalid @enderror" accept="image/*">
                <div class="image-preview me-2" id="image-preview-${imageCount}" style="width: 40px; height: 40px; background-color: #f5f5f5; border-radius: 4px; overflow: hidden;">
                    <img src="#" id="preview-${imageCount}" alt="Image Preview" style="width: 40px; height: 40px; object-fit: cover; display: none;">
                </div>
                <button type="button" class="btn btn-outline-danger btn-sm ms-2" onclick="removeImageField(${imageCount})"><i class="bx bx-trash"></i></button>
            </div>
        `;
        imageFieldsContainer.insertAdjacentHTML('beforeend', imageFieldHTML);

        // Add preview functionality for the new image input
        const imageInput = document.getElementById(`images-${imageCount}`);
        const preview = document.getElementById(`preview-${imageCount}`);

        imageInput.addEventListener('change', function () {
            const file = imageInput.files[0];
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

    // Prevent accidental product deletion when deleting image
    const deleteImageForms = document.querySelectorAll('.image-delete-form');
    deleteImageForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            // If there is only one image, prevent the delete form from submitting
            if (imageCount === 1) {
                e.preventDefault();
                alert('You cannot delete the last image.');
            }
        });
    });
});

</script>

@endpush

@push('styles')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 34px;
        height: 20px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
</style>
@endpush

@endsection
