<?php

namespace App\Listeners;

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
        $seconds = 30;
        // TODO: remove logs
        info('Job will be dispatched in ' . $seconds . ' seconds');

        info('Message data:');
        info($event->message);

        dispatch(new JobsSendEmailNewMessage($event))->delay($seconds);
    }
}
