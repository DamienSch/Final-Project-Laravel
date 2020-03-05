<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class CheckAdmin
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
        if ( !auth()->guest() && Auth::user()->userStatus() == 'admin') {
            return $next($request);
        } elseif (auth()->guest()) {
            return redirect('/login');
        }
        else {
            return redirect('/home');
        }
    }
}
