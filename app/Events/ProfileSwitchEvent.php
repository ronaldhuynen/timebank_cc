<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProfileSwitchEvent implements ShouldBroadcastNow
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $activeProfile;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($activeProfile)
    {
        $this->activeProfile = $activeProfile;
        $this->checkVerification();
    }

    
    public function checkVerification()
    {
        if (! getActiveProfile()->hasVerifiedEmail()) {
            session(['notification.alert' => 'Your email address is unverified. Check your profile settings to re-send the verification email.']);
        }
    }
    

    public function broadcastQueue()
    {
        return 'broadcastable';
    }


    public function broadcastWith()
    {
        return [
            'userId' => $this->activeProfile['userId'],
            'type' => $this->activeProfile['type'],
            'id' => $this->activeProfile['id'],
            'name' => $this->activeProfile['name'],
            'photo' => $this->activeProfile['photo']
        ];
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('switch-profile.' . $this->activeProfile['userId']);
    }
}
