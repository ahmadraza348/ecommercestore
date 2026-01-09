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
    public $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        // 1. Generate the PDF Invoice
        $pdf = Pdf::loadView('frontend.order_invoice', ['order' => $this->order]);

        // 2. Build the email and attach the PDF
        return $this->subject('Order Confirmation #' . $this->order->id)
            ->view('emails.order_confirmation') // Your HTML email body
            ->attachData($pdf->output(), 'invoice_' . $this->order->id . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
