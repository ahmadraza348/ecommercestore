<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">

    <!-- Site title -->
    <title>Home - Raza Mall</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/img/favicon.ico') }}" type="image/x-icon" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font-Awesome CSS -->
    <link href="{{ asset('frontend/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- helper class css -->
    <link href="{{ asset('frontend/assets/css/helper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/plugins.css') }}" rel="stylesheet">
    <!-- Plugins CSS -->
    <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">
    <!-- Main Style CSS -->
    <link href="{{ asset('frontend/assets/css/skin-default.css') }}" rel="stylesheet" id="galio-skin">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .page-item.active .page-link {
  z-index: 1;
  color: #fff;
  background-color: #d8373e;
  border-color: #d8373e;
}

    </style>

</head>

<body>

    <div class="wrapper">
        <!-- header area start -->
        @include('frontend.layouts.header')

        <!-- header area end -->


        <!-- breadcrumb area start -->

        <div class="breadcrumb-area"
            style="display: {{ in_array(Route::currentRouteName(), ['home']) ? 'none' : 'block' }};">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    @if (Route::currentRouteName() != 'home')
                                        <!-- Dynamic Breadcrumb Items -->
                                        @php
                                            $segments = Request::segments();
                                        @endphp
                                        @foreach ($segments as $index => $segment)
                                            @php
                                                $url = '';
                                                for ($i = 0; $i <= $index; $i++) {
                                                    $url .= '/' . $segments[$i];
                                                }
                                            @endphp
                                            @if ($index < count($segments) - 1)
                                                <li class="breadcrumb-item">
                                                    <a href="{{ url($url) }}">{{ ucfirst($segment) }}</a>
                                                </li>
                                            @else
                                                <li class="breadcrumb-item active" aria-current="page">
                                                    {{ ucfirst($segment) }}</li>
                                            @endif
                                        @endforeach
                                    @else
                                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- breadcrumb area end -->


        @yield('content')
        <!-- footer area start -->
        @include('frontend.layouts.footer')
        <!-- footer area end -->
    </div>


    <!-- Quick view modal start -->
    @include('frontend.partials.quick_view')
    <!-- Quick view modal end -->

    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- Scroll to Top End -->



    <!--All jQuery, Third Party Plugins & Activation (main.js) Files-->
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <!-- Jquery Min Js -->
    <script src="{{ asset('frontend/assets/js/plugins.js') }}"></script>
    <!-- Popper Min Js -->
    <script src="{{ asset('frontend/assets/js/vendor/popper.min.js') }}"></script>
    <!-- Bootstrap Min Js -->
    <script src="{{ asset('frontend/assets/js/vendor/bootstrap.min.js') }}"></script>
    <!-- Plugins Js-->
    <!-- Ajax Mail Js -->
    <script src="{{ asset('frontend/assets/js/ajax-mail.js') }}"></script>
    <!-- Active Js -->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    <!-- Switcher JS [Please Remove this when Choose your Final Projct] -->
    <script src="{{ asset('frontend/assets/js/switcher.js') }}"></script>
    <script defer src="https://unpkg.com/alpinejs@3.5.1"></script>

</body>

<script>
    $(document).ready(function () {
        function fetchFilteredProducts(page = 1) {
            let selectedBrands = [];
            let selectedAttributes = [];
            let currentSlug = $('input[name="current_slug"]').val();

            $('.filter-brand:checked').each(function () {
                selectedBrands.push($(this).val());
            });

            $('.filter-attribute:checked').each(function () {
                selectedAttributes.push($(this).val());
            });

            let minPrice = $('#min_price').val();
            let maxPrice = $('#max_price').val();
            let sortBy = $('#sortby').val();

            $.ajax({
                url: "{{ route('shop.filter') }}?page=" + page,
                method: "POST",
                data: {
                    brand_ids: selectedBrands,
                    attribute_values: selectedAttributes,
                    current_slug: currentSlug,
                    min_price: minPrice,
                    max_price: maxPrice,
                    sortby: sortBy,
                    _token: "{{ csrf_token() }}"
                },
                beforeSend: function () {
                    $('#loader').show();
                },
                success: function (response) {
                    $('#product-list').html(response.html);
                    $('.paginatoin-area').html(response.pagination);
                },
                complete: function () {
                    $('#loader').hide();
                },
                error: function () {
                    alert("Something went wrong! Please try again.");
                }
            });
        }

        $('.filter-brand, .filter-attribute, #sortby').on('change', function () {
            fetchFilteredProducts();
        });

        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetchFilteredProducts(page);
        });
        $('.price-range').on('slidechange', function (event, ui) {
        $('#min_price').val(ui.values[0]); // Update min price
        $('#max_price').val(ui.values[1]); // Update max price
        fetchFilteredProducts(); // Fetch products
    });
    });
</script>


</html>
