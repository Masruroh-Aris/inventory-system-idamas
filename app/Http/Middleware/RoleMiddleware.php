<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            // Redirect ke admin login sesuai nama route
            return redirect()->route('admin.login');
        }

        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}
