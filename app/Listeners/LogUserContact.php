<?php

namespace App\Listeners;

use App\Events\UserContact;
use Illuminate\Support\Facades\Log;


class LogUserContact
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
       Log::info('Contact message logged for: ' . $event->userContact->email);

    }
}
