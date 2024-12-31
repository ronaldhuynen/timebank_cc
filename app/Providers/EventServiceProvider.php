<?php

namespace App\Providers;

use App\Events\ProfileSwitchEvent;
use App\Events\ProfileVerified;
use App\Listeners\LogProfileSwitch;
use App\Listeners\LoginSuccessful;
use App\Listeners\ReactionCreatedListener;
use App\Listeners\SendEmailNewMessage;
use App\Listeners\UpdateProfileEmailVerifiedAt;
use Cog\Laravel\Love\Reaction\Events\ReactionHasBeenAdded;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
// use RTippin\Messenger\Events\PushNotificationEvent;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use RTippin\Messenger\Events\NewMessageEvent;

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

        // Rtippin Messenger events
        NewMessageEvent::class => [
            SendEmailNewMessage::class,
        ],

        // Log the date and ip of the profile that is switched to:
        // When the ProfileSwitchEvent triggers the LogProfileSwitch listens
        ProfileSwitchEvent::class => [
            LogProfileSwitch::class,
        ],

        // Email verification of profile models (organization's, banks, admins etc)
        ProfileVerified::class => [
            UpdateProfileEmailVerifiedAt::class,
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
