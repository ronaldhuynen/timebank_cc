<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        
        $locale = auth()->user()->lang_preference;
        if ($locale) {
        $localizedRoute = LaravelLocalization::getURLFromRouteNameTranslated($locale, 'routes.dashboard');
        }
        // Conditional redirect based on lang_preference
        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(
                        $locale ? $localizedRoute : route('dashboard')
                    );
    }

}
