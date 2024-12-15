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
        /* Tree container with scroll bar */
.tree-container {
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #d8373e;
    max-height: 300px; /* Limit height to 300px */
    overflow-y: auto; /* Enable vertical scrollbar */
    overflow-x: hidden; /* Hide horizontal scroll */
}

/* Tree structure styling */
.tree {
    list-style: none;
    margin: 0;
    padding: 0;
    position: relative;
}

.tree li {
    /* margin: 10px 0; */
    padding-left: 10px;
    position: relative;
}

/* Vertical and horizontal lines */
.tree li::before {
    content: "";
    position: absolute;
    top: 0;
    left: -10px;
    border-left: 1px solid #d8373e;
    height: 100%;
    width: 1px;
}

.tree li::after {
    content: "";
    position: absolute;
    top: 15px;
    left: -10px;
    border-top: 1px solid #d8373e;
    width: 10px;
    height: 0;
}

/* Remove vertical line for last child */
.tree li:last-child::before {
    height: 15px;
}

/* Link styling */
.tree li a {
    text-decoration: none;
    color: #333;
    font-weight: normal;
    transition: all 0.3s ease;
}

.tree li a:hover {
    color: #e74c3c;
    font-weight: bold;
}

/* Bold top-level categories */
.category_li > a {
    font-weight: bold;
    color: #007bff;
}

/* Styling for deeper levels */
.tree li ul {
    padding-left: 15px;
}

.tree li ul li a {
    font-size: 13px;
    color: #444;
}

    </style>

</head>

<body>
   
    <div class="wrapper">
        <!-- header area start -->
        @include('frontend.layouts.header')
    
        <!-- header area end -->
        

    <!-- breadcrumb area start -->
    
    <div class="breadcrumb-area" style="display: {{ in_array(Route::currentRouteName(), ['home']) ? 'none' : 'block' }};">
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
                                            <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($segment) }}</li>
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
    <script defer src="https://unpkg.com/alpinejs@3.5.1" ></script>


    

</body>



</html>
