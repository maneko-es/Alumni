<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::user()) {
            $isAdmin = false;
            $roles = Auth::user()->roles()->get();

            foreach ($roles as $key => $role) {
                if ($role->id === config('maravel.admin_role_id')) {
                    $isAdmin = true;
                    break;
                }
            }

            if ($isAdmin) {
                return redirect('/admin');
            } else {
                return redirect('/');
            }

        }

        return $next($request);
    }
}
