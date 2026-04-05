<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - Raza Mall</title>

    <link rel="shortcut icon" href="{{ asset('frontend/assets/img/favicon.ico') }}" type="image/x-icon" />
    
    <link href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/helper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/skin-default.css') }}" rel="stylesheet" id="galio-skin">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @include('frontend.layouts.custom_styles')
</head>

<body>
    <div class="wrapper">
        @include('frontend.layouts.header')

        @if(Route::currentRouteName() != 'home')
            @include('frontend.partials.breadcrumbs')
        @endif

        @yield('content')

        @include('frontend.layouts.footer')
    </div>

    @include('frontend.partials.quick_view')

    <div class="scroll-top not-visible"><i class="fa fa-angle-up"></i></div>

    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/bootstrap.min.js') }}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    <script defer src="https://unpkg.com/alpinejs@3.5.1"></script>

    @include('frontend.layouts.scripts') 
</body>
</html>