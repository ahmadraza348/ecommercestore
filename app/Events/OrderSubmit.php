<?php

namespace App\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderSubmit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orderId;
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

}
