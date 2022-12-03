<?php

namespace App\Providers;

use App\Events\ProfileSwitchEvent;
use App\Listeners\LoginSuccessful;
use App\Listeners\RedirectToDashboard;
use App\Listeners\SendEmailNewMessage;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use RTippin\Messenger\Events\NewInviteEvent;
use RTippin\Messenger\Events\NewMessageEvent;
use RTippin\Messenger\Events\ParticipantsAddedEvent;
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

        Login::class => [LoginSuccessful::class],

        // Rtippin Messenger events:
        // ParticipantsAddedEvent::class => [
        //    SendEmailParticipantsAdded::class,
        // ],
        NewMessageEvent::class => [
           SendEmailNewMessage::class,
        ],

        // ProfileSwitchEvent::class => [
        //     RedirectToDashboard::class,
        // ]

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
