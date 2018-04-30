<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    protected $fillable = [
        'name', 'slug'
    ];

    protected $uploads = '/images/';

    public function photoPlaceholder()
    {
        return $this->uploads . "placeholder_brand.png";
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRoute()
    {
        return 'admin.brands.edit';
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function photo()
    {
        return $this->morphOne(Photo::class, 'imageable');
    }
}
