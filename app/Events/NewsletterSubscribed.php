<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewsletterSubscribed implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $newsletter;

    public function __construct($newsletter)
    {
        $this->newsletter = $newsletter;
    }

    public function broadcastOn()
{
    return new Channel('newsletter');
}
public function broadcastWith(): array
{
    return [
        'email' => $this->newsletter->email,
    ];
}
}
