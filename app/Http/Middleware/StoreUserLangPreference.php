<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StoreUserLangPreference
{
  /**
     * Handle an incoming request.
     * Store the user's language preference according to the session('locale') in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()) {
            $user_lang = $request->user()->lang_preference;

            if (session('locale') != $user_lang) {
                $request->user()->update(['lang_preference' => session('locale')]);
            }
        }

        return $next($request);
    }
}
