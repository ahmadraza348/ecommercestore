<?php

namespace App\Mail;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order)
    {
        // Ensure items are loaded so the PDF doesn't show an empty list
        $this->order->load('items');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation #' . ($this->order->order_number ?? $this->order->id),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order_confirmation',
        );
    }

    public function attachments(): array
    {
        // Generate PDF
        $pdf = Pdf::loadView('frontend.order_invoice', ['order' => $this->order]);

        return [
            Attachment::fromData(fn () => $pdf->output(), 'invoice_' . $this->order->id . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}