<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role): mixed
    {
        if (auth()->user() && auth()->user()->role !== $role) {
            abort(Response::HTTP_FORBIDDEN, 'Acesso não autorizado.');
        }
        return $next($request);
    }
}