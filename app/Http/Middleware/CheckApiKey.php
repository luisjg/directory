<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class CheckApiKey
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
        if (config('app.app_secret') !== $request->get('secret') &&
            config('app.app_secret') !== $request->headers->get('X-API-Key')) {
            return [
                'status' => '400',
                'success' => 'false',
                'message' => 'Please check your API key',
            ];
        }
        return $next($request);
    }
}
