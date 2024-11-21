@extends('manage.layout')
@section('title', 'Categories List')
@section('content')
<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.categories.index') }}" class="row g-3">
            <!-- Category Name Filter -->
            <div class="col-md-4 col-lg-4">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" id="name" class="form-control" name="name" placeholder="Category Name" value="{{ request('name') }}">
            </div>

            <!-- Products Range -->
            <div class="col-md-4 col-lg-4">
                <label class="form-label">Products Range</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="min_products" placeholder="Min" value="{{ request('min_products') }}">
                    <span class="input-group-text">-</span>
                    <input type="number" class="form-control" name="max_products" placeholder="Max" value="{{ request('max_products') }}">
                </div>
            </div>

            <!-- Creation Date Filters -->
            <div class="col-md-4 col-lg-4">
                <label class="form-label">Creation Date</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="create_start" placeholder="Min" value="{{ request('create_start') }}">
                    <span class="input-group-text">-</span>
                    <input type="date" class="form-control" name="create_end" placeholder="Max" value="{{ request('create_end') }}">
                </div>
            </div>

            <!-- Parent Only Checkbox -->
            <div class="col-md-4 col-lg-4">
                <label class="form-label">Parent Categories Only</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="parent_only" value="1" {{ request('parent_only') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="parent_only">
                        Hide Subcategories
                    </label>
                </div>
            </div>

            <!-- Filter and Clear Buttons -->
            <div class="col-12 d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-primary mx-2">Filter</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mx-2">Clear</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Categories Table</h5>
        @if($categories->isEmpty())
        @else
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create Category</a>
        @endif
    </div>

    @if($categories->isEmpty())
        <div class="card-body">
            <div class="text-center">
                <h4>No Categories Yet</h4>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create Category</a>
            </div>
        </div>
    @else
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Products</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($categories as $category)
                    <tr>
                        <td>
                            <img src="{{ $category->cover }}" alt="{{ $category->name }}" class="w-1/4" width="23px"/>
                            <strong>{{ $category->name }}</strong>
                        </td>
                        <td>
                            @if($category->parent_id)
                                <span class="badge bg-label-secondary">Subcategory ({{ $category->parent->name }})</span>
                            @else
                                <span class="badge bg-label-primary">Category</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($category->description, 30) }}</td>
                        <td>
                            <span class="badge badge-center rounded-pill bg-label-{{ $category->products_count > 0 ? 'success' : 'danger' }}">{{ $category->products_count }}</span>
                        </td>
                        <td><span class="me-1">{{ $category->created_at }} ({{ $category->created_at->diffForHumans() }})</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.categories.show', $category->id) }}"><i class="bx bx-show me-1"></i> Show</a>
                                    <a class="dropdown-item" href="{{ route('admin.categories.edit', $category->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ route('category', $category) }}" target="_blank"><i class="bx bx-bullseye me-1"></i> View On Website</a>
                                    <!-- Button to open modal -->
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal" data-category-id="{{ $category->id }}">
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
        {{ $categories->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
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
                <p>Are you sure you want to delete this category?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="delete-category-form" action="" method="POST">
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
            const categoryId = this.getAttribute('data-category-id');
            const form = document.getElementById('delete-category-form');
            form.action = '/manage/categories/' + categoryId;
        });
    });
</script>
@endsection
