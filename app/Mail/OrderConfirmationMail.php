<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public Order $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    } 

     public function build()
    {
        // Create invoice PDF from blade
        $pdf = Pdf::loadView('frontend.invoice', [
            'order' => $this->order
        ]);

        return $this->subject('Your Order Invoice')
            ->view('emails.order_confirmation')
            ->attachData(
                $pdf->output(),
                'invoice-' . $this->order->order_number . '.pdf'
            );
    }
}
