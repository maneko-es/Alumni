<?php

namespace App\DataTables;

use App\DataTables\MainDataTable;

class RegistriesDataTable extends MainDataTable
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
                $buttons .= getTrashButton($page_name, $entry->id);
                return $buttons;
            })
            ->editColumn('title', function ($entry) use ($page_name) {
                return getEditUrl($page_name, $entry->id, $entry->name, true);
            })
            ->editColumn('status', function ($entry) {
                if($entry->status == 'accepted'){
                    return '<b style="color:green">Registre acceptat</b>';
                } elseif($entry->status == 'denied'){
                    return '<b style="color:red">Registre denegat</b>';
                } else {
                    return '<b style="color:gray">Pendent</b>';
                }
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
        $entries = $this->model->join('school_translations', 'registries.school_id', '=', 'school_translations.school_id')
        ->select([
            'registries.id',
            'registries.name',
            'registries.email',
            'registries.school_id',
            'school_translations.title as school',
            'registries.year',
            'registries.status',
        ])
        ->where('locale', config('app.locale'))
        ->groupBy('registries.id');

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
                'responsivePriority' => 1,
                'orderable' => false,
            ],
            [
                'data' => 'status',
                'title' => 'Estat',
                'responsivePriority' => 1,
                'orderable' => false,
            ],
            [
                'data' => 'email',
                'title' => trans('messages.email'),
                'responsivePriority' => 1,
                'orderable' => false,
            ],
            [
                'data' => 'school',
                'title' => trans('messages.school_id'),
                'responsivePriority' => 1,
                'orderable' => false,
            ],
            [
                'data' => 'year',
                'title' => trans('messages.year'),
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
