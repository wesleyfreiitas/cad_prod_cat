<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class segundo
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
        log::debug("Passou pelo segundo, onde vem a rota de usuário");
        return $next($request);
    }
}
