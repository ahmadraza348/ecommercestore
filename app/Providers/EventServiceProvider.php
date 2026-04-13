<?php

namespace App\Providers;

use App\Events\NewsletterSubscribed;
use App\Events\UserContact;
use App\Listeners\NotifyAdmin;
use App\Listeners\NotifyAdminNewsletter;
use App\Listeners\UserContactEmail;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserContact::class => [
            UserContactEmail::class,
            NotifyAdmin::class,
        ],

        NewsletterSubscribed::class => [
            NotifyAdminNewsletter::class,
        ],
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {}
}
