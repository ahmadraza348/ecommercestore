@extends('frontend.layouts.layout')
@section('content')
<div class="product-details-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <!-- product details inner end -->
                <div class="product-details-inner">
                    <div class="row">



                        @if ($product->product_variation_type == 'simple')
                        <div class="col-lg-6">
                            <div class="product-large-slider mb-20 slick-arrow-style_2">
                                @foreach ($product->gallery_images as $item)
                                <div class="pro-large-img img-zoom">
                                    <img src="{{ asset('storage/' . $item->image) }} " alt="" />
                                </div>
                                @endforeach

                            </div>
                            <div class="pro-nav slick-padding2 slick-arrow-style_2">
                                @foreach ($product->gallery_images as $item)
                                <div class="pro-nav-thumb">
                                    <img src="{{ asset('storage/' . $item->image) }} " alt="" />
                                </div>
                                @endforeach

                            </div>
                        </div>
                        @else
                        <div class="col-lg-6">

                            {{-- MAIN SLIDER --}}
                            <div class="product-large-slider mb-20 slick-arrow-style_2" id="main-slider">
                                @foreach ($product->gallery_images as $item)
                                <div class="pro-large-img img-zoom" data-color="{{ $item->color_id }}">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="">
                                </div>
                                @endforeach
                            </div>

                            {{-- THUMB SLIDER --}}
                            <div class="pro-nav slick-padding2 slick-arrow-style_2" id="thumb-slider">
                                @foreach ($product->gallery_images as $item)
                                <div class="pro-nav-thumb" data-color="{{ $item->color_id }}">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="">
                                </div>
                                @endforeach
                            </div>

                        </div>
                        @endif




                        <div class="col-lg-6">
                            <form action="{{route('addToCart')}}" method="post">
                                @csrf

                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="final_price" id="final_price" value="">

                                <div class="product-details-des mt-md-34 mt-sm-34">
                                    <h3><a href="product-details.html">{{ $product->name }}</a></h3>
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
                                        <span>{{ $product->stock }} in stock</span>
                                    </div>
                                    <div class="pricebox">
                                        <h5 id="price">Rs. {{ $product->sale_price }}</h5>
                                    </div>
                                    <br>

                                    @if ($product->proAttributeValuesRecords->isNotEmpty())
                                    <label><b>Select Color: <span id="selected-color-name"></span>
                                        </b></label>
                                    <div class="color-options">

                                        @foreach ($product->proAttributeValuesRecords->unique('color_id') as $item)
                                        @php
                                        $color = $item->color->colorcode ?? '#000';
                                        $colorId = $item->color->id;
                                        $colorName = $item->color->name;
                                        $colorPrice = $item->price ?: $product->sale_price;
                                        $stock = $item->stock ?: $product->stock;
                                        $variantSet = $variants[$colorId] ?? [];
                                        @endphp

                                        <input type="radio" required name="color" id="color_{{ $colorId }}"
                                            value="{{ $colorId }}"
                                            data-stock="{{ $stock }}"
                                            data-variants='@json($variantSet)'
                                            data-price="{{ $colorPrice }}" {{ $loop->first ? 'checked' : '' }}
                                            data-name="{{ $colorName }}">


                                        <label for="color_{{ $colorId }}" class="color-box"
                                            style="background: {{ $color }};"></label>
                                        @endforeach

                                    </div>
                                    @endif

                                    <div id="variant-attribute"></div>
                                    <br>


                                    <div class="quantity-cart-box d-flex align-items-center">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="number" name="pro_qty" value="1" min="1" max="">
                                            </div>
                                        </div>

                                        <div class="action_link">
                                            <button type="submit" style="border:none;background:none;padding:0;">
                                                <a class="buy-btn" type="submit" style="cursor:pointer">add to cart<i
                                                        class="fa fa-shopping-cart"></i></a>
                                            </button>



                                        </div>
                                    </div>
                                    <div class="useful-links mt-20">
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i
                                                class="fa fa-refresh"></i>compare</a>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Wishlist"><i
                                                class="fa fa-heart-o"></i>wishlist</a>
                                    </div>
                                    <div class="share-icon mt-20">
                                        <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                        <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                        <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                    </div>
                                </div>
                            </form>
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
                                        <a data-toggle="tab" href="#tab_three">reviews</a>
                                    </li>
                                </ul>
                                <div class="tab-content reviews-tab">
                                    <div class="tab-pane fade show active" id="tab_one">
                                        <div class="tab-one">
                                            {!! $product->long_description !!}
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab_three">
                                        <form action="#" class="review-form">
                                            <h5>1 review for Simple product 12</h5>
                                            <div class="total-reviews">
                                                <div class="rev-avatar">
                                                    <img src="frontend/assets/img/about/avatar.jpg" alt="">
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

                <!-- related products area start -->
                <div class="related-products-area mt-34">
                    <div class="section-title mb-30">
                        <div class="title-icon">
                            <i class="fa fa-desktop"></i>
                        </div>
                        <h3>related products</h3>
                    </div> <!-- section title end -->
                    <!-- featured category start -->
                    <div class="featured-carousel-active slick-padding slick-arrow-style">
                        <!-- product single item start -->
                        <div class="product-item fix">
                            <div class="product-thumb">
                                <a href="product-details.html">
                                    <img src="{{ asset('frontend/assets/img/product/product-img1.jpg') }}"
                                        class="img-pri" alt="">
                                    <img src="{{ asset('frontend/assets/img/product/product-img2.jpg') }}"
                                        class="img-sec" alt="">
                                </a>
                                <div class="product-label">
                                    <span>hot</span>
                                </div>
                                <div class="product-action-link">
                                    <a href="#" data-toggle="modal" data-target="#quick_view"> <span
                                            data-toggle="tooltip" data-placement="left" title="Quick view"><i
                                                class="fa fa-search"></i></span> </a>
                                    <a href="#" data-toggle="tooltip" data-placement="left"
                                        title="Wishlist"><i class="fa fa-heart-o"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Compare"><i
                                            class="fa fa-refresh"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="left"
                                        title="Add to cart"><i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h4><a href="product-details.html">affiliate product</a></h4>
                                <div class="pricebox">
                                    <span class="regular-price">$90.00</span>
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
                            </div>
                        </div>

                    </div>
                    <!-- featured category end -->
                </div>
                <!-- related products area end -->
            </div>

            <!-- sidebar start -->
            <div class="col-lg-3">
                <div class="shop-sidebar-wrap fix mt-md-22 mt-sm-22">
                    <!-- featured category start -->
                    <div class="sidebar-widget mb-22">
                        <div class="section-title-2 d-flex justify-content-between mb-28">
                            <h3>featured</h3>
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

                        </div>
                    </div>
                    <!-- featured category end -->

                    <!-- manufacturer start -->
                    <div class="sidebar-widget mb-22">
                        <div class="sidebar-title mb-10">
                            <h3>Manufacturers</h3>
                        </div>
                        <div class="sidebar-widget-body">
                            <ul>
                                <li><i class="fa fa-angle-right"></i><a href="#">calvin
                                        klein</a><span>(10)</span></li>
                                <li><i class="fa fa-angle-right"></i><a href="#">diesel</a><span>(12)</span>
                                </li>
                                <li><i class="fa fa-angle-right"></i><a href="#">polo</a><span>(20)</span></li>
                                <li><i class="fa fa-angle-right"></i><a href="#">Tommy
                                        Hilfiger</a><span>(12)</span></li>
                                <li><i class="fa fa-angle-right"></i><a href="#">Versace</a><span>(16)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- manufacturer end -->

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

                    <!-- sidebar banner start -->
                    <div class="sidebar-widget mb-22">
                        <div class="img-container fix img-full mt-30">
                            <a href="#"><img src="frontend/assets/img/banner/banner_shop.jpg')}}"
                                    alt=""></a>
                        </div>
                    </div>
                    <!-- sidebar banner end -->
                </div>
            </div>
            <!-- sidebar end -->
        </div>
    </div>
</div>
<style>
    .color-options input[type="radio"] {
        display: none;
    }

    .color-options .color-box {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        border: 2px solid #ccc;
        display: inline-block;
        margin-right: 8px;
        cursor: pointer;
        transition: 0.2s;
    }

    .color-options input[type="radio"]:checked+.color-box {
        border: 3px solid #000;
        transform: scale(1.1);
    }

    .variant-options input[type="radio"] {
        display: none;
    }

    .variant-options label {
        border: 1px solid #ccc;
        background-color: #d8373e;
        padding: 4px 8px;
        color: white;
        margin-right: 8px;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
        transition: 0.2s;
    }

    .variant-options input[type="radio"]:checked+label {
        border: 2px solid #000;
        background-color: #d8373e;
    }
</style>

<script>
    $(document).ready(function() {

        // Select first color by default
        let firstColor = $('input[name="color"]').first();
        firstColor.prop('checked', true);
        $('#selected-color-name').text(firstColor.data('name'));

        updateUI(firstColor);
    });

    // When user selects a color
    $('input[name="color"]').on('change', function() {
        $('#selected-color-name').text($(this).data('name'));
        updateUI($(this));
    });

    function updateUI(colorRadio) {
        const colorId = colorRadio.val();
        const variants = colorRadio.data('variants');

        let colorPrice = colorRadio.data('price') > 0 ?
            colorRadio.data('price') : {
                {
                    $product - > sale_price
                }
            };
        $('#price').text('Rs. ' + colorPrice);
        $('#final_price').val(colorPrice);


        loadColorImages(colorId);
        loadVariantValues(variants);
    }

    // Store original slides
    let originalMainSlides = $('#main-slider').html();
    let originalThumbSlides = $('#thumb-slider').html();

    function loadColorImages(colorId) {
        let main = $(originalMainSlides).filter(`[data-color="${colorId}"]`);
        let thumb = $(originalThumbSlides).filter(`[data-color="${colorId}"]`);

        if ($('#main-slider').hasClass('slick-initialized')) $('#main-slider').slick('unslick');
        if ($('#thumb-slider').hasClass('slick-initialized')) $('#thumb-slider').slick('unslick');

        $('#main-slider').html(main);
        $('#thumb-slider').html(thumb);

        $('#main-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            arrows: true,
            asNavFor: '#thumb-slider'
        });

        $('#thumb-slider').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            focusOnSelect: true,
            asNavFor: '#main-slider'
        });
    }

    function loadVariantValues(variants) {

        if (!variants || variants.length === 0) {
            $('#variant-attribute').html('');
            return;
        }

        // Select the first variant by default
        let selectedVariant = variants[0];

        let price = selectedVariant.price || $('#price').text().replace('Rs. ', '');
        $('#price').text('Rs. ' + price);
        $('#final_price').val(price);

        const attributeName = selectedVariant.attribute_value?.attribute?.name || 'Select';
        const attributeValue = selectedVariant.attribute_value?.name || '';

        let html = `
            <label><strong>Select ${attributeName}: ${attributeValue}</strong></label>
            <div class="variant-options">
        `;

        variants.forEach(v => {
            html += `
                <input type="radio"
                       name="variant"
                       id="variant_${v.id}"
                       value="${v.attribute_value_id}"
                       data-price="${v.price}"
                        data-stock="${v.stock}"
                       ${v.id == selectedVariant.id ? 'checked' : ''}>
                <label for="variant_${v.id}">${v.attribute_value.name}</label>
            `;
        });

        html += `</div>`;
        $('#variant-attribute').html(html);

        // When selecting variant
        $('input[name="variant"]').off('change').on('change', function() {
            const vPrice = $(this).data('price') || price;
            const vName = $(this).next('label').text();

            $('#price').text('Rs. ' + vPrice);
            $('#final_price').val(vPrice);

            $('#variant-attribute label strong').text(`Select ${attributeName}: ${vName}`);
        });
    }
</script>
@endsection