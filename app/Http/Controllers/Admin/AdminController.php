<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Order;
use App\DataTables\MainDataTable;
use App\Http\Controllers\Controller;
use App\MediaOriginal;
use App\Services\UploadManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use JsValidator;

class AdminController extends Controller
{
    /**
     * The model associated with the controller.
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The UploadManager variable.
     *
     * @var App\Services\UploadManager
     */
    protected $upload_manager;

    /**
     * Create a new controller instance.
     *
     * @param Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function __construct(Model $model, UploadManager $upload_manager = null)
    {
        if (!App::environment('testing')) {
            $this->middleware('admin');
        }

        $this->model = $model;
        $this->model->singular_table_name = $model->getSingularTableName();
        $this->model->table_name = $model->getTableName();

        $this->upload_manager = $upload_manager;

        view()->share([
            'singular_table_name' => $this->model->singular_table_name,
            'table_name' => $this->model->table_name
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function renderIndex(MainDataTable $dataTable)
    {
        return $this->renderIndexOrTrash($dataTable, 'index');
    }

    /**
     * Display a listing of the trash resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function renderTrash(MainDataTable $dataTable)
    {
        return $this->renderIndexOrTrash($dataTable, 'trash');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function renderCreate(Request $request, $data = [])
    {
        return $this->renderCreateEdit($request, $data, 'create');
    }

    /**
     * Redirect after store a newly created resource in storage.
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @param  array $data
     * @return \Illuminate\Http\Response
     */
    public function redirectStore(Model $model, $data = [])
    {
        return $this->redirectStoreUpdate($model, $data, 'oncreated');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array $data
     * @return \Illuminate\Http\Response
     */
    public function renderEdit(Request $request, $data = [])
    {
        return $this->renderCreateEdit($request, $data, 'edit');
    }

    /**
     * Redirect after update the specified resource in storage.
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @param  array $data
     * @return \Illuminate\Http\Response
     */
    public function redirectUpdate(Model $model, $data = [])
    {
        return $this->redirectStoreUpdate($model, $data, 'onedited');
    }

    /**
     * Remove the specified resource from storage using softdelete.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softDelete($id)
    {
        $entry = $this->model->findOrFail($id);
        $entry->delete();

        return redirect('/admin/' . str_slug($this->model->singular_table_name))
            ->withSuccess(trans('messages.ontrashed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entry = $this->model->findOrFail($id);
        $entry->delete();

        return redirect('/admin/' . str_slug($this->model->singular_table_name))
            ->withSuccess(trans('messages.ondeleted'));
    }

    /**
     * Remove the specified resource from storage
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyFromTrash($id)
    {
        $entry = $this->model->onlyTrashed()->findOrFail($id);
        $entry->forceDelete();

        return redirect('/admin/' . str_slug($this->model->singular_table_name) . '/trash')
            ->withSuccess(trans('messages.ondeleted'));
    }

    /**
     * Restore specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $entry = $this->model->onlyTrashed()->findOrFail($id);
        $entry->restore();

        return redirect('/admin/' . str_slug($this->model->singular_table_name) . '/trash')
            ->withSuccess(trans('messages.onrestored'));
    }

    /**
     * Changes order of resource
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function order(Request $request)
    {
        $order = json_decode($request->order);

        foreach ($order as $key => $value) {
            $client = $this->model->find($key);
            $client->sort = $value;
            $client->save();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\DataTables\MainDataTable $dataTable
     * @param  string $view
     * @return @return \Illuminate\Http\Response
     */
    public function renderIndexOrTrash(MainDataTable $dataTable, $view)
    {
        return $dataTable
            ->forModel($this->model)
            ->render('admin.' . $this->model->singular_table_name . '.' . $view);
    }

    /**
     * Refirect after store/update a newly created/edited resource in storage.
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @param  array $data
     * @param  string $message
     * @return \Illuminate\Http\Response
     */
    public function redirectStoreUpdate(Model $model, $data, $message)
    {
        $data = array_merge(['id' => $model->id], $data);

        return redirect()
            ->back()
            ->withSuccess(trans('messages.' . $message));

        /*return redirect()
            ->route('admin.' . str_slug($this->model->singular_table_name) . '.edit', $data)
            ->withSuccess(trans('messages.' . $message));*/
    }

    /**
     * Upload file.
     *
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    public function upload(Request $request)
    {
        $folder = config('maravel.media_originals_folder');

        $file = $request->file('file');

        $details = $this->upload_manager->getFileDetails($file);
        $request->merge($details);

        $filename = $this->upload_manager->upload($file, $folder);
        $request->merge(['filename' => $filename]);

        $entry = MediaOriginal::create($request->all());

        $entry->html = getThumbnail(
            $folder . '/' . $entry->filename,
            $entry->mime_type
        );

        return $entry;
    }

    /**
     * Show the form for creating/editing a resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  array $data
     * @param  string $view
     * @return \Illuminate\Http\Response
     */
    private function renderCreateEdit(Request $request, $data, $view)
    {
        $validator = JsValidator::formRequest($request, '#' . config('maravel.default_form_name'));

        $data = array_merge($data, compact('validator'));

        return view(
            'admin.' . $this->model->singular_table_name . '.' . $view,
            $data
        );
    }

}
