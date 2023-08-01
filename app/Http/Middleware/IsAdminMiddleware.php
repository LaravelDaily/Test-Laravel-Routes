<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        abort_if(! auth()->user()->is_admin, 403);
        if (! auth()->user()->is_admin) {
            abort(403);
        }

        return $next($request);
    }
}
