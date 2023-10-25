<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Auth::user()->status) {
            Auth::logout();
            return redirect()->route("auth.login")->withErrors("Your account is currently inactive!");
        }
        if (Auth::check() && Auth::user()->status) {
            return $next($request);
        }
        return redirect()->route("auth.login");
    }
}
