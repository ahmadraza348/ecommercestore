<?php

namespace App\Listeners;

use App\Events\OrderSubmit;
use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SaleEmailCustomer implements ShouldQueue
{
    public function handle(OrderSubmit $event): void
    {
        $orderId = $event->orderId;
        Log::info("Received OrderSubmit event for Order ID: {$orderId}");
        $order = Order::with('items')->find($orderId);
        try {
            Mail::to($order->billing_email)->send(new OrderConfirmationMail($order));
            Log::info("Successfully sent Order Email to: {$order->billing_email} for Order #{$order->order_number}");
        } catch (Throwable $e) {
            Log::error("Failed to send email for Order ID: {$orderId}. Error: ".$e->getMessage());
            throw $e;
        }

    }
}
