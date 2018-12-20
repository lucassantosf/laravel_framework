<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class PrimeiroMiddleware
{
    public function handle($request, Closure $next)
    {
        Log::debug('Passou pelo PrimeiroMiddleware ANTES');
        // return response('Parando a cadeia');
        //return response('teste');
        $response = $next($request);
        Log::debug('Passou pelo PrimeiroMiddleware DEPOIS');
        //return $response;
        return response('Alterei a resposta',201);
    }
}
