@extends('frontend.layouts.layout')
@section('content')
<div class="checkout-page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Checkout Login Coupon Accordion Start -->
                <div class="checkoutaccordion" id="checkOutAccordion">
                    <div class="card">
                        <h3>Returning Customer? <span data-toggle="collapse" data-target="#logInaccordion">Click Here To Login</span></h3>

                        <div id="logInaccordion" class="collapse" data-parent="#checkOutAccordion">
                            <div class="card-body">
                                <p class="my-3">If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing &amp; Shipping section.</p>
                                                    @include('auth.login_partial')

                            </div>
                        </div>
                    </div>

                </div>
                <!-- Checkout Login Coupon Accordion End -->
            </div>
        </div>
           @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
        <form action="{{ route('order.place') }}" method="POST" id="checkoutForm">
            @csrf
            <div class="row">

             


                <!-- Checkout Billing Details -->

                <div class="col-lg-6">

                    <div class="checkout-billing-details-wrap">
                        <h2>Billing Details</h2>
                        <div class="billing-form-wrap">
                            <form action="#">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="single-input-item mb-3">
                                            <label for="billing_first_name" class="required">First Name</label>
                                            <input type="text" id="billing_first_name" name="billing[first_name]"
                                                value="{{ old('billing.first_name', Auth::check() ? $user->first_name : '') }}"
                                                placeholder="First Name" required />
                                            @error('billing.first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="single-input-item mb-3">
                                            <label for="billing_last_name" class="required">Last Name</label>
                                            <input type="text" id="billing_last_name" name="billing[last_name]"
                                                value="{{ old('billing.last_name', Auth::check() ? $user->last_name : '') }}"
                                                placeholder="Last Name" required />
                                            @error('billing.last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="single-input-item mb-3">
                                    <label for="billing_email" class="required">Email Address</label>
                                    <input type="email" id="billing_email" name="billing[email]"
                                        value="{{ old('billing.email', Auth::check() ? $user->email : '') }}"
                                        placeholder="Email Address" required />
                                    @error('billing.email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="single-input-item mb-3">
                                    <label for="billing_company">Company Name</label>
                                    <input type="text" id="billing_company" name="billing[company]"
                                        value="{{ old('billing.company') }}"
                                        placeholder="Company Name" />
                                </div>

                                <div class="single-input-item mb-3">
                                    <label for="billing_country" class="required">Country</label>
                                    <select name="billing[country]" id="billing_country" class="form-select" required>
                                        <option value="">Select Country</option>
                                        <option value="Afghanistan" {{ old('billing.country') == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                                        <option value="Bangladesh" {{ old('billing.country') == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                        <option value="India" {{ old('billing.country') == 'India' ? 'selected' : '' }}>India</option>
                                        <option value="Pakistan" {{ old('billing.country') == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                        <option value="England" {{ old('billing.country') == 'England' ? 'selected' : '' }}>England</option>
                                    </select>
                                    @error('billing.country')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="single-input-item mb-3">
                                    <label for="billing_address_1" class="required pt-20">Street address</label>
                                    <input type="text" id="billing_address_1" name="billing[address_1]"
                                        value="{{ old('billing.address_1') }}"
                                        placeholder="Street address Line 1" required />
                                    @error('billing.address_1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="single-input-item mb-3">
                                    <input type="text" name="billing[address_2]"
                                        value="{{ old('billing.address_2') }}"
                                        placeholder="Street address Line 2 (Optional)" />
                                </div>


                                <div class="single-input-item mb-3">
                                    <label for="billing_city" class="required">Town / City</label>
                                    <input type="text" id="billing_city" name="billing[city]"
                                        value="{{ old('billing.city') }}"
                                        placeholder="Town / City" required />
                                    @error('billing.city')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="single-input-item mb-3">
                                    <label for="billing_state">State / Division</label>
                                    <input type="text" id="billing_state" name="billing[state]"
                                        value="{{ old('billing.state') }}"
                                        placeholder="State / Division" />
                                </div>
                                <div class="single-input-item mb-3">
                                    <label for="billing_postcode" class="required">Postcode / ZIP</label>
                                    <input type="text" id="billing_postcode" name="billing[postcode]"
                                        value="{{ old('billing.postcode') }}"
                                        placeholder="Postcode / ZIP" required />
                                    @error('billing.postcode')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="single-input-item mb-3">
                                    <label for="billing_phone">Phone</label>
                                    <input type="text" id="billing_phone" name="billing[phone]"
                                        value="{{ old('billing.phone', Auth::check() ? $user->phone : '') }}"
                                        placeholder="Phone" />
                                </div>

                                <div class="checkout-box-wrap mb-4">
                                    <div class="single-input-item">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="ship_to_different" name="different_shipping" value="1">
                                            <label class="form-check-label" for="ship_to_different">Ship to a different address?</label>
                                        </div>
                                    </div>
                                    <div class="ship-to-different single-form-row">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="single-input-item mb-3">
                                                    <label for="shipping_first_name" class="required">First Name</label>
                                                    <input type="text" id="shipping_first_name" name="shipping[first_name]"
                                                        value="{{ old('shipping.first_name') }}"
                                                        placeholder="First Name" />
                                                    @error('shipping.first_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-input-item mb-3">
                                                    <label for="shipping_last_name" class="required">Last Name</label>
                                                    <input type="text" id="shipping_last_name" name="shipping[last_name]"
                                                        value="{{ old('shipping.last_name') }}"
                                                        placeholder="Last Name" />
                                                    @error('shipping.last_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="single-input-item mb-3">
                                            <label for="shipping_email" class="required">Email Address</label>
                                            <input type="email" id="shipping_email" name="shipping[email]"
                                                value="{{ old('shipping.email') }}"
                                                placeholder="Email Address" />
                                            @error('shipping.email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="single-input-item mb-3">
                                            <label for="shipping_company">Company Name</label>
                                            <input type="text" id="shipping_company" name="shipping[company]"
                                                value="{{ old('shipping.company') }}"
                                                placeholder="Company Name" />
                                        </div>

                                        <div class="single-input-item mb-3">
                                            <label for="shipping_country" class="required">Country</label>
                                            <select name="shipping[country]" id="shipping_country" class="form-select">
                                                <option value="">Select Country</option>
                                                <option value="Bangladesh" {{ old('shipping.country') == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                                <option value="India" {{ old('shipping.country') == 'India' ? 'selected' : '' }}>India</option>
                                                <option value="Pakistan" {{ old('shipping.country') == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                                <option value="England" {{ old('shipping.country') == 'England' ? 'selected' : '' }}>England</option>
                                            </select>
                                            @error('shipping.country')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="single-input-item mb-3">
                                            <label for="shipping_address_1" class="required pt-20">Street address</label>
                                            <input type="text" id="shipping_address_1" name="shipping[address_1]"
                                                value="{{ old('shipping.address_1') }}"
                                                placeholder="Street address Line 1" />
                                            @error('shipping.address_1')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="single-input-item mb-3">
                                            <input type="text" name="shipping[address_2]"
                                                value="{{ old('shipping.address_2') }}"
                                                placeholder="Street address Line 2 (Optional)" />
                                        </div>

                                        <div class="single-input-item mb-3">
                                            <label for="shipping_city" class="required">Town / City</label>
                                            <input type="text" id="shipping_city" name="shipping[city]"
                                                value="{{ old('shipping.city') }}"
                                                placeholder="Town / City" />
                                            @error('shipping.city')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="single-input-item mb-3">
                                            <label for="shipping_state">State / Division</label>
                                            <input type="text" id="shipping_state" name="shipping[state]"
                                                value="{{ old('shipping.state') }}"
                                                placeholder="State / Division" />
                                        </div>

                                        <div class="single-input-item mb-3">
                                            <label for="shipping_postcode" class="required">Postcode / ZIP</label>
                                            <input type="text" id="shipping_postcode" name="shipping[postcode]"
                                                value="{{ old('shipping.postcode') }}"
                                                placeholder="Postcode / ZIP" />
                                            @error('shipping.postcode')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="single-input-item mb-4">
                                    <label for="order_note">Order Note</label>
                                    <textarea name="order_note" id="order_note" cols="30" rows="3"
                                        placeholder="Notes about your order, e.g. special notes for delivery.">{{ old('order_note') }}</textarea>
                                </div>
                        </div>
                    </div>

                </div>

                <!-- Order Summary Deta ils -->
                <div class="col-lg-6">
                    <div class="order-summary-details mt-md-26 mt-sm-26">
                        <h2>Your Order Summary</h2>
                        <div class="order-summary-content mb-sm-4">
                            <!-- Order Summary Table -->
                            <div class="order-summary-table table-responsive text-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Products</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($cartData && $cartData->items->count() > 0)
                                        @foreach ($cartData->items as $item)
                                        <tr>
                                            <td><a href="{{ route('pro.details', $item->product->slug) }}">{{ $item->product_name }} <br />Color: {{ $item->proColor?->name ?? null }} <br />
                                                    @if ($item->proAttribute)
                                                    {{ $item->proAttribute?->attribute?->name ?? null }}:
                                                    {{ $item->proAttribute?->name ?? null }}
                                                    @endif<strong> <br>
                                                        quantity : {{ $item->quantity }}</strong></a></td>
                                            <td>{{ $item->price }} PKR</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>


                                    @php
                                    $subtotal = $cartData->items->sum('line_total');
                                    $shipping = 250;

                                    $discount = session('coupon_discount', 0);

                                    $total = max(0, ($subtotal + $shipping) - $discount);
                                    @endphp

                                    <tfoot>
                                        <tr>
                                            <td>Sub Total</td>
                                            <td><strong>{{ number_format($subtotal, 2) }} PKR</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Discount</td>
                                            <td><strong>- {{ number_format($discount, 2) }} PKR</strong></td>

                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td><strong>{{ number_format($shipping, 2) }} PKR</strong></td>

                                        </tr>
                                        <tr>
                                            <td>Total Amount</td>
                                            <td><strong>{{ number_format($total, 2) }} PKR</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- Order Payment Method -->
                            <div class="order-payment-method">
                                <div class="single-payment-method show">
                                    <div class="payment-method-name">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="cashon" name="payment_method" value="cash" class="custom-control-input" checked />
                                            <label class="custom-control-label" for="cashon">Cash On Delivery</label>
                                        </div>
                                    </div>
                                    <div class="payment-method-details" data-method="cash">
                                        <p>Pay with cash upon delivery.</p>
                                    </div>
                                </div>

                                <div class="single-payment-method">
                                    <div class="payment-method-name">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="cardPayment" name="payment_method" value="stripe" class="custom-control-input" />
                                            <label class="custom-control-label" for="cardPayment">Card Payment <img src="{{ asset('frontend/assets/img/paypal-card.jpg') }}" class="img-fluid paypal-card" alt="Paypal" /></label>
                                        </div>
                                    </div>
                                    <div class="payment-method-details" data-method="stripe">
                                        <p>Card Payment</p>
                                    </div>
                                </div>
                                <div class="summary-footer-area">
                                    <button type="submit" class="check-btn sqr-btn">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection