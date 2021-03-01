<?php

namespace App\Http\Controllers;
use App\Page;
use App\Block;
use App\User;
use App\Category;
use App\School;
use App\Activity;
use App\Registry;
use App\Role;
use App\Configuration;

use View;
use Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;

class PublicController extends Controller
{
    public function __construct(Redirector $redirect)
    {

    }

    // PAGES --------------------------------------
    public function pageHome(){
        $page = Page::find(1);
        $blocks = $page->blocks()->get();
        $activities = Activity::where('published', true)->orderBy('created_at','desc')->take(9)->get();

        return view('front.home',compact('page','blocks','activities'));
    }
    public function pageAlumni(){
        $page = Page::find(2);
        $blocks = $page->blocks()->get();
        $schools = School::all();

        return view('front.alumni',compact('page','blocks','schools'));
    }
    public function pageActivitats(){
        $page = Page::find(3);
        $intro = $page->blocks()->first();
        $activities = Activity::paginate(15);
        $activities = Activity::where('published', true)->get();
        $schools = School::all();
        $categories = Category::where('category_id',5)->get();

        return view('front.activitats',compact('page','intro','activities','schools','categories'));
    }
        public function searchActivitats(Request $request){
            $page = Page::find(3);
            $intro = $page->blocks()->first();
            $schools = School::all();
            $categories = Category::where('category_id',5)->get();

            $activitiesQuery = Activity::where('published',1);
            if($request->school_id){
                $activitiesQuery->where('school_id',$request->school_id)->orWhere('school_id', 7);
            }
            if($request->category_id){
                $activitiesQuery->where('category_id',$request->category_id);
            }
            if($t = $request->t){
                $activitiesQuery->where(function ($query) use ($t) {
                    $query->whereTranslationLike('title','%'.$t.'%')
                          ->orWhereTranslationLike('body','%'.$t.'%');
                });
            }
            $activities = $activitiesQuery->get();

            return view('front.activitats',compact('page','intro','activities','schools','categories'));
        }
    public function pageAvantatges(){
        $page = Page::find(4);
        $blocks = $page->blocks()->get();
        $schools = School::all();

        return view('front.avantatges',compact('page','schools','blocks'));
    }
    public function pageContact(){
        $page = Page::find(5);
        $intro = $page->blocks()->first();
        $schools = School::all();
        $mail = Configuration::first()->main_mail;

        return view('front.contacte',compact('page','intro','schools', 'mail'));
    }
        public function sendContact(Request $request){
            $form = $request->all();
            $school = School::find($request->school_id);

            Mail::send('emails.contact', ['form' => $form,'school'=>$school], function ($m) use ($form,$school) {
                $m->to(Configuration::first()->main_mail)->subject('Formulari de contacte');
            });

            return redirect()->back()->with('success','Gràcies. Ens posarem en contacte amb vostè aviat.');
        }

    public function singleActivity($slug){
        $activity = Activity::whereTranslation('slug',$slug)->first();

        return view('front.singles.activity',compact('activity'));
    }



/*****************/
    public function pagePrivacy(){
        $page = Page::find(8);
        $blocks = $page->blocks()->get();
        return view('front.pages.legal',compact('page','blocks'));
    }

    public function pageCookies(){
        $page = Page::find(9);
        $blocks = $page->blocks()->get();
        return view('front.pages.legal',compact('page','blocks'));
    }


    public function frontLogout(){
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }

    public function pageIntranetLanding(){
        return view('front.intranet.landing');
    }

    public function temporal(){
        return view('front.intranet.construction');
    }

    public function flushSession(Request $request){
        $request->session()->flush();
    }

    public function acceptCookies(){
        setcookie('cookies',true,strtotime( '+30 days' ));

        return redirect()->back();
    }

    public function closeBanner(){
        session()->put('no-banner',true);

        return back();
    }
}
?>
