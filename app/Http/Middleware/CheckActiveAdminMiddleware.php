<?php

namespace App\Http\Middleware;

use Closure;

class CheckActiveAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (admin() && !admin()->is_active) {
            auth()->guard('admin')->logout();
            return redirect()->to('admin/login');
        }
        return $next($request);
    }
}
