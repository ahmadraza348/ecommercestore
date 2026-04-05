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
                                    <div class="product-details-des mt-md-34 mt-sm-34">
                                        <h3><a href="product-details.html">{{ $product->name }}</a></h3>
                                        @include('frontend.partials.review_star', ['product' => $product])
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
                                            <a href="javascript:void(0);" class="add-to-compare"
                                                data-id="{{ $product->id }}" data-toggle="tooltip" data-placement="top"
                                                title="Compare">
                                                <i class="fa fa-refresh"></i> compare
                                            </a>
                                            <a href="javascript:void(0);" class="add-to-wishlist"
                                                data-id="{{ $product->id }}" data-toggle="tooltip" data-placement="top"
                                                title="Wishlist">
                                                <i class="fa fa-heart-o"></i> wishlist
                                            </a>
                                        </div>

                                        @if ($product->tags > 0)
                                            <div class="shop-sidebar-wrap fix mt-3">

                                                <!-- product tag start -->
                                                <div class="sidebar-widget ">
                                                    <div class="sidebar-widget-body">
                                                        <div class="product-tag">
                                                            @foreach (explode(',', $product->tags) as $tag)
                                                                <a href="{{ url('search?query=' . trim($tag)) }}">
                                                                    {{ trim($tag) }}
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- product tag end -->
                                            </div>
                                        @endif

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
                                            <form action="{{ route('review.store', $product->id) }}" method="POST"
                                                class="review-form">
                                                @csrf
                                                <h5>{{ $product->reviews->count() }} review(s) for {{ $product->name }}
                                                </h5>

                                                @foreach ($product->reviews as $item)
                                                    <div class="total-reviews">
                                                        <div class="review-box">
                                                            <div class="ratings">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <span
                                                                        class="{{ $i <= $item->rating ? 'good' : '' }}"><i
                                                                            class="fa fa-star"></i></span>
                                                                @endfor
                                                            </div>
                                                            <div class="post-author">
                                                                <p><span>{{ $item->user_name }} -</span>
                                                                    {{ $item->created_at->format('d M, Y') }}</p>
                                                            </div>
                                                            <p>{{ $item->comment }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label>Your Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label>Your Email</label>
                                                        <input type="email" name="email" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label>Your Review</label>
                                                        <textarea name="review" class="form-control" required></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label>Rating</label>
                                                        &nbsp; Bad
                                                        <input type="radio" value="1" name="rating">
                                                        <input type="radio" value="2" name="rating">
                                                        <input type="radio" value="3" name="rating">
                                                        <input type="radio" value="4" name="rating">
                                                        <input type="radio" value="5" name="rating" checked>
                                                        Good
                                                    </div>
                                                </div>

                                                <div class="buttons">
                                                    <button class="sqr-btn" type="submit">Continue</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details reviews end -->

                    <!-- related products area start -->
                    @if ($related_pro->isNotEmpty())
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
(function($) {
    "use strict";

    $(document).ready(function() {
        // 1. Initialize Zoom
        initZoom();

        // 2. Handle Simple Products
        // If no color variations exist, we stop here to avoid script errors
        if ($('input[name="color"]').length === 0) {
            return;
        }

        // 3. Initial UI Setup
        // Select first available color on page load
        let firstColor = $('input[name="color"]:checked').length ? 
                         $('input[name="color"]:checked') : 
                         $('input[name="color"]').first();
        
        firstColor.prop('checked', true);
        $('#selected-color-name').text(firstColor.data('name'));
        updateUI(firstColor);

        // 4. Color Change Event
        $(document).on('change', 'input[name="color"]', function() {
            let $this = $(this);
            $('#selected-color-name').text($this.data('name'));
            updateUI($this);
        });

        // 5. Main UI Update Function
        function updateUI(colorRadio) {
            const variants = colorRadio.data('variants');
            const colorPrice = colorRadio.data('price');
            const stock = colorRadio.data('stock');
            const colorId = colorRadio.val();

            // Update Stock Display & Input Constraints
            const qtyInput = $('input[name="pro_qty"]');
            qtyInput.attr('max', stock);
            if (parseInt(qtyInput.val()) > stock) qtyInput.val(stock);
            
            $('#stock-display').html(stock > 0 ? 
                `<span class="text-success">${stock} in stock</span>` : 
                `<span class="text-danger">Product has been sold out</span>`
            );

            // Toggle Buy Button State
            $('.buy-btn').css('pointer-events', stock <= 0 ? 'none' : 'auto')
                         .css('opacity', stock <= 0 ? '0.5' : '1');
            $('button[type="submit"]').prop('disabled', stock <= 0);

            // Update Price
            $('#price').text('Rs. ' + colorPrice);

            // Sync Slider to Selected Color
            syncSliderToColor(colorId);

            // Re-load Size/Attribute Variants
            loadVariantValues(variants);
        }

        // 6. Slider Synchronization
        function syncSliderToColor(colorId) {
            let targetIndex = -1;

            $('#main-slider .pro-large-img').each(function(i) {
                if ($(this).data('color') == colorId) {
                    targetIndex = i;
                    return false; // break loop
                }
            });

            if (targetIndex !== -1) {
                // We use both to ensure full sync across thumbnails
                $('#main-slider').slick('slickGoTo', targetIndex);
                $('#thumb-slider').slick('slickGoTo', targetIndex);
            }
        }

        // 7. Dynamic Variant Loader (Size/Attributes)
        function loadVariantValues(variants) {
            variants = variants || [];
            const container = $('#variant-attribute');

            if (variants.length === 0) {
                container.empty();
                return;
            }

            let firstValid = variants.find(v => v.stock > 0) || variants[0];
            let attrName = firstValid.attribute_value?.attribute?.name || 'Attribute';

            let html = `
                <label><strong>Select ${attrName}: <span id="current-variant-name">${firstValid.attribute_value.name}</span></strong></label>
                <div class="variant-options">
            `;

            variants.forEach(v => {
                if (v.stock > 0) {
                    html += `
                        <input type="radio" name="attribute_value_id" id="variant_${v.id}" 
                               value="${v.attribute_value_id}" data-price="${v.price}" 
                               data-stock="${v.stock}" data-name="${v.attribute_value.name}"
                               ${v.id == firstValid.id ? 'checked' : ''}>
                        <label for="variant_${v.id}">${v.attribute_value.name}</label>
                    `;
                }
            });

            html += '</div>';
            container.html(html);

            // Bind Variant Change Event
            $('input[name="attribute_value_id"]').on('change', function() {
                const vPrice = $(this).data('price');
                const vStock = $(this).data('stock');
                const vName = $(this).data('name');

                $('#price').text('Rs. ' + vPrice);
                $('#current-variant-name').text(vName);
                $('#stock-display').text(vStock + ' in stock');
                
                $('input[name="pro_qty"]').attr('max', vStock);
            });
        }

        // 8. Zoom Functionality
        function initZoom() {
            if ($.fn.zoom) {
                $(".img-zoom").each(function() {
                    $(this).trigger('zoom.destroy');
                    $(this).zoom({ on: 'mouseover', magnify: 1.5 });
                });
            }
        }
    });

})(jQuery);
</script>
@endsection
