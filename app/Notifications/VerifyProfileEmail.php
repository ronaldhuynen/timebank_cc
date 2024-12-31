<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class VerifyProfileEmail extends VerifyEmail
{
    protected function verificationUrl($notifiable)
    {
        $baseName = class_basename($notifiable);         // e.g. "Organization"
        $type = Str::lower($baseName);

        // Use $notifiable->id for an organization, bank, admin ID 
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'type' => $type,
                'id' => $notifiable->id,
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
