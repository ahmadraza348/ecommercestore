<?php

namespace App\Services\Admin;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Newsletter;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Models\UserContact;
use Carbon\Carbon;
use App\Models\OrderItem;

class DashboardService
{
    public function getDashboardData()
    {
        return [
            // Orders
            'recentOrders' => Order::latest()->take(5)->get(),
            'totalOrders' => Order::count(),
            'totalSales' => Order::sum('total_amount'),
            'totalPending' => Order::where('payment_status', 'pending')->count(),
            'totalCompleted' => Order::where('order_status', 'completed')->count(),

            // Products
            'TotalProducts' => Product::count(),
            'recentProducts' => Product::latest()->take(5)->get(),

            // Categories / Brands
            'Totalcategories' => Category::count(),
            'totalBrands' => Brand::count(),

            // Users
            'totalUsers' => User::count(),
            'systemAdmins' => Admin::count(),

            // Engagement
            'totalReviews' => Review::count(),
            'totalContacts' => UserContact::count(),
            'totalNewsletters' => Newsletter::count(),

            'todayOrders' => Order::whereDate('created_at', Carbon::today())->count(),
            'todayRevenue' => Order::whereDate('created_at', Carbon::today())->sum('total_amount'),
            'lowStockProducts' => Product::where('stock', '<', 5)->count(),
            'activeCoupons' => Coupon::where('status', 1)->count(),
            'newUsersToday' => User::whereDate('created_at', Carbon::today())->count(),
            // Inside getDashboardData() return array:
'salesByLocation' => Order::selectRaw('billing_city as location, COUNT(*) as total_orders, SUM(total_amount) as total_revenue')
    ->groupBy('billing_city')
    ->orderByDesc('total_revenue')
    ->take(5)
    ->get(),

'topProducts' => OrderItem::with('product')
    ->selectRaw('product_id, SUM(quantity) as total_qty, SUM(line_total) as total_sales')
    ->groupBy('product_id')
    ->orderByDesc('total_qty')
    ->take(5)
    ->get(),
        ];
    }

}   
