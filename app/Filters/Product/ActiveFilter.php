<?php

namespace App\Filters\Product;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class ActiveFilter extends FilterAbstract
{
    public function mappings()
    {
        return [
            'yes' => true,
            'no' => false,
        ];
    }

    public function filter(Builder $builder, $value)
    {
        $value = $this->resolveFilterValue($value);

        if($value === null){
            return $builder;
        }

        return $builder->where('visible', $value);
    }
}