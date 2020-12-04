<?php

namespace App;

trait Publishable
{
    /**
     * Scope a query to only include published items
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('published', '=', 1);
    }
}
