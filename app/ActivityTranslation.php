<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;

class ActivityTranslation extends BaseModel
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
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['activity'];

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
     * Get the activity that the translation belongs to.
     */
    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }
}
