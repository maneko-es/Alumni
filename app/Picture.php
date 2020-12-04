<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Picture extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gallery_id',
        'description',   
        'img',   
    ];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    public function gallery()
    {
        return $this->belongsTo('App\Gallery');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
