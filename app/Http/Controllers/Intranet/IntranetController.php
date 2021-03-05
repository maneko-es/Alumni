<?php
namespace App\Http\Controllers\Intranet;

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\Controller as MyController;

use App;
use App\Page;
use App\Perk;
use App\Gallery;
use App\Category;
use App\Promotion;
use App\Picture;
use App\DataTables\MainDataTable;
use App\Http\Controllers\Controller;
use App\MediaOriginal;
use App\Services\UploadManager;
use Illuminate\Database\Eloquent\Model;
use JsValidator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntranetController extends MyController
{
    public function __construct(){

    }

    public function dashboard(){
        return view('front.intranet.dashboard');
    }
    public function viewPerks(){
        $schools = Auth::user()->schools->pluck('id')->toArray();
        // $perks = Perk::paginate(5);
        $perks = Perk::where('school_id', 0)->orWhereIn('school_id', $schools)->get();
        $blocks = Page::find(6)->blocks()->get();
        return view('front.intranet.perks',compact('perks','blocks'));
    }
    public function searchPerks(Request $request){
        $schools = Auth::user()->schools->pluck('id')->toArray();
        $t = $request->t;
        $blocks = Page::find(6)->blocks()->get();
        // $perks = Perk::whereTranslationLike('title','%'.$t.'%')->orWhereTranslationLike('body','%'.$t.'%')->paginate(5);
        $perks = Perk::whereTranslationLike('title','%'.$t.'%')->orWhereTranslationLike('body','%'.$t.'%')->whereIn('school_id', $schools)->get();
        return view('front.intranet.perks',compact('blocks','perks','t'));
    }

    public function viewGallery(){
        $user = Auth::user();
        if($user->preferred_promotion){
            $promotion = Promotion::find($user->preferred_promotion);
        } else {
            $promotion = $user->promotions->first();
        }
        $galleries = $promotion->galleries()->where('published', true)->paginate(9);
        $categories = Category::where('category_id',11)->get();
        return view('front.intranet.gallery',compact('galleries','categories'));
    }

    public function singleGallery($slug){
        $gallery = Gallery::whereTranslation('slug',$slug)->first();
        $pictures = $gallery->pictures()->orderBy('created_at','desc')->paginate(15);

        return view('front.intranet.singles.gallery',compact('gallery','pictures'));
    }
    public function singlePicture($slug,$id){
        $gallery = Gallery::whereTranslation('slug',$slug)->first();
        $picture = Picture::find($id);
        $prev = Picture::where('id', '<', $id)->max('id');
        $next = Picture::where('id', '>', $id)->min('id');

        return view('front.intranet.singles.picture',compact('gallery','picture','prev','next'));
    }


    public function markAsRead(Request $request){
        $user = Auth::user();
        $notifications = $user->notifications()->where('promotion_id',$request->promotion_id)->wherePivot('seen',0)->pluck('id');
        foreach($notifications as $n){
            $user->notifications()->updateExistingPivot($n,['seen'=>1]);
        }
    }



}
