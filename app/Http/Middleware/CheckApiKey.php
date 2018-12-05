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
        if (!empty($request->get('secret')) && ($request->get('secret') === config('app.app_secret'))) {
            return $next($request);
        } else if (config('app.app_secret') === $request->header('X-API-Key')) {
            return $next($request);
        } else {
            return [
                'status' => '400',
                'success' => 'false',
                'message' => 'Please check your API key',
            ];
        }
    }
}
