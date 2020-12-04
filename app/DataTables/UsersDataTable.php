<?php

namespace App\DataTables;

use App\DataTables\MainDataTable;

class UsersDataTable extends MainDataTable
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
                $buttons .= getEditButton($page_name, $entry->id);
                $buttons .= getTrashButton($page_name, $entry->id);
                return $buttons;
            })
            ->editColumn('email', function ($entry) use ($page_name) {
                return getEditUrl($page_name, $entry->id, $entry->email);
            })
            ->editColumn('promotions', function ($entry) use ($page_name) {
                return getUserPromos($entry);
            })
            ->addColumn('role', function ($entry) {
                $roles = '';
                $theroles = $entry->roles;
                foreach($theroles as $r){
                    if($r->name == 'Admin'){ $roles .= '<b style="color: red">Admin</b> - '; }
                    else {$roles .= $r->name;}
                }
                return $roles;
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
        $entries = $this->model
        ->select([
            'id',
            'email',
            'name',
        ])
        ->groupBy('users.id');

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
                'data' => 'email',
                'title' => trans('messages.email'),
                'responsivePriority' => 1,
                'orderable' => false,
            ],
            [
                'data' => 'name',
                'title' => trans('messages.name'),
                'orderable' => false,
            ],
            [
                'data' => 'promotions',
                'title' => trans('messages.promotions'),
                'orderable' => false,
            ],
            [
                'data' => 'role',
                'title' => trans('messages.role'),
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
