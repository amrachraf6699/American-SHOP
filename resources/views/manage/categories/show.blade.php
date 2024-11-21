@extends('manage.layout')
@section('title', 'Category Details')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <!-- Card for Category Info -->
            <div class="card shadow-lg">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">Back to Categories</a>
                </div>
                <div class="card-body text-center">
                    <!-- Category Cover Image -->
                    <div class="mb-4">
                        <img src="{{ asset($category->cover) }}" class="img-fluid rounded shadow-sm" alt="{{ $category->name }}" style="max-height: 300px; object-fit: cover;">
                    </div>

                    <!-- Category Name -->
                    <h4 class="fw-bold text-primary">{{ $category->name }}
                        @if($category->parent)
                        <small class="text-muted">( Subcategory of {{ $category->parent->name ?? 'None' }} )</small>
                        @endif
                    </h4>

                    <!-- Category Description -->
                    <p class="text-muted">{{ $category->description ?: 'No description available for this category.' }}</p>

                    <!-- Created At -->
                    <small class="text-muted">Created on {{ $category->created_at->format('d M, Y') }} ({{ $category->created_at->diffForHumans() }})</small>
                </div>
            </div>

            <!-- Associated Products Section -->
            <div class="mt-5 text-center">
                <h5 class="fw-semibold mb-3 text-info">Products in this Category</h5>
                @if($category->products->isEmpty())
                    <p class="text-muted">No products available in this category yet.</p>
                @else
                    <div class="table-responsive shadow-sm rounded">
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Created At</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category->products as $product)
                                    <tr>
                                        <td class="align-middle">{{ $product->name }}</td>
                                        <td class="align-middle">JOD {{ number_format($product->price, 2) }}</td>
                                        <td class="align-middle">{{ $product->created_at->format('d M, Y') }}</td>
                                        <td class="align-middle">
                                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm btn-outline-info"><i class="bx bx-show"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm mb-2">View All Products</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
