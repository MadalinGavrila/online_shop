<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'path', 'imageable_id', 'imageable_type'
    ];

    protected $uploads = '/images/';

    public function getPathAttribute($value)
    {
        return $this->uploads . $value;
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
