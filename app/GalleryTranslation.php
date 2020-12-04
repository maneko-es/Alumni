<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;

class GalleryTranslation extends BaseModel
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
        'description',
        'slug',
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['gallery'];

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
    public function gallery()
    {
        return $this->belongsTo('App\Gallery');
    }
}
