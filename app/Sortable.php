<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

trait Sortable
{
    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootSortable()
    {
        static::creating(function ($model) {
            $model->setHighestOrderNumber();
        });
    }

    /**
     * Determine the order value for the new record.
     *
     * @return integer
     */
    public function setHighestOrderNumber()
    {
        $max = (int) static::max('sort');
        $this->sort = $max + 1;
    }

    /**
     * Scope a query to ordered it by direction.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $direction
     */
    public function scopeOrdered(Builder $query, $direction = 'asc')
    {
        return $query->orderBy('sort', $direction);
    }
}
