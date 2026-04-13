<?php

namespace App\Listeners;

use App\Events\UserContact;
use App\Models\Admin;
use App\Notifications\CustomerContactNotification;
use Illuminate\Support\Facades\Notification;

class NotifyAdmin
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
    public function handle(UserContact $event): void
    {
        $admin = Admin::where('status', 1)->get();        
        Notification::send($admin, new CustomerContactNotification($event->userContact));
        
    }
}
