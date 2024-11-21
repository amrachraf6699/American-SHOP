@extends('layouts.app')
@section('title', 'Search')
@section('content')
<section class="fashion-product flash-sell product-style-4 section-margin" id="fashion-product">
    <div class="product-background">
        <h2>Search Results</h2>
        <ul class="breadcrumb-items list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li> \ </li>
            <li class="active">
                <a href="#">Search Results</a>
            </li>
        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="product-category-wrapper">
                <form action="" method="GET">
                    <div class="row">
                        <!-- Product Categories Filter -->
<div class="col-lg-5 col-md-6">
    <div class="block-filter">
        <h6 class="item-collapse">Product Categories</h6>
        <div class="box-collapse">
            <ul class="list-filter-checkbox product-scroll">
                @foreach($categories as $category)
                    <li>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="categories[]"
                                   value="{{ $category->id }}"
                                   id="category_{{ $category->id }}"
                                   @if(in_array($category->id, request()->get('categories', []))) checked @endif>
                            <label class="form-check-label" for="category_{{ $category->id }}">
                                {{ $category->name }} ({{ $category->products_count }})
                            </label>
                        </div>
                    </li>

                    <!-- Check if the category has children -->
                    @if($category->children->isNotEmpty())
                        @foreach($category->children as $child)
                            <li style="padding-left: 20px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="categories[]"
                                           value="{{ $child->id }}"
                                           id="category_{{ $child->id }}"
                                           @if(in_array($child->id, request()->get('categories', []))) checked @endif>
                                    <label class="form-check-label" for="category_{{ $child->id }}">
                                        {{ $child->name }} ({{ $child->products->count() }})
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>



                        <!-- Price Range Filter -->
                        <div class="col-lg-4 col-md-6">
                            <div class="block-filter">
                                <h6 class="item-collapse">Price Range</h6>
                                    <div class="input-group">
                                        <!-- Min Price Input -->
                                        <input type="number"
                                               class="form-control"
                                               name="min_price"
                                               placeholder="Min"
                                               value="{{ request()->get('min_price') }}">

                                        <span class="input-group-text">-</span>

                                        <!-- Max Price Input -->
                                        <input type="number"
                                               class="form-control"
                                               name="max_price"
                                               placeholder="Max"
                                               value="{{ request()->get('max_price') }}">
                                    </div>
                            </div>
                        </div>

                        <!-- Search by Text -->
                        <div class="col-lg-3 col-md-6">
                            <div class="block-filter">
                                <h6 class="item-collapse">Search</h6>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Start Typing......." value="{{ request()->get('search') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Apply Filter Button -->
                        <div class="col-12 d-flex justify-content-center mt-4">
                            <div class="block-filter">
                                <button type="submit" class="apply-btn">Apply Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
                    </div>
                </div>
            </div>
            @if($products->isEmpty())
            <section class="error-page">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="error-page-content mt--80 text-center">
                                <h1>404</h1>
                                <h3>We don't have any products for your search</h3>
                                <div class="error-img mt--120 sal-animate" data-sal="zoom-in" data-sal-duration="1000" data-sal-delay="100">
                                    <img src="assets/media/others/404.png" alt="404">
                                </div>
                                <a class="error-btn" href="{{ route('home') }}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M4.99739 10C5.00145 9.5616 5.1781 9.14243 5.48906 8.83335L9.06406 5.25002C9.2202 5.09481 9.43141 5.00769 9.65156 5.00769C9.87172 5.00769 10.0829 5.09481 10.2391 5.25002C10.3172 5.32749 10.3792 5.41965 10.4215 5.5212C10.4638 5.62275 10.4856 5.73167 10.4856 5.84168C10.4856 5.95169 10.4638 6.06062 10.4215 6.16216C10.3792 6.26371 10.3172 6.35588 10.2391 6.43335L7.49739 9.16668H15.8307C16.0517 9.16668 16.2637 9.25448 16.42 9.41076C16.5763 9.56704 16.6641 9.779 16.6641 10C16.6641 10.221 16.5763 10.433 16.42 10.5893C16.2637 10.7456 16.0517 10.8334 15.8307 10.8334H7.49739L10.2391 13.575C10.396 13.7308 10.4846 13.9426 10.4854 14.1637C10.4861 14.3849 10.399 14.5973 10.2432 14.7542C10.0874 14.9111 9.87564 14.9997 9.65451 15.0005C9.43337 15.0013 9.22098 14.9142 9.06406 14.7584L5.48906 11.175C5.17607 10.8639 4.99926 10.4413 4.99739 10Z" fill="white"></path>
                                    </svg> Back to home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @else
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header-filter d-flex text-center">
                        @php
                            $currentPage = $products->currentPage();
                            $perPage = $products->perPage();
                            $totalResults = $products->total();
                            $start = ($currentPage - 1) * $perPage + 1;
                            $end = min($start + $perPage - 1, $totalResults);
                        @endphp
                        <h4 class="text-center">Showing {{ $start }}-{{ $end }} of {{ $totalResults }} results</h4>
                    </div>
                </div>
                @foreach ($products as $product)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="selling-product-wrapper border rounded p-2">
                            <div class="flash-selling-content text-center">
                                <a href="{{ route('product', $product) }}">
                                    <img src="{{ $product->cover }}" alt="{{ $product->name }}" class="img-fluid" style="max-height: 150px; object-fit: cover;"> <!-- Reduced image size -->
                                </a>
                            </div>
                            <div class="product-info text-center mt-2">
                                <a href="{{ route('product', $product) }}">
                                    <h6 class="product-name text-truncate">{{ $product->name }}</h6>
                                </a>
                                <div class="product-selling-price d-flex justify-content-center align-items-center mb-1">
                                    <p class="m-0">JOD {{ $product->price }} @if ($product->discount) <span class="text-muted text-decoration-line-through ms-2">JOD {{ $product->price + $product->discount }}</span> @endif</p>
                                </div>
                                <div class="review-icon mb-1">
                                    @php
                                        $averageRating = $product->averageRating();
                                        $reviewsCount = $product->ratings()->count();
                                    @endphp

                                        @if ($reviewsCount > 0)
                                            @php
                                                $fullStars = floor($averageRating);
                                                $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                                                $emptyStars = 5 - ($fullStars + $halfStar);
                                            @endphp

                                            {{-- Display full stars --}}
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor

                                            {{-- Display half star if needed --}}
                                            @if ($halfStar)
                                                <i class="fas fa-star-half-alt"></i>
                                            @endif

                                            {{-- Display empty stars --}}
                                            @for ($i = 0; $i < $emptyStars; $i++)
                                                <i class="far fa-star"></i>
                                            @endfor
                                    <span class="rating-count">({{ $reviewsCount }})</span>
                                        @else
                                            <p class="text-muted">No reviews yet</p>
                                        @endif
                                </div>
                            </div>
                            <div class="product-overlay text-center mt-2">
                                <div class="product-overlay-icon d-flex justify-content-center">
                                    <a href="{{ route('product', $product) }}" class="me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 25 25" fill="none">
                                            <path d="M21.6706 20.2367L18.3152 16.8921C19.5447 15.3872 20.1493 13.4668 20.0037 11.5282C19.8582 9.58966 18.9737 7.78124 17.5332 6.47702C16.0928 5.17281 14.2065 4.47258 12.2647 4.52117C10.3228 4.56976 8.47387 5.36346 7.10034 6.73809C5.7268 8.11272 4.93373 9.96311 4.88518 11.9065C4.83663 13.8499 5.5363 15.7377 6.83948 17.1793C8.14266 18.6209 9.94964 19.5061 11.8867 19.6517C13.8237 19.7974 15.7425 19.1924 17.2463 17.9618L20.6018 21.3064C20.7443 21.4442 20.9353 21.5205 21.1335 21.5188C21.3317 21.517 21.5213 21.4375 21.6614 21.2972C21.8016 21.157 21.8811 20.9672 21.8828 20.7689C21.8845 20.5705 21.8083 20.3794 21.6706 20.2367ZM12.466 18.16C11.27 18.16 10.1008 17.8051 9.10636 17.1401C8.1119 16.4751 7.33682 15.5299 6.87912 14.424C6.42142 13.3182 6.30167 12.1013 6.535 10.9273C6.76833 9.75336 7.34427 8.675 8.18999 7.82861C9.0357 6.98222 10.1132 6.40582 11.2863 6.1723C12.4593 5.93878 13.6752 6.05863 14.7802 6.5167C15.8851 6.97476 16.8296 7.75046 17.4941 8.74571C18.1585 9.74096 18.5132 10.911 18.5132 12.108C18.5114 13.7126 17.8737 15.2509 16.74 16.3855C15.6063 17.52 14.0693 18.1582 12.466 18.16Z" fill="white" />
                                        </svg>
                                    </a>
                                    <a data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenuRight" href="javascript:void(0)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 25 25" fill="none">
                                            <path d="M17.2771 5.5188C16.4798 5.5312 15.6999 5.75381 15.0161 6.16415C14.3324 6.57449 13.769 7.15802 13.3828 7.85583C12.9967 7.15802 12.4333 6.57449 11.7495 6.16415C11.0658 5.75381 10.2858 5.5312 9.48855 5.5188C8.21756 5.57403 7.02009 6.13015 6.15774 7.06565C5.29539 8.00115 4.83827 9.24 4.88624 10.5115C4.88624 13.7317 8.27496 17.2486 11.1171 19.633C11.7516 20.1664 12.5539 20.4588 13.3828 20.4588C14.2117 20.4588 15.014 20.1664 15.6486 19.633C18.4907 17.2486 21.8794 13.7317 21.8794 10.5115C21.9274 9.24 21.4702 8.00115 20.6079 7.06565C19.7455 6.13015 18.5481 5.57403 17.2771 5.5188ZM14.7387 18.5495C14.3592 18.8692 13.879 19.0445 13.3828 19.0445C12.8866 19.0445 12.4064 18.8692 12.0269 18.5495C8.38895 15.4965 6.30234 12.5674 6.30234 10.5115C6.25393 9.61548 6.56174 8.73662 7.15862 8.06665C7.7555 7.39669 8.59304 6.98996 9.48855 6.93518C10.3841 6.98996 11.2216 7.39669 11.8185 8.06665C12.4154 8.73662 12.7232 9.61548 12.6748 10.5115C12.6748 10.6994 12.7494 10.8795 12.8821 11.0123C13.0149 11.1451 13.195 11.2197 13.3828 11.2197C13.5706 11.2197 13.7507 11.1451 13.8835 11.0123C14.0163 10.8795 14.0909 10.6994 14.0909 10.5115C14.0425 9.61548 14.3503 8.73662 14.9471 8.06665C15.544 7.39669 16.3816 6.98996 17.2771 6.93518C18.1726 6.98996 19.0101 7.39669 19.607 8.06665C20.2039 8.73662 20.5117 9.61548 20.4633 10.5115C20.4633 12.5674 18.3767 15.4965 14.7387 18.5495Z" fill="white" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif

            <nav class="box-pagination mt--80">
                {{$products->links('vendor.pagination.custom')}}
            </nav>
        </div>
</section>

<style>
    .form-group {
    margin-bottom: 1.5rem;
    }

    .custom-checkbox {
        display: flex;
        align-items: center;
    }

    .custom-checkbox input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        cursor: pointer;
    }

    .custom-checkbox label {
        font-weight: bold;
        font-size: 1rem;
        cursor: pointer;
    }

    .apply-btn {
        width: 100%;
        padding: 0.75rem;
        font-size: 1rem;
    }

    /* Close button */
    .close-btn {
        cursor: pointer;
        background: none;
        border: none;
        font-size: 18px;
        font-weight: bold;
        color: #333;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    /* Form group styling */
    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    /* Form button styling */
    .apply-btn {
        width: 100%;
        padding: 12px;
        background-color: #1077af;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
    }

    .apply-btn:hover {
        background-color: #054669;
    }
</style>
@endsection
