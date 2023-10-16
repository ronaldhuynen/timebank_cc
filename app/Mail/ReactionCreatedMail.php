<?php

namespace App\Mail;

use App\Models\Organization;
use App\Models\User;
use Cog\Laravel\Love\ReactionType\Models\ReactionType;
use function Psy\info;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ReactionCreatedMail extends Mailable //implements ShouldQueue  // ShouldQueue here creates the class as a background job
{
    use Queueable;
    use SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reaction)
    {
        $reactionType = ReactionType::fromName($reaction->getType()->name);
        $reactionCount = $reaction->getReactant()->getReactionCounterOfType($reactionType)->count;  // Get total count of only the current reaction type
        
        if ($reaction->getReacter()->getReacterable()::class === User::class) {
                $buttonUrl = route('user.show', ['userId' => $reaction->getReacter()->getReacterable()->id]);
            }        
        elseif ($reaction->getReacter()->getReacterable()::class === Organization::class) {
            $buttonUrl = route('org.show', ['orgId' => $reaction->getReacter()->getReacterable()->id]);
        }

        $locale = $reaction->getReactant()->getReactable()->lang_preference;    // Get preferred language of receiver

        return $this
            ->from('messages@timebank_2.cc', 'Timebank.cc Messenger')      // Optional: set alternative from data, other than the global one.
            ->subject( trans('messages.Your_profile_has_received_a_star', [], $locale))
            ->markdown('emails.reactions.'.$locale.'.new')
            ->with([
                'reactionType' => $reaction->getType(),
                'reactionCount' => $reactionCount,
                'from' => $reaction->getReacter()->getReacterable(),
                'to'=> $reaction->getReactant()->getReactable(),
                'buttonUrl' => $buttonUrl,
                ]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
    }
}
