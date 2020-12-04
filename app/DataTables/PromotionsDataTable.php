<?php

namespace App\DataTables;

use App\DataTables\MainDataTable;

class PromotionsDataTable extends MainDataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $promotion_name = str_slug($this->model->singular_table_name);

        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('actions', function ($entry) use ($promotion_name) {
                $model = $this->model->find($entry->id);
                $buttons = '';
                $buttons .= getMultilanguageEditButtons($promotion_name, $entry->id, $model);
                $buttons .= getTrashButton($promotion_name, $entry->id);
                return $buttons;
            })
            ->editColumn('title', function ($entry) use ($promotion_name) {
                return getEditUrl($promotion_name, $entry->id, $entry->title, true);
            })
            ->editColumn('school', function ($entry) {
                return getSchool($entry);
            })
            ->editColumn('created_at', function ($entry) {
                return formatDate($entry->created_at);
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
        $entries = $this->model->join('promotion_translations', 'promotions.id', '=', 'promotion_translations.promotion_id')
        ->select([
            'promotions.sort',
            'promotions.id',
            'promotion_translations.title',
            'promotions.created_at',
            'promotions.school_id',
        ])
        ->where('locale', config('app.locale'))
        ->groupBy('promotions.id');

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
                'data' => 'school',
                'title' => trans('messages.school'),
                'responsivePriority' => 1,
            ],
            [
                'data' => 'created_at',
                'title' => trans('messages.created'),
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
