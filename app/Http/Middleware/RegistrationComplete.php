<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RegistrationComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Define here the conditions for when the registration has NOT yet been completed.
        // Users with only auth middleware will be redirected to the incomplete steps of the registration forms.
        // Users with all required steps complete will get next to auth also access to registration-complete middleware.
        if (is_null(auth()->user()->about)
            && is_null(auth()->user()->motivation)) {
            return redirect()->route('register-step2.create');
        }
        return $next($request);
    }
}
