@extends('layouts.app')
@section('title', 'My Account')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg rounded-lg border-0">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Welcome, {{ $user->name }}</h2>

                        <div class="mb-4">
                            <h5 class="fw-bold">Name:</h5>
                            <p>{{ $user->name }}</p>
                        </div>

                        <div class="mb-4">
                            <h5 class="fw-bold">Email:</h5>
                            <p>{{ $user->email }}</p>
                        </div>

                        <div class="mb-4">
                            <h5 class="fw-bold">Phone:</h5>
                            <p>{{ $user->phone }}</p>
                        </div>

                        <hr>

                        <!-- Account Items -->
                        <div class="account-item my-4">
                            <a href="{{ route('user.edit') }}" class="account-link">
                                <h6>Edit Profile</h6>
                                <p>Update your personal information and settings</p>
                            </a>
                        </div>

                        <div class="account-item my-4">
                            <a href="{{ route('orders.index') }}" class="account-link">
                                <h6>Order History</h6>
                                <p>View and manage your past orders</p>
                            </a>
                        </div>

                        <div class="account-item my-4">
                            <a href="{{ route('addresses.index') }}" class="account-link">
                                <h6>Addresses</h6>
                                <p>Manage your shipping and billing addresses</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
    .account-item {
    padding: 15px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.account-item:hover {
    background-color: #f9f9f9;
}

.account-link {
    text-decoration: none;
    color: inherit;
}

</style>
@endsection
