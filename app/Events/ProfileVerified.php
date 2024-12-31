<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProfileVerified
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $profileModel;

    /**
     * Create a new event instance.
     * To update the email_verified_at record of the profile's model
     *
     * @param  mixed  $profileModel
     * @return void
     */
    public function __construct($profileModel)
    {
        $this->profileModel = $profileModel;
    }
}
