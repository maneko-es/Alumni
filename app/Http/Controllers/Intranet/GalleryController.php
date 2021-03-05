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
use App\Notification;
use App\User;
use App\DataTables\MainDataTable;
use App\Http\Controllers\Controller;
use App\MediaOriginal;
use App\Services\UploadManager;
use Illuminate\Database\Eloquent\Model;
use JsValidator;
use Image;

use Illuminate\Http\Request;
use App\Http\Requests\GalleryMediaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\PostTooLargeException;

class GalleryController extends MyController
{

    public function searchGallery(Request $request){
        $categories = Category::where('category_id',11)->get();
        $galleriesQuery = Gallery::where('promotion_id',$request->promotion_id)->where('published', true);
        if($request->category_id){
            $galleriesQuery->where('category_id',$request->cat);
        }
        if($t = $request->t){
            $galleriesQuery->where(function ($query) use ($t) {
                $query->whereTranslationLike('title','%'.$t.'%')
                      ->orWhereTranslationLike('description','%'.$t.'%');
            });
        }

        $galleries = $galleriesQuery->paginate(9);

        return view('front.intranet.gallery',compact('galleries','t','categories'));
    }
    public function createGalleryFront(){
        $categories = Category::where('category_id',11)->get();
        return view('front.intranet.create-gallery',compact('categories'));
    }


    public function saveGalleryFront(GalleryMediaRequest $request){

        $user = Auth::user();
        $gallery = new Gallery;
        $gallery->title = $request->name;
        $gallery->description = $request->description;
        $gallery->promotion_id = $request->promotion_id;
        $gallery->category_id = $request->category_id;
        $gallery->created_by = $user->id;
        $gallery->published = true;

        $gallery->slug = str_slug($gallery->title);

        $gallery->save();

        if($files = $request->file()['pictures']) {
            foreach($files as $file){
                $picture = new Picture;
                $picture->gallery_id = $gallery->id;
                $picture->uploaded_by = $user->id;
                $picture->save();

                $filename = pathinfo($file->getClientOriginalName())['filename'];

                $imgName = 'p'.$picture->id.'-g'.$gallery->id.'.'.$file->getClientOriginalExtension();

                $fullsize_path = public_path('galleries');
                $originalsize_path = public_path('galleries/originals');
                $mediumsize_path = public_path('galleries/medium');
                $thumbnailsize_path = public_path('galleries/thumbnails');

                $img = Image::make($file->path());
                //Save original
                $file->move($originalsize_path, $imgName);
                //Save fullsize
                $img->resize(1000, null, function ($constraint) { $constraint->aspectRatio(); })->save($fullsize_path.'/'.$imgName);
                //Save medium
                $img->resize(550, null, function ($constraint) { $constraint->aspectRatio(); })->save($mediumsize_path.'/'.$imgName);
                //Save thumbnail
                $img->resize(150, null, function ($constraint) { $constraint->aspectRatio(); })->save($thumbnailsize_path.'/'.$imgName);

                $picture->img = $imgName;
                $picture->save();
            }

            /*return response()->json([
                'img' => url('images/galleries/'.$imgName),
            ]);*/
        }


        $notification = new Notification;
        $notification->type = 'gallery';
        $notification->gallery_id = $gallery->id;
        $notification->promotion_id = $gallery->promotion_id;
        $notification->save();

        $target = $gallery->promotion->users()->get();
        foreach($target as $us){
            $us->notifications()->attach($notification);
        }

        return redirect(route('gallery-single',['slug'=>$gallery->slug]));
    }


    public function tagUsers(Request $request){
        $picture = Picture::find($request->picture_id);

        $notification = new Notification;
        $notification->type = 'tag';
        $notification->picture_id = $picture->id;
        $notification->promotion_id = $picture->gallery->promotion_id;
        $notification->save();

        foreach($request->users as $mate){
            $mateUser = User::find($mate);
            $picture->users()->attach($mateUser);
            $mateUser->notifications()->attach($notification);
        }

        return redirect()->back();
    }
    public function deleteTag(Request $request){
        $picture = Picture::find($request->picture_id);

        $picture->users()->detach(Auth::user()->id);

        return redirect()->back();
    }
    public function addDescription(Request $request){
        $picture = Picture::find($request->picture_id);
        $picture->description = $request->description;
        $picture->save();

        return redirect()->back();
    }
    public function addPictures(GalleryMediaRequest $request){
        $user = Auth::user();
        $gallery = Gallery::find($request->gallery_id);

        if($files = $request->file()['pictures']) {
            foreach($files as $file){
                $picture = new Picture;
                $picture->gallery_id = $gallery->id;
                $picture->uploaded_by = $user->id;
                $picture->save();

                $filename = pathinfo($file->getClientOriginalName())['filename'];

                $imgName = 'p'.$picture->id.'-g'.$gallery->id.'.'.$file->getClientOriginalExtension();

                $fullsize_path = public_path('galleries');
                $originalsize_path = public_path('galleries/originals');
                $mediumsize_path = public_path('galleries/medium');
                $thumbnailsize_path = public_path('galleries/thumbnails');

                $img = Image::make($file->path());
                //Save original
                $file->move($originalsize_path, $imgName);
                //Save fullsize
                $img->resize(1000, null, function ($constraint) { $constraint->aspectRatio(); })->save($fullsize_path.'/'.$imgName);
                //Save medium
                $img->resize(550, null, function ($constraint) { $constraint->aspectRatio(); })->save($mediumsize_path.'/'.$imgName);
                //Save thumbnail
                $img->resize(150, null, function ($constraint) { $constraint->aspectRatio(); })->save($thumbnailsize_path.'/'.$imgName);

                $picture->img = $imgName;
                $picture->save();
            }
        }

        return redirect()->back();
    }

}
