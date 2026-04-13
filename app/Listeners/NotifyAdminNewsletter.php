<?php

namespace App\Listeners;

use App\Events\NewsletterSubscribed;
use App\Models\Admin;
use App\Notifications\NewsletterNotification;
use Illuminate\Support\Facades\Notification;

class NotifyAdminNewsletter
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
  
public function handle(NewsletterSubscribed $event): void
{
    $admins = Admin::where('status', 1)->get();
    Notification::send($admins, new NewsletterNotification($event->newsletter));
}
}
