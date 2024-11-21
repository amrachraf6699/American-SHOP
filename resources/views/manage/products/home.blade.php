@extends('manage.layout')
@section('title', 'Products List')
@section('content')
<div class="card mb-2">
    <div class="card-header">
        <form method="GET" action="{{ route('admin.products.index') }}" class="row g-3 align-items-end">
            <!-- Product Name Filter -->
            <div class="col-md-3 col-lg-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" id="name" class="form-control" name="name" placeholder="Product Name" value="{{ request('name') }}">
            </div>

            <!-- Category Filter -->
            <div class="col-md-3 col-lg-2">
                <label for="category_id" class="form-label">Category</label>
                <select id="category_id" class="form-control" name="category_id">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Price Filters -->
            <div class="col-md-3 col-lg-2">
                <label class="form-label">Price Range</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="min_price" placeholder="Min" value="{{ request('min_price') }}">
                    <span class="input-group-text">-</span>
                    <input type="number" class="form-control" name="max_price" placeholder="Max" value="{{ request('max_price') }}">
                </div>
            </div>

            <!-- Orders Count Filters -->
            <div class="col-md-3 col-lg-2">
                <label class="form-label">Orders Count</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="min_orders" placeholder="Min" value="{{ request('min_orders') }}">
                    <span class="input-group-text">-</span>
                    <input type="number" class="form-control" name="max_orders" placeholder="Max" value="{{ request('max_orders') }}">
                </div>
            </div>


            <!-- Orders Count Filters -->
            <div class="col-md-3 col-lg-1">
                <label class="form-label" for="discount">Discount?</label>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="discount" name="discount" value="1" {{ request('discount') ? 'checked' : '' }}>
                    <label class="form-check-label" for="discount">Enable</label>
                </div>
            </div>


            <!-- Filter and Clear Buttons -->
            <div class="col-12 d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-primary mx-2">Filter</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mx-2">Clear</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Products Table {{ $products->total() > 0 ? '('.$products->total().' Total)' : '' }}</h5>
        @if($products->isEmpty())
        @else
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Create Product</a>
        @endif
    </div>

    @if($products->isEmpty())
        <div class="card-body">
            <div class="text-center">
                <h4>No Products Yet</h4>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Create Product</a>
            </div>
        </div>
    @else
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Images</th>
                    <th>Orders Count</th>
                    <th>Categories</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <strong>{{ $product->name }}</strong>
                        </td>
                        <td>JOD {{ number_format($product->price, 2) }}
                            {!! $product->discount ? ' <span class="text-success">('.number_format($product->discount, 2).' off)</span>' : '' !!}
                        </td>
                        <td>{{ Str::limit($product->description, 30) }}</td>
                        <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                @foreach ($product->files as $file)
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Image">
                                      <img src="{{ asset('storage/'.$file->path) }}" alt="Avatar" class="rounded-circle">
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <span class="badge badge-center rounded-pill bg-label-{{ $product->orders_count > 0 ? 'success' : 'danger' }}">{{ $product->orders_count }}</span>
                        </td>
                        <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                @foreach ($product->categories as $category)
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="{{ $category->name }}">
                                        <img src="{{ asset($category->cover) }}" alt="Avatar" class="rounded-circle">
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td><span class="me-1">{{ $product->created_at }} ({{ $product->created_at->diffForHumans() }})</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.products.show', $product->id) }}"><i class="bx bx-show me-1"></i> Show</a>
                                    <a class="dropdown-item" href="{{ route('admin.products.edit', $product->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ route('product', $product) }}" target="_blank"><i class="bx bx-bullseye me-1"></i> View On Website</a>
                                    <!-- Button to open modal -->
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal" data-product-id="{{ $product->id }}">
                                        <i class="bx bx-trash me-1"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <hr class="m-0" />

    <div class="mt-3 d-flex justify-content-center">
        {{ $products->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>

</div>

<!-- Modal for delete confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this product?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="delete-product-form" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const deleteButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            const form = document.getElementById('delete-product-form');
            form.action = '/manage/products/' + productId;
        });
    });
</script>
@endsection
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
