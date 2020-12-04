<?php

namespace App;

class Login extends BaseModel
{



    protected $fillable = [
        'ip',
        'place',
        'device',
        'browser',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
