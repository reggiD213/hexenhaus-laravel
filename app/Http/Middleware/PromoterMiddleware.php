<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Log;

class PromoterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        Log::info("Authenticating Users...");
        if (Auth::guard($guard)->guest() || !Auth::user()->booker()) {
            if ($request->ajax() || $request->wantsJson()) {
                Log::info("Unauthorized ajax request.");
                return response('Unauthorized.', 401);
            } else {
                Log::info("Redirecting to members page.");
                return redirect()->guest('/members');
            }
        }
        return $next($request);
    }
}
