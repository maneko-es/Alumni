<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;

class BlockTranslation extends BaseModel
{
    use Sluggable;

    /**
     * Disabling auto timestamps
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'slug',
        'button',
        'link',
        'hashtag',
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['block'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the post that the translation belongs to.
     */
    public function block()
    {
        return $this->belongsTo('App\Block');
    }
}
