<?php

namespace App\Listeners;

use App\Jobs\SendUserDeletedMail;

class UserDeletedListener
{
    public function handle(UserDeletedEvent $event)
    {
        
        $result = $event->getReaction();
        
        // Dispatch the job to the queue
        SendUserDeletedMail::dispatch($result);
    }
}
