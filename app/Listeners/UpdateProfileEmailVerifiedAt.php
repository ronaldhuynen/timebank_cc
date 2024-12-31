<?php

namespace App\Listeners;

use App\Events\ProfileVerified;
use Illuminate\Support\Facades\Log;

class UpdateProfileEmailVerifiedAt
{
    /**
     * Handle the event.
     * Update the email_verified_at record of the profile's Model
     *
     * @param  ProfileVerified  $event
     * @return void
     */
    public function handle(ProfileVerified $event)
    {
        $success = $event->profileModel->forceFill([
            'email_verified_at' => now(),
        ])->save();
        
        if ($success) {
            // Flash a success message to the session
            if (class_basename($event->profileModel) != 'User') {
                session(['email-verified' => 'Email verified successfully',
                    'email-profile' => $event->profileModel->name]);
            } else {
                session(['email-verified' => 'Email verified successfully']);
            }
        } else {
            Log::error('Failed to update email_verified_at for '. class_basename($event->profileModel) . ' id: ' . $event->profileModel->id);
        }

        }
}
