<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        $dpto = auth()->user()->nid_depto;
        if ($dpto ==10  && $dpto==13)
            return $next($request);

        return redirect('/');
    }
}
