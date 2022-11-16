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

class NewMessageMail extends Mailable implements ShouldQueue  // ShouldQueue here creates the class as a background job
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

        // $owner = $event->message->owner_type::where('id', $event->message->owner_id)->select('name', 'email', 'profile_photo_path')->first();
        // $others = DB::table('participants')->where('thread_id', $event->thread->id)->whereNotIn('owner_id', [$event->message->owner_id])->select('owner_type', 'owner_id')->get();
        // $recipients = $others->map(function ($others, $key) {
        //     return $others->owner_type::where('id', $others->owner_id)->select('name', 'email', 'profile_photo_path')->get();
        //     });


        Log::debug('Owner:');
        Log::debug($owner);
        Log::debug('Recipient:');
        Log::debug($recipient);



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
