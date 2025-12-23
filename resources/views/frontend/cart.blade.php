@extends('frontend.layouts.layout')
@section('content')
<div class="cart-main-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Cart Table Area -->
                <form action="{{ route('cart.update') }}" method="post">
                    @csrf
                <div class="cart-table table-responsive">
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="pro-thumbnail">Thumbnail</th>
                                <th class="pro-title">Product</th>
                                <th class="pro-price">Price</th>
                                <th class="pro-price">Color</th>
                                @foreach ($cartData->first()->items as $item)
                                @if( $item->proAttribute)
                                <th class="pro-price">{{ $item->proAttribute?->attribute?->name ?? Null }}</th>
                                @endif
                                @endforeach
                                <th class="pro-quantity">Quantity</th>
                                <th class="pro-subtotal">Total</th>
                                <th class="pro-remove">Remove</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($cartData && $cartData->items->count() > 0)
                            @foreach ($cartData->items as $item)

                            @php
                            $images = $item->product?->gallery_images;
                            $featuredImage = $images
                            ?->where('color_id', $item->color_id)
                            ->where('is_featured', 1)
                            ->first()
                            ?? $images
                            ?->where('color_id', $item->color_id)
                            ->first();
                            @endphp

                            <tr>
                                <td class="pro-thumbnail"><a href="{{route('pro.details', $item->product->slug)}}"><img class="img-fluid" src="{{ $featuredImage
                                                            ? asset('storage/' . $featuredImage->image)
                                                            : asset('backend/assets/img/noimage.png')
                                                        }}"
                                            alt="Product" /></a></td>
                                <td class="pro-title"><a href="#">{{ $item->product_name }}</a></td>
                                <td class="pro-price"><span>{{ $item->price }}</span></td>
                                <td class="pro-price"><span>{{ $item->proColor?->name ?? Null }}</span></td>
                                @if( $item->proAttribute)
                                <td class="pro-price"><span>{{ $item->proAttribute?->name ?? Null }}</span></td>
                                @endif


                                <td class="pro-quantity">
                                    <input type="hidden" name="item_id[{{ $item->id }}]" value="{{ $item->id }}">
                                    <div class="pro-qty"><input type="text" name="quantity[{{ $item->id }}]" value="{{ $item->quantity }}"></div>
                                </td>
                                <td class="pro-subtotal"><span>{{ $item->line_total }}</span></td>
                                <td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                            </tr>


                            @endforeach
                            @endif
                        </tbody>   
                    </table>
                </div>
                <button type="submit" class="sqr-btn  ">Update Cart</button>
                                    </form>

                <!-- Cart Update Option -->
                <div class="cart-update-option d-block d-md-flex justify-content-between">
                    <div class="apply-coupon-wrapper">
                        <form action="#" method="post" class=" d-block d-md-flex">
                            <input type="text" placeholder="Enter Your Coupon Code" required />
                            <button class="sqr-btn">Apply Coupon</button>
                        </form>
                    </div>
                   
                </div>
             
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5 ml-auto">
                <!-- Cart Calculation Area -->
                <div class="cart-calculator-wrapper">
                    <div class="cart-calculate-items">
                        <h3>Cart Totals</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Sub Total</td>
                                    <td>$230</td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td>$70</td>
                                </tr>
                                <tr class="total">
                                    <td>Total</td>
                                    <td class="total-amount">$300</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <a href="checkout.html" class="sqr-btn d-block">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection