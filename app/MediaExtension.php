<?php

namespace App;

class MediaExtension extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Gets a comma separated string with all the extensions on the table.
     *
     * @return string
     */
    protected static function getExtensionsString()
    {
        return implode(',', self::get()->pluck('name')->all());
    }
}
