<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use RTippin\Messenger\Events\NewMessageEvent;

class MessageReceived extends Mailable implements ShouldQueue  // ShouldQueue here creates the class as a background job
{
    use Queueable;
    use SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event)
    {

        Log::debug('3');
        Log::debug($event->message->body);

        $subject = __("Message received");
        return $this
            ->from('info@timebank_2.cc', 'Ronald de admin')      // Optional: set alternative from data, other than the global one.
            // ->replyTo('reply-to@test.nl', 'Reply to')
            ->subject($subject)
            ->markdown('emails.messages.new')
            ->with('event', $event);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // TODO: Find out below!
        // build method is not fires WHY?
        // therefore sending of email method is writen inside constructor!


        // Log::debug('3');
        // Log::debug($this->event->message->body);
        // $subject = __("Message received");
        // return $this
        //     ->from('info@timebank_2.cc', 'Ronald de admin')      // Optional: set alternative from data, other than the global one.
        //     // ->replyTo('reply-to@test.nl', 'Reply to')
        //     ->subject($subject)
        //     ->markdown('emails.messages.new')
        //     ->with(['body' => $this->event->message->body]);
    }
}
