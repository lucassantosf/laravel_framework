<?php

namespace App\Http\Middleware;

use Closure;

class ProdutoAdmin
{
    public function handle($request, Closure $next)
    {
        if($request->session()->exists('login')){
            $login = $request->session()->get('login');
            if($login['admin'])
                return $next($request);
            else 
                return redirect()->route('negadoLogin');
        }else{
            return redirect()->route('negado');
        }
        
    }
}
