<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PostsDataTable as DataTable;
use App\DataTables\PostsTrashDataTable as TrashDataTable;
use App\Http\Requests\Admin\Post\PostCreateRequest as CreateRequest;
use App\Http\Requests\Admin\Post\PostUpdateRequest as UpdateRequest;

use App\Post;
use App\Category;
use App\User;
use App\Services\UploadManager;
use Illuminate\Http\Request;

class PostController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(new Post, new UploadManager);
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
        $categories = Category::where('category_id',1)->get()->pluck('title','id');

        return parent::renderCreate(new CreateRequest, compact('locale', 'categories'));
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

        if (!isset($request->medias)) {
            $request->medias = [];
        }
        $entry->medias()->sync($request->medias);

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
        $categories = Category::where('category_id',1)->get()->pluck('title','id');

        $updateRequest = new UpdateRequest;
        //We set the locale to the request to have the correct field names there.
        $updateRequest->request->add(['locale' => $locale]);

        $entry = $this->model->findOrFail($id);

        return parent::renderEdit($updateRequest, compact('entry', 'locale', 'categories'));
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

        if (!isset($request->medias)) {
            $request->medias = [];
        }
        $entry->medias()->sync($request->medias);

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
