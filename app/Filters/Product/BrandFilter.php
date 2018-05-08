<?php

namespace App\Filters\Product;

use App\Brand;
use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class BrandFilter extends FilterAbstract
{
    public function mappings()
    {
        return Brand::pluck('slug', 'slug')->all();
    }

    public function filter(Builder $builder, $value)
    {
        $value = $this->resolveFilterValue($value);

        if($value === null){
            return $builder;
        }

        return $builder->whereHas('brands', function(Builder $builder) use ($value){
            $builder->where('slug', $value);
        });
    }
}