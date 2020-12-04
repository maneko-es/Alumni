<?php

namespace App\DataTables;

use App\DataTables\MainDataTable;

class CategoriesDataTable extends MainDataTable
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
                $model = $this->model->find($entry->id);
                $buttons = '';
                $buttons .= getMultilanguageEditButtons($page_name, $entry->id, $model);
                $buttons .= getTrashButton($page_name, $entry->id);
                return $buttons;
            })
            ->editColumn('title', function ($entry) use ($page_name) {
                return getEditUrl($page_name, $entry->id, $entry->title, true);
            })
            ->editColumn('created_at', function ($entry) {
                return formatDate($entry->created_at);
            })
            ->editColumn('updated_at', function ($entry) {
                return formatDate($entry->updated_at);
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $entries = $this->model->join('category_translations', 'categories.id', '=', 'category_translations.category_id')
        ->select([
            'categories.sort',
            'categories.id',
            'category_translations.title',
            'categories.created_at',
            'categories.updated_at',
        ])
        ->where('locale', config('app.locale'))
        ->groupBy('categories.id');

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
                'title' => trans('messages.sort'),
                'data' => 'sort',
                'visible' => false,
                'printable' => false,
            ],
            [
                'data' => 'id',
                'visible' => false,
                'searchable' => false,
                'exportable' => false,
                'printable' => false,
            ],
            [
                'data' => 'title',
                'title' => trans('messages.name'),
                'responsivePriority' => 1,
            ],
            [
                'data' => 'created_at',
                'title' => trans('messages.created'),
            ],
            [
                'data' => 'updated_at',
                'title' => trans('messages.modified'),
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
