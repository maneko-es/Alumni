<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Role extends BaseModel
{
    use Translatable;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'name'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * Get Roles list.
     *
     * @return array
     */
    protected static function getRolesList()
    {
        return static::whereHas('translations', function ($query) {
            $query->where('locale', config('app.fallback_locale'));
        })
            ->get()
            ->pluck('name', 'id');
    }
}
