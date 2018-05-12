<?php

namespace App\Http\Middleware;

use App\User;

use Auth;
use Closure;

class AdminAuthenticate
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
        if (Auth::user()->email != 'admin@gmail.com') {
            return response('Access denied.', 401);
        }

        return $next($request);
    }
}
