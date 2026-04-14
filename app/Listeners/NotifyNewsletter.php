<?php

namespace App\Listeners;

use App\Events\NewsletterSubmit;
use App\Events\AdminNotificationEvent;

class NotifyNewsletter 
{

    public function handle(NewsletterSubmit $event): void
    {
        event(new AdminNotificationEvent([
            'type' => 'newsletter',
            'title' => $event->newsletter->email,
            'message' => 'subscribed to newsletter',
        ]));
    }
}
