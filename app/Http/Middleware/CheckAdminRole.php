<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminRole
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
        return $request->user()->is_admin ? 
            $next($request) : 
            redirect()->route('home');
    }
}
