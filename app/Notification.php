<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends BaseModel
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
        'type',
        'mate_id',   
        'gallery_id',   
        'picture_id',   
    ];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps()->withPivot('seen');
    }
    public function gallery()
    {
        return $this->belongsTo('App\Gallery');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function picture()
    {
        return $this->belongsTo('App\Picture');
    }
}
