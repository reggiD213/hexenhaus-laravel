<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class AppMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        setlocale(LC_TIME, 'de_DE.utf8');
        Carbon::setLocale('de');

        return $next($request);
    }
}
