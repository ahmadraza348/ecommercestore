@extends('frontend.layouts.layout')
@section('content')
<div class="product-details-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="product-details-inner">
                    <div class="row">
                        <!-- Product Images Section -->
                        <div class="col-lg-6">
                            <div id="product-gallery">
                                @php
                                    $defaultColorId = $defaultColor['color_id'] ?? null;
                                    $defaultImages = $product->gallery_images->where('color_id', $defaultColorId);
                                    
                                    // Fallback to default images if no color-specific images
                                    if ($defaultImages->isEmpty()) {
                                        $defaultImages = $product->gallery_images->whereNull('color_id');
                                    }
                                @endphp

                                <div id="main-slider" class="product-large-slider mb-20 slick-arrow-style_2">
                                    @foreach ($defaultImages as $item)
                                        <div class="pro-large-img img-zoom">
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="Gallery Image" />
                                        </div>
                                    @endforeach
                                </div>

                                <div id="thumb-slider" class="pro-nav slick-padding2 slick-arrow-style_2 mt-2">
                                    @foreach ($defaultImages as $item)
                                        <div class="pro-nav-thumb">
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="Thumbnail Image" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="product-details-des mt-md-34 mt-sm-34">
                                <h3>{{ $product->name }}</h3>
                                <div class="d-flex justify-content-between" style="align-items:center;">
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

                                    <div class="availability">
                                        <span id="global-stock">{{ $product->stock }} in stock</span>
                                    </div>
                                </div>

                                {{-- Show Color Selector Only for Color-Based Variations --}}
                                @if(in_array($product->product_variation_type, ['color_varient', 'color_attribute_varient']) && $colors->isNotEmpty())
                                <div class="mt-3">
                                    <div id="selectedColorName" class="mt-1 fw-bold">
                                        Color: {{ $defaultColor['color']['name'] ?? 'Select Color' }}
                                    </div>

                                    <div id="color-list" class="d-flex gap-2 flex-wrap">
                                        @foreach ($colors as $c)
                                        @php
                                            $color = $c['color'];
                                            $colorCode = $color->colorcode ?? '#ccc';
                                            $isChecked = $loop->first ? 'checked' : '';
                                            $isSelected = $loop->first ? 'selected' : '';
                                        @endphp

                                        <label class="color-option {{ $isSelected }}" data-color-id="{{ $c['color_id'] }}" title="{{ $color->name }}">
                                            <input type="radio" name="product_color" class="d-none color-radio"
                                                value="{{ $c['color_id'] }}" {{ $isChecked }}>
                                            <div class="color-circle m-2" style="width:35px;height:35px;outline:1px solid grey;
                                                background: {{ $colorCode }}; display:flex; align-items:center;justify-content:center;
                                                border:2px solid transparent;">
                                            </div>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                {{-- Variants Area --}}
                                <div id="variants-area" class="mt-2">
                                    @if($product->product_variation_type === 'color_attribute_varient' && $product->attributes->isNotEmpty())
                                        <div id="selectedSizeName" class="fw-bold">
                                            {{ $product->attributes->first()->name }}:
                                        </div>
                                    @endif
                                    <div id="variants-list" class="mt-2" style="display:flex; gap:10px; flex-wrap:wrap;">
                                        @if(isset($variants) && $variants->isNotEmpty())
                                            @foreach($variants as $variant)
                                                <div class="variant-box {{ $loop->first ? 'active' : '' }}"
                                                     data-attribute-value-id="{{ $variant['attribute_value_id'] }}"
                                                     data-price="{{ $variant['price'] }}"
                                                     title="{{ $variant['name'] }}">
                                                    {{ $variant['name'] }}
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                {{-- Price Display --}}
                                <div class="pricebox my-3">
                                    @php
                                        $displayPrice = $product->sale_price;
                                        if(isset($defaultColor) && isset($defaultColor['default_price'])) {
                                            $displayPrice = $defaultColor['default_price'];
                                        } elseif(isset($variants) && $variants->isNotEmpty()) {
                                            $displayPrice = $variants->first()['price'];
                                        }
                                    @endphp
                                    <span class="regular-price" style="font-size:20px" id="display-price">
                                        Rs. {{ number_format($displayPrice, 2) }}
                                    </span>
                                </div>

                                {{-- Add to Cart / Quantity --}}
                                <div class="quantity-cart-box d-flex align-items-center mt-4">
                                    <div class="quantity me-3">
                                        <input id="qty" type="number" min="1" value="1" style="width:80px;padding:6px;">
                                    </div>
                                    <div class="action_link">
                                        <a id="add-to-cart" class="buy-btn" href="#">
                                            add to cart <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Product Tabs Section (unchanged) --}}
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
                                        {{-- Reviews content --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar (unchanged) --}}
            <div class="col-lg-3">
                <div class="shop-sidebar-wrap fix mt-md-22 mt-sm-22">
                    {{-- Sidebar content --}}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .color-option .color-circle {
        transition: 0.15s;
        cursor: pointer;
    }

    .color-option.selected .color-circle {
        border: 3px solid #000 !important;
        transform: scale(1.05);
    }

    .variant-box {
        padding: 8px 12px;
        border: 1px solid #ddd;
        cursor: pointer;
        border-radius: 5px;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .variant-box.active {
        border: 2px solid #000;
        background-color: #f8f9fa;
        transform: scale(1.02);
    }

    /* Hide variants area for simple products */
    .simple-product #variants-area {
        display: none !important;
    }
</style>

<script>
    $(function() {
        const productId = {{ $product->id }};
        const productVariationType = '{{ $product->product_variation_type }}';
        const colorVariantsUrl = "{{ route('product.colorVariants', $product) }}";
        const colorImagesUrl = "{{ route('product.colorImages', $product) }}";

        // Add variation type class to body for CSS targeting
        $('body').addClass(productVariationType + '-product');

        let currentColorId = $('input[name="product_color"]:checked').val();
        let currentVariantId = null;
        let currentDefault = null;

        function formatPrice(amount) {
            return 'Rs. ' + parseFloat(amount).toFixed(2);
        }

        // Initialize based on product type
        if (productVariationType === 'color_attribute_varient' && currentColorId) {
            loadVariants(currentColorId);
        }

        // Color click handler (only for color-based variations)
        if (productVariationType !== 'simple') {
            $(document).on('click', '.color-option', function(e){
                e.preventDefault();
                $('.color-option').removeClass('selected');
                $(this).addClass('selected');
                $(this).find('.color-radio').prop('checked', true);
                currentColorId = $(this).data('color-id');
                $('#selectedColorName').text('Color: ' + $(this).attr('title'));

                if (productVariationType === 'color_attribute_varient') {
                    loadVariants(currentColorId);
                }
                loadColorImages(currentColorId);
            });
        }

        // Variant click handler
        $(document).on('click', '.variant-box', function() {
            $('.variant-box').removeClass('active');
            $(this).addClass('active');
            currentVariantId = $(this).data('attribute-value-id') || null;
            let price = $(this).data('price');
            $('#display-price').text(formatPrice(price));
        });

        // AJAX: Load variants for a color
        function loadVariants(colorId) {
            $('#variants-list').empty();

            $.ajax({
                url: colorVariantsUrl,
                method: 'GET',
                data: { color_id: colorId },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(res) {
                    if (res.status !== 'success') {
                        $('#display-price').text(formatPrice({{ $product->sale_price }}));
                        return;
                    }

                    const data = res.data;
                    const variants = data.variants || [];
                    const def = data.default || null;
                    currentDefault = def;

                    if (variants.length > 0) {
                        $('#variants-list').show();
                        
                        variants.forEach(function(v, idx) {
                            const isActive = (def && def.type === 'variant' && def.variant_id == v.attribute_value_id) || idx === 0;
                            const box = $(`
                                <div class="variant-box ${isActive ? 'active' : ''}"
                                     data-attribute-value-id="${v.attribute_value_id}"
                                     data-price="${v.price}"
                                     title="${v.name}">
                                     ${v.name}
                                </div>
                            `);
                            $('#variants-list').append(box);
                            
                            if (isActive) {
                                currentVariantId = v.attribute_value_id;
                                $('#display-price').text(formatPrice(v.price));
                            }
                        });
                    } else if (def && def.type === 'color-only') {
                        // Color-only variation
                        $('#variants-list').hide();
                        $('#display-price').text(formatPrice(def.price));
                    } else {
                        // Fallback to product price
                        $('#variants-list').hide();
                        $('#display-price').text(formatPrice({{ $product->sale_price }}));
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    $('#display-price').text(formatPrice({{ $product->sale_price }}));
                }
            });
        }

        // Load images for selected color
        function loadColorImages(colorId) {
            $('#main-slider, #thumb-slider').html('<div class="text-center">Loading...</div>');

            $.ajax({
                url: colorImagesUrl,
                method: 'GET',
                data: { color_id: colorId },
                success: function(res) {
                    if (res.status === 'success' && res.data.length > 0) {
                        let mainHtml = '';
                        let thumbHtml = '';
                        
                        res.data.forEach(img => {
                            const src = "{{ asset('storage') }}/" + img.image;
                            mainHtml += `<div class="pro-large-img img-zoom"><img src="${src}" alt="Gallery Image" /></div>`;
                            thumbHtml += `<div class="pro-nav-thumb"><img src="${src}" alt="Thumbnail Image" /></div>`;
                        });

                        $('#main-slider').html(mainHtml);
                        $('#thumb-slider').html(thumbHtml);

                        // Reinitialize sliders if they exist
                        if ($.fn.slick && $('#main-slider').hasClass('slick-initialized')) {
                            $('#main-slider').slick('unslick');
                            $('#thumb-slider').slick('unslick');
                        }

                        if ($.fn.slick) {
                            $('#main-slider').slick({
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                arrows: true,
                                fade: true,
                                asNavFor: '#thumb-slider'
                            });
                            
                            $('#thumb-slider').slick({
                                slidesToShow: 4,
                                slidesToScroll: 1,
                                asNavFor: '#main-slider',
                                focusOnSelect: true,
                                arrows: true
                            });
                        }
                    } else {
                        $('#main-slider').html('<div class="text-center">No images available</div>');
                        $('#thumb-slider').html('');
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    $('#main-slider').html('<div class="text-center">Error loading images</div>');
                }
            });
        }

        // Add to cart handler
        $('#add-to-cart').on('click', function(e) {
            e.preventDefault();
            
            const quantity = $('#qty').val();
            let cartData = {
                product_id: productId,
                quantity: quantity,
                _token: '{{ csrf_token() }}'
            };

            // Add variation data based on product type
            if (productVariationType !== 'simple') {
                cartData.color_id = currentColorId;
            }

            if (productVariationType === 'color_attribute_varient' && currentVariantId) {
                cartData.attribute_value_id = currentVariantId;
            }

            // Add your cart AJAX call here
            console.log('Add to cart data:', cartData);
            // $.post('/cart/add', cartData, function(response) { ... });
        });
    });
</script>
@endsection