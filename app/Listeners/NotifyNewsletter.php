<?php

namespace App\Listeners;

use App\Events\NewsletterSubmit;
use App\Events\AdminNotificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyNewsletter implements ShouldQueue
{

    public function handle(NewsletterSubmit $event): void
    {
        event(new AdminNotificationEvent([
            'type' => 'newsletter',
            'title' => $event->newsletter->email,
        ]));
    }
}
