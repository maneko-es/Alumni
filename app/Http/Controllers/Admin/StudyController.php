<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Study\StudyCreateRequest as CreateRequest;
use App\Http\Requests\Admin\Study\StudyUpdateRequest as UpdateRequest;

use App\Study;
use Illuminate\Http\Request;

class StudyController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(new Study);
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

        return parent::redirectStore($entry, compact('locale'));
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
        $request->request->add(['original_size' => $request->original_size]);

        $entry->update($request->all());

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
