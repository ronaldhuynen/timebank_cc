<?php

namespace App\Listeners;

use App\Jobs\SendReactionCreatedMail;
use App\Mail\ReactionCreatedMail;
use Cog\Laravel\Love\Reaction\Events\ReactionHasBeenAdded;
use Cog\Laravel\Love\Reaction\Models\Reaction;
use Cog\Laravel\Love\ReactionType\Models\ReactionType;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReactionCreatedListener
{
    public function handle(ReactionHasBeenAdded $event)
    {
        
        $reaction = $event->getReaction();
        
// ds($reaction->getReactant()->getReactable())->label('MAIL');


        // Dispatch the job to the queue
        SendReactionCreatedMail::dispatch($reaction);
    }
}
