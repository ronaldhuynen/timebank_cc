<?php

namespace App\Listeners;

use App\Events\ProfileSwitchEvent;
use Carbon\Carbon;

class LogProfileSwitch
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ProfileSwitchEvent  $event
     * @return void
     */
    public function handle(ProfileSwitchEvent $event)
    {        
        $profile = getActiveProfile();

        if ($profile) {
            $profile->update([
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'last_login_ip' => request()->ip()
            ]);
        }
    }
}
