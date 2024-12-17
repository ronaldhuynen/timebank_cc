<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogErrors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response->isClientError() || $response->isServerError()) {
            $userId = Auth::check() ? Auth::id() : 'guest';
            $ipAddress = $request->ip();
            $datetime = now()->toDateTimeString();
            $statusCode = $response->status();
            $url = $request->fullUrl();

        

            // Assign error message based on status code
            $errorMessage = match ($statusCode) {
                401 => '401 Error: Unauthorized',
                403 => '403 Error: Forbidden',
                404 => '404 Error: Page not found',
                419 => '419 Error: Page expired',
                429 => '429 Error: Too many requests',
                500 => '500 Error: Server error',
                503 => '503 Error: Service unavailable',
                default => $statusCode . ' Error',
            };

            Log::warning($errorMessage, [
                'datetime' => $datetime,
                'url' => $url,
                'user_id' => $userId,
                'activeProfileType' => session('activeProfileType'),
                'activeProfileId' => session('activeProfileId'),
                'ip_address' => $ipAddress,
            ]);
        }

        return $response;
    }
}
