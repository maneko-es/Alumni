<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MediaTranslatedsDataTable as DataTable;
use App\DataTables\MediaTranslatedsTrashDataTable as TrashDataTable;
use App\Http\Requests\Admin\MediaTranslated\MediaTranslatedCreateRequest as CreateRequest;
use App\MediaTranslated;
use App\Services\UploadManager;
use Illuminate\Http\Request;

class MediaTranslatedController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(new MediaTranslated, new UploadManager);
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
        return parent::renderCreate(new CreateRequest);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        parent::upload($request);

        return redirect('/admin/media-translated')->withSuccess(trans('messages.oncreated'));
    }

    /**
     * Remove the specified resource from storage
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entry = $this->model->onlyTrashed()->findOrFail($id);

        $filepath = config('maravel.media_translateds_folder') . $entry->filename;

        if (file_exists($filepath)) {
            @unlink($filepath);
        }

        return parent::destroyFromTrash($id);
    }
}
