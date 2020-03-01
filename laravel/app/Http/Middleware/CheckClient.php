<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class CheckClient
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
        if ( !auth()->guest() &&Auth::user()->userStatus() == 'client') {
            return $next($request);
        } elseif (auth()->guest()) {
            return redirect('/');
        }
        else {
            return redirect('/users_gestion');
        }
    }
}
