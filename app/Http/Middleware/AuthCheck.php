<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    private string $token = 'abc123token';

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer: ')) {
            return response()->json(['invalid token']);
        }

        $requestToken = substr($authHeader, 7);

        if (!$requestToken && $requestToken !== $this->token) {
            return response()->json(['Unauthorized'], 401);
        }

        return $next($request);
    }
}
