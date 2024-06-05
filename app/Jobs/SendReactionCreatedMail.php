<?php

namespace App\Jobs;

use App\Mail\ReactionCreatedEmail;
use App\Mail\ReactionCreatedMail;
use Cog\Contracts\Love\Reaction\Models\Reaction;
use Cog\Laravel\Love\Reaction\Events\ReactionHasBeenAdded;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReactionCreatedMail implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;


    public $tries = 3;
    public $backoff = [5,10,30]; // wait for 5, 10, or 30 sec before worker tries again
    public $reaction;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Reaction $reaction)
    {
        $this->reaction = $reaction;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Send the email
        Mail::to($this->reaction->getReactant()->getReactable()->email)->send(new ReactionCreatedMail($this->reaction));
    }

}
