<?php

namespace App\Http\Middleware;

use Closure;
use Log;
class terceiro
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $nome, $idade)
    {
        log::debug("Passou pelo primeiro Middleware [Nome = $nome, $idade]");
        return $next($request);
    }
}
