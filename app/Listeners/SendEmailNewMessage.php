<?php

namespace App\Listeners;

use App\Mail\NewMessageMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use RTippin\Messenger\Events\NewMessageEvent;

class SendEmailNewMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        // TODO: do not send immediately

        // $now = now();
        // Mail::to('test@test.nl')->later(
        //     $now->addSeconds(2),
        //     new MessageReceived($event)
        // );


        $owner = $event->message->owner_type::where('id', $event->message->owner_id)->select('name', 'email', 'profile_photo_path')->first();
        $others = DB::table('participants')->where('thread_id', $event->thread->id)->whereNotIn('owner_id', [$event->message->owner_id])->select('owner_type', 'owner_id')->get();
        $recipients = $others->map(function ($others, $key) {
            return $others->owner_type::where('id', $others->owner_id)->select('name', 'email', 'profile_photo_path')->get();
        });

        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new NewMessageMail($event, $owner, $recipient));
        }
    }
}
