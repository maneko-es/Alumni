<?php

namespace App\Http\Controllers\Intranet;

use App\Http\Controllers\Controller;
use View;
use Hash;
use App\User;
use App\Study;
use App\School;
use App\Promotion;
use App\Page;
use App\Registry;
use Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\ProfileMediaRequest;



class UserController extends IntranetController
{  

	public $user;
    public $isUser;

    public function __construct()
    {
        $isUser = true;

        View::share(['isUser' => $isUser]);
    }

    public function viewProfile(){
        $user = Auth::user();
        $schools = School::all();

        return view('front.intranet.profile',compact('schools'));
    }

    public function editProfile(){
    
        return view('front.intranet.user.edit-profile');
    }
    public function settingsProfile(){
    
        return view('front.intranet.user.settings-profile');
    }

    public function updateProfile(ProfileMediaRequest $request)
    {
        $user = Auth::user();
        if($request->name){ $user->name = $request->name; }
        if($request->email){ $user->email = $request->email; }
        if($request->birth){ $user->birth = $request->birth; }
        if($request->address){ $user->address = $request->address; }
        if($request->cp){ $user->cp = $request->cp; }
        if($request->city){ $user->city = $request->city; }
        if($request->phone){ $user->phone = $request->phone; }

        if($request->situation){ $user->situation = $request->situation; }
        if($request->job){ $user->job = $request->job; }
        
        if($request->has_children){ $user->has_children = $request->has_children; }
        if($request->wants_info){ $user->wants_info = $request->wants_info; }
        if($request->select_school_new_0 && $request->promo_0){
            if(!$user->schools->find($request->select_school_new_0) && !Registry::where(['email' => $user->email, 'school_id' => $request->select_school_new_0])->first()){
                $registry = new Registry;
                $registry->name =  $request->name ;
                $registry->email = $request->email  ;
                $registry->school_id = $request->select_school_new_0  ;
                $registry->year = $request->promo_0  ;
                $registry->save();
                Session::flash('add_school', 'La nova promoció s\'afegirà al teu perfil un cop hagi estat validada');
                Session::flash('alert-class', 'alert-success');  
            }
        }
        if($request->select_school_new_1 && $request->promo_1){
            if(!$user->schools->find($request->select_school_new_1) && !Registry::where(['email' => $user->email, 'school_id' => $request->select_school_new_1])->first()){
                $registry = new Registry;
                $registry->name =  $request->name ;
                $registry->email = $request->email  ;
                $registry->school_id = $request->select_school_new_1  ;
                $registry->year = $request->promo_1  ;
                $registry->save();
            }
        }
        if($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        Session::flash('message', 'El teu perfil s\'ha actualitzat correctament.');
        Session::flash('alert-class', 'alert-success');  
        return back(); 
    }

    public function updateImage(ProfileMediaRequest $request){
        $user = Auth::user();
        if($file = $request->file('img')) {
            $filename = pathinfo($file->getClientOriginalName())['filename'];
            $imgName = $user->id.'_'.time().'.'.$file->getClientOriginalExtension();

            $originalsize_path = public_path('profile/original');
            $thumbnailsize_path = public_path('profile/thumbnail');
            $miniaturesize_path = public_path('profile/miniature');

            $img = Image::make($file->path());

            //Save original
            $file->move($originalsize_path, $imgName);
            //Save thumbnail
            $img->resize(150, null, function ($constraint) { $constraint->aspectRatio(); })->save($thumbnailsize_path.'/'.$imgName);
            //Save miniature
            $img->resize(50, null, function ($constraint) { $constraint->aspectRatio(); })->save($miniaturesize_path.'/'.$imgName);
            
            $user->img = $imgName;
            $user->save();

            return redirect()->back();
            

            /*return response()->json([
                'img' => url('images/galleries/'.$imgName),
            ]);*/
        }
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        if (Hash::check($request->old_password, $user->password)) {
            if($request->password == $request->password_again) {
                if(strlen($request->password) >= 8){
                    $obj_user = User::find($user->id);
                    $obj_user->password = Hash::make($request->password);
                    $obj_user->save();
                    return back()->with('success','Contrassenya desada correctament.'); 
                } else {
                    return back()->with('error','La contrassenya ha de contenir almenys 8 caràcters.');
                }
            } else {
                return back()->with('error','El camp "Contrassenya" y "Repetir contrassenya" han de coincidir.');
            }
        }  else {
            return back()->with('error','La contrassenya és incorrecta');
        }
    }

    public function addStudies(Request $request)
    {
        $user = Auth::user();
        $study = new Study;
        $study->name = $request->study;
        $study->user_id = $user->id;
        $study->save();

        return json_encode($study);
    }

    public function addSchool(Request $request)
    {
        $user = Auth::user();
        $promotion = Promotion::whereTranslation('title',$request->school_year)->where('school_id',$request->school_id)->first();
        $school = School::find($request->school_id);
        if(!$promotion){
            $promotion = new Promotion;
            $promotion->title = $request->school_year;
            $promotion->school_id = $request->school_id;
            $promotion->save();
        }

        $user->promotions()->attach($promotion);
        $user->schools()->attach($school);

        $result = array(
            'school' => $school->title,
            'year' => $request->school_year
        );
        return json_encode($result);
    }



    public function changePromotion(Request $request){
        $user = Auth::user();
        $user->preferred_promotion = $request->promotion_id;
        $user->save();
        return redirect('/intranet');
    }

    public function viewPromotion(){

        $blocks = Page::find(7)->blocks()->get();
        return view('front.intranet.promotion',compact('blocks'));
    }
}
?>