<?php

namespace App\Listeners;

use App\Jobs\SendReactionCreatedMail;
use Cog\Laravel\Love\Reaction\Events\ReactionHasBeenAdded;

class ReactionCreatedListener
{
    public function handle(ReactionHasBeenAdded $event)
    {
        
        $reaction = $event->getReaction();
        
        // Dispatch the job to the queue
        SendReactionCreatedMail::dispatch($reaction);
    }
}
