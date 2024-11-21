@extends('layouts.app')
@section('title', 'Your Addresses')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Your Addresses</h2>
                    <a href="{{ route('addresses.create') }}" class="btn custom-address-btn-primary btn-lg rounded border-rounded rounded-full">
                        <i class="bi bi-plus-circle"></i> Add New Address
                    </a>
                </div>

                <!-- Display addresses -->
                @if($addresses->isEmpty())
                    <div class="alert alert-info">
                        <p>You have no saved addresses. <a href="{{ route('addresses.create') }}" class="alert-link">Add an address</a></p>
                    </div>
                @else
                    <div class="list-group">
                        @foreach($addresses as $address)
                            <div class="list-group-item d-flex justify-content-between align-items-center mb-3 p-4 shadow-sm rounded">
                                <div>
                                    <!-- Display Address Info -->
                                    <h5 class="mb-2 text-dark">{{ $address->address_line_1 }}</h5>
                                    <p class="text-muted">{{ $address->address_line_2 ?? '' }}, {{ $address->city }}, {{ $address->state }}, {{ $address->zip_code }}</p>
                                    <p class="mb-2"><strong>Country:</strong> {{ $address->country }}</p>
                                    <p class="mb-2"><strong>Email:</strong> {{ $address->email }}</p>
                                    <p><strong>Phone:</strong> {{ $address->phone }}</p>

                                    <!-- Display Default Address -->
                                    <p><strong>Default Address:</strong>
                                        <span class="badge {{ $address->is_default ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $address->is_default ? 'Yes' : 'No' }}
                                        </span>
                                    </p>
                                </div>

                                <!-- Edit and delete actions -->
                                <div class="d-flex flex-column align-items-end">
                                    <!-- Edit Button -->
                                    <a href="{{ route('addresses.edit', $address->id) }}" class="btn custom-address-btn-warning btn-sm mb-2 px-4 py-2 d-flex align-items-center" title="Edit Address">
                                        <i class="fa fa-edit mr-2"></i> Edit
                                    </a>

                                    <!-- Set Default Button -->
                                    <form action="{{ route('addresses.default' , $address) }}" method="POST" class="mb-2">
                                        @csrf
                                        <button type="submit" class="btn custom-address-btn-primary btn-sm px-4 py-2 d-flex align-items-center" title="Set as Default Address">
                                            <i class="fa fa-check mr-2"></i> Set Default
                                        </button>
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="{{ route('addresses.destroy', $address->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this address?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn custom-address-btn-danger btn-sm px-4 py-2 d-flex align-items-center" title="Delete Address">
                                            <i class="fa fa-trash mr-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        /* Scoped Button Styles for Addresses Page */
.custom-address-btn-primary {
    background-color: #1077af;  /* Your primary color */
    color: white;
    border: none;
}

.custom-address-btn-primary:hover {
    background-color: #0c3169;  /* Lighter shade for hover */
    color: white;
}

.custom-address-btn-warning {
    background-color: #1077af;  /* Custom warning color */
    color: white;
    border: none;
}

.custom-address-btn-warning:hover {
    background-color: #0c3169;  /* Lighter shade for hover */
    color: white;
}

.custom-address-btn-danger {
    background-color: #1077af;  /* Custom danger color */
    color: white;
    border: none;
}

.custom-address-btn-danger:hover {
    background-color: #0c3169;  /* Lighter shade for hover */
    color: white;
}

/* Add more custom classes as needed for other buttons */

</style>
@endsection
