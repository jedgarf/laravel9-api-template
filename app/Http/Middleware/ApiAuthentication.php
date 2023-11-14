<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuthentication
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
        if (env('API_TOKEN') == $token) {
            return $next($request);
        } else {
            return response([
                'message' => 'Unathorized: Invalid Token.'
            ], 401);
        }
    }
}