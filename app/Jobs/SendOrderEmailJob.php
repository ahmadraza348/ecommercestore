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
    // Eager load items to prevent N+1 issues during PDF generation
    $order = Order::with('items')->find($this->orderId);

    if (!$order) {
        // If using a queue, the record might not be in the DB yet due to race conditions
        $this->release(5); 
        return;
    }

    Mail::to($order->billing_email)->send(new OrderConfirmationMail($order));
}
}

