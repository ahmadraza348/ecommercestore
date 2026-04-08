<?php
namespace App\Services\Admin;
use App\Models\Order;

class DashboardService
{
    public function getDashboardData()
    {
        return [
            'recentOrders' => Order::latest()->take(5)->get(),
            'totalOrders' => Order::count(),
            'totalSales' => Order::sum('total_amount'),
            'totalPending' => Order::where('payment_status', 'pending')->sum('total_amount'),
            'totalCompleted' => Order::where('order_status', 'completed')->count(),
        ];
    }
}