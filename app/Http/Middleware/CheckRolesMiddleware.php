<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRolesMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $userRole = session('role'); // ambil role dari session

        if (!$userRole || !in_array($userRole, $roles)) {
            return redirect()->route('login.show')->withErrors('Anda tidak punya akses.');
        }

        return $next($request);
    }
}
