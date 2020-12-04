<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class RoleTranslation extends BaseModel
{
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
        'name'
    ];
}
