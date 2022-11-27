<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
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
        Session::flash('login-success', 'Hello ' . $event->user->name . ', welcome back!');

        Session([
            'activeProfileType' => User::class,
            'activeProfileId' => Auth::user()->id,
            'activeProfileName'=> Auth::user()->name,
            'activeProfilePhoto'=> Auth::user()->profile_photo_path
        ]);

    }
}
