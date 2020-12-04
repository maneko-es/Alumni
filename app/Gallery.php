<?php

namespace App;

use App\Sortable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends BaseModel
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
        'description',
        'slug',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'published',
        'promotion_id'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The robots value that belongs to the entry.
     *
     * @return HasOne
     */
    public function promotion()
    {
        return $this->belongsTo('App\Promotion');
    }
    public function pictures()
    {
        return $this->hasMany('App\Picture');
    }


    /**
     * Get all of the medias for the gallery.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function medias()
    {
        return $this->morphToMany('App\MediaOriginal', 'mediable');
    }
}
