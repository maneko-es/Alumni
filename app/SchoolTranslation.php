<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;

class SchoolTranslation extends BaseModel
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
        'slug'
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['school'];

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
     * Get the school that the translation belongs to.
     */
    public function school()
    {
        return $this->belongsTo('App\School');
    }
}
