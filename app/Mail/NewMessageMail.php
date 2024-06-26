<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NewMessageMail extends Mailable //implements ShouldQueue  // ShouldQueue here creates the class as a background job
{
    use Queueable;
    use SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event, $owner, $recipient)
    {
        return $this
            ->from('messages@timebank_2.cc', 'Timebank.cc Messenger')      // Optional: set alternative from data, other than the global one.
            ->subject($event->thread->subject . __(' has an update'))
            ->markdown('emails.messages.new')
            ->with([
                'event' => $event,
                'owner' => $owner,
                'recipient' => $recipient->toArray()
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
