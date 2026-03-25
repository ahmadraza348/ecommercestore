@extends('frontend.layouts.layout')
@section('content')

    <div class="page-main-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 order-1 order-lg-2">

                    {{-- Breadcrumb or Search Title --}}
                    <div class="section-title mb-20">
                        <div class="title-icon">
                            <i class="fa fa-search"></i>
                        </div>
                        {{-- Check if we are searching or just viewing all products --}}
                        <h3>
                            @if (request('query'))
                                Search Results for: "{{ request('query') }}"
                            @else
                                All Products
                            @endif
                        </h3>
                    </div>

                    <div class="shop-product-wrapper pt-34">


                        <div class="shop-product-wrap grid row">
                            <div class="col-lg-12">
                                <div id="loader" style="display: none; text-align: center;">
                                    <img src="{{ asset('frontend/assets/loader.gif') }}"
                                        style="position:absolute; z-index:999" alt="Loading..." />
                                </div>

                                <div id="product-list" class="row">
                                    @isset($products)
                                        @foreach ($products as $item)
                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                @include('frontend.partials.pro_slide', ['item' => $item])
                                            </div>                                      
                                        @endforeach
                                    @else
                                        <div class="col-12 text-center">
                                            <h5>No Product Found matching "{{ request('query') }}"</h5>
                                        </div>
                                    @endisset
                                </div>
                            </div>

                            {{-- Pagination Area --}}
                            @isset($products)
                                <div class="paginatoin-area text-center pt-28">
                                    <div class="row">
                                        <div class="col-12">
                                            {{-- CRITICAL: Use appends() so the search term stays in the URL when you click page 2 --}}
                                            {{ $products->appends(['query' => request('query')])->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
