<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class IntranetAuthenticate
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
        $user = $request->user();
            if($user){
                //Si es admin, profesor o alumno puede ver
                if($user->roles->contains(1) || $user->roles->contains(2) || $user->roles->contains(3)){
                    return $next($request);
                } else {
                    return redirect('/');
                }
            } else {
                return redirect('/');
            }

    }
}
