<?php

namespace App\Http\Middleware;

use Closure;

class CheckBanStatus
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
        if ($request->user()->is_banned)
            abort(403, __('This account has been banned.'));

        return $next($request);
    }
}
