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
                
                <div class="col-lg-6 col-md-6 order-sm-6">
                    <div class="img-container img-full fix mb-30">
                        <a href="#">
                            <img src="{{ asset('frontend/assets/img/banner/banner_static_top1.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
                                <div class="col-lg-6 col-md-6 order-sm-6">

                    <div class="img-container img-full fix mb-30">
                        <a href="#">
                            <img src="{{ asset('frontend/assets/img/banner/banner_static_top2.jpg') }}" alt="">
                        </a>
                    </div>
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
                        <!-- category tab area start -->
                        <div class="category-tab-area mb-30 mt-md-16 mt-sm-16">
                            <div class="category-tab">
                                <ul class="nav" id="categoryTabs">
                                    @foreach ($featured_categories as $category_tab)
                                        <li>
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab"
                                                href="#tab-{{ $category_tab->id }}" data-id="{{ $category_tab->id }}">
                                                {{ $category_tab->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content">
                            @foreach ($featured_categories as $category_tab)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="tab-{{ $category_tab->id }}">

                                    <div class="container">
                                        <div class="row ajax-content" data-loaded="{{ $loop->first ? 'true' : 'false' }}">

                                            {{-- Preload ONLY first tab --}}
                                            @if ($loop->first)
                                                @foreach ($category_tab->products as $item)
                                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-30">
                                                        @include('frontend.partials.pro_slide')
                                                    </div>
                                                @endforeach
                                            @endif

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

    <script>
        $(document).ready(function() {

            const skeleton = `
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-30">
            <div class="skeleton-card">
                <div class="skeleton skeleton-img"></div>
                <div class="skeleton skeleton-text"></div>
                <div class="skeleton skeleton-text small"></div>
            </div>
        </div>
    `.repeat(4);

            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {

                let tab = $(e.target);
                let categoryId = tab.data('id');
                let target = $(tab.attr('href'));
                let content = target.find('.ajax-content');

                // STOP if already loaded
                if (content.data('loaded') === true || content.data('loaded') === 'true') {
                    return;
                }

                $.ajax({
                    url: '/category-products/' + categoryId,
                    type: 'GET',

                    beforeSend: function() {
                        content.html(skeleton);
                    },

                    success: function(res) {
                        content.hide().html(res.html).fadeIn(300);
                        content.attr('data-loaded', 'true');
                    },

                    error: function() {
                        content.html(
                            '<div class="col-12 text-center text-danger">Failed to load products</div>'
                            );
                    }
                });

            });

        });
    </script>


    <!-- brand area end -->
    <style>
        .skeleton-card {
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 8px;
        }

        .skeleton {
            background: linear-gradient(90deg, #eee, #f5f5f5, #eee);
            background-size: 200% 100%;
            animation: shimmer 1.2s infinite;
            border-radius: 6px;
        }

        .skeleton-img {
            height: 180px;
            margin-bottom: 10px;
        }

        .skeleton-text {
            height: 15px;
            margin-bottom: 8px;
            width: 80%;
        }

        .skeleton-text.small {
            width: 40%;
        }

        @keyframes shimmer {
            100% {
                background-position: -200% 0;
            }
        }
    </style>
@endsection
