<div class="product-item fix mb-30">
    <div class="product-thumb">
        <a href="{{ route('pro.details', ['slug' => $item->slug]) }}">
            <img src="{{ $item->featured_image ? asset('storage/' . $item->featured_image) : asset('backend/assets/img/noimage.png') }}"
                class="img-pri" alt="">
            <img src="{{ $item->back_image ? asset('storage/' . $item->back_image) : asset('backend/assets/img/noimage.png') }}"
                class="img-sec" alt="">
        </a>
        <div class="product-label">
            <span>{{ $item->label }}</span>
        </div>
        <div class="product-action-link">
            {{-- <a href="#" data-toggle="modal"
                data-target="#quick_view">
                <span data-toggle="tooltip" data-placement="left"
                    title="Quick view"><i
                        class="fa fa-search"></i></span> </a> --}}

                        <a href="#" class="quick-view-btn" data-id="{{ $item->id }}" data-toggle="modal" data-target="#quick_view">
                            <span data-toggle="tooltip" data-placement="left" title="Quick view">
                                <i class="fa fa-search"></i>
                            </span>
                        </a>

                        
            <a href="#" data-toggle="tooltip"
                data-placement="left" title="Wishlist"><i
                    class="fa fa-heart-o"></i></a>
            <a href="#" data-toggle="tooltip"
                data-placement="left" title="Compare"><i
                    class="fa fa-refresh"></i></a>
            <a href="#" data-toggle="tooltip"
                data-placement="left" title="Add to cart"><i
                    class="fa fa-shopping-cart"></i></a>
        </div>
    </div>
    <div class="product-content">
        <h4><a
                href="{{ route('pro.details', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
        </h4>
        <div class="pricebox">
            <span class="regular-price">{{ $item->sale_price }}
                PKR</span>
            <div class="ratings">
                <span class="good"><i
                        class="fa fa-star"></i></span>
                <span class="good"><i
                        class="fa fa-star"></i></span>
                <span class="good"><i
                        class="fa fa-star"></i></span>
                <span class="good"><i
                        class="fa fa-star"></i></span>
                <span><i class="fa fa-star"></i></span>
                <div class="pro-review">
                    <span>1 review(s)</span>
                </div>
            </div>
        </div>
    </div>
</div>