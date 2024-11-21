@extends('layouts.app')
@section('title', 'Login')
@section('content')

<section class="login-section section-margin">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-8">
                <div class="login-box text-center p-4">
                    <h4 class="mb-4">Welcome Back!</h4>
                    <p class="text-muted mb-4">Sign in to continue shopping with us</p>

                    <!-- Login Form -->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <!-- Email Input -->
                        <div class="form-group mb-3">
                            <input type="text" class="form-control input-style @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="form-group mb-4">
                            <input type="password" class="form-control input-style @error('email') is-invalid @enderror" name="password" placeholder="Password">
                            @error('password')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>

                        <!-- Forgot Password Link -->
                        <a href="" class="text-muted d-block">Forgot Password?</a>
                    </form>

                    <!-- Divider -->
                    <hr class="my-4">

                    <!-- Register Link -->
                    <p class="text-muted">Don't have an account?
                        <a href="{{ route('register') }}" class="text-primary">Sign Up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Additional Styles -->
<style>
    .login-section {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f9f9f9;
    }
    .login-box {
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
    .text-danger {
        font-size: 0.875rem;
    }
</style>

@endsection
