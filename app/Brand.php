<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeByProducts(Builder $builder, $id)
    {
        return $builder->whereHas('products', function(Builder $builder) use ($id){
            $builder->whereIn('id', $id);
        });
    }

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
