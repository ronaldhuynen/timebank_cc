<?php

namespace App\Providers;

use App\Events\ProfileSwitchEvent;
use App\Listeners\LoginSuccessful;
use App\Listeners\ReactionCreatedListener;
use App\Listeners\RedirectToDashboard;
use App\Listeners\SendEmailNewMessage;
use Cog\Laravel\Love\Reaction\Events\ReactionHasBeenAdded;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
// use RTippin\Messenger\Events\PushNotificationEvent;
use RTippin\Messenger\Events\NewMessageEvent;
use RTippin\Messenger\Events\ParticipantsAddedEvent;

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

        Login::class => [
            LoginSuccessful::class
        ],

        ReactionHasBeenAdded::class => [
            ReactionCreatedListener::class
        ],

        // Rtippin Messenger events:
        // ParticipantsAddedEvent::class => [
        //    SendEmailParticipantsAdded::class,
        // ],
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
