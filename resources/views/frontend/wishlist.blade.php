@extends('frontend.layouts.layout')
@section('content')
    <div class="wishlist-main-wrapper mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Image</th>
                                    <th class="pro-title">Product Name</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Stock Status</th>
                                    <th class="pro-subtotal">Add to Cart</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($products) && $products->count() > 0)
                                    @foreach ($products as $product)
                                        @php
                                            $featuredImage =
                                                $product->gallery_images->where('is_featured', 1)->first() ??
                                                $product->gallery_images->first();
                                        @endphp
                                        <tr id="wishlist-row-{{ $product->id }}">
                                            <td class="pro-thumbnail">
                                                <a href="{{ route('pro.details', $product->slug) }}">
                                                    <img class="img-fluid"
                                                        src="{{ $featuredImage ? asset('storage/' . $featuredImage->image) : asset('backend/assets/img/noimage.png') }}"
                                                        alt="Product" />
                                                </a>
                                            </td>
                                            <td class="pro-title">
                                                <a
                                                    href="{{ route('pro.details', $product->slug) }}">{{ $product->name }}</a>
                                            </td>
                                            <td class="pro-price">
                                                <span>{{ $product->sale_price }} PKR</span>
                                            </td>
                                            <td class="pro-quantity">
                                                <span class="text-success">In Stock</span>
                                            </td>
                                            <td class="pro-add-cart">
                                                <a href="{{ route('pro.details', $product->slug) }}" class="">
                                                    See Details
                                                </a>
                                            </td>
                                            <td class="pro-remove">
                                                <form action="{{ route('wishlist.remove', $product->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">Your wishlist is empty!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
