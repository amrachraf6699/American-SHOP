
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ env('APP_NAME') }} Manage | @yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin') }}/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    @stack('styles')
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('admin') }}/assets/vendor/js/helpers.js"></script>

    <script src="{{ asset('admin') }}/assets/js/config.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <img src="{{ asset('assets/media/logo.png') }}" width="200px"/>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
              <a href="{{ route('admin.home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="menu-link" target="_blank">
                  <i class="menu-icon bx bx-rocket"></i>
                  <div data-i18n="Analytics">Visit Website</div>
                </a>
            </li>


            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Resources</span>
              </li>



            <!-- Coupon COdes -->
            <li class="menu-item {{ request()->routeIs('admin.coupons.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-purchase-tag-alt"></i>
                  <div data-i18n="Coupons">Coupons</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item {{ request()->routeIs('admin.coupons.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.coupons.index') }}" class="menu-link">
                      <div data-i18n="Without menu">View All</div>
                    </a>
                  </li>
                  <li class="menu-item {{ request()->routeIs('admin.coupons.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.coupons.create') }}" class="menu-link">
                      <div data-i18n="Without menu">Create New</div>
                    </a>
                  </li>
                  <li class="menu-item {{ request()->routeIs('admin.coupons.show') ? 'active' : '' }}">
                    <a href="{{ route('admin.coupons.index') }}" class="menu-link">
                      <div data-i18n="Without menu">Show A Coupon</div>
                    </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.coupons.edit') ? 'active' : '' }}">
                    <a href="{{ route('admin.coupons.index') }}" class="menu-link">
                      <div data-i18n="Without menu">Edit a Coupon</div>
                    </a>
                    </li>
                </ul>
            </li>
            <!-- Categories -->
            <li class="menu-item {{ request()->routeIs('admin.categories.*') ? 'active open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Categories">Categories</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
                  <a href="{{ route('admin.categories.index') }}" class="menu-link">
                    <div data-i18n="Without menu">View All</div>
                  </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.categories.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.create') }}" class="menu-link">
                      <div data-i18n="Without menu">Create New</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.categories.show') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}" class="menu-link">
                      <div data-i18n="Without menu">Show A category</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.categories.edit') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}" class="menu-link">
                      <div data-i18n="Without menu">Edit a Category</div>
                    </a>
                </li>
              </ul>
            </li>

            <!-- Products -->
            <li class="menu-item {{ request()->routeIs('admin.products.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-package"></i>
                  <div data-i18n="Categories">Products</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}" class="menu-link">
                      <div data-i18n="Without menu">View All</div>
                    </a>
                  </li>
                  <li class="menu-item {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                      <a href="{{ route('admin.products.create') }}" class="menu-link">
                        <div data-i18n="Without menu">Create New</div>
                      </a>
                  </li>
                  <li class="menu-item {{ request()->routeIs('admin.products.show') ? 'active' : '' }}">
                      <a href="{{ route('admin.products.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Show A Product</div>
                      </a>
                  </li>
                  <li class="menu-item {{ request()->routeIs('admin.products.edit') ? 'active' : '' }}">
                      <a href="{{ route('admin.products.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Edit a Product</div>
                      </a>
                  </li>
                </ul>
            </li>

            <!-- Orders -->
            <li class="menu-item {{ request()->routeIs('admin.orders.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-cart-alt"></i>
                  <div data-i18n="Categories">Orders <span class="badge badge-center rounded-pill bg-label-warning">{{ App\Models\Order::where('status', 'paid')->count(); }}</span></div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
                      <a href="{{ route('admin.orders.index') }}" class="menu-link">
                        <div data-i18n="Without menu">View All</div>
                      </a>
                    </li>
                </ul>
            </li>

            <!-- Home Sliders -->
            <li class="menu-item {{ request()->routeIs('admin.home_sliders.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon bx bx-slideshow"></i>
                  <div data-i18n="Categories">Home Sliders</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item {{ request()->routeIs('admin.home_sliders.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.home_sliders.index') }}" class="menu-link">
                      <div data-i18n="Without menu">View All</div>
                    </a>
                  </li>
                  <li class="menu-item {{ request()->routeIs('admin.home_sliders.create') ? 'active' : '' }}">
                      <a href="{{ route('admin.home_sliders.create') }}" class="menu-link">
                        <div data-i18n="Without menu">Create New</div>
                      </a>
                  </li>
                  <li class="menu-item {{ request()->routeIs('admin.home_sliders.show') ? 'active' : '' }}">
                      <a href="{{ route('admin.home_sliders.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Show A Slider</div>
                      </a>
                  </li>
                  <li class="menu-item {{ request()->routeIs('admin.home_sliders.edit') ? 'active' : '' }}">
                      <a href="{{ route('admin.home_sliders.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Edit a Slider</div>
                      </a>
                  </li>
                </ul>

            <li class="menu-item {{ request()->routeIs('admin.newsletter') ? 'active' : '' }}">
                <a href="{{ route('admin.newsletter.index') }}" class="menu-link">
                    <i class='menu-icon bx bxs-news'></i>
                  <div data-i18n="Analytics">Newsletter</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Website</span>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <a href="{{ route('admin.settings') }}" class="menu-link">
                  <i class="menu-icon bx bx-cog"></i>
                  <div data-i18n="Analytics">Website Settings</div>
                </a>
            </li>

          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <ul class="navbar-nav flex-row align-items-center ms-auto">

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ asset(auth()->user()->cover) }}" alt class="w-px-40 rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="{{ asset(auth()->user()->cover) }}" alt class="w-px-40 rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ auth()->user()->name }}</span>
                            <small class="text-muted">{{ auth()->user()->type }}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('admin.profile') }}">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('admin.logout') }}">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Content -->
            @yield('content')
            <!-- / Content -->
            </div>

            <!-- Footer -->


            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('admin') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('admin') }}/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('admin') }}/assets/js/main.js"></script>

    @stack('scripts')


    @if(session('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "center",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
                onClick: function(){}
            }).showToast();
        </script>
    @endif


    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
