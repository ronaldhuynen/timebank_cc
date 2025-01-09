<?php

namespace App\Listeners;

use App\Jobs\SendEmailNewMessage as JobsSendEmailNewMessage;
use Carbon\Carbon;


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
        dispatch(new JobsSendEmailNewMessage($event));
    }
}
