@extends('frontend.layouts.layout')
@section('content')
<div class="cart-main-wrapper">
    <div class="container">
        <div class="row">
            @if ($cartData && $cartData->items->count() > 0)
            <div class="col-lg-12">
                <!-- Cart Table Area -->


                <form action="{{ route('cart.update') }}" method="post">
                    @csrf
                    <div class="cart-table table-responsive">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Id</th>
                                    <th class="pro-thumbnail">Image</th>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-price">Item Price</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <th class="pro-subtotal">Item Total</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($cartData && $cartData->items->count() > 0)
                                @foreach ($cartData->items as $item)
                                @php
                                $images = $item->product?->gallery_images;
                                $featuredImage =
                                $images
                                ?->where('color_id', $item->color_id)
                                ->where('is_featured', 1)
                                ->first() ??
                                $images?->where('color_id', $item->color_id)->first();
                                @endphp

                                <tr>
                                    <td class="">{{ $item->id }}</td>
                                    <td class="pro-thumbnail"><a
                                            href="{{ route('pro.details', $item->product->slug) }}"><img
                                                class="img-fluid"
                                                src="{{ $featuredImage ? asset('storage/' . $featuredImage->image) : asset('backend/assets/img/noimage.png') }}"
                                                alt="Product" /></a></td>
                                    <td class="pro-title"><a href="#">{{ $item->product_name }}
                                            <br />Color: {{ $item->proColor?->name ?? null }} <br />
                                            @if ($item->proAttribute)
                                            {{ $item->proAttribute?->attribute?->name ?? null }}:
                                            {{ $item->proAttribute?->name ?? null }}
                                            @endif
                                        </a></td>
                                    <td class="pro-price"><span>{{ $item->price }}</span></td>

                                    <td class="pro-quantity">
                                        <input type="hidden" name="ItemId[{{ $item->id }}]"
                                            value="{{ $item->id }}">
                                        <div class="pro-qty"><input type="text"
                                                name="quantity[{{ $item->id }}]"
                                                value="{{ $item->quantity }}"></div>
                                    </td>
                                    <td class="pro-subtotal"><span>{{ $item->line_total }}</span></td>
                                    <td class="pro-remove">
                                        <a href="{{ route('cart.remove', $item->id) }}"
                                            class="remove-item"
                                            data-route="{{ route('cart.remove', $item->id) }}">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>


                                    </td>
                                </tr>

                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="sqr-btn  mt-3">Update Cart</button>
                    </div>
                </form>

                <!-- Cart Update Option -->
                <div class="cart-update-option d-block d-md-flex justify-content-between">
                    <div class="apply-coupon-wrapper">
                        <form action="{{ route('coupon.apply') }}" method="post" class=" d-block d-md-flex">
                            @csrf
                            <input type="text" name="coupon_code" placeholder="Enter Your Coupon Code" required />
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
                                        <td>{{ $cartData->subtotal }} PKR</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td>250</td>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <td class="total-amount">{{ $cartData->total }} PKR</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <a href="checkout.html" class="sqr-btn d-block">Proceed To Checkout</a>
                    </div>
                </div>
            </div>

            @else
            <div class="col-lg-12">
                <div class="text-center py-5">
                    <h4>Your cart is empty</h4>
                    <p class="text-muted">Looks like you haven’t added anything yet.</p>
                    <a href="{{ route('home') }}" class="sqr-btn mt-3">Continue Shopping</a>
                </div>
            </div>
            @endif
    </div>
</div>

<script>
    document.addEventListener('click', function(e) {

        const btn = e.target.closest('.remove-item');
        if (!btn) return; // <- this is NOT optional

        e.preventDefault();

        if (!confirm('Remove this item from cart?')) return;

        const form = btn.closest('form');
        if (!form) {
            console.error('Form not found');
            return;
        }

        form.action = btn.getAttribute('data-route');
        form.submit();
    });
</script>

@endsection