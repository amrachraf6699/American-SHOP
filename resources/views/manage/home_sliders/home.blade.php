@extends('manage.layout')
@section('title', 'Home Sliders')
@section('content')
<div class="card mb-3">
    <div class="card-body">
        <!-- Search Filters -->
        <form method="GET" action="{{ route('admin.home_sliders.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="title" class="form-label">Slider Title OR Link</label>
                <input type="text" id="title" name="search" class="form-control" placeholder="Slider Title OR Link" value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <label for="opens_new_tab" class="form-label">Opens in New Tab</label>
                <select id="opens_new_tab" name="opens_new_tab" class="form-select">
                    <option value="">All</option>
                    <option value="1" {{ request('opens_new_tab') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ request('opens_new_tab') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary mx-2">Filter</button>
                <a href="{{ route('admin.home_sliders.index') }}" class="btn btn-secondary">Clear</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Home Sliders</h5>
        <a href="{{ route('admin.home_sliders.create') }}" class="btn btn-primary">Create Slider</a>
    </div>
    @if($home_sliders->isEmpty())
        <div class="card-body">
            <div class="text-center">
                <h4>No Home Sliders Yet</h4>
                <a href="{{ route('admin.home_sliders.create') }}" class="btn btn-primary">Create Slider</a>
            </div>
        </div>
    @else
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Link</th>
                        <th>Opens in New Tab</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($home_sliders as $slider)
                        <tr>
                            <td>{{ $slider->title }}</td>
                            <td>{{ Str::limit($slider->description, 50) }}</td>
                            <td>
                                <img src="{{ $slider->cover }}" alt="{{ $slider->title }}" class="img-fluid" width="40" />
                            </td>
                            <td>
                                <a href="{{ $slider->link }}" target="{{ $slider->opens_new_tab ? '_blank' : '_self' }}">
                                    {{ Str::limit($slider->link, 30) }}...
                                </a>
                            </td>
                            <td>
                                <span class="badge bg-{{ $slider->opens_new_tab ? 'success' : 'secondary' }}">
                                    {{ $slider->opens_new_tab ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.home_sliders.edit', $slider->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <!-- Button to open delete modal -->
                                        <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal" data-slider-id="{{ $slider->id }}">
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
    <div class="mt-3 d-flex justify-content-center">
        {{ $home_sliders->links('pagination::bootstrap-4') }}
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
                <p>Are you sure you want to delete this slider?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="delete-slider-form" action="" method="POST">
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
            const sliderId = this.getAttribute('data-slider-id');
            const form = document.getElementById('delete-slider-form');
            form.action = '/manage/home_sliders/' + sliderId;
        });
    });
</script>
@endsection
