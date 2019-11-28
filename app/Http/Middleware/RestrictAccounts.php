<?php

namespace App\Http\Middleware;

use Closure;

class RestrictAccounts
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
        if (session('user_type') !== null) {
            return redirect('/profile');
        }
        return $next($request);
    }
}
