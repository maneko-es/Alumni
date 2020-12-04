<?php

namespace App\DataTables;

use App\DataTables\MainDataTable;

class MediaOriginalsTrashDataTable extends MainDataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $page_name = str_slug($this->model->singular_table_name);

        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('actions', function ($entry) use ($page_name) {
                $buttons = '';
                $buttons .= getRestoreButton($page_name, $entry->id);
                $buttons .= getDeleteButton($page_name, $entry->id);
                return $buttons;
            })
            ->editColumn('filename', function ($entry) use ($page_name) {
                $media = getThumbnail(config('maravel.media_originals_folder') . $entry->filename, $entry->mime_type);
                $media .= $entry->filename;
                return $media;
            })
            ->editColumn('size', function ($entry) {
                return human_filesize($entry->size);
            })
            ->editColumn('created_at', function ($entry) {
                return formatDate($entry->created_at);
            })
            ->editColumn('deleted_at', function ($entry) {
                return formatDate($entry->deleted_at);
            })
            ->withTrashed()
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $entries = $this->model->select([
            'id',
            'filename',
            'size',
            'mime_type',
            'created_at',
            'deleted_at',
        ])
        ->onlyTrashed();

        return $this->applyScopes($entries);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    public function getColumns()
    {
        return [
            [
                'data' => 'id',
                'visible' => false,
                'searchable' => false,
                'exportable' => false,
                'printable' => false,
            ],
            [
                'data' => 'filename',
                'title' => trans('messages.filename'),
                'responsivePriority' => 1,
            ],
            [
                'data' => 'size',
                'title' => trans('messages.size'),
                'orderable' => false,
            ],
            [
                'data' => 'created_at',
                'title' => trans('messages.created'),
            ],
            [
                'data' => 'deleted_at',
                'title' => trans('messages.deleted'),
            ],
            [
                'data' => 'actions',
                'title' => trans('messages.actions'),
                'className' => 'actions',
                'orderable' => false,
                'searchable' => false,
                'exportable' => false,
                'printable' => false,
                'responsivePriority' => 1,
            ],
        ];
    }
}
