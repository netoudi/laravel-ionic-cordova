<?php

namespace CodeDelivery\Http\Middleware;

use Auth;
use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/auth/login');
        }

        if (Auth::user()->role <> 'admin') {
            return redirect('/auth/login');
        }

        return $next($request);
    }
}
