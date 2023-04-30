<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role == $role) {
                return $next($request);
            } elseif (($role == 'admin-staff') && (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')) {
                return $next($request);
            }
        }

        return response()->json(["No Permissions!"]);
    }
}