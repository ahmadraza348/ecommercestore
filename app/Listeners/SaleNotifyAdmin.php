<?php

namespace App\Listeners;

use App\Events\OrderSubmit;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\AdminNotificationEvent;
use App\Models\Order;

class SaleNotifyAdmin implements ShouldQueue
{

    public function handle(OrderSubmit $event): void
    {

        $orderId = $event->orderId;
        $order = Order::with('items')->find($orderId);


        event(new AdminNotificationEvent([
            'type' => 'order',
            'title' => $order->billing_first_name,            
          
        ]));
    }
}
