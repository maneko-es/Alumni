<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use App\Course;
use App\Module;
use Auth;
use Closure;
use DateTime;

class CourseAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $course = Course::whereTranslation('slug',$request->slug)->first();
        $courseID = $course->id;
        $user = $request->user();
            if($user){
                //Si es admin puede ver
                if($user->roles->contains(1)){
                    return $next($request);
                //Si es alumno puede ver si tiene ese curso
                } elseif($user->roles->contains(2)){

                    $now = new Datetime(); $now = $now->format('Y-m-d');
                    $start = $user->courses()->find($courseID)->pivot->start_date;
                    $end = $user->courses()->find($courseID)->pivot->end_date;
                    $module0_date = strtotime($start.' -7 days');
                    $module0_date = date("Y-m-d", $module0_date);


                    if($now >= $start && $now <= $end){   //Course available
                        return $next($request);

                    } else {  //Course not available

                        // Not available anymore
                        if($start < $now){
                            $error = trans('intranet.no-access-anymore');

                        } // Not available yet
                        else {
                            // If is not ended can see already course page and module 0
                            if($now < $end){
                                // Can enter if is course
                                if($request->route()->action['as'] == 'course-single'){
                                    return $next($request);
                                }
                                // Can enter if is messages
                                if($request->route()->action['as'] == 'course-messages'){
                                    return $next($request);
                                }
                                // Can enter if is first module
                                elseif($request->route()->action['as'] == 'course-module'){
                                    $module = Module::whereTranslation('slug',$request->module)->first();
                                    if($module->order == 0){
                                        return $next($request);
                                    } else {
                                        $error = trans('intranet.no-access-yet');
                                    }
                                }
                                // Anything else cannot enter
                                else {
                                    $error = trans('intranet.no-access-yet');
                                }
                            } else {
                                $error = trans('intranet.no-access-yet');
                            }
                        }
                        return redirect(route('dashboard'))->with('error',$error);
                    }
  
                //Si es profesor puede ver si tiene ese curso
                } elseif($user->courses->contains($courseID)){
                    return $next($request);
                    
                } else {
                    return redirect(route('dashboard'))->with('error','Unauthorized access');
                }
            } else {
                return redirect(url('/'));
            }
            //return $next($request);

    }
}
