<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next): Response
    {
        // Memeriksa apakah pengguna memiliki peran "admin"
        if ($request->user() && ($request->user()->hasRole('Admin') || $request->user()->hasRole('Super_Admin'))) {
            return $next($request);
        }
        // if (!$request->user() || !$request->user()->hasRole('Admin')) {
        //     abort(403, 'Unauthorized');
        // }
        abort(403, 'Unauthorized');
        //return $next($request);
    }
}
