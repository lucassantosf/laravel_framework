<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class PrimeiroMiddleware
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
        Log::debug('Passou pelo Middleware 1 Antes');
        //return $next($request);
        $response = $next($request);
        Log::debug('Passou pelo Middleware 1 Depois');
        //return $response;
        return response('Alterei a resposta',201);

    }
}
