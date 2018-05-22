<?php

namespace App;

use App\Filters\Product\ProductFilters;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use Illuminate\Database\Eloquent\Builder;
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

    public $quantity = null;

    protected $fillable = [
        'name', 'price', 'stock', 'description', 'visible', 'slug'
    ];

    protected $uploads = '/images/';

    public function photoPlaceholder()
    {
        return $this->uploads . "placeholder_product.png";
    }

    public function hasLowStock()
    {
        if($this->outOfStock()){
            return false;
        }

        return (bool) ($this->stock <= 5);
    }

    public function outOfStock()
    {
        return $this->stock === 0;
    }

    public function inStock()
    {
        return $this->stock >= 1;
    }

    public function hasStock($quantity)
    {
        return $this->stock >= $quantity;
    }

    public function scopeFilter(Builder $builder, $request, array $filters = [])
    {
        return (new ProductFilters($request))->add($filters)->filter($builder);
    }

    public function scopeByVisible(Builder $builder, $visible)
    {
        return $builder->where('visible', $visible);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRoute()
    {
        return 'admin.products.showPhotos';
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
        return strtoupper($value);
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

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
}
