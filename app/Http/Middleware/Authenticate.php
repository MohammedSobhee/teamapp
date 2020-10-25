<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */

    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if (request()->segment(1) != 'api') {
            $roles = admin()->Roles->pluck('id')->toArray();

            view()->share('admin_roles', $roles);


            $roles = admin()->Roles->pluck('route');

            $flag = false;
            foreach ($roles as $role) {
                if (preg_match('/' . $role . '/i', url()->current())) {
                    $flag = true;
                }
            }

            if (!$flag && request()->segment(2) != 'home' && !request()->ajax()) {
                return redirect(admin_home_url());
            }
        }
        return $next($request);
    }

    protected function authenticate($request, array $guards)
    {
        parent::authenticate($request, $guards);

    }

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route(admin_vw() . '.login');
        }
    }
//
//    protected function unauthenticated($request, array $guards)
//    {
//        return response_api(false, 401, trans('app.unauthorized'), empObj());
//    }
}
