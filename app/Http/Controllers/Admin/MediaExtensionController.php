<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\MediaExtension\MediaExtensionCreateRequest as CreateRequest;
use App\Http\Requests\Admin\MediaExtension\MediaExtensionUpdateRequest as UpdateRequest;

use App\MediaExtension;

use App\DataTables\MediaExtensionsDataTable as DataTable;

class MediaExtensionController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(new MediaExtension);
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
        $entry = $this->model->create($request->all());

        return parent::redirectStore($entry);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $entry = $this->model->findOrFail($id);

        return parent::renderEdit(new UpdateRequest, compact('entry'));
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
        $entry = $this->model->findOrFail($id);

        $entry->update($request->all());

        return parent::redirectUpdate($entry);
    }
}
