<!-- Start of Header -->
<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p class="welcome-msg">Exclusive Deals This Week – Don’t Miss Out!</p>
            </div>
            <div class="header-right">
                <div class="dropdown">
                    <a href="#currency">USD</a>
                    <div class="dropdown-box">
                        <a href="#USD">USD</a>
                        <a href="#INR">INR</a>
                    </div>
                </div>
                <!-- End of DropDown Menu -->

                <div class="dropdown">
                    <a href="#language"><img src="{{ asset('frontAssets/images/flags/eng.png') }}" alt="ENG Flag"
                            width="14" height="8" class="dropdown-image" /> ENG</a>
                    <div class="dropdown-box">
                        <a href="#ENG">
                            <img src="{{ asset('frontAssets/images/flags/eng.png') }}" alt="ENG Flag" width="14"
                                height="8" class="dropdown-image" />
                            ENG
                        </a>
                        <a href="#FRA">
                            <img src="{{ asset('frontAssets/images/flags/fra.png') }}" alt="FRA Flag" width="14"
                                height="8" class="dropdown-image" />
                            FRA
                        </a>
                    </div>
                </div>
                <!-- End of Dropdown Menu -->
                <span class="divider d-lg-show"></span>
                <a href="#" class="d-lg-show">Blog</a>
                <a href="{{ route('frontend.contact') }}" class="d-lg-show">Contact Us</a>
                {{-- @if (Auth::check())
                    <a href="{{ route('dashboard') }}" class="d-lg-show">My Account</a>
                    <span class="delimiter d-lg-show">/</span>
                    <a href="javascript:void(0)"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form-header').submit();"
                        class="ml-0 d-lg-show">
                        Logout
                    </a>
                    <form id="logout-form-header" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="d-lg-show"><i class="w-icon-account"></i>Sign
                        In</a>
                    <span class="delimiter d-lg-show">/</span>
                    <a href="{{ route('register') }}" class="ml-0 d-lg-show login">Register</a>
                @endif --}}
                @if (Auth::check())
                    <a href="{{ route('dashboard') }}" class="account-btn"><i class="fa fa-user"></i> My Account</a>
                    <a href="javascript:void(0)"
                        onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();"
                        class="logout-btn">
                        <i class="fa fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form-header" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="signin-btn">
                        <i class="w-icon-account"></i> Sign In
                    </a>
                    <a href="{{ route('register') }}" class="register-btn">
                        <i class="fa fa-user-plus"></i> Register
                    </a>
                @endif

            </div>
        </div>
    </div>
    <!-- End of Header Top -->

    <div class="header-middle bg-primary text-white">
        <div class="container">
            <div class="header-left mr-md-4">
                <a href="#" class="mobile-menu-toggle w-icon-hamburger" aria-label="menu-toggle">
                </a>
                <a href="{{ route('home') }}" class="logo ml-lg-0">
                    <img src="{{ asset(\App\Helpers\Helper::getLogoDark()) }}" alt="logo" width="144"
                        height="45" />
                </a>
                <form method="get" action="{{ route('frontend.shop') }}"
                    class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper border-white">
                    <div class="select-box bg-white" style="border-color: #fff;">
                        <select id="category" name="category">
                            <option value="all">All Categories</option>
                            @foreach (\App\Helpers\Helper::getCategories() as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" class="form-control text-white" style="border-color: #fff;" name="search"
                        id="search" placeholder="Search in..." required />
                    <button class="btn btn-search" style="border-color: #fff;" type="submit"><i
                            class="w-icon-search"></i>
                    </button>
                </form>
            </div>
            <div class="header-right ml-4">
                <div class="header-call d-xs-show d-lg-flex align-items-center">
                    <a href="https://t.me/BossWolter" class="w-icon-call"></a>
                    <div class="call-info d-lg-show">
                        <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                            <a href="https://t.me/BossWolter" class="text-capitalize text-white">Live Chat</a> or
                            :
                        </h4>
                        <a href="https://t.me/BossWolter" target="_blank"
                            class="phone-number font-weight-bolder ls-50">+66 9 5491 0493</a>
                    </div>
                </div>
                <a class="wishlist label-down link d-xs-show" href="wishlist.html">
                    <i class="w-icon-heart"></i>
                    <span class="wishlist-label d-lg-show">Wishlist</span>
                </a>
                <a class="compare label-down link d-xs-show" href="compare.html">
                    <i class="w-icon-compare"></i>
                    <span class="compare-label d-lg-show">Compare</span>
                </a>
                {{-- <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                    <div class="cart-overlay"></div>
                    <a href="#" class="cart-toggle label-down link">
                        <i class="w-icon-cart">
                            <span class="cart-count">{{ count(\App\Helpers\Helper::getCart()->items) }}</span>
                        </i>
                        <span class="cart-label">Cart</span>
                    </a>
                    <div class="dropdown-box">
                        <div class="cart-header">
                            <span>Shopping Cart</span>
                            <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
                        </div>

                        <div class="products">
                            <div class="product product-cart">
                                <div class="product-detail">
                                    <a href="product-default.html" class="product-name">Beige knitted
                                        elas<br>tic
                                        runner shoes</a>
                                    <div class="price-box">
                                        <span class="product-quantity">1</span>
                                        <span class="product-price">$25.68</span>
                                    </div>
                                </div>
                                <figure class="product-media">
                                    <a href="product-default.html">
                                        <img src="{{ asset('frontAssets/images/cart/product-1.jpg') }}" alt="product"
                                            height="84" width="94" />
                                    </a>
                                </figure>
                                <button class="btn btn-link btn-close" aria-label="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <div class="product product-cart">
                                <div class="product-detail">
                                    <a href="product-default.html" class="product-name">Blue utility
                                        pina<br>fore
                                        denim dress</a>
                                    <div class="price-box">
                                        <span class="product-quantity">1</span>
                                        <span class="product-price">$32.99</span>
                                    </div>
                                </div>
                                <figure class="product-media">
                                    <a href="product-default.html">
                                        <img src="{{ asset('frontAssets/images/cart/product-2.jpg') }}"
                                            alt="product" width="84" height="94" />
                                    </a>
                                </figure>
                                <button class="btn btn-link btn-close" aria-label="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="cart-total">
                            <label>Subtotal:</label>
                            <span class="price">$58.67</span>
                        </div>

                        <div class="cart-action">
                            <a href="cart.html" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                            <a href="checkout.html" class="btn btn-primary  btn-rounded">Checkout</a>
                        </div>
                    </div>
                    <!-- End of Dropdown Box -->
                </div> --}}
                <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                    <div class="cart-overlay"></div>
                    <a href="#" class="cart-toggle label-down link text-white">
                        <i class="w-icon-cart">
                            <span class="cart-count">{{ \App\Helpers\Helper::getCart()->items->count() }}</span>
                        </i>
                        <span class="cart-label">Cart</span>
                    </a>
                    <div class="dropdown-box">
                        @if (isset(\App\Helpers\Helper::getCart()->items) && count(\App\Helpers\Helper::getCart()->items))
                            <div class="cart-header">
                                <span>Shopping Cart</span>
                                <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
                            </div>

                            <div class="products">
                                @foreach (\App\Helpers\Helper::getCart()->items as $item)
                                    <div class="product product-cart">
                                        <div class="product-detail">
                                            <a href="{{ route('frontend.product.show', $item->product->slug) }}"
                                                class="product-name">
                                                {{ $item->product->name }}
                                            </a>
                                            <div class="price-box">
                                                <span class="product-quantity">{{ $item->quantity }}</span>
                                                <span class="product-price">
                                                    {{ \App\Helpers\Helper::formatCurrency($item->price) }}
                                                </span>
                                            </div>
                                        </div>
                                        <figure class="product-media">
                                            <a href="{{ route('frontend.product.show', $item->product->slug) }}">
                                                <img src="{{ asset($item->product->main_image) }}" alt="product"
                                                    height="84" width="94" />
                                            </a>
                                        </figure>
                                        <form action="{{ route('frontend.cart.remove', $item->id) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-link btn-close"
                                                aria-label="button">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>

                            <div class="cart-total">
                                <label>Subtotal:</label>
                                <span class="price">
                                    {{ \App\Helpers\Helper::formatCurrency(\App\Helpers\Helper::getCart()->items->sum('price')) }}
                                </span>
                            </div>

                            <div class="cart-action">
                                <a href="{{ route('frontend.cart.view') }}"
                                    class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                                <a href="{{ route('frontend.checkout') }}"
                                    class="btn btn-primary btn-rounded">Checkout</a>
                            </div>
                        @else
                            <p>No Items in Cart</p>
                            <div class="cart-action">
                                <a href="{{ route('frontend.shop') }}"
                                    class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i
                                        class="w-icon-long-arrow-left"></i>Shop Now</a>
                            </div>
                        @endif
                    </div>
                    <!-- End of Dropdown Box -->
                </div>

            </div>
        </div>
    </div>
    <!-- End of Header Middle -->

    <div class="header-bottom sticky-content fix-top sticky-header has-dropdown">
        <div class="container">
            <div class="inner-wrap">
                <div class="header-left">
                    <div class="dropdown category-dropdown has-border" data-visible="true">
                        <a href="#" class="category-toggle text-dark" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true" data-display="static"
                            title="Browse Categories">
                            <i class="w-icon-category"></i>
                            <span>Browse Categories</span>
                        </a>

                        <div class="dropdown-box">
                            <ul class="menu vertical-menu category-menu">
                                @foreach (\App\Helpers\Helper::getCategories() as $category)
                                    <li>
                                        <a href="{{ url('shop/' . $category->slug) }}">
                                            <i class="{{ $category->icon }}"></i>{{ $category->name }}
                                        </a>
                                        @if ($category->children->isNotEmpty())
                                            <ul class="megamenu {{ $category->name === 'Furniture' ? 'type2' : '' }}">
                                                @if (in_array($category->name, ['Fashion', 'Home & Garden', 'Electronics']))
                                                    @php
                                                        $childGroups = $category->children->chunk(2); // Group children in pairs
                                                    @endphp
                                                    @foreach ($childGroups as $group)
                                                        <li>
                                                            @foreach ($group as $child)
                                                                <h4
                                                                    class="menu-title {{ $group->first() !== $child ? 'mt-1' : '' }}">
                                                                    {{ $child->name }}</h4>
                                                                <hr class="divider">
                                                                <ul>
                                                                    @foreach ($child->children as $subchild)
                                                                        <li>
                                                                            <a
                                                                                href="{{ url('shop/' . $subchild->slug) }}">{{ $subchild->name }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endforeach
                                                        </li>
                                                    @endforeach
                                                    <li>
                                                        <div
                                                            class="menu-banner banner-fixed menu-banner{{ $category->name === 'Fashion' ? '2' : ($category->name === 'Home & Garden' ? '3' : '4') }}">
                                                            <figure>
                                                                <img src="{{ asset('frontAssets/images/menu/banner-' . ($category->name === 'Fashion' ? '2' : ($category->name === 'Home & Garden' ? '3' : '4')) . '.jpg') }}"
                                                                    alt="Menu Banner" width="235"
                                                                    height="{{ $category->name === 'Fashion' ? '347' : ($category->name === 'Home & Garden' ? '461' : '433') }}" />
                                                            </figure>
                                                            <div class="banner-content">
                                                                @if ($category->name === 'Fashion')
                                                                    <div class="banner-price-info mb-1 ls-normal">Get
                                                                        up to
                                                                        <strong
                                                                            class="text-primary text-uppercase">20%Off</strong>
                                                                    </div>
                                                                    <h3 class="banner-title ls-normal">Hot Sales</h3>
                                                                    <a href="shop-banner-sidebar.html"
                                                                        class="btn btn-dark btn-sm btn-link btn-slide-right btn-icon-right">
                                                                        Shop Now<i class="w-icon-long-arrow-right"></i>
                                                                    </a>
                                                                @elseif ($category->name === 'Home & Garden')
                                                                    <h4
                                                                        class="banner-subtitle font-weight-normal text-white mb-1">
                                                                        Restroom</h4>
                                                                    <h3
                                                                        class="banner-title font-weight-bolder text-white ls-normal">
                                                                        Furniture Sale</h3>
                                                                    <div
                                                                        class="banner-price-info text-white font-weight-normal ls-25">
                                                                        Up to <span
                                                                            class="text-secondary text-uppercase font-weight-bold">25%
                                                                            Off</span>
                                                                    </div>
                                                                    <a href="shop-banner-sidebar.html"
                                                                        class="btn btn-white btn-link btn-sm btn-slide-right btn-icon-right">
                                                                        Shop Now<i class="w-icon-long-arrow-right"></i>
                                                                    </a>
                                                                @elseif ($category->name === 'Electronics')
                                                                    <h4 class="banner-subtitle font-weight-normal">
                                                                        Deals Of The Week</h4>
                                                                    <h3 class="banner-title text-white">Save On Smart
                                                                        EarPhone</h3>
                                                                    <div
                                                                        class="banner-price-info text-secondary font-weight-bolder text-uppercase text-secondary">
                                                                        20% Off
                                                                    </div>
                                                                    <a href="shop-banner-sidebar.html"
                                                                        class="btn btn-white btn-outline btn-sm btn-rounded">Shop
                                                                        Now</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </li>
                                                @elseif ($category->name === 'Furniture')
                                                    <li class="row">
                                                        @foreach ($category->children as $child)
                                                            <div class="col-md-3 col-lg-3 col-6">
                                                                <h4 class="menu-title">{{ $child->name }}</h4>
                                                                <hr class="divider" />
                                                                <ul>
                                                                    @foreach ($child->children as $subchild)
                                                                        <li>
                                                                            <a
                                                                                href="{{ url('shop/' . $subchild->slug) }}">{{ $subchild->name }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                                    <li class="row">
                                                        <div class="col-6">
                                                            <div class="banner banner-fixed menu-banner5 br-xs">
                                                                <figure>
                                                                    <img src="{{ asset('frontAssets/images/menu/banner-5.jpg') }}"
                                                                        alt="Banner" width="410" height="123"
                                                                        style="background-color: #D2D2D2;" />
                                                                </figure>
                                                                <div class="banner-content text-right y-50">
                                                                    <h4
                                                                        class="banner-subtitle font-weight-normal text-default text-capitalize">
                                                                        New Arrivals
                                                                    </h4>
                                                                    <h3
                                                                        class="banner-title font-weight-bolder text-capitalize ls-normal">
                                                                        Amazing Sofa
                                                                    </h3>
                                                                    <div
                                                                        class="banner-price-info font-weight-normal ls-normal">
                                                                        Starting at <strong>$125.00</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="banner banner-fixed menu-banner5 br-xs">
                                                                <figure>
                                                                    <img src="{{ asset('frontAssets/images/menu/banner-6.jpg') }}"
                                                                        alt="Banner" width="410" height="123"
                                                                        style="background-color: #9F9888;" />
                                                                </figure>
                                                                <div class="banner-content y-50">
                                                                    <h4
                                                                        class="banner-subtitle font-weight-normal text-white text-capitalize">
                                                                        Best Seller
                                                                    </h4>
                                                                    <h3
                                                                        class="banner-title font-weight-bolder text-capitalize text-white ls-normal">
                                                                        Chair &amp; Lamp
                                                                    </h3>
                                                                    <div
                                                                        class="banner-price-info font-weight-normal ls-normal text-white">
                                                                        From <strong>$165.00</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{ route('frontend.shop') }}"
                                        class="font-weight-bold text-primary text-uppercase ls-25">
                                        View All Categories<i class="w-icon-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <nav class="main-nav">
                        <ul class="menu active-underline">
                            <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="{{ request()->routeIs('frontend.shop') ? 'active' : '' }}">
                                <a href="{{ route('frontend.shop') }}">Shop Now</a>
                            </li>
                            <li class="{{ request()->routeIs('frontend.become-a-vendor') ? 'active' : '' }}">
                                <a href="{{ route('frontend.become-a-vendor') }}">Become A Vendor</a>
                            </li>
                            <li class="{{ request()->routeIs('frontend.about') ? 'active' : '' }}">
                                <a href="{{ route('frontend.about') }}">About Us</a>
                            </li>
                            <li class="{{ request()->routeIs('frontend.contact') ? 'active' : '' }}">
                                <a href="{{ route('frontend.contact') }}">Contact Us</a>
                            </li>
                            <li class="{{ request()->routeIs('frontend.faqs') ? 'active' : '' }}">
                                <a href="{{ route('frontend.faqs') }}">FAQs</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="header-right">
                    <a href="#" class="d-xl-show"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                    <a href="#"><i class="w-icon-sale"></i>Daily Deals</a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End of Header -->

<!-- Start of Mobile Menu -->
<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay"></div>
    <!-- End of .mobile-menu-overlay -->

    <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
    <!-- End of .mobile-menu-close -->

    <div class="mobile-menu-container scrollable">
        <form action="#" method="get" class="input-wrapper">
            <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
                required />
            <button class="btn btn-search" type="submit">
                <i class="w-icon-search"></i>
            </button>
        </form>
        <!-- End of Search Form -->
        <div class="tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#main-menu" class="nav-link active">Main Menu</a>
                </li>
                <li class="nav-item">
                    <a href="#categories" class="nav-link">Categories</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="main-menu">
                <ul class="mobile-menu">
                    <li><a href="demo1.html">Home</a></li>
                    <li>
                        <a href="shop-banner-sidebar.html">Shop</a>
                        <ul>
                            <li>
                                <a href="#">Shop Pages</a>
                                <ul>
                                    <li><a href="shop-banner-sidebar.html">Banner With Sidebar</a></li>
                                    <li><a href="shop-boxed-banner.html">Boxed Banner</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Full Width Banner</a></li>
                                    <li><a href="shop-horizontal-filter.html">Horizontal Filter<span
                                                class="tip tip-hot">Hot</span></a></li>
                                    <li><a href="shop-off-canvas.html">Off Canvas Sidebar<span
                                                class="tip tip-new">New</span></a></li>
                                    <li><a href="shop-infinite-scroll.html">Infinite Ajax Scroll</a></li>
                                    <li><a href="shop-right-sidebar.html">Right Sidebar</a></li>
                                    <li><a href="shop-both-sidebar.html">Both Sidebar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Shop Layouts</a>
                                <ul>
                                    <li><a href="shop-grid-3cols.html">3 Columns Mode</a></li>
                                    <li><a href="shop-grid-4cols.html">4 Columns Mode</a></li>
                                    <li><a href="shop-grid-5cols.html">5 Columns Mode</a></li>
                                    <li><a href="shop-grid-6cols.html">6 Columns Mode</a></li>
                                    <li><a href="shop-grid-7cols.html">7 Columns Mode</a></li>
                                    <li><a href="shop-grid-8cols.html">8 Columns Mode</a></li>
                                    <li><a href="shop-list.html">List Mode</a></li>
                                    <li><a href="shop-list-sidebar.html">List Mode With Sidebar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Product Pages</a>
                                <ul>
                                    <li><a href="product-variable.html">Variable Product</a></li>
                                    <li><a href="product-featured.html">Featured &amp; Sale</a></li>
                                    <li><a href="product-accordion.html">Data In Accordion</a></li>
                                    <li><a href="product-section.html">Data In Sections</a></li>
                                    <li><a href="product-swatch.html">Image Swatch</a></li>
                                    <li><a href="product-extended.html">Extended Info</a>
                                    </li>
                                    <li><a href="product-without-sidebar.html">Without Sidebar</a></li>
                                    <li><a href="product-video.html">360<sup>o</sup> &amp; Video<span
                                                class="tip tip-new">New</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Product Layouts</a>
                                <ul>
                                    <li><a href="product-default.html">Default<span class="tip tip-hot">Hot</span></a>
                                    </li>
                                    <li><a href="product-vertical.html">Vertical Thumbs</a></li>
                                    <li><a href="product-grid.html">Grid Images</a></li>
                                    <li><a href="product-masonry.html">Masonry</a></li>
                                    <li><a href="product-gallery.html">Gallery</a></li>
                                    <li><a href="product-sticky-info.html">Sticky Info</a></li>
                                    <li><a href="product-sticky-thumb.html">Sticky Thumbs</a></li>
                                    <li><a href="product-sticky-both.html">Sticky Both</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="vendor-dokan-store.html">Vendor</a>
                        <ul>
                            <li>
                                <a href="#">Store Listing</a>
                                <ul>
                                    <li><a href="vendor-dokan-store-list.html">Store listing 1</a></li>
                                    <li><a href="vendor-wcfm-store-list.html">Store listing 2</a></li>
                                    <li><a href="vendor-wcmp-store-list.html">Store listing 3</a></li>
                                    <li><a href="vendor-wc-store-list.html">Store listing 4</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Vendor Store</a>
                                <ul>
                                    <li><a href="vendor-dokan-store.html">Vendor Store 1</a></li>
                                    <li><a href="vendor-wcfm-store-product-grid.html">Vendor Store 2</a></li>
                                    <li><a href="vendor-wcmp-store-product-grid.html">Vendor Store 3</a></li>
                                    <li><a href="vendor-wc-store-product-grid.html">Vendor Store 4</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="blog.html">Blog</a>
                        <ul>
                            <li><a href="blog.html">Classic</a></li>
                            <li><a href="blog-listing.html">Listing</a></li>
                            <li>
                                <a href="blog-grid.html">Grid</a>
                                <ul>
                                    <li><a href="blog-grid-2cols.html">Grid 2 columns</a></li>
                                    <li><a href="blog-grid-3cols.html">Grid 3 columns</a></li>
                                    <li><a href="blog-grid-4cols.html">Grid 4 columns</a></li>
                                    <li><a href="blog-grid-sidebar.html">Grid sidebar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Masonry</a>
                                <ul>
                                    <li><a href="blog-masonry-2cols.html">Masonry 2 columns</a></li>
                                    <li><a href="blog-masonry-3cols.html">Masonry 3 columns</a></li>
                                    <li><a href="blog-masonry-4cols.html">Masonry 4 columns</a></li>
                                    <li><a href="blog-masonry-sidebar.html">Masonry sidebar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Mask</a>
                                <ul>
                                    <li><a href="blog-mask-grid.html">Blog mask grid</a></li>
                                    <li><a href="blog-mask-masonry.html">Blog mask masonry</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="post-single.html">Single Post</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="about-us.html">Pages</a>
                        <ul>

                            <li><a href="about-us.html">About Us</a></li>
                            <li><a href="become-a-vendor.html">Become A Vendor</a></li>
                            <li><a href="contact-us.html">Contact Us</a></li>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="faq.html">FAQs</a></li>
                            <li><a href="error-404.html">Error 404</a></li>
                            <li><a href="coming-soon.html">Coming Soon</a></li>
                            <li><a href="wishlist.html">Wishlist</a></li>
                            <li><a href="cart.html">Cart</a></li>
                            <li><a href="checkout.html">Checkout</a></li>
                            <li><a href="my-account.html">My Account</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="elements.html">Elements</a>
                        <ul>
                            <li><a href="element-products.html">Products</a></li>
                            <li><a href="element-titles.html">Titles</a></li>
                            <li><a href="element-typography.html">Typography</a></li>
                            <li><a href="element-categories.html">Product Category</a></li>
                            <li><a href="element-buttons.html">Buttons</a></li>
                            <li><a href="element-accordions.html">Accordions</a></li>
                            <li><a href="element-alerts.html">Alert &amp; Notification</a></li>
                            <li><a href="element-tabs.html">Tabs</a></li>
                            <li><a href="element-testimonials.html">Testimonials</a></li>
                            <li><a href="element-blog-posts.html">Blog Posts</a></li>
                            <li><a href="element-instagrams.html">Instagrams</a></li>
                            <li><a href="element-cta.html">Call to Action</a></li>
                            <li><a href="element-vendors.html">Vendors</a></li>
                            <li><a href="element-icon-boxes.html">Icon Boxes</a></li>
                            <li><a href="element-icons.html">Icons</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="tab-pane" id="categories">
                <ul class="mobile-menu">
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-tshirt2"></i>Fashion
                        </a>
                        <ul>
                            <li>
                                <a href="#">Women</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">New Arrivals</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Best Sellers</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Trending</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Clothing</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Shoes</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Bags</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Accessories</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Jewlery &
                                            Watches</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Men</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">New Arrivals</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Best Sellers</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Trending</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Clothing</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Shoes</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Bags</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Accessories</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Jewlery &
                                            Watches</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-home"></i>Home & Garden
                        </a>
                        <ul>
                            <li>
                                <a href="#">Bedroom</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">Beds, Frames &
                                            Bases</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Dressers</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Nightstands</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Kid's Beds &
                                            Headboards</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Armoires</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Living Room</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">Coffee Tables</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Chairs</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Tables</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Futons & Sofa
                                            Beds</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Cabinets &
                                            Chests</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Office</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">Office Chairs</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Desks</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Bookcases</a></li>
                                    <li><a href="shop-fullwidth-banner.html">File Cabinets</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Breakroom
                                            Tables</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Kitchen & Dining</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">Dining Sets</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Kitchen Storage
                                            Cabinets</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Bashers Racks</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Dining Chairs</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Dining Room
                                            Tables</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Bar Stools</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-electronics"></i>Electronics
                        </a>
                        <ul>
                            <li>
                                <a href="#">Laptops &amp; Computers</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">Desktop
                                            Computers</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Monitors</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Laptops</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Hard Drives &amp;
                                            Storage</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Computer
                                            Accessories</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">TV &amp; Video</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">TVs</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Home Audio
                                            Speakers</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Projectors</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Media Streaming
                                            Devices</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Digital Cameras</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">Digital SLR
                                            Cameras</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Sports & Action
                                            Cameras</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Camera Lenses</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Photo Printer</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Digital Memory
                                            Cards</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Cell Phones</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">Carrier Phones</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Unlocked Phones</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Phone & Cellphone
                                            Cases</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Cellphone
                                            Chargers</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-furniture"></i>Furniture
                        </a>
                        <ul>
                            <li>
                                <a href="#">Furniture</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">Sofas & Couches</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Armchairs</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Bed Frames</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Beside Tables</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Dressing Tables</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Lighting</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">Light Bulbs</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Lamps</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Celling Lights</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Wall Lights</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Bathroom
                                            Lighting</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Home Accessories</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">Decorative
                                            Accessories</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Candals &
                                            Holders</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Home Fragrance</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Mirrors</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Clocks</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Garden & Outdoors</a>
                                <ul>
                                    <li><a href="shop-fullwidth-banner.html">Garden
                                            Furniture</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Lawn Mowers</a>
                                    </li>
                                    <li><a href="shop-fullwidth-banner.html">Pressure
                                            Washers</a></li>
                                    <li><a href="shop-fullwidth-banner.html">All Garden
                                            Tools</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Outdoor Dining</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-heartbeat"></i>Healthy & Beauty
                        </a>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-gift"></i>Gift Ideas
                        </a>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-gamepad"></i>Toy & Games
                        </a>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-ice-cream"></i>Cooking
                        </a>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-ios"></i>Smart Phones
                        </a>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-camera"></i>Cameras & Photo
                        </a>
                    </li>
                    <li>
                        <a href="shop-fullwidth-banner.html">
                            <i class="w-icon-ruby"></i>Accessories
                        </a>
                    </li>
                    <li>
                        <a href="shop-banner-sidebar.html" class="font-weight-bold text-primary text-uppercase ls-25">
                            View All Categories<i class="w-icon-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End of Mobile Menu -->
