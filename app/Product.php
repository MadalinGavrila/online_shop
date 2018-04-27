<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
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
        'name', 'price', 'stock', 'description', 'visible', 'slug'
    ];

    protected $uploads = '/images/';

    public function photoPlaceholder()
    {
        return $this->uploads . "placeholder_product.png";
    }

    public function addSubCategory($subCategory_id)
    {
        $subCategory = SubCategory::find($subCategory_id);

        $this->subCategories()->attach($subCategory);

        return $this;
    }

    public function withdrawSubCategory($subCategory_id)
    {
        $subCategory = SubCategory::find($subCategory_id);

        $this->subCategories()->detach($subCategory);

        return $this;
    }

    public function addBrand($brand_id)
    {
        $brand = Brand::find($brand_id);

        $this->brands()->attach($brand);

        return $this;
    }

    public function updateBrand($brand_id)
    {
        $this->brands()->detach();

        return $this->addBrand($brand_id);
    }

    public function withdrawBrand($brand_id)
    {
        $brand = Brand::find($brand_id);

        $this->brands()->detach($brand);

        return $this;
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class);
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'imageable');
    }
}
