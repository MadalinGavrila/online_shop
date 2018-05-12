<?php

namespace App\Filters\Product\Ordering;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class Ordering extends FilterAbstract
{
    public function mappings()
    {
        return [
            'newest' => ['created_at', 'desc'],
            'price_asc' => ['price', 'asc'],
            'price_desc' => ['price', 'desc'],
        ];
    }

    public function filter(Builder $builder, $value)
    {
        $value = $this->resolveFilterValue($value);

        if($value === null){
            return $builder;
        }

        $column = $value[0];
        $direction = $value[1];

        return $builder->orderBy($column, $direction);
    }
}