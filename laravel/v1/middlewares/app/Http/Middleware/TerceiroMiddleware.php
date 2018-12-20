<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class TerceiroMiddleware
{
    public function handle($request, Closure $next, $nome, $idade)
    {   
        Log::debug("Passou pelo Middleware [nome = $nome] $idade");
        return $next($request);
    }
}
