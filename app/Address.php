<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'address1', 'address2', 'country', 'city', 'postal_code'
    ];
}
