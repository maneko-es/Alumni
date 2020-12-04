<?php

namespace App;

use App\Sortable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends BaseModel
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
        'slug',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'published',
        'category_id',
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

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function categories()
    {
        return $this->hasMany('App\Category');
    }
}
