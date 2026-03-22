<?php
namespace App\Services\Admin;

use App\Models\Order;

class SalesService
{
    public function getsales(){
        $data = Order::with('items')->get();
        return $data;
    }
}