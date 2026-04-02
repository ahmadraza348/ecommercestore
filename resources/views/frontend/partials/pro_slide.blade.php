<div class="product-item fix mb-30">
    <div class="product-thumb">
        @php
            $featured_image = $item->gallery_images->where('is_featured', 1)->first()?->image;
            $back_image = $item->gallery_images->where('is_back', 1)->first()?->image;
        @endphp

        <a href="{{ route('pro.details', ['slug' => $item->slug]) }}">
            <img src="{{ $featured_image ? asset('storage/' . $featured_image) : asset('backend/assets/img/noimage.png') }}"
                class="img-pri" alt="Product Image">
            <img src="{{ $back_image ? asset('storage/' . $back_image) : asset('backend/assets/img/noimage.png') }}"
                class="img-sec" alt="Product Back Image">
        </a>

        <div class="product-label">
            <span>{{ $item->label }}</span>
        </div>
        
        <div class="product-action-link">
            <a href="#" class="quick-view-btn" data-id="{{ $item->id }}" data-toggle="modal" data-target="#quick_view">
                <span data-toggle="tooltip" data-placement="left" title="Quick view">
                    <i class="fa fa-search"></i>
                </span>
            </a>

            <a href="javascript:void(0);" class="add-to-wishlist" data-id="{{ $item->id }}" data-toggle="tooltip" data-placement="left" title="Wishlist">
                <i class="fa fa-heart-o"></i>
            </a>

            <a href="javascript:void(0);" class="add-to-compare" data-id="{{ $item->id }}" data-toggle="tooltip" data-placement="left" title="Compare">
                <i class="fa fa-refresh"></i>
            </a>

            @if ($item->product_variation_type == 'simple')
                <a href="javascript:void(0);" class="add-to-cart-btn" data-id="{{ $item->id }}" data-toggle="tooltip" title="Add to cart">
                    <i class="fa fa-shopping-cart"></i>
                </a>
            @else
                <a href="{{ route('pro.details', ['slug' => $item->slug]) }}" data-toggle="tooltip" title="Select Options">
                    <i class="fa fa-external-link"></i>
                </a>
            @endif
        </div>
    </div>
    <div class="product-content">
        <h4><a href="{{ route('pro.details', ['slug' => $item->slug]) }}">{{ $item->name }}</a></h4>
        <div class="pricebox">
            <span class="regular-price">{{ $item->sale_price }} PKR</span>
            @include('frontend.partials.review_star', ['product' => $item])
        </div>
    </div>
</div>