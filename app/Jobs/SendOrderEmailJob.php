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

class SendOrderEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $order;

    // Accept the order data
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    // This is what the "Chef" does when he picks up the ticket
    public function handle()
    {
        // Send the email to the billing email address
        Mail::to($this->order->billing_email)->send(new OrderConfirmationMail($this->order));
    }
}
