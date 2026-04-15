@extends('backend.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            {{-- Top Stats Cards --}}
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget">
                        <div class="dash-widgetcontent">
                            <h5>{{ number_format($dashboardData['totalOrders']) }}</h5>
                            <h6>Total Orders</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash1">
                        <div class="dash-widgetcontent">
                            <h5>PKR {{ number_format($dashboardData['totalSales'], 2) }}</h5>
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
            </div>
                 <div class="row mt-3">
                {{-- Quick Stats Row --}}
                <div class="col-lg-2 col-sm-6 col-12">
                    <div class="dash-count bg-primary text-white">
                        <div class="dash-counts">
                            <h4>{{ $dashboardData['todayOrders'] }}</h4>
                            <h5>Today Orders</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-6 col-12">
                    <div class="dash-count bg-success text-white">
                        <div class="dash-counts">
                            <h4>PKR {{ number_format($dashboardData['todayRevenue'], 2) }}</h4>
                            <h5>Today's Revenue</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-6 col-12">
                    <div class="dash-count bg-danger text-white">
                        <div class="dash-counts">
                            <h4>{{ $dashboardData['lowStockProducts'] }}</h4>
                            <h5>Low Stock</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-6 col-12">
                    <div class="dash-count bg-warning text-dark">
                        <div class="dash-counts">
                            <h4>{{ $dashboardData['activeCoupons'] }}</h4>
                            <h5>Active Coupons</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-6 col-12">
                    <div class="dash-count bg-info text-white">
                        <div class="dash-counts">
                            <h4>{{ $dashboardData['newUsersToday'] }}</h4>
                            <h5>New Users</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-6 col-12">
                    <div class="dash-count bg-dark text-white">
                        <div class="dash-counts">
                            <h4>{{ $dashboardData['totalContacts'] }}</h4>
                            <h5>Contacts</h5>
                        </div>
                    </div>
                </div>
            </div>

            {{-- New Row for Visual Charts --}}
            <div class="row">
                <div class="col-lg-7 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Sales Analytics</h5>
                        </div>
                        <div class="card-body">
                            <div id="sales_revenue_chart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Order Status Overview</h5>
                        </div>
                        <div class="card-body">
                            <div id="order_status_chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
    <div class="col-lg-7 col-sm-12 col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Sales by City (Top 5)</h5>
            </div>
            <div class="card-body">
                <div id="location_chart"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-5 col-sm-12 col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Location Breakdown</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>City</th>
                                <th>Orders</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dashboardData['salesByLocation'] as $loc)
                                <tr>
                                    <td><strong>{{ $loc->location ?? 'Unknown' }}</strong></td>
                                    <td>{{ $loc->total_orders }}</td>
                                    <td>PKR {{ number_format($loc->total_revenue, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

       

            <div class="row mt-4">
                {{-- Top Products Table --}}
                <div class="col-lg-5 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Top Selling Products</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive dataview">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($dashboardData['topProducts'] as $item)
                                            <tr>
                                                <td>{{ $item->product->name ?? 'N/A' }}</td>
                                                <td>{{ $item->total_qty }}</td>
                                                <td>PKR {{ number_format($item->total_sales, 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="3" class="text-center">No data</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Recent Orders Table --}}
                <div class="col-lg-7 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Recent Orders</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dashboardData['recentOrders'] as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->billing_first_name }}</td>
                                                <td>PKR {{ number_format($order->total_amount, 2) }}</td>
                                                <td>
                                                    <span class="badge {{ $order->order_status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                                                        {{ ucfirst($order->order_status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script Section for Charts --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            // 1. SALES ANALYTICS CHART (Area)
            var salesOptions = {
                series: [{
                    name: 'Revenue',
                    data: [31, 40, 28, 51, 42, {{ $dashboardData['todayRevenue'] }}, 100] // Replace with real monthly data later
                }],
                chart: { height: 350, type: 'area', toolbar: { show: false } },
                colors: ["#28C76F"],
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth' },
                xaxis: { categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"] },
            };
            new ApexCharts(document.querySelector("#sales_revenue_chart"), salesOptions).render();

            // 2. ORDER STATUS CHART (Pie)
            var statusOptions = {
                series: [{{ $dashboardData['totalCompleted'] }}, {{ $dashboardData['totalPending'] }}],
                chart: { type: 'donut', height: 300 },
                labels: ['Completed', 'Pending'],
                colors: ['#28C76F', '#FF9F43'],
                legend: { position: 'bottom' },
                responsive: [{
                    breakpoint: 480,
                    options: { chart: { width: 200 } }
                }]
            };
            new ApexCharts(document.querySelector("#order_status_chart"), statusOptions).render();
        });


        // 3. LOCATION BAR CHART
        var locationOptions = {
            series: [{
                name: 'Revenue',
                data: @json($dashboardData['salesByLocation']->pluck('total_revenue'))
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                }
            },
            dataLabels: { enabled: false },
            colors: ['#7367F0'],
            xaxis: {
                categories: @json($dashboardData['salesByLocation']->pluck('location')),
            }
        };
        new ApexCharts(document.querySelector("#location_chart"), locationOptions).render();

    </script>
@endsection