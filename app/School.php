<?php

namespace App;

use App\Sortable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends BaseModel
{
    use SoftDeletes;
    use Translatable;
    use Sortable;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'published' => 'boolean',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'slug'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'published',
        'color',
        'link',
        'email',
    ];


    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    //protected $with = ['translations'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * Get all of the medias for the school.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function medias()
    {
        return $this->morphToMany('App\MediaOriginal', 'mediable');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
