@extends('frontend.layouts.layout')
@section('content')
<div class="product-details-wrapper">
    <div class="container">
        <div class="row">
            <!-- left: images -->
            <div class="col-lg-6">
                @if ($product->gallery_images->isNotEmpty())
                    <div class="product-large-slider mb-20 slick-arrow-style_2">
                        @foreach ($product->gallery_images as $item)
                            <div class="pro-large-img img-zoom">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Gallery Image" />
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- right: details -->
            <div class="col-lg-6">
                <div class="product-details-des">
                    <h3>{{ $product->name }}</h3>

                    <div class="availability mt-10">
                        <h5>Availability:</h5>
                        <span id="global-stock">{{ $product->stock }} in stock</span>
                    </div>

                    <p>{{ $product->short_description }}</p>

                    {{-- Price display --}}
                    <div class="pricebox mt-3">
                        <span class="regular-price" id="display-price">{{ number_format($product->sale_price, 2) }} PKR</span>
                    </div>

                    {{-- Color selector --}}
                    <div class="mt-3">
                        <h5>Select Color</h5>
                        <div id="color-list" class="d-flex gap-2 flex-wrap">
                            @foreach ($colors as $c)
                                @php
                                    $color = $c['color'];
                                    $colorCode = $color->colorcode ?? '#ccc';
                                @endphp

                                <label class="color-option" data-color-id="{{ $c['color_id'] }}" title="{{ $color->name }}">
                                    <input type="radio" name="product_color" class="d-none color-radio"
                                           value="{{ $c['color_id'] }}" {{ $loop->first ? 'checked' : '' }}>
                                    <div class="color-circle" style="width:35px;height:35px;border-radius:50%;
                                         background: {{ $colorCode }}; display:flex;align-items:center;justify-content:center;
                                         border:2px solid transparent;">
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        <div id="selectedColorName" class="mt-1 fw-bold">
                            Selected: {{ $defaultColor['color']->name ?? '—' }}
                        </div>
                    </div>

                    {{-- Variants area (populated by AJAX) --}}
                    <div id="variants-area" class="mt-3">
                        <!-- populated by JS -->
                        <h5 id="variants-title" style="display:none;">Variants</h5>
                        <div id="variants-list" style="display:flex; gap:10px; flex-wrap:wrap;"></div>
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
</div>

{{-- Styles --}}
<style>
    .color-option .color-circle { transition: 0.15s; cursor: pointer; }
    .color-option.selected .color-circle { border: 3px solid #000 !important; transform: scale(1.05); }
    .variant-box { padding:8px 12px; border:1px solid #ddd; cursor:pointer; border-radius:6px; font-size:13px; }
    .variant-box.active { border:2px solid #000; transform: scale(1.02); }
</style>

{{-- jQuery (include if not already loaded) --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(function() {
    const productId = {{ $product->id }};
    const productRoute = "{{ url('/product') }}";
    const colorVariantsUrl = "{{ route('product.colorVariants', $product) }}";
    let currentColorId = $('input[name="product_color"]:checked').val();
    let currentVariantId = null;
    let currentDefault = null;

    // Helper: format price
    function formatPrice(amount) {
        return parseFloat(amount).toFixed(2) + ' PKR';
    }

    // Initialize: load variants for default color
    loadVariants(currentColorId);

    // color click handler
    $(document).on('click', '.color-option', function(e){
        e.preventDefault();
        $('.color-option').removeClass('selected');
        $(this).addClass('selected');
        $(this).find('.color-radio').prop('checked', true);
        currentColorId = $(this).data('color-id');
        $('#selectedColorName').text('Selected: ' + $(this).attr('title'));
        loadVariants(currentColorId);
    });

    // variant click handler (delegated)
    $(document).on('click', '.variant-box', function(){
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
        $('#display-price').text('Loading...');

        $.ajax({
            url: colorVariantsUrl,
            method: 'GET',
            data: { color_id: colorId },
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            success: function(res) {
                if (res.status !== 'success') {
                    $('#display-price').text('{{ number_format($product->sale_price, 2) }} PKR');
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
                    variants.forEach(function(v, idx){
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
                $('#display-price').text(formatPrice({{ $product->sale_price }}));
            },
            error: function(xhr) {
                console.error(xhr);
                $('#display-price').text(formatPrice({{ $product->sale_price }}));
            }
        });
    }
});
</script>
@endsection



