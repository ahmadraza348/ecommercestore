@extends('frontend.layouts.layout')
@section('content')
<div class="product-details-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="product-details-inner">
                    <div class="row">
                        <div class="col-lg-6">
                            @if ($product->gallery_images->isNotEmpty())
                            <div class="product-large-slider mb-20 slick-arrow-style_2">
                                @foreach ($product->gallery_images as $item)
                                <div class="pro-large-img img-zoom">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Gallery Image" />
                                </div>
                                @endforeach
                            </div>

                            <div class="pro-nav slick-padding2 slick-arrow-style_2">
                                @foreach ($product->gallery_images as $item)
                                <div class="pro-nav-thumb">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Thumbnail Image" />
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details-des mt-md-34 mt-sm-34">
                                <h3>{{ $product->name }}</h3>
                          <div class="d-flex justify-content-between"style="align-item:center; ">
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
            
                                <div class="availability ">
                                    <span id="global-stock">{{ $product->stock }} in stock</span>
                                </div>
                          </div>


                                {{-- Color selector --}}
                                <div class="mt-3">
                                      <div id="selectedColorName" class="mt-1 fw-bold">
                                        Select Color: {{ $defaultColor['color']->name ?? '—' }}
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

                                {{-- Variants area (populated by AJAX) --}}
                                <div id="variants-area" class="mt-2">
                                    <!-- <h5 id="variants-title" style="display:none;">Variants</h5> -->
                                       <div id="selectedSizeName" class="fw-bold">
                                        Select 
                                    </div>
                                    <div id="variants-list"class="mt-2" style="display:flex; gap:10px; flex-wrap:wrap; "></div>
                                </div>

                                

                                {{-- Price display --}}
                                <div class="pricebox my-3">
                                    <span class="regular-price"style="font-size:20px" id="display-price">Rs. {{ number_format($product->sale_price, 2) }}</span>
                                </div>

                                {{-- Add to cart / quantity --}}
                                <div class="quantity-cart-box d-flex align-items-center mt-4">
                                    <div class="quantity me-3"><input id="qty" type="number" min="1" value="1" style="width:80px;padding:6px;"></div>
                                    <div class="action_link">
                                        <a id="add-to-cart" class="buy-btn" href="#">add to cart <i class="fa fa-shopping-cart"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

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
                                            <h5>1 review for {{ $product->name }}</h5>
                                            <div class="total-reviews">
                                                <div class="rev-avatar">
                                                    <img src="assets/img/about/avatar.jpg" alt="">
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
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="shop-sidebar-wrap fix mt-md-22 mt-sm-22">
                    <div class="sidebar-widget mb-22">
                        <div class="section-title-2 d-flex justify-content-between mb-28">
                            <h3>featured</h3>
                            <div class="category-append"></div>
                        </div>
                        <div class="category-carousel-active row" data-row="4">
                            <div class="col">
                                <div class="category-item">
                                    <div class="category-thumb">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-img1.jpg" alt="">
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
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <div class="sidebar-widget mb-22">
                        <div class="img-container fix img-full mt-30">
                            <a href="#"><img src="assets/img/banner/banner_shop.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


{{-- Styles --}}
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
        padding: 5px;
        border: 1px solid #ddd;
        cursor: pointer;
        border-radius: 5px;
        font-size: 12px;
    }

    .variant-box.active {
        border: 2px solid #000;
        transform: scale(1.02);
    }
</style>

{{-- jQuery (include if not already loaded) --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}

<script>
    $(function() {
        // **FIXED: Blade variable wrapped in quotes**
        const productId = '{{ $product->id }}';
        const productRoute = "{{ url('/product') }}";
        const colorVariantsUrl = "{{ route('product.colorVariants', $product) }}";
        // Ensure the default color has the 'selected' class on load
        $('.color-option:first').addClass('selected');

        let currentColorId = $('input[name="product_color"]:checked').val();
        let currentVariantId = null;
        let currentDefault = null;

        // Helper: format price
        function formatPrice(amount) {
            // Use Number() to ensure it's treated as a number
            return 'Rs. ' + Number(amount).toFixed(2);
        }

        // Initialize: load variants for default color
        loadVariants(currentColorId);

        // color click handler
        $(document).on('click', '.color-option', function(e) {
            e.preventDefault();
            $('.color-option').removeClass('selected');
            $(this).addClass('selected');
            $(this).find('.color-radio').prop('checked', true);
            currentColorId = $(this).data('color-id');
            $('#selectedColorName').text('Selected: ' + $(this).attr('title'));
            loadVariants(currentColorId);
        });

        // variant click handler (delegated)
        $(document).on('click', '.variant-box', function() {
            $('.variant-box').removeClass('active');
            $(this).addClass('active');
            currentVariantId = $(this).data('attribute-value-id') || null;
            let price = $(this).data('price');
            $('#display-price').text(formatPrice(price));
        });

        // AJAX: load variants for a color
        function loadVariants(colorId) {
            $('#variants-list').empty();
            $('#variants-title').hide();
            // show a quick loader
            $('#display-price').text(`Rs. {{$product->sale_price}}.00`);

            $.ajax({
                url: colorVariantsUrl,
                method: 'GET',
                data: {
                    color_id: colorId
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(res) {
                    if (res.status !== 'success') {
                        // **FIXED: Blade variable wrapped in quotes**
                        $('#display-price').text(formatPrice('{{ $product->sale_price }}'));
                        return;
                    }

                    const data = res.data;
                    const variants = data.variants || [];
                    const def = data.default || null;
                    currentDefault = def;

                    if ((!variants || variants.length === 0) && def && def.type === 'color-only') {
                        // Only color-only row exists: show price and no variant selectors
                        $('#variants-list').hide();
                        $('#variants-title').hide();
                        $('#display-price').text(formatPrice(def.price));
                        return;
                    }

                    if (variants && variants.length > 0) {
                        $('#variants-list').show();
                        $('#variants-title').show();
                        $('#variants-list').empty();

                        // render variant boxes
                        variants.forEach(function(v, idx) {
                            // pick active = first or if matches default
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
                        return;
                    }

                    // fallback: no variants, no color-only row -> product price
                    $('#variants-list').hide();
                    $('#variants-title').hide();
                    // **FIXED: Blade variable wrapped in quotes**
                    $('#display-price').text(formatPrice('{{ $product->sale_price }}'));
                },
                error: function(xhr) {
                    console.error(xhr);
                    // **FIXED: Blade variable wrapped in quotes**
                    $('#display-price').text(formatPrice('{{ $product->sale_price }}'));
                }
            });
        }
    });
</script>
@endsection