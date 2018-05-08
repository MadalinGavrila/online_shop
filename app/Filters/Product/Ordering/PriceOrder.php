<?php

namespace App\Filters\Product\Ordering;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class PriceOrder extends FilterAbstract
{
    public function filter(Builder $builder, $value)
    {
        return $builder->orderBy('price', $this->resolveOrderDirection($value));
    }
}