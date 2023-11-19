<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next): Response
    {
        $user = $request->user();

        // if (
        //     $user && ($user->hasRole('User') ||
        //         $user->hasRole('Admin') ||
        //         $user->hasRole('Super_Admin')
        //     )
        // ) {
            if (
                !$user->nik ||
                !$user->company_name ||
                !$user->alamat ||
                !$user->npwp ||
                !$user->phone
            ) {
                // Profil belum lengkap, arahkan ke halaman users.show
                return redirect()->route('profil.index')->with('warning', 'Mohon untuk melengkapi profil Anda terlebih dahulu');
                // return redirect()->route('users.show', ['user' => $user])->with('warning', 'Mohon untuk melengkapi profil Anda terlebih dahulu');
            }
        // }
        return $next($request);
    }
}