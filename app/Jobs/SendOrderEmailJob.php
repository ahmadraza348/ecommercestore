<?php
namespace App\Jobs;

use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendOrderEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Number of times the job may be attempted
    public $tries = 3;

    public function __construct(public int $orderId) {}

    public function handle()
    {
        Log::info("Processing Order Email Job for Order ID: {$this->orderId}");

        $order = Order::with('items')->find($this->orderId);

        if (!$order) {
            Log::warning("Order ID: {$this->orderId} not found in DB. Releasing back to queue.");
            $this->release(5);
            return;
        }

        try {
            Mail::to($order->billing_email)->send(new OrderConfirmationMail($order));
            Log::info("Successfully sent Order Email to: {$order->billing_email} for Order #{$order->order_number}");
        } catch (Throwable $e) {
            Log::error("Failed to send email for Order ID: {$this->orderId}. Error: " . $e->getMessage());            
            throw $e;
        }
    }

    public function failed(Throwable $exception): void
    {
        Log::critical("SendOrderEmailJob permanently failed for Order ID: {$this->orderId}. Exception: {$exception->getMessage()}");
    }
}