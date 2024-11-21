@extends('manage.layout')
@section('title', 'Product Details')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <!-- Card for Product Info -->
            <div class="card shadow-lg">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">Back to Products</a>
                </div>
                <div class="card-body text-center">
                    <!-- Product Cover Image -->
                    <div class="mb-4">
                        <img src="{{ asset($product->cover) }}" class="img-fluid rounded shadow-sm" alt="{{ $product->name }}" style="max-height: 300px; object-fit: cover;">
                    </div>

                    <!-- Product Name -->
                    <h4 class="fw-bold text-primary">{{ $product->name }}</h4>

                    <!-- Product Price -->
                    <p class="text-muted">Price: JOD {{ number_format($product->price, 2) }}</p>

                    <!-- Product Description -->
                    <p class="text-muted">{{ $product->description ?: 'No description available for this product.' }}</p>

                    <!-- Created At -->
                    <small class="text-muted">Created on {{ $product->created_at->format('d M, Y') }} ({{ $product->created_at->diffForHumans() }})</small>
                </div>
            </div>

            <!-- Associated Categories Section -->
            <div class="mt-5 text-center">
                <h5 class="fw-semibold mb-3 text-info">Categories for this Product</h5>
                @if($product->categories->isEmpty())
                    <p class="text-muted">No categories assigned to this product yet.</p>
                @else
                    <div class="table-responsive shadow-sm rounded">
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->categories as $category)
                                    <tr>
                                        <td class="align-middle">{{ $category->name }}</td>
                                        <td class="align-middle">{{ Str::limit($category->description, 50) }}</td>
                                        <td class="align-middle">
                                            <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-sm btn-outline-info"><i class="bx bx-show"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm mb-2">View All Categories</a>
                    </div>
                @endif
            </div>

            <!-- Product Images Section -->
            <div class="mt-5 text-center">
                <h5 class="fw-semibold mb-3 text-info">Product Images</h5>
                @if($product->files->isEmpty())
                    <p class="text-muted">No images available for this product yet.</p>
                @else
                    <div id="productImagesCarousel" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">

                        <!-- Carousel Indicators -->
                        <ol class="carousel-indicators">
                            @foreach ($product->files as $index => $file)
                                <li data-bs-target="#productImagesCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>

                        <div class="carousel-inner">
                            @foreach ($product->files as $index => $file)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $file->path) }}" alt="Product Image" class="d-block w-100 img-fluid" style="max-height: 400px; object-fit: cover;">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p>Product image {{ $index + 1 }} of {{ $product->files->count() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Carousel Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#productImagesCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productImagesCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
