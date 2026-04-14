<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\UserContactSubmitted;
use App\Listeners\LogContactSubmission;
use App\Listeners\NotifyAdminContact;
use App\Listeners\SendContactEmail;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserContactSubmitted::class => [
            LogContactSubmission::class,
            NotifyAdminContact::class,
            SendContactEmail::class,
        ],
    ];
    public function shouldDiscoverEvents()
{
    return false; 
}
}