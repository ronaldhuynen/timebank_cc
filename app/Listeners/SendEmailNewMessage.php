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
        $seconds =30; // Delay in seconds before New Message email is dispatched

        // TODO: remove logs
        info('Job will be dispatched in ' . $seconds . ' seconds');

        info('Message data:');
        info($event->message);

        $seconds_ago = $seconds; // time that a recipient did not read tha last message of a thread (conversation)
        $read_before = Carbon::now()->subSeconds($seconds_ago)->toDateTimeString();

        dispatch(new JobsSendEmailNewMessage($event, $read_before))->delay($seconds);
    }
}
