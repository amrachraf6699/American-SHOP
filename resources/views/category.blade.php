@extends('layouts.app')
@section('title', $category->name)
@section('content')
<section class="fashion-product flash-sell product-style-3 product-style-2 section-margin" id="fashion-product">
    <div class="product-background" style="background-image: url('{{ $category->cover }}'); background-size: cover; background-position: center; position: relative; padding: 60px 0;">
        <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.6);"></div>
        <h2 class="text-white position-relative text-uppercase font-weight-bold">{{ $category->name }}</h2>
        <p class="text-white position-relative">{{ $category->description }}</p>
    </div>
    <div class="container">
        <div class="row">
            <h4 class="section-title mt-2 mb-2 text-center">Products</h4>
        </div>
        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-md-4 offset-md-4">
                <form method="GET" action="{{ route('category', $category) }}">
                    <select name="child_category_id" class="form-control" onchange="this.form.submit()">
                        <option value="">All Products</option>
                        @foreach($category->children as $child)
                            <option value="{{ $child->id }}" {{ $child->id == $childCategoryId ? 'selected' : '' }}>
                                {{ $child->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
        <!-- Product Grid -->
        <div class="row">
            @forelse($products as $product)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="selling-product-wrapper">
                    <div class="flash-selling-content text-center">
                        <a href="{{ route('product', $product) }}">
                            <img src="{{ $product->cover }}" alt="product" class="img-fluid">
                        </a>
                    </div>
                    <div class="product-info">
                        <a href="{{ route('product', $product) }}">
                            <h6>{{ $product->name }}</h6>
                        </a>
                        <div class="product-selling-price d-flex justify-content-between align-items-center">
                            @if ($product->discount)
                                <p>
                                    JOD{{ $product->price }}
                                    <span><del>JOD{{ $product->price + $product->discount }}</del></span>
                                </p>
                            @else
                                <p>JOD{{ number_format($product->price, 2) }}</p>
                            @endif
                            <div class="product-review d-flex justify-content-between align-items-center">
                                <div class="review-icon">
                                    {!! $product->stars !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-overlay">
                        <div class="product-overlay-icon">
                            <a href="{{ route('product', $product) }}">
                                <i class="fa fa-search" aria-hidden="true" style="color: white;"></i>
                            </a>
                            <a href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenuCart">
                                <i class="fa fa-shopping-cart" aria-hidden="true" style="color: white;"></i>
                            </a>
                            <form action="{{ route('wish', $product) }}" method="POST" id="wish-form-{{ $product->id }}">
                                @csrf
                                @if(auth()->check())
                                    <a href="javascript:void(0)" onclick="this.closest('form').submit();">
                                        <i class="fa fa-heart {{ auth()->user()->hasWished($product) ? 'text-danger' : 'text-white' }}" aria-hidden="true"></i>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}">
                                        <i class="fa fa-heart text-white" aria-hidden="true"></i>
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="add-btn">
                        <a href="{{ route('product', $product) }}">View Details</a>
                    </div>
                </div>
            </div>
            @empty
            <section class="error-page">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="error-page-content mt--80 text-center">
                                <h1>404</h1>
                                <h3>We don't have any products in this category</h3>
                                <div class="error-img mt--120 sal-animate" data-sal="zoom-in" data-sal-duration="1000" data-sal-delay="100">
                                    <img src="{{ asset('assets/media/others/404.png') }}" alt="404">
                                </div>
                                <a class="error-btn" href="{{ route('home') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M4.99739 10C5.00145 9.5616 5.1781 9.14243 5.48906 8.83335L9.06406 5.25002C9.2202 5.09481 9.43141 5.00769 9.65156 5.00769C9.87172 5.00769 10.0829 5.09481 10.2391 5.25002C10.3172 5.32749 10.3792 5.41965 10.4215 5.5212C10.4638 5.62275 10.4856 5.73167 10.4856 5.84168C10.4856 5.95169 10.4638 6.06062 10.4215 6.16216C10.3792 6.26371 10.3172 6.35588 10.2391 6.43335L7.49739 9.16668H15.8307C16.0517 9.16668 16.2637 9.25448 16.42 9.41076C16.5763 9.56704 16.6641 9.779 16.6641 10C16.6641 10.221 16.5763 10.433 16.42 10.5893C16.2637 10.7456 16.0517 10.8334 15.8307 10.8334H7.49739L10.2391 13.575C10.396 13.7308 10.4846 13.9426 10.4854 14.1637C10.4861 14.3849 10.399 14.5973 10.2432 14.7542C10.0874 14.9111 9.87564 14.9997 9.65451 15.0005C9.43337 15.0013 9.22098 14.9142 9.06406 14.7584L5.48906 11.175C5.17607 10.8639 4.99926 10.4413 4.99739 10Z" fill="white"></path>
                                    </svg> Back to home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endforelse
        </div>
        @if($products->isNotEmpty())
        <nav class="box-pagination mt--80">
            {{$products->links('vendor.pagination.custom')}}
        </nav>
        @endif
    </div>
</section>
@endsection
