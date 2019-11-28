<?php

namespace App\Http\Middleware;

use Closure;

class ClientOnly
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
        if (session('user_type') !== null && session('user_type') === 2) {
            return abort(403);
        }
        return $next($request);
    }
}
