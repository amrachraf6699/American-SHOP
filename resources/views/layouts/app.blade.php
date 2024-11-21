
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('') }}assets/media/favicon.png">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/vendor/animate.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/vendor/swiper-bundle.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/vendor/slick.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/vendor/sal.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/vendor/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/app.css">

</head>

<body class="sticky-header">
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  	<![endif]-->
    <a href="#main-wrapper" id="backto-top" class="back-to-top">
        <i class="far fa-angle-double-up"></i>
    </a>

    <!-- Preloader Start Here -->
    <div id="preloader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
    <!-- Preloader End Here -->

    <div id="main-wrapper" class="main-wrapper">

        <!--=====================================-->
        <!--=        Header Area Start       	=-->
        <!--=====================================-->
        <header class="header ll-header header-style-1">
            <div id="ll-sticky-placeholder"></div>
            <div class="header-top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <div class="header-top-right">
                                <div class="language-menu text-white">
                                    <a href="javascript:void(0);">LANGUAGE <i class="fas fa-angle-down"></i> </a>
                                    <ul class="language-submenu">
                                        <li>
                                            <img src="{{ asset('') }}assets/media/icon/en.svg" alt="language-icon">
                                            EN
                                        </li>
                                        <li>
                                            <img src="{{ asset('') }}assets/media/icon/ar.png" alt="language-icon">
                                            AR
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle-bar">
                <div class="container">
                    <div class="header-middle-content d-flex justify-content-between align-items-center">
                        <div class="header-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('') }}assets/media/logo.png" alt="logo">
                            </a>
                        </div>

                        <div class="header-search">
                            <form class="search d-flex" method="GET" action="{{ route('search') }}" id="searchForm" style="color: #FFF">
                                <div name="category_list" class="select-wrapper d-flex">
                                    <select name="categories[]" class="select d-flex">
                                        <option value="" selected>All Categories</option>
                                        @foreach ($all_categories as $category)
                                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="text" class="search-input" style="color:black" name="search" placeholder="Search products" value="{{ request()->routeIs('search') ? request('search') : '' }}">

                                <!-- Change the href to use JavaScript to submit the form -->
                                <a href="javascript:void(0)" class="search-icon" onclick="document.getElementById('searchForm').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                        <path d="M21.5178 21.7466L17.1748 17.4036M17.1748 17.4036C17.9177 16.6607 18.507 15.7787 18.909 14.8081C19.3111 13.8375 19.518 12.7972 19.518 11.7466C19.518 10.6959 19.3111 9.65563 18.909 8.68501C18.507 7.71438 17.9177 6.83244 17.1748 6.08955C16.4319 5.34666 15.55 4.75737 14.5793 4.35532C13.6087 3.95328 12.5684 3.74635 11.5178 3.74635C10.4672 3.74635 9.42687 3.95328 8.45624 4.35532C7.48561 4.75737 6.60367 5.34666 5.86078 6.08955C4.36045 7.58988 3.51758 9.62476 3.51758 11.7466C3.51758 13.8683 4.36045 15.9032 5.86078 17.4036C7.36111 18.9039 9.396 19.7468 11.5178 19.7468C13.6396 19.7468 15.6745 18.9039 17.1748 17.4036Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </form>
                        </div>
                        <div class="header-account">
                            @auth
                            <a class="account-icon wishlist" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasMenuRight" href="javascript:void(0)" data-sal="slide-up"
                                data-sal-duration="500" data-sal-delay="100"><span class="number-tag">{{ auth()->user()->wishes()->count() }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21"
                                    fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10 5.74671C8.5005 3.99919 5.99481 3.45913 4.11602 5.05933C2.23723 6.65953 1.97272 9.33497 3.44815 11.2275C4.67487 12.801 8.38733 16.1198 9.60408 17.194C9.74017 17.3141 9.80825 17.3742 9.88766 17.3978C9.95691 17.4184 10.0327 17.4184 10.1021 17.3978C10.1815 17.3742 10.2495 17.3141 10.3857 17.194C11.6024 16.1198 15.3148 12.801 16.5416 11.2275C18.017 9.33497 17.7847 6.6427 15.8737 5.05933C13.9626 3.47597 11.4995 3.99919 10 5.74671Z"
                                        stroke="#4F5D81" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                            <a href="javascript:void(0)" class="account-icon account wishlist" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasAccountMenu" data-sal="slide-up" data-sal-duration="500"
                                data-sal-delay="500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21"
                                fill="none">
                                <path
                                    d="M3.89193 16.0713L3.89703 16.056L3.90113 16.0405L4.31707 14.4599C4.31719 14.4594 4.31731 14.459 4.31743 14.4585C4.84555 12.4992 6.4894 11.2466 8.33426 11.2466H11.6676C13.5206 11.2466 15.1522 12.5056 15.5981 14.3632L15.598 14.3633L15.6007 14.3738L16.0174 15.9571L16.0215 15.9727L16.0266 15.988C16.2186 16.5642 16.0979 17.2284 15.6843 17.7799L15.6715 17.7969L15.6603 17.8149C15.3514 18.309 14.7788 18.5799 14.1676 18.5799H5.83426C5.1581 18.5799 4.63161 18.319 4.22457 17.8502C3.81874 17.3013 3.70138 16.643 3.89193 16.0713ZM4.93791 14.6055L4.93588 14.6124L4.93406 14.6193L4.52082 16.1896C4.39553 16.5894 4.49975 17.101 4.86801 17.416C4.93874 17.5251 5.03673 17.6352 5.17149 17.7251C5.35624 17.8482 5.5801 17.9132 5.83426 17.9132H14.1676C14.657 17.9132 15.0287 17.6759 15.1878 17.5168L15.2228 17.4818L15.2503 17.4406C15.4651 17.1184 15.6201 16.6316 15.481 16.1894L15.0678 14.6193L15.066 14.6124L15.0639 14.6055C14.5918 13.0003 13.2471 11.9132 11.6676 11.9132H8.33426C6.75475 11.9132 5.41 13.0003 4.93791 14.6055ZM10.0009 3.07988C11.8155 3.07988 13.2509 4.52997 13.2509 6.24655C13.2509 7.96313 11.8155 9.41322 10.0009 9.41322C8.1864 9.41322 6.75093 7.96313 6.75093 6.24655C6.75093 4.52997 8.1864 3.07988 10.0009 3.07988ZM10.0009 3.74655C8.57149 3.74655 7.41759 4.87389 7.41759 6.24655C7.41759 7.61921 8.57149 8.74655 10.0009 8.74655C11.4304 8.74655 12.5843 7.61921 12.5843 6.24655C12.5843 4.87389 11.4304 3.74655 10.0009 3.74655Z"
                                    fill="black" stroke="#4F5D81" />
                                </svg>
                            </a>



                            <a class="account-icon" href="{{ route('cart.index') }}">
                                <span class="number-tag">{{ auth()->user()->cartItems()->count() }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                    fill="none">
                                    <mask id="mask0_1384_25300" style="mask-type:luminance" maskUnits="userSpaceOnUse"
                                        x="0" y="0" width="18" height="18">
                                        <path d="M17.3327 0.413219H0.666016V17.0799H17.3327V0.413219Z" fill="white" />
                                    </mask>
                                    <g mask="url(#mask0_1384_25300)">
                                        <path
                                            d="M4.36914 4.57989H14.4621C14.8798 4.57989 15.203 4.94598 15.1512 5.36046L14.6304 9.52711C14.5869 9.87468 14.2915 10.1354 13.9413 10.1354H12.1623H7.22408H6.22099"
                                            stroke="#4F5D81" stroke-width="1.5" stroke-linejoin="round" />
                                        <path
                                            d="M2.05273 3.19062H3.60386C3.91786 3.19062 4.1928 3.40133 4.27443 3.70453L6.42826 11.7045C6.50989 12.0077 6.78483 12.2184 7.09883 12.2184H13.8583"
                                            stroke="#4F5D81" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M7.61046 14.9962C7.99399 14.9962 8.3049 14.6853 8.3049 14.3018C8.3049 13.9182 7.99399 13.6073 7.61046 13.6073C7.22693 13.6073 6.91602 13.9182 6.91602 14.3018C6.91602 14.6853 7.22693 14.9962 7.61046 14.9962Z"
                                            stroke="#4F5D81" stroke-width="1.5" stroke-linejoin="round" />
                                        <path
                                            d="M12.8194 14.9962C13.203 14.9962 13.5139 14.6853 13.5139 14.3018C13.5139 13.9182 13.203 13.6073 12.8194 13.6073C12.4359 13.6073 12.125 13.9182 12.125 14.3018C12.125 14.6853 12.4359 14.9962 12.8194 14.9962Z"
                                            stroke="#4F5D81" stroke-width="1.5" stroke-linejoin="round" />
                                    </g>
                                </svg>
                            </a>
                            @else
                            <a href="{{ route('login') }}" class="account-icon login" data-sal="slide-up" data-sal-duration="500"
                                data-sal-delay="500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21"
                                    fill="none">
                                    <path
                                        d="M3.89193 16.0713L3.89703 16.056L3.90113 16.0405L4.31707 14.4599C4.31719 14.4594 4.31731 14.459 4.31743 14.4585C4.84555 12.4992 6.4894 11.2466 8.33426 11.2466H11.6676C13.5206 11.2466 15.1522 12.5056 15.5981 14.3632L15.598 14.3633L15.6007 14.3738L16.0174 15.9571L16.0215 15.9727L16.0266 15.988C16.2186 16.5642 16.0979 17.2284 15.6843 17.7799L15.6715 17.7969L15.6603 17.8149C15.3514 18.309 14.7788 18.5799 14.1676 18.5799H5.83426C5.1581 18.5799 4.63161 18.319 4.22457 17.8502C3.81874 17.3013 3.70138 16.643 3.89193 16.0713ZM4.93791 14.6055L4.93588 14.6124L4.93406 14.6193L4.52082 16.1896C4.39553 16.5894 4.49975 17.101 4.86801 17.416C4.93874 17.5251 5.03673 17.6352 5.17149 17.7251C5.35624 17.8482 5.5801 17.9132 5.83426 17.9132H14.1676C14.657 17.9132 15.0287 17.6759 15.1878 17.5168L15.2228 17.4818L15.2503 17.4406C15.4651 17.1184 15.6201 16.6316 15.481 16.1894L15.0678 14.6193L15.066 14.6124L15.0639 14.6055C14.5918 13.0003 13.2471 11.9132 11.6676 11.9132H8.33426C6.75475 11.9132 5.41 13.0003 4.93791 14.6055ZM10.0009 3.07988C11.8155 3.07988 13.2509 4.52997 13.2509 6.24655C13.2509 7.96313 11.8155 9.41322 10.0009 9.41322C8.1864 9.41322 6.75093 7.96313 6.75093 6.24655C6.75093 4.52997 8.1864 3.07988 10.0009 3.07988ZM10.0009 3.74655C8.57149 3.74655 7.41759 4.87389 7.41759 6.24655C7.41759 7.61921 8.57149 8.74655 10.0009 8.74655C11.4304 8.74655 12.5843 7.61921 12.5843 6.24655C12.5843 4.87389 11.4304 3.74655 10.0009 3.74655Z"
                                        fill="black" stroke="#4F5D81" />
                                </svg>
                            </a>
                            @endauth

                            <div class="header-action">
                                <ul class="list-unstyled">
                                    <li class="mobile-menu-btn sidemenu-btn d-lg-none d-block">
                                        <button class="btn-wrap" data-bs-toggle="offcanvas"
                                            data-bs-target="#mobilemenu-popup">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-mainmenu d-flex justify-content-between align-items-center">
                <div class="container">
                    <div class="header-navbar">
                        <div class="header-main-nav">
                            <!-- Start Mainmanu Nav -->
                            <nav class="mainmenu-nav" id="mobilemenu-popup">
                                <div class="d-block d-lg-none">
                                    <div class="mobile-nav-header">
                                        <div class="mobile-nav-logo">
                                            <a href="{{ route('home') }}">
                                                <img src="{{ asset('') }}assets/media/logo.png" alt="Site Logo">
                                            </a>
                                        </div>
                                        <button class="mobile-menu-close" data-bs-dismiss="offcanvas"><i
                                                class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <ul class="mainmenu">
                                    @foreach($all_categories as $category)
                                    <li>
                                        <a href="{{ route('category', $category) }}">{{ $category->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </nav>
                            <!-- End Mainmanu Nav -->
                        </div>
                        <div class="header-info">
                            <ul class="contact-information d-flex justify-content-center align-items-center">
                                <li>
                                    <a href="{{ $website_info->location ?? '#' }}" target="_blank" style="text-decoration: none !important; color: inherit;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none">
                                            <path
                                                d="M10.0013 17.4931C12.918 14.4931 15.8346 11.8068 15.8346 8.4931C15.8346 5.17939 13.223 2.4931 10.0013 2.4931C6.77964 2.4931 4.16797 5.17939 4.16797 8.4931C4.16797 11.8068 7.08464 14.4931 10.0013 17.4931Z"
                                                stroke="#0d618f" stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M10 10.8264C11.3807 10.8264 12.5 9.70719 12.5 8.32644C12.5 6.94573 11.3807 5.82644 10 5.82644C8.61925 5.82644 7.5 6.94573 7.5 8.32644C7.5 9.70719 8.61925 10.8264 10 10.8264Z"
                                                stroke="#0d618f" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span> Location</span>
                                    </a>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none">
                                        <path
                                            d="M8.04513 5.18769C7.86871 4.59956 7.7445 3.98881 7.67792 3.3609C7.61246 2.74373 7.07417 2.28481 6.45355 2.28481H3.57471C2.83442 2.28481 2.26413 2.92419 2.3293 3.6616C2.98571 11.0901 8.90309 17.0075 16.3316 17.6639C17.069 17.7291 17.7084 17.1609 17.7084 16.4206V13.8542C17.7084 12.9172 17.2495 12.3808 16.6323 12.3154C16.0044 12.2488 15.3937 12.1246 14.8055 11.9481C14.0861 11.7324 13.3073 11.9355 12.7762 12.4666L11.5443 13.6985C9.32513 12.4974 7.49579 10.6681 6.29475 8.44894L7.52667 7.21698C8.05775 6.6859 8.26092 5.90706 8.04513 5.18769Z"
                                            stroke="#0d618f" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span> Call - <a style="text-decoration: none !important; color: inherit;" href="tel:{{ $website_info->phone ?? "#" }}">{{ $website_info->phone ?? "#" }}</a></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
          </header>
        <!--=====================================-->
        <!--=        Banner Area Start         =-->
        <!--=====================================-->
        <section class="banner banner-style-2">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </section>

        <!--Start Content-->
        @yield('content')
        <!--End Content-->

        <!--=====================================-->
        <!--=        Footer Area Start       	=-->
        <!--=====================================-->
        <footer id="footer" class="footer">
            <div class="container">
                <div class="footer-top">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="footer-col col4 position-relative">
                                <div class="footer-col-title">
                                    <h6>Stay Connected</h6>
                                    <ul class="social-menu d-flex justify-content-start align-items-center">
                                        <!-- Facebook -->
                                        <li><a href="{{ $website_info->facebook }}" target="_blank" rel="noopener noreferrer">
                                            <i class="fab fa-facebook-f fa-2x"></i>
                                        </a></li>

                                        <!-- Twitter -->
                                        <li><a href="{{ $website_info->twitter }}" target="_blank" rel="noopener noreferrer">
                                            <i class="fab fa-twitter fa-2x"></i>
                                        </a></li>

                                        <!-- Instagram -->
                                        <li><a href="{{ $website_info->instagram }}" target="_blank" rel="noopener noreferrer">
                                            <i class="fab fa-instagram fa-2x"></i>
                                        </a></li>

                                        <!-- WhatsApp -->
                                        <li><a href="{{ $website_info->whatsapp }}" target="_blank" rel="noopener noreferrer">
                                            <i class="fab fa-whatsapp fa-2x"></i>
                                        </a></li>

                                        <!-- YouTube -->
                                        <li><a href="{{ $website_info->youtube }}" target="_blank" rel="noopener noreferrer">
                                            <i class="fab fa-youtube fa-2x"></i>
                                        </a></li>
                                    </ul>
                                    <p>Always stay connected with us and get updated</p>
                                    <div class="d-flex ">
                                        <form action="{{ route('newsletter') }}" method="POST">
                                            @csrf
                                            <input class="footer-input" type="text" name="email"
                                                placeholder="Enter your email" autocomplete="true">
                                            <button class="footer-btn" type="submit">SIGNUP</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="copyright-text text-center text-white">
                            {{ env('APP_NAME') }}.{{ now()->format('Y') }} © All rights reserved
                        </p>
                    </div>
                </div>
            </div>
        </footer>


        <!-- Off-canvas menu -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAccountMenu" aria-labelledby="offcanvasAccountMenuLabel">
    <div class="offcanvas-header">
       <h5 id="offcanvasAccountMenuLabel">Account Menu</h5>
       <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="account-menu">
            @auth
            @if(auth()->user()->type == 'admin')
                <div class="account-item">
                    <a href="{{ route('admin.home') }}" class="account-link" target="_blank">
                        <h6>Manage</h6>
                        <p>Manage your products, Categories and orders</p>
                    </a>
                </div>
            @endif
            @endauth
            <div class="account-item">
                <a href="{{ route('addresses.index') }}" class="account-link">
                    <h6>Addresses</h6>
                    <p>Mange your shipping and billing addresses</p>
                </a>
            </div>
            <div class="account-item">
                <a href="{{ route('user.index') }}" class="account-link">
                    <h6>Account Settings</h6>
                    <p>Manage your personal information</p>
                </a>
            </div>
            <div class="account-item">
                <a href="{{ route('orders.index') }}" class="account-link">
                    <h6>Order History</h6>
                    <p>View past orders</p>
                </a>
            </div>
            <div class="account-item">
                <a href="{{ route('logout') }}" class="account-link logout">
                    <h6>Logout</h6>
                    <p>Sign out of your account</p>
                </a>
            </div>
        </div>
    </div>
    </div>

        <!--=====================================-->
        <!--=       Offcanvas Menu Area       	=-->
        <!--=====================================-->
        <div class="offcanvas offcanvas-end header-offcanvasmenu" tabindex="-1" id="offcanvasMenuRight">
            <div class="offcanvasClose">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-header">
                <h3>Your Wish List</h3>
                <a href="{{ route('wish.clear') }}">
                <button type="button">Clear all</button>
                </a>
            </div>
            <div class="offcanvas-body">
                <div class="row">
                    <div class="col-lg-12 section-margin">
                        @auth
                        @forelse (auth()->user()->wishlist as $item)
                        <div class="wish-item-info position-relative">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="wishImg" style="width: 100%; height: 100%; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                                        <a href="{{ route('product', $item->product) }}">
                                            <img src="{{ asset($item->product->cover) }}" alt="wish" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="product-info">
                                        <a href="{{ route('product', $item->product) }}">
                                            <h6>{{ $item->product->name }}</h6>
                                        </a>
                                        <div class="product-selling-price">
                                            <p>JOD {{ $item->product->price }}</p>
                                            <div
                                                class="product-review d-flex justify-content-between align-items-center">
                                                <div class="review-icon">
                                                    {!! $item->product->stars !!}
                                                </div>
                                            </div>
                                            <a class="shop-btn" href="{{ route('product', $item->product) }}">Shop Now <svg
                                                    xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    viewBox="0 0 25 25" fill="none">
                                                    <path
                                                        d="M4.79688 12.382H20.7969M20.7969 12.382L14.7969 6.38196M20.7969 12.382L14.7969 18.382"
                                                        stroke="white" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="wish-item-info position-relative">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="product-info">
                                        <p>No items in wishlist</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                        @endauth

                    </div>
                </div>
            </div>
        </div>



    <style>/* Offcanvas Styling */


        /* Account Menu Styling */
        .account-menu {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .account-item {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: all 0.3s ease;
        }

        .account-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .account-link {
            text-decoration: none;
            color: #333;
        }

        .account-link h6 {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 10px;
            color: #4f5d81;
        }

        .account-link p {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        .account-link.logout h6 {
            color: #e74c3c; /* Red color for logout */
        }

        /* Close Button */
        .btn-close {
            background-color: transparent;
            border: none;
            font-size: 24px;
            color: #4f5d81;
        }

        .btn-close:hover {
            color: #e74c3c;
        }


        </style>

    <!-- Jquery Js -->
    <script src="{{ asset('') }}assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('') }}assets/js/vendor/bootstrap.min.js"></script>
    <script src="{{ asset('') }}assets/js/vendor/jquery-appear.js"></script>
    <script src="{{ asset('') }}assets/js/vendor/slick.min.js"></script>
    <script src="{{ asset('') }}assets/js/vendor/swiper-bundle.min.js"></script>
    <script src="{{ asset('') }}assets/js/vendor/wow.min.js"></script>
    <script src="{{ asset('') }}assets/js/vendor/sal.js"></script>
    <script src="{{ asset('') }}assets/js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('') }}assets/js/vendor/js.cookie.js"></script>
    <script src="{{ asset('') }}assets/js/vendor/jquery.style.switcher.js"></script>
    <script src="{{ asset('') }}assets/js/vendor/tilt.js"></script>
    <script src="{{ asset('') }}assets/js/vendor/jquery.nav.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    @if(session('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #0d618f, #4598b9)",  /* Success Gradient */
                },
                onClick: function(){}
            }).showToast();
        </script>
    @endif

    @if(session('error'))
        <script>
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #e63946, #f1a7a6)",  /* Error Gradient */
                },
                onClick: function(){}
            }).showToast();
        </script>
    @endif


    <!-- Site Scripts -->
    <script src="{{ asset('') }}assets/js/app.js"></script>
    @stack('scripts')
</body>

</html>
