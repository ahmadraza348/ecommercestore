<?php

namespace App\Jobs;

use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use App\Mail\OrderPlacedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendOrderEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $orderId) {}

    public function handle()
    {
        $order = Order::findOrFail($this->orderId);

        // Safety Check: If order is still null for some reason, don't crash.
        if (!$order) {
            Log::error('Order not found in SendOrderEmailJob');
            return;
        }

        Mail::to($order->billing_email)
            ->send(new OrderConfirmationMail($order));
    }
}

