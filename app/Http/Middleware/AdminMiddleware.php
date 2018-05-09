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
        if ($dpto =='10' || $dpto=='13')
        {
            return $next($request);
        }

        return redirect('/')->with('block', 'SOLICITUD DENEGADA, no tiene suficientes privilegios :(');
    }
}
