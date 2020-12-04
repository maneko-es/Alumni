<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        } else {
            $isAdmin = false;
            $roles = Auth::user()->roles()->get();

            foreach ($roles as $key => $role) {
                if ($role->id === config('maravel.admin_role_id')) {
                    $isAdmin = true;
                    break;
                }
            }

            if (!$isAdmin) {
                return redirect('/');
            }
        }
        //app()->setLocale('es');
        return $next($request);


    }
}
