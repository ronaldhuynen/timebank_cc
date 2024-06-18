<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        // Conditional redirect based on lang_preference
        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(
                        auth()->user()->lang_preference ? route(auth()->user()->lang_preference . '.dashboard') : route('dashboard')
                    );
    }

}
