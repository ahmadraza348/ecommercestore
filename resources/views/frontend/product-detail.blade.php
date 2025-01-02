@extends('frontend.layouts.layout')
@section('content')
    <div class="product-details-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">

                    {{-- <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-6">
                                @if ($pro_detail->gallery_images->isNotEmpty())
                                    <!-- Main Slider -->
                                    <div class="product-large-slider mb-20 slick-arrow-style_2">
                                        @foreach ($pro_detail->gallery_images as $item)
                                            <div class="pro-large-img img-zoom">
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="Gallery Image" />
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Thumbnail Navigation -->
                                    <div class="pro-nav slick-padding2 slick-arrow-style_2">
                                        @foreach ($pro_detail->gallery_images as $item)
                                            <div class="pro-nav-thumb">
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="Thumbnail Image" />
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-6">
                                <div class="product-details-des mt-md-34 mt-sm-34">
                                    <h3><a href="product-details.html">{{ $pro_detail->name }}</a></h3>
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
                                    <div class="customer-rev">
                                        <a href="#">(1 customer review)</a>
                                    </div>
                                    <div class="availability mt-10">
                                        <h5>Availability:</h5>
                                        <span>{{ $pro_detail->stock }} in stock</span>
                                    </div>
                                    <div class="pricebox">
                                        <span class="regular-price">{{ $pro_detail->sale_price }} PKR</span>
                                    </div>
                                    <p>{{ $pro_detail->short_description }}</p>
                                    <div class="color-option mt-10">
                                        <h5>color :</h5>
                                        <ul>
                                            <li>
                                                <a class="c-black" href="#" title="Black"></a>
                                            </li>
                                            <li>
                                                <a class="c-blue" href="#" title="Blue"></a>
                                            </li>
                                            <li>
                                                <a class="c-brown" href="#" title="Brown"></a>
                                            </li>
                                            <li>
                                                <a class="c-gray" href="#" title="Gray"></a>
                                            </li>
                                            <li>
                                                <a class="c-red" href="#" title="Red"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="pro-size mb-20 mt-20">
                                        <h5>size :</h5>
                                        <select class="nice-select" style="display: none;">
                                            <option>S</option>
                                            <option>M</option>
                                            <option>L</option>
                                            <option>XL</option>
                                        </select>
                                        <div class="nice-select" tabindex="0"><span class="current">S</span>
                                            <ul class="list">
                                                <li data-value="S" class="option selected">S</li>
                                                <li data-value="M" class="option">M</li>
                                                <li data-value="L" class="option">L</li>
                                                <li data-value="XL" class="option">XL</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="quantity-cart-box d-flex align-items-center">
                                        <div class="quantity">
                                            <div class="pro-qty"><span class="dec qtybtn"></span><input type="text"
                                                    value="1"><span class="inc qtybtn"></span></div>
                                        </div>
                                        <div class="action_link ">
                                            <a class="buy-btn" href="#">add to cart<i class="fa fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="useful-links mt-20">
                                        <a href="#" data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Compare"><i class="fa fa-refresh"></i>compare</a>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Wishlist"><i class="fa fa-heart-o"></i>wishlist</a>
                                    </div>
                                    <div class="share-icon mt-20">
                                        <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                        <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                        <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-6">
                                @if ($pro_detail->gallery_images->isNotEmpty())
                                    <!-- Main Slider -->
                                    <div class="product-large-slider mb-20 slick-arrow-style_2">
                                        @foreach ($pro_detail->gallery_images as $item)
                                            <div class="pro-large-img img-zoom">
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="Gallery Image" />
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Thumbnail Navigation -->
                                    <div class="pro-nav slick-padding2 slick-arrow-style_2">
                                        @foreach ($pro_detail->gallery_images as $item)
                                            <div class="pro-nav-thumb">
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="Thumbnail Image" />
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            {{-- <div class="col-lg-6">
                                <div class="product-details-des mt-md-34 mt-sm-34">
                                    <h3>{{ $pro_detail->name }}</h3>
                                    <div class="availability mt-10">
                                        <h5>Availability:</h5>
                                        <span>{{ $pro_detail->stock }} in stock</span>
                                    </div>
                                    <div class="pricebox">
                                        <span class="regular-price">{{ $pro_detail->sale_price }} PKR</span>
                                    </div>
                                    <p>{{ $pro_detail->short_description }}</p>

                                    <!-- Attribute Selection -->
                                    <div class="color-option mt-10">
                                        <h5>Color:</h5>
                                        <ul id="color-options">
                                            @foreach ($pro_detail->attributes->where('slug', 'color') as $color)
                                            @dump($color)
                                                <li>
                                                    <input type="radio" name="color"
                                                        value="{{ $color->pivot->attribute_value_id }}"
                                                        id="color-{{ $color->pivot->attribute_value_id }}">
                                                    <label
                                                        for="color-{{ $color->pivot->attribute_value_id }}">{{ $color->name }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="pro-size mt-20">
                                        <h5>Size:</h5>
                                        <select id="size-options" class="nice-select" disabled>
                                            <option value="">Select Size</option>
                                        </select>
                                    </div>

                                    <div class="fabric-option mt-20">
                                        <h5>Fabric:</h5>
                                        <select id="fabric-options" class="nice-select" disabled>
                                            <option value="">Select Fabric</option>
                                        </select>
                                    </div>

                                    <!-- Add to Cart -->
                                    <div class="quantity-cart-box d-flex align-items-center mt-20">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <span class="dec qtybtn"></span>
                                                <input type="text" value="1">
                                                <span class="inc qtybtn"></span>
                                            </div>
                                        </div>
                                        <div class="action_link">
                                            <button id="add-to-cart-btn" class="buy-btn" disabled>Add to Cart<i
                                                    class="fa fa-shopping-cart"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-lg-6">
                                <div class="product-details-des mt-md-34 mt-sm-34">
                                    <h3>{{ $pro_detail->name }}</h3>
                                    <div class="availability mt-10">
                                        <h5>Availability:</h5>
                                        <span>{{ $pro_detail->stock }} in stock</span>
                                    </div>
                                    <div class="pricebox">
                                        <span class="regular-price">{{ $pro_detail->sale_price }} PKR</span>
                                    </div>
                                    <p>{{ $pro_detail->short_description }}</p>

                                    <!-- Attribute Selection -->
                                    <div class="color-option mt-10">
                                        <h5>Color:</h5>
                                        <ul id="color-options">
                                            @foreach ($pro_detail->attributes->where('slug', 'color') as $color)
                                                @php
                                                    // Fetch the color name from the pivot table's attribute_value_id
$colorName =
    \App\Models\AttributeValue::find(
        $color->pivot->attribute_value_id,
    )->name ?? 'N/A';
                                                @endphp
                                                <li>
                                                    <input type="radio" name="color"
                                                        value="{{ $color->pivot->attribute_value_id }}"
                                                        id="color-{{ $color->pivot->attribute_value_id }}">
                                                    <label
                                                        for="color-{{ $color->pivot->attribute_value_id }}">{{ $colorName }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="pro-size mt-20">
                                        <h5>Size:</h5>
                                        <select id="size-options" class="nice-select" disabled>
                                            <option value="">Select Size</option>
                                        </select>
                                    </div>

                                    <div class="fabric-option mt-20">
                                        <h5>Fabric:</h5>
                                        <select id="fabric-options" class="nice-select" disabled>
                                            <option value="">Select Fabric</option>
                                        </select>
                                    </div>

                                    <!-- Add to Cart -->
                                    <div class="quantity-cart-box d-flex align-items-center mt-20">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <span class="dec qtybtn"></span>
                                                <input type="text" value="1">
                                                <span class="inc qtybtn"></span>
                                            </div>
                                        </div>
                                        <div class="action_link">
                                            <button id="add-to-cart-btn" class="buy-btn" disabled>Add to Cart<i
                                                    class="fa fa-shopping-cart"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews mt-34">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">
                                        <li>
                                            <a class="active" data-toggle="tab" href="#tab_one">description</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#tab_two">information</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#tab_three">reviews</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content reviews-tab">
                                        <div class="tab-pane fade show active" id="tab_one">
                                            <div class="tab-one">
                                                {!! $pro_detail->long_description !!}
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_two">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td>color</td>
                                                        <td>black, blue, red</td>
                                                    </tr>
                                                    <tr>
                                                        <td>size</td>
                                                        <td>L, M, S</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="tab_three">
                                            <form action="#" class="review-form">
                                                <h5>1 review for {{ $pro_detail->name }}</h5>
                                                <div class="total-reviews">
                                                    <div class="rev-avatar">
                                                        <img src="{{ asset('frontend/assets/img/about/avatar.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="review-box">
                                                        <div class="ratings">
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star"></i></span>
                                                        </div>
                                                        <div class="post-author">
                                                            <p><span>admin -</span> 30 Nov, 2018</p>
                                                        </div>
                                                        <p>Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem
                                                            varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut
                                                            venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue
                                                            placerat pretium, augue erat accumsan lacus</p>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Your Name</label>
                                                        <input type="text" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Your Email</label>
                                                        <input type="email" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Your Review</label>
                                                        <textarea class="form-control" required></textarea>
                                                        <div class="help-block pt-10"><span
                                                                class="text-danger">Note:</span> HTML is not translated!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Rating</label>
                                                        &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                                        <input type="radio" value="1" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="2" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="3" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="4" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="5" name="rating" checked>
                                                        &nbsp;Good
                                                    </div>
                                                </div>
                                                <div class="buttons">
                                                    <button class="sqr-btn" type="submit">Continue</button>
                                                </div>
                                            </form> <!-- end of review-form -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details reviews end -->

                </div>

                <!-- sidebar start -->
                <div class="col-lg-3">
                    <div class="shop-sidebar-wrap fix mt-md-22 mt-sm-22">
                        <!-- featured category start -->
                        <div class="sidebar-widget mb-22">
                            <div class="section-title-2 d-flex justify-content-between mb-28">
                                <h3>Related</h3>
                                <div class="category-append"></div>
                            </div> <!-- section title end -->
                            <div class="category-carousel-active row" data-row="4">
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
                                                    <del>$180.00</del>
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
                                <div class="col">
                                    <div class="category-item">
                                        <div class="category-thumb">
                                            <a href="product-details.html">
                                                <img src="{{ asset('frontend/assets/img/product/product-img2.jpg') }}"
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
                                                    <del>$180.00</del>
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
                                <div class="col">
                                    <div class="category-item">
                                        <div class="category-thumb">
                                            <a href="product-details.html">
                                                <img src="{{ asset('frontend/assets/img/product/product-img3.jpg') }}"
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
                                                    <del>$180.00</del>
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
                                <div class="col">
                                    <div class="category-item">
                                        <div class="category-thumb">
                                            <a href="product-details.html">
                                                <img src="{{ asset('frontend/assets/img/product/product-img4.jpg') }}"
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
                                                    <del>$180.00</del>
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
                                <div class="col">
                                    <div class="category-item">
                                        <div class="category-thumb">
                                            <a href="product-details.html">
                                                <img src="{{ asset('frontend/assets/img/product/product-img5.jpg') }}"
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
                                                    <del>$180.00</del>
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
                                                    $150.00
                                                </div>
                                                <div class="old-price">
                                                    <del>$180.00</del>
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
                                <div class="col">
                                    <div class="category-item">
                                        <div class="category-thumb">
                                            <a href="product-details.html">
                                                <img src="{{ asset('frontend/assets/img/product/product-img10.jpg') }}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="category-content">
                                            <h4><a href="product-details.html">simple Product 01</a></h4>
                                            <div class="price-box">
                                                <div class="regular-price">
                                                    $150.00
                                                </div>
                                                <div class="old-price">
                                                    <del>$180.00</del>
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
                                <div class="col">
                                    <div class="category-item">
                                        <div class="category-thumb">
                                            <a href="product-details.html">
                                                <img src="{{ asset('frontend/assets/img/product/product-img12.jpg') }}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="category-content">
                                            <h4><a href="product-details.html">external Product 01</a></h4>
                                            <div class="price-box">
                                                <div class="regular-price">
                                                    $140.00
                                                </div>
                                                <div class="old-price">
                                                    <del>$160.00</del>
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
                        <!-- featured category end -->

                        <!-- product tag start -->
                        <div class="sidebar-widget mb-22">
                            <div class="sidebar-title mb-20">
                                <h3>tag</h3>
                            </div>
                            <div class="sidebar-widget-body">
                                <div class="product-tag">
                                    <a href="#">camera</a>
                                    <a href="#">computer</a>
                                    <a href="#">tablet</a>
                                    <a href="#">watch</a>
                                    <a href="#">smart phones</a>
                                    <a href="#">handbag</a>
                                    <a href="#">shoe</a>
                                    <a href="#">men</a>
                                </div>
                            </div>
                        </div>
                        <!-- product tag end -->


                    </div>
                </div>
                <!-- sidebar end -->
            </div>
        </div>
    </div>
@endsection
<script>
    $(document).ready(function () {
        // Handle color selection
        $('input[name="color"]').change(function () {
            const colorId = $(this).val();

            // Clear and disable dependent dropdowns
            $('#size-options').empty().append('<option value="">Select Size</option>').prop('disabled', true);
            $('#fabric-options').empty().append('<option value="">Select Fabric</option>').prop('disabled', true);
            $('#add-to-cart-btn').prop('disabled', true);

            // Fetch related attributes and values for the selected color
            $.ajax({
                url: '/get-attributes',
                method: 'POST',
                data: {
                    color_id: colorId,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.sizes && response.sizes.length > 0) {
                        const sizeOptions = $('#size-options');
                        sizeOptions.empty().append('<option value="">Select Size</option>');
                        response.sizes.forEach(size => {
                            sizeOptions.append(
                                `<option value="${size.id}">${size.name}</option>`
                            );
                        });
                        sizeOptions.prop('disabled', false);
                    }

                    if (response.fabrics && response.fabrics.length > 0) {
                        const fabricOptions = $('#fabric-options');
                        fabricOptions.empty().append('<option value="">Select Fabric</option>');
                        response.fabrics.forEach(fabric => {
                            fabricOptions.append(
                                `<option value="${fabric.id}">${fabric.name}</option>`
                            );
                        });
                        fabricOptions.prop('disabled', true); // Enable after size is selected
                    }
                },
                error: function () {
                    alert('Failed to fetch attributes. Please try again.');
                }
            });
        });

        // Handle size selection
        $('#size-options').change(function () {
            const sizeId = $(this).val();

            // Clear and disable fabric dropdown
            $('#fabric-options').empty().append('<option value="">Select Fabric</option>').prop('disabled', true);
            $('#add-to-cart-btn').prop('disabled', true);

            if (sizeId) {
                // Fetch fabrics based on selected size
                $.ajax({
                    url: '/get-fabrics',
                    method: 'POST',
                    data: {
                        size_id: sizeId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.fabrics && response.fabrics.length > 0) {
                            const fabricOptions = $('#fabric-options');
                            fabricOptions.empty().append('<option value="">Select Fabric</option>');
                            response.fabrics.forEach(fabric => {
                                fabricOptions.append(
                                    `<option value="${fabric.id}">${fabric.name}</option>`
                                );
                            });
                            fabricOptions.prop('disabled', false);
                        }
                    },
                    error: function () {
                        alert('Failed to fetch fabrics. Please try again.');
                    }
                });
            }
        });

        // Enable Add to Cart button when all attributes are selected
        $('#fabric-options').change(function () {
            const fabricId = $(this).val();
            if (fabricId) {
                $('#add-to-cart-btn').prop('disabled', false);
            } else {
                $('#add-to-cart-btn').prop('disabled', true);
            }
        });
    });
</script>

