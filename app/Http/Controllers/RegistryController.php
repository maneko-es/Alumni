<?php

namespace App\Http\Controllers;
use App\Page;
use App\Block;
use App\User;
use App\Post;
use App\Category;
use App\School;
use App\Activity;
use App\Registry;
use App\Role;
use App\Promotion;
use App\Notification;
use App\Configuration;

use View;
use Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;

class RegistryController extends Controller
{

    public function saveRegistry(Request $request){
        $exists = User::where('email',$request->email)->first();
        if($exists){
            return redirect()->back()->with("err","Ja existeix un usuari amb aquesta direcció de correu. Per afegir altres promocions, ves al teu perfil." );
        } elseif(!is_numeric($request->year)) {
            return redirect()->back()->with("err","L'any de promoció ha de ser un número" );
        } else {
            $registry = new Registry;
            $registry->name = $request->name . ' ' . $request->surname_1 . ' ' . $request->surname_2 ;
            $registry->email = $request->email;
            $registry->school_id = $request->school_id;
            $registry->year = $request->year;

            $registry->save();

            $school = School::find($registry->school_id);
            $general_email = Configuration::first()->main_mail;

            Mail::send('emails.registry', ['registry' => $registry, 'school'=>$school,'general_email'=>$general_email], function ($m) use ($registry,$school, $general_email) {
                $m->to($school->email)->cc($general_email)->subject(trans('Sol·licitud ICCIC Alumni'));
            });

            return redirect()->back()->with('success','La teva sol·licitud ha quedat registrada.');
        }
    }
    public function acceptRegistry(Request $request){
        $registry = Registry::find($request->registry_id);

        if ( !User::where('email', $registry->email)->first() ){

            $user = new User;
            $school = School::find($registry->school_id);
            $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
            $password = substr($random, 0, 10);

            $user->name = $registry->name;
            $user->email = $registry->email;
            $user->password = Hash::make($password);
            $roleStudent = Role::find(2);

            $user->save();
            $user->roles()->attach($roleStudent);
            $user->schools()->attach($school);

            $promotion = Promotion::where('school_id',$registry->school_id)->whereTranslation('title',$request->year)->first();
            if(!$promotion){
                $promotion = new Promotion;
                $promotion->school_id = $registry->school_id;
                $promotion->title = $request->year;
                // $promotion->slug = $request->year;
                $promotion->save();
            }
            $user->promotions()->attach($promotion);

            $user->save();

            $registry->status = 'accepted';
            $registry->user_id = $user->id;
            $registry->year = $request->year;
            $registry->save();

            Mail::send('emails.user-accepted', ['password' => $password, 'user' => $user, 'school' => $school], function ($m) use ($password,$user,$school) {
                $m->to($user->email)->subject(trans('Sol·licitud ICCIC Alumni'));
            });

            $notification = new Notification;
            $notification->type = 'mate';
            $notification->user_id = $user->id;
            $notification->promotion_id = $promotion->id;
            $notification->save();

            $target = $promotion->users()->get();
            foreach($target as $us){
                $us->notifications()->attach($notification);
            }

        } else {
            $user = User::where('email', $registry->email)->first();
            $school = School::find($registry->school_id);
            if(!$user->schools->find($registry->school_id)){
                $user->schools()->attach($school);
                $promotion = Promotion::where('school_id',$registry->school_id)->whereTranslation('title',$request->year)->first();
                if(!$promotion){
                    $promotion = new Promotion;
                    $promotion->school_id = $registry->school_id;
                    $promotion->title = $request->year;
                    // $promotion->slug = $request->year;
                    $promotion->save();
                }
                $user->promotions()->attach($promotion);
                $user->save();

                $registry->status = 'accepted';
                $registry->user_id = $user->id;
                $registry->save();

                Mail::send('emails.promo-added', ['user' => $user, 'school' => $school, 'promotion' => $promotion], function ($m) use ($promotion,$user,$school) {
                    $m->to($user->email)->subject(trans('Sol·licitud ICCIC Alumni'));
                });

                $notification = new Notification;
                $notification->type = 'mate';
                $notification->user_id = $user->id;
                $notification->promotion_id = $promotion->id;
                $notification->save();

                $target = $promotion->users()->get();
                foreach($target as $us){
                    $us->notifications()->attach($notification);
                }
            }
        }
        return redirect()->back();
    }

    public function denyRegistry(Request $request){
        $registry = Registry::find($request->registry_id);
        $school = School::find($registry->school_id);

        $registry->status = 'denied';
        $registry->save();

        Mail::send('emails.user-denied', ['registry' => $registry, 'school' => $school], function ($m) use ($registry,$school) {
            $m->to($registry->email)->subject(trans('Sol·licitud ICCIC Alumni'));
        });

        return redirect()->back();
    }

}
?>
