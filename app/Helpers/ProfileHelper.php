<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Retrieve the active profile based on the session data.
 *
 * This function checks if the session contains 'activeProfileType' and
 * 'activeProfileId'. If both are present, it attempts to find and return
 * the profile using the specified type and ID. If either is missing,
 * it returns null.
 *
 * @return mixed|null The active profile object if found, otherwise null.
 */
if (!function_exists('getActiveProfile')) {
    function getActiveProfile()
    {
        $profileType = Session::get('activeProfileType');
        $profileId = Session::get('activeProfileId');

        if ($profileType && $profileId) {
            return $profileType::find($profileId);
        }

        return null;
    }
}

if (!function_exists('getActiveProfileType')) {
    function getActiveProfileType()
    {
        $profileType = Session::get('activeProfileType');
        $profileTypeName = class_basename($profileType);

        if ($profileType && $profileTypeName) {
            return $profileTypeName;
        }

        return null;
    }
}

    /**
     * Checks if the user actually "owns" this profile.
     */
if (!function_exists('userOwnsProfile')) {
    function userOwnsProfile($profileModel)
    {
        $user = Auth::user();
        
        // Check if the profile model is an instance of the User model
        if ($profileModel instanceof \App\Models\User) {
            return $profileModel->id === $user->id;
        }

        // Example for Organization / Bank / Admin relationships:
        // If the model has a `users()` relationship, check if the user is in there
        if (method_exists($profileModel, 'users')) {
            return $profileModel->users->contains($user);
        }

        return false;
    }
}