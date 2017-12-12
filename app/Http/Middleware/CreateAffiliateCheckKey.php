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
        if (env('APP_SECRET') != $request->input('token')) {
            return [
                'status' => '400',
                'success' => 'false',
                'message' => 'Please check your API key',
            ];
        }
        return $next($request);
    }
}
