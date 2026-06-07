<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

//Middleware that restricts access based on user roles.//
/*Allows only users with specific roles to access routes.
Redirects unauthenticated users to login and blocks unauthorized roles.*/
class RoleMiddlewareAZU
{
    /**
     * Handle an incoming request and enforce role based access control.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        //Redirects unauthenticates users to login page//
        if (!Auth::check()) {
            return redirect("login");
        }

        $user = Auth::user();

        //Checks if a user has any of the allowed roles.//
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        //Deny access if no matching role is found.//
        abort(403, "Unauthorized action.");
    }
}
