<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\GalleriesDataTable as DataTable;
use App\DataTables\GalleriesTrashDataTable as TrashDataTable;
use App\Http\Requests\Admin\Gallery\GalleryCreateRequest as CreateRequest;
use App\Http\Requests\Admin\Gallery\GalleryUpdateRequest as UpdateRequest;

use App\Gallery;
use App\Promotion;
use App\Picture;
use Image;
use App\Services\UploadManager;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(new Gallery, new UploadManager);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTable $dataTable)
    {
        return parent::renderIndex($dataTable);
    }

    /**
     * Display a listing of the trash resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(TrashDataTable $dataTable)
    {
        return parent::renderTrash($dataTable);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locale = config('app.locale');
        $promotions_arr = Promotion::all();
        $promotions = array();
        foreach($promotions_arr as $promo){
            $promotions[$promo->id] = $promo->title.' - '.$promo->school()->first()->title;
        }

        return parent::renderCreate(new CreateRequest, compact('locale','promotions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $locale = $request->locale;

        $entry = $this->model->create($request->all());

        if($files = $request->file()['pictures']) {
            foreach($files as $file){
                $picture = new Picture;
                $picture->gallery_id = $entry->id;
                $picture->save();

                $filename = pathinfo($file->getClientOriginalName())['filename'];

                $imgName = 'p'.$picture->id.'-g'.$entry->id.'.'.$file->getClientOriginalExtension();

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
        } else {
            dd('dont have file');
        }

        return parent::redirectStore($entry, compact('locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $locale = $request->locale;
        $promotions_arr = Promotion::all();
        $promotions = array();
        foreach($promotions_arr as $promo){
            $promotions[$promo->id] = $promo->title.' - '.$promo->school()->first()->title;
        }


        $updateRequest = new UpdateRequest;
        //We set the locale to the request to have the correct field names there.
        $updateRequest->request->add(['locale' => $locale]);

        $entry = $this->model->findOrFail($id);

        return parent::renderEdit($updateRequest, compact('entry', 'locale','promotions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $locale = $request->locale;
        $entry = $this->model->findOrFail($id);

        $request->request->add(['published' => $request->published]);

        $entry->update($request->all());

        if($files = $request->file()['pictures']) {
            foreach($files as $file){
                $picture = new Picture;
                $picture->gallery_id = $entry->id;
                $picture->save();

                $filename = pathinfo($file->getClientOriginalName())['filename'];

                $imgName = 'p'.$picture->id.'-g'.$entry->id.'.'.$file->getClientOriginalExtension();

                $fullsize_path = public_path('galleries');
                $originalsize_path = public_path('galleries/originals');
                $mediumsize_path = public_path('galleries/medium');
                $thumbnailsize_path = public_path('galleries/thumbnails');

                $img = Image::make($file->path());
                //Save original
                $file->move($originalsize_path, $imgName);
                //Save fullsize
                $img->resize(1300, null, function ($constraint) { $constraint->aspectRatio(); })->save($fullsize_path.'/'.$imgName);
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
        } else {
            dd('dont have file');
        }

        return parent::redirectUpdate($entry, compact('locale'));
    }

    /**
     * Remove the specified resource from storage
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return parent::destroyFromTrash($id);
    }

    public function softDelete($id)
    {
        $entry = $this->model->findOrFail($id);
        $entry->delete();

        return redirect('/admin/' . str_slug($this->model->singular_table_name))
            ->withSuccess(trans('messages.ontrashed'));
    }
}
