<?php

namespace App;

use App\Sortable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends BaseModel
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
        'original_size' => 'boolean',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'body',
        'slug',
        'button',
        'link',
        'hashtag',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'published',
        'page_id',
        
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
     * Get all of the medias for the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function medias()
    {
        return $this->morphToMany('App\MediaOriginal', 'mediable');
    }
    public function mediat()
    {
        return $this->belongsTo('App\Mediatranslated');
    }

    public function page()
    {
        return $this->belongsTo('App\Page');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }

}
