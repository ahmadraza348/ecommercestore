<?php

namespace App\Listeners;

use App\Events\UserContactSubmitted;
use App\Events\AdminNotificationEvent;

class NotifyAdminContact 
{

    public function handle(UserContactSubmitted  $event): void
    {
        event(new AdminNotificationEvent([
            'type' => 'contact',
            'title' => $event->userContact->name,
            'subject' => $event->userContact->subject,
        ]));
    }
}
