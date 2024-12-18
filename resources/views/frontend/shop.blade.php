@extends('frontend.layouts.layout')
@section('content')


    <div class="page-main-wrapper">
        <div class="container">
            <div class="row">
                <!-- sidebar start -->
                <div class="col-lg-3 order-2 order-lg-1">
                    <div class="shop-sidebar-wrap mt-md-28 mt-sm-28">
                        <!-- sidebar categorie start -->
                        @if (!empty($shopPageCategories) && $shopPageCategories->isNotEmpty())
                            <div class="sidebar-widget mb-30">
                                <div class="sidebar-category">
                                    <ul>
                                        <li class="title"><i class="fa fa-bars"></i> Categories</li>
                                        @foreach ($shopPageCategories as $item)
                                            <li>
                                                <a href="{{ route('shop', ['slug' => buildCategorySlug($item)]) }}">
                                                    {{ $item->name }}
                                                </a>
                                                <span>({{ $item->products->where('status', 'active')->count() }})</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <!-- pricing filter start -->
                        <div class="sidebar-widget mb-30">
                            <div class="sidebar-title mb-10">
                                <h3>filter by price</h3>
                            </div>
                            <div class="sidebar-widget-body">
                                <div class="price-range-wrap">
                                    <div class="price-range" data-min="50" data-max="400"></div>
                                    <div class="range-slider">
                                        <form action="#" class="d-flex justify-content-between">
                                            <button class="filter-btn">filter</button>
                                            <div class="price-input d-flex align-items-center">
                                                <label for="amount">Price: </label>
                                                <input type="text" id="amount">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form method="post" id="FilterForm" action="">
                        </form>

                        @if ($brands->isNotEmpty())
                            <div class="sidebar-widget mb-30">
                                <div class="sidebar-title mb-10">
                                    <h3>Brands</h3>
                                </div>
                                <div class="sidebar-widget-body">
                                    <ul>
                                        @foreach ($shopPageBrands as $brand)
                                            <li>
                                                <label>
                                                    <input type="checkbox" class="filter-brand" value="{{ $brand->id }}">
                                                    {{ $brand->name }}
                                                </label>
                                                <span>({{ $brand->products->count() }})</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <!-- manufacturer end -->

                        @if ($shopPageAttributes->isNotEmpty())
                            @foreach ($shopPageAttributes as $attribute)
                                <div class="sidebar-widget mb-30">
                                    <div class="sidebar-title mb-10">
                                        <h3>{{ $attribute->name }}</h3>
                                    </div>
                                    <div class="sidebar-widget-body">
                                        <ul>
                                            @foreach ($attribute->attributevalue as $value)
                                                <li> <a {{-- href="{{ route('shop', ['slug' => $brand->slug]) }}" --}}>
                                                        <input type="checkbox" name=""class="filter-attribute"value="{{$value->id}}" id="">
                                                        {{ $value->name }}</a>
                                                    <span>({{ $value->products->count() }})</span>
                                                    {{-- <span>{{ $value->id }}</span> --}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <!-- product size end -->

                        <!-- product tag start -->
                        <div class="sidebar-widget mb-30">
                            <div class="sidebar-title mb-10">
                                <h3>tags</h3>
                            </div>
                            <div class="sidebar-widget-body">
                                <div class="product-tag">
                                    <a href="#">camera</a>

                                </div>
                            </div>
                        </div>
                        <!-- product tag end -->

                        <!-- sidebar banner start -->
                        <div class="sidebar-widget mb-30">
                            <div class="img-container fix img-full">
                                <a href="#"><img src="{{ asset('frontend/assets/img/banner/banner_shop.jpg') }}"
                                        alt=""></a>
                            </div>
                        </div>
                        <!-- sidebar banner end -->
                    </div>
                </div>
                <!-- sidebar end -->


                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="shop-banner img-full">
                        <img src="{{ asset('frontend/assets/img/banner/banner_static1.jpg') }}" alt="">
                    </div>
                    <!-- product view wrapper area start -->
                    <div class="shop-product-wrapper pt-34">
                        <!-- shop product top wrap start -->
                        <div class="shop-top-bar">
                            <div class="row">
                                <div class="col-lg-7 col-md-6">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode mr-70 mr-sm-0">
                                            <a class="active" href="#" data-target="grid"><i class="fa fa-th"></i></a>
                                            <a href="#" data-target="list"><i class="fa fa-list"></i></a>
                                        </div>
                                        <div class="product-amount">
                                            <p>Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of
                                                {{ $products->total() }} results</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6">
                                    <div class="top-bar-right">
                                        <div class="product-short">
                                            <p>Sort By : </p>
                                            <select class="nice-select" name="sortby">
                                                <option value="trending">Relevance</option>
                                                <option value="sales">Name (A - Z)</option>
                                                <option value="sales">Name (Z - A)</option>
                                                <option value="rating">Price (Low &gt; High)</option>
                                                <option value="date">Rating (Lowest)</option>
                                                <option value="price-asc">Model (A - Z)</option>
                                                <option value="price-asc">Model (Z - A)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- shop product top wrap start -->

                        <!-- product item start -->
                        <div class="shop-product-wrap grid row">
                            <div class="col-lg-12">
                                <!-- featured category area start -->
                                @if ($shopPageCategories->isNotEmpty())
                                    <div class="feature-category-area mt-md-70">
                                        <div class="section-title mb-30">
                                            <div class="title-icon">
                                                <i class="fa fa-bookmark"></i>
                                            </div>
                                            <h3>Shop By Category</h3>
                                        </div>
                                        <div class="featured-carousel-active slick-padding slick-arrow-style">
                                            @foreach ($shopPageCategories as $item)
                                                <div class="product-item fix mb-30">
                                                    <div class="product-thumb">
                                                        <a
                                                            href="{{ route('shop', ['slug' => buildCategorySlug($item)]) }}">
                                                            <img style="border-radius:100%; width: 200px; height:200px"src="{{ $item->image ? asset('storage/' . $item->image) : asset('backend/assets/img/noimage.png') }}"
                                                                class="img-pri" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-content">
                                                        <h4><a
                                                                href="{{ route('shop', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="loader" style="display: none; text-align: center;">
                                    <img src="{{ asset('frontend/assets/loader.gif') }}" style="position:absolute; z-index:999" alt="Loading..." />
                                </div>

                                <div id="product-list" class="row">
                                    @forelse ($products as $item)
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            @include('frontend.partials.pro_slide', ['item' => $item])
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div style="background-color:#d8373e; color:white" class="alert text-center"
                                                role="alert">
                                                <h5>No Product Found</h5>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>

                            </div>


                        </div>
                        <!-- product item end -->
                    </div>
                    <!-- product view wrapper area end -->

                    <!-- start pagination area -->
                    <div class="paginatoin-area text-center pt-28">
                        <div class="row">
                            <div class="col-12">
                                {{ $products->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                    <!-- end pagination area -->
                </div>

                <!-- product main wrap end -->
            </div>
        </div>
    </div>
@endsection
