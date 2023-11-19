<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next): Response
    {
        // Memeriksa apakah pengguna memiliki peran "Super Admin"
        if (!$request->user() || !$request->user()->hasRole('Super_Admin')) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
