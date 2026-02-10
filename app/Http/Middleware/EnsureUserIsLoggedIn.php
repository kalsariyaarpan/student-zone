<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsLoggedIn
{
    public function handle(Request $request, Closure $next)
    {
        // If user is NOT logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        return $next($request);
    }
}
