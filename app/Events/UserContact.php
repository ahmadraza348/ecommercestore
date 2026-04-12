<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserContact implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $userContact;
    public function __construct($userContact)
    {
        $this->userContact = $userContact;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {        
        return new Channel('user-contact');
    
    }

    // Data sending ot the channel
    public function broadcastWith() :array
    {
        return [
            'name' => $this->userContact->name,
            'email' => $this->userContact->email,
            'message' => $this->userContact->message,
            'subject' => $this->userContact->subject,
        ];

    }
}
