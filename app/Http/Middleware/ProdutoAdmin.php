<?php

namespace App\Http\Middleware;

use Closure;

use Log;

class ProdutoAdmin
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
        
        //verificação se existe login

        if ($request->session()->exists('login')) {
            $login = $request->session()->get('login');
            $isadmin = $login['isadmin'];
            if ($isadmin)
            //log::debug("Passou pelo primeiro Middleware [a = $request]");

                return $next($request);
        }
        return redirect()->route('negado');
    }
}
