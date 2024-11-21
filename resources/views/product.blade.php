@extends('layouts.app')
@section('title', $product->name)
@section('content')
<section class="product-details-wrapper section-margin">
    <div class="text-uppercase product-background">
      <h2>{{ $product->name }}</h2>
    </div>
    <div class="container">
      <div class="row mt--80">
        <div class="col-lg-6 col-md-12 box-images-product-left">
          <div class="detail-gallery-2">
            <div class="box-main-gallery">
              <div class="product-image-slider">
                <img src="{{ asset($product->cover) }}" id="MainImg" class="image" alt="product">
                <div class="clear"></div>
              </div>
            </div>
            <div class="slider-thumbnails d-flex align-items-center">
                @foreach ($product->files as $image)
                <div class="item-thumb text-center"><img src="{{ $image->url }}" class="small-img" alt="product">
                </div>
                @endforeach
            </div>
            <div class="product-faq mb--64">
              <div class="accordion mt--32" id="accordionExample-st-2">
                <div class="bd-faq-group">
                  <div class="accordion-item mb--48">
                    <h2 class="accordion-header" id="headingOne-st-2">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-st-2" aria-expanded="false" aria-controls="collapseOne-st-2">
                        Description
                      </button>
                    </h2>
                    <div id="collapseOne-st-2" class="accordion-collapse collapse" aria-labelledby="headingOne-st-2" data-bs-parent="#accordionExample-st-2">
                      <div class="accordion-body">
                        <p>{{ $product->description }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="d-md-flex md-block justify-content-between product-content-right">
            <div class="box-product-info">
              <h3 class="font-2xl-bold mb--20">{{ $product->name }}</h3>
              <h3 class="block-price mb--20">JOD {{ $product->price }} @if($product->discount) <small class="text-muted"><del>JOD {{ $product->discount + $product->price }}</del></small> @endif</hjson>
              <div class="block-rating review-icon mb--20">
                {!! $product->stars !!}
              </div>
              <div class="block-view">
                <p class="block-pera">{{ $product->description }}</p>
              </div>
              <div class="block-quantity">
                <span>Quantity</span>
                <div class="box-form-cart d-flex align-items-center">
                  <div class="form-cart d-flex align-items-center justify-content-between">
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="d-flex align-items-center">
                        @csrf
                    <span class="minus mr--20"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
                        <g clip-path="url(#clip0_446_24191)">
                          <path d="M13.125 8.65979H0.875C0.390833 8.65979 0 8.26896 0 7.78479C0 7.30062 0.390833 6.90979 0.875 6.90979H13.125C13.6092 6.90979 14 7.30062 14 7.78479C14 8.26896 13.6092 8.65979 13.125 8.65979Z" fill="#9D9FA2"></path>
                        </g>
                        <defs>
                          <clipPath id="clip0_446_24191">
                            <rect width="14" height="14" fill="white" transform="translate(0 0.493103)"></rect>
                          </clipPath>
                        </defs>
                      </svg></span>
                    <input class="form-control" type="text" value="1" name="quantity">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <span class="plus ml--20"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                        <path d="M17 11.4931H13V7.4931C13 7.22789 12.8946 6.97353 12.7071 6.786C12.5196 6.59846 12.2652 6.4931 12 6.4931C11.7348 6.4931 11.4804 6.59846 11.2929 6.786C11.1054 6.97353 11 7.22789 11 7.4931V11.4931H7C6.73478 11.4931 6.48043 11.5985 6.29289 11.786C6.10536 11.9735 6 12.2279 6 12.4931C6 12.7583 6.10536 13.0127 6.29289 13.2002C6.48043 13.3877 6.73478 13.4931 7 13.4931H11V17.4931C11 17.7583 11.1054 18.0127 11.2929 18.2002C11.4804 18.3877 11.7348 18.4931 12 18.4931C12.2652 18.4931 12.5196 18.3877 12.7071 18.2002C12.8946 18.0127 13 17.7583 13 17.4931V13.4931H17C17.2652 13.4931 17.5196 13.3877 17.7071 13.2002C17.8946 13.0127 18 12.7583 18 12.4931C18 12.2279 17.8946 11.9735 17.7071 11.786C17.5196 11.5985 17.2652 11.4931 17 11.4931Z" fill="#9D9FA2"></path>
                      </svg></span>
                  </div>
                  <button class="btn btn-cart btn-brand-1 mr--20 ml--20" href="javascript:void(0)">Add to Cart</button>
                  </form>
                  @auth
                  <form id="wishForm" action="{{ route('wish', $product) }}" method="POST">
                      @csrf
                      <a class="wish-cart" href="javascript:void(0)" onclick="document.getElementById('wishForm').submit();">
                          <i class="{{ auth()->user()->wishList()->where('product_id', $product->id)->exists() ? 'fas fa-heart text-danger' : 'far fa-heart text-black' }}" style="font-size: 24px;"></i>
                      </a>
                  </form>
                @endauth
                </div>
              </div>
              <div class="box-product-categories">
                <span>Social Share:</span>
                <div class="share-icon text-center">
                    <!-- Facebook Share -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}&quote=What%20a%20great%20product.%20Check%20{{ urlencode($product->name) }}%20at%20{{ env('APP_NAME') }}%20{{ urlencode(url()->current()) }}" target="_blank" class="facebook-share">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <!-- WhatsApp Share -->
                    <a href="https://wa.me/?text=What%20a%20great%20product.%20Check%20{{ urlencode($product->name) }}%20at%20{{ env('APP_NAME') }}%20{{ urlencode(url()->current()) }}" target="_blank" class="whatsapp-share">
                        <i class="fab fa-whatsapp"></i>
                    </a>

                    <!-- Twitter Share -->
                    <a href="https://twitter.com/intent/tweet?text=What%20a%20great%20product.%20Check%20{{ urlencode($product->name) }}%20at%20{{ env('APP_NAME') }}%20{{ urlencode(url()->current()) }}" target="_blank" class="twitter-share">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>
              <div class="box-product-categories">
                <span class="mb--40">Product Categories:</span>
                @foreach ($product->categories as $category)
                <a class="category-item-wrapper d-flex justify-content-between" href="{{ route('category' , $category) }}">
                  <p>{{ $category->name }}</p>
                  <span>{{ $category->products->count() }}</span>
                </a>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>

<style>
.share-icon {
    display: flex;
    gap: 15px;
}

.share-icon a {
    display: inline-block;
    width: 30px; /* Adjust icon size */
    border-radius: 12%;
    background-color: #f0f0f0;
    transition: background-color 0.3s ease;
    font-size: 20px; /* Adjust icon size */
    color: #000; /* Default color */
}

.share-icon a:hover {
    background-color: #ddd;
}

.share-icon .facebook-share {
    background-color: #1877F2;
}

.share-icon .whatsapp-share {
    background-color: #25D366;
}


.share-icon .twitter-share {
    background-color: #1DA1F2;
}

.share-icon i {
    color: white; /* Icon color */
    font-size: 20px; /* Adjust icon size */
}

.share-icon a:hover i {
    color: white; /* Keep icon color on hover */
}

</style>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantityInput = document.querySelector('.form-control');
        const minusButton = document.querySelector('.minus');
        const plusButton = document.querySelector('.plus');

        minusButton.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1; // Decrease the quantity
            }
        });

        plusButton.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1; // Increase the quantity
        });
    });


</script>
@endpush
@endsection

