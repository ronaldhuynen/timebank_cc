<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Jobs\SendEmailNewMessage as JobsSendEmailNewMessage;


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
     * @param  object
     * @return void
     */
    public function handle($event)
    {
        $minutes =30; // Delay in before New Message email is dispatched

        // TODO: remove logs
        info('Job will be dispatched in ' . $minutes . ' minutes');

        info('Message data:');
        info($event->message);

        $minutes_ago = $minutes; // time that a recipient did not read tha last message of a thread (conversation)
        $read_before = Carbon::now()->subMinutes($minutes_ago)->toDateTimeString();

        dispatch(new JobsSendEmailNewMessage($event, $read_before))->delay(($minutes/60));
    }
}
