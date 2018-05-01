<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = ['photo', 'visible'];

    protected $uploads = '/images/slides/';

    public function getPhotoAttribute($value)
    {
        return $this->uploads . $value;
    }
}
