<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SalesService;
use App\Models\Order;

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
        return view('backend.sales.index',compact('sales'));
    }
    public function details(Order $order)
    {
        return view('backend.sales.details',compact('order'));

    }
}
