<?php

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
