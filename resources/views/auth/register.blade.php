@extends('layouts.app')
@section('title', 'Register')
@section('content')

<section class="register-section section-margin">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-8">
                <div class="register-box text-center p-4">
                    <h4 class="mb-4">Create an Account</h4>
                    <p class="text-muted mb-4">Join us and start shopping today!</p>
                    
                    <!-- Registration Form -->
                    <form action="" method="POST">
                        @csrf

                        <!-- Name Input -->
                        <div class="form-group mb-3">
                            <input type="text"
                                class="form-control input-style @error('name') is-invalid @enderror"
                                name="name"
                                placeholder="Name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div class="form-group mb-3">
                            <input type="text"
                                class="form-control input-style @error('email') is-invalid @enderror"
                                name="email"
                                placeholder="Email"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone Input -->
                        <div class="form-group mb-3">
                            <input type="tel"
                                class="form-control input-style @error('phone') is-invalid @enderror"
                                name="phone"
                                placeholder="Phone"
                                value="{{ old('phone') }}">
                            @error('phone')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="form-group mb-3">
                            <input type="password"
                                class="form-control input-style @error('password') is-invalid @enderror"
                                name="password"
                                placeholder="Password">
                            @error('password')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="form-group mb-4">
                            <input type="password"
                                class="form-control input-style"
                                name="password_confirmation"
                                placeholder="Confirm Password">
                        </div>

                        <!-- Register Button -->
                        <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>

                        <!-- Login Link -->
                        <p class="text-muted">Already have an account?
                            <a href="" class="text-primary">Login</a>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Additional Styles -->
<style>
    .register-section {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f9f9f9;
    }
    .register-box {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .input-style {
        border-radius: 6px;
        padding: 10px;
        border: 1px solid #ddd;
    }
    .btn-primary {
        background-color: #4F5D81;
    }
</style>

@endsection
