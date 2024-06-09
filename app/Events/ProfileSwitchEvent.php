<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
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
        ds('profileSwitchEvent broadcastOn');
        return new PrivateChannel('switch-profile.' . $this->activeProfile['userId']);
    }
}
