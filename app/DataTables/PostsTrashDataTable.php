<?php

namespace App\DataTables;

use App\DataTables\MainDataTable;

class PostsTrashDataTable extends MainDataTable
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
        $entries = $this->model->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
        ->select([
            'posts.sort',
            'posts.id',
            'post_translations.title',
            'posts.created_at',
            'posts.deleted_at',
        ])
        ->where('locale', config('app.locale'))
        ->groupBy('posts.id')
        ->onlyTrashed();

        return $this->applyScopes($entries);

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
                'data' => 'title',
                'title' => trans('messages.title'),
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
