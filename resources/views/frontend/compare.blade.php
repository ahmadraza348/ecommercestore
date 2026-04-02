@extends('frontend.layouts.layout')
@section('content')
    <div class="compare-page-wrapper mt-50 mb-50">
        <div class="container">
            <div class="section-title text-center mb-30">
                <h2>Product Comparison</h2>
                <p class="text-muted">Compare features and prices of your favorite items (Max 3)</p>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if (isset($products) && $products->count() > 0)
                        <div class="compare-table table-responsive">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <td class="first-column">Actions</td>
                                        @foreach ($products as $product)
                                            <td class="pro-remove text-center" id="compare-col-{{ $product->id }}">
                                                <button class="btn btn-link text-danger remove-compare"
                                                    data-id="{{ $product->id }}">
                                                    <i class="fa fa-trash"></i> Remove
                                                </button>
                                            </td>
                                        @endforeach
                                    </tr>

                                    <tr>
                                        <td class="first-column">Product Image</td>
                                        @foreach ($products as $product)
                                            <td class="product-image-title text-center">
                                                <a href="{{ route('pro.details', $product->slug) }}" class="image">
                                                    <img class="img-fluid" style="max-width: 150px;"
                                                        src="{{ $product->gallery_images->where('is_featured', 1)->first() ? asset('storage/' . $product->gallery_images->where('is_featured', 1)->first()->image) : asset('backend/assets/img/noimage.png') }}"
                                                        alt="Compare Product">
                                                </a>
                                            </td>
                                        @endforeach
                                    </tr>

                                    <tr>
                                        <td class="first-column">Product Name</td>
                                        @foreach ($products as $product)
                                            <td class="text-center">
                                                <h6><a
                                                        href="{{ route('pro.details', $product->slug) }}">{{ $product->name }}</a>
                                                </h6>
                                            </td>
                                        @endforeach
                                    </tr>

                                    <tr>
                                        <td class="first-column">Price</td>
                                        @foreach ($products as $product)
                                            <td class="text-center">
                                                <span class="price"><strong>{{ $product->sale_price }} PKR</strong></span>
                                            </td>
                                        @endforeach
                                    </tr>

                                    <tr>
                                        <td class="first-column">Category</td>
                                        @foreach ($products as $product)
                                            <td class="text-center">{{ $product->category->name ?? 'N/A' }}</td>
                                        @endforeach
                                    </tr>

                                    <tr>
                                        <td class="first-column">Availability</td>
                                        @foreach ($products as $product)
                                            <td class="text-center">
                                                <span class="text-success">In Stock</span>
                                            </td>
                                        @endforeach
                                    </tr>

                                    <tr>
                                        <td class="first-column">Buy Now</td>
                                        @foreach ($products as $product)
                                            <td class="text-center">
                                                <a href="javascript:void(0);" class="sqr-btn add-to-cart-btn"
                                                    data-id="{{ $product->id }}">
                                                    Add to Cart
                                                </a>
                                            </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state text-center py-5">
                            <i class="fa fa-refresh fa-3x mb-3 text-muted"></i>
                            <h3>No products to compare</h3>
                            <a href="{{ url('/') }}" class="sqr-btn mt-3">Continue Shopping</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .first-column {
            width: 200px;
            font-weight: 700;
            background-color: #f9f9f9;
            text-transform: uppercase;
            font-size: 13px;
            vertical-align: middle !important;
        }

        .compare-table table td {
            vertical-align: middle;
            min-width: 250px;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.remove-compare').on('click', function() {
                let id = $(this).data('id');
                if (confirm('Remove this product from comparison?')) {
                    $.post("{{ route('compare.remove') }}", {
                        _token: "{{ csrf_token() }}",
                        product_id: id
                    }, function(res) {
                        if (res.status === 'success') {
                            location.reload(); // Reload to refresh the comparison grid
                        }
                    });
                }
            });
        });
    </script>
@endsection
