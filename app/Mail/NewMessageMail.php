<?php

namespace App\Mail;

use Illuminate\Support\Arr;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use RTippin\Messenger\Events\NewMessageEvent;

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

        // TODO: remove debug logs
        // Log::debug('Owner:');
        // Log::debug($owner);
        info('Send to recipient:');
        info($recipient);

        return $this
            ->from('messages@timebank_2.cc', 'Timebank.cc Messenger')      // Optional: set alternative from data, other than the global one.
            ->subject($event->thread->subject . __(' has an update') )
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
