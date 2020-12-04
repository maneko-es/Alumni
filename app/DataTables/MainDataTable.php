<?php

namespace App\DataTables;

use Yajra\Datatables\Services\DataTable;
use Illuminate\Contracts\View\Factory;
use Yajra\Datatables\Datatables;

abstract class MainDataTable extends DataTable
{
    /**
     * Gets model passed from controller and adds data to $this.
     *
     * @return this
     */
    public function forModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get builder parameters.
     *
     * @return array
     */
    protected function getBuilderParameters()
    {
        return config('maravel.default_datatables');
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return strtolower(trans('messages.' . $this->model->table_name));
    }
}
