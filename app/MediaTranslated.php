<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class MediaTranslated extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'filename',
      'extension',
      'mime_type',
      'size',
      'width',
      'height',
      'position',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get all of the posts that are assigned this media original.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function blocks()
    {
        return $this->morphedByMany('App\Block', 'mediablet');
    }
}
