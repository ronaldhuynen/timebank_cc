<?php

namespace App\Listeners;

use App\Mail\MessageReceived;
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
        Log::debug('1');
        Log::debug($event->message);

        Log::debug($event->thread);


        Log::debug('recipient');

        Log::debug($event->thread);



        // TODO: do not send immediately

        // $now = now();
        // Mail::to('test@test.nl')->later(
        //     $now->addSeconds(2),
        //     new MessageReceived($event)
        // );

        Mail::to('test@test.nl')->send(new MessageReceived($event));
    }
}
