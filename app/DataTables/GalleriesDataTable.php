<?php

namespace App\DataTables;

use App\DataTables\MainDataTable;

class GalleriesDataTable extends MainDataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $gallery_name = str_slug($this->model->singular_table_name);

        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('actions', function ($entry) use ($gallery_name) {
                $model = $this->model->find($entry->id);
                $buttons = '';
                $buttons .= getMultilanguageEditButtons($gallery_name, $entry->id, $model);
                $buttons .= getTrashButton($gallery_name, $entry->id);
                return $buttons;
            })
            ->editColumn('title', function ($entry) use ($gallery_name) {
                return getEditUrl($gallery_name, $entry->id, $entry->title, true);
            })
            ->editColumn('pictures', function ($entry) {
                return $entry->pictures()->get()->count();
            })
            ->editColumn('promotion', function ($entry) {
                return getPromotion($entry);
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
        $entries = $this->model->join('gallery_translations', 'galleries.id', '=', 'gallery_translations.gallery_id')
        ->select([
            'galleries.sort',
            'galleries.id',
            'gallery_translations.title',
            'galleries.created_at',
            'galleries.promotion_id',
        ])
        ->where('locale', config('app.locale'))
        ->groupBy('galleries.id');

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
                'data' => 'pictures',
                'title' => trans('messages.pictures'),
                'responsivePriority' => 1,
            ],
            [
                'data' => 'promotion',
                'title' => trans('messages.promotion'),
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
