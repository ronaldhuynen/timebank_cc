<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Mail\NewMessageMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use RTippin\Messenger\Events\NewMessageEvent;

class SendEmailParticipantsAdded
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

        Log::debug('ParticipantsAdded:');

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // $last_read_age = 1; // Minutes that a recipient did not read tha last message of a thread (conversation)
        // $formatted_age = Carbon::now()->subMinutes($last_read_age)->toDateTimeString();
        // sleep((60*$last_read_age)+1); // Wait 1 more second after $last_read_age before selecting email recipients and firing the Mailable

        // // TODO: remove debug logs
        // Log::debug('Formatted date:');
        // Log::debug($formatted_age);

        // TODO: remove debug logs
        Log::debug('ParticipantsAdded:');
        Log::debug($event->thread);


        // $owner = $event->message->owner_type::where('id', $event->message->owner_id)->select('name', 'email', 'profile_photo_path')->first();
        // $others = DB::table('participants')->where('thread_id', $event->thread->id)->where('last_read','<', $formatted_age)->whereNotIn('owner_id', [$event->message->owner_id])->select('owner_type', 'owner_id', 'last_read')->get();

        // $recipients = $others->map(function ($others, $key) {
        //     return $others->owner_type::where('id', $others->owner_id)->select('name', 'email', 'profile_photo_path')->get();
        // });


        // foreach ($recipients as $recipient) {
        //     Mail::to($recipient)->send(new NewMessageMail($event, $owner, $recipient));

    }
}
