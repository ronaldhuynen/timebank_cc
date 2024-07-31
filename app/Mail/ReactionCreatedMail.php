<?php

namespace App\Mail;

use App\Models\Organization;
use App\Models\User;
use Cog\Laravel\Love\ReactionType\Models\ReactionType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ReactionCreatedMail extends Mailable implements ShouldQueue  // ShouldQueue here creates the class as a background job
{
    use Queueable;
    use SerializesModels;

    protected $reaction;
    protected $reactionType;
    protected $reactionCount;
    protected $buttonUrl;
    protected $locale;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reaction)
    {
        $this->reaction = $reaction;
        $this->reactionType = ReactionType::fromName($reaction->getType()->name);
        $this->reactionCount = $reaction->getReactant()->getReactionCounterOfType($this->reactionType)->count;

        if ($reaction->getReacter()->getReacterable()::class === User::class) {
            $this->buttonUrl = route('user.show', ['userId' => $reaction->getReacter()->getReacterable()->id]);
        } elseif ($reaction->getReacter()->getReacterable()::class === Organization::class) {
            $this->buttonUrl = route('org.show', ['orgId' => $reaction->getReacter()->getReacterable()->id]);
        }

        $this->locale = $reaction->getReactant()->getReactable()->lang_preference;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('messages@timebank.cc', 'Timebank.cc Messenger') // Optional: set alternative from data, other than the global one.
            ->subject(trans('messages.Your_profile_has_received_a_star', [], $this->locale))
            ->markdown('emails.reactions.' . $this->locale . '.new')
            ->with([
                'reactionType' => $this->reaction->getType(),
                'reactionCount' => $this->reactionCount,
                'from' => $this->reaction->getReacter()->getReacterable(),
                'to' => $this->reaction->getReactant()->getReactable(),
                'buttonUrl' => $this->buttonUrl,
            ]);
    }
}
