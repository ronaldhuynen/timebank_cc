<?php

namespace App\Mail;

use App\Models\Bank;
use App\Models\Organization;
use App\Models\User;
use Cog\Laravel\Love\ReactionType\Models\ReactionType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ReactionCreatedMail extends Mailable implements ShouldQueue  // ShouldQueue here creates the class as a background job
{
    use Queueable;
    use SerializesModels;

    protected $reaction;
    protected $reactionType;
    protected $reactionCount;
    protected $buttonUrl;
    public $locale;

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

        $reacter = $reaction->getReacter()->getReacterable();

        if ($reacter instanceof User) {
            $userId = $reacter->id;
            $this->buttonUrl = route('user.show', ['id' => $userId]);
        } elseif ($reacter instanceof Organization) {
            $organizationId = $reacter->id;
            $this->buttonUrl = route('organization.show', ['id' => $organizationId]);
        } elseif ($reacter instanceof Bank) {
            $bankId = $reacter->id;
            $this->buttonUrl = route('organization.show', ['id' => $bankId]);   
        } else {
            Log::warning('ReactionCreatedMail: Unknown reacter type');
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
