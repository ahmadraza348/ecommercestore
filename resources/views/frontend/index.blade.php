@extends('frontend.layouts.layout')
@section('content')
    <!-- hero slider start -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="slider-wrapper-area">
                    <div class="hero-slider-active hero__1 slick-dot-style hero-dot">
                        <div class="single-slider"
                            style="background-image: url({{ asset('frontend/assets/img/slider/slider12_bg.jpg') }}">
                            <div class="container p-0">
                                <div class="slider-main-content">
                                    <div class="slider-content-img">
                                        <img src="{{ asset('frontend/assets/img/slider/slider11_lable1.png') }}"
                                            alt="">
                                        <img src="{{ asset('frontend/assets/img/slider/slider11_lable2.png') }}"
                                            alt="">
                                        <img src="{{ asset('frontend/assets/img/slider/slider11_lable3.png') }}"
                                            alt="">
                                    </div>
                                    <div class="slider-text">
                                        <div class="slider-label">
                                            <img src="{{ asset('frontend/assets/img/slider/slider11_lable4.png') }}"
                                                alt="">
                                        </div>
                                        <h1>samson s90</h1>
                                        <p>Typi Non Habent Claritatem Insitam; Est Usus Legentis</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- hero slider end -->

    <!-- home banner area start -->
    <div class="banner-area mt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 order-1">
                    <div class="img-container img-full fix imgs-res mb-sm-30">
                        <a href="#">
                            <img src="{{ asset('frontend/assets/img/banner/banner_left.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 order-sm-3">
                    <div class="img-container img-full fix mb-30">
                        <a href="#">
                            <img src="{{ asset('frontend/assets/img/banner/banner_static_top1.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="img-container img-full fix mb-30">
                        <a href="#">
                            <img src="{{ asset('frontend/assets/img/banner/banner_static_top2.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 order-2 order-md-3">
                    <div class="img-container img-full fix">
                        <a href="#">
                            <img src="{{ asset('frontend/assets/img/banner/banner_static_top3.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- home banner area end -->

    {{-- Featured Categories --}}
    @if (!empty($featured_categories) && $featured_categories->isNotEmpty())
        <div class="page-wrapper pt-6 pb-28 pb-md-6 pb-sm-6 pt-xs-36">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 order-1 order-lg-2">

                        <div class="section-title-2 d-flex justify-content-between mb-28">
                            <h3>Featured Categories</h3>
                            <div class="category-append"></div>
                        </div>

                        <!-- category tab area start -->
                        <div class="category-tab-area mb-30 mt-md-16 mt-sm-16">
                            <div class="category-tab">
                                <ul class="nav">
                                    <li>
                                        <i class="fa fa-star-o"></i>
                                    </li>

                                    @foreach ($featured_categories as $category_tab)
                                        <li>
                                            <a class="{{ $loop->index == 0 ? 'show active' : '' }}" data-toggle="tab"
                                                href="#{{ $category_tab->slug }}"> {{ $category_tab->name }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            @foreach ($featured_categories as $category_tab)
                                <div class="tab-pane fade show {{ $loop->index == 0 ? 'show active' : '' }}"
                                    id="{{ $category_tab->slug }}">
                                    <div class="feature-category-carousel-wrapper">
                                        <div class="container">
                                            <div class="featured-carousel-active2 row arrow-space slick-arrow-style"
                                                data-row="2">

                                                @foreach ($category_tab->products()->where('status', 'active')->take(8)->get() as $item)
                                                    <div class="col">
                                                        @include('frontend.partials.pro_slide')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- banner statistics start -->
                        <div class="banner-statistic banner-style-4 pb-36">
                            <div class="img-container fix img-full">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/img/banner/home3_static5.jpg') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- banner statistics end -->

                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- Featured Categories --}}


    {{-- Featured Products --}}
    <div class="page-wrapper pt-6 pb-28 pb-md-6 pb-sm-6 pt-xs-36">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- featured category area start -->
                    @if (!empty($featured_pro) && $featured_pro->isNotEmpty())
                        <div class="feature-category-area mt-md-70">
                            <div class="section-title mb-30">
                                <div class="title-icon">
                                    <i class="fa fa-bookmark"></i>
                                </div>
                                <h3>Featured </h3>
                            </div> <!-- section title end -->
                            <!-- featured category start -->
                            <div class="featured-carousel-active slick-padding slick-arrow-style">

                                @foreach ($featured_pro as $item)
                                    @include('frontend.partials.pro_slide', ['item' => $item])
                                @endforeach

                            </div>
                            <!-- featured category end -->
                        </div>
                    @endif

                </div>

            </div>
            <div class="banner-statistic pt-28 pb-36">
                <div class="img-container fix img-full">
                    <a href="#">
                        <img src="{{ asset('frontend/assets/img/banner/banner_static1.jpg') }}" alt="">
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- DOuble Slides Contaner --}}
    <div class="container">
        <div class="row product-feature-wrapper mb-lg-6">
            

            <!-- banner statistic end -->
            @if (!empty($sale_pro) && $sale_pro->isNotEmpty())
                <div class="col-lg-6">
                    <div class="hot-deals-wrap3 mb-30 mb-md-22 mb-sm-22 mt-sm-14">
                        <div class="section-title-2 d-flex justify-content-between mb-28">
                            <h3>Hot Sale</h3>
                            {{-- Products with limited-time discounts or seasonal relevance. --}}
                            <div class="category-append"></div>
                        </div> <!-- section title end -->
                        <div class="deals-carousel-active2 slick-padding slick-arrow-style">
                            @foreach ($sale_pro as $item)
                                @include('frontend.partials.pro_slide', ['item' => $item])
                            @endforeach
                        </div>
                    </div>
                </div>
        @endif
        <!-- hot deals area end -->
        <!-- most view area start -->
        @if (!empty($hot_deals_pro) && $hot_deals_pro->isNotEmpty())
            <div class="col-lg-6">
                <div class="hot-deals-wrap3 mb-30 mb-md-22 mb-sm-22 mt-sm-14">
                    <div class="section-title-2 d-flex justify-content-between mb-28">
                        <h3>Hot Deals</h3>
                        {{-- Products with limited-time discounts or seasonal relevance. --}}
                        <div class="category-append"></div>
                    </div> <!-- section title end -->
                    <div class="deals-carousel-active2 slick-padding slick-arrow-style">
                        @foreach ($hot_deals_pro as $item)
                            @include('frontend.partials.pro_slide', ['item' => $item])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
        <!-- most view area end -->

        <!-- banner statistic start -->
        <div class="banner-statistic pt-28 pb-30 pb-sm-0">
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <div class="img-container fix img-full mb-sm-30">
                        <a href="#">
                            <img src="{{ asset('frontend/assets/img/banner/banner_static2.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="img-container fix img-full mb-sm-30">
                        <a href="#">
                            <img src="{{ asset('frontend/assets/img/banner/banner_static3.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- 3  sliderrs --}}
    <div class="container">
        <!-- category features area start -->
        <div class="category-feature-area">
            <div class="row">
                <!-- New Products area start -->
                <div class="col-lg-4">
                    <div class="category-wrapper mb-md-24 mb-sm-24">
                        <div class="section-title-2 d-flex justify-content-between mb-28">
                            <h3>Recently Viewed</h3>
                            {{-- Products the users has  browsed. --}}
                            <div class="category-append"></div>
                        </div> <!-- section title end -->
                        <div class="category-carousel-active row" data-row="3">
                            <div class="col">
                                <div class="category-item">
                                    <div class="category-thumb">
                                        <a href="product-details.html">
                                            <img src="{{ asset('frontend/assets/img/product/product-img1.jpg') }}"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="category-content">
                                        <h4><a href="product-details.html">Virtual Product 01</a></h4>
                                        <div class="price-box">
                                            <div class="regular-price">
                                                $150.00
                                            </div>
                                            <div class="old-price">
                                                <del></del>
                                            </div>
                                        </div>
                                        <div class="ratings">
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <div class="pro-review">
                                                <span>1 review(s)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end single item -->
                            </div> <!-- end single item column -->
                        </div>
                    </div>
                </div>
                <!-- New Products area end -->
                <!-- Most viewed area start -->
                <div class="col-lg-4">
                    <div class="category-wrapper mb-md-24 mb-sm-24">
                        <div class="section-title-2 d-flex justify-content-between mb-28">

                            <h3>Top Rated </h3>
                            {{-- On the base of customer rating --}}
                            <div class="category-append"></div>
                        </div> <!-- section title end -->
                        <div class="category-carousel-active row" data-row="3">
                            <div class="col">
                                <div class="category-item">
                                    <div class="category-thumb">
                                        <a href="product-details.html">
                                            <img src="{{ asset('frontend/assets/img/product/product-img14.jpg') }}"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="category-content">
                                        <h4><a href="product-details.html">simple Product 06</a></h4>
                                        <div class="price-box">
                                            <div class="regular-price">
                                                $190.00
                                            </div>
                                            <div class="old-price">
                                                <del>$210.00</del>
                                            </div>
                                        </div>
                                        <div class="ratings">
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <div class="pro-review">
                                                <span>1 review(s)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end single item -->
                            </div> <!-- end single item column -->
                        </div>
                    </div>
                </div>
                <!-- Most viewed area end -->
                <!-- Most viewed area start -->
                <div class="col-lg-4">
                    <div class="category-wrapper mb-md-24 mb-sm-24">
                        <div class="section-title-2 d-flex justify-content-between mb-28">
                            <h3> Most Popular</h3>
                            {{-- Products with high sales volumes --}}
                            <div class="category-append"></div>
                        </div> <!-- section title end -->
                        <div class="category-carousel-active row" data-row="3">
                            <div class="col">
                                <div class="category-item">
                                    <div class="category-thumb">
                                        <a href="product-details.html">
                                            <img src="{{ asset('frontend/assets/img/product/product-img6.jpg') }}"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="category-content">
                                        <h4><a href="product-details.html">Virtual Product 01</a></h4>
                                        <div class="price-box">
                                            <div class="regular-price">
                                                $120.00
                                            </div>
                                            <div class="old-price">
                                                <del>$150.00</del>
                                            </div>
                                        </div>
                                        <div class="ratings">
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span class="good"><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <div class="pro-review">
                                                <span>1 review(s)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end single item -->
                            </div> <!-- end single item column -->
                        </div>
                    </div>
                </div>
                <!-- Most viewed area end -->
            </div>
        </div>
        <!-- category features area end -->
    </div>
    <!-- 3  sliderrs -->

    <!-- latest product start -->
    @if (!empty($new_arrival_pro) && $new_arrival_pro->isNotEmpty())
        <div class="latest-product">
            <div class="container">
                <div class="section-title mb-30">
                    <div class="title-icon">
                        <i class="fa fa-flash"></i>
                    </div>
                    <h3>New Arrival</h3>
                </div> <!-- section title end -->
                <!-- featured category start -->
                <div class="latest-product-active slick-padding slick-arrow-style">
                    @foreach ($new_arrival_pro as $item)
                        @include('frontend.partials.pro_slide', ['item' => $item])
                    @endforeach
                </div>
                <!-- featured category end -->
            </div>
        </div>
    @endif
    <!-- latest product end -->

    <!-- brand area start -->
    @if (!empty($brands) && $brands->isNotEmpty())
        <div class="brand-area pt-28 pb-30">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title mb-30">
                            <div class="title-icon">
                                <i class="fa fa-crop"></i>
                            </div>
                            <h3>Popular Brand</h3>
                        </div> <!-- section title end -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="brand-active slick-padding slick-arrow-style">
                            @foreach ($brands as $item)
                                <div class="brand-item text-center">
                                    <a href="{{ route('shop', ['slug' => 'brand/' . $item->slug]) }}"><img
                                            style="width:150px; height:150px"
                                            src="{{ asset('storage/' . $item->image) }}" alt=""></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- brand area end -->
@endsection
