<?php

namespace RenokiCo\EchoServer\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticatesWithToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $this->requestIsSigned($request)) {
            return response()->json(['app' => null], 401);
        }

        return $next($request);
    }

    /**
     * Check if the request is signed from the server.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function requestIsSigned(Request $request): bool
    {
        return config('echo-server.api.token') === $request->token;
    }
}
