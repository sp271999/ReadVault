<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOrImpersonating
{
    public function handle(Request $request, Closure $next): Response
    {
        // Guest → login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Real admin → allow
        if (Auth::user()->hasRole('admin')) {
            return $next($request);
        }

        // Admin impersonating user → allow
        // if (session()->has(' Auth::login($user)')) {
        //    return redirect()->route('user.dashboard');
        // }

        // ❌ Normal user trying admin URL → redirect
        return redirect()->route('user.dashboard');
    }
}
