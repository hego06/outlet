<?php

namespace App\Http\Middleware;

use Closure;

class VentasMiddleware
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
        $dpto = Auth()->user()->nid_depto;

        if ($dpto =='23' || $dpto=='9' || $dpto =='10' || $dpto=='13')
        {
            return $next($request);
        }

        return redirect('/')->with('block', 'SOLICITUD DENEGADA, no tiene suficientes privilegios :(');
    }
}
