<?php

namespace App\Listeners;

use App\Events\UserContact;
use App\Mail\UserContactMail;
use Illuminate\Support\Facades\Mail;


class UserContactEmail
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
        Mail::to($event->userContact->email)->send(new UserContactMail($event->userContact->name));     
    }
}
