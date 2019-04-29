<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class SegundoMiddleware
{
    public function handle($request, Closure $next)
    {
        Log::debug('Passou pelo SegundoMiddleware ANTES');
        
        $response = $next($request);

        Log::debug('Passou pelo SegundoMiddleware DEPOIS');

        //return $response;
        return $response;
    }
}
