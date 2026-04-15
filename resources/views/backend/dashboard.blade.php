@extends('backend.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget">
                        <div class="dash-widgetcontent">
                            <h5>{{ $dashboardData['totalOrders'] }}</h5>
                            <h6>Total Orders</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash1">
                        <div class="dash-widgetcontent">
                            <h5>{{ $dashboardData['totalSales'] }}</h5>
                            <h6>Total Sales</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash2">
                        <div class="dash-widgetcontent">
                            <h5>{{ $dashboardData['totalPending'] }}</h5>
                            <h6>Pending Orders</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash3">
                        <div class="dash-widgetcontent">
                            <h5>{{ $dashboardData['totalCompleted'] }}</h5>
                            <h6>Completed Orders</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count">
                        <div class="dash-counts">
                            <h4>{{ $dashboardData['totalUsers'] }}</h4>
                            <h5>Users</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count">
                        <div class="dash-counts">
                            <h4>{{ $dashboardData['totalBrands'] }}</h4>
                            <h5>Brands</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count">
                        <div class="dash-counts">
                            <h4>{{ $dashboardData['totalReviews'] }}</h4>
                            <h5>Reviews</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count">
                        <div class="dash-counts">
                            <h4>{{ $dashboardData['totalContacts'] }}</h4>
                            <h5>Contact Messages</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">

    {{-- Today Orders --}}
    <div class="col-lg-2 col-sm-6 col-12">
        <div class="dash-count bg-primary text-white">
            <div class="dash-counts">
                <h4>{{ $dashboardData['todayOrders'] }}</h4>
                <h5>Today Orders</h5>
            </div>
        </div>
    </div>

    {{-- Revenue Today --}}
    <div class="col-lg-2 col-sm-6 col-12">
        <div class="dash-count bg-success text-white">
            <div class="dash-counts">
                <h4>{{ $dashboardData['todayRevenue'] }}</h4>
                <h5>Today's Revenue</h5>
            </div>
        </div>
    </div>

    {{-- Low Stock --}}
    <div class="col-lg-2 col-sm-6 col-12">
        <div class="dash-count bg-danger text-white">
            <div class="dash-counts">
                <h4>{{ $dashboardData['lowStockProducts'] }}</h4>
                <h5>Low Stock</h5>
            </div>
        </div>
    </div>

    {{-- Coupons --}}
    <div class="col-lg-2 col-sm-6 col-12">
        <div class="dash-count bg-warning text-dark">
            <div class="dash-counts">
                <h4>{{ $dashboardData['activeCoupons'] }}</h4>
                <h5>Active Coupons</h5>
            </div>
        </div>
    </div>

    {{-- New Users --}}
    <div class="col-lg-2 col-sm-6 col-12">
        <div class="dash-count bg-info text-white">
            <div class="dash-counts">
                <h4>{{ $dashboardData['newUsersToday'] }}</h4>
                <h5>New Users</h5>
            </div>
        </div>
    </div>


</div>

            <div class="row">
                <div class="col-lg-7 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Purchase & Sales</h5>
                            <div class="graph-sets">
                                <ul>
                                    <li>
                                        <span>Sales</span>
                                    </li>
                                    <li>
                                        <span>Purchase</span>
                                    </li>
                                </ul>
                                <div class="dropdown">
                                    <button class="btn btn-white btn-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        2022 <img src="{{ asset('backend/assets/img/icons/dropdown.svg') }}" alt="img"
                                            class="ms-2">
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">2022</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">2021</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">2020</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="sales_charts"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Recently Added Products</h4>
                            <div class="dropdown">
                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"
                                    class="dropset">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a href="productlist.html" class="dropdown-item">Product List</a>
                                    </li>
                                    <li>
                                        <a href="addproduct.html" class="dropdown-item">Product Add</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive dataview">
                                <table class="table datatable ">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Products</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td class="productimgname">
                                                <a href="productlist.html" class="product-img">
                                                    <img src="{{ asset('backend/assets/img/product/product22.jpg') }}"
                                                        alt="product">
                                                </a>
                                                <a href="productlist.html">Apple Earpods</a>
                                            </td>
                                            <td>$891.2</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-body">
                    <h4 class="card-title">Expired Products</h4>
                    <div class="table-responsive dataview">
                        <table class="table datatable ">
                            <thead>
                                <tr>
                                    <th>SNo</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Brand Name</th>
                                    <th>Category Name</th>
                                    <th>Expiry Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>4</td>
                                    <td><a href="javascript:void(0);">IT0004</a></td>
                                    <td class="productimgname">
                                        <a class="product-img" href="productlist.html">
                                            <img src="{{ asset('backend/assets/img/product/product5.jpg') }}"
                                                alt="product">
                                        </a>
                                        <a href="productlist.html">Avocat</a>
                                    </td>
                                    <td>N/D</td>
                                    <td>Fruits</td>
                                    <td>20-11-2022</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
