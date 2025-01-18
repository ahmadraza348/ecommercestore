<header>

    <!-- header top start -->
    <div class="header-top-area bg-gray text-center text-md-left">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5">
                    <div class="header-call-action">
                        <a href="#">
                            <i class="fa fa-envelope"></i>
                            info@website.com
                        </a>
                        <a href="#">
                            <i class="fa fa-phone"></i>
                            0123456789
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-7">
                    <div class="header-top-right float-md-right float-none">
                        <nav>
                            <ul>
                                @if (!Auth::check())
                                    <li> <a href="{{ route('login') }}"> login</a>
                                    </li>
                                @else
                                    <li>
                                        <div class="dropdown header-top-dropdown">
                                            <a class="dropdown-toggle" id="myaccount" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                My Account
                                                <i class="fa fa-angle-down"></i>
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="myaccount">
                                                <a class="dropdown-item" href="{{ route('profile.edit') }}"> Account</a>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf

                                                    <x-dropdown-link :href="route('logout')"
                                                        onclick="event.preventDefault();
                                                                        this.closest('form').submit();">
                                                        {{ __('Log Out') }}
                                                    </x-dropdown-link>
                                                </form>
                                            </div>


                                        </div>
                                    </li>
                                @endif
                                <li>
                                    <a href="#">my wishlist</a>
                                </li>
                                <li>
                                    <a href="#">my cart</a>
                                </li>
                                <li>
                                    <a href="#">checkout</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header top end -->

    <!-- header middle start -->
    <div class="header-middle-area pt-20 pb-20">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="brand-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('frontend/assets/img/logo/logo.png') }}" alt="brand logo">
                        </a>
                    </div>
                </div> <!-- end logo area -->
                <div class="col-lg-9">
                    <div class="header-middle-right">
                        <div class="header-middle-shipping mb-20">
                            <div class="single-block-shipping">
                                <div class="shipping-icon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <div class="shipping-content">
                                    <h5>Working time</h5>
                                    <span>Mon- Sun: 8.00 - 18.00</span>
                                </div>
                            </div> <!-- end single shipping -->
                            <div class="single-block-shipping">
                                <div class="shipping-icon">
                                    <i class="fa fa-truck"></i>
                                </div>
                                <div class="shipping-content">
                                    <h5>free shipping</h5>
                                    <span>On order over $199</span>
                                </div>
                            </div> <!-- end single shipping -->
                            <div class="single-block-shipping">
                                <div class="shipping-icon">
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="shipping-content">
                                    <h5>money back 100%</h5>
                                    <span>Within 30 Days after delivery</span>
                                </div>
                            </div> <!-- end single shipping -->
                        </div>
                        <div class="header-middle-block">
                            <div class="header-middle-searchbox">
                                <input type="text" placeholder="Search...">
                                <button class="search-btn"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="header-mini-cart">
                                <div class="mini-cart-btn">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="cart-notification">2</span>
                                </div>
                                <div class="cart-total-price">
                                    <span>total</span>
                                    $50.00
                                </div>
                                <ul class="cart-list">
                                    <li>
                                        <div class="cart-img">
                                            <a href="product-details.html"><img
                                                    src="{{ asset('frontend/assets/img/cart/cart-1.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="cart-info">
                                            <h4><a href="product-details.html">simple product 09</a></h4>
                                            <span>$60.00</span>
                                        </div>
                                        <div class="del-icon">
                                            <i class="fa fa-times"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="cart-img">
                                            <a href="product-details.html"><img
                                                    src="{{ asset('frontend/assets/img/cart/cart-2.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="cart-info">
                                            <h4><a href="product-details.html">virtual product 10</a></h4>
                                            <span>$50.00</span>
                                        </div>
                                        <div class="del-icon">
                                            <i class="fa fa-times"></i>
                                        </div>
                                    </li>
                                    <li class="mini-cart-price">
                                        <span class="subtotal">subtotal : </span>
                                        <span class="subtotal-price">$88.66</span>
                                    </li>
                                    <li class="checkout-btn">
                                        <a href="#">checkout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header middle end -->

    <!-- main menu area start -->
    <div class="main-header-wrapper bdr-bottom1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <style>
                        .main-header-inner .category-toggle-wrap nav.category-menu.hm-1 {
                            display: {{ in_array(Route::currentRouteName(), ['login', 'register', 'profile.edit', 'verification.notice', 'password.request', 'password.reset', 'shop', 'pro.details']) ? 'none' : 'block' }};
                        }
                    </style>

                    <div class="main-header-inner">
                        <div class="category-toggle-wrap">
                            <div class="category-toggle">
                                category
                                <div class="cat-icon">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>

                            <nav class="category-menu hm-1">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li>
                                            <!-- Parent Category -->
                                            <a href="{{ route('shop', ['slug' => $category->slug]) }}">
                                                {{ $category->name }}
                                            </a>
                                            @if ($category->subcategories->isNotEmpty())
                                                <ul class="category-mega-menu">
                                                    @foreach ($category->subcategories as $subcategory)
                                                        <li>
                                                            <!-- Subcategory -->
                                                            <a
                                                                href="{{ route('shop', ['slug' => $category->slug, 'subslug' => $subcategory->slug]) }}">
                                                                {{ $subcategory->name }}
                                                            </a>
                                                            @if ($subcategory->subcategories->isNotEmpty())
                                                                <ul>
                                                                    @foreach ($subcategory->subcategories as $subsubcategory)
                                                                        <li>
                                                                            <!-- Sub-Subcategory -->
                                                                            <a
                                                                                href="{{ route('shop', ['slug' => $category->slug, 'subslug' => $subcategory->slug, 'childslug' => $subsubcategory->slug]) }}">
                                                                                {{ $subsubcategory->name }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </nav>


                        </div>
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('shop') }}">Shop</a></li>
                                    <li class="static"><a href="#">Brands <i class="fa fa-angle-down"></i></a>
                                        <ul class="megamenu dropdown">

                                            <ul class="megamenu dropdown">
                                                @foreach ($brands as $item)
                                                    <li><a
                                                            href="{{ route('shop', $item->slug) }}">{{ $item->name }}</a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                    </li>
                                </ul>
                                </li>
                                <li><a href="contact-us.html">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-block d-lg-none">
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- main menu area end -->

</header>
