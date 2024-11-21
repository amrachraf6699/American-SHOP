@extends('layouts.app')
@section('title', 'Home')
@section('content')

        <!--=====================================-->
        <!--=        Banner Area Start       	=-->
        <!--=====================================-->
        <section class="banner banner-style-1">
            <div class="container">
                <div class="banner-slider">
                    @foreach ($home_sliders as $banner)
                    <div class="banner-slider-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="banner-content" data-sal="slide-up" data-sal-duration="1000"
                                    data-sal-delay="100">
                                    <h1 class="title">{{ $banner->title }}</h1>
                                    <p class="subtitle mb--48">{{ $banner->description}}</p>
                                    <a href="{{ $banner->link }}" class="shop-btn"
                                        {{ $banner->opens_new_tab ? 'target="_blank"' : '' }}>
                                        DISCOVER
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                     </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner-thumbnail">
                                    <div class="banner-img" data-sal="zoom-in" data-sal-duration="1000"
                                        data-sal-delay="100">
                                        <img src="{{ asset($banner->cover) }}" alt="banner-img-1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>


        <!--=====================================-->
        <!--=        Top category Area Start       	=-->
        <!--=====================================-->
        <section class="top-category-products section-margin" id="top-category-products">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header position-relative">
                            <div class="title">
                                <h4>Shop By Category</h4>
                            </div>
                            <div class="box-button-swiper">
                                <div class="swiper-button-prev swiper-button-prev-collection btn-prev-style-1"><i
                                    class="fas fa-chevron-right"></i></div>
                                <div class="swiper-button-next swiper-button-next-collection btn-next-style-1"><i
                                    class="fas fa-chevron-left"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-swiper">
                    <div class="swiper-container swiper-6-items pb-0">
                        <div class="swiper-wrapper">
                            @foreach ($top_categories as $category)
                            <div class="swiper-slide" data-sal="slide-up" data-sal-duration="800" data-sal-delay="100">
                                <div class="trend-info text-center">
                                    <div class="trend-img">
                                        <a href="{{ route('category' , $category) }}"><img src="{{ asset($category->cover) }}" alt="shop-img-1"></a>
                                    </div>
                                    <a href="{{ route('category' , $category) }}">
                                        <h5 class="heading">{{ $category->name }}
                                            <svg class="svg-icon"
                                                xmlns="http://www.w3.org/2000/svg" width="21" height="21"
                                                viewBox="0 0 21 21" fill="none">
                                                <path
                                                    d="M15.0495 10.5082C15.0454 10.0698 14.8688 9.65061 14.5578 9.34153L10.9828 5.7582C10.8267 5.60299 10.6155 5.51587 10.3953 5.51587C10.1752 5.51587 9.96395 5.60299 9.80781 5.7582C9.72971 5.83567 9.66771 5.92783 9.6254 6.02938C9.5831 6.13093 9.56131 6.23985 9.56131 6.34986C9.56131 6.45987 9.5831 6.56879 9.6254 6.67034C9.66771 6.77189 9.72971 6.86406 9.80781 6.94153L12.5495 9.67486H4.21615C3.99513 9.67486 3.78317 9.76266 3.62689 9.91894C3.47061 10.0752 3.38281 10.2872 3.38281 10.5082C3.38281 10.7292 3.47061 10.9412 3.62689 11.0975C3.78317 11.2537 3.99513 11.3415 4.21615 11.3415H12.5495L9.80781 14.0832C9.65089 14.239 9.5623 14.4508 9.56152 14.6719C9.56074 14.8931 9.64783 15.1054 9.80365 15.2624C9.95946 15.4193 10.1712 15.5079 10.3924 15.5087C10.6135 15.5094 10.8259 15.4223 10.9828 15.2665L14.5578 11.6832C14.8708 11.3721 15.0476 10.9495 15.0495 10.5082Z"
                                                    fill="#4F5D81" />
                                            </svg>
                                        </h5>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================-->
        <!--=        Flash sell Start       	=-->
        <!--=====================================-->
        <section class="flash-sell section-margin" id="flash-sell">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header d-flex justify-content-between">
                            <h4>Catch Those Discounts</h4>
                            <div class="trend-icon">
                                <a href="product-list.html">View all <svg xmlns="http://www.w3.org/2000/svg" width="26"
                                        height="26" viewBox="0 0 26 26" fill="none">
                                        <path
                                            d="M8.52048 16.7126L17.9766 9.32462M17.9766 9.32462L11.6601 8.54904M17.9766 9.32462L17.201 15.6411"
                                            stroke="#161C2D" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @forelse($flash_sell as $product)
                    <div class="col-lg-3 col-md-6">
                        <div class="selling-product-wrapper">
                            <div class="flash-selling-content text-center">
                                <a href="{{ route('product' , $product) }}"><img src="{{ asset($product->cover) }}" alt="shop-img-1"></a>
                            </div>
                            <div class="product-info">
                                <a href="{{ route('product' , $product) }}">
                                    <h6>{{ $product->name }}</h6>
                                </a>
                                <div class="product-selling-price d-flex justify-content-between align-items-center">
                                    <p>JOD {{ $product->price }} <span><del><small>JOD{{ $product->price + $product->discount }}</small></del></span></p>
                                    <div class="product-review d-flex justify-content-between align-items-center">
                                        <div class="review-icon">
                                            {!! $product->stars !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-overlay">
                                <div class="product-overlay-icon">
                                    <form action="{{ route('cart.add') }}" method="POST" id="wish-form-{{ $product->id }}">
                                        @csrf
                                        @if (auth()->check())
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <a href="javascript:void(0)" onclick="this.closest('form').submit();">
                                                <i class="fa fa-shopping-cart text-white" aria-hidden="true"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}">
                                                <i class="fa fa-shopping-cart text-white" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </form>
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
                                <a href="{{ route('product' , $product) }}">View Details</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p> No Flash Sell Products Found Yet</p>
                    @endforelse
                </div>

            </div>
        </section>
        <!--=====================================-->
        <!--=     New Arrival products Area Start  	=-->
        <!--=====================================-->
        <section class="new-arrivals-products flash-sell section-margin" id="new-arrivals-products">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header d-flex justify-content-between">
                            <h4>New Arrival</h4>
                            <div class="trend-icon">
                                <a href="javascript:void(0)">View all <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                        viewBox="0 0 26 26" fill="none">
                                        <path
                                            d="M8.52048 16.7126L17.9766 9.32462M17.9766 9.32462L11.6601 8.54904M17.9766 9.32462L17.201 15.6411"
                                            stroke="#161C2D" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="row mb-5">
                            @forelse($new_arrival as $product)
                            <div class="col-lg-3 col-sm-6" data-sal="slide-up" data-sal-duration="800" data-sal-delay="100">
                                <div class="selling-product-wrapper">
                                    <div class="flash-selling-content text-center">
                                        <a href="{{ route('product' , $product) }}">
                                            <img src="{{ asset($product->cover) }}" alt="shop-img-1">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ route('product' , $product) }}">
                                            <h6>{{ $product->name }}</h6>
                                        </a>
                                        <div class="product-selling-price d-flex justify-content-between align-items-center">
                                            <p>
                                                JOD {{ number_format($product->price, 2) }}
                                            </p>
                                            <div class="product-review d-flex justify-content-between align-items-center">
                                                <div class="review-icon">
                                                    {!! $product->stars !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="product-overlay-icon">
                                            <form action="{{ route('cart.add') }}" method="POST" id="wish-form-{{ $product->id }}">
                                                @csrf
                                                @if (auth()->check())
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <a href="javascript:void(0)" onclick="this.closest('form').submit();">
                                                        <i class="fa fa-shopping-cart text-white" aria-hidden="true"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('login') }}">
                                                        <i class="fa fa-shopping-cart text-white" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                            </form>
                                            <form action="{{ route('wish', $product) }}" method="POST" id="wish-form-{{ $product->id }}">
                                                @csrf
                                                @if (auth()->check())
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
                                        <a href="{{ route('product' , $product) }}">View Details</a>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <p>No new arrivals found.</p>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
        </section>
@endsection
