<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Google2FAMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Skip if user doesn't have 2FA enabled
        if (empty($user->google2fa_secret)) {
            return $next($request);
        }

        // Check if user is already authenticated for 2FA
        if ($request->session()->get('2fa_verified')) {
            return $next($request);
        }

        // Redirect to 2FA verification page
        return redirect()->route('2fa.verify');
    }
}
