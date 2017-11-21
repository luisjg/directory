<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class CreateAffiliateCheckKey
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
        if(env('APP_MIDDLEWARE_KEY')!= $request->token)
        {
            throw new AccessDeniedException();
        }
        return $next($request);
    }
}
