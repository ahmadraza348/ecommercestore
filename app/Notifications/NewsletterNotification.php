<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewsletterNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $newsletter;

    public function __construct($newsletter)
    {
        $this->newsletter = $newsletter;
    }

public function via(object $notifiable): array
{
    return ['mail', 'database'];
}

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Newsletter Subscription')
            ->line('A new user subscribed to newsletter.')
            ->line('Email: ' . $this->newsletter->email);
    }
}
