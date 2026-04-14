<?php

namespace App\Events;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewsletterSubmit
{
    use Dispatchable, SerializesModels;

    public $newsletter;
    public function __construct($newsletter)
     {
        $this->newsletter = $newsletter;
     }
  
   
}
