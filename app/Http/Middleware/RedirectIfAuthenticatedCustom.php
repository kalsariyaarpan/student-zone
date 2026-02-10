<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedCustom
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // user already logged in
            return redirect()->route('home');
        }

        return $next($request);
    }
}

