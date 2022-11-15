<?php

namespace App\Providers;

use App\Listeners\SendEmailNewMessage;
use Illuminate\Auth\Events\Registered;
use RTippin\Messenger\Events\NewMessageEvent;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
// use RTippin\Messenger\Events\PushNotificationEvent;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // Rtippin Messenger event
        NewMessageEvent::class => [
           SendEmailNewMessage::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
