<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('get_layout')) {
    function get_layout()
    {
        return Auth::check() ? 'app-layout' : 'guest-layout';
    }
}
