<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class TerceiroMiddleware
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
        Log::debug("Passou pelo Middleware 3 : $request->nome , idade : $request->idade");
        return $next($request);
    }
}
