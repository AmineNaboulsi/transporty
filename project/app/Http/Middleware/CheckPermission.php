<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $user = Auth::user();
        // $routeName = $request->route()->getAction('as');
        // if ($user->role->name == 'admin' || $user->role->hasPermissionTo($routeName)) {
        //     return $next($request);
        // }
        // abort(403, 'Unauthorized');
        return $next($request);
    }
}
