@extends('frontend.layouts.layout')
@section('content')
    <div class="product-details-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">


                            <div class="col-lg-6">

                                <div class="product-large-slider mb-20 slick-arrow-style_2" id="main-slider">
                                    @foreach ($product->gallery_images as $item)
                                        <div class="pro-large-img img-zoom" data-color="{{ $item->color_id }}">
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="">
                                        </div>
                                    @endforeach
                                </div>

                                <div class="pro-nav slick-padding2 slick-arrow-style_2" id="thumb-slider">
                                    @foreach ($product->gallery_images as $item)
                                        <div class="pro-nav-thumb" data-color="{{ $item->color_id }}">
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="">
                                        </div>
                                    @endforeach
                                </div>

                            </div>


                            <div class="col-lg-6">
                                <form action="{{ route('addToCart') }}" method="post">
                                    @csrf

                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    @php
                                        $simplePro = $product->product_variation_type == 'simple';
                                    @endphp
                                    <input type="hidden" name="final_price" id="final_price"
                                        value="{{ $simplePro ? $product->sale_price : '' }}">

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
                                            <span id="stock-display">
                                                @php
                                                    $totalStock =
                                                        $product->product_variation_type == 'simple'
                                                            ? $product->stock
                                                            : $product->proAttributeValuesRecords->sum('stock');
                                                @endphp
                                                @if ($totalStock <= 0)
                                                    <span style="color:red;">Product has been sold out</span>
                                                @endif
                                            </span>


                                        </div>
                                        <div class="pricebox">
                                            <h5 id="price">Rs. {{ $product->sale_price }}</h5>
                                        </div>
                                        <br>

                                        @if ($product->proAttributeValuesRecords->isNotEmpty())
                                            @if ($totalStock > 0)
                                                <label><b>Select Color: <span id="selected-color-name"></span>
                                                    </b></label>
                                            @endif
                                            <div class="color-options">

                                                @foreach ($product->proAttributeValuesRecords->unique('color_id') as $item)
                                                    @php
                                                        $color = $item->color->color_code ?? '#000';
                                                        $colorId = $item->color->id;
                                                        $colorName = $item->color->name;
                                                        $variantSet = $variants[$colorId] ?? collect([]);
                                                        $colorPrice =
                                                            $variantSet->first()->price ?? $product->sale_price;
                                                        $stock = $variantSet->sum('stock');
                                                    @endphp
                                                    @if ($stock > 0)
                                                        <input type="radio" name="color" id="color_{{ $colorId }}"
                                                            value="{{ $colorId }}" data-name="{{ $colorName }}"
                                                            data-price="{{ $colorPrice }}"
                                                            data-stock="{{ $stock }}"
                                                            data-variants='@json($variantSet)'
                                                            {{ $loop->first ? 'checked' : '' }}>


                                                        <label for="color_{{ $colorId }}" class="color-box"
                                                            style="background-color: {{ $color }};">
                                                        </label>
                                                    @endif
                                                @endforeach

                                            </div>
                                        @endif

                                        <div id="variant-attribute"></div>
                                        <br>


                                        <div class="quantity-cart-box d-flex align-items-center">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="number" name="pro_qty" value="1" min="1"
                                                        max="{{ $stock ?? $product->stock }}">
                                                </div>
                                            </div>

                                            <div class="action_link">
                                                <button type="submit" {{ $totalStock <= 0 ? 'disabled' : '' }}
                                                    style="border:none;background:none;padding:0;">
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

                                        <div class="shop-sidebar-wrap fix mt-3">

                                            <!-- product tag start -->
                                            <div class="sidebar-widget ">

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

                                        <div class="share-icon mt-3">
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
                    @if($related_pro->isNotEmpty())
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
                            @foreach ($related_pro as $item)
                                @include('frontend.partials.pro_slide', ['item' => $item])                       
                            @endforeach
                            
                        </div>
                        <!-- featured category end -->
                    </div>
                    @endif
                    <!-- related products area end -->
                </div>

            </div>
        </div>
    </div>
    <style>
        .color-options input[type="radio"] {
            display: none;
        }

        .color-options .color-box {
            width: 35px;
            height: 35px;
            border-radius: 6px;
            border: 2px solid #ccc;
            display: inline-block;
            margin: 5px 8px 0 8px;
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

            initZoom();

            // SIMPLE PRODUCT → do nothing
            if ($('input[name="color"]').length === 0) {
                return;
            }

            // Select first color
            let firstColor = $('input[name="color"]').first();
            firstColor.prop('checked', true);
            $('#selected-color-name').text(firstColor.data('name'));

            updateUI(firstColor);
        });


        // COLOR CHANGE
        $('input[name="color"]').on('change', function() {
            $('#selected-color-name').text($(this).data('name'));
            updateUI($(this));
        });

        function updateUI(colorRadio) {

            const variants = colorRadio.data('variants');
            const colorPrice = colorRadio.data('price');
            const stock = colorRadio.data('stock');
            const colorId = colorRadio.val();

            // Update stock
            $('input[name="pro_qty"]').attr('max', stock);
            $('#stock-display').text(stock + ' in stock');

            // Disable button if needed
            if (stock <= 0) {
                $('.buy-btn').prop('disabled', true);
            } else {
                $('.buy-btn').prop('disabled', false);
            }

            // Update price
            $('#price').text('Rs. ' + colorPrice);

            // Move slider to that color image
            loadColorImages(colorId);

            // Load size/variant
            loadVariantValues(variants);
        }


        // 🔥 SIMPLE IMAGE SWITCH (NO REBUILD, NO FILTERING)
        function loadColorImages(colorId) {

            let index = -1;

            $('#main-slider .pro-large-img').each(function(i) {
                if ($(this).data('color') == colorId) {
                    index = i;
                    return false;
                }
            });

            if (index !== -1) {
                $('#main-slider').slick('slickGoTo', index);
                $('#thumb-slider').slick('slickGoTo', index);
            } else {
                console.warn('No image found for color:', colorId);
            }
        }


        // ZOOM
        function initZoom() {
            $(".img-zoom").each(function() {
                $(this).trigger('zoom.destroy');
            });

            $(".img-zoom").zoom({
                on: 'mouseover',
                magnify: 1.5
            });
        }


        // VARIANTS (SIZE ETC)
        function loadVariantValues(variants) {

            variants = variants || [];

            if (variants.length === 0) {
                $('#variant-attribute').html('');
                return;
            }

            let first = variants.find(v => v.stock > 0) || variants[0];

            let html = `
        <label><strong>Select ${first.attribute_value.attribute.name}: ${first.attribute_value.name}</strong></label>
        <div class="variant-options">
    `;

            variants.forEach(v => {
                if (v.stock > 0) {
                    html += `
                <input type="radio"
                    name="attribute_value_id"
                    id="variant_${v.id}"
                    value="${v.attribute_value_id}"
                    data-price="${v.price}"
                    data-stock="${v.stock}"
                    ${v.id == first.id ? 'checked' : ''}>
                <label for="variant_${v.id}">${v.attribute_value.name}</label>
            `;
                }
            });

            html += '</div>';
            $('#variant-attribute').html(html);

            // Variant change
            $('input[name="attribute_value_id"]').on('change', function() {

                const price = $(this).data('price');
                const stock = $(this).data('stock');
                const label = $(this).next().text();

                $('#price').text('Rs. ' + price);
                $('#stock-display').text(stock + ' in stock');

                $('input[name="pro_qty"]').attr('max', stock);

                if (stock <= 0) {
                    $('.buy-btn').prop('disabled', true);
                } else {
                    $('.buy-btn').prop('disabled', false);
                }

                $('#variant-attribute label strong').text(
                    `Select ${first.attribute_value.attribute.name}: ${label}`
                );
            });
        }
    </script>
@endsection
