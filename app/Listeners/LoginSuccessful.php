<?php

namespace App\Listeners;

use App\Events\ProfileSwitchEvent;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginSuccessful
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {

        $user = Auth::user();

        Session::flash('login-success', 'Hello ' . $event->user->name . ', welcome back!');

        // Set session properties
        Session([
                'activeProfileType' => User::class,
                'activeProfileId' => $user->id,
                'activeProfileName' => $user->name,
                'activeProfilePhoto' => $user->profile_photo_path,
                'activeProfileAccounts' => User::find($user->id)->accounts()->pluck('id')->toArray()
            ]);

        $activeProfile = [
                    'userId' => $user->id,
                    'type' => Session('activeProfileType'),
                    'id' => Session('activeProfileId'),
                    'name' => Session('activeProfileName'),
                    'photo' => Session('activeProfilePhoto')
                ];

        event(new ProfileSwitchEvent($activeProfile));

    }
}
