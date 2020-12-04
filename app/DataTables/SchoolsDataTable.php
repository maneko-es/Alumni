<?php

namespace App\DataTables;

use App\DataTables\MainDataTable;

class SchoolsDataTable extends MainDataTable
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
            ->editColumn('color', function ($entry) {
                return '<span style="display: block; width: 100px; height: 20px; background-color: '.$entry->color.'">&nbsp;</span>';
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
        $entries = $this->model->join('school_translations', 'schools.id', '=', 'school_translations.school_id')
        ->select([
            'schools.sort',
            'schools.id',
            'schools.color',
            'school_translations.title',
        ])
        ->where('locale', config('app.locale'))
        ->groupBy('schools.id');

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
                'title' => trans('messages.title'),
                'responsivePriority' => 1,
                'orderable' => false,
            ],
            [
                'data' => 'color',
                'title' => 'Color',
                'responsivePriority' => 1,
                'orderable' => false,
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
