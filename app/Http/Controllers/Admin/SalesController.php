<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SalesService;
use App\Models\Order;
use Illuminate\Http\Request;

use function Flasher\Toastr\Prime\toastr;

class SalesController extends Controller
{
    protected $service;
    public function __construct(SalesService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        $sales = $this->service->getsales();
        return view('backend.sales.index', compact('sales'));
    }
    public function details(Order $order)
    {
        return view('backend.sales.details', compact('order'));
    }
   public function updateOrderStatus(Order $order, Request $request)
{
    // 1. If the order is already cancelled in the database, block ALL changes
    if ($order->order_status === 'cancelled') {
        toastr()->error('This order is already cancelled. Status cannot be changed.');
        return redirect()->back();
    }

    // 2. If the user is trying to change the status TO cancelled
    if ($request->order_status === 'cancelled') {
        // This triggers the restocking logic in your Service
        $this->service->cancelOrder($order);
    }

    // 3. Update the status and comment for non-cancelled orders
    $this->service->updateOrderStatus($order);
    toastr()->success('Order status updated successfully');
    return redirect()->back();
}
}
